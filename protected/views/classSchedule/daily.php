<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<h1>Daily Schedule</h1>
<div class="row">
    <label class="required" for="group">Date <span class="required">*</span></label>
    <input  type="text" id="date1" name="date1" value="<?php echo $date1?>" size="20">
    <input name="search" id="search" value="Search" type="button" />
</div>
<br>
<?php
$scheduleColumns = array(
    //'date_schedule',
    array(
        'name'=>'start_time',
        'value'=>'date("g:i a", strtotime($data->start_time))',
    ),
    array(
        'name'=>'end_time',
        'value'=>'date("g:i a", strtotime($data->end_time))',
    ),
    array(
        'name'=>'enrollment_id',
        'header'=>'Name/Group/Band',
        'value'=>'$data->enrollment->ref_name',
    ),
    array(
        'name'=>'studio_id',
        'value'=>'$data->studio->name',
    ),
    array(
        'name'=>'teacher_id',
        'value'=>'!empty($data->teacher_id)?$data->teacher->name:""',
    ),
    array(
        'class'=>'CButtonColumn',
        'template'=>'{view}',
    ),
);
?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-schedule-grid',
    'dataProvider'=>$model->searchDateRange($date1,$date1),
	'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>$scheduleColumns,
    
));?>
<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
    var dateToday = new Date();
    $( '#date1' ).datepicker({buttonImageOnly: 'both',showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});

    $('#search').click(function(){
        $('#loading').show();
        $.fn.yiiGridView.update('class-schedule-grid',{
            data:{
                date1:$('#date1').val(),
            },complete: function(jqXHR, status) {
                $('#loading').hide();
            }
        });
    });
");

?>