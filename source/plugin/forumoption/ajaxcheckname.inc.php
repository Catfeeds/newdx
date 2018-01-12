<?php

if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$_POST['subject'] = mb_convert_encoding($_POST['subject'], 'GBK', 'UTF-8');


if ($_POST['subject'] && $_POST['fid']) {		
	
	$query = DB::query("SELECT subject FROM ".DB::table('forum_thread')." WHERE fid='{$_POST['fid']}' and subject LIKE '%{$_POST['subject']}%'");
	$msg = 'norepeat';
	while ($value = DB::fetch($query)) {
		$msg = 'like';
		if ($value['subject'] == $_POST['subject']) {
			$msg = 'repeat';
			break;
		}
	}	
	echo $msg;
} else {
	echo 'error';
}

exit;
