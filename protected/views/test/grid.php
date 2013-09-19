<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<form name="form_select_graph" id="form_select_graph" action="" method="post">
	<input type="hidden" id="date_options" name="date_options" value="">
	<input type="hidden" id="c_date1" name="date1" value="">
	<input type="hidden" id="c_date2" name="date2" value="">
	<input type="hidden" id="date_range" name="date_range" value="">
</form>

<select name="select_date_options" id="select_date_options">
	<option value="yesterday" label="Yesterday" <?php echo $date_options=="yesterday"?'selected="selected"':"";?> >Yesterday</option>
	<option value="today" label="Today" <?php echo $date_options=="today"?'selected="selected"':"";?> >Today</option>
	<option value="last_7_days" label="Last 7 days" <?php echo $date_options=="last_7_days"?'selected="selected"':"";?> >Last 7 days</option>
	<option value="last_month" label="Last Month &ndash; Dec" <?php echo $date_options=="last_month"?'selected="selected"':"";?> >Last Month</option>
	<option value="current_month" label="Current Month &ndash; Jan" <?php echo $date_options=="current_month"?'selected="selected"':"";?> >Current Month</option>
	<option value="-1" ></option>
</select>
<span>&nbsp;&nbsp;OR&nbsp;&nbsp;</span>
<span>Start Date</span><input style="height:27px"  id="date1" value="" type="text" />
&nbsp;&nbsp;
<span>End Date</span><input style="height:27px" id="date2" value="" type="text" />&nbsp;&nbsp;
<input name="display-report" id="display-report" value="Display Report" type="button" />
<br><br>
<!--<h2>Results from: <?php echo $date1;?> to: <?php echo $date2;?></h2>-->
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	//'dataProvider'=>$model->searchDateRange('2013-08-01','2013-08-07'),
    'dataProvider'=>$model->search2($date1,$date2),
    //'ajaxUrl' => $this->createUrl('/test/grid')."&date1=$date1&date2=$date2",
	//'filter'=>$model,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
        array(
           'name'=>'enrollment_id',
           'header'=>'Name/Group/Band',
           'type'=>'raw',
           'value'=>'$data->enrollment->ref_name',
           'footer'=>'Totals:'
        ),
        array(
           'name'=>'amount',
           'header'=>'Total',
           'value'=>'$data->amount',
           'footer'=>$model->search2($date1,$date2)===0 ? '' : $model->pageTotal($model->search2($date1,$date2))
        ),
        array(
                'class'=>'CButtonColumn',
                'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),array(
                    'onchange'=>
                    "$.fn.yiiGridView.update('payment-grid',{
                        data:{
                            pageSize: $(this).val(),
                            date1:'".$date1."',
                            date2:'".$date2."'
                        }
                    })",
            )),
            'template'=>'',
        ),
	),
    'summaryText'=>'Date Range: '.$date1.' to '.$date2,
    //'summaryText'=>'Date Range: '.$date1.' to '.$date2."<br> Displaying {start}-{end} of {count} results",
    //'template'=>' {items} {summary} {pager}',
)); ?>

<script type="text/javascript">
$(document).ready(function() {
	var defDate1 = "<?php echo isset($_REQUEST['date1'])?$_REQUEST['date1']:date("Y-m-d");?>";
	var defDate2 = "<?php echo isset($_REQUEST['date2'])?$_REQUEST['date2']:date("Y-m-d");?>";
	var hdate2Popup = false;
    
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
	
	$('#select_date_options').change(function(){
		if($(this).val()!="-1"){
			$('#date_options').val($(this).val());
			
			$('#date_range').val('');
			$('#date1').val('');
			$('#date2').val('');
			
			//$('#form_select_graph').submit();
            $.fn.yiiGridView.update('payment-grid',{
                data:{
                    date_options:$(this).val(),
                    date2:'',
                    date1:'',
                }
            })
		}
	});
		
	$('#display-report').click(function(){
		var d1 = $('#date1').val();
		var d2 = $('#date2').val();
		
		if(!isDate(d1)){
			alert('Please enter valid date');
			$('#date1').focus();
			return false;
		}else if(!isDate(d2)){
			alert('Please enter valid date');
			$('#date2').focus();
			return false;
		}
		var arrD1 = d1.split('/');
		d1 = arrD1[2]+"-"+arrD1[0]+"-"+arrD1[1];
		
		var arrD2 = d2.split('/');
		d2 = arrD2[2]+"-"+arrD2[0]+"-"+arrD2[1];
		
		$('#c_date1').val(d1);
		$('#c_date2').val(d2);
		$('#date_range').val('1');
		$('#select_date_options').val('-1');
        $.fn.yiiGridView.update('payment-grid',{
            data:{
                date2:d2,
                date1:d1,
                date_options:''
            }
        });
        return false;
	});
	
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
		
	<?php
		if($date_range == 1){
	?>
	if(defDate1!=''){
		var arrD1 = defDate1.split("-");
		$('#date1').val(arrD1[1]+"/"+arrD1[2]+"/"+arrD1[0]);
	}
	if(defDate2!=''){
		var arrD2 = defDate2.split("-");
		$('#date2').val(arrD2[1]+"/"+arrD2[2]+"/"+arrD2[0]);
	}
	$('#select_date_options').val('-1');
	<?php
		}else{
	?>
		$('#date1').val('');
		$('#date2').val('');
	<?php
		}
	?>
});
</script>