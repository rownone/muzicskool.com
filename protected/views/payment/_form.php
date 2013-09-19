<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php 
        $ref_name = $model->isNewRecord?"": $model->enrollment->ref_name;
    ?>
	<?php echo $form->errorSummary($model); ?>
    <div class="row">
        <label class="required" for="Payment_student">Name/Group/Band <span class="required">*</span></label>
        <input disabled type="text" id="Payment_student" name="Payment[student]" value="<?php echo $ref_name;?>" maxlength="255" size="60">
        <a id="browse-student" href="javascript:;">Browse</a>
    </div>
    <div class="row" style="display:none;">
		<?php echo $form->textField($model,'enrollment_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'payment_date'); ?>
		<?php echo $form->textField($model,'payment_date'); ?>
		<?php echo $form->error($model,'payment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'or_number'); ?>
		<?php echo $form->textField($model,'or_number'); ?>
		<?php echo $form->error($model,'or_number'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
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
<?php $this->renderPartial('_browse',array('enrollment'=>$enrollment)); ?>

<?php
Yii::app()->clientScript->registerScript('payment', "
 $(function() {
    $( '#Payment_payment_date' ).datepicker({buttonImageOnly: true,showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});
  });
");
?>