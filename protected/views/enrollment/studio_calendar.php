<style>
.open{
    background: url("images/ui-bg_highlight-hard_100_f2f5f7_1x100.png") repeat-x scroll 50% top #F2F5F7;
    border: 1px solid #AAAAAA;
    float: left;
    height: 115px;
    width: 122px;
}
.close{
    background: url("images/ui-bg_highlight-soft_25_ffef8f_1x100.png") repeat-x scroll 50% top #FFEF8F;
    border: 1px solid #AAAAAA;
    float: left;
    height: 115px;
    width: 122px;
}
</style>
<h1>Select Studio</h1>
<div>
<?php
foreach($studios as $studio){
?>
<div class="<?php echo $studio['className'];?>">
    <a id="<?php echo $studio['id']?>" class="a-studio" href="javascript:;">
<?php  echo $studio['name']." - ".$studio['description'];?>
    </a>
</div>
<?php
}
?>
</div>