<?php

/**
 * http://www.8264.com/plugin.php?id=friendlylink:setinlink
 * @author gtl
 * �������Ӻ�̨���� --- ���ݸ���
 * ��Ѷ 1|gp_catid
 * ��̳ 2|gp_fid|gp_typeid
 * ���� 3|fid
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';
require_once DISCUZ_ROOT . './source/plugin/friendlylink/flink.func.php';
$setlink = 1;
$nosetlink = 0;

//�������� ����Ԥ��
$insert_data[] = "(0, '8264������Ѷ', '', '', 0, {$setlink})";
$insert_data[] = "(0, '8264��̳', '', '', 0, {$setlink})";
$insert_data[] = "(0, '8264����', '', '', 0, {$setlink})";
$insert_data[] = "(0, '����', '', '', 0, {$setlink})";
$insert_data[] = "(0, 'Ԥ��', '', '', 0, {$setlink})";
$insert_data[] = "(0, 'Ԥ��', '', '', 0, {$setlink})";
$insert_data[] = "(0, 'Ԥ��', '', '', 0, {$setlink})";
$insert_data[] = "(0, 'Ԥ��', '', '', 0, {$setlink})";
$insert_data[] = "(0, 'Ԥ��', '', '', 0, {$setlink})";

//��Ѷ ��������(����������)
$portal_cc = array();
$query = DB::query("SELECT catid,catname FROM " . DB::table('portal_category') . " where upid = 0 and closed = 0");
while ($values = DB::fetch($query)) {
	$insert_data[] = "(".P_FRIENDLYLINK_PORTAL.", '{$values['catname']}', 'http://www.8264.com/list/{$values['catid']}/', '".P_FRIENDLYLINK_PORTAL."|{$values['catid']}', '1', {$setlink})";
	$portal_cc[] = $values['catid'];
}
$query = DB::query("SELECT catid,catname FROM " . DB::table('portal_category') . " where upid in (".  implode(',', $portal_cc).") and closed = 0");
while ($values = DB::fetch($query)) {
	$insert_data[] = "(".P_FRIENDLYLINK_PORTAL.", '{$values['catname']}', 'http://www.8264.com/list/{$values['catid']}/', '".P_FRIENDLYLINK_PORTAL."|{$values['catid']}', '0', {$setlink})";
}

//��̳ ��������
$query = DB::query("SELECT fid,name FROM " . DB::table('forum_forum') . " where fup = 0 and status = 1");
while ($values = DB::fetch($query)) {
	$tmpsql[] = $values['fid'];
	//$fupinfo[$values['fid']] = $values['name'];
}
$tmpsql = implode($tmpsql, ',');
$query = DB::query("SELECT fid,name,fup FROM " . DB::table('forum_forum') . " where fup in({$tmpsql}) and status = 1");
while ($values = DB::fetch($query)) {
	$insert_data[] = "(".P_FRIENDLYLINK_FORUM.", '{$values['name']}', 'http://bbs.8264.com/forum-{$values['fid']}-1.html', '".P_FRIENDLYLINK_FORUM."|{$values['fid']}|0', '1', {$setlink})";
}

//��Ѷ
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '����Ʒ��', 'http://www.8264.com/pinpai', '".P_FRIENDLYLINK_DIANPING."|408', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '������Ʒ��', 'http://www.8264.com/zhuangbei.html', '".P_FRIENDLYLINK_DIANPING."|490', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '�����', 'http://www.8264.com/dianpu', '".P_FRIENDLYLINK_DIANPING."|471', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '��������', 'http://www.8264.com/panpa', '".P_FRIENDLYLINK_DIANPING."|497', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '��ѩ��', 'http://www.8264.com/xuechang', '".P_FRIENDLYLINK_DIANPING."|477', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", 'Ǳˮ��', 'http://www.8264.com/qianshui/', '".P_FRIENDLYLINK_DIANPING."|498', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", 'ɽ��', 'http://www.8264.com/shanfeng', '".P_FRIENDLYLINK_DIANPING."|392', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '��·', 'http://www.8264.com/xianlu', '".P_FRIENDLYLINK_DIANPING."|494', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '����', 'http://www.8264.com/diaoyu', '".P_FRIENDLYLINK_DIANPING."|499', '1', {$setlink})";
$insert_data[] = "(".P_FRIENDLYLINK_DIANPING.", '������ֲ�', 'http://www.8264.com/dianping-club-act-showlist.html', '".P_FRIENDLYLINK_DIANPING."|501', '1', {$setlink})";

//���
$sql = "INSERT INTO " . DB::table('common_friendlink2_inlink') . "(`group`, `keyword`, `url`, `identifie`, `weight`, `setinlink`) VALUES".  implode($insert_data, ',');
if($_GET['type'] == 1){
	print_r($insert_data);
}else{
	echo $sql;
}

//$query = DB::query($sql);
//
//var_dump($query);
