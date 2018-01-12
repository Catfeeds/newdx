<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$set= $_G['cache']['plugin']['drc_qqgroup'];
$offset = $set['offset'];
$admins = explode(",", $set['admins']);
$groups = unserialize($set['groups']);
$notice = $set['notice'];
$perpage = $set['perpage'];
$plugin_nav = lang('plugin/drc_qqgroup', 'main_nav');
if($offset != 1){
	showmessage(lang('plugin/drc_qqgroup', 'main_offset'));
}elseif(!in_array($_G['groupid'], $groups)){
	showmessage(lang('plugin/drc_qqgroup', 'main_group'));
}

$side_list = $side_lists = array();
$side_query = DB::query("SELECT * FROM ".DB::table('drc_qqgroup_type')." ORDER BY displayorder");
while($side_list = DB::fetch($side_query)){
	$side_lists[] = $side_list;
}

if(empty($_G['gp_mod'])){
	$sqlwhere = '';
	$typeurl = '';
	if(intval($_G['gp_qtid'])){
		$qtid = intval($_G['gp_qtid']);
		$sqlwhere = 'typeid='.$qtid.' AND';
		$typeurl = '&qtid='.$qtid;
	}
	$page = empty($_G['page']) ? 1 : $_G['page'];
	$indexnum = DB::result_first("SELECT COUNT(*) FROM ".DB::table('drc_qqgroups')." WHERE {$sqlwhere} display=1");
	$start_limit = ($page - 1) * $perpage;
	$multipage = multi($indexnum, $perpage, $page, 'plugin.php?id=drc_qqgroup:main'.$typeurl, 0, 10);
	$sql = "SELECT * FROM ".DB::table('drc_qqgroups')." WHERE {$sqlwhere} display=1 ORDER BY id DESC LIMIT $start_limit, $perpage";
	$query = DB::query($sql);
	$index_list = $index_lists = array();
	while($index_list = DB::fetch($query)){
		$index_list['createtime'] = dgmdate($index_list['createtime'], 'd');
		$index_lists[] = $index_list;
	}
	include template('drc_qqgroup:main');
}elseif($_G['gp_mod'] == 'cpanel'){
	if(!in_array($_G['uid'], $admins)){
		showmessage(lang('plugin/drc_qqgroup', 'main_noadmins'));
	}else{
		require_once './source/plugin/drc_qqgroup/cpanel.inc.php';
	}
}elseif($_G['gp_mod'] == 'add'){
	require_once './source/plugin/drc_qqgroup/add.inc.php';
}else{
	showmessage('undefined_action');
}
?>