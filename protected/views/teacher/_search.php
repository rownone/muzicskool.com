<?php
/* @var $this TeacherController */
/* @var $model Teacher */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    <?php /*?>
	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>
    <?php */?>
	<div class="row">
		<?php echo $form->label($model,'datetime_created'); ?>
		<?php echo $form->textField($model,'datetime_created'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'contact_number'); ?>
		<?php echo $form->textField($model,'contact_number',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>
    <div class="row">
		<?php echo $form->label($model,'salary_rate'); ?>
		<?php echo $form->textField($model,'salary_rate',array('size'=>60,'maxlength'=>255)); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
        <?php echo $form->dropDownList($model,'active',array('0'=>'No','1'=>'Yes'), array('options' => array('1'=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->