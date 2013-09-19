<?php
/* @var $this ClassScheduleController */
/* @var $model ClassSchedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'class-schedule-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'datetime_created'); ?>
		<?php echo $form->textField($model,'datetime_created'); ?>
		<?php echo $form->error($model,'datetime_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enrollment_id'); ?>
		<?php echo $form->textField($model,'enrollment_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'enrollment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teacher_id'); ?>
		<?php echo $form->textField($model,'teacher_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'teacher_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teacher_attended'); ?>
		<?php echo $form->textField($model,'teacher_attended',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'teacher_attended'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teacher_replacement_id'); ?>
		<?php echo $form->textField($model,'teacher_replacement_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'teacher_replacement_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teacher_salary'); ?>
		<?php echo $form->textField($model,'teacher_salary'); ?>
		<?php echo $form->error($model,'teacher_salary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'student_attended'); ?>
		<?php echo $form->textField($model,'student_attended',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'student_attended'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'studio_id'); ?>
		<?php echo $form->textField($model,'studio_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'studio_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_schedule'); ?>
		<?php echo $form->textField($model,'date_schedule'); ?>
		<?php echo $form->error($model,'date_schedule'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->textField($model,'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prepared_by_id'); ?>
		<?php echo $form->textField($model,'prepared_by_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'prepared_by_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
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