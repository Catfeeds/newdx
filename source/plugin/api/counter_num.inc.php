<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$historypost = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='historyposts'");
$historypost = explode("\t", $historypost);
$sql = !empty($_G['member']['accessmasks']) ?
		"SELECT f.fid, f.fup, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.inheritedmod, f.domain,
			f.forumcolumns, f.simple, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.redirect, ff.extra, a.allowview
			FROM ".DB::table('forum_forum')." f
			LEFT JOIN ".DB::table('forum_forumfield')." ff ON ff.fid=f.fid
			LEFT JOIN ".DB::table('forum_access')." a ON a.uid='$_G[uid]' AND a.fid=f.fid
			WHERE f.status='1' ORDER BY f.type, f.displayorder"
		: "SELECT f.fid, f.fup, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.inheritedmod, f.domain,
			f.forumcolumns, f.simple, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.redirect, ff.extra
			FROM ".DB::table('forum_forum')." f
			LEFT JOIN ".DB::table('forum_forumfield')." ff USING(fid)
			WHERE f.status='1' ORDER BY f.type, f.displayorder";
$query = DB::query($sql);
while($forum = DB::fetch($query)) {
	if($forum['type'] != 'group') {
		$threads += $forum['threads'];
		$posts += $forum['posts'];
		$todayposts += $forum['todayposts'];
	}
}
$register_num = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='showtotalmembers'");
$json = array(
	'posts' => $posts,
	'todayposts' => $todayposts,
	'yesterday' =>$historypost[0],
    // 'register_num' => DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_member'))
    'register_num' => $register_num
);
echo json_encode($json);
