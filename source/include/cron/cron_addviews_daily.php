<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//����꣬��237�����ʵ����
$dianpu = 237;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$dianpu." where fid = '".$_G['config']['fids']['dianpu']."'");

//Ʒ�Ƽ�493�����ʵ��
$pinpai = 493;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$pinpai." where fid = '".$_G['config']['fids']['brand']."'");

//��ѩ����243�����
$skiing = 243;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$skiing." where fid = '".$_G['config']['fids']['skiing']."'");

//װ�����247�����
$equipment = 247;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$equipment." where fid = '".$_G['config']['fids']['equipment']."'");

//��·��247�����
$xianludianping = 247;
DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$xianludianping." where fid = '".$_G['config']['fids']['line']."'");

//���ױ��Ǻ�����·����
//�����
$xianlu = rand(1400,1600);
//������
$download = rand(380,400);
$query = DB::query("SELECT id FROM ".DB::table('portal_article_title')." WHERE catid = 881");
while ($value = DB::fetch($query)) {
	if($value['id']){
		DB::query("UPDATE ".DB::table('forum_thread')." SET views=views+".$xianlu." where tid = '".$value['id']."'");
		DB::query("UPDATE ".DB::table('forum_attachment')." SET downloads=downloads+".$download." WHERE tid='".$value['id']."' and filetype='application/pdf' and isimage=0 ORDER BY dateline LIMIT 1");
	}		
}