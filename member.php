<?php
// 定义应用 ID
define('APPTYPEID', 0);
define('CURSCRIPT', 'member');
//====================================
// 基础文件引入， 其他程序引导文件可能不需要
// class_forum.php 和 function_forum.php
// 请根据实际需要确定是否引入
//====================================
require './source/class/class_core.php';

$discuz = & discuz_core::instance();

//====================================
//模块定义以及模块缓存定义
//====================================
$modarray = array('activate', 'clearcookies', 'emailverify', 'getpasswd',
					'groupexpiry', 'logging', 'lostpasswd',
					'register', 'regverify', 'switchstatus', 'connect');

// 判断 $mod 的合法性

$mod = !in_array($discuz->var['mod'], $modarray) ? 'register' : $discuz->var['mod'];

//定义当前模块常量
define('CURMODULE', $mod);

$modcachelist = array('register' => array('modreasons', 'stamptypeid', 'fields_required', 'fields_optional', 'fields_register', 'ipctrl'));

//依据 CURMODULE 或者 $mod 设定需要加载的缓存
$cachelist = array();
if(isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];
}

//====================================
// 加载核心处理,各程序入口文件代码相同
//====================================
$discuz->cachelist = $cachelist;
$discuz->init();
if($mod == 'register' && $discuz->var['mod'] != $_G['setting']['regname'] && !defined('IN_CONNECT')) {
	showmessage('undefined_action');
}

//====================================
// 以下内容由各个模块根据需要自行撰写程序运行环境
//====================================

require libfile('function/member');
require libfile('class/member');
runhooks();
// 域名访问插件
if(file_exists('./source/plugin/domainset/indomain.php')){
   require './source/plugin/domainset/indomain.php';
}
// 访问统计插件
// if (file_exists(DISCUZ_ROOT.'./source/plugin/request_log/request.php')) {
    // include_once DISCUZ_ROOT.'./source/plugin/request_log/request.php';
// }

require DISCUZ_ROOT.'./source/module/member/member_'.$mod.'.php';


?>
