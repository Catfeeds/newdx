<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if (!$_G['uid'] || !$_G['username']) {
	exit;
}

$type = $_GET['type'];
$typeid = $_GET['typeid'];
$star_num = intval($_GET['starnum']);

if (!$type || !$typeid || $star_num > 5 || $star_num < 1) {
	exit;
}
require_once DISCUZ_ROOT."/source/plugin/forumoption/include.php";
$starid = $forumOption->getStarid($type, $typeid);
if ($starid) {
	$dateline = time();	
	//$client_ip = $_SERVER["HTTP_CDN_SRC_IP"];
   // if($client_ip){
    //    $ip = $client_ip;
   // }else{
        $ip = $discuz->_get_client_ip();   
   // }   
	DB::query("INSERT INTO ".DB::table('dianping_star_logs')." (starid, starnum, dateline, uid, username, ip) ".
			  "VALUE ($starid, $star_num, $dateline, {$_G['uid']}, '{$_G['username']}', '$ip')");
	echo json_encode($forumOption->calStarInfo($starid));
}