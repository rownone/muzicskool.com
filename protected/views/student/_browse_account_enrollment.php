
<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
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
                            var fname = $(this).parent().parent().find('td:nth(1)').html();
                            var course = $(this).parent().parent().find('td:nth(2) .course').html();
                            var fee = $(this).parent().parent().find('td:nth(2) .fee').html();
                            var total_payment = $(this).parent().parent().find('td:nth(2) .total_payment').html();
           
                            var total_balance = $(this).parent().parent().find('td:nth(2) .total_balance').html();
                           
                            $('#student').val(fname);
                            $('#course').val(course);

                            gFee = fee;
                            gTotalPayment = total_payment;
                            gTotalBalance = total_balance;
                            $.fn.yiiGridView.update('payment-grid',{
                                data:{
                                    enrollment_id:-1,
                                }
                            });
                            $('#fee').val('');
                            $('#total_payment').val('');
                            $('#total_balance').val('');
                            $('#bakz').hide();
                            $('#popup-select-student').hide();
                            $('#print').hide();
                            return false;
                        }
                     ", 
                    'url'=>'$data->id',
                ),                
            ),
        ),
        'ref_name',        
		array(
            'name'=>'course_id',
            'type'=>'raw',
            'filter' => CHtml::activeTextField($enrollment, 'course_id'),
            //'value'=>'$data->course->name',
            'value'=>function($data,$row){ // declare signature so that we can use $data, and $row within this function 
                    $fee = "<span style='display:none;' class='fee'>".$data->fee."</span>";
                    $total_payment = "<span style='display:none;' class='total_payment'>".$data->total_payment."</span>";
                    $total_balance = "<span style='display:none;' class='total_balance'>".($data->fee - $data->total_payment)."</span>";
                    $course = "<span class='course'>".$data->course->name."</span>";
                    return $course.$total_payment.$fee.$total_balance;
                }
        ),
        array(
            'name'=>'fee',
            'value'=>'$data->fee',
            'visible'=>false
        ),
        array(
            'name'=>'total_payment',
            'value'=>' $data->total_payment',
            'visible'=>false
        ),
	),
)); ?>

</div>



<?php
Yii::app()->clientScript->registerScript('search-student', "
$('#browse-student').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-student').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-student').hide();
});

$('.search-form form').submit(function(){
	$('#student-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>