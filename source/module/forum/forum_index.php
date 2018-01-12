<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_index.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
$oldindex = $_G['newtpl'] ? false : true;
$newindex = ($_GET['2014new'] == 1 || $_GET['new'] == 1 || ! $oldindex) && $_GET['old'] != 1 ? true : false;
$vban = $newindex ? 'newindex' : 'oldindex';
if($newindex){$_G['newtpl'] = 1;}
//note 在线列表命令
$gid = intval(getgpc('gid'));
$showoldetails = get_index_online_details();

//noteX 增加手机版禁用首页缓存(IN_MOBILE)
if(!$_G['uid'] && !$gid && $_G['setting']['cacheindexlife'] && !$_G['gp_archiver'] && !defined('IN_MOBILE')) {
	get_index_page_guest_cache($newindex);
}

//note 新帖时间
$newthreads = round((TIMESTAMP - $_G['member']['lastvisit'] + 600) / 1000) * 1000;
$rsshead = $_G['setting']['rssstatus'] ? ('<link rel="alternate" type="application/rss+xml" title="'.$_G['setting']['bbname'].'" href="'.$_G['siteurl'].'forum.php?mod=rss&auth='.$_G['rssauth']."\" />\n") : '';

//note 初始化变量
$catlist = $forumlist = $sublist = $forumname = $collapseimg = $collapse = array();
$threads = $posts = $todayposts = $fids = $announcepm = 0;
$postdata = $_G['cache']['historyposts'] ? explode("\t", $_G['cache']['historyposts']) : array(0,0);
$postdata[0] = intval($postdata[0]);
$postdata[1] = intval($postdata[1]);

//note SEO
$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['forum']);
if(!$navtitle) {
	$navtitle = $_G['setting']['navs'][2]['navname'];
} else {
	$nobbname = true;
}
$metadescription = $_G['setting']['seodescription']['forum'];
if(!$metadescription) {
	$metadescription = $navtitle;
}
$metakeywords = $_G['setting']['seokeywords']['forum'];
if(!$metakeywords) {
	$metakeywords = $navtitle;
}

//TODO 这里的首页热点没有判断，数据默认总是要更新的，等待新版界面出来要加上判断
if($_G['setting']['indexhot']['status'] && $_G['cache']['heats']['expiration'] < TIMESTAMP) {
	require_once libfile('function/cache');
	updatecache('heats');
}
//noteX 手机收藏夹(IN_MOBILE)
if(defined('IN_MOBILE')) {
	@include DISCUZ_ROOT.'./source/module/forum/forum_index_mobile.php';
}
//*如果是新版需要去查几个频道的更新数量*//
if($newindex){
	$portallist_array = memory('get', 'portal_list_discuz_index_count_array');
	if(!$portallist_array || empty($portallist_array)){
		$q = DB::query("SELECT p.catid, p.articles FROM " . DB::table('portal_category') . " p WHERE p.catid IN(842,881,880,871,878)");
		while($v = DB::fetch($q)){
			$portallist_array[$v['catid']] = $v['articles'];
		}
		!empty($portallist_array) && memory('set', 'portal_list_discuz_index_count_array', $portallist_array, 300);
	}
	$newlistcount = array();
	foreach($portallist_array as $_k => $_v){
		$cookiecount = intval(getcookie('8264portallistcount_' . $_k));
		if($cookiecount <= 0){
			$cookiecount = 0;
			dsetcookie('8264portallistcount_' . $_k, $cookiecount, 3600 * 24 * 60);
		}
		$newlistcount[$_k] = $_v - $cookiecount;
	}
}
if(empty($gid) && empty($_G['member']['accessmasks']) && empty($showoldetails)) {
	extract(get_index_memory_by_groupid($_G['member']['groupid'], $vban));
	if(defined('FORUM_INDEX_PAGE_MEMORY') && FORUM_INDEX_PAGE_MEMORY) {
		categorycollapse();
		if($_G['gp_archiver']) {
			include loadarchiver('forum/discuz_8264_new');
		} else {
			$newindex ? include template('diy:forum/discuz_8264_new') : include template('diy:forum/discuz');
		}
		dexit();
	}
}

if(!$gid && (!defined('FORUM_INDEX_PAGE_MEMORY') || !FORUM_INDEX_PAGE_MEMORY)) {
	//note 公告
	$announcements = get_index_announcements();
	$_sql_fup = $newindex ? 'f.fup as ofup, f.nfup as fup' : 'f.fup';  // 恢复老版fup lxp 20140410
	$_sql_displayorder = $newindex ? 'f.ndisplayorder' : 'f.displayorder';
	//note 访问限制
	$sql = !empty($_G['member']['accessmasks']) ?
		"SELECT f.fid, {$_sql_fup}, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.inheritedmod, f.domain,
			f.forumcolumns, f.simple, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.redirect, ff.extra, a.allowview
			FROM ".DB::table('forum_forum')." f
			LEFT JOIN ".DB::table('forum_forumfield')." ff ON ff.fid=f.fid
			LEFT JOIN ".DB::table('forum_access')." a ON a.uid='$_G[uid]' AND a.fid=f.fid
			WHERE f.status='1' ORDER BY f.type, " . $_sql_displayorder
		: "SELECT f.fid, {$_sql_fup}, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.inheritedmod, f.domain,
			f.forumcolumns, f.simple, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.redirect, ff.extra
			FROM ".DB::table('forum_forum')." f
			LEFT JOIN ".DB::table('forum_forumfield')." ff USING(fid)
			WHERE f.status='1' ORDER BY f.type, " . $_sql_displayorder;

	$query = DB::query($sql);

	while($forum = DB::fetch($query)) {
		if($newindex){
			$forum['name'] = str_replace(array('『', '』', '□-A', '□-B', '□-C', '□-D', '□-E', '□-F', '□-G', '□-H', '□-I', '□-J', '□-K', '□-L', '□-M', '□-N', '□-O', '□-P', '□-Q', '□-R', '□-S', '□-T', '□-U', '□-V', '□-W', '□-X', '□-Y', '□-Z'), '', $forum['name']);
		}else{
			if($forum['fid'] == 191) $forum['forumcolumns'] = 4;
			if(in_array($forum['fid'], array(38, 67, 180))) $forum['forumcolumns'] = 0;
		}
		
		$forumname[$forum['fid']] = strip_tags($forum['name']);
		$forum['extra'] = unserialize($forum['extra']);
		if(!is_array($forum['extra'])) {
			$forum['extra'] = array();
		}
		if($forum['type'] != 'group') {

			$threads += $forum['threads'];
			$posts += $forum['posts'];
			$todayposts += $forum['todayposts'];

			if($forum['type'] == 'forum' && isset($catlist[$forum['fup']])) {
				if(forum($forum)) {
					$catlist[$forum['fup']]['forums'][] = $forum['fid'];
					$forum['orderid'] = $catlist[$forum['fup']]['forumscount']++;
					$forum['subforums'] = '';
					$forumlist[$forum['fid']] = $forum;
				}
			} elseif($forum['type'] == 'sub'){
				// 恢复老版fup lxp 20140410
				$ffid = $newindex ? $forum['ofup'] : $forum['fup'];
				if(isset($forumlist[$ffid])){
					$forumlist[$ffid]['threads'] += $forum['threads'];
					$forumlist[$ffid]['posts'] += $forum['posts'];
					$forumlist[$ffid]['todayposts'] += $forum['todayposts'];
					if($_G['setting']['subforumsindex'] && $forumlist[$ffid]['permission'] == 2 && !($forumlist[$ffid]['simple'] & 16) || ($forumlist[$ffid]['simple'] & 8)) {
						$forumlist[$ffid]['subforums'] .= (empty($forumlist[$ffid]['subforums']) ? '' : ', ').'<a href="forum.php?mod=forumdisplay&fid='.$forum['fid'].'" '.(!empty($forum['extra']['namecolor']) ? ' style="color: ' . $forum['extra']['namecolor'].';"' : '') . '>'.$forum['name'].'</a>';
					}
				}
			}

		} else {

			if($forum['moderators']) {
			 	$forum['moderators'] = moddisplay($forum['moderators'], 'flat');
			}
			$forum['forumscount'] 	= 0;
			$catlist[$forum['fid']] = $forum;

		}
	}
	//echo '<pre>' . var_export($catlist, true);
	foreach($catlist as $catid => $category) {
		$catlist[$catid]['collapseimg'] = 'collapsed_no.gif';
		if($catlist[$catid]['forumscount'] && $category['forumcolumns']) {
			$catlist[$catid]['forumcolwidth'] = (floor(100 / $category['forumcolumns']) - 0.1).'%';
			$catlist[$catid]['endrows'] = '';			
			if($colspan = $category['forumscount'] % $category['forumcolumns']) {
				while(($category['forumcolumns'] - $colspan) > 0) {
					$catlist[$catid]['endrows'] .= '<td>&nbsp;</td>';
					$colspan ++;
				}
				$catlist[$catid]['endrows'] .= '</tr>';
			}			
		} elseif(empty($category['forumscount'])) {
			unset($catlist[$catid]);
		}
	}
	//echo '<pre>' . var_export($catlist, true);exit;
	unset($catid, $category);

	if(isset($catlist[0]) && $catlist[0]['forumscount']) {
		$catlist[0]['fid'] = 0;
		$catlist[0]['type'] = 'group';
		$catlist[0]['name'] = $_G['setting']['bbname'];
		$catlist[0]['collapseimg'] = 'collapsed_no.gif';
	} else {
		unset($catlist[0]);
	}

	//note 显示在线列表
	if(!IS_ROBOT && ($_G['setting']['whosonlinestatus'] == 1 || $_G['setting']['whosonlinestatus'] == 3)) {
		$_G['setting']['whosonlinestatus'] = 1;

		//note 历史在线人数
		$onlineinfo = explode("\t", $_G['cache']['onlinerecord']);
 		//note 当前在线总数
		if(empty($_G['cookie']['onlineusernum'])) {
			$onlinenum = DB::result_first("SELECT count(*) FROM ".DB::table('common_session'));
			if($onlinenum > $onlineinfo[0]) {
				$onlinerecord = "$onlinenum\t".TIMESTAMP;
				DB::query("UPDATE ".DB::table('common_setting')." SET svalue='$onlinerecord' WHERE skey='onlinerecord'");
				save_syscache('onlinerecord', $onlinerecord);
				$onlineinfo = array($onlinenum, TIMESTAMP);
			}
			dsetcookie('onlineusernum', intval($onlinenum), 300);
		} else {
			$onlinenum = intval($_G['cookie']['onlineusernum']);
		}
		//note 格式化最高记录日期
		$onlineinfo[1] = dgmdate($onlineinfo[1], 'd');

		$detailstatus = $showoldetails == 'yes' || (((!isset($_G['cookie']['onlineindex']) && !$_G['setting']['whosonline_contract']) || $_G['cookie']['onlineindex']) && $onlinenum < 500 && !$showoldetails);

		if($detailstatus) {
			$actioncode = lang('action');

			$_G['uid'] && updatesession();
			$membercount = $invisiblecount = 0;
			$whosonline = array();

			$_G['setting']['maxonlinelist'] = $_G['setting']['maxonlinelist'] ? $_G['setting']['maxonlinelist'] : 500;
			$query = DB::query("SELECT uid, username, groupid, invisible, lastactivity, fid FROM ".DB::table('common_session')." WHERE uid>'0' LIMIT ".$_G['setting']['maxonlinelist']);
			while($online = DB::fetch($query)) {
				$membercount ++;
				if($online['invisible']) {
					$invisiblecount++;
					continue;
				} else {
					$online['icon'] = !empty($_G['cache']['onlinelist'][$online['groupid']]) ? $_G['cache']['onlinelist'][$online['groupid']] : $_G['cache']['onlinelist'][0];
				}
				$online['lastactivity'] = dgmdate($online['lastactivity'], 't');
				$whosonline[] = $online;
			}
			if(isset($_G['cache']['onlinelist'][7]) && $_G['setting']['maxonlinelist'] > $membercount) {
				$query = DB::query("SELECT uid, username, groupid, invisible, lastactivity, fid FROM ".DB::table('common_session')." WHERE uid='0' ORDER BY uid DESC LIMIT ".($_G['setting']['maxonlinelist'] - $membercount));
				while($online = DB::fetch($query)) {
					$online['icon'] = $_G['cache']['onlinelist'][7];
					$online['username'] = $_G['cache']['onlinelist']['guest'];
					$online['lastactivity'] = dgmdate($online['lastactivity'], 't');
					$whosonline[] = $online;
				}
			}
			unset($actioncode, $online);

			if($onlinenum > $_G['setting']['maxonlinelist']) {
				$membercount = $discuz->session->onlinecount(1);
				$invisiblecount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_session')." WHERE invisible = '1'");
			}

			if($onlinenum < $membercount) {
				$onlinenum = $discuz->session->onlinecount(0);
				dsetcookie('onlineusernum', intval($onlinenum), 300);
			}

			$guestcount = $onlinenum - $membercount;

			$db = DB::object();
			$db->free_result($query);
			unset($online);
		}

	} else {
		$_G['setting']['whosonlinestatus'] = 0;
	}

	if(defined('FORUM_INDEX_PAGE_MEMORY') && !FORUM_INDEX_PAGE_MEMORY) {
		memory('set', 'forum_index_page_' . $_G['member']['groupid'] . '_' . $vban, array(
			'catlist' => $catlist,
			'forumlist' => $forumlist,
			'sublist' => $sublist,
			'whosonline' => $whosonline,
			'onlinenum' => $onlinenum,
			'membercount' => $membercount,
			'guestcount' => $guestcount,
			'announcements' => $announcements,
			'threads' => $threads,
			'posts' => $posts,
			'todayposts' => $todayposts,
			'onlineinfo' => $onlineinfo,
			'announcepm' => $announcepm), getglobal('setting/memory/forumindex/ttl'));
	}

} else {
	require_once DISCUZ_ROOT.'./source/include/misc/misc_category.php';
}

$lastvisit = $lastvisit ? dgmdate($lastvisit, 'u') : 0;

if($_G['gp_archiver']) {
	include loadarchiver('forum/discuz');
	exit();
}
//exit('<pre>'.var_export($forumlist, true));
categorycollapse();
// include template('diy:forum/discuz:'.$gid);
$newindex ? include template('diy:forum/discuz_8264_new:'.$gid) : include template('diy:forum/discuz:'.$gid);

function get_index_announcements() {
	global $_G;
	$announcements = '';
	if($_G['cache']['announcements']) {
		$readapmids = !empty($_G['cookie']['readapmid']) ? explode('D', $_G['cookie']['readapmid']) : array();
		foreach($_G['cache']['announcements'] as $announcement) {
			if(empty($announcement['groups']) || in_array($_G['member']['groupid'], $announcement['groups'])) {
				if(empty($announcement['type'])) {
					$announcements .= '<li><a href="forum.php?mod=announcement&id='.$announcement['id'].'" target="_blank">'.$announcement['subject'].
						'<em>('.dgmdate($announcement['starttime'], 'd').')</em></a></li>';
				} elseif($announcement['type'] == 1) {
					$announcements .= '<li><a href="'.$announcement['message'].'" target="_blank">'.$announcement['subject'].
						'<em>('.dgmdate($announcement['starttime'], 'd').')</em></a></li>';
				}
			}
		}
	}
	return $announcements;
}

function get_index_page_guest_cache($newban = false) {
	global $_G;
	//debug 检查缓存文件，如果不存在相应目录则创建目录。
	$indexcache = getcacheinfo(0);
	$indexcache['filename'] = $newban ? $indexcache['filename'] . '_newban' : $indexcache['filename'];
	/*//debug 如果过期或者不存在，则定义缓存文件。output将该页缓存。
	if(TIMESTAMP - $indexcache['filemtime'] > $_G['setting']['cacheindexlife']) {
		@unlink($indexcache['filename']);
		define('CACHE_FILE', $indexcache['filename']);
	} elseif($indexcache['filename']) {
		@readfile($indexcache['filename']);*/
	if($_G['gp_debugadmin'] == '8264') memory('rm', $indexcache['filename']);
	if(memory('get', $indexcache['filename'])) {
		echo memory('get', $indexcache['filename']);
		$updatetime = dgmdate($indexcache['filemtime'], 'H:i:s');
		$gzip = $_G['gzipcompress'] ? ', Gzip enabled' : '';
		echo "<script type=\"text/javascript\">
			if($('debuginfo')) {
				$('debuginfo').innerHTML = '. This page is cached  at $updatetime $gzip .';
			}
			</script>";
		exit();
	}else{
		define('CACHE_FILE', $indexcache['filename']);
	}
}

function get_index_memory_by_groupid($groupid, $vban) {
	$enable = getglobal('setting/memory/forumindex/enable');
	if($enable && memory('check')) {
		$ret = memory('get', 'forum_index_page_' . $groupid . '_' . $vban);
		define('FORUM_INDEX_PAGE_MEMORY', $ret ? 1 : 0);
		if($ret) {
			return $ret;
		}
	}
	return array('none' => null);
}

function get_index_online_details() {
	$showoldetails = getgpc('showoldetails');
	switch($showoldetails) {
		case 'no': dsetcookie('onlineindex', ''); break;
		case 'yes': dsetcookie('onlineindex', 1, 86400 * 365); break;
	}
	return $showoldetails;
}

function do_forum_bind_domains() {
	global $_G;
	if($_G['setting']['binddomains'] && $_G['setting']['forumdomains']) {
		$loadforum = isset($_G['setting']['binddomains'][$_SERVER['HTTP_HOST']]) ? max(0, intval($_G['setting']['binddomains'][$_SERVER['HTTP_HOST']])) : 0;
		if($loadforum) {
			dheader('Location: '.$_G['setting']['siteurl'].'/forum.php?mod=forumdisplay&fid='.$loadforum);
		}
	}
}

function categorycollapse() {
	global $_G, $collapse, $catlist;
	if(!$_G['uid']) {
		return;
	}
	foreach($catlist as $fid => $forum) {
		if(!isset($_G['cookie']['collapse']) || strpos($_G['cookie']['collapse'], '_category_'.$fid.'_') === FALSE) {
			$catlist[$fid]['collapseimg'] = 'collapsed_no.gif';
			$collapse['category_'.$fid] = '';
		} else {
			$catlist[$fid]['collapseimg'] = 'collapsed_yes.gif';
			$collapse['category_'.$fid] = 'display: none';
		}
	}
}
//获得论坛首页任务信息
function gettasklistbyindex(){
	global $_G;
	$starttasks = array();
	$query = DB::query("SELECT * FROM ".DB::table('common_task')." where available='2'  and scriptname != 'weixin' and scriptname != 'appshare' and scriptname != 'changxian' and scriptname != 'appfollow' ORDER BY displayorder, taskid DESC limit 5");
	while($task = DB::fetch($query)) {
		if($task['reward'] == 'credit') {
			$reward = $_G['setting']['extcredits'][$task['prize']]['title'];
			$rnum = $task['bonus'];
		} elseif($task['reward'] == 'magic') {
			$magicname = DB::result_first("SELECT name FROM ".DB::table('common_magic')." WHERE magicid='$task[prize]'");
			$reward = $magicname;
			$rnum = $task['bonus']."张";
		} elseif($task['reward'] == 'medal') {
			$medalname = DB::result_first("SELECT name FROM ".DB::table('forum_medal')." WHERE medalid='$task[prize]'");
			$reward = "".$medalname;
			$rnum = ($task['bonus'] ? ' '."有效期".$task['bonus'].' '."天" : '');
		} elseif($task['reward'] == 'invite') {
			$reward = "".$task['prize'];
			$rnum = ($task['bonus'] ? ' '."有效期".$task['bonus'].' '."天" : '');
		} elseif($task['reward'] == 'group') {
			$grouptitle = DB::result_first("SELECT grouptitle FROM ".DB::table('common_usergroup')." WHERE groupid='$task[prize]'");
			$reward = "".$grouptitle;
			$rnum = ($task['bonus'] ? ' '."有效期".' '.$task['bonus'].' '."天" : '');
		} else {
			$reward = "无";
			$rnum = "无";
		}
		$task['reward'] = $reward;
		$task['rnum'] = $rnum;
		$starttasks[] = $task;
	}
    $tasklist_weixin  = array();
    foreach($starttasks as $key => $val){
        if($val['scriptname'] == 'weixin'){
            $tasklist_weixin[] = $val;
            unset($starttasks[$key]);
        }
    }
    if($tasklist_weixin){
        foreach($tasklist_weixin as $key => $val){
            if($key > 0){
                unset($tasklist_weixin[$key]);
            }
        }
    }
    $starttasks  =  array_merge_recursive($tasklist_weixin,$starttasks);

	return $starttasks;
}

?>