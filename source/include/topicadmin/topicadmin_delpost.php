<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: topicadmin_delpost.php 17508 2010-10-20 06:10:25Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['group']['allowdelpost']) {
	showmessage('undefined_action', NULL);
}

$topiclist = $_G['gp_topiclist'];
$modpostsnum = count($topiclist);
if(!($deletepids = dimplode($topiclist))) {
	showmessage('admin_delpost_invalid');
} elseif(!$_G['group']['allowdelpost'] || !$_G['tid']) {
	showmessage('admin_nopermission', NULL);
}  else {
	$posttable = getposttablebytid($_G['tid']);
	$query = DB::query("SELECT pid FROM ".DB::table($posttable)." WHERE pid IN ($deletepids) AND first='1'");
	if(DB::num_rows($query)) {
		dheader("location: $_G[siteurl]forum.php?mod=topicadmin&action=moderate&operation=delete&optgroup=3&fid=$_G[fid]&moderate[]=$thread[tid]&inajax=yes".($_G['gp_infloat'] ? "&infloat=yes&handlekey={$_G['gp_handlekey']}" : ''));
	}
}

if(!submitcheck('modsubmit')) {

	$deleteid = '';
	foreach($topiclist as $id) {
		$deleteid .= '<input type="hidden" name="topiclist[]" value="'.$id.'" />';
	}
	
	include template('forum/topicadmin_action');

} else {

	$reason = checkreasonpm();
	
	$pids = $comma = '';
	$posts = $uidarray = $puidarray = $auidarray = array();
	$losslessdel = $_G['setting']['losslessdel'] > 0 ? TIMESTAMP - $_G['setting']['losslessdel'] * 86400 : 0;
	$query = DB::query("SELECT pid, authorid, dateline, message, first FROM ".DB::table($posttable)." WHERE pid IN ($deletepids) AND tid='$_G[tid]'");
	while($post = DB::fetch($query)) {
		if(!$post['first']) {
			$posts[] = $post;
			$pids .= $comma.$post['pid'];
			if($post['dateline'] < $losslessdel) {
				updatemembercount($post['authorid'], array('posts' => -1), false);
			} else {
				$puidarray[] = $post['authorid'];
			}
			$modpostsnum++;
			$comma = ',';
		}
	}
		
	if($puidarray) {
		updatepostcredits('-', $puidarray, 'reply', $_G['fid']);
	}
	if($pids) {
		$query = DB::query("SELECT uid, attachment, thumb, remote, aid, serverid FROM ".DB::table('forum_attachment')." WHERE pid IN ($pids)");
	}
	while($attach = DB::fetch($query)) {
		if(in_array($attach['uid'], $puidarray)) {
			$auidarray[$attach['uid']] = !empty($auidarray[$attach['uid']]) ? $auidarray[$attach['uid']] + 1 : 1;
		}
		dunlink($attach);
	}
	if($auidarray) {
		updateattachcredits('-', $auidarray, $postattachcredits);
	}

	$logs = array();
	if($pids) {
		$query = DB::query("SELECT r.extcredits, r.score, p.authorid, p.author FROM ".DB::table('forum_ratelog')." r LEFT JOIN ".DB::table($posttable)." p ON r.pid=p.pid WHERE r.pid IN ($pids)");
		while($author = DB::fetch($query)) {
			if($author['score'] > 0) {
				updatemembercount($author['authorid'], array($author['extcredits'] => -$author['score']));
				$author['score'] = $_G['setting']['extcredits'][$id]['title'].' '.-$author['score'].' '.$_G['setting']['extcredits'][$id]['unit'];
				$logs[] = dhtmlspecialchars("$_G[timestamp]\t{$_G[member][username]}\t$_G[adminid]\t$author[author]\t$author[extcredits]\t$author[score]\t$thread[tid]\t$thread[subject]\t$delpostsubmit");
			}
		}
	}
	if(!empty($logs)) {
		writelog('ratelog', $logs);
		unset($logs);
	}
	DB::delete('common_credit_log', "operation='PRC' AND relatedid IN ($pids)");
	DB::query("DELETE FROM ".DB::table('forum_ratelog')." WHERE pid IN ($pids)");
	DB::query("DELETE FROM ".DB::table('forum_attachment')." WHERE pid IN ($pids)");
	DB::query("DELETE FROM ".DB::table('forum_attachmentfield')." WHERE pid IN ($pids)");
	
	//新添加
	//一个函数递归来实现删除的操作，没想到怎么来写，先用着这个麻烦的
	//检测帖子是否为通过“点评/回复”所添加，如果是在postcomment表中查找forpid 体检为IN ($pids) ，有记录则是，就删除它
	DB::query("DELETE FROM ".DB::table('forum_postcomment')." WHERE forpid IN ($pids)");	
	$querycomment = DB::query("select * FROM ".DB::table('forum_postcomment')." WHERE pid IN ($pids)");
	if(mysql_num_rows($querycomment)){
		while($post = DB::fetch($querycomment)) {
			$forpids[] = $post['forpid']; 
			$ids[] = $post['id']; //主点评的id
		}
		$id = implode(",",$ids);
		$query = DB::query("select * FROM ".DB::table('forum_postcomment')." WHERE replyid IN ($id)");
		if(mysql_num_rows($query)){
			while($replypost = DB::fetch($query)) {
				$replyforpids[] = $replypost['forpid'];//点评回复所对应的楼层的帖子pid
			}	
			$replyforpid = implode(",",$replyforpids);
			DB::query("DELETE FROM ".DB::table('forum_post')." WHERE pid IN ($replyforpid)");
			DB::query("DELETE FROM ".DB::table('forum_postcomment')." WHERE replyid IN ($id)");
		}		
		DB::query("DELETE FROM ".DB::table('forum_postcomment')." WHERE id IN ($id)");
	
		$forpid = implode(",",$forpids);
		DB::query("DELETE FROM ".DB::table('forum_post')." WHERE pid IN ($forpid)");
		/*此处将帖子的删除信息，更新*/
		foreach($forpids as $dpid){
			$_tmparr = array(
				'tid' => $_G['tid'],
				'pid' => $dpid,
				'fid' => $_G['fid'],
				'username' => $_G['username'],);
			addrecordthreadstatus($_tmparr, 1);
		}		
	}		
	//删除店铺评分信息 by zhanghongliang at 20121120
	if($pids&&($_G['fid']==$_G['config']['fids']['skiing']||$_G['fid']==$_G['config']['fids']['dianpu']||$_G['fid']==$_G['config']['fids']['produce'])){
    	$qy = DB::query("select * FROM ".DB::table('dianping_star_logs')." WHERE pid IN ($pids)");
		while($val = DB::fetch($qy)) {	
			DB::query("delete from ".DB::table('dianping_star_logs')." WHERE pid='$val[pid]'");
			$forumOption->calStarInfo($val['starid']);
		}
	}
	//删除店铺评分信息end
	

	//更新主题的回复数
	$replies = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid='$_G[tid]' " . getSlaveID());
	DB::update('forum_thread', array('replies' => $replies-1), "tid='$_G[tid]'");
	//end
	DB::query("DELETE FROM ".DB::table('forum_postcomment')." WHERE pid IN ($pids)");
	DB::query("DELETE FROM ".DB::table($posttable)." WHERE pid IN ($pids)");
	getstatus($thread['status'], 1) && DB::query("DELETE FROM ".DB::table('forum_postposition')." WHERE pid IN ($pids)");	
	
	$thread['stickreply'] && DB::query("DELETE FROM ".DB::table('forum_poststick')." WHERE tid='$thread[tid]' AND pid IN ($pids)");
	//删除评论减分
	if($thread['first']!=1&&$thread['fid']==$_G['config']['fids']['zbfx']){
		ForumOptionProduce::calPostRankEvent($thread['tid'],11);
	}
	
	foreach(explode(',', $pids) as $pid) {		
		my_post_log('delete', array('pid' => $pid));
		$_tmparr = array(
			'tid' => $_G['tid'],
			'pid' => $pid,
			'fid' => $_G['fid'],
			'username' => $_G['username'],);
		addrecordthreadstatus($_tmparr, 1);		
	}

	if($thread['special']) {
		DB::query("DELETE FROM ".DB::table('forum_trade')." WHERE pid IN ($pids)");
	}

	updatethreadcount($_G['tid'], 1);
	updateforumcount($_G['fid']);
	addrecordforuminfo($_G['fid'], 3);
	$_G['forum']['threadcaches'] && deletethreadcaches($thread['tid']);

	$modaction = 'DLP';

	$resultarray = array(
	'redirect'	=> "forum.php?mod=viewthread&tid=$_G[tid]&page=$_REQUEST[page]",
	'reasonpm'	=> ($sendreasonpm ? array('data' => $posts, 'var' => 'post', 'item' => 'reason_delete_post') : array()),
	'reasonvar'	=> array('tid' => $thread['tid'], 'subject' => $thread['subject'], 'modaction' => $modaction, 'reason' => stripslashes($reason)),
	'modtids'	=> 0,
	'modlog'	=> $thread
	);

	procreportlog('', $pids, TRUE);

}

?>