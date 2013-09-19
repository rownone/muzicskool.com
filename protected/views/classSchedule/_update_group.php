<?php
/* @var $this ClassScheduleController */
/* @var $model ClassSchedule */
/* @var $form CActiveForm */
?>

<div class="form">
<?php 
    $attributes = array(
        //'datetime_created',
        array(
            'label' => 'Group',
            'value' => $model->enrollment->group->name,
        ),
        array(
            'label' => 'Teacher',
            'value' => $model->teacher->name,
        ),
        array(
            'label' => 'Studio',
            'value' => $model->studio->name,
        ),
        'date_schedule',
        array(
            'label' => 'Start Time',
            'value' => date("g:i a", strtotime($model->start_time)),
        ),
        array(
            'label' => 'End Time',
            'value' => date("g:i a", strtotime($model->end_time)),
        ),

    );
    
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'class-schedule-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		<?php echo $form->labelEx($model,'group_attended'); ?>
        <?php echo $form->dropDownList($model,'student_attended',array('0'=>'No','1'=>'Yes')
                ,array('options' => array($model->student_attended=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'student_attended'); ?>
	</div>
   
    <div class="row">
		<?php echo $form->labelEx($model,'teacher_attended'); ?>
        <?php echo $form->dropDownList($model,'teacher_attended',array('0'=>'No','1'=>'Yes')
                ,array('options' => array($model->student_attended=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'student_attended'); ?>
	</div>
   
	 <?php
        $display = !empty($model->teacher_attended)?"style='display:none;'":"";        
        $teacher_replacement = !empty($model->teacher_replacement_id)?$model->teacher_replacement->name:"";        
    ?>
    <div id="div-teacher-replace" class="row" <?php echo $display;?>>
		<?php echo $form->labelEx($model,'teacher_replacement_id'); ?>
        <input type="text" value="<?php echo $teacher_replacement;?>" id="ClassSchedule_teacher_replacement" maxlength="60" size="60">
        <?php echo $form->error($model,'teacher_replacement_id'); ?>
        <a id="browse-teacher" href="javascript:;">Browse</a>
    </div>
    <div class="row" style="display:none;">		
		<?php echo $form->textField($model,'teacher_replacement_id',array('size'=>20,'maxlength'=>20)); ?>		
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="clear"><br></div>
<?php $this->renderPartial('_browse_teacher',array('model'=>$model, 'teacher'=>$teacher)); ?>
<?php
Yii::app()->clientScript->registerScript('update_individual', "
$('#ClassSchedule_teacher_attended').change(function(){
    if($(this).val() == '1'){
        $('#div-teacher-replace').hide();
    }else{
        $('#div-teacher-replace').show();
    }
    $('#ClassSchedule_teacher_replacement_id').val(0);
    $('#ClassSchedule_teacher_replacement').val('');
});
");
?>