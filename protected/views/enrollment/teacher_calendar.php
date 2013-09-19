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
        events:"<?php echo Yii::app()->createUrl( 'enrollment/getTeacherCalendar' ).'&teacher_id='?>"+$('#teacher_id').val(),
        eventDrop: function(event, delta) {
            alert(event.title + ' was moved ' + delta + ' days\n' +
                '(should probably update your database)');
        },
        loading: function(bool) {
            if (bool) $('#loading').show();
            else $('#loading').hide();
        },
        eventClick: function(calEvent, jsEvent, view) {
            if(calEvent.taken==1)return;
            var id = calEvent.id.split('-');
            var data = calEvent.title.split(' - ');
            var yyyy = calEvent.start.getFullYear();
            var mm = (calEvent.start.getMonth()+1);
            var dd = calEvent.start.getDate();
            if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
            var today = yyyy+'-'+mm+'-'+dd;
            
            $('#teacher_schedule_id').val(id[1]);
            $('#ClassSchedule_start_time').val(data[0]);
            $('#ClassSchedule_end_time').val(data[1]);
            $('#ClassSchedule_date_schedule').val(today);
            
            // change the border color just for fun
            $(this).css('border-color', 'red');
            setTimeout(function(){
               $('#popup-teacher-calendar').hide();
               $('#popup-teacher-calendar #result').html('');
            },100);
            
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


<div id='calendar'></div>