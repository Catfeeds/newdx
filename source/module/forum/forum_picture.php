<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
require_once libfile('function/discuzcode');
$threadtable = 'forum_thread';
if ($_G['fid']!='443'){
	showmessage('该帖子不属于每日一图模块',$_G['config']['web']['forum']."thread-{$_G[gp_tid]}-1-1.html");
	
}
$weburl = $_G['config']['web']['forum'] . "forum.php?mod=redirect";
$geturl = $_G['config']['web']['forum'] . "forum.php?mod=picture";

if($_G['setting']['cachethreadlife'] && $_G['forum']['threadcaches'] && !$_G['uid'] && $page == 1 && !$_G['forum']['special'] && empty($_G['gp_do']) && empty($_G['gp_archiver'])) {
	viewthread_loadcache();
}

$forum_post=DB::fetch_first("SELECT tid,fid,pid,message,dateline,first  FROM ".DB::table('forum_post')." WHERE tid='$_G[tid]' and first=1".getSlaveID());

$comments = $commentcount = $totalcomment = array();
if($_G['setting']['commentnumber']){
	
	$page = max(1, $_G['gp_page']);
	$perpage =  5;
	$start = ($page - 1) * $perpage;
	
	$count = DB::result_first("SELECT count(*) FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and tid = '$_G[tid]' and pid = '$forum_post[pid]' ORDER BY dateline DESC ".getSlaveID());
	$queryp = DB::query("SELECT id,pid,authorid,author,dateline,comment FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and tid = '$_G[tid]'  and pid = '$forum_post[pid]' ORDER BY dateline DESC limit $start,$perpage ".getSlaveID());
	
	while($comment = DB::fetch($queryp)) {

		//存储点评 回复的条数
		$comment['replyCount'] = $count;  //点评回复的数量
		
		if(count($comments[$comment['pid']]) < $_G['setting']['commentnumber'] && $comment['authorid']) {
			$comment['avatar'] = avatar($comment['authorid'], 'small');
			$comment['dateline'] = dgmdate($comment['dateline'], 'u');
			$comments[$comment['pid']][] = $comment;
		}
		if(!$comment['authorid']) {
			$cic = 0;
			$totalcomment[$comment['pid']] = preg_replace('/<i>([\.\d]+)<\/i>/e', "'<i class=\"cmstarv\" style=\"background-position:20px -'.(intval(\\1) * 16).'px\">'.sprintf('%1.1f', \\1).'</i>'.(\$cic++ % 2 ? '<br />' : '');", $comment['comment']);
		}
	}
	 $multipage = multi($count, $perpage, $page, $geturl. '&tid='.$_G[tid],0,3);
}

if($_GET['inajax']){
	viewthread_updateviews();
   	include template('diy:forum/viewpicture_page');
}else{
	
	$forum_picture = DB::fetch_first("SELECT subject,views,replies FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0')".getSlaveID()));
	$forum_picture['views'] += get_redis_views($_G['tid'],'viewthread');
	$forum_picture['short_subject'] = cutstr($_G['forum_thread']['subject'], 52);
	
	//截取主题内容 祛除不必要的内容
	$message=strip_tags(discuzcode(trim(preg_replace("/\[attach\]\d+\[\/attach\]/i", "",$forum_post['message']))),'<a>');
	$resubstr=strpos($message,'<a href="http://www.8264.com/plugin.php?id=dailypicture:public"');
	$forum_post['message']=str_replace("作者介绍","<br />作者介绍",substr($message,0,$resubstr));//删除后面
	$forum_post['dateline']=date('Y-m-d H:i',$forum_post['dateline']);
	$str = DB::fetch_first("SELECT aid,remote,attachment,serverid FROM ".DB::table('forum_attachment')." WHERE tid='$_G[tid]' AND pid = '$forum_post[pid]' ".getSlaveID());
	$metadescription = str_replace('\n','br',cutstr(strip_tags($forum_post['message']), 160));
	if(!$metadescription){
		$metadescription=strip_tags($forum_picture['subject']);
	}
	$metakeywords = strip_tags($forum_picture['subject']);
	$navtitle = $forum_picture['subject'].'-'.strip_tags($_G['forum']['name']);
	if(file_exists(DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php")){
			require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
			$attach_server = new attachserver;
			$attachserverlist = $attach_server->get_server_domain('all', '*');
	}
	
	$attach = array();
	$attach['url'] = ($str['remote'] ? $_G['setting']['ftp']['attachurl'] : ($str['serverid'] > 0 ? 'http://'.$attachserverlist[$str['serverid']]['name'].'/' : $_G['setting']['attachurl'])).'forum/';
	$tmpstr = '';
	
	if ( is_array( $attachserverlist[$str['serverid']]['api'] ) ) {
		if( $attachserverlist[$str['serverid']]['api']['class'] && is_object( $attachserverlist[$str['serverid']]['api']['class'] ) ) {
			$_callback = array( $attachserverlist[$str['serverid']]['api']['class'], $attachserverlist[$str['serverid']]['api']['function'] );
		}else{
			$_callback = $attachserverlist[$str['serverid']]['api']['function'];
		}
		$tmpstr = call_user_func_array( $_callback, array( 'forum', true, false, true ));
	}
	
	$pic_url = $attach['url'].$str['attachment'] . $tmpstr;	
   	viewthread_updateviews();
        $seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
        $secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
        include template('diy:forum/viewpicture');
}

function viewthread_loadcache() {
	global $_G;
	$_G['forum']['livedays'] = ceil((TIMESTAMP - $_G['forum']['dateline']) / 86400);
	$_G['forum']['lastpostdays'] = ceil((TIMESTAMP - $_G['forum']['lastthreadpost']) / 86400);
	$threadcachemark = 100 - (
	$_G['forum']['displayorder'] * 15 +
	$_G['forum']['digest'] * 10 +
	min($_G['forum']['views'] / max($_G['forum']['livedays'], 10) * 2, 50) +
	max(-10, (15 - $_G['forum']['lastpostdays'])) +
	min($_G['forum']['replies'] / $_G['setting']['postperpage'] * 1.5, 15));
	if($threadcachemark < $_G['forum']['threadcaches']) {

		$threadcache = getcacheinfo($_G['tid']);
		/*if(TIMESTAMP - $threadcache['filemtime'] > $_G['setting']['cachethreadlife']) {
			@unlink($threadcache['filename']);
			define('CACHE_FILE', $threadcache['filename']);
		} else {
			readfile($threadcache['filename']);*/
		if(memory('get', $threadcache['filename'])) {
			echo memory('get', $threadcache['filename']);
			viewthread_updateviews();
			$_G['setting']['debug'] && debuginfo();
			$_G['setting']['debug'] ? die('<script type="text/javascript">document.getElementById("debuginfo").innerHTML = " '.($_G['setting']['debug'] ? 'Updated at '.gmdate("H:i:s", $threadcache['filemtime'] + 3600 * 8).', Processed in '.$debuginfo['time'].' second(s), '.$debuginfo['queries'].' Queries'.($_G['gzipcompress'] ? ', Gzip enabled' : '') : '').'";</script>') : die();
		}else {
			define('CACHE_FILE', $threadcache['filename']);
		}
	}
}
function viewthread_updateviews() {
	global $_G, $do, $threadtable;
	/**声明redis**/
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6381);
	/**结束**/
	if($_G['setting']['delayviewcount'] == 1 || $_G['setting']['delayviewcount'] == 3) {
		//$_G['forum_logfile'] = './data/cache/forum_threadviews_'.intval(getgpc('config/server/id')).'.log';
		if(substr(TIMESTAMP, -2) == '00' || $_G['uid'] == 1){
			require_once libfile('function/misc');
			//updateviews($threadtable, 'tid', 'views', $_G['forum_logfile']);
			updateviews_redis($threadtable, 'tid', 'views', 'viewthread', false);
		}
		/**将帖子点击存入缓存中**/
		if($myredis->connected){
			$myredis->obj->hincrby('viewthread_number',$_G['tid'],1);
            if($_G['uid'] == 1){
            	for($_i = 0; $_i <= 300; $_i++){
		        	$_re = $myredis->obj->lpop('viewthread_queue_watting');
		        	if($_re){
		        		$_re = unserialize($_re);
		        		if($_re['tid'] > 0 && $_re['views'] > 0){
		        			$myredis->obj->hincrby('viewthread_number', $_re['tid'], $_re['views']);
		        		}
		        	}else{
		        		break;
		        	}
		        }
            }
		}else{
            DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');exit;
		}
	} else {
		DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
	}
}

?>
