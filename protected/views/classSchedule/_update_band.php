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
        'label' => 'Band',
        'value' => $model->enrollment->band->name,
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
     <?php
        if(!$model->isNewRecord){
    ?>
    <div class="row">
		<?php echo $form->labelEx($model,'band_attended'); ?>
        <?php echo $form->dropDownList($model,'student_attended',array('0'=>'No','1'=>'Yes')
                ,array('options' => array($model->student_attended=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'student_attended'); ?>
	</div>
    <?php }?>
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