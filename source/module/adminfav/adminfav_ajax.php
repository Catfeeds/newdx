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
$uid = empty($_GET['uid']) ? $_G['uid'] : intval($_GET['uid']);
$page=$_G['gp_page'];
$id=$_G['gp_id'];
if($op == 'del_adminfav') {
	if(submitcheck('delimgsubmit')) {
		//showmessage($disp);
		$return = DB::query("delete FROM ".DB::table('yingyong_fav')." where id=$id and uid=$uid");
		
		showmessage('do_success',"adminfav.php?page=".$page,array());
	}
}
elseif($op =='edit_adminfav') {
	
	$name=DB::result_first('select name FROM '.DB::table("yingyong_fav")." WHERE id=$id");
	$href=DB::result_first('select href FROM '.DB::table("yingyong_fav")." WHERE id=$id");
	$color=DB::result_first('select color FROM '.DB::table("yingyong_fav")." WHERE id=$id");
	if(submitcheck('url_editsubmit')){
			if(!preg_match("/^(http|ftp|https|mms)\:\/\//i", $_POST['href'])) $_POST['href'] = 'http://'.$_POST['href'];
			$url=array(
						'uid'=>$uid,
						'name'=>getstr($_POST['title'],0, 0, 0, 0, -1),
						'href'=>$_POST['href'],
						'color'=>$_POST['color'],
						'dateline'=>$_G['timestamp']
						);
			if(!empty($url['name']))
			{
				if($id){
					DB::update('yingyong_fav',daddslashes($url),"`id`='{$id}' and uid=$uid");
				}
				showmessage('do_success',"adminfav.php?page=".$page,array());
			}
		}
	}
include template('adminfav/ajax');
?>