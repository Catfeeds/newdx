<?php

/**
 *  ��̳��°�ӿ�
 *	��̨����ƽ̨ר������ļ�
 *  ��APP������ļ��������ڷ�������ͨ�Ų���TOKEN��֤
 */

require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

define("API_URL", "http://bbs.8264.com/api/activity.php");
define("ZAIWAI_API_URL", $_G['config']['zaiwaiapi']['url']);
define("ZAIWAI_API_TOKEN", $_G['config']['zaiwaiapi']['token']);

$appname = $_GET['appname'];  //�����APP
$access_token = $_GET['access_token'];  //����ʹ�õ�TOKEN


function output_msg($msg) {
	header('Content-type: application/json');
	exit($msg);
}

// ��־��¼
require DISCUZ_ROOT.'source/plugin/logs/logs.class.php';
$logs = new logs('activity_api');

// ����APP KEY ��config_global�����ã�Ŀǰδ��Ȩ����Ӧ��ʹ�ã��˴�ǿ����֤appΪzaiwaiapp�Ƿ�Ϸ�
$key_search = array_keys($_G['config']['apikey']);
if(!in_array($appname, $key_search)) {
	$logs->log_str('appname param error.');
	output_msg('{"msg":{"code":410, "info":"Invalid app."}}');
}

// ��֤TOKEN
require_once libfile('class/myredis');
$redis = & myredis::instance(6381);
$access_token_test = time();	//����redis������ʱ����tokenͬʱΪ�տ���������֤
$access_token_test = $redis->obj->get('access_token_'.$appname);
if($access_token != $access_token_test) {
	$logs->log_str('access_token error. appname:'.$appname);
	output_msg('{"msg":{"code":411, "info":"Permission check failed."}}');
}

$c = $_GET['c'];
$m = $_GET['m'];

if(!in_array($c, array('thread', 'user', 'manage'))) {
	$logs->log_str('Param c error.');
	output_msg('{"msg":{"code":423, "info":"Param c error."}}');
}

require DISCUZ_ROOT.'source/function/function_activity.php';
require DISCUZ_ROOT.'api/activity/'.$c.'_ctl.php';

$obj = new $c;

if(!method_exists($obj, $m)) {
	$logs->log_str('Request param m error. c:'.$c.', m:'.$m);
	output_msg('{"msg":{"code":423, "info":"Request param m error."}}');
}

$obj->$m();

?>
