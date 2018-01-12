<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 防爬虫和统计程序的页面嵌入
 * @filesource ipbanspider.class.php
 */

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
if($_G['gp_inajax']==1){
    include template('common/header_ajax');
}else{
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=spider');
?>
<br />
<fieldset>
<legend>添加模块</legend>
<p>蜘蛛名：<input type="text" name="name" size="20" maxlength="25" />&nbsp;<select name="friend"><option value="0">不友好</option><option value="1">友好</option></select>&nbsp;<input type="submit" name="submit" value="添加"/></p>
<br />
<span class="blue" onclick="if(confirm('清空后所有爬虫的访问计数将被归零重新计算！是否确认？'))ajaxget('plugin.php?id=ipbanspider:ajaxget&m=spider&v=clear' ,'updates');">清空缓存(<b class="red">相关的访问量将清空</b>)</span>
<br /><p><span class="blue">自动刷新<input type="checkbox" id="autoref"/></span><span onclick="ajaxget('plugin.php?id=ipbanspider:spider' ,'SPIDER_DIV');" class="green">刷新</span></p>
</fieldset>
<?php showformfooter(); ?>
<fieldset>
<legend>管理模块</legend>
<div id="SPIDER_DIV">
<?php
}
require dirname(__FILE__).'/spider.class.php';
if($_POST){
    if(strlen($_G['gp_name']) > 0){
        spider::add($_G['gp_name'] ,$_G['gp_friend']);
    }else{
        cpmsg('提交蜘蛛名不能为空', 'action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=spider', 'error');
    }
}
loadcache('plugin');
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
$q = DB::query("SELECT * FROM ".DB::table('plugin_ipbanspider_spiders'));
while($v = DB::fetch($q)){
    $spiders[] = $v;
}
?>
<?php if(!empty($spiders)){ ?>
    <div id="updates"></div>
    <ul>
        <?php
        foreach($spiders as $f){
            $num = spider::getval($f['friend'] ,$f['sname']);
        ?>
        <li><div><b class="blue"><?php echo $f['sname']; ?></b><span><?php echo $f['friend']==1 ? '<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=spider&v=update&other='.$f['sid'].'|0\',\'updates\');" class="green">友好</b>' : '<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=spider&v=update&other='.$f['sid'].'|1\',\'updates\');" class="red">不友好</b>'; ?></span><em><?php echo $num; ?></em><span onclick="ajaxget('plugin.php?id=ipbanspider:ajaxget&m=spider&v=delete&other=<?php echo $f['sid'];?>|0','updates');" class="red bold">X</span></div></li>
        <?php } ?>
    </ul>
    <p style="clear: both;" class="red"><br />所有疑似蜘蛛</p>
    <ul>
        <?php
        foreach(spider::getmaybespider() as $k => $v){
        ?>
            <li><div><b class="blue"><?php echo $k ?></b><em><?php echo $v; ?></em></div></li>
        <?php
        }
        ?>
    </ul>
<?php }else{ ?>
    <p>当前没有蜘蛛信息</p>
<?php }
if($_G['gp_inajax']==1){
    include template('common/footer_ajax');
}else{
?>
</div>
</fieldset>
<style>
#update p{text-align: center;border:1px solid #F4E4B4;background: #FFFFE9;cursor: pointer;}
#update p a{color:#EFAA00;}
#update p b{margin:0 5px;}
.green,.red,.blue{margin: 0 3px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
#SPIDER_DIV ul li{float: left;}
#SPIDER_DIV ul li span{margin-left:10px;}
#SPIDER_DIV ul li div{border:1px dashed #0099CC;padding:5px;margin:10px 0 0 10px;}
fieldset{padding: 10px;margin-bottom: 20px;}
em{color:#39F;font-weight: 700;}
.blod{font-weight: bold;}
</style>
<script>
    function find_new(){
        if(document.getElementById('autoref').checked == true){
            ajaxget('plugin.php?id=ipbanspider:spider' ,'SPIDER_DIV');
        }
    }
    setInterval(find_new,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php } ?>
