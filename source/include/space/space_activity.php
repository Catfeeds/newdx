<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_activity.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$minhot = $_G['setting']['feedhotmin']<1?3:$_G['setting']['feedhotmin'];
$page = empty($_GET['page'])?1:intval($_GET['page']);
if($page<1) $page=1;
$id = empty($_GET['id'])?0:intval($_GET['id']);
if(empty($_GET['view'])) $_GET['view'] = 'all';
$datearray = array('week', 'nextweek', 'month', 'nextmonth', 'halfyear', 'old');
if(empty($_GET['date'])||!in_array($_GET['date'], $datearray)) $_GET['date'] = 'default';
$_GET['order'] = empty($_GET['order']) ? 'dateline' : $_GET['order'];

$activitytypelist = $_G['setting']['activitytype'] ? explode("\n", trim($_G['setting']['activitytype'])) : '';
foreach ($activitytypelist as $key=>$value) {
	$activitytypelist[$key] = trim($value);
}
if(empty($_GET['class'])||!in_array($_GET['class'], $activitytypelist)) $_GET['class'] = '';

$orderdate = array($_GET['date'] => ' class="timeone"');
if ($_GET['class']) {
	$orderclass = array($_GET['class'] => ' class="timeone"');
} else {
	$orderclass = array('default' => ' class="timeone"');
}
$orderview = array($_GET['view'] => ' class="timeone"');

$perpage = 20;
$perpage = mob_perpage($perpage);
$start = ($page-1)*$perpage;
ckstart($start, $perpage);

$list = array();
$userlist = array();
$hiddennum = $count = $pricount = 0;

//获取地区省份列表
$query = DB::query("SELECT * FROM ".DB::table('common_district')." WHERE level='1' ORDER BY id ASC");
while($value = DB::fetch($query)) {
	$arealist[$value['id']] = $value['name'];
	$areaarray[] = $value['id'];
}
//end
if(empty($_GET['area'])||!in_array($_GET['area'], $areaarray)) $_GET['area'] = 0;
$orderarea = array($_GET['area'] => ' class="timeone"');


$gets = array(
	'mod' => 'space',
	'uid' => $space['uid'],
	'do' => 'activity',
	'view' => $_GET['view'],
	'order' => $_GET['order'],
	'type' => $_GET['type'],
	'fuid' => $_GET['fuid'],
	'searchkey' => $_GET['searchkey'],
	'date' => $_GET['date'],
	'class' => $_GET['class']
);
$theurl = 'home.php?'.url_implode($gets);
$multi = '';

$wheresql = '1';
$threadsql = $apply_sql = '';

$f_index = '';
$need_count = true;
require_once libfile('function/misc');
$today = strtotime(dgmdate($_G['timestamp'], 'Y-m-d'));
if($_GET['view'] == 'all') {
	if($_GET['order'] == 'hot') {
		$threadsql .= " t.special='4'";
		$apply_sql = "INNER JOIN ".DB::table('forum_thread')." t ON t.special='4' AND t.tid = a.tid AND t.displayorder>'-1'";
	}
	$orderactives = array($_GET['order'] => ' class="a"');
} elseif($_GET['view'] == 'me') {
	$viewtype = in_array($_G['gp_type'], array('orig', 'apply')) ? $_G['gp_type'] : 'orig';
	$_GET['date'] = 'me';
	if($_GET['type'] == 'apply') {
		$wheresql = "1";
		$apply_sql = "INNER JOIN ".DB::table('forum_activityapply')." apply ON apply.uid = '$space[uid]' AND apply.tid = a.tid";
	} else {
		$wheresql = "a.uid = '$space[uid]'";
	}
	$orderactives = array($viewtype => ' class="a"');
} else {

	space_merge($space, 'field_home');

	if($space['feedfriend']) {

		$fuid_actives = array();

		require_once libfile('function/friend');
		$fuid = intval($_GET['fuid']);
		if($fuid && friend_check($fuid, $space['uid'])) {
			$wheresql = "a.uid='$fuid'";
			$fuid_actives = array($fuid=>' selected');
		} else {
			$wheresql = "a.uid IN ($space[feedfriend])";
			$theurl = "home.php?mod=space&uid=$space[uid]&do=$do&view=we";
		}

		$query = DB::query("SELECT * FROM ".DB::table('home_friend')." WHERE uid='$space[uid]' ORDER BY num DESC LIMIT 0,100");
		while ($value = DB::fetch($query)) {
			$userlist[] = $value;
		}
	} else {
		$need_count = false;
	}
}

$actives = array($_GET['view'] =>' class="a"');

if($need_count) {

	$order = '';
	$orderwhere = " a.starttimefrom";
	$weekend = strtotime('next Monday');
	$nextweekend = $weekend + 60*60*24*7;
	$monthend = strtotime(date('Y-m', strtotime('+1 month')));
	$nextmonthend = strtotime(date('Y-m', strtotime('+2 month')));
	$halfyear = strtotime(date('Y-m', strtotime('+6 month')));
	
	if ($_GET['date'] == 'old') {
		$wheresql .= " AND a.starttimefrom <'$today'";
	} elseif ($_GET['date'] == 'week') {
		$wheresql .= " AND a.starttimefrom >'$today' AND a.starttimefrom <'$weekend'";
	} elseif ($_GET['date'] == 'nextweek') {
		$wheresql .= " AND a.starttimefrom >'$weekend' AND a.starttimefrom <'$nextweekend'";
	} elseif ($_GET['date'] == 'month') {
		$wheresql .= " AND a.starttimefrom >'$today' AND a.starttimefrom <'$monthend'";
	} elseif ($_GET['date'] == 'nextmonth') {
		$wheresql .= " AND a.starttimefrom >'$monthend' AND a.starttimefrom <'$nextmonthend'";
	} elseif ($_GET['date'] == 'halfyear') {
		$wheresql .= " AND a.starttimefrom >'$halfyear'";
	} elseif ($_GET['date'] == 'me') {
		//
	} else {
		$wheresql .= " AND a.starttimefrom >'$today'";
	}
	
	if ($_GET['order'] == 'dateline') {
		if ($_GET['date']  == 'old') {
			$order = 'DESC';
		} elseif ($_GET['date']  == 'me') {
			$order = 'DESC';
		}else {
			$order = 'ASC';
		}
			
		
		
	} elseif(empty($_G['gp_order'])) {
		$order = 'DESC';
	} elseif ($_GET['order'] == 'hot') {
		$orderwhere = ' a.applynumber';
		$order = 'DESC';
	}
	
	if(!empty($_GET['class'])) {
		$wheresql .= " AND a.class = '{$_GET['class']}'";
	}

	if(!empty($_GET['area'])) {
		$wheresql .= " AND a.area = '{$_GET['area']}'";
	}
	
	if($searchkey = stripsearchkey($_GET['searchkey'])) {
		$threadsql .= " AND t.subject LIKE '%$searchkey%'";
		$searchkey = dhtmlspecialchars($searchkey);
	}
	
	$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('forum_activity')." a $apply_sql WHERE $wheresql"),0);
	if($count) {
		if($_GET['view'] == 'all' && $_GET['order'] == 'hot') {
			$apply_sql = '';
		}
		$threadsql = empty($threadsql) ? '' : $threadsql.' AND ';
		
		$query = DB::query("SELECT a.*, t.* FROM ".DB::table('forum_activity')." a $apply_sql
			INNER JOIN ".DB::table('forum_thread')." t ON $threadsql t.tid=a.tid
			WHERE t.displayorder>'-1' AND $wheresql
			ORDER BY $orderwhere $order LIMIT $start, $perpage");
	}
}

if($count) {
	loadcache('forums');
	$daytids = $tids = array();

	while ($value = DB::fetch($query)) {
		if(empty($value['author']) && $value['authorid'] != $_G['uid']) {
			$hiddennum++;
			continue;
		}
		$date = dgmdate($value['starttimefrom'], 'Ymd');
		$tids[$value['tid']] = $value['tid'];
		$value['week'] = dgmdate($value['starttimefrom'], 'w');
		$value['month'] = dgmdate($value['starttimefrom'], 'n'.lang('space', 'month'));
		$value['day'] = dgmdate($value['starttimefrom'], 'j');
		$value['time'] = dgmdate($value['starttimefrom'], 'm'.lang('space', 'month').'d'.lang('space', 'day'));
		if ($value['starttimeto']) {
			$value['endtime'] = dgmdate($value['starttimeto'], 'm'.lang('space', 'month').'d'.lang('space', 'day'));
		} else {
			$value['endtime'] = '';
		}
		if ($value['area']) $value['areaname'] = $arealist[$value['area']];
		$value['subject'] = cutstr($value['subject'], 64);
		$value['starttimefrom'] = dgmdate($value['starttimefrom']);

		$daytids[$value['tid']] = $date;
		
		$value['postdate'] = dgmdate($value['dateline'], 'Y'.lang('space', 'year').'m'.lang('space', 'month').'d'.lang('space', 'day'));
		$list[$date][$value['tid']] = procthread($value);
	}
	if($tids) {
		require_once libfile('function/post');
		$activitylist = getfieldsofposts('tid, pid, message, dateline', "tid IN (".dimplode($tids).") AND first='1'");
		foreach($activitylist as $value) {
			$date = $daytids[$value['tid']];
			$value['message'] = messagecutstr($value['message'], 150);
			$list[$date][$value['tid']]['message'] = $value['message'];
		}
	}
	$multi = multi($count, $perpage, $page, $theurl);
}
if($_G['uid']) {
	if($_GET['view'] == 'all') {
		$navtitle = lang('core', 'title_view_all').lang('core', 'title_activity');
	} elseif($_GET['view'] == 'me') {
		$navtitle = lang('core', 'title_my_activity');
	} else {
		$navtitle = lang('core', 'title_friend_activity');
	}
} else {
	if($_G['gp_order'] == 'hot') {
		$navtitle = lang('core', 'title_top_activity');
	} else {
		$navtitle = lang('core', 'title_newest_activity');
	}
}

include_once template("diy:home/space_activity");

?>