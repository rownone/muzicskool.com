<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/smart_wizard_vertical.css" />-->
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-1.4.2.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/smart_wizard.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.smartWizard.js"></script>
<?php
/* @var $this EnrollmentController */
/* @var $model Enrollment */

$this->breadcrumbs=array(
	'Enrollments'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Enrollment', 'url'=>array('index')),
	array('label'=>'Manage Enrollment', 'url'=>array('admin')),
);
?>

<h1>Create Enrollment</h1>

<?php echo $this->renderPartial('_form_1', array('model'=>$model)); ?>

<?php $this->renderPartial('_browse_student',array('students'=>$students,'model'=>$model)); ?>
<?php $this->renderPartial('_browse_band',array('bands'=>$bands,'model'=>$model)); ?>
<?php $this->renderPartial('_browse_group',array('groups'=>$groups,'model'=>$model)); ?>