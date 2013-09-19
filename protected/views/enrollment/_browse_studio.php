
<div id="popup-select-studio" class="modalz" style="display:none;">
    <a id="close-browse-studio" title="Close" class="mCloseImg"></a>
    <?php /*?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'studio-grid',
        'dataProvider'=>$studio->search(),
        'ajaxUrl'=>Yii::app()->createUrl( 'enrollment/searchStudio' ),
        'filter'=>$studio,
        'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
        'columns'=>array(
             array
            (
                'header'=>'Select', // add headers this way
                'class'=>'CButtonColumn',
                'template'=>'{add}',
                'buttons'=>array
                (
                    'add' => array
                    (
                        'label'=>'Select',
                        'click'=>"function(){
                            $('#studio_id').val($(this).attr('href'));
                            var name = $(this).parent().parent().find('td:nth(1)').html();
                            $('#ClassSchedule_studio').val(name);

                            $('#popup-select-studio').hide();
                            return false;
                            }
                         ", 
                        'url'=>'$data->primaryKey',
                    ),                
                ),
            ),
            'name',
        ),
    )); ?>
    <?php */?>
    <div id="result"></div>
</div>

<?php
Yii::app()->clientScript->registerScript('browse_studio', "

if($('#ClassSchedule_date_schedule').val()==''){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = yyyy+'-'+mm+'-'+dd;
    $('#ClassSchedule_date_schedule').val(today);
}
function IsValidTime(timeStr) {
    // Checks if time is in HH:MM:SS AM/PM format.
    // The seconds and AM/PM are optional.
    var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;
    var matchArray = timeStr.match(timePat);
    if (matchArray == null) {
        alert('Time is not in a valid format.');
        return false;
    }
    return true;
}

function isValidDate2(s) {
  var bits = s.split('-');
  var y = bits[0], m  = bits[1], d = bits[2];
  // Assume not leap year by default (note zero index for Jan)
  var daysInMonth = [31,28,31,30,31,30,31,31,30,31,30,31];

  // If evenly divisible by 4 and not evenly divisible by 100,
  // or is evenly divisible by 400, then a leap year
  if ( (!(y % 4) && y % 100) || !(y % 400)) {
    daysInMonth[1] = 29;
  }
  return d <= daysInMonth[--m]
}

$('#browse-studio').click(function(){
    
    if(!isValidDate2($('#ClassSchedule_date_schedule').val())){
        alert('Please select date');
        $('#ClassSchedule_date_schedule').focus();
        return false;
    }
    var startTime = $('#ClassSchedule_start_time').val();
    var endTime = $('#ClassSchedule_end_time').val();
    if(!IsValidTime(startTime)){
        $('#ClassSchedule_start_time').focus();
        $('#ClassSchedule_start_time').select();
        return false;
    }
    
    if(!IsValidTime(endTime)){
        $('#ClassSchedule_end_time').focus();
        $('#ClassSchedule_end_time').select();
        return false;
    }
    
    var regExp = /(\d{1,2})\:(\d{1,2})\:(\d{1,2})/;
    if(parseInt(endTime.replace(regExp, '$1$2$3')) < parseInt(startTime.replace(regExp, '$1$2$3'))){
        $('#ClassSchedule_end_time').focus();
        $('#ClassSchedule_end_time').select();
        alert('End Time must be greater Start Time');
        return false;
    }
   
    $.post('".Yii::app()->createUrl( 'enrollment/studioCalendar' )."',
        {
            date_schedule:$('#ClassSchedule_date_schedule').val(),
            start_time:$('#ClassSchedule_start_time').val(),
            end_time:$('#ClassSchedule_end_time').val(),
        },
        function(data){
            $('#loading').show();
            $('#popup-select-studio #result').html(data);
            $('#popup-select-studio').show();
            $('#loading').hide();
            
            $('.open .a-studio').click(function(){
                $('#ClassSchedule_studio').val($(this).html());
                $('#studio_id').val($(this).attr('id'));
                $('#popup-select-studio').hide();
            });
    });

});

$('#close-browse-studio').click(function(){
    $('#popup-select-studio').hide();
});

");
?>