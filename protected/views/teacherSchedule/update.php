<?php
/* @var $this TeacherScheduleController */
/* @var $model TeacherSchedule */

$this->breadcrumbs=array(
	'Teacher Schedules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TeacherSchedule', 'url'=>array('index')),
	array('label'=>'Create TeacherSchedule', 'url'=>array('create')),
	array('label'=>'View TeacherSchedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TeacherSchedule', 'url'=>array('admin')),
);
?>

<h1>Update TeacherSchedule <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>