<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$_POST['subject'] = mb_convert_encoding($_POST['subject'], 'GBK', 'UTF-8');
if ($_POST['subject'] && $_POST['type'] && $_POST['typesn']) {
	if (in_array($_POST['type'], array('region', 'scapearea', 'scape'))) {
		$tableName = "mudidi_{$_POST['type']}";
	} else {
		echo 'error';
		exit;
	}
	
	$query = DB::query("SELECT name FROM ".DB::table($tableName)." WHERE sn LIKE '{$_POST['typesn']}-%' AND name like '%{$_POST['subject']}%'");
	$msg = 'norepeat';
	while ($value = DB::fetch($query)) {
		$msg = 'like';
		if ($value['name'] == $_POST['subject']) {
			$msg = 'repeat';
			break;
		}
	}
	echo $msg;
} else {
	echo 'error';
}

exit;