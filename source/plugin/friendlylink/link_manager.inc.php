<?php

/**
 * @author gongtianlu
 * �������Ӻ�̨���� --- ���ӹ���
 * ��Ѷ 1|gp_catid
 * ��̳ 2|gp_fid|gp_typeid
 * ���� 3|fid
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';
require_once DISCUZ_ROOT . './source/plugin/friendlylink/flink.func.php';

//�ֶθ���
if (in_array($_GET['field'], array('name','url','displayorder', 'ispass')) && $_GET['id']) {
	$id = (int)$_GET['id'];
	$val = $_GET['val'];
	$field = $_GET['field'];
	//ɾ������
	clear_server($_GET['id']);
	//�������ݿ�
	$sql = "UPDATE " . DB::table('common_friendlink2') . " SET `{$field}` = '{$val}' WHERE id = {$id}";
	$query = DB::query($sql);
	cpmsg('���óɹ�', '', 'succeed');
}

//ɾ������
if($_GET['op'] == 'del' && $_GET['id']) {
	$id = (int)$_GET['id'];
	//ɾ������
	clear_server($id);
	//�������ݿ�
	$sql = "DELETE FROM " . DB::table('common_friendlink2') . " WHERE id = {$id}";
	$query = DB::query($sql);
	cpmsg('ɾ���ɹ�', '', 'succeed');
}

//��ȡ������Ϣ
$cateinfokey = "plugin_friendlylink_cateinfo";
$cateinfo = memory('get', $cateinfokey);
if(!$cateinfo){
	$portal = $forum = $forumclass = array();
	#��Ѷ
	$query = DB::query("SELECT catid,catname FROM " . DB::table('portal_category'));
	while ($values = DB::fetch($query)) {
		$portal[$values['catid']]['name'] = $values['catname'];
	}
	#��̳+����
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

//����
$name = trim($_GET['name']);
$urlstr = trim($_GET['url']);
$wheresql = '';
$name && $conditions[] = "name like '%{$name}%'";
$urlstr && $conditions[] = "url like '%{$urlstr}%'";
$conditions && $wheresql = " where ".implode(' and ', $conditions);

//�б�ҳչʾ #��ҳ��Ϣ
$page = max(intval($_GET['page']), 1);
$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 20;
$start = ($page-1)*$perpage;
$pageurl = ADMINSCRIPT."?action=plugins&operation=config&do=92&identifier=friendlylink&pmod=link_manager&name={$name}&url={$urlstr}&perpage={$perpage}";
$listcount = DB::result_first("SELECT COUNT(*) FROM " . DB::table('common_friendlink2') . " ".$wheresql);
$multipage = multi($listcount, $perpage, $page, $pageurl);

//�б�ҳչʾ #����
$links = false;
$sql = "SELECT * FROM " . DB::table('common_friendlink2') . " $wheresql order by ispass,addtime desc limit {$start},{$perpage}";
$query = DB::query($sql);
while ($values = DB::fetch($query)) {
	$values['addtime'] = date("Y-m-d H:i:s", $values['addtime']);
	$identifies = explode('|', $values['identifie']);
	if($identifies[0] == 1){
		$values['position'] = $identifies[1] ? '��Ѷ>'.$cateinfo[1][$identifies[1]]['name'] : '8264��ҳ';
	}elseif($identifies[0] == 2){
		$values['position'] = $identifies[1] ? $identifies[2] ? '¿����̳>'.$cateinfo[2][$identifies[1]]['name'].'>'.$cateinfo[2][$identifies[1]]['typeid'][$identifies[2]] : '¿����̳>'.$cateinfo[2][$identifies[1]]['name'] : '��̳��ҳ';
	}elseif($identifies[0] == 3){
		$values['position'] = '����>'.$cateinfo[2][$identifies[1]]['name'];
	}
	$links[] = $values;
}
include template('friendlylink:list');
?>