<?php

/**
 *  ��̳��°�ӿ�
 */

//�����������ٶ�
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

$time_start = microtime_float();

define("API_URL", "http://bbs.8264.com/api/activity.php");
define("ZAIWAI_API_URL", $_G['config']['zaiwaiapi']['url']);
define("ZAIWAI_API_TOKEN", $_G['config']['zaiwaiapi']['token']);

$appname = $_GET['appname'];  //�����APP
$sign = $_GET['sign'];  //�����ǩ��
$qt = intval($_GET['qt']);  //�����ʱ��� ��λ����

function output_msg($msg, $isArray = false) {
	global $time_start;

	$time_end = microtime_float();
	$time_diff = round($time_end - $time_start, 4);

	if (!$isArray) {
		$msg = diconv($msg, 'gbk', 'utf-8');
	} else {
		$msg = iconv_array($msg);
		$msg = json_encode($msg);
		$msg = str_replace('"actList":[]', '"actList":null', $msg);
		$msg = str_replace('"myActList":[]', '"myActList":null', $msg);
		$msg = str_replace('"myApply":[]', '"myApply":null', $msg);
		$msg = str_replace('"applyList":[]', '"applyList":null', $msg);
	}
	header('Content-type: application/json');
	exit($msg);
}

function output_errorMsg($code, $enInfo, $zhInfo = "") {
	$data = array();
	$data['msg']['info'] = $enInfo;
	$data['msg']['code'] = $code;
	$data['errorCode']   = 2;
	$data['errorReason'] = !empty($zhInfo) ? $zhInfo : '����ʧ�ܣ�����ϵ����ͷ�';

	output_msg($data, true);
}

// ��־��¼
require DISCUZ_ROOT.'source/plugin/logs/logs.class.php';
$logs = new logs('activity_api');


// ����APP KEY ��config_global�����ã�Ŀǰδ��Ȩ����Ӧ��ʹ�ã��˴�ǿ����֤appΪzaiwaiapp�Ƿ�Ϸ�
$key_search = array_keys($_G['config']['apikey']);
if(!in_array($appname, $key_search)) {
	$logs->log_str('appname param error.');
	output_errorMsg(410, 'Invalid app.', '');
}

// ǩ����������
$timestamp = time();
if(abs($timestamp - $qt) > 3600) {
	$logs->log_str('Request time is too long.');
	output_errorMsg(422, 'Request time is too long.', '');
}

// ��֤ǩ����Ч��
if(!sign_test($appname, $sign)) {
	$logs->log_str($_SERVER['QUERY_STRING']);
	$logs->log_str('Invalid signature.');
	output_errorMsg(411, 'Invalid signature.', '');
}


$c = $_GET['c'];
$m = $_GET['m'];

if(!in_array($c, array('thread', 'user', 'manage'))) {
	$logs->log_str('Param c error.');
	output_errorMsg(423, 'Param c error.', '');
}

require_once libfile('class/myredis');
$redis = & myredis::instance(6381);
require DISCUZ_ROOT.'source/function/function_activity.php';
require DISCUZ_ROOT.'api/activity/'.$c.'_ctl.php';
$obj = new $c;
if(!method_exists($obj, $m)) {
	$logs->log_str('Request param m error. c:'.$c.', m:'.$m);
	output_errorMsg(423, 'Request param m error.', '');
}

$obj->$m();

?>
