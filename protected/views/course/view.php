<?php
/* @var $this CourseController */
/* @var $model Course */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl."/css/popup.css");
$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'Update Course', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Course', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>View Course</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
        'description',
	),
)); ?>

<br>
<h2 style="margin-bottom:0px">Teachers</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-items-grid',
	//'dataProvider'=>$model->search(),
    'dataProvider'=>$courseItems->searchByCourseId($model->id),    
    'cssFile' => Yii::app()->baseUrl . '/css/grid.css',
	'columns'=>array(
        array( 
           'name'=>'teacher_id',
           'type'=>'raw',
           'value'=>'empty($data->teacher_id) ?"": CHtml::link(CHtml::encode($data->teacher->name), array("teacher/view", "id"=>$data->teacher->id))',
        ),
        'rate',
        array(
			'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'url'=>'Yii::app()->createUrl("/courseItems/delete", array("id" => $data->primaryKey))',
                )
            )
		),
	),
)); ?>

<a id="add-teacher" href="javascript:;">Add Teacher</a>

<div id="bakz" style="display:none"></div>
<div id="popup-select-teacher" class="modalz" style="display:none;"><a title="Close" class="mCloseImg"></a>
    <div class="form">
        <div class="error" style='display: none'></div>
        
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'class-items-form',
            'enableAjaxValidation'=>FALSE,
            'action'=>Yii::app()->createUrl('/course/saveCourseItems'),
            'htmlOptions'=>array(
            'style'=>'padding:10px;'
            )
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($courseItems); ?>
        <div class="row">
            <label class="required" for="CourseItems_teacher_id">Teacher <span class="required">*</span></label>
            <input disabled type="text" id="CourseItems_teacher" name="CourseItems[teacher]" maxlength="255" size="60">
            <?php echo "<input id='teacher_id' name='CourseItems[teacher_id]' type='hidden' value='' />"?>
            <a id="browse-teacher" href="javascript:;">Browse</a>
        </div>
        <div class="row">
            <?php echo $form->labelEx($courseItems,'rate'); ?>
            <?php echo $form->textField($courseItems,'rate'); ?>
            <?php echo $form->error($courseItems,'rate'); ?>
        </div>
        
        <?php echo "<input id='course_id' name='CourseItems[course_id]' type='hidden' value='$model->id' />"?>
        <div class="row buttons">
            <label>&nbsp;</label>            
        </div>
          <input type="submit" id="save" value="Save" name="save">
    <?php $this->endWidget(); ?>
        
    </div>
</div>
<div class="clear"><br></div>
<?php $this->renderPartial('_browse_teacher',array('teacher'=>$teachers)); ?>

<?php
Yii::app()->clientScript->registerScript('search', "

$('#add-teacher').click(function(){
    $('#CourseItems_teacher').val('');
    $('#teacher_id').val('');
    $('.error').hide();
    $('.error').html('');
    $('#bakz').show();
    $('#popup-select-teacher').show();
});

$('.mCloseImg').click(function(){
    $('#bakz').hide();
    $('#popup-select-teacher').hide();
});

$('.search-form form').submit(function(){
	$('#teacher-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});


jQuery('body').on('click','#save',function(){
    $('#loading').show();
	jQuery.ajax({
		'type':'POST',
		'dataType':'json',
		'data': $(\"#class-items-form\").serialize(),
		'success':function(data){
            $('#loading').hide();
			if(data.result===\"success\"){
                $.fn.yiiGridView.update('course-items-grid');
                $('#bakz').hide();
                $('#popup-select-teacher').hide();
            }else{
                $('.error').show().html(data.msg);
            }     
		},
		'url':'".Yii::app()->createUrl('/course/saveCourseItems')."','cache':false
	});
	return false;
});


");
?>