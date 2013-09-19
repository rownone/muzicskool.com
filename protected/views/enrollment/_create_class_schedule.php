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
        'action'=>Yii::app()->createUrl('/enrollment/saveClassSchedule'),
        'htmlOptions'=>array(
        'style'=>'padding:10px;'
        )
    )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo "<input id='enrollment_type_id' name='ClassSchedule[enrollment_type_id]' type='hidden' value='$model->enrollment_type_id;' />"?>
        <?php echo "<input id='enrollment_id' name='ClassSchedule[enrollment_id]' type='hidden' value='$model->id;' />"?>
        <?php echo "<input id='course_id' name='ClassSchedule[course_id]' type='hidden' value='$model->course_id;' />"?>
        <div class="row">
            <label class="required" for="ClassSchedule_teacher_id">Teacher <span class="required">*</span></label>
            <input disabled type="text" id="ClassSchedule_teacher" name="ClassSchedule[teacher]" maxlength="255" size="60">
            <?php echo "<input id='teacher_id' name='ClassSchedule[teacher_id]' type='hidden' value='' />"?>
            <?php echo "<input id='teacher_schedule_id' name='ClassSchedule[teacher_schedule_id]' type='hidden' value='' />"?>
            <a id="browse-teacher" href="javascript:;">Browse</a>
        </div>
        <div class="row">
            <label class="required" for="ClassSchedule_date_schedule">Date<span class="required">*</span></label>		
            <input  type="text" id="ClassSchedule_date_schedule" name="ClassSchedule[date_schedule]"  size="20">
            <!--<a id="browse-teacher-schedule" href="javascript:;">Browse</a>-->
            <a id="browse-teacher-calendar" href="javascript:;">Select Schedule</a>
        </div>
         <div class="row">
            <label class="required" for="ClassSchedule_start_time">Start Time<span class="required">*</span></label>		
            <input  type="text" id="ClassSchedule_start_time" name="ClassSchedule[start_time]"  size="20">
            <!--<a id="browse-teacher-schedule" href="javascript:;">Browse</a>-->
        </div>
         <div class="row">
            <label class="required" for="ClassSchedule_end_time">End Time<span class="required">*</span></label>		
            <input  type="text" id="ClassSchedule_end_time" name="ClassSchedule[end_time]"  size="20">			
        </div>
        <div class="row">
            <label class="required" for="ClassSchedule_studio_id">Studio <span class="required">*</span></label>
            <input disabled type="text" id="ClassSchedule_studio" name="ClassSchedule[studio]" maxlength="255" size="60">
            <?php echo "<input id='studio_id' name='ClassSchedule[studio_id]' type='hidden' value='' />"?>
            <a id="browse-studio" href="javascript:;">Browse</a>
        </div>
        <?php  
        /*echo CHtml::ajaxSubmitButton('Save',Yii::app()->createUrl('enrollment/saveClassSchedule'),array(
           'type'=>'POST',
           'dataType'=>'json',
           'data'=>'js:$("#class-schedule-form").serialize()',
           'success'=>'js:function(data){
               if(data.result==="success"){
                    $.fn.yiiGridView.update(\'class-schedule-grid\');
                    $(\'#bakz\').hide();
                    $(\'#popup-select-schedule\').hide();
               }else{
                    $(\'.error\').show().html(data.msg);
               }
           }',
        ));*/
        ?>
         <input type="submit" id="save" value="Save" name="save">
    <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
<div class="clear"><br></div>
<?php $this->renderPartial('_browse_teacher',array('teacher'=>$teacher)); ?>
<div class="clear"><br></div>
<?php $this->renderPartial('_browse_teacher_calendar',array('teacher'=>$teacher)); ?>
<div class="clear"><br></div>
<?php //$this->renderPartial('_browse_teacher_schedule',array('teacher'=>$teacher)); ?>
<?php $this->renderPartial('_browse_studio',array('studio'=>$studio)); ?>
<div class="clear"><br></div>
<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
$('#ClassSchedule_date_schedule').keypress(function(){
    return false;
});

$('#ClassSchedule_start_time').keypress(function(){
    return false;
});

$('#ClassSchedule_end_time').keypress(function(){
    return false;
});

jQuery('body').on('click','#save',function(){
    if($('#teacher_id').val() ==''){
        alert('Please select teacher');
        $('#browse-teacher').trigger('click');
        return false;
    }
    if($('#teacher_schedule_id').val() ==''){
        alert('Please select schedule');
        $('#browse-teacher-calendar').trigger('click');
        return false;
    }
    if($('#studio_id').val() ==''){
        alert('Please select studio');
        $('#browse-studio').trigger('click');
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
		},
		'url':'".Yii::app()->createUrl('enrollment/saveClassSchedule')."','cache':false
	});
	return false;
});

$('#add-schedule').click(function(){
    $('.error').hide();
    $('#bakz').show();
	$('#ClassSchedule_date_schedule').val('');
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

");
?>