<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_home.php 19233 2010-12-23 02:55:53Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function getstr($string, $length, $in_slashes=0, $out_slashes=0, $bbcode=0, $html=0) {
	global $_G;

	$string = trim($string);
	if($in_slashes) {
		$string = dstripslashes($string);
	}
	if($html < 0) {
		$string = preg_replace("/(\<[^\<]*\>|\r|\n|\s|\[.+?\])/is", ' ', $string);
	} elseif ($html == 0) {
		$string = dhtmlspecialchars($string);
	}

	if($length) {
		$string = cutstr($string, $length);
	}

	if($bbcode) {
		require_once DISCUZ_ROOT.'./source/class/class_bbcode.php';
		$bb = & bbcode::instance();
		$string = $bb->bbcode2html($string, $bbcode);
	}
	if($out_slashes) {
		$string = daddslashes($string);
	}
	return trim($string);
}

function obclean() {
	ob_end_clean();
	if (getglobal('config/output/gzip') && function_exists('ob_gzhandler')) {
		ob_start('ob_gzhandler');
	} else {
		ob_start();
	}
}

function dreaddir($dir, $extarr=array()) {
	$dirs = array();
	if($dh = opendir($dir)) {
		while (($file = readdir($dh)) !== false) {
			if(!empty($extarr) && is_array($extarr)) {
				if(in_array(strtolower(fileext($file)), $extarr)) {
					$dirs[] = $file;
				}
			} else if($file != '.' && $file != '..') {
				$dirs[] = $file;
			}
		}
		closedir($dh);
	}
	return $dirs;
}

function url_implode($gets) {
	$arr = array();
	foreach ($gets as $key => $value) {
		if($value) {
			$arr[] = $key.'='.urlencode(dstripslashes($value));
		}
	}
	return implode('&', $arr);
}

function ckstart($start, $perpage) {
	global $_G;

	$_G['setting']['maxpage'] = $_G['setting']['maxpage'] ? $_G['setting']['maxpage'] : 100;
	$maxstart = $perpage*intval($_G['setting']['maxpage']);
	if($start < 0 || ($maxstart > 0 && $start >= $maxstart)) {
		showmessage('length_is_not_within_the_scope_of');
	}
}

function get_my_app() {
	global $_G;

	if($_G['setting']['my_app_status']) {
		$query = DB::query("SELECT * FROM ".DB::table('common_myapp')." WHERE flag='1' ORDER BY displayorder DESC", 'SILENT');
		while ($value = DB::fetch($query)) {
			$_G['my_app'][$value['appid']] = $value;
		}
	}
}

function get_my_userapp() {
	global $_G;

	if($_G['setting']['my_app_status']) {
		$query = DB::query("SELECT * FROM ".DB::table('home_userapp')." WHERE uid='$_G[uid]' ORDER BY displayorder DESC", 'SILENT');
		while ($value = DB::fetch($query)) {
			$_G['my_userapp'][$value['appid']] = $value;
		}
	}
}

function getspace($uid) {
	global $_G;

	$var = "home_space_{$uid}";
	if(!isset($_G[$var])) {
		if($uid == $_G['uid'] && $_G['member']['uid']) {
			$_G[$var] = $_G['member'];
			$_G[$var]['self'] = 1;
		} else {
			$query = DB::query("SELECT * FROM ".DB::table('common_member')." WHERE uid='$uid'");
			$_G[$var] = DB::fetch($query);
		}
	}
	return $_G[$var];
}

function ckprivacy($key, $privace_type) {
	global $_G, $space;

	$var = "home_ckprivacy_{$key}_{$privace_type}";
	if(isset($_G[$var])) {
		return $_G[$var];
	}
	space_merge($space, 'field_home');
	$result = false;
	if($_G['adminid'] == 1) {
		$result = true;
	} else {
		if($privace_type == 'feed') {
			if(!empty($space['privacy'][$privace_type][$key])) {
				$result = true;
			}
		} elseif($space['self']){
			$result = true;
		} else {
			if(empty($space['privacy'][$privace_type][$key])) {
				$result = true;
			} elseif ($space['privacy'][$privace_type][$key] == 1) {
				include_once libfile('function/friend');
				if(followed_by_me($_G['uid'], $space['uid']) == 2) {
					$result = true;
				}
			} elseif ($space['privacy'][$privace_type][$key] == 3) {
				$result = in_array($_G['groupid'], array(4, 5, 6, 7)) ? false : true;
			}
		}
	}
	$_G[$var] = $result;
	return $result;
}

function app_ckprivacy($privacy) {
	global $_G, $space;

	$var = "home_app_ckprivacy_{$privacy}";
	if(isset($_G[$var])) {
		return $_G[$var];
	}
	$result = false;
	switch ($privacy) {
		case 0:
			$result = true;
			break;
		case 1:
			include_once libfile('function/friend');
			if(friend_check($space['uid'])) {
				$result = true;
			}
			break;
		case 2:
			break;
		case 3:
			if($space['self']) {
				$result = true;
			}
			break;
		case 4:
			break;
		case 5:
			break;
		default:
			$result = true;
			break;
	}
	$_G[$var] = $result;
	return $result;
}

function formatsize($size) {
	$prec=3;
	$size = round(abs($size));
	$units = array(0=>" B ", 1=>" KB", 2=>" MB", 3=>" GB", 4=>" TB");
	if ($size==0) return str_repeat(" ", $prec)."0".$units[0];
	$unit = min(4, floor(log($size)/log(2)/10));
	$size = $size * pow(2, -10*$unit);
	$digi = $prec - 1 - floor(log($size)/log(10));
	$size = round($size * pow(10, $digi)) * pow(10, -$digi);
	return $size.$units[$unit];
}

function ckfriend($touid, $friend, $target_ids='') {
	global $_G;

	if(empty($_G['uid'])) return $friend?false:true;
	if($touid == $_G['uid']) return true;

	$var = 'home_ckfriend_'.md5($touid.'_'.$friend.'_'.$target_ids);
	if(isset($_G[$var])) return $_G[$var];

	$_G[$var] = false;
	switch ($friend) {
		case 0:
			$_G[$var] = true;
			break;
		case 1:
			include_once libfile('function/friend');
			if(friend_check($touid)) {
				$_G[$var] = true;
			}
			break;
		case 2:
			if($target_ids) {
				$target_ids = explode(',', $target_ids);
				if(in_array($_G['uid'], $target_ids)) $_G[$var] = true;
			}
			break;
		case 3:
			break;
		case 4:
			$_G[$var] = true;
			break;
		default:
			break;
	}
	return $_G[$var];
}

//隐私设置由"0"为全站用户可见,"1"为全好友可见,"2"为仅指定的好友可见,"3"为仅自己可见,"4"为凭密码查看 改为"0"为全站用户可见, "3"为仅自己可见，其它的都当做3处理，因此把ckfriend换为ckperm
function ckperm($value = array()) {
	global $_G, $space;
	if ($value) {
		return $_G['adminid'] == 1 || $space['self'] || ($value['status'] == 0 && !$space['self'] && $value['friend'] == 0) || $value['uid'] == $_G['uid'] ? true : false;
	} else {
		return $_G['adminid'] == 1 || $space['self'] ? true : false;
	}
//	ckfriend($value['uid'], $value['friend'], $value['target_ids']) && ($value['status'] == 0 || $value['uid'] == $_G['uid'] || $_G['adminid'] == 1)
}

function sub_url($url, $length) {
	if(strlen($url) > $length) {
		$url = str_replace(array('%3A', '%2F'), array(':', '/'), rawurlencode($url));
		$url = substr($url, 0, intval($length * 0.5)).' ... '.substr($url, - intval($length * 0.3));
	}
	return $url;
}

function space_domain($space) {
	global $_G;

	if($_G['setting']['allowspacedomain'] && $_G['setting']['domain']['root']['home']) {
		space_merge($space, 'field_home');
		if($space['domain']) {
			$space['domainurl'] = 'http://'.$space['domain'].'.'.$_G['setting']['domain']['root']['home'];
		}
	}
	if(!empty($_G['setting']['domain']['app']['home'])) {
		$space['domainurl'] = 'http://'.$_G['setting']['domain']['app']['home'].'/?'.$space['uid'];
	} elseif(empty($space['domainurl'])) {
		$space['domainurl'] = $_G['siteurl'].'?'.$space['uid'];
	}
	return $space['domainurl'];
}

function my_checkupdate() {
	global $_G;
	if($_G['setting']['my_app_status'] && empty($_G['setting']['my_closecheckupdate']) && $_G['group']['radminid'] == 1) {
		$sid = $_G['setting']['my_siteid'];
		$ts = $_G['timestamp'];
		$key = md5($sid.$ts.$_G['setting']['my_sitekey']);
		echo '<script type="text/javascript" src="http://notice.uchome.manyou.com/notice?sId='.$sid.'&ts='.$ts.'&key='.$key.'" charset="UTF-8"></script>';
	}
}

function g_name($groupid) {
	global $_G;
	echo $_G['cache']['usergroups'][$groupid]['grouptitle'];
}

function g_color($groupid) {
	global $_G;
	if(empty($_G['cache']['usergroups'][$groupid]['color'])) {
		echo '';
	} else {
		echo ' style="color:'.$_G['cache']['usergroups'][$groupid]['color'].';"';
	}
}

function mob_perpage($perpage) {
	global $_G;

	$newperpage = isset($_GET['perpage'])?intval($_GET['perpage']):0;
	if($_G['mobile'] && $newperpage>0 && $newperpage<500) {
		$perpage = $newperpage;
	}
	return $perpage;
}

function ckicon_uid($feed) {
	global $_G, $space;

	space_merge($space, 'field_home');
	$filter_icon = empty($space['privacy']['filter_icon'])?array():array_keys($space['privacy']['filter_icon']);
	if($filter_icon && (in_array($feed['icon'].'|0', $filter_icon) || in_array($feed['icon'].'|'.$feed['uid'], $filter_icon))) {
		return false;
	}
	return true;
}

function sarray_rand($arr, $num=1) {
	$r_values = array();
	if($arr && count($arr) > $num) {
		if($num > 1) {
			$r_keys = array_rand($arr, $num);
			foreach ($r_keys as $key) {
				$r_values[$key] = $arr[$key];
			}
		} else {
			$r_key = array_rand($arr, 1);
			$r_values[$r_key] = $arr[$r_key];
		}
	} else {
		$r_values = $arr;
	}
	return $r_values;
}

function my_showgift() {
	global $_G, $space;
	if($_G['setting']['my_showgift'] && $_G['my_userapp'][$_G['home_gift_appid']]) {
		echo '<script language="javascript" type="text/javascript" src="http://gift.manyou-apps.com/recommend.js"></script>';
	}
}

function getsiteurl() {
	global $_G;
	return $_G['siteurl'];
}
/*查看原图功能：增加是否为附件服务器的判定,增加参数serverid*/
function pic_get($filepath, $type, $thumb, $remote, $return_thumb=1, $serverid=0, $nowater = false) {
	global $_G;

	$url = $filepath;
	if($return_thumb && $thumb) $url .= '.thumb.jpg';
	if($remote > 1 && $type == 'album') {
		$remote -= 2;
		$type = 'forum';
	}
	$urls=($remote?$_G['setting']['ftp']['attachurl']:$_G['setting']['attachurl']).$type.'/'.$url;
	if($serverid>0){
        if(file_exists(DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php")){
            require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
            $attach_server = new attachserver;
            $domain = $attach_server->get_server_domain($serverid, '*');
            if(is_array($domain['domain'])){
            	if($return_thumb){
            		$thumbstring = getUpYun( true, 140, 140, 1, 0, 1, true, $domain['cdnname'] );
            	}else{
            		if($type == 'portal'){
            			$thumbstring = getUpYun( false, 0, 0, 1, ! $nowater ? 9 : 0, 2, true, $domain['cdnname'] );
            		}else{
            			$thumbstring = $attach_server->getshowString( $type, true, ! $nowater, true, $domain['cdnname'] );
            		}
            	}
            	$urls = "http://{$domain['name']}/{$type}/" . ($type == 'album' ? $filepath : $url) . $thumbstring;
            }else{
	            $serverurl = "http://".$attach_server->get_server_domain($serverid)."/".$attach['attachment'];
	            $urls=$serverurl.$type."/".$url;
            }
        }
    }
	return $urls;
}

function pic_cover_get($pic, $picflag, $domain='') {
	global $_G;

	$type = 'album';
	if($picflag > 2) {
		$picflag = $picflag - 2;
		//$type = 'forum';
	}
	if(!empty($domain)){
		if(is_array($domain)){
			$domain = $domain['name'];
		}
		return "http://".$domain."/".$type."/".$pic;
	}
	if($picflag == 1) {
		$url = $_G['setting']['attachurl'].$type.'/'.$pic;
	} elseif ($picflag == 2) {
		$url = $_G['setting']['ftp']['attachurl'].$type.'/'.$pic;
	} else {
		$url = $pic;
	}
	return $url;
}

function pic_delete($pic, $type, $thumb, $remote, $domain='', $api='', $serverid=0) {
	global $_G;

	if($remote > 1 && $type == 'album') {
		$remote -= 2;
		$type = 'forum';
	}
if(!empty($domain) && !empty($api)){
/*增加判定附件服务器的删除*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
//$attachserver->post_method($domain,$api,"del_pic&pic_name=$type/".$pic."&havethumb=".$thumb);
$attachserver->delete($domain , $api , $type.'/'.$pic , $thumb);
/*结束*/
}//else{
	if($remote) {
		ftpcmd('delete', $type.'/'.$pic);
		if($thumb) {
			ftpcmd('delete', $type.'/'.$pic.'.thumb.jpg');
		}
		ftpcmd('close');
	} else {
		@unlink($_G['setting']['attachdir'].'/'.$type.'/'.$pic);
		if($thumb) {
			@unlink($_G['setting']['attachdir'].'/'.$type.'/'.$pic.'.thumb.jpg');
		}
	}
//}
}

function pic_upload($FILES, $type='album', $thumb_width=0, $thumb_height=0, $thumb_type=2, $watermark = true) {
	require_once libfile('class/upload');
	$upload = new discuz_upload();
	$result = array('pic'=>'', 'thumb'=>0, 'remote'=>0,'serverid'=>0);

	$upload->init($FILES, $type);
	if($upload->error()) {
		return array();
	}

	$upload->save(0, true, true, $watermark);
	if($upload->error()) {
		return array();
	}

	$result['pic'] = $upload->attach['attachment'];
	$result['serverid'] = $upload->attach['serverid'];

    /*引入附件*/
    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
    $attachserver = new attachserver;
    $serverinfo = $attachserver->get_server_domain($result['serverid'],'*');
    /*结束*/

	if($thumb_width && $thumb_height) {
        if($result['serverid']>0){
            if($attachserver->Thumb($serverinfo['domain'] , $serverinfo['api'] , $upload->attach['target'] , '' , $thumb_width , $thumb_height , $thumb_type)) $result['thumb']=1;
            //$attachserver->post_method($serverinfo['domain'],$serverinfo['api'],"pic_thumb&pic_attachment=".$upload->attach['target']."&pic_name=&width=$thumb_width&height=$thumb_height&thumbtype=$thumb_type");
            //if($return[1]=='ok' && $return[2]=='thumb_ok') $result['thumb']=1;
		}else{
    		require_once libfile('class/image');
    		$image = new image();
    		if($image->Thumb($upload->attach['target'], '', $thumb_width, $thumb_height, $thumb_type)) {
    			$result['thumb'] = 1;
    		}
		}
	}

	if(getglobal('setting/ftp/on')) {
		if(ftpcmd('upload', $type.'/'.$upload->attach['attachment'])) {
			if($result['thumb']) {
				ftpcmd('upload', $type.'/'.$upload->attach['attachment'].'.thumb.jpg');
			}
			ftpcmd('close');
			$result['remote'] = 1;
		} else {
			if(getglobal('setting/ftp/mirror')) {
				@unlink($upload->attach['target']);
				@unlink($upload->attach['target'].'.thumb.jpg');
				return array();
			}
		}
	}

	return $result;
}

function member_count_update($uid, $counts) {
	global $_G;

	$setsqls = array();
	foreach ($counts as $key => $value) {
		if($key == 'credit') {
			if($_G['setting']['creditstransextra'][6]) {
				$key = 'extcredits'.intval($_G['setting']['creditstransextra'][6]);
			} elseif ($_G['setting']['creditstrans']) {
				$key = 'extcredits'.intval($_G['setting']['creditstrans']);
			} else {
				continue;
			}
		}
		$setsqls[$key] = $value;
	}
	if($setsqls) {
		updatemembercount($uid, $setsqls);
	}
}


function member_status_update($uid, $counts) {
	global $_G;

	$setsqls = array();
	$newprompt = 0;
	foreach ($counts as $key => $value) {
		$setsqls[] = "{$key}={$key}+'{$value}'";
		if(in_array($key, array('notifications','pokes','myinvitations','pendingfriends', 'newinvite'))) {
			$newprompt = $newprompt + $value;
		}
	}
	if($setsqls) {
		$setsqls[] = "lastactivity='{$_G[timestamp]}'";
		DB::query("UPDATE ".DB::table('common_member_status')." SET ".implode(',', $setsqls)." WHERE uid='$uid'");
	}
	if($newprompt) {
		DB::query("UPDATE ".DB::table('common_member')." SET newprompt=newprompt+'$newprompt' WHERE uid='$uid'");
	}
}

//设置最新浏览通知、邀请、短消息、任务的时间
function member_status_view_update($taskcount) {
	global $_G;
	//dsetcookie('member_view_latest_' . $_G['uid'], $_G["member"]["notifications"] . "\t" . $_G["member"]["newinvite"]  . "\t" . $_G["member"]["newpm"] . "\t" . $taskcount, 86400*30*12);
}

/**
 * 校准用户通知数量
 * 目前只有邀请通知数据转移到新通知数据表中
 * mtype消息类型 (邀请=1)
 * 备注：
 * common_member_status表 (newpm:新站内短消息;newprompt:消息总数,不包含站短;newnotice:未知)
 * common_member表 (notifications:通知数;newinvite:新邀请数)
 **/

function fix_member_notice($uid) {
	if(!intval($uid)) return;

	$notification_num = DB::result_first('SELECT COUNT(*) FROM ' .DB::table('home_notification') . " WHERE uid='$uid' AND new=1 " . getSlaveID());
	$poke_num = DB::result_first('SELECT COUNT(*) FROM ' .DB::table('home_poke') . " WHERE uid='$uid' AND new=1 " . getSlaveID());
	$notice_table = 'home_notice_'.substr($uid, -1);
	$invite_num = DB::result_first('SELECT COUNT(*) FROM ' .DB::table($notice_table) . " WHERE uid='$uid' AND mtype=1 AND new=1 ");

	$newprompt = $notification_num + $poke_num + $invite_num;
	DB::query('UPDATE ' . DB::table('common_member') . " SET newprompt='$newprompt' WHERE uid='$uid'");
	DB::query('UPDATE ' . DB::table('common_member_status') ." SET notifications='$notification_num',newinvite='$invite_num',pokes='$poke_num' WHERE uid='$uid'");

	// require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
	// $logs = new logs('fix_member_notice');
	// $logs->log_str("uid:{$uid}, newprompt:{$newprompt}, notification:{$notification_num}, poke:{$poke_num}, invite:{$invite_num}");
}
?>
