<?php
/* @var $this PhotoController */

$this->breadcrumbs=array(
	'Photo',
);
?>


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/webcam.css" />
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.webcam.js"></script>
<script>
var url_jscam_canvas_only = '<?php echo Yii::app()->request->baseUrl; ?>/swf/jscam_canvas_only.swf';
var url_upload_photo = '<?php echo Yii::app()->createUrl( '/photo/upload' ); ?>';
</script>

<p id="status" style="height:22px; color:#c00;font-weight:bold;"></p>

<div id="webcam" style="float:left;">
    <!--<img src="/image/antenna.png" alt="" />-->
    <span>Photo</span>
</div>
<div style="float:left;">
<p style="margin-top:1px;"><canvas id="canvas" height="240" width="320"></canvas></p>
</div>
<p style="width:360px;text-align:center;font-size:12px">
    <a href="javascript:webcam.capture(3);changeFilter();void(0);">Take a picture after 3 seconds</a> | 
    <a href="javascript:webcam.capture();changeFilter();void(0);">Take a picture instantly</a>
</p>

<h3>Available Cameras</h3>

<ul id="cams"></ul>

<div class="clear"></div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/z/webcam.js"></script>


