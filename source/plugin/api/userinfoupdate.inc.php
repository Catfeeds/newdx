<?php

/**
 * @author JiangHong
 * @copyright 2013
 * �������ҳ��ĳ���û���Ϣ�Ļ��档ajaxʹ��
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$tuid = intval($_G['gp_uid']);
include template('common/header_ajax');
if ($tuid > 0 && $_G['uid'] > 0){
    memory('rm' , 'user_info_viewthread_uid_'.$tuid.'_cache');
    // �°�ҳ����ʾ lxp 20140126
	if($_G['newtpl']){
		echo '<b>�������</b>';
	} else {
		echo '<b style="color:green;">������ɣ���ˢ��ҳ��鿴��</b>';
	}
}else{
	if($_G['newtpl']){
		echo '<b>���ȵ�¼</b>';
	} else {
		echo '<b style="color:red;">���¼��ɴ˲�����</b>';
	}
}
include template('common/footer_ajax');
?>