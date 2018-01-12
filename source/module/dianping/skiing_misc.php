<?php
/**
 *	滑雪场点评操作管理
 *
 */

$do = in_array($_GET['do'], array('support', 'edit', 'deleteit', 'checkit')) ? $_GET['do'] : '';

if(!$_G['uid']) { echo '-1'; exit; }	//需要登陆后才能继续操作

$pid = $_GET['pid'] ? intval($_GET['pid']) : 0;

require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();

if($do == 'support')
{
	$issupport = $comment_obj->getsupport($pid, $_G['uid']);
	if($issupport) { echo '-3'; exit; }	//已经评价过了
	$supportnum = $comment_obj->support($pid);
	if($supportnum == '-1')
	{
		echo '-2'; exit;
	}
	else
	{
		echo '('.$supportnum.')'; exit;
	}
}

?>
