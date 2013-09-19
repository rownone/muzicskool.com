<?php

class TeacherController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'admin',),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('update', 'delete'),
                'expression'=>'Yii::app()->User->isAdmin()',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('saveSchedule','salary','salaryDetails','summary'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSummary()
    {
        $this->layout = 'column1';
        
        $date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']:'';
        $date2 = isset($_REQUEST['date2'])?$_REQUEST['date2']:'';
        
        $classSchedule = new ClassSchedule('search');
        $classSchedule->unsetAttributes();
        $classSchedule->teacher_id = isset($_REQUEST['teacher_id'])?$_REQUEST['teacher_id']:-1;
        $classSchedule->status = Yii::app()->params['open'];
        
        $teacher = new Teacher('search');
        $teacher->unsetAttributes();
        $this->render('summary',array(
            'classSchedule'=> $classSchedule,
            'teacher'=> $teacher,'date1'=>$date1,
            'date2'=>$date2
        ));
    }
    
    public function actionSalary()
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
        if(empty($date1)&&empty($date2)&&empty($date_options)) $date_options = 'current_month';
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
        $model = new ClassSchedule('search');
        $model->unsetAttributes();  // clear any default values
        $model->status = 1;
        
        $teacher = new Teacher('search');
        $teacher->unsetAttributes();
        //$model = Payment::model();
        $this->render('salary', array('model'=>$model,'teacher'=> $teacher,
            'date_options'=>$date_options,'date1'=>$date1,
            'date2'=>$date2,'date_range'=>$date_range));
    }
    
    public function actionSalaryDetails()
    {
        $this->layout = '//layouts/column1';
        if(isset($_POST['date1'])){
            $date1 = isset($_POST['date1'])?$_POST['date1']:'';
            $date2 = isset($_POST['date2'])?$_POST['date2']:'';
        }else{
            $date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']:'';
            $date2 = isset($_REQUEST['date2'])?$_REQUEST['date2']:'';
        }
        $date_range = isset($_REQUEST['date_range'])?$_REQUEST['date_range']:'';
        $today = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));
        $last7days = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 7, date("Y")));
        $yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
        $thisMonth = date("Y-m-d", mktime(0, 0, 0, date("m") , 01, date("Y")));
        
        $date_options = isset($_REQUEST['date_options'])?$_REQUEST['date_options']:'';
        if(empty($date1)&&empty($date2)&&empty($date_options)) $date_options = 'current_month';
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
        
        $teacher_id = isset($_REQUEST['teacher_id'])?$_REQUEST['teacher_id']:'';
        if(empty($teacher_id)){
            throw new CHttpException(404, 'The requested page does not exist.');
            die();
        }
        $model = new ClassSchedule('search');
        $model->unsetAttributes();  // clear any default values
        $model->teacher_replacement_id = $teacher_id;
        $model->status = 1;

        $this->render('salary_details', array('model'=>$model,
            'date_options'=>$date_options,'date1'=>$date1,
            'date2'=>$date2,'date_range'=>$date_range));
    }
    
    /*public function actionSalaryDetails()
    {
        $this->layout = 'column1';
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $teacher_id = isset($_REQUEST['teacher_id'])?$_REQUEST['teacher_id']:'';
        $date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']:'';
        $date2 = isset($_REQUEST['date2'])?$_REQUEST['date2']:'';

        if(empty($date1)||empty($date2)||empty($teacher_id)){
            throw new CHttpException(404, 'The requested page does not exist.');
            die();
        }
        $model = new ClassSchedule('search');
        $model->unsetAttributes();  // clear any default values
        $model->teacher_replacement_id = $teacher_id;
        $model->status = 1;
        $this->render('salary_details', array('model'=>$model,
            'date1'=>$date1,
            'date2'=>$date2,));
    }*/
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),'schedule'=>$this->loadScheduleModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Teacher;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset($_POST['Teacher'])) {
            $teacher = $_POST['Teacher'];
            $teacher['name'] = $teacher['last_name'].', '.$teacher['first_name'].' '.substr($teacher['middle_name'], 0,1).'.';
            
            $imageFileName = '';
            
            $model->attributes = $teacher;
            if($teacher['photo_source']=='upload'){
                $imageUploadFile = CUploadedFile::getInstance($model,'photo');
                if($imageUploadFile !== null){ // only do if file is really uploaded
                    $imageFileName = mktime().$imageUploadFile->name;
                    $model->photo = $imageFileName;
                    $imageUploadFile->saveAs('photo-upload/'.$imageFileName);
                }
            }else{
                if(!empty($teacher['photo2'])){
                    preg_match('#^data:[\w/]+(;[\w=]+)*,[\w+/=%]+$#', $data=$teacher['photo2']);
                    $filename = uniqid().".png";
                    copy($data, "photo-upload/".$filename);
                    $teacherPhoto = $filename;
                    $model->photo = $teacherPhoto;
                }
            }
            if ($model->save()){
               
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionSaveSchedule()
    {
        if (isset($_POST['TeacherSchedule'])) {
            $teacherSchedule = $_POST['TeacherSchedule'];
            $schedule = new TeacherSchedule;
            
            $_criteria = new CDbCriteria();
            $_criteria->addCondition('teacher_id = ' . $teacherSchedule['teacher_id']);

            $items = $schedule->findAll( $_criteria);

            foreach($items as $item){
               // echo 'x';
                if($item->day==$teacherSchedule['day']){
                    
                    $tFrom = $item->time_from;
                    $tTo = $item->time_to;
                    
                    $newFrom1 = $teacherSchedule['time_from'];
                    $newTo1 = $teacherSchedule['time_to'];
                    $erroMsg = '';
                    
                    $newFrom =  date("H:i", strtotime($newFrom1)).':01'; //add 1 second
                    $newTo =  date("H:i:s", strtotime($newTo1)); //add 1 second
                    
                    $tFromDisplay = date("g:i a", strtotime($tFrom));
                    $tToDisplay = date("g:i a", strtotime($tTo));                    
                    $newFromDisplay = date("g:i a", strtotime($newFrom));
                    $newToDisplay = date("g:i a", strtotime($newTo));
                    
                    if (strtotime($newFrom) >= strtotime($tFrom) && strtotime($newFrom) <= strtotime($tTo)   ) {
                        $erroMsg = "Conflict schedule ".$teacherSchedule['day']." Start Time $newFromDisplay between $tFromDisplay and $tToDisplay ";
                    }else if (strtotime($newTo) >= strtotime($tFrom) && strtotime($newTo) <= strtotime($tTo)   ) {
                        $erroMsg = "Conflict schedule ".$teacherSchedule['day']." End time $newToDisplay between $tFromDisplay and $tToDisplay ";
                    }
                    
                    if(!empty($erroMsg)){
                        exit(json_encode(array('result' => 'error', 'msg' => '
                            <div class="errorSummary"><p>Please fix the following input errors:</p>
                            <ul><li>'.$erroMsg.'</li></ul></div>
                            ')));
                    }
                }
            }
        
            $schedule->unsetAttributes();
            $schedule->attributes=$teacherSchedule;
            
            if (!$schedule->save())
                exit(json_encode(array('result' => 'error', 'msg' => CHtml::errorSummary($schedule))));
            else
                exit(json_encode(array('result' => 'success', 'msg' => 'Schedule has been successfully saved')));            
        }
        //$this->redirect(Yii::app()->createUrl('teacher/view&id='.$teacherSchedule['teacher_id'] ));
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Teacher'])) {
            $teacher = $_POST['Teacher'];
            $teacher['name'] = $teacher['last_name'].', '.$teacher['first_name'].' '.substr($teacher['middle_name'], 0,1).'.';
            $model->attributes = $teacher;
            
            $imageFileName = '';
            
            if($teacher['photo_source']=='upload'){
                $imageUploadFile = CUploadedFile::getInstance($model,'photo');
                if($imageUploadFile !== null){ // only do if file is really uploaded
                    $imageFileName = mktime().$imageUploadFile->name;
                    $model->photo = $imageFileName;
                    $imageUploadFile->saveAs('photo-upload/'.$imageFileName);
                }
            }else{
                if(!empty($teacher['photo2'])){
                    preg_match('#^data:[\w/]+(;[\w=]+)*,[\w+/=%]+$#', $data=$teacher['photo2']);
                    $filename = uniqid().".png";
                    copy($data, "photo-upload/".$filename);
                    $teacherPhoto = $filename;
                    $model->photo = $teacherPhoto;
                }
            }
            if ($model->save()){
                
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        
        
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Teacher');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Teacher('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Teacher']))
            $model->attributes = $_GET['Teacher'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Teacher the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Teacher::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadScheduleModel($id='') {
        if(!empty($id)){
            $model = TeacherSchedule::model()->findByPk($id);
        }else{
            $model = TeacherSchedule::model();
        }
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    
    /**
     * Performs the AJAX validation.
     * @param Teacher $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacher-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
