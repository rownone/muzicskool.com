

<a id="add-schedule" href="javascript:;">Add Schedule</a>
<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
        <div class="error" style='display: none'>
            
        </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'teacher-schedule-form',
        'enableAjaxValidation'=>FALSE,
        'action'=>Yii::app()->createUrl('/teacher/saveSchedule'),
        'htmlOptions'=>array(
        'style'=>'padding:10px;'
        )
    )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($schedule); ?>

       
        <div class="row" style="width:100px;float:left">
            <?php echo $form->labelEx($schedule,'day'); ?>
            <?php echo $form->dropDownList($schedule,'day',
                    array('Mon'=>'Mon','Tue'=>'Tue','Wed'=>'Wed','Thu'=>'Thu','Fri'=>'Fri','Sat'=>'Sat','Sun'=>'Sun')); ?>
            <?php echo $form->error($schedule,'day'); ?>
        </div>
        
        <div class="row" style="width:173px;float:left">
            <label class="required" for="time_range">Time <span class="required">*</span></label>
            <select id="time_range" name="TeacherSchedule[time_range]">
                <option value="9:00 - 10:00">9AM - 10AM</option>
                <option value="10:00 - 11:00">10AM - 11AM</option>
                <option value="11:00 - 12:00">11AM - 12PM</option>
                <option value="12:00 - 13:00">12NN - 1PM</option>
                <option value="13:00 - 14:00">1PM - 2PM</option>
                <option value="14:00 - 15:00">2PM - 3PM</option>
                <option value="15:00 - 16:00">3PM - 4PM</option>
                <option value="16:00 - 17:00">4PM - 5PM</option>
                <option value="17:00 - 18:00">5PM - 6PM</option>
                <option value="18:00 - 19:00">6PM - 7PM</option>
                <option value="19:00 - 20:00">7PM - 8PM</option>
                <option value="20:00 - 21:00">8PM - 9PM</option>
            </select>
        </div>
        <div style="display:none" class="row" style="width:173px;float:left">
            <?php echo $form->labelEx($schedule,'time_from'); ?>
            <?php echo $form->textField($schedule,'time_from'); ?>
            <?php echo $form->error($schedule,'time_from'); ?>
        </div>

        <div style="display:none" class="row" style="width:173px;float:left">
            <?php echo $form->labelEx($schedule,'time_to'); ?>
            <?php echo $form->textField($schedule,'time_to'); ?>
            <?php echo $form->error($schedule,'time_to'); ?>
        </div>
        <?php //echo $form->hiddenField($teacher,'id',array('type'=>'hidden')); ?>
        <?php echo "<input name='TeacherSchedule[teacher_id]' type='hidden' value='".$teacher->id."' />"?>
        <div class="row buttons">
            <label>&nbsp;</label>
            <?php //echo CHtml::submitButton('Create',array('class' => 'createSchedule', 'style' => 'width: 120px;')); ?>
        <?php
        
        /*echo CHtml::ajaxSubmitButton('Save',Yii::app()->createUrl('teacher/saveSchedule'),array(
           'type'=>'POST',
           'dataType'=>'json',
           'data'=>'js:$("#teacher-schedule-form").serialize()',
           'success'=>'js:function(data){
               if(data.result==="success"){
                    $.fn.yiiGridView.update(\'group-items-grid\');
                    $(\'#bakz\').hide();
                    $(\'#popup-select-student\').hide();
               }else{
                    $(\'.error\').show().html(data.msg);
               }               
           }',
        ));*/
        ?>

        </div>
         <input type="submit" id="save" value="Save" name="save">
    <?php $this->endWidget(); ?>
        
    </div><!-- form -->
</div>

<?php
Yii::app()->clientScript->registerScript('schedule', "
function IsValidTime(timeStr) {
    // Checks if time is in HH:MM:SS AM/PM format.
    // The seconds and AM/PM are optional.
    var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;
    var matchArray = timeStr.match(timePat);
    if (matchArray == null) {
        alert('Time is not in a valid format.');
        return false;
    }
    return true;
}
jQuery('body').on('click','#save',function(){
   
    var startTime = $('#TeacherSchedule_time_from').val();
    var endTime = $('#TeacherSchedule_time_to').val();
    if(!IsValidTime(startTime)){
        $('#TeacherSchedule_time_from').focus();
        $('#TeacherSchedule_time_from').select();
        return false;
    }
    
    if(!IsValidTime(endTime)){
        $('#TeacherSchedule_time_to').focus();
        $('#TeacherSchedule_time_to').select();
        return false;
    }
    
    var regExp = /(\d{1,2})\:(\d{1,2})\:(\d{1,2})/;
    if(parseInt(endTime.replace(regExp, '$1$2$3')) < parseInt(startTime.replace(regExp, '$1$2$3'))){
        $('#TeacherSchedule_time_to').focus();
        $('#TeacherSchedule_time_to').select();
        alert('End Time must be greater Start Time');
        return false;
    }
    $('#loading').show();
	jQuery.ajax({
		'type':'POST',
		'dataType':'json',
		'data': $(\"#teacher-schedule-form\").serialize(),
		'success':function(data){
            $('#loading').hide();
			if(data.result===\"success\"){
                $.fn.yiiGridView.update('group-items-grid');
                $('#bakz').hide();
                $('#popup-select-student').hide();
            }else{
                $('.error').show().html(data.msg);
            }     
		},
		'url':'".Yii::app()->createUrl('teacher/saveSchedule')."','cache':false
	});
	return false;
});

$('#add-schedule').click(function(){
    $('.error').hide();
    $('#bakz').show();
    $('#popup-select-student').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-student').hide();
});

$('#time_range').change(function(){
    var t = $(this).val().split(' - ');
    $('#TeacherSchedule_time_from').val(t[0]);
    $('#TeacherSchedule_time_to').val(t[1]);
});
$('#time_range').trigger('change');
");
?>