<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_space.php 17496 2010-10-20 03:03:15Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$uid = empty($_GET['uid']) ? 0 : intval($_GET['uid']);

if(in_array($_G['groupid'],array(9,11,12))){
	if($_GET['diy']){
		showmessage('等级不够,禁止装扮');
	}
}

if($_GET['username']) {
	$member = DB::fetch_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$_GET[username]' LIMIT 1");
	if(empty($member)) {
		showmessage('space_does_not_exist');
	}
	$uid = $member['uid'];
}

//添加装备分享 by zhanghongliang
// 120503 wistar 添加强驴榜
$dos = array('index', 'doing', 'blog', 'album', 'friend', 'wall',
	'notice', 'share', 'home', 'pm', 'videophoto', 'favorite',
	'thread', 'trade', 'poll', 'activity', 'debate', 'reward', 'profile','produce','identity','invite', 'ownactivity', 'dianping');

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';
if($do == 'index' && $_G['inajax']) {

	$do = 'profile';
}

if(empty($uid) || in_array($do, array('notice', 'pm'))) $uid = $_G['uid'];

if($uid) {
	$space = getspace($uid);

	if(empty($space)) {
		showmessage('space_does_not_exist');
	}

	//获得封面
	$picid = DB::result_first("SELECT picid FROM ".DB::table('home_cover')." WHERE uid={$space["uid"]} " . getSlaveID());
	if ($picid) {
		$picShow  = DB::fetch_first("SELECT filepath,serverid FROM ".DB::table('home_pic')." WHERE picid={$picid} " . getSlaveID());
	}
	if ($picShow) {
		$coverurl = getimagethumb(1500, 1500, 1, 'album/'.$picShow['filepath'], 0, $picShow['serverid']);
	}
}
if(empty($space)) {
	if(in_array($do, array('doing', 'blog', 'album', 'share', 'home', 'thread', 'trade', 'poll', 'activity', 'debate', 'reward', 'group','produce'))) {
		$_GET['view'] = 'all';
		$space['uid'] = 0;
	} else {
		showmessage('login_before_enter_home', null, array(), array('showmsg' => true, 'login' => 1));
	}
} else {

	$navtitle = $space['username'];

	if($space['status'] == -1 && $_G['adminid'] != 1) {
		showmessage('space_has_been_locked');
	}

	if(in_array($space['groupid'], array(4, 5, 6)) && ($_G['adminid'] != 1 && $space['uid'] != $_G['uid'])) {
		$_GET['do'] = $do = 'profile';
	}

	$exception = array('profile', 'index', 'album', 'friend');
	if(! in_array($do, $exception) && ! ckprivacy($do, 'view')) {
		$_G['privacy'] = 1;
		require_once libfile('space/profile', 'include');
		include template('home/space_privacy');
		exit();
	}

	if(!$space['self'] && $_GET['view'] != 'eccredit' && $_GET['do'] != 'friend') $_GET['view'] = 'me';

	get_my_userapp();

	get_my_app();
}

$diymode = 0;

$seccodecheck = $_G['setting']['seccodestatus'] & 4;
$secqaacheck = $_G['setting']['secqaa']['status'] & 2;
/*新版通知消息页面公共载入数据*/
if(in_array($_G['gp_do'], array('pm', 'notice'))){
	// 任务列表
	require_once libfile('class/task');
	$tasklib = & task::instance();
	$tasklist = $tasklib->tasklist('new');
    $tasklist_weixin  = array();
    foreach($tasklist as $key => $val){
        if($val['scriptname'] == 'weixin'){
            $tasklist_weixin[] = $val;
            unset($tasklist[$key]);
        }

        if($val['scriptname'] == 'changxian'){
            unset($tasklist[$key]);
        }
        if($val['scriptname'] == 'tiezi'){
            unset($tasklist[$key]);
        }
    }

    if($tasklist_weixin){
        foreach($tasklist_weixin as $key => $val){
            if($key > 0){
                unset($tasklist_weixin[$key]);
            }
        }
    }
    $tasklist  =  array_merge_recursive($tasklist_weixin,$tasklist);
	$taskcount = count($tasklist);
	member_status_view_update($taskcount);
	$tasklist = array_splice($tasklist, 0, 4);
}

if($_GET['do'] == 'notice') {
	if(! $_GET['ajax']) {
		space_merge($space, 'status');
	}

	$notify_type = $_G['gp_type'] ? $_G['gp_type'] : ($space['notifications'] ? 'notification'
		: ($space['newinvite'] ? 'invitation'
			: ($space['pokes'] ? 'greeting'
				: ($space['newpm'] ? 'smessage' : 'notification'))));

	$space_type = array('notification' => '通知', 'invitation' => '邀请', 'greeting' => '招呼', 'smessage' => '短消息');
	if($space_type[$notify_type]) {
		$navtitle = $space['username'] . ' - ' . $space_type[$notify_type];

		define('MESSAGE_DIR', DISCUZ_ROOT . 'source/module/message/');
		$c_path = MESSAGE_DIR . 'controller/' . $notify_type . '.controller.php';
		if(file_exists($c_path)) {
			require $c_path;
			$c_name = ucfirst($notify_type) . '_Controller';
			$action = $_GET['action'] ? $_GET['action'] : 'show';
			if(class_exists($c_name)) {
				$controller = new $c_name;
				$data = $controller->$action();

				if($data['toReadCount'] && $data['status_key']) {
					member_status_update($_G['uid'], array(
						$data['status_key'] => -($data['toReadCount'])
					));
					//$space[$data['status_key']] -= $data['toReadCount'];
				}

				//校准由于各种原因引起的数据不准的问题
				if($action == 'show' && !memory('get', "fix_notice_{$_G['uid']}")) {
					fix_member_notice($_G['uid']);
					memory('set', "fix_notice_{$_G['uid']}", 1,  43200);
				}

				//有点乱, 控制器应拆分开为ajax控制器和普通控制器, 在此未做拆分
				if($data['exit']) {
					exit($data['exit']);
				}
				extract($data);
			}
		}
	}

	include template('home/space_notice_new');
	exit;
}

//获得与访问页面的关注关系
include_once libfile('function/friend');
if(! memory('get', 'fans_follow_count_' . $space['uid'])) {
	correct_user_statistic($space['uid']);
	memory('set', 'fans_follow_count_' . $space['uid'], 1, 86400);
}
$space['mutual'] = empty($_G['uid']) || ($_G['uid'] == $space['uid']) ? 0 : followed_by_me($_G['uid'], $space['uid']);
require_once libfile('space/'.$do, 'include');

?>
