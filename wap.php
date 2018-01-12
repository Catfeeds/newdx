<?php

/**
 *  手机版入口
 */

//require './external/fb.ext.php';
require './source/class/class_core.php';
require './source/class/class_sockpost.php';

$discuz = & discuz_core::instance();

require libfile('function/wap');

//判断来自discuz哪个入口
$entrance = "portal";
$ctlList  = array(
	"portal" => array("portalArticle"=>1, "presale" => 1),
	"member" => array("logging"=>1,'register'=>1),
	"forum"  => array("thread"=>1,"forumIndex"=>1,"forumMisc"=>1,"forumRedirect"=>1,'forumActivity'=>1,'forumPost'=>1,'forumDianping'=>1),
	"dianping"  => array("dianping"=>1,"dianpingDetail"=>1),
);
foreach ($ctlList as $k => $v) {
	if (isset($v[$_G["gp_ctl"]])) {
		$entrance = $k;
		break;
	}
}

//验证令牌
if (empty($_GET['notoken'])) {
	if ($_G['gp_token'] != sockpost::token(intval($_G['gp_posttime']))) {
		echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"令牌有误")));
	    exit();
	}
}


//接口登录码
if (!empty($_G['gp_login'])) {
	$_G["cookie"]["auth"] = $_G['gp_login'];
	dsetcookie('auth', $_G["cookie"]["auth"], 0, 1, true);
} else {
	dsetcookie('auth', '', -1, 1, true);
}

$cachelist = array();
if ($entrance == "portal") {
	require libfile('function/home');
	require libfile('function/portal');
	require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';

	//$_G["cache"]
	$cachelist = array('userapp', 'portalcategory');
} elseif ($entrance == "forum") {
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
}elseif($entrance == "dianping"){
	$modcachelist = array(
		'dianping_climblist' => array('dp_climb_comment_rate','dp_country_region'),
                'dianping_clublist' => array('dp_climb_comment_rate','dp_country_region'),
		'dianping_divinglist' => array('dp_climb_comment_rate','dp_country_region'),
		'dianping_fishinglist' => array('dp_climb_comment_rate','dp_country_region'),
		'dianping_mountainlist' => array('forumlinks','dp_mountain_comment_rate'),
		'dianping_linelist' => array('dp_line_comment_rate','dp_country_region','dp_line_region'),
		'dianping_skiinglist' => array('dp_skiing_pro', 'dp_skiing_index_comment', 'dp_skiing_sidebar_hot', 'dp_skiing_sidebar_new'),
		'dianping_equipmentlist' => array('dp_equipment_brandlist'),
                'dianping_indexlist' => array('dp_equipment_brandlist','dp_climb_comment_rate','dp_country_region','forumlinks','dp_mountain_comment_rate'),

            
		'dianpingDetail_divingDetail'=>array('dp_diving_list_hot','dp_country_region'),
		'dianpingDetail_climbDetail'=>array('dp_climb_list_hot','dp_country_region'),
                'dianpingDetail_clubDetail'=>array('dp_climb_list_hot','dp_country_region'),
		'dianpingDetail_fishingDetail'=>array('dp_fishing_list_hot','dp_country_region'),
		'dianpingDetail_mountainDetail'=>array('dp_mountain_sidebar_hot'),
		'dianpingDetail_lineDetail'=>array('dp_line_list_hot','dp_country_region'),
		'dianpingDetail_skiingDetail'=>array('dp_skiing_pro', 'dp_skiing_sidebar_hot'),
		// 'dianpingDetail_equipmentDetail'=>array('dp_diving_list_hot','dp_country_region'),
	);
}

//设定需要加载的缓存
$ctl_act = "{$_G["gp_ctl"]}_{$_G["gp_act"]}";
if(isset($modcachelist[$ctl_act])) {
	$cachelist = $modcachelist[$ctl_act];
}
$discuz->cachelist = !empty($cachelist) ? $cachelist : array();
$discuz->init();

if ($entrance == "forum") {

//	$modarray = array('ajax', 'announcement', 'attachment', 'forumdisplay', 'm_forumdisplay', 'dianping',
//		'group', 'image', 'm_index', 'index', 'medal', 'misc', 'modcp', 'notice', 'post', 'm_post', 'redirect',
//		'relatekw', 'relatethread', 'rss', 'topicadmin', 'trade', 'viewthread', 'm_viewthread', 'test'
//	);
//	$mod = !in_array($discuz->var['mod'], $modarray) ? 'index' : $discuz->var['mod'];
//	define('CURMODULE', $mod != 'redirect' ? $mod : 'viewthread');
//	if ($discuz->var['mod'] == 'group') {
//		$_G['basescript'] = 'group';
//	}
//	$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['forum']);

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
$_G["wap"] = array(
//	"uid"=>0,
//	"username"=>0,
//	"adminid"=>0,
//	"groupid"=>0,
//	"sid"=>0,
	"formhash"=>0,
//	"timestamp"=>0,
//	"starttime"=>0,
//	"clientip"=>0,
//	"authkey"=>0,
//	"config"=>0,
	"setting"=>0,
	"member"=>0,
	"group"=>0,
//	"cookie"=>0,
//	"cache"=>0,
//	"session"=>0,
//	"my_app"=>0,
//	"my_userapp"=>0,
//	"fid"=>0,
//	"tid"=>0,
//	"forum"=>0,
//	"rssauth"=>0,
//	"home"=>0,
//	"space"=>0,
//	"block"=>0,
//	"article"=>0,
//	"perm"=>0,
//	"tpp"=>0,
//	"ppp"=>0,
);

//全局变量--返回数据
global $returnData;
$returnData['G'] 		 = array_intersect_key($_G,$_G['wap']);
$returnData['G']['auth'] = !empty($_G['cookie']['auth']) ? $_G['cookie']['auth'] : "";
if ($entrance == "forum") {
	//获得默认为精华的论坛列表，代替$forumOption->hookScript11();
	$returnData['forumoptionList'] 		= getForumoptionList();
	$returnData['G']['forumoptionList'] = $returnData['forumoptionList'];
}

//memcache缓存$_G
$memKey  = 'cache_auth';
$memKey .= !empty($_G['gp_login']) ? "_{$_G['gp_login']}" : '';
if ($entrance == "member") {
	memory('rm', $memKey);
}

if (!memory('get', $memKey)) {
	memory('set', $memKey, $returnData['G'], 3600);
}

//只是获取$_G
if ($_G["gp_ctl"] == 'system' && $_G["gp_act"] == 'getG') {
	encodeData($returnData);
}

// 平台参数
$module = "wap";
// 默认平台
$ctl_root = "/source/module/{$module}";
include(DISCUZ_ROOT . '/source/8264/launcher.php');
Launcher::startup(array(
	'ctl_root' => DISCUZ_ROOT . $ctl_root,
	'external_libs' => array(
		DISCUZ_ROOT . '/source/8264/controller/frontend.base.php',
		DISCUZ_ROOT . '/source/8264/controller/plugin.base.php',
	)
));
?>
