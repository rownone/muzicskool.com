<?php
/* @var $this TeacherController */
/* @var $model Teacher */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Teacher', 'url'=>array('index')),
	array('label'=>'Create Teacher', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#teacher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Teachers</h1>

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
	'id'=>'teacher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
		//'id',
		//'datetime_created',
		'first_name',
		'last_name',
		'contact_number',
		'email',
		//'salary_rate',

        array(
            'name'=>'active',
            'value'=>'($data->active==1) ? "Yes" : "No"',
        ),
		/*'notes',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{calendar}{update}{delete}',
            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>'Yii::app()->createUrl("/teacher/view", array("id" => $data->id))',
                ),
                'calendar' => array
                (
                    'label'=>'Calendar',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/calendar.png',
                    'url'=>'Yii::app()->createUrl("classSchedule/calendar", array("teacher_id"=>$data->id))',
                ),
                'update' => array
                (
                    'url'=>'Yii::app()->createUrl("/teacher/update", array("id" => $data->id))',
                ),
                'delete' => array
                (
                    'url'=>'Yii::app()->createUrl("/teacher/delete", array("id" => $data->id))',
                )
            )
		),
	),
)); ?>
