<?php

/**
 * This is the model class for table "tbl_enrollment".
 *
 * The followings are the available columns in table 'tbl_enrollment':
 * @property string $id
 * @property string $datetime_created
 * @property double $fee
 * @property string $course_id
 * @property string $student_id
 * @property string $group_id
 * @property string $band_id
 * @property string $enrollment_type_id
 * @property string $ref_name
 * @property string $ref_id
 * @property string $prepared_by_id
 * @property string $notes
 * @property string $status
 * @property string $payment_status
 */
class Enrollment extends CActiveRecord
{
    //public $course_name;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Enrollment the static model class
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
		return 'tbl_enrollment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fee, enrollment_type_id, ref_name', 'required'),
            array('notes', 'length', 'max'=>1000),
			array('fee, total_payment', 'numerical'),
			array('course_id, ref_id, prepared_by_id, student_id, group_id, band_id', 'length', 'max'=>20),
            array('status, payment_status', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, prepared_by_id,datetime_created, ref_name, fee, course_id, student_id, group_id, band_id, notes', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'student' => array(self::BELONGS_TO, 'Student', 'student_id'),
            'band' => array(self::BELONGS_TO, 'Band', 'band_id'),
            'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
            'enrollment_type' => array(self::BELONGS_TO, 'EnrollmentType', 'enrollment_type_id'),
            'prepared_by' => array(self::BELONGS_TO, 'User', 'prepared_by_id'),
            'class_schedule' => array(self::HAS_MANY, 'ClassSchedule', 'enrollment_id'),
            'payment' => array(self::HAS_MANY, 'Payment', 'enrollment_id'),
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
			'fee' => 'Fee',
			'course_id' => 'Course',
            //'course_name' => 'Course',
			'student_id' => 'Student',
			'group_id' => 'Group',
			'band_id' => 'Band',
            'enrollment_type_id' => 'Enrollment Type',
            'ref_name' => 'Name',
            'prepared_by_id'=> 'Prepared By',
			'notes' => 'Notes',
            'status' => 'Status',
            'payment_status' => 'Payment Status',
            'total_payment' => 'Total Payment',
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
        $criteria->with= array('course','enrollment_type','prepared_by');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('fee',$this->fee);
		//$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('band_id',$this->band_id,true);
        
        //$criteria->compare('enrollment_type_id',$this->enrollment_type_id,true);
        
        $criteria->compare('ref_name',$this->ref_name,true);
        $criteria->compare('ref_id',$this->ref_id,true);
        //$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		$criteria->compare('notes',$this->notes,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('payment_status',$this->payment_status,true);
        
        $criteria->addSearchCondition('course.name',$this->course_id);
        $criteria->addSearchCondition('enrollment_type.name',$this->enrollment_type_id);
        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'ref_name ASC, datetime_created DESC',
            ),
		));
	}
    
    public function searchStudent()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        //$criteria->together = true;
        //$criteria->with= array('prepared_by');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('fee',$this->fee);
		//$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('band_id',$this->band_id,true);
        
        $criteria->compare('enrollment_type_id',$this->enrollment_type_id,true);
        
        $criteria->compare('ref_name',$this->ref_name,true);
        $criteria->compare('ref_id',$this->ref_id,true);
        //$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		$criteria->compare('notes',$this->notes,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('payment_status',$this->payment_status,true);
        //$criteria->group = 'student_id';
        $criteria->addSearchCondition('course.name',$this->course_id);
        //$criteria->addSearchCondition('enrollment_type.name',$this->enrollment_type_id);
        //$criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'ref_name ASC',
            ),
            
            
		));
	}
    
    public function searchNotFullyPaid($groupBy='')
	{
		$criteria=new CDbCriteria;
        $criteria->together = true;
        $criteria->with= array('course','enrollment_type','prepared_by');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('fee',$this->fee);
		//$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('band_id',$this->band_id,true);
        //$criteria->compare('enrollment_type_id',$this->enrollment_type_id,true);
        $criteria->compare('ref_name',$this->ref_name,true);
        $criteria->compare('ref_id',$this->ref_id,true);
        //$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		$criteria->compare('notes',$this->notes,true);
        //$criteria->compare('status',$this->status,true);
        $criteria->compare('payment_status',$this->payment_status,true);
        
        $criteria->addCondition('payment_status <> 1 ');
        if(!empty($groupBy)){
            $criteria->group = $groupBy;
        }
        $criteria->addSearchCondition('course.name',$this->course_id);
        $criteria->addSearchCondition('enrollment_type.name',$this->enrollment_type_id);
        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'sort'=>array(
                'defaultOrder'=>'ref_name ASC',
            ),
		));
	}
    
    public function getStatusFilter()
    {
        return array(
            array('id'=>1, 'val'=>'Complete'),
            array('id'=>2, 'val'=>'On-going'),
            array('id'=>0, 'val'=>'For-Schedule'),
        );
    }
    
    public function getStatusValue($status)
    {
        if($status == 1) 
            return 'Complete';
        elseif($status == 2) 
            return 'On-going';
        else
            return 'For-Schedule';
    }
    
    public function getPaymentStatusFilter()
    {
        return array(            
            array('id'=>0, 'val'=>'Un-Paid'),
            array('id'=>1, 'val'=>'Fully-Paid'),
            array('id'=>2, 'val'=>'With-Balance'),
        );
    }
    
    public function getPaymentStatusValue($status)
    {
        if($status == 1) 
            return 'Fully-Paid';
        elseif($status==2)
            return 'With-Balance';
        else
            return 'Un-Paid';
    }
    
    public function getRefName($data,$row)
    {
        if($data->enrollment_type_id==Yii::app()->params['individual']){
            return CHtml::link(CHtml::encode(ucwords ($data->ref_name)),array('/student/view','id'=>$data->student_id));
        }elseif($data->enrollment_type_id==Yii::app()->params['group']){
            return CHtml::link(CHtml::encode(ucwords ($data->ref_name)),array('/group/view','id'=>$data->group_id));
        }else{
            return CHtml::link(CHtml::encode(ucwords ($data->ref_name)),array('/band/view','id'=>$data->band_id));
        }        
    }
    
    public function getSearchRefName($data,$row)
    {
        if($data->enrollment_type_id==Yii::app()->params['individual']){
            return ucwords ($data->ref_name);
        }elseif($data->enrollment_type_id==Yii::app()->params['group']){
            return ucwords ($data->ref_name);
        }else{
            return ucwords ($data->ref_name);
        }        
    }  
    
    public function beforeSave() 
    {
        if($this->enrollment_type_id==Yii::app()->params['individual']){
            $this->ref_id = $this->student_id;
        }elseif($this->enrollment_type_id==Yii::app()->params['group']){
            $this->ref_id = $this->group_id;
        }else{
            $this->ref_id = $this->band_id;
        }
        $this->prepared_by_id = Yii::app()->User->getId();
        return true;
    }
    
    public function updatePaymentStatus()
    {
        $totalPay = 0;
        foreach($this->payment as $pay){
            $totalPay +=$pay->amount;
        }
        if($totalPay==0){
            $this->payment_status = Yii::app()->params['unPaid'];
        }elseif($totalPay >=$this->fee){
            $this->payment_status = Yii::app()->params['fullyPaid']; //Fully Paid
        }else{
            $this->payment_status = Yii::app()->params['withBalance'];
        }
        $this->total_payment = $totalPay;
        $this->save();
    }
    
    public function updateStatus()
    {
        $classCount = count($this->class_schedule);

        $_criteria = new CDbCriteria();
        $_criteria->addCondition('enrollment_id = ' . $this->id);
        $_criteria->addCondition('status <> '.Yii::app()->params['open']);

        $classSchedule = new ClassSchedule;

        $items = $classSchedule->findAll($_criteria);
        if($classCount<1){
            $this->status = Yii::app()->params['forSchedule']; //Closed
        }elseif(count($items)==$classCount){
            $this->status = Yii::app()->params['complete']; //Closed
        }else{
            $this->status = Yii::app()->params['onGoing'];
        }
        $this->save();
    }
}