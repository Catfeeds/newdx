<?php
// ����Ӧ�� ID
define('APPTYPEID', 0);
define('CURSCRIPT', 'member');
//====================================
// �����ļ����룬 �������������ļ����ܲ���Ҫ
// class_forum.php �� function_forum.php
// �����ʵ����Ҫȷ���Ƿ�����
//====================================
require './source/class/class_core.php';

$discuz = & discuz_core::instance();

//====================================
//ģ�鶨���Լ�ģ�黺�涨��
//====================================
$modarray = array('activate', 'clearcookies', 'emailverify', 'getpasswd',
					'groupexpiry', 'logging', 'lostpasswd',
					'register', 'regverify', 'switchstatus', 'connect');

// �ж� $mod �ĺϷ���

$mod = !in_array($discuz->var['mod'], $modarray) ? 'register' : $discuz->var['mod'];

//���嵱ǰģ�鳣��
define('CURMODULE', $mod);

$modcachelist = array('register' => array('modreasons', 'stamptypeid', 'fields_required', 'fields_optional', 'fields_register', 'ipctrl'));

//���� CURMODULE ���� $mod �趨��Ҫ���صĻ���
$cachelist = array();
if(isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];
}

//====================================
// ���غ��Ĵ���,����������ļ�������ͬ
//====================================
$discuz->cachelist = $cachelist;
$discuz->init();
if($mod == 'register' && $discuz->var['mod'] != $_G['setting']['regname'] && !defined('IN_CONNECT')) {
	showmessage('undefined_action');
}

//====================================
// ���������ɸ���ģ�������Ҫ����׫д�������л���
//====================================

require libfile('function/member');
require libfile('class/member');
runhooks();
// �������ʲ��
if(file_exists('./source/plugin/domainset/indomain.php')){
   require './source/plugin/domainset/indomain.php';
}
// ����ͳ�Ʋ��
// if (file_exists(DISCUZ_ROOT.'./source/plugin/request_log/request.php')) {
    // include_once DISCUZ_ROOT.'./source/plugin/request_log/request.php';
// }

require DISCUZ_ROOT.'./source/module/member/member_'.$mod.'.php';


?>
