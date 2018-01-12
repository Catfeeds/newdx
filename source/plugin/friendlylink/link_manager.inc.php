<?php

/**
 * @author gongtianlu
 * 友情链接后台管理 --- 链接管理
 * 资讯 1|gp_catid
 * 论坛 2|gp_fid|gp_typeid
 * 点评 3|fid
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';
require_once DISCUZ_ROOT . './source/plugin/friendlylink/flink.func.php';

//字段更新
if (in_array($_GET['field'], array('name','url','displayorder', 'ispass')) && $_GET['id']) {
	$id = (int)$_GET['id'];
	$val = $_GET['val'];
	$field = $_GET['field'];
	//删除缓存
	clear_server($_GET['id']);
	//更新数据库
	$sql = "UPDATE " . DB::table('common_friendlink2') . " SET `{$field}` = '{$val}' WHERE id = {$id}";
	$query = DB::query($sql);
	cpmsg('设置成功', '', 'succeed');
}

//删除操作
if($_GET['op'] == 'del' && $_GET['id']) {
	$id = (int)$_GET['id'];
	//删除缓存
	clear_server($id);
	//更新数据库
	$sql = "DELETE FROM " . DB::table('common_friendlink2') . " WHERE id = {$id}";
	$query = DB::query($sql);
	cpmsg('删除成功', '', 'succeed');
}

//获取分类信息
$cateinfokey = "plugin_friendlylink_cateinfo";
$cateinfo = memory('get', $cateinfokey);
if(!$cateinfo){
	$portal = $forum = $forumclass = array();
	#资讯
	$query = DB::query("SELECT catid,catname FROM " . DB::table('portal_category'));
	while ($values = DB::fetch($query)) {
		$portal[$values['catid']]['name'] = $values['catname'];
	}
	#论坛+点评
	$query = DB::query("SELECT fid,typeid,name FROM " . DB::table('forum_threadclass'));
	while ($values = DB::fetch($query)) {
		$forumclass[$values['fid']][$values['typeid']] = $values['name'];
	}
	$query = DB::query("SELECT fid,name FROM " . DB::table('forum_forum'));
	while ($values = DB::fetch($query)) {
		$forum[$values['fid']]['name'] = $values['name'];
		$forum[$values['fid']]['typeid'] = $forumclass[$values['fid']];
	}
	$cateinfo[1] = $portal;
	$cateinfo[2] = $forum;
	memory('set', $cateinfokey, $cateinfo, 86400);
}

//搜索
$name = trim($_GET['name']);
$urlstr = trim($_GET['url']);
$wheresql = '';
$name && $conditions[] = "name like '%{$name}%'";
$urlstr && $conditions[] = "url like '%{$urlstr}%'";
$conditions && $wheresql = " where ".implode(' and ', $conditions);

//列表页展示 #分页信息
$page = max(intval($_GET['page']), 1);
$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 20;
$start = ($page-1)*$perpage;
$pageurl = ADMINSCRIPT."?action=plugins&operation=config&do=92&identifier=friendlylink&pmod=link_manager&name={$name}&url={$urlstr}&perpage={$perpage}";
$listcount = DB::result_first("SELECT COUNT(*) FROM " . DB::table('common_friendlink2') . " ".$wheresql);
$multipage = multi($listcount, $perpage, $page, $pageurl);

//列表页展示 #数据
$links = false;
$sql = "SELECT * FROM " . DB::table('common_friendlink2') . " $wheresql order by ispass,addtime desc limit {$start},{$perpage}";
$query = DB::query($sql);
while ($values = DB::fetch($query)) {
	$values['addtime'] = date("Y-m-d H:i:s", $values['addtime']);
	$identifies = explode('|', $values['identifie']);
	if($identifies[0] == 1){
		$values['position'] = $identifies[1] ? '资讯>'.$cateinfo[1][$identifies[1]]['name'] : '8264首页';
	}elseif($identifies[0] == 2){
		$values['position'] = $identifies[1] ? $identifies[2] ? '驴友论坛>'.$cateinfo[2][$identifies[1]]['name'].'>'.$cateinfo[2][$identifies[1]]['typeid'][$identifies[2]] : '驴友论坛>'.$cateinfo[2][$identifies[1]]['name'] : '论坛首页';
	}elseif($identifies[0] == 3){
		$values['position'] = '点评>'.$cateinfo[2][$identifies[1]]['name'];
	}
	$links[] = $values;
}
include template('friendlylink:list');
?>