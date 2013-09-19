<div id="popup-teacher-calendar" class="modalz" style="display:none; left: 219px;top: 14px;width:auto;position: absolute;">
    <a id="close-teacher-calendar" title="Close" class="mCloseImg"></a>
    <h1>Teacher Calendar</h1>
    <div id="result"></div>
</div>
<?php
Yii::app()->clientScript->registerScript('browse_teacher_calendar', "
$('#browse-teacher-calendar').click(function(){
    $.post('".Yii::app()->createUrl( 'enrollment/teacherCalendar' )."',
        {d:$('#ClassSchedule_class_date').val()},
        function(data){
        $('#loading').show();
        $('#popup-teacher-calendar #result').html(data);
        $('#popup-teacher-calendar').show();
        $('#loading').hide();
    });
    
});

$('#close-teacher-calendar').click(function(){
    $('#popup-teacher-calendar').hide();
    $('#popup-teacher-calendar #result').html('');
});

");
?>