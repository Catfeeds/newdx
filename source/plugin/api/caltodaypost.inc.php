<?php

/**
 * @author blog.anchen8.net
 * @copyright 2013
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
$q = DB::query("SELECT fid FROM ".DB::table('forum_forum'));
while($v = DB::fetch($q)){
    $fids[] = $v['fid'];
}
$time = strtotime(date('Y-m-d' ,strtotime('today')));
foreach($fids as $fid){
    DB::update('forum_forum' , array('todayposts' => DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_post')." p WHERE p.dateline > {$time} and p.fid = {$fid}")) , "fid = {$fid}");
}
$yesterday = strtotime(date('Y-m-d' , strtotime('-1day')));
$historyposts = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE dateline >= {$yesterday} AND dateline < {$time}");
save_syscache('historyposts' ,$historyposts);
?>