<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_notice.php 16279 2010-09-02 09:33:15Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$perpage = 100;
$perpage = mob_perpage($perpage);

$page = empty($_GET['page'])?0:intval($_GET['page']);
if($page<1) $page = 1;
$start = ($page-1)*$perpage;

ckstart($start, $perpage);

$list = array();
$count = 0;
$multi = '';

$view = (!empty($_GET['view']) && in_array($_GET['view'], array('userapp')))?$_GET['view']:'notice';
$actives = array($view=>' class="a"');

if($view == 'userapp') {

	space_merge($space, 'status');

	if($_GET['op'] == 'del') {
		$appid = intval($_GET['appid']);
		DB::query("DELETE FROM ".DB::table('common_myinvite')." WHERE appid='$appid' AND touid='$_G[uid]'");

		$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('common_myinvite')." WHERE touid='$_G[uid]'"), 0);
		$changecount = $count - $space['myinvitations'];
		if($changecount) {
			member_status_update($_G['uid'], array('myinvitations' => $changecount));
		}

		showmessage('do_success', "home.php?mod=space&do=notice&view=userapp&quickforward=1");
	}

	$filtrate = 0;
	$count = 0;
	$apparr = array();
	$type = intval($_GET['type']);
	$query = DB::query("SELECT * FROM ".DB::table('common_myinvite')." WHERE touid='$_G[uid]' ORDER BY dateline DESC");
	while ($value = DB::fetch($query)) {
		$count++;
		$key = md5($value['typename'].$value['type']);
		$apparr[$key][] = $value;
		if($filtrate) {
			$filtrate--;
		} else {
			if($count < $perpage) {
				if($type && $value['appid'] == $type) {
					$list[$key][] = $value;
				} elseif(!$type) {
					$list[$key][] = $value;
				}
			}
		}
	}

	if(empty($count) && $space['myinvitations']) {
		$changecount = 0 - $space['myinvitations'];
		if($changecount) {
			member_status_update($_G['uid'], array('myinvitations' => $changecount));
		}
	}

} else {
	space_merge($space, 'status');

	if(!empty($_GET['ignore'])) {
		DB::update('home_notification', array('new'=>'0', 'from_num'=>0), array('new'=>'1', 'uid'=>$_G['uid']));

		$changecount = 0 - $space['notifications'];
		if($changecount) {
			member_status_update($_G['uid'], array('notifications' => $changecount));
		}
	}

	foreach (array('wall', 'piccomment', 'blogcomment', 'clickblog', 'clickpic', 'sharecomment', 'doing', 'friend', 'credit', 'bbs', 'system', 'thread', 'task', 'group') as $key) {
		$noticetypes[$key] = lang('notification', "type_$key");
	}

	$type = trim($_GET['type']);
	$typesql = $type?"AND type='$type'":'';

	$fuids = $newids = array();
    $history = empty($_G['gp_history']) ? 0 : $_G['gp_history'];
    $tablename = $history == 1 ? DB::table('plugin_notification_history') : DB::table('home_notification');
	$count = DB::result(DB::query("SELECT COUNT(*) FROM {$tablename} WHERE uid='$_G[uid]' $typesql"), 0);
    if(!$history){
        $invite_thread = memory('get' , 'plugin_invite_cache_uid_'.$_G['uid']);
        if(!$invite_thread){
            $invite_thread = array();
            $query = DB::query('SELECT im.* FROM '.DB::table('plugin_invite_relation').' ir LEFT JOIN '.DB::table('plugin_invite_message').' im ON ir.mid = im.mid WHERE ir.status = 1 AND ir.tousers LIKE \'%('.$_G['uid'].')%\' ORDER BY ir.dateline DESC ' . getSlaveID());
            while($v = DB::fetch($query)){
                $reads_mid = memory('get' , 'plugin_invite_cache_mid_reads_'.$v['mid']);
                if(!$reads_mid){
                    $midread = DB::result_first("SELECT readuid FROM ".DB::table('plugin_invite_readed')." WHERE mid = {$v[mid]}");
                    $reads_mid = explode(',' ,$midread);
                    memory('set' , 'plugin_invite_cache_mid_reads_'.$v['mid'] , $reads_mid , 3600);
                }
                if(in_array($_G['uid'] , $reads_mid)) continue;
                $v['style'] = 'color:#000;font-weight:bold;';
                $invite_thread['invite_'.$v['mid']] = $v;
            }
            if(empty($invite_thread)){
                $invite_thread = 'null';
            }
            memory('set' , 'plugin_invite_cache_uid_'.$_G['uid'] , $invite_thread , 60);
        }
    }
    /*2014-1-22 增加浏览后，清空对新邀请的数量 by JiangHong*/
    /*require_once libfile('class/myredis');
	$redis = & myredis::instance(6378);
	$redis->zRem("common_member_invite_users_list", 'uid_' . $_G['uid']);
    /*end*/
	if($count) {
		$query = DB::query("SELECT * FROM {$tablename} WHERE uid='$_G[uid]'  $typesql ORDER BY new DESC, dateline DESC LIMIT $start,$perpage");
		while ($value = DB::fetch($query)) {
			if($value['new']) {
				$newids[] = $value['id'];
				$value['style'] = 'color:#000;font-weight:bold;';
			} else {
				$value['style'] = '';
			}
			$fuids[$value['id']] = $value['authorid'];
			if($value['from_num'] > 0) $value['from_num'] = $value['from_num'] - 1;
			$list[$value['id']] = $value;
		}
		if($fuids) {
			require_once libfile('function/friend');
			friend_check($fuids);

			foreach($fuids as $key => $fuid) {
				$value = array();
				$value['isfriend'] = $fuid==$space['uid'] || $_G["home_friend_".$space['uid'].'_'.$fuid] ? 1 : 0;
				$list[$key] = array_merge($list[$key], $value);
			}

		}
		$multi = multi($count, $perpage, $page, "home.php?mod=space&do=$do".($history == 1 ? "&history=1" : ""));
	}
	$newnotice = $space['notifications'];
	if($newids) {
		DB::query("UPDATE {$tablename} SET new='0', from_num='0' WHERE id IN (".dimplode($newids).")");
		$newcount = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('home_notification')." WHERE uid='$_G[uid]' AND new='1'"), 0);
        $newcount += DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('plugin_notification_history')." WHERE uid='$_G[uid]' AND new='1'"), 0);
		$changecount = $newcount - $space['notifications'];
		if($changecount) {
			member_status_update($_G['uid'], array('notifications' => $changecount));
		}

		$space['notifications'] = $newcount;
	}

	$updatenotice = array();
	if($newnotice) {
		$updatenotice['notifications'] = -$newnotice;
	}
if($page < 2 && $history != 1){
	$newprompt = 0;
	foreach (array('notifications','myinvitations','pokes','pendingfriends') as $key) {
		$newprompt = $newprompt + $space[$key];
	}

	if($newprompt != $space['newprompt']) {
		$space['newprompt'] = $newprompt;
		DB::update('common_member', array('newprompt'=>$newprompt), array('uid'=>$_G['uid']));
	}

	if($newprompt) {
		$pokes = $pendingfriends = array();
		if($space['pendingfriends']) {
			$query = DB::query("SELECT * FROM ".DB::table('home_friend_request')." WHERE uid='$_G[uid]' ORDER BY dateline DESC LIMIT 0, 2");
			while($value = DB::fetch($query)) {
				$pendingfriends[] = $value;
			}
			if(empty($pendingfriends)) {
				$updatenotice['pendingfriends'] = -$space['pendingfriends'];
			}
		}
		if($space['pokes']) {
			$query = DB::query("SELECT * FROM ".DB::table('home_poke')." WHERE uid='$_G[uid]' ORDER BY dateline DESC LIMIT 0, 2");
			while($value = DB::fetch($query)) {
				$pokes[] = $value;
			}
			if(empty($pokes)) {
				$updatenotice['pokes'] = -$space['pokes'];
			}
		}
	}

	if(!empty($updatenotice)) {
		member_status_update($_G['uid'], $updatenotice);
	}
}
}
//新增推荐的商业好友,每行3个显示，当不足行时会自动减一行 2012-06-19 by jianghong
$friendstatus = memory('get' , 'plugin_friendoption_status');
if(!$friendstatus){
    $numfriends = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_friendoption')." WHERE friendsetting = 1");
    $friendstatus = $numfriends > 0 ? 1 : -1;
    memory('set' , 'plugin_friendoption_status' , $friendstatus , 3600 * 12);
}
if($friendstatus == 1){
    $m_title = "用户推荐";
    $m_row = 2;//行
    $m_perrow = 3;//每行显示3个，改动需变动样式
    $max_friend_auto = $m_row * $m_perrow;
    $his_friend = array();
    //新增过滤掉已经是好友的推荐用户 2012-06-20 by jianghong
    if($_G['uid']!=""){
        $query=DB::query("SELECT fuid FROM ".DB::TABLE('home_friend')." WHERE uid=".$_G['uid']);
        while($ff = DB::fetch($query)){
            $his_friend[]=$ff['fuid'];
        }
        $his_friend[count($his_friend)] = $_G['uid'];
    }
    $query=DB::query("SELECT * FROM ".DB::TABLE('plugin_friendoption')." WHERE friendsetting = 1");
    $auto_list = array();
    while($value = DB::fetch($query)){
        if(!in_array($value['uid'],$his_friend)){
            $auto_list[]=$value;
        }
    }
    if(count($auto_list)>0){
        if(count($auto_list)<$m_perrow){
            $max_friend_auto = count($auto_list);
        }
        while(count($auto_list)<$max_friend_auto){
            $m_row--;
            $max_friend_auto = $m_row * $m_perrow;
        }
        //当推荐的商户大于最大的显示量时，将采取随机显示推荐的信息
        if(count($auto_list)>$max_friend_auto){
            $m_list = array();
            for($im=0;$im<$max_friend_auto;$im++){
                $math = rand(0,(count($auto_list)-1-$im));//每次循环减少一个随机数最大值，将放在结尾的随机过的数排除掉
                $m_list[$im] = $auto_list[$math];
                $auto_list[$math]=$auto_list[(count($auto_list)-1-$im)];//将数组最后的放在刚随机过的位置上，排除重复可能
            }
        }
        else{
            $m_list = array();
            for($in=0;$in<count($auto_list);$in++){
                $m_list[$in]=$auto_list[$in];
            }
        }
    }
}
//以上部分为新增2012-06-19 by jianghong
dsetcookie('promptstate_'.$_G['uid'], $newprompt, 31536000);
include_once template("diy:home/space_notice");

?>