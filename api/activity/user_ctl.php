<?php

/**
* 活动用户操作
*/


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require DISCUZ_ROOT.'api/activity/thread_ctl.php';

class user extends thread
{
	private $virtual_uid = 40269021;
	private $virtual_username = '在外用户';
	private $follower_connent = '#zaiwaiapp#';

	function __construct()
	{
		parent::__construct();
	}

	// 我发布的活动
	public function myActList()
	{
		if(!$this->uid) {
			output_errorMsg(423, 'Unknown user info.', '');
		}

		$page 	   = max(intval($_GET['page']), 1);
		$perpage   = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start     = ($page-1)*$perpage;
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$tid	= $_GET['tid']; //找到这个tid的位置

		//其他条件
		$conditions = array();
		$wheresql = "";
		if($_POST['goodtitle']){
			$conditions[] = "t.subject like '%{$_POST['goodtitle']}%'";
		}
		if($_POST['formid']){
			$conditions[] = "a.formid = {$_POST['formid']}";
		}
		$starttime = (int)$_POST['starttime'];
		$endtime = (int)$_POST['endtime'];
		if($starttime>0){
			$conditions[] = "t.dateline >= $starttime";
		}
		if($endtime>0){
			$conditions[] = "t.dateline =< ".($endtime+86399);
		}
		$status = $_POST['status'];
		if($status>0){
			switch ($status) {
				case 1: //报名中
					$conditions[] = "a.expiration > {$this->timestamp} and a.passnumber < a.number";
					break;
				case 2: //已满员
					$conditions[] = "a.expiration > {$this->timestamp} and a.passnumber = a.number";
					break;
				case 3: //报名结束
					$conditions[] = "a.expiration <= {$this->timestamp}";
					break;
//				case 4: //活动中
//					$conditions[] = "a.starttimefrom <= {$this->timestamp} and a.starttimeto > {$this->timestamp}";
//					break;
//				case 5: //活动结束
//					$conditions[] = "a.starttimeto <= ".$this->timestamp;
//					break;
			}
			
			if($row['exptime'] > $this->timestamp) { //报名中
				$row['status'] = "报名中";
				if($row['passnumber'] == $row['number']){
					$row['status'] = "已满员";
				}
			} else{
				$row['status'] = "报名结束";
			}
		}
		$conditions[] = "(displayorder>=0 OR t.displayorder IN (-4, -3, -2))";
		if($conditions){
			$wheresql = " and ".implode(" and ", $conditions);
		}

		$list = array();
		$sql = "SELECT t.tid, t.subject, t.dateline, t.fid, t.displayorder, a.aid, a.title, a.cost, a.starttimefrom as starttime, a.starttimeto as endtime, a.place, a.collectplace, a.number, a.applynumber, a.passnumber, a.expiration as exptime, a.nature, a.formid FROM ".DB::table("forum_activity")." AS a
				INNER JOIN ".DB::table("forum_thread")." AS t ON t.tid=a.tid
				WHERE a.tid > 5161751 AND a.credit = 0 AND t.authorid = {$this->uid} $wheresql". getSlaveID(); //某些活动之后的 不需要积分的XXX活动
		$query = DB::query($sql);

		while($row = DB::fetch($query)){
			//活动状态 分为活动未开始和活动进行中和活动结束三大状态
			if($row['exptime'] > $this->timestamp) { //报名中
				$row['status'] = "报名中";
				if($row['passnumber'] == $row['number']){
					$row['status'] = "已满员";
				}
			} elseif ($row['starttime'] > $this->timestamp) {
				$row['status'] = "报名结束";
			} elseif ($row['starttime'] <= $this->timestamp && $row['endtime'] > $this->timestamp) {
				$row['status'] = "活动中";
			} elseif ($row['endtime'] <= $this->timestamp) {
				$row['status'] = "活动结束";
			}

			//是否有未审核的
			$row['isVerified'] 		= $row['applynumber'] - $row['passnumber'] > 0 ? 1 : 0;
			$row['isEdit']     		= $row['endtime'] < $this->timestamp ? 0 : 1;
			$row['displayorder']    = intval($row['displayorder']);

			//格式化时间
			$row['dateline_f']  = date("YmdHis", $row['dateline']);
			$row['starttime_f'] = date("YmdHis", $row['starttime']);
			$row['endtime_f']   = date("YmdHis", $row['endtime']);
			$row['exptime_f']   = date("YmdHis", $row['exptime']);

			//输出原图
			$row['coverpic'] = $this->model->attach($row['aid']);

			$list[] = $row;
		}
		$list = $this->model->multi_array_sort($list, 'displayorder', SORT_DESC);
		$listCount = count($list);
		for ($i=0;$i<$listCount-1;$i++) {
        	for ($j=$i+1;$j<=$listCount-1;$j++) {
        		if ($list[$i]['tid'] < $list[$j]['tid'] && $list[$i]['displayorder'] == $list[$j]['displayorder']) {
        			$temp = $list[$i];
        			$list[$i] = $list[$j];
        			$list[$j] = $temp;
        		}
        	}
        }
		
		//如果tid存在 计算tid在数据中的位置 因为索引数组所以↓
		if($tid){
			$find = false;
			foreach ($list as $tidindex => $info) {
				if($info['tid'] == $tid){
					$find = true;
					break;
				}
			}
			if($find){ //计算所在页码
				$thistidpagenum = ceil($tidindex/$perpage);
				$start     = ($thistidpagenum-1)*$perpage;
			}
		}
		
        $listpage = ceil($listCount / $perpage);
		$list = array_slice($list, $start, $perpage);
		if($list) {
			$data['next']      = $listpage <= $page ? '' : "page=".($page+1);
			$data['myActList'] = $list;
			$data['count'] = $listCount;
			$data['currpage'] = (int)$thistidpagenum;
		} else {
			$data['next']      = '';
			$data['myActList'] = array();
			$data['count'] = 0;
		}

		//给app用户清除通知
		//cleanActivityMsg(12, $appuserid);

		output_msg($data, true);
	}

	// 我报名的
	public function myApply()
	{
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$wechatuserid = $_GET['wechatuserid'];

		if(!$this->uid && !$appuserid && !$wechatuserid) {
			output_errorMsg(423, 'Unknown user info.', '');
		}

		$page = max(intval($_GET['page']), 1);
		$perpage  = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start = ($page-1)*$perpage;
		$where = '';
		$list = array();

		if($this->uid) {
			$where = " AND aa.uid = '{$this->uid}'";
		} elseif($wechatuserid) {
			$where = " AND aa.wechatuserid = '{$wechatuserid}'";
		} elseif($appuserid) {
			$where = " AND aa.appuserid = '{$appuserid}'";
		}

		$column = 'a.title, a.cost, a.starttimefrom as starttime, a.starttimeto as endtime, a.collectplace, a.lng, a.lat, aa.applyid, aa.verified, aa.dateline as applytime, t.tid, t.fid, t.subject, t.authorid, t.dateline';
		$sql = "SELECT {$column} FROM ".DB::table("forum_activityapply")." AS aa
				INNER JOIN ".DB::table("forum_activity")." AS a
				ON aa.tid=a.tid
				INNER JOIN ".DB::table("forum_thread")." AS t
				ON t.tid=aa.tid
				WHERE aa.tid > 5161751 AND t.displayorder >= 0 AND a.timediff < 4 AND a.credit = 0 {$where} " . getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			if (!isset($this->arrDi[$row['fid']])) {
				continue;
			}

			if ($row['verified'] == 1) {
				$row['status'] = "报名成功";
			} elseif($row['verified'] == 2) {
				$row['status'] = "资料不全";
			} else {
				$row['status'] = "审核中";
			}
			// if ($row['endtime'] < $this->timestamp) {
			// 	$row['status'] = "活动结束";
			// }

			//可取消报名按钮状态
			$row['isCancel'] = $row['starttime'] < $this->timestamp ? 0 : 1;
			//活动发起者APPUID
			$leader = $this->model->leader_info($row['authorid']);
			$row['leaderId'] = $leader['appuserid'] ? $leader['appuserid'] : '';

			//格式化时间
			$row['dateline_f']  = date("YmdHis", $row['dateline']);
			$row['starttime_f'] = date("YmdHis", $row['starttime']);
			$row['endtime_f']   = date("YmdHis", $row['endtime']);
			$row['exptime_f']   = date("YmdHis", $row['exptime']);
			$row['applytime_f'] = date("YmdHis", $row['applytime']);

			$list[] = $row;
		}

		$list = $this->model->multi_array_sort($list, 'applytime', SORT_DESC);
		$listCount = count($list);

		//我报名的活动数
		$data['applyNums'] = count($list);

		//未审核的活动数
		$sql  .= " AND aa.verified = 0 ".getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			if (!isset($this->arrDi[$row['fid']])) {
				continue;
			}
			$list_unverfies[] = $row;
		}
		$data['applyUnverifies'] = count($list_unverfies);

		$listpage = ceil($listCount / $perpage);
		$list     = array_slice($list, $start, $perpage);
		if($list) {
			$data['next']    = $listpage <= $page ? '' : "page=".($page+1);
			$data['myApply'] = $list;
		} else {
			$data['next']    = '';
			$data['myApply'] = array();
		}

		//给app用户清除通知
		cleanActivityMsg(13, $appuserid);

		output_msg($data, true);
	}

	//指定活动下的报名列表
	public function applyList()
	{
		parent::base();
		$page = max(intval($_GET['page']), 1);
		$perpage  = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start = ($page-1)*$perpage;
		$wechat_token = $this->model->wechat_token();

		$sql = "SELECT applyid, username, uid, message, verified, dateline, ufielddata, appuserid, appusername, wechatuserid, wechatusername FROM ".DB::table("forum_activityapply")." WHERE tid='$this->tid'
				ORDER BY dateline DESC LIMIT $start, $perpage ".getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			$s = unserialize($row['ufielddata']);
			unset($row['ufielddata']);

			//论坛用户
			if($row['uid'] != $this->virtual_uid) {
				$row['avatar'] = avatar($row['uid'], 'middle', true);
			}

			//微信用户
			if($row['wechatuserid']) {
				$wechat_result = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$wechat_token."&openid=".$row['wechatuserid']."&lang=zh_CN");
				$wechat_result = json_decode($wechat_result, true);
				$row['avatar'] = $wechat_result['headimgurl'] ? $wechat_result['headimgurl'] : 'http://static.8264.com/wei/images/default.png';
				$row['username'] = $row['wechatusername'];
			}

			//APP用户
			if($row['appuserid']) {
				$user_result = requestRemoteData(ZAIWAI_API_URL."userService/findCustomerUserListByUserIdList?userIdList=".$row['appuserid']."&sourceUserId=".$row['appuserid']."&sToken=".ZAIWAI_API_TOKEN);
				$user_result = json_decode($user_result, true);
				$row['avatar'] = $user_result['customerUserList'][0]['userBasic']['picUrl'];
				$row['username'] = $row['appusername'];
			}
			$row['realname'] = $s['userfield']['realname'];
			$row['mobile']   = $s['userfield']['mobile'];
			$row['nums']     = intval($s['userfield']['field3']);
			if($s['userfield']['idcard']) {
				$row['idcard'] = $s['userfield']['idcard'];
			}

			if ($row['verified'] == 1) {
				$row['status'] = "已通过";
			} elseif($row['verified'] == 2) {
				$row['status'] = "资料不全";
			} else {
				$row['status'] = "待审核";
			}

			//格式化时间
			$row['dateline_f'] = date("YmdHis", $row['dateline']);

			$list[] = $row;
		}
		$data = array();
		if($list) {
			$data['next']      = count($list) < $perpage ? '' : "page=".($page+1);
			$data['applyList'] = $list;
		} else {
			$data['next']      = '';
			$data['applyList'] = array();
		}
		output_msg($data, true);
	}

	// 审核报名
	public function applyVerify()
	{
		parent::base();
		$applyid = intval($_GET['applyid']);
		if(!$applyid) {
			output_errorMsg(423, 'Param applyid miss.', '');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		//验证审核者是否为本帖发起人
		$authorid = DB::result_first("SELECT authorid FROM ".DB::table("forum_thread")." WHERE tid='{$this->tid}'");
		if($authorid != $this->uid) {
			output_errorMsg(431, 'Operator is not author.', '');
		}

		DB::query("UPDATE ".DB::table("forum_activityapply")." SET verified='1' WHERE applyid='{$applyid}'");
		if(DB::affected_rows()) {
			//给用户发站内信通知

			parent::act_info();
			//是否有未审核的
			$data = array();
			$data['isVerified'] = $this->activity['applynumber'] - $this->activity['passnumber'] > 0 ? 1 : 0;
			$data['result'] 	= 1;

			//给app用户(活动参与者)发通知
			$applyShow = DB::fetch_first("SELECT appuserid, uid, tid FROM ".DB::table("forum_activityapply")." WHERE applyid={$applyid} " .getSlaveID());
			pushActivityMsg(13, $applyShow['uid'], $applyShow['appuserid']);

			//向活动报名者(绑定微信)发送活动报名成功通知
			$activity = DB::fetch_first("SELECT title, clubname FROM ".DB::table('forum_activity')." WHERE tid='{$applyShow['tid']}'");
			sendApplySuccessMsgForWechat($applyShow['uid'], $activity['title'], $activity['clubname']);

			output_msg($data, true);
		} else {
			output_errorMsg(431, 'Verify activity failed.', '网络原因请重新刷新');
		}
	}

	// 活动报名
	public function apply()
	{
		parent::base();

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		$realname 		= diconv($_POST['realname'], 'utf-8', 'gbk//TRANSLIT');
		$mobile 		= $_POST['mobile'];
		$nums 			= intval($_POST['nums']);
		$idcard 		= diconv($_POST['idcard'], 'utf-8', 'gbk//TRANSLIT');
		$message 		= diconv($_POST['message'], 'utf-8', 'gbk//TRANSLIT');
		$appuserid      = number_format($_POST['appuserid'], 0, ".", '');
		$appusername    = diconv($_POST['appusername'], 'utf-8', 'gbk//TRANSLIT');
		$wechatunionid  = $_POST['wechatunionid'] ? $_POST['wechatunionid'] : '';
		$wechatuserid   = $_POST['wechatuserid'] ? $_POST['wechatuserid'] : '';
		$wechatusername = diconv($_POST['wechatusername'], 'utf-8', 'gbk//TRANSLIT');
		$plat = $_POST['plat'];

		if(!$realname || !$nums || !$mobile) {
			output_errorMsg(423, 'Param realname/mobile/nums/*userid/*appusername empty.', '报名信息填写不完整');
		}

		$user_apply_status = $this->model->user_apply_status($this->tid, $this->uid, $appuserid, $wechatuserid);
		if($user_apply_status['apply']['applyid']) {
			output_errorMsg(433, 'This user was applyed.', '您已经报过名了');
		}

		parent::act_info();
		// 活动已过期
		if($this->activity['exptime'] && ($this->activity['exptime'] < $this->timestamp)) {
			output_errorMsg(433, 'The activity was expired.', '活动已过期');
		}

		// 活动已开始
		if($this->activity['starttime'] && ($this->activity['starttime'] < $this->timestamp)) {
			output_errorMsg(434, 'The activity was started.', '活动已开始');
		}

		// 超活动人数
		if($this->activity['number'] && ($this->activity['number']-$this->activity['passnumber'] < $nums)) {
			output_errorMsg(434, 'The activity was started.', '活动已报满');
		}

		$ufielddata_arr = array('userfield' =>
			array(
				'realname' => $realname,
				'mobile' => $mobile,
				'field3' => $nums,
			));
		if($idcard) {
			$ufielddata_arr['userfield']['idcard'] = $idcard;
		}

		$ufielddata = serialize($ufielddata_arr);
		//如果有用户论坛信息则用论坛ID，否则用虚拟ID
		$this->uid = $this->uid ? $this->uid : $this->virtual_uid;
		$this->username = $this->username ? $this->username : $this->virtual_username;

		// 增加报名记录
		DB::query("INSERT INTO ".DB::table("forum_activityapply")." (tid, username, uid, message, verified, dateline, payment, ufielddata, isshow, appuserid, appusername, wechatunionid, wechatuserid, wechatusername, plat)
		 VALUES('$this->tid', '$this->username', '$this->uid', '$message', 0, '$this->timestamp', '-1', '$ufielddata', 1, '$appuserid', '$appusername', '$wechatunionid', '$wechatuserid', '$wechatusername', '$plat')");
		$apply_id = DB::insert_id();

		if($apply_id) {
			// 报名人数统计
			$result = setPassnumAndApplynum($this->tid);
			$this->logs->log_str('activity apply update applynum:'.$result['applynumber'].', passnumber:'.$result['passnumber']);
			//计算当前活动热度
			setActHot($this->tid);
			//给活动发起者发站内信通知
			if($this->activity['uid'] != $this->uid && $this->uid != $this->virtual_uid) {
				$this->model->notification_add($this->activity['uid'], 'activity', 'activity_notice', array(
					'tid' => $this->activity['tid'],
					'subject' => $this->thread['subject'],
					'fromid' => $this->uid,
					'username' => $this->username,
				));
			}

			//给app用户(活动发布者)发通知
			pushActivityMsg(12, $this->activity['uid'], 0);

			//向活动发布者(绑定微信)发送新报名通知
			sendNewActivityMsgForWechat($this->activity['uid'], $this->activity['tid'], $this->activity['title'], $realname, $mobile);

			//报完名将从感兴趣的人缓存中清除记录
			$str = '';
			if($wechatunionid && $wechatuserid && $wechatusername) {
				$str = '3|'.$wechatunionid.$this->follower_connent.$wechatuserid.'|'.$wechatusername.'|0';
			}

			if($this->uid && $this->username && $this->uid != $this->virtual_uid.'|0') {
				$str = '1|'.$this->uid.'|'.$this->username.'|0';
			}

			if($appuserid && $appusername) {
				$str = '2|'.$appuserid.'|'.$appusername.'|0';
			}

			$this->logs->log_str('follower_rem1:'.$this->tid.', str:'.$str);
			if(!empty($str)) {
				$this->logs->log_str('follower_rem2:'.$this->tid.', str:'.$str);
				$this->model->follower_rem($this->tid, $str);
			}
			//感兴趣人列表END

			$data['applyid'] = $apply_id;
			$this->logs->log_str('activity apply:'.$this->tid.', applyid:'.$apply_id);

			output_msg($data, true);
		} else {
			$this->logs->log_str('activity apply failed, tid:'.$this->tid.', mobile:'.$mobile.', nums:'.$nums.', message:'.$message.', appuserid:'.$appuserid.', appusername:'.$appusername.', appactid:'.$appactid);

			output_errorMsg(432, 'Item insert failed.', '网络连接失败，请重新尝试');
		}

	}

	// 取消报名|报名未通过
	public function applyCancel()
	{
		parent::base();

		$applyid = intval($_GET['applyid']);
		if(!$applyid) {
			output_errorMsg(423, 'Param applyid miss.', '');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		// 检查取消的用户报名人数,检查取消的记录是否为请求者
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$wechatuserid = $_GET['wechatuserid'];
		$is_myapply = $this->model->user_apply_status($this->tid, $this->uid, $appuserid, $wechatuserid);

		//验证审核者是否为本帖发起人
		$authorid = DB::result_first("SELECT authorid FROM ".DB::table("forum_thread")." WHERE tid='$this->tid'");

		$this->model->filelog('apply_cancel', $is_myapply);

		if(!$is_myapply['apply']['applyid'] && $authorid != $this->uid) {
			output_errorMsg(423, 'The applyid Don\'t exist.', '不存在此条报名信息');
		}

		if($is_myapply['apply']['applyid'] && $is_myapply['apply']['applyid'] != $applyid) {
			output_errorMsg(423, 'The operation Don\'t permitted.', '');
		}

		parent::act_info();
		if($this->activity['starttime'] < $this->timestamp) {
			output_errorMsg(423, 'The act is over. Cancel failed.', '活动已开始，无法取消报名');
		}

		$activity = unserialize($is_myapply['apply']['ufielddata']);
		$nums 	  = $activity['userfield']['field3'];
		$realname = !empty($activity['userfield']['realname']) ? $activity['userfield']['realname'] : '';

		//若是审核，则获得下申请者的userid
		if ($authorid == $this->uid) {
			$applyer = DB::result_first("SELECT uid FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' AND tid='$this->tid' ".getSlaveID());
		}

		DB::query("DELETE FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' AND tid='$this->tid'");
		$result = DB::affected_rows();

		if($result) {

			$data['result'] = 1;
			$this->logs->log_str('activity apply cancel:'.$this->tid.', applyid:'.$applyid.', nums:'.$nums);

			parent::act_info();
			//是否有未审核的
			$data['isVerified'] = $this->activity['applynumber'] - $this->activity['passnumber'] > 0 ? 1 : 0;

			//取消报名
			if ($is_myapply['apply']['uid'] == $this->uid) {
				//向活动发布者(绑定微信)发送取消报名申请通知
				sendActivityCancelMsgForWechat($this->activity['uid'], $this->activity['tid'], $this->activity['title'], $realname, '');
			} elseif ($authorid == $this->uid) {
				sendApplyFailMsgForWechat($applyer, $this->activity['title'], $this->activity['starttime'], $this->activity['place']);
			}

			output_msg($data, true);

		} else {
			output_errorMsg(433, 'activity apply cancel failed.', '网络原因请重新刷新');
		}
	}

	// 浏览活动时加入感兴趣人
	public function follower()
	{
		parent::base();

		$appusername 	= diconv($_GET['appusername'], 'utf-8', 'gbk//TRANSLIT');
		$appuserid 		= number_format($_GET['appuserid'], 0, ".", '');
		$wechatunionid  = $_GET['wechatunionid'] ? $_GET['wechatunionid'] : '';
		$wechatuserid   = $_GET['wechatuserid'] ? $_GET['wechatuserid'] : '';
		$wechatusername = diconv($_GET['wechatusername'], 'utf-8', 'gbk//TRANSLIT');

		//注意以下三种帐号有先后顺序，最终以APP帐号为准
		$str = '';
		if($wechatunionid && $wechatuserid && $wechatusername) {
			$str = '3|'.$wechatunionid.$this->follower_connent.$wechatuserid.'|'.$wechatusername.'|0';
		}

		if($this->uid && $this->username) {
			$str = '1|'.$this->uid.'|'.$this->username.'|0';
		}

		if($appuserid && $appusername) {
			$str = '2|'.$appuserid.'|'.$appusername.'|0';
		}

		if(!empty($str)) {
			$this->model->follower($this->tid, $str);
			output_msg('{"result":1}');
		} else {
			output_errorMsg(433, 'Param miss.', '');
		}
	}

	//感兴趣的人
	public function followerList()
	{
		parent::base();

		$page = max(intval($_GET['page']), 1);
		$perpage  = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$location = $_GET['location'];

		$activity = $this->model->follower_list($this->tid, $page, $perpage, $appuserid, $location);
		output_msg($activity, true);
	}

	// 我最近报名的一个活动填的报名信息，用于下次报名快速填充
	public function myApplyInfo()
	{
		$apply_where = '';
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$wechatuserid = $_GET['wechatuserid'];

		if(empty($wechatuserid) && empty($appuserid) && empty($this->uid)) {
			output_errorMsg(423, 'Param miss.', '');
		}

		if($wechatuserid) {
			$apply_where = " wechatuserid='$wechatuserid'";
		}

		if($appuserid) {
			$apply_where = " appuserid='$appuserid'";
		}

		if($this->uid) {
			$apply_where = " uid='$this->uid'";
		}

		if($apply_where) {
			$data['apply'] = DB::fetch_first("SELECT applyid, message, ufielddata FROM ".DB::table("forum_activityapply")." WHERE $apply_where ORDER BY applyid DESC LIMIT 1 ".getSlaveID());
			if($data['apply']) {
				$data['apply']['ufielddata'] = unserialize($data['apply']['ufielddata']);
				$data['apply']['realname'] = $data['apply']['ufielddata']['userfield']['realname'];
				$data['apply']['mobile'] = $data['apply']['ufielddata']['userfield']['mobile'];
				$data['apply']['nums'] = $data['apply']['ufielddata']['userfield']['field3'];
				unset($data['apply']['ufielddata']);

				output_msg($data, true);
			} else {
				output_msg('{"msg":{"code":200, "info":"Data is empty."}, "apply":""}');
			}
		}
	}

	//清除下感兴趣的人(清理数据用)
	public function delRedis()
	{
		$tid = 5194045;
		$str = '2|370886082297760|ygdtest|0';
		$this->model->follower_rem($tid, $str);
		$str = '2|368099109476000|在外测试test_001|0';
		$this->model->follower_rem($tid, $str);
		echo 'ok';
	}
	
	// 活动咨询
	public function actConsult()
	{
		$tid = $_GET['tid'];
		$contacts_mobile  = trim($_GET['mobile']);
		$wechat_no  = trim($_GET['wechat']);
		if(!$tid||($contacts_mobile==''&&$wechat_no=='')||!$_GET['ip']) {
			output_errorMsg(423, 'Param miss.', '');
		}
		
		$contacts_type = $contacts_mobile&&!$wechat_no? 0:1;
		$remarkother = diconv($_GET['remark'], 'utf-8', 'gbk//TRANSLIT');
		
		
		$data = array();
		$data['tid'] = $tid;
		$data['username'] = $_GET['username'];
		$data['uid'] = $_GET['uid'];
		$data['contype'] = $contacts_type;
		$data['remark'] = daddslashes($remarkother);
		$data['dateline'] = $_GET['dateline'];
		$data['ip'] = $_GET['ip'];

		if($contacts_type===0){
			$data['mobile'] = $contacts_mobile;
		}else if($contacts_type==1){
			$data['wechat'] = $wechat_no;
		}
		
		
		//防刷验证
	if($this->activityask_brush($data)){
		//记录ip 手机号 微信号信息(每天，防止刷单用)开始
		$this->activityask_statistics_addlog($tid,1,$_GET['ip'],1,$_GET['dateline']);
		if($contacts_type===0){
			$this->activityask_statistics_addlog($tid,2,$contacts_mobile,1,$_GET['dateline']);
		}else if($contacts_type==1){
			$this->activityask_statistics_addlog($tid,3,$wechat_no,1,$_GET['dateline']);
		}
		//记录ip 手机号 微信号信息(每天，防止刷单用)结束
		output_msg(array('consultState'=>1,'consultMsg'=>'咨询成功'), true);
	}
	
	DB::insert('forum_activity_consult', $data);
	$askid = DB::insert_id();
	if($askid){
		//记录ip 手机号 微信号信息(每天，防止刷单用)开始
		$this->activityask_statistics_addlog($tid,1,$_GET['ip'],1,$_GET['dateline']);
		if($contacts_type===0){
			$this->activityask_statistics_addlog($tid,2,$contacts_mobile,1,$_GET['dateline']);
		}else if($contacts_type==1){
			$this->activityask_statistics_addlog($tid,3,$wechat_no,1,$_GET['dateline']);
		}
		//记录ip 手机号 微信号信息(每天，防止刷单用)结束
		$activity = DB::fetch(DB::query("SELECT uid, expiration, ufield, credit, title,mobile FROM ".DB::table('forum_activity')." WHERE tid='$tid'"));
		if($activity['mobile']){
			$contacts_info = $contacts_mobile?"手机号".$contacts_mobile:"微信号".$wechat_no;
			$remarkstr = $remarkother?'备注：'.$remarkother.'，':'';
			$send_msg_content = iconv('GB2312', 'UTF-8',"8264提醒您，{$contacts_info}的用户正在咨询活动：{$activity['title']}，{$remarkstr}请尽快联系。");
			$send_msg_res = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=send_msg&tel=".$activity['mobile']."&content=".$send_msg_content);
		}
		output_msg(array('consultState'=>1,'consultMsg'=>'咨询成功'), true);
	}
		
		
	}
	
	
	function activityask_brush($data=array()){
		$currdate = strtotime(date('Y-m-d', $data['dateline']));
		//同ip某一活动某天最多三次咨询入库
		$ipcounts =DB::result_first("SELECT counts FROM " . DB::table('forum_activity_consult_statistics') . " where tid={$data[tid]} and data_val = '{$data[ip]}' and data_type = 1 and datetime = {$currdate} " . getSlaveID());
		if($ipcounts>3){
			return true;
			die;
		}
		//1分钟某一活动相同信息重复提交验证开始
		if($data['contype']===0){
			$mobilecounts =DB::result_first("SELECT COUNT(*) FROM " . DB::table('forum_activity_consult') . " where tid={$data[tid]} and mobile = '{$data[mobile]}' and dateline > ".($data['dateline']-10)." " . getSlaveID());
			if($mobilecounts>0){
				return true;
				die;
			}
		}elseif($data['contype']==1){
			$wechatnocounts =DB::result_first("SELECT COUNT(*) FROM " . DB::table('forum_activity_consult') . " where tid={$data[tid]} and wechat = '{$data[wechat]}' and dateline > ".($data['dateline']-10)." " . getSlaveID());
			if($wechatnocounts>0){
				return true;
				die;
			}
		}	

		return false;
	}


	function activityask_statistics_addlog($tid,$type,$data_val,$q,$dateline){
			$currdate = strtotime(date('Y-m-d', $dateline));
			$data =DB::fetch_first("SELECT * FROM " . DB::table('forum_activity_consult_statistics') . " where tid={$tid} and data_val = '{$data_val}' and data_type = {$type} and datetime = {$currdate} " . getSlaveID());

			if($data){
				DB::update('forum_activity_consult_statistics', array('counts'=>($data['counts']+$q)), "id={$data['id']}");
			}else{
				DB::insert('forum_activity_consult_statistics', array(
					'tid' => $tid,
					'counts' => $q,
					'data_val' => $data_val,
					'data_type' => $type,
					'datetime' => $currdate
					));
			}

		}
	
	

}

?>
