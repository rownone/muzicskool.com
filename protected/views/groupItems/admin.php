<?php
/* @var $this GroupItemsController */
/* @var $model GroupItems */

$this->breadcrumbs=array(
	'Group Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List GroupItems', 'url'=>array('index')),
	array('label'=>'Create GroupItems', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#group-items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Group Items</h1>

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
	'id'=>'group-items-grid',
	//'dataProvider'=>$model->search(),
    'dataProvider'=>$model->searchByGroupId(2),    
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
		//'id',
		 array(
            'name'=>'group_id',
            'value'=>'empty($data->group_id) ? "" : $data->group->name',
        ),
		 array(
            'name'=>'student_id',
            'value'=>'empty($data->student_id) ? "" : $data->student->name',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
