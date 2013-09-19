<?php
/* @var $this TeacherScheduleController */
/* @var $model TeacherSchedule */

$this->breadcrumbs=array(
	'Teacher Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TeacherSchedule', 'url'=>array('index')),
	array('label'=>'Manage TeacherSchedule', 'url'=>array('admin')),
);
?>

<h1>Create TeacherSchedule</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>