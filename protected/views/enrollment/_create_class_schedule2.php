<style>
#tmp-class-schedule-grid tr:nth-child(odd) { background: none repeat scroll 0 0 #E5F1F4;}
#tmp-class-schedule-grid tr:nth-child(even) {background: none repeat scroll 0 0 #F8F8F8;}
</style>

<a id="add-schedule" href="javascript:;">Add Schedule</a>
<div id="bakz" style="display:none"></div>
<div id="popup-select-schedule" class="modalz" style="display:none;"><a id="close-add-schedule" title="Close" class="mCloseImg"></a>
    <h1>Set Class Schedule</h1>
    <div class="form">
        <div class="error" style='display: none'>
            
        </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'class-schedule-form',
        'enableAjaxValidation'=>FALSE,
        'action'=>Yii::app()->createUrl('/enrollment/saveClassSchedule2'),
        'htmlOptions'=>array(
        'style'=>'padding:10px;'
        )
    )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo "<input id='enrollment_type_id' name='enrollment_type_id' type='hidden' value='$model->enrollment_type_id;' />"?>
        <?php echo "<input id='enrollment_id' name='enrollment_id' type='hidden' value='$model->id;' />"?>
        <div class="row">
            <label class="required" for="ClassSchedule_teacher_id">Teacher <span class="required">*</span></label>
            <input disabled type="text" id="ClassSchedule_teacher" name="ClassSchedule[teacher]" maxlength="255" size="60">
            <?php echo "<input id='teacher_id' name='teacher_id' type='hidden' value='' />"?>
            <input type="hidden" id="c" name="c" value="" />
            <input type="button" value="Browse" id="browse-teacher" name="browse-teacher">
            <input type="button" value="Select Schedule" id="browse-teacher-calendar" name="browse-teacher-calendar">
        </div>
        
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
        
         <input type="submit" id="save" value="Save" name="save">
    <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
<div class="clear"><br></div>
<?php $this->renderPartial('_browse_teacher2',array('teacher'=>$teacher)); ?>
<div class="clear"><br></div>

<div id="popup-teacher-calendar" class="modalz" style="display:none; left: 219px;top: 14px;width:auto;position: absolute;">
    <a id="close-teacher-calendar" title="Close" class="mCloseImg"></a>
    <h1>Teacher Calendar</h1>
    <div id="result"></div>
</div>

<?php
Yii::app()->clientScript->registerScript('browse_teacher_calendar', "

$('#browse-teacher-calendar').click(function(){
    if($('#teacher_id').val()==''){
        alert('Please select teacher');
        $('#browse-teacher').trigger('click');
        return false;
    }
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

$('#close-browse-studio').click(function(){
    $('#popup-select-studio').hide();
});

");
?>
<div class="clear"><br></div>
<div id="popup-select-studio" class="modalz" style="display:none;">
    <a id="close-browse-studio" title="Close" class="mCloseImg"></a>
<div id="result"></div>
</div>


<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "

$('#add-schedule').click(function(){
    $('.error').hide();
    $('#bakz').show();
	$('#tmp-class-schedule-grid .items tbody tr').remove();
    $('#c').val('');
    $('#popup-select-schedule').show();
});

$('#close-add-schedule').click(function(){
    $('#bakz').hide();
    $('#popup-select-schedule').hide();
});

jQuery('body').on('click','#save',function(){
    if($('#teacher_id').val() ==''){
        alert('Please select teacher');
        $('#browse-teacher').trigger('click');
        return false;
    }
    if($('#tmp-class-schedule-grid .items tbody tr').length<1){
        $('#bakz').hide();
        $('#popup-select-schedule').hide();
        return false;
    }
    $('#loading').show();
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
            location.reload();
		},
		'url':'".Yii::app()->createUrl('enrollment/saveClassSchedule2')."','cache':false
	});
	return false;
});

");
?>