<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 点评系统后台管理 --- 点评管理
 */

if(! defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
include 'dianping.fun.php';
$dianpingmodules = m('dianpingmodules');
$modules = $dianpingmodules->findAll();
if(empty($modules)) exit('暂时无模块，请去系统管理中添加');
$fids =  array();
foreach($modules as $k){
	$modules_array[] = $k['srcid'];
	$fids[] = $k['fid'];
	$mods[$k['fid']] = $k['mname'];
	$fd[$k['srcid']]=$k['fid'];
	$ord[$k['srcid']] = $k['srcid'];
	$ford[$k['fid']] = $k['srcid'];
}

$url = $_SERVER['QUERY_STRING'];
	if(!empty($_POST['checkPid'])){
		if(delDp($_POST['checkPid'])==1){
			cpmsg('删除成功', $url, 'succeed');
		}else{
			cpmsg('删除失败', $url, 'error');
		}
	}

if ($_GET['del'] == 1 && $_GET['pid']) {
	$puidarray = array();
	$url = preg_replace('/(&|\?)pid=\d+/i', '', $url);
	$url = preg_replace('/(&|\?)del=1/i', '', $url);
	if (delDp($_GET['pid'])) {
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
$ppp = 50;
$page = max(1, intval($_G['gp_page']));

//增加搜索条件
$search_type = $_G['gp_search_type']?$_G['gp_search_type']:$_G['gp_search_type_g'];
$search_key  =  $_G['gp_search_key']?$_G['gp_search_key']:$_G['gp_search_key_g'];
$search_where = '';
$search_get='';
if (!empty($search_type) && !empty($search_key)) {
	switch ($search_type){
		case 'threadName':
			$search_where .= " AND t.subject LIKE '%{$search_key}%' ";
			break;
		case 'author':
			$search_where .= " AND p.author LIKE '%{$search_key}%' ";
			break;
		default:
			$search_where .= " AND p.message LIKE '%{$search_key}%' ";
			break;
	}
	$search_get.="&search_type_g=$search_type&search_key_g=$search_key";
}

$nowmodule = $_G['gp_fmod'] ? $_G['gp_fmod'] : 'equipment';
if(!empty($nowmodule)){
  	$where = " WHERE p.first=0 AND p.fid = ".$fd[$nowmodule].$search_where;
  	$url_path="&fmod=".$nowmodule;
}else{
	$url_path="";
	$fids = implode(',',$fids);
	$where= " WHERE p.first=0 AND p.fid = ".$fids.$search_where;
}
	if($_GET['orderby']=='order'){
		$order= "ORDER BY b.showorder DESC,p.pid DESC";
	}else {
		$order="ORDER BY p.pid DESC";
	}
	$count = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." AS p
	                    		   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid=p.tid
	                    		   LEFT JOIN ".DB::table('dianping_star_logs')." AS b ON p.pid = b.pid
								   $where " . getSlaveID());
	if($nowmodule=='mountain'){
		$bicount = DB::result_first('SELECT count(*) FROM '.DB::table('forum_post').' AS p where p.first=0 AND p.fid in ('.$fd[$nowmodule].') and rate<>0 ' . getSlaveID());
	}
	$array = array();
	$tem = ($count - ($page - 1) * $ppp)+1;
	$query = DB::query("SELECT c.extcredits5,p.pid,p.dateline,b.goodpoint,b.showorder,b.weakpoint,p.rate,p.fid,p.message,p.author,p.authorid,p.tid,b.starnum,t.subject AS threadName FROM ".DB::table('forum_post')." AS p
	                    LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid=p.tid
	                    LEFT JOIN ".DB::table('dianping_star_logs')." AS b ON p.pid = b.pid
	                    LEFT JOIN ".DB::table('common_member_count')." AS c ON p.authorid = c.uid
					    $where
					    $order
						LIMIT ".($page - 1)*$ppp.", $ppp".getSlaveID());

	while ($value = DB::fetch($query)) {

			$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
			$value['starnum'] = $value['starnum'] ? $value['starnum'] : 0;
			$value['srcid'] = $ford[$value['fid']];
			$value[$value['pid']]['number'] = --$tem;
			$value['coin']=$value['extcredits5'];
			$array[] = $value;

	}

	$urls = $_SERVER['REQUEST_URI'];
	$multi = multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=dianping&pmod=dianping_manager".$search_get.$url_path);
/**
 *
 * 删除点评
 * @param $pid
 */
function delDp($pid){
	global $_G;
	$puidarray = array();
	require_once libfile("function/delete");
	require_once libfile('function/post');
	require_once libfile('function/misc');
	require_once libfile('function/feed');
	//删除
	$dp = m('dianping');
	if(!is_array($pid)){
		$pid=array('0'=>$pid);
	}
		foreach ($pid as $value){
			$post = DB::fetch_first("select tid,authorid,fid from ".DB::table('forum_post')." where pid='$value'".getSlaveID());
			foreach ($_G['config']['fids'] as $key=>$val){
				if($val==$post['fid'] && $key!="zbfx" && $key!="mudidi" && $key!="produce" && $key!='dianpu'){
					 $mod=$key;
					 break;
				}
			}
			if (deletepost('pid='.$value)) {
				$score = $dp->delStar($value);
				if($score===NULL){
					$update_set=" cnum=cnum-1 ";
				}else{
					//更新首页评分
					$update_set=" cnum=cnum-1,score ='$score',lastscore = '$dp->t_lastprice'";
				}
					//更新点评数
			//	if($mod=='diving' || $mod=='climb' || $mod=='brand' || $mod=='fishing' || $mod=='equipment' || $mod=='shop'){
					DB::query("UPDATE ".DB::table('dianping_'.$mod.'_info')." SET $update_set WHERE tid='$post[tid]'", 'UNBUFFERED');
				//}else {
			//		DB::query("UPDATE ".DB::table('plugin_'.$mod.'_info')." SET $update_set WHERE tid='$post[tid]'", 'UNBUFFERED');
			//	}
				//删除用户中心动态
				deletefeed('', 'dianping', $value);
				$puidarray[] = $post['authorid'];
				if ($puidarray) {
					updatepostcredits('-', $puidarray, 'reply', $post['fid']);
					updatethreadcount($post['tid'], 1);
					updateforumcount($post['fid']);
				}

		    }
		}
	return 1;

}
	include template('dianping:dianping');



