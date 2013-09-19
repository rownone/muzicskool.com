<?php
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'upload-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )
    );
    ?>
    <div class="row">
		<?php echo $form->labelEx($model,'studio_id'); ?>
		<?php echo $form->textField($model,'studio_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'studio_id'); ?>
	</div>
 <div class="row">
		<?php echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->textField($model,'student_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>
    <?php
    // ...
    echo $form->labelEx($model, 'photo');
    echo $form->fileField($model, 'photo');
    echo $form->error($model, 'photo');
    // ...
    ?>
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
    <?php
    $this->endWidget();
?>
