
<div id="popup-select-teacher" class="modalz" style="display:none;">
    <a id="close-browse-teacher" title="Close" class="mCloseImg"></a>
    <h1><?php echo $teacher->course->name;?> Teachers</h1>
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
                            
                            $('#ClassSchedule_teacher').val(fname);

                            $('#popup-select-teacher').hide();
                            return false;
                            }
                         ", 
                        'url'=>'$data->teacher_id',
                    ),                
                ),
            ),
            /*'first_name',
            'middle_name',
            'last_name',*/
            array(
                'name'=>'teacher_id',
                'value'=>' $data->teacher->name',
            )
        ),
    )); ?>

<!--<div id="result"></div>-->
</div>

<?php
Yii::app()->clientScript->registerScript('browse_teacher', "
$('#browse-teacher').click(function(){
    /*$.post('".Yii::app()->createUrl( 'enrollment/teacherSchedule' )."',
        {d:$('#TeacherSchedule_class_date').val()},
        function(data){
        $('#popup-select-teacher #result').html(data);
        $('#popup-select-teacher').show();
    });
    */
    $('#popup-select-teacher').show();
});

$('#close-browse-teacher').click(function(){
    $('#popup-select-teacher').hide();
});

");
?>