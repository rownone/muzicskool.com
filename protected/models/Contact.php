<?php

/**
 * This is the model class for table "tbl_contact".
 *
 * The followings are the available columns in table 'tbl_contact':
 * @property string $id
 * @property string $datetime_created
 * @property string $name
 * @property string $address
 * @property string $sex
 * @property string $birthdate
 * @property string $contact_number
 * @property string $email
 * @property string $course
 * @property string $subject
 * @property string $message
 * @property string $contact_type
 */
class Contact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contact the static model class
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
		return 'tbl_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, contact_number, email, subject, message', 'required'),
			array('name, address, course, subject', 'length', 'max'=>255),
			array('sex', 'length', 'max'=>10),
            array('birthdate', 'date', 'format'=>'yyyy-M-d'),
			array('contact_number, email', 'length', 'max'=>50),
            array('contact_type','length', 'max'=>11),            
            array('message', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contact_type, datetime_created, name, address, sex, birthdate, contact_number, email, course, subject, message', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'address' => 'Address',
			'sex' => 'Sex',
			'birthdate' => 'Birthdate',
			'contact_number' => 'Contact Number',
			'email' => 'Email',
			'course' => 'Course',
			'subject' => 'Subject',
            'contact_type' => 'Contact Type',
			'message' => 'Message',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('course',$this->course,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
        $criteria->compare('contact_type',$this->contact_type,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'datetime_created DESC,email ASC',
            ),
		));
	}
}