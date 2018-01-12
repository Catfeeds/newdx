<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
if(isset($_GET['on_off'])){
    DB::query("update ".DB::table('plugin_forumoption_setting')." set value = '".$_GET['on_off']."' where name='fiter_setting'");
	memory('rm' ,'plugin_forumoption_setting_BvSjK');
}
if(isset($_GET['fiter_level'])){
    DB::query("update ".DB::table('plugin_forumoption_setting')." set value = '".$_GET['fiter_level']."' where name='fiter_level'");
	memory('rm' ,'plugin_forumoption_setting_BvSjK');
}
if($_GET['del'] && !empty($_GET['del'])){
    $delstr = $_GET['del'];
    $newfiter = array();
    $j=0;
    $fiter_arr = explode(",",DB::result_first("select value from ".DB::table('plugin_forumoption_setting')." where name = 'fiter_string'"));
    if(count($fiter_arr)==1){
        DB::query("delete from ".DB::table('plugin_forumoption_setting')." where name = 'fiter_string'");
		memory('rm' ,'plugin_forumoption_setting_BvSjK');
    }else{
    for($i=0;$i<count($fiter_arr);$i++){
        if($fiter_arr[$i]!=$delstr){
            $newfiter[$j] = $fiter_arr[$i];
            $j++;
        }
    }
    $newfiter_str = implode(",",$newfiter);
    DB::query("update ".DB::table('plugin_forumoption_setting')." set value='".$newfiter_str."' where name = 'fiter_string'");
	memory('rm' ,'plugin_forumoption_setting_BvSjK');
    }
}
if($_POST['fiter_string']){
    $fiterinfo = DB::fetch_first("select count(*) as num,value from ".DB::table('plugin_forumoption_setting')." where name = 'fiter_string'");
    $fiter_str = ($fiterinfo['num']!=0) ? $fiterinfo['value'].",".$_POST['fiter_string'] : $_POST['fiter_string'];
    $method = ($fiterinfo['num']==0) ? "insert into ".DB::table('plugin_forumoption_setting')." values('fiter_string','".$fiter_str."')" : "update ".DB::table('plugin_forumoption_setting')." set value='".$fiter_str."' where name = 'fiter_string'";
    DB::query($method);
	memory('rm' ,'plugin_forumoption_setting_BvSjK');
}

$fiter_state = DB::fetch_first("select count(*) as num,value from ".DB::table('plugin_forumoption_setting')." where name = 'fiter_setting'");
if($fiter_state['num']==0){
    DB::query("insert into ".DB::table('plugin_forumoption_setting')." values('fiter_setting',1)");
    memory('rm' ,'plugin_forumoption_setting_BvSjK');
	$fiter_st = 1;
}else{
    $fiter_st = $fiter_state['value'];
}
$fiter_arr = array();
$fiter = DB::fetch_first("select count(*) as num,value from ".DB::table('plugin_forumoption_setting')." where name = 'fiter_string'");
if($fiter['num']!=0){
    $fiter_array = explode(",",$fiter['value']);
}
$fiter_level = DB::fetch_first("select count(*) as num,value from ".DB::table('plugin_forumoption_setting')." where name = 'fiter_level'");
if($fiter_level['num']==0){
    DB::query("insert into ".DB::table('plugin_forumoption_setting')." values('fiter_level',0)");
    memory('rm' ,'plugin_forumoption_setting_BvSjK');
	$fiter_le = 0;
}else{
    $fiter_le = $fiter_level['value'];
}
function state_to_text($state){
    return ($state==1) ? "<span style='color:green;'>开启中</span>" : "<span style='color:red;'>关闭中</span>";
    }
function tovalue($state){
    return ($state==1) ? 0 : 1;
}
?>
<style>
#top_box,#bottom_box{float:left;clear:both;margin:30px 0 40px 30px;width: 500px;}
#fiter_list li{text-decoration: none;float: left;padding:5px 7px;border: 1px solid #ccc;font-size: 14px;margin: 10px;border-radius: 5px;-webkit-border-radius: 5px;-webkit-border-radius: 5px;-moz-box-shadow: 0 2px 3px rgba(0,0,0,0.5);-webkit-box-shadow: 0 2px 3px rgba(0,0,0,0.5);
text-shadow: 0 -1px 1px rgba(0,0,0,0.25);}
#tips{position:absolute;left: 380px;top:80px;color: red;}
.close{line-height:7px;margin:5px;}
a,a:hover,a:visited{text-decoration: none;}
</style>
<div id="container_box">
    <div id="top_box">
        <form action="" method="post">
            <div>
                请输入需要添加的关键字：<input id="fiter_string" type="text" name="fiter_string"/>
                <input type="submit" name="submit" onClick="return checkbd();" value="添加"/>
                </form>
                <div id="tips"></div>
                <div style="margin-top: 30px;">过滤功能:<span style="margin:0 30px;"><a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_fiter&on_off=<?=tovalue($fiter_st)?>"><?=state_to_text($fiter_st)?></a></span>
                是否过滤置顶帖:<span style="margin-left: 30px;"><a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_fiter&fiter_level=<?=tovalue($fiter_le)?>"><?=state_to_text($fiter_le)?></a></span></div>
            </div>
    </div>
    <hr style="border-top: 1px dotted #ccc;float:left;clear: both;width: 500px;" />
    <div id="bottom_box">
        <ul id="fiter_list">
        <?php if(count($fiter_array)>0){
            foreach($fiter_array as $value){
        ?>
           <li><b><?=$value?></b><span class="close"><a onClick="return confirm('确定将此记录删除?')" href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_fiter&del=<?=$value?>">X</a></span></li>
        <?php
            }
        } ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
function checkbd(){
    if(document.getElementById("fiter_string").value==""){
        tips("关键字不能为空");
        return false;
    }
}
function tips(str){
    document.getElementById("tips").innerHTML = str;
}
</script>
