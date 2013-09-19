<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';

?>

<div id="formContainer">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


        <a class="flipLink" id="flipToRecover" href="#">Forgot?</a>

		<?php echo $form->textField($model,'username',array('placeholder'=>'Username')); ?>
		<?php echo $form->error($model,'username'); ?>
	

		<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
        <?php echo CHtml::submitButton('Login'); ?>
		
	
  
<?php $this->endWidget(); ?>
</div><!-- form -->

