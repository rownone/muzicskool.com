<?php 
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/cupertino/theme.css");
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.css");
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.print.css");
    
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/jquery-1.9.1.min.js");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/jquery-ui-1.10.2.custom.min.js");
    //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.min.js");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.js");
?>

<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        theme: true,
        editable: true,
        //events: "json-events.php",
        events:"<?php echo Yii::app()->createUrl( 'classSchedule/getStudioCalendar' ).'&studio_id='.$studio->id?>",
        eventDrop: function(event, delta) {
            alert(event.title + ' was moved ' + delta + ' days\n' +
                '(should probably update your database)');
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
	}		
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
	}
	#calendar {
		width: 900px;
		margin: 0 auto;
	}
</style>

<h1><?php echo ucwords($studio->name);?> Calendar</h1>

<div id='calendar'></div>