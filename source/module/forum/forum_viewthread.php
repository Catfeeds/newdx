<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('SQL_ADD_THREAD', ' t.dateline, t.special, t.lastpost AS lastthreadpost, ');

require_once libfile('function/forumlist');
require_once libfile('function/discuzcode');
require_once libfile('function/post');
$_G['forum']['extra'] = unserialize($_G['forum']['extra']);
if(!is_array($_G['forum']['extra'])) {
	$_G['forum']['extra'] = array();
}
$page = max(1, $_G['page']);
$_G['forum_scan_way'] = $_G['gp_forum_scan_way'];//common 为帖子模式  pic 为图片模式
if($_GET['tid']){
	$forumOption->getThreadsbytid($_GET['tid']);
}

$catlist = $forumlist = $sublist = $forumname = $collapseimg = $collapse = array();
$newindex = 1;
$_sql_fup = $newindex ? 'f.nfup as fup' : 'f.fup';
$_sql_displayorder = $newindex ? 'f.ndisplayorder' : 'f.displayorder';
//note 访问限制
$sql1 = !empty($_G['member']['accessmasks']) ?
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

$query1 = DB::query($sql1);
while($forum = DB::fetch($query1)) {
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

		} elseif(isset($forumlist[$forum['fup']])) {

			$forumlist[$forum['fup']]['threads'] += $forum['threads'];
			$forumlist[$forum['fup']]['posts'] += $forum['posts'];
			$forumlist[$forum['fup']]['todayposts'] += $forum['todayposts'];
			if($_G['setting']['subforumsindex'] && $forumlist[$forum['fup']]['permission'] == 2 && !($forumlist[$forum['fup']]['simple'] & 16) || ($forumlist[$forum['fup']]['simple'] & 8)) {
				$forumlist[$forum['fup']]['subforums'] .= (empty($forumlist[$forum['fup']]['subforums']) ? '' : ', ').'<a href="forum.php?mod=forumdisplay&fid='.$forum['fid'].'" '.(!empty($forum['extra']['namecolor']) ? ' style="color: ' . $forum['extra']['namecolor'].';"' : '') . '>'.$forum['name'].'</a>';
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
unset($catid, $category);
if(isset($catlist[0]) && $catlist[0]['forumscount']) {
	$catlist[0]['fid'] = 0;
	$catlist[0]['type'] = 'group';
	$catlist[0]['name'] = $_G['setting']['bbname'];
	$catlist[0]['collapseimg'] = 'collapsed_no.gif';
} else {
	unset($catlist[0]);
}

$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
$threadtable_info = !empty($_G['cache']['threadtable_info']) ? $_G['cache']['threadtable_info'] : array();

if(!in_array(0, $threadtableids)) {
	$threadtableids = array_merge(array(0), $threadtableids);
}

$archiveid = intval($_G['gp_archiveid']);
$displayorderadd = $_G['uid'] ? " OR (t.displayorder IN ('-4', '-3', '-2') AND t.authorid='{$_G['uid']}')" : '';

if(empty($archiveid) || !in_array($archiveid, $threadtableids)) {
	$threadtable = !empty($_G['forum']['threadtableid']) ? "forum_thread_{$_G['forum']['threadtableid']}" : 'forum_thread';
	$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' $displayorderadd)"));
	if($_G['forum_thread']) {
		if($_G['forum']['threadtableid']) {
			$_G['forum_thread']['is_archived'] = true;
			$_G['forum_thread']['archiveid'] = $_G['forum']['threadtableid'];
		} else {
			$_G['forum_thread']['is_archived'] = false;
		}
	}
} elseif(in_array($archiveid, $threadtableids)) {
	$threadtable = $archiveid ? "forum_thread_{$archiveid}" : 'forum_thread';
	$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' $displayorderadd)"));

	$_G['forum_thread']['is_archived'] = true;
	$_G['forum_thread']['archiveid'] = $_G['gp_archiveid'];
} else {
	$threadtable = 'forum_thread';
	$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' $displayorderadd)"));
}

if(!$_G['forum_thread']) {
	// showmessage('thread_nonexistence');
	header("HTTP/1.1 404 Not Found");
	header('Status: 404');
	exit;
}
$_G['forum_thread']['views'] += get_redis_views($_G['tid'],'viewthread');
$_G['forum_thread']['short_subject'] = cutstr($_G['forum_thread']['subject'], 52);
if($_G['setting']['cachethreadlife'] && $_G['forum']['threadcaches'] && !$_G['uid'] && $page == 1 && !$_G['forum']['special'] && empty($_G['gp_do']) && empty($_G['gp_archiver'])) {
	viewthread_loadcache();
}

$posttableid = $_G['forum_thread']['posttableid'];

$_G['action']['fid'] = $_G['fid'];
$_G['action']['tid'] = $_G['tid'];
$_G['gp_authorid'] = !empty($_G['gp_authorid']) ? intval($_G['gp_authorid']) : 0;
$_G['gp_ordertype'] = !empty($_G['gp_ordertype']) ? intval($_G['gp_ordertype']) : 0;

//附件用全局变量 discuzcode funtion attachlist
$aimgs = array();
//分类信息用的变量
$skipaids = array();
$oldthreads = array();
$oldtopics = isset($_G['cookie']['oldtopics']) ? $_G['cookie']['oldtopics'] : 'D';

if($_G['setting']['visitedthreads'] && $oldtopics) {
	$oldtids = array_slice(explode('D', $oldtopics), 0, $_G['setting']['visitedthreads']);
	$oldtidsnew = array();
	foreach($oldtids as $oldtid) {
		$oldtid && $oldtidsnew[] = $oldtid;
	}
	if($oldtidsnew) {
		$query = DB::query("SELECT tid, subject FROM ".DB::table('forum_thread')." WHERE tid IN (".dimplode($oldtidsnew).")");
		while($oldthread = DB::fetch($query)) {
			$oldthreads[$oldthread['tid']] = $oldthread['subject'];
		}
	}
}

if(strpos($oldtopics, 'D'.$_G['tid'].'D') === FALSE) {
	$oldtopics = 'D'.$_G['tid'].$oldtopics;
	if(strlen($oldtopics) > 3072) {
		$oldtopics = preg_replace("((D\d+)+D).*$", "\\1", substr($oldtopics, 0, 3072));
	}
	dsetcookie('oldtopics', $oldtopics, 3600);
}
if($_G['member']['lastvisit'] < $_G['forum_thread']['lastpost'] && (!isset($_G['cookie']['fid'.$_G['fid']]) || $_G['forum_thread']['lastpost'] > $_G['cookie']['fid'.$_G['fid']])) {
	dsetcookie('fid'.$_G['fid'], $_G['forum_thread']['lastpost'], 3600);
}

$thisgid = 0;
$_G['forum_thread']['subjectenc'] = rawurlencode($_G['forum_thread']['subject']);
$_G['gp_from'] = !empty($_G['gp_from']) && $_G['gp_from'] == 'portal' ? 'portal' : '';
$fromuid = $_G['setting']['creditspolicy']['promotion_visit'] && $_G['uid'] ? '&amp;fromuid='.$_G['uid'] : '';
$feeduid = $_G['forum_thread']['authorid'] ? $_G['forum_thread']['authorid'] : 0;
$feedpostnum = $_G['forum_thread']['replies'] > $_G['ppp'] ? $_G['ppp'] : ($_G['forum_thread']['replies'] ? $_G['forum_thread']['replies'] : 1);
if(!empty($_G['gp_extra'])) {
	parse_str($_G['gp_extra'], $extra);
	$_G['gp_extra'] = array();
	foreach($extra as $_k => $_v) {
		if(preg_match('/^\w+$/', $_k)) {
			$_G['gp_extra'][] = $_k.'='.$_v;
		}
	}
	$_G['gp_extra'] = implode('&', $_G['gp_extra']);
}
if(!$_G['gp_from']) {
	$forumarchivename = $threadtable_info[$_G['forum']['threadtableid']]['displayname'] ? htmlspecialchars($threadtable_info[$_G['forum']['threadtableid']]['displayname']) : lang('core', 'archive').' '.$_G['forum']['threadtableid'];
	$upnavlink = 'forum.php?mod=forumdisplay&fid='.$_G['fid'].($_G['gp_extra'] && !IS_ROBOT ? '&'.$_G['gp_extra'] : '');
	if(empty($_G['forum']['threadtableid'])) {
		//此处代码做了修改 at 2012.3.20 by zhanghongliang
		if($_G['fid']==$_G['config']['fids']['zbfx']){
			$navigation = ' <em>&rsaquo;</em> <a href="'.$_G['config']['web']['forum'].'">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="./zb">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
			$forumnameurl = $_G['config']['web']['portal'] . 'zb';
		}else{
			//百分百科技 at 2013-3-12 by zhanghongliang
			$cname = (strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']);
			$category= array();
			$category[0] = $cname;
			$category[1] = "http://bbs.8264.com/forum-".$_G['fid']."-1.html";
			//end
			$dom=$forumOption->getdomainbyfid($_G[fid]);
			if($dom){
				$navigation = ' <em>&rsaquo;</em> <a class="xlsj" href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="http://'.$dom.'.'.$_G['setting']['domain']['root']['forum'].'/">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
				$forumnameurl = 'http://' . $dom . '.' . $_G['setting']['domain']['root']['forum'] . '/';
			}else{
				$navigation = ' <em>&rsaquo;</em> <a class="xlsj" href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="'.$upnavlink.'">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
				$forumnameurl = $upnavlink;
			}
		}
	} else {
		$navigation = ' <em>&rsaquo;</em> <a class="xlsj" href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="'.$upnavlink.'">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>'.' <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&archiveid='.$_G['forum']['threadtableid'].'">'.$forumarchivename.'</a>';
		$forumnameurl = $upnavlink;
	}
	//增加title第几页显示  2013.1.16
	$navtitle = $_G['forum_thread']['subject'].' - '.'第'.$page.'页'.' - '.strip_tags($_G['forum']['name']);

	if($_G['forum_scan_way'] == 'pic'){
		$navtitle = $_G['forum_thread']['subject'].' - '.strip_tags($_G['forum']['name']);
	}

	if($_G['forum']['type'] == 'sub') {
		$fup = DB::fetch_first("SELECT fid, name FROM ".DB::table('forum_forum')." WHERE fid='".$_G['forum']['fup']."'");
		if(empty($_G['forum']['threadtableid'])) {

			$navigation = ' <em>&rsaquo;</em> <a href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$fup['fid'].'">'.(strip_tags($fup['name']) ? strip_tags($fup['name']) : $fup['name']).'</a> <em>&rsaquo;</em>';
			//此处代码做了修改在 2011 7 29日
			if($_G['fid']==$_G['config']['fids']['mountain']){
				$navigation.='<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
			}else{
				//百分百科技 at 2013-3-12 by zhanghongliang
				$catname = (strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']);
				$category1= array();
				$category1[0] = $catname;
				$category1[1] = "http://bbs.8264.com/forum-".$fup['fid']."-1.html";;
				//end
				$navigation.='<a href="'.$upnavlink.'">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
			}
			//此处代码做了修改在
		} else {
			$navigation = ' <em>&rsaquo;</em> <a href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$fup['fid'].'">'.(strip_tags($fup['name']) ? strip_tags($fup['name']) : $fup['name']).'</a> <em>&rsaquo;</em> <a href="'.$upnavlink.'">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>'.' <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&archiveid='.$_G['forum']['threadtableid'].'">'.$forumarchivename.'</a>';
		}
	}
} elseif($_G['gp_from'] == 'portal') {
	$_G['setting']['ratelogon'] = 1;
	$navigation = ' <em>&rsaquo;</em> <a href="portal.php">'.lang('core', 'portal').'</a>';
	$navsubject = $_G['forum_thread']['subject'];
	//增加title第几页显示  2013.1.16
	$navtitle = $_G['forum_thread']['subject'].' - '.'第'.$_G['gp_page'].'页';
	if($_G['forum_scan_way'] == 'pic'){
		$navtitle = $_G['forum_thread']['subject'];
	}
}

$_G['gp_extra'] = $_G['gp_extra'] ? rawurlencode($_G['gp_extra']) : '';
$metakeywords = strip_tags($_G['forum_thread']['subject']);

if(in_array('forum_viewthread', $_G['setting']['rewritestatus'])) {
	$canonical = rewriteoutput('forum_viewthread', 1, '', $_G['tid'], 1, '', '');
} elseif(in_array('all_script', $_G['setting']['rewritestatus'])) {
	$canonical = rewriteoutput('all_script', 1, '', 'forum', 'viewthread&tid='.$_G['tid'].'&page=1', '');
} else {
	$canonical = 'forum.php?mod=viewthread&tid='.$_G['tid'];
}
$_G['setting']['seohead'] .= '<link href="'.$_G['siteurl'].$canonical.'" rel="canonical" />';

if($_G['forum']['status'] == 3) {
	$_G['action']['action'] = 3;
	require_once libfile('function/group');
	$status = groupperm($_G['forum'], $_G['uid']);
	if($status == 1) {
		showmessage('forum_group_status_off');
	} elseif($status == 2) {
		showmessage('forum_group_noallowed', 'forum.php?mod=group&fid='.$_G['fid']);
	} elseif($status == 3) {
		showmessage('forum_group_moderated', 'forum.php?mod=group&fid='.$_G['fid']);
	}
	$navigation = ' <em>&rsaquo;</em> <a href="group.php">'.$_G['setting']['navs'][3]['navname'].'</a> '.get_groupnav($_G['forum']);
	$_G['grouptypeid'] = $_G['forum']['fup'];
}

$_G['forum_tagscript'] = '';

$threadsort = $_G['forum_thread']['sortid'] && isset($_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]) ? 1 : 0;
if($threadsort) {
	require_once libfile('function/threadsort');
	$threadsortshow = threadsortshow($_G['forum_thread']['sortid'], $_G['tid']);
}
if(empty($_G['forum']['allowview'])) {
	if(!$_G['forum']['viewperm'] && !$_G['group']['readaccess']) {
		showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
	} elseif($_G['forum']['viewperm'] && !forumperm($_G['forum']['viewperm'])) {
		$navtitle = '';
		showmessagenoperm('viewperm', $_G['fid']);
	}
} elseif($_G['forum']['allowview'] == -1) {
	$navtitle = '';
	showmessage('forum_access_view_disallow');
}

if($_G['forum']['formulaperm']) {
	formulaperm($_G['forum']['formulaperm']);
}
if($_G['forum']['password'] && $_G['forum']['password'] != $_G['cookie']['fidpw'.$_G['fid']]) {
	dheader("Location: $_G[siteurl]forum.php?mod=forumdisplay&fid=$_G[fid]");
}

if($_G['forum_thread']['readperm'] && $_G['forum_thread']['readperm'] > $_G['group']['readaccess'] && !$_G['forum']['ismoderator'] && $_G['forum_thread']['authorid'] != $_G['uid']) {
	showmessage('thread_nopermission', NULL, array('readperm' => $_G['forum_thread']['readperm']), array('login' => 1));
}

$usemagic = array('user' => array(), 'thread' => array());
/* 道具代码暂时注释
if($_G['setting']['magicstatus']) {
	loadcache('magics');
	if($_G['cache']['magics']) {
		foreach($_G['cache']['magics'] as $id => $magic) {
			if($magic['available'] == 1) {
				if($magic['type'] == 1) {
					$usemagic['thread'][$id]['name'] = $magic['name'];
				} elseif($magic['type'] == 2) {
					$usemagic['user'][$id]['name'] = $magic['name'];
					$usemagic['user'][$id]['pic'] = strtolower($magic['identifier']).'_s.gif';
				}
			}
		}
	}
}
*/
$hiddenreplies = getstatus($_G['forum_thread']['status'], 2);
$rushreply = getstatus($_G['forum_thread']['status'], 3);
$savepostposition = getstatus($_G['forum_thread']['status'], 1);
$_G['forum_threadpay'] = FALSE;
if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) {
	if($_G['setting']['maxchargespan'] && TIMESTAMP - $_G['forum_thread']['dateline'] >= $_G['setting']['maxchargespan'] * 3600) {
		DB::query("UPDATE ".DB::table($threadtable)." SET price='0' WHERE tid='$_G[tid]'");
		$_G['forum_thread']['price'] = 0;
	} else {
		$exemptvalue = $_G['forum']['ismoderator'] ? 128 : 16;
		if(!($_G['group']['exempt'] & $exemptvalue) && $_G['forum_thread']['authorid'] != $_G['uid']) {
			$query = DB::query("SELECT relatedid FROM ".DB::table('common_credit_log')." WHERE relatedid='$_G[tid]' AND uid='$_G[uid]' AND operation='BTC'");
			if(!DB::num_rows($query)) {
				require_once libfile('thread/pay', 'include');
				$_G['forum_threadpay'] = TRUE;
			}
		}
	}
}

$_G['group']['raterange'] = $_G['setting']['modratelimit'] && $adminid == 3 && !$_G['forum']['ismoderator'] ? array() : $_G['group']['raterange'];
$_G['group']['allowgetattach'] = !empty($_G['forum']['allowgetattach']) || ($_G['group']['allowgetattach'] && !$_G['forum']['getattachperm']) || forumperm($_G['forum']['getattachperm']);
$_G['getattachcredits'] = '';
if($_G['forum_thread']['attachment']) {
	$exemptvalue = $_G['forum']['ismoderator'] ? 32 : 4;
	if(!($_G['group']['exempt'] & $exemptvalue)) {
		$creditlog = updatecreditbyaction('getattach', $_G['uid'], array(), '', 1, 0, $_G['forum_thread']['fid']);
		$p = '';
		if($creditlog['updatecredit']) for($i = 1;$i <= 8;$i++) {
			if($policy = $creditlog['extcredits'.$i]) {
				$_G['getattachcredits'] .= $p.$_G['setting']['extcredits'][$i]['title'].' '.$policy.' '.$_G['setting']['extcredits'][$i]['unit'];
				$p = ', ';
			}
		}
	}
}

$exemptvalue = $_G['forum']['ismoderator'] ? 64 : 8;
$_G['forum_attachmentdown'] = $_G['group']['exempt'] & $exemptvalue;

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

$postlist = $_G['forum_attachtags'] = $attachlist = $_G['forum_threadstamp'] = array();
$aimgcount = 0;
$_G['forum_attachpids'] = -1;

if(!empty($_G['gp_action']) && $_G['gp_action'] == 'printable' && $_G['tid']) {
	header('HTTP/1.1 404 Not Found');
	header('Status: 404');
	echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 printtable</center></body></html>";
	exit;
	require_once libfile('thread/printable', 'include');
	dexit();
}

if($_G['forum_thread']['stamp'] >= 0) {
	$_G['forum_threadstamp'] = $_G['cache']['stamps'][$_G['forum_thread']['stamp']];
}

$thisgid = $_G['forum']['type'] == 'forum' ? $_G['forum']['fup'] : $_G['cache']['forums'][$_G['forum']['fup']]['fup'];
$lastmod = $_G['forum_thread']['moderated'] ? viewthread_lastmod() : array();

$showsettings = str_pad(decbin($_G['setting']['showsettings']), 3, '0', STR_PAD_LEFT);

$showsignatures = $showsettings{0};
$showavatars = $showsettings{1};
$_G['setting']['showimages'] = $showsettings{2};

$highlightstatus = isset($_G['gp_highlight']) && str_replace('+', '', $_G['gp_highlight']) ? 1 : 0;

$_G['forum']['allowreply'] = isset($_G['forum']['allowreply']) ? $_G['forum']['allowreply'] : '';
$_G['forum']['allowpost'] = isset($_G['forum']['allowpost']) ? $_G['forum']['allowpost'] : '';

if(!$_G['uid']) {
	$guestallowpostreply = ($_G['forum']['allowreply'] != -1) && (($_G['forum_thread']['isgroup'] || (!$_G['forum_thread']['closed'] && !checkautoclose($_G['forum_thread']))) || $_G['forum']['ismoderator']) && ((!$_G['forum']['replyperm'] && $_G['perm']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'], $_G['perm']['groupid'])) || $_G['forum']['allowreply']);
}
$allowpostreply = ($_G['forum']['allowreply'] != -1) && (($_G['forum_thread']['isgroup'] || (!$_G['forum_thread']['closed'] && !checkautoclose($_G['forum_thread']))) || $_G['forum']['ismoderator']) && ((!$_G['forum']['replyperm'] && $_G['group']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'])) || $_G['forum']['allowreply']);
if(!$_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
	$allowpostreply = false;
}
$_G['group']['allowpost'] = $_G['forum']['allowpost'] != -1 && ((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])) || $_G['forum']['allowpost']);

if(!$_G['uid']) {
	$guestreply = $guestallowpostreply && !$allowpostreply;
	$allowpostreply = $guestreply || $allowpostreply;
}
if($_G['group']['allowpost']) {
	$_G['group']['allowpostpoll'] = $_G['group']['allowpostpoll'] && ($_G['forum']['allowpostspecial'] & 1);
	$_G['group']['allowposttrade'] = $_G['group']['allowposttrade'] && ($_G['forum']['allowpostspecial'] & 2);
	$_G['group']['allowpostreward'] = $_G['group']['allowpostreward'] && ($_G['forum']['allowpostspecial'] & 4) && isset($_G['setting']['extcredits'][$_G['setting']['creditstrans']]);
	$_G['group']['allowpostactivity'] = $_G['group']['allowpostactivity'] && ($_G['forum']['allowpostspecial'] & 8);
	$_G['group']['allowpostdebate'] = $_G['group']['allowpostdebate'] && ($_G['forum']['allowpostspecial'] & 16);
} else {
	$_G['group']['allowpostpoll'] = $_G['group']['allowposttrade'] = $_G['group']['allowpostreward'] = $_G['group']['allowpostactivity'] = $_G['group']['allowpostdebate'] = FALSE;
}

$_G['forum']['threadplugin'] = $_G['group']['allowpost'] && $_G['setting']['threadplugins'] ? is_array($_G['forum']['threadplugin']) ? $_G['forum']['threadplugin'] : unserialize($_G['forum']['threadplugin']) : array();

$_G['setting']['visitedforums'] = $_G['setting']['visitedforums'] ? visitedforums() : '';
$forummenu = '';

if($_G['setting']['forumjump']) {
	$forummenu = forumselect(FALSE, 1);
}

$relatedthreadlist = array();
$relatedthreadupdate = $tagupdate = FALSE;
$relatedkeywords = $tradekeywords = $_G['forum_firstpid'] = '';
$metakeywords = $_G['forum']['name'];

if(!isset($_G['cookie']['collapse']) || strpos($_G['cookie']['collapse'], 'modarea_c') === FALSE) {
	$collapseimg['modarea_c'] = 'collapsed_no';
	$collapse['modarea_c'] = '';
} else {
	$collapseimg['modarea_c'] = 'collapsed_yes';
	$collapse['modarea_c'] = 'display: none';
}

$threadtag = array();
$_G['setting']['tagstatus'] = $_G['setting']['tagstatus'] && $_G['forum']['allowtag'] ? ($_G['setting']['tagstatus'] == 2 ? 2 : $_G['forum']['allowtag']) : 0;

viewthread_updateviews();

$_G['setting']['infosidestatus']['posts'] = $_G['setting']['infosidestatus'][1] && isset($_G['setting']['infosidestatus']['f'.$_G['fid']]['posts']) ? $_G['setting']['infosidestatus']['f'.$_G['fid']]['posts'] : $_G['setting']['infosidestatus']['posts'];

//可能已经废弃
//$infoside = $_G['setting']['infosidestatus'][1] && $_G['forum_thread']['replies'] > $_G['setting']['infosidestatus']['posts'];

$postfieldsadd = $specialadd1 = $specialadd2 = $specialextra = '';
if($_G['forum_thread']['special'] == 2) {
	if(!empty($_G['gp_do']) && $_G['gp_do'] == 'tradeinfo') {
		require_once libfile('thread/trade', 'include');
	}
	$query = DB::query("SELECT pid FROM ".DB::table('forum_trade')." WHERE tid='$_G[tid]'");
	while($trade = DB::fetch($query)) {
		$tpids[] = $trade['pid'];
	}
	$specialadd2 = " AND pid NOT IN (".dimplode($tpids).")";
} elseif($_G['forum_thread']['special'] == 5) {
	if(isset($_G['gp_stand']) && $_G['gp_stand'] >= 0 && $_G['gp_stand'] < 3) {
		$specialadd1 .= "LEFT JOIN ".DB::table('forum_debatepost')." dp ON p.pid=dp.pid";
		if($_G['gp_stand']) {
			$specialadd2 .= "AND (dp.stand='$_G[gp_stand]' OR p.first='1')";
		} else {
			$specialadd2 .= "AND (dp.stand='0' OR dp.stand IS NULL OR p.first='1')";
		}
		$specialextra = "&amp;stand=$_G[gp_stand]";
	} else {
		$specialadd1 = "LEFT JOIN ".DB::table('forum_debatepost')." dp ON p.pid=dp.pid";
	}
	$postfieldsadd .= ", dp.stand, dp.voters";
}

$onlyauthoradd = $threadplughtml = '';
$posttable = $posttableid ? "forum_post_$posttableid" : 'forum_post';

if(empty($_G['gp_viewpid'])) {
	//搜索引擎来路功能
	$_G['setting']['my_search_status'] = 1;
	if ($_G['setting']['my_search_status']) {
		if (viewthread_is_search_referer()) {
			$_sig = md5($_G['timestamp'] . $_G['setting']['my_siteid'] . $_G['uid'] . $_G['setting']['my_sitekey'] . $_G['groupid']);
			$my_search_se_url = 'http://search.manyou.com/api/se?referer=' . urlencode($_SERVER['HTTP_REFERER']) . '&ts=' . time() . '&sig=' . $_sig . '&sId=' . $_G['setting']['my_siteid'] . '&cuId=' . $_G['uid'] . '&gId=' . $_G['groupid'];
		}
	}
	//end
	$ordertype = empty($_G['gp_ordertype']) && getstatus($_G['forum_thread']['status'], 4) ? 1 : $_G['gp_ordertype'];
	//在装备分享做下修改 at 2012.4.5 by zhanghongliang
	if($_G['fid']==$_G['config']['fids']['zbfx']){
		$ordertype=0;
	}
	//回帖置顶
	$sticklist = array();
	if($_G['forum_thread']['stickreply'] && $page == 1 && !$_G['gp_authorid'] && !$ordertype) {
		$query = DB::query("SELECT p.*, ps.position FROM ".DB::table('forum_poststick')." ps
			LEFT JOIN ".DB::table($posttable)." p USING(pid)
			WHERE ps.tid='$_G[tid]' ORDER BY ps.dateline DESC");
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		while($post = DB::fetch($query)) {
			//在装备分享做下修改 at 2012.4.5 by zhanghongliang
			if($_G['fid']!=$_G['config']['fids']['zbfx']){
				if($_G['fid']==$_G['config']['fids']['skiing']){
					$post['message'] = messagecutstr($post['message']);
				}else{
					$post['message'] = messagecutstr($post['message'], 400);
				}
			}else{
				$post['message'] = discuzcode($post['message'],$post['pid']);
				//$post['message'] = preg_replace('/<br\s*\/>\s*<br\s*\/>/', '<br />', $post['message']);
				if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $post['message'], $matches)) {
					$aids = $matches[1];
					foreach ($aids as $aid) {
						$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
						if ($attachment['isimage']) {
							if($attachment['serverid']>0){
								$domaininfo  = $attachserver->get_server_domain($attachment['serverid'], '*');
								$path = "http://".$domaininfo['name']."/forum/".$attachment['attachment'];
								if( is_array( $domaininfo['api'] ) ) {
									if( $domaininfo['api']['class'] && is_object( $domaininfo['api']['class'] ) ) {
										$_callback = array( $domaininfo['api']['class'], $domaininfo['api']['function'] );
									}else{
										$_callback = $domaininfo['api']['function'];
									}
									$path .= call_user_func_array( $_callback, array( 'forum', true, $_G['fid'] == 443 ? false : true, true ));
								}
							}elseif($attachment['remote']){
								$path = $_G['setting']['ftp']['attachurl'].'forum/'.$attachment['attachment'];
							}else{
								$path = $_G['setting']['attachurl'].'forum/'.$attachment['attachment'];
							}
						}
						if($attachment['width']>610){
							$post['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" width="610px;" />', $post['message']);
						}else{
							$post['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" />', $post['message']);
						}
					}
						//$ads = implode(",", $aids);
				}
		    }
			$post['message'] = trim($post['message']);
			$post['avatar'] = avatar($post['authorid'], 'small');
			$sticklist[$post['pid']] = $post;
		}
		$stickcount = count($sticklist);
	}

	if($_G['gp_authorid']) {
		$_G['forum_thread']['replies'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND invisible='0' AND authorid='$_G[gp_authorid]' " . getSlaveID());
		$_G['forum_thread']['replies']--;
		if($_G['forum_thread']['replies'] < 0) {
			showmessage('undefined_action');
		}
		$onlyauthoradd = "AND p.authorid='$_G[gp_authorid]'";
	} elseif($_G['forum_thread']['special'] == 5) {
		if(isset($_G['gp_stand']) && $_G['gp_stand'] >= 0 && $_G['gp_stand'] < 3) {
			$_G['forum_thread']['replies'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND stand='$_G[gp_stand]'");
		} else {
			$_G['forum_thread']['replies'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND invisible='0' " . getSlaveID());
			$_G['forum_thread']['replies'] > 0 && $_G['forum_thread']['replies']--;
		}
	} elseif($_G['forum_thread']['special'] == 2) {
		$tradenum = DB::result_first("SELECT count(*) FROM ".DB::table('forum_trade')." WHERE tid='$_G[tid]'");
		$_G['forum_thread']['replies'] -= $tradenum;
	}
	$_G['ppp'] = $_G['forum']['threadcaches'] && !$_G['uid'] ? $_G['setting']['postperpage'] : $_G['ppp'];
	$totalpage = ceil(($_G['forum_thread']['replies'] + 1) / $_G['ppp']);
	$page > $totalpage && $page = $totalpage;
	$_G['forum_pagebydesc'] = $page > 50 && $page > ($totalpage / 2) ? TRUE : FALSE;

	if (isset($forumOption)) {
		$forumOption->hookScript10($_G['forum_pagebydesc']);
	}


	if($_G['forum_pagebydesc']) {
		$firstpagesize = ($_G['forum_thread']['replies'] + 1) % $_G['ppp'];
		$_G['forum_ppp3'] = $_G['forum_ppp2'] = $page == $totalpage && $firstpagesize ? $firstpagesize : $_G['ppp'];
		$realpage = $totalpage - $page + 1;
		$start_limit = max(0, ($realpage - 2) * $_G['ppp'] + $firstpagesize);
		$_G['forum_numpost'] = ($page - 1) * $_G['ppp'];
		if($ordertype != 1) {
			$pageadd =  "ORDER BY p.dateline DESC LIMIT $start_limit, ".$_G['forum_ppp2'];
		} else {
			$_G['forum_numpost'] = $_G['forum_thread']['replies'] + 2 - $_G['forum_numpost'] + ($page > 1 ? 1 : 0);
			$pageadd = "ORDER BY p.first ASC, p.dateline ASC LIMIT $start_limit, ".$_G['forum_ppp2'];
		}
	} else {
		$start_limit = $_G['forum_numpost'] = max(0, ($page - 1) * $_G['ppp']);
		if($start_limit > $_G['forum_thread']['replies']) {
			$start_limit = $_G['forum_numpost'] = 0;
			$page = 1;
		}
		if($ordertype != 1) {
			$pageadd = "ORDER BY p.dateline LIMIT $start_limit, $_G[ppp]";
		} else {
			$_G['forum_numpost'] = $_G['forum_thread']['replies'] + 2 - $_G['forum_numpost'] + ($page > 1 ? 1 : 0);
			$pageadd = "ORDER BY p.first DESC, p.dateline DESC LIMIT $start_limit, $_G[ppp]";
		}
	}

	//评论分页 by zhanghongliang at 2013.1.11
	if (in_array($_G['fid'],$_G['config']['fids'])) {
		$_G['forum_thread']['replies']=$_G['forum_thread']['replies']-1;
	}
	$multipage = multi($_G['forum_thread']['replies'] + 1, $_G['ppp'], $page, 'forum.php?mod=viewthread&tid='.$_G['tid'].
		($_G['forum_thread']['is_archived'] ? '&archive='.$_G['forum_thread']['archiveid'] : '').
		'&amp;extra='.$_G['gp_extra'].
		($ordertype && $ordertype != getstatus($_G['forum_thread']['status'], 4) ? '&amp;ordertype='.$ordertype : '').
		(isset($_G['gp_highlight']) ? '&amp;highlight='.rawurlencode($_G['gp_highlight']) : '').
		(!empty($_G['gp_authorid']) ? '&amp;authorid='.$_G['gp_authorid'] : '').
		(!empty($_G['gp_from']) ? '&amp;from='.$_G['gp_from'] : '').
		(!empty($_G['gp_checkrush']) ? '&amp;checkrush='.$_G['gp_checkrush'] : '').
		(!empty($_G['gp_modthreadkey']) ? '&amp;modthreadkey='.rawurlencode($_G['gp_modthreadkey']) : '').
		$specialextra);
} else {
	$_G['gp_viewpid'] = intval($_G['gp_viewpid']);
	$pageadd = "AND p.pid='$_G[gp_viewpid]'";
}
$_G['forum_newpostanchor'] = $_G['forum_postcount'] = $_G['forum_ratelogpid'] = $_G['forum_commonpid'] = 0;

$_G['forum_onlineauthors'] = array();
$query_sql = "SELECT p.* $postfieldsadd
		FROM ".DB::table($posttable)." p
		$specialadd1 ";

$cachepids = $positionlist = $postusers = $skipaids = array();
if($savepostposition && empty($onlyauthoradd) && empty($specialadd2) && empty($_G['gp_viewpid']) && $ordertype != 1) {
	$start = ($page - 1) * $_G['ppp'] + 1;
	$end = $start + $_G['ppp'];
	$q2 = DB::query("SELECT pid, position FROM ".DB::table('forum_postposition')." WHERE tid='$_G[tid]' AND position>='$start' AND position<'$end' ORDER BY position");
	while ($post = DB::fetch($q2)) {
		$cachepids[] = $post['pid'];
		$positionlist[$post['pid']] = $post['position'];
	}
	$cachepids = dimplode($cachepids);
	$pagebydesc = false;
}


$query_sql .= $savepostposition && $cachepids ? "WHERE p.pid IN ($cachepids)" : ("WHERE p.tid='$_G[gp_tid]'".($_G['forum_auditstatuson'] || in_array($_G['forum_thread']['displayorder'], array(-2, -3, -4)) && $_G['forum_thread']['authorid'] == $_G['uid'] ? '' : " AND p.invisible='0'")." $specialadd2 $onlyauthoradd $pageadd");

// 如果fid==408 将每页显示主题 并将回复顺序按时间降序排列
if (isset($forumOption)) {
	$query_sql = $forumOption->hookScript1($query_sql, $posttable);
}

//新添加
//向帖子(假如帖子，对应一个点评，条件为forpid不为0)的内部加入所对应点评的编号
$forumComment = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and forpid <> 0 and tid=$_G[gp_tid] " . getSlaveID());
$hhtss = 0;
while($comment = DB::fetch($forumComment)) {
	$replyComment[$comment['forpid']] = $comment;
}
//end

//快速回帖之后获取帖子内容不能走从库查询
if(empty($_G['gp_viewpid'])) { $query_sql .= getSlaveID(); }

$query = DB::query($query_sql);
while($post = DB::fetch($query)) {
	if(($onlyauthoradd && $post['anonymous'] == 0) || !$onlyauthoradd) {
		//新添加
		//循环查找帖子的pid与该主题点评列表$replyComment中相同的 点评记录的编号id，并存入$post数组中
		/*for($i=0;$i<count($replyComment);$i++){
			if($post['pid'] == $replyComment[$i]['forpid']){
				$post['cid'] = $replyComment[$i]['id'];
				echo "<p>{$post['pid']}={$replyComment[$i]['forpid']}|{$post['pid']} = {$replyComment[$i]['id']}</p>";
			}
			$hhtss++;
		}*/
		if(!empty($replyComment[$post['pid']]))
		{
			$post['cid'] = $replyComment[$post['pid']]['id'];
		}
		//end
		$postlist[$post['pid']] = $post;
		$postusers[$post['authorid']] = array();
		if($post['first']) {
			$_G['forum_firstpid'] = $post['pid'];
			$metadescription = str_replace(array("\r", "\n"), '', messagecutstr(strip_tags($post['message']), 160));

			// 快捷点评 lxp 20140220
			$message = messagecutstr($post['message'], 100);
			$message = implode("\n", array_slice(explode("\n", $message), 0, 3));
			$fastreply_noticeauthormsg = htmlspecialchars($message);
			$time = dgmdate($post['dateline']);
			$post_reply_quote = lang('forum/misc', 'post_reply_quote', array('author' => $post['author'], 'time' => $time));
			$message = "[quote][size=2][color=#999999]{$post_reply_quote}[/color] [url=forum.php?mod=redirect&goto=findpost&pid={$post['pid']}&ptid={$post['tid']}][img]http://static.8264.com/static/image/common/back.gif[/img][/url][/size]\n{$message}[/quote]";
			$fastreply_noticetrimstr = htmlspecialchars($message);
		}
	}
}

if(!$metadescription) {
	$metadescription = strip_tags($_G['forum_thread']['subject']);
}


$postno = & $_G['cache']['custominfo']['postno'];
if($postusers) {
    //require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
    //$logs = new logs('log_viewthread_cache_user');
    //$log_str = '当前共有'.count($postusers).'个用户';
    $postusersinfo = array();
    foreach($postusers as $k => $v){
        $lsinfo = memory('get' ,'user_info_viewthread_uid_'.$k.'_cache');
        if($lsinfo){
            $postusersinfo[$k] = $lsinfo;
            unset($postusers[$k]);
        }
    }
    //$log_str .= ',通过缓存读取后，剩余需要查询用户'.count($postusers).'个';
    if($postusers){
        //$log_str .= ',开始sql查询用户'.dimplode(array_keys($postusers));
    	$verifyadd = '';
    	$fieldsadd = $_G['cache']['custominfo']['fieldsadd'];
    	if($_G['setting']['verify']['enabled']) {
    		$verifyadd = "LEFT JOIN ".DB::table('common_member_verify')." mv USING(uid)";
    		$fieldsadd .= ', mv.verify1, mv.verify2, mv.verify3, mv.verify4, mv.verify5';
    	}
    	$query = DB::query("SELECT m.uid, m.username, m.groupid, m.adminid, m.regdate, m.credits, m.email, m.status AS memberstatus,
    			ms.lastactivity, ms.invisible AS authorinvisible,
    			mc.*,
    			mf.medals, mf.sightml AS signature, mf.customstatus $fieldsadd
    			FROM ".DB::table('common_member')." m
    			LEFT JOIN ".DB::table('common_member_field_forum')." mf USING(uid)
    			LEFT JOIN ".DB::table('common_member_status')." ms USING(uid)
    			LEFT JOIN ".DB::table('common_member_count')." mc USING(uid)

    			$verifyadd
    			WHERE m.uid IN (".dimplode(array_keys($postusers)).")" . getSlaveID());
    	while($postuser = DB::fetch($query)) {
    		//$postusers[$postuser['uid']] = $postuser;
            $postusersinfo[$postuser['uid']] = $postuser;
            memory('set' ,'user_info_viewthread_uid_'.$postuser['uid'].'_cache' ,$postuser ,3600 * 24 * 7);
    	}
	}
    //$logs->log_str($log_str);

    //发帖数和回复数相关
    include_once libfile('function/space');
    include_once libfile('function/friend');
    $dianpingFids = getdianpingfids();
    $allowviewuserthread = $_G['setting']['allowviewuserthread'];
	$allowviewuserthread = trim($allowviewuserthread, "'");
	$allowviewuserthread = $allowviewuserthread && !$space['self'] ? explode("','", $allowviewuserthread) :array();

	$allowviewuserthread = array_diff($allowviewuserthread, $dianpingFids);
	$infids  = implode(',', $allowviewuserthread);
    $notfids = implode(',', $dianpingFids);

	foreach($postlist as $pid => $post) {
		$post = array_merge($postlist[$pid], $postusersinfo[$post['authorid']]);
		$postlist[$pid] = viewthread_procpost($post, $_G['member']['lastvisit'], $ordertype);

		//发帖数和回复数
		$postlist[$pid]['self'] = $_G['uid'] == $postlist[$pid]['authorid'] ? 1 : 0;
		$postlist[$pid]['threads']  = getthreadbyuid($postlist[$pid], $notfids, $infids);
		$postlist[$pid]['posts']    = getpostbyuid($postlist[$pid], $notfids, $infids);
	}
}

if($savepostposition && $positionlist) {
	foreach ($positionlist as $pid => $position)
	$postlist[$pid]['number'] = $position;
}

if($_G['forum_thread']['special'] > 0 && (empty($_G['gp_viewpid']) || $_G['gp_viewpid'] == $_G['forum_firstpid'])) {
	$_G['forum_thread']['starttime'] = gmdate($_G['forum_thread']['dateline']);
	$_G['forum_thread']['remaintime'] = '';
	switch($_G['forum_thread']['special']) {
		case 1: require_once libfile('thread/poll', 'include'); break;
		case 2: require_once libfile('thread/trade', 'include'); break;
		case 3: require_once libfile('thread/reward', 'include'); break;
		case 4: require_once libfile('thread/activity', 'include'); break;
		case 5: require_once libfile('thread/debate', 'include'); break;
		case 127:
			if($_G['forum_firstpid']) {
				$sppos = strpos($postlist[$_G['forum_firstpid']]['message'], chr(0).chr(0).chr(0));
				$specialextra = substr($postlist[$_G['forum_firstpid']]['message'], $sppos + 3);

				$postlist[$_G['forum_firstpid']]['message'] = substr($postlist[$_G['forum_firstpid']]['message'], 0, $sppos);
				if($specialextra) {
					if(array_key_exists($specialextra, $_G['setting']['threadplugins'])) {
						@include_once DISCUZ_ROOT.'./source/plugin/'.$_G['setting']['threadplugins'][$specialextra]['module'].'.class.php';
						$classname = 'threadplugin_'.$specialextra;
						if(class_exists($classname) && method_exists($threadpluginclass = new $classname, 'viewthread')) {
							$threadplughtml = $threadpluginclass->viewthread($_G['tid']);
						}
					}
				}
			}
			break;
	}
}
if(empty($_G['gp_authorid']) && empty($postlist)) {
	$replies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND invisible='0'");
	$replies = intval($replies) - 1;
	if($_G['forum_thread']['replies'] != $replies && $replies > 0) {
		DB::query("UPDATE ".DB::table($threadtable)." SET replies='$replies' WHERE tid='$_G[tid]'");
		dheader("Location: forum.php?mod=redirect&tid=$_G[tid]&goto=lastpost");
	}
}

if($_G['forum_pagebydesc'] && (!$savepostposition || $_G['gp_ordertype'] == 1)) {
	$postlist = array_reverse($postlist, TRUE);
}

if($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors']) {
	$query = DB::query("SELECT uid FROM ".DB::table('common_session')." WHERE uid IN(".dimplode($_G['forum_onlineauthors']).") AND invisible=0");
	$_G['forum_onlineauthors'] = array();
	while($author = DB::fetch($query)) {
		$_G['forum_onlineauthors'][$author['uid']] = 1;
	}
} else {
	$_G['forum_onlineauthors'] = array();
}

$ratelogs = array();
if($_G['forum_ratelogpid']) {
	$query = DB::query("SELECT * FROM ".DB::table('forum_ratelog')." WHERE pid IN (".$_G['forum_ratelogpid'].") ORDER BY dateline DESC");
	while($ratelog = DB::fetch($query)) {
		if(count($postlist[$ratelog['pid']]['ratelog']) < $_G['setting']['ratelogrecord']) {
			$ratelogs[$ratelog['pid']][$ratelog['uid']]['username'] = $ratelog['username'];
			$ratelogs[$ratelog['pid']][$ratelog['uid']]['score'][$ratelog['extcredits']] += $ratelog['score'];
			empty($ratelogs[$ratelog['pid']][$ratelog['uid']]['reason']) && $ratelogs[$ratelog['pid']][$ratelog['uid']]['reason'] = dhtmlspecialchars($ratelog['reason']);
			$postlist[$ratelog['pid']]['ratelog'][$ratelog['uid']] = $ratelogs[$ratelog['pid']][$ratelog['uid']];
		}
		$postlist[$ratelog['pid']]['ratelogextcredits'][$ratelog['extcredits']] += $ratelog['score'];

		if(!$postlist[$ratelog['pid']]['totalrate'] || !in_array($ratelog['uid'], $postlist[$ratelog['pid']]['totalrate'])) {
			$postlist[$ratelog['pid']]['totalrate'][] = $ratelog['uid'];
		}
	}
	foreach($postlist as $key => $val) {
		if(!empty($val['ratelogextcredits'])) {
			ksort($postlist[$key]['ratelogextcredits']);
		}
	}
}

$comments = $commentcount = $totalcomment = array();
if($_G['forum_commonpid'] && $_G['setting']['commentnumber']){
	$query = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and tid = ".$_G['tid']." ORDER BY dateline DESC " . getSlaveID());
	while($totalcom = DB::fetch($query)){
			//if($totalcom['replyid'] != 0){
			$reply[$totalcom['replyid']] = $totalcom;
			//}
		}
    $querys = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and pid IN (".$_G['forum_commonpid'].') ORDER BY dateline DESC ' . getSlaveID());
	while($comment = DB::fetch($querys)) {
		/*for($i=0;$i<count($reply);$i++){
			$arr = $reply[$i];
			if($arr['replyid'] == $comment['id']){
				$arr['avatar'] = avatar($arr['authorid'], 'small');
				$arr['dateline'] = dgmdate($arr['dateline'], 'u');
				$comment['replyComment'][] = $arr;
				$j++;
			}
		}*/
		if(!empty($reply[$comment['id']]))
		{
			$reply[$comment['id']]['avatar'] = avatar($reply[$comment['id']]['authorid'], 'small');
			$reply[$comment['id']]['dateline'] = dgmdate($reply[$comment['id']]['dateline'], 'u');
			$comment['replyComment'][] = $reply[$comment['id']];
			$j++;
		}
		//存储点评 回复的条数
		$comment['replyCount'] = count($comment['replyComment']);
		//将点评回复 分装为n条和全部  未 超过n条的回复threeComment键的值为空
		$count = count($comment['replyComment']);  //点评回复的数量
		for($i=0;$i<$count;$i++){
			$comment['partComment'][] = $comment['replyComment'][$i];
			if($i>=9) break;
		}
		//END
		if($comment['authorid']) {
			$commentcount[$comment['pid']]++;
		}
		if(count($comments[$comment['pid']]) < $_G['setting']['commentnumber'] && $comment['authorid']) {
			$comment['avatar'] = avatar($comment['authorid'], 'small');
			$comment['dateline'] = dgmdate($comment['dateline'], 'u');
			//向点评表中添加数据的时候对内容做过过滤，下边做下两行的修改
			//$comments[$comment['pid']][] = str_replace(array('[b]', '[/b]', '[/color]'), array('<b>', '</b>', '</font>'), preg_replace("/\[color=([#\w]+?)\]/i", "<font color=\"\\1\">", $comment));
			$comments[$comment['pid']][] = $comment;
		}
		if(!$comment['authorid']) {
			$cic = 0;
			$totalcomment[$comment['pid']] = preg_replace('/<i>([\.\d]+)<\/i>/e', "'<i class=\"cmstarv\" style=\"background-position:20px -'.(intval(\\1) * 16).'px\">'.sprintf('%1.1f', \\1).'</i>'.(\$cic++ % 2 ? '<br />' : '');", $comment['comment']);
		}
	}
}

if($_G['forum_attachpids'] != '-1' && !$_G['gp_archiver']) {
	require_once libfile('function/attachment');
	if(is_array($threadsortshow) && !empty($threadsortshow['sortaids'])) {
		$skipaids = $threadsortshow['sortaids'];
	}
	parseattach($_G['forum_attachpids'], $_G['forum_attachtags'], $postlist, $skipaids);
}

if(empty($postlist)) {
	showmessage('undefined_action', NULL);
} else {
	foreach($postlist as $pid => $post) {
		$postlist[$pid]['message'] = preg_replace("/\[attach\]\d+\[\/attach\]/i", '', $postlist[$pid]['message']);
        /*增加，将用户的外站地址中，本站的前端地址换成附件 by JiangHong 2012-12-06*/
        $needreplace = array("http://bbs.8264.com/data/attachment/","http://www.8264.com/data/attachment/","http://u.8264.com/data/attachment/");
        $postlist[$pid]['message'] = str_replace($needreplace,$_G['config']['web']['attach'],$postlist[$pid]['message']);
        /*结束*/
		if($_G['fid']==$_G['config']['fids']['produce']){
			$postlist[$pid]['message'] = preg_replace('/<i[^>]*?>.*?<\/i>/is'," ",$postlist[$pid]['message']);
		}
	}
}

$module_cache = "brand";
$cacheindex = $forumOption->get_cache_index($_G['tid'],$module_cache);
$dzty_on =0;
if($cacheindex){
    $articles_result = $forumOption->get_info_by_index("articles",$cacheindex);
    $zb_result = $forumOption->get_info_by_index("zb",$cacheindex);
    if($dzty_on==1){$dzty_result = $forumOption->get_info_by_index("dzty",$cacheindex);}
    $topics_result = $forumOption->get_info_by_index("topics",$cacheindex);
    $blogs_result = $forumOption->get_info_by_index("blogs",$cacheindex);
    $photos_result = $forumOption->get_info_by_index("photos",$cacheindex);

}
if($_G['gp_archiver']) {
	include loadarchiver('forum/viewthread');
	exit();
}

$_G['forum_thread']['heatlevel'] = $_G['forum_thread']['recommendlevel'] = 0;
if($_G['setting']['heatthread']['iconlevels']) {
	foreach($_G['setting']['heatthread']['iconlevels'] as $k => $i) {
		if($_G['forum_thread']['heats'] > $i) {
			$_G['forum_thread']['heatlevel'] = $k + 1;
			break;
		}
	}
}

if(!empty($_G['setting']['recommendthread']['status']) && $_G['forum_thread']['recommends']) {
	foreach($_G['setting']['recommendthread']['iconlevels'] as $k => $i) {
		if($_G['forum_thread']['recommends'] > $i) {
			$_G['forum_thread']['recommendlevel'] = $k+1;
			break;
		}
	}
}

$allowblockrecommend = $_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock'];
$allowpostarticle = $_G['group']['allowmanagearticle'] || $_G['group']['allowauthorizedarticle'];
$allowpusharticle = empty($_G['forum_thread']['special']) && empty($_G['forum_thread']['sortid']) && !$_G['forum_thread']['pushedaid'];
if($_G['forum_thread']['displayorder'] != -4) {
	$modmenu = array(
		'thread' => $_G['forum']['ismoderator'] || $allowblockrecommend || $allowpusharticle && $allowpostarticle,
		'post' => $_G['forum']['ismoderator'] && ($_G['group']['allowwarnpost'] || $_G['group']['allowbanpost'] || $_G['group']['allowdelpost'] || $_G['group']['allowstickreply']) || $_G['forum_thread']['pushedaid'] && $allowpostarticle
	);
} else {
	$modmenu = array();
}
//----------------图片浏览方式--------------
$forum_pic_count_attachment = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_attachment')." WHERE tid='$_G[tid]'");

$forum_pic_count = $forum_pic_count_attachment + $forum_pic_count_photo;

$_G['forum_pic_count'] = 5;

if($forum_pic_count >= $_G['forum_pic_count']){
	$_G['forum_scan_way_button'] = 1;
}
$pic_postlist = array();

if($_G['forum_scan_way'] == 'pic'){//图片模式
	$navtitle = '[图片版]'.$navtitle;
	$query = DB::query("SELECT aid,remote,attachment,serverid FROM ".DB::table('forum_attachment')." WHERE tid='$_G[tid]' ORDER BY dateline LIMIT 0,15");
	if(file_exists(DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php")){
		require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
		$attach_server = new attachserver;
		$attachserverlist = $attach_server->get_server_domain('all', '*');
	}
	while($row = DB::fetch($query)){
		$attach = array();
		$attach['url'] = ($row['remote'] ? $_G['setting']['ftp']['attachurl'] : ($row['serverid'] > 0 ? 'http://'.$attachserverlist[$row['serverid']]['name'].'/' : $_G['setting']['attachurl'])).'forum/';
		// $pic_key = getforumimg($row['aid'], 0, 100, 100, '2');
		$pic_key = getimagethumb(100 ,100 ,2 ,'forum/'.$row['attachment'], $row['aid'], $row['serverid']);
		$tmpstr = '';
		if ( is_array( $attachserverlist[$row['serverid']]['api'] ) ) {
			if( $attachserverlist[$row['serverid']]['api']['class'] && is_object( $attachserverlist[$row['serverid']]['api']['class'] ) ) {
				$_callback = array( $attachserverlist[$row['serverid']]['api']['class'], $attachserverlist[$row['serverid']]['api']['function'] );
			}else{
				$_callback = $attachserverlist[$row['serverid']]['api']['function'];
			}
			$tmpstr = call_user_func_array( $_callback, array( 'forum', true, true, true ));
		}
		$pic_postlist[$pic_key] = $attach['url'].$row['attachment'] . $tmpstr;
	}
	include template('diy:forum/viewthread_pic');
	exit;
}
//-------------------------------------------

//为百分百科技调用数据 at 2013-3-12 by zhanghongliang
$firstpic = DB::fetch_first("SELECT aid,remote,attachment,serverid FROM ".DB::table('forum_attachment')." WHERE tid='$_G[tid]' ORDER BY dateline LIMIT 0,1");
if(file_exists(DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php")){
	require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
	$attach_server = new attachserver;
	$attachserverlist = $attach_server->get_server_domain('all');
	$attach = ($firstpic['remote'] ? $_G['setting']['ftp']['attachurl'] : ($firstpic['serverid'] > 0 ? 'http://'.$attachserverlist[$firstpic['serverid']].'/' : $_G['setting']['attachurl'])).'forum/';
	$firstpic['url'] = $attach.$firstpic['attachment'];
}
//end

if(empty($_G['gp_viewpid'])) {
	$sufix = '';
	if($_G['gp_from'] == 'portal') {
		$_G['disabledwidthauto'] = 1;

		$sufix = '_portal';
		if ($_GET['type'] == 1) {
			$sufix = '_article';
		}
		$post = &$postlist[$_G['forum_firstpid']];
	}
	if($_G['inajax']) {
		include template('common/header_ajax');
		$sufix = '_from_node';
	}

	//此处代码做了修改
	if (isset($forumOption)) {
		include $forumOption->hookScript2($sufix);
	} else {
		// 新老模板切换 lxp 20131219
		if($_G['newtpl'] && !$sufix){
			include template('diy:forum/viewthread'.$sufix.'_2014:'.$_G['fid']);
		} else {
			include template('diy:forum/viewthread'.$sufix.':'.$_G['fid']);
		}
	}
	//此处代码做了修改
	if($_G['inajax']) {
		include template('common/footer_ajax');
	}
} else {
	$_G['setting']['admode'] = 0;
	$post = $postlist[$_G['gp_viewpid']];
	if($rushreply && !empty($_G['gp_viewpid'])) {
		$post['number'] = DB::result_first("SELECT position FROM ".DB::table('forum_postposition')." WHERE pid='$_G[gp_viewpid]'");
	} else {
		$post['number'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$post[tid]' AND dateline<='$post[dbdateline]' " . getSlaveID());
	}
	include template('common/header_ajax');
	//此处代码做了修改
	if($_G['fid']==$_G['config']['fids']['produce']){
	   hookscriptoutput('viewthreadbrand');
	}elseif($_G['fid']==421){
	   hookscriptoutput('viewthreadstore');
	}elseif($_G['fid']==$_G['config']['fids']['zbfx']){
	   hookscriptoutput('viewthreadproduce');
	}elseif($_G['fid']==$_G['config']['fids']['mountain']&&$_G['uid']==1){
	   hookscriptoutput('viewthreadmountion');
	}else{
	   hookscriptoutput('viewthread');
	}
	//此处代码做了修改
	$postcount = 0;
	if($_G['gp_from']) {
		include template('forum/viewthread_from_node');
	} else {
		//此处代码做了修改
		if (isset($forumOption)) {
			include $forumOption->hookScript3();
		} else {

			include template('forum/viewthread_node');
		}
	   //上面代码做了修改
	}
	include template('common/footer_ajax');
}
if($_G['fid'] != $_G['config']['fids']['zbfx'] && !$_G['newtpl']){
	include DISCUZ_ROOT."./source/plugin/topic_manager/pic_auto.php";
}

function viewthread_updateviews() {
	global $_G, $do, $threadtable;
	/**声明redis**/
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6381);
	/**结束**/
	if($_G['setting']['delayviewcount'] == 1 || $_G['setting']['delayviewcount'] == 3) {
		//$_G['forum_logfile'] = './data/cache/forum_threadviews_'.intval(getgpc('config/server/id')).'.log';
		if(substr(TIMESTAMP, -2) == '00' || $_G['uid'] == 1){
			require_once libfile('function/misc');
			//updateviews($threadtable, 'tid', 'views', $_G['forum_logfile']);
			updateviews_redis($threadtable, 'tid', 'views', 'viewthread', false);
		}
		/**将帖子点击存入缓存中**/
		if($myredis->connected){
			$myredis->obj->hincrby('viewthread_number',$_G['tid'],1);
            if($_G['uid'] == 1){
            	for($_i = 0; $_i <= 300; $_i++){
		        	$_re = $myredis->obj->lpop('viewthread_queue_watting');
		        	if($_re){
		        		$_re = unserialize($_re);
		        		if($_re['tid'] > 0 && $_re['views'] > 0){
		        			$myredis->obj->hincrby('viewthread_number', $_re['tid'], $_re['views']);
		        		}
		        	}else{
		        		break;
		        	}
		        }
            }
		}else{
            DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
		}
		/**结束**/
		/*if(@$fp = fopen(DISCUZ_ROOT.$_G['forum_logfile'], 'a')) {
			fwrite($fp, "$_G[tid]\n");
			fclose($fp);
		} elseif($adminid == 1) {
			showmessage('view_log_invalid', '', array('logfile' => $_G['forum_logfile']));
		}*/
	} else {
		DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
	}
}

function viewthread_procpost($post, $lastvisit, $ordertype, $special = 0) {
	global $_G;

	if(!$_G['forum_newpostanchor'] && $post['dateline'] > $lastvisit) {
		$post['newpostanchor'] = '<a name="newpost"></a>';
		$_G['forum_newpostanchor'] = 1;
	} else {
		$post['newpostanchor'] = '';
	}

	$post['lastpostanchor'] = ($ordertype != 1 && $_G['forum_numpost'] == $_G['forum_thread']['replies']) || ($ordertype == 1 && $_G['forum_numpost'] == $_G['forum_thread']['replies'] + 2) ? '<a name="lastpost"></a>' : '';
	if($_G['forum_pagebydesc']) {
		if($ordertype != 1) {
			$post['number'] = $_G['forum_numpost'] + $_G['forum_ppp2']--;
		} else {
			$post['number'] = $post['first'] == 1 ? 1 : $_G['forum_numpost'] - $_G['forum_ppp2']--;
		}
	} else {
		if($ordertype != 1) {
			$post['number'] = ++$_G['forum_numpost'];
		} else {
			$post['number'] = $post['first'] == 1 ? 1 : --$_G['forum_numpost'];
		}
	}

	$_G['forum_postcount']++;

	$post['dbdateline'] = $post['dateline'];
	$post['dateline'] = dgmdate($post['dateline'], 'u');
	$post['groupid'] = $_G['cache']['usergroups'][$post['groupid']] ? $post['groupid'] : 7;

	if($post['username']) {

		$_G['forum_onlineauthors'][] = $post['authorid'];
		$post['usernameenc'] = rawurlencode($post['username']);
		$post['readaccess'] = $_G['cache']['usergroups'][$post['groupid']]['readaccess'];
		if($_G['cache']['usergroups'][$post['groupid']]['userstatusby'] == 1) {
			$post['authortitle'] = $_G['cache']['usergroups'][$post['groupid']]['grouptitle'];
			$post['stars'] = $_G['cache']['usergroups'][$post['groupid']]['stars'];
		}
		$post['upgradecredit'] = false;
		if($_G['cache']['usergroups'][$post['groupid']]['type'] == 'member' && $_G['cache']['usergroups'][$post['groupid']]['creditslower'] != 999999999) {
			$post['upgradecredit'] = $_G['cache']['usergroups'][$post['groupid']]['creditslower'] - $post['credits'];
		}

		$post['taobaoas'] = addslashes($post['taobao']);
		$post['regdate'] = dgmdate($post['regdate'], 'd');
		$post['lastdate'] = dgmdate($post['lastactivity'], 'd');

		$post['authoras'] = !$post['anonymous'] ? ' '.addslashes($post['author']) : '';

		if($post['medals']) {
			loadcache('medals');
			foreach($post['medals'] = explode("\t", $post['medals']) as $key => $medalid) {
				list($medalid, $medalexpiration) = explode("|", $medalid);
				if(isset($_G['cache']['medals'][$medalid]) && (!$medalexpiration || $medalexpiration > TIMESTAMP)) {
					$post['medals'][$key] = $_G['cache']['medals'][$medalid];
				} else {
					unset($post['medals'][$key]);
				}
			}
		}

		$post['avatar'] = avatar($post['authorid']);
		$post['groupicon'] = $post['avatar'] ? g_icon($post['groupid'], 1) : '';
		$post['banned'] = $post['status'] & 1;
		$post['warned'] = ($post['status'] & 2) >> 1;

	} else {
		if(!$post['authorid']) {
			$post['useip'] = substr($post['useip'], 0, strrpos($post['useip'], '.')).'.x';
		}
	}
	$post['attachments'] = array();
	$post['imagelist'] = $post['attachlist'] = '';

	if($post['attachment']) {
		if($_G['group']['allowgetattach']) {
			$_G['forum_attachpids'] .= ",$post[pid]";
			$post['attachment'] = 0;
			if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $post['message'], $matchaids)) {
				$_G['forum_attachtags'][$post['pid']] = $matchaids[1];
			}
		} else {
			$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
		}
	}

	$_G['forum_ratelogpid'] .= ($_G['setting']['ratelogrecord'] && $post['ratetimes']) ? ','.$post['pid'] : '';
	if($_G['setting']['commentnumber'] && ($post['first'] && $_G['setting']['commentfirstpost'] || !$post['first'])) {
		$_G['forum_commonpid'] .= $post['comment'] ? ','.$post['pid'] : '';
	}
	$post['allowcomment'] = $_G['setting']['commentnumber'] && ($_G['setting']['commentpostself'] || $post['authorid'] != $_G['uid']) &&
		($post['first'] && $_G['setting']['commentfirstpost'] && in_array($_G['group']['allowcommentpost'], array(1, 3)) ||
		(!$post['first'] && in_array($_G['group']['allowcommentpost'], array(2, 3))));
	$_G['forum']['allowbbcode'] = $_G['forum']['allowbbcode'] ? -$post['groupid'] : 0;
	$post['signature'] = $post['usesig'] ? ($_G['setting']['sigviewcond'] ? (strlen($post['message']) > $_G['setting']['sigviewcond'] ? $post['signature'] : '') : $post['signature']) : '';

	if(!$_G['gp_archiver']) {
		// 有修改  20110913 限定未登录时图片大小(2011 12 7二次次修改)
		if($_G['fid']==$_G['config']['fids']['zbfx']) {

		}else {
			include_once DISCUZ_ROOT.'./source/plugin/forumoption/include.php';
			global $forumOption;
			if(!$_G['uid'] && $forumOption && $forumOption->getSetting('isSmallPic')){
				$aa = "/\[img\=[0-9]+\,[0-9]+\]/";
				$bb = "[img]";
				$cc = "[img=80,0]";
				$post['message'] = preg_replace($aa, $bb, $post['message']);
				$post['message'] = str_replace($bb, $cc, $post['message']);
			}
		}
		//只对网络图片起作用
		$post['message'] = str_replace('http://image.8264.com/album/', 'http://image1.8264.com/album/', $post['message']);
		$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], $post['htmlon'] & 1, $_G['forum']['allowsmilies'], $_G['forum']['allowbbcode'], ($_G['forum']['allowimgcode'] && $_G['setting']['showimages'] ? 1 : 0), $_G['forum']['allowhtml'], ($_G['forum']['jammer'] && $post['authorid'] != $_G['uid'] ? 1 : 0), 0, $post['authorid'], $_G['forum']['allowmediacode'], $post['pid']);
		/*论坛主题添加关键字  11-12-26 15:20 by MengJin */
		if ($post['first'] == 1) {
			if (file_exists(DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php')) {
				require_once DISCUZ_ROOT.'./source/plugin/articlekeywords/include.php';
				$articleKeywords = new ArticleKeywords();
				$post['message'] = $articleKeywords->parseArticle($post['message']);
			}
		}
		/*论坛主题添加关键字  11-12-26 15:20 by MengJin */
	}

	//若是AA相约板块，则对message进行处理
	if ($post['fid'] == 161) {
		if ($post['first']) {
			$_G["isshowcontact"] = true;
			if (!$_G['uid']) {
				$_G["isshowcontact"] = false;//未登录
			} else {
				preg_match("/\[contact\](.+)\[\/contact\]/isU", $post['message'], $matA);
				if ($matA[1]) {
					$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_post')." WHERE authorid={$_G['uid']} and tid={$post['tid']} and invisible=0" . getSlaveID());
					$_G["isshowcontact"] = $count > 0 ? true : false;
				} else {
					$_G["isshowcontact"] = false;//不包含[contact](.+)[/contact]
				}
			}
		}

		if ($_G["isshowcontact"]) {
			$post['message'] = preg_replace("/\[contact\](.+)\[\/contact\]/isU", '$1', $post['message']);
		} else {
			$post['message'] = preg_replace("/\[contact\](.+)\[\/contact\]/isU", '******(联系方式回复可见)', $post['message']);
		}

	}

	$_G['forum_firstpid'] = intval($_G['forum_firstpid']);
	$post['custominfo'] = viewthread_custominfo($post);

	$post['mutual'] = empty($_G['uid']) || ($_G['uid'] == $post['authorid']) ||  empty($post['first']) ? 0 : followed_by_me($_G['uid'], $post['authorid']);

	//新的活动内容显示
	if ($post['first'] == 1) {
		$post['activitymessage'] = explode('[----]', $post['message']);
		if (count($post['activitymessage']) > 1) {
			$post['message'] = '';
			$arrTitle 		 = array('行程介绍', '费用装备', '其他');
			$arrTitleClass   = array('tTrip', 'tPrice', 'tNotice');
			foreach ($post['activitymessage'] as $k=>$v) {
				if ($k > 2) {break;}
				if ($v == '暂无内容') {continue;}
				$post['message'] .= '<div class="activitymessage">';
				$post['message'] .= "<h3><i class='ui-title-icon ui-{$arrTitleClass[$k]}-icon'></i>{$arrTitle[$k]}</h3><span class='dotted-line'></span>";
				$post['message'] .= "<p class='message'>{$v}</p>";
				$post['message'] .= '</div>';
			}
		}
	}

	return $post;
}

function viewthread_loadcache() {
	global $_G;
	$_G['forum']['livedays'] = ceil((TIMESTAMP - $_G['forum']['dateline']) / 86400);
	$_G['forum']['lastpostdays'] = ceil((TIMESTAMP - $_G['forum']['lastthreadpost']) / 86400);
	$threadcachemark = 100 - (
	$_G['forum']['displayorder'] * 15 +
	$_G['forum']['digest'] * 10 +
	min($_G['forum']['views'] / max($_G['forum']['livedays'], 10) * 2, 50) +
	max(-10, (15 - $_G['forum']['lastpostdays'])) +
	min($_G['forum']['replies'] / $_G['setting']['postperpage'] * 1.5, 15));
	if($threadcachemark < $_G['forum']['threadcaches']) {

		$threadcache = getcacheinfo($_G['tid']);
		/*if(TIMESTAMP - $threadcache['filemtime'] > $_G['setting']['cachethreadlife']) {
			@unlink($threadcache['filename']);
			define('CACHE_FILE', $threadcache['filename']);
		} else {
			readfile($threadcache['filename']);*/
		$cache_content = memory_redis('get', $threadcache['filename'], '', '', 6376);
		if($cache_content) {
			echo $cache_content;
			viewthread_updateviews();
			$_G['setting']['debug'] && debuginfo();
			$_G['setting']['debug'] ? die('<script type="text/javascript">document.getElementById("debuginfo").innerHTML = " '.($_G['setting']['debug'] ? 'Updated at '.gmdate("H:i:s", $threadcache['filemtime'] + 3600 * 8).', Processed in '.$debuginfo['time'].' second(s), '.$debuginfo['queries'].' Queries'.($_G['gzipcompress'] ? ', Gzip enabled' : '') : '').'";</script>') : die();
		}else {
			define('CACHE_FILE', $threadcache['filename']);
		}
	}
}

function viewthread_lastmod() {
	global $_G, $threadtable;
	if($lastmod = DB::fetch_first("SELECT uid AS moduid, username AS modusername, dateline AS moddateline, action AS modaction, magicid, stamp
		FROM ".DB::table('forum_threadmod')."
		WHERE tid='$_G[tid]' ORDER BY dateline DESC LIMIT 1")) {
		$modactioncode = lang('forum/modaction');
		$lastmod['modusername'] = $lastmod['modusername'] ? $lastmod['modusername'] : 'System';
		$lastmod['moddateline'] = dgmdate($lastmod['moddateline'], 'u');
		if($modactioncode[$lastmod['modaction']]) {
			$lastmod['modaction'] = $modactioncode[$lastmod['modaction']].($lastmod['modaction'] != 'SPA' ? '' : ' '.$_G['cache']['stamps'][$lastmod['stamp']]['text']);
		} elseif(substr($lastmod['modaction'], 0, 1) == 'L' && preg_match('/L(\d\d)/', $lastmod['modaction'], $a)) {
			$lastmod['modaction'] = $modactioncode['SLA'].' '.$_G['cache']['stamps'][intval($a[1])]['text'];
		} else {
			$lastmod['modaction'] = '';
		}
		if($lastmod['magicid']) {
			loadcache('magics');
			$lastmod['magicname'] = $_G['cache']['magics'][$lastmod['magicid']]['name'];
		}
	} else {
		DB::query("UPDATE ".DB::table($threadtable)." SET moderated='0' WHERE tid='$_G[tid]'", 'UNBUFFERED');
	}
	return $lastmod;
}

function viewthread_custominfo($post) {
	global $_G;

	$types = array('left', 'menu');
	foreach($types as $type) {
		if(!is_array($_G['cache']['custominfo']['setting'][$type])) {
			continue;
		}
		$data = '';
		foreach($_G['cache']['custominfo']['setting'][$type] as $key => $order) {
			$v = '';
			if(substr($key, 0, 10) == 'extcredits') {
				$i = substr($key, 10);
				$extcredit = $_G['setting']['extcredits'][$i];
				$v = '<dt>'.($extcredit['img'] ? $extcredit['img'].' ' : '').$extcredit['title'].'</dt><dd>'.$post['extcredits'.$i].' '.$extcredit['unit'].'&nbsp;</dd>';
			} elseif(substr($key, 0, 6) == 'field_') {
				require_once libfile('function/profile');
				$v = profile_show(substr($key, 6), $post);
				if($v) {
					$v = '<dt>'.$_G['cache']['custominfo']['profile'][$key][0].'</dt><dd>'.$v.'&nbsp;</dd>';
				}
			} else {
				switch($key) {
					case 'uid': $v = $post['uid'];break;
					case 'posts': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=thread&type=reply&view=me&from=space" target="_blank">'.$post['posts'].'</a>';break;
					case 'threads': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=thread&type=thread&view=me&from=space" target="_blank">'.$post['threads'].'</a>';break;
					case 'doings': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=doing&view=me&from=space" target="_blank">'.$post['doings'].'</a>';break;
					case 'blogs': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=blog&view=me&from=space" target="_blank">'.$post['blogs'].'</a>';break;
					case 'albums': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=album&view=me&from=space" target="_blank">'.$post['albums'].'</a>';break;
					case 'sharings': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=share&view=me&from=space" target="_blank">'.$post['sharings'].'</a>';break;
					case 'friends': $v = '<a href="home.php?mod=space&uid='.$post['uid'].'&do=friend&view=me&from=space" target="_blank">'.$post['friends'].'</a>';break;
					case 'digest': $v = $post['digestposts'];break;
					case 'credits': $v = $post['credits'];break;
					case 'readperm': $v = $post['readaccess'];break;
					case 'regtime': $v = $post['regdate'];break;
					case 'lastdate': $v = $post['lastdate'];break;
					case 'oltime': $v = $post['oltime'].' '.lang('space', 'viewthread_userinfo_hour');break;
				}
				if($v !== '') {
					$v = '<dt>'.lang('space', 'viewthread_userinfo_'.$key).'</dt><dd>'.$v.'&nbsp;</dd>';
				}
			}
			$data .= $v;
		}
		$return[$type] = $data;
	}
	return $return;
}

function remaintime($time) {
	$days = intval($time / 86400);
	$time -= $days * 86400;
	$hours = intval($time / 3600);
	$time -= $hours * 3600;
	$minutes = intval($time / 60);
	$time -= $minutes * 60;
	$seconds = $time;
	return array((int)$days, (int)$hours, (int)$minutes, (int)$seconds);
}

function viewthread_is_search_referer() {
	$regex = "((http|https)\:\/\/)?";
	$regex .= "([a-z]*.)?(ask.com|yahoo.com|cn.yahoo.com|bing.com|baidu.com|soso.com|google.com|google.cn)(.[a-z]{2,3})?\/";
	if(preg_match("/^$regex/", $_SERVER['HTTP_REFERER'])) {
		return true;
	}
	return false;
}
?>
