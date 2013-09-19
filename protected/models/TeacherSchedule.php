<?php

/**
 * This is the model class for table "tbl_teacher_schedule".
 *
 * The followings are the available columns in table 'tbl_teacher_schedule':
 * @property string $id
 * @property string $teacher_id
 * @property string $day
 * @property string $time_from
 * @property string $time_to
 */
class TeacherSchedule extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TeacherSchedule the static model class
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
		return 'tbl_teacher_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_id, day, time_from, time_to', 'required'),
			array('teacher_id, day', 'length', 'max'=>20),
            array('day_num', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, teacher_id, day, time_from, time_to', 'safe', 'on'=>'search'),
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
            'teacher' => array(self::BELONGS_TO, 'Teacher', 'teacher_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'teacher_id' => 'Teacher',
			'day' => 'Day',
			'time_from' => 'Start Time',
			'time_to' => 'End Time',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('day',$this->day,true);
		$criteria->compare('time_from',$this->time_from,true);
		$criteria->compare('time_to',$this->time_to,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getTeacherCalendar($teacher_id, $start, $end)
    {   
        $data = array();
        $_criteria = new CDbCriteria();
        $_criteria->addCondition('teacher_id = ' . $teacher_id);
        $items = $this->findAll( $_criteria);
        
        $Mon = array();
        $Tue = array();
        $Wed = array();
        $Thu = array();
        $Fri = array();
        $Sat = array();
        $Sun = array();
        
        foreach($items as $item){
            $time_from = date("g:i a", strtotime($item->time_from));
            $time_to = date("g:i a", strtotime($item->time_to));
            $val = array('title'=> $time_from.' - '.$time_to,'time'=>$item->time_from.' - '.$item->time_to);
            if($item->day=="Mon"){
                $Mon[$item->id] = $val;
            }else if($item->day=="Tue"){
                $Tue[$item->id] = $val;
            }if($item->day=="Wed"){
                $Wed[$item->id] = $val;
            }if($item->day=="Thu"){
                $Thu[$item->id] = $val;
            }if($item->day=="Fri"){
                $Fri[$item->id] = $val;
            }if($item->day=="Sat"){
                $Sat[$item->id] = $val;
            }if($item->day=="Sun"){
                $Sun[$item->id] = $val;
            }            
        }
        
        $s = gmdate("Y-m-d", $start);
        $e = gmdate("Y-m-d", $end);

        $startTime = strtotime($s.' 12:00');
        $endTime = strtotime($e.' 12:00');
        
        $x=1;
        //$todays_date = date("Y-m-d");
        for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
          //$thisDate = date('D Y-m-d', $i); // 2010-05-01, 2010-05-02, etc
          //echo $thisDate."\n";
            $day = date('D', $i);
            $thisDate = date('Y-m-d', $i);
            if(date("Y-m-d")<=date('Y-m-d', $i)){
                $itemCount=0;
                
                if($day=="Mon"){
                    foreach($Mon as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                        
                        $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id); //check time start and time end by teacher_schedule_id
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                        $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }            
                }else if($day=="Tue"){
                     foreach($Tue as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                         $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id);
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                         $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }
                }if($day=="Wed"){
                    foreach($Wed as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                         $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id);
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                         $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }
                }if($day=="Thu"){
                    foreach($Thu as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                         $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id);
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                         $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }
                }if($day=="Fri"){
                    foreach($Fri as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                         $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id);
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                         $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }
                }if($day=="Sat"){
                    foreach($Sat as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                         $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id);
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                         $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }
                }if($day=="Sun"){
                    foreach($Sun as $timeSched=>$val){
                        $x++;
                        $teacher_schedule_id = ($timeSched);
                         $teacherSchedule = ClassSchedule::model();
                        $_criteria = new CDbCriteria();
                        $_criteria->addCondition('teacher_id = ' . $teacher_id);
                        $_criteria->addCondition('teacher_schedule_id = ' . $teacher_schedule_id);
                        $_criteria->addCondition("date_schedule = '$thisDate'" );
                        $_criteria->addCondition("status = 0 " );
                        $itemCount = count($teacherSchedule->findAll( $_criteria));
                        $css = $itemCount>0?"taken":"";
                         $t = explode(' - ', $val['time']);
                        $data[] = array(
                            'id'=>$x.'-'.$teacher_schedule_id,
                            'title'=>$val['title'],
                            'start'=>$thisDate.' '.$t[0],
                            'end'=>$thisDate.' '.$t[1],
                            'className'=>$css,
                            'taken'=>$itemCount,
                            'url'=>''
                        );
                    }
                }
            }
        }
        
        return $data;
    }
    
    public function searchByDay($day)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('day',$day,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function searchByTeacherId($teacher_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('teacher_id',$teacher_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'day_num ASC, time_from ASC, time_to ASC',
            ),
		));
	}
    
    public function beforeSave() 
    {
        if($this->day=='Mon'){
            $this->day_num = 1;
        }else if($this->day=='Tue'){
            $this->day_num = 2;
        }else if($this->day=='Wed'){
            $this->day_num = 3;
        }else if($this->day=='Thu'){
            $this->day_num = 4;
        }else if($this->day=='Fri'){
            $this->day_num = 5;
        }else if($this->day=='Sat'){
            $this->day_num = 6;
        }else if($this->day=='Sun'){
            $this->day_num = 7;
        }
        
        $time_from =  date("H:i", strtotime($this->time_from)).':01'; //add 1 second
        
        $this->time_from = date("H:i:s", strtotime($time_from));

        $this->time_to = date("H:i", strtotime($this->time_to));
        return parent::beforeSave();
    }
}