
<div id="bakz" style="display:none"></div>
<div id="popup-select-group" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-grid',
	'dataProvider'=>$enrollment->searchStudent(),
	'filter'=>$enrollment,
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
                           $('#enrollment_id').val($(this).attr('href'));
                            var fname = $(this).parent().parent().find('td:nth(1)').html();
                            var course = $(this).parent().parent().find('td:nth(2)').html();
                            $('#group').val(fname);
                            $('#course').val(course);
                            $('#bakz').hide();
                            $('#popup-select-group').hide();
                            $('#print').hide();
                            return false;
                        }
                     ", 
                    'url'=>'$data->id',
                ),                
            ),
        ),
        'ref_name',
		array(
            'name'=>'course_id',
            'filter' => CHtml::activeTextField($enrollment, 'course_id'),
            'value'=>' $data->course->name',
        ),
	),
)); ?>

</div>



<?php
Yii::app()->clientScript->registerScript('search-student', "
$('#browse-group').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-group').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-group').hide();
});

$('.search-form form').submit(function(){
	$('#group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>