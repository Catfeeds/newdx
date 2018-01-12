<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//户外店，加237个访问点击。
$dianpu = 237;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$dianpu." where fid = '".$_G['config']['fids']['dianpu']."'");

//品牌加493个访问点击
$pinpai = 493;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$pinpai." where fid = '".$_G['config']['fids']['brand']."'");

//滑雪场加243个点击
$skiing = 243;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$skiing." where fid = '".$_G['config']['fids']['skiing']."'");

//装备库加247个点击
$equipment = 247;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$equipment." where fid = '".$_G['config']['fids']['equipment']."'");

//线路加247个点击
$xianludianping = 247;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$xianludianping." where fid = '".$_G['config']['fids']['line']."'");

//哥伦比亚合作线路下载
//点击量
$xianlu = rand(1400,1600);
//下载数
$download = rand(380,400);
$query = DB::query("SELECT id FROM ".DB::table('portal_article_title')." WHERE catid = 881");
while ($value = DB::fetch($query)) {
	if($value['id']){
		DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$xianlu." where tid = '".$value['id']."'");
		DB::query("UPDATE ".DB::table('forum_attachment')." SET downloads=downloads+".$download." WHERE tid='".$value['id']."' and filetype='application/pdf' and isimage=0 ORDER BY dateline LIMIT 1");
	}		
}