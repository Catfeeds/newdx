<?php 
	if(!defined('IN_DISCUZ')) {
		exit('Access Denied');
	}
	
	if(!$_GET['fid']){
		echo false;
	}
	
	$threadmessage = 'threadmessage_'.$_GET['fid'];
	$typearr = memory('get',$threadmessage);
	if(!$typearr){
		$countmark = DB::result_first("SELECT typeid,name FROM ".DB::table('forum_threadclass')." WHERE fid = {$_GET['fid']}");
		
		if(!$countmark){
			$utf_name = mb_convert_encoding('没有子版块', "UTF-8", "GBK");
			$utf_typecount = mb_convert_encoding('没有', "UTF-8", "GBK");
			$utf_todaycount = mb_convert_encoding('没有', "UTF-8", "GBK");
			$typearr = array(array('name'=>$utf_name,'typecount'=>$utf_typecount,'todaycount'=>$utf_todaycount));
			memory('set',$threadmessage,$typearr,900);
			$str = json_encode($typearr);
			echo $str;
			exit;
		}
		
		$query = DB::query("SELECT typeid,name FROM ".DB::table('forum_threadclass')." WHERE fid = {$_GET['fid']}");
		
		//获取今天0点的时间戳
		$today = dgmdate(TIMESTAMP, 'Y-m-d');
		$timearr = array();
		$timearr = explode('-',$today);
		$todaytime = mktime(0,0,0,$timearr[1],$timearr[2],$timearr[0]);
		
		$typearr = array();
		while($row = DB::fetch($query)){
			//mb_convert_encoding("妳係我的友仔", "UTF-8", "GBK"); 
			// $typearr[$row['typeid']]['name'] = $row['name'];
			$typearr[$row['typeid']]['name'] = mb_convert_encoding($row['name'], "UTF-8", "GBK");
			$typecount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_thread')." WHERE typeid = {$row['typeid']}");
			$typearr[$row['typeid']]['typecount'] = $typecount;
		}
		
		$fidarr = array_keys($typearr);
		$tidarr = array();
		foreach($fidarr as $value){
			$query = DB::query("SELECT tid FROM ".DB::table('forum_thread')." WHERE typeid = {$value} ORDER BY tid ");
			while($row = DB::fetch($query)){
				$tidarr[$value][] = $row['tid'];
			}
			$tidstr = implode(',',$tidarr[$value]);
			unset($tidarr[$value]);
			if(isset($tidstr{0})){
				$todaycount = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid in (".$tidstr.") AND dateline > {$todaytime}");
				$typearr[$value]['todaycount'] = $todaycount;
			}else{
				$typearr[$value]['todaycount'] = '0';
			}
		}
		array_unshift($typearr, "apple");
		array_shift($typearr);
		memory('set',$threadmessage,$typearr,900);
	}
	$str = json_encode($typearr);
	echo $str;