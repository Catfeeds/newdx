<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_album.php 19158 2010-12-20 08:21:50Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$minhot = $_G['setting']['feedhotmin']<1?3:$_G['setting']['feedhotmin'];
if(empty($_G['gp_view'])) $_G['gp_view'] = 'me';



$page = empty($_GET['page'])?1:intval($_GET['page']);
if($page<1) $page=1;
$perpage = 100;
$perpage = mob_perpage($perpage);
$start = ($page-1)*$perpage;

$list = array();

/*引入附件服务器信息*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$serverinfo = $attachserver->get_server_domain('all');
/*结束*/

if($_G['gp_view'] == 'used') {
    $diymode = 1;
	
	$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('plugin_produce_users')." WHERE type='used' AND uid={$uid}"),0);	
	if($count) {
		$array=array();
		$query = DB::query("SELECT tid FROM ".DB::table('plugin_produce_users')." WHERE type='used' AND uid={$uid}");
		while ($value = DB::fetch($query)) {		
			$array[] = $value['tid'];
		}
		$arr=implode(',',$array);		
		if($arr){
		    $query = DB::query("SELECT r.serverid,r.cptp,t.* FROM ".DB::table('plugin_produce_info')." AS r
			                  LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			                  where t.fid=437 AND r.isshow=1 AND t.displayorder >= 0 AND t.tid in ($arr) ORDER BY t.dateline desc LIMIT $start,$perpage");
			$list=array();	  
			while ($value = DB::fetch($query)) {
				$value['dateline']=date('Y-m-d ', $value['dateline']);
				//$value['tag']=1;
                /*增加附件服务器的判定*/
                $value['cptp'] = $value['serverid'] > 0 ? "http://".$serverinfo[$value['serverid']]."/plugin/".$value['cptp'] : "/data/attachment/plugin/".$value['cptp'];
                /*结束*/
				$list[] = $value;
			}			 
		}
		
	}
	$multi = multi($count, $perpage, $page, "home.php?mod=space&uid={$uid}&do=produce&view=used&from=space");
	include_once template("diy:home/space_produce_list");
} elseif ($_G['gp_view'] == 'want') {
	$diymode = 1;   
    $count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('plugin_produce_users')." WHERE type='want' AND uid={$uid}"),0);		
	if($count) {
		$array=array();
		$query = DB::query("SELECT tid FROM ".DB::table('plugin_produce_users')." WHERE type='want' AND uid={$uid}");
		while ($value = DB::fetch($query)) {		
			$array[] = $value['tid'];
		}
		$arr=implode(',',$array);		
		if($arr){
		  $query = DB::query("SELECT r.serverid,r.cptp,t.* FROM ".DB::table('plugin_produce_info')." AS r
			   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			   where t.fid=437 AND r.isshow=1 AND t.displayorder >= 0 AND t.tid in ($arr) ORDER BY t.dateline desc LIMIT $start,$perpage");	
	     
		while ($value = DB::fetch($query)) {
			$value['dateline']=date('Y-m-d ', $value['dateline']);
            /*增加附件服务器的判定*/
            $value['cptp'] = $value['serverid'] > 0 ? "http://".$serverinfo[$value['serverid']]."/plugin/".$value['cptp'] : "/data/attachment/plugin/".$value['cptp'];
            /*结束*/		
			$list[] = $value;
		 }			 
		}
		
	}	
	$multi = multi($count, $perpage, $page, "home.php?mod=space&uid={$uid}&do=produce&view=want&from=space");
	include_once template("diy:home/space_produce_list");
} elseif($_G['gp_view'] == 'me') {	
	$diymode = 1;
	$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('forum_thread')." as t LEFT JOIN ".DB::table('plugin_produce_info')." AS r ON r.tid =                                    t.tid WHERE  t.fid=437 AND t.authorid={$uid} AND t.displayorder >= 0 and r.isshow=1"),0);
	if($count) {
		$query = DB::query("SELECT r.serverid,r.cptp,r.cpxh,r.isused,t.* FROM ".DB::table('plugin_produce_info')." AS r
			   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			   where t.fid=437 AND t.authorid={$uid} AND r.isshow=1 AND t.displayorder >= 0 ORDER BY t.dateline desc LIMIT $start,$perpage");		
	  
		while ($value = DB::fetch($query)) {
			$value['dateline']=date('Y-m-d ', $value['dateline']);
			if($value['isused']){
				//$value['tag']=0;
			}
            /*增加附件服务器的判定*/
            $value['cptp'] = $value['serverid'] > 0 ? "http://".$serverinfo[$value['serverid']]."/plugin/".$value['cptp'] : "/data/attachment/plugin/".$value['cptp'];
            /*结束*/		
			$list[] = $value;
		}
	}
		
	$multi = multi($count, $perpage, $page, "home.php?mod=space&uid={$uid}&do=produce&view=me&from=space");
	include_once template("diy:home/space_produce_list");
}
?>
