<?php

/**
 * This is the model class for table "tbl_teacher".
 *
 * The followings are the available columns in table 'tbl_teacher':
 * @property string $id
 * @property string $datetime_created
 * @property string $first_name
 * @property string $last_name
 * @property string $contact_number
 * @property string $email
 * @property integer $active
 * @property string $notes
 */
class Teacher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teacher the static model class
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
		return 'tbl_teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' first_name, middle_name, last_name, contact_number', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('address, email', 'length', 'max'=>255),
			array('contact_number', 'length', 'max'=>50),
            array('salary_rate', 'numerical'),
            array('notes', 'length', 'max'=>1000),
            array('birthdate', 'date', 'format'=>'yyyy-M-d'),
            array('photo', 'file', 'types'=>'jpg, gif, png','allowEmpty' => true,),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datetime_created, first_name, last_name, contact_number, email, active, notes', 'safe', 'on'=>'search'),
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
            'schedule' => array(self::HAS_MANY, 'TeacherSchedule', 'teacher_id'),
            'course' => array(self::MANY_MANY, 'course', 'tbl_course_items(teacher_id, course_id)'),
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
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'contact_number' => 'Contact Number',
			'email' => 'Email',
            'birthdate' => 'Birthdate',
            'address' => 'Address',
            'salary_rate' => 'Salary Rate',
			'active' => 'Active',
			'notes' => 'Notes',
            'photo' => 'Photo',
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
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'last_name ASC',
            ),
		));
	}
    
    public function searchByCourseId($course_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('course_id',course_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() 
    {
		$this->name = $this->last_name.", ".$this->first_name." ".substr($this->middle_name,0,1);
        
		return true;
	}
}