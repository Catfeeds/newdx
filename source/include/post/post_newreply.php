<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: post_newreply.php 18213 2010-11-17 02:09:45Z zhengqingpeng $
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//限制点评访问
if($_G['fid']==$_G['config']['fids']['brand']||$_G['fid']==$_G['config']['fids']['equipment']||$_G['fid']==$_G['config']['fids']['skiing']||$_G['fid']==$_G['config']['fids']['dianpu']||$_G['fid']==$_G['config']['fids']['mountain']||$_G['fid']==$_G['config']['fids']['line']||$_G['fid']==$_G['config']['fids']['shop']||$_G['fid']==$_G['config']['fids']['climb']){
	showmessage('您请求的来路不正确，禁止访问！', NULL);
}
require_once libfile('function/forumlist');
$isfirstpost = 0;
$showthreadsorts = 0;
$quotemessage = '';
if ($special == 5) {
	$debate = array_merge($thread, DB::fetch_first("SELECT * FROM ".DB::table('forum_debate')." WHERE tid='$_G[tid]'"));
	$standquery = DB::query("SELECT stand FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND uid='$_G[uid]' AND stand>'0' ORDER BY dateline LIMIT 1");
	$firststand = DB::result_first("SELECT stand FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND uid='$_G[uid]' AND stand>'0' ORDER BY dateline LIMIT 1");
	$stand = $firststand ? $firststand : intval($_G['gp_stand']);
	if ($debate['endtime'] && $debate['endtime'] < TIMESTAMP) {
		showmessage('debate_end');
	}
}
if (! $_G['uid'] && ! ((! $_G['forum']['replyperm'] && $_G['group']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'])))) {
	showmessage('replyperm_login_nopermission', null, array(), array('login' => 1));
} elseif (empty($_G['forum']['allowreply'])) {
	if (! $_G['forum']['replyperm'] && ! $_G['group']['allowreply']) {
		showmessage('replyperm_none_nopermission', null, array(), array('login' => 1));
	} elseif ($_G['forum']['replyperm'] && ! forumperm($_G['forum']['replyperm'])) {
		showmessagenoperm('replyperm', $_G['forum']['fid']);
	}
} elseif ($_G['forum']['allowreply'] == -1) {
	showmessage('post_forum_newreply_nopermission', null);
}
if (! $_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
	showmessage('replyperm_login_nopermission', null, array(), array('login' => 1));
}
if (empty($thread)) {
	showmessage('thread_nonexistence');
} elseif ($thread['price'] > 0 && $thread['special'] == 0 && ! $_G['uid']) {
	showmessage('group_nopermission', null, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
}
checklowerlimit('reply', 0, 1, $_G['forum']['fid']);
if ($_G['setting']['commentnumber'] && ! empty($_G['gp_comment'])) { //10  和  yes
	$posttable = getposttablebytid($_G['tid']); //返回论坛回复表的表名forum_post
	if (! submitcheck('commentsubmit', 0, $seccodecheck, $secqaacheck)) {
		showmessage('undefined_action', null); //未定义操作，请返回
	}
	$post = DB::fetch_first('SELECT * FROM '.DB::table($posttable)." WHERE pid='$_G[gp_pid]'");
	if (! $post) {
		showmessage('undefined_action', null);
	}
	if ($thread['closed'] && $_G['adminid']!=1 && ! $thread['isgroup']) {
		showmessage('post_thread_closed');
	} elseif (! $thread['isgroup'] && $post_autoclose = checkautoclose($thread)) {
		showmessage($post_autoclose, '', array('autoclose' => $_G['forum']['autoclose']));
	} elseif (checkflood()) {
		showmessage('post_flood_ctrl', '', array('floodctrl' => $_G['setting']['floodctrl']));
	} elseif (checkmaxpostsperhour()) {
		showmessage('post_flood_ctrl_posts_per_hour', '', array('posts_per_hour' => $_G['group']['maxpostsperhour']));
	}
	$commentscore = '';
	if (! empty($_G['gp_commentitem']) && $post['authorid'] != $_G['uid']) {
		foreach ($_G['gp_commentitem'] as $itemk => $itemv) {
			if ($itemv !== '') {
				$commentscore .= strip_tags(trim($itemk)).': <i>'.intval($itemv).'</i> ';
			}
		}
	}
	$comment = cutstr(($commentscore ? $commentscore.'<br />' : '').censor(trim(htmlspecialchars($_G['gp_message'])), '***'), 200, ' ');
	if (! $comment) {
		showmessage('post_sm_isnull');
	}
	DB::insert('forum_postcomment', array(
		'tid' => $post['tid'],
		'pid' => $post['pid'],
		'author' => $_G['username'],
		'authorid' => $_G['uid'],
		'dateline' => TIMESTAMP,
		'comment' => $comment,
		'score' => $commentscore ? 1 : 0,
		'forpid' => 0,
		'replyid' => 0,
		));
	//添加点评之后将帖子回复表的comment字段赋值为1，代表该贴有评论
	DB::update($posttable, array('comment' => 1), "pid='$_G[gp_pid]'");
	//该行对积分进行更新操作，并通过Cookie通知界面弹出积分增减提示；
	updatepostcredits('+', $_G['uid'], 'reply', $_G['fid']);
	if ($_G['uid'] != $post['authorid']) {
		notification_add($post['authorid'], 'pcomment', 'comment_add', array(
			'tid' => $_G['tid'],
			'pid' => $_G['gp_pid'],
			'subject' => $thread['subject'],
			'commentmsg' => cutstr(str_replace(array(
				'[b]',
				'[/b]',
				'[/color]'), '', preg_replace("/\[color=([#\w]+?)\]/i", "", stripslashes($comment))), 200)));
	}
	$pcid = DB::result_first("SELECT id FROM ".DB::table('forum_postcomment')." WHERE pid='$_G[gp_pid]' AND authorid='0'");
	if ($_G['gp_commentitem']) {
		$query = DB::query('SELECT comment FROM '.DB::table('forum_postcomment')." WHERE pid='$_G[gp_pid]' AND score='1'");
		$totalcomment = array();
		while ($comment = DB::fetch($query)) {
			$comment['comment'] = addslashes($comment['comment']);
			if (strexists($comment['comment'], '<br />')) {
				if (preg_match_all("/([^:]+?):\s<i>(\d+)<\/i>/", $comment['comment'], $a)) {
					foreach ($a[1] as $k => $itemk) {
						$totalcomment[trim($itemk)][] = $a[2][$k];
					}
				}
			}
		}
		$totalv = '';
		foreach ($totalcomment as $itemk => $itemv) {
			$totalv .= strip_tags(trim($itemk)).': <i>'.(floatval(sprintf('%1.1f', array_sum($itemv) / count($itemv)))).'</i> ';
		}
		if ($pcid) {
			DB::update('forum_postcomment', array('comment' => $totalv, 'dateline' => TIMESTAMP + 1), "id='$pcid'");
		} else {
			DB::insert('forum_postcomment', array(
				'tid' => $post['tid'],
				'pid' => $post['pid'],
				'author' => '',
				'authorid' => '0',
				'dateline' => TIMESTAMP + 1,
				'comment' => $totalv));
		}
	}
	DB::update('forum_postcomment', array('dateline' => TIMESTAMP + 1), "id='$pcid'");
	showmessage('comment_add_succeed', "forum.php?mod=viewthread&tid=$post[tid]&pid=$post[pid]&page=$_G[gp_page]&extra=$extra#pid$post[pid]", array('tid' => $post['tid'], 'pid' => $post['pid']));
}
if ($special == 127) {
	$posttable = getposttablebytid($_G['tid']);
	$postinfo = DB::fetch_first("SELECT message FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='1'");
	$sppos = strrpos($postinfo['message'], chr(0).chr(0).chr(0));
	$specialextra = substr($postinfo['message'], $sppos + 3);
}
if (! submitcheck('replysubmit', 0, $seccodecheck, $secqaacheck)) {
	if ($thread['special'] == 2 && ((! isset($_G['gp_addtrade']) || $thread['authorid'] != $_G['uid']) && ! $tradenum = DB::result_first("SELECT count(*) FROM ".DB::table('forum_trade')." WHERE tid='$_G[tid]'"))) {
		showmessage('trade_newreply_nopermission', null);
	}
	$language = lang('forum/misc');
	$noticeauthor = $noticetrimstr = '';
	if (isset($_G['gp_repquote'])) {
		$posttable = getposttablebytid($_G['tid']);
		$thaquote = DB::fetch_first("SELECT tid, fid, author, authorid, first, message, useip, dateline, anonymous, status FROM ".DB::table($posttable)." WHERE pid='$_G[gp_repquote]' AND (invisible='0' OR (authorid='$_G[uid]' AND invisible='-2'))");
		if ($thaquote['tid'] != $_G['tid']) {
			//处理回帖被删除，回帖的评论记录未删除的问题
			if(empty($thaquote['tid']) && $_G['gp_repquote']) {
				DB::query("DELETE FROM ".DB::table("forum_postcomment")." WHERE forpid='$_G[gp_repquote]'");
			}
			showmessage('undefined_action', null);
		}
		if (getstatus($thread['status'], 2) && $thaquote['authorid'] != $_G['uid'] && $_G['uid'] != $thread['authorid'] && $thaquote['first'] != 1 && ! $_G['forum']['ismoderator']) {
			showmessage('undefined_action', null);
		}
		if (! ($thread['price'] && ! $thread['special'] && $thaquote['first'])) {
			$time = dgmdate($thaquote['dateline']);
			$quotefid = $thaquote['fid'];
			$message = $thaquote['message'];
			if ($_G['setting']['bannedmessages'] && $thaquote['authorid']) {
				$author = DB::fetch_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid='$thaquote[authorid]'");
				if (! $author['groupid'] || $author['groupid'] == 4 || $author['groupid'] == 5) {
					$message = $language['post_banned'];
				} elseif ($thaquote['status'] & 1) {
					$message = $language['post_single_banned'];
				}
			}
			$message = implode("\n", array_slice(explode("\n", $message), 0, 3));
			$thaquote['useip'] = substr($thaquote['useip'], 0, strrpos($thaquote['useip'], '.')).'.x';
			if ($thaquote['author'] && $thaquote['anonymous']) {
				$thaquote['author'] = 'Anonymous';
			} elseif (! $thaquote['author']) {
				$thaquote['author'] = 'Guest from '.$thaquote['useip'];
			} else {
				$thaquote['author'] = $thaquote['author'];
			}
			$post_reply_quote = lang('forum/misc', 'post_reply_quote', array('author' => $thaquote['author'], 'time' => $time));
			$noticeauthormsg = htmlspecialchars($message);
			//对活动头贴引用的处理
			if ($thread['special'] && $thaquote['first']) {
				$noticeauthormsg = explode('[----]', $noticeauthormsg);
				$noticeauthormsg = "行程介绍：{$noticeauthormsg[0]}费用装备：{$noticeauthormsg[1]}其他：{$noticeauthormsg[2]}";
			}
			$noticeauthormsg = messagecutstr($noticeauthormsg, 100);
			$message = $noticeauthormsg;
			$message = "[quote][size=2][color=#999999]{$post_reply_quote}[/color] [url=forum.php?mod=redirect&goto=findpost&pid=$_G[gp_repquote]&ptid={$_G['tid']}][img]http://static.8264.com/static/image/common/back.gif[/img][/url][/size]\n{$message}[/quote]";
			$quotemessage = discuzcode($message, 0, 0);
			$noticeauthor = htmlspecialchars('q|'.$thaquote['authorid'].'|'.$thaquote['author']);
			$noticetrimstr = htmlspecialchars($message);
			$message = '';
		}
	} elseif (isset($_G['gp_reppost']) && $_G['gp_reppost'] = intval($_G['gp_reppost'])) {
		$posttable = getposttablebytid($_G['tid']);
		$thapost = DB::fetch_first("SELECT tid, author, authorid, useip, dateline, anonymous, status, message FROM ".DB::table($posttable)." WHERE pid='$_G[gp_reppost]' AND (invisible='0' OR (authorid='$_G[uid]' AND invisible='-2'))");
		if ($thapost['tid'] != $_G['tid']) {
			showmessage('undefined_action', null);
		}
		$thapost['useip'] = substr($thapost['useip'], 0, strrpos($thapost['useip'], '.')).'.x';
		if ($thapost['author'] && $thapost['anonymous']) {
			$thapost['author'] = '[color=Olive]Anonymous[/color]';
		} elseif (! $thapost['author']) {
			$thapost['author'] = '[color=Olive]Guest[/color] from '.$thapost['useip'];
		} else {
			$thapost['author'] = '[color=Olive]'.$thapost['author'].'[/color]';
		}
		$posttable = getposttablebytid($thapost['tid']);
		$message = "[b]$language[post_reply] [url=forum.php?mod=redirect&goto=findpost&pid=$_G[gp_reppost]&ptid=$thapost[tid]]$thapost[author] $language[post_thread][/url][/b]";
		$quotemessage = discuzcode($message, 0, 0);
		$noticeauthormsg = htmlspecialchars(messagecutstr($thapost['message'], 100));
		$noticeauthor = htmlspecialchars('r|'.$thapost['authorid'].'|'.$thapost['author']);
		$noticetrimstr = htmlspecialchars($message);
		$message = '';
	}
	if (isset($_G['gp_addtrade']) && $thread['special'] == 2 && $_G['group']['allowposttrade'] && $thread['authorid'] == $_G['uid']) {
		$expiration_7days = date('Y-m-d', TIMESTAMP + 86400 * 7);
		$expiration_14days = date('Y-m-d', TIMESTAMP + 86400 * 14);
		$trade['expiration'] = $expiration_month = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, date('d'), date('Y')));
		$expiration_3months = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, date('d'), date('Y')));
		$expiration_halfyear = date('Y-m-d', mktime(0, 0, 0, date('m') + 6, date('d'), date('Y')));
		$expiration_year = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') + 1));
	}
	if ($thread['replies'] <= $_G['ppp']) { //         10
		$postlist = array();
		$posttable = getposttablebytid($_G['tid']);
		$query = DB::query("SELECT p.* ".($_G['setting']['bannedmessages'] ? ', m.groupid ' : '')."FROM ".DB::table($posttable)." p ".($_G['setting']['bannedmessages'] ? "LEFT JOIN ".DB::table('common_member')." m ON p.authorid=m.uid " : '')."WHERE p.tid='$_G[tid]' AND p.invisible='0' ".($thread['price'] > 0 && $thread['special'] == 0 ? 'AND p.first = 0' : '')." ORDER BY p.dateline DESC");
		while ($post = DB::fetch($query)) {
			$post['dateline'] = dgmdate($post['dateline'], 'u');
			if ($_G['setting']['bannedmessages'] && ($post['authorid'] && (! $post['groupid'] || $post['groupid'] == 4 || $post['groupid'] == 5))) {
				$post['message'] = $language['post_banned'];
			} elseif ($post['status'] & 1) {
				$post['message'] = $language['post_single_banned'];
			} else {
				$post['message'] = preg_replace("/\[hide=?\d*\](.+?)\[\/hide\]/is", "[b]$language[post_hidden][/b]", $post['message']);
				$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], $post['htmlon'] & 1, $_G['forum']['allowsmilies'], $_G['forum']['allowbbcode'], $_G['forum']['allowimgcode'], $_G['forum']['allowhtml'], $_G['forum']['jammer']);
			}
			$postlist[] = $post;
		}
	}
	if ($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
		$attachlist = getattach(0);
		$attachs = $attachlist['attachs'];
		$imgattachs = $attachlist['imgattachs'];
		unset($attachlist);
	}

	//图片上传方式改为upyun form方式 by zhangwenchu 20170118
	require_once libfile('post/upyunform.inc', 'include');

	//调用引用的模板回复表单框
	if (! getgpc('infloat') && ! getgpc('inajax')) {
		include template('forum/post_newimage');
	} else {
		if ($_G['fid'] == $_G['config']['fids']['skiing']) {
			getgpc('infloat') ? include template('forum/post_infloatskiing') : include template('forum/post');
		} elseif ($_G['fid'] == $_G['config']['fids']['produce']) {
			getgpc('infloat') ? include template('forum/post_infloatbrand') : include template('forum/post');
		} else {
			getgpc('infloat') ? include template('forum/post_infloat') : include template('forum/post');
		}
	}
} else {
	//禁止用户发帖操作（modify by zhanghongliang at 2012.4.27）
	if ($_G['fid'] == $_G['config']['fids']['zbfx']) {
		$forbidcomment = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_publishers')." WHERE uid = {$_G['uid']} and forbidcomment = 1");
		if ($forbidcomment) {
			showmessage('很遗憾的通知您，您已被管理员禁止在本版块发布评论！', null);
		}
	}
	//end
	if (trim($subject) == '' && trim($message) == '' && $thread['special'] != 2) {
		showmessage('post_sm_isnull');
	} elseif ($thread['closed'] && $_G['adminid']!=1 && ! $thread['isgroup']) {
		showmessage('post_thread_closed');
	} elseif (! $thread['isgroup'] && $post_autoclose = checkautoclose($thread)) {
		showmessage($post_autoclose, '', array('autoclose' => $_G['forum']['autoclose']));
	} elseif ($post_invalid = checkpost($subject, $message, $special == 2 && $_G['group']['allowposttrade'])) {
		showmessage($post_invalid, '', array('minpostsize' => $_G['setting']['minpostsize'], 'maxpostsize' => $_G['setting']['maxpostsize']));
	} elseif (checkflood()) {
		showmessage('post_flood_ctrl', '', array('floodctrl' => $_G['setting']['floodctrl']));
	} elseif (checkmaxpostsperhour()) {
		showmessage('post_flood_ctrl_posts_per_hour', '', array('posts_per_hour' => $_G['group']['maxpostsperhour']));
	}
	if (! empty($_G['gp_trade']) && $thread['special'] == 2 && $_G['group']['allowposttrade']) {
		$item_price = floatval($_G['gp_item_price']);
		$item_credit = intval($_G['gp_item_credit']);
		if (! trim($_G['gp_item_name'])) {
			showmessage('trade_please_name');
		} elseif ($_G['group']['maxtradeprice'] && $item_price > 0 && ($_G['group']['mintradeprice'] > $item_price || $_G['group']['maxtradeprice'] < $item_price)) {
			showmessage('trade_price_between', '', array('mintradeprice' => $_G['group']['mintradeprice'], 'maxtradeprice' => $_G['group']['maxtradeprice']));
		} elseif ($_G['group']['maxtradeprice'] && $item_credit > 0 && ($_G['group']['mintradeprice'] > $item_credit || $_G['group']['maxtradeprice'] < $item_credit)) {
			showmessage('trade_credit_between', '', array('mintradeprice' => $_G['group']['mintradeprice'], 'maxtradeprice' => $_G['group']['maxtradeprice']));
		} elseif (! $_G['group']['maxtradeprice'] && $item_price > 0 && $_G['group']['mintradeprice'] > $item_price) {
			showmessage('trade_price_more_than', '', array('mintradeprice' => $_G['group']['mintradeprice']));
		} elseif (! $_G['group']['maxtradeprice'] && $item_credit > 0 && $_G['group']['mintradeprice'] > $item_credit) {
			showmessage('trade_credit_more_than', '', array('mintradeprice' => $_G['group']['mintradeprice']));
		} elseif ($item_price <= 0 && $item_credit <= 0) {
			showmessage('trade_pricecredit_need');
		} elseif ($_G['gp_item_number'] < 1) {
			showmessage('tread_please_number');
		}
	}
	$attentionon = empty($_G['gp_attention_add']) ? 0 : 1;
	$attentionoff = empty($attention_remove) ? 0 : 1;
	$heat = $thread['heats'];
	if ($thread['lastposter'] != $_G['member']['username']) {
		$posttable = getposttablebytid($_G['tid']);
		$userreplies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='0' AND authorid='$_G[uid]' ".getSlaveID());
		$thread['heats'] += round($_G['setting']['heatthread']['reply'] * pow(0.8, $userreplies));
		//添加日志信息
		if ($_G['fid'] == 408) {
			require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$logs = new logs;
			$logs->set_filename('heats');
			$logs->log_str("当前tid: ".$_G['tid']." 原先值:".$heat.",最新值：".$thread['heats']."由uid:".$_G['uid'].":会员名：".$_G['member']['username']." 操作");
		}
		//end
		$heatbefore = $thread['heats'];
		DB::query("UPDATE ".DB::table('forum_thread')." SET heats='$thread[heats]' WHERE tid='$_G[tid]'", 'UNBUFFERED');
	}

	//增加@功能，在引用之前处理，避免对引用内容中存在的@进行通知
	if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) {
		require_once libfile("class/at");
		$at = new at;
		$message = $at->parse($message);
	}
	//@匹配结束

	if (! empty($_G['gp_noticetrimstr'])) {
		$message = $_G['gp_noticetrimstr']."\n\n".$message;
	}
	$bbcodeoff = checkbbcodes($message, ! empty($_G['gp_bbcodeoff']));
	$smileyoff = checksmilies($message, ! empty($_G['gp_smileyoff']));
	$parseurloff = ! empty($_G['gp_parseurloff']);
	$htmlon = $_G['group']['allowhtml'] && ! empty($_G['gp_htmlon']) ? 1 : 0;
	$usesig = ! empty($_G['gp_usesig']) ? 1 : ($_G['uid'] && $_G['group']['maxsigsize'] ? 1 : 0);
	$isanonymous = $_G['group']['allowanonymous'] && ! empty($_G['gp_isanonymous']) ? 1 : 0;
	$author = empty($isanonymous) ? $_G['username'] : '';
	/**
	 * 新增用于图片附件的处理，当插入三张后，剩余的图片，将不用附件形式展现，而且继续保存在未使用中。
	 * 2012-08-29 jianghong
	 * $send_img：提交的帖子中图片，不包含附件
	 */
	$new_img_edit = $_G['gp_attachnew'];
	if (preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $message)) {
		preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $message, $matches);
		$send_img = $matches[2];
		foreach ($new_img_edit as $key => $descon) {
			if (! in_array($key, $send_img)) {
				unset($new_img_edit[$key]);
			}
		}
	} else {
		unset($new_img_edit);
	}
	//$new_img_edit=$_G['fid']==64?$new_img_edit:$_G['gp_attachnew'];
	/**
	 * 以上修改部分
	 */
	$pinvisible = $modnewreplies ? -2 : ($thread['displayorder'] == -4 ? -3 : 0);
	$message = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $message);
	//添加过滤
	$pattern = "[img=1,1";
	if (strstr($message, $pattern)) {
		$pinvisible = $modnewreplies = -2;
	}
	$pattern1 = "[flash=1,1";
	if(strstr($message,$pattern1)){
		$pinvisible = $modnewreplies = -2;
	}
	//end

	//引用添加的操作
	$pid = insertpost(array(
		'fid' => $_G['fid'],
		'tid' => $_G['tid'],
		'first' => '0',
		'author' => $_G['username'],
		'authorid' => $_G['uid'],
		'subject' => $subject,
		'dateline' => $_G['timestamp'],
		'message' => $message,
		'useip' => $_G['clientip'],
		'invisible' => $pinvisible,
		'anonymous' => $isanonymous,
		'usesig' => $usesig,
		'htmlon' => $htmlon,
		'bbcodeoff' => $bbcodeoff,
		'smileyoff' => $smileyoff,
		'parseurloff' => $parseurloff,
		'attachment' => '0',
		));
	//start 记录回复帖子信息
	$parr = array(
		'tid' => $_G['tid'],
		'pid' => $pid,
		'uid' => $_G['uid'],
		'username' => $_G['username'],
		'fid' => $_G['fid'],
		'name' => $_G['forum']['name'],  // lxp 20140126
		'subject' => $subject,
		'message' => $message,
		'ip' => $_G['clientip']);
	addrecordthread($parr, 3);
	//end

	// 发送@提醒
	if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) {
		$at->thread = array('tid' => $_G['tid'], 'pid' => $pid, 'subject' => $thread['subject']);
		$at->notice();
	}

	$typeid = DB::result_first("SELECT typeid FROM ".DB::table('forum_thread')." WHERE tid='{$_G['tid']}'");
	DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');
	if ($_G['gp_way'] == 'reply' || $_G['gp_way'] == 'commentreply' ||  $_G['gp_way'] == 'picturereply') {
		//标签过滤 start
		$message = substr($message, strpos($message, "[/quote]"));
		//筛选过滤内容
		$tagarr = array(
			"img",
			"quote",
			"code",
			"audio",
			"media",
			"ra",
			"rm",
			"wma",
			"wmv",
			"attach",
			"list");
		for ($i = 0; $i < count($tagarr); $i++) {
			$tag = $tagarr[$i];
			$rule = "/\[$tag.*?\](.*)\[\/$tag\]/";
			$message = preg_replace($rule, '', $message);
		}
		$singletag = array(
			"url",
			"b",
			"color",
			"i",
			"u",
			"align",
			"list",
			"size",
			"font",
			"p",
			"img",
			"quote",
			"code",
			"audio",
			"media",
			"ra",
			"rm",
			"wma",
			"wmv",
			"attach");
		for ($i = 0; $i < count($singletag); $i++) {
			$tagsin = $singletag[$i];
			$leftrule = "/\[$tagsin.*?\]/";
			$message = preg_replace($leftrule, "", $message);
			$rightrule = "/\[\/$tagsin\]/";
			$message = preg_replace($rightrule, "", $message);
		}
		$message = preg_replace("/\[hr\]/", "", $message);
		$message = preg_replace("/\[\*\]/", "", $message);
		//标签过滤 end
		//根据板块表情是否启用判断并过滤表情                 表情过滤start
		$smilewatch = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." WHERE fid='$_G[fid]'");
		if ($smilewatch['allowsmilies'] == 1) {
			//判断表情启用的类型（土土驴，默认表情等类型）
			$ava_typeid = DB::query('SELECT * FROM '.DB::table('forum_imagetype')." WHERE available=1"); //启用的表情的组编号typeid
			$arr = array();
			while ($ava = DB::fetch($ava_typeid)) {
				$arr[] = $ava['typeid'];
			}
			$typeids = implode(",", $arr); //转换为字符串
			$query = DB::query("SELECT code FROM ".DB::table('common_smiley')." WHERE typeid IN ($typeids)");
			while ($smile = DB::fetch($query)) {
				$message = str_replace($smile['code'], "", $message);
			}
		}
		//表情过滤end
		$message = cutstr(censor(trim(htmlspecialchars($message)), '***'), 200);
		$commentContent = array(
			'tid' => $_G['tid'],
			'pid' => $_G['gp_pid'],
			'author' => $_G['username'],
			'authorid' => $_G['uid'],
			'dateline' => $_G['timestamp'],
			'comment' => $message,
			'score' => $commentscore ? 1 : 0, //待议
			'forpid' => $pid,
			'replyid' => 0,
			'isshow' => $pinvisible == -2 ? 0 : 1);
		if (! empty($_G['gp_cid'])) {
			$commentContent['replyid'] = $_G['gp_cid'];
		}
		//点评添加的操作
		DB::insert('forum_postcomment', $commentContent);
		//添加点评之后将帖子回复表的comment字段赋值为1，代表该贴有评论,
		DB::update('forum_post', array('comment' => 1), "pid='".$_G['gp_pid']."'");
		//该行对积分进行更新操作，并通过Cookie通知界面弹出积分增减提示；
		updatepostcredits('+', $_G['uid'], 'reply', $_G['fid']);
	}
	//***************************** 评星级修改 *****************************
	$star_num = intval($_POST['starselect']);
	if ($star_num > 0 && $star_num <= 5) {
		require_once DISCUZ_ROOT."/source/plugin/forumoption/include.php";
		if (! $forumOption->isStared('forum', $_G['tid'], $_G['uid'])) {
			$starid = $forumOption->getStarid('forum', $_G['tid']);
			if ($starid) {
				$dateline = time();
				//$client_ip = $_SERVER["HTTP_CDN_SRC_IP"];
				//if($client_ip){
				//	$ip = $client_ip;
				//}else{
				$ip = $discuz->_get_client_ip();
				//}
				DB::query("INSERT INTO ".DB::table('dianping_star_logs')." (starid, starnum, dateline, uid, username, pid, ip) "."VALUE ($starid, $star_num, $dateline, {$_G['uid']}, '{$_G['username']}', $pid, '$ip')");
				$forumOption->calStarInfo($starid);
			}
		}
	}
	//***************************** 评星级修改 *****************************
	$cacheposition = getstatus($thread['status'], 1);
	if ($pid && $cacheposition) {
		savepostposition($_G['tid'], $pid);
	}
	require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';
	//添加评论，给装备加分操作
	if ($_G['fid'] == $_G['config']['fids']['zbfx'] && class_exists('ForumOptionProduce')) {
		//添加评论，给装备加分操作
		ForumOptionProduce::calPostRankEvent($_G['tid'], 10);
	}
	// 送获奖代码活动, 临时放置
	/*
	* if ($_G['tid'] == 1128508) {
	* $forumOption->initCodeMessage($_G['uid']);
	* }*/
	// 送获奖代码活动, 临时放置
	$nauthorid = 0;
	if (! empty($_G['gp_noticeauthor']) && ! $isanonymous && ! $modnewreplies) {
		list($ac, $nauthorid, $nauthor) = explode('|', $_G['gp_noticeauthor']);
		if ($nauthorid != $_G['uid']) {
			if ($ac == 'q') {
				notification_add($nauthorid, 'post', 'repquote_noticeauthor', array(
					'tid' => $thread['tid'],
					'subject' => $thread['subject'],
					'fid' => $_G['fid'],
					'pid' => $pid,
					));
			} elseif ($ac == 'r') {
				notification_add($nauthorid, 'post', 'reppost_noticeauthor', array(
					'tid' => $thread['tid'],
					'subject' => $thread['subject'],
					'fid' => $_G['fid'],
					'pid' => $pid,
					));
			}
		}
	}
	if ($thread['authorid'] != $_G['uid'] && getstatus($thread['status'], 6) && empty($_G['gp_noticeauthor']) && ! $isanonymous && ! $modnewreplies) {
		$posttable = getposttablebytid($_G['tid']);
		$thapost = DB::fetch_first("SELECT tid, author, authorid, useip, dateline, anonymous, status, message FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='1' AND invisible='0'");
		notification_add($thapost['authorid'], 'post', 'reppost_noticeauthor', array(
			'tid' => $thread['tid'],
			'subject' => $thread['subject'],
			'fid' => $_G['fid'],
			'pid' => $pid,
			'from_id' => $thread['tid'],
			'from_idtype' => 'post',
			));
	}
	if ($special == 5) {
		if (! DB::num_rows($standquery)) {
			if ($stand == 1) {
				DB::query("UPDATE ".DB::table('forum_debate')." SET affirmdebaters=affirmdebaters+1 WHERE tid='$_G[tid]'");
			} elseif ($stand == 2) {
				DB::query("UPDATE ".DB::table('forum_debate')." SET negadebaters=negadebaters+1 WHERE tid='$_G[tid]'");
			}
		} else {
			$stand = $firststand;
		}
		if ($stand == 1) {
			DB::query("UPDATE ".DB::table('forum_debate')." SET affirmreplies=affirmreplies+1 WHERE tid='$_G[tid]'");
		} elseif ($stand == 2) {
			DB::query("UPDATE ".DB::table('forum_debate')." SET negareplies=negareplies+1 WHERE tid='$_G[tid]'");
		}
		DB::query("INSERT INTO ".DB::table('forum_debatepost')." (tid, pid, uid, dateline, stand, voters, voterids) VALUES ('$_G[tid]', '$pid', '$_G[uid]', '$_G[timestamp]', '$stand', '0', '')");
	}
	($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) && ($_G['gp_attachnew'] || $_G['gp_attachdel'] || $special == 2 && $_G['gp_tradeaid']) && updateattach($postattachcredits, $_G['tid'], $pid, $new_img_edit, $_G['gp_attachdel']);
	$replymessage = 'post_reply_succeed';
	if ($special == 2 && $_G['group']['allowposttrade'] && $thread['authorid'] == $_G['uid'] && ! empty($_G['gp_trade']) && ! empty($_G['gp_item_name'])) {
		require_once libfile('function/trade');
		trade_create(array(
			'tid' => $_G['tid'],
			'pid' => $pid,
			'aid' => $_G['gp_tradeaid'],
			'item_expiration' => $_G['gp_item_expiration'],
			'thread' => $thread,
			'discuz_uid' => $_G['uid'],
			'author' => $author,
			'seller' => empty($_G['gp_paymethod']) && $_G['gp_seller'] ? dhtmlspecialchars(trim($_G['gp_seller'])) : '',
			'item_name' => $_G['gp_item_name'],
			'item_price' => $_G['gp_item_price'],
			'item_number' => $_G['gp_item_number'],
			'item_quality' => $_G['gp_item_quality'],
			'item_locus' => $_G['gp_item_locus'],
			'transport' => $_G['gp_transport'],
			'postage_mail' => $_G['gp_postage_mail'],
			'postage_express' => $_G['gp_postage_express'],
			'postage_ems' => $_G['gp_postage_ems'],
			'item_type' => $_G['gp_item_type'],
			'item_costprice' => $_G['gp_item_costprice'],
			'item_credit' => $_G['gp_item_credit'],
			'item_costcredit' => $_G['gp_item_costcredit']));
		$replymessage = 'trade_add_succeed';
		if (! empty($_G['gp_tradeaid'])) {
			DB::query("UPDATE ".DB::table('forum_attachment')." SET tid='$_G[tid]', pid='$pid' WHERE aid='$_G[gp_tradeaid]' AND uid='$_G[uid]'");
		}
	}
	if ($specialextra) {
		@include_once DISCUZ_ROOT.'./source/plugin/'.$_G['setting']['threadplugins'][$specialextra]['module'].'.class.php';
		$classname = 'threadplugin_'.$specialextra;
		if (class_exists($classname) && method_exists($threadpluginclass = new $classname, 'newreply_submit_end')) {
			$threadpluginclass->newreply_submit_end($_G['fid'], $_G['tid']);
		}
	}
	$_G['forum']['threadcaches'] && deletethreadcaches($_G['tid']);
	$param = array(
		'fid' => $_G['fid'],
		'tid' => $_G['tid'],
		'pid' => $pid,
		'from' => $_G['gp_from'],
		'sechash' => ! empty($_G['gp_sechash']) ? $_G['gp_sechash'] : '');
	include_once libfile('function/stat');
	updatestat($thread['isgroup'] ? 'grouppost' : 'post');
	if ($modnewreplies) {
		unset($param['pid']);
		DB::query("UPDATE ".DB::table('forum_forum')." SET todayposts=todayposts+1, modworks='1' WHERE fid='$_G[fid]'", 'UNBUFFERED');
		//start 记录修改版块操作
		addrecordforuminfo($_G['fid'], 3);
		//end
		showmessage('post_reply_mod_succeed', "forum.php?mod=forumdisplay&fid=$_G[fid]", $param);
	} else {
		DB::query("UPDATE ".DB::table('forum_thread')." SET lastposter='$author', lastpost='$_G[timestamp]', replies=replies+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
		updatepostcredits('+', $_G['uid'], 'reply', $_G['fid']);
		if ($_G['forum']['status'] == 3) {
			if ($_G['forum']['closed'] > 1) {
				DB::query("UPDATE ".DB::table('forum_thread')." SET lastposter='$author', lastpost='$_G[timestamp]', replies=replies+1 WHERE tid='".$_G['forum']['closed']."'", 'UNBUFFERED');
			}
			DB::query("UPDATE ".DB::table('forum_groupuser')." SET replies=replies+1, lastupdate='".TIMESTAMP."' WHERE uid='$_G[uid]' AND fid='$_G[fid]'");
			updateactivity($_G['fid'], 0);
			require_once libfile('function/grouplog');
			updategroupcreditlog($_G['fid'], $_G['uid']);
		}
		if ($thread['displayorder'] != -4) {
			$lastpost = "$thread[tid]\t".addslashes($thread['subject'])."\t$_G[timestamp]\t$author";
			DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED');
			if ($_G['forum']['type'] == 'sub') {
				DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid='".$_G['forum']['fup']."'", 'UNBUFFERED');
			}
			//start 记录修改版块操作
			addrecordforuminfo($_G['fid'], 3);
			//end
		}

		//清除个人中心回复列表的缓存
		$memKey    = "cache_ucenter_reply_list_{$_G['uid']}_1";
		memory('rm', $memKey);

		$page = getstatus($thread['status'], 4) ? 1 : @ceil(($thread['special'] ? $thread['replies'] + 1 : $thread['replies'] + 2) / $_G['ppp']);
		if ($special == 2 && ! empty($_G['gp_continueadd'])) {
			dheader("location: forum.php?mod=post&action=reply&fid={$_G[forum][fid]}&firstpid=$pid&tid={$thread[tid]}&addtrade=yes");
		} else {
			$jumpurl = "forum.php?mod=viewthread&tid={$thread[tid]}&pid=$pid&page=$page&extra=$extra#pid$pid";
			/*
			* if($_G['gp_way'] == 'commentreply'){
			* //$jumpurl = "forum.php?mod=redirect&goto=findpost&pid=".$_G['gp_pid']."&ptid={$thread[tid]}";
			* $jumpurl = "forum.php?mod=viewthread&tid={$thread[tid]}&pid=$pid&page=".$_G['page']."&extra=$extra#id".$_G['gp_cid']."";
			* }
			* if($_G['gp_way'] == 'reply' || $_G['gp_way'] == 'commentreply'){
			* $jumpurl = "forum.php?mod=viewthread&tid={$thread[tid]}&pid=$pid&page=".$_G['page']."&extra=$extra#pid_".$_G['gp_pid']."";
			* }
			*/
			if ($_G['gp_way'] == 'reply' || $_G['gp_way'] == 'commentreply') {
				$jumpurl = "forum.php?mod=viewthread&tid={$thread[tid]}&pid=$pid&page=".$_G['page']."&extra=$extra#pid_".$_G['gp_postid']."";
			}
			$url = empty($_POST['portal_referer']) ? $jumpurl : $_POST['portal_referer'];
		}

		//阅读版数据
		if ($thread['readmodel'] > 0) {
			$readmodelTable = '';
			$arrTable = array(
				'1'  => 'forum_travelread',
				'99' => 'forum_travelread',
				'2'  => 'forum_articleread',
				'98' => 'forum_articleread',
			);
			$readmodelTable = $arrTable[$thread['readmodel']] ? $arrTable[$thread['readmodel']] : '';
			if ($readmodelTable) {
				$travelShow = DB::fetch_first("SELECT apids, cpids, rpids, acnt, ccnt, rcnt  FROM ".DB::table($readmodelTable)." where tid = {$_G['tid']} " . getSlaveID());
				if (!empty($travelShow)) {
					include_once libfile('function/readmodelTravel');
					$travelShow['apids']   	= explode(',', $travelShow['apids']);
					$travelShow['cpids']   	= explode(',', $travelShow['cpids']);
					$travelShow['rpids']   	= explode(',', $travelShow['rpids']);
					$travelShow = createReadmodel($travelShow, $message, $pid, $_G['uid'], $thread['authorid']);
					$travelShow['apids']   	= implode(',', $travelShow['apids']);
					$travelShow['cpids']   	= implode(',', $travelShow['cpids']);
					$travelShow['rpids']   	= implode(',', $travelShow['rpids']);

					DB::update($readmodelTable, $travelShow, "tid={$_G['tid']}");
				}
			}
		}

		//游记阅读版的回复跳转
		if ($_G['gp_is_readmodel']) {
			showmessage('comment_add_succeed', dreferer(), array(), array());
		}

		//两类回复跳转所使用的楼层的id存在不同的变量里边，故分开处理
		if ($_G['gp_way'] == 'reply') {
			showmessage('comment_add_succeed', "forum.php?mod=viewthread&tid={$thread[tid]}&pid=".$_G['gp_pid']."&page=$_G[gp_page]&extra=$extra#pid_".$_G['gp_pid']."", array('tid' => "{$thread[tid]}", 'pid' => $_G['gp_pid']));
		} elseif ($_G['gp_way'] == 'commentreply') {
			showmessage('commentreply_add_succeed', "forum.php?mod=viewthread&tid={$thread[tid]}&pid=".$_G['gp_postid']."&page=$_G[gp_page]&extra=$extra#pid_".$_G['gp_postid']."", array('tid' => "{$thread[tid]}", 'pid' => $_G['gp_postid']));
		} elseif ($_G['gp_way'] == 'picturereply') {
			echo 1;
			exit;
		} else {
			showmessage($replymessage, $url, $param);
		}
	}
}
?>
