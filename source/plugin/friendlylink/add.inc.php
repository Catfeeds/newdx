<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/flink.func.php';

$navtitle = "������������";
$identifie = $_G['gp_type'];

//������֤
$outlinkname = urldecode($_G['gp_n']);
$outlink = urldecode($_G['gp_l']);
$hash = md5($identifie.$outlinkname.$outlink.md5('46ea7e'));
if($hash !== $_G['gp_h']){
	showmessage('���ʴ���');
}

if (!empty($_POST)) {
	$name = trim($_G['gp_name']);
	$url = trim($_G['gp_url']);
	$qq = trim($_G['gp_qq']);
	if (empty($name)) {
		showmessage('�������Ʋ���Ϊ��');
	}
	if (abslength($name)>20) {
		showmessage('�������Ʋ��ܳ���10����');
	}
	if (!checkurl($url)) {
		showmessage('������Ϸ������ӵ�ַ');
	}
	if (!checkqq($qq)) {
		showmessage('������Ϸ���qq');
	}
	$sql = "INSERT INTO " . DB::table('common_friendlink2') . "(`name`,`url`,`description`,`logo`,`identifie`,`ptype`,`type`,`addtime`,`qq`,`site_outlink_name`,`site_outlink`) VALUES('{$name}','$url','','','{$identifie}','',''," . time() . ",'{$qq}','{$outlinkname}','{$outlink}')";
	$query = DB::query($sql);
	if (!$query) {
		showmessage('���ʧ�ܣ�������');
	} else {
		showmessage('do_success',$outlink);
	}
} else {
	include template('friendlylink:add');
}
?>