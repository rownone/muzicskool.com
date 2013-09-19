<?php
/* @var $this TeacherController */
/* @var $model Teacher */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Update Teacher', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Teacher', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
    array('label'=>'View Calendar', 'url'=>array('classSchedule/calendar', 'teacher_id'=>$model->id)),
    array('label'=>'View Salary', 'url'=>array('teacher/salaryDetails', 'teacher_id'=>$model->id)),
);
?>

<h1>Teacher Profile</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'datetime_created',
		'first_name',
        'middle_name',
		'last_name',
		'contact_number',
		'birthdate',
        'address',
        'email',
        //'salary_rate',
		array(
            'label' => 'active',
            'value' => ($model->active==1) ? "Yes" : "No"
        ),
		'notes',
        array(
            'label' => 'photo',
            'type'=>'raw',
            'value'=>CHtml::image(Yii::app()->request->baseUrl.'/photo-upload/'.$model->photo,'',array('width'=>341,'height'=>232)),
        ),
	),
)); ?>



<br>
<h2 style="margin-bottom:0px">Schedule</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-items-grid',
	//'dataProvider'=>$model->search(),
    'dataProvider'=>$schedule->searchByTeacherId($model->id),    
	//'filter'=>$groupItems,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
		//'id',
		array(
            'name'=>'day',
            'value'=>'$data->day',
        ),
        array(
            'name'=>'time_from',
            'value'=>'date("g:i a", strtotime($data->time_from));',
        ),
        array(
            'name'=>'time_to',
            'value'=>'date("g:i a", strtotime($data->time_to));',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'url'=>'Yii::app()->createUrl("/teacherSchedule/delete", array("id" => $data->primaryKey))',
                )
            )
		),
	),
)); ?>

<?php echo $this->renderPartial('_add_schedule', array('schedule'=>$schedule,'teacher'=>$model)); ?>