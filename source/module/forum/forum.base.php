<?php
/**
 * 论坛控制器基类
 *
 * @author rinne 130826
 * @usage none
 */
class ForumCtl extends FrontendCtl
{
	var $_ctl = 'forum';
	function __construct()
	{
		parent::__construct();
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
/**
 * 点评系统基类
 *
 * @author rinne 130826
 */
class DianpingCtl extends ForumCtl
{
	var $modname = '';
	var $mod;
	var $method_array = array(
		'new',
		'edit',
		'reply');
	/**
	 * 对模块状态判定
	 * @author JiangHong
	 */
	function __construct()
	{
		global $_G;
		parent::__construct();
		$this->_ctl = $this->modname;
		if (empty($this->modname))
			$this->showmessage('undefined_action', $_G['config']['web']['portal']);
		$this->mod = m($this->modname);
		if ($this->mod->_moduleinfo['status'] != 1) {
			$this->showmessage('model_close', $_G['config']['web']['portal']);
		}
		if (empty($this->mod->_fid)) {
			$this->showmessage('forum_nonexistence');
		}
		/*判断是否有密码*/
		if ($_G['forum']['password'] && $_G['forum']['password'] != $_G['cookie']['fidpw' . $this->mod->_fid]) {
			$this->showmessage('forum_passwd');
		}
		/*判断版块的浏览权限*/
		if (empty($_G['forum']['allowview'])) {
			if (! $_G['forum']['viewperm'] && ! $_G['group']['readaccess']) {
				$this->showmessage('group_nopermission', null, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
			} elseif ($_G['forum']['viewperm'] && ! forumperm($_G['forum']['viewperm'])) {
				showmessagenoperm('viewperm', $this->mod->_fid);
			}
		} elseif ($_G['forum']['allowview'] == -1) {
			$this->showmessage('forum_access_view_disallow');
		}
	}
	/**
	 * 将默认页转向列表页
	 * @author JiangHong
	 */
	function index()
	{
		$this->showlist();
	}
	function _getGlobalArgs($type = 'list')
	{
		global $_G;
		$data = array();
		if($this->mod->getChildStatus('pro')){
			$regions_count = 0;
			$regions = $this->mod->getRegions(0, 2, true, true);
			$data['city'] = '中国';
			if (is_array($regions)) {
				foreach ($regions as $v) {
					$regions_count += $v['count'];
					if (intval($_G['gp_pro']) == $v['pro']) {
						$data['city'] = $v['name'];
					}
				}
			}
			$data['regions'] = $regions;
			$data['shorttitle'] = $data['city'];
			$data['regions_count'] = $regions_count;
		}
		$data = array_merge($data, $this->mod->getNavTitle($type, array('area' => $data['city'])));
		$data['modstr'] = $this->modname;
		$data['modname'] = $this->mod->_moduleinfo['mname'];
		$data['modsetting'] = $this->mod->_setting;
		$data['fid'] = $this->mod->_fid;
		$dianpingmodules = m('dianpingmodules');
		$data['dianpingmodules'] = $dianpingmodules->findAll(array('conditions' => 'status = 1', 'fields' => 'mname AS name, srcid AS src', 'order' => 'displayorder asc'));
		return $data;
	}
	/**
	 * 显示列表页
	 * @author JiangHong
	 */
	function showlist()
	{
		global $_G;
		$data = $this->_getGlobalArgs('list');
		$perpage = max($this->mod->limit, 1);
		$page = max(intval($_G['gp_page']), 1);
		$start = ($page - 1) * $perpage;
		$data['url'] = $data['sorturl'] = $data['myurl'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		// 处理分页样式 lxp 20130922
		$pagestr = $htmlstate == 1 ? 'page-' : 'page=';
		$order = isset($_G['gp_order']) ? $_G['gp_order'] : 'lastpost';
		$data['url'] .= "&order={$order}&page={$page}";
		$data['order'] = $order;
		if (! empty($_G['gp_pro'])) {
			$pro = $_G['gp_pro'];
			$condition['pro'] = "={$pro}";
			$maxcondition = "{$this->mod->alias}.{$this->mod->_vars[pro]} = {$pro}";
		}else{
			$pro = 0;
		}
		$data['pro'] = $pro;

		if (! empty($_G['gp_key'])) {
			$condition['name'] = "LIKE '%" . $_G['gp_key'] . "%'";
			$maxcondition = "{$this->mod->alias}.{$this->mod->_vars[name]} LIKE '%{$_G[gp_key]}%'";
			$data['findkey'] = urldecode($_G['gp_key']);
			$findkey = urlencode($_G['gp_key']);
			$data['url'] .= "&key=" . $findkey;
		}
		$max = $this->mod->getMaxCount($maxcondition);
		$realpages = @ceil($max / $perpage);
		if ($page > 1) {
			$data['prev'] = $data['myurl'] . '&act=showlist&order=' . $order . '&' . $pagestr . ($page - 1);
			$data['prev'] .= "&pro={$pro}";
		}
		if ($page < $realpages) {
			$data['next'] = $data['myurl'] . '&act=showlist&order=' .$order . '&' . $pagestr . ($page + 1);
			$data['next'] .= "&pro={$pro}";
		}
		$data['url'] .= "&pro={$pro}";
		$data['sorturl'] .= "&pro={$pro}";
		$desc = $_G['gp_desc'] === 0 ? 'ASC' : 'DESC';
		if (! empty($_G['gp_order'])) {
			if($_G['gp_order'] == 'score'){
				$orders = array('score' => $desc);
			}elseif($_G['gp_order'] == 'heats'){
				$orders = array('orderby' => 'DESC', 'heats' => $desc);
			}else {
				$orders = array('lastpost' => 'DESC');
			}
		} else {
			$orders = array('lastpost' => 'DESC');
		}
		$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';
		if (! empty($condition)) {
			foreach ($condition as $_k => $_v) {
				$_k = array_key_exists($_k, $this->mod->_vars) ? $this->mod->alias . '.' . $this->mod->_vars[$_k] : 't.' . $_k;
				$where .= "AND {$_k} {$_v} ";
			}
		}
		$data['list'] = $this->mod->getlist(array(
			'start' => $start,
			'order' => $orders,
			'where' => $where
		));
		// $data = array_merge($data, $this->mod->getNavTitle('list'));
		$data = array_merge($data, $this->mod->getPlugin('list', $_GET));
		// 推荐的点评列表 lxp 20130924
		$mod_dianping = m('dianping');
		$data['reply'] = $mod_dianping->find(array(
			'fields' => 'starid, starnum, uid, username, goodpoint, weakpoint, f_p.pid, tid, f_p.message',
			'conditions' => "showorder>0 AND fid={$this->mod->_fid}",
			'order' => 'showorder DESC',
			'join' => 'has_post',
			'index_key' => 'pid'
		));
		if (is_array($data['reply'])) {
			$mod_forum_thread = m('forum_thread');
			foreach ($data['reply'] as $k => $v) {
				if($v['tid']){
					$data['reply'][$k] = array_merge($v, $mod_forum_thread->get(array('fields' => 'subject', 'conditions' => "tid={$v['tid']}")));
					$data['reply'][$k]['goodpoints'] = $this->_set_br($v['goodpoints']);
					$data['reply'][$k]['weakpoints'] = $this->_set_br($v['weakpoints']);
					$data['reply'][$k]['message'] = $this->_set_br($v['message']);
				}
			}
		}
		$this->assign($data);
		$this->display($this->mod->template['list']);
	}
	/**
	 * 显示详细页
	 * @author JiangHong
	 */
	function showview()
	{
		global $_G;
		if ($_G['gp_tid'] <= 0) {
			$this->showlist();
		} else {
			$data = $this->_getGlobalArgs('view');
			$tid = trim($_GET['tid']);
			$data['viewdata'] = $this->mod->getview($tid);
			if (empty($data['viewdata']))
				$this->showmessage('thread_nonexistence');
			$data['viewdata']['message'] = $this->_set_br($data['viewdata']['message']); // 处理textarea换行

			$data['pageTitle'] = str_replace('[subject]', $data['viewdata']['name'], $data['pageTitle']);
			$data['metakeywords'] = str_replace('[subject]', $data['viewdata']['name'], $data['metakeywords']);
			$data['metadescription'] = str_replace('[subject]', $data['viewdata']['name'], $data['metadescription']);
			$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);
			if (empty($data['piclist'])) {
				$data['piclist'][0]['attachment'] = $data['viewdata']['attachment'];
				$data['piclist'][0]['dir'] = 'plugin';
				$data['piclist'][0]['url'] = $_G['config']['web']['attach'] . 'plugin/';
			}
			$data['regions'] = $this->mod->getRegions(0, 2, true, true);
			$data['mapon'] = in_array('map', $this->mod->_modulesopen);
			// $data['modstr'] = $this->modname;
			// $data['modname'] = $this->mod->_moduleinfo['mname'];
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			// 当前用户回复
			$mod_forum_post = m('forum_post');
			$data['my_comment'] = array();
			$data['my_comment'] = $mod_forum_post->get(array('conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}", 'join' => 'has_star'));
			if ($data['my_comment']) {
				$data['my_comment']['goodpoint'] = $this->_set_br($data['my_comment']['goodpoint']);
				$data['my_comment']['weakpoint'] = $this->_set_br($data['my_comment']['weakpoint']);
				$data['my_comment']['message'] = $this->_set_br($data['my_comment']['message']);
				$data['my_comment']['rate'] =($data['my_comment']['rate']);
				$data['my_comment']['dateline'] = $this->mod->_timeHandle($data['my_comment']['dateline']);
				$data['my_comment']['extdata'] = unserialize($data['my_comment']['extdata']);
			}
			$dianping = m('dianping');
// 			$data['scores'] = $dianping->getAllRate($tid);
			$data['myrate'] = max(intval($dianping->getMyRate($_G['uid'], $tid)), 0);
			$dianpingshow = m('dianpingshow');
			$data['star_data'] = $dianpingshow->getData($tid);
			/*增加初始时获得第一页的评论列表*/
			$page = max(1, $_G['gp_page']);
			$data['page'] = $page;
			$perpage =  max($this->mod->commentlimit, 1);
			$start = ($page - 1) * $perpage;
			$replyList = $mod_forum_post->find(array(
				'fields' => "f_p.fid,f_p.tid,f_p.first,f_p.author,f_p.authorid,f_p.dateline,f_p.message,f_p.rate,sl.starid,sl.starnum,sl.pid,sl.uid,sl.username,sl.goodpoint,sl.weakpoint,sl.ext1,sl.ext2,sl.ext3,sl.ext4,sl.enable,sl.supports",
				'conditions' => "f_p.tid={$tid} AND f_p.first=0",
				'order' => 'sl.stickreply DESC, f_p.dateline DESC',
				'limit' => "{$start}, {$this->mod->commentlimit}",
				'join' => 'has_star'
			));

			if (is_array($replyList)) {
				foreach ($replyList as $k => $v) {
					if($v['authorid'] == $_G['uid']){unset($replyList[$k]);continue;}
					$replyList[$k]['goodpoint'] = $this->_set_br($v['goodpoint']);
					$replyList[$k]['weakpoint'] = $this->_set_br($v['weakpoint']);
					$replyList[$k]['message'] = $this->_set_br($v['message']);
					$replyList[$k]['dateline'] = $this->mod->_timeHandle($v['dateline']);
					$replyList[$k]['extdata'] = unserialize($replyList[$k]['extdata']);
				}
			}
			$multipage = multi($data['viewdata']['replies'], $perpage, $page, $data['url'] . "&act=showview&tid={$tid}");
			if ($_G['uid']) {
				$mod_dianping_support = m('dianpingsupport');
				$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			}
			$data['replylist'] = $replyList;
			$data['replymulti'] = $multipage;
			$data['supportlist'] = $supportlist;
			/*结束*/

			$data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));
			$data['citychange'] = 1;
			$this->assign($data);
			$this->display($this->mod->template['view']);
		}
	}
	/**
	 * ajax 点评列表
	 *
	 * @author lxp 20131010
	 */
	function ajaxreply()
	{
		global $_G;
		$tid = $_G['gp_tid'];
		if (! $tid) {
			die();
		}
		$url = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$page = max(intval($_G['gp_page']), 1);
		$perpage = max($this->mod->commentlimit, 1);
		$start = ($page - 1) * $perpage;
		$mod_forum_post = m('forum_post');
		$replyList = $mod_forum_post->find(array(
			'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate, sl.starid, sl.starnum, sl.goodpoint, sl.weakpoint, sl.extdata, sl.supports',
			'conditions' => "f_p.tid={$tid} AND f_p.first=0",
			'order'      => 'sl.stickreply DESC, f_p.dateline DESC',
			'limit'      => "$start, {$this->mod->commentlimit}",
			'join'       => 'has_star'
		));
		if (is_array($replyList)) {
			foreach ($replyList as $k => $v) {
				if($v['authorid'] == $_G['uid']){
					unset($replyList[$k]);
					continue;
				}
				$replyList[$k] = $this->_makereply($v);
			}
		}
        $thread_info = DB::fetch_first("SELECT replies,subject FROM ".DB::table('forum_thread')." WHERE tid = {$tid}");

        $multipage = multi($thread_info['replies'], $perpage, $page, $url . "&act=showview&tid={$tid}");
		if ($_G['uid']) {
			$mod_dianping_support = m('dianpingsupport');
			$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
		}
		$data = $this->_getGlobalArgs('list');
		$this->assign($data);
		$this->assign('page', $page);
		$this->assign('list', $replyList);
		$this->assign('multipage', $multipage);
		$this->assign('supportlist', $supportlist);
        $this->assign('subject',$thread_info['subject']);
        $this->assign('mod',$this->modname);
        $this->assign('tid',$tid);
		$this->display($this->mod->template['replylist'] ? $this->mod->template['replylist'] : 'forum/dianping/replylist');
	}

	/**
	 * 处理回复点评内容的现实
	 *
	 * @author lxp 20131125
	 * @param array $reply
	 * @return array
	 */
	function _makereply($reply){
		if($reply){
			$reply['goodpoint'] = $this->_set_br($reply['goodpoint']);
			$reply['weakpoint'] = $this->_set_br($reply['weakpoint']);
			$reply['message'] = $this->_set_br($reply['message']);
			$reply['dateline'] = $this->mod->_timeHandle($reply['dateline']);
			$reply['extdata'] = $this->_set_br(unserialize($reply['extdata']));
		}
		return $reply;
	}

	/**
	 * 进行发布或编辑操作，进行统一验证
	 * @author JiangHong
	 */
	function dopost()
	{
		global $_G;
		cknewuser();
		$method = $_G['gp_do'];
		/*验证方法是否有效*/
		if (! in_array($method, $this->method_array)) {
			$this->showmessage('undefined_action');
		}
		//验证是否绑定手机号
		if(!$_G['member']['telstatus']) {
			showmessage('bindtel_tips', 'http://u.8264.com/home-setting.html#account-security');
		}

		$data = $this->_getGlobalArgs('post');
		$data['imgselectlimit'] = $this->mod->_setting['imagelimit'] > 0 ? $this->mod->_setting['imagelimit'] : 5;
		/*编辑或回复操作，需要验证原帖的权限和状态*/
		if (in_array($method, array('edit', 'reply'))) {
			/*此处将在thread模型后再完善*/
			if ($thread = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid='$_G[tid]'" . ($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' OR (displayorder IN ('-4', '-2') AND authorid='$_G[uid]'))"))) {
				if ($thread['readperm'] && $thread['readperm'] > $_G['group']['readaccess'] && ! $_G['forum']['ismoderator'] && $thread['authorid'] != $_G['uid']) {
					$this->showmessage('thread_nopermission', null, array('readperm' => $thread['readperm']), array('login' => 1));
				}
				$_G['fid'] = $thread['fid'];
			} else {
				$this->showmessage('thread_nonexistence');
			}
			if ($method == 'reply' && ($thread['closed'] == 1) && ! $_G['forum']['ismoderator']) {
				$this->showmessage('post_thread_closed');
			}
		}
		/*根据论坛权限公式计算用户权限*/
		formulaperm($_G['forum']['formulaperm']);
		/*判断当前时段是否可以发帖*/
		periodscheck('postbanperiods');
		/*论坛post权限检查: 新手实习期限，待member模型建立后会更新此处的查询语句*/
		if (! $_G['adminid'] && $_G['setting']['newbiespan'] && (! getuserprofile('lastpost') || TIMESTAMP - getuserprofile('lastpost') < $_G['setting']['newbiespan'] * 60)) {
			if (TIMESTAMP - (DB::result_first("SELECT regdate FROM " . DB::table('common_member') . " WHERE uid='$_G[uid]'")) < $_G['setting']['newbiespan'] * 60) {
				$this->showmessage('post_newbie_span', '', array('newbiespan' => $_G['setting']['newbiespan']));
			}
		}
		if (in_array($method, array('new', 'edit'))) {
			$this->check_allow_action('allowpost');
			if ($this->mod->getChildStatus('pic')) {
				/*处理图片上传的权限*/
				$_G['forum']['allowpostimage'] = isset($_G['forum']['allowpostimage']) ? $_G['forum']['allowpostimage'] : '';
				$_G['group']['allowpostimage'] = $_G['forum']['allowpostimage'] != -1 && ($_G['forum']['allowpostimage'] == 1 || (! $_G['forum']['postimageperm'] && $_G['group']['allowpostimage']) || ($_G['forum']['postimageperm'] && forumperm($_G['forum']['postimageperm'])));
				$_G['group']['attachextensions'] = $_G['forum']['attachextensions'] ? $_G['forum']['attachextensions'] : $_G['group']['attachextensions'];
				/*处理上传的图片类型*/
				if ($_G['group']['attachextensions']) {
					$imgexts = explode(',', str_replace(' ', '', $_G['group']['attachextensions']));
					$imgexts = array_intersect(array(
						'jpg',
						'jpeg',
						'gif',
						'png',
						'bmp'), $imgexts);
					$imgexts = implode(', ', $imgexts);
				} else {
					$imgexts = 'jpg, jpeg, gif, png, bmp';
				}
				/*此处计算用户是否超过当天的发布图片最大数量，是否超过当天发布图片的大小限制。待attachment的模型建立后，会更新查询语句*/
				if ($_G['group']['allowpostimage']) {
					if ($_G['group']['maxattachnum']) {
						$allowuploadnum = $_G['group']['maxattachnum'] - DB::result_first("SELECT count(*) FROM " . DB::table('forum_attachment') . " WHERE uid='$_G[uid]' AND pid>'0' AND dateline>'$_G[timestamp]'-86400");
						$allowuploadnum = $allowuploadnum < 0 ? 0 : $allowuploadnum;
					}
					if ($_G['group']['maxsizeperday']) {
						$allowuploadsize = $_G['group']['maxsizeperday'] - intval(DB::result_first("SELECT SUM(filesize) FROM " . DB::table('forum_attachment') . " WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400"));
						$allowuploadsize = $allowuploadsize < 0 ? 0 : $allowuploadsize;
						$allowuploadsize = $allowuploadsize / 1048576 >= 1 ? round(($allowuploadsize / 1048576), 1) . 'MB' : round(($allowuploadsize / 1024)) . 'KB';
					}
				}
				/*判定是否可以上传图片，如果不能上传图片将不可以发布滑雪场*/
				$data['allowpostimg'] = $allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
				$maxattachsize_mb = $_G['group']['maxattachsize'] / 1048576 >= 1 ? round(($_G['group']['maxattachsize'] / 1048576), 1) . 'MB' : round(($_G['group']['maxattachsize'] / 1024)) . 'KB';
				if (! $allowpostimg)
					$this->showmessage('postattachperm_upgrade_nopermission_not_enter', null, array('action' => ($method == 'new' ? '发布' : '编辑')));
			}
		}

		$data['seccodecheck'] = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
		$data['secqaacheck'] = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
		if (! empty($_POST)) {
			if ($_G['formhash'] != $_POST['formhash']) {
				$this->showmessage('submit_invalid');
			}
		}
		call_user_func_array(array($this, '_' . $method . 'post'), array($data));
	}
	/**
	 * 显示发布页
	 * @author JiangHong
	 */
	function _newpost($data)
	{
		global $_G;
		/*if (! $_G['group']['allowpostpoll'])
			$this->showmessage('group_nopermission', null, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));*/
		if (! $_G['uid'] && ! ((! $_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
			$this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
		} elseif (empty($_G['forum']['allowpost'])) {
			if (! $_G['forum']['postperm'] && ! $_G['group']['allowpost']) {
				$this->showmessage('postperm_none_nopermission_dianping', null, array(), array('login' => 1));
			} elseif ($_G['forum']['postperm'] && ! forumperm($_G['forum']['postperm'])) {
				showmessagenoperm('postperm', $this->mod->_fid, $_G['forum']['formulaperm']);
			}
		} elseif ($_G['forum']['allowpost'] == -1) {
			$this->showmessage('post_forum_newthread_nopermission');
		}
		if (! $_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
			$this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
		}
		checklowerlimit('post', 0, 1, $this->mod->_fid);
		//$data = $this->_getGlobalArgs('post');
		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'new';
			if($this->mod->getChildStatus('pro')){
				$data['regions'] = $this->mod->getRegions(0, 2, true, true);
				$data['nowregion'] = $this->mod->getRegionByIp($_G['clientip']);
			}
			// 取得分类列表
			if($this->mod->getChildStatus('typeclass')){
				$data['typelist'] = $this->mod->_getTypeClass();
			}
			// 取得品牌列表
			if($this->mod->getChildStatus('brand')){
				$mod_brand = m('brand');
				$data['brandlist'] = $mod_brand->find(array(
						'fields' => 'id, subject, url, letter',
						'conditions' => "ispublish = 1",
						'order' => 'subject'
				));
			}
			$data['letterlist'] = explode(',', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z');

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
			//var_dump($postdata);
			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
			$this->mod->dopost($postdata);
		}
	}
	/**
	 * 显示编辑页
	 * @author JiangHong
	 */
	function _editpost($data)
	{
		global $_G;
		$tid = intval($_G['gp_tid']);
		$pid = intval($_G['gp_pid']);
		if ($pid <= 0 || $tid <= 0)
			$this->showmessage('nopidandtid');
		//$data = $this->_getGlobalArgs('post');
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['editdata'] = $this->mod->getview($tid);
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'edit';

			if($this->mod->getChildStatus('pro')){
				$data['regions'] = $this->mod->getRegions(0, 2, true, true);
				$data['nowregion'] = array('name' => $data['editdata']['proname'], 'id' => $data['editdata']['pro']);
			}
			// 取得分类列表
			if($this->mod->getChildStatus('typeclass')){
				$data['typelist'] = $this->mod->_getTypeClass();
			}
			// 取得品牌列表
			if($this->mod->getChildStatus('brand')){
				$mod_brand = m('brand');
				$data['brandlist'] = $mod_brand->find(array(
						'fields' => 'id, subject, url, letter',
						'conditions' => "ispublish = 1",
						'order' => 'subject'
				));
				$data['letterlist'] = explode(',', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z');
			}

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$pstatus = DB::fetch_first("SELECT COUNT(*) AS count, first, authorid FROM " . DB::table('forum_post') . " WHERE pid = {$pid}");
			$postdata = array_merge($_GET, $_POST);
			if ($_G['forum']['ismoderator'] != 1 && $pstatus['authorid'] != $_G['uid'])
				$this->showmessage('model_edit_nopermission');
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
			if ($pstatus['first'] == 1) {
				$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
				$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
				$this->mod->dopost($postdata, $tid, $pid);
			}
		}
	}
	/**
	 * 发/编辑 点评 - ajax
	 *
	 * @author lxp 20130910
	 */
	function _replypost($data)
	{
		global $_G;
		$this->check_allow_action('allowreply');
		if (submitcheck('replypostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$postdata = array_merge($_GET, $_POST);
			$postdata = iconv_array($postdata, 'UTF-8', 'GBK'); // jquery ajax提交转码
			// 简单验证
			$star_num = intval($postdata['starnum']);
			if ($star_num > 5 || $star_num <= 0 || !trim($postdata['goodpoint']) || !trim($postdata['weakpoint']) || !trim($postdata['message'])) {
				$this->showmessage("数据错误，请重新提交");
			}
			if($postdata['message'] == $this->mod->_setting['initdianping']){
				$this->showmessage("请认真填写综合评价");
			}
			$extdata = array();
			if(isset($postdata['price']) && !empty($postdata['price'])){
				$extdata['price'] = trim(dhtmlspecialchars($postdata['price']));
			}
			// 初始化模型
			$mod_forum_post = m('forum_post');
			$mod_star_logs = m('dianping');
			$starid = $mod_star_logs->_getStarid($_G['tid']);


			if (isset($postdata['ext']) && $postdata['ext'] == 'edit') {
				// 修改评价
				if ($_G['forum']['ismoderator'] == 1 || $mod_star_logs->get(array('conditions' => "uid = {$_G['uid']} AND pid = {$postdata['pid']}", 'index_key' => 'pid'))) {
					$mod_forum_post->edit("pid = {$postdata['pid']}", array('message' => trim(dhtmlspecialchars($postdata['message'])), ));
					$mod_star_logs->edit("pid = {$postdata['pid']}", array(
						'starnum' => $postdata['starnum'],
						'goodpoint' => trim(dhtmlspecialchars($postdata['goodpoint'])),
						'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
						'lastupdate' => $_G['timestamp'],
						'extdata' => addslashes(serialize(dstripslashes($extdata)))
					));
				}
			} else {
				require_once libfile('function/post');
				// 新增评价
				if (intval($mod_star_logs->getMyRate($_G['uid'], $_G['tid']))) {
					$this->showmessage("你已经点评过了");
				}
				$pid = insertpost(array(
					'fid' => $this->mod->_fid,
					'tid' => $_G['tid'],
					'first' => '0',
					'author' => $_G['username'],
					'authorid' => $_G['uid'],
					'subject' => '',
					'dateline' => $_G['timestamp'],
					'message' => trim(dhtmlspecialchars($postdata['message'])),
					'useip' => $_G['clientip'],
					'attachment' => '0',
				));
				// 新增点评分数
				$mod_star_logs->add(array(
					'starid' => $starid,
					'starnum' => $star_num,
					'dateline' => $_G['timestamp'],
					'uid' => $_G['uid'],
					'username' => $_G['username'],
					'pid' => $pid,
					'ip' => $_G['clientip'],
					'goodpoint' => trim(dhtmlspecialchars($postdata['goodpoint'])),
					'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
					'extdata' => addslashes(serialize(dstripslashes($extdata))),
					'lastupdate' => $_G['timestamp']
				));
				// 相关更新
				$lastpost = "{$_G['tid']}\t\t{$_G['timestamp']}\t{$_G['username']}";
				DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid='{$this->mod->_fid}'", 'UNBUFFERED');
				require_once libfile('function/stat');
				updatestat('post');
				$typeid = DB::result_first("SELECT typeid FROM " . DB::table('forum_thread') . " WHERE tid='{$_G['tid']}'");
				DB::query("UPDATE " . DB::table('forum_threadclass') . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');
				updatepostcredits('+', $_G['uid'], 'reply', $this->mod->_fid); // 更新积分

				$mod_thread = m('forum_thread');
				$mod_thread->updateHeats($_G['tid']);  // 更新热度
				$mod_thread->edit($_G['tid'], "replies=replies+1, lastpost='{$_G['timestamp']}', lastposter='{$_G['username']}'");
				// 更新点评人数 lxp 20131029
				$this->mod->updateNum($_G['tid'], $starid);
			}
			// 更新评分
			$score = $mod_star_logs->updateStar($starid);
			$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $mod_star_logs->t_lastprice)));
			die('ok');
		}
	}
	/**
	 * 支持 - 赞
	 *
	 * @author lxp 20130917
	 */
	function support()
	{
		global $_G;
		if (! $_G['gp_pid'] || ! $_G['uid'] || ! $_G['gp_tid']) {
			die();
		}
		$mod_support = m('dianpingsupport');
		$mod_star_logs = m('dianping');
		if ($mod_support->isSupport($_G['gp_pid'], $_G['uid'])) {
			$mod_support->add(array(
				'fid' => $this->mod->_fid,
				'tid' => $_G['gp_tid'],
				'pid' => $_G['gp_pid'],
				'uid' => $_G['uid'],
				'username' => $_G['username'],
				'ip' => $_G['clientip'],
				'dateline' => $_G['timestamp']));
			$mod_star_logs->edit("pid = {$_G['gp_pid']}", 'supports = supports+1');
		}
	}
	/**
	 * 读取图片列表
	 */
	function getimglist()
	{
		global $_G;
		if ($_G['inajax']) {
			$this->display('common/header_ajax');
			$tid = intval($_G['gp_tid']);
			$pid = intval($_G['gp_pid']);
			$dir = $_GET['type'] ? $_GET['type'] : 'plugin';
			$data['dir'] = $dir;
			$data['imgselectlimit'] = $this->mod->_setting['imagelimit'] > 0 ? $this->mod->_setting['imagelimit'] : 5;
			$data['imglist'] = $this->_getimgbytidpid($tid, $pid, $dir, false, $data['imgselectlimit'] * 2);
			$this->assign($data);
			$this->display($this->mod->template['imagelist']);
			$this->display('common/footer_ajax');
		}
	}
	/**
	 * 验证用户是否有权限执行当前的操作
	 */
	function check_allow_action($action = 'allowpost')
	{
		global $_G;
		if (isset($_G['forum'][$action]) && $_G['forum'][$action] == -1) {
			$this->showmessage('forum_access_disallow');
		}
	}
	/**
	 * 发布错误消息提示
	 */
	function showmessage($message, $url = null, $args = array(), $extra = array(), $custom = 0)
	{
		global $_G;
		$args = array_merge(array('name' => $this->mod->_moduleinfo['mname'], 'mod' => $this->modname), $args);
		parent::showmessage($message, $url, $args, $extra, $custom);
	}
	/**
	 * 处理textarea提交的回车换行问题
	 *
	 * @author lxp 20130530
	 * @param string $str
	 * @return mixed
	 */
	function _set_br($str){
		$str = str_replace(array("\r\n","\r","\n"), "<br/>", $str);
		return $str;
	}
	/**
	 * 审核相关的商品
	 */
	function checkit()
	{
		global $_G;
		$tid = $_G['gp_tid'];
		$status = intval($_G['gp_type']);
		if ($_G['forum']['ismoderator']) {
			if ($this->mod->checkThis($tid, $status)) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo -1;
		}
		exit();
	}
	/**
	 * 删除相关的商品
	 */
	function deleteit()
	{
		global $_G;
		$tid = $_G['gp_tid'];
		if ($_G['forum']['ismoderator']) {
			$this->mod->deleteThis($tid);
			$this->showmessage("您删除的{$this->mod->_moduleinfo[mname]}已经被删除！", $_G['config']['web']['portal'] . "dianping.php?mod={$this->modname}&act=showlist");
		}
		$this->showmessage("您没有权限进行删除操作");
	}
	/**
	 * 重写父类的管理操作
	 */
	function moderator()
	{
		global $_G;
		//读取帖子相关操作返回结果
		$result = $this->_getModeratorResult();
		if (in_array($result['action'], array('delpost', 'stickreply'))) {
			switch ($result['action']) {
				case 'delpost':
					$dianping = m('dianping');
					$score = $dianping->delStar($result['pids'], $this->modname, false);
					!is_array($score) && $this->mod->edit("{$this->mod->_vars[tid]} = {$result[reasonvar][tid]}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $dianping->t_lastprice)));
					// 更新点评人数 lxp 20131029
					$this->mod->updateNum($result['reasonvar']['tid']);
					$resultarray['redirect'] = $_G['config']['web']['portal'] . 'dianping.php?mod=' . $this->modname . '&act=showview&tid=' . $result['reasonvar']['tid'];
					break;
				case 'stickreply':
					$resultarray['redirect'] = $_G['config']['web']['portal'] . 'dianping.php?mod=' . $this->modname . '&act=showview&tid=' . $result['reasonvar']['tid'];
					break;
				default:
					break;
			}
		}
		$this->showmessage((isset($resultarray['message']) ? $resultarray['message'] : 'admin_succeed'), $resultarray['redirect']);
	}

	//当用户在发布时,会首先选择省,选择省后,后面的城市需要填充
	function ajaxGetCities() {
		$provinceid = $_POST['provinceid'];
		if($provinceid) {
			$mdRegion = m('regions');
			$cities = $mdRegion->getCitiesByProvince($provinceid);
			if($cities) {
				$return_data = '';
				foreach ($cities as $k => $v) {
					$return_data .=  sprintf('<a href="javascript:void(0);" rel="%s">%s</a>',
						$v['codeid'],
						$v['cityname']);
				}
				echo $return_data;
			}
			exit;
		}
	}
}
?>
