<?php
/**
 * @author JiangHong
 * @todo get user's task doing list
 * @copyright 2014
 */

global $_G;
require_once libfile('class/task');
$tasklib = & task::instance();
if(! $_G['cookie']['taskcount_' . $_G['uid']]){
// 	$mytasklist = $tasklib->tasklist('doing');
	$newtasklist = $tasklib->tasklist('new');
// 	$task_count_my = count($mytasklist);
	$task_count_new = count($newtasklist);
	dsetcookie('taskcount_' . $_G['uid'], $task_count_my . "\t" . $task_count_new, 30);
}else{
	list($task_count_my, $task_count_new) = explode("\t", $_G['cookie']['taskcount_' . $_G['uid']]);
}

//������û���µ�֪ͨ�����롢����Ϣ������ͷ����Ϣ��ʽ
if($_G['cookie']['member_view_latest_' . $_G['uid']]){
	$data = explode("\t", $_G['cookie']['member_view_latest_' . $_G['uid']]);
	$task_count_new .= $_G["member"]["notifications"] > intval($data[0]) || $_G["member"]["newinvite"] > intval($data[1]) || $_G["member"]["newpm"] > intval($data[2]) || $task_count_new > intval($data[3]) ? ",1" : ",0";
} else {
	$task_count_new .= ",1";
}

include template('api:tasklist');
?>