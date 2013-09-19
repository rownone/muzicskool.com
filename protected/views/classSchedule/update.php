<?php
/* @var $this ClassScheduleController */
/* @var $model ClassSchedule */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
$this->breadcrumbs=array(
	'Class Schedules'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View ClassSchedule', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'View Enrollment Info', 'url'=>Yii::app()->createUrl( 'enrollment/view&id='.$model->enrollment_id )),
);
?>

<h1>Attendance</h1>
<?php
    if($model->enrollment->enrollment_type_id == Yii::app()->params['individual']){
        echo $this->renderPartial('_update_individual', array('model'=>$model,'teacher'=>$teacher));
    }elseif($model->enrollment->enrollment_type_id == Yii::app()->params['group']){
        echo $this->renderPartial('_update_group', array('model'=>$model,'teacher'=>$teacher));
    }elseif($model->enrollment->enrollment_type_id == Yii::app()->params['band']){
        echo $this->renderPartial('_update_band', array('model'=>$model));
    }
?>
