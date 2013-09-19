<?php

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$('#student-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
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
                    'click'=>"function(){
                    /*$.fn.yiiGridView.update('group-items-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                                $.fn.yiiGridView.update('group-items-grid');
                                $('#bakz').hide();
                                $('#popup-select-student').hide();
                            }
                        })
                    */
                        return false;
                    }
                    ",
                    //'url'=>'Yii::app()->controller->createUrl("/group/saveGroupItems",array("group_id"=>'.$_REQUEST['group_id'].',"student_id"=>$data->primaryKey))',  
                ),
            ),
        ),
		'first_name',
        'middle_name',
        'last_name',
	),
)); ?>
