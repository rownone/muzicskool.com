<?php
/* @var $this StudioController */
/* @var $model Studio */

$this->breadcrumbs=array(
	'Studios'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Studio', 'url'=>array('index')),
	array('label'=>'Create Studio', 'url'=>array('create')),
	array('label'=>'Update Studio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Studio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Studio', 'url'=>array('admin')),
    array('label'=>'View Calendar', 'url'=>array('classSchedule/calendar', 'studio_id'=>$model->id)),
);
?>

<h1>View Studio</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'code',
		'name',
		'description',
        'notes',
	),
)); ?>
