<?php
/* @var $this GroupItemsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Group Items',
);

$this->menu=array(
	array('label'=>'Create GroupItems', 'url'=>array('create')),
	array('label'=>'Manage GroupItems', 'url'=>array('admin')),
);
?>

<h1>Group Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
