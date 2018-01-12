<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$cookiePrefix = 'plugin_homefriend_index_';
$search = array(
	'uid' => '',
	'username' => '',
);

if ($_GET['reload']) {
    foreach ($search as $i => $item) {
        dsetcookie($cookiePrefix.$i, '', -1);
    }
}


if ($_POST['searchUser']) {
    if (!$_POST['uid'] && !$_POST['username']) {
        cpmsg('请至少填写一项数据以供搜索', 'action=plugins&operation=config&do='.$pluginid.'&identifier=homefriend&pmod=index', 'error');
    }

    $sql = "SELECT * FROM ".DB::table('common_member')." WHERE 1=1";
    if ($_POST['uid']) {
        $sql .= " AND uid = {$_POST['uid']}";
    }
    if ($_POST['username']) {
        $sql .= " AND uid = '{$_POST['username']}'";
    }
    $sql .= " LIMIT 1";

    $user = DB::fetch_first($sql);
    if (!$user) {
        cpmsg('不存在此用户', 'action=plugins&operation=config&do='.$pluginid.'&identifier=homefriend&pmod=index', 'error');
    }

    dsetcookie($cookiePrefix.'uid', $user['uid'], 999999);
    dsetcookie($cookiePrefix.'username', $user['username'], 999999);
}


$search['uid'] = getcookie($cookiePrefix.'uid');
$search['username'] = getcookie($cookiePrefix.'username');

if ($search['uid']) {
	require_once libfile('function/friend');
	function plugin_friend_delete($uid, $touid) {
		DB::delete('home_friend', "(uid='$uid' AND fuid='$touid') OR (fuid='$uid' AND uid='$touid')");

		if(DB::affected_rows()) {
			addfriendlog($uid, $touid, 'delete');
			friend_cache($uid);
			friend_cache($touid);
		}
	}

	if (isset($_GET['uid']) && $_GET['del'] == 1) {
		plugin_friend_delete($search['uid'], $_GET['uid']);
		$url = $_SERVER['QUERY_STRING'];
		$url = preg_replace('/&?uid=\d+/', '', $url);
		$url = preg_replace('/&?del=\d+/', '', $url);
		cpmsg('删除成功', $url, 'succeed');
	}

	if ($_POST['operateNum'] != NULL) {
		$url = $_SERVER['QUERY_STRING'];
		if (count($_POST['friend']) == 0) {
			cpmsg('请至少选择一条信息', $url, 'error');
		}

		$uidsArray = array_keys($_POST['friend']);
		switch ($_POST['operateNum']) {
			case '3':
				foreach ($uidsArray as $uid) {
					plugin_friend_delete($search['uid'], $uid);
				}
				cpmsg('删除成功', $url, 'succeed');
				break;
		}
	}

    if ($_POST['search']) {
        unset($_POST['search']);
        $_G['gp_page'] = 1;
        foreach ($_POST as $postid => $post) {
            dsetcookie($cookiePrefix.$postid, $post, 999999);
        }
    }

	foreach (explode(' ', 'threadsFilter postsFilter lastvisitFilter order orderType ppp') as $item) {
		$search[$item] = getcookie($cookiePrefix.$item);
	}

    if ($search['order'] == NULL) {
        $search['order'] = 3;
    }
    if ($search['orderType'] == NULL) {
        $search['orderType'] = 0;
    }
	if ($search['ppp'] == NULL) {
        $search['ppp'] = 50;
    }

	$where = '';
	if ($search['threadsFilter'] != NULL) {
        $where .= " AND c.threads <= {$search['threadsFilter']}";
    }
	if ($search['postsFilter'] != NULL) {
        $where .= " AND c.posts <= {$search['postsFilter']}";
    }
	if ($search['lastvisitFilter'] != NULL) {
		$lastvisitTime = strtotime($search['lastvisitFilter']." 23:59:59");
		//echo date("Y-m-d H:i:s", $lastvisitTime);exit;
		if ($lastvisitTime == NULL) {
			$lastvisitTime = time();
		}
        $where .= " AND s.lastvisit <= {$lastvisitTime}";
    }

	if ($_GET['deleteall'] == 1) {
		$url = $_SERVER['QUERY_STRING'];
		$url = preg_replace('/&?deleteall=\d+/', '', $url);
		$uidsArray = array();
		$query = DB::query("SELECT f.fuid FROM ".DB::table('home_friend')." AS f
							LEFT JOIN ".DB::table("common_member_status")." AS s ON f.fuid = s.uid
							LEFT JOIN ".DB::table("common_member_count")." AS c ON f.fuid = c.uid
							WHERE f.uid = {$search['uid']} $where");
		while ($value = DB::fetch($query)) {
			plugin_friend_delete($search['uid'], $value['fuid']);
		}
		cpmsg('删除成功', $url, 'succeed');
	}


    $orderBy = '';
    switch ($search['order']) {
        case 0: $order = 'c.friends'; break;
        case 1: $order = 'c.threads'; break;
        case 2: $order = 'c.posts'; break;
        case 3: $order = 's.lastvisit'; break;
        default: break;
    }
    if ($order != NULL) {
        $orderBy = " ORDER BY ".$order." ".($search['orderType']?'DESC':'ASC');
    }

    $ppp = $search['ppp'];
    $page = max(1, intval($_G['gp_page']));

    $count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('home_friend')." AS f
							   LEFT JOIN ".DB::table("common_member_status")." AS s ON f.fuid = s.uid
							   LEFT JOIN ".DB::table("common_member_count")." AS c ON f.fuid = c.uid
							   WHERE f.uid = {$search['uid']} $where");

    $friendData = array();
    $query = DB::query("SELECT f.*, s.*, c.* FROM ".DB::table('home_friend')." AS f
                        LEFT JOIN ".DB::table("common_member_status")." AS s ON f.fuid = s.uid
                        LEFT JOIN ".DB::table("common_member_count")." AS c ON f.fuid = c.uid
                        WHERE f.uid = {$search['uid']} $where
                        $orderBy, s.lastvisit ASC
                        LIMIT ".(($page - 1) * $ppp).", $ppp");

    while ($value = DB::fetch($query)) {
        $friendData[] = $value;
    }

    include 'include/friendlist.php';
    exit;
}

include 'include/index.php';
