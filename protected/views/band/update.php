<?php
/* @var $this BandController */
/* @var $model Band */

$this->breadcrumbs=array(
	'Bands'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Band', 'url'=>array('index')),
	array('label'=>'Create Band', 'url'=>array('create')),
	array('label'=>'View Band', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Band', 'url'=>array('admin')),
);
?>

<h1>Update Band</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>