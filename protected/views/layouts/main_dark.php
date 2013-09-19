<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/redmond/jquery-ui-1.10.3.custom.min.css" />
    
    <style>
        body{
            background: url("http://www.muzicskool.com/wp-content/themes/sound_rock/images/pattern/pattern1-bg.png") repeat scroll 0 0 transparent;
        }
        #page{
            border: medium none !important;padding: 20px;width: 100%;background: url("http://www.muzicskool.com/wp-content/themes/sound_rock/images/pattern/pattern1-bg.png") repeat scroll 0 0 transparent;
        }
        .row label{
            float: left;
            padding: 6px 0;
            width: 130px;display: block;
            font-size: 13px;
            font-weight: bold;
            color: #999999;
        }
        div.form div.success input, div.form div.success textarea, div.form div.success select, div.form input.success, div.form textarea.success, div.form select.success {
            background: none repeat scroll 0 0 #0E0E0E;
            border-color: #0B0B0B;
        }
        div.form .errorMessage {
            color: red;
        }
        .row input[type="text"], .row textarea, .row select{
            background: none repeat scroll 0 0 #0E0E0E;
            border: 1px solid #0B0B0B;
            border-radius: 2px 2px 2px 2px;
            box-shadow: 1px 1px 2px #000000 inset;
            color: #FD4239 !important;
            display: block;
            font: 12px "HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif;
            margin: 0 0 10px;
            max-width: 100%;
            outline: medium none;
            padding: 10px;
            width: 340px;
        }
        .cmd {
            background: none repeat scroll 0 0 #2B2B2B;
            background-color: #FD4239 !important;
            border: medium none;
            border-radius: 3px 3px 3px 3px;
            box-shadow: 0 1px 1px #3F3F3F inset;
            color: #FFFFFF !important;
            cursor: pointer;
            display: inline-block;
            font-family: Oswald,sans-serif;
            font-weight: bold;
            font-size: 12px;
            height: 31px;
            line-height: normal;
            padding: 0 20px;
            text-transform: uppercase;
        }
        .h1-dark{
            color:#FD4239 !important;    -moz-box-sizing: border-box;
            font-size: 24px;
            padding: 0 0 20px;
            text-transform: uppercase;
            width: 100%;
            font-family: Oswald,sans-serif;
            font-weight: bold;
            text-shadow: 1px 1px #000000;
        }
        .flash-success{
            width: 92%;
        }
    </style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style='' >

<div class="container" id="page" style=' '>


	<?php echo $content; ?>

	<div class="clear"></div>


</div><!-- page -->

</body>
</html>
