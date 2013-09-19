<?php

/**
 * This is the model class for table "tbl_student".
 *
 * The followings are the available columns in table 'tbl_student':
 * @property string $id
 * @property string $datetime_created
 * @property string $first_name
 * @property string $last_name
 * @property string $contact_number
 * @property string $home_address
 * @property string $email
 * @property string $birthdate
 * @property string $notes
 */
class Student extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Student the static model class
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
		return 'tbl_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, middle_name, contact_number', 'required'),
			array('first_name, last_name, middle_name, name, home_address', 'length', 'max'=>255),
			array('contact_number, email', 'length', 'max'=>50),
            //array('group_id', 'length', 'max'=>20),
            array('notes', 'length', 'max'=>1000),
            array('birthdate', 'date', 'format'=>'yyyy-M-d'),
            array('photo', 'file', 'types'=>'jpg, gif, png','allowEmpty' => true,),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datetime_created, first_name, last_name, contact_number, home_address, email, notes', 'safe', 'on'=>'search'),
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
			//'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'group' => array(self::MANY_MANY, 'Group', 'tbl_group_items(student_id, group_id)'),
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
            'middle_name' => 'Middle Name',
            'name' => 'Name',
			'contact_number' => 'Contact Number',
			'home_address' => 'Home Address',
			'email' => 'Email',
            'birthdate' => 'Birthdate',
            //'group_id' => 'Group',
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
        $criteria->compare('middle_name',$this->middle_name,true);
        $criteria->compare('name',$this->name,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('home_address',$this->home_address,true);
		$criteria->compare('email',$this->email,true);
       // $criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'last_name ASC',
            ),
		));
	}
    
    public static function getAge($birthdate)
    {        
        $birthday = new DateTime($birthdate);
        $interval = $birthday->diff(new DateTime);
        return $interval->y;
    }
    
    public function beforeSave() 
    {
		$this->name = $this->last_name.", ".$this->first_name." ".substr($this->middle_name,0,1);
        
		return true;
	}
}