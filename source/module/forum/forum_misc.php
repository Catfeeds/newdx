<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_misc.php 23917 2011-08-16 08:25:05Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
define('NOROBOT', TRUE);

require_once libfile('function/post');
require_once libfile('function/activity');

$feed = array();
if($_G['gp_action'] == 'paysucceed') {
	$orderid = trim($_G['gp_orderid']);
	$url = !empty($orderid) ? 'forum.php?mod=trade&orderid='.$orderid : 'home.php?mod=spacecp&ac=credit';
	showmessage('payonline_succeed', $url);

} elseif($_G['gp_action'] == 'nav') {
	require_once libfile('misc/forumselect', 'include');
	exit;
//新的论坛首页点击发布帖子，弹出对话框，判断是否显示“进入论坛首页的界面”
} elseif($_G['gp_action'] == 'navnew') {

	require_once libfile('misc/forumselect', 'include');
	exit;
//新的论坛首页点击发布帖子，弹出对话框，判断是否显示“进入论坛首页的界面”
}elseif($_G['gp_action'] == 'navnewactlist') {

	require_once libfile('misc/forumselect', 'include');
	exit;

}elseif($_G['gp_action'] == 'attachcredit') {
	if($_G['gp_formhash'] != FORMHASH) {
		showmessage('undefined_action', NULL);
	}

	$aid = intval($_G['gp_aid']);
	$attach = DB::fetch_first("SELECT tid, filename FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
	$thread = DB::fetch_first("SELECT fid FROM ".DB::table('forum_thread')." WHERE tid='$attach[tid]' AND displayorder>='0'");

	checklowerlimit('getattach', 0, 1, $thread['fid']);
	$getattachcredits = updatecreditbyaction('getattach', $_G['uid'], array(), '', 1, 1, $thread['fid']);
	$_G['policymsg'] = $p = '';
	if($getattachcredits['updatecredit']) {
		if($getattachcredits['updatecredit']) for($i = 1;$i <= 8;$i++) {
			if($policy = $getattachcredits['extcredits'.$i]) {
				$_G['policymsg'] .= $p.($_G['setting']['extcredits'][$i]['img'] ? $_G['setting']['extcredits'][$i]['img'].' ' : '').$_G['setting']['extcredits'][$i]['title'].' '.$policy.' '.$_G['setting']['extcredits'][$i]['unit'];
				$p = ', ';
			}
		}
	}

	$ck = substr(md5($aid.TIMESTAMP.md5($_G['config']['security']['authkey'])), 0, 8);
	$aidencode = aidencode($aid);
	showmessage('attachment_credit', "forum.php?mod=attachment&aid=$aidencode&ck=$ck", array('policymsg' => $_G['policymsg'], 'filename' => $attach['filename']), array('redirectmsg' => 1, 'login' => 1));

} elseif($_G['gp_action'] == 'attachpay') {
	$aid = intval($_G['gp_aid']);
	$aidencode = aidencode($aid);
	if(!$aid) {
		showmessage('undefined_action', NULL);
	} elseif(!isset($_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]])) {
		showmessage('credits_transaction_disabled');
	} elseif(!$_G['uid']) {
		showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
	} else {
		$attach = DB::fetch_first("SELECT a.aid, a.tid, a.pid, a.uid, a.price, a.filename, af.description, a.readperm, m.username AS author FROM ".DB::table('forum_attachment')." a LEFT JOIN ".DB::table('forum_attachmentfield')." af ON a.aid=af.aid LEFT JOIN ".DB::table('common_member')." m ON a.uid=m.uid WHERE a.aid='$aid'");
		if($attach['price'] <= 0) {
			showmessage('undefined_action', NULL);
		}
	}

	if($attach['readperm'] && $attach['readperm'] > $_G['group']['readaccess']) {
		showmessage('attachment_forum_nopermission', NULL, array(), array('login' => 1));
	}

	$balance = getuserprofile('extcredits'.$_G['setting']['creditstransextra'][1]);
	$status = $balance < $attach['price'] ? 1 : 0;

	if($_G['adminid'] == 3) {
		$fid = DB::result_first("SELECT fid FROM ".DB::table(getposttablebytid($attach['tid']))." WHERE tid='$attach[tid]'");
		$ismoderator = DB::result_first("SELECT uid FROM ".DB::table('forum_moderator')." WHERE fid='$fid' AND uid='$_G[uid]'");
	} elseif(in_array($_G['adminid'], array(1, 2))) {
		$ismoderator = 1;
	} else {
		$ismoderator = 0;
	}
	$exemptvalue = $ismoderator ? 64 : 8;
	if($_G['uid'] == $attach['uid'] || $_G['group']['exempt'] & $exemptvalue) {
		$status = 2;
	} else {
		$payrequired = $_G['uid'] ? !DB::result_first("SELECT uid FROM ".DB::table('common_credit_log')." WHERE uid='$_G[uid]' AND relatedid='$attach[aid]' AND operation='BAC'") : 1;
		$status = $payrequired ? $status : 2;
	}
	$balance = $status != 2 ? $balance - $attach['price'] : $balance;

	$sidauth = rawurlencode(authcode($_G['sid'], 'ENCODE', $_G['authkey']));

	if(DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_credit_log')." WHERE uid='$_G[uid]' AND relatedid='$aid' AND operation='BAC'")) {
		showmessage('attachment_yetpay', "forum.php?mod=attachment&aid=$aidencode", array(), array('redirectmsg' => 1));
	}

	$attach['netprice'] = $status != 2 ? round($attach['price'] * (1 - $_G['setting']['creditstax'])) : 0;

	if(!submitcheck('paysubmit')) {
		include template('forum/attachpay');
	} else {
		if(!empty($_G['gp_buyall'])) {
			$query = DB::query("SELECT aid, price FROM ".DB::table('forum_attachment')." WHERE pid='$attach[pid]' AND price>'0'");
			$aids = $prices = array();
			$tprice = 0;
			while($tmp = DB::fetch($query)) {
				$aids[$tmp['aid']] = $tmp['aid'];
				$prices[$tmp['aid']] = $status != 2 ? array($tmp['price'], round($tmp['price'] * (1 - $_G['setting']['creditstax']))) : array(0, 0);
			}
			if($aids) {
				$query = DB::query("SELECT relatedid FROM ".DB::table('common_credit_log')." WHERE uid='$_G[uid]' AND relatedid IN (".dimplode($aids).") AND operation='BAC'");
				while($tmp = DB::fetch($query)) {
					unset($aids[$tmp['relatedid']]);
				}
			}
			foreach($aids as $aid) {
				$tprice += $prices[$aid][0];
			}
			$status = getuserprofile('extcredits'.$_G['setting']['creditstransextra'][1]) < $tprice ? 1 : 0;
		} else {
			$aids = array($aid);
			$prices[$aid] = $status != 2 ? array($attach['price'], $attach['netprice']) : array(0, 0);
		}

		if($status == 1) {
			showmessage('credits_balance_insufficient', '', array('title' => $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'], 'minbalance' => $attach['price']));
		}

		foreach($aids as $aid) {
			$updateauthor = 1;
			if($_G['setting']['maxincperthread'] > 0) {
				$extcredit = 'extcredits'.$_G['setting']['creditstransextra'][1];
				if((DB::result_first("SELECT SUM($extcredit) FROM ".DB::table('common_credit_log')." WHERE relatedid='$aid' AND uid='$attach[uid]' AND operation='SAC'")) > $_G['setting']['maxincperthread']) {
					$updateauthor = 0;
				}
			}
			if($updateauthor) {
				updatemembercount($attach['uid'], array($_G['setting']['creditstransextra'][1] => $prices[$aid][1]), 1, 'SAC', $aid);
			}
			updatemembercount($_G['uid'], array($_G['setting']['creditstransextra'][1] => -$prices[$aid][0]), 1, 'BAC', $aid);

			$aidencode = aidencode($aid);
		}

		if(count($aids) > 1) {
			showmessage('attachment_buyall', 'forum.php?mod=redirect&goto=findpost&ptid='.$attach['tid'].'&pid='.$attach['pid']);
		} else {
			$_G['forum_attach_filename'] = $attach['filename'];
			showmessage('attachment_buy', "forum.php?mod=attachment&aid=$aidencode", array('filename' => $_G['forum_attach_filename']), array('redirectmsg' => 1));
		}
	}

} elseif($_G['gp_action'] == 'viewattachpayments') {

	$aid = intval($_G['gp_aid']);
	$extcreditname = 'extcredits'.$_G['setting']['creditstransextra'][1];

	$loglist = array();
	$query = DB::query("SELECT l.*, m.username FROM ".DB::table('common_credit_log')." l
		LEFT JOIN ".DB::table('common_member')." m USING (uid)
		WHERE l.relatedid='$aid' AND l.operation='BAC' ORDER BY l.dateline");
	while($log = DB::fetch($query)) {
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		$log[$extcreditname] = abs($log[$extcreditname]);
		$loglist[] = $log;
	}
	include template('forum/attachpay_view');

} elseif($_G['gp_action'] == 'getonlines') {

	$num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_session'), 0);
	showmessage($num);

} elseif($_G['gp_action'] == 'upload') {

	$logData = array(
		'time' => date("Y-m-d H:i:s"),
		'uid' => $_G['uid'],
		'groupid' => $_G['groupid'],
		'ip' => $_G['clientip'],
		'useragent' => $_SERVER['HTTP_USER_AGENT'],
		'forum_allowpostattach'  => $_G['forum']['allowpostattach'],
		'forum_postattachperm'   => $_G['forum']['postattachperm'],
		'group_allowpostattach'  => $_G['group']['allowpostattach'],
		'attach_perm'            => forumperm($_G['forum']['postattachperm']),

		'forum_allowpostimage'   => $_G['forum']['allowpostimage'],
		'forum_postimageperm'    => $_G['forum']['postimageperm'],
		'image_perm'             => forumperm($_G['forum']['postimageperm']),

		'forum_attachextensions' => $_G['forum']['attachextensions'],
		'group_attachextensions' => $_G['group']['attachextensions'],
	);


	$_G['group']['allowpostattach'] = $_G['forum']['allowpostattach'] != -1 && ($_G['forum']['allowpostattach'] == 1 || (!$_G['forum']['postattachperm'] && $_G['group']['allowpostattach']) || ($_G['forum']['postattachperm'] && forumperm($_G['forum']['postattachperm'])));
	$_G['group']['allowpostimage'] = $_G['forum']['allowpostimage'] != -1 && ($_G['forum']['allowpostimage'] == 1 || (!$_G['forum']['postimageperm'] && $_G['group']['allowpostattach']) || ($_G['forum']['postimageperm'] && forumperm($_G['forum']['postimageperm'])));
	$_G['group']['attachextensions'] = $_G['forum']['attachextensions'] ? $_G['forum']['attachextensions'] : $_G['group']['attachextensions'];
	if($_G['group']['attachextensions']) {
		$imgexts = explode(',', str_replace(' ', '', $_G['group']['attachextensions']));
		$imgexts = array_intersect(array('jpg','jpeg','gif','png','bmp'), $imgexts);
		$imgexts = implode(', ', $imgexts);
	} else {
		$imgexts = 'jpg, jpeg, gif, png, bmp';
	}
	$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;

	if(!$allowpostimg) {

		$logData['final_allowpostattach'] = $_G['group']['allowpostattach'];
		$logData['final_allowpostimage']  = $_G['group']['allowpostimage'];
		$logData['imgexts'] 			  = $imgexts;

		//加调试日志
		require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
		$newlogs = new logs('undefined_action_uploadpic_pop');
		$newlogs->log_array($logData, 'undefined_action_uploadpic_pop');

		showmessage('undefined_action', NULL);
	}

	include template('forum/upload');

} elseif($_G['gp_action'] == 'comment') {

	if(!$_G['setting']['commentnumber']) {
		showmessage('undefined_action', NULL);
	}
	$posttable = getposttablebytid($_G['tid']);
	$post = DB::fetch_first('SELECT * FROM '.DB::table($posttable)." WHERE pid='$_G[gp_pid]'");
	if($_G['group']['allowcommentitem'] && $post['authorid'] != $_G['uid']) {
		$itemi = DB::result_first('SELECT special FROM '.DB::table('forum_thread')." WHERE tid='$post[tid]'");
		if($itemi > 0) {
			if($itemi == 2){
				$itemi = $post['first'] || DB::result_first('SELECT count(*) FROM '.DB::table('forum_trade')." WHERE pid='$post[pid]'") ? 2 : 0;
			} elseif($itemi == 127) {
				$itemi = $_G['gp_special'];
			} else {
				$itemi = $post['first'] ? $itemi : 0;
			}
		}
		$_G['setting']['commentitem'] = $_G['setting']['commentitem'][$itemi];
		if($itemi == 0) {
			loadcache('forums');
			if($_G['cache']['forums'][$post['fid']]['commentitem']) {
				$_G['setting']['commentitem'] = $_G['cache']['forums'][$post['fid']]['commentitem'];
			}
		}
		if($_G['setting']['commentitem'] && !DB::result_first('SELECT count(*) FROM '.DB::table('forum_postcomment')." WHERE pid='$_G[gp_pid]' AND authorid='$_G[uid]' AND score='1'")) {
			$commentitem = explode("\n", $_G['setting']['commentitem']);
		}
	}
	if(!$post || !($_G['setting']['commentpostself'] || $post['authorid'] != $_G['uid']) || !(($post['first'] && $_G['setting']['commentfirstpost'] && in_array($_G['group']['allowcommentpost'], array(1, 3)) || (!$post['first'] && in_array($_G['group']['allowcommentpost'], array(2, 3)))))) {
		showmessage('undefined_action', NULL);
	}
	$extra = !empty($_G['gp_extra']) ? rawurlencode($_G['gp_extra']) : '';
	$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
	$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

	include template('forum/comment');

} elseif($_G['gp_action'] == 'commentmore') {

	if(!$_G['setting']['commentnumber'] || !$_G['inajax']) {
		showmessage('undefined_action', NULL);
	}
	if(!intval($_G['tid'])) {
		showmessage('参数错误', NULL);
	}
	require_once libfile('function/discuzcode');

	$commentlimit = intval($_G['setting']['commentnumber']);
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $commentlimit;
	$comments 	 = array();
	$_comments   = array();

	//存储点评的回复列表
	$query = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and tid = ".$_G['tid']." ORDER BY dateline DESC");
	while($totalcom = DB::fetch($query)){
		$reply[] = $totalcom;
		if ($_G["gp_pid"] == $totalcom["pid"]) {
			$_comments[] = $totalcom;
		}
	}
	$_comments = array_slice($_comments, $start_limit, $commentlimit);
	foreach ($_comments as $comment) {
		for($i=0;$i<count($reply);$i++){
			$arr = $reply[$i];
			if($arr['replyid'] == $comment['id']){
				$arr['avatar'] 	 = avatar($arr['authorid'], 'small');
				$arr['dateline'] = dgmdate($arr['dateline'], 'u');
				$comment['replyComment'][] = $arr;
			}
		}

		//存储点评 回复的条数
		$comment['replyCount'] = count($comment['replyComment']);

		//将点评回复 分装为3条和全部  未 超过3条的回复threeComment键的值为空
		$comment['threeComment'] = NULL;
		$count = count($comment['replyComment']);  //点评回复的数量
		for($i=0;$i<$count;$i++){
			$comment['partComment'][] = $comment['replyComment'][$i];
			if($i>=9) break;
		}
		$comment['avatar'] 	 = avatar($comment['authorid'], 'small');
		$comment['dateline'] = dgmdate($comment['dateline'], 'u');
		$comments[] = $comment;
	}

	$totalcomment = DB::result_first('SELECT comment FROM '.DB::table('forum_postcomment')." WHERE pid='$_G[gp_pid]' AND authorid='0'");
	$totalcomment = preg_replace('/<i>([\.\d]+)<\/i>/e', "'<i class=\"cmstarv\" style=\"background-position:20px -'.(intval(\\1) * 16).'px\">'.sprintf('%1.1f', \\1).'</i>'.(\$cic++ % 2 ? '<br />' : '');", $totalcomment);
	$count = DB::result_first('SELECT count(*) FROM '.DB::table('forum_postcomment')." WHERE pid='$_G[gp_pid]' AND authorid>'0'");
	$multi = multi($count, $commentlimit, $page, "forum.php?mod=misc&action=commentmore&tid=$_G[tid]&pid=$_G[gp_pid]");
	include template('forum/comment_more');

} elseif($_G['gp_action'] == 'postappend') {

	$posttable = getposttablebytid($_G['tid']);
	$pidappend = intval($_G['gp_pid']);
	$post = DB::fetch_first("SELECT pid, tid, fid, message, authorid, author, bbcodeoff FROM ".DB::table($posttable)." WHERE pid='$pidappend'");
	if($post['authorid'] != $_G['uid']) {
		showmessage('postappend_only_yourself');
	}
	if(submitcheck('postappendsubmit')) {
		$message = censor($_G['gp_postappendmessage']);
		$message = addslashes($post['message'])."\n\n[b]".lang('forum/misc', 'postappend_content')." (".dgmdate(TIMESTAMP)."):[/b]\n$message";
		require_once libfile('function/post');
		$bbcodeoff = checkbbcodes($message, 0);
		DB::update($posttable, array(
			'message' => $message,
			'bbcodeoff' => $bbcodeoff,
		), "pid='$pidappend'");
		showmessage('postappend_add_succeed', "forum.php?mod=viewthread&tid=$post[tid]&pid=$post[pid]&page=$_G[gp_page]&extra=$_G[gp_extra]#pid$post[pid]", array('tid' => $post['tid'], 'pid' => $post['pid']));
	} else {
		include template('forum/postappend');
	}

} elseif($_G['gp_action'] == 'pubsave') {

	$thread = DB::fetch_first("SELECT tid,fid,replies FROM ".DB::table('forum_thread')." WHERE tid='$_G[tid]' AND displayorder='-4' AND authorid='$_G[uid]'");
	if(!$thread) {
		showmessage('thread_nonexistence');
	}
	$posttable = getposttablebytid($_G['tid']);
	DB::query("UPDATE ".DB::table($posttable)." SET dateline='$_G[timestamp]', invisible='0' WHERE tid='$_G[tid]'");
	DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder='0', dateline='$_G[timestamp]', lastpost='$_G[timestamp]' WHERE tid='$_G[tid]'");
	$posts = $thread['replies'] + 1;
	if($thread['replies']) {
		$dateline = $_G['timestamp'];
		$query = DB::query("SELECT pid FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='0' ORDER BY pid asc");
		while($post = DB::fetch($query)) {
			$dateline++;
			DB::query("UPDATE ".DB::table($posttable)." SET dateline='$dateline' WHERE pid='$post[pid]'");
			my_post_log('update', array('pid' => $post['pid']));
		}
	}
	my_thread_log('update', array('tid' => $thread['tid']));
	DB::query("UPDATE ".DB::table('forum_forum')." SET threads=threads+1, posts=posts+'".$posts."', todayposts=todayposts+'".$posts."' WHERE fid='$thread[fid]'", 'UNBUFFERED');
	dheader('location: '.dreferer());

} elseif($_G['gp_action'] == 'loadsave') {

	$message = '&nbsp;';
	$savepost = DB::fetch_first("SELECT message FROM ".DB::table('forum_post')." WHERE pid='$_G[gp_pid]'");
	if($savepost) {
		$message = $savepost['message'];
		if($_G['gp_type']) {
			require_once libfile('function/discuzcode');
			$message = discuzcode($message, $savepost['smileyoff'], $savepost['bbcodeoff'], $savepost['htmlon']);
		}
		$message = $message ? $message : '&nbsp;';
	}
	include template('common/header_ajax');
	echo $message;
	include template('common/footer_ajax');
	exit;

} elseif($_G['gp_action'] == 'followlist') {	//获取用户关注的人

	if(!in_array($_G['groupid'], array(1,2,3)) && $_G['groupid'] < 13) {
		echo json_encode(array());
		exit;
	}

	$data = array();
	$username = diconv(urldecode(trim($_G['gp_username'])), 'utf-8', 'gbk');

	if($username) {
		$sql = " AND fwusername LIKE '%$username%'";
	}
	$tablename = 'home_follow_'.substr($_G['uid'], -1);
	$query = DB::query("SELECT fwusername FROM ".DB::table($tablename)." WHERE uid='$_G[uid]' $sql ORDER BY attime DESC LIMIT 0,10 ".getSlaveID());
	while ($row = DB::fetch($query)) {
		$data[] = diconv($row['fwusername'], 'gbk', 'utf-8');
	}

	echo json_encode($data);
} elseif($_G['gp_action'] == 'activitytermini') {
} elseif($_G['gp_action'] == 'geterea') {
} else {

	if(empty($_G['forum']['allowview'])) {
		if(!$_G['forum']['viewperm'] && !$_G['group']['readaccess']) {
			showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
		} elseif($_G['forum']['viewperm'] && !forumperm($_G['forum']['viewperm'])) {
			showmessage('forum_nopermission', NULL, array($_G['group']['grouptitle']), array('login' => 1));
		}
	}

	$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid='$_G[tid]' AND (displayorder>='0' OR displayorder='-4' AND authorid='$_G[uid]')");
	if($thread['readperm'] && $thread['readperm'] > $_G['group']['readaccess'] && !$_G['forum']['ismoderator'] && $thread['authorid'] != $_G['uid']) {
		showmessage('thread_nopermission', NULL, array('readperm' => $thread['readperm']), array('login' => 1));
	}

	if($_G['forum']['password'] && $_G['forum']['password'] != $_G['cookie']['fidpw'.$_G['fid']]) {
		showmessage('forum_passwd', "forum.php?mod=forumdisplay&fid=$_G[fid]");
	}

	if(!$thread) {
		if(!($_G['gp_action'] == 'activityapplies' && $_G['gp_is_uc'] == 1 && $_G['gp_inajax'] == 1 && submitcheck('activitycancel'))){ //这个if是 gtl 加的在特殊情况下需要绕过这个判断 以便执行 gp_activitycancel
			showmessage('thread_nonexistence');
		}
	}

	if($_G['forum']['type'] == 'forum') {
		$navigation = '<a href="forum.php">'.$_G['setting']['navs'][2]['navname']."</a> <em>&rsaquo;</em> <a href=\"forum.php?mod=forumdisplay&fid=$_G[fid]\">".$_G['forum']['name']."</a> <em>&rsaquo;</em> <a href=\"forum.php?mod=viewthread&tid=$_G[tid]\">$thread[subject]</a> ";
		$navtitle = strip_tags($_G['forum']['name']).' - '.$thread['subject'];
	} elseif($_G['forum']['type'] == 'sub') {
		$fup = DB::fetch_first("SELECT name, fid FROM ".DB::table('forum_forum')." WHERE fid='".$_G['forum']['fup']."'");
		$navigation = '<a href="forum.php">'.$_G['setting']['navs'][2]['navname']."</a> <em>&rsaquo;</em> <a href=\"forum.php?mod=forumdisplay&fid=$fup[fid]\">$fup[name]</a> &raquo; <a href=\"forum.php?mod=forumdisplay&fid=$_G[fid]\">".$_G['forum']['name']."</a> <em>&rsaquo;</em> <a href=\"forum.php?mod=viewthread&tid=$_G[tid]\">$thread[subject]</a> ";
		$navtitle = strip_tags($fup['name']).' - '.strip_tags($_G['forum']['name']).' - '.$thread['subject'];
	}

}

if($_G['gp_action'] == 'votepoll' && submitcheck('pollsubmit', 1)) {

	if(!$_G['group']['allowvote']) {
		showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
	} elseif(!empty($thread['closed'])) {
		showmessage('thread_poll_closed', NULL, array(), array('login' => 1));
	} elseif(empty($_G['gp_pollanswers'])) {
		showmessage('thread_poll_invalid', NULL, array(), array('login' => 1));
	}

	$pollarray = DB::fetch_first("SELECT overt, maxchoices, expiration FROM ".DB::table('forum_poll')." WHERE tid='$_G[tid]'");
	$overt = $pollarray['overt'];
	if(!$pollarray) {
		showmessage('undefined_action', NULL);
	} elseif($pollarray['expiration'] && $pollarray['expiration'] < TIMESTAMP) {
		showmessage('poll_overdue', NULL, array(), array('login' => 1));
	} elseif($pollarray['maxchoices'] && $pollarray['maxchoices'] < count($_G['gp_pollanswers'])) {
		showmessage('poll_choose_most', NULL, array('maxchoices' => $pollarray['maxchoices']), array('login' => 1));
	}

	$voterids = $_G['uid'] ? $_G['uid'] : $_G['clientip'];

	$polloptionid = array();
	$query = DB::query("SELECT polloptionid, voterids FROM ".DB::table('forum_polloption')." WHERE tid='$_G[tid]'");
	while($pollarray = DB::fetch($query)) {
		if(strexists("\t".$pollarray['voterids']."\t", "\t".$voterids."\t")) {
			showmessage('thread_poll_voted', NULL, array(), array('login' => 1));
		}
		$polloptionid[] = $pollarray['polloptionid'];
	}

	$polloptionids = '';
	foreach($_G['gp_pollanswers'] as $key => $id) {
		if(!in_array($id, $polloptionid)) {
			showmessage('undefined_action', NULL);
		}
		unset($polloptionid[$key]);
		$polloptionids[] = $id;
	}

	$pollanswers = implode('\',\'', $polloptionids);

	DB::query("UPDATE ".DB::table('forum_polloption')." SET votes=votes+1, voterids=CONCAT(voterids,'$voterids\t') WHERE polloptionid IN ('$pollanswers')", 'UNBUFFERED');
	DB::query("UPDATE ".DB::table('forum_thread')." SET lastpost='$_G[timestamp]' WHERE tid='$_G[tid]'", 'UNBUFFERED');
	DB::query("UPDATE ".DB::table('forum_poll')." SET voters=voters+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');

	DB::insert('forum_pollvoter', array(
		'tid' => $_G['tid'],
		'uid' => $_G['uid'],
		'username' => $_G['username'],
		'options' => implode("\t", $_G['gp_pollanswers']),
		'dateline' => $_G['timestamp'],
		));

	updatecreditbyaction('joinpoll');

	$space = array();
	space_merge($space, 'field_home');

	if($overt && !empty($space['privacy']['feed']['newreply'])) {
		$feed['icon'] = 'poll';
		$feed['title_template'] = 'feed_thread_votepoll_title';
		$feed['title_data'] = array(
			'subject' => "<a href=\"forum.php?mod=viewthread&tid=$_G[tid]\">$thread[subject]</a>",
			'author' => "<a href=\"home.php?mod=space&uid=$thread[authorid]\">$thread[author]</a>",
			'hash_data' => "tid{$_G[tid]}"
		);
		$feed['id'] = $_G['tid'];
		$feed['idtype'] = 'tid';
		postfeed($feed);
	}
	$posttable = getposttablebytid($_G['tid']);
	$pid = DB::result_first("SELECT pid FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='1'");

	if(!empty($_G['inajax'])) {
		dheader("location: forum.php?mod=viewthread&tid=$_G[tid]&viewpid=$pid&inajax=1");
	} else {
		showmessage('thread_poll_succeed', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''));
	}

} elseif($_G['gp_action'] == 'viewvote') {

	require_once libfile('function/post');
	$polloptionid = is_numeric($_G['gp_polloptionid']) ? $_G['gp_polloptionid'] : '';

	$page = intval($_GET['page']) ? intval($_GET['page']) : 1;
	$perpage = 100;
	$overt = DB::result_first("SELECT overt FROM ".DB::table('forum_poll')." WHERE tid='$_G[tid]'");

	$polloptions = array();
	$query = DB::query("SELECT polloptionid, polloption FROM ".DB::table('forum_polloption')." WHERE tid='$_G[tid]'");
	while($options = DB::fetch($query)) {
		if(empty($polloptionid)) {
			$polloptionid = $options['polloptionid'];
		}
		$options['polloption'] = preg_replace("/\[url=(https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k|thunder|synacast){1}:\/\/([^\[\"']+?)\](.+?)\[\/url\]/i",
			"<a href=\"\\1://\\2\" target=\"_blank\">\\3</a>", $options['polloption']);
		$polloptions[] = $options;
	}

	$arrvoterids = array();
	if($overt || $_G['adminid'] == 1) {
		$voterids = '';
		$voterids = DB::result_first("SELECT voterids FROM ".DB::table('forum_polloption')." WHERE polloptionid='$polloptionid'");
		$arrvoterids = explode("\t", trim($voterids));
	}

	if(!empty($arrvoterids)) {
		$count = count($arrvoterids);
		$perpage = 100;
		$multi = $perpage * ($page - 1);
		$multipage = multi($count, $perpage, $page, "forum.php?mod=misc&action=viewvote&tid=$_G[tid]&polloptionid=$polloptionid".( $_G[gp_handlekey] ? "&handlekey=".$_G[gp_handlekey] : '' ).($_G['gp_infloat'] ? "&infloat=1" : ''));
		$arrvoterids = array_slice($arrvoterids, $multi, $perpage);
	}
	$voterlist = $voter = array();
	if($voterids = dimplode($arrvoterids)) {
		$query = DB::query("SELECT uid, username FROM ".DB::table('common_member')." WHERE uid IN ($voterids)");
		while($voter = DB::fetch($query)) {
			$voterlist[] = $voter;
		}
	}
	include template('forum/viewthread_poll_voter');

} elseif($_G['gp_action'] == 'rate' && $_G['gp_pid']) {

	if(!$_G['inajax']) {
		showmessage('undefined_action', NULL);
	}
	if(!$_G['group']['raterange']) {
		showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
	} elseif($_G['setting']['modratelimit'] && $_G['adminid'] == 3 && !$_G['forum']['ismoderator']) {
		showmessage('thread_rate_moderator_invalid', NULL);
	}
	$posttable = getposttablebytid($_G['tid']);
	$reasonpmcheck = $_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3 ? 'checked="checked" disabled' : '';
	if(($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) || !empty($_G['gp_sendreasonpm'])) {
		$forumname = strip_tags($_G['forum']['name']);
		$sendreasonpm = 1;
	} else {
		$sendreasonpm = 0;
	}

	$post = DB::fetch_first("SELECT * FROM ".DB::table($posttable)." WHERE pid='$_G[gp_pid]' AND invisible='0' AND authorid<>'0'");
	if(!$post || $post['tid'] != $thread['tid'] || !$post['authorid']) {
		showmessage('undefined_action', NULL);
	} elseif(!$_G['forum']['ismoderator'] && $_G['setting']['karmaratelimit'] && TIMESTAMP - $post['dateline'] > $_G['setting']['karmaratelimit'] * 3600) {
		showmessage('thread_rate_timelimit', NULL, array('karmaratelimit' => $_G['setting']['karmaratelimit']));
	} elseif($post['authorid'] == $_G['uid'] || $post['tid'] != $_G['tid']) {
		showmessage('thread_rate_member_invalid', NULL);
	} elseif($post['anonymous']) {
		showmessage('thread_rate_anonymous', NULL);
	} elseif($post['status'] & 1) {
		showmessage('thread_rate_banned', NULL);
	}

	$allowrate = TRUE;
	if(!$_G['setting']['dupkarmarate']) {
		$query = DB::query("SELECT pid FROM ".DB::table('forum_ratelog')." WHERE uid='$_G[uid]' AND pid='$_G[gp_pid]' LIMIT 1");
		if(DB::num_rows($query)) {
			showmessage('thread_rate_duplicate', NULL);
		}
	}

	$page = intval($_G['gp_page']);
	require_once libfile('function/misc');
	$maxratetoday = getratingleft($_G['group']['raterange']);
	if(!submitcheck('ratesubmit')) {
		$_G['referer'] = $_G['siteurl'].'forum.php?mod=viewthread&tid='.$_G['tid'].'&page='.$page.($_G['gp_from'] ? '&from='.$_G['gp_from'] : '').'#pid'.$_G['gp_pid'];
		$ratelist = getratelist($_G['group']['raterange']);
		include template('forum/rate');
	} else {
		$reason = checkreasonpm();
		$rate = $ratetimes = 0;
		$creditsarray = array();
		foreach($_G['group']['raterange'] as $id => $rating) {
			$bels = $id;
			$score = intval($_G['gp_score'.$id]);
			if(isset($_G['setting']['extcredits'][$id]) && !empty($score)) {
				if(abs($score) <= $maxratetoday[$id]) {
					if($score > $rating['max'] || $score < $rating['min']) {
						showmessage('thread_rate_range_invalid');
					} else {
						$creditsarray[$id] = $score;
						$rate += $score;
						$ratetimes += ceil(max(abs($rating['min']), abs($rating['max'])) / 5);
					}
				} else {
					showmessage('thread_rate_ctrl');
				}
			}
		}

		if(!$creditsarray) {
			showmessage('thread_rate_range_invalid', NULL);
		}

		updatemembercount($post['authorid'], $creditsarray, 1, 'PRC', $_G['gp_pid']);
		DB::query("UPDATE ".DB::table($posttable)." SET rate=rate+($rate), ratetimes=ratetimes+$ratetimes WHERE pid='$_G[gp_pid]'");
		if($post['first']) {
			//在添加8264币时添加8264图章 at 2013.5.27
			if($bels==5&&$score!=0){
				loadcache('stamps');
				$modaction = $_G['gp_stamp'] !== '' ? 'SPA' : 'SPD';
				$_G['gp_stamp'] = $_G['gp_stamp'] !== '' ? $_G['gp_stamp'] : -1;
				DB::query("UPDATE ".DB::table('forum_thread')." SET moderated='1', stamp='$_G[gp_stamp]' WHERE tid='$_G[tid]'");
				if($modaction == 'SPA' && $_G['cache']['stamps'][$_G['gp_stamp']]['icon']) {
					DB::query("UPDATE ".DB::table('forum_thread')." SET icon='".$_G['cache']['stamps'][$_G['gp_stamp']]['icon']."' WHERE tid='$_G[tid]'");
				} elseif($modaction == 'SPD' && $_G['cache']['stamps'][$thread['stamp']]['icon'] == $thread['icon']) {
					DB::query("UPDATE ".DB::table('forum_thread')." SET icon='-1' WHERE tid='$_G[tid]'");
				}

				// 自动加精华1 lxp 20140410
				if($score>0){
					$auto_digest = true;
					DB::query("UPDATE ".DB::table('forum_thread')." SET digest='1', moderated='1' WHERE tid='$_G[tid]'");
					if($thread['digest'] == 0){
						updatecreditbyaction('digest', $thread['authorid'], array('digestposts' => 1), '', 1);
					}
				}
			}
			//end
			$threadrate = intval(@($post['rate'] + $rate) / abs($post['rate'] + $rate));
			DB::query("UPDATE ".DB::table('forum_thread')." SET rate='$threadrate' WHERE tid='$_G[tid]'");
		}
		require_once libfile('function/discuzcode');
		$sqlvalues = $comma = '';
		$sqlreason = censor(trim($_G['gp_reason']));
		$sqlreason = cutstr(dhtmlspecialchars($sqlreason), 40, '.');
		$_fid = DB::result_first("SELECT fid FROM " . DB::table('forum_thread') . " WHERE tid = {$thread['tid']}");
		require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";
		$logs = new logs('rate_debug');
		$logs->log_str("uid:{$_G[uid]}|pid:{$_G[gp_pid]}|tid:{$thread[tid]}|fid:{$_fid}");
		foreach($creditsarray as $id => $addcredits) {
			$sqlvalues .= "$comma('$_G[gp_pid]', '$_G[uid]', '$_G[username]', '$id', '$_G[timestamp]', '$addcredits', '$sqlreason', '{$_fid}', '{$thread['tid']}')";
			$comma = ', ';
		}
		DB::query("INSERT INTO ".DB::table('forum_ratelog')." (pid, uid, username, extcredits, dateline, score, reason, fid, tid)
			VALUES $sqlvalues", 'UNBUFFERED');

		/*此处增加对是否为点评子系统，若为点评子系统将进行对相应最后加币时间的更新。以便优化首页的排行列表*/
		$_dianpingids = $_G['config']['fids'];
		if($_fid > 0 && $thread['tid'] > 0 && $id == 5 && $addcredits > 0 && in_array($_fid, $_dianpingids)){
			$_dianpingids = array_flip($_dianpingids);
			$_dianpingmodname = $_dianpingids[$_fid];
			if(file_exists(DISCUZ_ROOT . "./source/models/{$_dianpingmodname}.model.php")){
				include(DISCUZ_ROOT . '/source/8264/launcher.php');
				include(DISCUZ_ROOT . '/source/8264/model/model.base.php');
				$dianpingmod = m($_dianpingmodname);
				if($dianpingmod){
					$dianpingmod->updateLastRate($thread['tid'], $_G['gp_pid']);
				}
			}
		}
		/*结束*/

		include_once libfile('function/post');
		$_G['forum']['threadcaches'] && @deletethreadcaches($_G['tid']);

		$reason = dhtmlspecialchars(censor(trim($reason)));
		if($sendreasonpm) {
			$ratescore = $slash = '';
			foreach($creditsarray as $id => $addcredits) {
				$ratescore .= $slash.$_G['setting']['extcredits'][$id]['title'].' '.($addcredits > 0 ? '+'.$addcredits : $addcredits).' '.$_G['setting']['extcredits'][$id]['unit'];
				$slash = ' / ';
			}
			if($bels==5&&$score!=0){
				if($auto_digest){
					$ratescore .= "，并被加入精华";
				}
				sendreasonpm($post, 'rate_reasons', array(
				'tid' => $thread['tid'],
				'pid' => $_G['gp_pid'],
				'subject' => $thread['subject'],
				'ratescore' => $ratescore,
				'reason' => stripslashes($reason),
				));
			}else{
				sendreasonpm($post, 'rate_reason', array(
				'tid' => $thread['tid'],
				'pid' => $_G['gp_pid'],
				'subject' => $thread['subject'],
				'ratescore' => $ratescore,
				'reason' => stripslashes($reason),
				));
			}
		}
		$logs = array();
		foreach($creditsarray as $id => $addcredits) {
			$logs[] = dhtmlspecialchars("$_G[timestamp]\t{$_G[member][username]}\t$_G[adminid]\t$post[author]\t$id\t$addcredits\t$_G[tid]\t$thread[subject]\t$reason");
		}
		writelog('ratelog', $logs);
		showmessage('thread_rate_succeed', dreferer());
	}
} elseif($_G['gp_action'] == 'removerate' && $_G['gp_pid']) {
	if(!$_G['forum']['ismoderator'] || !$_G['group']['raterange']) {
		showmessage('undefined_action');
	}

	$reasonpmcheck = $_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3 ? 'checked="checked" disabled' : '';
	if(($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) || !empty($_G['gp_sendreasonpm'])) {
		$forumname = strip_tags($_G['forum']['name']);
		$sendreasonpm = 1;
	} else {
		$sendreasonpm = 0;
	}

	foreach($_G['group']['raterange'] as $id => $rating) {
		$maxratetoday[$id] = $rating['mrpd'];
	}
	$posttable = getposttablebytid($_G['tid']);
	$post = DB::fetch_first("SELECT * FROM ".DB::table($posttable)." WHERE pid='$_G[gp_pid]' AND invisible='0' AND authorid<>'0'");
	if(!$post || $post['tid'] != $thread['tid'] || !$post['authorid']) {
		showmessage('undefined_action');
	}

	require_once libfile('function/misc');

	if(!submitcheck('ratesubmit')) {

		$_G['referer'] = $_G['siteurl'].'forum.php?mod=viewthread&tid='.$_G['tid'].'&page='.$page.($_G['gp_from'] ? '&from='.$_G['gp_from'] : '').'#pid'.$_G['gp_pid'];
		$ratelogs = array();
		$query = DB::query("SELECT * FROM ".DB::table('forum_ratelog')." WHERE pid='$_G[gp_pid]' ORDER BY dateline");
		while($ratelog = DB::fetch($query)) {
			$ratelog['dbdateline'] = $ratelog['dateline'];
			$ratelog['dateline'] = dgmdate($ratelog['dateline'], 'u');
			$ratelog['scoreview'] = $ratelog['score'] > 0 ? '+'.$ratelog['score'] : $ratelog['score'];
			$ratelogs[] = $ratelog;
		}

		include template('forum/rate');

	} else {

		$reason = checkreasonpm();

		if(!empty($_G['gp_logidarray'])) {
			if($sendreasonpm) {
				$ratescore = $slash = '';
			}

			$query = DB::query("SELECT * FROM ".DB::table('forum_ratelog')." WHERE pid='$_G[gp_pid]'");
			$rate = $ratetimes = 0;
			$logs = array();
			while($ratelog = DB::fetch($query)) {
				if(in_array($ratelog['uid'].' '.$ratelog['extcredits'].' '.$ratelog['dateline'], $_G['gp_logidarray'])) {
					$rate += $ratelog['score'] = -$ratelog['score'];
					$ratetimes += ceil(max(abs($rating['min']), abs($rating['max'])) / 5);
					updatemembercount($post['authorid'], array($ratelog['extcredits'] => $ratelog['score']));
					DB::delete('common_credit_log', array('uid' => $post['authorid'], 'operation' => 'PRC', 'relatedid' => $_G['gp_pid']));
					DB::query("DELETE FROM ".DB::table('forum_ratelog')." WHERE pid='$_G[gp_pid]' AND uid='$ratelog[uid]' AND extcredits='$ratelog[extcredits]' AND dateline='$ratelog[dateline]'", 'UNBUFFERED');
					$logs[] = dhtmlspecialchars("$_G[timestamp]\t{$_G[member][username]}\t$_G[adminid]\t$ratelog[username]\t$ratelog[extcredits]\t$ratelog[score]\t$_G[tid]\t$thread[subject]\t$reason\tD");
					if($sendreasonpm) {
						$ratescore .= $slash.$_G['setting']['extcredits'][$ratelog['extcredits']]['title'].' '.($ratelog['score'] > 0 ? '+'.$ratelog['score'] : $ratelog['score']).' '.$_G['setting']['extcredits'][$ratelog['extcredits']]['unit'];
						$slash = ' / ';
					}
				}
			}
			writelog('ratelog', $logs);

			if($sendreasonpm) {
				sendreasonpm($post, 'rate_removereason', array(
					'tid' => $thread['tid'],
					'pid' => $_G['gp_pid'],
					'subject' => $thread['subject'],
					'ratescore' => $ratescore,
					'reason' => stripslashes($reason),
				));
			}
			DB::query("UPDATE ".DB::table($posttable)." SET rate=rate+($rate), ratetimes=ratetimes-$ratetimes WHERE pid='$_G[gp_pid]'");
			if($post['first']) {
				$threadrate = @intval(@($post['rate'] + $rate) / abs($post['rate'] + $rate));
				DB::query("UPDATE ".DB::table('forum_thread')." SET rate='$threadrate' WHERE tid='$_G[tid]'");
			}

		}

		showmessage('thread_rate_removesucceed', dreferer());

	}

} elseif($_G['gp_action'] == 'viewratings' && $_G['gp_pid']) {
	$posttable = getposttablebytid($_G['tid']);
	$queryr = DB::query("SELECT * FROM ".DB::table('forum_ratelog')." WHERE pid='$_G[gp_pid]' ORDER BY dateline DESC");
	$queryp = DB::query("SELECT p.* ".($_G['setting']['bannedmessages'] ? ", m.groupid " : '').
		" FROM ".DB::table($posttable)." p ".
		($_G['setting']['bannedmessages'] ? "LEFT JOIN ".DB::table('common_member')." m ON m.uid=p.authorid" : '').
		" WHERE p.pid='$_G[gp_pid]' AND p.invisible='0'");

	if(!(DB::num_rows($queryr)) || !(DB::num_rows($queryp))) {
		showmessage('thread_rate_log_nonexistence');
	}

	$post = DB::fetch($queryp);
	if($post['tid'] != $thread['tid']) {
		showmessage('undefined_action', NULL);
	}

	$loglist = $logcount = array();
	while($log = DB::fetch($queryr)) {
		$logcount[$log['extcredits']] += $log['score'];
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		$log['score'] = $log['score'] > 0 ? '+'.$log['score'] : $log['score'];
		$log['reason'] = dhtmlspecialchars($log['reason']);
		$loglist[] = $log;
	}
	include template('forum/rate_view');
}elseif(($_G['gp_action'] == 'activenopass'||$_G['gp_action'] == 'activepass')&& $_G['gp_pid']) {
	if($_G['gp_action'] == 'activenopass'){
		$num = $_GET['nopassnum'];
		$logtmplist = getallorder($_G['tid'], 3);
	}elseif($_G['gp_action'] == 'activepass'){
		$num = $_GET['passnum'];
		$logtmplist = getallorder($_G['tid'], 2);
	}else{
		showmessage('undefined_action', NULL);
	}
	$loglist = $logcount = array();
	foreach ($logtmplist as $log) {
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		$loglist[] = $log;
	}

	include template('forum/activepass');
} elseif($_G['gp_action'] == 'viewwarning' && $_G['gp_uid']) {

	if(!($warnuser = DB::result_first("SELECT username FROM ".DB::table('common_member')." WHERE uid='$_G[gp_uid]'"))) {
		showmessage('undefined_action', NULL);
	}

	$query = DB::query("SELECT * FROM ".DB::table('forum_warning')." WHERE authorid='$_G[gp_uid]'");

	if(!($warnnum = DB::num_rows($query))) {
		showmessage('thread_warning_nonexistence');
	}

	$warning = array();
	while($warning = DB::fetch($query)) {
		$warning['dateline'] = dgmdate($warning['dateline'], 'u');
		$warning['reason'] = dhtmlspecialchars($warning['reason']);
		$warnings[] = $warning;
	}

	include template('forum/warn_view');

} elseif($_G['gp_action'] == 'pay') {

	if(!isset($_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]])) {
		showmessage('credits_transaction_disabled');
	} elseif($thread['price'] <= 0 || $thread['special'] <> 0) {
		showmessage('undefined_action', NULL);
	} elseif(!$_G['uid']) {
		showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
	}

	if(($balance = getuserprofile('extcredits'.$_G['setting']['creditstransextra'][1]) - $thread['price']) < ($minbalance = 0)) {
		if($_G['setting']['ec_ratio'] && $_G['setting']['creditstrans'][0] == $_G['setting']['creditstransextra'][1]) {
			showmessage('credits_balance_insufficient_and_charge', '', array('title' => $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'], 'minbalance' => $thread['price']));
		} else {
			showmessage('credits_balance_insufficient', '', array('title' => $_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]]['title'], 'minbalance' => $thread['price']));
		}
	}

	if(DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_credit_log')." WHERE uid='$_G[uid]' AND relatedid='$_G[tid]' AND operation='BTC'")) {
		showmessage('credits_buy_thread', 'forum.php?mod=viewthread&tid='.$_G['tid'].($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''));
	}

	$thread['netprice'] = floor($thread['price'] * (1 - $_G['setting']['creditstax']));

	if(!submitcheck('paysubmit')) {

		include template('forum/pay');

	} else {

		$updateauthor = true;
		if($_G['setting']['maxincperthread'] > 0) {
			$extcredit = 'extcredits'.$_G['setting']['creditstransextra'][1];
			if((DB::result_first("SELECT SUM($extcredit) FROM ".DB::table('common_credit_log')." WHERE uid='$thread[authorid]' AND operation='STC' AND relatedid='$_G[tid]'")) > $_G['setting']['maxincperthread']) {
				$updateauthor = false;
			}
		}
		if($updateauthor) {
			updatemembercount($thread['authorid'], array($_G['setting']['creditstransextra'][1] => $thread['netprice']), 1, 'STC', $_G['tid']);
		}
		updatemembercount($_G['uid'], array($_G['setting']['creditstransextra'][1] => -$thread['price']), 1, 'BTC', $_G['tid']);

		showmessage('thread_pay_succeed', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''));

	}

} elseif($_G['gp_action'] == 'viewpayments') {
	$extcreditname = 'extcredits'.$_G['setting']['creditstransextra'][1];
	$loglist = array();
	$query = DB::query("SELECT l.*, m.username FROM ".DB::table('common_credit_log')." l
		LEFT JOIN ".DB::table('common_member')." m USING (uid)
		WHERE relatedid='$_G[tid]' AND operation='BTC' ORDER BY l.dateline");
	while($log = DB::fetch($query)) {
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		$log[$extcreditname] = abs($log[$extcreditname]);
		$loglist[] = $log;
	}
	include template('forum/pay_view');

} elseif($_G['gp_action'] == 'viewthreadmod' && $_G['tid']) {

	$modactioncode = lang('forum/modaction');
	$loglist = array();
	$query = DB::query("SELECT * FROM ".DB::table('forum_threadmod')." WHERE tid='$_G[tid]' ORDER BY dateline DESC");

	while($log = DB::fetch($query)) {
		$log['dateline'] = dgmdate($log['dateline'], 'u');
		$log['expiration'] = !empty($log['expiration']) ? dgmdate($log['expiration'], 'd') : '';
		$log['status'] = empty($log['status']) ? 'style="text-decoration: line-through" disabled' : '';
		if(!$modactioncode[$log['action']] && preg_match('/S(\d\d)/', $log['action'], $a) || $log['action'] == 'SPA') {
			loadcache('stamps');
			if($log['action'] == 'SPA') {
				$log['action'] = 'SPA'.$log['stamp'];
				$stampid = $log['stamp'];
			} else {
				$stampid = intval($a[1]);
			}
			$modactioncode[$log['action']] = $modactioncode['SPA'].' '.$_G['cache']['stamps'][$stampid]['text'];
		} elseif(preg_match('/L(\d\d)/', $log['action'], $a)) {
			loadcache('stamps');
			$modactioncode[$log['action']] = $modactioncode['SLA'].' '.$_G['cache']['stamps'][intval($a[1])]['text'];
		}
		if($log['magicid']) {
			loadcache('magics');
			$log['magicname'] = $_G['cache']['magics'][$log['magicid']]['name'];
		}
		$loglist[] = $log;
	}

	if(empty($loglist)) {
		showmessage('threadmod_nonexistence');
	}

	include template('forum/viewthread_mod');

} elseif($_G['gp_action'] == 'bestanswer' && $_G['tid'] && $_G['gp_pid'] && submitcheck('bestanswersubmit')) {

	$forward = 'forum.php?mod=viewthread&tid='.$_G['tid'].($_G['gp_from'] ? '&from='.$_G['gp_from'] : '');
	$posttable = getposttablebytid($_G['tid']);
	$post = DB::fetch_first("SELECT authorid, first FROM ".DB::table($posttable)." WHERE pid='$_G[gp_pid]' and tid='$_G[tid]'");

	if(!($thread['special'] == 3 && $post && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $thread['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $thread['authorid'] == $_G['uid']) && $post['authorid'] != $thread['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $thread['price'] > 0)) {
		showmessage('reward_cant_operate');
	} elseif($post['authorid'] == $thread['authorid']) {
		showmessage('reward_cant_self');
	} elseif($thread['price'] < 0) {
		showmessage('reward_repeat_selection');
	}
	updatemembercount($post['authorid'], array($_G['setting']['creditstransextra'][2] => $thread['price']), 1, 'RAC', $_G['tid']);
	$thread['price'] = '-'.$thread['price'];
	DB::query("UPDATE ".DB::table('forum_thread')." SET price='$thread[price]' WHERE tid='$_G[tid]'");
	DB::query("UPDATE ".DB::table($posttable)." SET dateline=$thread[dateline]+1 WHERE pid='$_G[gp_pid]'");

	$thread['dateline'] = dgmdate($thread['dateline']);
	if($_G['uid'] != $thread['authorid']) {
		notification_add($thread['authorid'], 'reward', 'reward_question', array(
			'tid' => $thread['tid'],
			'subject' => $thread['subject'],
		));
	}
	notification_add($post['authorid'], 'reward', 'reward_bestanswer', array(
		'tid' => $thread['tid'],
		'subject' => $thread['subject'],
	));

	showmessage('reward_completion', $forward);

} elseif($_G['gp_action'] == 'activityapplies') {

	if(!$_G['uid']) {
		showmessage('undefined_action', NULL);
	}

	//为获取图片做准备
	require_once DISCUZ_ROOT.'source/plugin/attachment_server/attachment_server.class.php';
	$attachserver = new attachserver;
	$attachlist = $attachserver->get_server_domain('all', '*');

	if(submitcheck('activitysubmit')) {
		$activity = DB::fetch(DB::query("SELECT uid, expiration, ufield, cost, credit, title, starttimefrom, starttimeto, timediff, aid, formid FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'"));
		if($activity['expiration'] && $activity['expiration'] < TIMESTAMP) {
			showmessage('activity_stop', NULL, array(), array('login' => 1));
		}
		//查看当前用户是否在该活动上报过名
		$applyinfo = getapplyhistory($_G['tid'], $_G['uid']);
		if($applyinfo && $applyinfo['verified'] < 2) {
			showmessage('activity_repeat_apply', NULL, array(), array('login' => 1));
		}
		$payvalue = intval($_G['gp_payvalue']);
		$payment  = $_G['gp_payment'] ? $payvalue : $activity['cost'];
		$message  = cutstr(dhtmlspecialchars($_G['gp_message']), 200);
		$verified = $thread['authorid'] == $_G['uid'] ? 1 : 0;
		$realname = '';
		$mobile   = '';
		$quantity = 0;
		if($activity['ufield']) {
			$ufielddata = array();
			$activity['ufield'] = unserialize($activity['ufield']);
			if(!empty($activity['ufield']['userfield'])) {
				if($activity['formid']){
					//使用了表单助手
					gethdfieldsetting();
					foreach($_POST as $key => $value) {
						if(empty($_G['cache']['profilesetting2'][$key])) continue;
						$value = cutstr(dhtmlspecialchars(trim($value)), 100, '.');
						if(empty($value) && $_G['cache']['profilesetting2'][$key]['required']) {
							showmessage('activity_exile_field');
						}
						if(!empty($value)&& $key == 'field3'){
							if(is_numeric($value)&&$value>0&&$value<=50){
								$quantity = $value;
							}else{
								showmessage('您填写的报名人数不是一个大于1数字或者数字过大！');
							}
						}
						$ufielddata['userfield'][$key] = $value;
					}
				}else{
					if(!class_exists('discuz_censor')) {
						include libfile('class/censor');
					}
					$censor = discuz_censor::instance();
					loadcache('profilesetting');

					foreach($_POST as $key => $value) {
						if(empty($_G['cache']['profilesetting'][$key])) continue;
						$value = cutstr(dhtmlspecialchars(trim($value)), 100, '.');
						if(empty($value) && $key != 'residedist' && $key != 'residecommunity') {
							showmessage('activity_exile_field');
						}
						if(!empty($value)&& $key == 'field3'){
							if(is_numeric($value)&&$value>=0&&$value<=50){
								$quantity = $value;
							}else{
								showmessage('您填写的报名人数不是一个数字或者数字过大！');
							}
						}
						$ufielddata['userfield'][$key] = $value;
					}
				}
				$realname = !empty($ufielddata['userfield']['realname']) ? $ufielddata['userfield']['realname'] : '';
				$mobile   = !empty($ufielddata['userfield']['mobile']) ? $ufielddata['userfield']['mobile'] : '';
			}
			if(!empty($activity['ufield']['extfield'])) {
				foreach($activity['ufield']['extfield'] as $fieldid) {
					$tmpname = addslashes(htmlspecialchars_decode($fieldid));
					$value = cutstr(dhtmlspecialchars(trim($_G['gp_'.$tmpname])), 50, '.');
					$ufielddata['extfield'][$fieldid] = $value;
				}
			}
			$ufielddata = !empty($ufielddata) ? serialize($ufielddata) : '';
		}
		if($_G['setting']['activitycredit'] && $activity['credit'] && empty($applyinfo['verified'])) {
			checklowerlimit(array('extcredits'.$_G['setting']['activitycredit'] => '-'.$activity['credit']));
			updatemembercount($_G['uid'], array($_G['setting']['activitycredit'] => '-'.$activity['credit']), true, 'ACC', $_G['tid']);
		}
		if($applyinfo && $applyinfo['verified'] == 2) {
			$newinfo = array(
				'tid' => $_G['tid'],
				'username' => $_G['username'],
				'uid' => $_G['uid'],
				'message' => $message,
				'verified' => $verified,
				'dateline' => $_G['timestamp'],
				'payment' => $payment,
				'ufielddata' => $ufielddata,
				'useform' => $activity['formid'],
				'contacts_name' => $realname,
				'contacts_mobile' => $mobile,
			);
			updateapply($applyinfo['applyid'], $newinfo);
		} else {
			$subject = DB::result_first("SELECT subject FROM " . DB::table('forum_thread') . " WHERE tid='{$_G["tid"]}' " . getSlaveID());
			$newinfo = array(
				'tid' => $_G['tid'],
				'username' => $_G['username'],
				'uid' => $_G['uid'],
				'message' => $message,
				'verified' => $verified,
				'dateline' => $_G['timestamp'],
				'payment' => $payment>0?$payment:0,
				'ufielddata' => $ufielddata,
				'contacts_name' => $realname,
				'contacts_mobile' => $mobile,
				'quantity' => $quantity,
				'sex' => '1',
				'order_type' => '20',
				'ip' => $_G['clientip'],
				'subject' => $subject,
				'authorid' => $activity['uid'],
				'starttimefrom' => $activity['starttimefrom'],
				'starttimeto' => $activity['starttimeto'],
				'days' => $activity['timediff'],
				'coverpic' => '',
				'useform' => $activity['formid'],
				'isshow' => 1,
				'applyid' => 0
			);
			$attachment = DB::fetch_first("SELECT attachment, isimage, serverid, dir FROM " . DB::table('forum_attachment') . " WHERE aid='{$activity['aid']}' ".getSlaveID());
			if($attachment['isimage'] && $attachment['serverid'] > 0) {
				$newinfo['coverpic'] = "http://" . $attachlist[$attachment['serverid']]['name'] . "/".$attachment['dir']."/" . $attachment['attachment'];
			}
			$createresult = newapply($newinfo); //创建
			if(!$createresult){
				showmessage('活动报名失败！', NULL, array(), array('login' => 1));
			}
			//新的动态表的增加
			$feedarr = array(
				'uid' 	    => $_G['uid'],
				'fid' 	    => $_G['gp_fid'],
				'id' 	    => $_G['gp_tid'],
				'pid'  	    => $_G['gp_pid'],
				'type'      => 7,
				'dateline'  => $_G[timestamp],
				'subject'   => '参加了活动',
				'message'   => '',
				'title'     => $subject,
				'username'  => $_G['username'],
			);

			require_once libfile('function/feed');
			feed_add_ucenter($feedarr);

			//给app用户(活动发布者)发通知
			// pushActivityMsg(12, $activity['uid'], 0);

			//向活动发布者(绑定微信)发送新报名通知
			// sendNewActivityMsgForWechat($activity['uid'], $_G['gp_tid'], $activity['title'], $realname, $mobile);
		}

		//清缓存
		clearcache_getapplyhistory($_G['tid'], $_G['uid']);
		clearcache_getallorder($_G['tid']);
		clearcache_getapply($_G['uid']);

		//更新下某个活动的总报名人数和已通过报名人数
		setPassnumAndApplynum($_G['tid']);

		//计算当前活动热度
		setActHot($_G['tid']);

		if($thread['authorid'] != $_G['uid']) {
			notification_add($thread['authorid'], 'activity', 'activity_notice', array(
				'tid' => $_G['tid'],
				'subject' => $thread['subject'],
			));
			$space = array();
			space_merge($space, 'field_home');
		}

		//当发布活动时 页面提示 start
		$extraparam = array();
		$extraparam['header'] = false;
		$extraparam['refreshtime'] = 1000;
//		$extraparam['wechatshare'] = "{$_G['config']['web']['mobile']}thread-{$_G[tid]}.html";
		$extraparam['wechatshare'] = "http://wei.zaiwai.com";
		$extraparam['tid']    = $tid;
		$extraparam['info_activity'] = "报名成功";
		$extraparam['wechatshare'] = urlencode($extraparam['wechatshare']);
		showmessage('activity_completion', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), $extraparam);

	} elseif(submitcheck('activitycancel')) {
		if($_G['gp_is_uc'] && $_G['gp_page']){ //为了解决当活动删除时报名删除的问题
			$page = max(1, (int)$_G['gp_page']);
			$applylist = getapply(array('uid' => $_G['uid'], 'isshow' => 1, 'page' => $page, 'perpage' => 15));
			$findit = false;
			if($applylist['list']){
				foreach ($applylist['list'] as $applyid => $applyinfo) {
					if($applyinfo['tid'] == $_G['tid']){
						$findit = true;
						break;
					}
				}
			}
			if(!$findit){
				showmessage('删除失败！', '', array(), array('showdialog' => 1, 'closetime' => true));
			}
		}

		$cancelresult = cancelapply($_G['tid'], $_G['uid']);
		if($cancelresult !== true){
			showmessage('活动取消失败！', NULL, array(), array('login' => 1));
		}

		//清除缓存
		clearcache_getapplyhistory($_G['tid'], $_G['uid']);
		clearcache_getallorder($_G['tid']);
		clearcache_getapply($_G['uid']);

		//更新下某个活动的总报名人数和已通过报名人数
		setPassnumAndApplynum($_G['tid']);

		$message = cutstr(dhtmlspecialchars($_G['gp_message']), 200);

		//向活动发布者(绑定微信)发送取消报名申请通知
		// sendActivityCancelMsgForWechat($activityShow['uid'], $_G['tid'], $activityShow['title'], $realname, $message);

		if($thread['authorid'] != $_G['uid']) {
			notification_add($thread['authorid'], 'activity', 'activity_cancel', array(
				'tid' => $_G['tid'],
				'subject' => $thread['subject'],
				'reason' => $message
			));
		}

		$locationurl = !empty($_G['gp_query_string']) ? "home.php?{$_G['gp_query_string']}" : "forum.php?mod=viewthread&tid=$_G[tid]&do=viewapplylist".($_G['gp_from'] ? '&from='.$_G['gp_from'] :'');

		if($_G['gp_inajax']) {
			showmessage('activity_cancel_success', $locationurl, array('success'=>1), array('showdialog' => 1, 'showmsg' => true, 'closetime' => true));
		} else {
			showmessage('activity_cancel_success', $locationurl, array(), array('showdialog' => 1, 'closetime' => true));
		}

	} elseif(submitcheck('activitynoshow')) {
		$cancelresult = cancelapply($_G['tid'], $_G['uid']); //直接删除
		clearcache_getapplyhistory($_G['tid'], $_G['uid']);
		clearcache_getallorder($_G['tid']);
		clearcache_getapply($_G['uid']);
		//使其在个人中心我参加的活动栏中，不可见
		showmessage('删除成功', dreferer(), array('tid' => $tid), array('showdialog' => 1, 'showmsg' => true, 'closetime' => true));
	}

} elseif($_G['gp_action'] == 'activityapplylist_bak') {
	return false;
	$isactivitymaster = $thread['authorid'] == $_G['uid'] || $_G['group']['alloweditactivity'];
	$activity = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'");
	if(!$activity || $thread['special'] != 4 || !$isactivitymaster) {
		showmessage('undefined_action');
	}

	if(!submitcheck('applylistsubmit')) {
		$sqlverified = $isactivitymaster ? '' : "AND verified='1'";

		if(!empty($_G['gp_uid']) && $isactivitymaster) {
			$sqlverified .= " AND uid='$_G[gp_uid]'";
		}

		$applylist = array();
		$activity['ufield'] = $activity['ufield'] ? unserialize($activity['ufield']) : array();
		$query = DB::query("SELECT applyid, username, uid, message, verified, dateline, payment, ufielddata, appuserid, appusername, wechatuserid, wechatusername FROM ".DB::table('forum_activityapply')." WHERE tid='$_G[tid]' $sqlverified ORDER BY dateline DESC");
		while($activityapplies = DB::fetch($query)) {
			$ufielddata = '';
			$activityapplies['dateline'] = dgmdate($activityapplies['dateline'], 'u');
			$activityapplies['ufielddata'] = !empty($activityapplies['ufielddata']) ? unserialize($activityapplies['ufielddata']) : '';
			if($activityapplies['ufielddata']) {
				if($activityapplies['ufielddata']['userfield']) {
					require_once libfile('function/profile');
					loadcache('profilesetting');
					$data 		= '';
					$hasmobile  = false;//在外app端的报名数据
					foreach($activity['ufield']['userfield'] as $fieldid) {
						$hasmobile = $hasmobile || $fieldid == 'mobile' ? true : false;

						$data = profile_show($fieldid, $activityapplies['ufielddata']['userfield']);
						$ufielddata .= '<li>'.$_G['cache']['profilesetting'][$fieldid]['title'].'&nbsp;&nbsp;:&nbsp;&nbsp;'.$data.'</li>';
					}
					if (!$hasmobile && $activityapplies['appuserid']) {
						$fieldid = 'mobile';
						$data 	 = profile_show($fieldid, $activityapplies['ufielddata']['userfield']);
						$ufielddata .= '<li>'.$_G['cache']['profilesetting'][$fieldid]['title'].'&nbsp;&nbsp;:&nbsp;&nbsp;'.$data.'</li>';
					}
				}
				if($activityapplies['ufielddata']['extfield']) {
					foreach($activity['ufield']['extfield'] as $name) {
						$ufielddata .= '<li>'.$name.'&nbsp;&nbsp;:&nbsp;&nbsp;'.$activityapplies['ufielddata']['extfield'][$name].'</li>';
					}
				}
			}
			$activityapplies['ufielddata'] = $ufielddata;
			$applylist[] = $activityapplies;
		}

		$activity['starttimefrom'] = dgmdate($activity['starttimefrom'], 'u');
		$activity['starttimeto']   = $activity['starttimeto'] ? dgmdate($activity['starttimeto'], 'u') : 0;
		$activity['expiration']    = $activity['expiration'] ? dgmdate($activity['expiration'], 'u') : 0;

		include template('forum/activity_applylist');
	} else {
		$locationurl = !empty($_G['gp_referer']) ? $_G['gp_referer'] : "forum.php?mod=viewthread&tid=$_G[tid]&do=viewapplylist".($_G['gp_from'] ? '&from='.$_G['gp_from'] : '');

		if(empty($_G['gp_applyidarray'])) {
			showmessage('activity_choice_applicant');
		} else {
			$reason   = cutstr(dhtmlspecialchars($_G['gp_reason']), 200);
			$uidarray = $unverified = $appactids = $appuserids = array();
			$ids   	  = dimplode($_G['gp_applyidarray']);
			$query    = DB::query("SELECT a.applyid,a.uid,a.verified,a.appactid, a.appuserid FROM ".DB::table('forum_activityapply')." a RIGHT JOIN ".DB::table('common_member')." m USING(uid) WHERE a.tid='$_G[tid]' AND a.applyid IN (".$ids.")");
			while($v = DB::fetch($query)) {
				$uidarray[] = $v['uid'];
				if($v['verified'] != 1) {
					$unverified[] = $v['applyid'];
					$unverified_uid[] = $v['uid'];
				}
				if ($v['appactid'] > 0) {
					$appactids[$v['appactid']] = $v['appactid'];
				}
				if ($v['appuserid'] > 0) {
					$appuserids[$v['appuserid']] = $v['appuserid'];
				}
			}
			$activity_subject = $thread['subject'];

			if($_G['gp_operation'] == 'notification') {
				if(empty($uidarray)) {
					showmessage('activity_notification_user');
				}
				if(empty($reason)) {
					showmessage('activity_notification_reason');
				}
				if($uidarray) {
					foreach($uidarray as $uid) {
						notification_add($uid, 'activity', 'activity_notification', array('tid' => $_G['tid'], 'subject' => $activity_subject, 'msg' => $reason));
					}
					$_G['gp_is_uc'] = $_G['gp_need_uc'] ? 1 : 0;

					showmessage('activity_notification_success', $locationurl, array(), array('showdialog' => 1, 'closetime' => true));
				}
			} elseif($_G['gp_operation'] == 'delete') {
				//做修改
				$arr = $_G['gp_applyidarray'];
				foreach($arr as $id){
					$act = DB::fetch_first("select * FROM ".DB::table('forum_activityapply')." WHERE applyid='$id'");
					if($act){
						$fild = unserialize($act['ufielddata']);
						$filds = $fild['userfield']['field3'];
						if(!empty($filds)&&is_numeric($filds)){
							DB::query("update ".DB::table('forum_activity')." set applynumber = applynumber - $filds WHERE tid='$_G[tid]'");
						}else{
							$applynumber = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_activityapply')." WHERE tid='$_G[tid]' AND verified='1'");
							DB::update('forum_activity', array('applynumber' => $applynumber), "tid='$_G[tid]'");
						}
					}
				}
				//end
				if($uidarray) {
					DB::query("DELETE FROM ".DB::table('forum_activityapply')." WHERE tid='$_G[tid]' AND applyid IN (".$ids.")", 'UNBUFFERED');
					foreach($uidarray as $uid) {
						notification_add($uid, 'activity', 'activity_delete', array(
							'tid' => $_G['tid'],
							'subject' => $activity_subject,
							'reason' => stripslashes($reason),
						));
						//向活动报名者(绑定微信)发送报名失败通知
						// sendApplyFailMsgForWechat($uid, $activity['title'], $activity['starttimefrom'], $activity['place']);
					}
				}

				//更新下某个活动的总报名人数和已通过报名人数
				setPassnumAndApplynum($_G['tid']);

				showmessage('activity_delete_completion', $locationurl);
			} else {
				if($unverified) {
					$unverified = implode(',', $unverified);
					$verified = $_G['gp_operation'] == 'replenish' ? 2 : 1;

					DB::query("UPDATE ".DB::table('forum_activityapply')." SET verified={$verified} WHERE tid={$_G['tid']} AND applyid IN ({$unverified})", 'UNBUFFERED');
					$notification_lang = $verified == 1 ? 'activity_apply' : 'activity_replenish';
					foreach($unverified_uid as $uid) {
						notification_add($uid, 'activity', $notification_lang, array(
							'tid' => $_G['tid'],
							'subject' => $activity_subject,
							'reason' => stripslashes($reason),
						));
					}
				}

				//更新下某个活动的总报名人数和已通过报名人数
				$return  = setPassnumAndApplynum($_G['tid']);

				/*
				try {
					$zwappShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_zwapp')." WHERE tid={$_G['tid']} " . getSlaveID());
					if ($zwappShow) {

						$appapi = $_G['config']['zaiwaiapi']['url'];
						$token  = $_G['config']['zaiwaiapi']['token'];

						//更新在外app报名活动状态
						if ($appactids) {
							foreach ($appactids as $v) {
								requestRemoteData("{$appapi}activitieService/updateActivitieEnrollState?activitieEnrollId={$v}&state=0&sToken={$token}&refuseReason=");
							}
						}

						$passnumber = $return['passnumber'] + 1;
						$request = "{$appapi}activitieService/updateActivitieBatchEnrollCount?activitieBatchId={$zwappShow['appabid']}&count={$passnumber}&sToken={$token}";
						requestRemoteData($request);
					}

					//给app用户(活动参与者)发通知
					if ($appuserids) {
						foreach ($appuserids as $v) {
							pushActivityMsg(13, 0, $v);
						}
					}

					//向活动报名者(绑定微信)发送活动报名成功通知
					if($uidarray) {
						foreach($uidarray as $v) {
							sendApplySuccessMsgForWechat($v, $activity['title'], $activity['clubname']);
						}
					}

				} catch(Exception $e) {

				}
				*/

				showmessage('activity_auditing_completion', $locationurl);
			}
		}
	}

} elseif($_G['gp_action'] == 'activityexport') {
	$posttable = getposttablebytid($_G['tid']);
	$activity = DB::fetch_first("SELECT a.*, p.message FROM ".DB::table('forum_activity')." a LEFT JOIN ".DB::table($posttable)." p ON p.tid=a.tid AND p.first='1' WHERE a.tid='$_G[tid]'");
	if(!$activity || $thread['special'] != 4 || $thread['authorid'] != $_G['uid'] && !$_G['group']['alloweditactivity']) {
		showmessage('undefined_action');
	}
	$ufield = '';
	if($activity['ufield']) {
		$activity['ufield'] = unserialize($activity['ufield']);
		if($activity['ufield']['userfield']) {
			if($activity['formid']){
				gethdfieldsetting();
				foreach($activity['ufield']['userfield'] as $fieldid) {
					$ufield .= ','.$_G['cache']['profilesetting2'][$fieldid]['title'];
				}
			}else{
				loadcache('profilesetting');
				foreach($activity['ufield']['userfield'] as $fieldid) {
					$ufield .= ','.$_G['cache']['profilesetting'][$fieldid]['title'];
				}
			}

		}
		if($activity['ufield']['extfield']) {
			foreach($activity['ufield']['extfield'] as $extname) {
				$ufield .= ','.$extname;
			}
		}
	}
	$activity['starttimefrom'] = dgmdate($activity['starttimefrom'], 'dt');
	$activity['starttimeto'] = $activity['starttimeto'] ? dgmdate($activity['starttimeto'], 'dt') : 0;
	$activity['expiration'] = $activity['expiration'] ? dgmdate($activity['expiration'], 'dt') : 0;
	$activity['message'] = preg_replace('/\[.+?\]/', '', $activity['message']);
	$applynumbers = $activity['applynumber'];

	$applylist = array();
	$tmpdata = getallorder($_G[tid]);
	require_once libfile('function/profile');
	loadcache('profilesetting');
	gethdfieldsetting();
	foreach ($tmpdata as $applyid => $apply) {
		$apply['dateline']   = dgmdate($apply['dateline'], 'dt');
		$apply['ufielddata'] = !empty($apply['ufielddata']) ? unserialize($apply['ufielddata']) : '';
		$ufielddata = '';
		if($apply['ufielddata'] && $activity['ufield']) {
			if($apply['ufielddata']['userfield'] && $activity['ufield']['userfield']) {
				if($activity['formid']){
					foreach($activity['ufield']['userfield'] as $fieldid) {
						$data = profile_show2($fieldid, $apply['ufielddata']['userfield']);
						if(strlen($data) > 11 && is_numeric($data)) {
							$data = '['.$data.']';
						}
						$ufielddata .= ','.strip_tags(str_replace('&nbsp;', ' ', $data));
					}
				}else{
					foreach($activity['ufield']['userfield'] as $fieldid) {
						$data = profile_show($fieldid, $apply['ufielddata']['userfield']);
						if(strlen($data) > 11 && is_numeric($data)) {
							$data = '['.$data.']';
						}
						$ufielddata .= ','.strip_tags(str_replace('&nbsp;', ' ', $data));
					}
				}
			}
			if($activity['ufield']['extfield']) {
				foreach($activity['ufield']['extfield'] as $extname) {
					if(strlen($apply['ufielddata']['extfield'][$extname]) > 11 && is_numeric($apply['ufielddata']['extfield'][$extname])) {
						$apply['ufielddata']['extfield'][$extname] = '['.$apply['ufielddata']['extfield'][$extname].']';
					}
					$ufielddata .= ','.strip_tags(str_replace('&nbsp;', ' ', $apply['ufielddata']['extfield'][$extname]));
				}
			}
		}
		$apply['fielddata'] = $ufielddata;
		if(strlen($apply['message']) > 11 && is_numeric($apply['message'])) {
			$apply['message'] = '['.$apply['message'].']';
		}
		$applylist[] = $apply;
	}
	$filename = "activity_{$_G[tid]}.csv";

	include template('forum/activity_export');
	$csvstr = ob_get_contents();
	ob_end_clean();
	header('Content-Encoding: none');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Pragma: no-cache');
	header('Expires: 0');
	if($_G['charset'] != 'gbk') {
		$csvstr = diconv($csvstr, $_G['charset'], 'GBK');
	}
	echo $csvstr;
} elseif($_G['gp_action'] == 'tradeorder') {

	$trades = array();
	$query = DB::query("SELECT * FROM ".DB::table('forum_trade')." WHERE tid='$_G[tid]' ORDER BY displayorder");

	if($thread['authorid'] != $_G['uid'] && !$_G['group']['allowedittrade']) {
		showmessage('undefined_action', NULL);
	}

	if(!submitcheck('tradesubmit')) {

		$stickcount = 0;$trades = $tradesstick = array();
		while($trade = DB::fetch($query)) {
			$stickcount = $trade['displayorder'] > 0 ? $stickcount + 1 : $stickcount;
			$trade['displayorderview'] = $trade['displayorder'] < 0 ? 128 + $trade['displayorder'] : $trade['displayorder'];
			if($trade['expiration']) {
				$trade['expiration'] = ($trade['expiration'] - TIMESTAMP) / 86400;
				if($trade['expiration'] > 0) {
					$trade['expirationhour'] = floor(($trade['expiration'] - floor($trade['expiration'])) * 24);
					$trade['expiration'] = floor($trade['expiration']);
				} else {
					$trade['expiration'] = -1;
				}
			}
			if($trade['displayorder'] < 0) {
				$trades[] = $trade;
			} else {
				$tradesstick[] = $trade;
			}
		}
		$trades = array_merge($tradesstick, $trades);
		include template('forum/trade_displayorder');

	} else {

		$count = 0;
		while($trade = DB::fetch($query)) {
			$displayordernew = abs(intval($_G['gp_displayorder'][$trade['pid']]));
			$displayordernew = $displayordernew > 128 ? 0 : $displayordernew;
			if($_G['gp_stick'][$trade['pid']]) {
				$count++;
				$displayordernew = $displayordernew == 0 ? 1 : $displayordernew;
			}
			if(!$_G['gp_stick'][$trade['pid']] || $displayordernew > 0 && $_G['group']['tradestick'] < $count) {
				$displayordernew = -1 * (128 - $displayordernew);
			}
			DB::query("UPDATE ".DB::table('forum_trade')." SET displayorder='".$displayordernew."' WHERE tid='$_G[tid]' AND pid='$trade[pid]'");
		}

		showmessage('trade_displayorder_updated', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''));

	}

} elseif($_G['gp_action'] == 'debatevote') {

	if(!empty($thread['closed'])) {
		showmessage('thread_poll_closed');
	}

	if(!$_G['uid']) {
		showmessage('debate_poll_nopermission', NULL, array(), array('login' => 1));
	}

	$isfirst = empty($_G['gp_pid']) ? TRUE : FALSE;

	$debate = DB::fetch_first("SELECT uid, endtime, affirmvoterids, negavoterids FROM ".DB::table('forum_debate')." WHERE tid='$_G[tid]'");

	if(empty($debate)) {
		showmessage('debate_nofound');
	}

	if($isfirst) {
		$stand = intval($_G['gp_stand']);

		if($stand == 1 || $stand == 2) {
			if(strpos("\t".$debate['affirmvoterids'], "\t{$_G['uid']}\t") !== FALSE || strpos("\t".$debate['negavoterids'], "\t{$_G['uid']}\t") !== FALSE) {
				showmessage('debate_poll_voted');
			} elseif($debate['endtime'] && $debate['endtime'] < TIMESTAMP) {
				showmessage('debate_poll_end');
			}
		}
		if($stand == 1) {
			DB::query("UPDATE ".DB::table('forum_debate')." SET affirmvotes=affirmvotes+1 WHERE tid='$_G[tid]'");
			DB::query("UPDATE ".DB::table('forum_debate')." SET affirmvoterids=CONCAT(affirmvoterids, '$_G[uid]\t') WHERE tid='$_G[tid]'");
		} elseif($stand == 2) {
			DB::query("UPDATE ".DB::table('forum_debate')." SET negavotes=negavotes+1 WHERE tid='$_G[tid]'");
			DB::query("UPDATE ".DB::table('forum_debate')." SET negavoterids=CONCAT(negavoterids, '$_G[uid]\t') WHERE tid='$_G[tid]'");
		}

		showmessage('debate_poll_succeed', 'forum.php?mod=viewthread&tid='.$_G['tid'], array(), array('showmsg' => 1, 'locationtime' => true));
	}

	$debatepost = DB::fetch_first("SELECT stand, voterids, uid FROM ".DB::table('forum_debatepost')." WHERE pid='$_G[gp_pid]' AND tid='$_G[tid]'");
	if(empty($debatepost)) {
		showmessage('debate_nofound');
	}
	$debate = array_merge($debate, $debatepost);
	unset($debatepost);

	if($debate['uid'] == $_G['uid']) {
		showmessage('debate_poll_myself', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), array('showmsg' => 1));
	} elseif(strpos("\t".$debate['voterids'], "\t$_G[uid]\t") !== FALSE) {
		showmessage('debate_poll_voted', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), array('showmsg' => 1));
	} elseif($debate['endtime'] && $debate['endtime'] < TIMESTAMP) {
		showmessage('debate_poll_end', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), array('showmsg' => 1));
	}

	DB::query("UPDATE ".DB::table('forum_debatepost')." SET voters=voters+1, voterids=CONCAT(voterids, '$_G[uid]\t') WHERE pid='$_G[gp_pid]'");

	showmessage('debate_poll_succeed', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), array('showmsg' => 1));

} elseif($_G['gp_action'] == 'debateumpire') {

	$debate = DB::fetch_first("SELECT * FROM ".DB::table('forum_debate')." WHERE tid='$_G[tid]'");

	if(empty($debate)) {
		showmessage('debate_nofound');
	}elseif(!empty($thread['closed']) && TIMESTAMP - $debate['endtime'] > 3600) {
		showmessage('debate_umpire_edit_invalid');
	} elseif($_G['member']['username'] != $debate['umpire']) {
		showmessage('debate_umpire_nopermission');
	}

	$debate = array_merge($debate, $thread);

	if(!submitcheck('umpiresubmit')) {
		$query = DB::query("SELECT SUM(dp.voters) as voters, dp.stand, m.uid, m.username FROM ".DB::table('forum_debatepost')." dp
			LEFT JOIN ".DB::table('common_member')." m ON m.uid=dp.uid
			WHERE dp.tid='$_G[tid]' AND dp.stand>'0'
			GROUP BY m.uid
			ORDER BY voters DESC
			LIMIT 30");
		$candidate = $candidates = array();
		while($candidate = DB::fetch($query)) {
			$candidate['username'] = dhtmlspecialchars($candidate['username']);
			$candidates[$candidate['username']] = $candidate;
		}
		$winnerchecked = array($debate['winner'] => ' checked="checked"');

		list($debate['bestdebater']) = preg_split("/\s/", $debate['bestdebater']);

		include template('forum/debate_umpire');
	} else {
		if(empty($_G['gp_bestdebater'])) {
			showmessage('debate_umpire_nofound_bestdebater');
		} elseif(empty($_G['gp_winner'])) {
			showmessage('debate_umpire_nofound_winner');
		} elseif(empty($_G['gp_umpirepoint'])) {
			showmessage('debate_umpire_nofound_point');
		}
		$bestdebateruid = DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='$_G[gp_bestdebater]' LIMIT 1");
		if(!$bestdebateruid) {
			showmessage('debate_umpire_bestdebater_invalid');
		}
		if(!$bestdebaterstand = DB::result_first("SELECT stand FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND uid='$bestdebateruid' AND stand>'0' AND uid<>'$debate[uid]' AND uid<>'$_G[uid]' LIMIT 1")) {
			showmessage('debate_umpire_bestdebater_invalid');
		}
		$arr = DB::fetch_first("SELECT SUM(voters) AS voters, COUNT(*) AS replies FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND uid='$bestdebateruid'");
		$bestdebatervoters = $arr['voters'];
		$bestdebaterreplies = $arr['replies'];

		$umpirepoint = dhtmlspecialchars($_G['gp_umpirepoint']);
		$bestdebater = dhtmlspecialchars($_G['gp_bestdebater']);
		$winner = intval($_G['gp_winner']);
		DB::query("UPDATE ".DB::table('forum_thread')." SET closed='1' WHERE tid='$_G[tid]'");
		DB::query("UPDATE ".DB::table('forum_debate')." SET umpirepoint='$umpirepoint', winner='$winner', bestdebater='$bestdebater\t$bestdebateruid\t$bestdebaterstand\t$bestdebatervoters\t$bestdebaterreplies', endtime='$_G[timestamp]' WHERE tid='$_G[tid]'");
		showmessage('debate_umpire_comment_succeed', 'forum.php?mod=viewthread&tid='.$_G['tid'].($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''));
	}

} elseif($_G['gp_action'] == 'recommend') {

	dsetcookie('discuz_recommend', '', -1, 0);
	if(empty($_G['uid'])) {
		showmessage('to_login', null, array(), array('showmsg' => true, 'login' => 1));
	}
	if(!$_G['setting']['recommendthread']['status'] || !$_G['group']['allowrecommend']) {
		showmessage('undefined_action', NULL);
	}

	if($thread['authorid'] == $_G['uid'] && !$_G['setting']['recommendthread']['ownthread']) {
		showmessage('recommend_self_disallow', '', array('recommendc' => $thread['recommends']), array('msgtype' => 3));
	}

	if(DB::fetch_first("SELECT * FROM ".DB::table('forum_memberrecommend')." WHERE recommenduid='$_G[uid]' AND tid='$_G[tid]'")) {
		showmessage('recommend_duplicate', '', array('recommendc' => $thread['recommends']), array('msgtype' => 3));
	}

	$recommendcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_memberrecommend')." WHERE recommenduid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400");
	if($_G['setting']['recommendthread']['daycount'] && $recommendcount >= $_G['setting']['recommendthread']['daycount']) {
		showmessage('recommend_outoftimes', '', array('recommendc' => $thread['recommends']), array('msgtype' => 3));
	}

	$_G['group']['allowrecommend'] = intval($_G['gp_do'] == 'add' ? $_G['group']['allowrecommend'] : -$_G['group']['allowrecommend']);
	if($_G['gp_do'] == 'add') {
		$heatadd = 'recommend_add=recommend_add+1';
	} else {
		$heatadd = 'recommend_sub=recommend_sub+1';
	}

	$heatv = abs($_G['group']['allowrecommend']) * $_G['setting']['heatthread']['recommend'];
	DB::query("UPDATE ".DB::table('forum_thread')." SET heats=heats+'$heatv', recommends=recommends+'{$_G[group][allowrecommend]}', $heatadd WHERE tid='$_G[tid]'");
	DB::query("INSERT INTO ".DB::table('forum_memberrecommend')." (tid, recommenduid, dateline) VALUES ('$_G[tid]', '$_G[uid]', '$_G[timestamp]')");

	dsetcookie('recommend', 1, 43200);
	$recommendv = $_G['group']['allowrecommend'] > 0 ? '+'.$_G['group']['allowrecommend'] : $_G['group']['allowrecommend'];
	if($_G['setting']['recommendthread']['daycount']) {
		$daycount = $_G['setting']['recommendthread']['daycount'] - $recommendcount;
		showmessage('recommend_daycount_succed', '', array('recommendv' => $recommendv, 'recommendc' => $thread['recommends'], 'daycount' => $daycount), array('msgtype' => 3));
	} else {
		showmessage('recommend_succed', '', array('recommendv' => $recommendv, 'recommendc' => $thread['recommends']), array('msgtype' => 3));
	}

} elseif($_G['gp_action'] == 'removeindexheats') {

	if($_G['adminid'] != 1) {
		showmessage('undefined_action', NULL);
	}
	DB::query("UPDATE ".DB::table('forum_thread')." SET heats=0 WHERE tid='$_G[tid]'");
	require_once libfile('function/cache');
	updatecache('heats');
	dheader('Location: '.dreferer());

} elseif($_G['gp_action'] == 'protectsort') {

	if($_G['gp_sortvalue']) {
		makevaluepic($_G['gp_sortvalue']);
	} else {
		$tid = $_G['gp_tid'];
		$optionid = $_G['gp_optionid'];
		include template('common/header_ajax');
		echo DB::result_first('SELECT value FROM '.DB::table('forum_typeoptionvar')." WHERE tid='$tid' AND optionid='$optionid'");
		include template('common/footer_ajax');
	}

} elseif($_G['gp_action'] == 'activitytermini') {
	//自动完成，目的地列表
	require_once libfile('function/activity');
	$data = getZaiwaiPlaceList($_G['gp_keyword']);
	echo json_encode(array('list'=>$data));
	exit();
} elseif($_G['gp_action'] == 'geterea') {
	//获得客户端ip，为短线专区提供参数
	include_once DISCUZ_ROOT . './source/plugin/forumoption/include.php';
	$ip = $_G["clientip"];
	$zaiwaiCN = $forumOption->getStateByIp($ip);
	$zaiwaiCN = !$zaiwaiCN ? '天津' : $zaiwaiCN;
	$arrZaiwaiarea = array(
	    '北京' => "beijing",
	    '天津' => "tianjin",
	    '重庆' => "chongqing",
	    '上海' => "shanghai",
	    '河北' => "hebei",
	    '陕西' => "shanxi",
	    '辽宁' => "liaoning",
	    '吉林' => "jilin",
	    '黑龙江' => "heilongjiang",
	    '江苏' => "jiangsu",
	    '浙江' => "zhejiang",
	    '安徽' => "anhui",
	    '福建' => "fujian",
	    '江西' => "jiangxi",
	    '山东' => "shandong",
	    '河南' => "henan",
	    '湖北' => "hubei",
	    '湖南' => "hunan",
	    '广东' => "guangdong",
	    '海南' => "hainan",
	    '四川' => "sichuan",
	    '贵州' => "guizhou",
	    '云南' => "yunnan",
	    '山西' => "shan_xi",
	    '甘肃' => "gansu",
	    '青海' => "qinghai",
	    '内蒙古' => "neimenggu",
	    '广西' => "guangxi",
	    '西藏' => "xizang",
	    '宁夏' => "ningxia",
	    '新疆' => "xinjiang"
	);
	$zaiwaiarea = $arrZaiwaiarea[$zaiwaiCN];
	echo $zaiwaiarea;
	exit();
}elseif($_G['gp_action'] == 'activityconsults') {
	$activity = DB::fetch(DB::query("SELECT uid, expiration, ufield, credit, title,mobile FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'"));
	if($activity['expiration'] && $activity['expiration'] < TIMESTAMP) {
		showmessage('activity_stop', NULL, array(), array('login' => 0));
	}
	$contacts_mobile  = trim($_G['gp_contacts_mobile']);
	$wechat_no  = trim($_G['gp_wechat_no']);
	if($contacts_mobile==''&&$wechat_no==''){
		showmessage('activity_no_contacts', NULL, array(), array('login' => 0));
	}

	$contacts_type = $contacts_mobile&&!$wechat_no? 0:1;
	$remarkother = trim($_G['gp_other']);

	$data = array();
	$data['tid'] = $_G[tid];
	$data['username'] = $_G[username];
	$data['uid'] = $_G[uid];
	$data['contype'] = $contacts_type;
	$data['remark'] = daddslashes($remarkother);
	$data['dateline'] = TIMESTAMP;
	$data['ip'] = $_G['clientip'];

	if($contacts_type===0){
		$data['mobile'] = $contacts_mobile;
	}else if($contacts_type==1){
		$data['wechat'] = $wechat_no;
	}


	//防刷验证
	if(activityask_brush($data)){
		//记录ip 手机号 微信号信息(每天，防止刷单用)开始
		activityask_statistics_addlog($_G[tid],1,$_G['clientip'],1);
		if($contacts_type===0){
			activityask_statistics_addlog($_G[tid],2,$contacts_mobile,1);
		}else if($contacts_type==1){
			activityask_statistics_addlog($_G[tid],3,$wechat_no,1);
		}
		//记录ip 手机号 微信号信息(每天，防止刷单用)结束
		showmessage('activity_consultcompletion', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), array('login' => 0));
	}

	DB::insert('forum_activity_consult', $data);
	$askid = DB::insert_id();
	if($askid){
		//记录ip 手机号 微信号信息(每天，防止刷单用)开始
		activityask_statistics_addlog($_G[tid],1,$_G['clientip'],1);
		if($contacts_type===0){
			activityask_statistics_addlog($_G[tid],2,$contacts_mobile,1);
		}else if($contacts_type==1){
			activityask_statistics_addlog($_G[tid],3,$wechat_no,1);
		}
		//记录ip 手机号 微信号信息(每天，防止刷单用)结束
		if($activity['mobile']){
			$contacts_info = $contacts_mobile?"手机号".$contacts_mobile:"微信号".$wechat_no;
			$remarkstr = $remarkother?'备注：'.$remarkother.'，':'';
			$send_msg_content = iconv('GB2312', 'UTF-8',"8264提醒您，{$contacts_info}的用户正在咨询活动：{$activity['title']}，{$remarkstr}请尽快联系。");
			$send_msg_res = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=send_msg&tel=".$activity['mobile']."&content=".$send_msg_content);
		}
		showmessage('activity_consultcompletion', "forum.php?mod=viewthread&tid=$_G[tid]".($_G['gp_from'] ? '&from='.$_G['gp_from'] : ''), array(), array('login' => 0));
	}

}elseif($_G['gp_action'] == 'activityapplylist'){
	//将activityapplylist 进行了改版
	$isactivitymaster = $thread['authorid'] == $_G['uid'] || $_G['group']['alloweditactivity'];
	$activity = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'");
	if(!$activity || $thread['special'] != 4 || !$isactivitymaster) {
		showmessage('undefined_action');
	}

	if(!submitcheck('applylistsubmit')) {
		$applylist = array();
		$activity['ufield'] = $activity['ufield'] ? unserialize($activity['ufield']) : array();
		$tmpdata = getallorder($_G[tid]);
		require_once libfile('function/profile');
		foreach ($tmpdata as $applyid => $activityapplies) {
			$ufielddata = '';
			$activityapplies['dateline'] = dgmdate($activityapplies['dateline'], 'u');
			$activityapplies['ufielddata'] = !empty($activityapplies['ufielddata']) ? unserialize($activityapplies['ufielddata']) : '';
			if($activityapplies['ufielddata']) {
				if($activityapplies['ufielddata']['userfield']) {
					if($activity['formid']){
						//使用了表单助手
						gethdfieldsetting();
						$data 		= '';
						$hasmobile  = false;//在外app端的报名数据
						foreach($activity['ufield']['userfield'] as $fieldid) {
							$hasmobile = $hasmobile || $fieldid == 'mobile' ? true : false;

							$data = profile_show2($fieldid, $activityapplies['ufielddata']['userfield']);
							$ufielddata .= '<li>'.$_G['cache']['profilesetting2'][$fieldid]['title'].'&nbsp;&nbsp;:&nbsp;&nbsp;'.$data.'</li>';
						}
						if (!$hasmobile && $activityapplies['appuserid']) {
							$fieldid = 'mobile';
							$data 	 = profile_show2($fieldid, $activityapplies['ufielddata']['userfield']);
							$ufielddata .= '<li>'.$_G['cache']['profilesetting2'][$fieldid]['title'].'&nbsp;&nbsp;:&nbsp;&nbsp;'.$data.'</li>';
						}
					}else{
						loadcache('profilesetting');
						$data 		= '';
						$hasmobile  = false;//在外app端的报名数据
						foreach($activity['ufield']['userfield'] as $fieldid) {
							$hasmobile = $hasmobile || $fieldid == 'mobile' ? true : false;

							$data = profile_show($fieldid, $activityapplies['ufielddata']['userfield']);
							$ufielddata .= '<li>'.$_G['cache']['profilesetting'][$fieldid]['title'].'&nbsp;&nbsp;:&nbsp;&nbsp;'.$data.'</li>';
						}
						if (!$hasmobile && $activityapplies['appuserid']) {
							$fieldid = 'mobile';
							$data 	 = profile_show($fieldid, $activityapplies['ufielddata']['userfield']);
							$ufielddata .= '<li>'.$_G['cache']['profilesetting'][$fieldid]['title'].'&nbsp;&nbsp;:&nbsp;&nbsp;'.$data.'</li>';
						}
					}
				}
				if($activityapplies['ufielddata']['extfield']) {
					foreach($activity['ufield']['extfield'] as $name) {
						$ufielddata .= '<li>'.$name.'&nbsp;&nbsp;:&nbsp;&nbsp;'.$activityapplies['ufielddata']['extfield'][$name].'</li>';
					}
				}
			}
			$activityapplies['ufielddata'] = $ufielddata;
			$activityapplies['applyid'] = $applyid;
			$applylist[] = $activityapplies;
		}

		$activity['starttimefrom'] = dgmdate($activity['starttimefrom'], 'u');
		$activity['starttimeto']   = $activity['starttimeto'] ? dgmdate($activity['starttimeto'], 'u') : 0;
		$activity['expiration']    = $activity['expiration'] ? dgmdate($activity['expiration'], 'u') : 0;

		include template('forum/activity_applylist');
	} else {
		$locationurl = !empty($_G['gp_referer']) ? $_G['gp_referer'] : "forum.php?mod=viewthread&tid=$_G[tid]&do=viewapplylist".($_G['gp_from'] ? '&from='.$_G['gp_from'] : '');

		if(empty($_G['gp_applyidarray'])) {
			showmessage('activity_choice_applicant');
		} else {
			$reason   = cutstr(dhtmlspecialchars($_G['gp_reason']), 200);
			$uidarray = $unverified = $appactids = $appuserids = array();
			$ids   	  = dimplode($_G['gp_applyidarray']);
			$allorder = getallorder($_G[tid]);
			//将当前需要操作的数据筛选出来
			if(is_array($_G['gp_applyidarray'])){
				foreach($_G['gp_applyidarray'] as $applyid){
					if(isset($allorder[$applyid])){
						$info = $allorder[$applyid];
						$uidarray[] = $info['uid']; //待操作的全部用户
						if($info['verified'] != 1) {
							$unverified[] = $applyid;
							$unverified_uid[] = $info['uid'];
						}
					}
				}
			}
			$activity_subject = $thread['subject'];

			if($_G['gp_operation'] == 'notification') {
				if(empty($uidarray)) {
					showmessage('activity_notification_user');
				}
				if(empty($reason)) {
					showmessage('activity_notification_reason');
				}
				if($uidarray) {
					foreach($uidarray as $uid) {
						notification_add($uid, 'activity', 'activity_notification', array('tid' => $_G['tid'], 'subject' => $activity_subject, 'msg' => $reason));
					}
					$_G['gp_is_uc'] = $_G['gp_need_uc'] ? 1 : 0;

					showmessage('activity_notification_success', $locationurl, array(), array('showdialog' => 1, 'closetime' => true));
				}
			} elseif($_G['gp_operation'] == 'delete') {
				if($uidarray) {
					updatestatus($_G['tid'], implode(',', $_G['gp_applyidarray']), -1);
					foreach($uidarray as $uid) {
						notification_add($uid, 'activity', 'activity_delete', array(
							'tid' => $_G['tid'],
							'subject' => $activity_subject,
							'reason' => stripslashes($reason),
						));
						clearcache_getapplyhistory($_G['tid'], $uid);
						clearcache_getapply($uid);
					}
				}
				clearcache_getallorder($_G['tid']);
				showmessage('activity_delete_completion', $locationurl);
			} else {
				if($unverified) {
					$unverified = implode(',', $unverified);
					$verified = $_G['gp_operation'] == 'replenish' ? 2 : 1;

					updatestatus($_G['tid'], $unverified, $verified);

					$notification_lang = $verified == 1 ? 'activity_apply' : 'activity_replenish';
					foreach($unverified_uid as $uid) {
						notification_add($uid, 'activity', $notification_lang, array(
							'tid' => $_G['tid'],
							'subject' => $activity_subject,
							'reason' => stripslashes($reason),
						));
						clearcache_getapplyhistory($_G['tid'], $uid);
						clearcache_getapply($uid);
					}
					clearcache_getallorder($_G['tid']);
				}
				showmessage('activity_auditing_completion', $locationurl);
			}
		}
	}
}


function activityask_brush($data=array()){
	$currdate = strtotime(date('Y-m-d', TIMESTAMP));
	//同ip某一活动某天最多三次咨询入库
	$ipcounts =DB::result_first("SELECT counts FROM " . DB::table('forum_activity_consult_statistics') . " where tid={$data[tid]} and data_val = '{$data[ip]}' and data_type = 1 and datetime = {$currdate} " . getSlaveID());
	if($ipcounts>3){
		return true;
		die;
	}
	//1分钟某一活动相同信息重复提交验证开始
	if($data['contype']===0){
		$mobilecounts =DB::result_first("SELECT COUNT(*) FROM " . DB::table('forum_activity_consult') . " where tid={$data[tid]} and mobile = '{$data[mobile]}' and dateline > ".(TIMESTAMP-10)." " . getSlaveID());
		if($mobilecounts>0){
			return true;
			die;
		}
	}elseif($data['contype']==1){
		$wechatnocounts =DB::result_first("SELECT COUNT(*) FROM " . DB::table('forum_activity_consult') . " where tid={$data[tid]} and wechat = '{$data[wechat]}' and dateline > ".(TIMESTAMP-10)." " . getSlaveID());
		if($wechatnocounts>0){
			return true;
			die;
		}
	}

	return false;
}


function activityask_statistics_addlog($tid,$type,$data_val,$q){
		$currdate = strtotime(date('Y-m-d', TIMESTAMP));
		$data =DB::fetch_first("SELECT * FROM " . DB::table('forum_activity_consult_statistics') . " where tid={$tid} and data_val = '{$data_val}' and data_type = {$type} and datetime = {$currdate} " . getSlaveID());

		if($data){
			DB::update('forum_activity_consult_statistics', array('counts'=>($data['counts']+$q)), "id={$data['id']}");
		}else{
			DB::insert('forum_activity_consult_statistics', array(
				'tid' => $tid,
				'counts' => $q,
				'data_val' => $data_val,
				'data_type' => $type,
				'datetime' => $currdate
				));
		}

	}


function makevaluepic($value) {
	Header("Content-type:image/png");
	$im = @imagecreate(130, 25);
	$background_color = imagecolorallocate($im, 255, 255, 255);
	$text_color = imagecolorallocate($im, 23, 14, 91);
	imagestring($im, 4, 0, 4, $value, $text_color);
	imagepng($im);
	imagedestroy($im);
}

function getratelist($raterange) {
	global $_G;
	$maxratetoday = getratingleft($raterange);

	$ratelist = array();
	foreach($raterange as $id => $rating) {
		if(isset($_G['setting']['extcredits'][$id])) {
			$ratelist[$id] = '';
			$rating['max'] = $rating['max'] < $maxratetoday[$id] ? $rating['max'] : $maxratetoday[$id];
			$rating['min'] = -$rating['min'] < $maxratetoday[$id] ? $rating['min'] : -$maxratetoday[$id];
			$offset = abs(ceil(($rating['max'] - $rating['min']) / 10));
			if($rating['max'] > $rating['min']) {
				for($vote = $rating['max']; $vote >= $rating['min']; $vote -= $offset) {
					$ratelist[$id] .= $vote ? '<li>'.($vote > 0 ? '+'.$vote : $vote).'</li>' : '';
				}
			}
		}
	}
	return $ratelist;
}

function getratingleft($raterange) {
	global $_G;
	$maxratetoday = array();

	foreach($raterange as $id => $rating) {
		$maxratetoday[$id] = $rating['mrpd'];
	}

	$query = DB::query("SELECT extcredits, SUM(ABS(score)) AS todayrate FROM ".DB::table('forum_ratelog')."
		WHERE uid='$_G[uid]' AND dateline>='$_G[timestamp]'-86400
		GROUP BY extcredits");
	while($rate = DB::fetch($query)) {
		$maxratetoday[$rate['extcredits']] = $raterange[$rate['extcredits']]['mrpd'] - $rate['todayrate'];
	}
	return $maxratetoday;
}

?>
