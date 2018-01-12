<?php

/**
 * @author JiangHong
 * 接受提交的数据
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
/*定义最大发图数量*/
$maxpic = $_G['cache']['plugin']['picupload']['maxpic'] > 0 ? $_G['cache']['plugin']['picupload']['maxpic'] : 50;
if($_G['groupid']!=1) showmessage('postperm_login_nopermission', NULL, array(), array('login' => 1));
if ($_G['formhash'] != $_G['gp_formhash']){
	showmessage('submit_invalid');
}
if (empty($_G['gp_fid'])) {
    showmessage('forum_nonexistence');
}
if (!$_G['uid'])
    showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
$_G['fid'] = $_G['gp_fid'];
include libfile('function/forum');
include libfile('function/post');
loadforum();
set_rssauth();
runhooks();
showmessagenoperm('postperm', $_G['fid'], $_G['forum']['formulaperm']);
//loadcache('forums');
//$_G['forum'] = $_G['cache']['forums'][$_G['fid']];
if (!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) ||
    ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
    showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
} elseif (empty($_G['forum']['allowpost'])) {
    if (!$_G['forum']['postperm'] && !$_G['group']['allowpost']) {
        showmessage('postperm_none_nopermission', null, array(), array('login' => 1));
    } elseif ($_G['forum']['postperm'] && !forumperm($_G['forum']['postperm'])) {
        showmessagenoperm('postperm', $_G['fid'], $_G['forum']['formulaperm']);
    }
} elseif ($_G['forum']['allowpost'] == -1) {
    showmessage('post_forum_newthread_nopermission', null);
}

if (!$_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] ||
    $_G['setting']['need_friendnum'])) {
    showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
}
checklowerlimit('post', 0, 1, $_G['forum']['fid']);
if (!$_G['adminid'] && $_G['setting']['newbiespan'] && (!getuserprofile('lastpost') ||
    TIMESTAMP - getuserprofile('lastpost') < $_G['setting']['newbiespan'] * 60)) {
    if (TIMESTAMP - (DB::result_first("SELECT regdate FROM " . DB::table('common_member') .
        " WHERE uid='$_G[uid]'")) < $_G['setting']['newbiespan'] * 60) {
        showmessage('post_newbie_span', '', array('newbiespan' => $_G['setting']['newbiespan']));
    }
}
$postimage = $_G['gp_attachnew'];
if (empty($postimage))
    showmessage($_G['cache']['plugin']['picupload']['nopic_upload'] ? $_G['cache']['plugin']['picupload']['nopic_upload'] :
        '没有提交任何图片,不能进行分楼操作');
$subject = $_G['gp_subject'];
$typeid = $_G['gp_typeid'];
$posttime = $_G['gp_posttime'];
$action = $_G['gp_action'] ? $_G['gp_action'] : 'reply';
$tid = $_G['gp_tid'] ? $_G['gp_tid'] : 0;
if ($action == 'replay' && $tid == 0) {
    showmessage('undefined_action', null);
}
if (trim($subject) == '') {
    showmessage('post_sm_isnull');
}
if ($action == 'newthread' && strlen($subject) > 80)
    showmessage('post_subject_toolong', null);
if ($_G['forum']['threadtypes'] && $typeid == 0)
    showmessage('post_sort_isnull', null);
$first = 0;
$deleteattach = array();
if (checkflood()) {
    showmessage('post_flood_ctrl', '', array('floodctrl' => $_G['setting']['floodctrl']));
} elseif (checkmaxpostsperhour()) {
    showmessage('post_flood_ctrl_posts_per_hour', '', array('posts_per_hour' => $_G['group']['maxpostsperhour']));
}

$readperm = $_G['group']['allowsetreadperm'] ? $readperm : 0;
$usesig = !empty($_G['gp_usesig']) && $_G['group']['maxsigsize'] ? 1 : 0;
/*引入水印包*/
if ($_G['setting']['watermarkstatus'] && empty($_G['forum']['disablewatermark'])) {
    require_once libfile('class/image');
    $image = new image;
    /*引入附件服务器信息，以便进行水印处理*/
    require_once DISCUZ_ROOT . "./source/plugin/attachment_server/attachment_server.class.php";
    $attachserver = new attachserver;
    $all_serverinfo = $attachserver->get_server_domain('all', '*');
    /*结束*/
}
$allimage = $_G['gp_attachimage'];
$query = DB::query("SELECT * FROM " . DB::table('forum_attachment') . " WHERE aid IN(" . dimplode($allimage) . ");");
while ($value = DB::fetch($query)) {
    $attach[$value['aid']] = $value;
}
$newalbum = 0;
if ($_G['gp_savetoalbum']){
    if(!$_G['gp_albumid']){
        require_once libfile('function/spacecp');
        $_G['gp_albumid'] = album_creat(array('albumname' => $_G['gp_newalbumname']));
        $newalbum = 1;
    }
}
$picnum = 0;

foreach ($postimage as $attachid => $attachoption) {
    /*将需要删除的图片放入删除数组中*/
    if ($attachoption['delete']) {
        $deleteattach[] = $attachid;
        continue;
    }
    $forumsave = 1;
    $message = $attachoption['description'];
    (strpos($message, '[/img]') || strpos($message, '[/flash]')) && $message =
        preg_replace("/\[img[^\]]*\].+?\[\/img\]|\[flash[^\]]*\].+?\[\/flash\]/is", '',
        $message);
    $message = preg_replace("/((https?|ftp|gopher|news|telnet|rtsp|mms|callto):\/\/|www\.)([a-z0-9\/\-_+=.~!%@?#%&;:$\\()|]+\s*)/i",
        '', $message);
    $message = htmlspecialchars($message);
    /*使用相册中的图片处理*/
    if ($attachoption['type'] == 'album') {
        if ($attachoption['url']) {
            $forumsave = false;
            $attachtag = '[img]' . $attachoption['url'] . '[/img]';
        } else {
            continue;
        }
    } else {
        $_G['forum_attachexist'] = 1;
        $attachtag = '[attach]' . $attachid . '[/attach]';
    }
    if($picnum >= $maxpic) continue;
    $picnum++;
    $message = $_G['gp_beforeattach'] ? $message . '\n\n' . $attachtag : $attachtag .
        '\n\n' . $message;
    $newthread = 0;
    $doaction = 'reply';
    if ($first == 0 && $action == 'newthread') {
        /*第一楼将发布为主题，若是回帖则会生成回复*/
        $firstmessage = $message;
        $newthread = 1;
        $doaction = 'post';
        $posttableid = getposttableid('p');
        $thread['status'] = 0;
        $_G['gp_reply_notice'] && $thread['status'] = setstatus(6, 1, $thread['status']);
        DB::query("INSERT INTO " . DB::table('forum_thread') .
            " (fid, posttableid, readperm, price, typeid, sortid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup)
    		VALUES ('$_G[fid]', '$posttableid', '$readperm', '', '$typeid', '', '$_G[username]', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$_G[username]', '', '', '', '2', '', '$thread[status]', '')");
        $tid = DB::insert_id();
    }
    $pid = insertpost(array(
        'fid' => $_G['fid'],
        'tid' => $tid,
        'first' => $newthread,
        'author' => $_G['username'],
        'authorid' => $_G['uid'],
        'subject' => $newthread ? $subject : '',
        'dateline' => $_G['timestamp'],
        'message' => $message,
        'useip' => $_G['clientip'],
        'invisible' => '',
        'anonymous' => '',
        'usesig' => $usesig,
        'htmlon' => '',
        'bbcodeoff' => '',
        'smileyoff' => '',
        'parseurloff' => '',
        'attachment' => '2',
        'tags' => '',
        ));
    $update = array(
        'readperm' => $_G['group']['allowsetattachperm'] ? $attach[$attachid]['readperm'] :
            0,
        'price' => $_G['group']['maxprice'] ? (intval($attach[$attachid]['price']) <= $_G['group']['maxprice'] ?
            intval($attach[$attachid]['price']) : $_G['group']['maxprice']) : 0,
        'tid' => $tid,
        'pid' => $pid,
        'uid' => $_G['uid']);
    //DB::query("UPDATE ".DB::table('forum_attachment')." SET tid='$tid', pid='$pid' WHERE aid='$attachid' AND uid='$_G[uid]'");
    /*保存相册的处理*/
    if ($_G['gp_savetoalbum'] && $forumsave) {
        $picdata = array(
            'albumid' => $_G['gp_albumid'],
            'uid' => $_G['uid'],
            'username' => $_G['username'],
            'dateline' => $attach[$attachid]['dateline'],
            'postip' => $_G['clientip'],
            'filename' => $attach[$attachid]['filename'],
            'title' => $attach[$attachid]['description'],
            'type' => fileext($attach[$attachid]['attachment']),
            'size' => $attach[$attachid]['filesize'],
            'filepath' => $attach[$attachid]['attachment'],
            'thumb' => $attach[$attachid]['thumb'],
            'remote' => $attach[$attachid]['remote'] + 2,
            'serverid' => $attach[$attachid]['serverid']);
        $update['picid'] = DB::insert('home_pic', $picdata, 1);
    }
    /*结束*/
    DB::query("REPLACE INTO " . DB::table('forum_attachmentfield') .
        " (aid, tid, pid, uid, description) VALUES ('$attachid', '$tid', '$pid', '$_G[uid]', '" .
        cutstr(dhtmlspecialchars($attach[$attachid]['description']), 100) . "')");
    DB::update('forum_attachment', $update, "aid='$attachid' and uid='$_G[uid]'");
    /*水印处理*/
    if ($_G['setting']['watermarkstatus'] && empty($_G['forum']['disablewatermark'])) {
        if ($attach[$attachid]['serverid'] > 0) {
            $attachserver->post_method($all_serverinfo[$attach[$attachid]['serverid']]['domain'],
                $all_serverinfo[$attach[$attachid]['serverid']]['api'],
                "pic_watermark&source=forum/" . $attach[$attachid]['attachment'] .
                "&target=&type=forum");
        } else {
            $image->Watermark($_G['setting']['attachdir'] . '/forum/' . $attach[$attachid]['attachment'],
                '', 'forum');
        }
    }
    /*结束*/
    if ($pid && getstatus($thread['status'], 1)) {
        savepostposition($tid, $pid);
    }
    /*更新用户积分*/
    updatepostcredits('+', $_G['uid'], $doaction, $_G['fid']);
    /*结束*/
    if ($newthread) {
        /*发送用户动态到空间*/
        $feed = array(
            'icon' => '',
            'title_template' => '',
            'title_data' => array(),
            'body_template' => '',
            'body_data' => array(),
            'title_data' => array(),
            'images' => array());
        if (!empty($_G['gp_addfeed']) && $_G['forum']['allowfeed']) {
            $message = str_replace('\n', '', $message);
            $feed['icon'] = 'thread';
            $feed['title_template'] = 'feed_thread_title';
            $feed['body_template'] = 'feed_thread_message';
            $feed['body_data'] = array('subject' => "<a href=\"forum.php?mod=viewthread&tid=$tid\">$subject</a>",
                    'message' => messagecutstr($message, 150));
            if (!empty($_G['forum_attachexist'])) {
                if ($attachid) {
                    $feed['images'] = array(getforumimg($attachid));
                    $feed['image_links'] = array("forum.php?mod=viewthread&do=tradeinfo&tid=$tid&pid=$pid");
                }
            }
            $feed['title_data']['hash_data'] = "tid{$tid}";
            $feed['id'] = $tid;
            $feed['idtype'] = 'tid';
            if ($feed['icon']) {
                postfeed($feed);
            }
        }
    }
    $first++;
    //if($first > 10) showmessage('post_newthread_succeed', "forum.php?mod=viewthread&tid=$tid&extra=$extra", array('fid'=>$_G['fid'],'tid'=>$tid));
}
include_once libfile('function/stat');
updatestat('post');
updatestat('thread');
DB::query("UPDATE " . DB::table('forum_thread') . " SET lastposter='$_G[username]', lastpost='$_G[timestamp]', replies=replies+" . ($action == 'newthread' ? ($first - 1) : $first) . " WHERE tid='$tid'",
    'UNBUFFERED');
if ($newalbum) {
    require_once libfile('function/home');
    require_once libfile('function/spacecp');
    album_update_pic($_G['gp_savealbumname']);
}
/*更新相册中图片数量*/
if ($_G['gp_savealbumname']) {
    $albumdata = array(
        'picnum' => DB::result_first("SELECT count(*) FROM " . DB::table('home_pic') .
            " WHERE albumid='$_G[gp_savealbumname]'"),
        'updatetime' => $_G['timestamp'],
        );
    DB::update('home_album', $albumdata, "albumid='$_G[gp_savealbumname]'");
}
if ($deleteattach) {
    //echo '<pre>删除下面id:'.dimplode($deleteattach);exit;
    /*$query = DB::query("SELECT attachment , serverid , aid , remote , thumb , tid FROM ".DB::table('forum_attachment')." WHERE aid IN(".dimplode($deleteattach).");");
    while($delattach = DB::fetch($query)){
    dunlink($delattach);
    }*/
    foreach ($deleteattach as $delaid) {
        dunlink($attach[$delaid]);
    }
    file_put_contents(DISCUZ_ROOT.'data/dlogs/fenlou_'.date("Ymd", $_G['timestamp']).'.log', date("H:i:s", $_G['timestamp']).",line:287,{$_G['uid']},".dimplode($deleteattach)."\r\n---------------\r\n", FILE_APPEND);
    DB::delete('forum_attachment', " aid IN(" . dimplode($deleteattach) . ")");
}
if ($action == 'newthread') {
    /*更新版区发帖数和帖子数*/
    $subject = str_replace("\t", ' ', $subject);
    $lastpost = "$tid\t$subject\t$_G[timestamp]\t$_G[username]";
    DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='$lastpost', threads=threads+1, posts=posts+$picnum, todayposts=todayposts+1 WHERE fid='$_G[fid]'",
        'UNBUFFERED');
    if($_G['forum']['type'] == 'sub'){
        DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost' WHERE fid='".$_G['forum'][fup]."'", 'UNBUFFERED');
    }
}else{
	$lastpost = "$thread[tid]\t".addslashes($thread['subject'])."\t$_G[timestamp]\t$author";
	DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+$picnum, todayposts=todayposts+$picnum WHERE fid='$_G[fid]'", 'UNBUFFERED');
	if($_G['forum']['type'] == 'sub') {
		DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost' WHERE fid='".$_G['forum']['fup']."'", 'UNBUFFERED');
	}
}
if ($first > 0) {
    showmessage('post_newthread_succeed', "forum.php?mod=viewthread&tid=$tid&extra=$extra",
        array('fid' => $_G['fid'], 'tid' => $tid));
} elseif (!empty($deleteattach)) {
    showmessage('portal_image_noexist', "forum.php?mod=forumdisplay&fid=$_G[fid]");
}
?>
