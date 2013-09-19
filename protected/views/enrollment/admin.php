<?php
/* @var $this EnrollmentController */
/* @var $model Enrollment */

$this->breadcrumbs=array(
	'Enrollments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Enroll Individual', 'url'=>array('individual')),
	array('label'=>'Enroll Group', 'url'=>array('group')),
    array('label'=>'Enroll Band', 'url'=>array('band')),
);

Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
$('.search-form form').submit(function(){
	$('#enrollment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Enrollments</h1>

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
	'id'=>'enrollment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
        array(
            'name'=>'enrollment_type_id',
            'filter' => CHtml::activeTextField($model, 'enrollment_type_id'),
            'value'=>'$data->enrollment_type->name',
        ),
		'datetime_created',
        array(
            'name'=>'ref_name',
            'type'=>'raw',
            //'value'=>array($this,'colRefName'),
            'value'=>array($model,'getRefName'),
        ),
        array(
            'name'=>'course_id',
            'filter' => CHtml::activeTextField($model, 'course_id'),
            'value'=>' !empty($data->course_id)?$data->course->name:""',
        ),
		'fee',
        array(
            'name'=>'prepared_by_id',
            'filter' => CHtml::activeTextField($model, 'prepared_by_id'),
            'value'=>'$data->prepared_by->username',
        ),
        array(
            'name'=>'status',
            'filter'=>CHtml::listData(Enrollment::getStatusFilter(), 'id', 'val'),
            'value'=>'Enrollment::getStatusValue($data->status)',
        ),
        array(
            'name'=>'payment_status',
            'filter'=>CHtml::listData(Enrollment::getPaymentStatusFilter(), 'id', 'val'),
            'value'=>'Enrollment::getPaymentStatusValue($data->payment_status)',
        ),
		/*'notes',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
