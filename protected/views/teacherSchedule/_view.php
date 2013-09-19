<?php
/* @var $this TeacherScheduleController */
/* @var $data TeacherSchedule */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_id')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day')); ?>:</b>
	<?php echo CHtml::encode($data->day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_from')); ?>:</b>
	<?php echo CHtml::encode($data->time_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_to')); ?>:</b>
	<?php echo CHtml::encode($data->time_to); ?>
	<br />


</div>