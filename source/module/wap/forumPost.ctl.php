<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ForumPostCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();
	}

	//帖子发布表单--源自source/module/forum/forum_post.php的action=newthread
	function form()
	{
		global $_G;
		global $returnData;

		define('NOROBOT', TRUE);
		cknewuser_wap();

		//note 引用头文件
		require_once libfile('class/credit');
		require_once libfile('function/post');

		$dealedData = $this->_commonPost();
		extract($dealedData);

		loadcache('groupreadaccess');
		$this->_commonNewthread();

		$returnData["forum"] 	    	= $_G["forum"];
		$returnData["isYzm"] 	    	= checkperm('seccode') && ($secqaacheck || $seccodecheck) ? 1 : 0;
		encodeData($returnData);

	}

	//帖子发布--源自source/module/forum/forum_post.php的action=newthread
	function doPost()
	{
		global $_G;
		global $returnData;

		define('NOROBOT', TRUE);
		cknewuser_wap();

		//note 引用头文件
		require_once libfile('class/credit');
		require_once libfile('function/post');

		//参数整理
		$dealedData = $this->_commonPost();
		extract($dealedData);
		$special = 0;
		$sortid  = max($_G['gp_sortid'], 0);

		//接下由客户端那边得到的真实ip
		$_G['clientip'] = $_G['gp_ip'];

		loadcache('groupreadaccess');
		$this->_commonNewthread();

		if (submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck)){

			$typeid       = isset($_G['gp_typeid']) && isset($_G['forum']['threadtypes']['types'][$_G['gp_typeid']]) ? $_G['gp_typeid'] : 0;
			if (!$typeid && $_G['forum']['threadtypes']['required'] && !$special) {
				encodeData(array('error'=>true , 'errorinfo'=>'请选择主题的类别'));
			}

			if (trim($subject) == '') {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_sm_isnull')));
			}
			if (strstr($subject, '?') || strstr($message, '?')) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'submit_invalid')));
			}
			if ($post_invalid = checkpost($subject, $message, ( $special || $sortid )))	{
				if (!($post_invalid == 'post_message_tooshort' && !empty($_G['gp_aid']))) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('forum/wap_new', $post_invalid, array( 'minpostsize' => $_G['setting']['minpostsize'], 'maxpostsize' => $_G['setting']['maxpostsize'] ))));
				}
			}
			if (checkflood()) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl', array('floodctrl' => $_G['setting']['floodctrl']))));
			} elseif (checkmaxpostsperhour())	{
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl_posts_per_hour', array('posts_per_hour' => $_G['group']['maxpostsperhour']))));
			}

			$_G['gp_save'] = $_G['uid'] ? $_G['gp_save'] : 0;

			$displayorder = $modnewthreads ? -2 : (($_G['forum']['ismoderator'] && ! empty( $_G['gp_sticktopic'])) ? 1 : (empty($_G['gp_save']) ? 0 : -4));

			//添加过滤
			$pattern = "[img=1,1";
			if (strstr($message, $pattern))	{
				$displayorder = $modnewthreads = -2;
			}
			$pattern1 = "[flash=1,1";
			if (strstr($message, $pattern1))	{
				$displayorder = $modnewthreads = -2;
			}
			if ( $displayorder == -2 ) {
				DB::update( 'forum_forum', array( 'modworks' => '1' ), "fid='{$_G['fid']}'" );
				addrecordforuminfo($_G['fid'], 3);
			} elseif ( $displayorder == -4 ) {
				$_G['gp_addfeed'] = 0;
			}

			$digest      = ( $_G['forum']['ismoderator'] && ! empty( $_G['gp_addtodigest'] ) ) ? 1 : 0;
			$isanonymous = ( $_G['group']['allowanonymous'] && $_G['gp_isanonymous'] ) ? 1 : 0;

			$author    = !$isanonymous ? $_G['username'] : '';
			$moderated = $digest || $displayorder > 0 ? 1 : 0;
			$thread    = array();
			$thread['status'] = 0;
			$_G['gp_ordertype'] && $thread['status'] = setstatus( 4, 1, $thread['status'] );
			$_G['gp_hiddenreplies'] && $thread['status'] = setstatus( 2, 1, $thread['status'] );
			if ( $_G['group']['allowpostrushreply'] && $_G['gp_rushreply'] ) {
				$thread['status'] = setstatus(3, 1, $thread['status']);
				$thread['status'] = setstatus(1, 1, $thread['status']);
			}

			$_G['gp_allownoticeauthor'] && $thread['status'] = setstatus( 6, 1, $thread['status'] );
			$isgroup     = $_G['forum']['status'] == 3 ? 1 : 0;
			$posttableid = getposttableid('p');
			$attachment  = $_G['gp_aid'] ? 2 : 0;

			//forum_thread表记录
			DB::query( "INSERT INTO " . DB::table( 'forum_thread' ) . " (fid, posttableid, readperm, price, typeid, sortid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup)
				VALUES ('$_G[fid]', '$posttableid', '0', '0', '$typeid', '0', '$author', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$author', '$displayorder', '$digest', '$special', '$attachment', '$moderated', '$thread[status]', '$isgroup')" );

			$tid = DB::insert_id();
			$typeid > 0 && DB::query( "UPDATE " . DB::table( 'forum_threadclass' ) . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED' );

			//更新空间动态
			DB::update('common_member_field_home', array('recentnote' => $subject), array('uid' => $_G['uid'] ));

			if ($moderated) {
				updatemodlog($tid, ($displayorder > 0 ? 'STK' : 'DIG' ));
				updatemodworks(($displayorder > 0 ? 'STK' : 'DIG'), 1);
			}

			$bbcodeoff = checkbbcodes( $message, ! empty( $_G['gp_bbcodeoff'] ) );
			$smileyoff = checksmilies( $message, ! empty( $_G['gp_smileyoff'] ) );
			$parseurloff = ! empty( $_G['gp_parseurloff'] );
			$htmlon = bindec( ( $_G['setting']['tagstatus'] && ! empty( $tagoff ) ? 1 : 0 ) . ( $_G['group']['allowhtml'] && ! empty( $_G['gp_htmlon'] ) ? 1 : 0 ) );
			$usesig = ! empty( $_G['gp_usesig'] ) && $_G['group']['maxsigsize'] ? 1 : 0;

			$pinvisible = $modnewthreads ? -2 : ( empty( $_G['gp_save'] ) ? 0 : -3 );
			$message = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $message);
			$message = htmlspecialchars_decode($message);

			//上传图片处理
			if ($_G['gp_aid']) {
				$aids = trim($_G['gp_aid'], ',');
				$aids = explode(',', $aids);
				$index = 0;
				$needaids = array();
				foreach ($aids as $v) {
					if ($v == 0) {continue;}
					$message .= "\r\n[attach]{$v}[/attach]";
					$needaids[$v] = $v;
					$index++;
					if ($index >= 3) {break;}
				}
			}
			//增加手机版发帖后缀
			$message .= "\r\n\r\n发自8264手机版 m.8264.com";
			$message = trim($message);
			$pid = insertpost(array(
				'fid' 			=> $_G['fid'],
				'tid' 			=> $tid,
				'first' 		=> '1',
				'author' 		=> $_G['username'],
				'authorid' 		=> $_G['uid'],
				'subject' 		=> $subject,
				'dateline' 		=> $_G['timestamp'],
				'message' 		=> $message,
				'useip' 		=> $_G['clientip'],
				'invisible' 	=> $pinvisible,
				'anonymous' 	=> $isanonymous,
				'usesig' 		=> $usesig,
				'htmlon' 		=> $htmlon,
				'bbcodeoff' 	=> $bbcodeoff,
				'smileyoff' 	=> $smileyoff,
				'parseurloff' 	=> $parseurloff,
				'attachment' 	=> $attachment,
				'tags' 			=> implode( ',', $tagarray ),
			));

			//start 记录发帖信息
			$parr = array(
				'tid' => $tid,
				'pid' => $pid,
				'uid' => $_G['uid'],
				'username' => $_G['username'],
				'fid' => $_G['fid'],
				'name' => $_G['forum']['name'],
				'subject' => $subject,
				'message' => $message,
				'ip' => $_G['clientip'] );
			addrecordthread( $parr, 1 );

			if ($pid && getstatus($thread['status'], 1)) {
				savepostposition( $tid, $pid );
			}

			$param = array(
				'fid' => $_G['fid'],
				'tid' => $tid,
				'pid' => $pid
			);
			$statarr = array(
				0 => 'thread',
				1 => 'poll',
				2 => 'trade',
				3 => 'reward',
				4 => 'activity',
				5 => 'debate',
				127 => 'thread' );
			include_once libfile( 'function/stat' );
			updatestat($isgroup ? 'groupthread' : $statarr[$special]);

			//因为feed_add_ucenter()里要用到parseattach(),所以要把更新图片附件的tid和pid置于feed_add_ucenter()之前
			if (!empty($needaids)) {
				$needaids = implode(",", $needaids);
				DB::query( "UPDATE " . DB::table( 'forum_attachment' ) . " SET tid={$tid}, pid={$pid} WHERE aid in ($needaids)" );
			}

			//记录列表页头图信息
			include_once libfile('function/previewimg');
			update_previewimg($pid);

			if ($modnewthreads) {
				DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED' );

				//记录修改版块操作
				addrecordforuminfo($_G['fid'], 3);
				showmessage( 'post_newthread_mod_succeed', "forum.php?mod=viewthread&tid=$tid&extra=$extra", $param );
			}
			else
			{
				//2015-02-04 by shuaiquan 新的动态表的增加
				$feedarr = array(
					'uid' 	    => $_G[uid],
					'fid' 	    => $_G[fid],
					'id' 	    => $tid,
					'pid'  	    => $pid,
					'type'      => 1,
					'dateline'  => $_G[timestamp],
					'subject'   => '发布了新帖子',
					'message'   => $message,
					'username'  => $_G['username'],
					'authorid'  => $_G['uid'],
					'htmlon'    => $htmlon,
					'bbcodeoff' => $bbcodeoff,
					'smileyoff' => $smileyoff,
					'title'     => $subject,
				);

				require_once libfile('function/feed');
				feed_add_ucenter($feedarr);

				updatepostcredits( '+', $_G['uid'], 'post', $_G['fid'] );
				if ($isgroup)	{
					DB::query( "UPDATE " . DB::table( 'forum_groupuser' ) . " SET threads=threads+1, lastupdate='" . TIMESTAMP . "' WHERE uid='$_G[uid]' AND fid='$_G[fid]'" );
				}
				if ($displayorder != -4) {
					$subject  = str_replace( "\t", ' ', $subject );
					$lastpost = "$tid\t$subject\t$_G[timestamp]\t$author";
					DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost', threads=threads+1, posts=posts+1, todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED' );

					if ( $_G['forum']['type'] == 'sub' ) {
						DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost' WHERE fid='" . $_G['forum'][fup] . "'", 'UNBUFFERED' );
					}
					//start 记录修改版块操作
					addrecordforuminfo($_G['fid'], 3);
				}
			}

			$returnData['tid'] = $tid;
		}

		encodeData($returnData);

	}

	function doPostAddTo() {
		global $_G;
		global $returnData;

		define('NOROBOT', TRUE);
		cknewuser_wap();

		//note 引用头文件
		require_once libfile('class/credit');
		require_once libfile('function/post');

		//参数整理
		$tid = (int)$_POST['tid'];
		$dealedData = $this->_commonPost();
		extract($dealedData);
		$special = 0;
		$sortid  = max($_G['gp_sortid'], 0);

		//接下由客户端那边得到的真实ip
		$_G['clientip'] = $_G['gp_ip'];

		loadcache('groupreadaccess');
		$this->_commonNewthread();

		if (submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck)){

//			$typeid       = isset($_G['gp_typeid']) && isset($_G['forum']['threadtypes']['types'][$_G['gp_typeid']]) ? $_G['gp_typeid'] : 0;
//			if (!$typeid && $_G['forum']['threadtypes']['required'] && !$special) {
//				encodeData(array('error'=>true , 'errorinfo'=>'请选择主题的类别'));
//			}

			if (trim($subject) == '') {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_sm_isnull')));
			}
			if (strstr($subject, '?') || strstr($message, '?')) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'submit_invalid')));
			}
			if ($post_invalid = checkpost($subject, $message, ( $special || $sortid )))	{
				if (!($post_invalid == 'post_message_tooshort' && !empty($_G['gp_aid']))) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('forum/wap_new', $post_invalid, array( 'minpostsize' => $_G['setting']['minpostsize'], 'maxpostsize' => $_G['setting']['maxpostsize'] ))));
				}
			}
			if (checkflood()) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl', array('floodctrl' => $_G['setting']['floodctrl']))));
			} elseif (checkmaxpostsperhour())	{
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl_posts_per_hour', array('posts_per_hour' => $_G['group']['maxpostsperhour']))));
			}

			$_G['gp_save'] = $_G['uid'] ? $_G['gp_save'] : 0;

			$displayorder = $modnewthreads ? -2 : (($_G['forum']['ismoderator'] && ! empty( $_G['gp_sticktopic'])) ? 1 : (empty($_G['gp_save']) ? 0 : -4));

			//添加过滤
			$pattern = "[img=1,1";
			if (strstr($message, $pattern))	{
				$displayorder = $modnewthreads = -2;
			}
			$pattern1 = "[flash=1,1";
			if (strstr($message, $pattern1))	{
				$displayorder = $modnewthreads = -2;
			}
			if ( $displayorder == -2 ) {
				DB::update( 'forum_forum', array( 'modworks' => '1' ), "fid='{$_G['fid']}'" );
				addrecordforuminfo($_G['fid'], 3);
			} elseif ( $displayorder == -4 ) {
				$_G['gp_addfeed'] = 0;
			}

			$digest      = ( $_G['forum']['ismoderator'] && ! empty( $_G['gp_addtodigest'] ) ) ? 1 : 0;
			$isanonymous = ( $_G['group']['allowanonymous'] && $_G['gp_isanonymous'] ) ? 1 : 0;

			$author    = !$isanonymous ? $_G['username'] : '';
			$moderated = $digest || $displayorder > 0 ? 1 : 0;
			$thread    = array();
			$thread['status'] = 0;
			$_G['gp_ordertype'] && $thread['status'] = setstatus( 4, 1, $thread['status'] );
			$_G['gp_hiddenreplies'] && $thread['status'] = setstatus( 2, 1, $thread['status'] );
			if ( $_G['group']['allowpostrushreply'] && $_G['gp_rushreply'] ) {
				$thread['status'] = setstatus(3, 1, $thread['status']);
				$thread['status'] = setstatus(1, 1, $thread['status']);
			}

			$_G['gp_allownoticeauthor'] && $thread['status'] = setstatus( 6, 1, $thread['status'] );
			$isgroup     = $_G['forum']['status'] == 3 ? 1 : 0;
			$posttableid = getposttableid('p');
			$attachment  = $_G['gp_aid'] ? 2 : 0;

			//查询到这条记录$tid
			$query = DB::query("SELECT tid, authorid FROM " . DB::table( 'forum_thread' ) . " WHERE tid=".$tid);
			$tinfo = DB::fetch($query);
			if($tinfo['authorid'] != $_G['uid']){
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', '操作失败')));
			}

			//更新
			$attachment==2 && DB::query("UPDATE " . DB::table( 'forum_thread' ) . " SET attachment={$attachment} WHERE tid={$tid}");

			$bbcodeoff = checkbbcodes( $message, ! empty( $_G['gp_bbcodeoff'] ) );
			$smileyoff = checksmilies( $message, ! empty( $_G['gp_smileyoff'] ) );
			$parseurloff = ! empty( $_G['gp_parseurloff'] );
			$htmlon = bindec( ( $_G['setting']['tagstatus'] && ! empty( $tagoff ) ? 1 : 0 ) . ( $_G['group']['allowhtml'] && ! empty( $_G['gp_htmlon'] ) ? 1 : 0 ) );
			$usesig = ! empty( $_G['gp_usesig'] ) && $_G['group']['maxsigsize'] ? 1 : 0;

			$pinvisible = $modnewthreads ? -2 : ( empty( $_G['gp_save'] ) ? 0 : -3 );
			$message = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $message);
			$message = htmlspecialchars_decode($message);

			//上传图片处理
			if ($_G['gp_aid']) {
				$aids = trim($_G['gp_aid'], ',');
				$aids = explode(',', $aids);
				$index = 0;
				$needaids = array();
				foreach ($aids as $v) {
					if ($v == 0) {continue;}
					$message .= "\r\n[attach]{$v}[/attach]";
					$needaids[$v] = $v;
					$index++;
					if ($index >= 3) {break;}
				}
			}

			$message = trim($message);
			//查询到一楼
			$postinfo = getfieldsofposts('pid,message', "tid={$tid} and first=1");
			if(empty($postinfo)){
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', '操作失败')));
			}
			$pid = $postinfo[0]['pid'];
			$updatedata = array('message' => "{$postinfo[0]['message']}\r\n$message");
			$attachment == 2 && $updatedata['attachment'] = $attachment;
			updatepost($updatedata, "pid={$pid}");

			//start 记录修改帖子信息
			$parr = array(
				'tid' => $tid,
				'pid' => $pid,
				'uid' => $_G['uid'],
				'username' => $_G['username'],
				'fid' => $_G['fid'],
				'name' => $_G['forum']['name'],
				'subject' => $subject,
				'message' => "{$postinfo[0]['message']}\r\n$message",
				'ip' => $_G['clientip']);
			addrecordthread($parr, 2);
			//end

			//因为feed_add_ucenter()里要用到parseattach(),所以要把更新图片附件的tid和pid置于feed_add_ucenter()之前
			if (!empty($needaids)) {
				$needaids = implode(",", $needaids);
				DB::query( "UPDATE " . DB::table( 'forum_attachment' ) . " SET tid={$tid}, pid={$pid} WHERE aid in ($needaids)" );
				memory('rm', 'attach_cache_pid_'.$pid);
			}

			//记录列表页头图信息
			include_once libfile('function/previewimg');
			update_previewimg($pid);

			$returnData['tid'] = $tid;
		}

		encodeData($returnData);
	}

	//帖子回复表单--源自source/include/post/post_newreply.php
	function replyForm()
	{
		global $_G;
		global $returnData;

		$dealedData = $this->_commonPost();
		extract($dealedData);

		if (empty($_G['gp_hascomment'])) {
			$dealedData = $this->_commonNewreply();
			extract($dealedData);
		}

		$returnData["forum"] 	    	= $_G["forum"];
        $returnData["threadShow"]		= $_G["forum_thread"];
        $returnData["stand"]			= !empty($stand) ? $stand : 0;
        $returnData["isYzm"] 	    	= checkperm('seccode') && ($secqaacheck || $seccodecheck) ? 1 : 0;
//        $returnData["isYzm"] 	    	= "==={$secqaacheck}==={$seccodecheck}===".checkperm('seccode');
		encodeData($returnData);
	}

	//帖子回复--源自source/include/post/post_newreply.php
	function doReply() {
		global $_G;
		global $returnData;

		//参数整理
		$dealedData = $this->_commonPost();
		extract($dealedData);
		$dealedData = $this->_commonNewreply();
		extract($dealedData);

		//接下由客户端那边得到的真实ip
		$_G['clientip'] = $_G['gp_ip'];

		$thread = $_G["forum_thread"] ? $_G["forum_thread"] : array();

		if (submitcheck('replysubmit', 0, $seccodecheck, $secqaacheck)) {

			//引用头文件
			require_once libfile('class/credit');
			require_once libfile('function/post');

			if (trim($subject) == '' && trim($message) == '' && $thread['special'] != 2 && empty($_G['gp_aid'])) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_sm_isnull')));
			} elseif ($thread['closed'] && ! $_G['forum']['ismoderator'] && ! $thread['isgroup']) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_thread_closed')));
			} elseif (! $thread['isgroup'] && $post_autoclose = checkautoclose($thread)) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', $post_autoclose, array('autoclose' => $_G['forum']['autoclose']))));
			} elseif ($post_invalid = checkpost($subject, $message, $thread['special'] == 2 && $_G['group']['allowposttrade'])) {
				if ($post_invalid = checkpost($subject, $message, ( $special || $sortid )))	{
					if (!($post_invalid == 'post_message_tooshort' && !empty($_G['gp_aid']))) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('forum/wap_new', $post_invalid, array( 'minpostsize' => $_G['setting']['minpostsize'], 'maxpostsize' => $_G['setting']['maxpostsize'] ))));
					}
				}
			} elseif (checkflood()) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl', array('floodctrl' => $_G['setting']['floodctrl']))));
			} elseif (checkmaxpostsperhour()) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl_posts_per_hour', array('posts_per_hour' => $_G['group']['maxpostsperhour']))));
			}

			if (! empty($_G['gp_trade']) && $thread['special'] == 2 && $_G['group']['allowposttrade']) {
				$item_price  = floatval($_G['gp_item_price']);
				$item_credit = intval($_G['gp_item_credit']);
				if (! trim($_G['gp_item_name'])) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'trade_please_name')));
				} elseif ($_G['group']['maxtradeprice'] && $item_price > 0 && ($_G['group']['mintradeprice'] > $item_price || $_G['group']['maxtradeprice'] < $item_price)) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'trade_price_between', array('mintradeprice' => $_G['group']['mintradeprice'], 'maxtradeprice' => $_G['group']['maxtradeprice']))));
				} elseif ($_G['group']['maxtradeprice'] && $item_credit > 0 && ($_G['group']['mintradeprice'] > $item_credit || $_G['group']['maxtradeprice'] < $item_credit)) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'trade_credit_between', array('mintradeprice' => $_G['group']['mintradeprice'], 'maxtradeprice' => $_G['group']['maxtradeprice']))));
				} elseif (! $_G['group']['maxtradeprice'] && $item_price > 0 && $_G['group']['mintradeprice'] > $item_price) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'trade_price_more_than', array('mintradeprice' => $_G['group']['mintradeprice']))));
				} elseif (! $_G['group']['maxtradeprice'] && $item_credit > 0 && $_G['group']['mintradeprice'] > $item_credit) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'trade_credit_more_than', array('mintradeprice' => $_G['group']['mintradeprice']))));
				} elseif ($item_price <= 0 && $item_credit <= 0) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'trade_pricecredit_need')));
				} elseif ($_G['gp_item_number'] < 1) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'tread_please_number')));
				}
			}

			$attentionon  = empty($_G['gp_attention_add']) ? 0 : 1;
			$attentionoff = empty($attention_remove) ? 0 : 1;
			$heat 		  = $thread['heats'];
			//热度计算
			if ($thread['lastposter'] != $_G['member']['username']) {
				$posttable   = getposttablebytid($_G['tid']);
				$userreplies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='0' AND authorid='$_G[uid]'");
				$thread['heats'] += round($_G['setting']['heatthread']['reply'] * pow(0.8, $userreplies));

				DB::query("UPDATE ".DB::table('forum_thread')." SET heats='$thread[heats]' WHERE tid='$_G[tid]'", 'UNBUFFERED');
			}

			//点评回复的引用
			if ($_G['gp_way'] == 'commentreply' || $_G['gp_way'] == 'reply') {

				$language = lang('forum/misc');
				$noticetrimstr = '';
				if (isset($_G['gp_pid'])) {
					$posttable = getposttablebytid($_G['tid']);
					$thaquote  = DB::fetch_first("SELECT tid, fid, author, authorid, first, message, useip, dateline, anonymous, status FROM ".DB::table($posttable)." WHERE pid='{$_G['gp_pid']}' AND (invisible='0' OR (authorid='{$_G[uid]}' AND invisible='-2'))");
					if ($thaquote['tid'] != $_G['tid']) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
					}
					if (getstatus($thread['status'], 2) && $thaquote['authorid'] != $_G['uid'] && $_G['uid'] != $thread['authorid'] && $thaquote['first'] != 1 && ! $_G['forum']['ismoderator']) {
						encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
					}
					if (!($thread['price'] && !$thread['special'] && $thaquote['first'])) {
						$quotefid 		= $thaquote['fid'];
						$noticetrimstr  = $thaquote['message'];
						if ($_G['setting']['bannedmessages'] && $thaquote['authorid']) {
							$author = DB::fetch_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid='{$thaquote[authorid]}'");
							if (! $author['groupid'] || $author['groupid'] == 4 || $author['groupid'] == 5) {
								$noticetrimstr = $language['post_banned'];
							} elseif ($thaquote['status'] & 1) {
								$noticetrimstr = $language['post_single_banned'];
							}
						}
						$time    = dgmdate($thaquote['dateline']);
						$noticetrimstr = messagecutstr($noticetrimstr, 100);
						$noticetrimstr = implode("\n", array_slice(explode("\n", $noticetrimstr), 0, 3));
						$thaquote['useip'] = substr($thaquote['useip'], 0, strrpos($thaquote['useip'], '.')).'.x';
						if ($thaquote['author'] && $thaquote['anonymous']) {
							$thaquote['author'] = 'Anonymous';
						} elseif (!$thaquote['author']) {
							$thaquote['author'] = 'Guest from '.$thaquote['useip'];
						} else {
							$thaquote['author'] = $thaquote['author'];
						}
						$post_reply_quote = lang('forum/misc', 'post_reply_quote', array('author' => $thaquote['author'], 'time' => $time));
						$noticetrimstr          = "[quote][size=2][color=#999999]{$post_reply_quote}[/color] [url=forum.php?mod=redirect&goto=findpost&pid={$_G['gp_pid']}&ptid={$_G['tid']}][img]static/image/common/back.gif[/img][/url][/size]\n{$noticetrimstr}[/quote]";
						$noticetrimstr    = htmlspecialchars($noticetrimstr);
					}
				}
				$message = $noticetrimstr."\n\n".$message;
			}
			$bbcodeoff   = checkbbcodes($message, ! empty($_G['gp_bbcodeoff']));
			$smileyoff   = checksmilies($message, ! empty($_G['gp_smileyoff']));
			$parseurloff = ! empty($_G['gp_parseurloff']);
			$htmlon 	 = $_G['group']['allowhtml'] && ! empty($_G['gp_htmlon']) ? 1 : 0;
			$usesig 	 = ! empty($_G['gp_usesig']) ? 1 : ($_G['uid'] && $_G['group']['maxsigsize'] ? 1 : 0);
			$isanonymous = $_G['group']['allowanonymous'] && ! empty($_G['gp_isanonymous']) ? 1 : 0;
			$author 	 = empty($isanonymous) ? $_G['username'] : '';
			$attachment  = $_G['gp_aid'] ? 2 : 0;

			$pinvisible = $modnewreplies ? -2 : ($thread['displayorder'] == -4 ? -3 : 0);
			$message = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $message);
			$message = htmlspecialchars_decode($message);
			$message .= "\r\n\r\n发自8264手机版 m.8264.com";

			//上传图片处理
			if ($_G['gp_aid']) {
				$aids = trim($_G['gp_aid'], ',');
				$aids = explode(',', $aids);
				$index = 0;
				foreach ($aids as $v) {
					if ($v == 0) {continue;}
					$message .= "\r\n[attach]{$v}[/attach]";
					$index++;
					if ($index >= 3) {break;}
				}
			}

			//回复
			$pid = insertpost(array(
				'fid' 			=> $_G['fid'],
				'tid' 			=> $_G['tid'],
				'first' 		=> '0',
				'author' 		=> $_G['username'],
				'authorid' 		=> $_G['uid'],
				'subject' 		=> $subject,
				'dateline' 		=> $_G['timestamp'],
				'message'   	=> $message,
				'useip' 		=> $_G['clientip'],
				'invisible' 	=> $pinvisible,
				'anonymous' 	=> $isanonymous,
				'usesig' 		=> $usesig,
				'htmlon' 		=> $htmlon,
				'bbcodeoff' 	=> $bbcodeoff,
				'smileyoff' 	=> $smileyoff,
				'parseurloff' 	=> $parseurloff,
				'attachment' 	=> $attachment,
			));

			if (!empty($aids)) {
				$aids = implode(",", $aids);
				DB::query( "UPDATE " . DB::table( 'forum_attachment' ) . " SET tid={$_G['tid']}, pid={$pid} WHERE aid in ($aids)" );
			}

			//记录回复帖子信息
			$parr = array(
				'tid' 		=> $_G['tid'],
				'pid' 		=> $pid,
				'uid' 		=> $_G['uid'],
				'username' 	=> $_G['username'],
				'fid' 		=> $_G['fid'],
				'name' 		=> $_G['forum']['name'],
				'subject' 	=> $subject,
				'message' 	=> $message,
				'ip' 		=> $_G['clientip']);
			addrecordthread($parr, 3);

			$typeid = DB::result_first("SELECT typeid FROM ".DB::table('forum_thread')." WHERE tid='{$_G['tid']}'" . getSlaveID());
			DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');

			//点评回复
			if ($_G['gp_way'] == 'reply' || $_G['gp_way'] == 'commentreply') {

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

				$message = cutstr(censor_wap(trim(htmlspecialchars($message)), '***'), 200);
				$commentContent = array(
					'tid' 	   	=> $_G['tid'],
					'pid' 	   	=> $_G['gp_pid'],
					'author'   	=> $_G['username'],
					'authorid' 	=> $_G['uid'],
					'dateline'	=> $_G['timestamp'],
					'comment'  	=> $message,
					'score'    	=> $commentscore ? 1 : 0,
					'forpid' 	=> $pid,
					'replyid' 	=> 0,
					'isshow' 	=> $pinvisible == -2 ? 0 : 1);
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

			$cacheposition = getstatus($thread['status'], 1);
			if ($pid && $cacheposition) {
				savepostposition($_G['tid'], $pid);
			}

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
			if ($thread['special'] == 5) {
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

			if ($specialextra) {
				@include_once DISCUZ_ROOT.'./source/plugin/'.$_G['setting']['threadplugins'][$specialextra]['module'].'.class.php';
				$classname = 'threadplugin_'.$specialextra;
				if (class_exists($classname) && method_exists($threadpluginclass = new $classname, 'newreply_submit_end')) {
					$threadpluginclass->newreply_submit_end($_G['fid'], $_G['tid']);
				}
			}

			$_G['forum']['threadcaches'] && deletethreadcaches($_G['tid']);
			$param = array(
				'fid' 		=> $_G['fid'],
				'tid' 		=> $_G['tid'],
				'pid' 		=> $pid,
				'from' 		=> $_G['gp_from'],
				'sechash' 	=> ! empty($_G['gp_sechash']) ? $_G['gp_sechash'] : '');
			include_once libfile('function/stat');
			updatestat($thread['isgroup'] ? 'grouppost' : 'post');
			if ($modnewreplies) {
				unset($param['pid']);
				DB::query("UPDATE ".DB::table('forum_forum')." SET todayposts=todayposts+1, modworks='1' WHERE fid='$_G[fid]'", 'UNBUFFERED');

				//记录修改版块操作
				addrecordforuminfo($_G['fid'], 3);

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

					//记录修改版块操作
					addrecordforuminfo($_G['fid'], 3);
				}
			}
			$returnData['pid'] = $pid;
		}

		//加调试日志
		if (empty($returnData['pid'])) {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('m_doreply');

			$logMDoreply = array(
				'threadShow' => $thread,
				'post'       => $_POST,
			);
			$newlogs->log_array($logMDoreply, 'm_doreply');
		}

		//清除个人中心回复列表的缓存
		$memKey    = "cache_ucenter_reply_list_{$_G['uid']}_1";
		memory('rm', $memKey);

		encodeData($returnData);
	}

	function _check_allow_action($action = 'allowpost') {
		global $_G;
		if(isset($_G['forum'][$action]) && $_G['forum'][$action] == -1) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_access_disallow')));
		}
	}

	//发各种帖共用程序--源自source/module/forum/forum_post.php的action=newthread
	function _commonPost() {
		global $_G;

		if($_G['forum']['status'] == 3) {
			encodeData(array('error'=>true , 'errorinfo'=>"手机版驴友录暂未开放"));
		}

		//本版是否禁止发帖
		if(($_G['forum']['simple'] & 1) || $_G['forum']['redirect']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_disablepost')));
		}

		if($_G['gp_action'] == 'reply') {
			$this->_check_allow_action('allowreply');
		} else {
			$this->_check_allow_action('allowpost');
		}

		$space = array();
		space_merge($space, 'field_home');

		//note 当前时段是否允许发帖
		periodscheck_wap('postbanperiods');

		//权限判断
		if(empty($_G['forum']['allowview'])) {
			if(!$_G['forum']['viewperm'] && !$_G['group']['readaccess']) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nonexistence222', array('grouptitle' => $_G['group']['grouptitle']))));
			} elseif($_G['forum']['viewperm'] && !forumperm($_G['forum']['viewperm'])) {
				encodeData(array('error'=>true , 'errorinfo'=>showmessagenoperm_wap('viewperm', $_G['fid'])));
			}
		} elseif($_G['forum']['allowview'] == -1) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_access_view_disallow')));
		}

		//根据论坛权限公式计算用户权限
		if($_G['forum']['formulaperm']) {
			if ($message = formulaperm_wap($_G['forum']['formulaperm'])) {
				encodeData(array('error'=>true , 'errorinfo'=>$message));
			}
		}

		//note 论坛post权限检查: 新手实习期限
		if(!$_G['adminid'] && $_G['setting']['newbiespan'] && (!getuserprofile('lastpost') || TIMESTAMP - getuserprofile('lastpost') < $_G['setting']['newbiespan'] * 60)) {
			if(TIMESTAMP - (DB::result_first("SELECT regdate FROM ".DB::table('common_member')." WHERE uid='$_G[uid]'")) < $_G['setting']['newbiespan'] * 60) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_disablepost', array('newbiespan' => $_G['setting']['newbiespan']))));
			}
		}

		//note 附件相关设置
		$_G['forum']['allowpostattach'] = isset($_G['forum']['allowpostattach']) ? $_G['forum']['allowpostattach'] : '';
		$_G['group']['allowpostattach'] = $_G['forum']['allowpostattach'] != -1 && ($_G['forum']['allowpostattach'] == 1 || (!$_G['forum']['postattachperm'] && $_G['group']['allowpostattach']) || ($_G['forum']['postattachperm'] && forumperm($_G['forum']['postattachperm'])));
		$_G['forum']['allowpostimage'] = isset($_G['forum']['allowpostimage']) ? $_G['forum']['allowpostimage'] : '';
		$_G['group']['allowpostimage'] = $_G['forum']['allowpostimage'] != -1 && ($_G['forum']['allowpostimage'] == 1 || (!$_G['forum']['postimageperm'] && $_G['group']['allowpostimage']) || ($_G['forum']['postimageperm'] && forumperm($_G['forum']['postimageperm'])));
		$_G['group']['attachextensions'] = $_G['forum']['attachextensions'] ? $_G['forum']['attachextensions'] : $_G['group']['attachextensions'];
		if($_G['group']['attachextensions']) {
			$imgexts = explode(',', str_replace(' ', '', $_G['group']['attachextensions']));
			$imgexts = array_intersect(array('jpg','jpeg','gif','png','bmp'), $imgexts);
			$imgexts = implode(', ', $imgexts);
		} else {
			$imgexts = 'jpg, jpeg, gif, png, bmp';
		}
		$allowuploadnum = TRUE;
		if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
			if($_G['group']['maxattachnum']) {
				$allowuploadnum = $_G['group']['maxattachnum'] - DB::result_first("SELECT count(*) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND pid>'0' AND dateline>'$_G[timestamp]'-86400");
				$allowuploadnum = $allowuploadnum < 0 ? 0 : $allowuploadnum;
			}
			if($_G['group']['maxsizeperday']) {
				$allowuploadsize = $_G['group']['maxsizeperday'] - intval(DB::result_first("SELECT SUM(filesize) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400"));
				$allowuploadsize = $allowuploadsize < 0 ? 0 : $allowuploadsize;
				$allowuploadsize = $allowuploadsize / 1048576 >= 1 ? round(($allowuploadsize / 1048576), 1).'MB' : round(($allowuploadsize / 1024)).'KB';
			}
		}
		$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
		$enctype = ($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) ? 'enctype="multipart/form-data"' : '';
		$maxattachsize_mb = $_G['group']['maxattachsize'] / 1048576 >= 1 ? round(($_G['group']['maxattachsize'] / 1048576), 1).'MB' : round(($_G['group']['maxattachsize'] / 1024)).'KB';

		//note 一些页面变量的初始化
		$subject = $message = '';
		if ($_G['gp_subject']) {
			$subject  = iconv("utf-8","gbk//TRANSLIT",$_G['gp_subject']);
			$subject  = dhtmlspecialchars(censor_wap(trim($subject)));
			$subject  = str_replace("\t", ' ', $subject);
		}
		if ($_G['gp_message']) {
			$message  = iconv("utf-8","gbk//TRANSLIT",$_G['gp_message']);
			$message  = censor_wap($message);
		}

		$polloptions 	= isset($polloptions) ? censor_wap(trim($polloptions)) : '';
		$_G['setting']['tagstatus'] = $_G['setting']['tagstatus'] && $_G['forum']['allowtag'] ? ($_G['setting']['tagstatus'] == 2 ? 2 : $_G['forum']['allowtag']) : 0;

		//是否强制当前用户发表的主题进入审核
		if(periodscheck('postmodperiods', 0)) {
			$modnewthreads = $modnewreplies = 1;
		} else {
			$censormod = censormod($subject."\t".$message);
			$modnewthreads = (!$_G['group']['allowdirectpost'] || $_G['group']['allowdirectpost'] == 1) && $_G['forum']['modnewposts'] || $censormod ? 1 : 0;
			$modnewreplies = (!$_G['group']['allowdirectpost'] || $_G['group']['allowdirectpost'] == 2) && $_G['forum']['modnewposts'] == 2 || $censormod ? 1 : 0;
		}

		require_once libfile('class/censor');
		$censor = & discuz_censor::instance();
		if(!empty($_G['gp_attachnew'])) {
			foreach($_G['gp_attachnew'] as $key => $attachnew) {
				censor_wap($attachnew['description']);
				$censor->check($_G['gp_attachnew'][$key]['description']);
				if($censor->modmoderated()) {
					if(!$modnewthreads || !$modnewreplies) {
						$modnewthreads = $modnewreplies = 1;
					}
				}
			}
		}

		//note 发帖时是否显示验证码或者验证问答 ($_G['setting']['seccodestatus'] pos. -3)
		$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
		$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

		return array('message'=>$message, 'subject'=>$subject, 'modnewthreads'=>$modnewthreads, 'modnewreplies'=>$modnewreplies, 'seccodecheck'=>$seccodecheck, 'secqaacheck'=>$secqaacheck);
	}

	//发newthread共用程序--源自source/include/post/post_newthread.php
	function _commonNewthread() {
		global $_G;

		if ( empty( $_G['forum']['fid'] ) || $_G['forum']['type'] == 'group' ){
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_nonexistence')));
		}

		if ( ! $_G['uid'] && ! ( ( ! $_G['forum']['postperm'] && $_G['group']['allowpost'] ) || ( $_G['forum']['postperm'] && forumperm( $_G['forum']['postperm'] ) ) ) ){
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'postperm_login_nopermission')));
		}
		elseif ( empty( $_G['forum']['allowpost'] ) ){
			if ( ! $_G['forum']['postperm'] && ! $_G['group']['allowpost'] ){
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'postperm_none_nopermission')));
			}
			elseif ( $_G['forum']['postperm'] && ! forumperm( $_G['forum']['postperm'] ) ){
				encodeData(array('error'=>true , 'errorinfo'=>showmessagenoperm_wap('postperm', $_G['fid'], $_G['forum']['formulaperm'])));
			}
		}
		elseif ( $_G['forum']['allowpost'] == -1 ){
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_forum_newthread_nopermission')));
		}

		if ( ! $_G['uid'] && ( $_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'] ) ){
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'postperm_login_nopermission')));
		}

		$dianpingFids = array();
		foreach ($_G['config']['fids'] as $v) {
			$dianpingFids[$v] = $v;
		}
		if (isset($dianpingFids[$_G['fid']])){
			encodeData(array('error'=>true , 'errorinfo'=>'您请求的来路不正确，禁止访问！'));
		}

		//强制发特殊主题
		if($_G['forum']['allowspecialonly']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'group_nopermission', array('grouptitle' => $_G['group']['grouptitle']))));
		}

		checklowerlimit_wap( 'post', 0, 1, $_G['forum']['fid'] );
	}

	//发newreply共用程序--源自source/include/post/post_newreply.php
	function _commonNewreply() {
		global $_G;

		//获得帖子信息
		$threadtable = !empty($_G['forum']['threadtableid']) ? "forum_thread_{$_G['forum']['threadtableid']}" : 'forum_thread';
		$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'" . getSlaveID());
		$thread = $_G["forum_thread"] ? $_G["forum_thread"] : array();

		//限制点评访问
		if($_G['fid']==$_G['config']['fids']['brand']||$_G['fid']==$_G['config']['fids']['equipment']||$_G['fid']==$_G['config']['fids']['skiing']||$_G['fid']==$_G['config']['fids']['dianpu']||$_G['fid']==$_G['config']['fids']['mountain']||$_G['fid']==$_G['config']['fids']['line']||$_G['fid']==$_G['config']['fids']['shop']||$_G['fid']==$_G['config']['fids']['climb']){
			encodeData(array('error'=>true , 'errorinfo'=>'您请求的来路不正确，禁止访问！'));
		}
		require_once libfile('function/forumlist');
		$quotemessage    = '';
		if (! $_G['uid'] && ! ((! $_G['forum']['replyperm'] && $_G['group']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'])))) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'replyperm_login_nopermission')));
		} elseif (empty($_G['forum']['allowreply'])) {
			if (! $_G['forum']['replyperm'] && ! $_G['group']['allowreply']) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'replyperm_none_nopermission')));
			} elseif ($_G['forum']['replyperm'] && ! forumperm($_G['forum']['replyperm'])) {
				encodeData(array('error'=>true , 'errorinfo'=>showmessagenoperm_wap('replyperm', $_G['fid'])));
			}
		} elseif ($_G['forum']['allowreply'] == -1) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_forum_newreply_nopermission')));
		}
		if (! $_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'replyperm_login_nopermission')));
		}
		if (empty($thread)) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nonexistence')));
		} elseif ($thread['price'] > 0 && $thread['special'] == 0 && ! $_G['uid']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'group_nopermission', array('grouptitle' => $_G['group']['grouptitle']))));
		}
		if ($thread['special'] == 5) {
			$debate     = array_merge($thread, DB::fetch_first("SELECT * FROM ".DB::table('forum_debate')." WHERE tid='$_G[tid]'"));
			$standquery = DB::query("SELECT stand FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND uid='$_G[uid]' AND stand>'0' ORDER BY dateline LIMIT 1");
			$firststand = DB::result_first("SELECT stand FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND uid='$_G[uid]' AND stand>'0' ORDER BY dateline LIMIT 1");
			$stand      = $firststand ? $firststand : intval($_G['gp_stand']);
			if ($debate['endtime'] && $debate['endtime'] < TIMESTAMP) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'debate_end')));
			}
		}
		checklowerlimit_wap('reply', 0, 1, $_G['forum']['fid']);

		if ($_G['setting']['commentnumber'] && ! empty($_G['gp_comment'])) { //10  和  yes
			$posttable = getposttablebytid($_G['tid']); //返回论坛回复表的表名forum_post
			if (!submitcheck('commentsubmit', 0, $seccodecheck, $secqaacheck)) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
			}
			$post = DB::fetch_first('SELECT * FROM '.DB::table($posttable)." WHERE pid='$_G[gp_pid]'");
			if (!$post) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
			}
			if ($thread['closed'] && !$_G['forum']['ismoderator'] && !$thread['isgroup']) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_thread_closed')));
			} elseif (! $thread['isgroup'] && $post_autoclose = checkautoclose($thread)) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', $post_autoclose, array('autoclose' => $_G['forum']['autoclose']))));
			} elseif (checkflood()) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl', array('floodctrl' => $_G['setting']['floodctrl']))));
			} elseif (checkmaxpostsperhour()) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_flood_ctrl_posts_per_hour', array('posts_per_hour' => $_G['group']['maxpostsperhour']))));
			}
			$commentscore = '';
			$_G['gp_message'] = iconv("utf-8","gbk//TRANSLIT",$_G['gp_message']);
			$comment = cutstr(($commentscore ? $commentscore.'<br />' : '').censor_wap(trim(htmlspecialchars($_G['gp_message'])), '***'), 200, ' ');
			if (!$comment) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'post_sm_isnull')));
			}
			DB::insert('forum_postcomment', array(
				'tid' 		=> $post['tid'],
				'pid' 		=> $post['pid'],
				'author' 	=> $_G['username'],
				'authorid' 	=> $_G['uid'],
				'dateline' 	=> TIMESTAMP,
				'comment' 	=> $comment,
				'score' 	=> 0,
				'forpid' 	=> 0,
				'replyid' 	=> 0,
			));

			//添加点评之后将帖子回复表的comment字段赋值为1，代表该贴有评论
			DB::update($posttable, array('comment' => 1), "pid='$_G[gp_pid]'");

			//该行对积分进行更新操作，并通过Cookie通知界面弹出积分增减提示；
			updatepostcredits('+', $_G['uid'], 'reply', $_G['fid']);
			if ($_G['uid'] != $post['authorid']) {
				notification_add($post['authorid'], 'pcomment', 'comment_add', array(
					'tid' 		 => $post['tid'],
					'pid' 		 => $post['pid'],
					'subject' 	 => $thread['subject'],
					'commentmsg' => cutstr(str_replace(array(
						'[b]',
						'[/b]',
						'[/color]'), '', preg_replace("/\[color=([#\w]+?)\]/i", "", stripslashes($comment))), 200)));
			}
		}

		if ($thread['special'] == 127) {
			$posttable    = getposttablebytid($_G['tid']);
			$postinfo     = DB::fetch_first("SELECT message FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='1'");
			$sppos        = strrpos($postinfo['message'], chr(0).chr(0).chr(0));
			$specialextra = substr($postinfo['message'], $sppos + 3);
		}

		return $thread['special'] == 5 ? array('standquery'=>$standquery, 'stand'=>$stand, 'firststand'=>$firststand) : array();
	}

}
?>
