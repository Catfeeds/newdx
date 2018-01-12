<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/flink.func.php';

$navtitle = "友情链接申请";
$identifie = $_G['gp_type'];

//类型验证
$outlinkname = urldecode($_G['gp_n']);
$outlink = urldecode($_G['gp_l']);
$hash = md5($identifie.$outlinkname.$outlink.md5('46ea7e'));
if($hash !== $_G['gp_h']){
	showmessage('访问错误');
}

if (!empty($_POST)) {
	$name = trim($_G['gp_name']);
	$url = trim($_G['gp_url']);
	$qq = trim($_G['gp_qq']);
	if (empty($name)) {
		showmessage('链接名称不能为空');
	}
	if (abslength($name)>20) {
		showmessage('链接名称不能超过10个字');
	}
	if (!checkurl($url)) {
		showmessage('请输入合法的链接地址');
	}
	if (!checkqq($qq)) {
		showmessage('请输入合法的qq');
	}
	$sql = "INSERT INTO " . DB::table('common_friendlink2') . "(`name`,`url`,`description`,`logo`,`identifie`,`ptype`,`type`,`addtime`,`qq`,`site_outlink_name`,`site_outlink`) VALUES('{$name}','$url','','','{$identifie}','',''," . time() . ",'{$qq}','{$outlinkname}','{$outlink}')";
	$query = DB::query($sql);
	if (!$query) {
		showmessage('添加失败，请重试');
	} else {
		showmessage('do_success',$outlink);
	}
} else {
	include template('friendlylink:add');
}
?>