<?php
/* @var $this EnrollmentController */
/* @var $data Enrollment */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime_created')); ?>:</b>
	<?php echo CHtml::encode($data->datetime_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fee')); ?>:</b>
	<?php echo CHtml::encode($data->fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_id')); ?>:</b>
	<?php echo CHtml::encode($data->student_id); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('band_id')); ?>:</b>
	<?php echo CHtml::encode($data->band_id); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('prepared_by_id')); ?>:</b>
	<?php echo CHtml::encode($data->prepared_by_id); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	

</div>