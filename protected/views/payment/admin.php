<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Create Payment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#payment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Payments</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php /*?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php */?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
		//'id',
		//'datetime_created',
		//'enrollment_id',
        array(
            'name'=>'enrollment_id',
            'header'=>'Student/Group/Band',
            'type'=>'raw',
            'filter' => CHtml::activeTextField($model, 'enrollment_id'),
            'value'=>array($model,'getRefName'),
        ),
		'payment_date',
        'or_number',
		'amount',
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
