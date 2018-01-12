<?php

/**
 *  小程序接口入口
 */

//require './external/fb.ext.php';
require './source/class/class_core.php';
require './source/class/class_sockpost.php';

$discuz = & discuz_core::instance();//加载配置


require libfile('function/wap');

//判断来自discuz哪个入口
$entrance = "forum";
$ctlList  = array(
	"member" => array("logging"=>1,'register'=>1, "login"=>1),
	"forum"  => array("thread"=>1,"forumIndex"=>1,"forumMisc"=>1,"forumRedirect"=>1,'forumActivity'=>1,'forumPost'=>1,'forumDianping'=>1),
);
foreach ($ctlList as $k => $v) {
	if (isset($v[$_G["gp_ctl"]])) {
		$entrance = $k;
		break;
	}
}


//小程序论坛请求
$appname = $_GET['appname'];  //请求的APP
$sign = $_GET['sign'];  //请求的签名
$qt = intval($_GET['qt']);  //请求的时间戳 单位：秒


// 在外APP KEY 在config_global中配置，目前未授权其它应用使用，此处强制验证app为zaiwaiapp是否合法
$key_search = array_keys($_G['config']['apikey']);
if(!in_array($appname, $key_search)) {
	echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"appname param error.")));
	exit();
}

// 签名过期限制
$timestamp = time();
if(abs($timestamp - $qt) > 3600) {
	echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"Request time is too long.")));
	exit();
}


//验证签名有效性
if(!sign_test($appname, $sign)) {
	echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"令牌有误")));
	exit();
}



//接口登录码
if (!empty($_G['gp_login'])) {
	$_G["cookie"]["authsapp"] = $_G['gp_login'];
	dsetcookie('authsapp', $_G["cookie"]["authsapp"], 0, 1, true);
} else {
	dsetcookie('authsapp', '', -1, 1, true);
}

$cachelist = array();
if($entrance == "forum") {
	require libfile('function/forum');
	$modcachelist = array(
		'forumIndex_index' => array('announcements', 'onlinelist', 'forumlinks', 'advs_index',	'heats', 'historyposts', 'onlinerecord', 'userstats'),
		'thread_showlist' => array('smilies', 'announcements_forum', 'globalstick', 'forums', 'icons', 'onlinelist', 'forumstick', 'threadtable_info', 'threadtableids', 'stamps'),
		'thread_showview' => array('smilies', 'smileytypes', 'forums', 'usergroups', 'ranks', 'stamps', 'bbcodes', 'smilies', 'custominfo', 'groupicon', 'stamps', 'threadtableids', 'threadtable_info'),
		'post' => array('bbcodes_display', 'bbcodes', 'smileycodes', 'smilies', 'smileytypes', 'icons', 'domainwhitelist'),
		'space' => array('fields_required', 'fields_optional', 'custominfo'),
		'group' => array('grouptype'),

	);


} elseif ($entrance == "member") {
	require libfile('function/member');
//	require libfile('class/member');

	$modcachelist = array('member_register' => array('modreasons', 'stamptypeid', 'fields_required', 'fields_optional', 'fields_register', 'ipctrl'));
}

//设定需要加载的缓存
$ctl_act = "{$_G["gp_ctl"]}_{$_G["gp_act"]}";
if(isset($modcachelist[$ctl_act])) {
	$cachelist = $modcachelist[$ctl_act];
}
$discuz->cachelist = !empty($cachelist) ? $cachelist : array();
$discuz->init();

if ($entrance == "forum") {

	//把此论坛信息存入$_G
	loadforum();

	set_rssauth();

	//判断是点评的模块，会域名跳转，所以点评不加载此段代码
	if (file_exists(DISCUZ_ROOT . './source/plugin/forumoption/include.php') && $_G["gp_ctl"] != 'forumDianping') {
		include_once DISCUZ_ROOT . './source/plugin/forumoption/include.php';
		$_G['obj_forumOption'] = $forumOption;
	}
}

runhooks();

//$_G一维key
$_G["sapp"] = array(
	"formhash"=>0,
	"setting"=>0,
	"member"=>0,
	"group"=>0,

);

//全局变量--返回数据
global $returnData;
$returnData['G'] 		 = array_intersect_key($_G,$_G['sapp']);
$returnData['G']['authsapp'] = !empty($_G['cookie']['authsapp']) ? $_G['cookie']['authsapp'] : "";
if ($entrance == "forum") {
	//获得默认为精华的论坛列表，代替$forumOption->hookScript11();
	$returnData['forumoptionList'] 		= getForumoptionList();
	$returnData['G']['forumoptionList'] = $returnData['forumoptionList'];
}

//memcache缓存$_G
$memKey  = 'cache_authsapp';
$memKey .= !empty($_G['gp_login']) ? "_{$_G['gp_login']}" : '';
if ($entrance == "member") {
	memory('rm', $memKey);
}

if (!memory('get', $memKey)) {
	memory('set', $memKey, $returnData['G'], 3600);
}

//只是获取$_G
if ($_G["gp_ctl"] == 'system' && $_G["gp_act"] == 'getG') {
	encodeData($returnData);//
}

// 平台参数
$module = "sapp";
// 默认平台
$ctl_root = "/source/module/{$module}";
include(DISCUZ_ROOT . '/source/8264/launcher.php');
Launcher::startup(array(
	'ctl_root' => DISCUZ_ROOT . $ctl_root,
	'external_libs' => array(
		DISCUZ_ROOT . '/source/8264/controller/frontend.base.php',//控制器前台基类
		DISCUZ_ROOT . '/source/8264/controller/plugin.base.php',
	)
));
?>
