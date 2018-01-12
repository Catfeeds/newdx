<?php

/**
 * @author JiangHong
 * @copyright 2014
 */

if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}

loadcache('plugin');
$pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
$ajaxpertime = $_G['cache']['plugin']['ipbanspider']['ajax_per'] > 1 ? $_G['cache']['plugin']['ipbanspider']['ajax_per'] : 5;
require_once libfile('class/myredis');
$redis = & myredis::instance(6379);
//change db
$redis->SELECTDB(1);
if(!empty($_G['gp_username'])){
	$userid = DB::result_first('SELECT uid FROM ' . DB::table('common_member') . " WHERE username = '{$_G[gp_username]}'");
	$username = $_G['gp_username'];
}elseif(!empty($_G['gp_userid'])){
	$userid = $_G['gp_userid'];
	$username = DB::result_first('SELECT username FROM ' . DB::table('common_member') . " WHERE uid = '{$userid}'");
}
$userid = intval($userid) > 0 ? $userid : 0;

if($_G['gp_method'] == 'add'){
	if($userid > 0){
		$redis->sAdd($pre.'whitelist_by_uid', $userid);
		cpmsg("增加完成", $_SERVER['QUERY_STRING'], 'succeed');exit;
	}
}

if(!$_G['gp_inajax']){
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=userwhite&method=add');
    echo '<fieldset><legend>增加用户</legend><p>新增用户名：&nbsp;&nbsp;<input type="text" name="username" value=""/>&nbsp;&nbsp;或用户ID：&nbsp;&nbsp;<input type="text" name="userid" value=""/>&nbsp;&nbsp;<input type="submit" name="submit" value="增加"/></p></fieldset><br />';
    showformfooter();
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=userwhite');
	echo '<fieldset><legend>搜索用户</legend><p>搜索用户名：&nbsp;&nbsp;<input type="text" name="username" value="'.$_G['gp_username'].'"/>&nbsp;&nbsp;或用户ID：&nbsp;&nbsp;<input type="text" name="userid" value="'.$_G['gp_userid'].'"/>&nbsp;&nbsp;<input type="submit" name="submit" value="查询"/></p></fieldset>';
    showformfooter();
    echo '<br /><p>自动刷新<input type="checkbox" checked id="autoref"/></p>';
    showformheader('plugins&operation=config&do='.$pluginid.'&identifier=ipbanspider&pmod=userwhite');
    echo '<div id="BLACKLIST_DIV">';
}else{
    include template('common/header_ajax');
}
if($_G['gp_inajax'] && $_G['groupid']==1){
    include_once libfile('function/admincp');
}

$page = $_G['gp_page'] >= 1 ? $_G['gp_page'] : 1;
$perpage = $_G['cache']['plugin']['ipbanspider']['page_per'] ? $_G['cache']['plugin']['ipbanspider']['page_per'] : 15;
$nowpage = $perpage * ($page - 1) - 1;
$nowpage = $nowpage >= 0 ? $nowpage : 0;
if(empty($_G['gp_userid']) && empty($_G['gp_username'])){
	$whitelist = $redis->sMembers($pre.'whitelist_by_uid');
	if(!empty($whitelist)){
		$q = DB::query("SELECT uid, username FROM " . DB::table('common_member') . " WHERE uid IN(".dimplode($whitelist).")");
		while($vs = DB::fetch($q)){
			$unamearr[$vs['uid']] = $vs['username'];
		}
	}
}else{
    if($userid > 0){
    	if($redis->sIsMember($pre.'whitelist_by_uid', $userid)){
    		$whitelist[0] = $userid;
    		$unamearr[$userid] = $username;
    	}
    }
}
sort($whitelist);
$count = count($whitelist);
$multipage = multi($count, $perpage, $page, "admin.php?action=plugins&operation=config&do=$pluginid&identifier=ipbanspider&pmod=userwhite");
$multipage = isset($multipage) ? $multipage : '';
showtableheader();
showsubtitle(array('' ,'用户' ,'操作'));
showtablerow('' ,array('colspan="4"') ,array('<p id="update"></p>'));
if(!empty($whitelist)){
    $min = min($nowpage+$perpage ,$count);
    for($i=$nowpage;$i<$min;$i++){
        showtablerow('' ,array('class="td25"','') ,array(
            "<input type=\"checkbox\" class=\"checkbox\" name=\"deletes[]\" value=\"$whitelist[$i]\"/>",
            "<a target='_blank' href='{$_G[config][web][home]}{$whitelist[$i]}'>".$unamearr[$whitelist[$i]]."</a>" , '<b class="red" onclick="ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=userwhite&v=list&other='.$whitelist[$i].'|userwhite|unsafe|'.$unamearr[$whitelist[$i]].'\',\'update\')">移出用户白名单</b>',
        ));
    }
}else{
    showtablerow('' ,array('','colspan="5"'),array('','当前没有用户白名单'));
}
showsubmit('delete' ,'submit' ,'<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'deletes\')" /><label for="chkall">全选</label>' ,'' ,$multipage);
showtablefooter();

if(!$_G['gp_inajax']){
    if(submitcheck('delete')){
        echo '<script>';
        foreach($_G['gp_deletes'] as $dip){
            echo 'ajaxget(\'plugin.php?id=ipbanspider:ajaxget&m=userwhite&v=list&other='.$dip.'|userwhite|unsafe\',\'update\');';
        }
        echo '</script>';
    }
    echo '</div>';
?>
<div id="message" style="display:none;">

</div>
<style>
fieldset{padding:10px 10px;}
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
            ajaxget('plugin.php?id=ipbanspider:userwhite&page=<?php echo $page; ?>&userid=<?php echo $userid; ?>' ,'BLACKLIST_DIV');
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
