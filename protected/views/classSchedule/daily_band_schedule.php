<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css" />
<style>
#tmp-class-schedule-grid tr:nth-child(odd) { background: none repeat scroll 0 0 #E5F1F4;}
#tmp-class-schedule-grid tr:nth-child(even) {background: none repeat scroll 0 0 #F8F8F8;}
.studios li{
    width:218px;
    float:left;
    list-style: none outside none;
    
}
</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-ui.min.js"></script>
<h1>Daily Band Schedule</h1>
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="row">
    <label class="required" for="group">Date <span class="required">*</span></label>
    <input  type="text" id="date1" name="date1" value="<?php echo $date1?>" size="20">
    <?php echo CHtml::submitButton('Search'); ?>
        <input name="print" id="print" value="Print" type="button" onclick="PrintElem('#for-print')" />
    <br><br><hr>
    <h3>Columns</h3>
    
    <ul class="studios">
    <?php 
    $x=0;
    foreach($studio as $s){
        if(count($chkStudios)>0){
            $checked = '';
            foreach($chkStudios as $chk){
                if($chk==$s->id){
                    $checked = "checked";
                    break;
                }
            }
    ?>
        <li><input <?php echo $checked;?> type="checkbox" name="studios[]" value="<?php echo $s->id?>"><?php echo $s->name?></li>
    <?php
        }else{
            $checked = $x<7 ?"checked":"";
    ?>
        <li><input <?php echo $checked;?> type="checkbox" name="studios[]" value="<?php echo $s->id?>"><?php echo $s->name?></li>
    <?php 
        $x++;
    
        }
    }
    ?>
    </ul>
    <hr>
    <br>
    <div style="clear:both; "></div>
   
</div>
<?php $this->endWidget(); ?>
<br>


<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
    var dateToday = new Date();
    $( '#date1' ).datepicker({buttonImageOnly: 'both',showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});

");

?>
<?php
    $rows = array();
    $cols = array();
    /*foreach($model as $item){
        if (!in_array($item->studio->name, $cols)){
            $cols[]=$item->studio->name;
        }        
    }*/
    foreach($studio as $item){
        $search = false;
        foreach($chkStudios as $chk){
            if($item->id==$chk){
                $search = true;
                break;
            }
        }
        if($search){
            if (!in_array($item->name, $cols)){
                $cols[]=$item->name;
            }
        }
    }
    sort($cols);
    array_unshift($cols, "Time");
    foreach($model as $item){
        if($item->enrollment->enrollment_type_id==Yii::app()->params['band']){
            $row = array();
            $sameTime = false;
            foreach($cols as $col){
                if($col=="Time"){
                    $time=date("g:i a", strtotime($item->start_time))." - ".date("g:i a", strtotime($item->end_time));
                    $r = end($rows);
                    if($r['Time']==$time){
                        $sameTime = true;
                        $row = end($rows);
                        array_pop($rows);
                    }else{
                        $row['Time'] = $time; 
                    }
                }else{
                    if($item->studio->name==$col){
                        if($item->enrollment->enrollment_type_id==Yii::app()->params['band']){
                            $row[$col]="<a href=".Yii::app()->createUrl( 'classSchedule/view&id='.$item->id ).">".$item->enrollment->ref_name."</a>";
                        }else{
                            $row[$col]=$item->enrollment->ref_name.' - '.$item->enrollment->course->name." - ".$item->teacher->name;
                        }
                    }else{
                        if(!$sameTime)
                            $row[$col]="";
                    }
                }
            }
            $rows[] = $row;
        }
    }
?>
<div id="for-print">
<?php 
    if(count($rows)>0){
?>
<div class="grid-view" id="tmp-class-schedule-grid">
    <table class="items">
    <thead>
        <tr>
            <?php foreach($cols as $col){?>
            <th><?php echo $col;?></th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($rows as $row){
                ?>
                <tr>
                <?php foreach($cols as $col){
                    ?>
                    <td><?php echo $row[$col];?></td>
                    <?php
                }?>
                </tr>
                <?php
            }
        ?>
    </tbody>
    </table>
</div>
<?php
    }else echo '<span class="empty">No results found.</span>';
?>
</div>
<?php
Yii::app()->clientScript->registerScript('create_class_schedule', "
    var dateToday = new Date();
    $( '#date1' ).datepicker({buttonImageOnly: 'both',showButtonPanel: true,dateFormat: 'yy-mm-dd',changeMonth: true,
      yearRange: '-60:+0',changeYear: true,});

    $('#search').click(function(){
        $.fn.yiiGridView.update('class-schedule-grid',{
            data:$('#search-form').serialize()
            //{
                //date1:$('#date1').val(),
            //}
        });
    });
");

?>


<script type="text/javascript">
    /*<![CDATA[*/
    function PrintElem(elem)
    {
        var html = '';
        html = "<h1>Daily Schedule</h1><h4>Date: "+$('#date1').val()+"</h4>";
        Popup(html+$(elem).html());
        $('.filters').show();
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
    
    /*]]>*/
</script>
