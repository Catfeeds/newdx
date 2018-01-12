<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: group.php 16832 2010-09-15 07:38:31Z wangjinbo $
 */

define('APPTYPEID', 3);
define('CURSCRIPT', 'group');
require_once './banip.php';

require './source/class/class_core.php';

$discuz = & discuz_core::instance();

$cachelist = array('grouptype', 'groupindex');
$discuz->cachelist = $cachelist;
$discuz->init();

if(!$_G['setting']['groupstatus']) {
	showmessage('group_status_off');
}
$modarray = array('index', 'my', 'attentiongroup');
$mod = !in_array($_G['mod'], $modarray) ? 'index' : $_G['mod'];

define('CURMODULE', $mod);

runhooks();

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['group']);

//判断文件是否存在（20110627 edit by zhanghongliang）
if(file_exists('./source/plugin/domainset/indomain.php')){
   require './source/plugin/domainset/indomain.php';
}

// 访问统计插件
// if (file_exists(DISCUZ_ROOT.'./source/plugin/request_log/request.php')) {
    // include_once DISCUZ_ROOT.'./source/plugin/request_log/request.php';
// }
require DISCUZ_ROOT.'./source/module/group/group_'.$mod.'.php';
?>
