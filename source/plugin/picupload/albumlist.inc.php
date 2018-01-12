<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 返回相册列表
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_G['gp_inajax']){
	if($_G['uid'] && $_G['gp_abid']){
		$aid = $_G['gp_abid'];
		include_once libfile('function/home');
		$perpage = 9;
		$page = max(1, $_G['gp_page']);
		$start_limit = ($page - 1) * $perpage;
		$photolist = array();
		$count= DB::result_first("SELECT picnum FROM ".DB::table('home_album')." WHERE albumid='$aid' AND uid='$_G[uid]'");
		$query = DB::query("SELECT * FROM ".DB::table('home_pic')." WHERE albumid='$aid' ORDER BY dateline ASC LIMIT $start_limit,$perpage " . getSlaveID());
		while($value = DB::fetch($query)) {
			$value['pic'] = pic_get($value['filepath'], 'album', $value['thumb'], $value['remote'],1,$value['serverid']);
			$value['bigpic'] = pic_get($value['filepath'], 'album', 0, $value['remote'],0,$value['serverid']);
			$value['count'] = $count;
			$value['url'] = (substr(strtolower($value['bigpic']), 0, 7) == 'http://' ? '' : $_G['siteurl']).$value['bigpic'];
			$value['thumburl'] = (substr(strtolower($value['pic']), 0, 7) == 'http://' ? '' : $_G['siteurl']).$value['pic'];
			$photolist[] = $value;
		}
		$c_i = $c_j = 0;$b_space = '';
		$c_i = count($photolist)%3;
		$c_i > 0 && $c_j = 3 - $c_i;
		for($i = 1; $i <= $c_j ; $i++){
			$b_space .= '<li></li>';
		}
		$_G['gp_ajaxtarget'] = 'albumlist_ajax';
		if($page > 100){
			$showpage = 5;
			$addcss = "<style>.pg a, .pg strong{margin-left:0px;padding-left:3px;}</style>";
		}elseif($page >= 10){
			$showpage = 4;
			$addcss = "<style>.pg a, .pg strong{margin-left:2px;padding-left:5px}</style>";
		}else{
			$showpage = 3;
			$addcss = "";
		}
		$multi = multi($count, $perpage, $page, "plugin.php?id=picupload:albumlist&abid=$aid" , 0 , $showpage , true , true);
		include template('common/header_ajax');
		include template('picupload:albumlist');
		include template('common/footer_ajax');
	}else{
		showmessage('postperm_login_nopermission', NULL, array(), array('login' => 1));
	}
}

?>