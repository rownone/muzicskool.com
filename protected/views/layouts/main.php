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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/musical-menu/css/menu.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/redmond/jquery-ui-1.10.3.custom.min.css" />
    

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<style>
	.menu-holder {
	font-weight:bold;
	height:40px;
	background: rgb(149,149,149); /* Old browsers */
background: -moz-linear-gradient(top, rgba(149,149,149,1) 0%, rgba(13,13,13,1) 46%, rgba(1,1,1,1) 50%, rgba(10,10,10,1) 53%, rgba(78,78,78,1) 76%, rgba(56,56,56,1) 87%, rgba(27,27,27,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(149,149,149,1)), color-stop(46%,rgba(13,13,13,1)), color-stop(50%,rgba(1,1,1,1)), color-stop(53%,rgba(10,10,10,1)), color-stop(76%,rgba(78,78,78,1)), color-stop(87%,rgba(56,56,56,1)), color-stop(100%,rgba(27,27,27,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#959595', endColorstr='#1b1b1b',GradientType=0 ); /* IE6-9 */
	}
	
		/* keyframes #animation */
@-webkit-keyframes animation {
    0% {
        -webkit-transform: scale(1);
    }
    30% {
        -webkit-transform: scale(1.2);
    }
    100% {
        -webkit-transform: scale(1.1);
    }
}
@-moz-keyframes animation {
    0% {
        -moz-transform: scale(1);
    }
    30% {
        -moz-transform: scale(1.2);
    }
    100% {
        -moz-transform: scale(1.1);
    }
}
nav  li > a:hover {
    /* CSS3 animation */
    -webkit-animation-name: animation;
    -webkit-animation-duration: 0.3s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: 1;
    -webkit-animation-direction: normal;
    -webkit-animation-delay: 0;
    -webkit-animation-play-state: running;
    -webkit-animation-fill-mode: forwards;

    -moz-animation-name: animation;
    -moz-animation-duration: 0.3s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: 1;
    -moz-animation-direction: normal;
    -moz-animation-delay: 0;
    -moz-animation-play-state: running;
    -moz-animation-fill-mode: forwards;
}


nav ul ul {
	display: none;
}

	nav ul li:hover > ul {
		display: block;
	}

nav ul {
	background: rgb(149,149,149); /* Old browsers */
background: -moz-linear-gradient(top, rgba(149,149,149,1) 0%, rgba(13,13,13,1) 46%, rgba(1,1,1,1) 50%, rgba(10,10,10,1) 53%, rgba(78,78,78,1) 76%, rgba(56,56,56,1) 87%, rgba(27,27,27,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(149,149,149,1)), color-stop(46%,rgba(13,13,13,1)), color-stop(50%,rgba(1,1,1,1)), color-stop(53%,rgba(10,10,10,1)), color-stop(76%,rgba(78,78,78,1)), color-stop(87%,rgba(56,56,56,1)), color-stop(100%,rgba(27,27,27,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#959595', endColorstr='#1b1b1b',GradientType=0 ); /* IE6-9 */
	box-shadow: 0px 0px 9px rgba(0,0,0,0.15);
	padding: 0 10px;
	/* border-radius: 10px;   */
	list-style: none;
	position: relative;
	display: inline-table;
}
	nav ul:after {
		content: ""; clear: both; display: block;
	}

	nav ul li {
		float: left;
	}
		nav ul li:hover {
			background:#323232;
		}
			nav ul li:hover a {
				color: #fff;
				background: rgb(243,197,189); /* Old browsers */
background: -moz-linear-gradient(top, rgba(243,197,189,1) 0%, rgba(232,108,87,1) 50%, rgba(234,40,3,1) 51%, rgba(255,102,0,1) 75%, rgba(199,34,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(243,197,189,1)), color-stop(50%,rgba(232,108,87,1)), color-stop(51%,rgba(234,40,3,1)), color-stop(75%,rgba(255,102,0,1)), color-stop(100%,rgba(199,34,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(243,197,189,1) 0%,rgba(232,108,87,1) 50%,rgba(234,40,3,1) 51%,rgba(255,102,0,1) 75%,rgba(199,34,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(243,197,189,1) 0%,rgba(232,108,87,1) 50%,rgba(234,40,3,1) 51%,rgba(255,102,0,1) 75%,rgba(199,34,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(243,197,189,1) 0%,rgba(232,108,87,1) 50%,rgba(234,40,3,1) 51%,rgba(255,102,0,1) 75%,rgba(199,34,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(243,197,189,1) 0%,rgba(232,108,87,1) 50%,rgba(234,40,3,1) 51%,rgba(255,102,0,1) 75%,rgba(199,34,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f3c5bd', endColorstr='#c72200',GradientType=0 ); /* IE6-9 */
			}
		
		nav ul li a {
			display: block; padding: 12px 20px;
			color: #eee; text-decoration: none;
		}
			
		
	nav ul ul {
		border-radius: 0px; 
		padding: 0;
		position: absolute; top: 100%;
	}
		nav ul ul li {
			float: none; 
			border-top: 1px solid #333333;
			/* border-bottom: 1px solid #333333; */ 
			position: relative;
			width:160px;
		}
			nav ul ul li a {
				padding: 10px 20px;
				color: #fff;
			}	
				nav ul ul li a:hover {
					background: rgb(149,149,149); /* Old browsers */
background: -moz-linear-gradient(top, rgba(149,149,149,1) 0%, rgba(13,13,13,1) 46%, rgba(1,1,1,1) 50%, rgba(10,10,10,1) 53%, rgba(78,78,78,1) 76%, rgba(56,56,56,1) 87%, rgba(27,27,27,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(149,149,149,1)), color-stop(46%,rgba(13,13,13,1)), color-stop(50%,rgba(1,1,1,1)), color-stop(53%,rgba(10,10,10,1)), color-stop(76%,rgba(78,78,78,1)), color-stop(87%,rgba(56,56,56,1)), color-stop(100%,rgba(27,27,27,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(149,149,149,1) 0%,rgba(13,13,13,1) 46%,rgba(1,1,1,1) 50%,rgba(10,10,10,1) 53%,rgba(78,78,78,1) 76%,rgba(56,56,56,1) 87%,rgba(27,27,27,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#959595', endColorstr='#1b1b1b',GradientType=0 ); /* IE6-9 */
				}
		
	nav ul ul ul {
		position: absolute; left: 100%; top:0;
	}
	</style>
	
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<?php /*?><div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div><?php */?>
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"/>
	</div><!-- header -->

<div class="menu-holder">
	<nav>
		<?php $this->widget('zii.widgets.CMenu',array('id'=>'mainmenu3',
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Enrollment', 'url'=>array('/enrollment/admin'), 'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Individual','url'=>array('/enrollment/individual'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Group','url'=>array('/enrollment/group'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Band Rehearsal','url'=>array('/enrollment/band'),'visible'=>!Yii::app()->user->isGuest),
					),
				),
                array('label'=>'Payment', 'url'=>array('/payment/admin'), 'visible'=>!Yii::app()->user->isGuest,
                    'items'=>array(
						array('label'=>'Create','url'=>array('/payment/create'),'visible'=>!Yii::app()->user->isGuest),
					),
                ),
                array('label'=>'Calendar', 'url'=>array('/classSchedule/calendar'), 'visible'=>!Yii::app()->user->isGuest,
                    'items'=>array(
						array('label'=>'Daily Class','url'=>array('/classSchedule/daily4'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Daily Band','url'=>array('/classSchedule/dailyBand'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Monthly','url'=>array('/classSchedule/calendar'),'visible'=>!Yii::app()->user->isGuest),
					),
                ),
                array('label'=>'Library', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Student', 'url'=>array('/student/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Group', 'url'=>array('/group/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Band', 'url'=>array('/band/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Teacher', 'url'=>array('/teacher/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Course', 'url'=>array('/course/admin'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Studio', 'url'=>array('/studio/admin'), 'visible'=>!Yii::app()->user->isGuest),
					),
				),
                
                array('label'=>'Report', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest,
                    'items'=>array(
                        array('label'=>'Daily Class Schedule','url'=>array('/classSchedule/dailySchedule4'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Daily Band Schedule','url'=>array('/classSchedule/dailyBandSchedule'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Payment','url'=>array('/payment/reports'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Teacher','url'=>array('/teacher/salary'),'visible'=>!Yii::app()->user->isGuest,
                            'items'=>array(
                                array('label'=>'Schedule','url'=>array('/teacher/summary/'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Salary','url'=>array('/teacher/salary'),'visible'=>!Yii::app()->user->isGuest),
                            ),                            
                        ),
                        array('label'=>'Student','url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest,
                            'items'=>array(
                                array('label'=>'Details','url'=>array('/student/summary/'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Accounts','url'=>array('/student/accounts'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Attendance','url'=>array('/student/attendance/'),'visible'=>!Yii::app()->user->isGuest),
                            ),                            
                        ),
                        array('label'=>'Group','url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest,
                            'items'=>array(
                                array('label'=>'Details','url'=>array('/group/summary/'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Accounts','url'=>array('/group/accounts'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Attendance','url'=>array('/group/attendance/'),'visible'=>!Yii::app()->user->isGuest),
                            ),                            
                        ),
                        array('label'=>'Band','url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest,
                            'items'=>array(
                                array('label'=>'Details','url'=>array('/band/summary/'),'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'Accounts','url'=>array('/band/accounts'),'visible'=>!Yii::app()->user->isGuest),
                            ),                            
                        ),
					),
                ),
                array('label'=>'Form', 'url'=>array('/contact/admin'), 'visible'=>!Yii::app()->user->isGuest,
                    'items'=>array(
						array('label'=>'Contact','url'=>array('/contact/'),'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Assessment','url'=>array('/contact/assessment'),'visible'=>!Yii::app()->user->isGuest),
					),
                ),
                array('label'=>'User', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->User->isAdmin()),
				array('itemOptions'=>array('style'=>'width:auto;'), 'label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 
                    'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</nav>
</div><!-- mainmenu -->
	<div class="clear"><br></div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->name); ?><br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/css/musical-menu/js/script.js"></script>
<div style="display: none;height: 16px;left: 44%;position: fixed;top: 50%;width: 128px;z-index: 99999;" id="loading">
	<div style="text-align: center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader.gif"></div>
</div>
</body>
</html>
