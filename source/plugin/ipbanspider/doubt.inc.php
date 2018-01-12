<?php
/**
 * @author JiangHong
 * @copyright 2013
 * 用于管理当前的可疑名单
 */

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=doubt');
    echo '<br /><p>搜索IP：&nbsp;&nbsp;<input type="text" name="searchip" value="'.$_G['gp_searchip'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="查询"/>&nbsp;&nbsp;<b class="green">提示：查询可以查询ip段，具体方式为用*代替,例如：131.*.14.* 、17.*.*.* 、 192.168.1.*</b></p>';
    showformfooter();
    echo '<br /><p>自动刷新<input type="checkbox" checked id="autoref"/></p>';
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=doubt');
    echo '<div id="DOUBT_DIV">';
}else{
    include template('common/header_ajax');
}
if($_G['gp_inajax'] && $_G['groupid']==1){
    include_once libfile('function/admincp');
}
loadcache('plugin');
$pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
require_once libfile('class/myredis');
$redis = & myredis::instance(6379);
//change db
$redis->SELECTDB(1);
$doubttemp = $redis->sMembers($pre.'config_doubtip_set');
if(!empty($_G['gp_searchip'])){
    $grepip = str_replace('*' ,'\d{1,3}' ,$_G['gp_searchip']);
}
foreach($doubttemp as $n => $ip){
    if(!empty($grepip) && preg_match('#'.$grepip.'#i' ,$ip)==0) continue;
    $doubt[$ip] = $redis->ZCARD($pre.'history_ban_'.$ip);
}
arsort($doubt);
$blacklist = $redis->zRange($pre.'blacklist' ,0 ,-1);
echo '<br /><p><b>此处显示为当前可疑的IP信息（当前规则为每<b class="blue">'.($_G['cache']['plugin']['ipbanspider']['record_pertime'] > 0 ? $_G['cache']['plugin']['ipbanspider']['record_pertime'] : 5).'秒</b>访问<b class="red">'.($_G['cache']['plugin']['ipbanspider']['record_pernum'] > 0 ? $_G['cache']['plugin']['ipbanspider']['record_pernum'] : 10).'次</b>为可疑ip）</b><b class="red" onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=doubt&v=clear&other=\' ,\'update\')">清空</b></p>';
if(!empty($doubt)){
    echo '<div id="update"></div><ul>';
    foreach($doubt as $dip => $num){
        echo '<li><div><span><b class="blue">'.$dip.'</b>'.(in_array($dip ,$blacklist)?'<b class="red">被封中</b>':'<b onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=black&v=list&other='.$dip.'|doubt|ban\',\'update\')" class="red">封号</b>').'<a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=history&searchip='.$dip.'">历</a><a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=select&searchip='.$dip.'">详</a></span>被封<b class="red">'.$num.'</b>次<em class="red" onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=doubt&v=delete&other='.$dip.'\' ,\'update\')">X</em></div></li>';
    }
    echo '</ul>';
}else{
    echo '<br /><p><b class="green">当前没有可疑IP</b></p>';
}
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
#DOUBT_DIV ul li{float: left;}
#DOUBT_DIV ul li span{margin-left:10px;}
#DOUBT_DIV ul li div{border:1px dashed #0099CC;padding:5px;margin:10px 0 0 10px;}
fieldset{padding: 10px;margin-bottom: 20px;}
em{color:#39F;font-weight: 700;}
.blod{font-weight: bold;}
</style>
<script>
    function find_new(){
        if(document.getElementById('autoref').checked == true){
            ajaxget('plugin.php?id=ipbanspider:doubt' ,'DOUBT_DIV');
        }
    }
    setInterval(find_new,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php } ?>
