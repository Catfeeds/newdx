<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';
$puid=$_GET['prid'];
$uuid=$_GET['puid'];

if(!empty($puid)&&!empty($uuid)){
	$reason=mb_convert_encoding($_POST['reason'],'GBK','UTF-8');
	$issend=$_POST['sendreasonpm'];
	$price=DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_price')." WHERE id = {$puid}");
	if($issend&&($uuid!=$_G['uid'])){
		$thread=ForumOptionProduce::getTheardBytId($price['tid']);
		$message = '你的价格在 <a href="'.$_G['config']['web']['portal'].'zb-'.$thread[tid].'" target="_blank">'.$thread[subject].'</a> 被 管理员 删除 <div class="quote"><blockquote>'.$reason.'</blockquote></div>';
		notification_add($uuid, 'system', 'system_notice', array('subject' => '用户您好：', 'message' => $message), 0);
	}
	DB::query("update ".DB::table('plugin_produce_price')." set deletereason = '{$reason}',isdelete = 1 WHERE id ={$puid}");
	//删除价格减分操作
	ForumOptionProduce::calPostRankEvent($price['tid'],6);
	$threads=ForumOptionProduce::getTheardBytId($price['tid']);
	ForumOptionProduce::calPublisherRankEvent($threads['authorid'],$threads['author'],3);
	echo "success";
}else{
	echo "error";
}
