
<div id="popup-browse-teacher" class="modalz" style="display:none;">
    <a id="close-browse-teacher" title="Close" class="mCloseImg"></a>
    <?php //*?>
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
                            $('#CourseItems_teacher').val(lname+', '+fname+' '+mname);
                            $('#popup-browse-teacher').hide();
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
<?php //*/?>

<!--<div id="result"></div>-->
</div>

<?php
Yii::app()->clientScript->registerScript('browse_teacher', "
$('#browse-teacher').click(function(){
    $('#popup-browse-teacher').show();
});

$('#close-browse-teacher').click(function(){
    $('#popup-browse-teacher').hide();
});

");
?>