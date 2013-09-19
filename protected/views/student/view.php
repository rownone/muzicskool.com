<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Student', 'url'=>array('index')),
	array('label'=>'Create Student', 'url'=>array('create')),
	array('label'=>'Update Student', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Student', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Student', 'url'=>array('admin')),
);
?>

<h1>View Student</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'datetime_created',
		'first_name',
        'middle_name',
		'last_name',
        'birthdate',
        array(
            'label'=>'Age',
            'value'=>$model->getAge($model->birthdate),
        ),
		'contact_number',
		'home_address',
		'email',
        /*array(
            'label' => $model->getAttributeLabel('group'),
            'value' => empty($model->group_id) ? "" : $model->group->name
        ),*/
		'notes',
         array(
            'label' => 'photo',
            'type'=>'raw',
            'value'=>CHtml::image(Yii::app()->request->baseUrl.'/photo-upload/'.$model->photo,'',array('width'=>341,'height'=>232)),
        ),
	),
)); ?>

<br>
<?php 
if(count($model->group)>0){
?>
    <h2 style="margin-bottom:0px">Group</h2>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'group-items-grid',
        'dataProvider'=>$groupItems->searchByStudentId($model->id),    
        'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
        'columns'=>array(
            //'id',
            /*array(
                'name'=>'group_id',
                'value'=>'empty($data->group_id) ? "" : $data->group->name',
            ),*/
            array( 
               'name'=>'group_id',
               'type'=>'raw',
               'value'=>'empty($data->group_id) ?"": CHtml::link(CHtml::encode($data->group->name), array("group/view", "id"=>$data->group->id))',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
                'buttons'=>array
                (
                    'view' => array
                    (
                        'url'=>'Yii::app()->createUrl("/group/view", array("id" => $data->group_id))',
                    )
                )
            ),

        ),
    )); 
}
?>

<?php
    if($enrollment===null){
        
    }else{
?>
        <br>
        <h2 style="margin-bottom:0px">Course</h2>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'group-items-grid',
            'dataProvider'=>$enrollment->search(),    
            'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
            'columns'=>array(
                array( 
                   'name'=>'datetime_created',
                   'type'=>'raw',
                   'value'=>'CHtml::link(CHtml::encode($data->datetime_created), array("/enrollment/view", "id"=>$data->id))',
                ),
                array(
                    'name'=>'course_id',
                    'filter' => CHtml::activeTextField($enrollment, 'course_id'),
                    'value'=>' !empty($data->course_id)?$data->course->name:""',
                ),                
                'fee',
                'total_payment',
                array(
                    'name'=>'total_payment',
                    'header'=>'Total Balance',
                    'value'=>'$data->fee - $data->total_payment',
                ),
                array(
                    'name'=>'prepared_by_id',
                    'filter' => CHtml::activeTextField($enrollment, 'prepared_by_id'),
                    'value'=>'$data->prepared_by->username',
                ),
                array(
                    'name'=>'status',
                    'filter'=>CHtml::listData(Enrollment::getStatusFilter(), 'id', 'val'),
                    'value'=>'Enrollment::getStatusValue($data->status)',
                ),
                /*array(
                    'name'=>'payment_status',
                    'filter'=>CHtml::listData(Enrollment::getPaymentStatusFilter(), 'id', 'val'),
                    'value'=>'Enrollment::getPaymentStatusValue($data->payment_status)',
                ),*/
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{calendar}{payment}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'url'=>'Yii::app()->createUrl("/enrollment/view", array("id" => $data->id))',
                        ),
                        'calendar' => array
                        (
                            'label'=>'Calendar',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/calendar.png',
                            'url'=>'Yii::app()->createUrl("classSchedule/calendar", array("enrollment_id"=>$data->id))',
                        ),
                        'payment' => array
                        (
                            'label'=>'Payment',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/payment.png',
                            'url'=>'Yii::app()->createUrl("payment/history", array("id"=>$data->id))',
                        ),
                    )
                ),
            ),
        )); 

    }
?>
