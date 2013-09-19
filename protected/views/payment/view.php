<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Create Payment', 'url'=>array('create')),
	array('label'=>'Update Payment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Payment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Payment', 'url'=>array('admin')),
);
?>

<h1>View Payment</h1>
<?php
    $attributes[] = array(
        'label' => 'Name',
        'type'=>'raw',
        'value' => $model->getRefNameInGV(),
    );
    if($model->enrollment->enrollment_type_id==Yii::app()->params['individual'] ||
        $model->enrollment->enrollment_type_id==Yii::app()->params['group'] ){
        $attributes[] = array(
            'label' => 'Course',
            'type'=>'raw',
            'value' => $model->enrollment->course->name,
        );
    }
    /*$attributes[] = array(
		'payment_date',
		'amount',
		array(
            'label' => 'Prepared By',
            'value' => $model->prepared_by->username,
        ),
		'notes');*/
        $attributes[] = 'payment_date';
        $attributes[] = 'or_number';
        $attributes[] = 'amount';
        $attributes[] = array(
            'label' => 'Prepared By',
            'value' => $model->prepared_by->username,
        );
        $attributes[] = 'notes';
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); ?>
