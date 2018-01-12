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
/*
$daohang=array();
$query=DB::query("SELECT * FROM ".DB::table('wangban_daohang')." where 1 ");
while($value=DB::fetch($query)){
	$daohang[]=$value;
}
 */
 
 $uid=$_G['uid'];
		
 $daohang=array();
	$query=DB::query("SELECT * FROM ".DB::table('yingyong_fav')." where uid=$uid ORDER BY id");
	$count=DB::result_first('SELECT count(*) FROM '.DB::table("yingyong_fav")." WHERE uid=$uid");
	while($value=DB::fetch($query)){
		$daohang[]=$value;
	}
	if(submitcheck('daohang_editsubmit')) {
		
		$id=intval($_POST['id']);
		if(!preg_match("/^(http|ftp|https|mms)\:\/\//i", $_POST['href'])) $_POST['href'] = 'http://'.$_POST['href'];
		$daohang=array(
					'uid'=>$uid,
					'name'=>getstr($_POST['title'],0, 0, 0, 0, -1),
					'href'=>$_POST['href'],
					'color'=>$_POST['color'],
					'dateline'=>$_G['timestamp']
					);
		if(!empty($daohang['name']))
		{
			if($id){
				
				DB::update('yingyong_fav',daddslashes($daohang),"`id`='{$id}'");
				
			}else{
				DB::insert('yingyong_fav',daddslashes($daohang),1);
			}
			showmessage('do_success','fav.php',$daohang);
		}
	}
	
include template('yingyong/index');
?>