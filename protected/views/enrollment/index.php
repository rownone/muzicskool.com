<?php
/* @var $this EnrollmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Enrollments',
);

$this->menu=array(
	array('label'=>'Create Enrollment', 'url'=>array('create')),
	array('label'=>'Manage Enrollment', 'url'=>array('admin')),
);
?>

<h1>Enrollments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
