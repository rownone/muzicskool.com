
<div id="bakz" style="display:none"></div>
<div id="popup-select-course" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-grid',
	'dataProvider'=>$courses->search(),
	'filter'=>$courses,
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
                            $('#course_id').val($(this).attr('href'));
                            var fname = $(this).parent().parent().find('td:nth(1)').html();
                            $('#course').val(fname);
                            $('#bakz').hide();
                            $('#popup-select-course').hide();
                            $('#print').hide();
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
Yii::app()->clientScript->registerScript('search-course', "
$('#browse-course').click(function(){
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-course').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-course').hide();
});

$('.search-form form').submit(function(){
	$('#course-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>