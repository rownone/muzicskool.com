<?php
/* @var $this StudioController */
/* @var $model Studio */

$this->breadcrumbs=array(
	'Studios'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Studio', 'url'=>array('index')),
	array('label'=>'Manage Studio', 'url'=>array('admin')),
);
?>

<h1>Create Studio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>