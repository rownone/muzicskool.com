<?php
/* @var $this ClassScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Class Schedules',
);

$this->menu=array(
	array('label'=>'Create ClassSchedule', 'url'=>array('create')),
	array('label'=>'Manage ClassSchedule', 'url'=>array('admin')),
);
?>

<h1>Class Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
