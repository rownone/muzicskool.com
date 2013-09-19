<?php
/* @var $this TeacherScheduleController */
/* @var $model TeacherSchedule */

$this->breadcrumbs=array(
	'Teacher Schedules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TeacherSchedule', 'url'=>array('index')),
	array('label'=>'Create TeacherSchedule', 'url'=>array('create')),
	array('label'=>'Update TeacherSchedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TeacherSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TeacherSchedule', 'url'=>array('admin')),
);
?>

<h1>View TeacherSchedule #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'teacher_id',
		'day',
		'time_from',
		'time_to',
	),
)); ?>
