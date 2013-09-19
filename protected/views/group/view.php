<?php
/* @var $this GroupController */
/* @var $model Group */

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	//array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Update Group', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
?>

<h1>View Group</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'notes',
	),
)); ?>

<br>
<h2 style="margin-bottom:0px">Group Members</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'group-items-grid',
	//'dataProvider'=>$model->search(),
    'dataProvider'=>$groupItems->searchByGroupId($model->id),    
	//'filter'=>$groupItems,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
        array( 
           'name'=>'student_id',
           'type'=>'raw',
           'value'=>'empty($data->student_id) ?"": CHtml::link(CHtml::encode($data->student->name), array("student/view", "id"=>$data->student->id))',
        ),
        
		//'id',
		/*array(
            'name'=>'student_id',
            'value'=>'empty($data->student_id) ? "" : $data->student->name',
        ),
		*/
        array(
			'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'url'=>'Yii::app()->createUrl("/groupItems/delete", array("id" => $data->primaryKey))',
                )
            )
            //'deleteButtonUrl'=>'Yii::app()->createUrl("/controllername/delete", array("id" => 1))',
		),
	),
)); ?>

<a id="add-student" href="javascript:;">Add Student</a>

<div id="bakz" style="display:none"></div>
<div id="popup-select-student" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
<div class="error" style='display: none'>
            
</div></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
	'dataProvider'=>$students->search(),
    //'ajaxUrl'=>Yii::app()->createUrl( 'student/students' ),
    'ajaxUrl'=>Yii::app()->createUrl( 'group/student' ).'&group_id='.$model->id,
	'filter'=>$students,
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
		array
        (
            'header'=>'Add', // add headers this way
            'class'=>'CButtonColumn',
            'template'=>'{add}',
            'buttons'=>array
            (
                'add' => array
                (
                    'label'=>'Add',
                    'click'=>"function(){
                        $('#loading').show();
                        $.fn.yiiGridView.update('group-items-grid', {
                            type:'POST',
                            dataType:'json',
                            url:$(this).attr('href'),
                            success:function(data) {
                                $('#loading').hide();
                                //$('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
                                if(data.result===\"success\"){
                                    $.fn.yiiGridView.update('group-items-grid');
                                    $('#bakz').hide();
                                    $('#popup-select-student').hide();
                                }else{
                                     $.fn.yiiGridView.update('group-items-grid');
                                    $('.error').show();
                                    $('.error').html(data.msg);
                                }
                            }
                        })
                        return false;
                        }
                     ",
                    'url'=>'Yii::app()->controller->createUrl("saveGroupItems",array("group_id"=>'.$model->id.',"student_id"=>$data->primaryKey))',
                ),                
            ),
        ),
		'first_name',
        'middle_name',
        'last_name',        
	),
)); ?>

</div>


<?php
Yii::app()->clientScript->registerScript('search', "

$('#add-student').click(function(){
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