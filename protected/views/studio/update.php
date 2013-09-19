<?php
/* @var $this StudioController */
/* @var $model Studio */

$this->breadcrumbs=array(
	'Studios'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Studio', 'url'=>array('index')),
	array('label'=>'Create Studio', 'url'=>array('create')),
	array('label'=>'View Studio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Studio', 'url'=>array('admin')),
);
?>

<h1>Update Studio <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>