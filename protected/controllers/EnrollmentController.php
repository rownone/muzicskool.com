<?php

class EnrollmentController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'expression'=>'Yii::app()->User->isAdmin()',
                'users'=>array('@'),
			),
            array('allow',
				'actions'=>array(
                    'saveClassSchedule',
                    'saveClassSchedule2',
                    'searchStudent',
                    'searchBand',
                    'searchGroup',
                    'searchTeacher',
                    'searchStudio',
                    'classSchedule',
                    'getTeacherCalendar',
                    'teacherSchedule',
                    'searchTeacherSchedule',
                    'teacherCalendar',
                    'studioCalendar',
                    'individual',
                    'group',
                    'band',
                    'test','teacherCalendar2'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionSaveClassSchedule2()
    {
        $error = '';
        for($x=0;$x<(int)$_POST['c'];$x++){
           $schedule = new ClassSchedule;
           $schedule->enrollment_id = $_POST['enrollment_id'];
                    
           if($_POST['enrollment_type_id']!=Yii::app()->params['band']){
                $schedule->teacher_id = $_POST['teacher_id'];
                $schedule->teacher_schedule_id = $_POST['teacher_schedule_id'][$x];
           }
           $schedule->date_schedule = $_POST['date_schedule'][$x];
           $schedule->start_time = $_POST['start_time'][$x];
           $schedule->end_time = $_POST['end_time'][$x];
           $schedule->studio_id = $_POST['studio_id'][$x];
           $schedule->prepared_by_id = Yii::app()->User->getId();
           
           if (!$schedule->save(false))               
                $error .= CHtml::errorSummary($schedule);
                
        }
        if(empty($error)){
            echo(json_encode(array('result' => 'success', 'msg' => 'Schedule has been successfully saved')));
        }else{
            echo(json_encode(array('result' => 'error', 'msg' => $error)));
        }
    }
    
    public function actionSaveClassSchedule()
    {
        if (isset($_POST['ClassSchedule'])) {
           $data = $_POST['ClassSchedule'];
           
           $schedule = new ClassSchedule;
           
           $schedule->enrollment_id = $data['enrollment_id'];
                    
           if($data['enrollment_type_id']!=Yii::app()->params['band']){
                $schedule->teacher_id = $data['teacher_id'];
                $schedule->teacher_schedule_id = $data['teacher_schedule_id'];
           }
           $schedule->date_schedule = $data['date_schedule'];
           $schedule->start_time = $data['start_time'];
           $schedule->end_time = $data['end_time'];
           $schedule->studio_id = $data['studio_id'];
           $schedule->prepared_by_id = Yii::app()->User->getId();
           
           if (!$schedule->save(false))
                exit(json_encode(array('result' => 'error', 'msg' => CHtml::errorSummary($schedule))));
            else
                exit(json_encode(array('result' => 'success', 'msg' => 'Schedule has been successfully saved')));
       }
    }
    public function actionClassSchedule()
	{
        //$this->layout = 'main_blank';
        $timestamp = strtotime($_POST['d']);

        $day = date('D', $timestamp);
        var_dump($day);
        die();
        $model=new Enrollment;
		$this->renderPartial('classSchedule',array(
			'model'=>$model, 'teacher'=> Teacher::model()
		),false,true);
        
        //echo 'test';
	}
    
    public function actionTeacherSchedule()
	{
        //$day='Mon';
        if(isset($_REQUEST['d'])){
            $timestamp = strtotime($_REQUEST['d']);

            $day = date('D', $timestamp);
            
        }
       $teacherSchedule = TeacherSchedule::model();
        $this->renderPartial('teacher_schedule',array(
                'day'=>$day, 'teacherSchedule'=> $teacherSchedule
            ),false,true);
        //echo 'test';
	}
    
    public function actionTest($id)
	{
        $model = $this->loadModel($id);
        $courseItems = CourseItems::model();
        $courseItems->course_id = $model->course_id;
        
        $classSchedule=new ClassSchedule('search');
		$classSchedule->unsetAttributes();
        $classSchedule->enrollment_id = $id;
		$this->render('test',array(
			'model'=>$model,
            'teacher'=> $courseItems,
            'studio'=> Studio::model(),
            'classSchedule'=>$classSchedule
		));
	}
    
    public function actionTeacherCalendar2()
	{
        $teacherSchedule = TeacherSchedule::model();
        $this->renderPartial('teacher_calendar2',array('teacherSchedule'=> $teacherSchedule),false,true);
	}
    
    public function actionTeacherCalendar()
	{
        $teacherSchedule = TeacherSchedule::model();
        $this->renderPartial('teacher_calendar',array('teacherSchedule'=> $teacherSchedule),false,true);
	}
    
    public function actionGetTeacherCalendar()
    {
        $teacher_id = $_REQUEST['teacher_id'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        
        $teacherSchedule = TeacherSchedule::model();
        $schedules = $teacherSchedule->getTeacherCalendar($teacher_id, $start, $end);
        
        echo json_encode($schedules);
    }
    
    public function actionStudioCalendar()
	{
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $date_schedule = $_POST['date_schedule'];
        
        $start_time = date("H:i", strtotime($start_time)).':01';
        $end_time = date("H:i", strtotime($end_time)).':00';
                
        $studios = Studio::model()->findAll(array('order'=>'name ASC'));
        $data = array();
        foreach($studios as $studio){
            $teacherSchedule = ClassSchedule::model();
            $_criteria = new CDbCriteria();
            $_criteria->addCondition('studio_id = ' . $studio->id);
            $_criteria->addCondition("date_schedule = '$date_schedule'" );
            $_criteria->addCondition("status = 0 " );
            $_criteria->addCondition(" (start_time between '$start_time' and '$end_time') OR (end_time between '$start_time' and '$end_time' )"  );
            
            $itemCount = count($teacherSchedule->findAll( $_criteria));
            $className = $itemCount<1?"open":"close";
            //if($itemCount<1){
                $data[] = array(
                    'id'=>$studio->id,
                    'name'=>$studio->name,
                    'description'=>$studio->description,
                    'className'=>$className
                );
            //}
        }
        $this->renderPartial('studio_calendar',array('studios'=> $data),false,true);
	}
    
    public function actionGetStudioCalendar()
    {
        $teacher_id = $_REQUEST['teacher_id'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        
        $teacherSchedule = TeacherSchedule::model();
        $schedules = $teacherSchedule->getTeacherCalendar($teacher_id, $start, $end);
        
        echo json_encode($schedules);
    }
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
        $courseItems = CourseItems::model();
        $courseItems->course_id = $model->course_id;
        
        //$classSchedule = ClassSchedule::model();
        //$classSchedule->enrollment_id = $id;
        $classSchedule=new ClassSchedule('search');
		$classSchedule->unsetAttributes();  // clear any default values
        $classSchedule->enrollment_id = $id;
		$this->render('view',array(
			'model'=>$model,
            //'students'=>$this->loadStudentModel(),
            //'teacher'=> Teacher::model(),
            'teacher'=> $courseItems,
            'studio'=> Studio::model(),
            'classSchedule'=>$classSchedule
		));
	}

    public function actionIndividual()
	{
		$model=new Enrollment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enrollment']))
		{
			$model->attributes=$_POST['Enrollment'];
			if($model->save()){
                $this->redirect(array('view','id'=>$model->id));
            }
		}else{
            $model->enrollment_type_id = Yii::app()->params['individual'];
        }
        $_criteria = new CDbCriteria();
        $_criteria->addCondition('is_group_course = 0');

        $course = new Course;
        $course = $course->findAll( $_criteria);
        
		$this->render('enroll_individual',array(
			'model'=>$model,
            'course'=>$course,
            'students'=>$this->loadStudentModel(),'lockCourse'=>false
		));
	}
    
    public function actionGroup()
	{
		$model=new Enrollment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enrollment']))
		{
			$model->attributes=$_POST['Enrollment'];
			if($model->save()){
                $this->redirect(array('view','id'=>$model->id));
            }
		}else{
            $model->enrollment_type_id = Yii::app()->params['group'];
        }
        
        $_criteria = new CDbCriteria();
        $_criteria->addCondition('is_group_course = 1');

        $course = new Course;
        $course = $course->findAll( $_criteria);
        
		$this->render('enroll_group',array(
			'model'=>$model,
            'course'=>$course,
            'groups'=>$this->loadGroupModel(),'lockCourse'=>false
		));
	}
    
     public function actionBand()
	{
		$model=new Enrollment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enrollment']))
		{
			$model->attributes=$_POST['Enrollment'];
			if($model->save()){
                $this->redirect(array('view','id'=>$model->id));
            }
		}else{
            $model->enrollment_type_id = 3;
        }
        
		$this->render('enroll_band',array(
			'model'=>$model,
            'bands'=>$this->loadBandModel(),
		));
	}
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Enrollment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enrollment']))
		{
			$model->attributes=$_POST['Enrollment'];
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->id));
                //exit(json_encode(array('result' => 'success', 'msg' => 'success')));
                $this->renderPartial('classSchedule',array('model'=>$model,'classSchedule'=>ClassSchedule::model()));
                exit();
            }else{
                exit(json_encode(array('result' => 'error', 'msg' => 'Opps error on saving data.')));
            }
		}else{
            $model->enrollment_type_id = 1;
        }
        
		$this->render('create',array(
			'model'=>$model,
            'students'=>$this->loadStudentModel(),
            'bands'=>$this->loadBandModel(),
            'groups'=>$this->loadGroupModel(),
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

		if(isset($_POST['Enrollment']))
		{
			$model->attributes=$_POST['Enrollment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        
        if($model->enrollment_type_id==Yii::app()->params['individual']){
            $_criteria = new CDbCriteria();
            $_criteria->addCondition('is_group_course = 0');

            $course = new Course;
            $course = $course->findAll( $_criteria);
            $dontEditCourse = false;
            if(count($model->class_schedule)>0){
                $dontEditCourse = true;
            }
            $this->render('enroll_individual',array(
                'model'=>$model,'students'=>$this->loadStudentModel(),'course'=>$course,'lockCourse'=>$dontEditCourse
            ));
        }else if($model->enrollment_type_id==Yii::app()->params['group']){
            $_criteria = new CDbCriteria();
            $_criteria->addCondition('is_group_course = 1');

            $course = new Course;
            $course = $course->findAll( $_criteria);
            $dontEditCourse = false;
            if(count($model->class_schedule)>0){
                $dontEditCourse = true;
            }
            $this->render('enroll_group',array(
                'model'=>$model,'groups'=>$this->loadGroupModel(),'course'=>$course,'lockCourse'=>$dontEditCourse
            ));
        }else if($model->enrollment_type_id==Yii::app()->params['band']){
            $this->render('enroll_band',array(
                'model'=>$model,'bands'=>$this->loadBandModel(),
            ));
        }
		
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
		$dataProvider=new CActiveDataProvider('Enrollment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Enrollment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Enrollment']))
			$model->attributes=$_GET['Enrollment'];
        else $model->status=2;
		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    /*protected function colRefName($data,$row)
    {
        if($data->enrollment_type_id==Yii::app()->params['individual']){
            return CHtml::link(CHtml::encode(ucwords ($data->ref_name)),array('/student/view','id'=>$data->student_id));
        }elseif($data->enrollment_type_id==Yii::app()->params['group']){
            return CHtml::link(CHtml::encode(ucwords ($data->ref_name)),array('/group/view','id'=>$data->group_id));
        }else{
            return CHtml::link(CHtml::encode(ucwords ($data->ref_name)),array('/band/view','id'=>$data->band_id));
        }        
    }*/
    /**
	 * Manages all models.
	 */
    
    public function actionSearchTeacher()
	{
		$model=new Teacher('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Teacher']))
			$model->attributes=$_GET['Teacher'];

        $this->render('_browse_teacher',array(
			'teacher'=>$model,
		));
	}
    
    public function actionSearchTeacherSchedule()
	{
         if(isset($_REQUEST['day'])){
            $timestamp = strtotime($_REQUEST['day']);

            $day = date('D', $timestamp);
            
        }
		$model=new TeacherSchedule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TeacherSchedule']))
			$model->attributes=$_GET['TeacherSchedule'];

        $this->render('teacher_schedule',array(
			 'day'=>$day, 'teacherSchedule'=>$model,
		));
	}
    
    public function actionSearchStudio()
	{
		$model=new Studio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Studio']))
			$model->attributes=$_GET['Studio'];

        $this->render('_browse_studio',array(
			'studio'=>$model,
		));
	}
    
	public function actionSearchStudent()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

		//$this->render('search_student',array(
        $this->render('_browse_student',array(
			'students'=>$model,
		));
	}
    
    public function actionSearchBand()
	{
		$model=new Band('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Band']))
			$model->attributes=$_GET['Band'];

		//$this->render('search_student',array(
        $this->render('_browse_band',array(
			'bands'=>$model,
		));
	}
    
    public function actionSearchGroup()
	{
		$model=new Group('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Group']))
			$model->attributes=$_GET['Group'];

		//$this->render('search_student',array(
        $this->render('_browse_group',array(
			'groups'=>$model,
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Enrollment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Enrollment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function loadStudentModel()
	{
		$model= Student::model();
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function loadBandModel()
	{
		$model= Band::model();
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function loadGroupModel()
	{
		$model= Group::model();
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Enrollment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='enrollment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
