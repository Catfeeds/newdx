<?php

/**
 *  С����ӿ����
 */

//require './external/fb.ext.php';
require './source/class/class_core.php';
require './source/class/class_sockpost.php';

$discuz = & discuz_core::instance();//��������


require libfile('function/wap');

//�ж�����discuz�ĸ����
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


//С������̳����
$appname = $_GET['appname'];  //�����APP
$sign = $_GET['sign'];  //�����ǩ��
$qt = intval($_GET['qt']);  //�����ʱ��� ��λ����


// ����APP KEY ��config_global�����ã�Ŀǰδ��Ȩ����Ӧ��ʹ�ã��˴�ǿ����֤appΪzaiwaiapp�Ƿ�Ϸ�
$key_search = array_keys($_G['config']['apikey']);
if(!in_array($appname, $key_search)) {
	echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"appname param error.")));
	exit();
}

// ǩ����������
$timestamp = time();
if(abs($timestamp - $qt) > 3600) {
	echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"Request time is too long.")));
	exit();
}


//��֤ǩ����Ч��
if(!sign_test($appname, $sign)) {
	echo json_encode(iconv_array(array('error'=>true , 'errorinfo'=>"��������")));
	exit();
}



//�ӿڵ�¼��
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

//�趨��Ҫ���صĻ���
$ctl_act = "{$_G["gp_ctl"]}_{$_G["gp_act"]}";
if(isset($modcachelist[$ctl_act])) {
	$cachelist = $modcachelist[$ctl_act];
}
$discuz->cachelist = !empty($cachelist) ? $cachelist : array();
$discuz->init();

if ($entrance == "forum") {

	//�Ѵ���̳��Ϣ����$_G
	loadforum();

	set_rssauth();

	//�ж��ǵ�����ģ�飬��������ת�����Ե��������ش˶δ���
	if (file_exists(DISCUZ_ROOT . './source/plugin/forumoption/include.php') && $_G["gp_ctl"] != 'forumDianping') {
		include_once DISCUZ_ROOT . './source/plugin/forumoption/include.php';
		$_G['obj_forumOption'] = $forumOption;
	}
}

runhooks();

//$_Gһάkey
$_G["sapp"] = array(
	"formhash"=>0,
	"setting"=>0,
	"member"=>0,
	"group"=>0,

);

//ȫ�ֱ���--��������
global $returnData;
$returnData['G'] 		 = array_intersect_key($_G,$_G['sapp']);
$returnData['G']['authsapp'] = !empty($_G['cookie']['authsapp']) ? $_G['cookie']['authsapp'] : "";
if ($entrance == "forum") {
	//���Ĭ��Ϊ��������̳�б�����$forumOption->hookScript11();
	$returnData['forumoptionList'] 		= getForumoptionList();
	$returnData['G']['forumoptionList'] = $returnData['forumoptionList'];
}

//memcache����$_G
$memKey  = 'cache_authsapp';
$memKey .= !empty($_G['gp_login']) ? "_{$_G['gp_login']}" : '';
if ($entrance == "member") {
	memory('rm', $memKey);
}

if (!memory('get', $memKey)) {
	memory('set', $memKey, $returnData['G'], 3600);
}

//ֻ�ǻ�ȡ$_G
if ($_G["gp_ctl"] == 'system' && $_G["gp_act"] == 'getG') {
	encodeData($returnData);//
}

// ƽ̨����
$module = "sapp";
// Ĭ��ƽ̨
$ctl_root = "/source/module/{$module}";
include(DISCUZ_ROOT . '/source/8264/launcher.php');
Launcher::startup(array(
	'ctl_root' => DISCUZ_ROOT . $ctl_root,
	'external_libs' => array(
		DISCUZ_ROOT . '/source/8264/controller/frontend.base.php',//������ǰ̨����
		DISCUZ_ROOT . '/source/8264/controller/plugin.base.php',
	)
));
?>
