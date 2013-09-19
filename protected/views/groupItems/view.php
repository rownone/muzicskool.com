<?php
/* @var $this GroupItemsController */
/* @var $model GroupItems */

$this->breadcrumbs=array(
	'Group Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GroupItems', 'url'=>array('index')),
	array('label'=>'Create GroupItems', 'url'=>array('create')),
	array('label'=>'Update GroupItems', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GroupItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupItems', 'url'=>array('admin')),
);
?>

<h1>View GroupItems #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_id',
		'student_id',
	),
)); ?>
