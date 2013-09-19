<?php

/**
 * This is the model class for table "tbl_course_items".
 *
 * The followings are the available columns in table 'tbl_course_items':
 * @property string $id
 * @property string $course_id
 * @property string $teacher_id
 * @property double $rate
 */
class CourseItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseItems the static model class
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
		return 'tbl_course_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, teacher_id, rate', 'required'),
			array('rate', 'numerical'),
			array('course_id, teacher_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, course_id, teacher_id, rate', 'safe', 'on'=>'search'),
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
            'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
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
			'course_id' => 'Course',
			'teacher_id' => 'Teacher',
			'rate' => 'Rate/hr',
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
		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('rate',$this->rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function searchByCourseId($course_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('course_id',$course_id,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave()
    {

        $_criteria = new CDbCriteria();
        $_criteria->addCondition('teacher_id = ' . $this->teacher_id);
        $_criteria->addCondition('course_id = ' . $this->course_id);
        $rec= new CActiveDataProvider(get_class($this), 
        array('criteria'=>$_criteria,));

        $result=$rec->getData();
        if(count($result)>0){
            echo (json_encode(array('result' => 'error', 'msg' => '<div class="errorSummary"><p>Please fix the following input errors:</p>
            <ul><li>Teacher already exist. Please select another teacher.</li></ul></div>')));
            return false;
        }else{
            echo (json_encode(array('result' => 'success', 'msg' => 'Success!')));
            return true;
        }
               
    }
}