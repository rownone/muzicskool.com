
<div id="popup-select-teacher" class="modalz" style="display:none;">
    <a id="close-browse-teacher" title="Close" class="mCloseImg"></a>
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
                        'url'=>'Yii::app()->createUrl("/teacher/salaryDetails", 
                    array("teacher_id" => $data->id,
                    "date1"=>"'.$date1.'","date2"=>"'.$date2.'"))',
                    ),                
                ),
            ),
            array(
                'name'=>'name',
                'value'=>' $data->name',
            )
        ),
    )); ?>

<!--<div id="result"></div>-->
</div>

<?php
Yii::app()->clientScript->registerScript('browse_teacher', "
$('#browse-teacher').click(function(){
    $('#popup-select-teacher').show();
});

$('#close-browse-teacher').click(function(){
    $('#popup-select-teacher').hide();
});

");
?>