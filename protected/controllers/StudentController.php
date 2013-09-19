<?php

class StudentController extends Controller
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
            array('allow', // allow authenticated user to perform 'students' and 'update' actions
				'actions'=>array('students','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','summary','accounts','attendance'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionAccounts()
    {
        $this->layout = 'column1';
      
        $enrollment=new Enrollment('search');
		$enrollment->unsetAttributes();
        $enrollment->enrollment_type_id = Yii::app()->params['individual'];
        
        $payment=new Payment('search');
		$payment->unsetAttributes();  // clear any default values

        $payment->enrollment_id = -1;
        if(!empty($_REQUEST['enrollment_id'])){
            $payment->enrollment_id = $_REQUEST['enrollment_id'];
        }
        $this->render('accounts',array(
            'payment'=> $payment,
            'enrollment'=> $enrollment
        ));
    }
    
    public function actionAttendance()
    {
        $this->layout = 'column1';

        $enrollment=new Enrollment('search');
		$enrollment->unsetAttributes();
        $enrollment->enrollment_type_id = Yii::app()->params['individual'];
        $enrollment->status = Yii::app()->params['onGoing'];

        $classSchedule = new ClassSchedule('search');
        $classSchedule->enrollment_id = empty($_REQUEST['enrollment_id'])?-1:$_REQUEST['enrollment_id'];
       
        $this->render('attendance',array(
            'classSchedule'=> $classSchedule,
            'enrollment'=> $enrollment
        ));
    }
    
    public function actionSummary()
    {
        $this->layout = 'column1';

        
        $enrollment=new Enrollment('search');
		$enrollment->unsetAttributes();
        $enrollment->enrollment_type_id = Yii::app()->params['individual'];
        $enrollment->status = Yii::app()->params['onGoing'];

        
        $classSchedule = new ClassSchedule('search');
        $classSchedule->enrollment_id = empty($_REQUEST['enrollment_id'])?-1:$_REQUEST['enrollment_id'];
        /*if(!empty($_REQUEST['student_id'])&&!empty($_REQUEST['course_id'])){
            $criteria = new CDbCriteria;
            $criteria->condition='student_id=:student_id AND status=:status AND course_id=:course_id';
            $criteria->params=array(':student_id'=>$_REQUEST['student_id'], 
                ':course_id'=>$_REQUEST['course_id'], ':status'=>Yii::app()->params['onGoing']);
            $searchEnrollment = Enrollment::model()->find($criteria);
            if($searchEnrollment!==null){
                $classSchedule->enrollment_id = $searchEnrollment->id;
            }
        }*/
        $this->render('summary',array(

            'classSchedule'=> $classSchedule,
            'enrollment'=> $enrollment
        ));
    }
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
        $_criteria = new CDbCriteria();
        $_criteria->addCondition('student_id = '.$model->id);
        //$enrollment = Enrollment::model()->find( $_criteria);
        $enrollment=new Enrollment('search');
		$enrollment->unsetAttributes();
        $enrollment->student_id = $model->id;
        $this->render('view',array(
            'model'=>$model,
            'groupItems'=>GroupItems::model(),
            'enrollment'=>$enrollment,
        ));       
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Student;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{

            $students = $_POST['Student'];
            $students['name'] = $students['last_name'].', '.$students['first_name'].' '.substr($students['middle_name'], 0,1).'.';
            $model->attributes=$students;
            
            $imageFileName = '';
			
            $model->attributes = $students;

            if($students['photo_source']=='upload'){
                $imageUploadFile = CUploadedFile::getInstance($model,'photo');
                if($imageUploadFile !== null){ // only do if file is really uploaded
                    $imageFileName = mktime().$imageUploadFile->name;
                    $model->photo = $imageFileName;
                    $imageUploadFile->saveAs('photo-upload/'.$imageFileName);
                }
            }else{
                if(!empty($students['photo2'])){
                    preg_match('#^data:[\w/]+(;[\w=]+)*,[\w+/=%]+$#', $data=$students['photo2']);
                    $filename = uniqid().".png";
                    copy($data, "photo-upload/".$filename);
                    $studentPhoto = $filename;
                    $model->photo = $studentPhoto;
                }
            }
            if ($model->save()){
                
                $this->redirect(array('view', 'id' => $model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
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
        
        if(isset($_POST['Student']))
		{
            $student = $_POST['Student'];
            $student['name'] = $student['last_name'].', '.$student['first_name'].' '.substr($student['middle_name'], 0,1).'.';

            $imageFileName = '';

            $model->attributes = $student;
            if($student['photo_source']=='upload'){
                $imageUploadFile = CUploadedFile::getInstance($model,'photo');
                if($imageUploadFile !== null){ // only do if file is really uploaded
                    $imageFileName = mktime().$imageUploadFile->name;
                    $model->photo = $imageFileName;
                    $imageUploadFile->saveAs('photo-upload/'.$imageFileName);
                }
            }else{
                if(!empty($student['photo2'])){
                    preg_match('#^data:[\w/]+(;[\w=]+)*,[\w+/=%]+$#', $data=$student['photo2']);
                    $filename = uniqid().".png";
                    copy($data, "photo-upload/".$filename);
                    $studentPhoto = $filename;
                    $model->photo = $studentPhoto;
                }
            }
            
            if ($model->save()){
                
                $this->redirect(array('view', 'id' => $model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Student');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
	 * Manages all models.
	 */
	public function actionStudents()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		$this->render('students',array(
			'model'=>$model,
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Student the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Student::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Student $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
