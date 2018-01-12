<?php

/**
 * OPENID 第三方登陆主入口文件
 */


require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = &discuz_core::instance();
$discuz->init();

$appname = $_GET['appname'];  //请求的APP
$sign = $_GET['sign'];  //请求的签名
$qt = intval($_GET['qt']);  //请求的时间戳 单位：秒
$api_url = 'http://www.8264.com/openid/';

function output_msg($msg, $isArray = false) {	
	if (!$isArray) {
		$msg = diconv($msg, 'gbk', 'utf-8');	
	} else {
		$msg = iconv_array($msg);
		$msg = json_encode($msg);
	}	
	header('Content-type: application/json');
	exit($msg);
}

function output_errorMsg($code, $enInfo, $zhInfo = "") {
	$data = array();
	$data['msg']['info'] = $enInfo;
	$data['msg']['code'] = $code;
	$data['errorCode']   = 2;
	$data['errorReason'] = !empty($zhInfo) ? $zhInfo : '请求失败，请联系在外客服';
	
	output_msg($data, true);
}

// 日志记录
require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
$logs = new logs('openid');

// 在外APP KEY 在config_global中配置，目前未授权其它应用使用，此处强制验证app为zaiwaiapp是否合法
$key_search = array_keys($_G['config']['apikey']);
if(!in_array($appname, $key_search)) {
	$logs->log_str('appname param error.');
	output_errorMsg(410, 'Invalid app.', '');
}

// 签名过期限制10分钟
$timestamp = time();
if(abs($timestamp - $qt) > 600) {
	$logs->log_str('Request time is too long.');
	output_errorMsg(422, 'Request time is too long.', '');
}

// 验证签名有效性
if(!sign_test($appname, $sign)) {
	$logs->log_str($_SERVER['QUERY_STRING']);
	$logs->log_str('Invalid signature.');
	output_errorMsg(411, 'Invalid signature.', '');
}

$c = $_GET['c'];
$m = $_GET['m'];

if(!in_array($c, array('authorize'))) {
	$logs->log_str('Param c error.');
	output_errorMsg(423, 'Param c error.', '');
}

require DISCUZ_ROOT.'openid/'.$c.'_ctl.php';

$obj = new $c;

if(!method_exists($obj, $m)) {
	$logs->log_str('Request param m error. c:'.$c.', m:'.$m);
	output_errorMsg(423, 'Request param m error.', '');
}

$obj->$m();

?>
