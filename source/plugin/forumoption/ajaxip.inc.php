<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
include DISCUZ_ROOT.'/source/plugin/forumoption/include.php';
function get_clientip(){
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
			foreach ($matches[0] AS $xip) {
				if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
					$ip = $xip;
					break;
				}
			}
		}
		return $ip;
	}
$forumOption->getSetting('recom_thread_opened');
$ip = get_clientip();
// $ip = "111.160.216.2";
$data = $forumOption->getThreadByIp($ip);

//获取线路广告数据，如果存在，由json转为array
$xianluAD = $forumOption->getWanXianlu($ip);
if($xianluAD)
{
	$xianlu = json_decode($xianluAD, true);
}

include template('common/header_ajax');
if(!empty($data)){
	include template('forumoption:ajaxip');
}else{
	echo "<script>$('sitefocus').style.border = 'none';</script>";
}
include template('common/footer_ajax');
?>
