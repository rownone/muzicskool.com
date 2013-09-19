
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
                            var fname = $(this).parent().parent().find('td:nth(1)').html();
                            
                            $('#band').val(fname);

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
        'ref_name',
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