<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_ajax.php 18112 2010-11-12 04:30:13Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
define('NOROBOT', TRUE);

if($_G['gp_action'] == 'checkusername') {


	$username = trim($_G['gp_username']);
	$usernamelen = dstrlen($username);
	if($usernamelen < 3) {
		showmessage('profile_username_tooshort', '', array(), array('handle' => false));
	} elseif($usernamelen > 15) {
		showmessage('profile_username_toolong', '', array(), array('handle' => false));
	}

	loaducenter();
	$ucresult = uc_user_checkname($username);

	if($ucresult == -1) {
		showmessage('profile_username_illegal', '', array(), array('handle' => false));
	} elseif($ucresult == -2) {
		showmessage('profile_username_protect', '', array(), array('handle' => false));
	} elseif($ucresult == -3) {
		if(DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$username'")) {
			showmessage('register_check_found', '', array(), array('handle' => false));
		} else {
			showmessage('register_activation', '', array(), array('handle' => false));
		}
	}

} elseif($_G['gp_action'] == 'checkemail') {

	$email = trim($_G['gp_email']);
	loaducenter();
	$ucresult = uc_user_checkemail($email);

	if($ucresult == -4) {
		showmessage('profile_email_illegal', '', array(), array('handle' => false));
	} elseif($ucresult == -5) {
		showmessage('profile_email_domain_illegal', '', array(), array('handle' => false));
	} elseif($ucresult == -6) {
		showmessage('profile_email_duplicate', '', array(), array('handle' => false));
	}

} elseif($_G['gp_action'] == 'checkinvitecode') {

	$invitecode = trim($_G['gp_invitecode']);
	if(!$invitecode) {
		showmessage('no_invitation_code', '', array(), array('handle' => false));
	}
	$result = array();
	$query = DB::query("SELECT * FROM ".DB::table('common_invite')." WHERE code='$invitecode'");
	if($invite = DB::fetch($query)) {
		if(empty($invite['fuid']) && (empty($invite['endtime']) || $_G['timestamp'] < $invite['endtime'])) {
			$result['uid'] = $invite['uid'];
			$result['id'] = $invite['id'];
			$result['appid'] = $invite['appid'];
		}
	}
	if(empty($result)) {
		showmessage('wrong_invitation_code', '', array(), array('handle' => false));
	}

} elseif($_G['gp_action'] == 'checkuserexists') {

	$check = DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='".trim($_G['gp_username'])."'");
	$check ? showmessage('<img src="'.$_G['style']['imgdir'].'/check_right.gif" width="13" height="13">', '', array(), array('msgtype' => 3))
		: showmessage('username_nonexistence', '', array(), array('msgtype' => 3));

} elseif($_G['gp_action'] == 'attachlist') {

	require_once libfile('function/post');
	loadcache('groupreadaccess');
	$attachlist = getattach($_G['gp_pid'], intval($_G['gp_posttime']));
	$attachlist = $attachlist['attachs']['unused'];
	$_G['group']['maxprice'] = isset($_G['setting']['extcredits'][$_G['setting']['creditstrans']]) ? $_G['group']['maxprice'] : 0;

	include template('common/header_ajax');
	include template('forum/ajax_attachlist');
	include template('common/footer_ajax');
	dexit();

} elseif($_GET['action'] == 'loadthreadlist' && !empty($_GET['fid']) && !empty($_GET['typeid'])) {
	$fid = intval($_GET['fid']);
	$typeid = intval($_GET['typeid']);
	$page = $_GET['page'] ? max(intval($_GET['page']), 2) : 2;
	$limit_start = 6*($page-1);

	//获取子分类
	$subtypes = memory('get', 'threadclass_types_'.$typeid);
	if(!$subtypes || $_G['adminid'] == 1) {
		unset($subtypes);
		memory('rm', 'threadclass_types_'.$typeid);
		$query_threadclass = DB::query("SELECT typeid, fid, name, icon, fatherid FROM ".DB::table('forum_threadclass')." WHERE fid='$fid' AND fatherid='$typeid' ORDER BY displayorder ASC ".getSlaveID());
		while($row = DB::fetch($query_threadclass)) {
			$subtypes[$row['typeid']] = $row['name'];
		}
		memory('set', 'threadclass_types_'.$typeid, $subtypes, 864000);
	}

	if($subtypes){
		$sql_where = " AND typeid IN ('$typeid' ";
		foreach ($subtypes as $subtypeid => $subtypename) {
			$sql_where .= ", '$subtypeid'";
		}
		$sql_where .= ") ";
	}else{
		$sql_where = " AND typeid='$typeid' ";
	}

	$_G['forum_colorarray'] = array('', '#EE1B2E', '#EE5023', '#996600', '#3C9D40', '#2897C5', '#2B65B7', '#8F2A90', '#EC1282');
	$sql = "SELECT * FROM ".DB::table('forum_thread')."
			WHERE fid='$fid' AND displayorder >= 0 ".$sql_where."
			ORDER BY displayorder DESC, lastpost DESC
			LIMIT $limit_start,6";
	$query = DB::query($sql);
	while($thread = DB::fetch($query)) {
		$thread['lastposterenc'] = rawurlencode($thread['lastposter']);
		//$thread['sorthtml'] = $thread['sortid'] && !empty($_G['forum']['threadsorts']['prefix']) && isset($_G['forum']['threadsorts']['types'][$thread['sortid']]) ?
		//'<em>[<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&amp;filter=sortid&amp;sortid='.$thread['sortid'].'">'.$_G['forum']['threadsorts']['types'][$thread['sortid']].'</a>]</em>' : //'';
		$thread['multipage'] = '';
		$topicposts = $thread['special'] ? $thread['replies'] : $thread['replies'] + 1;
		$multipate_archive = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "archiveid={$_G['gp_archiveid']}" : '';
		if($topicposts > $_G['ppp']) {
			$pagelinks = '';
			$thread['pages'] = ceil($topicposts / $_G['ppp']);
			$realtid = $_G['forum']['status'] != 3 && $thread['isgroup'] == 1 ? $thread['closed'] : $thread['tid'];
			$show_pagenum = $_G['newtpl'] ? 3 : 6;
			for($i = 2; $i <= $show_pagenum && $i <= $thread['pages']; $i++) {
				$pagelinks .= "<a href=\"forum.php?mod=viewthread&tid=$realtid&amp;".(!empty($multipate_archive) ? "$multipate_archive&amp;" : '')."extra=$extra&amp;page=$i\">$i</a>";
			}
			if($thread['pages'] > $show_pagenum) {
				$pagelinks .= "..<a href=\"forum.php?mod=viewthread&tid=$realtid&amp;".(!empty($multipate_archive) ? "$multipate_archive&amp;" : '')."extra=$extra&amp;page=$thread[pages]\">$thread[pages]</a>";
			}
			$thread['multipage'] = '&nbsp;'.($_G['newtpl']?'':'...').$pagelinks;
		}

		if($thread['highlight']) {
			$string = sprintf('%02d', $thread['highlight']);
			$stylestr = sprintf('%03b', $string[0]);

			$thread['highlight'] = ' style="';
			$thread['highlight'] .= $stylestr[0] ? 'font-weight: bold;' : '';
			$thread['highlight'] .= $stylestr[1] ? 'font-style: italic;' : '';
			$thread['highlight'] .= $stylestr[2] ? 'text-decoration: underline;' : '';
			$thread['highlight'] .= $string[1] ? 'color: '.$_G['forum_colorarray'][$string[1]] : '';
			$thread['highlight'] .= '"';
		} else {
			$thread['highlight'] = '';
		}

		$thread['recommendicon'] = '';
		if(!empty($_G['setting']['recommendthread']['status']) && $thread['recommends']) {
			foreach($_G['setting']['recommendthread']['iconlevels'] as $key => $i) {
				if($thread['recommends'] > $i) {
					$thread['recommendicon'] = $key+1;
					break;
				}
			}
		}

		$thread['moved'] = $thread['heatlevel'] = 0;
		$thread['icontid'] = !$thread['moved'] && $thread['isgroup'] != 1 ? $thread['tid' ] : $thread['closed'];
		if($_G['forum']['status'] != 3 && ($thread['closed'] || ($_G['forum']['autoclose'] && TIMESTAMP - $thread[$closedby] > $_G['forum']['autoclose']))) {
			$thread['new'] = 0;
			if($thread['isgroup'] == 1) {
				$thread['folder'] = 'common';
				$grouptids[] = $thread['closed'];
			} else {
				if($thread['closed'] > 1) {
					$thread['moved'] = $thread['tid'];
					$thread['replies'] = '-';
					$thread['views'] = '-';
				}
				$thread['folder'] = 'lock';
			}
		} elseif($_G['forum']['status'] == 3 && $thread['closed'] == 1) {
			$thread['folder'] = 'lock';
		} else {
			$thread['folder'] = 'common';
			if(!IS_ROBOT && (empty($_G['cookie']['oldtopics']) || strpos($_G['cookie']['oldtopics'], 'D'.$thread['tid'].'D') === FALSE)) {
				$thread['new'] = 1;
				$thread['folder'] = 'new';
			} else {
				$thread['new'] = 0;
			}
			$thread['weeknew'] = $thread['new'] && TIMESTAMP - 604800 <= $thread['dateline'];
			//$thread['views'] += get_redis_views($thread['tid'],'viewthread');
			if($thread['replies'] > $thread['views']) {
				$thread['views'] = $thread['replies'];
			}
			if($_G['setting']['heatthread']['iconlevels']) {
				foreach($_G['setting']['heatthread']['iconlevels'] as $k => $i) {
					if($thread['heats'] > $i) {
						$thread['heatlevel'] = $k + 1;
						break;
					}
				}
			}
		}
		//加入当天发帖帖子标红操作
		if (date('Y-m-d') == date('Y-m-d',$thread['dateline'])) {
			$thread['color'] = "style='color:red;'";
		}
		$thread['dateline'] = dgmdate($thread['dateline'], 'd');
		$thread['lastpost'] = dgmdate($thread['lastpost'], 'u');
		//增加判断当是地区时，将地区置顶提取出来
	   /* $thread['displayorder'] = ($_G['gp_typeid'] > 0 && $_G['gp_typeid'] == $thread['typeid'] && $thread['typedorder']>0) ? 'p' : $thread['displayorder'];
		if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p')) ) {
			$thread['id'] = 'stickthread_'.$thread['tid'];
			$separatepos++;
		} else {
			$thread['id'] = 'normalthread_'.$thread['tid'];
		}
		if(isset($_G['setting']['verify']['enabled']) && $_G['setting']['verify']['enabled']) {
			$verifyuids[$thread['authorid']] = $thread['authorid'];
		}
		if($_G['newtpl']){
			$thread['sorthtml'] = str_replace(array('<em>[',']</em>','<em>','</em>'), '', $thread['sorthtml']);
			$thread['typehtml'] = str_replace(array('<em>[',']</em>','<em>','</em>'), '', $thread['typehtml']);
			$thread['lastpost'] = strip_tags($thread['lastpost']);

			if(in_array($thread['displayorder'], array(2,3,4))){
				$_G['forum_toplist'][] = $thread;
			} elseif(in_array($thread['displayorder'], array(1,'p'))){
				$_G['forum_middlelist'][] = $thread;
			} else {
				$_G['forum_mainlist'][] = $thread;
			}

		}
		$threadids[] = $thread['tid'];
		*/
		$threadlist[] = $thread;

		}
		$nextpage = $page + 1;
		include template('forum/ajax_threadlist');
} elseif($_G['gp_action'] == 'imagelist') {

	require_once libfile('function/post');
	$attachlist = getattach($_G['gp_pid'], intval($_G['gp_posttime']));
	$imagelist = $attachlist['imgattachs']['unused'];

	include template('common/header_ajax');
    if(isset($_G['gp_new_template']) && $_G['gp_new_template']==1){
        include template('forum/ajax_imagelist_newimage');
    }else{
        include template('forum/ajax_imagelist');
    }
	include template('common/footer_ajax');
	dexit();

} elseif($_G['gp_action'] == 'secondgroup') {

	require_once libfile('function/group');
	$groupselect = get_groupselect($_G['gp_fupid'], $_G['gp_groupid']);
	include template('common/header_ajax');
	include template('forum/ajax_secondgroup');
	include template('common/footer_ajax');
	dexit();

} elseif($_G['gp_action'] == 'displaysearch_adv') {
	$display = $_G['gp_display'] == 1 ? 1 : '';
	dsetcookie('displaysearch_adv', $display);
} elseif($_G['gp_action'] == 'checkgroupname') {
	$groupname = stripslashes(trim($_G['gp_groupname']));
	if(empty($groupname)) {
		showmessage('group_name_empty', '', array(), array('msgtype' => 3));
	}
	$tmpname = cutstr($groupname, 20, '');
	if($tmpname != $groupname) {
		showmessage('group_name_oversize', '', array(), array('msgtype' => 3));
	}
	if(DB::result_first("SELECT fid FROM ".DB::table('forum_forum')." WHERE name='".addslashes($groupname)."'")) {
		showmessage('group_name_exist', '', array(), array('msgtype' => 3));
	}
	showmessage('', '', array(), array('msgtype' => 3));
	include template('common/header_ajax');
	include template('common/footer_ajax');
	dexit();
} elseif($_G['gp_action'] == 'getthreadtypes') {
	include template('common/header_ajax');
	echo '<select name="threadtypeid">';
	if(!empty($_G['forum']['threadtypes']['types'])) {
		if(!$_G['forum']['threadtypes']['required']) {
			echo '<option value="0"></option>';
		}
		foreach($_G['forum']['threadtypes']['types'] as $typeid => $typename) {
			echo '<option value="'.$typeid.'">'.$typename.'</option>';
		}
	} else {
		echo '<option value="0" /></option>';
	}
	echo '</select>';
	include template('common/footer_ajax');
} elseif($_G['gp_action'] == 'setthreadcover') {
	$aid = intval($_G['gp_aid']);
	$tid=intval($_G['gp_tid']);
	require_once libfile('function/post');
	if($_G['forum'] && $aid) {
		DB::update('forum_attachment', array('cover' => 0), array('tid'=>$tid));
		DB::update('forum_attachment', array('cover' => 1), array('aid'=>$aid));
		showmessage('set_cover_success', '', array(), array('alert' => 'right', 'closetime' => 1));
	}
	showmessage('set_cover_fail', '', array(), array('closetime' => 3));
} elseif ( $_G['gp_action'] == 'deletepic' ) {
	include template('common/header_ajax');
	if ( $_G['uid'] ){
		$_deleteattach = array();
		if ( $_G['gp_picid'] > 0 ) {
			$_tmp = DB::fetch_first("SELECT * FROM " . DB::table( 'forum_attachment' ) . " WHERE aid = {$_G[gp_picid]} AND uid = {$_G[uid]}" );
			if ( $_tmp ) {
				$_deleteattach[] = $_tmp;
			}
		} elseif ( $_G['gp_deleteall'] == 1 ) {
			$_q = DB::query( "SELECT * FROM " . DB::table( 'forum_attachment' ) . " WHERE uid = {$_G[uid]} AND tid = 0 AND pid = 0" );
			while ( $_v = DB::fetch( $_q ) ) {
				$_deleteattach[] = $_v;
			}
		}
		if ( ! empty( $_deleteattach ) ) {
			require_once libfile( 'function/forum' );
			foreach( $_deleteattach as $_k => $_v ) {
				dunlink( $_v, $_v['dir'] );
				$d_aids[] = $_v['aid'];
			}
			DB::delete('forum_attachment', "aid IN(" . dimplode($d_aids) . ")");
		}
	}
	echo '<span></span>';
	include template('common/footer_ajax');
} elseif($_G['gp_action'] == 'loginIsAppearVerify'){
    require_once libfile('function/verify');
    $res = loginIsAppearVerify($_G['clientip'], iconv('utf-8', 'gbk', $_G['gp_username']));
    echo json_encode(array('is_yzm'=>$res));exit;
}elseif($_G['gp_action'] == 'regIsAppearVerify'){
    require_once libfile('function/verify');
    $res = regIsAppearVerify($_G['clientip']);
    echo json_encode(array('is_yzm'=>$res));exit;
}


showmessage('succeed', '', array(), array('handle' => false));
?>
