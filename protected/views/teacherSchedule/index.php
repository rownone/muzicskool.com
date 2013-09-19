<?php
/* @var $this TeacherScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Teacher Schedules',
);

$this->menu=array(
	array('label'=>'Create TeacherSchedule', 'url'=>array('create')),
	array('label'=>'Manage TeacherSchedule', 'url'=>array('admin')),
);
?>

<h1>Teacher Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
