<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: post_newthread.php 22550 2011-05-12 05:21:39Z monkey $
 */
if ( ! defined( 'IN_DISCUZ' ) )
{
	exit( 'Access Denied' );
}


if ( empty( $_G['forum']['fid'] ) || $_G['forum']['type'] == 'group' )
{
	showmessage( 'forum_nonexistence' );
}

if ( ( $special == 1 && ! $_G['group']['allowpostpoll'] ) || ( $special == 2 && ! $_G['group']['allowposttrade'] ) || ( $special == 3 && ! $_G['group']['allowpostreward'] ) || ( $special == 4 && ! $_G['group']['allowpostactivity'] ) || ( $special == 5 && ! $_G['group']['allowpostdebate'] ) )
{
	showmessage( 'group_nopermission', null, array( 'grouptitle' => $_G['group']['grouptitle'] ), array( 'login' => 1 ) );
}
if ( ! $_G['uid'] && ! ( ( ! $_G['forum']['postperm'] && $_G['group']['allowpost'] ) || ( $_G['forum']['postperm'] && forumperm( $_G['forum']['postperm'] ) ) ) )
{
	showmessage( 'postperm_login_nopermission', null, array(), array( 'login' => 1 ) );
}
elseif ( empty( $_G['forum']['allowpost'] ) )
{
	if ( ! $_G['forum']['postperm'] && ! $_G['group']['allowpost'] )
	{
		showmessage( 'postperm_none_nopermission', null, array(), array( 'login' => 1 ) );
	}
	elseif ( $_G['forum']['postperm'] && ! forumperm( $_G['forum']['postperm'] ) )
	{
		showmessagenoperm( 'postperm', $_G['fid'], $_G['forum']['formulaperm'] );
	}
}
elseif ( $_G['forum']['allowpost'] == -1 )
{
	showmessage( 'post_forum_newthread_nopermission', null );
}

if ( ! $_G['uid'] && ( $_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'] ) )
{
	showmessage( 'postperm_login_nopermission', null, array(), array( 'login' => 1 ) );
}
if ( $_G['fid'] == $_G['config']['fids']['brand'] || $_G['fid'] == $_G['config']['fids']['equipment'] || $_G['fid'] == $_G['config']['fids']['skiing'] || $_G['fid'] == $_G['config']['fids']['shop'] || $_G['fid'] == $_G['config']['fids']['line'] )
{
	showmessage( '您请求的来路不正确，禁止访问！', null );
}
//禁止用户发帖操作（modify by zhanghongliang at 2012.4.27）
if ( $_G['fid'] == $_G['config']['fids']['zbfx'] )
{
	$forbidshare = DB::fetch_first( "SELECT * FROM " . DB::table( 'plugin_produce_publishers' ) . " WHERE uid = {$_G['uid']} and forbidshare = 1" );
	if ( $forbidshare )
	{
		showmessage( '您在本版块的发帖功能已被管理员禁止！', null );
	}
}
//end
checklowerlimit( 'post', 0, 1, $_G['forum']['fid'] );
if ( ! submitcheck( 'topicsubmit', 0, $seccodecheck, $secqaacheck ) )
{
	$isfirstpost = 1;
	$allownoticeauthor = 1;
	$tagoffcheck = '';
	$showthreadsorts = ! empty( $sortid ) || $_G['forum']['threadsorts']['required'] && empty( $special );

	if ( $special == 2 && $_G['group']['allowposttrade'] )
	{

		$expiration_7days = date( 'Y-m-d', TIMESTAMP + 86400 * 7 );
		$expiration_14days = date( 'Y-m-d', TIMESTAMP + 86400 * 14 );
		$trade['expiration'] = $expiration_month = date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ) + 1, date( 'd' ), date( 'Y' ) ) );
		$expiration_3months = date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ) + 3, date( 'd' ), date( 'Y' ) ) );
		$expiration_halfyear = date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ) + 6, date( 'd' ), date( 'Y' ) ) );
		$expiration_year = date( 'Y-m-d', mktime( 0, 0, 0, date( 'm' ), date( 'd' ), date( 'Y' ) + 1 ) );

	}
	elseif ( $specialextra )
	{

		$threadpluginclass = null;
		if ( isset( $_G['setting']['threadplugins'][$specialextra]['module'] ) )
		{
			$threadpluginfile = DISCUZ_ROOT . './source/plugin/' . $_G['setting']['threadplugins'][$specialextra]['module'] . '.class.php';
			if ( file_exists( $threadpluginfile ) )
			{
				@include_once $threadpluginfile;
				$classname = 'threadplugin_' . $specialextra;
				if ( class_exists( $classname ) && method_exists( $threadpluginclass = new $classname, 'newthread' ) )
				{
					$threadplughtml = $threadpluginclass->newthread( $_G['fid'] );
					$buttontext = lang( 'plugin/' . $specialextra, $threadpluginclass->buttontext );
					$iconfile = $threadpluginclass->iconfile;
					$iconsflip = array_flip( $_G['cache']['icons'] );
					$thread['iconid'] = $iconsflip[$iconfile];
				}
			}
		}

		if ( ! is_object( $threadpluginclass ) )
		{
			$specialextra = '';
		}
	}

	if ( $special == 4 )
	{
		$activity = array(
			'starttimeto' => '',
			'starttimefrom' => '',
			'place' => '',
			'class' => '',
			'cost' => '',
			'number' => '',
			'gender' => '',
			'expiration' => '',
			'nature' => '' );
		$activitytypelist = $_G['setting']['activitytype'] ? explode( "\n", trim( $_G['setting']['activitytype'] ) ) : '';

		require_once libfile('function/activity');
		//if(!checkUserBind($_G['uid'])) {
			//showmessage("需要绑定在外帐号后才能发布活动", "http://bbs.8264.com/forum-{$_G['fid']}-1.html");
		//}
		$activityNumberList = getActivityNumberList();
		$activityClubList   = getClubList();
		$tpllist = getformtpllist($_G['uid']); //根据当前用户的uid远程调取表单模板列表 gtl 20161129y
		//如果是创建状态设定默认值
		if(!empty($tpllist)){
			$tmptpl = current($tpllist);
			$activity['formid'] = $tmptpl['formid'];
		}
	}

	if ( $_G['group']['allowpostattach'] || $_G['group']['allowpostimage'] )
	{
		$attachlist = getattach( 0 );
		$attachs = $attachlist['attachs'];
		$imgattachs = $attachlist['imgattachs'];
		unset( $attachlist );
	}

	! isset( $attachs['unused'] ) && $attachs['unused'] = array();
	! isset( $imgattachs['unused'] ) && $imgattachs['unused'] = array();

	//若是装备交易板块，则默认$message
	if ($_G['fid'] == 53) {
		$message  = "转让\r\n";
		$message .= "品名：\r\n";
		$message .= "规格型号：\r\n";
		$message .= "新旧程度：\r\n";
		$message .= "有无瑕疵并说明：\r\n";
		$message .= "入手来源及时间：\r\n";
		$message .= "价格：\r\n";
		$message .= "含或不含运资转让价：\r\n";
		$message .= "是否可刀：\r\n";
		$message .= "是否有售后服务：\r\n";
		$message .= "是否支持淘宝：\r\n";
		$message .= "货品所在地：\r\n";
		$message .= "联系方式：\r\n";
		$message .= "转让原因：\r\n";
		$message .= "实物图片：\r\n";
	}

	//图片上传方式改为upyun form方式 by zhangwenchu 20170118
	require_once libfile('post/upyunform.inc', 'include');

	if ( $forumOption )
	{
		include $forumOption->hookScriptPost1();
	}
	else
	{
		getgpc( 'infloat' ) ? include template( 'forum/post_infloat' ) : include template( 'forum/post' );
	}
}
else
{
	set_time_limit(0);

	if ( trim( $subject ) == '' )
	{
		showmessage( 'post_sm_isnull' );
	}
	if ( ! $sortid && ! $special && trim( $message ) == '' )
	{
		//at 2012.1.6 by zhanghongliang
		if ( $_G['fid'] != $_G['config']['fids']['zbfx'] )
		{
			showmessage( 'post_sm_isnull' );
		}
	}
//	if ( strstr( $subject, '?' ) || strstr( $message, '?' ) )
//	{
//		showmessage( 'submit_invalid' );
//	}
	if ( $post_invalid = checkpost( $subject, $message, ( $special || $sortid ) ) )
	{
		showmessage( $post_invalid, '', array( 'minpostsize' => $_G['setting']['minpostsize'], 'maxpostsize' => $_G['setting']['maxpostsize'] ) );
	}
	if ( checkflood() )
	{
		showmessage( 'post_flood_ctrl', '', array( 'floodctrl' => $_G['setting']['floodctrl'] ) );
	}
	elseif ( checkmaxpostsperhour() )
	{
		showmessage( 'post_flood_ctrl_posts_per_hour', '', array( 'posts_per_hour' => $_G['group']['maxpostsperhour'] ) );
	}
	$_G['gp_save'] = $_G['uid'] ? $_G['gp_save'] : 0;

	$typeid = isset( $typeid ) && isset( $_G['forum']['threadtypes']['types'][$typeid] ) ? $typeid : 0;
	$displayorder = $modnewthreads ? -2 : ( ( $_G['forum']['ismoderator'] && ! empty( $_G['gp_sticktopic'] ) ) ? 1 : ( empty( $_G['gp_save'] ) ? 0 : -4 ) );

	//添加过滤
	$pattern = "[img=1,1";
	if ( strstr( $message, $pattern ) )
	{
		$displayorder = $modnewthreads = -2;
	}
	$pattern1 = "[flash=1,1";
	if ( strstr( $message, $pattern1 ) )
	{
		$displayorder = $modnewthreads = -2;
	}
	//end
	if ( $displayorder == -2 )
	{
		/* debug
		* $has_moderated = $_G['cookie']['has_moderated'];
		* $has_moderated_arr = explode('|', $has_moderated);
		* if(!in_array($_G['fid'], $has_moderated_arr)) {
		* $has_moderated_arr[] = $_G['fid'];
		* }
		* dsetcookie('has_moderated', implode('|', $has_moderated_arr), 86400);*/
		DB::update( 'forum_forum', array( 'modworks' => '1' ), "fid='{$_G['fid']}'" );
		//start 记录修改版块操作
		addrecordforuminfo( $_G['fid'], 3 );
		//end
	}
	elseif ( $displayorder == -4 )
	{
		$_G['gp_addfeed'] = 0;
	}
	$digest = ( $_G['forum']['ismoderator'] && ! empty( $_G['gp_addtodigest'] ) ) ? 1 : 0;
	$readperm = $_G['group']['allowsetreadperm'] ? $readperm : 0;
	$isanonymous = ( $_G['group']['allowanonymous'] && $_G['gp_isanonymous'] ) ? 1 : 0;
	$price = intval( $price );
	$price = $_G['group']['maxprice'] && ! $special ? ( $price <= $_G['group']['maxprice'] ? $price : $_G['group']['maxprice'] ) : 0;

	if ( ! $typeid && $_G['forum']['threadtypes']['required'] && ! $special )
	{
		showmessage( 'post_type_isnull' );
	}

	if ( ! $sortid && $_G['forum']['threadsorts']['required'] && ! $special )
	{
		showmessage( 'post_sort_isnull' );
	}

	if ( $price > 0 && floor( $price * ( 1 - $_G['setting']['creditstax'] ) ) == 0 )
	{
		showmessage( 'post_net_price_iszero' );
	}
	if ( $special == 1 )
	{

		$polloption = $_G['gp_tpolloption'] == 2 ? explode( "\n", $_G['gp_polloptions'] ) : $_G['gp_polloption'];
		$pollarray = array();
		foreach ( $polloption as $key => $value )
		{
			$polloption[$key] = censor( $polloption[$key] );
			if ( trim( $value ) === '' )
			{
				unset( $polloption[$key] );
			}
		}

		if ( count( $polloption ) > $_G['setting']['maxpolloptions'] )
		{
			showmessage( 'post_poll_option_toomany', '', array( 'maxpolloptions' => $_G['setting']['maxpolloptions'] ) );
		}
		elseif ( count( $polloption ) < 2 )
		{
			showmessage( 'post_poll_inputmore' );
		}

		$curpolloption = count( $polloption );
		$pollarray['maxchoices'] = empty( $_G['gp_maxchoices'] ) ? 0 : ( $_G['gp_maxchoices'] > $curpolloption ? $curpolloption : $_G['gp_maxchoices'] );
		$pollarray['multiple'] = empty( $_G['gp_maxchoices'] ) || $_G['gp_maxchoices'] == 1 ? 0 : 1;
		$pollarray['options'] = $polloption;
		$pollarray['visible'] = empty( $_G['gp_visibilitypoll'] );
		$pollarray['overt'] = ! empty( $_G['gp_overt'] );

		if ( preg_match( "/^\d*$/", trim( $_G['gp_expiration'] ) ) )
		{
			if ( empty( $_G['gp_expiration'] ) )
			{
				$pollarray['expiration'] = 0;
			}
			else
			{
				$pollarray['expiration'] = TIMESTAMP + 86400 * $_G['gp_expiration'];
			}
		}
		else
		{
			showmessage( 'poll_maxchoices_expiration_invalid' );
		}

	}
	elseif ( $special == 3 )
	{

		$rewardprice = intval( $_G['gp_rewardprice'] );
		if ( $rewardprice < 1 )
		{
			showmessage( 'reward_credits_please' );
		}
		elseif ( $rewardprice > 32767 )
		{
			showmessage( 'reward_credits_overflow' );
		}
		elseif ( $rewardprice < $_G['group']['minrewardprice'] || ( $_G['group']['maxrewardprice'] > 0 && $rewardprice > $_G['group']['maxrewardprice'] ) )
		{
			if ( $_G['group']['maxrewardprice'] > 0 )
			{
				showmessage( 'reward_credits_between', '', array( 'minrewardprice' => $_G['group']['minrewardprice'], 'maxrewardprice' => $_G['group']['maxrewardprice'] ) );
			}
			else
			{
				showmessage( 'reward_credits_lower', '', array( 'minrewardprice' => $_G['group']['minrewardprice'] ) );
			}
		}
		elseif ( ( $realprice = $rewardprice + ceil( $rewardprice * $_G['setting']['creditstax'] ) ) > getuserprofile( 'extcredits' . $_G['setting']['creditstransextra'][2] ) )
		{
			showmessage( 'reward_credits_shortage' );
		}
		$price = $rewardprice;

	}
	elseif ( $special == 4 )
	{
		$activitytime = 1;
		$_G['gp_activityplace'] = array_filter($_G['gp_activityplace']);

		if (! $_G['gp_activityplace']) {
			showmessage('activity_address_please');
		} elseif (empty($_G['gp_collectplace'])) {
			showmessage('activity_collectplace_please');
		}

		require_once libfile('function/activity');

		foreach ($_G['gp_activityplace'] as $k=>$v) {
			$_G['gp_activityplace'][$k] = dealActivityText($v, false);
		}

		$activity = array();
		$activity['cost'] 				= intval( $_G['gp_cost'] );
		$activity['starttimefrom'] 		= @strtotime( $_G['gp_starttimefrom'][$activitytime] );
		$activity['starttimefrom'] 		= intval($activity['starttimefrom']);
		$activity['starttimefrom_int'] 	= strtotime(date('Y-m-d', $activity['starttimefrom']));
		$activity['starttimeto'] 		= @strtotime( $_G['gp_starttimeto'] );
		$activity['starttimeto'] 		= intval($activity['starttimeto']);
		$activity['starttimeto_int'] 	= strtotime(date('Y-m-d', $activity['starttimeto']));
		$activity['timediff'] 			= floor(($activity['starttimeto_int'] - $activity['starttimefrom_int'])/86400) + 1;
		$activity['place'] 				= implode('，', $_G['gp_activityplace']);
		$activity['place'] 				= censor( dhtmlspecialchars( $activity['place'] ) );
		$activity['collectplace'] 		= censor( dhtmlspecialchars( trim( $_G['gp_collectplace'] ) ) );
		$activity['class'] 				= !empty($_G['gp_activityclass']) ? censor( dhtmlspecialchars( trim( $_G['gp_activityclass'] ) ) ) : '';
		$activity['gender'] 			= 0;
		$activity['number'] 			= intval( $_G['gp_activitynumber'] );
		$activity['expiration']     	= @strtotime( $_G['gp_activityexpiration'] );
		$activity['credit']         	= intval($_G['gp_activitycredit']);
		$activity['area'] 				= intval( $_G['gp_activityarea'] );
		$activity['nature'] 			= intval( $_G['gp_activitynature'] );
		$activity['lng'] 				= $_G['gp_lng'];
		$activity['lat'] 				= $_G['gp_lat'];
		$activity['lasttime'] 			= $_G['timestamp'];
		$activity['title'] 		    	= $activity['place'].$activity['class'].$activity['timediff'].'日';
		$activity['plat'] 		    	= 1;
		$activity['mobile'] 		= trim($_G['gp_activitymobile']);

		if (!$activity['starttimefrom']) {
			showmessage('对不起，请输入活动开始时间');
		} elseif (!$activity['starttimeto']) {
			showmessage('对不起，请输入活动结束时间');
		} elseif ($activity['starttimefrom'] > $activity['starttimeto']) {
			showmessage('对不起，活动的结束时间应晚于开始时间');
		} elseif (!$activity['expiration']) {
			showmessage('对不起，请输入报名截止时间');
		} elseif ($activity['expiration'] > $activity['starttimefrom']) {
			showmessage('对不起，报名截止日期应早于活动开始时间 ');
		} elseif (!$activity['class']) {
			showmessage('activity_sort_please');
		} elseif (!$activity['nature']) {
			showmessage('对不起，请选择活动性质');
		} elseif ($activity['nature'] == 2 && !$activity['cost']) {
			showmessage('对不起，请输入每人花销');
		} elseif (!$activity['lat'] || !$activity['lng']) {
			showmessage('activity_collectplace_please');
		}

		//设置俱乐部
		$activity['clubname'] = censor( dhtmlspecialchars( trim( $_G['gp_clubname'] ) ) );
		$activity['clubname'] = dealActivityText($activity['clubname']);
		$activity['clubid']   = setClubList($activity['clubname']);

		//更新在外app目的地库
		setZaiwaiPlace($_G['gp_activityplace']);

		//统计地方版版块下有效的活动数量
		if ($_G['forum']['nfup'] == 76) {
			setCityNum($_G['fid']);
		}

		if ($activity['credit'] > 0)
		{
			$subject .= '[' . $activity['collectplace'] . ']';
		}
		//新版报名模板
		$tpllist = getformtpllist($_G['uid']);
		if(!$_POST['formid'] || !$tpllist || !isset($tpllist[$_POST['formid']])){
			showmessage('请选择或创建一个新表单 ');
		}
		$activity['formid'] = $_POST['formid'];
		$activity['ufield'] = addslashes($tpllist[$_POST['formid']]['formfields']);
/*		//旧版报名模板
		$extfield = $_G['gp_extfield'];
		$extfield = explode( "\n", $_G['gp_extfield'] );
		foreach ( $extfield as $key => $value )
		{
			$extfield[$key] = censor( trim( $value ) );
			if ( $extfield[$key] === '' || is_numeric( $extfield[$key] ) )
			{
				unset( $extfield[$key] );
			}
		}
		$extfield = array_unique( $extfield );
		if ( count( $extfield ) > $_G['setting']['activityextnum'] )
		{
			showmessage( 'post_activity_extfield_toomany', '', array( 'maxextfield' => $_G['setting']['activityextnum'] ) );
		}

		$userfield = array('0'=>"realname", '1'=>'mobile', '2'=>'field3');
		$idcard    = intval($_G['gp_idcard']);
		if ($idcard > 0) {
			$userfield[] = 'idcard';
		}
		if ($activity['credit'] > 0) {
			$userfield[] = 'address';
		}
		$activity['ufield'] = array( 'userfield' => $userfield, 'extfield' => $extfield );
		$activity['ufield'] = serialize( $activity['ufield'] );
*/
		//活动贴不包括自定义的和有奖活动，重新组织标题
//		if (!($activity['credit'] || $_G['member']['adminid'] == 1)) {
//			$subject = resetActivitySubject($activity);
//		}
		unset($activity['starttimefrom_int'], $activity['starttimeto_int']);
	}
	elseif ( $special == 5 )
	{

		if ( empty( $_G['gp_affirmpoint'] ) || empty( $_G['gp_negapoint'] ) )
		{
			showmessage( 'debate_position_nofound' );
		}
		elseif ( ! empty( $_G['gp_endtime'] ) && ( ! ( $endtime = @strtotime( $_G['gp_endtime'] ) ) || $endtime < TIMESTAMP ) )
		{
			showmessage( 'debate_endtime_invalid' );
		}
		elseif ( ! empty( $_G['gp_umpire'] ) )
		{
			if ( ! DB::result_first( "SELECT COUNT(*) FROM " . DB::table( 'common_member' ) . " WHERE username='$_G[gp_umpire]'" ) )
			{
				$_G['gp_umpire'] = dhtmlspecialchars( $_G['gp_umpire'] );
				showmessage( 'debate_umpire_invalid', '', array( 'umpire' => $umpire ) );
			}
		}
		$affirmpoint = censor( dhtmlspecialchars( $_G['gp_affirmpoint'] ) );
		$negapoint = censor( dhtmlspecialchars( $_G['gp_negapoint'] ) );
		$stand = censor( intval( $_G['gp_stand'] ) );

	}
	elseif ( $specialextra )
	{

		@include_once DISCUZ_ROOT . './source/plugin/' . $_G['setting']['threadplugins'][$specialextra]['module'] . '.class.php';
		$classname = 'threadplugin_' . $specialextra;
		if ( class_exists( $classname ) && method_exists( $threadpluginclass = new $classname, 'newthread_submit' ) )
		{
			$threadpluginclass->newthread_submit( $_G['fid'] );
		}
		$special = 127;
	}
	$sortid = $special && $_G['forum']['threadsorts']['types'][$sortid] ? 0 : $sortid;
	$typeexpiration = intval( $_G['gp_typeexpiration'] );

	if ( $_G['forum']['threadsorts']['expiration'][$typeid] && ! $typeexpiration )
	{
		showmessage( 'threadtype_expiration_invalid' );
	}
	$_G['forum_optiondata'] = array();
	if ( $_G['forum']['threadsorts']['types'][$sortid] && ! $_G['forum']['allowspecialonly'] )
	{
		$_G['forum_optiondata'] = threadsort_validator( $_G['gp_typeoption'], $pid );
	}
	$author = ! $isanonymous ? $_G['username'] : '';
	$moderated = $digest || $displayorder > 0 ? 1 : 0;
	$thread['status'] = 0;
	$_G['gp_ordertype'] && $thread['status'] = setstatus( 4, 1, $thread['status'] );
	$_G['gp_hiddenreplies'] && $thread['status'] = setstatus( 2, 1, $thread['status'] );
	if ( $_G['group']['allowpostrushreply'] && $_G['gp_rushreply'] )
	{
		$thread['status'] = setstatus( 3, 1, $thread['status'] );
		$thread['status'] = setstatus( 1, 1, $thread['status'] );
	}

	$_G['gp_allownoticeauthor'] && $thread['status'] = setstatus( 6, 1, $thread['status'] );
	$isgroup = $_G['forum']['status'] == 3 ? 1 : 0;
	$posttableid = getposttableid( 'p' );
	$attachment  = $_G['gp_imgselect'] ? 2 : 0;

	DB::query( "INSERT INTO " . DB::table( 'forum_thread' ) . " (fid, posttableid, readperm, price, typeid, sortid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup)
		VALUES ('$_G[fid]', '$posttableid', '$readperm', '$price', '$typeid', '$sortid', '$author', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$author', '$displayorder', '$digest', '$special', '$attachment', '$moderated', '$thread[status]', '$isgroup')" );
	$tid = DB::insert_id();
	$typeid > 0 && DB::query( "UPDATE " . DB::table( 'forum_threadclass' ) . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED' );

	if ( $forumOption )
	{
		$forumOption->hookScriptPost2( $subject, $tid );
	}
	//更新空间动态
	DB::update( 'common_member_field_home', array( 'recentnote' => $subject ), array( 'uid' => $_G['uid'] ) );

	if ( $special == 3 && $_G['group']['allowpostreward'] )
	{
		updatemembercount( $_G['uid'], array( $_G['setting']['creditstransextra'][2] => -$realprice ), 1, 'RTC', $tid );
	}
	if ( $moderated )
	{
		updatemodlog( $tid, ( $displayorder > 0 ? 'STK' : 'DIG' ) );
		updatemodworks( ( $displayorder > 0 ? 'STK' : 'DIG' ), 1 );
	}

	if ( $special == 1 )
	{
		foreach ( $pollarray['options'] as $polloptvalue )
		{
			$polloptvalue = dhtmlspecialchars( trim( $polloptvalue ) );
			DB::query( "INSERT INTO " . DB::table( 'forum_polloption' ) . " (tid, polloption) VALUES ('$tid', '$polloptvalue')" );
		}
		$polloptionpreview = '';
		$query = DB::query( "SELECT polloption FROM " . DB::table( 'forum_polloption' ) . " WHERE tid='$tid' ORDER BY displayorder LIMIT 2" );
		while ( $option = DB::fetch( $query ) )
		{
			$polloptvalue = preg_replace( "/\[url=(https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k|thunder|synacast){1}:\/\/([^\[\"']+?)\](.+?)\[\/url\]/i", "<a href=\"\\1://\\2\" target=\"_blank\">\\3</a>", $option['polloption'] );
			$polloptionpreview .= $polloptvalue . "\t";
		}

		$polloptionpreview = daddslashes( $polloptionpreview );
		DB::query( "INSERT INTO " . DB::table( 'forum_poll' ) . " (tid, multiple, visible, maxchoices, expiration, overt, pollpreview)
			VALUES ('$tid', '$pollarray[multiple]', '$pollarray[visible]', '$pollarray[maxchoices]', '$pollarray[expiration]', '$pollarray[overt]', '$polloptionpreview')" );

	}
	elseif ( $special == 4 && $_G['group']['allowpostactivity'] )
	{

		$activity['tid'] = $tid;
		$activity['uid'] = $_G['uid'];
		$activity['aid'] = $_G['gp_activityaid'];

		DB::insert('forum_activity', $activity);

		//地方板块同步活动到hd.8264.com开始，加商业活动，线路
		$local_plate_fids=array('5','158','101','166','113','110','112','108','176','117','104','106','164','114','159','116','109','111','115','170','143','177','103','165','107','48','102','100','171','105','147');
		if(in_array($_G['fid'],$local_plate_fids)&&$activity['credit']==0){

			// 将活动tid添加入队列，等待发送给hd.8264.com
				require_once libfile('class/myredis');
				$redis = & myredis::instance(6381);

				if($redis->connected) {
					$redis->obj->rpush('thread_activity', $tid);
				}

		}
		//地方板块同步活动到hd.8264.com结束


	}
	elseif ( $special == 5 && $_G['group']['allowpostdebate'] )
	{
		DB::query( "INSERT INTO " . DB::table( 'forum_debate' ) . " (tid, uid, starttime, endtime, affirmdebaters, negadebaters, affirmvotes, negavotes, umpire, winner, bestdebater, affirmpoint, negapoint, umpirepoint)
			VALUES ('$tid', '$_G[uid]', '$_G[timestamp]', '$endtime', '0', '0', '0', '0', '$_G[gp_umpire]', '', '', '$affirmpoint', '$negapoint', '')" );

	}
	elseif ( $special == 127 )
	{

		$message .= chr( 0 ) . chr( 0 ) . chr( 0 ) . $specialextra;

	}

	if ( $_G['forum']['threadsorts']['types'][$sortid] && ! empty( $_G['forum_optiondata'] ) && is_array( $_G['forum_optiondata'] ) )
	{
		$filedname = $valuelist = $separator = '';
		foreach ( $_G['forum_optiondata'] as $optionid => $value )
		{
			if ( ( $_G['forum_optionlist'][$optionid]['search'] || in_array( $_G['forum_optionlist'][$optionid]['type'], array(
				'radio',
				'select',
				'number' ) ) ) && $value )
			{
				$filedname .= $separator . $_G['forum_optionlist'][$optionid]['identifier'];
				$valuelist .= $separator . "'$value'";
				$separator = ' ,';
			}

			if ( $_G['forum_optionlist'][$optionid]['type'] == 'image' )
			{
				$identifier = $_G['forum_optionlist'][$optionid]['identifier'];
				$sortaid = intval( $_G['gp_typeoption'][$identifier]['aid'] );
			}

			DB::query( "INSERT INTO " . DB::table( 'forum_typeoptionvar' ) . " (sortid, tid, fid, optionid, value, expiration)
				VALUES ('$sortid', '$tid', '$_G[fid]', '$optionid', '$value', '" . ( $typeexpiration ? TIMESTAMP + $typeexpiration : 0 ) . "')" );
		}

		if ( $filedname && $valuelist )
		{
			DB::query( "INSERT INTO " . DB::table( 'forum_optionvalue' ) . "$sortid ($filedname, tid, fid) VALUES ($valuelist, '$tid', '$_G[fid]')" );
		}
	}

	$bbcodeoff = checkbbcodes( $message, ! empty( $_G['gp_bbcodeoff'] ) );
	$smileyoff = checksmilies( $message, ! empty( $_G['gp_smileyoff'] ) );
	$parseurloff = ! empty( $_G['gp_parseurloff'] );
	$htmlon = bindec( ( $_G['setting']['tagstatus'] && ! empty( $tagoff ) ? 1 : 0 ) . ( $_G['group']['allowhtml'] && ! empty( $_G['gp_htmlon'] ) ? 1 : 0 ) );
	$usesig = ! empty( $_G['gp_usesig'] ) && $_G['group']['maxsigsize'] ? 1 : 0;
	/**
	 * 新增用于图片附件的处理，当插入三张后，剩余的图片，将不用附件形式展现，而且继续保存在未使用中。
	 * 2012-08-29 jianghong
	 * $send_img：提交的帖子中图片，不包含附件
	 */
	$new_img_edit = $_G['gp_attachnew'];
	if ( preg_match( '/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $message ) )
	{
		preg_match_all( '/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $message, $matches );
		$send_img = $matches[2];
		foreach ( $new_img_edit as $key => $descon )
		{
			if ( ! in_array( $key, $send_img ) )
			{
				unset( $new_img_edit[$key] );
			}
		}
	}
	else
	{
		unset( $new_img_edit );
	}
	//$new_img_edit=$_G['fid']==64?$new_img_edit:$_G['gp_attachnew'];
	/**
	 * 以上修改部分
	 */
	$pinvisible = $modnewthreads ? -2 : ( empty( $_G['gp_save'] ) ? 0 : -3 );
	$message = preg_replace( '/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $message );
	$message = trim( $message );

	//若是AA相约板块，则对message加进联系方式项
	if ($_G['fid'] == 161 && $_G["gp_contact"]) {
		$message .= "\r\n联系方式：[contact]{$_G["gp_contact"]}[/contact]";
	}

	if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) {
		//增加@功能
		require_once libfile("class/at");
		$at = new at;
		$message = $at->parse($message);
		if($at->atlist) { $bbcodeoff = 0; }
	}

	$pid = insertpost( array(
		'fid' => $_G['fid'],
		'tid' => $tid,
		'first' => '1',
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
		'attachment' => $attachment,
		'tags' => implode( ',', $tagarray ),
		) );
	//start 记录发帖信息
	$parr = array(
		'tid' => $tid,
		'pid' => $pid,
		'uid' => $_G['uid'],
		'username' => $_G['username'],
		'fid' => $_G['fid'],
		'name' => $_G['forum']['name'], // lxp 20140126
		'subject' => $subject,
		'message' => $message,
		'ip' => $_G['clientip'] );
	addrecordthread( $parr, 1 );
	//end

	if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) {
		// 发送@提醒
		$at->thread = array('tid' => $tid, 'pid' => $pid, 'subject' => $subject);
		$at->notice();
	}

	//2012-06-28 by jianghong 用于发帖查询是否存在品牌，存在则需要放入相应的缓存队列表中
	if ( $_G['fid'] == 7 || $_G['fid'] == 120 || $_G['fid'] == 174 || $_G['fid'] == 378 )
	{
		$type_pro = ( $_G['fid'] == 7 || $_G['fid'] == 120 ) ? "zb" : "dzty";
		$search_arr = array( $subject, $message );
		$produce_info = $forumOption->get_produce_id_arr( $search_arr );
		if ( $produce_info )
		{
			for ( $dl_i = 0; $dl_i < count( $produce_info ); $dl_i++ )
			{
				$newthread = array(
					'pid' => $pid,
					'tid' => $produce_info[$dl_i],
					'type' => $type_pro,
					'dateline' => time() );
				$forumOption->produce_update_cache_all( $newthread, 'brand', 0 ); //将发的新帖子，与关联的品牌放入总缓存表中永久保存
				$forumOption->update_cache_produce( $produce_info[$dl_i], $type_pro ); //更新缓存队列
			}
		}
	}
	//以上为新增2012-06-28
	if ( $pid && getstatus( $thread['status'], 1 ) )
	{
		savepostposition( $tid, $pid );
	}

	if ( $special == 4 && $_G['gp_activityaid'] )
	{
		DB::query( "UPDATE " . DB::table( 'forum_attachment' ) . " SET tid='$tid', pid='$pid' WHERE aid='$_G[gp_activityaid]' AND uid='$_G[uid]'" );
	}

	if ( $_G['forum']['threadsorts']['types'][$sortid] && ! empty( $_G['forum_optiondata'] ) && is_array( $_G['forum_optiondata'] ) && $sortaid )
	{
		DB::query( "UPDATE " . DB::table( 'forum_attachment' ) . " SET tid='$tid', pid='$pid' WHERE aid='$sortaid'" );
	}
	( $_G['group']['allowpostattach'] || $_G['group']['allowpostimage'] ) && ( $_G['gp_attachnew'] || $_G['gp_attachdel'] || $sortid || ! empty( $_G['gp_activityaid'] ) ) && updateattach( $postattachcredits, $tid, $pid, $new_img_edit, $_G['gp_attachdel'] );

	include_once libfile('function/previewimg');
	update_previewimg($pid);

	$param = array(
		'fid' => $_G['fid'],
		'tid' => $tid,
		'pid' => $pid );

	$statarr = array(
		0 => 'thread',
		1 => 'poll',
		2 => 'trade',
		3 => 'reward',
		4 => 'activity',
		5 => 'debate',
		127 => 'thread' );
	include_once libfile( 'function/stat' );
	updatestat( $isgroup ? 'groupthread' : $statarr[$special] );

	if ( $modnewthreads )
	{
		DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED' );
		//start 记录修改版块操作
		addrecordforuminfo( $_G['fid'], 3 );
		//end
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
			'type'      => $special == 4 ? 6 : 1,
			'dateline'  => $_G[timestamp],
			'subject'   => $special == 4 ? '发布了新活动' : '发布了新帖子',
			'message'   => $message,
			'username'  => $author,
			'authorid'  => $_G['uid'],
			'htmlon'    => $htmlon,
			'bbcodeoff' => $bbcodeoff,
			'smileyoff' => $smileyoff,
			'title'     => $subject,
		);

		require_once libfile('function/feed');
		feed_add_ucenter($feedarr);

		if ( $specialextra )
		{

			$classname = 'threadplugin_' . $specialextra;
			if ( class_exists( $classname ) && method_exists( $threadpluginclass = new $classname, 'newthread_submit_end' ) )
			{
				$threadpluginclass->newthread_submit_end( $_G['fid'], $tid );
			}
		}
		if ( $digest )
		{
			updatepostcredits( '+', $_G['uid'], 'digest', $_G['fid'] );
		}
		updatepostcredits( '+', $_G['uid'], 'post', $_G['fid'] );
		if ( $isgroup )
		{
			DB::query( "UPDATE " . DB::table( 'forum_groupuser' ) . " SET threads=threads+1, lastupdate='" . TIMESTAMP . "' WHERE uid='$_G[uid]' AND fid='$_G[fid]'" );
		}
		if ( $displayorder != -4 )
		{
			$subject = str_replace( "\t", ' ', $subject );
			$lastpost = "$tid\t$subject\t$_G[timestamp]\t$author";
			/*修改2011-09-05 16:22 by 孟津*/
			if ( $_G['fid'] == $_G['config']['fids']['mudidi'] )
				DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost', threads=threads+1, posts=posts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED' );
			else
				DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost', threads=threads+1, posts=posts+1, todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED' );

			if ( $_G['forum']['type'] == 'sub' )
			{
				DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost' WHERE fid='" . $_G['forum'][fup] . "'", 'UNBUFFERED' );
			}
			//start 记录修改版块操作
			addrecordforuminfo( $_G['fid'], 3 );
			//end
		}

		if ( $_G['forum']['status'] == 3 )
		{
			require_once libfile( 'function/group' );
			updateactivity( $_G['fid'], 0 );
			require_once libfile( 'function/grouplog' );
			updategroupcreditlog( $_G['fid'], $_G['uid'] );
		}
		if ( $_G['fid'] == $_G['config']['fids']['dianpu'] )
		{
			showmessage( '您的店铺进入审核状态，请耐心等待!', $_G['config']['web']['forum'] . "forum-" . $_G['config']['fids']['dianpu'] . "-1.html", $param );
		}
		elseif ( $_G['fid'] == $_G['config']['fids']['skiing'] )
		{
			showmessage( '滑雪场信息进入审核状态，请耐心等待!', $_G['config']['web']['forum'] . "forum-" . $_G['config']['fids']['skiing'] . "-1.html", $param );
		}
		elseif ( $_G['fid'] == $_G['config']['fids']['produce'] )
		{
			showmessage( '品牌信息进入审核状态，请耐心等待!', $_G['config']['web']['forum'] . "forum-" . $_G['config']['fids']['produce'] . "-1.html", $param );
		}
		else
		{
			//当发布活动时 页面提示
			$extraparam = array();
			if($special == 4){
				$extraparam['header'] = false;
				$extraparam['refreshtime'] = 1000;
				$extraparam['wechatshare'] = $activity['timediff'] <= 3 ? urlencode("http://wei.zaiwai.com/?d=forum&c=activity&m=activity_info&tid={$tid}") : "{$_G['config']['web']['mobile']}thread-{$tid}.html";

				$extraparam['tid']    = $tid;
				$extraparam['info_activity'] = "发布成功";

				//手机号hd认领条数
				if(trim($_G['gp_activitymobile'])&&trim($_G['gp_activitymobileclaimnum'])){
					$extraparam['hdmobile'] = trim($_G['gp_activitymobile']);
					$extraparam['hdmobile_claimnum'] = trim($_G['gp_activitymobileclaimnum']);
				}

				//获得关注分组
				require_once libfile('function/friend');
				$extraparam['groups'] = friend_group_list();
			}

			//当是旅游攻略板块时，页面提示
			if($_G['fid'] == 52){
				$extraparam['header'] = false;
				$extraparam['refreshtime'] = 1000;
				$extraparam['wechatshare'] = "{$_G['config']['web']['mobile']}thread-{$tid}-1.html?hasfid={$_G['fid']}";

				$extraparam['tid']    = $tid;
				$extraparam['fid']    = 52;
				$extraparam['info_activity'] = "发布成功";
			}

			showmessage( 'post_newthread_succeed', "forum.php?mod=viewthread&tid=$tid&extra=$extra", $param, $extraparam );
		}

	}
}

?>
