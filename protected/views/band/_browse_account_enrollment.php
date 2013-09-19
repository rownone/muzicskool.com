
<div id="bakz" style="display:none"></div>
<div id="popup-select-band" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'band-grid',
	'dataProvider'=>$enrollment->searchStudent(),
	'filter'=>$enrollment,
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
                            $('#enrollment_id').val($(this).attr('href'));
                            var fname = $(this).parent().parent().find('td:nth(1) .ref_name').html();
                            
                            var fee = $(this).parent().parent().find('td:nth(1) .fee').html();
                            var total_payment = $(this).parent().parent().find('td:nth(1) .total_payment').html();
           
                            var total_balance = $(this).parent().parent().find('td:nth(1) .total_balance').html();
                           
                            $('#band').val(fname);
                            
                            gFee = fee;
                            gTotalPayment = total_payment;
                            gTotalBalance = total_balance;
                            $('#loading').show();
                            $.fn.yiiGridView.update('payment-grid',{
                                data:{
                                    enrollment_id:-1,
                                },
                                complete: function(jqXHR, status) {
                                    $('#loading').hide();
                                }
                            });
                            $('#fee').val('');
                            $('#total_payment').val('');
                            $('#total_balance').val('');
                            $('#bakz').hide();
                            $('#popup-select-band').hide();
                            $('#print').hide();
                            return false;
                        }
                     ", 
                    'url'=>'$data->id',
                ),                
            ),
        ),
        array(
            'name'=>'ref_name',
            'type'=>'raw',
            'value'=>function($data,$row){ // declare signature so that we can use $data, and $row within this function 
                    $fee = "<span style='display:none;' class='fee'>".$data->fee."</span>";
                    $total_payment = "<span style='display:none;' class='total_payment'>".$data->total_payment."</span>";
                    $total_balance = "<span style='display:none;' class='total_balance'>".($data->fee - $data->total_payment)."</span>";
                    $ref_name = "<span class='ref_name'>".$data->ref_name."</span>";
                    return $ref_name.$total_payment.$fee.$total_balance;
                }
        ),
	),
)); ?>

</div>



<?php
Yii::app()->clientScript->registerScript('search-band', "
$('#browse-band').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-band').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-band').hide();
});

$('.search-form form').submit(function(){
	$('#band-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>