
<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
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
                            $('#student').val(fname);
                            $('#course').val(course);
                            $('#bakz').hide();
                            $('#popup-select-student').hide();
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
            'value'=>'$data->course->name',
        ),
        array(
            'name'=>'fee',
            'value'=>'$data->fee',
            'visible'=>false
        ),
        array(
            'name'=>'total_payment',
            'value'=>' $data->total_payment',
            'visible'=>false
        ),
	),
)); ?>

</div>



<?php
Yii::app()->clientScript->registerScript('search-student', "
$('#browse-student').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-student').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-student').hide();
});

$('.search-form form').submit(function(){
	$('#student-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>