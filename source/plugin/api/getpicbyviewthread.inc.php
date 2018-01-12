<?php

	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}
	
	$pic_postlist_more=array();
	
	if($_GET['tid'] && $_GET['from']){
		echo false;
	}
	$from = $_GET['from']*10+5;
	
	$query = DB::query("SELECT aid,remote,attachment,serverid FROM ".DB::table('forum_attachment')." WHERE tid='{$_GET['tid']}' ORDER BY dateline LIMIT {$from},10");
	
	$querylast = DB::result_first("SELECT aid FROM ".DB::table('forum_attachment')." WHERE tid='{$_GET['tid']}' ORDER BY dateline desc LIMIT 1");
	
	if(file_exists(DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php")){
		require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
		$attach_server = new attachserver;
		$attachserverlist = $attach_server->get_server_domain('all', '*');
	}
	$i = 0;
	while($row = DB::fetch($query)){
		$attach = array();
		$attach['url'] = ($row['remote'] ? $_G['setting']['ftp']['attachurl'] : ($row['serverid'] > 0 ? 'http://'.$attachserverlist[$row['serverid']]['name'].'/' : $_G['setting']['attachurl'])).'forum/';
		// $pic_postlist_more[$i][] = getforumimg($row['aid'], 0, 100, 100, '2');
		$pic_postlist_more[$i][] = getimagethumb(100 ,100 ,2 ,'forum/'.$row['attachment'], $row['aid'], $row['serverid']);
		$tmpstr = '';
		if ( is_array( $attachserverlist[$row['serverid']]['api'] ) ) {
			if( $attachserverlist[$row['serverid']]['api']['class'] && is_object( $attachserverlist[$row['serverid']]['api']['class'] ) ) {
				$_callback = array( $attachserverlist[$row['serverid']]['api']['class'], $attachserverlist[$row['serverid']]['api']['function'] );
			}else{
				$_callback = $attachserverlist[$row['serverid']]['api']['function'];
			}
			$tmpstr = call_user_func_array( $_callback, array( 'forum', true, true, true ));
		}
		$pic_postlist_more[$i][] = $attach['url'].$row['attachment'] . $tmpstr;
		++$i;
		if($row['aid'] == $querylast){
			$pic_postlist_more[$i][] = "http://www.8264.com/static/images/lastpicmin.jpg";
			$pic_postlist_more[$i][] = "http://www.8264.com/static/images/lastpicmax.jpg";
		}
	}
	
	$piccount = count($pic_postlist_more);
	
	if($piccount){
		$str=json_encode($pic_postlist_more);
		echo $str;
	}else{
		echo false;
	}
	