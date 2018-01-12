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

	$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_travelread')." where tid = {$tid} " . getSlaveID());
	if (empty($travelShow)) {
		@header("http/1.1 404 not found");
		@header("status: 404 not found");
		include template("common/404");
		exit();
	}

	$threadShow = DB::fetch_first("SELECT dateline, views, typeid, readmodel FROM ".DB::table('forum_thread')." where tid = {$tid} " . getSlaveID());

	//redis更新、读取点击数
	require_once libfile('function/forumlist');
    viewthread_updateviews();
    $threadShow['views'] += get_redis_views($tid,'viewthread');

    /*浏览过的用户*/
	setReadmodelCache($tid, $_G['uid'], 14, $initUids, 'views');
	$viewsuids = readmodelCache($tid, 10, 'views');
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

	//根据fid和typeid查询域名信息
	$dom = $forumOption->getdomainbyfid($_G['fid']);
	$dm  = $forumOption->getdomainbyfidandtypeid($_G['fid'], $threadShow['typeid']);

    //文章
	$travelShow['apids'] = $travelShow['apids'] ? explode(',', $travelShow['apids']) : array();
	$pids = array_slice($travelShow['apids'], $start, $perpage);
	$pids = $pids ? implode(',', $pids) : '';
	$message = '';
	if($pids) {
		$sql   = "SELECT message, pid FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) order by pid asc " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$message .= readmodelMessage($v['message'], 0, $v['pid']);
		}
	}

	//文章的分页
	$count  = $travelShow['acnt'];
	$theurl = "forum.php?mod=readmodeltravel&action=show&tid={$tid}";
	$multi  = multi($count, $perpage, $page, $theurl);
	$multi  = str_replace('&amp;', '&', $multi);
	$multi  = preg_replace('/forum\.php\?mod=readmodeltravel&action=show&tid=(\d+)&page=(\d+)/ise', "_rewriteUrl('\\1', '\\2')", $multi);

	//推荐评论
	$blockquote 	     = array();
	$travelShow['rpids'] = $travelShow['rpids'] ? explode(',', $travelShow['rpids']) : array();
	$travelShow['rpids'] = array_reverse($travelShow['rpids']);
	$pids  = array_slice($travelShow['rpids'], 0, 10);
	$pids  = $pids ? implode(',', $pids) : '';
	if($pids){
		$pids =rtrim($pids,',');
	}
	$rList = array();
	if($pids) {
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
	if($pids){
		$pids =rtrim($pids,',');
	}
	$cList = array();
	if($pids) {
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
	if($pids){
		$pids =rtrim($pids,',');
	}
	if($pids) {
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

	//作者的等级信息
	include_once libfile('function/home');
	loadcache('usergroups');
	$space = getspace($travelShow['authorid']);
	$space['group'] = $_G['cache']['usergroups'][$space['groupid']];

	/*相关游记*/
	$sql     = "SELECT placeid, level FROM ".DB::table('forum_travelread_tid_place')." WHERE tid = {$tid} " . getSlaveID();
	$query   = DB::query($sql);
	$rsql    = array();
	while ($v = DB::fetch($query)) {
		$rsql[] = "( SELECT tid  FROM ".DB::table('forum_travelread_tid_place')." WHERE placeid = {$v['placeid']} AND level = {$v['level']} ) ";
	}
	$tids1	   = array();
	$tids2	   = array();
	$releList  = array();
	if ($rsql) {
		$key_array = array();
		$rsql 	   = implode(' union all ', $rsql) . ' limit 100 ' . getSlaveID();
		$query     = DB::query($rsql);
		while ($v = DB::fetch($query)) {
			$tids1[$v['tid']]['tid'] = $v['tid'];
			$tids1[$v['tid']]['cnt']++;
		}
		unset($tids1[$travelShow['tid']]);
		foreach ($tids1 as $v) {
			$key_array[] = $v['cnt'];
		}
		array_multisort($key_array, SORT_DESC, $tids1);
		$tids1 = array_slice($tids1, 0, 10);
		foreach ($tids1 as $v) {
			$tids2[$v['tid']] = $v['tid'];
		}
		if ($tids2) {
			$temptids = implode(',', $tids2);
			$sql      = "SELECT tid, subject, pic  FROM ".DB::table('forum_travelread')." WHERE tid in ({$temptids}) AND isshow=1 " . getSlaveID();
			$query    = DB::query($sql);
			while ($v = DB::fetch($query)) {
				if (empty($v['pic'])) {continue;}
				$v['pic']    .= strpos($v['pic'], 'image1.8264.com') === false ? "" : "!t2w400h300";
				$v['subject'] = mb_substr($v['subject'], 0, 50, 'gbk');
				$tempviews    = DB::result_first("SELECT views FROM ".DB::table('forum_thread')." where tid = {$v['tid']} " . getSlaveID());
    			$v['views']   = $tempviews + get_redis_views($v['tid'],'viewthread');
				$releList[$v['tid']]   = $v;
			}
		}
	}

	$tempCnt = count($releList);
	if ($tempCnt < 3) {
		$sql      = "SELECT tid, subject, pic FROM ".DB::table('forum_travelread')." WHERE isshow=1 ORDER BY dateline DESC LIMIT 10 " . getSlaveID();
		$query    = DB::query($sql);
		while ($v = DB::fetch($query)) {
			if (isset($tids2[$v['tid']])) {continue;}
			if ($travelShow['tid'] == $v['tid']) {continue;}
			$v['pic']    .= strpos($v['pic'], 'image1.8264.com') === false ? "" : "!t2w400h300";
			$v['subject'] = mb_substr($v['subject'], 0, 50, 'gbk');
			$tempviews    = DB::result_first("SELECT views FROM ".DB::table('forum_thread')." where tid = {$v['tid']} " . getSlaveID());
			$v['views']   = $tempviews + get_redis_views($v['tid'],'viewthread');
			$releList[$v['tid']]   = $v;

			$tids2[$v['tid']] = $v['tid'];
			$tempCnt++;
			if ($tempCnt >= 3) {
				break;
			}
		}
	}
	/*相关游记 end*/

	//标签
	$placeList      = array();
	$placenameList  = array();
	$sql   = "SELECT * FROM ".DB::table('forum_travelread_tid_place')." WHERE tid = {$tid} ORDER BY level ASC " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['url'] = "{$_G['config']['web']['portal']}youji/list-{$v['placeid']}-{$v['level']}-1.html";
		$placeList[] = $v;
		$placenameList[] = $v['name'];
	}
	$placename = $placenameList ? implode('|', $placenameList) : '';
	$shareurl  = "{$_G['config']['web']['forum']}forum-readmodeltravel-action-show-tid-{$tid}-is_wei-1-shareuid-{$_G['uid']}.html";

	$pageTitle = "{$travelShow['subject']} - {$placename}游记攻略 - 8264.com";

	//推荐
	$hddata = gethddata($placeList);

	include_once template("forum/travelread_show");

} elseif ($action == 'incComment') {
	$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
	$perpage = 10;
	$page    = max($_G['gp_page'], 1);
	$start   = ($page-1) * $perpage;
	$type    = !empty($_G['gp_type']) ? $_G['gp_type'] : 'rList';

	if (empty($tid)) {
		showmessage('帖子id缺失', NULL);
	}

	$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_travelread')." where tid = {$tid} " . getSlaveID());
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

	$placeid = !empty($_G['gp_placeid']) ? number_format($_G['gp_placeid'], 0, ".", '') : 0;
	$level   = !empty($_G['gp_level']) ? intval($_G['gp_level']) : 0;
	$perpage = 20;
	$page    = max($_G['gp_page'], 1);
	$start   = ($page-1) * $perpage;

	$placename = DB::result_first("SELECT name FROM ".DB::table('forum_travelread_tid_place')." where placeid = {$placeid} AND level = {$level} " . getSlaveID());

	$travelList = array();
	$threadList = array();
	$placeList  = array();
	$tids  = array();

	if ($placeid && $level) {
		$where = $placeid && $level ? " t_t_d.placeid = {$placeid} AND t_t_d.level = {$level} " : '';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_travelread_tid_place')." t_t_d WHERE {$where} " . getSlaveID());
		if($count) {
			$temptids = array();
			$sql   = "SELECT tid  FROM ".DB::table('forum_travelread_tid_place')." t_t_d WHERE {$where} " . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$temptids[$v['tid']] = $v['tid'];
			}
			if ($temptids) {
				$temptids = implode(',', $temptids);
				$where = "t.isshow = 1 AND tid in ({$temptids})";
				$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_travelread')." t WHERE {$where} " . getSlaveID());
				$sql   = "SELECT t.tid, t.subject, t.author, t.authorid, t.summary  FROM ".DB::table('forum_travelread')." t WHERE {$where} ORDER BY t.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
				$query = DB::query($sql);
				while ($v = DB::fetch($query)) {
				    /*浏览过的用户*/
					setReadmodelCache($v['tid'], '', 14, $initUids, 'views');
					$v['viewsuids'] = readmodelCache($v['tid'], 14, 'views');
					/*浏览过的用户 end*/
					$v['summary'] = unserialize($v['summary']);

					$travelList[$v['tid']] = $v;
					$tids[$v['tid']] = $v['tid'];
				}
			}
		}
	} else {
		$where = 't.isshow = 1 ';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_travelread')." t WHERE {$where} " . getSlaveID());
		$sql   = "SELECT t.tid, t.subject, t.author, t.authorid, t.summary  FROM ".DB::table('forum_travelread')." t WHERE {$where} ORDER BY t.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
		    /*浏览过的用户*/
			setReadmodelCache($v['tid'], '', 14, $initUids, 'views');
			$v['viewsuids'] = readmodelCache($v['tid'], 14, 'views');
			/*浏览过的用户 end*/
			$v['summary'] = unserialize($v['summary']);

			$travelList[$v['tid']] = $v;
			$tids[$v['tid']] = $v['tid'];
		}
	}

	if ($tids) {
		$tids = implode(',', $tids);
		$sql   = "SELECT tid, dateline, views FROM ".DB::table('forum_thread')." WHERE tid in ({$tids}) " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['views'] += get_redis_views($v['tid'],'viewthread');
			$threadList[$v['tid']] = $v;
		}

		$sql   = "SELECT * FROM ".DB::table('forum_travelread_tid_place')." WHERE tid in ({$tids}) ORDER BY level ASC " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['url'] = "{$_G['config']['web']['portal']}youji/list-{$v['placeid']}-{$v['level']}-1.html";
			$placeList[$v['tid']][$v['placeid'].'-'.$v['level']] = $v;
		}
	}

    $allUrl   = "{$_G['config']['web']['portal']}youji/";
    $titleUrl = $placeid && $level ? "{$_G['config']['web']['portal']}youji/list-{$placeid}-{$level}-1.html" : $allUrl;
    if ($placeid && $level) {
    	$areaData = array();
    	$areaData = _getAreaInfo($placeid, $level, $areaData);
    }

	//分页
	$theurl = "forum.php?mod=readmodeltravel&action=list&placeid={$placeid}&level={$level}";
	$multi  = multi($count, $perpage, $page, $theurl);
	$multi  = str_replace('&amp;', '&', $multi);
	$multi  = preg_replace('/forum\.php\?mod=readmodeltravel&action=list&placeid=(\d+)&level=(\d+)&page=(\d+)/ise', "_rewriteUrlList('\\1', '\\2', '\\3')", $multi);

	//热门旅行地
	$hotList = array();
	$sql   = "SELECT * FROM ".DB::table('forum_travelread_place')." ORDER BY actnum DESC LIMIT 4 " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		if ($v['placeid'] == 371041028144800) {continue;}

		$hottidcount = DB::result_first("SELECT count(*) FROM ".DB::table('forum_travelread_tid_place')." WHERE placeid={$v['placeid']} AND level={$v['level']} " . getSlaveID());
		$limit_start = rand(0, ($hottidcount-1));
		$hottid = DB::result_first("SELECT tid FROM ".DB::table('forum_travelread_tid_place')." WHERE placeid={$v['placeid']} AND level={$v['level']} LIMIT {$limit_start},1 " . getSlaveID());

		setReadmodelCache($hottid, '', 14, $initUids, 'views');
		$v['viewsuids'] = readmodelCache($hottid, 3, 'views');
		$v['url'] = "{$_G['config']['web']['portal']}youji/list-{$v['placeid']}-{$v['level']}-1.html";
		$hotList[] = $v;
	}
	$hotList = array_slice($hotList, 0, 3);

	//国内旅行地
	$domesticList = array();
	$sql   = "SELECT * FROM ".DB::table('forum_travelread_place')." WHERE actnum > 0 AND level = 2 ORDER BY actnum DESC " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['url'] = "{$_G['config']['web']['portal']}youji/list-{$v['placeid']}-{$v['level']}-1.html";
		$domesticList[] = $v;
	}

	//国外旅行地
	$abroadList = array();
	$sql   = "SELECT * FROM ".DB::table('forum_travelread_place')." WHERE actnum > 0 AND level = 1 ORDER BY actnum DESC " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		if ($v['placeid'] == 371041028144800) {continue;}
		$v['url'] = "{$_G['config']['web']['portal']}youji/list-{$v['placeid']}-{$v['level']}-1.html";
		$abroadList[] = $v;
	}

	$pageTitle = $placename ? "2017".$placename."游记攻略，{$placename}户外游记，{$placename}自助游线路推荐 – 8264.com" : "2017游记攻略，户外游记，自助游线路推荐 - 8264.com";

	include_once template("forum/travelread_list");
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
	return $page == 1 ? "{$_G['config']['web']['portal']}youji/{$tid}.html" : "{$_G['config']['web']['portal']}youji/{$tid}-{$page}.html";
}
function _rewriteUrlList($placeid, $level, $page) {
	$page = intval($page);
	return "{$_G['config']['web']['portal']}youji/list-{$placeid}-{$level}-{$page}.html";
}
//获得地区信息
function _getAreaInfo($placeid, $level, $areaData) {
	if ($level == 1) {
		if($placeid){
		$areaData['nationShow'] = DB::fetch_first("SELECT id, alias FROM ".DB::table('t_nation_info')." WHERE id={$placeid} " . getSlaveID());
		$areaData['nationShow']['url'] = "{$_G['config']['web']['portal']}youji/list-{$placeid}-1-1.html";
		}
	}
	if ($level == 2) {
		if($placeid){
		$areaData['provinceShow'] = DB::fetch_first("SELECT id, alias, nation_id FROM ".DB::table('t_province_info')." WHERE id={$placeid} " . getSlaveID());
		$areaData['provinceShow']['url'] = "{$_G['config']['web']['portal']}youji/list-{$placeid}-2-1.html";
		$areaData = _getAreaInfo($areaData['provinceShow']['nation_id'], 1, $areaData);
		}
	}
	if ($level == 3) {
		if($placeid){
		$areaData['cityShow'] = DB::fetch_first("SELECT id, alias, province_id FROM ".DB::table('t_city_info')." WHERE id={$placeid} " . getSlaveID());
		$areaData['cityShow']['url'] = "{$_G['config']['web']['portal']}youji/list-{$placeid}-3-1.html";
		$areaData = _getAreaInfo($areaData['cityShow']['province_id'], 2, $areaData);
		}
	}
	if ($level == 4) {
		if($placeid){
		$areaData['areaShow'] = DB::fetch_first("SELECT id, alias, city_id FROM ".DB::table('t_area_info')." WHERE id={$placeid} " . getSlaveID());
		$areaData['areaShow']['url'] = "{$_G['config']['web']['portal']}youji/list-{$placeid}-4-1.html";
		$areaData = _getAreaInfo($areaData['areaShow']['city_id'], 3, $areaData);
		}
	}
	if ($level == 5) {
		if($placeid){
		$areaData['poiShow'] = DB::fetch_first("SELECT id, alias, area_id FROM ".DB::table('t_poi_info')." WHERE id={$placeid} " . getSlaveID());
		$areaData['poiShow']['url'] = "{$_G['config']['web']['portal']}youji/list-{$placeid}-5-1.html";
		$areaData = _getAreaInfo($areaData['poiShow']['area_id'], 4, $areaData);
		}
	}
	return $areaData;
}
//O(∩_∩)O哈哈~
function gethddata($placeList){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$arr = array();
	foreach ($placeList as $info) {
		$arr[$info['level']][] = $info['name'];
	}
	$place = '';
	if(isset($arr[2])){
		$place = $arr[2][0];
	}elseif(isset($arr[1])){
		$place = $arr[1][0];
	}
	$params = array(
		'appname' => $appname,
		'app' => 'search',
		'act' => 'recommend_3',
		'qt' => time(),
		'r' => 4,
		'place' => $place
	);
	$url = build_url($params, $appsecret);
	$json_data = file_get_contents($url);
	$data = json_decode($json_data, true);
	if ($data['errorCode'] == 0) {
		return iconv_array($data['result'], 'UTF-8', 'GBK');
	}
	return false;
}
?>
