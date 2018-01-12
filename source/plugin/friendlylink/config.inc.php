<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('P_FRIENDLYLINK_PORTAL', 1); //资讯
define('P_FRIENDLYLINK_FORUM', 2); //论坛
define('P_FRIENDLYLINK_DIANPING', 3); //点评
define('P_FRIENDLYLINK_QITA', 4); //其他

$plugin_fk_relation = array(
	P_FRIENDLYLINK_PORTAL => '资讯',
	P_FRIENDLYLINK_FORUM => '论坛',
	P_FRIENDLYLINK_DIANPING => '点评',
	P_FRIENDLYLINK_QITA => '其他'
);

$url = "/admin.php?action=plugins&operation=config&do=92&identifier=friendlylink&pmod=".$_GET['pmod'];
?>
