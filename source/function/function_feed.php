<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_feed.php 13398 2010-07-27 01:48:11Z wangjinbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function feed_add($icon, $title_template='', $title_data=array(), $body_template='', $body_data=array(), $body_general='', $images=array(), $image_links=array(), $target_ids='', $friend='', $appid='', $returnid=0, $id=0, $idtype='', $uid=0, $username='') {
	global $_G;

	$title_template = $title_template?lang('feed', $title_template):'';
	$body_template = $body_template?lang('feed', $body_template):'';
	$body_general = $body_general?lang('feed', $body_general):'';
	if(empty($uid) || empty($username)) {
		$uid = $username = '';
	}

	$feedarr = array(
		'appid' => $appid,
		'icon' => $icon,
		'uid' => $uid ? intval($uid) : $_G['uid'],
		'username' => $username ? $username : $_G['username'],
		'dateline' => $_G['timestamp'],
		'title_template' => $title_template,
		'body_template' => $body_template,
		'body_general' => $body_general,
		'image_1' => empty($images[0])?'':$images[0],
		'image_1_link' => empty($image_links[0])?'':$image_links[0],
		'image_2' => empty($images[1])?'':$images[1],
		'image_2_link' => empty($image_links[1])?'':$image_links[1],
		'image_3' => empty($images[2])?'':$images[2],
		'image_3_link' => empty($image_links[2])?'':$image_links[2],
		'image_4' => empty($images[3])?'':$images[3],
		'image_4_link' => empty($image_links[3])?'':$image_links[3],
		'target_ids' => $target_ids,
		'friend' => $friend,
		'id' => $id,
		'idtype' => $idtype
	);

	$feedarr = dstripslashes($feedarr);
	$feedarr['title_data'] = serialize(dstripslashes($title_data));
	$feedarr['body_data'] = serialize(dstripslashes($body_data));
	$feedarr['hash_data'] = empty($title_data['hash_data'])?'':$title_data['hash_data'];
	$feedarr = daddslashes($feedarr);

	if(is_numeric($icon)) {
		$feed_table = 'home_feed_app';
		unset($feedarr['id'], $feedarr['idtype']);
	} else {
		if($feedarr['hash_data']) {
			$query = DB::query("SELECT feedid FROM ".DB::table('home_feed')." WHERE uid='$feedarr[uid]' AND hash_data='$feedarr[hash_data]' LIMIT 0,1");
			if($oldfeed = DB::fetch($query)) {
				return 0;
			}
		}
		$feed_table = 'home_feed';
	}

	if($returnid) {
		return DB::insert($feed_table, $feedarr, $returnid);
	} else {
		DB::insert($feed_table, $feedarr);
		return 1;
	}
}

//新的动态
function feed_add_ucenter($feedarr) {
	global $_G;

	//允许浏览的板块
	$allowviewuserthread = $_G['setting']['allowviewuserthread'];
	$allowviewuserthread = trim($allowviewuserthread, "'");
	$allowviewuserthread = explode("','", $allowviewuserthread);
	$allowviewuserthread = array_flip($allowviewuserthread);
	
	if (!isset($allowviewuserthread[$feedarr['fid']])) { return false;}
	
	$feedarr = dstripslashes($feedarr);
	
	//对message的处理
	if ($feedarr['type'] < 2) {
//		showmessage('8264com');
		require_once libfile('function/space');
		$feedarr['message'] = space_viewthread_procpost($feedarr);
		$feedarr['message']['subject'] = $feedarr['title'];		
		$feedarr['message'] = serialize(dstripslashes($feedarr['message']));
		
		unset($feedarr['authorid'], $feedarr['htmlon'], $feedarr['bbcodeoff'], $feedarr['smileyoff'], $feedarr['title']);	
	} elseif ($feedarr['type'] == 6 || $feedarr['type'] == 7) {
		$feedarr['message'] = array();
		
		$activityShow = DB::fetch_first("select * from ".DB::table('forum_activity')." WHERE tid={$feedarr['id']}");
		if(!empty($activityShow)) {
			$feedarr['message']['starttimeto']   = $activityShow['starttimeto'];
			$feedarr['message']['starttimefrom'] = $activityShow['starttimefrom'];
			$feedarr['message']['place'] 		 = $activityShow['place'];
			$feedarr['message']['expiration'] 	 = $activityShow['expiration'];
		}		
		$feedarr['message']['subject'] = $feedarr['title'];
		$feedarr['message'] = serialize(dstripslashes($feedarr['message']));
		unset($feedarr['authorid'], $feedarr['htmlon'], $feedarr['bbcodeoff'], $feedarr['smileyoff'], $feedarr['title']);
	}

	$feedarr = daddslashes($feedarr);
	DB::insert('home_feed_ucenter', $feedarr);
	
	if ($feedarr['type'] == 1) {
		$memKey    = "cache_ucenter_thread_list_{$feedarr['uid']}_1";	
		memory('rm', $memKey);
	}	
	
	_feeddeal($feedarr['uid']);
}

function mkfeed($feed, $actors=array()) {
	global $_G;

	$feed['title_data'] = empty($feed['title_data'])?array():(is_array($feed['title_data'])?$feed['title_data']:@unserialize($feed['title_data']));
	if(!is_array($feed['title_data'])) $feed['title_data'] = array();
	$feed['body_data'] = empty($feed['body_data'])?array():(is_array($feed['body_data'])?$feed['body_data']:@unserialize($feed['body_data']));
	if(!is_array($feed['body_data'])) $feed['body_data'] = array();

	$searchs = $replaces = array();
	if($feed['title_data']) {
		foreach (array_keys($feed['title_data']) as $key) {
			$searchs[] = '{'.$key.'}';
			$replaces[] = $feed['title_data'][$key];
		}
	}

	$searchs[] = '{actor}';
	$replaces[] = empty($actors)?"<a href=\"home.php?mod=space&uid=$feed[uid]\" target=\"_blank\">$feed[username]</a>":implode(lang('core', 'dot'), $actors);
	$feed['title_template'] = str_replace($searchs, $replaces, $feed['title_template']);
	$feed['title_template'] = feed_mktarget($feed['title_template']);

	$searchs = $replaces = array();
	$searchs[] = '{actor}';
	$replaces[] = empty($actors)?"<a href=\"home.php?mod=space&uid=$feed[uid]\" target=\"_blank\">$feed[username]</a>":implode(lang('core', 'dot'), $actors);
	if($feed['body_data'] && is_array($feed['body_data'])) {
		foreach (array_keys($feed['body_data']) as $key) {
			$searchs[] = '{'.$key.'}';
			$replaces[] = $feed['body_data'][$key];
		}
	}

	$feed['magic_class'] = '';
	if(!empty($feed['body_data']['magic_thunder'])) {
		$feed['magic_class'] = 'magicthunder';
	}

	$feed['body_template'] = str_replace($searchs, $replaces, $feed['body_template']);
	$feed['body_template'] = feed_mktarget($feed['body_template']);

	$feed['body_general'] = feed_mktarget($feed['body_general']);

	if(is_numeric($feed['icon'])) {
		$feed['icon_image'] = "http://appicon.manyou.com/icons/{$feed['icon']}";
	} else {
		$feed['icon_image'] = "http://static.8264.com/static/image/feed/{$feed['icon']}.gif";
	}

	$feed['new'] = 0;
	if($_G['cookie']['home_readfeed'] && $feed['dateline']+300 > $_G['cookie']['home_readfeed']) {
		$feed['new'] = 1;
	}

	return $feed;
}

function feed_mktarget($html) {
	global $_G;

	if($html && $_G['setting']['feedtargetblank']) {
		$html = preg_replace("/target\=([\'\"]?)[\w]+([\'\"]?)/i", '', $html);
		$html = preg_replace("/<a(.+?)href=([\'\"]?)([^>\s]+)\\2([^>]*)>/i", '<a href="\\3" target="_blank" \\1 \\4>', $html);
	}
	return $html;
}

function feed_publish($id, $idtype, $add=0) {
	global $_G;

	$setarr = array();
	switch ($idtype) {
		case 'blogid':
			$blog_sql = 'SELECT uid,username,subject FROM ' . DB::table('home_blog') . " WHERE blogid={$id} LIMIT 1 " . getSlaveID();
			$blog = DB::fetch_first($blog_sql);
			if(! $blog || $blog['friend']) return; 
			$feedarr = & $blog;
			$feedarr['type'] 	 = 4;
			$feedarr['id']   	 = $id;
			$feedarr['dateline'] = $_G['timestamp'];
			$feedarr['message']['title'] = $feedarr['subject'];
			$feedarr['subject']  = '发表了新日志';
			$field_sql 	   = 'SELECT message,pic FROM ' . DB::table('home_blogfield') . " WHERE blogid={$id} LIMIT 1 " . getSlaveID() ;
			$blogfieldShow = DB::fetch_first($field_sql);
			$blog_message  = preg_replace("/&[a-z]+\;/i", '', $blogfieldShow['message']);
			$feedarr['message']['content'] = getstr($blog_message, 150, 1, 1, 0, -1);
			$feedarr['message']['pic'] 	   = !empty($blogfieldShow['pic']) ? 1 : 0;
			$feedarr['message'] = serialize(dstripslashes($feedarr['message']));
			$feedarr = daddslashes($feedarr);
			DB::insert('home_feed_ucenter', $feedarr);
			_feeddeal($feedarr['uid']);
			return;
			break;
		case 'albumid':
			if($id > 0) {
				$album_sql = 'SELECT uid,username,albumname,picnum,friend FROM ' . DB::table('home_album') . " WHERE albumid='{$id}' LIMIT 1 " . getSlaveID();
				$album = DB::fetch_first($album_sql);
				//相册隐私设置:"0"全站用户可见,"1"为全好友可见,"2"为仅指定的好友可见,"3"为仅自己可见,"4"为凭密码查看, 0才进行相应处理
				if($album['friend']) return;
				$feedarr = array();
				$feedarr['subject']  = '更新了相册';
				$feedarr['uid'] 	 = $album['uid'];
				$feedarr['type'] 	 = 5;
				$feedarr['username'] = $album['username'];
				$feedarr['dateline'] = $_G['timestamp'];
				$feedarr['id']       = $id;
				$feedarr['message']['albumname'] = $album['albumname'];
				$feedarr['message']['pic_count'] = $album['picnum'];
				$pic_sql = 'SELECT filepath,thumb,remote,serverid,dateline,picid FROM ' . DB::table('home_pic') ." WHERE albumid='{$id}' ORDER BY dateline DESC LIMIT 3 " . getSlaveID();
				$query   = DB::query($pic_sql);
				while($value = DB::fetch($query)) {					
					$feedarr['message']['picture'][$value['picid']] =  $value['serverid'] > 50 ? getimagethumb(180, 120, 2, 'album/'.$value['filepath'], 0, $value['serverid']) : getimagethumb(100, 67, 2, 'album/'.$value['filepath'], 0, $value['serverid']);
				}
				$feedarr['message'] = serialize(dstripslashes($feedarr['message']));
				$feedarr = daddslashes($feedarr);
				DB::insert('home_feed_ucenter', $feedarr);
				_feeddeal($feedarr['uid']);
				return;
			}
			break;
		case 'picid':
			$plussql = $id>0?"p.picid='$id'":"p.uid='$_G[uid]' ORDER BY dateline DESC LIMIT 1";
			$query = DB::query("SELECT p.*, a.friend, a.target_ids FROM ".DB::table('home_pic')." p
				LEFT JOIN ".DB::table('home_album')." a ON a.albumid=p.albumid WHERE $plussql");
			if($value = DB::fetch($query)) {
				if(empty($value['friend'])) {
					$setarr['icon'] = 'album';
					$setarr['id'] = $value['picid'];
					$setarr['idtype'] = $idtype;
					$setarr['uid'] = $value['uid'];
					$setarr['username'] = $value['username'];
					$setarr['dateline'] = $value['dateline'];
					$setarr['target_ids'] = $value['target_ids'];
					$setarr['friend'] = $value['friend'];
					$setarr['hot'] = $value['hot'];
					$status = $value['status'];
					$url = "home.php?mod=space&uid=$value[uid]&do=album&picid=$value[picid]";
					$setarr['image_1'] = pic_get($value['filepath'], 'album', $value['thumb'], $value['remote'],1,$value['serverid']);
					$setarr['image_1_link'] = $url;
					$setarr['title_template'] = 'feed_pic_title';
					$setarr['body_template'] = 'feed_pic_body';
					$setarr['body_data'] = array('title' => $value['title']);
				}
			}
			break;
	}
	if($setarr['icon']) {
		$setarr['title_template'] = $setarr['title_template']?lang('feed', $setarr['title_template']):'';
		$setarr['body_template'] = $setarr['body_template']?lang('feed', $setarr['body_template']):'';
		$setarr['body_general'] = $setarr['body_general']?lang('feed', $setarr['body_general']):'';

		$setarr['title_data']['hash_data'] = "{$idtype}{$id}";
		$setarr['title_data'] = serialize($setarr['title_data']);
		$setarr['body_data'] = serialize($setarr['body_data']);
		$setarr = daddslashes($setarr);

		$feedid = 0;
		if(!$add && $setarr['id']) {
			$query = DB::query("SELECT feedid FROM ".DB::table('home_feed')." WHERE id='$id' AND idtype='$idtype'");
			$feedid = DB::result($query, 0);
		}
		if($status == 0) {
			if($feedid) {
				DB::update('home_feed', $setarr, array('feedid'=>$feedid));
			} else {
				DB::insert('home_feed', $setarr);
			}
		}
	}
}

//大于50条的动态清除及feedtime字段的更新
function _feeddeal($uid) {		
	global $_G;
	
	$dateline = DB::result_first("select dateline from ".DB::table('home_feed_ucenter')." WHERE uid={$uid} order by dateline desc limit 50,1");
	if ($dateline) {
		DB::query("DELETE FROM ".DB::table('home_feed_ucenter')." WHERE uid={$uid} and dateline < '{$dateline}'");	
	}
		
	for ($i=0;$i<10;$i++) {
		DB::update("home_follow_{$i}", array('feedtime'=>$_G['timestamp']), "fwuid={$uid}");
	}			
}

//删除动态
function deletefeed($ids = '', $type = '', $pids =  '') {
	$pid    = intval($pid);
	if ($type == 'thread') {
		$type = '1,3,6,7';
	} elseif ($type == 'dianping') {	
		$type = '3';	
	} elseif ($type == 'blog') {	
		$type = '4';
	} elseif ($type == 'album') {
		$type = '5';
	} else {
		$type = '';
	}
	
	if ($pids) {
		$sql  = "DELETE FROM ".DB::table('home_feed_ucenter')." WHERE pid in ({$pids}) ";
		DB::query($sql);
	}	
	
	if ($ids && $type) {
		$sql  = "DELETE FROM ".DB::table('home_feed_ucenter')." WHERE  ";
		$sql .= strrpos($ids, 'id') === false ? " id in ({$ids}) " : $ids;
		$sql .= $type ? " and type in ({$type}) " : '';
		DB::query($sql);
	}
}

?>