<?php
/**
 * 点评回复管理操作
 */
$do = in_array($_GET['do'], array('support', 'rate', 'removerate', 'delpost', 'stickreply','addlike')) ? $_GET['do'] : '';

$pid = $_G['gp_pid'] ? intval($_G['gp_pid']) : 0;

if(!$_G['uid'])
{
	//echo '{"error":1, "msg":"需要登陆后才能继续操作"}';
	echo '-1';
	exit;
}
if($do=='')
{
	echo '{"error":1, "msg":"非法操作，请返回"}'; exit;
}
require_once libfile('function/misc');
require_once libfile('dianping/comment_brand', 'class');
$comment_obj = new comment_brand();

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
}elseif ($do=='addlike'){
	$like=$comment_obj->getlike($_G['gp_tid'],$_G['gp_uid'],$_G['gp_type']);

	if($like){
		//已经操作过返回-2
		echo '-2';
		exit;
	}else{
		if($comment_obj->like($_G['gp_tid'],$_G['uid'],$_G['username'],$_G['gp_type'])){
			$likenum=$comment_obj->likenum($_G['gp_tid'],$_G['gp_type']);
			echo $likenum;
		}else{
			echo 'false';
		}
	}

}

?>
