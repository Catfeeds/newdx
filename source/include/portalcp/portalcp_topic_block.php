<?php
/**
 *  新专题模块数据处理
 *
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$navtitle = '新专题模块管理 - 门户管理 - 户外资料网';

//检查专题权限
if(!$_G['group']['allowaddtopic'] || !$_G['group']['allowmanagetopic']) {
	showmessage('无专题管理权限，请返回', dreferer());
}

$query = DB::query("SELECT bid, topicid, name, shownum FROM ".DB::table('portal_topic_block')." ORDER BY bid DESC");
while ($row = DB::fetch($query)) {
	$topic_block[] = $row;
}

include_once template("portal/portalcp_topic_block");
?>
