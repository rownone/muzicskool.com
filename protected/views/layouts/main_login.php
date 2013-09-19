

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/apple-login/styles.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    	

    </head>
    
    <body>
        

        
        <?php echo $content; ?>
        <footer>
	        <h2>Copyright © 2013 by <i>Muzic'skool.com</i></h2>
            <a href="http://tutorialzine.com/2012/02/apple-like-login-form/" class="tzine">All Rights Reserved.</a>
        </footer>
        <!-- JavaScript includes -->
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/script.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.yiiactiveform.js"></script>
    </body>
</html>




