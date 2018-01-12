<?php

/**
 * @author wangyanan
 * @copyright 2016
 * 点评系统后台管理 --- 需导入点评管理
 */

if(! defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
include 'dianping.fun.php';

$url = $_SERVER['QUERY_STRING'];
if(!empty($_POST['checkPid'])){
	$ids=$_POST['checkPid'];
	$flag=TRUE;
	foreach($ids as $v){
		DB::query("DELETE FROM ".DB::table('plugin_dianping_quick_reply')." WHERE id=".$v);
		if (DB::affected_rows()==0) {
			$flag=FALSE;
		}
	}
	if ($flag) {
		cpmsg('删除成功', $url, 'succeed');
	}else{
		cpmsg('删除成功', $url, 'succeed');
	}
}
if ($_GET['del'] == 1 && $_GET['quick_id']) {
	$puidarray = array();
	$url = preg_replace('/(&|\?)quick_id=\d+/i', '', $url);
	$url = preg_replace('/(&|\?)del=1/i', '', $url);
	DB::query("DELETE FROM ".DB::table('plugin_dianping_quick_reply')." WHERE id=".$_GET['quick_id']);
	if (DB::affected_rows()>0) {
        cpmsg('删除成功', $url, 'succeed');
    } else {
        cpmsg('删除失败', $url, 'error');
    }
    
    exit;
}

//判断是否为关键字搜索
if($_G['gp_search']){
	$_G['gp_page']='';
}
$ppp = 20;
$page = max(1, intval($_G['gp_page']));

//增加搜索条件
$search_type = $_G['gp_search_type']?$_G['gp_search_type']:$_G['gp_search_type_g'];
$search_key  =  $_G['gp_search_key']?$_G['gp_search_key']:$_G['gp_search_key_g'];
$search_where = '';
$search_get='';
if (!empty($search_type) && !empty($search_key)) {
	switch ($search_type){
		case 'reply_origin':
			$search_where .= " WHERE f.name LIKE '%{$search_key}%' ";
			break;
		case 'threadName':
			$search_where .= " WHERE a.subject LIKE '%{$search_key}%' ";
			break;
		case 'author':
			$search_where .= " WHERE a.authorname LIKE '%{$search_key}%' ";
			break;
		default:
			$search_where .= " WHERE a.data4 LIKE '%{$search_key}%' ";
			break;
	}
	$search_get.="&search_type_g=$search_type&search_key_g=$search_key";
}
	
	$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_dianping_quick_reply')." AS a LEFT JOIN ".DB::table('forum_forum')." AS f on a.reply_origin=f.fid $search_where". getSlaveID());
	$array = array();
	$tem = ($count - ($page - 1) * $ppp)+1;
	//echo "SELECT b.extcredits5,a.*,f.name as fname FROM ".DB::table('forum_forum')." AS f right join ".DB::table('plugin_dianping_quick_reply')." AS a on a.fid=f.fid LEFT JOIN ".DB::table('common_member_count') ." AS b ON a.authorid=b.uid $search_where ORDER BY tid ASC,dateline DESC LIMIT ".($page - 1)*$ppp.", $ppp"; 
	$query = DB::query("SELECT b.extcredits5,a.*,f.name as fname FROM ".DB::table('forum_forum')." AS f right join ".DB::table('plugin_dianping_quick_reply')." AS a on a.reply_origin=f.fid LEFT JOIN ".DB::table('common_member_count') ." AS b ON a.authorid=b.uid $search_where ORDER BY tid ASC,dateline DESC LIMIT ".($page - 1)*$ppp.", $ppp".getSlaveID());
	while ($value = DB::fetch($query)) {

			$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
			$value['starnum'] = $value['starnum'] ? $value['starnum'] : 0;
			$value['srcid'] = $ford[$value['fid']];
			$value[$value['pid']]['number'] = --$tem;
			$value['coin']=$value['extcredits5'];
			$array[] = $value;

	}

	$urls = $_SERVER['REQUEST_URI'];
	$multi = multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=dianping&pmod=xdrdianping_manager".$search_get.$url_path);

	include template('dianping:xdrdianping');



