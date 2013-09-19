<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
?>
<style>
    #payment-grid tr.odd td:nth-child(3), #payment-grid tr.even td:nth-child(3), #payment-grid tfoot tr td:nth-child(3){
        text-align:right;
    }
</style>
<h1>Student Accounts</h1>
<br>
<div class="row">
    <label class="required" for="student">Student <span class="required">*</span></label>
    <input disabled  type="text" id="student" name="student" maxlength="255" size="60">
    <?php echo "<input id='enrollment_id' name='enrollment_id' type='hidden' value='' />"?>
    <a id="browse-student" href="javascript:;">Browse</a>
</div><br/>
<div class="row">
    <label class="required" for="student">Course</label>
    <input disabled type="text" id="course" name="student" maxlength="255" size="60">
</div><br/>
<div class="row">
    <label class="required" for="Fee">Fee</label>
    <input disabled style="text-align:right;" type="text" id="fee" name="fee" maxlength="255" size="15">
</div><br/>
<div class="row">
    <label class="required" for="total_payment">Total Payment</label>
    <input disabled style="text-align:right;" type="text" id="total_payment" name="total_payment" maxlength="255" size="15">
</div><br/>
<div class="row">
    <label class="required" for="total_balance">Total Balance</label>
    <input disabled style="text-align:right;" type="text" id="total_balance" name="total_balance" maxlength="255" size="15">
</div>
<br/>
<div class="row">
    <input name="display-report" id="display-schedule" value="Display Schedule" type="button" />
    <input style="display:none;" type="button" value="Print" id="print" name="print" onclick="PrintElem('#for-print')">
</div>
<div class="clear"><br></div>
<h2 style="margin-bottom:0px">Payments</h2>

<div id="for-print">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	'dataProvider'=>$payment->search(),
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
        array(
           'name'=>'payment_date',
           'value'=>'$data->payment_date',
           'footer'=>'<b>Totals:</b>'
        ),
        'or_number',
        array(
           'name'=>'amount',
           'value'=>'$data->amount',
           'footer'=>$payment->search()===0 ? '' : "<b>".$payment->pageTotal($payment->search())."</b>"
        ),
		array(
            'name'=>'prepared_by_id',
            'value'=>'$data->prepared_by->username',
        )
	),
)); ?>
</div>
<script>
var gFee = 0;
var gTotalPayment = 0;
var gTotalBalance = 0;
</script>
<?php $this->renderPartial('_browse_account_enrollment',array('enrollment'=>$enrollment)); ?>
<?php //$this->renderPartial('_browse_course',array('courses'=>$course)); ?>

<script type="text/javascript">
$(document).ready(function() {
    $('#display-schedule').click(function(){
        $('#print').show();
        $('#loading').show();
        $.fn.yiiGridView.update('payment-grid',{
            data:{
                enrollment_id:$('#enrollment_id').val(),
            },
            complete: function(jqXHR, status) {
                $('#loading').hide();
                $('#fee').val(gFee);
                $('#total_payment').val(gTotalPayment);
                $('#total_balance').val(gTotalBalance);
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
        html = "<h4>Name: "+$('#student').val()+"</h4>"; 
        html += "<h4>Course: "+$('#course').val()+"</h4>";
        html += "<h4>Fee: "+$('#fee').val()+"</h4>"; 
        html += "<h4>Total Payment: "+$('#total_payment').val()+"</h4>"; 
        html += "<h4>Total Balance: "+$('#total_balance').val()+"</h4>"; 
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