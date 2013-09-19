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
        $group = $model->isNewRecord ? '': $model->group->name;
        $group_id = $model->isNewRecord ? '': $model->group_id;
        $ref_name = $model->isNewRecord ? '': $model->ref_name;
    ?>
	<?php echo $form->errorSummary($model); ?>
        <?php echo "<input id='enrollment_type_id' name='Enrollment[enrollment_type_id]' type='hidden' value='$model->enrollment_type_id' />"?>
        <div class="row">            
            <?php echo $form->labelEx($model,'group_id'); ?>
            <input disabled type="text" value='<?php echo $group;?>' id="Enrollment_group" name="Enrollment[group]" maxlength="255" size="60">
            <?php echo "<input id='group_id' name='Enrollment[group_id]' type='hidden' value='$group_id' />"?>
            <a id="add-group" href="javascript:;">Browse</a>
            <?php echo $form->error($model,'group_id'); ?>
        </div>        
        
        <?php echo "<input id='ref_name' name='Enrollment[ref_name]' type='hidden' value='$ref_name' />"?>
        <div class="row" style="display:<?php echo $lockCourse==true?'none':'block'?>">
            <?php echo $form->labelEx($model,'course_id'); ?>
            <?php echo $form->dropDownList($model,'course_id',CHtml::listData($course, 'id', 'name') ); ?>
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

<?php $this->renderPartial('_browse_group',array('groups'=>$groups,'model'=>$model)); ?>
