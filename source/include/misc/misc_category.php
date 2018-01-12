<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_category.php 16942 2010-09-17 05:16:35Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$_sql_fup = $newindex ? 'f.nfup as fup' : 'f.fup';
$_sql_select = $newindex ? 'f.nfup' : 'f.fup';
$_sql_displayorder = $newindex ? 'f.ndisplayorder' : 'f.displayorder';
$gquery = DB::query("SELECT f.fid, f.fup, f.type, f.name, ff.moderators, ff.extra, f.domain, f.forumcolumns FROM ".DB::table('forum_forum')." f LEFT JOIN ".DB::table('forum_forumfield')." ff ON ff.fid=f.fid WHERE f.fid='$gid'");
$sql = !empty($_G['member']['accessmasks']) ? "SELECT f.fid, {$_sql_fup}, f.type, f.name, f.threads, f.posts, f.todayposts, f.domain,
				f.forumcolumns, f.lastpost, f.inheritedmod, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.extra, ff.redirect, a.allowview
				FROM ".DB::table('forum_forum')." f
				LEFT JOIN ".DB::table('forum_forumfield')." ff ON ff.fid=f.fid
				LEFT JOIN ".DB::table('forum_access')." a ON a.uid='$_G[uid]' AND a.fid=f.fid
				WHERE {$_sql_select}='$gid' AND f.status='1' AND f.type='forum' ORDER BY {$_sql_displayorder}"
			: "SELECT f.fid, {$_sql_fup}, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.inheritedmod, f.domain,
				f.forumcolumns, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.extra, ff.redirect
				FROM ".DB::table('forum_forum')." f
				LEFT JOIN ".DB::table('forum_forumfield')." ff USING(fid)
				WHERE {$_sql_select}='$gid' AND f.status='1' AND f.type='forum' ORDER BY {$_sql_displayorder}";

$query = DB::query($sql);
if(!DB::num_rows($gquery) || !DB::num_rows($query)) {
	showmessage('forum_nonexistence', NULL);
}

while(($forum = DB::fetch($gquery)) || ($forum = DB::fetch($query))) {
	if($newindex){
		$forum['name'] = str_replace(array('¡º', '¡»', '¡õ-A', '¡õ-B', '¡õ-C', '¡õ-D', '¡õ-E', '¡õ-F', '¡õ-G', '¡õ-H', '¡õ-I', '¡õ-J', '¡õ-K', '¡õ-L', '¡õ-M', '¡õ-N', '¡õ-O', '¡õ-P', '¡õ-Q', '¡õ-R', '¡õ-S', '¡õ-T', '¡õ-U', '¡õ-V', '¡õ-W', '¡õ-X', '¡õ-Y', '¡õ-Z'), '', $forum['name']);
	}
	$forum['extra'] = unserialize($forum['extra']);
	if(!is_array($forum['extra'])) {
		$forum['extra'] = array();
	}
	if($forum['type'] != 'group') {
		$threads += $forum['threads'];
		$posts += $forum['posts'];
		$todayposts += $forum['todayposts'];
		if(forum($forum)) {
			$forum['orderid'] = $catlist[$forum['fup']]['forumscount'] ++;
			$forum['subforums'] = '';
			$forumlist[$forum['fid']] = $forum;
			$catlist[$forum['fup']]['forums'][] = $forum['fid'];
			$fids .= ','.$forum['fid'];
		}
	} else {
		$forum['collapseimg'] = 'collapsed_no.gif';
		$collapse['category_'.$forum['fid']] = '';

		if($forum['moderators']) {
			$forum['moderators'] = moddisplay($forum['moderators'], 'flat');
		}
		$forum['forumscount'] = 0;
		//$forum['forumcolumns'] = 0;
		$catlist[$forum['fid']] = $forum;

		$navigation = '<em>&rsaquo;</em> '.$forum['name'];
		$navtitle = strip_tags($forum['name']);
	}

}
$query = DB::query("SELECT fid, fup, name, threads, posts, todayposts FROM ".DB::table('forum_forum')." WHERE status='1' AND fup IN ($fids) AND type='sub' ORDER BY displayorder");
while($forum = DB::fetch($query)) {

	if($_G['setting']['subforumsindex'] && $forumlist[$forum['fup']]['permission'] == 2) {
		$forumlist[$forum['fup']]['subforums'] .= '<a href="forum.php?mod=forumdisplay&fid='.$forum['fid'].'"><u>'.$forum['name'].'</u></a>&nbsp;&nbsp;';
	}
	$forumlist[$forum['fup']]['threads'] 	+= $forum['threads'];
	$forumlist[$forum['fup']]['posts'] 	+= $forum['posts'];
	$forumlist[$forum['fup']]['todayposts'] += $forum['todayposts'];

}

?>