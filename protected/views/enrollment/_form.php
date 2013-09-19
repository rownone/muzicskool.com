<?php
/* @var $this EnrollmentController */
/* @var $model Enrollment */
/* @var $form CActiveForm */
?>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>
<style>
    input[type=radio]{
        float:left;
    }
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enrollment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div id="wizard" class="swMain">
    <ul>
        <li>
            <a href="#step-1">
            <label class="stepNumber">1</label>
            <span class="stepDesc">
               Enrollment Type<br />
               <small>Select Enrollment Type</small>
            </span>
            </a>
        </li>
        <li>
            <a href="#step-2">
            <label class="stepNumber">2</label>
            <span class="stepDesc">
               Enrollment Details<br />
               <small>Fill Enrollment Details</small>
            </span>
            </a>
        </li>
        <li>
            <a href="#step-3">
            <label class="stepNumber">3</label>
            <span class="stepDesc">
               Class Schedule<br />
               <small>Create Class Schedule</small>
            </span>                   
            </a>
        </li>
        
    </ul>
    <div id="step-1">	
        <h2 class="StepTitle">Step 1 Select Enrollment Type</h2>
        <div class="compactRadioGroup"> 
        <?php
            // include your model attribute's value on the select parameter
             //echo CHtml::radioButtonList('enrollment_type_id',$model->enrollment_type_id,array('1'=>'Individual','2'=>'Group','3'=>'Band Rehearsal'), array( 'separator' => "  ")); 
         ?></div>
        <div class="row">
            <?php echo $form->labelEx($model,'enrollment_type_id'); ?>
            <br>
            <?php echo $form->radioButtonList($model,'enrollment_type_id',
                    array('1'=>'Individual','2'=>'Group','3'=>'Band Rehearsal'),
                    
                    array('onclick'=>"
                        $('#Enrollment_student').val('');
                        $('#Enrollment_group').val('');
                        $('#Enrollment_band').val('');
                        $('#ref_name').val('');
                        $('.f_name').hide();
                        if($(this).val()==1){
                            $('#f_student').show();
                            $('#Enrollment_course_id').show();
                        }else if($(this).val()==2){
                            $('#f_group').show();
                            $('#Enrollment_course_id').show();
                        }else{
                            $('#f_band').show();
                            $('#Enrollment_course_id').hide();
                        }
                    ")
                    ); ?>
            <?php echo $form->error($model,'enrollment_type_id'); ?>
        </div>
    </div>
    <div id="step-2" style="height: 450px">
        <h2 class="StepTitle">Step 2 Fill Enrollment Details</h2>	
        <div id='f_student' class="row f_name" style='display:block;'>
            <?php echo $form->labelEx($model,'student_id'); ?>
            <input disabled type="text" id="Enrollment_student" name="Enrollment[student]" maxlength="255" size="60">
            <?php //echo $form->dropDownList($model,'student_id',CHtml::listData(Student::model()->findAll(), 'id', 'name'),  array('empty'=>'') ); ?>
            <?php echo "<input id='student_id' name='Enrollment[student_id]' type='hidden' value='' />"?>
            <a id="add-student" href="javascript:;">Browse</a>
        </div>        

        <div id='f_group' class="row f_name" style='display:none;'>
            <?php echo $form->labelEx($model,'group_id'); ?>
            <?php //echo $form->dropDownList($model,'group_id',CHtml::listData(Group::model()->findAll(), 'id', 'name'),  array('empty'=>'') ); ?>
            <?php //echo $form->error($model,'group_id'); ?>
            <input disabled type="text" id="Enrollment_group" name="Enrollment[group]" maxlength="255" size="60">
            <?php echo "<input id='group_id' name='Enrollment[group_id]' type='hidden' value='' />"?>
            <a id="add-group" href="javascript:;">Browse</a>
        </div>
       
        <div id='f_band' class="row f_name" style='display:none;'>
            <?php echo $form->labelEx($model,'band_id'); ?>            
            <?php //echo $form->dropDownList($model,'band_id',CHtml::listData(Band::model()->findAll(), 'id', 'name'),  array('empty'=>'') ); ?>
            <?php //echo $form->error($model,'band_id'); ?>
            <input disabled type="text" id="Enrollment_band" name="Enrollment[band]" maxlength="255" size="60">
            <?php echo "<input id='band_id' name='Enrollment[band_id]' type='hidden' value='' />"?>
            <a id="add-band" href="javascript:;">Browse</a>
        </div>

        <?php echo "<input id='ref_name' name='Enrollment[ref_name]' type='hidden' value='' />"?>
        <div class="row">
            <?php echo $form->labelEx($model,'course_id'); ?>
            <?php echo $form->dropDownList($model,'course_id',CHtml::listData(Course::model()->findAll(), 'id', 'name'),  array('empty'=>'') ); ?>
            <?php echo $form->error($model,'course_id'); ?>
        </div>
              
        <div class="row">
            <?php echo $form->labelEx($model,'fee'); ?>
            <?php echo $form->textField($model,'fee'); ?>
            <?php echo $form->error($model,'fee'); ?>
        </div>
       
         <div class="row">
            <?php echo $form->labelEx($model,'notes'); ?>
            <?php echo $form->textArea($model,'notes',array('rows'=>14, 'cols'=>75,)); ?>
            <?php echo $form->error($model,'notes'); ?>
        </div>
        <?php 
            echo CHtml::ajaxSubmitButton('Save',Yii::app()->createUrl('enrollment/create'),array(
                'type'=>'POST',
                //'dataType'=>'json',
                'data'=>'js:$("#enrollment-form").serialize()',
                'success'=>'js:function(data){
                   
                    $("#class-schedule-container").append($(data));
                    
                    if(data.result==="success"){
                         //alert(data.msg);
                    }else{
                        //alert(data.msg);
                    }
                }',
             ),array('id'=>'save_enrollment','style'=>'display:none'));
         ?>
    </div>                      
    <div id="step-3">
        <h2 class="StepTitle">Step 3 Add Class Schedule</h2>	
        <div id="class-schedule-container"></div>
    </div>
    
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('style'=>'display:none;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->





<script type="text/javascript">
   
$(document).ready(function(){
    // Smart Wizard	
    var current_step = 0;
    $('#wizard').smartWizard({
        transitionEffect:'slideleft',
        onLeaveStep: leaveAStepCallback,
        onShowStep:function(s){
           
            if($(s).attr('href')==='#step-3'){
                $('#save_enrollment').trigger('click');
                 $('.buttonPrevious').addClass("buttonDisabled").attr("disabled", "disabled");
                 current_step = 3;
            }
                //$('#enrollment-form').submit();
        }
    });
    function leaveAStepCallback(obj){
        var step_num= obj.attr('rel');
        if(current_step===3) return false;
        
        //return validateSteps(step_num);
        return true;
    }

    function onFinishCallback(){
        //if(validateAllSteps()){
            //$('form').submit();
        //}
    }
});
</script>