<?php
$criteria=new CDbCriteria;
$criteria->compare('day',$day,true);

$dataProvider=new CActiveDataProvider($teacherSchedule,array(
    'criteria'=>$criteria,
    'pagination'=>array(
        'route'=>'/enrollment/searchTeacherSchedule'
    ),
    'sort'=>array(
        'route'=>'/enrollment/searchTeacherSchedule'
    )
));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teacher-schedule-grid',
	//'dataProvider'=>$teacherSchedule->searchByDay($day),
    'dataProvider'=>$dataProvider,
    //'ajaxUrl'=>Yii::app()->createUrl( '/enrollment/searchTeacherSchedule' ).'&day='.$day, // this takes care of the search 
	//'filter'=>$teacherSchedule,
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
                            //$('#teacher_id').val($(this).attr('href'));
                            //var name = $(this).parent().parent().find('td:nth(1)').html();
                            var startTime = $(this).parent().parent().find('td:nth(2)').html();
                            var endTime = $(this).parent().parent().find('td:nth(3)').html();
                            //$('#ClassSchedule_teacher').val(name);
                            $('#ClassSchedule_start_time').val(startTime)
                            $('#ClassSchedule_end_time').val(endTime)
                            $('#popup-select-teacher-schedule').hide();
                            return false;
                            }
                         ", 
                        'url'=>'$data->primaryKey',
                    ),                
                ),
            ),
		//'id',
		/*array(
            'name'=>'teacher_id',
            'value'=>'empty($data->teacher_id) ? "" : $data->teacher->name',
        ),*/
		'day',
		'time_from',
		'time_to',
		
	),
)); ?>
