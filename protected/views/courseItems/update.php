<?php
/* @var $this CourseItemsController */
/* @var $model CourseItems */

$this->breadcrumbs=array(
	'Course Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CourseItems', 'url'=>array('index')),
	array('label'=>'Create CourseItems', 'url'=>array('create')),
	array('label'=>'View CourseItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CourseItems', 'url'=>array('admin')),
);
?>

<h1>Update CourseItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>