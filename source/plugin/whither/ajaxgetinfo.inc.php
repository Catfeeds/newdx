<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if ($_GET['infoid']) {
    require_once libfile('function/discuzcode');
    $info = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_info')." WHERE id = '{$_GET['infoid']}'");
    $array = array(
        'subject' => mb_convert_encoding($info['name'], 'UTF-8', 'GBK'),
        'message' => mb_convert_encoding(discuzcode($info['message'], -1, 0), 'UTF-8', 'GBK'),
    );
    echo json_encode($array);
}
exit;
