
<div id="popup-select-teacher-schedule" class="modalz" style="display:none;">
    <a id="close-browse-teacher-schedule" title="Close" class="mCloseImg"></a>
    <?php /*?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'teacher-grid',
        'dataProvider'=>$teacher->search(),
        'ajaxUrl'=>Yii::app()->createUrl( 'enrollment/searchTeacher' ),
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
                            var mname = $(this).parent().parent().find('td:nth(2)').html();
                            var lname = $(this).parent().parent().find('td:nth(3)').html();
                            $('#TeacherSchedule_teacher').val(lname+', '+fname+' '+mname);

                            $('#popup-select-teacher').hide();
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
<?php */?>

<div id="result">
</div>
</div>

<?php
Yii::app()->clientScript->registerScript('browse_teacher_schedule', "
$('#browse-teacher-schedule').click(function(){
    $.post('".Yii::app()->createUrl( 'enrollment/teacherSchedule' )."',
        {d:$('#ClassSchedule_class_date').val()},
        function(data){
        $('#popup-select-teacher-schedule #result').html(data);
        $('#popup-select-teacher-schedule').show();
    });
    

});

$('#close-browse-teacher-schedule').click(function(){
    $('#popup-select-teacher-schedule').hide();
});

");
?>