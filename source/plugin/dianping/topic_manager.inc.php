<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 点评系统后台管理 --- 主题管理
 */

if(! defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
include 'dianping.fun.php';
$dianpingmodules = m('dianpingmodules');
$modules = $dianpingmodules->findAll();
$url = $_SERVER['REQUEST_URI'];
if(empty($modules)) exit('暂时无模块，请去系统管理中添加');
if($_GET['op']&&$_GET['tid']){
	$isshow = $_GET['isshow'];
	$tid = $_GET['tid'];
	$dianpingmod = m($_GET['op']);
	$aa = $dianpingmod->checkThis($tid,$isshow);
	$urls = $_SERVER['QUERY_STRING'];
	$urls= preg_replace('/(&|\?)tid=\d+/i', '', $urls);
	$urls = preg_replace('/(&|\?)isshow=1/i', '', $urls);
	$urls = preg_replace('/(&|\?)isshow=0/i', '', $urls);
	cpmsg('设置成功', $urls, 'succeed');
}

$fids =  array();
foreach($modules as $k){
	$modules_array[] = $k['srcid'];
	$fids[] = $k['fid'];
	$mods[$k['fid']] = $k['mname'];
	$src[$k['fid']] = $k['srcid'];
	$ord[$k['srcid']] = $k['srcid'];
	$wh[$k['srcid']] = $k['fid'];
}

$prefix = 'plugin_dianping_';
if (!empty($_POST)) {
	if (!empty($_POST['search'])) {
		unset($_POST['search']);
		$_G['gp_page'] = 1;
		foreach ($_POST as $postid => $post) {
			$_SESSION[$prefix.$postid] = $post;
		}
	} else {

	}
}



$search = array();
$ppp = 50;
$page = max(1, intval($_G['gp_page']));

foreach (explode(' ', 'kName tid ispublish orderby horl') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$search['kName'] = $_G['gp_kName'];
$search['ispublish'] = $_G['gp_ispublish'];
$search['orderby'] = $_G['gp_orderby'];
$search['horl'] = $_G['gp_horl'];

$where = ' WHERE 1=1 and displayorder >=0 ';
if (!empty($search['kName'])) {
	$where .= " AND subject LIKE '%{$search['kName']}%'";
	$sub = $search['kName'];
}
if (!empty($search['tid'])) {
	$where .= " AND tid in ('$search[tid]')";
	$tid = $search[tid];
}
if ($search['ispublish'] != '') {
	$where .= " AND closed = ('$search[ispublish]')";
	$close = $search[ispublish];
}

$nowmodule = $_G['gp_fmod'];
if(empty($nowmodule)){
	if($nowmodule===''){
		echo '暂无数据';exit;
	}
	$fids = implode(',',$fids);
	$where .= " and fid in ($fids)";
	$count = DB::result_first("select count(*) from ".DB::table('forum_thread')." $where order by dateline");
	$sql = "select * from ".DB::table('forum_thread')." $where order by dateline desc limit ".($page - 1)*$ppp.", $ppp";
	$query = DB::query($sql);
	$threadlist = array();
	while ($value = DB::fetch($query)) {
		$status = $value['closed']==1 ? '<span style="color:red">未审核</span>':'<span style="color:green">已审核</span>';
		$threadlist['list'][] = array(
					'tid' => $value['tid'],
					'fid' => $value['fid'],
					'author' => $value['author'],
					'authorid' => $value['authorid'],
					'subject' => $value['subject'],
					'replies' => $value['replies'],
					'dateline' => date('Y-m-d H:i', $value['dateline']),
					'closed' => ($value['closed'] ^ 1),
					'status' => $status,
					'scr' => $src[$value['fid']],
					'mod' => $mods[$value['fid']],
				);
	}
	$threadlist['multi'] = multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=dianping&pmod=topic_manager&kName=$search[kName]&ispublish=$search[ispublish]&orderby=$search[orderby]&horl=$search[horl]");

}elseif(in_array($nowmodule, $modules_array)){
	$modules_obj[$nowmodule] = m($nowmodule);
	if(empty($modules_obj[$nowmodule])){
		echo '暂无数据';exit;
	}
	/***
	*  更改招商状态
	*/
	if (isset($_GET['gid']) && isset($_GET['zs'])) {
		$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE id = {$_GET[gid]}");
		DB::query("UPDATE ".DB::table('dianping_brand_info')." SET zhaoshang = {$_GET['zs']} WHERE id = {$_GET['gid']}");
		$url = $_SERVER['QUERY_STRING'];
		$url = preg_replace('/&?gid=\d+/', '', $url);
		$url = preg_replace('/&?zs=\d+/', '', $url);
		cpmsg('操作成功', $url, 'succeed');
	}
	/***
	*  更改置顶状态
	*/
	if (isset($_GET['gid']) && isset($_GET['zd'])) {
		$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE id = {$_GET[gid]}");
		DB::query("UPDATE ".DB::table('dianping_brand_info')." SET displayorder = {$_GET['zd']} WHERE id = {$_GET[gid]}");
		DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder = {$_GET['zd']} WHERE tid = {$info['tid']}");
		$url = $_SERVER['QUERY_STRING'];
		$url = preg_replace('/&?gid=\d+/', '', $url);
		$url = preg_replace('/&?zd=\d+/', '', $url);
		cpmsg('操作成功', $url, 'succeed');
	}
	$where =" 1 = 1 and t.displayorder!=-1 ";
	//$cont = " 1 = 1 ";
	if (!empty($search['kName'])) {
		$sub = $search['kName'];
		$where .= " AND t.subject LIKE '%{$sub}%'";
		//$cont .=" and subject like '%{$sub}%'";
	}
	if (!empty($search['tid'])) {
		$tid = $search[tid];
		$where .= " AND {$modules_obj[$nowmodule]->alias}.{$modules_obj[$nowmodule]->_vars[tid]} in ($tid) ";
		//$cont .=" and tid in ({$tid})";
	}
	if ($search['ispublish'] != '') {
		if($search['ispublish'] ==1){
			$where .=" and {$modules_obj[$nowmodule]->alias}.{$modules_obj[$nowmodule]->_vars[enable]} = 0 ";
		//	$cont .=" and closed = 1";

		}elseif($search['ispublish'] ==0){
			$where .=" and {$modules_obj[$nowmodule]->alias}.{$modules_obj[$nowmodule]->_vars[enable]} = 1 ";
		//	$cont .=" and closed = 0";
		}
	}
    /*由于最终此处order还是会进入dianpingmod.model进行处理，防止dateline冲突，此处做例外处理*/
    if($nowmodule == 'diving' || $nowmodule == 'climb' || $nowmodule == 'line' || $nowmodule == 'mountain' ||  $nowmodule == 'fishing' || $nowmodule == 'skiing'){
        $orderby = 'id';
    }else{
        $orderby = 'dateline';
    }
	if ($search['orderby'] != '') {
		if($search['orderby'] ==1){
			$orderby ="displayorder";
		}elseif($search['ispublish'] ==0){
			$orderby ="dateline";
		}
	}
	$horl = 'desc';
	if ($search['horl'] != '') {
		if($search['horl'] ==1){
			$horl ="asc";
		}elseif($search['horl'] ==0){
			$horl ="desc";
		}
	}
	//$count = DB::result_first("select count(*) from ".DB::table('forum_thread')." where $cont and fid in($wh[$nowmodule]) and displayorder<>-1");
	if($nowmodule=='brand'){
		//引入点评新版公用配置文件
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		$threadlist = array();
		$pplist = array();
		foreach ($dp_category['brand']['ranklist'] as $ppid => $ppname) {
			$pplist[] = array('id' => $ppid, 'produce' => $ppname);
		}

		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_brand_info')." AS bd
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = bd.tid where $where");

	}else{
		// if($nowmodule == 'diving' || $nowmodule == 'climb' || $nowmodule == 'club' || $nowmodule == 'hostel' || $nowmodule == 'line' || $nowmodule == 'fishing' || $nowmodule == 'mountain' || $nowmodule == 'equipment' || $nowmodule == 'skiing' || $nowmodule == "shop"){
            $count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_'.$nowmodule.'_info')." AS {$modules_obj[$nowmodule]->alias}
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = {$modules_obj[$nowmodule]->alias}.tid where $where");
       //  }else{
       //      $count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_'.$nowmodule.'_info')." AS {$modules_obj[$nowmodule]->alias}
				   // LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = {$modules_obj[$nowmodule]->alias}.tid where $where");
       //  }

		//$count = DB::result_first("select count(*) from ".DB::table('forum_thread')." where $cont and fid in($wh[$nowmodule]) and displayorder<>-1");
	}
	//echo $where;exit;
	$threads = $modules_obj[$nowmodule]->getlist(array('where'=>$where,
							'start'=>($page - 1)*$ppp,
							'limit'=>$ppp,
							'order'=>array($orderby=>$horl)),-1);

	foreach($threads as $value){
				if($nowmodule=='brand'){
					$zs = $modules_obj[$nowmodule]->get(array('fields'=>'id,zhaoshang,zstel','conditions'=>'tid='.$value['tid']));
				}
                                if($nowmodule=='club'){
					$cl = $modules_obj[$nowmodule]->get(array('fields'=>'contact,tel,weixin,qq','conditions'=>'tid='.$value['tid']));
				}
                                if($nowmodule=='hostel'){
					$cl = $modules_obj[$nowmodule]->get(array('fields'=>'contact,tel,weixin,qq','conditions'=>'tid='.$value['tid']));
				}
				$threadlist['list'][] = array(
							'tid' => $value['tid'],
							'subject' => $value['subject'],
							'id' => $zs['id'],
							'bzs' => $zs['zhaoshang'],
							'zstel' => $zs['zstel'],
                                                        'contact'=>$cl['contact'],
                                                        'tel'=>$cl['tel'],
                                                        'weixin'=>$cl['weixin'],
                                                        'qq'=>$cl['qq'],
							'displayorder' => $value['displayorder'],
							'author' => $value['author'],
							'authorid' => $value['authorid'],
							'replies' => $value['replies'],
							'dateline' => $value['dateline'],
							'orderby' => $value['orderby'],
							'fid' => $value['fid'],
							'scr' => $src[$value['fid']],
							'closed' => $value['enable'],
							'status' => $value['enable']==1 ? '<span style="color:green">已审核</span>':'<span style="color:red">未审核</span>',
							'mod' => $mods[$value['fid']],
						);

	}
	$url = $_SERVER['REQUEST_URI'];
	//$count = count($threadlist['list']);
	$threadlist['multi'] = multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=dianping&pmod=topic_manager&fmod=$nowmodule&kName=$search[kName]&ispublish=$search[ispublish]&orderby=$search[orderby]&horl=$search[horl]");
}
include template('dianping:list');
?>
