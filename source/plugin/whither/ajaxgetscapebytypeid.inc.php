<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$array = array();
if ($_POST['scapetypeid'] && $_POST['sn']) {
	$query = DB::query("SELECT * FROM ".DB::table('mudidi_scape')." AS s
					    WHERE type = {$_POST['scapetypeid']} AND sn LIKE '{$_POST['sn']}%'");
	while ($value = DB::fetch($query)) {
		$value['name'] = mb_convert_encoding($value['name'], 'UTF-8', 'GBK');
		$array[] = $value;
	}
}
echo json_encode($array);
exit;
