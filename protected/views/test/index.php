<?php
/* @var $this TestController */
/*
$this->breadcrumbs=array(
	'Test',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

 <div class="form">
        <?php echo CHtml::beginForm(); ?>
     <div class="field-row">
		<div class="label"><label>Birthday</label></div>
		<div class="fields">
			<?php $this->widget('DateDropdownsWidget', array(
					'monthName' => '',
					'dayName' => '',
					'yearName' => '',
					'monthSelected' => '',
					'daySelected' => '',
					'yearSelected' => '',
					'reverseYear' => true,
					'addEmptyValues' => true,
				)); ?>
			<?php //echo CHtml::activeTextArea($editProfileForm, 'bio', array('maxlength' => 180, 'rows' => '2', 'cols' => '30')); ?>
		</div>
	</div>
        <table>
        <tr><th>id</th><th>group_id</th><th>student_id</th></tr>
        <?php foreach($items as $i=>$item): ?>
        <tr>
        <td><?php //echo CHtml::activeTextField($item,"[$i]id"); ?></td>
        <td><?php //echo CHtml::activeTextField($item,"[$i]group_id"); ?></td>
        <td><?php //echo CHtml::activeTextField($item,"[$i]student_id"); ?></td>
        </tr>
        <?php endforeach; ?>
        </table>

        <?php echo CHtml::submitButton('Save'); ?>
        <?php echo CHtml::endForm(); ?>
        </div><!-- form -->
        
<?php */?>

<?php
/**
 *
 * @author Shiki
 * @link http://twidl.it/
 * @copyright Copyright &copy; 2009-2010 Twidl, Inc.
 * @license http://twidl.it/license/
 * @version 1.0
 * @package system
 * @since 1.0
 *
 * @history
 *
 * @notes
 */
$baseUrl = Yii::app()->getRequest()->getBaseUrl();
// 3 = debug
// 4 = prod
//$flashVars = array('mode' => (Yii::app()->params[Application::PARAM_DEV_MODE] ? 3 : 4));
$flashVars = array('mode' => 3 );
?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/js/swfobject.js"></script>
<div id="cup-camera-upload-wrap">
	<div id="cup-camera-upload"></div>
</div>
<script type="text/javascript">

	swfobject.embedSWF("<?php echo Yii::app()->request->baseUrl ?>/swf/camera-upload.swf", "cup-camera-upload", "540", "260", "9.0.0", "", <?php echo CJSON::encode($flashVars); ?>);

</script>