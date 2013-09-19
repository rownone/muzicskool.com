<?php
/* @var $this CourseItemsController */
/* @var $model CourseItems */

$this->breadcrumbs=array(
	'Course Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CourseItems', 'url'=>array('index')),
	array('label'=>'Manage CourseItems', 'url'=>array('admin')),
);
?>

<h1>Create CourseItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>