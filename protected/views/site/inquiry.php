<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>
    
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($contact,'address'); ?>
		<?php echo $form->textField($contact,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($contact,'address'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($contact,'sex'); ?>
        <?php echo $form->dropDownList($contact,'sex',array('M'=>'Male','F'=>'Female'),array('style'=>'width:125px;')); ?>
		<?php echo $form->error($contact,'sex'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($contact,'birthdate'); ?>
		<?php echo $form->textField($contact,'birthdate'); ?>
		<?php echo $form->error($contact,'birthdate'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($contact,'contact_number'); ?>
		<?php echo $form->textField($contact,'contact_number'); ?>
		<?php echo $form->error($contact,'contact_number'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($contact,'course'); ?>
        <?php echo $form->dropDownList($contact,'course',CHtml::listData($course::model()->findAll(), 'name', 'name')); ?>
		<?php echo $form->error($contact,'course'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode',array('style'=>'display: inline;width:125px;')); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
	
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'cmd')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

<?php
Yii::app()->clientScript->registerScript('search', "
 $(function() {
    $( '#Contact_birthdate' ).datepicker({buttonImageOnly: true,showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});
  });
");
?>