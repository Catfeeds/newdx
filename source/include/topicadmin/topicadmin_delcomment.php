<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: topicadmin_delcomment.php 16938 2010-09-17 04:37:59Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!$_G['group']['allowdelpost'] || empty($_G['gp_topiclist'])) {
	showmessage('undefined_action', NULL);
}

if(!submitcheck('modsubmit')) {

	$commentid = $_G['gp_topiclist'][0];
	$pid = DB::result_first("SELECT pid FROM ".DB::table('forum_postcomment')." WHERE id='$commentid'");
	if(!$pid) {
		showmessage('undefined_action', NULL);
	}
	$deleteid = '<input type="hidden" name="topiclist" value="'.$commentid.'" />';
	include template('forum/topicadmin_action');

} else {
	$reason = checkreasonpm();
	$modaction = 'DCM';

	$commentid = intval($_G['gp_topiclist']);
	$postcomment = DB::fetch_first("SELECT * FROM ".DB::table('forum_postcomment')." WHERE id='$commentid'");
	if(!$postcomment) {
		showmessage('undefined_action', NULL);
	}
	//新添加
	//点评是否有回复
	$replyCount = DB::result_first("SELECT count(*) FROM ".DB::table('forum_postcomment')." WHERE replyid='$postcomment[replyid]' " . getSlaveID());
	if($replyCount){
		//带有回复的点评 删除replyid = $postcomment['id'] 或者 $commentid  的所有点评以及点评所对应的楼层
		$query = DB::query('SELECT * FROM '.DB::table('forum_postcomment')." WHERE replyid='$commentid' " . getSlaveID());
		while($arr = DB::fetch($query)){
			$commentForum[] = $arr['forpid']; 
		}
		for($i=0;$i<count($commentForum);$i++){			
			DB::delete('forum_post',"pid='$commentForum[$i]'");	
		}
		DB::delete('forum_postcomment', "replyid='$commentid'");   //删除点评回复列表的操作
		DB::delete('forum_post', "pid='$postcomment[forpid]'");  //删除点评的楼层
		DB::delete('forum_postcomment', "id='$commentid'");  	//删除点评
	}else{
		DB::delete('forum_postcomment', "id='$commentid'");
		//删除帖子
		DB::delete('forum_post', "pid='$postcomment[forpid]'");
				
		//删除上方帖子下方的点评
		$forumCount = DB::fetch_first("SELECT count(*) FROM ".DB::table('forum_postcomment')." WHERE pid='$postcomment[forpid]' " . getSlaveID());
		if($forumCount){
			DB::delete('forum_postcomment', "pid='$postcomment[forpid]'");
		}
	}
	//更新主题的回复数
	$replies = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid='$_G[tid]' " . getSlaveID());
	DB::update('forum_thread', array('replies' => $replies-1), "tid='$_G[tid]'");
	//end	
	if(!DB::result_first("SELECT count(*) FROM ".DB::table('forum_postcomment')." WHERE pid='$postcomment[pid]' " . getSlaveID())) {
		DB::update('forum_post', array('comment' => 0), "pid='$postcomment[pid]'");
	}
	updatepostcredits('-', $postcomment['authorid'], 'reply', $_G['fid']);
	
	$query = DB::query('SELECT comment FROM '.DB::table('forum_postcomment')." WHERE pid='$postcomment[pid]' AND score='1'");
	$totalcomment = array();
	while($comment = DB::fetch($query)) {
		if(strexists($comment['comment'], '<br />')) {
			if(preg_match_all("/([^:]+?):\s<i>(\d+)<\/i>/", $comment['comment'], $a)) {
				foreach($a[1] as $k => $itemk) {
					$totalcomment[trim($itemk)][] = $a[2][$k];
				}
			}
		}
	}
	$totalv = '';
	foreach($totalcomment as $itemk => $itemv) {
		$totalv .= strip_tags(trim($itemk)).': <i>'.(sprintf('%1.1f', array_sum($itemv) / count($itemv))).'</i> ';
	}

	if($totalv) {
		DB::update('forum_postcomment', array('comment' => $totalv, 'dateline' => TIMESTAMP + 1), "pid='$postcomment[pid]' AND authorid='0'");
	} else {
		DB::delete('forum_postcomment', "pid='$postcomment[pid]' AND authorid='0'");
	}

	$resultarray = array(
	'redirect'	=> "forum.php?mod=viewthread&tid=$_G[tid]&page=$_REQUEST[page]",
	'reasonpm'	=> ($sendreasonpm ? array('data' => array($postcomment), 'var' => 'post', 'item' => 'reason_delete_comment') : array()),
	'reasonvar'	=> array('tid' => $thread['tid'], 'pid' => $postcomment['pid'], 'subject' => $thread['subject'], 'modaction' => $modaction, 'reason' => stripslashes($reason)),
	'modtids'	=> 0,
	'modlog'	=> $thread
	);

}

?>