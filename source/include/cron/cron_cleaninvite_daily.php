<?php

/**
 * @author JiangHong
 * @copyright 2013
 * ���������°��������Ϣ��������15���������Ϣ
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/*$time = strtotime(date('Y-m-d', strtotime('-15days')));
$counts = DB::result_first('SELECT COUNT(*) FROM '.DB::table('plugin_invite_message')." WHERE `dateline` < {$time}");
DB::delete('plugin_invite_message', "dateline < {$time}");
DB::delete('plugin_invite_readed', "dateline < {$time}");
DB::delete('plugin_invite_relation', "dateline < {$time}");
require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
$logs = new logs('cron_delete_invite');
$nowtime = date('Y-m-d H:i:s', $_G['timestamp']);
$logs->log_str("��ǰʱ�� {$nowtime} ,ִ��ɾ�����빦�ܣ���ɾ�� ".date('Y-m-d H:i:s' ,$time)."({$time})ǰ�� {$counts} ��������Ϣ");*/
?>