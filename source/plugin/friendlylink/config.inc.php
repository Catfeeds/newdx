<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('P_FRIENDLYLINK_PORTAL', 1); //��Ѷ
define('P_FRIENDLYLINK_FORUM', 2); //��̳
define('P_FRIENDLYLINK_DIANPING', 3); //����
define('P_FRIENDLYLINK_QITA', 4); //����

$plugin_fk_relation = array(
	P_FRIENDLYLINK_PORTAL => '��Ѷ',
	P_FRIENDLYLINK_FORUM => '��̳',
	P_FRIENDLYLINK_DIANPING => '����',
	P_FRIENDLYLINK_QITA => '����'
);

$url = "/admin.php?action=plugins&operation=config&do=92&identifier=friendlylink&pmod=".$_GET['pmod'];
?>
