<?php 
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/cupertino/theme.css");
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.css");
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.print.css");
    
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/jquery-1.9.1.min.js");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/jquery-ui-1.10.2.custom.min.js");
    //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.min.js");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.js");
?>
<?php
    $url = Yii::app()->createUrl( 'classSchedule/getCalendar' );
    $calendarTitle = Yii::app()->name;
    if(isset($_REQUEST['studio_id'])){
        $url .="&studio_id=".$_REQUEST['studio_id'];
        $calendarTitle = ucwords($model->name);
    }elseif (isset($_REQUEST['teacher_id'])) {
        $url .="&teacher_id=".$_REQUEST['teacher_id'];
        $calendarTitle = ucwords($model->name);
    }elseif (isset($_REQUEST['enrollment_id'])) {
        $url .="&enrollment_id=".$_REQUEST['enrollment_id'];
        $calendarTitle = ucwords($model->ref_name);
    }
?>
<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        theme: true,
        editable: true,
        events:"<?php echo $url;?>",
        eventDrop: function(event, delta) {
        },
        loading: function(bool) {
            if (bool) $('#loading').show();
            else $('#loading').hide();
        },
        eventClick: function(calEvent, jsEvent, view) {
            
        }
    });
});

</script>
<style>
	#calendar {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        width: 900px;
		margin: 0 auto;
	}		
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
	}
	
</style>

<h1><?php echo $calendarTitle;?> Calendar</h1>

<div id='calendar'></div>