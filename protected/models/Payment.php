<?php

/**
 * This is the model class for table "tbl_payment".
 *
 * The followings are the available columns in table 'tbl_payment':
 * @property string $id
 * @property string $datetime_created
 * @property string $enrollment_id
 * @property string $payment_date
 * @property double $amount
 * @property string $prepared_by_id
 * @property string $notes
 */
class Payment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return 'tbl_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enrollment_id, payment_date, amount, or_number', 'required'),
			array('amount', 'numerical'),
			array('enrollment_id, prepared_by_id', 'length', 'max'=>20),
            array('notes', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datetime_created, enrollment_id, payment_date, amount, prepared_by_id, notes', 'safe', 'on'=>'search'),
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
            'enrollment' => array(self::BELONGS_TO, 'Enrollment', 'enrollment_id'),
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
			'enrollment_id' => 'Name',
			'payment_date' => 'Payment Date',
			'amount' => 'Amount',
            'or_number' => 'OR Number',
			'prepared_by_id' => 'Prepared By',
			'notes' => 'Notes',
		);
	}

    public function getRefName($data,$row)
    {
        if(!empty($data->enrollment)){
            if($data->enrollment->enrollment_type_id==Yii::app()->params['individual']){
                return CHtml::link(CHtml::encode(ucwords ($data->enrollment->ref_name)),array('/student/view','id'=>$data->enrollment->student_id));
            }elseif($data->enrollment->enrollment_type_id==Yii::app()->params['group']){
                return CHtml::link(CHtml::encode(ucwords ($data->enrollment->ref_name)),array('/group/view','id'=>$data->enrollment->group_id));
            }else{
                return CHtml::link(CHtml::encode(ucwords ($data->enrollment->ref_name)),array('/band/view','id'=>$data->enrollment->band_id));
            }
        }
    }  
    
    public function getRefNameInGV()
    {
        if($this->enrollment->enrollment_type_id==Yii::app()->params['individual']){
            return CHtml::link(CHtml::encode(ucwords ($this->enrollment->ref_name)),array('/student/view','id'=>$this->enrollment->student_id));
        }elseif($this->enrollment->enrollment_type_id==Yii::app()->params['group']){
            return CHtml::link(CHtml::encode(ucwords ($this->enrollment->ref_name)),array('/group/view','id'=>$this->enrollment->group_id));
        }else{
            return CHtml::link(CHtml::encode(ucwords ($this->enrollment->ref_name)),array('/band/view','id'=>$this->enrollment->band_id));
        }
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
        $criteria->with= array('enrollment','prepared_by');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('amount',$this->amount);
        $criteria->compare('or_number',$this->or_number);
		$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		$criteria->compare('notes',$this->notes,true);

        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'payment_date DESC ',
            ),
		));
	}
    
    public function searchDateRange($from, $to)
	{

		$criteria=new CDbCriteria;
        $criteria->select = 'enrollment_id, payment_date, sum(amount) as amount';
        $criteria->together = true;
        $criteria->with= array('enrollment','prepared_by');
		
        $criteria->addCondition("payment_date between '$from' and '$to' ");
        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        
        $criteria->group = 'enrollment_id';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'payment_date DESC ',
            ),
		));
	}
    
    public function search2($date1,$date2)
	{
		$criteria=new CDbCriteria;
        $criteria->together = true;
        $criteria->with= array('enrollment','prepared_by');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('amount',$this->amount);
        $criteria->compare('or_number',$this->or_number);
		$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		$criteria->compare('notes',$this->notes,true);

        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        $criteria->addCondition("payment_date between '$date1' and '$date2' ");
        
        $criteria->group = 'enrollment_id';
		
        return new CActiveDataProvider($this, array(
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',
                        Yii::app()->params['defaultPageSize']),
                 //'route'=>"/test/grid&date1=$date1&date2=$date2"
            ),
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'payment_date DESC ',
                //'route'=>"/test/grid/"
                //'route'=>"/test/grid&date1=$date1&date2=$date2"
                //'route'=>"/test/grid/&date1=$date1&date2=$date2"
            ),
		));
	}
    
    public function search3($date1,$date2)
	{
		$criteria=new CDbCriteria;
        $criteria->together = true;
        $criteria->with= array('enrollment','prepared_by');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('datetime_created',$this->datetime_created,true);
		$criteria->compare('enrollment_id',$this->enrollment_id,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('amount',$this->amount);
        $criteria->compare('or_number',$this->or_number);
		//$criteria->compare('prepared_by_id',$this->prepared_by_id,true);
		//$criteria->compare('notes',$this->notes,true);

        $criteria->addSearchCondition('prepared_by.username',$this->prepared_by_id);
        $criteria->addSearchCondition('enrollment.ref_name',$this->enrollment_id);
        $criteria->addCondition("payment_date between '$date1' and '$date2' ");
        
        //$criteria->group = 'enrollment_id';
		
        return new CActiveDataProvider($this, array(
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',
                        Yii::app()->params['defaultPageSize']),
            ),
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'payment_date ASC, ref_name ASC ',
            ),
		));
	}
    
    public static function pageTotal($provider)
    {
        $total=0;
        foreach($provider->data as $item)
            $total+=$item->amount;
        return $total;
    }
    
    public function beforeSave() 
    {
        $this->prepared_by_id = Yii::app()->User->getId();
        return parent::beforeSave();
    }
    
    protected function afterSave()
    {
        $this->enrollment->updatePaymentStatus();
        return true;
    }
}