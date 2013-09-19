<?php

/**
 * This is the model class for table "tbl_group_items".
 *
 * The followings are the available columns in table 'tbl_group_items':
 * @property string $id
 * @property string $group_id
 * @property string $student_id
 */
class GroupItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GroupItems the static model class
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
		return 'tbl_group_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, student_id', 'required'),
			array('group_id, student_id', 'length', 'max'=>20),
            //array('student_id', 'unique', 'className' => 'Student'),
             array('student_id', 'ext.validators.EUniqueIndexValidator'),
            /*array('student_id','unique',
				'criteria'=>array(
					'condition'=>'student_id=:student_id',
					'params'=>array(':student_id'=>$this->student_id),
				),
			),*/

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, group_id, student_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Group',
			'student_id' => 'Student',
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
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('student_id',$this->student_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchByGroupId($group_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('group_id',$group_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function searchByStudentId($student_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('student_id',$student_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave()
    {

        $_criteria = new CDbCriteria();
        $_criteria->addCondition('student_id = ' . $this->student_id);
        $_criteria->addCondition('group_id = ' . $this->group_id);
        $rec= new CActiveDataProvider(get_class($this), 
        array('criteria'=>$_criteria,));

        $result=$rec->getData();
        if(count($result)>0){
            echo (json_encode(array('result' => 'error', 'msg' => '<div class="errorSummary"><p>Please fix the following input errors:</p>
            <ul><li>Student already exist in the group. Please select another student.</li></ul></div>')));
            return false;
        }else{
            echo (json_encode(array('result' => 'success', 'msg' => 'Success!')));
            return true;
        }
               
    }
}