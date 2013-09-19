
<div id="popup-select-group" class="modalz" style="display:none;"><a title="Close" class="mCloseImg close-group"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-grid',
	'dataProvider'=>$groups->search(),
    'ajaxUrl'=>Yii::app()->createUrl( 'enrollment/searchGroup' ),
	'filter'=>$groups,
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
                        $('#group_id').val($(this).attr('href'));
                        var name = $(this).parent().parent().find('td:nth(1)').html();
                        
                        $('#Enrollment_group').val(name);
                        $('#ref_name').val(name);
                        $('#bakz').hide();
                        $('#popup-select-group').hide();
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
Yii::app()->clientScript->registerScript('search-group', "

$('#add-group').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-group').show();
});

$('.close-group').click(function(){
    $('#bakz').hide();
    $('#popup-select-group').hide();
});

$('.search-form form').submit(function(){
	$('#group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>