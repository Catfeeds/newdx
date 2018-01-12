<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_forumdisplay.php 23437 2011-07-14 10:14:07Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');


//论坛首页设置猜你喜欢的模块
$fid =$_G['fid'];
recent_forum('set', $fid);
//论坛首页设置猜你喜欢的模块
$catlist = $forumlist = $sublist = $forumname = $collapseimg = $collapse = array();
$newindex = 1;
$_sql_fup = $newindex ? 'f.nfup as fup' : 'f.fup';
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
//echo $sql;
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



$forumOption->hookScript11();
urlthreetoone();//url三合一
if($_G['forum']['redirect']) {
	dheader("Location: {$_G[forum][redirect]}");
} elseif($_G['forum']['type'] == 'group') {
	dheader("Location: forum.php?gid=$_G[fid]");
} elseif(empty($_G['forum']['fid'])) {
	// showmessage('forum_nonexistence', NULL);
	header('HTTP/1.1 404 Not Found');
	header('Status: 404');
	exit;
}

$_G['action']['fid'] = $_G['fid'];

$_G['gp_specialtype'] = isset($_G['gp_specialtype']) ? $_G['gp_specialtype'] : '';
$_G['gp_dateline'] = isset($_G['gp_dateline']) ? intval($_G['gp_dateline']) : 0;
$_G['gp_digest'] = isset($_G['gp_digest']) ? 1 : '';
$_G['gp_archiveid'] = isset($_G['gp_archiveid']) ? intval($_G['gp_archiveid']) : 0;
$showoldetails = isset($_G['gp_showoldetails']) ? $_G['gp_showoldetails'] : '';
switch($showoldetails) {
	case 'no': dsetcookie('onlineforum', ''); break;
	case 'yes': dsetcookie('onlineforum', 1, 31536000); break;
}

$_G['forum']['name'] = strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name'];
$_G['forum']['extra'] = unserialize($_G['forum']['extra']);
if(!is_array($_G['forum']['extra'])) {
	$_G['forum']['extra'] = array();
}

$threadtable_info = !empty($_G['cache']['threadtable_info']) ? $_G['cache']['threadtable_info'] : array();
$forumarchive = array();
if($_G['forum']['archive']) {
	$query = DB::query("SELECT * FROM ".DB::table('forum_forum_threadtable')." WHERE fid='{$_G['fid']}'");
	while($archive = DB::fetch($query)) {
		$forumarchive[$archive['threadtableid']] = array(
			'displayname' => htmlspecialchars($threadtable_info[$archive['threadtableid']]['displayname']),
			'threads' => $archive['threads'],
			'posts' => $archive['posts'],
		);
		if(empty($forumarchive[$archive['threadtableid']]['displayname'])) {
			$forumarchive[$archive['threadtableid']]['displayname'] = lang('forum/template', 'forum_archive').' '.$archive['threadtableid'];
		}
	}
}

if($_G['forum']['type'] == 'forum') {
	if(empty($_G['gp_archiveid'])) {
		if($_G['forum']['fid']==$_G['config']['fids']['zbfx']){
			$navigation = '<em>&rsaquo;</em> <a href="'.$_G['config']['web']['forum'].'">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="'.$_G['config']['web']['portal'].'zb">'.$_G['forum']['name'].'</a>';
			$forumnameurl = $_G['config']['web']['portal'] . 'zb';
		}elseif($_G['forum']['fid']==$_G['config']['fids']['dianpu']){
			$navigation = '<em>&rsaquo;</em> <a href="'.$_G['config']['web']['forum'].'">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="'.$_G['config']['web']['portal'].'dianpu">'.$_G['forum']['name'].'</a>';
			$forumnameurl = $_G['config']['web']['portal'] . 'dianpu';
		}else{
			$dm = $forumOption->getdomainbyfid($_G['forum']['fid']);
			if($dm){
				$navigation = '<em>&rsaquo;</em> <a class="xlsj" href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="http://'.$dm.'.'.$_G['setting']['domain']['root']['forum'].'/">'.$_G['forum']['name'].'</a>';
				$forumnameurl = 'http://' . $dm . '.' . $_G['setting']['domain']['root']['forum'] . '/';
			}else{
				$navigation = '<em>&rsaquo;</em> <a class="xlsj" href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$_G['forum']['fid'].'">'.$_G['forum']['name'].'</a>';
				$forumnameurl = 'forum.php?mod=forumdisplay&fid=' . $_G['forum']['fid'];
			}
		}
	} else {
		$navigation = '<em>&rsaquo;</em> <a class="xlsj" href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> '.'<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'">'.$_G['forum']['name'].'</a> <em>&rsaquo;</em> '.$forumarchive[$_G['gp_archiveid']]['displayname'];
		$forumnameurl = 'forum.php?mod=forumdisplay&fid=' . $_G['fid'];
	}
	$navtitle = $_G['forum']['name'];
} else {
	$forumup = $_G['forum']['status'] == 3 ? '' : $_G['cache']['forums'][$_G['forum']['fup']]['name'];
	$forumnameurl = 'forum.php?mod=forumdisplay&fid=' . $_G['forum']['fup'];
	if(empty($_G['gp_archiveid'])) {
		$navigation = '<em>&rsaquo;</em> <a href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$_G['forum']['fup'].'">'.$forumup.'</a> <em>&rsaquo;</em> '.$_G['forum']['name'];
	} else {
		$navigation = '<em>&rsaquo;</em> <a href="./">'.$_G['setting']['navs'][2]['navname'].'</a> <em>&rsaquo;</em> <a href="forum.php?mod=forumdisplay&fid='.$_G['forum']['fup'].'">'.$forumup.'</a> <em>&rsaquo;</em> '.'<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'">'.$_G['forum']['name'].'</a> <em>&rsaquo;</em> '.$forumarchive[$_G['gp_archiveid']]['displayname'];
	}
	$navtitle = $_G['forum']['name'].' - '.strip_tags($forumup);
}


$metakeywords = $_G['forum']['keywords'];
if(!$metakeywords) {
	$metakeywords = $_G['forum']['name'];
}
$metadescription = $_G['forum']['description_seo'];
if(!$metadescription) {
	$metadescription = $_G['forum']['name'];
}

$rssauth = $_G['rssauth'];
$rsshead = $_G['setting']['rssstatus'] ? ('<link rel="alternate" type="application/rss+xml" title="'.$_G['setting']['bbname'].' - '.$navtitle.'" href="'.$_G['siteurl'].'forum.php?mod=rss&fid='.$_G['fid'].'&amp;auth='.$rssauth."\" />\n") : '';
//$navtitle .= ' - ';
$metakeywords = !$_G['forum']['keywords'] ? $_G['forum']['name'] : $_G['forum']['keywords'];
$metadescription = !$_G['forum']['description_seo'] ? $_G['forum']['name'] : strip_tags($_G['forum']['description_seo']);

if($_G['forum']['status'] == 3) {
	$navtitle = $_G['forum']['name'].' - '.$_G['setting']['navs'][3]['navname'];
	$metakeywords = $_G['forum']['metakeywords'];
	$metadescription = $_G['forum']['description_seo'];
	$_G['seokeywords'] = $_G['setting']['seokeywords']['group'];
	$_G['seodescription'] = $_G['setting']['seodescription']['group'];
	$action = getgpc('action') ? $_G['gp_action'] : 'list';
	require_once libfile('function/group');
	$status = groupperm($_G['forum'], $_G['uid']);
	if($status == -1) {
		showmessage('forum_not_group', 'group.php');
	} elseif($status == 1) {
		showmessage('forum_group_status_off');
	} elseif($status == 2) {
		showmessage('forum_group_noallowed', 'forum.php?mod=group&fid='.$_G['fid']);
	} elseif($status == 3) {
		showmessage('forum_group_moderated', 'forum.php?mod=group&fid='.$_G['fid']);
	}
	$_G['forum']['icon'] = get_groupimg($_G['forum']['icon'], 'icon');
	$_G['grouptypeid'] = $_G['forum']['fup'];
	$_G['forum']['dateline'] = dgmdate($_G['forum']['dateline'], 'd');

	$groupnav = get_groupnav($_G['forum']);
	$onlinemember = grouponline($_G['fid']);
	$groupmanagers = $_G['forum']['moderators'];
	$groupcache = getgroupcache($_G['fid'], array('replies', 'views', 'digest', 'lastpost', 'ranking', 'activityuser', 'newuserlist'));
}
$_G['forum']['banner'] = get_forumimg($_G['forum']['banner']);
if($_G['forum']['viewperm'] && !forumperm($_G['forum']['viewperm']) && !$_G['forum']['allowview']) {
	showmessagenoperm('viewperm', $_G['fid'], $_G['forum']['formulaperm']);
} elseif($_G['forum']['formulaperm']) {
	formulaperm($_G['forum']['formulaperm']);
}
if($_G['forum']['password']) {
	if($_G['gp_action'] == 'pwverify') {
		if($_G['gp_pw'] != $_G['forum']['password']) {
			showmessage('forum_passwd_incorrect', NULL);
		} else {
			dsetcookie('fidpw'.$_G['fid'], $_G['gp_pw']);
			showmessage('forum_passwd_correct', "forum.php?mod=forumdisplay&fid=$_G[fid]");
		}
	} elseif($_G['forum']['password'] != $_G['cookie']['fidpw'.$_G['fid']]) {
		include template('forum/forumdisplay_passwd');
		exit();
	}
}

if(!isset($_G['cookie']['collapse']) || strpos($_G['cookie']['collapse'], 'forum_rules_'.$_G['fid']) === FALSE) {
	$collapse['forum_rules'] = '';
	$collapse['forum_rulesimg'] = 'no';
} else {
	$collapse['forum_rules'] = 'display: none';
	$collapse['forum_rulesimg'] = 'yes';
}

$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
$threadtable = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "forum_thread_{$_G['gp_archiveid']}" : 'forum_thread';
if($_G['setting']['allowmoderatingthread'] && $_G['uid']) {
	$threadmodcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table($threadtable)." WHERE fid='{$_G['fid']}' AND displayorder='-2' AND authorid='{$_G['uid']}'");
}

if($_G['forum']['modworks'] || $_G['forum']['modnewposts']) {
	$_G['forum']['modnewposts'] && $_G['forum']['modworks'] = 1;
	$modnum = $_G['group']['allowmodpost'] ? getcountofposts(DB::table('forum_post'), "invisible='-2' AND fid='$_G[fid]'") : 0;
	$modusernum = $_G['group']['allowmoduser'] ? DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_member_validate')." WHERE status='0'") : 0;
}

$optionadd = $filterurladd = $searchsorton = '';

$quicksearchlist = array();


if(!empty($_G['forum']['threadsorts']['types'])) {
	require_once libfile('function/threadsort');

	$showpic = intval($_G['gp_showpic']);
	$templatearray = $sortoptionarray = array();
	foreach($_G['forum']['threadsorts']['types'] as $stid => $sortname) {
		loadcache(array('threadsort_option_'.$stid, 'threadsort_template_'.$stid));
		$templatearray[$stid] = $_G['cache']['threadsort_template_'.$stid]['subject'];
		$sortoptionarray[$stid] = $_G['cache']['threadsort_option_'.$stid];
	}

	if(!empty($_G['forum']['threadsorts']['defaultshow']) && empty($_G['gp_sortid']) && empty($_G['gp_sortall'])) {
		$_G['gp_sortid'] = $_G['forum']['threadsorts']['defaultshow'];
		$filterurladd = '&amp;filter=sort';
	}

	$_G['gp_sortid'] = $_G['gp_sortid'] ? $_G['gp_sortid'] : $_G['gp_searchsortid'];
	if(isset($_G['gp_sortid']) && $_G['forum']['threadsorts']['types'][$_G['gp_sortid']]) {
		$searchsortoption = $sortoptionarray[$_G['gp_sortid']];
		$quicksearchlist = quicksearch($searchsortoption);
	}
}
/*
 * 增加版主处理2012-06-06 jianghong
 * $gp_manage:地方版块版主，设置不显示的版主将不在地方版块显示 mod=1
 * $gp_manage_part:地区版主，读取当前版块的地区版主 mod=0
 * $part_name:当前地区的名称
 * $bkname:识别当前是否为地方版块，如果为地方版块则截取版块中文，去掉前面字符。
 * 增加权限处理，判断当前是否为本区版主或者总版主，否则无权限。
 */
/*$part_name = $_G['forum']['threadtypes']['types'][$_G['gp_typeid']];
$gp_manage_part = ($_G['forum']['status'] != 3 && $_G['gp_typeid']) ? $forumOption->groupmanageroption($_G['action']['fid'],$_G['gp_typeid'],1):"";
$moderatedby_part = ($_G['forum']['status'] != 3 && $_G['gp_typeid']) ? moddisplay(implode("\t",array_intersect(explode("\t", $_G['forum']['moderators']),explode("\t", $gp_manage_part))), 'forumdisplay') : '';
$gp_manage = $forumOption->groupmanageroption($_G['action']['fid'],$_G['gp_typeid'],0);
$bkname = str_replace(array('『', '』', '□-', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'), '', $_G['forum']['name']);
//以上为新增2012-06-06 jianghong
if(!empty($_G['member']['username'])){
$is_manager_forumorpart = in_array($_G['member']['username'],explode("\t",$gp_manage_part)) ? 1 : 0;
$is_manager_forumorpart = (in_array($_G['member']['username'],explode("\t",$gp_manage)) || $_G['perm']['groupid']==1 || $_G['perm']['groupid']==2) ? 2 : $is_manager_forumorpart;
if($_G['perm']['groupid']!=1 && $_G['perm']['groupid']!=2 && !in_array($_G['member']['username'],explode("\t",$gp_manage)) && !in_array($_G['member']['username'],explode("	",$gp_manage_part))){
   $_G['forum']['ismoderator'] = 0;
}
if((in_array($_G['member']['username'],explode("\t",$gp_manage)) || in_array($_G['member']['username'],explode("\t",$gp_manage_part)))){
   $_G['forum']['ismoderator'] = 1;
}
}else{
    $is_manager_forumorpart = 9;//9表示其他版块
}
//新增，使用原先的版主排序顺序
$managers = array_intersect(explode("\t", $_G['forum']['moderators']), explode("\t", $gp_manage));
//dsetcookie('is_manager_forumorpart',$is_manager_forumorpart,300);
//增加过滤功能，来过滤某些字段
$fiter_setting = $forumOption->get_fiterkey_setting();
if($fiter_setting['on_off']==1){
$fiter_string = $forumOption->get_fiterkey();
$fiter_level = $fiter_setting['fiter_level'];
}*/
//*****以上代码为新增 2012-0611 jianghong*****
//$moderatedby = $_G['forum']['status'] != 3 ? moddisplay($gp_manage, 'forumdisplay') : '';//修改通过赋值来去掉设置不显示的版主 edit by jianghong 2012-06-06
$bkname = str_replace(array('『', '』', '□-A', '□-B', '□-C', '□-D', '□-E', '□-F', '□-G', '□-H', '□-I', '□-J', '□-K', '□-L', '□-M', '□-N', '□-O', '□-P', '□-Q', '□-R', '□-S', '□-T', '□-U', '□-V', '□-W', '□-X', '□-Y', '□-Z'), '', $_G['forum']['name']);
$moderatedby = $_G['forum']['status'] != 3 ? moddisplay($_G['forum']['moderators'], 'forumdisplay') : '';
if($_G['gp_typeid'] > 0) {
	$nowtype_moderator = DB::fetch_first("SELECT name, moderator_type, fatherid FROM " . DB::table('forum_threadclass') . " WHERE typeid = '{$_G[gp_typeid]}'");
	$nowtype_moderator['moderator_type'] = moddisplay($nowtype_moderator['moderator_type'], 'forumdisplay');
}
//$moderatedby = $_G['forum']['status'] != 3 ? moddisplay(implode("\t", $managers), 'forumdisplay') : '';
if($nowtype_moderator['fatherid'] > 0) {
	$fathertype_moderator = DB::fetch_first("SELECT name, moderator_type FROM " . DB::table('forum_threadclass') . " WHERE typeid = '{$nowtype_moderator[fatherid]}'");
	$fathertype_moderator['moderator_type'] = moddisplay($fathertype_moderator['moderator_type'], 'forumdisplay');
}
//if($_G['adminid'] == 1) echo '<pre>' . var_export($_G['forum']['threadtypes'], true) . '</pre>';
/**
 * @todo 此处新版分区展示，将不需要显示的子版块隐藏
 * @author JiangHong
 */
$thistypefatherid = $nowtype_moderator['fatherid'] > 0 ? $nowtype_moderator['fatherid'] : $_G['gp_typeid'];
$alldomainlist=$forumOption->getdomainbyfidandtypeid($_G['gp_fid']);
if(($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || $_G['forum']['threadsorts']) {
	foreach($_G['forum']['threadtypes']['types'] as $_k => $_v) {
		$allthreadsname[$_k] = $_G['forum']['threadtypes']['types'][$_k];
		if($_G['forum']['threadtypes']['fatherid'][$_k] > 0) {
			$_G['forum']['threadtypes']['childtypes'][$_G['forum']['threadtypes']['fatherid'][$_k]][$_k] = $_v;
			unset($_G['forum']['threadtypes']['types'][$_k]);
		}
		$_G['forum']['threadtypes']['url'][$_k] = $alldomainlist[$_k] ? "http://" . $alldomainlist[$_k] . '.' . $_G['config']['alldomain']['forum'] . ($_G['gp_archiveid'] ? '?archiveid=' . $_G['gp_archiveid'] : '') : $_G['config']['web']['forum'] . 'forum.php?mod=forumdisplay&fid=' . $_G['gp_fid'] . '&typeid=' . $_k . '&filter=typeid' . ($_G['gp_archiveid'] ? '&archiveid=' . $_G['gp_archiveid'] : '');
	}
}
/*结束*/
$_G['gp_highlight'] = empty($_G['gp_highlight']) ? '' : htmlspecialchars($_G['gp_highlight']);
if($_G['forum']['autoclose']) {
	$closedby = $_G['forum']['autoclose'] > 0 ? 'dateline' : 'lastpost';
	$_G['forum']['autoclose'] = abs($_G['forum']['autoclose']) * 86400;
}
$subexists = 0;
foreach($_G['cache']['forums'] as $sub) {
	if($sub['type'] == 'sub' && $sub['fup'] == $_G['fid'] && (!$_G['setting']['hideprivate'] || !$sub['viewperm'] || forumperm($sub['viewperm']) || strstr($sub['users'], "\t$_G[uid]\t"))) {
		if(!$sub['status']) {
			continue;
		}
		$subexists = 1;
		$sublist = array();
		$sql = !empty($_G['member']['accessmasks']) ? "SELECT f.fid, f.fup, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.domain, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.extra, ff.redirect, a.allowview FROM ".DB::table('forum_forum')." f
						LEFT JOIN ".DB::table('forum_forumfield')." ff ON ff.fid=f.fid
						LEFT JOIN ".DB::table('forum_access')." a ON a.uid='$_G[uid]' AND a.fid=f.fid
						WHERE fup='$_G[fid]' AND status>'0' AND type='sub' ORDER BY f.displayorder"
					: "SELECT f.fid, f.fup, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.domain, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.extra, ff.redirect FROM ".DB::table('forum_forum')." f
						LEFT JOIN ".DB::table('forum_forumfield')." ff USING(fid)
						WHERE f.fup='$_G[fid]' AND f.status>'0' AND f.type='sub' ORDER BY f.displayorder";
		$query = DB::query($sql);
		while($sub = DB::fetch($query)) {
			$sub['extra'] = unserialize($sub['extra']);
			if(!is_array($sub['extra'])) {
				$sub['extra'] = array();
			}
			if(forum($sub)) {
				$sub['orderid'] = count($sublist);
				$sublist[] = $sub;
			}
		}
		break;
	}
}

if(!empty($_G['gp_archiveid']) && in_array($_G['gp_archiveid'], $threadtableids)) {
	$subexists = 0;
}

if($subexists) {
	if($_G['forum']['forumcolumns']) {
		$_G['forum']['forumcolwidth'] = (floor(100 / $_G['forum']['forumcolumns']) - 0.1).'%';
		$_G['forum']['subscount'] = count($sublist);
		$_G['forum']['endrows'] = '';
		if($colspan = $_G['forum']['subscount'] % $_G['forum']['forumcolumns']) {
			while(($_G['forum']['forumcolumns'] - $colspan) > 0) {
				$_G['forum']['endrows'] .= '<td>&nbsp;</td>';
				$colspan ++;
			}
			$_G['forum']['endrows'] .= '</tr>';
		}
	}
	if(empty($_G['cookie']['collapse']) || strpos($_G['cookie']['collapse'], 'subforum_'.$_G['fid']) === FALSE) {
		$collapse['subforum'] = '';
		$collapseimg['subforum'] = 'collapsed_no.gif';
	} else {
		$collapse['subforum'] = 'display: none';
		$collapseimg['subforum'] = 'collapsed_yes.gif';
	}
}

$page = $_G['page'];
$subforumonly = $_G['forum']['simple'] & 1;
$simplestyle = !$_G['forum']['allowside'] || $page > 1 ? true : false;
if($page > 1) { $navtitle .= " - 第{$page}页"; }

if($subforumonly) {
	$_G['setting']['fastpost'] = false;
	$forummenu = '';
	if($_G['setting']['forumjump']) {
		$forummenu = forumselect(FALSE, 1);
	}
	//此处代码做了修改

	if($_G['gp_archiver']) {
		if (isset($forumOption)) {
			include $forumOption->hookScript6();
		} else {
			include loadarchiver('forum/forumdisplay');
		}
	} else {
		if (isset($forumOption)) {
			include $forumOption->hookScript9();
		} else {
			include template('diy:forum/forumdisplay:'.$_G['fid']);
		}
	}
	//上面代码做了修改
	exit();
}

$page = $_G['setting']['threadmaxpages'] && $page > $_G['setting']['threadmaxpages'] ? 1 : $page;
$start_limit = ($page - 1) * $_G['tpp'];
if($_G['forum']['modrecommend'] && $_G['forum']['modrecommend']['open']) {
	$_G['forum']['recommendlist'] = recommendupdate($_G['fid'], $_G['forum']['modrecommend'], '', 1);
}
$recommendgroups = array();
if($_G['forum']['status'] != 3) {
	loadcache('forumrecommend');
	$recommendgroups = $_G['cache']['forumrecommend'][$_G['fid']];
}
if(!$simplestyle || !$_G['forum']['allowside'] && $page == 1) {
	if($_G['cache']['announcements_forum']) {
		$announcement = $_G['cache']['announcements_forum'];
		$announcement['starttime'] = dgmdate($announcement['starttime'], 'd');
	} else {
		$announcement = NULL;
	}
}


$filteradd = $sortoptionurl = $sp = '';
$sorturladdarray = $selectadd = array();
$forumdisplayadd = array('orderby' => '');
$specialtype = array('poll' => 1, 'trade' => 2, 'reward' => 3, 'activity' => 4, 'debate' => 5);
$filterfield = array('digest', 'recommend', 'typeid', 'sortid', 'special', 'dateline', 'specialtype', 'author', 'reply', 'view', 'lastpost', 'heat', 'page', 'moderate');

foreach ($filterfield as $v) {
	$forumdisplayadd[$v] = '';
}
$filter = isset($_G['gp_filter']) && in_array($_G['gp_filter'], $filterfield) ? $_G['gp_filter'] : '';
if($filter) {
	$dm = $forumOption->getdomainbyfidandtypeid($_G['fid'],$_GET['typeid']);
	if($dm){
		// $_SERVER['QUERY_STRING'] = "?mod=forumdisplay&fid=".$_G['fid']."&filter=typeid&typeid=".$_GET['typeid']."";
		if(strpos($_SERVER['QUERY_STRING'],'&filter=') === false){
			$_SERVER['QUERY_STRING'] .= "&filter=typeid";
		}
		$_SERVER['QUERY_STRING'] .= "&typeid=".$_GET['typeid']."";

	}
	if($query_string = $_SERVER['QUERY_STRING']) {
		$query_string = substr($query_string, (strpos($query_string, "&") + 1));
		parse_str($query_string, $geturl);

		$geturl = daddslashes($geturl, 1);
		if($geturl && is_array($geturl)) {
			$issort = isset($_G['gp_sortid']) && isset($_G['forum']['threadsorts']['types'][$_G['gp_sortid']]) && $quicksearchlist ? TRUE : FALSE;
			$selectadd = $issort ? $geturl : array();
			foreach($filterfield as $option) {
				foreach($geturl as $field => $value) {
					if(in_array($field, $filterfield) && $option != $field && $field != 'page') {
						$forumdisplayadd[$option] .= '&'.$field.'='.rawurlencode($value);
					}
				}
				if($issort) {
					$sfilterfield = array_merge(array('filter', 'sortid', 'orderby', 'fid'), $filterfield);
					foreach($geturl as $soption => $value) {
						$forumdisplayadd[$soption] .= !in_array($soption, $sfilterfield) ? "&$soption=".rawurlencode($value) : '';
					}
				}
			}
			if($issort && is_array($quicksearchlist)) {
				foreach($quicksearchlist as $option) {
					$identifier = $option['identifier'];
					foreach($geturl as $option => $value) {
						$sorturladdarray[$identifier] .= !in_array($option, array('filter', 'sortid', 'orderby', 'fid', 'searchsort', $identifier)) ? "&amp;$option=$value" : '';
					}
				}
			}

			foreach($geturl as $field => $value) {
				if($field != 'page' && $field != 'fid') {
					$multiadd[] = $field.'='.rawurlencode($value);
					if(in_array($field, $filterfield)) {
						$filteradd .= $sp;
						if($field == 'digest') {
							$filteradd .= "AND digest>'0'";
						} elseif($field == 'recommend') {
							$filteradd .= "AND recommends>'".intval($_G['setting']['recommendthread']['iconlevels'][0])."'";
						} elseif($field == 'specialtype') {
							$filteradd .= "AND special='$specialtype[$value]'";
						} elseif($field == 'dateline') {
							$filteradd .= $value ? "AND lastpost>='".(TIMESTAMP - $value)."'" : '';
						} elseif($field == 'sortid') {
							$filteradd .= "AND $field='$value'";
						} elseif($field == 'typeid') {
							$filteradd .= $thistypefatherid == $value ? "AND typeid IN('$value','" . implode("','", array_keys($_G['forum']['threadtypes']['childtypes'][$thistypefatherid])) . "') AND typeid != 0" : "AND typeid='$value'";
						}
						$sp = ' ';
					}
				}
			}
		}
	}
	$simplestyle = true;
}
if(!empty($_G['gp_orderby']) && in_array($_G['gp_orderby'], array('lastpost', 'dateline', 'replies', 'views', 'recommends', 'heats', 'digest'))) {
	$forumdisplayadd['orderby'] .= '&orderby='.$_G['gp_orderby'];
} else {
	//此处判断按热门排序
	$_G['gp_orderby'] = isset($_G['cache']['forums'][$_G['fid']]['orderby']) ? $_G['cache']['forums'][$_G['fid']]['orderby'] : 'lastpost';
	if (isset($forumOption)) {
		$forumOption->hookScript7();
	}
}

if(!empty($_G['gp_ascdesc']) && in_array($ascdesc, array('ASC', 'DESC'))) {
	$forumdisplayadd['ascdesc'] .= '&ascdesc='.$_G['gp_ascdesc'];
} else {
	$_G['gp_ascdesc'] = isset($_G['cache']['forums'][$_G['fid']]['ascdesc']) ? $_G['cache']['forums'][$_G['fid']]['ascdesc'] : 'DESC';
}

$check = array();
$check[$filter] = $check[$_G['gp_orderby']] = $check[$_G['gp_ascdesc']] = 'selected="selected"';

if(($_G['forum']['status'] != 3 && $_G['forum']['allowside']) || !empty($_G['forum']['threadsorts']['templatelist'])) {
	updatesession();
	$onlinenum = getonlinenum($_G['fid']);
	if(!IS_ROBOT && ($_G['setting']['whosonlinestatus'] == 2 || $_G['setting']['whosonlinestatus'] == 3)) {
		$_G['setting']['whosonlinestatus'] = 1;
		$detailstatus = $showoldetails == 'yes' || (((!isset($_G['cookie']['onlineforum']) && !$_G['setting']['whosonline_contract']) || $_G['cookie']['onlineforum']) && !$showoldetails);

		if($detailstatus) {
			$actioncode = lang('forum/action');
			$whosonline = array();
			$forumname = strip_tags($_G['forum']['name']);
			$query = DB::query("SELECT uid, groupid, username, invisible, lastactivity FROM ".DB::table('common_session')." WHERE uid>'0' AND fid='$_G[fid]' AND invisible='0' ORDER BY lastactivity DESC LIMIT 12");
			$_G['setting']['whosonlinestatus'] = 1;
			while($online = DB::fetch($query)) {
				if($online['uid']) {
					$online['icon'] = isset($_G['cache']['onlinelist'][$online['groupid']]) ? $_G['cache']['onlinelist'][$online['groupid']] : $_G['cache']['onlinelist'][0];
				} else {
					$online['icon'] = $_G['cache']['onlinelist'][7];
					$online['username'] = $_G['cache']['onlinelist']['guest'];
				}
				$online['lastactivity'] = dgmdate($online['lastactivity'], 't');
				$whosonline[] = $online;
			}
			unset($online);
		}
	} else {
		$_G['setting']['whosonlinestatus'] = 0;
	}
}

$forumdisplayadd['page'] = '';
if($_G['forum']['threadsorts']['types'] && $sortoptionarray && ($_G['gp_searchoption'] || $_G['gp_searchsort'])) {
	$sortid = intval($_G['gp_sortid']);

	if($_G['gp_searchoption']){
		$forumdisplayadd['page'] = '&sortid='.$sortid;
		foreach($_G['gp_searchoption'] as $optionid => $option) {
			$identifier = $sortoptionarray[$sortid][$optionid]['identifier'];
			$forumdisplayadd['page'] .= $option['value'] ? "&searchoption[$optionid][value]=$option[value]&searchoption[$optionid][type]=$option[type]" : '';
		}
	}

	if($searchsorttids = sortsearch($_G['gp_sortid'], $sortoptionarray, $_G['gp_searchoption'], $selectadd, $_G['fid'])) {
		$filteradd .= "AND t.tid IN (".dimplode($searchsorttids).")";
	}
}

if(empty($filter) && empty($_G['gp_sortid']) && empty($_G['gp_archiveid']) && empty($_G['forum']['archive'])) {
	$_G['forum_threadcount'] = $_G['forum']['threads'];


} elseif(!$_G['gp_moderate']) {
	//解决精华帖查看效率，临时方案
	//TODO X2.0 将结果缓存，毕竟精华帖是少数
	$indexadd = '';
	if(strexists($filteradd, "t.digest>'0'")) {
		$indexadd = " FORCE INDEX (digest) ";
	}
	$_G['forum_threadcount'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($threadtable)." t $indexadd WHERE t.fid='{$_G['fid']}' $filteradd AND t.displayorder>='0'");
}
$thisgid = $_G['forum']['type'] == 'forum' ? $_G['forum']['fup'] : (!empty($_G['cache']['forums'][$_G['forum']['fup']]['fup']) ? $_G['cache']['forums'][$_G['forum']['fup']]['fup'] : 0);
$forumstickycount = $stickycount = $stickytids = 0;


if($_G['setting']['globalstick'] && $_G['forum']['allowglobalstick']) {
	$stickytids = $_G['cache']['globalstick']['global']['tids'].(empty($_G['cache']['globalstick']['categories'][$thisgid]['count']) ? '' : ','.$_G['cache']['globalstick']['categories'][$thisgid]['tids']);

	$stickytids = trim($stickytids, ', ');
	if ($stickytids === ''){
		$stickytids = '0';
	}

	if($_G['forum']['status'] != 3) {
		$stickycount = $_G['cache']['globalstick']['global']['count'];
		if(!empty($_G['cache']['globalstick']['categories'][$thisgid])) {
			$stickycount += $_G['cache']['globalstick']['categories'][$thisgid]['count'];
		}

	}
}
$forumstickytids = array();
loadcache('forumstick');
$_G['cache']['forumstick'][$_G['fid']] = isset($_G['cache']['forumstick'][$_G['fid']]) ? $_G['cache']['forumstick'][$_G['fid']] : array();
$forumstickycount = count($_G['cache']['forumstick'][$_G['fid']]);
foreach($_G['cache']['forumstick'][$_G['fid']] as $forumstickthread) {
	$forumstickytids[] = $forumstickthread['tid'];
}
if(!empty($forumstickytids)) {
	$forumstickytids = dimplode($forumstickytids);
	$stickytids .= ", $forumstickytids";
}


$stickycount += $forumstickycount;
$filterbool = !empty($filter) && in_array($filter, $filterfield);
$_G['forum_threadcount'] += $filterbool ? 0 : $stickycount;



$forumdisplayadd['page'] = !empty($forumdisplayadd['page']) ? $forumdisplayadd['page'] : '';
$multipage_archive = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "&archiveid={$_G['gp_archiveid']}" : '';

/**
* 默认设为精华插件 为了可以获取到参数all 手动添加
*/
if ($_G['gp_all']) {
   $multiadd[] = "all={$_G['gp_all']}";
}
$multipage = multi($_G['forum_threadcount'], $_G['tpp'], $page, "forum.php?mod=forumdisplay&fid=$_G[fid]".($multiadd ? '&'.implode('&', $multiadd) : '')."$multipage_archive", $_G['setting']['threadmaxpages']);
//$extra = rawurlencode(!IS_ROBOT ? 'page='.$page.($forumdisplayadd['page'] ? '&filter='.$filter.$forumdisplayadd['page'] : '').($forumdisplayadd['orderby'] ? $forumdisplayadd['orderby'] : '') : 'page=1');

$separatepos = 0;
$_G['forum_threadlist'] = $threadids = array();
$_G['forum_colorarray'] = array('', '#EE1B2E', '#EE5023', '#996600', '#3C9D40', '#2897C5', '#2B65B7', '#8F2A90', '#EC1282');

$displayorderadd = !$filterbool && $stickycount ? 't.displayorder IN (0, 1)' : 't.displayorder IN (0, 1, 2, 3, 4)';


if(isset($forumOption)) {
	$lasted_bbs_ids = $forumOption->hookScript4($threadtable);
}

if(($start_limit && $start_limit > $stickycount) || !$stickycount || $filterbool) {
	//解决精华帖查看效率，临时方案
	//TODO X2.0 将结果缓存，毕竟精华帖是少数
	$indexadd = '';
	if(strexists($filteradd, "t.digest>'0'")) {
		$indexadd = " FORCE INDEX (digest) ";
	}
	$querysticky = '';
    $distype = ($_G['gp_typeid']) ? ",t.typedorder DESC" :"";
	$sql = "SELECT t.* FROM ".DB::table($threadtable)." t $indexadd
		WHERE t.fid='{$_G['fid']}' $filteradd AND ($displayorderadd)
		ORDER BY t.displayorder DESC ".$distype.", t.$_G[gp_orderby] $_G[gp_ascdesc]
		LIMIT ".($filterbool ? $start_limit : $start_limit - $stickycount).", $_G[tpp] " . getSlaveID() . " ";
	if(isset($forumOption)) {
		$sql = $forumOption->hookScript5($sql, $lasted_bbs_ids);
	}

	$query = DB::query($sql);
} else {
	$sql = "SELECT t.* FROM ".DB::table($threadtable)." t
		WHERE t.tid IN ($stickytids) AND (t.displayorder IN (2, 3, 4))
		ORDER BY displayorder DESC, $_G[gp_orderby] $_G[gp_ascdesc]
		LIMIT $start_limit, ".($stickycount - $start_limit < $_G['tpp'] ? $stickycount - $start_limit : $_G['tpp']) . " " . getSlaveID() . " ";
	if(isset($forumOption)) {
		$sql = $forumOption->hookScript5($sql, $lasted_bbs_ids);
	}
	$querysticky = DB::query($sql);
	if($_G['tpp'] - $stickycount + $start_limit > 0) {
		$sql = "SELECT t.* FROM ".DB::table($threadtable)." t
			WHERE t.fid='{$_G['fid']}' $filteradd AND ($displayorderadd)
			ORDER BY displayorder DESC, $_G[gp_orderby] $_G[gp_ascdesc]
			LIMIT ".($_G['tpp'] - $stickycount + $start_limit);
		if(isset($forumOption)) {
			$sql = $forumOption->hookScript5($sql, $lasted_bbs_ids);
		}

		$query = DB::query($sql);
	} else {
		$query = '';
	}
}
//echo $sql;exit;
$_G['ppp'] = $_G['forum']['threadcaches'] && !$_G['uid'] ? $_G['setting']['postperpage'] : $_G['ppp'];
$page = $_G['page'];
$verify = $verifyuids = $grouptids = array();
//$alldomain_withfidtypeid = $forumOption->getdomainbyfidandtypeid();
while(($querysticky && $thread = DB::fetch($querysticky)) || ($query && $thread = DB::fetch($query))) {
	$thread['lastposterenc'] = rawurlencode($thread['lastposter']);
	if($thread['typeid'] && !empty($_G['forum']['threadtypes']['prefix']) && (isset($allthreadsname[$thread['typeid']]))) {
		if($_G['forum']['threadtypes']['prefix'] == 1) {
			/*$dm=$alldomain_withfidtypeid[$_G['fid']][$thread['typeid']];
			if($dm){
			$thread['typehtml'] = '<em>[<a href="http://'.$dm.'.'.$_G['setting']['domain']['root']['forum'].'/">'.$_G['forum']['threadtypes']['types'][$thread['typeid']].'</a>]</em>';
			}else{
			$thread['typehtml'] = '<em>[<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&amp;filter=typeid&amp;typeid='.$thread['typeid'].'">'.$_G['forum']['threadtypes']['types'][$thread['typeid']].'</a>]</em>';
			}*/
			$thread['typehtml'] = '<em>[<a href="' . $_G['forum']['threadtypes']['url'][$thread['typeid']] . '" />' . $allthreadsname[$thread['typeid']] . '</a>]</em>';
		} elseif($_G['forum']['threadtypes']['icons'][$thread['typeid']] && $_G['forum']['threadtypes']['prefix'] == 2) {
			$thread['typehtml'] = '<em><a title="'.$_G['forum']['threadtypes']['types'][$thread['typeid']].'" href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&amp;filter=typeid&amp;typeid='.$thread['typeid'].'">'.'<img style="vertical-align: middle;padding-right:4px;" src="'.$_G['forum']['threadtypes']['icons'][$thread['typeid']].'" alt="'.$allthreadsname[$thread['typeid']].'" /></a></em>';
		}
	} else {
		$thread['typeid'] = $thread['typehtml'] = '';
	}

	$thread['sorthtml'] = $thread['sortid'] && !empty($_G['forum']['threadsorts']['prefix']) && isset($_G['forum']['threadsorts']['types'][$thread['sortid']]) ?
		'<em>[<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&amp;filter=sortid&amp;sortid='.$thread['sortid'].'">'.$_G['forum']['threadsorts']['types'][$thread['sortid']].'</a>]</em>' : '';
	$thread['multipage'] = '';
	$topicposts = $thread['special'] ? $thread['replies'] : $thread['replies'] + 1;
	$multipate_archive = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "archiveid={$_G['gp_archiveid']}" : '';
	if($topicposts > $_G['ppp']) {
		$pagelinks = '';
		$thread['pages'] = ceil($topicposts / $_G['ppp']);
		$realtid = $_G['forum']['status'] != 3 && $thread['isgroup'] == 1 ? $thread['closed'] : $thread['tid'];
		$show_pagenum = $_G['newtpl'] ? 3 : 6;  // 新版帖子后分页显示个数 lxp 20140123
		for($i = 2; $i <= $show_pagenum && $i <= $thread['pages']; $i++) {
			$pagelinks .= "<a href=\"forum.php?mod=viewthread&tid=$realtid&amp;".(!empty($multipate_archive) ? "$multipate_archive&amp;" : '')."extra=$extra&amp;page=$i\">$i</a>";
		}
		if($thread['pages'] > $show_pagenum) {
			$pagelinks .= "..<a href=\"forum.php?mod=viewthread&tid=$realtid&amp;".(!empty($multipate_archive) ? "$multipate_archive&amp;" : '')."extra=$extra&amp;page=$thread[pages]\">$thread[pages]</a>";
		}
		$thread['multipage'] = '&nbsp;'.($_G['newtpl']?'':'...').$pagelinks;  // 新版帖子后去掉省略号 lxp 20140123
	}

	if($thread['highlight']) {
		$string = sprintf('%02d', $thread['highlight']);
		$stylestr = sprintf('%03b', $string[0]);

		$thread['highlight'] = ' style="';
		$thread['highlight'] .= $stylestr[0] ? 'font-weight: bold;' : '';
		$thread['highlight'] .= $stylestr[1] ? 'font-style: italic;' : '';
		$thread['highlight'] .= $stylestr[2] ? 'text-decoration: underline;' : '';
		$thread['highlight'] .= $string[1] ? 'color: '.$_G['forum_colorarray'][$string[1]] : '';
		$thread['highlight'] .= '"';
	} else {
		$thread['highlight'] = '';
	}

	$thread['recommendicon'] = '';
	if(!empty($_G['setting']['recommendthread']['status']) && $thread['recommends']) {
		foreach($_G['setting']['recommendthread']['iconlevels'] as $k => $i) {
			if($thread['recommends'] > $i) {
				$thread['recommendicon'] = $k+1;
				break;
			}
		}
	}

	$thread['moved'] = $thread['heatlevel'] = 0;
	$thread['icontid'] = !$thread['moved'] && $thread['isgroup'] != 1 ? $thread['tid' ] : $thread['closed'];
	if($_G['forum']['status'] != 3 && ($thread['closed'] || ($_G['forum']['autoclose'] && TIMESTAMP - $thread[$closedby] > $_G['forum']['autoclose']))) {
		$thread['new'] = 0;
		if($thread['isgroup'] == 1) {
			$thread['folder'] = 'common';
			$grouptids[] = $thread['closed'];
		} else {
			if($thread['closed'] > 1) {
				$thread['moved'] = $thread['tid'];
				$thread['replies'] = '-';
				$thread['views'] = '-';
			}
			$thread['folder'] = 'lock';
		}
	} elseif($_G['forum']['status'] == 3 && $thread['closed'] == 1) {
		$thread['folder'] = 'lock';
	} else {
		$thread['folder'] = 'common';
		if(!IS_ROBOT && (empty($_G['cookie']['oldtopics']) || strpos($_G['cookie']['oldtopics'], 'D'.$thread['tid'].'D') === FALSE)) {
			$thread['new'] = 1;
			$thread['folder'] = 'new';
		} else {
			$thread['new'] = 0;
		}
		$thread['weeknew'] = $thread['new'] && TIMESTAMP - 604800 <= $thread['dateline'];
		$thread['views'] += get_redis_views($thread['tid'],'viewthread');
		if($thread['replies'] > $thread['views']) {
			$thread['views'] = $thread['replies'];
		}
		if($_G['setting']['heatthread']['iconlevels']) {
			foreach($_G['setting']['heatthread']['iconlevels'] as $k => $i) {
				if($thread['heats'] > $i) {
					$thread['heatlevel'] = $k + 1;
					break;
				}
			}
		}
	}
//加入当天发帖帖子标红操作
	if (date('Y-m-d') == date('Y-m-d',$thread['dateline'])) {
		$thread['color'] = "style='color:red;'";
	}
	$thread['dateline'] = dgmdate($thread['dateline'], 'd');
	$thread['lastpost'] = dgmdate($thread['lastpost'], 'u');
//增加判断当是地区时，将地区置顶提取出来
    $thread['displayorder'] = ($_G['gp_typeid'] > 0 && $_G['gp_typeid'] == $thread['typeid'] && $thread['typedorder']>0) ? 'p' : $thread['displayorder'];
	if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p')) ) {
		$thread['id'] = 'stickthread_'.$thread['tid'];
		$separatepos++;
	} else {
		$thread['id'] = 'normalthread_'.$thread['tid'];
	}
	if(isset($_G['setting']['verify']['enabled']) && $_G['setting']['verify']['enabled']) {
		$verifyuids[$thread['authorid']] = $thread['authorid'];
	}

	$threadids[] = $thread['tid'];
	$_G['forum_threadlist'][] = $thread;

	/* 新版样式处理 lxp 20131210 Begin */
	if($_G['newtpl']){
		$thread['sorthtml'] = str_replace(array('<em>[',']</em>','<em>','</em>'), '', $thread['sorthtml']);
		$thread['typehtml'] = str_replace(array('<em>[',']</em>','<em>','</em>'), '', $thread['typehtml']);
		$thread['lastpost'] = strip_tags($thread['lastpost']);

		if(in_array($thread['displayorder'], array(2,3,4))){
			$_G['forum_toplist'][] = $thread;
		} elseif(in_array($thread['displayorder'], array(1,'p'))){
			$_G['forum_middlelist'][] = $thread;
		} else {
			$_G['forum_mainlist'][] = $thread;
		}
	}
	/* End */
}
//查询认证
if($_G['setting']['verify']['enabled'] && $verifyuids) {
	$verifyquery = DB::query("SELECT * FROM ".DB::table('common_member_verify')." WHERE uid IN(".dimplode($verifyuids).")");
	while($value = DB::fetch($verifyquery)) {
		foreach($_G['setting']['verify'] as $vid => $vsetting) {
			if($vsetting['available'] && $vsetting['showicon'] && !empty($vsetting['icon']) && $value['verify'.$vid] == 1) {
				$verify[$value['uid']] .= "<a href=\"home.php?mod=spacecp&ac=profile&op=verify&vid=$vid\" target=\"_blank\">".(!empty($vsetting['icon']) ? '<img src="'.$vsetting['icon'].'" class="vm" alt="'.$vsetting['title'].'" title="'.$vsetting['title'].'" />' : $vsetting['title']).'</a>';
			}
		}

	}
}

$_G['forum_threadnum'] = count($_G['forum_threadlist']) - $separatepos;

if(!empty($grouptids)) {
	$query = DB::query("SELECT t.tid, t.views, f.name, f.fid FROM ".DB::table('forum_thread')." t LEFT JOIN ".DB::table('forum_forum')." f ON f.fid=t.fid WHERE t.tid IN(".dimplode($grouptids).")");
	while($row = DB::fetch($query)) {
		$groupnames[$row['tid']]['name'] = $row['name'];
		$groupnames[$row['tid']]['fid'] = $row['fid'];
		$groupnames[$row['tid']]['views'] = $row['views'];
	}
}

$stemplate = $sortexpiration = null;
if($_G['forum']['threadsorts']['types'] && $sortoptionarray && $templatearray) {
	$sortid = intval($_G['gp_sortid']);
	$sortlistarray = showsorttemplate($_G['gp_sortid'], $_G['fid'], $sortoptionarray, $templatearray, $_G['forum_threadlist'], $threadids);
	$stemplate = $sortlistarray['template'];
	$sortexpiration = $sortlistarray['expiration'];

	if(($_G['gp_searchoption'] || $_G['gp_searchsort']) && empty($searchsorttids)) {
		$_G['forum_threadlist'] = $multipage = '';
	}
}

$separatepos = $separatepos ? $separatepos + 1 : 0;

$_G['setting']['visitedforums'] = $_G['setting']['visitedforums'] ? visitedforums() : '';
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

$forummenu = '';
if(!$_G['uid']) {
	$guestfastpost = $_G['setting']['fastpost'] && $_G['perm']['allowpost'] && !$_G['forum']['allowspecialonly'] && !$_G['forum']['threadsorts']['required'];
	$_G['perm']['allowpost'] = (!$_G['forum']['postperm'] && $_G['perm']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'], $_G['perm']['groupid'])) || (isset($_G['forum']['allowpost']) && $_G['forum']['allowpost'] == 1 && $_G['perm']['allowpost']);
	$guestfastpost = $guestfastpost && !$_G['forum']['allowspecialonly'];
	$_G['perm']['allowpost'] = isset($_G['forum']['allowpost']) && $_G['forum']['allowpost'] == -1 ?  false : $_G['perm']['allowpost'];
}

$fastpost = $_G['setting']['fastpost'] && $_G['group']['allowpost'] && !$_G['forum']['allowspecialonly'] && !$_G['forum']['threadsorts']['required'];

$_G['group']['allowpost'] = (!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])) || (isset($_G['forum']['allowpost']) && $_G['forum']['allowpost'] == 1 && $_G['group']['allowpost']);
$fastpost = $fastpost && !$_G['forum']['allowspecialonly'];
$_G['group']['allowpost'] = isset($_G['forum']['allowpost']) && $_G['forum']['allowpost'] == -1 ?  false : $_G['group']['allowpost'];

$guestpost = null;
if(!$_G['uid']) {
	$guestpost = $_G['perm']['allowpost'] && !$_G['group']['allowpost'];
	if($guestpost) {
		$_G['group']['allowpost'] = $_G['perm']['allowpost'];
	}
	$fastpost = $guestfastpost && !$fastpost || $fastpost;
}

if($fastpost) {
	$usesigcheck = $_G['uid'] && $_G['group']['maxsigsize'];
	$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
	$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
}
$showpoll = $showtrade = $showreward = $showactivity = $showdebate = 0;
if($_G['forum']['allowpostspecial']) {
	$showpoll = $_G['forum']['allowpostspecial'] & 1;
	$showtrade = $_G['forum']['allowpostspecial'] & 2;
	$showreward = isset($_G['setting']['extcredits'][$_G['setting']['creditstransextra'][2]]) && ($_G['forum']['allowpostspecial'] & 4);
	$showactivity = $_G['forum']['allowpostspecial'] & 8;
	$showdebate = $_G['forum']['allowpostspecial'] & 16;
}
if($_G['group']['allowpost']) {
	$_G['group']['allowpostpoll'] = $_G['group']['allowpostpoll'] && $showpoll;
	$_G['group']['allowposttrade'] = $_G['group']['allowposttrade'] && $showtrade;
	$_G['group']['allowpostreward'] = $_G['group']['allowpostreward'] && $showreward;
	$_G['group']['allowpostactivity'] = $_G['group']['allowpostactivity'] && $showactivity;
	$_G['group']['allowpostdebate'] = $_G['group']['allowpostdebate'] && $showdebate;
}

$_G['forum']['threadplugin'] = $_G['group']['allowpost'] && $_G['setting']['threadplugins'] ? unserialize($_G['forum']['threadplugin']) : array();

if($_G['setting']['forumjump']) {
	$forummenu = forumselect(FALSE, 1);
}

//此处代码做了修改
// 新老模板切换 lxp 20131209
if($_G['newtpl']){
	//户外先锋营版块模板特殊处理 2014.06.26
	if($_G['fid'] == 489 && $_G['gp_typeid'] == '') {
		require_once libfile('forumdisplay/fid_'.$_G['fid'], 'include');
		$template = 'diy:forum/forumdisplay_fid_'.$_G['fid'];
	} else {
		$template = 'diy:forum/forumdisplay_2014:'.$_G['fid'];
	}
} else {
	$template = 'diy:forum/forumdisplay:'.$_G['fid'];
}
if (isset($forumOption)) {
	$template = $forumOption->hookScript8($template);
}

//上面代码做了修改

if(!empty($_G['forum']['threadsorts']['templatelist']) && $_G['forum']['status'] != 3) {
	$template = 'diy:forum/forumdisplay_'.$_G['forum']['threadsorts']['templatelist'].':'.$_G['fid'];
} elseif($_G['forum']['status'] == 3) {
	$groupviewed_list = get_viewedgroup();
	write_groupviewed($_G['fid']);
	$template = 'diy:group/group:'.$_G['fid'];
}

if($_G['gp_archiver']) {
	include loadarchiver('forum/forumdisplay');
	exit();
}
//新增是否过滤置顶主题
$startnum = ($fiter_level == 1) ? 0:($separatepos-1);
$startnum = ($startnum <0 ) ? 0 : $startnum;
if(($_G['fid']==56&&$_G['uid']==1)){
	//$forumOption->getSmallPics();
}
include(DISCUZ_ROOT."./source/plugin/forumoption/smailltip.inc.php");
//主题列表缩略图
//include(DISCUZ_ROOT."./source/plugin/forose_picshow/forumdisplay.inc.php");

//发帖按钮右侧增加在外线路广告 (地方版$_G['forum']['fup'] == 76)
/*if(isset($forumOption)) {
	//获取线路广告数据，如果存在，由json转为array。缓存数据为UTF8 JSON
	$xianluAD_json = $forumOption->getWanXianlu($_G['clientip']);
	if($xianluAD_json)
	{
		$xianluAD_difang_arr = json_decode($xianluAD_json, true);
		$xianluAD_difang_key = array_rand($xianluAD_difang_arr, 1);
		$xianluAD_difang = $xianluAD_difang_arr[$xianluAD_difang_key];
	}
}*/
include template($template);
?>
