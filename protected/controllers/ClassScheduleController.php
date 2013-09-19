<?php

class ClassScheduleController extends Controller
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
            array('allow',
				'actions'=>array('calendar'),
				'users'=>array('@'),
			),
            array('allow',
				'actions'=>array('studioCalendar',
                    'getStudioCalendar','getCalendar'),
				'users'=>array('@'),
			),*/
            array('allow',
				'actions'=>array(
                    'delete','goDelete',
                    'studioCalendar',
                    'getStudioCalendar',
                    'getCalendar',
                    'index','view',
                    'create','update',
                    'admin',
                    'calendar','daily',
                    'daily2','daily3','dailySchedule',
                    'dailySchedule2','dailySchedule3',
                    'daily4','dailySchedule4','dailyBand','dailyBandSchedule'
                ),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
    public function actionGetCalendar()
	{
        $model=new ClassSchedule;

        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        if(isset($_REQUEST['studio_id'])){
            echo json_encode($model->getCalendar($start,$end,'studio',$_REQUEST['studio_id']));
        }elseif(isset($_REQUEST['teacher_id'])){
            echo json_encode($model->getCalendar($start,$end,'teacher',$_REQUEST['teacher_id']));
        }elseif(isset($_REQUEST['enrollment_id'])){
            echo json_encode($model->getCalendar($start,$end,'enrollment',$_REQUEST['enrollment_id']));
        }else{
            echo json_encode($model->getCalendar($start,$end));
        }
		
	}
    
    public function actionCalendar()
	{
        $this->layout = 'column1';
        if(isset($_REQUEST['studio_id'])){
            $model = Studio::model()->findByPk($_REQUEST['studio_id']);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }elseif (isset($_REQUEST['teacher_id'])) {
           $model = Teacher::model()->findByPk($_REQUEST['teacher_id']);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }elseif (isset($_REQUEST['enrollment_id'])) {
           $model = Enrollment::model()->findByPk($_REQUEST['enrollment_id']);
           
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }else{
            $model = ClassSchedule::model();
        }
        $this->render('calendar',array(
			'model'=>$model,
		));
	}
    
    public function actionDailyBand()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        $studios = isset($_POST['studios'])?$_POST['studios']:array();
        $this->render('daily_band',array(
			'model'=>$model,'date1'=>$date1,
            'studio'=>Studio::model()->findAll(array('order'=>'name ASC')),
            'chkStudios'=>$studios,
		));
    }
    
    public function actionDailyBandSchedule()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        $studios = isset($_POST['studios'])?$_POST['studios']:array();
        $this->render('daily_band_schedule',array(
			'model'=>$model,'date1'=>$date1,
            'studio'=>Studio::model()->findAll(array('order'=>'name ASC')),
            'chkStudios'=>$studios,
		));
    }
    
    public function actionDaily4()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        $studios = isset($_POST['studios'])?$_POST['studios']:array();
        $this->render('daily4',array(
			'model'=>$model,'date1'=>$date1,
            'studio'=>Studio::model()->findAll(array('order'=>'name ASC')),
            'chkStudios'=>$studios,
		));
    }
    
    public function actionDailySchedule4()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        $studios = isset($_POST['studios'])?$_POST['studios']:array();
        $this->render('daily_schedule4',array(
			'model'=>$model,'date1'=>$date1,
            'studio'=>Studio::model()->findAll(array('order'=>'name ASC')),
            'chkStudios'=>$studios,
		));
    }
    
    
    public function actionDaily()
	{
        $this->layout = 'column1';
        $model=new ClassSchedule('search');
		$model->unsetAttributes();  // clear any default values
        $date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']: date('Y-m-d');
        
        $this->render('daily',array(
			'model'=>$model,'date1'=>$date1
		));
    }
    
    public function actionDailySchedule()
	{
        $this->layout = 'column1';
        $model=new ClassSchedule('search');
		$model->unsetAttributes();  // clear any default values
        $date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']: date('Y-m-d');
        
        $this->render('daily_schedule',array(
			'model'=>$model,'date1'=>$date1
		));
    }
    
    
    public function actionDaily2()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        
        $this->render('daily2',array(
			'model'=>$model,'date1'=>$date1
		));
    }
    
    public function actionDaily3()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        $studios = isset($_POST['studios'])?$_POST['studios']:array();
        $this->render('daily3',array(
			'model'=>$model,'date1'=>$date1,
            'studio'=>Studio::model()->findAll(array('order'=>'name ASC')),
            'chkStudios'=>$studios,
		));
    }
    
    public function actionDailySchedule2()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        
        $this->render('daily_schedule2',array(
			'model'=>$model,'date1'=>$date1
		));
    }
    
    public function actionDailySchedule3()
	{
        $this->layout = 'column1';
        $date1 = isset($_POST['date1'])?$_POST['date1']: date('Y-m-d');
        $_criteria = new CDbCriteria();
        $_criteria->addCondition("date_schedule between '$date1' and '$date1' ");
        $_criteria->order = "start_time ASC, studio_id ASC";
        $classSchedule = new ClassSchedule();
        $model = $classSchedule->findAll($_criteria);
        $studios = isset($_POST['studios'])?$_POST['studios']:array();
        $this->render('daily_schedule3',array(
			'model'=>$model,'date1'=>$date1,
            'studio'=>Studio::model()->findAll(array('order'=>'name ASC')),
            'chkStudios'=>$studios,
		));
    }
    
    
    
    /*public function actionGetStudioCalendar()
	{
        $model=new ClassSchedule;
        $studio_id = $_REQUEST['studio_id'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        
		echo json_encode($model->getStudioCalendar($studio_id));
	}
    
    public function actionStudioCalendar()
	{
        $studio_id = $_REQUEST['studio_id'];

        $model = Studio::model()->findByPk($studio_id);
        if(count($model)>0){
            $this->render('studio_calendar',array(
                'studio'=>$model
            ));
        }
	}*/
    
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

   
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ClassSchedule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassSchedule']))
		{
			$model->attributes=$_POST['ClassSchedule'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['ClassSchedule']))
		{
			$model->attributes=$_POST['ClassSchedule'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        $courseItems = CourseItems::model();
        $courseItems->course_id = $model->enrollment->course_id;
		$this->render('update',array(
			'model'=>$model,'teacher'=> $courseItems,
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
        $enrollment->updateStatus();
        
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
   
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ClassSchedule');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ClassSchedule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ClassSchedule']))
			$model->attributes=$_GET['ClassSchedule'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ClassSchedule the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ClassSchedule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ClassSchedule $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='class-schedule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
