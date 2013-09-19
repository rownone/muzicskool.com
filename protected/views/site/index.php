<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<br>
<hr>
<h2>Web Application: <?php echo $leads;?></h2>
<br>
<hr>
<h2>Contacts: <?php echo $contacts;?></h2>