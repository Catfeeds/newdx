<?php
/**
 *  ��ר��ģ�����ݴ���
 *
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$navtitle = '��ר��ģ����� - �Ż����� - ����������';

//���ר��Ȩ��
if(!$_G['group']['allowaddtopic'] || !$_G['group']['allowmanagetopic']) {
	showmessage('��ר�����Ȩ�ޣ��뷵��', dreferer());
}

$query = DB::query("SELECT bid, topicid, name, shownum FROM ".DB::table('portal_topic_block')." ORDER BY bid DESC");
while ($row = DB::fetch($query)) {
	$topic_block[] = $row;
}

include_once template("portal/portalcp_topic_block");
?>
