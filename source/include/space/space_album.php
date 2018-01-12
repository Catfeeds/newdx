<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_album.php 19158 2010-12-20 08:21:50Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/space');
space_merge($space, 'count');

$minhot = $_G['setting']['feedhotmin'] < 1 ? 3 : $_G['setting']['feedhotmin'];
$id 	= empty($_GET['id'])?0:intval($_GET['id']);
$picid 	= empty($_GET['picid'])?0:intval($_GET['picid']);

$page   = empty($_GET['page'])?1:intval($_GET['page']);
if($page < 1) $page = 1;

/*新增查询附件服务器信息*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$all_server = $attachserver->get_server_domain('all');
/*结束*/

if($id > 0) {
	
	//相片列表	
	require libfile('function/spacecp');
	
	$perpage = 15;
	$perpage = mob_perpage($perpage);
	$start   = ($page-1)*$perpage;

	ckstart($start, $perpage);
	
	$isEdit = !empty($_G['gp_edit']) ? true :false;

	//获得当前相册的信息
	$query = DB::query("SELECT * FROM ".DB::table('home_album')." WHERE albumid='$id' AND uid='$space[uid]' LIMIT 1");
	$album = DB::fetch($query);
	if(empty($album)) {
		showmessage('相册已空，系统已为您删除', "home.php?mod=space&uid={$space['uid']}&do=album&view=me");
	}

	ckfriend_album($album);

	$wheresql = "albumid='$id'";
	
	if(empty($album['picnum'])) {
		DB::query("DELETE FROM ".DB::table('home_album')." WHERE albumid='$id'");
		showmessage('相册已空，系统已为您删除', "home.php?mod=space&uid={$album['uid']}&do=album&view=me");
	}

	if($album['catid']) {
		$album['catname'] = DB::result(DB::query("SELECT catname FROM ".DB::table('home_album_category')." WHERE catid='$album[catid]'"), 0);
		$album['catname'] = dhtmlspecialchars($album['catname']);
	}
	
	if (empty($album['mpic'])) {
		$tempPic = album_update_pic($album['albumid'], 0 , true);
		$album['mpic'] 		= $tempPic['mpic'];
		$album['mserverid'] = $tempPic['mserverid'];
	}	
	
	$album['pic']  = getimagethumb(231, 231, 2, $album['mpic'], 0, $album['mserverid']);

	//获得当前相册的相片列表
	$list = array();
	$pricount = 0;
	if($album['picnum']) {		
		$query = DB::query("SELECT * FROM ".DB::table('home_pic')." WHERE $wheresql ORDER BY dateline ASC LIMIT $start,$perpage " . getSlaveID());
		while ($value = DB::fetch($query)) {
			if($value['status'] == 0 || $value['uid'] == $_G['uid'] || $_G['adminid'] == 1) {
				$dir                   = $value['remote'] == 2 ? 'forum' : 'album';
				$value['pic']  		   = getimagethumb(290, 192, 2, $dir.'/'.$value['filepath'], 0, $value['serverid']);
				$value['filepath']     = $value['serverid'] > 50 ? "http://{$_G['config']['cdn']['images']['cdnurl']}/{$dir}/{$value['filepath']}" : "http://{$_G['config']['host']['attachauto']}/{$dir}/{$value['filepath']}";	
				$list[$value['picid']] = $value;
			} else {
				$pricount++;
			}
		}
	}
	$theurl   = "home.php?mod=space&uid={$album[uid]}&do={$do}&id={$id}";
	$multi    = multi($album['picnum'], $perpage, $page, $theurl);	

	$navtitle 			= $album['albumname'].' - '.lang('space', 'sb_album', array('who' => $album['username']));
	$metakeywords 		= $album['albumname'];
	$metadescription 	= $album['albumname'];
	
	include_once template("home/space_album_view");

} elseif ($picid) {	
	//相片详细
	
	//获得相片信息
	$query  = DB::query("SELECT * FROM ".DB::table('home_pic')." WHERE picid='{$picid}' AND uid='{$space[uid]}' LIMIT 1");
	$pic 	= DB::fetch($query);
	if(!$pic || ($pic['status'] == 1 && $pic['uid'] != $_G['uid'] && $_G['adminid'] != 1 && $_G['gp_modpickey'] != modauthkey($pic['picid']))) {
		showmessage('view_images_do_not_exist');
	}
	
	$theurl = "home.php?mod=space&uid=$pic[uid]&do=$do&picid=$picid";

	//获得相册信息
	$album = array();
	if($pic['albumid']) {
		$query = DB::query("SELECT * FROM ".DB::table('home_album')." WHERE albumid='{$pic[albumid]}'");
		if(!$album = DB::fetch($query)) {
			DB::update('home_pic', array('albumid'=>0), array('albumid'=>$pic['albumid']));
		}
	}

	if($album) {
		ckfriend_album($album);
		$wheresql = "albumid='{$pic[albumid]}'";
	} else {
		$album['picnum']  = getcount('home_pic', array('uid'=>$pic['uid'], 'albumid'=>0));
		$album['albumid'] = $pic['albumid'] = '-1';
		$wheresql = "uid='{$space[uid]}' AND albumid='0'";
	}

	//获得此相片上一张和下一张的picid
	$prevpicid 	= '';
	$nextpicid 	= '';
	$index	 	= 0;
	$currIndex 	= 0;
	$hasCurr    = false;
	$query   	= DB::query("SELECT picid,uid,status FROM ".DB::table('home_pic')." WHERE $wheresql ORDER BY dateline ASC " . getSlaveID());	
	while ($v = DB::fetch($query)) {
		if($v['status'] == 0 || $v['uid'] == $_G['uid'] || $_G['adminid'] == 1) {
			if ($v['picid'] == $picid) {
				$currIndex = $index;
				$hasCurr   = true;
			}
			$prevpicid = !$hasCurr ? $v['picid'] : $prevpicid;
			$nextpicid = $index == $currIndex+1 && $hasCurr ? $v['picid'] : '';
			$index++;
			if ($nextpicid) {break;}
		}
	}

	$pic['pic']  = pic_get($pic['filepath'], 'album', $pic['thumb'], $pic['remote'], 0, $pic['serverid']);
	$pic['size'] = formatsize($pic['size']);

	//相片评论
	$perpage = 5;
	$perpage = mob_perpage($perpage);
	$start   = ($page-1)*$perpage;
	ckstart($start, $perpage);

	$cid  = empty($_GET['cid']) ? 0 : intval($_GET['cid']);
	$csql = $cid ? "cid='$cid' AND" : '';
	
	//评论列表
	$list    = array();
	$count   = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_comment')." WHERE $csql id='$pic[picid]' AND idtype='picid'"),0);
	if($count) {
		$query = DB::query("SELECT * FROM ".DB::table('home_comment')." WHERE $csql id='$pic[picid]' AND idtype='picid' ORDER BY dateline desc LIMIT $start,$perpage");
		while ($value = DB::fetch($query)) {
			$list[] = $value;
		}
	}

	$multi = multi($count, $perpage, $page, $theurl);

	if(empty($album['albumname'])) $album['albumname'] = lang('space', 'default_albumname');

	$pic_url = $pic['pic'];
	if(!preg_match("/^http\:\/\/.+?/i", $pic['pic'])) {
		$pic_url = getsiteurl().$pic['pic'];
	}
	
	$navtitle = $album['albumname'];
	if($pic['title']) {
		$navtitle = $pic['title'].' - '.$navtitle;
	}
	$metakeywords    = $pic['title'] ? $pic['title'] : $album['albumname'];
	$metadescription = $pic['title'] ? $pic['title'] : $albumname['albumname'];

	if($_G['inajax']){
	   	include template('home/space_album_pic_comment');
	}else{
		include_once template("home/space_album_pic");//参考自forum/viewpicture		
	}

} else {	
	//相册列表
	
	loadcache('albumcategory');
	$category = $_G['cache']['albumcategory'];

	$perpage = 20;
	$perpage = mob_perpage($perpage);

	$start = ($page-1)*$perpage;

	ckstart($start, $perpage);

	$_GET['friend'] = intval($_GET['friend']);

	$default 	= array();
	$f_index 	= '';
	$list    	= array();
	$pricount 	= 0;
	$picmode 	= 0;

	if(empty($_GET['view'])) {
		$_GET['view'] = 'we';
	}

	$gets = array(
		'mod' 		=> 'space',
		'uid' 		=> $space['uid'],
		'do' 		=> 'album',
		'view' 		=> $_GET['view'],
		'catid' 	=> $_GET['catid'],
		'order' 	=> $_GET['order'],
		'fuid' 		=> $_GET['fuid'],
		'searchkey' => $_GET['searchkey'],
		'from' 		=> $_GET['from']
	);
	$theurl  = 'home.php?'.url_implode($gets);
	$actives = array($_GET['view'] =>' class="a"');

	$need_count = true;

	if($_GET['view'] == 'all') {

		$wheresql = '1';

		if($_GET['order'] == 'hot') {
			$orderactives = array('hot' => ' class="a"');
			$picmode = 1;
			$need_count = false;

			$ordersql = 'p.dateline';
			$wheresql = "p.hot>='$minhot'";

			$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_pic')." p WHERE $wheresql " . getSlaveID()),0);
			if($count) {
				$query = DB::query("SELECT p.*, a.albumname, a.friend, a.target_ids FROM ".DB::table('home_pic')." p
					LEFT JOIN ".DB::table('home_album')." a ON a.albumid=p.albumid
					WHERE $wheresql
					ORDER BY $ordersql DESC
					LIMIT $start,$perpage");
				while ($value = DB::fetch($query)) {
					if(ckperm($value)) {
						$value['pic'] = pic_get($value['filepath'], 'album', $value['thumb'], $value['remote'],1,$value['serverid']);
						$list[] = $value;
					} else {
						$pricount++;
					}
				}
			}

		} else {
			$orderactives = array('dateline' => ' class="a"');
		}

	} elseif($_GET['view'] == 'we') {

		space_merge($space, 'field_home');

		if($space['feedfriend']) {

			$wheresql = "uid IN ($space[feedfriend])";
			$f_index = 'USE INDEX(updatetime)';

			$fuid_actives = array();

			require_once libfile('function/friend');
			$fuid = intval($_GET['fuid']);
			if($fuid && friend_check($fuid)) {
				$wheresql = "uid='$fuid'";
				$f_index = '';
				$fuid_actives = array($fuid=>' selected');
			}

			$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$space[uid]' ORDER BY num DESC, dateline DESC LIMIT 0,500");
			while ($value = DB::fetch($query)) {
				$userlist[] = $value;
			}
		} else {
			$need_count = false;
		}

	} else { 
		$diymode   = 1;
		$wheresql  = "uid={$space['uid']}";
	}

	if($need_count) {		
		if($searchkey = stripsearchkey($_GET['searchkey'])) {
			$wheresql .= " and albumname like '%$searchkey%'";
			$searchkey = dhtmlspecialchars($searchkey);
		}

		$catid = empty($_GET['catid']) ? 0 : intval($_GET['catid']);
		if($catid) {
			$wheresql .= " and catid = {$catid}";
		}
		
		$wheresql .= !ckperm() ? ' and friend = 0 ' : '';	
		$count     = DB::result_first("SELECT COUNT(*) FROM ".DB::table('home_album')." WHERE {$wheresql} " . getSlaveID());
		if($count) {
			require libfile('function/spacecp');
			$query = DB::query("SELECT * FROM ".DB::table('home_album')." $f_index WHERE $wheresql ORDER BY updatetime DESC LIMIT $start,$perpage");
			while ($value = DB::fetch($query)) {
				if(ckperm($value)) {
					if ($diymode) {
						if (empty($value['mpic'])) {														
							$tempPic = album_update_pic($value['albumid'], 0 , true);
							$value['mpic'] 		= $tempPic['mpic'];
							$value['mserverid'] = $tempPic['mserverid'];
						}
						$value['pic']  = getimagethumb(212, 212, 2, $value['mpic'], 0, $value['mserverid']);
					} else {
						$value['pic'] = pic_cover_get($value['pic'], $value['picflag'], $all_server[$value['serverid']]);
					}					
				} elseif ($value['picnum']) {
					$value['pic'] = 'http://static.8264.com/static/image/common/nopublish.gif';
				} else {
					$value['pic'] = '';
				}
				$list[] = $value;
			}
		}
	}

	$multi = multi($count, $perpage, $page, $theurl);
	
	if($_G['uid']) {
		if($_G['gp_view'] == 'all') {
			$navtitle = lang('core', 'title_view_all').lang('core', 'title_album');
		} elseif($_G['gp_view'] == 'me') {
			$navtitle = lang('core', 'title_my_album');
		} else {
			$navtitle = lang('core', 'title_friend_album');
		}
	} else {
		if($_G['gp_order'] == 'hot') {
			$navtitle = lang('core', 'title_hot_pic_recommend');
		} else {
			$navtitle = lang('core', 'title_newest_update_album');
		}
	}
	if($space['username']) {
		$navtitle = lang('space', 'sb_album', array('who' => $space['username']));
	}
	
	$metakeywords 	 = $navtitle;
	$metadescription = $navtitle;
	
	if ($diymode) {
		include_once template("home/space_album_list_uc");
	} else {
		include_once template("diy:home/space_album_list");
	}
}

function ckfriend_album($album) {
	global $_G, $space;
	
	if($_G['adminid'] != 1 && !$space['self'] && $album['friend'] > 0) {		
		showmessage("由于 {$album['username']} 的隐私设置，你不能访问当前内容",dreferer());
	}
}

?>