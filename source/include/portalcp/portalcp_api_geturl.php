<?php
/**
 * api��geturl���ӹ���
 *
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$navtitle = 'url���ӹ��� - �Ż����� - ����������';

if(submitcheck('editsubmit')) {

	$edit_param = array(
		'values' => $_G['gp_content'],
		'dateline' => $_G['timestamp']
		);

	DB::update('plugin_css_cache', $edit_param, array('filename' => 'plugin_api_geturl'));
	showmessage('�������', "portal.php?mod=portalcp&ac=api_geturl");
}else{
	$content = DB::result_first("SELECT `values` FROM ".DB::table('plugin_css_cache')." WHERE filename='plugin_api_geturl'");
}

include_once template("portal/portalcp_api_geturl");
?>
