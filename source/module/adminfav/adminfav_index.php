<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 17496 2010-10-20 03:03:15Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
	$op=$_G['gp_op'];
	$uid=$_G['gp_uid'];
	$page=$_G['gp_page'];
	if(empty($_G['uid'])) {
		showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
	}

	$uid = empty($_GET['uid']) ? $_G['uid'] : intval($_GET['uid']);
	$page = empty($_GET['page'])?1:$_GET['page'];
	if($_GET['uid'])
	{
		$theurl="adminfav.php?mod=index&op=search_uid&uid=".$uid;
	}
	else
	{
		$theurl="adminfav.php";
	}
	$perpage = 50;
	$perpage = mob_perpage($perpage);
	$start = ($page-1)*$perpage;
	ckstart($start, $perpage);
	$urls=array();
	$query=DB::query("SELECT * FROM ".DB::table('yingyong_fav')." where 1 ORDER BY dateline DESC LIMIT $start,$perpage");
	while($value=DB::fetch($query)){
		$urls[]=$value;
	}
	$result=DB::query("SELECT count(*) as title FROM ".DB::table('yingyong_fav'));
	$count=mysql_result($result,0,"title");
	$multi = multi($count, $perpage, $page, $theurl);
	if($op=="search_uid")
	{
		$urls=array();
		$query=DB::query("SELECT * FROM ".DB::table('yingyong_fav')." where uid=$uid ORDER BY dateline DESC LIMIT $start,$perpage");
		while($value=DB::fetch($query)){
			$urls[]=$value;
		}
		$result=DB::query("SELECT count(*) as title FROM ".DB::table('yingyong_fav')." where uid=$uid");
		$count=mysql_result($result,0,"title");
		$multi = multi($count, $perpage, $page, $theurl);
	}
	if(submitcheck('searchsubmit')){
		$urls=array();
		$query=DB::query("SELECT * FROM ".DB::table('yingyong_fav')." where name like '%".$_POST['srchtxt']."%' or href like '%".$_POST['srchtxt']."%' ORDER BY dateline DESC LIMIT $start,$perpage");
		while($value=DB::fetch($query)){
			$urls[]=$value;
		}
		$result=DB::query("SELECT count(*) as title FROM ".DB::table('yingyong_fav')." where name like '%".$_POST['srchtxt']."%'");
		$count=mysql_result($result,0,"title");
		$multi = multi($count, $perpage, $page, $theurl);
	}
include template('adminfav/index');
?>