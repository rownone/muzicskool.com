<?php
/* @var $this EnrollmentController */
/* @var $model Enrollment */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
$this->breadcrumbs=array(
	'Enrollments'=>array('index'),
	$model->id,
);

if($model->enrollment_type_id==1){//student
    $create = 'individual';
}else if($model->enrollment_type_id==2){//student
    $create = 'group';
}else{
    $create = 'band';
}

$this->menu=array(
	array('label'=>'Create Enrollment', 'url'=>array($create)),
	array('label'=>'Update Enrollment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Enrollment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Enrollment', 'url'=>array('admin')),
    array('label'=>'View Calendar', 'url'=>array('classSchedule/calendar','enrollment_id'=>$model->id)),
    array('label'=>'Payment History', 'url'=>array('payment/history','id'=>$model->id)),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/jquery-ui.min.js");
?>
<h1>View Enrollment</h1>
<?php 
if($model->enrollment_type_id==Yii::app()->params['individual']){//student
    $attributes = array(
        'datetime_created',
        array(
            'label' => $model->getAttributeLabel('student'),
            'type'=>'raw',
            'value' => CHtml::link(CHtml::encode(ucwords ($model->student->name)),
                array('student/view','id'=>$model->student->id)),
        ),
        array(
            'label' => $model->getAttributeLabel('course'),
            'value' => $model->course->name
        ),
        'fee',
        'total_payment',
        array(
            'label' => 'Total Balance',
            'value' => $model->fee - $model->total_payment
        ),
        array(
            'label' => 'Status',
            'value' => Enrollment::getStatusValue($model->status)
        ),
        array(
            'label' => $model->getAttributeLabel('prepared_by_id'),
            'value' => $model->prepared_by->username
        ),
        'notes'
    );

    $scheduleColumns = array(
        array(
            'name'=>'teacher_id',
            'value'=>'$data->teacher->name',
        ),
//        array(
//            'name'=>'studio_id',
//            'value'=>'$data->studio->name',
//        ),
        array(
            'name'=>'studio_id',
            'filter' => CHtml::activeTextField($classSchedule, 'studio_id'),
            'value'=>'$data->studio->name',
        ),
        'date_schedule',
        array(
            'name'=>'start_time',
            'value'=>'date("g:i a", strtotime($data->start_time))',
        ),
        array(
            'name'=>'end_time',
            'value'=>'date("g:i a", strtotime($data->end_time))',
        ),
         array( 
            'name'=>'status',
            'filter'=>CHtml::listData(ClassSchedule::getStatusFilter(), 'id', 'val'),
            'value'=>'ClassSchedule::getStatusValue($data->status)',
         ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
            'buttons'=>array
            (
                //'delete' => array('url'=>'Yii::app()->createUrl("/classSchedule/delete/", array("id" => $data->primaryKey))',),
                'delete' => array
                (
                    'url'=>'Yii::app()->createUrl("/classSchedule/delete", array("id" => $data->primaryKey))',
                ),
                'view' => array('url'=>'Yii::app()->createUrl("/classSchedule/view", array("id" => $data->primaryKey))',),
//                'delete' => array
//                (
//                    'label'=>'delete',
//                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
//                    'url'=>'Yii::app()->createUrl("classSchedule/delete", array("id"=>$data->primaryKey))',
//                ),
            )
        ),
    );

/***********************GROUP******************************************/
}else if($model->enrollment_type_id==Yii::app()->params['group']){//group
    $attributes = array(
        'datetime_created',
        array(
            'label' => $model->getAttributeLabel('group'),
            'type'=>'raw',
            'value' => CHtml::link(CHtml::encode(ucwords ($model->group->name)),
                                 array('group/view','id'=>$model->group->id)),
        ),
        'fee',
        array(
            'label' => $model->getAttributeLabel('course'),
            'value' => $model->course->name
        ),
        'notes'
    );

   $scheduleColumns = array(
        array(
            'name'=>'teacher_id',
            'value'=>'$data->teacher->name',
        ),
         array(
            'name'=>'studio_id',
            'value'=>'$data->studio->name',
        ),
        'date_schedule',
        array(
            'name'=>'start_time',
            'value'=>'date("g:i a", strtotime($data->start_time))',
        ),
        array(
            'name'=>'end_time',
            'value'=>'date("g:i a", strtotime($data->end_time))',
        ),
        array( 
            'name'=>'status',
            'filter'=>CHtml::listData(ClassSchedule::getStatusFilter(), 'id', 'val'),
            'value'=>'ClassSchedule::getStatusValue($data->status)',
         ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
            'buttons'=>array
            (
                'delete' => array('url'=>'Yii::app()->createUrl("/classSchedule/delete", array("id" => $data->primaryKey))',),
                'view' => array('url'=>'Yii::app()->createUrl("/classSchedule/view", array("id" => $data->primaryKey))',)
            )
        ),
    );

/**********************BAND REHEARSAL**********************************************/

}else if($model->enrollment_type_id==Yii::app()->params['band']){//band rehearsal
    $attributes = array(
        'datetime_created',
        array(
            'label' => $model->getAttributeLabel('band'),
            'type'=>'raw',
            'value' => CHtml::link(CHtml::encode(ucwords ($model->band->name)),
                array('band/view','id'=>$model->band->id)),
        ),
        'fee',
        'notes'
    );

    $scheduleColumns = array(
        array(
           'name'=>'studio_id',
           'value'=>'$data->studio->name',
        ),
        'date_schedule',
        array(
            'name'=>'start_time',
            'value'=>'date("g:i a", strtotime($data->start_time))',
        ),
        array(
            'name'=>'end_time',
            'value'=>'date("g:i a", strtotime($data->end_time))',
        ),
         array( 
            'name'=>'status',
            'filter'=>CHtml::listData(ClassSchedule::getStatusFilter(), 'id', 'val'),
            'value'=>'ClassSchedule::getStatusValue($data->status)',
         ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',
            'buttons'=>array
            (
                'delete' => array('url'=>'Yii::app()->createUrl("/classSchedule/delete", array("id" => $data->primaryKey))',),
                'view' => array('url'=>'Yii::app()->createUrl("/classSchedule/view", array("id" => $data->primaryKey))',)
            )
        ),
    );    
}

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); 
?>

<br>
<h2 style="margin-bottom:0px">Schedule</h2>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-schedule-grid',
	//'dataProvider'=>$classSchedule->searchByEnrollmentId($model->id),
    'dataProvider'=>$classSchedule->search(),
	//'filter'=>$classSchedule,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>$scheduleColumns,
    //'ajaxUpdate'=>'class-schedule-grid', // not necessary if same as id
    //'ajaxUrl'=>Yii::app()->createUrl( 'classSchedule/search' ),
));

if($model->enrollment_type_id==Yii::app()->params['individual'] || 
        $model->enrollment_type_id ==Yii::app()->params['group']){//student
    $this->renderPartial('_create_class_schedule2',
        array('model'=>$model,'teacher'=>$teacher,'studio'=>$studio));
}else{ //band
    $this->renderPartial('_create_band_schedule',
        array('model'=>$model,'studio'=>$studio));
}
?>
