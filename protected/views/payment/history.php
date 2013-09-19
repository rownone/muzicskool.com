<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Inrollment Info', 'url'=>array('enrollment/view', 'id'=>$model->enrollment_id)),
	//array('label'=>'Create Payment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$('#payment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Payments History</h1>
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
    $attributes[] = array(
        'label' => 'Total Payments',
        'type'=>'raw',
        'value' => $model->enrollment->total_payment,
    );
    $attributes[] = array(
        'label' => 'Total Balance',
        'type'=>'raw',
        'value' => $model->enrollment->fee - $model->enrollment->total_payment,
    );
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
        array(
           'name'=>'payment_date',
           'value'=>'$data->payment_date',
           'footer'=>'<b>Totals:</b>'
        ),
        'or_number',
        array(
           'name'=>'amount',
           'value'=>'$data->amount',
           'footer'=>$model->search()===0 ? '' : "<b>".$model->pageTotal($model->search())."</b>"
        ),
		/*'prepared_by_id',*/
		array(
            'name'=>'prepared_by_id',
            //'filter' => CHtml::activeTextField($model, 'prepared_by_id'),
            'value'=>'$data->prepared_by->username',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
