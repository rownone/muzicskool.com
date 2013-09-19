<?php
/* @var $this ClassScheduleController */
/* @var $model ClassSchedule */

$this->breadcrumbs=array(
	'Class Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClassSchedule', 'url'=>array('index')),
	array('label'=>'Manage ClassSchedule', 'url'=>array('admin')),
);
?>

<h1>Create ClassSchedule</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>