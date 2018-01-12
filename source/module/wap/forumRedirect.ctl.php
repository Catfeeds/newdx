<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ForumRedirectCtl extends FrontendCtl{
	
	function __construct()
	{
		parent::__construct();
	}
	
	//找到回帖--参考module/forum/forum_redirect.php的gp_goto=findpost
	function findpost()
	{	
		global $_G;	
		
		loadcache('threadtableids');
		$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		if(!in_array(0, $threadtableids)) {
			$threadtableids = array_merge(array(0), $threadtableids);
		}
		$pid  = isset($_G['gp_pid']) ? intval($_G['gp_pid']) : 0;
		$ptid = isset($_G['gp_ptid']) ? intval($_G['gp_ptid']) : 0;
		$authoridurl  = isset($_G['gp_authorid']) ? '&authorid='.intval($_G['gp_authorid']) : '';
		$ordertypeurl = isset($_G['gp_ordertype']) ? '&ordertype='.intval($_G['gp_ordertype']) : '';
		if(!empty($ptid)) {
			$posttable = getposttablebytid($_G['tid']);
		} else {
			$posttable = 'forum_post';
		}		
		
		if(empty($_G['gp_goto']) && !empty($ptid)) {
			$postno = intval($_G['gp_postno']);
			$status = DB::result_first("SELECT status FROM ".DB::table('forum_thread')." WHERE tid='$ptid'" . getSlaveID());
			if(getstatus($post['status'], 3)) {
				$pid = DB::result_first("SELECT pid FROM ".DB::table('forum_postposition')." WHERE tid='$ptid' AND position='$postno'");
			} else {
				if($_G['gp_ordertype'] != 1) {
					$postno = $postno > 0 ? $postno - 1 : 0;
					$pid    = DB::result_first("SELECT pid FROM ".DB::table($posttable)." WHERE tid='$ptid' AND invisible='0' ORDER BY dateline LIMIT $postno, 1");
				} else {
					$postno = $postno > 1 ? $postno - 1 : 0;
					if($postno) {
						$pid = DB::result_first("SELECT pid FROM ".DB::table($posttable)." WHERE tid='$ptid' AND invisible='0' ORDER BY dateline LIMIT $postno, 1");
					} else {
						$pid = DB::result_first("SELECT pid FROM ".DB::table($posttable)." WHERE tid='$ptid' AND first='1' LIMIT 1");
					}
				}
			}
			$_G['gp_goto'] = 'findpost';
		}
		if($_G['gp_goto'] == 'findpost') {
			foreach($threadtableids as $tableid) {
				$threadtable = $tableid ? "forum_thread_$tableid" : 'forum_thread';
				$post = getallwithposts(array(
					'select' => 'p.tid, p.dateline, t.status, t.special, t.replies',
					'from' => DB::table('forum_post')." p LEFT JOIN ".DB::table($threadtable)." t USING(tid)",
					'where' => "p.pid='$pid'" . getSlaveID(),
				));
				if(!empty($post)) {
					$post = $post[0];
					break;
				}
			}
			if($post) {
				$ordertype = !isset($_GET['ordertype']) && getstatus($post['status'], 4) ? 1 : intval($ordertype);
				$sqladd = $post['special'] ? "AND first=0" : '';
				$curpostnum = DB::result_first("SELECT count(*) FROM ".DB::table($posttable)." WHERE tid='$post[tid]' AND dateline<='$post[dateline]' $sqladd " . getSlaveID());
				if($ordertype != 1) {
					$page = ceil($curpostnum / $_G['ppp']);
				} else {
					if($curpostnum > 1) {
						$page = ceil(($post['replies'] - $curpostnum + 3) / $_G['ppp']);
					} else {
						$page = 1;
					}
				}
				if(!empty($special) && $special == 'trade') {
					//稍后用时处理
					dheader("Location: forum.php?mod=viewthread&do=tradeinfo&tid=$post[tid]&pid=$pid$authoridurl$ordertypeurl");
				} else {
					encodeData(array("url"=>$_G['config']['web']['mobile']."index.php?d=forum&c=thread&m=show&tid={$post['tid']}&page=$page$authoridurl$ordertypeurl".(isset($_G['gp_modthreadkey']) && ($modthreadkey = modauthkey($post['tid'])) ? "&modthreadkey=$modthreadkey": '')."&nocache=1#pid$pid"));
				}
			} else {
				if($ptid) {
					encodeData(array("url"=>$_G['config']['web']['mobile']."index.php?d=forum&c=thread&m=show&tid=$ptid$authoridurl$ordertypeurl"));
				}
				encodeData(array('error'=>true , 'errorinfo'=>"指定的帖子不存在或已被删除或正在被审核。")); 
			}
		}	
	}
	
}
?>