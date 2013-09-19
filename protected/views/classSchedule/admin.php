<?php
/* @var $this ClassScheduleController */
/* @var $model ClassSchedule */

$this->breadcrumbs=array(
	'Class Schedules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ClassSchedule', 'url'=>array('index')),
	array('label'=>'Create ClassSchedule', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#class-schedule-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Class Schedules</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
		//'id',
		//'datetime_created',
		//'enrollment_id',
		
        array(
           'name'=>'teacher_id',
           'header'=>'Teacher',
           'type'=>'raw',
           'value'=>'!empty($data->teacher_id)?$data->teacher->name:""',
        ),
		//'teacher_attended',
		//'teacher_replacement_id',
		
		//'teacher_salary',
		//'student_attended',
		array(
           'name'=>'studio_id',
           'header'=>'Studio',
           'type'=>'raw',
           'value'=>'$data->studio->name',
        ),
		'date_schedule',
		array(
           'name'=>'start_time',
           'header'=>'Start Time',
           'type'=>'raw',
           'value'=>'date("g:i a", strtotime($data->start_time))',
        ),
        array(
           'name'=>'start_time',
           'header'=>'Start Time',
           'type'=>'raw',
           'value'=>'date("g:i a", strtotime($data->end_time))',
        ),
		array( 
            'name'=>'status',
            'filter'=>CHtml::listData(ClassSchedule::getStatusFilter(), 'id', 'val'),
            'value'=>'ClassSchedule::getStatusValue($data->status)',
        ),
        /*array(
            'name'=>'prepared_by_id',
            'filter' => CHtml::activeTextField($model, 'prepared_by_id'),
            'value'=>'$data->prepared_by->username',
        ),*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
