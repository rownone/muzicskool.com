<?php
/* @var $this ClassScheduleController */
/* @var $data ClassSchedule */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime_created')); ?>:</b>
	<?php echo CHtml::encode($data->datetime_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enrollment_id')); ?>:</b>
	<?php echo CHtml::encode($data->enrollment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_id')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_attended')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_attended); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_replacement_id')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_replacement_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_salary')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_salary); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('student_attended')); ?>:</b>
	<?php echo CHtml::encode($data->student_attended); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('studio_id')); ?>:</b>
	<?php echo CHtml::encode($data->studio_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_schedule')); ?>:</b>
	<?php echo CHtml::encode($data->date_schedule); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prepared_by_id')); ?>:</b>
	<?php echo CHtml::encode($data->prepared_by_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>