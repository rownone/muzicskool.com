
<div id="bakz" style="display:none"></div>
<div id="popup-select-teacher" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teacher-grid',
	'dataProvider'=>$teacher->search(),
	'filter'=>$teacher,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
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
                           $('#teacher_id').val($(this).attr('href'));
                            var fname = $(this).parent().parent().find('td:nth(1)').html();
                            
                            $('#teacher').val(fname);

                            $('#bakz').hide();
                            $('#popup-select-teacher').hide();
                            $('#print').hide();
                            return false;
                        }
                     ", 
                    'url'=>'$data->id',
                ),
            ),
        ),
        array(
            'name'=>'name',
            'value'=>'$data->name'
        )
	),
)); ?>

</div>



<?php
Yii::app()->clientScript->registerScript('search-teacher', "
$('#browse-teacher').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-teacher').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-teacher').hide();
});

$('.search-form form').submit(function(){
	$('#teacher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>