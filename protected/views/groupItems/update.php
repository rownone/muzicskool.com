<?php
/* @var $this GroupItemsController */
/* @var $model GroupItems */

$this->breadcrumbs=array(
	'Group Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupItems', 'url'=>array('index')),
	array('label'=>'Create GroupItems', 'url'=>array('create')),
	array('label'=>'View GroupItems', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GroupItems', 'url'=>array('admin')),
);
?>

<h1>Update GroupItems <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>