<?php

class TestController extends Controller
{
    public function actionGrid()
    {   
        $date1 = isset($_REQUEST['date1'])?$_REQUEST['date1']:'';
        $date2 = isset($_REQUEST['date2'])?$_REQUEST['date2']:'';
        $date_range = isset($_REQUEST['date_range'])?$_REQUEST['date_range']:'';
        $today = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));
        $last7days = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 7, date("Y")));
        $yesterday = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
        $thisMonth = date("Y-m-d", mktime(0, 0, 0, date("m") , 01, date("Y")));

        $date_options = isset($_REQUEST['date_options'])?$_REQUEST['date_options']:'';

        //if(empty($date1) && empty($date1)) {
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
        $this->render('grid', array('model'=>$model,
            'date_options'=>$date_options,'date1'=>$date1,
            'date2'=>$date2,'date_range'=>$date_range));
    }
    
	public function actionIndex()
	{
        $points = array();
        $points[] = array(
            "id"=>1,
            "time"=>'05:30:00',
            "enrollment_type_id"=>'',
            "ref_name"=>'',
        );
        $points[] = array(
            "id"=>2,
            "time"=>'09:30:00',
            "enrollment_type_id"=>'',
            "ref_name"=>'',
        );
        $points[] = array(
            "id"=>3,
            "time"=>'13:30:00',
            "enrollment_type_id"=>'',
            "ref_name"=>'',
        );
        $points[] = array(
            "id"=>4,
            "time"=>'02:30:00',
            "enrollment_type_id"=>'',
            "ref_name"=>'',
        );
        $points[] = array(
            "id"=>5,
            "time"=>'02:31:00',
            "enrollment_type_id"=>'',
            "ref_name"=>'',
        );
       
        foreach ($points as $key => $val) {
            $time[$key] = $val['time'];
        }
var_dump($time);die();
        array_multisort($time, SORT_ASC, $points);
        
        var_dump($points);
        die();
        $data = array(
            1 => array ('Name', 'Surname'),
                array('Schwarz', 'Oliver'),
                array('Test', 'Peter')
        );
        Yii::import('application.extensions.phpexcel.JPhpExcel');
        $xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
        $xls->addArray($data);
        $xls->generateXML('my-test');

        die();
        var_dump(Yii::app()->User->isAdmin());
        var_dump(Yii::app()->User->getId());
        die();
        $courseItems= CourseItems::model()->findAll(array(
            'condition'=>'course_id=:course_id',
            'params'=>array(':course_id'=>1),
        ));
        foreach($courseItems as $item){
                echo $item->course->name . " has " . count($item->course->teacher) . " teachers. They are:<br />";
                foreach($item->course->teacher as $teacher){
                        echo $teacher->name . "<br />";
                }
                echo "<br />";
        }
        die();
		//$this->render('index');
        //$post=Post::model()->findByPk(10);
        $tFrom ="09:00:00";
        $tTo ="10:00:00";
        
        $newFrom = "09:00";
        $newTo = "10:00";
        if (strtotime($newFrom) >= strtotime($tFrom) && strtotime($newFrom) <= strtotime($tTo)   ) {
            echo "conflict start time  $newFrom between $tFrom and $tTo";
        }else if (strtotime($newTo) >= strtotime($tFrom) && strtotime($newTo) <= strtotime($tTo)   ) {
            echo "conflict end time $newTo between $tFrom and $tTo";
        }else{
            echo 'free';
        }
        die();
        $groups= GroupItems::model()->findAll(array(
            'condition'=>'group_id=:group_id',
            'params'=>array(':group_id'=>2),
        ));
        foreach($groups as $group){
                echo $group->group->name . " has " . count($group->group->student) . " students. They are:<br />";
                foreach($group->group->student as $student){
                        echo $student->name . "<br />";
                }
                echo "<br />";
        }
        die();
        
        $str = '123';
        echo substr("abcdef", 0,1);
        die();
        $student = Student::model()->findByPk(1);
        echo 'name: '.$student->first_name.' '.$student->last_name;
        echo '<br>';
        echo 'group: '.(empty($student->group_id)?"": $student->group->name);
        echo '<br>';
        echo 'groupid: '.$student->group_id;
        $student->group_id=3;
        $student->save();
	}
    
    public function actionPhoto()
    {
        $this->render('photo');
    }
    
    public function actionUploadPhoto()
    {
        $model=new Test;
        if(isset($_POST['Test']))
        {
            $model->attributes=$_POST['Test'];
            //var_dump(CUploadedFile::getInstance($model,'photo'));
            $imageUploadFile = CUploadedFile::getInstance($model,'photo');
            if($imageUploadFile !== null){ // only do if file is really uploaded
                $imageFileName = mktime().$imageUploadFile->name;
                $model->photo = $imageFileName;
            }     
            //$filename = $imageUploadFile->name;
            
            //$model->photo=$filename;
            if($model->save()){
                if($imageUploadFile !== null) // validate to save file
                    $imageUploadFile->saveAs('photo-upload/'.$imageFileName);
//                /($model->photo->saveAs("up/".$filename));
                //$imageUploadFile->saveAs("up/".$filename);
                /// redirect to success page
            }
        }
        $this->render('upload-photo', array('model'=>$model));
    }
    
    public function actionShowMany()
    {
        $items = GroupItems::model()->findAll();
        $this->render('index',array(
			'items'=>$items,
		));
        
    }
    
    public function actionTestManyToMany()
    {
            $groups = Group::model()->findAll();
            $students = Student::model()->findAll();

            foreach($groups as $group){
                    echo $group->name . " has " . count($group->student) . " students. They are:<br />";
                    foreach($group->student as $student){
                            echo $student->name . "<br />";
                    }
                    echo "<br />";
            }

            echo "<hr />";

            foreach($students as $student)
            {
                    echo $student->name . " is associated with " . count($student->group) . " groups. They are:<br />";
                    foreach($student->group as $group)
                    {
                            echo $group->name . "<br />";
                    }
                    echo "<br />";
            }
    }
    
    public function actionCamera()
    {
        $this->render('index');
    }


    // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}