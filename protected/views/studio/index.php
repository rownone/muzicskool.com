<?php
/* @var $this StudioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Studios',
);

$this->menu=array(
	//array('label'=>'Create Studio', 'url'=>array('create')),
	array('label'=>'Manage Studio', 'url'=>array('admin')),
);
?>

<h1>Studios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
