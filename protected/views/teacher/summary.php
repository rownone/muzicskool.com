<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<h1>Teacher Details</h1>
<br>
<div class="row">
    <label class="required" for="teacher">Name <span class="required">*</span></label>
    <input disabled type="text" id="teacher" name="teacher" maxlength="255" size="60">
    <?php echo "<input id='teacher_id' name='teacher_id' type='hidden' value='' />"?>
    <a id="browse-teacher" href="javascript:;">Browse</a>
</div>

<br/>
<div class="row">
    <span>Start Date</span><input style=""  id="date1" value="" type="text" />
&nbsp;&nbsp;
<span>End Date</span><input style="" id="date2" value="" type="text" />&nbsp;&nbsp;
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
        'name'=>'enrollment_id',
        'header'=>'Student/Group',
        'value'=>'$data->enrollment->ref_name'
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
if(!empty($date1)&&!empty($date2))
    $provider = $classSchedule->searchByTeacherDateRange($date1,$date2);
else
    $provider = $classSchedule->searchByTeacher();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-schedule-grid',
    'dataProvider'=>$provider,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>$scheduleColumns,
    'summaryText'=>'',    
));?>
</div>
<?php $this->renderPartial('_browse_schedule',array('teacher'=>$teacher)); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#display-schedule').click(function(){
        $('#print').show();
        $('#loading').show();
        var d1 = $('#date1').val();
		var d2 = $('#date2').val();
		
		if(!isDate(d1)){
			alert('Please enter valid date');
			$('#date1').focus();
            $('#print').hide();
            $('#loading').hide();
			return false;
		}else if(!isDate(d2)){
			alert('Please enter valid date');
			$('#date2').focus();
            $('#print').hide();
            $('#loading').hide();
			return false;
		}
		var arrD1 = d1.split('/');
		d1 = arrD1[2]+"-"+arrD1[0]+"-"+arrD1[1];
		
		var arrD2 = d2.split('/');
		d2 = arrD2[2]+"-"+arrD2[0]+"-"+arrD2[1];
        
        $.fn.yiiGridView.update('class-schedule-grid',{
            data:{
                teacher_id:$('#teacher_id').val(), 
                date2:d2,
                date1:d1,
            },complete: function(jqXHR, status) {
                $('#loading').hide();
            }
        });
    });
    var defDate1 = "<?php echo isset($_REQUEST['date1'])?$_REQUEST['date1']:date("Y-m-d");?>";
	var defDate2 = "<?php echo isset($_REQUEST['date2'])?$_REQUEST['date2']:date("Y-m-d");?>";
    
	$('#date1').datepicker( 
        {nextText:"",prevText:"",numberOfMonths:1,showButtonPanel:true,closeText:"Clear Dates",
			onClose: function(input, inst){
                if(inst.id == 'date1'){
                    setTimeout(function(){
                        $("#date2").datepicker( "show" );
                    },300);
                }
			},
			afterShow: function (input, inst, td) {
				$('.ui-datepicker-close').click(function(){
					$('#date2, #date1').val('');
				});
			}
	});
	
	$('#date2').datepicker( {
		afterShow: function (input, inst, td) {
			$('.ui-datepicker-close').click(function(){
				$('#date2, #date1').val('');
			});
		},nextText:"",prevText:"",numberOfMonths:1,showButtonPanel:true,closeText:"Clear Dates"});
	
    function isDate(dateStr) {
		var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
		var matchArray = dateStr.match(datePat); // is the format ok?
		if (matchArray == null) {
			return false;
		}
		var month = matchArray[1]; // p@rse date into variables
		var day = matchArray[3];
		var year = matchArray[5];
		if (month < 1 || month > 12) { // check month range
			alert("Month must be between 1 and 12.");
			return false;
		}
		if (day < 1 || day > 31) {
			alert("Day must be between 1 and 31.");
			return false;
		}
		if ((month==4 || month==6 || month==9 || month==11) && day==31) {
			alert("Month "+month+" doesn`t have 31 days!")
			return false;
		}
		if (month == 2) { // check for february 29th
			var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
			if (day > 29 || (day==29 && !isleap)) {
				alert("February " + year + " doesn`t have " + day + " days!");
				return false;
			}
		}
		return true; // date is valid
	}
});
</script>

<script type="text/javascript">
    /*<![CDATA[*/
    function PrintElem(elem)
    {
        var html = '';
        html = "<h4>Name: "+$('#teacher').val()+"</h4>"; 
        Popup(html+$(elem).html());
    }
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
    /*function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<link rel="stylesheet" media="print" href="<?php echo Yii::app()->baseUrl . '/css/grid.css';?>" type="text/css" />');
        mywindow.document.write(data);
        mywindow.print();
        mywindow.close();
        return true;
    }*/
    /*]]>*/
</script>