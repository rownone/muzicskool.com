<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
   <style>
    @media print
    {
        body {line-height:1.5;font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;color:#000;background:none;font-size:10pt;}
        table{
            width:100%
        }
        th, td
        {
            border: 1px solid #98BF21;
        }
    }
    @media screen
    {
        body {line-height:1.5;font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;color:#000;background:none;font-size:10pt;}
        table{
            width:100%
        }
        th, td
        {
            border: 1px solid #98BF21;
        }
    }
   </style>
</head>

<body>
    <div id="header">
		        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" style=' width: 130px !important;'>
	</div>
<?php echo $content; ?>
</body>
</html>
