<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css" />

<style>
#tmp-class-schedule-grid tr:nth-child(odd) { background: none repeat scroll 0 0 #E5F1F4;}
#tmp-class-schedule-grid tr:nth-child(even) {background: none repeat scroll 0 0 #F8F8F8;}
</style>
<div class="row">
    <input id="teacher_id" type="hidden" value="6"/>
    <a id="browse-teacher-calendar" href="javascript:;">Select Schedule</a>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'class-schedule-form',
        'enableAjaxValidation'=>FALSE,
        'action'=>Yii::app()->createUrl('/enrollment/saveClassSchedule2'),
        'htmlOptions'=>array(
        'style'=>'padding:10px;'
        )
    )); ?>
<div class="grid-view" id="tmp-class-schedule-grid">
    <table class="items">
    <thead>
        <tr>
            <th>Studio</th>
            <th>Date Schedule</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>    
    </tbody>
    </table>
</div>
<br>
<input type="hidden" id="c" name="c" value="" />
<input type="hidden" id="enrollment_id" name="enrollment_id" value="24" />
<input type="hidden" id="enrollment_type_id" name="enrollment_type_id" value="1" />
<input type="hidden" id="teacher_id" name="teacher_id" value="6" />
<input type="submit" id="save" value="Save" name="save">
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "

jQuery('body').on('click','#save',function(){
    if($('#teacher_id').val() ==''){
        alert('Please select teacher');
        $('#browse-teacher').trigger('click');
        return false;
    }
    
    //$('#loading').show();
	jQuery.ajax({
		'type':'POST',
		'dataType':'json',
		'data': $(\"#class-schedule-form\").serialize(),
		'success':function(data){
            $('#loading').hide();
			if(data.result===\"success\"){
                $('#loading').show();
                $.fn.yiiGridView.update('class-schedule-grid',{
                complete: function(jqXHR, status) {
                        $('#loading').hide();
                    }
                });
                $('#bakz').hide();
                $('#popup-select-schedule').hide();
			}else{
                $('.error').show().html(data.msg);
			}
		},
		'url':'".Yii::app()->createUrl('enrollment/saveClassSchedule2')."','cache':false
	});
	return false;
});


");
?>

<div id="popup-teacher-calendar" class="modalz" style="display:none; left: 219px;top: 14px;width:auto;position: absolute;">
    <a id="close-teacher-calendar" title="Close" class="mCloseImg"></a>
    <h1>Teacher Calendar</h1>
    <div id="result"></div>
</div>
<?php
Yii::app()->clientScript->registerScript('browse_teacher_calendar', "
$('#browse-teacher-calendar').click(function(){
    $.post('".Yii::app()->createUrl( 'enrollment/teacherCalendar2' )."',
        {d:$('#ClassSchedule_class_date').val()},
        function(data){
        $('#loading').show();
        $('#popup-teacher-calendar #result').html(data);
        $('#popup-teacher-calendar').show();
        $('#loading').hide();
    });
    
});

$('#close-teacher-calendar').click(function(){
    $('#popup-teacher-calendar').hide();
    $('#popup-teacher-calendar #result').html('');
});

");
?>
<div class="clear"><br></div>
<div id="popup-select-studio" class="modalz" style="display:none;">
    <a id="close-browse-studio" title="Close" class="mCloseImg"></a>
<div id="result"></div>
</div>
