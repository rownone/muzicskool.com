<?php 
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/cupertino/theme.css");
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.css");
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.print.css");
    
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/jquery-1.9.1.min.js");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/jquery-ui-1.10.2.custom.min.js");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/vendor/fullcalendar/fullcalendar.js");
?>
<style>
.takeit .fc-event-inner{
	background-color:#899AAA !important;
    color: #000000 !important;
}

</style>
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
        next:function(){
            alert('ssss');
        },
        loading: function(bool) {
            if (bool) $('#loading').show();
            else $('#loading').hide();
        },
        eventClick: function(calEvent, jsEvent, view) {
            if(calEvent.taken==1)return;
            if($('#popup-select-studio').is(':visible')){
                alert('Please select studio');
                return false;
            }
            var obj = this;
            if($(this).attr('class').indexOf('takeit')>-1){
                var id = $(this).attr('id');
                $('#tmp-class-schedule-grid .items tbody tr#tr'+id).remove();
                $(this).removeClass('takeit');
                $('#c').val($('#tmp-class-schedule-grid tbody tr').length);
                return false;
            }
            
            var id = calEvent.id.split('-');
            var data = calEvent.title.split(' - ');
            var yyyy = calEvent.start.getFullYear();
            var mm = (calEvent.start.getMonth()+1);
            var dd = calEvent.start.getDate();
            if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} 
            var today = yyyy+'-'+mm+'-'+dd;

            var teacher_schedule_id = id[1];
            var start_time = data[0];
            var end_time = data[1];
            var date_schedule = today;
            $.post('<?php echo Yii::app()->createUrl( 'enrollment/studioCalendar' ) ?>',
                {
                    date_schedule : date_schedule,
                    start_time : start_time,
                    end_time : end_time,
                },
                function(data){
                    $('#loading').show();
                    $('#popup-select-studio #result').html(data);
                    $('#popup-select-studio').show();
                    $('#loading').hide();

                    $('.open .a-studio').click(function(){
                        $(obj).addClass('takeit');
                        var exit = false;
                        $('#tmp-class-schedule-grid tbody tr .teacher_schedule_id').each(function(){
                            var tr_date_schedule = $(this).parent().find('.date_schedule').val();
                            if($(this).val() == teacher_schedule_id && tr_date_schedule==date_schedule){                                
                                exit = true;
                                return false;
                            }
                        });
                        if(exit){                            
                            $('#popup-select-studio').hide();
                            return false;
                        }
                        
                        var ClassSchedule_studio = $(this).html();
                        $('#popup-select-studio').hide();
                        var cls = $('#tmp-class-schedule-grid tr').length % 2 >0 ?'odd':'even';
                        cls = "";
                        var d = new Date();
                        var n = d.getTime();
                        var val = '<input type="hidden" class="teacher_schedule_id" name="teacher_schedule_id[]" value="'+teacher_schedule_id+'"/>'+
                        '<input type="hidden" name="studio_id[]" value="'+$(this).attr('id')+'"/>'+
                        '<input type="hidden" name="start_time[]" value="'+start_time+'"/>'+
                        '<input type="hidden" name="end_time[]" value="'+end_time+'"/>'+
                        '<input class="date_schedule" type="hidden" name="date_schedule[]" value="'+date_schedule+'"/>';

                        $('#tmp-class-schedule-grid tbody')
                                .append('<tr id="tr'+n+'" class="'+cls+
                                '"><td>'+ClassSchedule_studio+'</td><td>'+
                                date_schedule+'</td><td>'+
                                start_time+'</td><td>'+
                                end_time+'</td><td style="text-align:center;"><a href="javascript:;" id="'+n+
                                '"><img alt="Delete" src="<?php echo Yii::app()->request->baseUrl;?>/images/delete.png"></a>'+val+'</td></tr>');
                        $('#'+n).click(function(){
                            $('#tr'+$(this).attr('id')).remove();
                            $('#c').val($('#tmp-class-schedule-grid tbody tr').length);
                        });
                        $('#c').val($('#tmp-class-schedule-grid tbody tr').length);
                        $(obj).attr('id',n);
                    });
            });
        }
    });
    $('#close-calendar').click(function(){
        $('#popup-teacher-calendar').hide();
        $('#popup-teacher-calendar #result').html('');
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

<input style="float:right" type="button" value="Done" id="close-calendar" name="close-calendar">