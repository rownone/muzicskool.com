<?php

/**
 * This is the model class for table "tbl_class_schedule".
 *
 * The followings are the available columns in table 'tbl_class_schedule':
 * @property string $id
 * @property string $datetime_created
 * @property string $enrollment_id
 * @property string $teacher_id
 * @property string $teacher_attended
 * @property string $teacher_replacement_id
 * @property double $teacher_salary
 * @property string $student_attended
 * @property string $studio_id
 * @property string $date_schedule
 * @property string $start_time
 * @property string $end_time
 * @property string $prepared_by_id
 * @property integer $status
 * @property string $notes
 */
class ClassSchedule extends CActiveRecord
{
    public $group_attended = '';
    public $band_attended = '';
    public $class_session = '';
    public $total_salary = '';
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_class_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enrollment_id, date_schedule, start_time, end_time, prepared_by_id', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('teacher_salary', 'numerical'),
			array('enrollment_id, teacher_id, teacher_schedule_id, teacher_replacement_id, studio_id, prepared_by_id', 'length', 'max'=>20),
			array('teacher_attended, student_attended', 'length', 'max'=>10),
            array('notes', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datetime_created, enrollment_id, teacher_id, teacher_attended, teacher_replacement_id, teacher_salary, student_attended, studio_id, date_schedule, start_time, end_time, prepared_by_id, status, notes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'studio' => array(self::BELONGS_TO, 'Studio', 'studio_id'),
            'teacher' => array(self::BELONGS_TO, 'Teacher', 'teacher_id'),
            'band' => array(self::BELONGS_TO, 'Band', 'band_id'),
            'enrollment' => array(self::BELONGS_TO, 'Enrollment', 'enrollment_id'),
            'teacher_replacement' => array(self::BELONGS_TO, 'Teacher', 'teacher_replacement_id'),
            'prepared_by' => array(self::BELONGS_TO, 'User', 'prepared_by_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'datetime_created' => 'Datetime Created',
			'enrollment_id' => 'Enrollment',
			'teacher_id' => 'Teacher',
			'teacher_attended' => 'Teacher Attended',
			'teacher_replacement_id' => 'Teacher Replacement',
			'teacher_salary' => 'Teacher Salary',
			'student_attended' => 'Student Attended',
			'studio_id' => 'Studio',
			'date_schedule' => 'Date Schedule',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'prepared_by_id' => 'Prepared By',
			'status' => 'Status',
			'notes' => 'Notes',
            'group_attended' => 'Group Attended',
            'band_attended' => 'Band Attended',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        
        $criteria->together = true;
        $criteria->with= array('studio','teacher','prepared_by','teacher_replacement');
        
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		//$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('teacher_attended',$this->teacher_attended,true);
		//$criteria->compare('teacher_replacement_id',$this->teacher_replacement_id,true);
		//$criteria->compare('teacher_salary',$this->teacher_salary);
		$criteria->compare('student_attended',$this->student_attended,true);
		//$criteria->compare('studio_id',$this->studio_id,true);
		$criteria->compare('date_schedule',$this->date_schedule,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		//$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('notes',$this->notes,true);
        
        $criteria->addSearchCondition('teacher.name',$this->teacher_id);
        $criteria->addSearchCondition('teacher_replacement.name',$this->teacher_replacement_id);
        $criteria->addSearchCondition('studio.name',$this->studio_id);
        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_schedule ASC, start_time ASC, end_time ASC',
            ),
            'pagination'=>array(
                'pageSize'=> 100,
            ),
		));
	}
    
    public function searchByTeacher()
	{
		$criteria=new CDbCriteria;
  		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('studio_id',$this->studio_id,true);
		$criteria->compare('date_schedule',$this->date_schedule,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
        $criteria->compare('status',$this->status,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_schedule ASC, start_time ASC, end_time ASC',
            ),
            'pagination'=>array(
                'pageSize'=> 100,
            ),
		));
	}
    
    public function searchByTeacherDateRange($date1,$date2)
	{
		$criteria=new CDbCriteria;
  		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('studio_id',$this->studio_id,true);
		$criteria->compare('date_schedule',$this->date_schedule,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
        $criteria->compare('status',$this->status,true);
        
        $criteria->addCondition("date_schedule between '$date1' and '$date2' ");
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_schedule ASC, start_time ASC, end_time ASC',
            ),
            'pagination'=>array(
                'pageSize'=> 100,
            ),
		));
	}
    
    public function searchDateRange($date1,$date2)
	{
		$criteria=new CDbCriteria;
        
        $criteria->together = true;
        $criteria->with= array('studio','teacher','prepared_by');
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		$criteria->compare('date_schedule',$this->date_schedule,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('status',$this->status);
        $criteria->addCondition("date_schedule between '$date1' and '$date2' ");
        $criteria->addSearchCondition('teacher.name',$this->teacher_id);
        $criteria->addSearchCondition('studio.name',$this->studio_id);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'start_time ASC, end_time ASC',
            ),
		));
	}
    
    public function searchTeacherSalaryDetails($date1,$date2)
	{
		$criteria=new CDbCriteria;
        
        $criteria->together = true;
        $criteria->with= array('studio','teacher','prepared_by','teacher_replacement');
        
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		
		$criteria->compare('teacher_attended',$this->teacher_attended,true);
		$criteria->compare('teacher_replacement_id',$this->teacher_replacement_id,true);
		$criteria->compare('teacher_salary',$this->teacher_salary);
		$criteria->compare('student_attended',$this->student_attended,true);
		$criteria->compare('studio_id',$this->studio_id,true);
		$criteria->compare('date_schedule',$this->date_schedule,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('notes',$this->notes,true);
        
        $criteria->addCondition("date_schedule between '$date1' and '$date2' ");
         
        $criteria->addSearchCondition('teacher.name',$this->teacher_id);
        $criteria->addSearchCondition('teacher_replacement.name',$this->teacher_replacement_id);
        $criteria->addSearchCondition('studio.name',$this->studio_id);
        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_schedule ASC, start_time ASC, end_time ASC',
            ),
		));
	}
    
    public function searchTeacherSalaryDetailsReport($date1,$date2)
	{
		$criteria=new CDbCriteria;
        
//        $criteria->together = true;
//        $criteria->with= array('studio','teacher','prepared_by','teacher_replacement');
        
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		
		$criteria->compare('teacher_attended',$this->teacher_attended,true);
		$criteria->compare('teacher_replacement_id',$this->teacher_replacement_id,true);
		$criteria->compare('teacher_salary',$this->teacher_salary);
		$criteria->compare('student_attended',$this->student_attended,true);
		$criteria->compare('studio_id',$this->studio_id,true);
		$criteria->compare('date_schedule',$this->date_schedule,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('notes',$this->notes,true);
        
        $criteria->addCondition("date_schedule between  '$date1' and '$date2' ");
         
//        $criteria->addSearchCondition('teacher.name',$this->teacher_id);
//        $criteria->addSearchCondition('teacher_replacement.name',$this->teacher_replacement_id);
//        $criteria->addSearchCondition('studio.name',$this->studio_id);
//        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_schedule ASC, start_time ASC, end_time ASC',
            ),
		));
	}
    
    public function searchTeacherSalary($date1,$date2)
	{
		$criteria=new CDbCriteria;
        $criteria->select = " enrollment_id, teacher_replacement_id, date_schedule, 
            count(teacher_replacement_id) as class_session, 
            sum(teacher_salary) as total_salary  ";
            //CAST(sum(teacher_salary) AS DECIMAL(10,2)) as total_salary  ";
        $criteria->together = true;
		$criteria->compare('id',$this->id,true);
        $criteria->compare('teacher_replacement_id',$this->teacher_replacement_id,true);
		$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
        $criteria->compare('status',$this->status);

        $criteria->addCondition("date_schedule between '$date1' and '$date2' ");
        
        $criteria->group = 'teacher_replacement_id';
		
        return new CActiveDataProvider($this, array(
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',
                        Yii::app()->params['defaultPageSize']),
            ),
			'criteria'=>$criteria,
            //'sort'=>array(
                //'defaultOrder'=>'payment_date DESC ',
                //'route'=>"/test/grid/"
           // ),
		));
	}
    
    public static function classSessionTotal($provider)
    {
        $total=0;
        foreach($provider->data as $item)
            $total+=$item->class_session;
        return $total;
    }
    
    public static function salaryTotal($provider)
    {
        $total=0;
        foreach($provider->data as $item)
            $total+= (!empty($item->total_salary))?$item->total_salary:0;
        return (float) $total;
    }
    
    public function getStatusFilter()
    {
        return array(
            array('id'=>1, 'val'=>'Done'),
            array('id'=>0, 'val'=>'Open'),
        );
    }
    
    public function getStatusValue($status)
    {
        if($status == 1) 
            return 'Done';
        else 
            return 'Open';
    }
    
    public function getEnrollmentRefName($data,$row)
    {
        if($data->enrollment->enrollment_type_id==Yii::app()->params['individual']){
            return CHtml::link(CHtml::encode(ucwords ($data->enrollment->ref_name)),array('/student/view','id'=>$data->enrollment->student_id));
        }elseif($data->enrollment->enrollment_type_id==Yii::app()->params['group']){
            return CHtml::link(CHtml::encode(ucwords ($data->enrollment->ref_name)),array('/group/view','id'=>$data->enrollment->group_id));
        }else{
            return CHtml::link(CHtml::encode(ucwords ($data->enrollment->ref_name)),array('/band/view','id'=>$data->enrollment->band_id));
        }        
    }
    
    public function getAttendanceSymbol($data,$row)
    {
        if(empty($data->status)){
            return '';
        }elseif(!empty($data->teacher_replacement_id) && !empty($data->student_attended)){
            return '&#10003;';
        }else{
            return 'x';
        }        
    }
    
    public function searchByEnrollmentId($enrollmentId)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('enrollment_id',$enrollmentId,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_schedule ASC, start_time ASC, end_time ASC',
            ),
		));
	}
    
    
    
    public function getCalendar($start, $end, $calendar='', $refId='')
    {       
        $data = array();
        $s = gmdate("Y-m-d", $start);
        $e = gmdate("Y-m-d", $end);
        $x=1;

        $classSchedule = ClassSchedule::model();
        $_criteria = new CDbCriteria();
        if(empty($refId)){
            
        }elseif ($calendar=='studio') {
            $_criteria->addCondition(" studio_id = $refId");
        }elseif ($calendar=='teacher') {
            $_criteria->addCondition(" teacher_id = $refId");
        }elseif ($calendar=='enrollment') {

            $_criteria->addCondition(" enrollment_id = $refId");
        }
        
        $_criteria->addCondition(" date_schedule between '$s' and '$e' ");
        $_criteria->addCondition(" status = 0 ");
        
        $items = $classSchedule->findAll($_criteria);

        foreach($items as $item){
            $x++;
            $startT = $item->start_time;
            $endT = $item->end_time;
            $val = date("g:i a", strtotime($startT)).' - '.date("g:i a", strtotime($endT));
            
            if($calendar=="studio"){
                if($item->enrollment->enrollment_type_id==Yii::app()->params['individual']){
                    $title = ucwords($item->enrollment->student->name).' '.$val;
                }elseif($item->enrollment->enrollment_type_id==Yii::app()->params['group']){
                    $title = ucwords($item->enrollment->group->name).' '.$val;
                }elseif($item->enrollment->enrollment_type_id==Yii::app()->params['band']){
                    $title = ucwords($item->enrollment->band->name).' '.$val;
                }
            }else{
               $title = ucwords($item->studio->name).' '.$val;
            }

            $url = Yii::app()->createUrl( 'classSchedule/view' ).'&id='.$item->id;
            $data[] = array(
                'id'=>$x,
                'title'=>$title,
                'start'=>$item->date_schedule.' '.$item->start_time,
                'end'=>$item->date_schedule.' '.$item->end_time,
                'className'=>'taken',
                'url'=>$url,
                'allDay'=>'false'
            );
        }
        
        return $data;
    }
    
    /*public function getStudioCalendar($studio_id)
    {
        $data = array();
       
        $x=1;
        
        $classSchedule = ClassSchedule::model();
        $_criteria = new CDbCriteria();
        $_criteria->addCondition('studio_id = ' . $studio_id);
        $items = $classSchedule ->findAll($_criteria);
     
        foreach($items as $item){
            $x++;
            $val = $item->start_time.' - '.$item->end_time;
           
            $data[] = array(
                'id'=>$x,
                'title'=>$val,
                'start'=>$item->date_schedule.' '.$item->start_time,
                'end'=>$item->date_schedule.' '.$item->end_time,
                'className'=>'taken',
                'url'=>''
            );
        }
        
        return $data;
    }*/
    
    public function beforeSave() 
    {
        $start_time =  date("H:i", strtotime($this->start_time)).':01'; //add 1 second        
        $this->start_time = date("H:i:s", strtotime($start_time));
        $this->end_time = date("H:i", strtotime($this->end_time));
        
        if(!$this->isNewRecord){
            $this->status = 1; //update/done
            if(!empty($this->teacher_attended)){
                $this->teacher_replacement_id = $this->teacher_id;
            }
            if($this->enrollment->enrollment_type_id == Yii::app()->params['individual'] ||
                    $this->enrollment->enrollment_type_id == Yii::app()->params['band']){
                
                $courseItems = CourseItems::model();
                $_criteria = new CDbCriteria();
                $_criteria->addCondition('teacher_id = ' . $this->teacher_id);
                $_criteria->addCondition('course_id = ' . $this->enrollment->course_id);
                $items = $courseItems ->find($_criteria);
                
                $start_time =  date("H:i", strtotime($this->start_time)).":00";     
                $end_time = date("H:i", strtotime($this->end_time)).":00";

                $start = strtotime($start_time);
                $end = strtotime($end_time);

                $diff = ($end - $start) / 3600;

                $this->teacher_salary = $diff * $items->rate;
            }
        }
        $this->prepared_by_id = Yii::app()->User->getId();
        return parent::beforeSave();
    }
    
    protected function afterSave()
    {        
        $this->enrollment->updateStatus();
        return true;
    }
}