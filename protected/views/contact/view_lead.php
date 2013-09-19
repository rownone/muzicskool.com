<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Contact', 'url'=>array('index')),
	//array('label'=>'Create Contact', 'url'=>array('create')),
	//array('label'=>'Update Contact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Contact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contact', 'url'=>array('assessment')),
    array('label'=>'Save As Student', 'url'=>array('saveStudent', 'id'=>$model->id)),
);
?>

<h1>View Application</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'datetime_created',
		'name',
		'address',
		'sex',
		'birthdate',
		'contact_number',
		'email',
		'course',
		'subject',
		'message',
	),
)); ?>
