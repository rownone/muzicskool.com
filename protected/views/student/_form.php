<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/webcam.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.webcam.js"></script>
<script>
var url_jscam_canvas_only = '<?php echo Yii::app()->request->baseUrl; ?>/swf/jscam_canvas_only.swf';
var url_upload_photo = '<?php echo Yii::app()->createUrl( '/photo/upload' ); ?>';
var PHOTO = 'Student_photo1';
var PHOTO2 = 'Student_photo2';
</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'middle_name'); ?>
		<?php echo $form->textField($model,'middle_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'middle_name'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'birthdate'); ?>
		<?php echo $form->textField($model,'birthdate'); ?>
		<?php echo $form->error($model,'birthdate'); ?><b id="age"></b>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'contact_number'); ?>
		<?php echo $form->textField($model,'contact_number',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'contact_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_address'); ?>
		<?php echo $form->textField($model,'home_address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model, 'photo'); ?>
        <?php echo $form->fileField($model, 'photo'); ?>
        <?php echo $form->error($model, 'photo'); ?><br>
        <span>&nbsp;OR&nbsp;</span><br>
        <input type="button" value="Take a picture" id="takepicture" name="takepicture">
        <span id="taken-pic"></span>
	</div>
    <!--<input type="hidden" value="<?php echo !$model->isNewRecord ?$model->photo : '';?>" id="Student_photo1" name="Student[photo1]" />-->
    <input type="hidden" value="<?php echo !$model->isNewRecord ?'upload' : 'camera';?>" id="Student_photo_source" name="Student[photo_source]" />
    <input type="hidden" value="<?php echo !$model->isNewRecord ?$model->photo : '';?>" id="Student_photo2" name="Student[photo2]" />
    <p id="v" style="display: none;"></p>
    <?php /*?>
    <div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php //echo $form->dropDownList($model,'group_id',array('size'=>50, 'cols'=>50)); ?>
        <?php //$form->dropDownList($model,'group_id',array('1'=>'men','2'=>'women'), array('options' => array('2'=>array('selected'=>true)))); ?>
        <?php echo $form->dropDownList($model,'group_id',CHtml::listData(Group::model()->findAll(), 'id', 'name'),  array('empty'=>'') ); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>
    <?php */?>
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

<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;left: 303px;width: 723px;">
    <a title="Close" class="mCloseImg"></a>
    <div id="result">
        <h3 style="width: 170px; margin-bottom: 0px;">Available Cameras</h3>
        <ul style="margin-bottom: 0px;" id="cams"></ul>

        <p id="status" style="height:22px; color:#c00;font-weight:bold;margin-bottom: 0px;margin-top: 0px;"></p>

        <div id="webcam" style="float:left;margin-bottom: 10px;">
            <!--<img src="/image/antenna.png" alt="" />-->
            <span>Photo</span>
        </div>
        <div style="float:left;">
        <p style="margin-top:1px;"><canvas id="canvas" height="240" width="320"></canvas></p>
        </div>
        <div class="clear"></div>
        <p style="width:360px;text-align:center;font-size:12px;margin-top: 0;float:left;">
            <a href="javascript:webcam.capture(3);changeFilter();void(0);">Take a picture after 3 seconds</a> | 
            <a href="javascript:webcam.capture();changeFilter();void(0);">Take a picture instantly</a>
        </p>
        <p style="width:360px;text-align:center;font-size:12px;margin-top: 0;float:left;">
            <a id="cam-done" href="javascript:;">Done</a> |
            <a id="cam-cancel" href="javascript:;">Cancel</a>
        </p>
        
        <div class="clear"></div>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/z/webcam.js"></script>
        
        
    </div>
</div>
<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
    var dateToday = new Date();
    $( '#Student_birthdate' ).datepicker({maxDate: dateToday,buttonImageOnly: 'both',showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});
      
    $(\"input:file\").change(function (){
       $(\"#Student_photo_source\").val('upload');
    });
     
    $('.mCloseImg').click(function(){
        $('#Student_photo1').val(''); //clear captured pic
        $('#bakz').hide();
        $('#popup-select-student').hide();
        $('#taken-pic').html('');
        return false;
    });
    
    $('#cam-done').click(function(){
        $('#bakz').hide();
        $('#popup-select-student').hide();
        $('#taken-pic').html($('#Student_photo1').val());
        $(\"#Student_photo_source\").val('camera');
        return false;
    });
    
    $('#cam-cancel').click(function(){
        $('#Student_photo1').val(''); //clear captured pic
        $('#bakz').hide();
        $('#popup-select-student').hide();
        $('#taken-pic').html('');
        $(\"#Student_photo_source\").val('upload');
        return false;
    });
    
    $('#Student_birthdate').change(function(){
        var age = calcAge($('#Student_birthdate').val());
        $('#age').html(parseInt(age)+' yrs old');
    });
    function calcAge(dateString) {
        var birthday = +new Date(dateString);
        return ((Date.now() - birthday) / (31557600000));
    }
    var age = calcAge($('#Student_birthdate').val());
    $('#age').html(parseInt(age)+' yrs old');
");


?>