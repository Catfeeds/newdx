<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ForumMiscCtl extends FrontendCtl{
	
	private $startime;
	function __construct()
	{
		parent::__construct();
		$this->startime = strtotime('2015-07-08 13:30:00');
	}
	
	//点评更多列表--参考module/forum/forum_misc.php的action=commentmore
	function commentmore()
	{	
		global $_G;	
		global $returnData;
		
		if(!$_G['setting']['commentnumber']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
		}
		require_once libfile('function/discuzcode');
		
		$commentlimit = $_G["gp_commentnumber"] ? $_G["gp_commentnumber"] : $_G['setting']['commentnumber'];//帖子每页点评个数
		$firstNum     = $_G["gp_commentnumberInit"] ? intval($_G["gp_commentnumberInit"]) : 1;//帖子第一页点评个数
		
		$page 		 = max(2, $_G['gp_page']);
		$start_limit = ($page - 1) * $commentlimit - ($commentlimit - $firstNum);
		$comments    = array();
		$_comments   = array();
		
		//存储点评的回复列表		
		$query = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and tid = ".$_G['tid']." ORDER BY dateline DESC " . getSlaveID());
		while($totalcom = DB::fetch($query)){
			$reply[] = $totalcom;
			if ($_G["gp_pid"] == $totalcom["pid"]) {
				$_comments[] = $totalcom;
			}
		}
		$_comments = array_slice($_comments, $start_limit, $commentlimit);
		foreach ($_comments as $comment) {
			$comment['avatar']  = avatar($comment['authorid'], 'small');
			for($i=0;$i<count($reply);$i++){
				$arr = $reply[$i];
				if($arr['replyid'] == $comment['id']){
					$arr['avatar'] = avatar($arr['authorid'], 'small');
					$comment['replyComment'][] = $arr;
				}
			}
			if($comment['authorid']) {
				$comments[] = $comment;
			}
		}
		$returnData["commentList"] = $comments;
		encodeData($returnData);
	}
	
	//首页最新热帖更多列表
	function threadHotMore()
	{	
		global $_G;	
		global $returnData;
		
		//参数整理
		$perpage = $_G['gp_perpage'] ? intval($_G['gp_perpage']) : 15;
		$firstNum= $_G["gp_perpageInit"] ? intval($_G["gp_perpageInit"]) : 1;//第一页个数
		$page 	 = $_G['gp_page'] ? max(2,intval($_G['gp_page'])) : 2;
		$start 	 = ($page - 1) * $perpage  - ($perpage - $firstNum);
		
		$memKey 	   = 'cache_mobile_zxrt_list';
		$memKeyWeight  = 'cache_mobile_zxrt_weight_list';		
		$hotThreadList = memory('get', $memKey);
		$weightList    = memory('get', $memKeyWeight);

		foreach ($weightList as $k=>$v) {
			if($hotThreadList[$k]['forbid'] == 1){
				unset($weightList[$k]);
				continue;
			}
		}
		
		$weightList = array_slice($weightList, $start, $perpage, true);
		foreach ($weightList as $k=>$v) {
			$weightList[$k] = $hotThreadList[$k];
		}		
		
		$returnData["weightList"] = $weightList;
		
		encodeData($returnData);
	}
	
	//上传图片权限检测
	function uploadPicPerm() 
	{
		global $_G;	
		global $returnData;
		 
       	require_once libfile('class/forumupload');
    	$obj = new forum_upload_wap();    	
    	
		encodeData($returnData);		
	}
	
	//上传upyun
	function uploadUpyunParam(){
		global $_G;	
		global $returnData;
		$returntype = (int)$_G['gp_returntype'];
		
		//图片上传
		require_once libfile('class/upyun_form');
		$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);
		$upyunParam['opts'] = array();
		$upyunParam['opts']['save-key'] = 'forum/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // 保存路径
		$upyunParam['opts']['allow-file-type'] = 'jpg,jpeg,bmp,png';
		switch ($returntype) {
			case 1:
				$upyunParam['opts']['return-url'] = "http://m.8264.com/index.php?d=system&c=misc&m=doUploadPicN";
				break;
			case 3: //测试环境
				$upyunParam['opts']['return-url'] = "http://m2.8264.com/index.php?d=system&c=misc&m=doUploadPicN";
				break;
			case 2:
			default:
				;
				break;
		}
		$upyunParam['policy'] = $upyun->policyCreate($upyunParam['opts']);
		$upyunParam['sign'] = $upyun->signCreate($upyunParam['opts']);
		$upyunParam['action'] = $upyun->action();
		$upyunParam['version'] = $upyun->version();
		$upyunParam['exptime'] = TIMESTAMP+1800;
		$upyunParam['cdnConfig'] = $_G['config']['cdn']['form'];
		$returnData['upyunParam'] = $upyunParam;

		encodeData($returnData);
	}

	//上传图片--入库
	function uploadPic() 
	{
		global $_G;	
		global $returnData;   	
		
		$_G['gp_name'] = iconv("utf-8","gbk//TRANSLIT",$_G['gp_name']);
		
		DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid)
			VALUES ('0', '0', '$_G[timestamp]', '0', '0', '".$_G['gp_name']."', '".$_G['gp_type']."', '".$_G['gp_num']."', '".$_G['gp_attachment']."', '0', '1', '".$_G['uid']."', '{$_G['gp_thumb']}', '0', '{$_G['gp_width']}', {$_G['gp_serverid']})");
		$aid = DB::insert_id();    	  	
    	
		dsetcookie("upload_attach_8264_attachmentname", $_G['gp_name'],10);
		dsetcookie("upload_attach_8264_attachmentserverid", $_G['gp_name'],10);
		
    	$returnData['aid']    = $aid;
    	$returnData['attach'] = getimagethumb(70,70,22,'forum/'.$_G['gp_attachment'], 0, $_G['gp_serverid']);   	
    	
		encodeData($returnData);
	}
	
	//上传图片--获得图片服务器信息及图片名
	function getAttachServer()
	{	
		global $_G;	
		global $returnData;       
        
		require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
        $attachserver = new attachserver;
        $servers_arr  = $attachserver->get_server();
        
        $savefilename = date('His').strtolower(random(16)).'.jpg';
        
        $returnData['servers_arr']  = $servers_arr;
        $returnData['savefilename'] = $savefilename;
        
        unset($returnData['forumoptionList']);
		encodeData($returnData);
	}
	
	//上传图片--获得upyun信息
	function getUpYunInfo() 
	{
		global $_G;	
		global $returnData;
		
		$returnData['upYun'] = getUpYun($_G['gp_thumb'], $_G['gp_width'], $_G['gp_height'], $_G['gp_thumbtype'], $_G['gp_waterposion'], $_G['gp_watertype'], $_G['gp_returnurl'], $_G['gp_name']);
        
        unset($returnData['forumoptionList']);
		encodeData($returnData);		
	}
	
	//上传图片--生成原图保护的安全标识
	function getSecureStrInfo() 
	{
		global $_G;	
		global $returnData;
		
		$returnData['secure'] = $secure = getSecureStr($_G['gp_uid'], $_G['gp_attachment'], $_G['gp_type']);
        
        unset($returnData['forumoptionList']);
		encodeData($returnData);		
	}
	
	//微信分享--入库
	function insertCommonShare() 
	{
		global $_G;	
		global $returnData;
    	
		$arrCommonShare = array('uid' => $_G['gp_uid'], 'tid' => $_G['gp_tid'], 'url' => $_G['gp_url'] , 'share_ip' => $_G['gp_share_ip'], 'dateline' => $_G['timestamp'], 'turn' => $_G['gp_turn']);   	
    	
    	//若是发布者，则给它的选中的关注分组，发邀请
    	if ($_G['gp_iscreater']) {
    		//参考自 source\module\misc\misc_invite.php
    		
    		//获得要发邀请的分组
    		$tempgroup = DB::result_first("SELECT groups FROM ".DB::table('common_share_follow_group')." WHERE tid={$_G['gp_tid']} " . getSlaveID());
    		
			if ($tempgroup) {
				
				require libfile('function/friend');
				
				$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid={$_G['gp_tid']} " . getSlaveID());
				
				$invitename = lang('forum/misc', 'join_activity');
				$message = lang('notification' , 'thread_invite' ,array('actor' => "<a href=\"home.php?mod=space&uid=$_G[gp_uid]\">".$thread['author']."</a>" , 'subject' => $thread['subject'], 'invitename' => $invitename, 'tid' => $_G['gp_tid'], 'from_id' => $_G['gp_tid'], 'from_idtype' => 'invite_thread'));				
				
				require_once libfile('class/myredis');
				$redis = & myredis::instance(6378);
				
				$tempgroup = trim($tempgroup, ',');				
				$tempgroup = explode(',', $tempgroup);
				
				foreach ($tempgroup as $v) {
					
					$uids  = array();
					$number_users = 0;
					$uidtext = '';
					$sql   = 'SELECT fwuid FROM '. DB::table(get_user_table($_G['gp_uid'])) . " WHERE uid='{$_G['gp_uid']}' and mutual=2 and gid={$v} ";
					$sql  .= " ORDER BY dateline DESC LIMIT 0,1000 " . getSlaveID();
					$query = DB::query($sql);
					while($value = DB::fetch($query)) {
						$redis->zIncrBy("common_member_invite_users_list", 1, 'uid_' . $value['fwuid']);						
		                $uidtext .= "({$value['fwuid']})";
		                $number_users++;	
		                $uids[$value['fwuid']] = $value['fwuid'];					
					}
					if ($uids) {
						$uidstring = implode(',', $uids);
						DB::query('UPDATE ' . DB::table('common_member_status') . " SET newinvite=newinvite+1 WHERE uid IN(".$uidstring.')');
						DB::query('UPDATE ' . DB::table('common_member') . " SET newprompt=newprompt+1 WHERE uid IN(".$uidstring.')');
						$msgid = DB::insert('plugin_invite_message', array('message' => addslashes($message), 'dateline' => $_G['timestamp'] , 'num' => $number_users , 'author' => $thread['author'] , 'authorid' => $_G['gp_uid']) ,TRUE);
						DB::insert('plugin_invite_relation', array('uid' => $_G['gp_uid'], 'mid' => $msgid, 'tousers' => $uidtext , 'dateline' => $_G['timestamp']));
					}
				}
				
				DB::delete('common_share_follow_group',"tid = {$_G['gp_tid']}");
			} 
			$arrCommonShare['first_source'] = 1;
			  
    	} elseif ($_G['gp_openid']) {
    		$isCouponed = DB::result_first("SELECT coupon FROM ".DB::table('common_share_coupon')." WHERE tid={$_G['gp_tid']} and openid = '{$_G['gp_openid']}' " . getSlaveID());    		
    		if (!$isCouponed) {
    			DB::insert('common_share_coupon', array('tid' => $_G['gp_tid'], 'openid' => $_G['gp_openid'], 'coupon' => $_G['gp_coupon'], 'dateline' => $_G['timestamp']));
    		}
    		$returnData['coupon'] = $_G['gp_coupon'];
    		$arrCommonShare['first_source'] = $_G['gp_frominvite'] ? 3 : 2;
    		$_G['gp_turn'] = intval($_G['gp_turn']);
    		$arrCommonShare['first_source'] = $_G['gp_turn'] > 1 ? 0 : $arrCommonShare['first_source'];
    	} elseif ($_G['gp_hasfid']) {
    		$arrFid = array('52'=>4);
    		$arrCommonShare['first_source'] = isset($arrFid[$_G['gp_hasfid']]) ? $arrFid[$_G['gp_hasfid']] : 4;
    		$_G['gp_turn'] = intval($_G['gp_turn']);    		
    	}
    	
    	$returnData['id'] = DB::insert('common_share', $arrCommonShare, true);
		encodeData($returnData);
	}
        //微信分享任务帖子--入库
	function insertTaskShare() 
	{
            global $_G;
            global $returnData;
            $arrCommonShare = array('uid' => $_G['gp_zhuzhanuser'], 'taskid' => $_G['gp_taskid'],'dateline' => $_G['timestamp']);
            $isshare = DB::result_first("SELECT * FROM ".DB::table('common_share_task_tiezi')." WHERE uid={$_G['gp_zhuzhanuser']} and taskid = '{$_G['gp_taskid']}' " . getSlaveID());
            if(!$isshare){
                $returnData['id'] = DB::insert('common_share_task_tiezi', $arrCommonShare, true);
            }
            
            encodeData($returnData);
	}
	
	//获得微信分享的优惠码
	function getShareCoupon()
	{
		global $_G;	
		global $returnData;
		
		$couponShow = DB::fetch_first("SELECT coupon FROM ".DB::table('common_share_coupon')." WHERE tid={$_G['gp_tid']} and openid='{$_G['gp_openid']}' " . getSlaveID());
		$returnData['coupon'] = $couponShow['coupon'];
		encodeData($returnData);
	}
	
	//微信分享的浏览--入库
	function insertCommonView() 
	{
		global $_G;	
		global $returnData;
		
		DB::query("INSERT INTO ".DB::table('common_view')." (url, tid, ip, utm_source, utm_campaign, dateline, turn)	VALUES ('{$_G['gp_url']}', '{$_G['gp_tid']}', '{$_G['gp_ip']}', '{$_G['gp_utm_source']}', '{$_G['gp_utm_campaign']}', '{$_G['timestamp']}', '{$_G['gp_turn']}')");		
    	$returnData['id']    = DB::insert_id();
    	
		encodeData($returnData);
	}

	//在外后台 微信分享统计-读取分享记录 待改善
	function getCommonShare() 
	{
		global $_G;	
		global $returnData;
		
		$conditions = '';
		if(!empty($_G['gp_dateline_start'])&&!empty($_G['gp_dateline_end'])) {
			$dateline_start = max($this->startime, $_G['gp_dateline_start']);
			$conditions = "where dateline between '{$dateline_start}' and '{$_G['gp_dateline_end']}'";
		} else {
			$conditions = "where dateline>{$this->startime}";
		}		
		$sql   = "SELECT tid,share_ip,turn,first_source FROM ".DB::table('common_share')." {$conditions} " . getSlaveID();
		$query = DB::query($sql);
		$return['shareCount'] 	  = 0; //一次分享数
		$return['shareCountFor1'] = 0; //发布活动分享数
		$return['shareCountFor2'] = 0; //参加活动分享数
		$return['shareCountFor3'] = 0; //通过邀请分享数
		$return['shareSecCount']  = 0; //二次分享数
		$arrFirst  = array();
		$arrFirst1 = array();
		$arrFirst2 = array();
		$arrFirst3 = array();
		$arrSec    = array();
		while($v = DB::fetch($query)){
			if ($v['turn'] == 1 && !isset($arrFirst[$v['tid']][$v['share_ip']])) {
				$return['shareCount']++;
				$arrFirst[$v['tid']][$v['share_ip']] = 1;
			}
			if ($v['turn'] == 1 && $v['first_source'] <= 1 && !isset($arrFirst1[$v['tid']][$v['share_ip']])) {
				$return['shareCountFor1']++;
				$arrFirst1[$v['tid']][$v['share_ip']] = 1;
			}
			if ($v['turn'] == 1 && $v['first_source'] == 2 && !isset($arrFirst2[$v['tid']][$v['share_ip']])) {
				$return['shareCountFor2']++;
				$arrFirst2[$v['tid']][$v['share_ip']] = 1;
			}
			if ($v['turn'] == 1 && $v['first_source'] == 3 && !isset($arrFirst3[$v['tid']][$v['share_ip']])) {
				$return['shareCountFor3']++;
				$arrFirst3[$v['tid']][$v['share_ip']] = 1;
			}
			if ($v['turn'] > 1 && !isset($arrSec[$v['tid']][$v['share_ip']])) {
				$return['shareSecCount']++;
				$arrSec[$v['tid']][$v['share_ip']] = 1;
			}
		}
		$return['sql'] = $sql;
		encodeData($return);
	}
	
	//在外后台 微信分享统计-读取浏览记录 待改善
	function getCommonView() 
	{
		global $_G;	
		global $returnData;
		
		$conditions = '';
		if(!empty($_G['gp_dateline_start'])&&!empty($_G['gp_dateline_end'])){
			$dateline_start = max($this->startime, $_G['gp_dateline_start']);
			$conditions = "where dateline between '{$dateline_start}' and '{$_G['gp_dateline_end']}' ";
		}else{
			$conditions = "where dateline>{$this->startime}";
		}		
		
		$return['count']  = 0;
		$arrTid = array();
		$sql = "SELECT tid,ip FROM ".DB::table('common_view')." {$conditions} " . getSlaveID();
		$query = DB::query($sql);
		while($v = DB::fetch($query)) {
			if (!isset($arrTid[$v['tid']][$v['ip']])) {
				$return['count']++;
				$arrTid[$v['tid']][$v['ip']] = 1;
			}
			$return['allcount']++;
		}		
		$return['sql'] = $sql;
		encodeData($return);
	}
	
	//在外后台 微信分享统计-发表活动数，报名活动数
	function getActivityCount() 
	{
		global $_G;	
		global $returnData;
		
		$conditions = 'where displayorder>-1 and special=4 ';
		if(!empty($_G['gp_dateline_start'])&&!empty($_G['gp_dateline_end'])){
			$dateline_start = max($this->startime, $_G['gp_dateline_start']);
			$conditions .= "and dateline between '{$dateline_start}' and '{$_G['gp_dateline_end']}' ";
		}else{
			$conditions.= " and dateline>{$this->startime}";
		}
		
		$return['postActivityCount']  = 0;
		$return['applyActivityCount'] = 0;
		$tids  = array();
		$sql   = "SELECT tid FROM ".DB::table('forum_thread')." {$conditions} " . getSlaveID();
		$query = DB::query($sql);
		while($v = DB::fetch($query)) {
			$tids[$v['tid']] = $v['tid'];
		}
		
		if ($tids) {
			$return['postActivityCount'] = count($tids);
			$tids  = implode(',', $tids);				
			$sql   = "select aa.tid , aa.dateline, aa.verified, aa.ufielddata from ".DB::table('forum_activityapply')." aa where aa.tid in ({$tids}) " . getSlaveID();
			$query = DB::query($sql);
			while($v = DB::fetch($query)) {				
				$v['ufielddata'] = unserialize($v['ufielddata']);
				$nofilds = $v['ufielddata']['userfield']['field3'];
				if($v['verified'] == 1) {
					$return['applyActivityCount'] += !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
				}
			}
		}
		$return['tids'] = $tids;
		$return['sql'] = "SELECT tid as count FROM ".DB::table('forum_thread')." {$conditions} ";
		encodeData($return);
	}

    //在外后台 任务列表页浏览量
    function getzhuzhan_views()
    {
        global $_G;
        global $returnData;

        $conditions = '';
        if(!empty($_G['gp_dateline_start'])&&!empty($_G['gp_dateline_end'])){
            $dateline_start = $_G['gp_dateline_start'];
            $conditions .= "where dateline > {$dateline_start} and dateline < {$_G['gp_dateline_end']}";
        }else{
            $conditions.= "";
        }

        $query = DB::query("SELECT count(*) as count FROM ".DB::table('task_views')." {$conditions} " . getSlaveID());
        while($totalcom = DB::fetch($query)){
            $return[] = $totalcom;
        }
        encodeData($return);
    }

}
?>