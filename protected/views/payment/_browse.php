
<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
	'dataProvider'=>$enrollment->searchNotFullyPaid(),
    //'ajaxUrl'=>Yii::app()->createUrl( 'enrollment/searchStudent' ),
    //'ajaxUrl'=>Yii::app()->createUrl( 'group/student' ).'&group_id='.$model->id,
	'filter'=>$enrollment,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
         array
        (
            'header'=>'Select', // add headers this way
            'class'=>'CButtonColumn',
            'template'=>'{select}',
            'buttons'=>array
            (
                'select' => array
                (
                    'label'=>'Select',
                    'click'=>"function(){
                        $('#Payment_enrollment_id').val($(this).attr('href'));
                        var fname = $(this).parent().parent().find('td:nth(1)').html();
                        $('#Payment_student').val(fname);
                        $('#bakz').hide();
                        $('#popup-select-student').hide();
                        return false;
                        }
                     ", 
                    'url'=>'$data->primaryKey',
                ),
            ),
        ),
		array(
            'name'=>'ref_name',
            'value'=>'ucwords($data->ref_name)',
        ),
        array(
            'name'=>'course_id',
            'filter' => CHtml::activeTextField($enrollment, 'course_id'),
            'value'=>' !empty($data->course_id)?$data->course->name:""',
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