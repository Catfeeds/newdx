<?php
/**
 * 问答控制器基类
 */
class QuestionCtl extends FrontendCtl
{
	var $_ctl = 'question';
	function __construct()
	{
		parent::__construct();
        if($_GET['fromm8264xuexiao']=='1'){
            dsetcookie('fromm8264xuexiao', 1, 1800, 1, true);
        }
	}
	function _run_action()
	{
		parent::_run_action();
	}
	function _config_view()
	{
		parent::_config_view();
	}
	/**
	 * 读取当前帖子的图片
	 */
	function _getimgbytidpid($tid, $pid, $type = 'forum', $unused = false, $limit = 5)
	{
		global $_G;
		$_num = 0;
		require_once DISCUZ_ROOT . './source/plugin/attachment_server/attachment_server.class.php';
		$attachserver = new attachserver;
		$attachlist = $attachserver->get_server_domain( 'all', '*' );
		if ($tid > 0) {
			$pids = $pid > 0 ? "AND pid = {$pid}" : '';
			$q = DB::query("SELECT * FROM " . DB::table('forum_attachment') . " WHERE isimage = 1 AND tid = {$tid} {$pids} AND dir = '{$type}' ORDER BY dateline asc");
			while ($v = DB::fetch($q)) {
				$v['url'] = 'http://' . $attachlist[$v['serverid']]['name'] . '/' . $type . '/';
				if ( is_array( $attachlist[$v['serverid']]['api'] ) ) {
					if( $attachlist[$v['serverid']]['api']['class'] && is_object( $attachlist[$v['serverid']]['api']['class'] ) ) {
						$_callback = array( $attachlist[$v['serverid']]['api']['class'], $attachlist[$v['serverid']]['api']['function'] );
					}else{
						$_callback = $attachlist[$v['serverid']]['api']['function'];
					}
					$v['attachment'] .= call_user_func_array( $_callback, array( 'forum', true, true, true ));
				}
				$_num++;
				$return[] = $v;
			}
		}
		$_need = $limit - $_num;
		if ($unused && $_need > 0) {
			$q = DB::query("SELECT * FROM " . DB::table('forum_attachment') . " WHERE tid = 0 AND pid = 0 AND uid = {$_G[uid]} AND isimage = 1 AND dir = '{$type}' ORDER BY dateline asc limit {$_need}");
			while ($v = DB::fetch($q)) {
				$v['url'] = 'http://' . $attachlist[$v['serverid']]['name'] . '/' . $type . '/';
				if ( is_array( $attachlist[$v['serverid']]['api'] ) ) {
					if( $attachlist[$v['serverid']]['api']['class'] && is_object( $attachlist[$v['serverid']]['api']['class'] ) ) {
						$_callback = array( $attachlist[$v['serverid']]['api']['class'], $attachlist[$v['serverid']]['api']['function'] );
					}else{
						$_callback = $attachlist[$v['serverid']]['api']['function'];
					}
					$v['attachment'] .= call_user_func_array( $_callback, array( 'forum', true, true, true ));
				}
				$return[] = $v;
			}
		}
		return $return ? $return : array();
	}
	/**
	 * 显示消息的方法
	 */
	function showmessage($message, $url_forward = '', $values = array(), $extraparam = array(), $custom = 0)
	{
		showmessage($message, $url_forward, $values, $extraparam, $custom);
	}
	/**
	 * @author JiangHong
	 * 论坛的管理操作
	 */
	function _getModeratorResult()
	{
		global $_G;
		$_G['inajax'] = 1;
		$data['ctlname'] = $this->_ctl;
		$_G['gp_topiclist'] = ! empty($_G['gp_topiclist']) ? (is_array($_G['gp_topiclist']) ? array_unique($_G['gp_topiclist']) : $_G['gp_topiclist']) : array();
		loadcache(array(
			'modreasons',
			'stamptypeid',
			'threadtableids'));
		$data['modpostsnum'] = 0;
		$data['resultarray'] = $data['thread'] = array();
		$data['threadtableids'] = ! empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		if (! $_G['uid'] || ! $_G['forum']['ismoderator']) {
			$this->showmessage('admin_nopermission', null);
		}
		$data['frommodcp'] = ! empty($_G['gp_frommodcp']) ? intval($_G['gp_frommodcp']) : 0;
		$data['navigation'] = $data['navtitle'] = '';
		if (! empty($_G['tid'])) {
			$_G['gp_archiveid'] = intval($_G['gp_archiveid']);
			if (! empty($_G['gp_archiveid']) && in_array($_G['gp_archiveid'], $data['threadtableids'])) {
				$data['threadtable'] = "forum_thread_{$_G['gp_archiveid']}";
			} else {
				$data['threadtable'] = 'forum_thread';
			}
			$data['thread'] = DB::fetch_first("SELECT * FROM " . DB::table($data['threadtable']) . " WHERE tid='$_G[tid]' AND fid='$_G[fid]' AND displayorder>='0'");
			if (! $data['thread']) {
				$this->showmessage('thread_nonexistence');
			}
			$data['navigation'] .= " &raquo; <a href=\"forum.php?mod=viewthread&tid=$_G[tid]\">{$data[thread]}[subject]</a> ";
			$data['navtitle'] .= ' - ' . $data['thread']['subject'] . ' - ';
			if ($data['thread']['special'] && in_array($_G['gp_action'], array(
				'copy',
				'split',
				'merge'))) {
				$this->showmessage('special_noaction');
			}
		}
		if (($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) || ! empty($_G['gp_sendreasonpm'])) {
			$data['forumname'] = strip_tags($_G['forum']['name']);
			$data['sendreasonpm'] = 1;
		} else {
			$data['sendreasonpm'] = 0;
		}
		$data['postcredits'] = $_G['forum']['postcredits'] ? $_G['forum']['postcredits'] : $_G['setting']['creditspolicy']['post'];
		$data['replycredits'] = $_G['forum']['replycredits'] ? $_G['forum']['replycredits'] : $_G['setting']['creditspolicy']['reply'];
		$data['digestcredits'] = $_G['forum']['digestcredits'] ? $_G['forum']['digestcredits'] : $_G['setting']['creditspolicy']['digest'];
		$data['postattachcredits'] = $_G['forum']['postattachcredits'] ? $_G['forum']['postattachcredits'] : $_G['setting']['creditspolicy']['postattach'];
		$_G['gp_handlekey'] = 'mods';
		$_methodname = '_moderator_' . $_G['gp_action'];
		if (preg_match('/^\w+$/', $_G['gp_action']) && method_exists($this, $_methodname)) {
			return call_user_func_array(array($this, $_methodname), array($data));
		} else {
			$this->showmessage('undefined_action', null);
		}
	}
	/**
	 *  管理操作 - 删除回复
	 */
	function _moderator_delpost($data)
	{
		global $_G;
		require_once libfile('function/post');
		require_once libfile('function/misc');
		if (! $_G['group']['allowdelpost']) {
			$this->showmessage('undefined_action', null);
		}
		$data['topiclist'] = $_G['gp_topiclist'];
		$data['modpostsnum'] = count($data['topiclist']);
		if (! ($data['deletepids'] = dimplode($data['topiclist']))) {
			$this->showmessage('admin_delpost_invalid');
		} elseif (! $_G['group']['allowdelpost'] || ! $_G['tid']) {
			$this->showmessage('admin_nopermission', null);
		} else {
			$data['posttable'] = getposttablebytid($_G['tid']);
			$query = DB::query("SELECT pid FROM " . DB::table($data['posttable']) . " WHERE pid IN ({$data[deletepids]}) AND first='1'");
			if (DB::num_rows($query)) {
				dheader("location: $_G[siteurl]forum.php?mod=topicadmin&action=moderate&operation=delete&optgroup=3&fid=$_G[fid]&moderate[]={$data[thread][tid]}&inajax=yes" . ($_G['gp_infloat'] ? "&infloat=yes&handlekey={$_G['gp_handlekey']}" : ''));
			}
		}
		if (! submitcheck('modsubmit')) {
			$data['deleteid'] = '';
			foreach ($data['topiclist'] as $id) {
				$data['deleteid'] .= '<input type="hidden" name="topiclist[]" value="' . $id . '" />';
			}
			$this->assign($data);
			$this->display('forum/moderator/topicadmin_action');
		} else {
			$reason = checkreasonpm();
			$pids = $comma = '';
			$posts = $uidarray = $puidarray = $auidarray = array();
			$losslessdel = $_G['setting']['losslessdel'] > 0 ? TIMESTAMP - $_G['setting']['losslessdel'] * 86400 : 0;
			$query = DB::query("SELECT pid, authorid, dateline, message, first FROM " . DB::table($data['posttable']) . " WHERE pid IN ({$data['deletepids']}) AND tid='$_G[tid]'");
			while ($post = DB::fetch($query)) {
				if (! $post['first']) {
					$posts[] = $post;
					$pids .= $comma . $post['pid'];
					if ($post['dateline'] < $losslessdel) {
						updatemembercount($post['authorid'], array('posts' => -1), false);
					} else {
						$puidarray[] = $post['authorid'];
					}
					$data['modpostsnum']++;
					$comma = ',';
				}
			}
			if ($puidarray) {
				updatepostcredits('-', $puidarray, 'reply', $_G['fid']);
			}
			if ($pids) {
				$query = DB::query("SELECT uid, attachment, thumb, remote, aid, serverid FROM " . DB::table('forum_attachment') . " WHERE pid IN ($pids)");
			}
			while ($attach = DB::fetch($query)) {
				if (in_array($attach['uid'], $puidarray)) {
					$auidarray[$attach['uid']] = ! empty($auidarray[$attach['uid']]) ? $auidarray[$attach['uid']] + 1 : 1;
				}
				dunlink($attach);
			}
			if ($auidarray) {
				updateattachcredits('-', $auidarray, $data['postattachcredits']);
			}
			$logs = array();
			if ($pids) {
				$query = DB::query("SELECT r.extcredits, r.score, p.authorid, p.author FROM " . DB::table('forum_ratelog') . " r LEFT JOIN " . DB::table($data['posttable']) . " p ON r.pid=p.pid WHERE r.pid IN ($pids)");
				while ($author = DB::fetch($query)) {
					if ($author['score'] > 0) {
						updatemembercount($author['authorid'], array($author['extcredits'] => -$author['score']));
						$author['score'] = $_G['setting']['extcredits'][$id]['title'] . ' ' . -$author['score'] . ' ' . $_G['setting']['extcredits'][$id]['unit'];
						$logs[] = dhtmlspecialchars("$_G[timestamp]\t{$_G[member][username]}\t$_G[adminid]\t$author[author]\t$author[extcredits]\t$author[score]\t{$data[thread][tid]}\t{$data[thread][subject]}\t$delpostsubmit");
					}
				}
			}
			if (! empty($logs)) {
				writelog('ratelog', $logs);
				unset($logs);
			}
			if($pids){
				DB::delete('common_credit_log', "operation='PRC' AND relatedid IN ($pids)");
				DB::query("DELETE FROM " . DB::table('forum_ratelog') . " WHERE pid IN ($pids)");
				DB::query("DELETE FROM " . DB::table('forum_attachment') . " WHERE pid IN ($pids)");
				DB::query("DELETE FROM " . DB::table('forum_attachmentfield') . " WHERE pid IN ($pids)");
				//查询这个帖子是否有对他的评论贴，需要删除这个帖子对应的评论贴和对应评论贴的评论，此处循环查询到没有评论贴位置
				$tmp_pid_arr = explode(',', $pids);
				while (! empty($tmp_pid_arr)) {
					$tmp_pid = implode(',', $tmp_pid_arr);
					$tmp_pid_arr = array();
					$q = DB::query("SELECT * FROM " . DB::table('forum_postcomment') . " WHERE pid IN ($tmp_pid)");
					while ($v = DB::fetch($q)) {
						$tmp_pid_arr[] = $v['forpid'];
					}
					if (! empty($tmp_pid_arr)) {
						$pids .= ',' . implode(',', $tmp_pid_arr);
					}
				}
				//exit('删除帖子pid为:'.$pids);
				//如果这个帖子是对别的帖子的点评回复，删除这个帖子的评论信息
				DB::delete('forum_postcomment', "forpid IN ($pids)");
				//更新主题的回复数
				$pids_arr = explode(',', $pids);
				$replies = DB::result_first("SELECT count(*) FROM " . DB::table('forum_post') . " WHERE tid='$_G[tid]' " . getSlaveID());
				DB::update('forum_thread', array('replies' => $replies - count($pids_arr)), "tid='$_G[tid]'");
				//end
				DB::delete($data['posttable'], "pid IN ($pids)");
				getstatus($data['thread']['status'], 1) && DB::query("DELETE FROM " . DB::table('forum_postposition') . " WHERE pid IN ($pids)");
				$data['thread']['stickreply'] && DB::query("DELETE FROM " . DB::table('forum_poststick') . " WHERE tid='{$data['thread'][tid]}' AND pid IN ($pids)");
				foreach (explode(',', $pids) as $pid) {
					my_post_log('delete', array('pid' => $pid));
				}
				if ($data['thread']['special']) {
					DB::query("DELETE FROM " . DB::table('forum_trade') . " WHERE pid IN ($pids)");
				}
			}
			updatethreadcount($_G['tid'], 1);
			updateforumcount($_G['fid']);
			$_G['forum']['threadcaches'] && deletethreadcaches($data['thread']['tid']);
			$modaction = 'DLP';
			$resultarray = array(
				'action' => 'delpost',
				'pids' => $pids_arr,
				'redirect' => "forum.php?mod=viewthread&tid=$_G[tid]&page=$_REQUEST[page]",
				'reasonpm' => ($data['sendreasonpm'] ? array(
					'data' => $posts,
					'var' => 'post',
					'item' => 'reason_delete_post') : array()),
				'reasonvar' => array(
					'tid' => $data['thread']['tid'],
					'subject' => $data['thread']['subject'],
					'modaction' => $modaction,
					'reason' => stripslashes($reason)),
				'modtids' => 0,
				'modlog' => $data['thread']);
			procreportlog('', $pids, true);
			return $resultarray;
		}
	}
	/**
	 * 管理操作 - 置顶回复
	 */
	function _moderator_stickreply($data)
	{
		global $_G;
		if (! $_G['group']['allowstickreply']) {
			$this->showmessage('undefined_action', null);
		}
		$data['topiclist'] = $_G['gp_topiclist'];
		if (empty($data['topiclist'])) {
			$this->showmessage('admin_stickreply_invalid');
		} elseif (! $_G['tid']) {
			$this->showmessage('admin_nopermission', null);
		}
		require_once libfile('function/post');
		require_once libfile('function/misc');
		$posttable = getposttablebytid($_G['tid']);
		$sticktopiclist = $posts = array();
		foreach ($data['topiclist'] as $pid) {
			$post = DB::fetch_first("SELECT p.tid, p.authorid, p.dateline, p.first, t.special FROM " . DB::table($posttable) . " p
				LEFT JOIN " . DB::table('forum_thread') . " t USING(tid) WHERE p.pid='$pid' " . getSlaveID());
			$posts[]['authorid'] = $post['authorid'];
			$sqladd = $post['special'] ? "AND first=0" : '';
			$posttable = getposttablebytid($post['tid']);
			$curpostnum = DB::result_first("SELECT COUNT(*) FROM " . DB::table($posttable) . " WHERE tid='$post[tid]' AND dateline<='$post[dateline]' $sqladd ". getSlaveID());
			if (empty($post['first'])) {
				$sticktopiclist[$pid] = $curpostnum;
			}
		}
		if (! submitcheck('modsubmit')) {
			$data['stickpid'] = '';
			foreach ($sticktopiclist as $id => $postnum) {
				$data['stickpid'] .= '<input type="hidden" name="topiclist[]" value="' . $id . '" />';
			}
			$this->assign($data);
			$this->display('forum/moderator/topicadmin_action');
		} else {
			$dianping = m('dianping');
			if ($_G['gp_stickreply']) {
				foreach ($sticktopiclist as $pid => $postnum) {
					DB::query("REPLACE INTO " . DB::table('forum_poststick') . " SET tid='$_G[tid]', pid='$pid', position='$postnum', dateline='$_G[timestamp]'");
					$_pids[] = $pid;
				}
				$_stick = 1;
			} else {
				foreach ($sticktopiclist as $pid => $postnum) {
					DB::delete('forum_poststick', "tid='$_G[tid]' AND pid='$pid'");
					$_pids[] = $pid;
				}
				$_stick = 0;
			}
			$_pids = implode(',', $_pids);
			$dianping->edit("pid IN ({$_pids})",'stickreply = ' . $_stick);
			$sticknum = DB::result_first("SELECT COUNT(*) FROM " . DB::table('forum_poststick') . " WHERE tid='$_G[tid]'");
			$stickreply = intval($_G['gp_stickreply']);
			if ($sticknum == 0 || $stickreply == 1) {
				DB::query("UPDATE " . DB::table('forum_thread') . " SET moderated='1', stickreply='$stickreply' WHERE tid='$_G[tid]'");
			}
			$modaction = $_G['gp_stickreply'] ? 'SRE' : 'USR';
			$reason = checkreasonpm();
			$resultarray = array(
				'action' => 'stickreply',
				'pids' => $pid,
				'redirect' => "forum.php?mod=viewthread&tid=$_G[tid]&page=$page",
				'reasonpm' => ($data['sendreasonpm'] ? array(
					'data' => $posts,
					'var' => 'post',
					'item' => $_G['gp_stickreply'] ? 'reason_stickreply' : 'reason_stickdeletereply') : array()),
				'reasonvar' => array(
					'tid' => $data['thread']['tid'],
					'subject' => $data['thread']['subject'],
					'modaction' => $modaction,
					'reason' => stripslashes($reason)),
				'modlog' => $data['thread']);
			return $resultarray;
		}
	}
	/**
	 * @author JiangHong
	 * 论坛的管理操作
	 */
	function moderator()
	{
		$resultarray = $this->_getModeratorResult();
		$this->showmessage((isset($resultarray['message']) ? $resultarray['message'] : 'admin_succeed'), $resultarray['redirect']);
	}



}

?>
