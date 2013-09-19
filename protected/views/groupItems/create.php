<?php
/* @var $this GroupItemsController */
/* @var $model GroupItems */

$this->breadcrumbs=array(
	'Group Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupItems', 'url'=>array('index')),
	array('label'=>'Manage GroupItems', 'url'=>array('admin')),
);
?>

<h1>Create GroupItems</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>