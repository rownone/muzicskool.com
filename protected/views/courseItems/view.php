<?php
/* @var $this CourseItemsController */
/* @var $model CourseItems */

$this->breadcrumbs=array(
	'Course Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CourseItems', 'url'=>array('index')),
	array('label'=>'Create CourseItems', 'url'=>array('create')),
	array('label'=>'Update CourseItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CourseItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseItems', 'url'=>array('admin')),
);
?>

<h1>View CourseItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'course_id',
		'teacher_id',
		'rate',
	),
)); ?>
