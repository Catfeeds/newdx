<?php

/**
 * @author JiangHong
 * 图片分楼
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

//绑定手机才能操作
if(!$_G['member']['telstatus']) {
	showmessage('bindtel_tips', 'http://u.8264.com/home-setting.html#account-security');
}

$allowgroup = unserialize($_G['cache']['plugin']['picupload']['postgroup']);
$allowforum = unserialize($_G['cache']['plugin']['picupload']['postforum']);
if($_G['groupid']==1 || in_array($_G['groupid'] , $allowgroup)){
	$fid = $_G['gp_fid'];
    include libfile('function/forum');
    loadforum();
    set_rssauth();
    runhooks();
	if(!in_array($fid , $allowforum)){
		showmessage('当前版块 ( '.$_G['forum']['name'].' ) 未开放此功能。', NULL);
	}
    $_G['gp_action'] = $_G['gp_action'] ? $_G['gp_action'] : 'newthread';
    $isfirstpost = $_G['gp_action']=='newthread';
    $ajaxper = $_G['cache']['plugin']['picupload']['ajaxper'] > 0 ? $_G['cache']['plugin']['picupload']['ajaxper'] : 500;
    include libfile('function/post');
    if(!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
        showmessage('postperm_login_nopermission', NULL, array(), array('login' => 1));
    } elseif(empty($_G['forum']['allowpost'])) {
    	if(!$_G['forum']['postperm'] && !$_G['group']['allowpost']) {
    		showmessage('postperm_none_nopermission', NULL);
    	} elseif($_G['forum']['postperm'] && !forumperm($_G['forum']['postperm'])) {
            include libfile('function/forum');
    		showmessagenoperm('postperm', $_G['fid'], $_G['forum']['formulaperm']);
    	}
    } elseif($_G['forum']['allowpost'] == -1) {
    	showmessage('post_forum_newthread_nopermission', NULL);
    }
	$maxpic = $_G['cache']['plugin']['picupload']['maxpic'] > 0 ? $_G['cache']['plugin']['picupload']['maxpic'] : 50;
    if($_G['cache']['plugin']['picupload']['useajax'] && $_G['gp_inajax']){
        include template('common/header_ajax');
        include template('picupload:upload_index_ajax');
        include template('common/footer_ajax');
    }elseif(!$_G['cache']['plugin']['picupload']['useajax'] && !$_G['gp_inajax']){
        $navtitle = $_G['gp_action']=='newthread' ? lang('core', 'title_newthread_post') : lang('core' , 'title_reply_post');
        $_G['gp_action'] == 'reply' && $thread = DB::fetch_first("SELECT * FROM ".DB::table("forum_thread")." WHERE tid = '$_G[gp_tid]';");
		$returnurl = 'forum.php?mod=forumdisplay&fid='.$_G['fid'].(!empty($_G['gp_extra']) ? '&'.preg_replace("/^(&)*/", '', $_G['gp_extra']) : '');
        $navigation = '';
        //$navigation = '<em>&rsaquo;</em><a href="'.$returnurl.'">'.$_G['forum']['name'].'</a> '.$navigation.'<em>&rsaquo;</em>';
        $navigation .= $_G['gp_action']=='newthread' ? lang('core', 'title_newthread_post') : lang('core' , 'title_reply_post');
        $navtitle .= ' - '.$_G['forum']['name'].' - 图片分楼发帖';
        /*相册相关的信息*/
        // require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
        // $attachserver = new attachserver;
        // $alldomain = $attachserver->get_server_domain('all');
        // require_once libfile('function/home');
        $query = DB::query("SELECT albumid , albumname , picnum FROM ".DB::table('home_album')." WHERE uid = '{$_G['uid']}'");
        $albumlist = array();
        while($values = DB::fetch($query)){
            $albumlist[] = $values;
        }
        /*结束*/

		require_once libfile('post/upyunform.inc', 'include');


		include template('picupload:upload_index');

    }else{
        if(!$_G['gp_inajax']){
            showmessage('意外错误，请您重新进入此版区，<a href="forum.php?mod=forumdisplay&fid={$fid}"><strong><font color="red">点击进入</font></strong></a>',"forum.php?mod=forumdisplay&fid={$fid}",array(),array());
        }
        $err_message = <<<EOF
    意外错误，请您重新进入此版区，<a href="forum.php?mod=forumdisplay&fid={$fid}"><strong><font color="red">点击进入</font></strong></a>。
EOF;
        include $_G['gp_inajax'] ? template('common/header_ajax') : template('common/header');
        include template('picupload:userlogin');
        include $_G['gp_inajax'] ? template('common/footer_ajax') : template('common/footer');
    }
}else{
    // showmessage('postperm_login_nopermission', NULL, array(), array('login' => 1));
    showmessage('您当前的用户组 ( '.$_G['group']['grouptitle'].' )，不能执行此操作。', NULL);
}
?>
