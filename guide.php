<?php
define('APPTYPEID', 2);
define('CURSCRIPT', 'forum');


require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->cachelist = $cachelist;
$discuz->init();

runhooks();

$newthread_list = $newthread_lists = $newreply_list = $newreply_lists = array();
$forum_colorarray = array('','#EE1B2E','#EE5023','#996600','#3C9D40','#2897C5','#2B65B7','#8F2A90','#EC1282');
$newthread_query = DB::query("SELECT tid, author, authorid, subject, highlight FROM ".DB::table('forum_thread')." WHERE displayorder not in ('-1') ORDER BY dateline DESC LIMIT 100");
while($newthread_list = DB::fetch($newthread_query)){
	if($newthread_list['highlight']) {
		$thread_string = sprintf('%02d', $newthread_list['highlight']);
		$thread_stylestr = sprintf('%03b', $thread_string[0]);

		$newthread_list['highlight'] = ' style="';
		$newthread_list['highlight'] .= $thread_stylestr[0] ? 'font-weight: bold;' : '';
		$newthread_list['highlight'] .= $thread_stylestr[1] ? 'font-style: italic;' : '';
		$newthread_list['highlight'] .= $thread_stylestr[2] ? 'text-decoration: underline;' : '';
		$newthread_list['highlight'] .= $thread_string[1] ? 'color: '.$forum_colorarray[$thread_string[1]] : '';
		$newthread_list['highlight'] .= '"';
	} else {
		$newthread_list['highlight'] = '';
	}
	$newthread_lists[] = $newthread_list;
}




$newreply_query = DB::query("SELECT tid, subject, lastposter, highlight FROM ".DB::table('forum_thread')." WHERE displayorder not in ('-1') ORDER BY lastpost DESC LIMIT 100");
while($newreply_list = DB::fetch($newreply_query)){
	if($newreply_list['highlight']) {
		$string = sprintf('%02d', $newreply_list['highlight']);
		$stylestr = sprintf('%03b', $string[0]);

		$newreply_list['highlight'] = ' style="';
		$newreply_list['highlight'] .= $stylestr[0] ? 'font-weight: bold;' : '';
		$newreply_list['highlight'] .= $stylestr[1] ? 'font-style: italic;' : '';
		$newreply_list['highlight'] .= $stylestr[2] ? 'text-decoration: underline;' : '';
		$newreply_list['highlight'] .= $string[1] ? 'color: '.$forum_colorarray[$string[1]] : '';
		$newreply_list['highlight'] .= '"';
	} else {
		$newreply_list['highlight'] = '';
	}
	$newreply_lists[] = $newreply_list;
}
include template('forum/guide');
?>