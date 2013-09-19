<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>
<h1>Band Details</h1>
<br>
<div class="row">
    <label class="required" for="band">Band <span class="required">*</span></label>
    <input disabled type="text" id="band" name="band" maxlength="255" size="60">
    <?php echo "<input id='enrollment_id' name='enrollment_id' type='hidden' value='' />"?>
    <a id="browse-band" href="javascript:;">Browse</a>
</div>

<br/>
<div class="row">
    <input name="display-report" id="display-schedule" value="Display Schedule" type="button" />
    <input style="display:none;" type="button" value="Print" id="print" name="print" onclick="PrintElem('#for-print')">
</div>
<div class="clear"><br></div>
<h2 style="margin-bottom:0px">Schedule</h2>
<?php
$scheduleColumns = array(
    'date_schedule',
    array(
        'name'=>'studio_id',
        'value'=>'$data->studio->name',
    ),
    array(
        'name'=>'start_time',
        'value'=>'date("g:i a", strtotime($data->start_time))',
    ),
    array(
        'name'=>'end_time',
        'value'=>'date("g:i a", strtotime($data->end_time))',
    ),
);
?>
<div id="for-print">
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-schedule-grid',
    'dataProvider'=>$classSchedule->search(),
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>$scheduleColumns,
    'summaryText'=>'',    
));?>
</div>
<?php $this->renderPartial('_browse',array('enrollment'=>$enrollment)); ?>


<script type="text/javascript">
$(document).ready(function() {
    $('#display-schedule').click(function(){
        $('#print').show();
        $('#loading').show();
        $.fn.yiiGridView.update('class-schedule-grid',{
            data:{
                enrollment_id:$('#enrollment_id').val(),
            },complete: function(jqXHR, status) {
                $('#loading').hide();
            }

        });
    });
    
});
</script>

<script type="text/javascript">
    /*<![CDATA[*/
    function PrintElem(elem)
    {
        var html = '';
        html = "<h4>Name: "+$('#band').val()+"</h4>"; 
        Popup(html+$(elem).html());
    }

    /*function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<link rel="stylesheet" media="print" href="<?php echo Yii::app()->baseUrl . '/css/grid.css';?>" type="text/css" />');
        mywindow.document.write(data);
        mywindow.print();
        mywindow.close();

        return true;
    }*/

    function Popup(data) 
    {
        var mywindow = window.open('<?php echo Yii::app()->createUrl( 'site/print' )?>', 'my div', 'height=400,width=600');

        mywindow.addEventListener('load', function(){
            $(mywindow.document).find('body').find('div#print').append(data);
             mywindow.print();
             mywindow.close();
        }, true);
       
        return true;
    }
    /*]]>*/
</script>