<?php

	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}

	$query = DB::query("SELECT typeid,todayposts FROM ".DB::table('forum_threadclass'));
	$date = date('Y-m-d',time()-7200);
	while($row = DB::fetch($query)) {
		
		DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$date}','{$row['typeid']}','1','{$row['todayposts']}')");
		
		DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts='0' WHERE typeid='{$row['typeid']}'");
	}
