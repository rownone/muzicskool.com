
<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
	'dataProvider'=>$students->search(),
    'ajaxUrl'=>Yii::app()->createUrl( 'enrollment/searchStudent' ),
    //'ajaxUrl'=>Yii::app()->createUrl( 'group/student' ).'&group_id='.$model->id,
	'filter'=>$students,
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
                        $('#student_id').val($(this).attr('href'));
                        var fname = $(this).parent().parent().find('td:nth(1)').html();
                        var mname = $(this).parent().parent().find('td:nth(2)').html();
                        var lname = $(this).parent().parent().find('td:nth(3)').html();
                        $('#Enrollment_student').val(lname+', '+fname+' '+mname);
                        $('#ref_name').val(lname+', '+fname+' '+mname);
                        $('#bakz').hide();
                        $('#popup-select-student').hide();
                        return false;
                        }
                     ", 
                    'url'=>'$data->primaryKey',
                ),                
            ),
        ),
		'first_name',
        'middle_name',
        'last_name',
	),
)); ?>

</div>



<?php
Yii::app()->clientScript->registerScript('search-student', "

$('#add-student').click(function(){
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