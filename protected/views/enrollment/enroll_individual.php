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

<h1><?php echo $model->isNewRecord?'Create':'Update'; ?> Enrollment</h1>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enrollment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php
        $student = $model->isNewRecord ? '': $model->student->name;
        $student_id = $model->isNewRecord ? '': $model->student_id;
        $ref_name = $model->isNewRecord ? '': $model->ref_name;
    ?>
	<?php echo $form->errorSummary($model); ?>
        <?php echo "<input id='enrollment_type_id' name='Enrollment[enrollment_type_id]' type='hidden' value='$model->enrollment_type_id' />"?>
        <div class="row">
            <?php echo $form->labelEx($model,'student_id'); ?>
            <input disabled type="text" value='<?php echo $student;?>' id="Enrollment_student" name="Enrollment[student]" maxlength="255" size="60">
            <?php echo "<input id='student_id' name='Enrollment[student_id]' type='hidden' value='$student_id' />"?>
            <a id="add-student" href="javascript:;">Browse</a>
            <?php echo $form->error($model,'student_id'); ?>
        </div>
        
        <?php echo "<input id='ref_name' name='Enrollment[ref_name]' type='hidden' value='$ref_name' />"?>
        <div class="row" style="display:<?php echo $lockCourse==true?'none':'block'?>">
            <?php echo $form->labelEx($model,'course_id'); ?>
            <?php echo $form->dropDownList($model,'course_id',CHtml::listData($course, 'id', 'name')); ?>
            <?php echo $form->error($model,'course_id'); ?>
        </div>
              
        <div class="row">
            <?php echo $form->labelEx($model,'fee'); ?>
            <?php echo $form->textField($model,'fee'); ?>
            <?php echo $form->error($model,'fee'); ?>
        </div>
       
         <div class="row">
            <?php echo $form->labelEx($model,'notes'); ?>
            <?php echo $form->textArea($model,'notes',array('rows'=>14, 'cols'=>75,)); ?>
            <?php echo $form->error($model,'notes'); ?>
        </div>
       
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('style'=>'display:block;')); ?>
	</div>
    
    <?php $this->endWidget(); ?>
</div>

<?php $this->renderPartial('_browse_student',array('students'=>$students,'model'=>$model)); ?>
