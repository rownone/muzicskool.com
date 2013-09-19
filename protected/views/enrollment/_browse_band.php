
<div id="popup-select-band" class="modalz" style="display:none;"><a title="Close" class="mCloseImg close-band"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'band-grid',
	'dataProvider'=>$bands->search(),
    'ajaxUrl'=>Yii::app()->createUrl( 'enrollment/searchBand' ),
	'filter'=>$bands,
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
                        $('#band_id').val($(this).attr('href'));
                        var name = $(this).parent().parent().find('td:nth(1)').html();
                        
                        $('#Enrollment_band').val(name);
                        $('#ref_name').val(name);
                        $('#bakz').hide();
                        $('#popup-select-band').hide();
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

</div>



<?php
Yii::app()->clientScript->registerScript('search-band', "

$('#add-band').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-band').show();
});

$('.close-band').click(function(){
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