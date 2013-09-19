<?php

/**
 * This is the model class for table "tbl_band".
 *
 * The followings are the available columns in table 'tbl_band':
 * @property string $id
 * @property string $name
 * @property string $contact_first_name
 * @property string $contact_last_name
 * @property string $contact_number
 * @property string $contact_address
 * @property string $contact_email
 * @property string $notes
 */
class Band extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Band the static model class
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
		return 'tbl_band';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, contact_first_name, contact_last_name, contact_number', 'required'),
			array('name, contact_first_name, contact_last_name, contact_address', 'length', 'max'=>255),
			array('contact_number, contact_email', 'length', 'max'=>50),
            array('notes', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, contact_first_name, contact_last_name, contact_number, contact_address, contact_email, notes', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'contact_first_name' => 'Contact First Name',
			'contact_last_name' => 'Contact Last Name',
			'contact_number' => 'Contact Number',
			'contact_address' => 'Contact Address',
			'contact_email' => 'Contact Email',
			'notes' => 'Notes',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('contact_first_name',$this->contact_first_name,true);
		$criteria->compare('contact_last_name',$this->contact_last_name,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('contact_address',$this->contact_address,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}