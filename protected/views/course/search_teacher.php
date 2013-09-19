<?php

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$('#teacher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teacher-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array
        (
            'header'=>'Select', // add headers this way
            'class'=>'CButtonColumn',
            'template'=>'{add}',
            'buttons'=>array
            (
                'add' => array
                (
                    'label'=>'Select',
                    //'url'=>'Yii::app()->controller->createUrl("/group/saveGroupItems",array("group_id"=>'.$_REQUEST['group_id'].',"teacher_id"=>$data->primaryKey))',  
                ),
            ),
        ),
		'first_name',
        'middle_name',
        'last_name',
	),
)); ?>
