<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_upload.php 17282 2010-09-28 09:04:15Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/include.php';
$albumid = empty($_GET['albumid'])?0:intval($_GET['albumid']);

if($_GET['op'] == 'recount') {
	$newsize = DB::result(DB::query("SELECT SUM(size) FROM ".DB::table('home_pic')." WHERE uid='$_G[uid]' " . getSlaveID()), 0);
	DB::update('common_member_count', array('attachsize'=>$newsize), array('uid'=>$_G['uid']));
	showmessage('do_success', 'home.php?mod=spacecp&ac=upload');
}

if(submitcheck('albumsubmit')) {
	if($_POST['albumop'] == 'creatalbum') {
		$_POST['albumname'] = empty($_POST['albumname'])?'':getstr($_POST['albumname'], 50, 1, 1);
		$_POST['albumname'] = censor($_POST['albumname'], NULL, TRUE);

		if(is_array($_POST['albumname']) && $_POST['albumname']['message']) {
			echo "<script>";
			echo "parent.showDialog('{$_POST['albumname']['message']}');";
			echo "</script>";
			exit();
		}

		if(empty($_POST['albumname'])) $_POST['albumname'] = gmdate('Ymd');

		$_POST['friend'] = intval($_POST['friend']);

		$_POST['target_ids'] = '';
		if($_POST['friend'] == 2) {
			$uids = array();
			$names = empty($_POST['target_names'])?array():explode(' ', str_replace(array(lang('spacecp', 'tab_space'), "\r\n", "\n", "\r"), ' ', $_POST['target_names']));
			if($names) {
				$query = DB::query("SELECT uid FROM ".DB::table('common_member')." WHERE username IN (".dimplode($names).")");
				while ($value = DB::fetch($query)) {
					$uids[] = $value['uid'];
				}
			}
			if(empty($uids)) {
				$_POST['friend'] = 3;
			} else {
				$_POST['target_ids'] = implode(',', $uids);
			}
		} elseif($_POST['friend'] == 4) {
			$_POST['password'] = trim($_POST['password']);
			if($_POST['password'] == '') $_POST['friend'] = 0;
		}
		if($_POST['friend'] !== 2) {
			$_POST['target_ids'] = '';
		}
		if($_POST['friend'] !== 4) {
			$_POST['password'] = '';
		}

		$setarr = array();
		$setarr['albumname'] = $_POST['albumname'];
		$setarr['catid'] = intval($_POST['catid']);
		$setarr['uid'] = $_G['uid'];
		$setarr['username'] = $_G['username'];
		$setarr['dateline'] = $setarr['updatetime'] = $_G['timestamp'];
		$setarr['friend'] = $_POST['friend'];
		$setarr['password'] = $_POST['password'];
		$setarr['target_ids'] = $_POST['target_ids'];
        $albumid = DB::insert('home_album', $setarr, 1);
        //新增，检测是否存在关联的品牌，存在将放入总缓冲表，并更新缓存对列2012-07-02
        $type_module = "photos";
        $search_arr = array($_POST['albumname']);
    	$produce_info = $forumOption->get_produce_id_arr($search_arr);
        if($produce_info){

            for($dl_i=0;$dl_i<count($produce_info);$dl_i++){
                $newthread = array('otherid' => $albumid,
                                'id' =>$produce_info[$dl_i],
                                'type' =>$type_module,
                                'dateline' =>time()
                                );
             $forumOption->produce_update_cache_all($newthread,'brand',1);   //将发的新帖子，与关联的品牌放入总缓存表中永久保存
             $forumOption->update_cache_produce($produce_info[$dl_i],$type_module); //更新缓存队列
            }
        }

        //以上为新增2012-07-02
		if($setarr['catid']) {
			DB::query("UPDATE ".DB::table('home_album_category')." SET num=num+1 WHERE catid='$setarr[catid]'");
		}

		if(empty($space['albumnum'])) {
			$space['albums'] = getcount('home_album', array('uid'=>$space['uid']));
			$albumnumsql = "albums=".$space['albums'];
		} else {
			$albumnumsql = 'albums=albums+1';
		}
		DB::query("UPDATE ".DB::table('common_member_count')." SET {$albumnumsql} WHERE uid='$_G[uid]'");

	} else {
		$albumid = intval($_POST['albumid']);
	}

	if($_G['mobile']) {
		showmessage('do_success', 'home.php?mod=spacecp&ac=upload');
	} else {
		echo "<script>";
		echo "parent.no_insert = 1;";
		echo "parent.albumid = $albumid;";
		echo "parent.start_upload();";
		echo "</script>";
	}
	exit();

} elseif(submitcheck('uploadsubmit')) {

	$albumid = $picid = 0;

	if(!checkperm('allowupload')) {
		if($_G['mobile']) {
			showmessage(lang('spacecp', 'not_allow_upload'));
		} else {
			echo "<script>";
			echo "alert(\"".lang('spacecp', 'not_allow_upload')."\")";
			echo "</script>";
			exit();
		}
	}

	$uploadfiles = pic_save($_FILES['attach'], $_POST['albumid'], $_POST['pic_title']);
	if($uploadfiles && is_array($uploadfiles)) {
		$albumid = $uploadfiles['albumid'];
		$picid = $uploadfiles['picid'];
		$uploadStat = 1;
		if($albumid > 0) {
			album_update_pic($albumid);
		}
	} else {
		$uploadStat = $uploadfiles;
	}

	if($_G['mobile']) {
		if($picid) {
			if(ckprivacy('upload', 'feed')) {
				require_once libfile('function/feed');
				feed_publish($albumid, 'albumid');
			}
			showmessage('do_success', "home.php?mod=space&uid=$_G[uid]&do=album&picid=$picid");
		} else {
			showmessage($uploadStat, 'home.php?mod=spacecp&ac=upload');
		}
	} else {
		echo "<script>";
		echo "parent.albumid = $albumid;";
		echo "parent.uploadStat = '$uploadStat';";
		echo "parent.picid = $picid;";
		echo "parent.upload();";
		echo "</script>";
	}
	exit();

} elseif(submitcheck('viewAlbumid')) {

	if($_POST['opalbumid'] > 0) {
		album_update_pic($_POST['opalbumid']);
	}

	if(ckprivacy('upload', 'feed')) {
		require_once libfile('function/feed');
		feed_publish($_POST['opalbumid'], 'albumid');
	}

	$url = "home.php?mod=space&uid=$_G[uid]&do=album&quickforward=1&id=".(empty($_POST['opalbumid'])?-1:$_POST['opalbumid']);

	showmessage('upload_images_completed', $url);

} else {
	if(!checkperm('allowupload')) {
		showmessage('no_privilege', '', array(), array('return' => true));
	}
	ckrealname('album');
	ckvideophoto('album');
	cknewuser();
	$config = urlencode($_G['siteroot'].'home.php?mod=misc&ac=swfupload&op=config'.($_GET['op'] == 'cam'? '&cam=1' : '').($_GET['albumid'] > 0 ? '&albumid='.$_GET['albumid'] : '').($_GET['debug']==1 ? '&debug=1' : ''));
	$albums = getalbums($_G['uid']);
	$actives = ($_GET['op'] == 'flash' || $_GET['op'] == 'cam')?array($_GET['op']=>' class="a"'):array('js'=>' class="a"');
	$maxspacesize = checkperm('maxspacesize');
	if(!empty($maxspacesize)) {
		space_merge($space, 'count');
		space_merge($space, 'field_home');
		$maxspacesize = $maxspacesize + $space['addsize'] * 1024 * 1024;
		$haveattachsize = formatsize($maxspacesize - $space['attachsize']);
	} else {
		$haveattachsize = 0;
	}
	require_once libfile('function/friend');
	$groups = friend_group_list();
	loadcache('albumcategory');
	$category = $_G['cache']['albumcategory'];
	$categoryselect = '';
	if($category) {
		include_once libfile('function/portalcp');
		$categoryselect = category_showselect('album', 'catid', !$_G['setting']['albumcategoryrequired'] ? true : false, $_GET['catid']);
	}
}

if(!$_G['gp_op']) {
	$_G['gp_op'] = 'normal';
}
$navtitle = lang('core', 'title_'.$_G['gp_op'].'_upload');

if ($_G['gp_op'] == 'flash') {
	//不显示底部广告
	$nobottomad = false;
	$hash = md5($_G['uid'].UC_KEY);

	require_once libfile('function/spacecp');
	$user_albums = getalbums($_G['uid']);


	$albumids_arr = array();
	foreach($user_albums as &$v){
		$albumids_arr[] = $v['albumid'];
		$v['mpic'] = "http://".$_G['config']['cdn']['images']['cdnurl']."/".$v['mpic']."!t2w60h60";
		$v['albumname'] = stripslashes($v['albumname']);
	}
	$albumid = $_G['gp_albumid'];

	if(in_array($albumid, $albumids_arr)){
		$album_list_type = 1;
		$the_album = $user_albums[$albumid];
	}else{
		$album_list_type = 2;
		$albumid = "";
	}

	require_once libfile('class/upyun_form');
	$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

	$opts = array();
	$opts['save-key'] = '/album/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // 保存路径
	$opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';

	$policy = $upyun->policyCreate($opts);
	$sign = $upyun->signCreate($opts);
	$action = $upyun->action();
	$version = $upyun->version();

	include_once template("home/spacecp_upload_uc");
} else {
	include_once template("home/spacecp_upload");
}

?>
