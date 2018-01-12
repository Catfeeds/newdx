<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_thread.php 19203 2010-12-22 02:55:50Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once libfile('function/space');
require_once libfile('function/forumlist');

space_merge($space, 'count');

$minhot = $_G['setting']['feedhotmin'] < 1 ? 3 : $_G['setting']['feedhotmin'];
$page = empty($_GET['page']) ? 1 : intval($_GET['page']);
if($page < 1) $page = 1;
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

if(empty($_G['gp_view'])) $_G['gp_view'] = 'all';
$_G['gp_order'] = empty($_G['gp_order']) ? 'dateline' : $_G['gp_order'];

$allowviewuserthread = $_G['setting']['allowviewuserthread'];

$perpage = 20;
$start   = ($page-1)*$perpage;
ckstart($start, $perpage);

$list 		= array();
$userlist 	= array();
$hiddennum 	= $count = $pricount = 0;

$gets = array(
	'mod' => 'space',
	'uid' => $space['uid'],
	'do' => 'thread',
	'view' => $_G['gp_view'],
	'type' => $_GET['type'],
	'order' => $_G['gp_order'],
	'fuid' => $_GET['fuid'],
	'searchkey' => $_GET['searchkey'],
	'from' => $_GET['from']
);
$theurl = 'home.php?'.url_implode($gets);
$multi = '';

require_once libfile('function/misc');
require_once libfile('function/forum');
loadcache(array('forums'));
$fids 		= $comma = '';
$wheresql 	= $_G['gp_view'] == 'me' || !$allowviewuserthread ? '1' : " t.fid IN(".$allowviewuserthread.")";
$wheresql  .= $_G['gp_view'] != 'me' ? " AND t.displayorder>='0'" : '';
$f_index 	= '';
$ordersql 	= 't.dateline DESC';
$need_count = true;

//只是改个人中心的版面--新增变量，by lishuaiquan 20141104
$onlyUc = $_G['gp_view'] == 'me' && $_GET['from'] == 'space' ? true : false;

if($_G['gp_view'] == 'all') {
	$start 		= 0;
	$perpage 	= 100;
	$alltype 	= 'dateline';
	$wheresql 	= "t.displayorder>='0'";
	loadcache('space_thread');
	if($_G['gp_order'] == 'hot') {
		$wheresql  .= " AND t.replies>='$minhot'";
		$alltype 	= 'hot';
	} else {
		$pruneperm = 0;
		if(($_G['adminid'] == 1 || $_G['adminid'] == 2)) {
			if(in_array($_G['uid'], explode(',', $_G['config']['admincp']['founder'])) || in_array($_G['username'], explode(',', $_G['config']['admincp']['founder']))) {
				$pruneperm = 1;
			} elseif(DB::result_first("SELECT ap.perm FROM ".DB::table('common_admincp_member')." am LEFT JOIN ".DB::table('common_admincp_perm')." ap ON ap.cpgroupid=am.cpgroupid WHERE am.uid='$_G[uid]' AND ap.perm='prune'")) {
				$pruneperm = 1;
			}
		}
		if(submitcheck('delthread') && $pruneperm) {
			require_once libfile('function/post');
			$moderate = $_G['gp_moderate'];
			$tidsadd = 'tid IN ('.dimplode($moderate).')';
			$tuidarray = $ruidarray = $fids = array();
			$postarray = getfieldsofposts('fid, first, authorid', $tidsadd);
			foreach($postarray as $post) {
				if($post['first']) {
					$tuidarray[$post['fid']][] = $post['authorid'];
				} else {
					$ruidarray[$post['fid']][] = $post['authorid'];
				}
				$fids[$post['fid']] = $post['fid'];
			}
			if($tuidarray) {
				foreach($tuidarray as $fid => $uids) {
					$_G['fid'] = $fid;
					updatepostcredits('-', $uids, 'post');
				}
			}
			if($ruidarray) {
				foreach($ruidarray as $fid => $uids) {
					$_G['fid'] = $fid;
					updatepostcredits('-', $uids, 'reply');
				}
			}

			require_once libfile('function/delete');
			deletepost($tidsadd);
			deletethread($tidsadd);
			DB::query("DELETE FROM ".DB::table('forum_postcomment')." WHERE ".$tidsadd." AND authorid='$space[uid]'");

			foreach($fids as $fid) {
				updateforumcount(intval($fid));
			}

			foreach($moderate as $tid) {
				my_thread_log('delete', array('tid' => $tid));
			}
			$_G['cache']['space_thread'][$alltype] = array();
			save_syscache('space_thread', $_G['cache']['space_thread']);

			showmessage('thread_delete_succeed', 'home.php?mod=space&uid='.$space['uid'].'&do=thread&view=all');
		}
	}
	$orderactives = array($_G['gp_order'] => ' class="a"');

} elseif($_G['gp_view'] == 'me') {
	
	if($_GET['from'] == 'space') $diymode = 1;

	//获得已开启的点评模块列表
	$dianpingFids = getdianpingfids();
	
	//发帖数和回复数
	if ($onlyUc) {		
		$allowviewuserthread = trim($allowviewuserthread, "'");
		$allowviewuserthread = $allowviewuserthread && !$space['self'] ? explode("','", $allowviewuserthread) :array();
		if ($space['self']) {
			$notfids = implode(',', $dianpingFids);
		} else {
			$allowviewuserthread = array_diff($allowviewuserthread, $dianpingFids);
			$infids = implode(',', $allowviewuserthread);
		}
		
		loadcache('forums');
		$forums = $_G['cache']['forums'];		
		
		$threadCount  = getthreadbyuid($space, $notfids, $infids);		
		$replyCount   = getpostbyuid($space, $notfids, $infids);
	}
	
	$viewtype = in_array($_G['gp_type'], array('reply', 'thread', 'postcomment')) ? $_G['gp_type'] : 'thread';
	$filter   = in_array($_G['gp_filter'], array('recyclebin', 'save', 'aduit', 'close', 'common')) ? $_G['gp_filter'] : '';
	if($viewtype == 'thread') {		
		$wheresql .= " AND t.authorid = '{$space['uid']}'";
		if($filter == 'recyclebin') {
			$wheresql .= " AND t.displayorder='-1'";
		} elseif($filter == 'aduit') {
			$wheresql .= " AND (t.displayorder='-2' OR t.displayorder='-3')";
		} elseif($filter == 'save') {
			$wheresql .= " AND t.displayorder='-4'";
		} elseif($filter == 'close') {
			$wheresql .= " AND t.closed='1'";
		} elseif($filter == 'common') {
			$wheresql .= " AND t.displayorder>='0' AND t.closed='0'";
		} elseif($space['uid'] != $_G['uid']) {
			if($allowviewuserthread === false && $_G['adminid'] != 1) {
				showmessage('ban_view_other_thead');
			}
			if(!$allowviewuserthread && $_G['adminid'] != 1) {
				showmessage('allow_view_other_thead_but_no_detail');
			}
			$fidsql = empty($allowviewuserthread) ? '' : " AND t.fid IN($allowviewuserthread) ";
			$wheresql .= "$fidsql AND t.displayorder>='0'";
		}
		$ordersql  = $onlyUc ? $ordersql : 't.lastpost DESC';
		
		if ($onlyUc) {
			$need_count = false;	
			//若是mencache已到期，则重新缓存
			$memKey    = "cache_ucenter_thread_list_{$space['uid']}_{$page}";	
			if ($_G['gp_nocache']) {
				memory('rm', $memKey);
			}			
			$memList   = memory('get', $memKey);
			if ($memList) {
				$list = $memList;
			} else {
				$sql   = "SELECT t.tid,t.fid,t.author,t.authorid,t.subject,t.dateline,t.views,t.replies,t.rate,t.stamp FROM ".DB::table('forum_thread')." t WHERE t.authorid = {$space["uid"]} and t.displayorder>=0 and t.special<>4 ";
				$sql  .= $space['self'] ? " and t.fid not in ({$notfids}) " : " and t.fid in ({$infids}) ";	
				$sql  .= " order by t.dateline desc limit {$start},{$perpage}"  . getSlaveID();	
				$query = DB::query($sql);
				$tids  = $postList = array();
				while($v = DB::fetch($query)) {
					$tids[$v['tid']] = $v['tid'];
					$v['views'] 	+= get_redis_views($v['tid'],'viewthread');					
					$list[$v['tid']] = $v;
				}
				if($tids) {				
					$query = DB::query("SELECT * FROM ".DB::table('forum_post')." WHERE tid in (".dimplode($tids).") and first = 1 " . getSlaveID());
					while($v = DB::fetch($query)) {
						$list[$v['tid']]['message'] = space_viewthread_procpost($v);
						$list[$v['tid']]['message']['message'] = str_replace('$', '', $list[$v['tid']]['message']['message']);	
						$list[$v['tid']]['message']['message'] = preg_replace("/\(.*\)\.innerHTML.*\);/isU", "", $list[$v['tid']]['message']['message']);
						$list[$v['tid']]['message']['message'] = cutstr($list[$v['tid']]['message']['message'], 200, '...');
					}
				}									
				memory('set', $memKey, $list, 600);
			}
			
			$nextpage = $page + 1;
			$prevpage = $page - 1;
		}
		
	} elseif($viewtype == 'postcomment') {
		$posttable = getposttable('p');
		require_once libfile('function/post');
		$query = DB::query("SELECT c.*, p.authorid, p.tid, p.pid, p.fid, p.invisible, p.dateline, p.message, t.special, t.status, t.subject, t.digest,t.attachment, t.replies, t.views, t.lastposter, t.lastpost
			FROM ".DB::table('forum_postcomment')." c
			LEFT JOIN ".DB::table($posttable)." p ON p.pid = c.pid
			LEFT JOIN ".DB::table('forum_thread')." t ON t.tid = c.tid
			WHERE c.authorid = '$space[uid]' ORDER BY c.dateline DESC LIMIT $start, $perpage");
		$list = $fids = array();
		while($value = DB::fetch($query)) {
			$fids[] = $value['fid'];
			$value['comment'] = messagecutstr($value['comment'], 100);
			$list[] = procthread($value);
		}
		if($fids) {
			$fids  = array_unique($fids);
			$query = DB::query("SELECT fid, name FROM ".DB::table('forum_forum')." WHERE fid IN (".dimplode($fids).")");
			while($forum = DB::fetch($query)) {
				$forums[$forum['fid']] = $forum['name'];
			}
		}

		$multi = simplepage(count($list), $perpage, $page, $theurl);
		$need_count = false;

	} else {
		
		$threadsql  = '';
		$postsql 	= "p.authorid='{$space['uid']}'";
		if($filter == 'recyclebin') {
			$postsql 	.= " AND p.invisible='-1'";
		} elseif($filter == 'aduit') {
			$postsql 	.= " AND p.invisible='-2'";
		} elseif($filter == 'save') {
			$postsql 	.= " AND p.invisible='-3'";
		} elseif($filter == 'close') {
			$threadsql  .= " AND t.closed='1'";
		} elseif($filter == 'common') {
			$postsql    .= " AND p.invisible='0'";
			$threadsql  .= " AND t.displayorder>='0' AND t.closed='0'";
		} elseif($space['uid'] != $_G['uid']) {
			if($allowviewuserthread === false && $_G['adminid'] != 1) {
				showmessage('ban_view_other_thead');
			}
			if(!$allowviewuserthread && $_G['adminid'] != 1) {
				showmessage('allow_view_other_thead_but_no_detail');
			}
			$threadsql .= '';
		}
		$postsql  .= " AND p.first='0'";
		$posttable = getposttable('p');
		
		require_once libfile('function/post');
		
		$list = $fids = array();
		if ($onlyUc) {
			//若是mencache已到期，则重新缓存
			$memKey    = "cache_ucenter_reply_list_{$space['uid']}_{$page}";
			$memList   = memory('get', $memKey);
			if ($memList) {
				$list 	  = $memList['list'];
				$forpids  = $memList['forpids'];
				$postList = $memList['postList'];
			} else {
				if ($replyCount) {
							
					$forpids = $pids = $postList = array();
					$sql  = "SELECT p.authorid, p.tid, p.pid, p.fid, p.dateline, p.message, p.status, t.subject, t.replies, t.views FROM ".DB::table($posttable)." p ";
					$sql .= " INNER JOIN ".DB::table('forum_thread')." t ON t.tid=p.tid ";
					$sql .= " WHERE p.authorid={$space['uid']} AND p.first=0 and t.displayorder>=0 ";
					$sql .= $space['self'] ? " and t.fid not in ({$notfids}) " : " and t.fid in ({$infids}) ";				
					$sql .= " ORDER BY p.dateline DESC LIMIT {$start},{$perpage} ". getSlaveID();
					$query = DB::query($sql);		
					while($v = DB::fetch($query)) {
						$_list[] = $v;	
						$tids[]  = $v['tid'];
					}				
					$index   = 0;
					foreach ($_list as $k=>$v) {					
						$v['dateU']   	 	= $v['dateline'];						
						$v['views']  	   += get_redis_views($v['tid'],'viewthread');
						$tempv 	   			= $v;
						$list[$v['tid']][$index]  = space_viewthread_procpost($tempv);
						$list[$v['tid']][$index]  = array_merge($v, $list[$v['tid']][$index]);
						$list[$v['tid']][$index]['message']	= !getstatus($v['status'], 2) || $v['authorid'] == $_G['uid'] ? $list[$v['tid']][$index]['message'] : '';
						$forpids[$v['pid']]	= $v['pid'];										
						$index++;
					}
				}		
				if ($forpids) {
					//获得回复人author
					$forpids  = implode(',', $forpids);
					$query 	  = DB::query("SELECT pid,forpid FROM ".DB::table('forum_postcomment')." WHERE forpid in ({$forpids}) " . getSlaveID());
					$forpids  = array();
					while($v = DB::fetch($query)) {
						$pids[$v['pid']] 	   = $v['pid'];
						$forpids[$v['forpid']] = $v['pid'];
					}
				}
						
				if ($pids) {
					$pids  = implode(',', $pids);
					$query = DB::query("SELECT author,authorid,pid FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) " . getSlaveID());
					while($v = DB::fetch($query)) {
						$postList[$v['pid']]['author']   = $v['author'];
						$postList[$v['pid']]['authorid'] = $v['authorid'];
					}
				}
				
				$memList['list'] 	 = $list;
				$memList['forpids']  = $forpids;
				$memList['postList'] = $postList;
				memory('set', $memKey, $memList, 600);
			}
			
			$nextpage = $page + 1;
			$prevpage = $page - 1;
			
		} else {
			$sql   = "SELECT p.authorid, p.tid, p.pid, p.fid, p.invisible, p.dateline, p.message, t.special, t.status, t.subject, t.digest,t.attachment, t.replies, t.views, t.lastposter, t.lastpost, t.displayorder FROM ".DB::table($posttable)." p
			INNER JOIN ".DB::table('forum_thread')." t ON t.tid=p.tid {$threadsql}
			WHERE {$postsql} ORDER BY p.dateline DESC LIMIT {$start},{$perpage} " . getSlaveID();
			$query = DB::query($sql);	
			 		
			while($value = DB::fetch($query)) {
				$fids[] = $value['fid'];
				$value['message'] = !getstatus($value['status'], 2) || $value['authorid'] == $_G['uid'] ? messagecutstr($value['message'], 100) : '';
				$list[] = procthread($value);
				$tids[$value['tid']] = $value['tid'];
			}
			
			$multi = simplepage(count($list), $perpage, $page, $theurl);
			
			if($fids) {
				$query = DB::query("SELECT fid, name FROM ".DB::table('forum_forum')." WHERE fid IN (".dimplode($fids).")");
				while($forum = DB::fetch($query)) {
					$forums[$forum['fid']] = $forum['name'];
				}
			}	
		}	

		$need_count = false;
	}
	$orderactives = array($viewtype => ' class="a"');	

} else {

	space_merge($space, 'field_home');

	if($space['feedfriend']) {

		$fuid_actives = array();

		require_once libfile('function/friend');
		$fuid = intval($_GET['fuid']);
		if($fuid && friend_check($fuid, $space['uid'])) {
			$wheresql .= " AND t.authorid='$fuid'";
			$fuid_actives = array($fuid=>' selected');
		} else {
			$wheresql  .= " AND t.authorid IN ($space[feedfriend])";
			$theurl 	= "home.php?mod=space&uid=$space[uid]&do=$do&view=we";
		}

		$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$_G[uid]' ORDER BY num DESC LIMIT 0,100");
		while ($value = DB::fetch($query)) {
			$userlist[] = $value;
		}
	} else {
		$need_count = false;
	}
}

$actives = array($_G['gp_view'] =>' class="a"');

if($need_count) {
	if($searchkey = stripsearchkey($_GET['searchkey'])) {
		$wheresql .= " AND t.subject LIKE '%$searchkey%'";
		$searchkey = dhtmlspecialchars($searchkey);
	}

	$havecache = false;
	if($_G['gp_view'] == 'all') {
		$cachetime = $_G['gp_order'] == 'hot' ? 43200 : 3000;
		if(!empty($_G['cache']['space_thread'][$alltype]) && is_array($_G['cache']['space_thread'][$alltype])) {
			$threadarr = $_G['cache']['space_thread'][$alltype];
			if(!empty($threadarr['dateline']) && $threadarr['dateline'] > $_G['timestamp'] - $cachetime) {
				$list 		= $threadarr['data'];
				$forums 	= $threadarr['forums'];
				$hiddennum 	= $threadarr['hiddennum'];
				$havecache 	= true;
			}
		}
	}
	if(!$havecache) {
		$query = DB::query("SELECT t.* FROM ".DB::table('forum_thread')." t WHERE {$wheresql} LIMIT {$start},{$perpage}");
		$fids  = $forums = $tids = $postList = array();
		while($value = DB::fetch($query)) {
			if(empty($value['author']) && $value['authorid'] != $_G['uid']) {
				$hiddennum++;
				continue;
			}
			$fids[$value['fid']] = $value['fid'];
			$tids[$value['tid']] = $value['tid'];
			$value['views'] += get_redis_views($value['tid'],'viewthread');
			$list[] = $onlyUc ? $value : procthread($value);
		}
		if($fids) {
			$query = DB::query("SELECT fid, name, status FROM ".DB::table('forum_forum')." WHERE fid IN (".dimplode($fids).")");
			while($forum = DB::fetch($query)) {
				$forums[$forum['fid']] = $forum['name'];
			}
		}
		foreach($list as $k => $v) {
			if($forums[$v[fid]['status']] != 3 && $v['closed'] > 1) {
				unset($list[$k]);
				unset($tids[$v['tid']]);
				$hiddennum++;
			}
		}
		if($tids && $onlyUc) {
			$query = DB::query("SELECT * FROM ".DB::table('forum_post')." WHERE tid IN (".dimplode($tids).") and first = 1 " . getSlaveID());
			while($v = DB::fetch($query)) {
				$postList[$v['tid']] = space_viewthread_procpost($v);
			}
		}
		if($_G['gp_view'] == 'all') {
			$_G['cache']['space_thread'][$alltype] = array(
				'dateline' 	=> $_G['timestamp'],
				'hiddennum' => $hiddennum,
				'forums' 	=> $forums,
				'data' 		=> $list
			);
			save_syscache('space_thread', $_G['cache']['space_thread']);
		}
	}

	if($_G['gp_view'] != 'all') {
		$multi = simplepage(count($list)+$hiddennum, $perpage, $page, $theurl);
	}
}

$navtitle = $_G['gp_type'] == 'reply' ? "{$space['username']}的回复" : "{$space['username']}的帖子";
$metakeywords 		= $navtitle;
$metadescription 	= $navtitle;

if ($onlyUc) {
	//个人中心的主题模板不走原来的模板，梳理程序
	include_once template("home/space_thread_uc");
} else {
	include_once template("diy:home/space_thread");
}

?>