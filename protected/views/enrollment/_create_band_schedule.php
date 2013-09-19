<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<a id="add-schedule" href="javascript:;">Add Schedule</a>
<div id="bakz" style="display:none"></div>
<div id="popup-select-schedule" class="modalz" style="display:none;"><a id="close-add-schedule" title="Close" class="mCloseImg"></a>
    <div class="form">
        <div class="error" style='display: none'>
            
        </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'class-schedule-form',
        'enableAjaxValidation'=>FALSE,
        'action'=>Yii::app()->createUrl('/enrollment/saveClassSchedule'),
        'htmlOptions'=>array(
        'style'=>'padding:10px;'
        )
    )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo "<input id='enrollment_type_id' name='ClassSchedule[enrollment_type_id]' type='hidden' value='$model->enrollment_type_id;' />"?>
        <div class="row">
            <label class="required" for="ClassSchedule_date_schedule">Date<span class="required">*</span></label>		
            <input  type="text" id="ClassSchedule_date_schedule" name="ClassSchedule[date_schedule]"  size="20">
        </div>
        <div class="row">
            <label class="required" for="ClassSchedule_start_time">Start Time<span class="required">*</span></label>		
            <input  type="text" id="ClassSchedule_start_time" name="ClassSchedule[start_time]"  size="20">
        </div>
         <div class="row">
            <label class="required" for="ClassSchedule_end_time">End Time<span class="required">*</span></label>		
            <input  type="text" id="ClassSchedule_end_time" name="ClassSchedule[end_time]"  size="20">			
        </div>
        <?php echo "<input id='enrollment_id' name='ClassSchedule[enrollment_id]' type='hidden' value='$model->id;' />"?>
        <div class="row">
            <label class="required" for="ClassSchedule_studio_id">Studio <span class="required">*</span></label>
            <input disabled type="text" id="ClassSchedule_studio" name="ClassSchedule[studio]" maxlength="255" size="60">
            <?php echo "<input id='studio_id' name='ClassSchedule[studio_id]' type='hidden' value='' />"?>
            <a id="browse-studio" href="javascript:;">Browse</a>
        </div>
        
        <input type="submit" id="save" value="Save" name="save">
    <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
<div class="clear"><br></div>
<?php $this->renderPartial('_browse_studio',array('studio'=>$studio)); ?>
<div class="clear"><br></div>

<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
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
    if(isNaN(Date.parse($('#ClassSchedule_date_schedule').val()))){
        alert('Please select date');
        $('#ClassSchedule_date_schedule').focus();
        return false;
    }
    var startTime = $('#ClassSchedule_start_time').val();
    var endTime = $('#ClassSchedule_end_time').val();
    if(!IsValidTime(startTime)){
        $('#ClassSchedule_start_time').focus();
        $('#ClassSchedule_start_time').select();
        return false;
    }
    
    if(!IsValidTime(endTime)){
        $('#ClassSchedule_end_time').focus();
        $('#ClassSchedule_end_time').select();
        return false;
    }
    
    var regExp = /(\d{1,2})\:(\d{1,2})\:(\d{1,2})/;
    if(parseInt(endTime.replace(regExp, '$1$2$3')) < parseInt(startTime.replace(regExp, '$1$2$3'))){
        $('#ClassSchedule_end_time').focus();
        $('#ClassSchedule_end_time').select();
        alert('End Time must be greater Start Time');
        return false;
    }
    
    if($('#studio_id').val() ==''){
        alert('Please select studio');
        $('#browse-studio').trigger('click');
        return false;
    }
    
	jQuery.ajax({
		'type':'POST',
		'dataType':'json',
		'data': $(\"#class-schedule-form\").serialize(),
		'success':function(data){
			if(data.result===\"success\"){
			$.fn.yiiGridView.update('class-schedule-grid');
			$('#bakz').hide();
			$('#popup-select-schedule').hide();
			}else{
			$('.error').show().html(data.msg);
			}
		},
		'url':'".Yii::app()->createUrl('enrollment/saveClassSchedule')."','cache':false
	});
	return false;
});

$('#add-schedule').click(function(){
    $('.error').hide();
    $('#bakz').show();
	//$('#ClassSchedule_date_schedule').val('');
	$('#ClassSchedule_start_time').val('');
	$('#ClassSchedule_end_time').val('');
    $('#ClassSchedule_studio').val('');
    $('#studio_id').val('');
    $('#popup-select-schedule').show();
});

$('#close-add-schedule').click(function(){
    $('#bakz').hide();
    $('#popup-select-schedule').hide();
});
var dateToday = new Date();
$( '#ClassSchedule_date_schedule' ).datepicker({minDate: dateToday,buttonImageOnly: 'both',showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});
");


?>