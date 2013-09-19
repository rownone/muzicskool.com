<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<h1>Daily Schedule</h1>
<div class="row">
    <label class="required" for="group">Date <span class="required">*</span></label>
    <input  type="text" id="date1" name="date1" value="<?php echo $date1?>" size="20">
    <input name="search" id="search" value="Search" type="button" />
    <input name="print" id="print" value="Print" type="button" onclick="PrintElem('#for-print')" />
</div>
<br>
<?php
$scheduleColumns = array(
    //'date_schedule',
    /*array(
        'name'=>'teacher_id',
        'value'=>'$data->teacher->name',
    ),*/
    array(
        'name'=>'start_time',
        'value'=>'date("g:i a", strtotime($data->start_time))',
    ),
    array(
        'name'=>'end_time',
        'value'=>'date("g:i a", strtotime($data->end_time))',
    ),
    array(
        'name'=>'enrollment_id',
        'header'=>'Name/Group/Band',
        'value'=>'$data->enrollment->ref_name',
    ),
    array(
        'name'=>'studio_id',
        'value'=>'$data->studio->name',
    ),
    array(
        'name'=>'teacher_id',
        'value'=>'!empty($data->teacher_id)?$data->teacher->name:""',
    ),
);
?>
<div id="for-print">
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-schedule-grid',
    'dataProvider'=>$model->searchDateRange($date1,$date1),
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>$scheduleColumns,
    
));?>
</div>
<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
    var dateToday = new Date();
    $( '#date1' ).datepicker({buttonImageOnly: 'both',showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});

    $('#search').click(function(){
        $.fn.yiiGridView.update('class-schedule-grid',{
            data:{
                date1:$('#date1').val(),
            }
        });
    });
");

?>


<script type="text/javascript">
    /*<![CDATA[*/
    function PrintElem(elem)
    {
        var html = '';
        html = "<h4>Date: "+$('#date1').val()+"</h4>";
        Popup(html+$(elem).html());
        $('.filters').show();
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