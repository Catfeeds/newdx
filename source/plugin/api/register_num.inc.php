<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$json = array(
    'error_code' => 0,
    // 'register_num' => DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_member'))
    'register_num' => DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='showtotalmembers'")
);
echo json_encode($json);
