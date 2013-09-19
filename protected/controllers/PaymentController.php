<?php

class PaymentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','history','reports'),
				'users'=>array('@'),
			),
			
            /*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('update','delete'),
				'users'=>array('@'),
			),*/

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('update', 'delete'),
                'expression'=>'Yii::app()->User->isAdmin()',
            ),
            
            
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    public function actionReports()
	{
        $this->layout = '//layouts/column1';
		$date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']:'';
        $date2 = isset($_REQUEST['date2'])?$_REQUEST['date2']:'';
        $date_range = isset($_REQUEST['date_range'])?$_REQUEST['date_range']:'';
        $today = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));
        $last7days = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 7, date("Y")));
        $yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
        $thisMonth = date("Y-m-d", mktime(0, 0, 0, date("m") , 01, date("Y")));
        
        $date_options = isset($_REQUEST['date_options'])?$_REQUEST['date_options']:'';
        if(empty($date1)&&empty($date2)&&empty($date_options)) $date_options = 'today';
        if(!empty($date_options)){
            if($date_options=="today"){
                $date1 = $today;
                $date2 = $today;			
            }else if($date_options=="yesterday"){
                $date1 = $yesterday;
                $date2 = $yesterday;
            }else if($date_options=="last_7_days"){
                $date1 = $last7days;
                $date2 = $today;
            }else if($date_options=="last_month"){
                $date1 = date("Y-m-1", strtotime("-1 month"));
                $date2 = date("Y-m-t", strtotime("-1 month"));
            }else if($date_options=="current_month"){
                $date1 = $thisMonth;
                $date2 = $today;
            }else{
                $date1 = $today;
                $date2 = $today;
                $date_options = "today";
            }
        }

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $model = Payment::model();
        $this->render('reports', array('model'=>$model,
            'date_options'=>$date_options,'date1'=>$date1,
            'date2'=>$date2,'date_range'=>$date_range));
	}
    
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Payment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Payment']))
		{
			$model->attributes=$_POST['Payment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        $enrollment = new Enrollment('search');
        $enrollment->unsetAttributes();
		$this->render('create',array(
			'model'=>$model,'enrollment'=>$enrollment
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Payment']))
		{
			$model->attributes=$_POST['Payment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        $enrollment = new Enrollment('search');
        $enrollment->unsetAttributes();
		$this->render('create',array(
			'model'=>$model,'enrollment'=>$enrollment
		));

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
        $enrollment_id = $model->enrollment_id;
        $model->delete();
        $enrollment = Enrollment::model()->findByPk($enrollment_id);
        $enrollment->updatePaymentStatus();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Payment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionHistory($id)
	{
		$model=new Payment('search');
		$model->unsetAttributes();  // clear any default values
        $model->enrollment_id = $id;

		$this->render('history',array(
			'model'=>$model,
		));
	}
    
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Payment('search');
		$model->unsetAttributes();  // clear any default values
        
		if(isset($_GET['Payment']))
			$model->attributes=$_GET['Payment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Payment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Payment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Payment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
