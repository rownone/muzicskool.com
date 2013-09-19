<?php
/* @var $this CourseItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Course Items',
);

$this->menu=array(
	array('label'=>'Create CourseItems', 'url'=>array('create')),
	array('label'=>'Manage CourseItems', 'url'=>array('admin')),
);
?>

<h1>Course Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
