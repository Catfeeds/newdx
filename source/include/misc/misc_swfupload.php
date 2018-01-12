<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_swfupload.php 19665 2011-01-13 06:08:34Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/spacecp');

$op = empty($_GET['op'])?'':$_GET['op'];

$isupload = empty($_GET['cam']) && empty($_GET['doodle']) ? true : false;
$iscamera = isset($_GET['cam']) ? true : false;
$isdoodle = isset($_GET['doodle']) ? true : false;
$fileurl = '';
if(!empty($_POST['uid']) || ($_G['gp_newflash']==1 && $op != 'config')) {
	//$_G['uid'] = intval($_POST['uid']);
    $_G['uid'] = intval($_G['gp_uid']);
	if(empty($_G['uid']) || $_G['gp_hash'] != md5($_G['uid'].UC_KEY)) {
		exit('errorhash');
	}
	$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$_G[uid]' LIMIT 1");
	$_G['username'] = addslashes($member['username']);

	loadcache('usergroup_'.$member['groupid']);
	$_G['group'] = $_G['cache']['usergroup_'.$member['groupid']];

} elseif (empty($_G['uid'])) {
	showmessage('to_login', null, array(), array('showmsg' => true, 'login' => 1));
}
if($_G['gp_uid'] == 35732735){
	$_G['config']['cdns']['opend'] = true;
}
if($op == "getalbumid"){
    $albumid = DB::result_first("SELECT albumid FROM ".DB::table('home_pic')." WHERE uid={$_G[uid]} ORDER BY dateline DESC LIMIT 1");
    echo $albumid > 0 ? $albumid : 0;exit;
}elseif($op == "finish") {

	$albumid = intval($_GET['albumid']);

	$type = intval($_GET['type']);

	//上传完不更新封面
	/*if($albumid > 0) {
	   album_update_pic($albumid);
	}else{
	   $albumid = DB::result_first("SELECT albumid FROM ".DB::table('home_pic')." WHERE uid={$_G[uid]} ORDER BY dateline DESC LIMIT 1");
       album_update_pic($albumid);
	}*/
	if($albumid) {
		$pic_count = DB::result_first('SELECT COUNT(*) FROM ' . DB::table('home_pic') . " WHERE albumid={$albumid} " . getSlaveID());
		DB::update('home_album', array('picnum' => $pic_count, 'updatetime' => $_G['timestamp']), array('albumid' => $albumid));
	}

	$space = getspace($_G['uid']);

	if(ckprivacy('upload', 'feed')) {
		require_once libfile('function/feed');
		feed_publish($albumid, 'albumid');
	}

	if($type == 1){
		$url = $_G['config']['web']['home'].'home.php?mod=space&do=album'.($albumid > 0 ? '&id='.$albumid : '&view=me');
		echo json_encode(array('url' => $url, 'flag' => 1));die;
	}else{
		echo $_G['config']['web']['home'].'home.php?mod=space&do=album'.($albumid > 0 ? '&id='.$albumid : '&view=me');
		exit();
	}

} elseif($op == 'config') {

	$hash = md5($_G['uid'].UC_KEY);
	$uploadurl = urlencode(getsiteurl().'home.php?mod=misc&ac=swfupload'.($iscamera ? '&op=screen' : ($isdoodle ? '&op=doodle&from=':'')));
	if($isupload && !checkperm('allowupload')) {
		$hash = '';
	} else {
		$filearr = $dirstr = array();
		if($iscamera) {
			$directory = dreaddir(DISCUZ_ROOT.'./static/image/foreground');
			foreach($directory as $key => $value) {
				$dirstr = DISCUZ_ROOT.'./static/image/foreground/'.$value;
				if(is_dir($dirstr)) {
					$filearr = dreaddir($dirstr, array('jpg','jpeg','gif','png'));
					if(!empty($filearr)) {
						if(is_file($dirstr.'/categories.txt')) {
							$catfile = @file($dirstr.'/categories.txt');
							$dirarr[$key][0] = trim($catfile[0]);
						} else {
							$dirarr[$key][0] = trim($value);
						}
						$dirarr[$key][1] = trim('static/image/foreground/'.$value.'/');
						$dirarr[$key][2] = $filearr;
					}
				}
			}
		} elseif($isdoodle) {
			$filearr = dreaddir(DISCUZ_ROOT.'./static/image/doodle/big', array('jpg','jpeg','gif','png'));
		}
	}
	$feedurl = urlencode(getsiteurl().'home.php?mod=misc&ac=swfupload&op=finish&random='.random(8).'&albumid=');
	$albumurl = urlencode(getsiteurl().'home.php?mod=space&do=album'.($isdoodle ? '&picid=' : '&id='));
	$max = @ini_get(upload_max_filesize);
	$unit = strtolower(substr($max, -1, 1));
	if($unit == 'k') {
		$max = intval($max)*1024;
	} elseif($unit == 'm') {
		$max = intval($max)*1024*1024;
	} elseif($unit == 'g') {
		$max = intval($max)*1024*1024*1024;
	}
	$albums = getalbums($_G['uid']);
	loadcache('albumcategory');
	$categorys = $_G['cache']['albumcategory'];
	$categorystat = $_G['setting']['albumcategorystat'] ? intval($_G['setting']['albumcategorystat']) : 0;
	$categoryrequired = $_G['setting']['albumcategoryrequired'] ? intval($_G['setting']['albumcategoryrequired']) : 0;
} elseif($op == "screen" || $op == "doodle") {

	if(empty($GLOBALS['HTTP_RAW_POST_DATA'])) {
		$GLOBALS['HTTP_RAW_POST_DATA'] = file_get_contents("php://input");
	}
	$status = "failure";
	$dosave = true;

	if($op == "doodle") {
		$query = DB::query('SELECT mm.* FROM '.DB::table('common_magic').' cm LEFT JOIN '.DB::table('common_member_magic')." mm ON mm.uid = '$_G[uid]' AND mm.magicid = cm.magicid WHERE cm.identifier = 'doodle'");
		$magic = DB::fetch($query);
		if(empty($magic) || $magic['num'] < 1) {
			$uploadfiles = -8;
			$dosave = false;
		}
	}

	if($dosave && !empty($GLOBALS['HTTP_RAW_POST_DATA'])) {
		$_SERVER['HTTP_ALBUMID'] = addslashes(diconv(urldecode($_SERVER['HTTP_ALBUMID']), 'UTF-8'));
		$from = false;
		if($op == 'screen') {
			$from = 'camera';
		} elseif($_GET['from'] == 'album') {
			$from = 'uploadimage';
		}
		$_G['setting']['allowwatermark'] = 0;
		$uploadfiles = stream_save($GLOBALS['HTTP_RAW_POST_DATA'], $_SERVER['HTTP_ALBUMID'], 'jpg', '', '', 0, $from);
	}

	$uploadResponse = true;
	$picid = $proid = $albumid = 0;
	if($uploadfiles && is_array($uploadfiles)) {
		$status = "success";
		$albumid = $uploadfiles['albumid'];
		$picid =  $uploadfiles['picid'];
		if($op == "doodle") {
			$fileurl = pic_get($uploadfiles['filepath'], 'album', $uploadfiles['thumb'], $uploadfiles['remote'], 0,$uploadfiles['serverid']);
			$remote = $uploadfiles['remote'] > 1 ? $uploadfiles['remote'] - 2 : $uploadfiles['remote'];
			if(!$remote) {
				if(!preg_match("/^http\:\/\//i", $fileurl)) {
					$fileurl = getsiteurl().$fileurl;
				}
			}
			require_once libfile('function/magic');
			usemagic($magic['magicid'], $magic['num'], 1);
			updatemagiclog($magic['magicid'], '2', '1', '0');
			if($albumid > 0) {
				album_update_pic($albumid);
			}
		}
	} else {
		switch ($uploadfiles) {
			case -1:
				$uploadfiles = lang('spacecp', 'inadequate_capacity_space');
				break;
			case -2:
				$uploadfiles = lang('spacecp', 'only_allows_upload_file_types');
				break;
			case -4:
				$uploadfiles = lang('spacecp', 'ftp_upload_file_size');
				break;
			case -8:
				$uploadfiles = lang('spacecp', 'has_not_more_doodle');
				break;
			default:
				$uploadfiles = lang('spacecp', 'mobile_picture_temporary_failure');
				break;
		}
	}

} elseif($_G['gp_newflash']==1 && $op == 'createalbum'){
	$hash = md5($_G['gp_uid'].UC_KEY);
	$_GET['catid'] = $_GET['catid'] ? intval($_GET['catid']) : 0;
	$_GET['albumid'] = addslashes(diconv(urldecode($_GET['albumid']), 'UTF-8'));
	$albumid = $_GET['albumid'] < 0 ? 0 : $_GET['albumid'];
	$albumid = str_replace('_', ':', $albumid);
	if($albumid) {
		$albumid = album_creat_by_id($albumid, $_GET['catid']);
	}else{
		$albumid = 0;
	}
	echo $albumid;exit;
} elseif($op == 'checkalbumid'){
	$hash = md5($_G['gp_uid'].UC_KEY);
	$albumid = $_GET['albumid'] < 0 ? 0 : $_GET['albumid'];

	$albums = getalbums($_G['uid']);

	if( in_array($albumid, array_keys($albums) ) ){
		echo 1;die;
	}else{
		echo 0;die;
	}
} elseif($op == 'upyunupload'){
	if(!$_G['uid']){
		echo "-1";die;
	}

	$filesize = intval($_G['gp_filesize']);
	$albumid = intval($_G['gp_albumid']);

	$albums = getalbums($_G['uid']);
	if( !in_array($albumid, array_keys($albums) ) ){
		echo "-2";die;
	}

	$attachment = addslashes(str_replace("/album/", "", $_G['gp_url']));

	$uploadfiles = array(
		'albumid' => $albumid,
		'uid' => $_G['uid'],
		'username' => $_G['username'],
		'dateline' => $_G['timestamp'],
		'filename' => addslashes(iconv("UTF-8","GBK",$_G['gp_filename'])),
		'postip' => $_G['clientip'],
		'title' => "",
		'type' => addslashes(substr($_G['gp_filename'], strripos($_G['gp_filename'], '.')+1)),
		'size' => $filesize,
		'filepath' => $attachment,
		'thumb' => 0,
		'remote' => 0,
		'status' => 0,
		'serverid' => 99
	);
	$picid = DB::insert('home_pic', $uploadfiles, 1);

	include_once libfile('function/stat');
	updatestat('pic');

	echo $picid;die;

} elseif($_G['gp_newflash']==1 && $op == 'newupload'){
    $hash = md5($_G['gp_uid'].UC_KEY);

    $_GET['catid'] = $_GET['catid'] ? intval($_GET['catid']) : 0;
    //if(!empty($_FILES['Filedata'])){
        $_GET['albumid'] = addslashes(diconv(urldecode($_GET['albumid']), 'UTF-8'));
    //}
    if($_GET['source'] != 1){
        $albumid = $_GET['albumid'] < 0 ? 0 : $_GET['albumid'];
		$albumid = str_replace('_', ':', $albumid);
        if($albumid) {
    		$albumid = album_creat_by_id($albumid, $_GET['catid']);
    	} else {
    		$albumid = 0;
    		$showtip = false;
    	}
    }
    if($hash != $_G['gp_hash']){
        //file_put_contents(DISCUZ_ROOT.'./AABBCC.log', "HASH ERROR", FILE_APPEND);
    }elseif(!empty($_FILES['Filedata'])){
        $_FILES['Filedata']['name'] = addslashes(diconv(urldecode($_FILES["Filedata"]['name']), 'UTF-8'));
        $swfhash = md5($hash.md5($_FILES['Filedata']['name']).$_G['gp_filekey']);
        if($_GET['source'] == 1){
            require_once libfile('class/upload');
            $upload = new discuz_upload();
            $upload->init($_FILES['Filedata'], 'album');
            if(!$upload->error()){
                if($upload->save(0, false, false, false)){
                    require_once libfile('class/myredis');
                    $redis = & myredis::instance(6382);
                    $thumbargs = $redis->hashget('THUMB_WAITTING_HASH' ,$swfhash);
                    if($thumbargs){
                        $thumbargs = json_decode($thumbargs ,true);
                        $thumbargs['source'] = 'album/'.$upload->attach['attachment'];
                        $thumbargs['width'] = $_G['setting']['maxthumbwidth'];
                        $thumbargs['height'] = $_G['setting']['maxthumbheight'];
                        $thumbargs['quality'] = $_G['setting']['thumbquality'];
                    	$watermarktrans = unserialize($_G['setting']['watermarktrans']);
    					$watermarkstatus = unserialize($_G['setting']['watermarkstatus']);
    					$watermarkquality = unserialize($_G['setting']['watermarkquality']);
    					$thumbargs['watermarktype'] = $_G['setting']['watermarktype']['album'];
    					$thumbargs['watermarktrans'] = $watermarktrans['album'];
    					$thumbargs['watermarkstatus'] = $watermarkstatus['album'];
    					$thumbargs['watermarkquality'] = $watermarkquality['album'];
                        $redis->RPUSH('THUMB_WATTING_LIST_QUEUE' ,json_encode($thumbargs));
                        $redis->hashdel('THUMB_WAITTING_HASH' ,$swfhash);
                    }
                }
            }
        }else{
            $uploadfiles = pic_save($_FILES["Filedata"], $_GET['albumid'], '', true, $_GET['catid']);
        }
    }else{
        $swfhash = md5($hash.md5($_G['gp_filename']).$_G['gp_filekey']);
        //$_GET['filename'] = addslashes(diconv(urldecode($_GET['filename']), 'UTF-8'));
        $savefilename = date('His').strtolower(random(16)).'.jpg';
        if(empty($GLOBALS['HTTP_RAW_POST_DATA'])) $GLOBALS['HTTP_RAW_POST_DATA'] = file_get_contents("php://input");
		require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
        $attachserver = new attachserver;
        $servers_arr = $attachserver->get_server();
        require libfile('class/sockpost');
		$dir = date('Ym').'/'.date('d').'/';
		$args = array(
					'classname' => 'discuz',
					'dir' => 'album/'.$dir,
					'attachment' => 'album/'.$dir.$savefilename,
					'replace' => true,
					'method' => 'ver_file',
            );
		$return = sockpost::post($GLOBALS['HTTP_RAW_POST_DATA'] ,$servers_arr['domain'] ,$servers_arr['api'] ,$savefilename ,'image/jpeg' ,$args ,array() ,false);
		// file_put_contents(DISCUZ_ROOT.'./misc.log' ,"\r\nreturn=".var_export($return ,true) ,FILE_APPEND);
		$attachment = $return['save'] ? $dir.$savefilename : false;
        $title = getstr($_G['gp_filename'], 200, 1, 1);
    	$title = censor($title);
        if(censormod($title) || $_G['group']['allowuploadmod']) {
            $pic_status = 1;
        } else {
            $pic_status = 0;
        }
        if($attachment!==false){
            $thumb = $attachserver->Thumb($servers_arr['domain'] , $servers_arr['api'] , 'album/'.$attachment , '' , 140 , 140 , 1) ? 1 : 0;
            $uploadfiles = array(
                    'albumid' => $albumid,
                    'uid' => $_G['gp_uid'],
                    'username' => $_G['username'],
                    'dateline' => $_G['timestamp'],
                    'filename' => addslashes($_G['gp_filename']),
                    'postip' => $_G['clientip'],
                    'title' => $title,
                    'type' => addslashes(substr($_G['gp_filename'], strripos($_G['gp_filename'], '.')+1)),
                    'size' => $_G['gp_ssize'],
                    'filepath' => $attachment,
                    'thumb' => $thumb,
                    'remote' => 0,
                    'status' => $pic_status,
                    'serverid' => $servers_arr['serverid']
            );
            $uploadfiles['picid'] = DB::insert('home_pic', $uploadfiles, 1);
            
            DB::query("UPDATE ".DB::table('common_member_count')." SET attachsize=attachsize+{$_G[gp_ssize]} WHERE uid='$_G[uid]'");
            
            include_once libfile('function/stat');
            updatestat('pic');
            require_once libfile('class/myredis');
            $redis = & myredis::instance(6382);
            $redis->hashset('THUMB_WAITTING_HASH' ,$swfhash ,json_encode(array('time' => time() ,'target' => 'album/'.$attachment)));
        }
    }
    $uploadResponse = true;
	if($uploadfiles && is_array($uploadfiles)) {
		$status = "success";
		$albumid = $uploadfiles['albumid'];
	} else {
		$status = "failure";
	}
    //$savelog = date('Y-m-d H:i:s', $_G['timestamp'])."\r\n\$_FLIES=".var_export($_FILES, true)."\r\n\$_POST=".var_export($_POST, true)."\r\n\$_GET=".var_export($_GET, true)."\r\n--------$swfhash-----------\r\n";
    //file_put_contents(DISCUZ_ROOT.'./AABBCC.log', $savelog, FILE_APPEND);
} elseif($_FILES && $_POST) {
	if($_FILES["Filedata"]['error']) {
		$uploadfiles = lang('spacecp', 'file_is_too_big');
	} else {
		$_FILES["Filedata"]['name'] = addslashes(diconv(urldecode($_FILES["Filedata"]['name']), 'UTF-8'));
		$_POST['albumid'] = addslashes(diconv(urldecode($_POST['albumid']), 'UTF-8'));
		$catid = $_POST['catid'] ? intval($_POST['catid']) : 0;
		$uploadfiles = pic_save($_FILES["Filedata"], $_POST['albumid'], addslashes(diconv(urldecode($_POST['title']), 'UTF-8')), true, $catid);
	}
	$proid = $_POST['proid'];
	$uploadResponse = true;
	$albumid = 0;
	if($uploadfiles && is_array($uploadfiles)) {
		$status = "success";
		$albumid = $uploadfiles['albumid'];
	} else {
		$status = "failure";
	}
}

$newalbumname = dgmdate($_G['timestamp'], 'Ymd');
if($_G['gp_newflash'] == 1){
	foreach($albums as $k => $v){
		$albums[$k]['albumcover'] = !empty($v['mpic']) ? getimagethumb(50, 50, 2, 'album/'.$v['mpic'], 0, $v['mserverid']) : $_G['config']['web']['forum'] . "static/images/default.jpg";
	}
	$debugmod = $_G['gp_debug']==1 ? 1 : 0;
	include template("home/misc_swfupload_new");
}else{
	include template("home/misc_swfupload");
}
$outxml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$outxml .= diconv(ob_get_contents(), $_G['charset'], 'UTF-8');
obclean();

@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: application/xml; charset=utf-8");
echo $outxml;

?>