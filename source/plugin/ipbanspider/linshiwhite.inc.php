<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=linshiwhite');
    echo '<br /><p>搜索IP：&nbsp;&nbsp;<input type="text" name="searchip" value="'.$_G['gp_searchip'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="查询"/>&nbsp;&nbsp;<b class="green">提示：查询可以查询ip段，具体方式为用*代替,例如：131.*.14.* 、17.*.*.* 、 192.168.1.*</b></p>';
    showformfooter();
    echo '<br /><p>自动刷新<input type="checkbox" checked id="autoref"/></p>';
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=linshiwhite');
    echo '<div id="BLACKLIST_DIV">';
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
$page = $_G['gp_page'] >= 1 ? $_G['gp_page'] : 1;
$perpage = $_G['cache']['plugin']['ipbanspider']['page_per'] ? $_G['cache']['plugin']['ipbanspider']['page_per'] : 15;
$nowpage = $perpage * ($page - 1) - 1;
$nowpage = $nowpage >= 0 ? $nowpage : 0;
if(empty($_G['gp_searchip'])){
	$whitelist = $redis->keys($pre.'whitelist_linshi_*_*');
}else{
    $grepip = str_replace('.' ,'_' ,$_G['gp_searchip']);
    $whitelist = $redis->keys($pre.'whitelist_linshi_*_' . $grepip);
}
sort($whitelist);
$count = count($whitelist);
$multipage = multi($count, $perpage, $page, "admin.php?action=plugins&operation=config&do=$pluginid&identifier=ipbanspider&pmod=linshiwhite");
$multipage = isset($multipage) ? $multipage : '';
showtableheader();
showsubtitle(array('' ,'IP' ,'访问次数' ,'剩余时间' ,'操作'));
showtablerow('' ,array('colspan="4"') ,array('<p id="update"></p>'));
if(!empty($whitelist)){
    $min = min($nowpage+$perpage ,$count);
    for($i=$nowpage;$i<$min;$i++){
    	$_mykey = $whitelist[$i];
    	$whitelist[$i] = str_replace($pre.'whitelist_linshi_', '', $whitelist[$i]);
    	if(substr($whitelist[$i],0,2) == 'no'){
    		$t_pre = "[<b class='red'>未登录</b>]";
    		$_logon = 0;
    		$whitelist[$i] = str_replace('nologon_', '', $whitelist[$i]);
    	}else{
    		$_logon = 1;
    		$t_pre = "[<b class='green'>登录</b>]";
    		$whitelist[$i] = str_replace('logon_', '', $whitelist[$i]);
    	}
    	$whitelist[$i] = str_replace('_', '.', $whitelist[$i]);
        showtablerow('' ,array('class="td25"','','','') ,array(
            "<input type=\"checkbox\" class=\"checkbox\" name=\"deletes[]\" value=\"$whitelist[$i]\">",
            $whitelist[$i].$t_pre.'<a class="blue" href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=history&searchip='.$whitelist[$i].'">历</a><b onclick="getmessage(\''.$whitelist[$i].'\')" class="blue">详</b>' , $redis->ZCARD($pre.'COMMON_IP_'.$whitelist[$i].'_zset'), timeshow($redis->ttl($_mykey)) , '<b class="red" onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=linshiwhite&v=list&other='.$whitelist[$i].'|linshiwhite|unsafe|'.$_logon.'\',\'update\')">移出临时白名单</b>',
        ));
    }
}else{
    showtablerow('' ,array('','colspan="5"'),array('','当前没有临时白名单IP'));
}
showsubmit('delete' ,'submit' ,'<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'deletes\')" /><label for="chkall">全选</label>' ,'' ,$multipage);
showtablefooter();
function timeshow($timenum){
	if($timenum < 0){
		return "无限制";
	}else{
		$hour = floor($timenum / 3600);
		$minute = floor($timenum % 3600 / 60);
		$second = $timenum - $hour * 3600 - $minute * 60;
		return ($hour > 0 ? "{$hour}小时" : '') . ($minute > 0 ? "{$minute}分钟" : '') . ($second > 0 ? "{$second}秒" : '');
	}
}
if(!$_G['gp_inajax']){
    if(submitcheck('delete')){
        echo '<script>';
        foreach($_G['gp_deletes'] as $dip){
            echo 'ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=linshiwhite&v=list&other='.$dip.'|linshiwhite|unsafe\',\'update\');';
        }
        echo '</script>';
    }
    echo '</div>';
?>
<div id="message" style="display:none;">

</div>
<style>
#update p{text-align: center;border:1px solid #F4E4B4;background: #FFFFE9;cursor: pointer;}
#update p a{color:#EFAA00;}
#update p b{margin:0 5px;}
.green,.red,.blue{margin: 0 3px;cursor: pointer;}
.green{color:green;}
.red{color:red;}
.blue{color:blue;}
#message{position: absolute;top: 50px;left: 50px; width: 950px;height: 620px;border: 5px #CCC solid;background: white;}
#message #list{overflow-y: scroll;width: 950px;height: 520px;}
#message #user{overflow-y: scroll;width: 950px;height:70px;}
#message h3{text-align: center;}
#message h3 span{float:right;cursor: pointer;}
#message ul li{float:left;border:1px dashed #0099CC;padding:3px;margin:5px 0 0 5px;}
#message ul li span{margin-left:10px;}
</style>
<script>
    function find_new(){
        if(document.getElementById('autoref').checked == true){
            ajaxget('plugin.php?id=ipbanspider:linshiwhite&page=<?php echo $page; ?>&searchip=<?php echo $_G['gp_searchip']; ?>' ,'BLACKLIST_DIV');
        }
    }
    function getmessage(ip){
        ajaxget('plugin.php?id=ipbanspider:ajaxget&m=select&v=find&other='+ip ,'message');
    }
    setInterval(find_new,<?php echo $ajaxpertime*1000 ?>);
</script>
<?php
}else{
    include template('common/footer_ajax');
}
?>
