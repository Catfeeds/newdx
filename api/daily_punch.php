<?php

/**
 *  在外APP微信公众号，每日打卡任务专用接口
 */

require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

define("SIGN_KEY", $_G['config']['apikey']['zaiwaiapp']);

$c = $_GET['c'];
$m = $_GET['m'];
if($c=='addcredits'){
	$uid =intval($_POST['uid']);
	$sign_param=array(
		            'uid'=>$uid,
		            'openid'=>trim($_POST['openid'])
					);
	if(!check_sign($c,$sign_param,$_POST['sign'])){
		output_msg(json_encode(array('msg'=>'sign error')));
	}
	
	$dataarr = array(2 => 10);
	updatemembercount($uid, $dataarr,1, $operation = 'PUNCH');
	notification_add($uid, 'system', '恭喜您完成"在外APP"公众号每日打卡任务，并获得奖励10驴币', array(), 1);
	
}elseif($c=='checkuser'){
	
	$post_username=trim($_POST['username']);
	$post_password=trim($_POST['password']);
	$sign_param=array(
		            'username'=>$post_username,
		            'password'=>$post_password
					);
	if(!check_sign($c,$sign_param,$_POST['sign'])){
		output_msg(json_encode(array('msg'=>'sign error')));
	}
	
	if(!function_exists('uc_user_login')) {
		loaducenter();
	}
	list($uid, $username, $password, $email) = uc_user_login($post_username,$post_password);
	$return_data['uid'] = $uid;
	$return_data['username'] = $username;
	if($uid > 0) {
		$return_data['msg'] = '登录成功';
	} elseif($uid == -1) {
		$return_data['msg'] = '用户不存在,或者被删除';
	} elseif($uid == -2) {
		$return_data['msg'] = '密码错';
	} else {
		$return_data['msg'] = '未定义';
	}
	
	$return_data = iconv_array($return_data);
	output_msg(json_encode($return_data));
	
}
die;





function output_msg($msg) {
	header('Content-type: application/json');
	exit($msg);
}

function check_sign($c,$sign_param=array(),$sign) {
	if(empty($sign_param)){
		return false;
	}else{
		ksort($sign_param);
		reset($sign_param);
		return $sign == md5($c.http_build_query($sign_param).SIGN_KEY) ? true : false;
	}
}



?>
