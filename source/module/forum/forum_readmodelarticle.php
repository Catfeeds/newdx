<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

include_once libfile('function/discuzcode');
include_once libfile('function/readmodelTravel');

$actions  = array('show', 'incComment', 'list');
$action   = (!empty($_GET['action']) && in_array($_GET['action'], $actions)) ? $_GET['action'] : 'show';
$initUids = array(34580208,34579525,34584350,34591519,34601139,34634293,34658450,34662174,34669571,34732759,34765037,34765948,34827390,34904368,34917534,33923076,34162277,34171897,34177772,34187409,34246381,34310721,34321028,34489764,34506056,34974326,35057226,35100093,35303332,35406372,35461288,35494020,35594130,35609394,35783338,35784530,35898171,35941107,35962608,36031128,36039945,36050500,36202932,36267751,36295870,36313785,36313802,36335766,36342768,36361460);

if ($action == 'show') {
	$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
	$perpage = 30;
	$page    = max($_G['gp_page'], 1);
	$start   = ($page-1) * $perpage;

	if (empty($tid)) {
		@header("http/1.1 404 not found");
		@header("status: 404 not found");
		include template("common/404");
		exit();
	}

	$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_articleread')." where tid = {$tid} " . getSlaveID());
	if (empty($travelShow)) {
		@header("http/1.1 404 not found");
		@header("status: 404 not found");
		include template("common/404");
		exit();
	}

	$threadShow = DB::fetch_first("SELECT dateline, views, typeid, readmodel, subject FROM ".DB::table('forum_thread')." where tid = {$tid} " . getSlaveID());

	//redis更新、读取点击数
	require_once libfile('function/forumlist');
    viewthread_updateviews();
    $threadShow['views'] += get_redis_views($tid,'viewthread');

    /*浏览过的用户*/
	setReadmodelCache($tid, $_G['uid'], 14, $initUids, 'views');
	$viewsuids = readmodelCache($tid, 14, 'views');
	/*浏览过的用户 end*/

	/*分享过的用户*/
	$shareCnt  = 0;
	$shareuid  = intval($_G['gp_shareuid']);
	setReadmodelCache($tid, $shareuid, 5, $initUids, 'share');
	$shareuids = readmodelCache($tid, 5, 'share');
	$shareCnt += $travelShow['shareInit'];
	/*分享过的用户 end*/

	//若是扫的二维码，则跳转
	if ($_G['gp_is_wei']) {
		dheader("location:{$_G['config']['web']['mobile']}thread-{$tid}-1.html");
	}

    //文章
	$travelShow['apids'] = $travelShow['apids'] ? explode(',', $travelShow['apids']) : array();
	$pids = array_slice($travelShow['apids'], $start, $perpage);
	$pids = $pids ? implode(',', $pids) : '';
	$message = '';
	if($pids) {
		$pids = rtrim($pids, ',');
		$sql   = "SELECT message, pid FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) order by pid asc " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$message .= readmodelMessage($v['message'], 0, $v['pid']);
		}
	}

	//文章的分页
	$count  = $travelShow['acnt'];
	$theurl = "forum.php?mod=readmodelarticle&action=show&tid={$tid}";
	$multi  = multi($count, $perpage, $page, $theurl);
	$multi  = str_replace('&amp;', '&', $multi);
	$multi  = preg_replace('/forum\.php\?mod=readmodelarticle&action=show&tid=(\d+)&page=(\d+)/ise', "_rewriteUrl('\\1', '\\2')", $multi);

	//推荐评论
	$blockquote 	     = array();
	$travelShow['rpids'] = $travelShow['rpids'] ? explode(',', $travelShow['rpids']) : array();
	$travelShow['rpids'] = array_reverse($travelShow['rpids']);
	$pids  = array_slice($travelShow['rpids'], 0, 10);
	$pids  = $pids ? implode(',', $pids) : '';
	$rList = array();
	if($pids) {
		$pids = rtrim($pids, ',');
		$sql   = "SELECT tid, pid, subject, author, authorid, message, dateline  FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) order by pid desc " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['message']  = readmodelMessage($v['message'], $tid, $v['pid'], $blockquote);
			$v['dateline'] = dgmdate($v['dateline']);
			$v['noticeauthormsg'] = getNoticeauthormsg($v['message']);
			$rList[] = $v;
		}
	}

	//推荐评论的分页
	$count   = $travelShow['rcnt'];
	$_G['gp_ajaxtarget'] = 'recommendPage';
	$multiR  = multi($count, 10, 1, '');


	/*全部评论及最新评论过的用户*/
	$commentuids         = array();
	$_commentuids        = array();
	$travelShow['cpids'] = $travelShow['cpids'] ? explode(',', $travelShow['cpids']) : array();
	$travelShow['cpids'] = array_reverse($travelShow['cpids']);
	$pids  = array_slice($travelShow['cpids'], 0, 10);
	$pids  = $pids ? implode(',', $pids) : '';
	$cList = array();
	if($pids) {
		$pids = rtrim($pids, ',');
		$sql   = "SELECT tid, pid, author, authorid, message, dateline  FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) order by pid desc " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['message']  = readmodelMessage($v['message'], $tid, $v['pid'], $blockquote);
			$v['dateline'] = dgmdate($v['dateline']);
			$v['noticeauthormsg'] = getNoticeauthormsg($v['message']);
			$cList[] = $v;

			$_commentuids[$v['pid']] = $v['authorid'];
		}
	}
	$pids  = array_slice($travelShow['cpids'], 10, 20);
	$pids  = $pids ? implode(',', $pids) : '';
	if($pids) {
		$pids = rtrim($pids, ',');
		$sql   = "SELECT pid, authorid  FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$_commentuids[$v['pid']] = $v['authorid'];
		}
	}
	$pids  = array_slice($travelShow['cpids'], 0, 30);
	foreach ($pids as $v) {
		$commentuids[$_commentuids[$v]] = $_commentuids[$v];
	}
	$tempCnt = count($commentuids);
	$max     = 12;
	if ($tempCnt < $max) {
		$iscycle = true;
		$usercnt = count($initUids) - 1;
		$cnt     = 0;
		while ($iscycle) {
			$rand = rand(0, $usercnt);
			$temp = !empty($initUids[$rand]) ? $initUids[$rand] : '';
			if (empty($temp) || isset($commentuids[$temp])) {continue;}
			$commentuids[$temp] = $temp;
			$cnt++;
			$iscycle = $cnt >= $max ? false : true;
		}
	}
	$commentuids = array_slice($commentuids, 0, $max);
	/*全部评论及最新评论过的用户 end*/

	//全部评论的分页
	$count   = $travelShow['ccnt'];
	$_G['gp_ajaxtarget'] = 'allPage';
	$multiC  = multi($count, 10, 1, '');

	//最新帖子
	$latestList = array();
	$sql   = "SELECT tid, subject, dateline FROM ".DB::table('forum_articleread')." order by dateline desc LIMIT 6 " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		if ($v['tid'] == $tid) {continue;}
		$v['dateline'] = dgmdate($v['dateline']);
		$v['url'] 	   = "{$_G['config']['web']['portal']}wenzhang/{$v['tid']}.html";
		$v['subject']  = mb_substr($v['subject'], 0 , 42, 'gbk');
		$latestList[]  = $v;
	}
	$latestList = array_slice($latestList, 0, 5);

	//最近帖子
	$nearestList = array();
	$sql   = "SELECT tid, subject, pic FROM ".DB::table('forum_articleread')." WHERE dateline < {$travelShow['dateline']} ORDER BY dateline DESC LIMIT 3 " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['url'] 	   = "{$_G['config']['web']['portal']}wenzhang/{$v['tid']}.html";
		$v['subject']  = mb_substr($v['subject'], 0 , 14, 'gbk');
		$v['pic']      = $v['pic'] ? $v['pic'].(strpos($v['pic'], '8264.com') === false ? "" : "!t2w450h300") : "http://static.8264.com/static/image/common/nophoto.jpg";
		$nearestList[] = $v;
	}
	$tempnum = 3 - count($nearestList);
	if ($tempnum) {
		$sql   = "SELECT tid, subject, pic FROM ".DB::table('forum_articleread')." WHERE dateline > {$travelShow['dateline']} ORDER BY dateline ASC LIMIT {$tempnum} " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['url'] 	   = "{$_G['config']['web']['portal']}wenzhang/{$v['tid']}.html";
			$v['subject']  = mb_substr($v['subject'], 0 , 14, 'gbk');
			$v['pic']      = $v['pic'] ? $v['pic'].(strpos($v['pic'], '8264.com') === false ? "" : "!t2w450h300") : "http://static.8264.com/static/image/common/nophoto.jpg";
			$nearestList[] = $v;
		}
	}

	//热门帖子
	setArticlereadCache($tid);
	$hotList = articlereadCache();
	if ($hotList) {
		$hottids = array_keys($hotList);
		$hottids = implode(',', $hottids);
		$sql     = "SELECT tid, subject, pic FROM ".DB::table('forum_articleread')." WHERE tid in ($hottids) " . getSlaveID();
		$query   = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['url'] 	   = "{$_G['config']['web']['portal']}wenzhang/{$v['tid']}.html";
			$v['subject']  = mb_substr($v['subject'], 0 , 28, 'gbk');
			$v['pic']     .= strpos($v['pic'], 'image1.8264.com') === false ? "" : "!t2w450h300";
			$hotList[$v['tid']] = $v;
		}
	}

	$shareurl  = "{$_G['config']['web']['forum']}forum-readmodelarticle-action-show-tid-{$tid}-is_wei-1-shareuid-{$_G['uid']}.html";

	/*面包屑*/
	$threadtable_info = !empty($_G['cache']['threadtable_info']) ? $_G['cache']['threadtable_info'] : array();
	$forumarchivename = $threadtable_info[$_G['forum']['threadtableid']]['displayname'] ? htmlspecialchars($threadtable_info[$_G['forum']['threadtableid']]['displayname']) : lang('core', 'archive').' '.$_G['forum']['threadtableid'];
	$upnavlink = 'forum.php?mod=forumdisplay&fid='.$_G['fid'];
	if(empty($_G['forum']['threadtableid'])) {
		$dom = $forumOption->getdomainbyfid($_G[fid]);
		if($dom){
			$navigation = '<a href="http://'.$dom.'.'.$_G['setting']['domain']['root']['forum'].'/" class="gt">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
			$forumnameurl = 'http://' . $dom . '.' . $_G['setting']['domain']['root']['forum'] . '/';
		}else{
			$navigation = '<a href="'.$upnavlink.'" class="gt">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>';
			$forumnameurl = $upnavlink;
		}
	} else {
		$navigation = '<a href="'.$upnavlink.'" class="gt">'.(strip_tags($_G['forum']['name']) ? strip_tags($_G['forum']['name']) : $_G['forum']['name']).'</a>'.'<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&archiveid='.$_G['forum']['threadtableid'].'" class="gt">'.$forumarchivename.'</a>';
		$forumnameurl = $upnavlink;
	}
	/*面包屑 end*/

	$pageTitle = "{$travelShow['subject']} - 文章阅读版 - 户外资料网8264.com";

	include_once template("forum/articleread_show");

} elseif ($action == 'incComment') {
	$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
	$perpage = 10;
	$page    = max($_G['gp_page'], 1);
	$start   = ($page-1) * $perpage;
	$type    = !empty($_G['gp_type']) ? $_G['gp_type'] : 'rList';

	if (empty($tid)) {
		showmessage('帖子id缺失', NULL);
	}

	$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_articleread')." where tid = {$tid} " . getSlaveID());
	if (empty($travelShow)) {
		showmessage('此帖子阅读版不存在', NULL);
	}

	//评论
	$blockquote = array();
	$pids = $type == 'rList' ? $travelShow['rpids'] : $travelShow['cpids'];
	$pids = $pids ? explode(',', $pids) : array();
	$pids = array_reverse($pids);
	$pids = array_slice($pids, $start, $perpage);
	$pids = $pids ? implode(',', $pids) : '';
	$commentList = array();
	if($pids) {
		$pids = rtrim($pids, ',');
		$sql   = "SELECT tid, pid, author, authorid, message, dateline  FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) order by pid desc " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['message']  = readmodelMessage($v['message'], $tid, $v['pid'], $blockquote);
			$v['dateline'] = dgmdate($v['dateline']);
			$v['noticeauthormsg'] = getNoticeauthormsg($v['message']);
			$commentList[] = $v;
		}
	}

	//评论的分页
	$count   = $type == 'rList' ? $travelShow['rcnt'] : $travelShow['ccnt'];
	$_G['gp_ajaxtarget'] = $type == 'rList' ? 'recommendPage' : 'allPage';
	$multiComment  = multi($count, $perpage, $page, '');

	include_once template("forum/travelread_comment_body");

} elseif ($action == 'list') {
	require_once libfile('function/forumlist');
	$perpage = 20;
	$page    = max($_G['gp_page'], 1);
	$start   = ($page-1) * $perpage;

	$articlelList = array();
	$threadList = array();
	$tids  = array();

	$where = 'a.isshow = 1 ';
	$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_articleread')." a WHERE {$where} " . getSlaveID());
	$sql   = "SELECT a.tid, a.subject, a.author, a.authorid, a.summary, a.pic  FROM ".DB::table('forum_articleread')." a WHERE {$where} ORDER BY a.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['summary'] = unserialize($v['summary']);
		$v['pic'] = $v['pic']? $v['pic']:'http://static.8264.com/static/images/wenzhanglistnoimg.jpg';
		$articlelList[$v['tid']] = $v;
		$tids[$v['tid']] = $v['tid'];
	}
	//var_dump($articlelList);

	if ($tids) {
		$tids = implode(',', $tids);
		$sql   = "SELECT tid, dateline FROM ".DB::table('forum_thread')." WHERE tid in ({$tids}) " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$threadList[$v['tid']] = $v;
		}
	}


	//分页
	$theurl = "forum.php?mod=readmodelarticle&action=list";
	$multi  = multi($count, $perpage, $page, $theurl);
	$multi  = str_replace('&amp;', '&', $multi);
	$multi  = preg_replace('/forum\.php\?mod=readmodelarticle&action=list&page=(\d+)/ise', "_rewriteUrlList('\\1')", $multi);


	//推荐文章
	$tjArticlelList =array();
	$sql   = "SELECT a.tid, a.subject, a.author, a.authorid,a.pic, t.dateline,t.replies  FROM ".DB::table('forum_articleread')." AS a "
		. "LEFT JOIN ".DB::table("forum_thread")." AS t "
		. "ON a.tid=t.tid "
		." WHERE a.isshow = 1 AND a.dateline > '".(TIMESTAMP-3600*24*14)."' ORDER BY t.replies desc LIMIT 5 " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['pic'] = $v['pic']? $v['pic']:'http://static.8264.com/static/images/wenzhanglistnoimg.jpg';
		$tjArticlelList[$v['tid']] = $v;
	}
	//推荐文章结束


	$pageTitle = "文章阅读版 - 户外资料网8264.com";

	include_once template("forum/articleread_list");



}

function viewthread_updateviews() {
	global $_G;

	$threadtable = 'forum_thread';

	/**声明redis**/
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6381);
	/**结束**/
	if($_G['setting']['delayviewcount'] == 1 || $_G['setting']['delayviewcount'] == 3) {
		if(substr(TIMESTAMP, -2) == '00' || $_G['uid'] == 1){
			require_once libfile('function/misc');
			updateviews_redis($threadtable, 'tid', 'views', 'viewthread', false);
		}
		/**将帖子点击存入缓存中**/
		if($myredis->connected){
			$myredis->obj->hincrby('viewthread_number',$_G['tid'],1);
            if($_G['uid'] == 1){
            	for($_i = 0; $_i <= 300; $_i++){
		        	$_re = $myredis->obj->lpop('viewthread_queue_watting');
		        	if($_re){
		        		$_re = unserialize($_re);
		        		if($_re['tid'] > 0 && $_re['views'] > 0){
		        			$myredis->obj->hincrby('viewthread_number', $_re['tid'], $_re['views']);
		        		}
		        	}else{
		        		break;
		        	}
		        }
            }
		}else{
            DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
		}
	} else {
		DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
	}
}

function _rewriteUrl($tid, $page) {
	$page = intval($page);
	return $page == 1 ? "{$_G['config']['web']['portal']}wenzhang/{$tid}.html" : "{$_G['config']['web']['portal']}wenzhang/{$tid}-{$page}.html";
}

function _rewriteUrlList($page) {
	$page = intval($page);
	return "{$_G['config']['web']['portal']}wenzhang/list-{$page}.html";
}
?>
