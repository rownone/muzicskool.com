<?php
/* @var $this ClassScheduleController */
/* @var $model ClassSchedule */

$this->breadcrumbs=array(
	'Class Schedules'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update Attendance', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'View Enrollment Info', 'url'=>Yii::app()->createUrl( 'enrollment/view&id='.$model->enrollment_id )),
	array('label'=>'Delete ClassSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Class Schedule</h1>
<?php
  
    if($model->enrollment->enrollment_type_id==Yii::app()->params['individual']){
        $attributes = array(
            array(
                'label' => 'Student',
                'value' => $model->enrollment->student->name,
            ),
            array(
                'label' => 'Course',
                'value' => $model->enrollment->course->name,
            ),
            array(
                'label' => 'Teacher',
                'value' => $model->teacher->name,
            ),
            array(
                'label' => 'Studio',
                'value' => $model->studio->name,
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
        
        if(!empty($model->status)){
            $attributes[] = array(
                'label' => 'Student Attended',
                'value' => !empty($model->student_attended)?"Yes":"No",
            );
            $attributes[] = array(
                'label' => 'Teacher Attended',
                'value' => !empty($model->teacher_attended)?"Yes":"No",
            );
            if(empty($model->teacher_attended)){
                $attributes[] = array(
                    'label' => 'Teacher Replacement',
                    'value' => !empty($model->teacher_replacement_id)?$model->teacher_replacement->name:'',
                );
            }
        }
       
    }else if($model->enrollment->enrollment_type_id==Yii::app()->params['group']){
        $attributes = array(
            array(
                'label' => 'Group',
                'value' => $model->enrollment->group->name,
            ),
            array(
                'label' => 'Course',
                'value' => $model->enrollment->course->name,
            ),
            array(
                'label' => 'Teacher',
                'value' => $model->teacher->name,
            ),
            array(
                'label' => 'Studio',
                'value' => $model->studio->name,
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
        if(!empty($model->status)){
            $attributes[] = array(
                'label' => 'Student Attended',
                'value' => !empty($model->student_attended)?"Yes":"No",
            );
            $attributes[] = array(
                'label' => 'Teacher Attended',
                'value' => !empty($model->teacher_attended)?"Yes":"No",
            );
            if(empty($model->teacher_attended)){
                $attributes[] = array(
                    'label' => 'Teacher Replacement',
                    'value' => $model->teacher_replacement->name,
                );
            }
        }
        
    }else if($model->enrollment->enrollment_type_id==Yii::app()->params['band']){
        $attributes = array(
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
    }
    $attributes[] = 'notes';
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); ?>
