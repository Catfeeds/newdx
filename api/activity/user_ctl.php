<?php

/**
* ��û�����
*/


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require DISCUZ_ROOT.'api/activity/thread_ctl.php';

class user extends thread
{
	private $virtual_uid = 40269021;
	private $virtual_username = '�����û�';
	private $follower_connent = '#zaiwaiapp#';

	function __construct()
	{
		parent::__construct();
	}

	// �ҷ����Ļ
	public function myActList()
	{
		if(!$this->uid) {
			output_errorMsg(423, 'Unknown user info.', '');
		}

		$page 	   = max(intval($_GET['page']), 1);
		$perpage   = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start     = ($page-1)*$perpage;
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$tid	= $_GET['tid']; //�ҵ����tid��λ��

		//��������
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
				case 1: //������
					$conditions[] = "a.expiration > {$this->timestamp} and a.passnumber < a.number";
					break;
				case 2: //����Ա
					$conditions[] = "a.expiration > {$this->timestamp} and a.passnumber = a.number";
					break;
				case 3: //��������
					$conditions[] = "a.expiration <= {$this->timestamp}";
					break;
//				case 4: //���
//					$conditions[] = "a.starttimefrom <= {$this->timestamp} and a.starttimeto > {$this->timestamp}";
//					break;
//				case 5: //�����
//					$conditions[] = "a.starttimeto <= ".$this->timestamp;
//					break;
			}
			
			if($row['exptime'] > $this->timestamp) { //������
				$row['status'] = "������";
				if($row['passnumber'] == $row['number']){
					$row['status'] = "����Ա";
				}
			} else{
				$row['status'] = "��������";
			}
		}
		$conditions[] = "(displayorder>=0 OR t.displayorder IN (-4, -3, -2))";
		if($conditions){
			$wheresql = " and ".implode(" and ", $conditions);
		}

		$list = array();
		$sql = "SELECT t.tid, t.subject, t.dateline, t.fid, t.displayorder, a.aid, a.title, a.cost, a.starttimefrom as starttime, a.starttimeto as endtime, a.place, a.collectplace, a.number, a.applynumber, a.passnumber, a.expiration as exptime, a.nature, a.formid FROM ".DB::table("forum_activity")." AS a
				INNER JOIN ".DB::table("forum_thread")." AS t ON t.tid=a.tid
				WHERE a.tid > 5161751 AND a.credit = 0 AND t.authorid = {$this->uid} $wheresql". getSlaveID(); //ĳЩ�֮��� ����Ҫ���ֵ�XXX�
		$query = DB::query($sql);

		while($row = DB::fetch($query)){
			//�״̬ ��Ϊ�δ��ʼ�ͻ�����кͻ��������״̬
			if($row['exptime'] > $this->timestamp) { //������
				$row['status'] = "������";
				if($row['passnumber'] == $row['number']){
					$row['status'] = "����Ա";
				}
			} elseif ($row['starttime'] > $this->timestamp) {
				$row['status'] = "��������";
			} elseif ($row['starttime'] <= $this->timestamp && $row['endtime'] > $this->timestamp) {
				$row['status'] = "���";
			} elseif ($row['endtime'] <= $this->timestamp) {
				$row['status'] = "�����";
			}

			//�Ƿ���δ��˵�
			$row['isVerified'] 		= $row['applynumber'] - $row['passnumber'] > 0 ? 1 : 0;
			$row['isEdit']     		= $row['endtime'] < $this->timestamp ? 0 : 1;
			$row['displayorder']    = intval($row['displayorder']);

			//��ʽ��ʱ��
			$row['dateline_f']  = date("YmdHis", $row['dateline']);
			$row['starttime_f'] = date("YmdHis", $row['starttime']);
			$row['endtime_f']   = date("YmdHis", $row['endtime']);
			$row['exptime_f']   = date("YmdHis", $row['exptime']);

			//���ԭͼ
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
		
		//���tid���� ����tid�������е�λ�� ��Ϊ�����������ԡ�
		if($tid){
			$find = false;
			foreach ($list as $tidindex => $info) {
				if($info['tid'] == $tid){
					$find = true;
					break;
				}
			}
			if($find){ //��������ҳ��
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

		//��app�û����֪ͨ
		//cleanActivityMsg(12, $appuserid);

		output_msg($data, true);
	}

	// �ұ�����
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
				$row['status'] = "�����ɹ�";
			} elseif($row['verified'] == 2) {
				$row['status'] = "���ϲ�ȫ";
			} else {
				$row['status'] = "�����";
			}
			// if ($row['endtime'] < $this->timestamp) {
			// 	$row['status'] = "�����";
			// }

			//��ȡ��������ť״̬
			$row['isCancel'] = $row['starttime'] < $this->timestamp ? 0 : 1;
			//�������APPUID
			$leader = $this->model->leader_info($row['authorid']);
			$row['leaderId'] = $leader['appuserid'] ? $leader['appuserid'] : '';

			//��ʽ��ʱ��
			$row['dateline_f']  = date("YmdHis", $row['dateline']);
			$row['starttime_f'] = date("YmdHis", $row['starttime']);
			$row['endtime_f']   = date("YmdHis", $row['endtime']);
			$row['exptime_f']   = date("YmdHis", $row['exptime']);
			$row['applytime_f'] = date("YmdHis", $row['applytime']);

			$list[] = $row;
		}

		$list = $this->model->multi_array_sort($list, 'applytime', SORT_DESC);
		$listCount = count($list);

		//�ұ����Ļ��
		$data['applyNums'] = count($list);

		//δ��˵Ļ��
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

		//��app�û����֪ͨ
		cleanActivityMsg(13, $appuserid);

		output_msg($data, true);
	}

	//ָ����µı����б�
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

			//��̳�û�
			if($row['uid'] != $this->virtual_uid) {
				$row['avatar'] = avatar($row['uid'], 'middle', true);
			}

			//΢���û�
			if($row['wechatuserid']) {
				$wechat_result = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$wechat_token."&openid=".$row['wechatuserid']."&lang=zh_CN");
				$wechat_result = json_decode($wechat_result, true);
				$row['avatar'] = $wechat_result['headimgurl'] ? $wechat_result['headimgurl'] : 'http://static.8264.com/wei/images/default.png';
				$row['username'] = $row['wechatusername'];
			}

			//APP�û�
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
				$row['status'] = "��ͨ��";
			} elseif($row['verified'] == 2) {
				$row['status'] = "���ϲ�ȫ";
			} else {
				$row['status'] = "�����";
			}

			//��ʽ��ʱ��
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

	// ��˱���
	public function applyVerify()
	{
		parent::base();
		$applyid = intval($_GET['applyid']);
		if(!$applyid) {
			output_errorMsg(423, 'Param applyid miss.', '');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '�û�Ȩ�ޱ���ֹ������ϵ8264�ͷ�');
		}

		//��֤������Ƿ�Ϊ����������
		$authorid = DB::result_first("SELECT authorid FROM ".DB::table("forum_thread")." WHERE tid='{$this->tid}'");
		if($authorid != $this->uid) {
			output_errorMsg(431, 'Operator is not author.', '');
		}

		DB::query("UPDATE ".DB::table("forum_activityapply")." SET verified='1' WHERE applyid='{$applyid}'");
		if(DB::affected_rows()) {
			//���û���վ����֪ͨ

			parent::act_info();
			//�Ƿ���δ��˵�
			$data = array();
			$data['isVerified'] = $this->activity['applynumber'] - $this->activity['passnumber'] > 0 ? 1 : 0;
			$data['result'] 	= 1;

			//��app�û�(�������)��֪ͨ
			$applyShow = DB::fetch_first("SELECT appuserid, uid, tid FROM ".DB::table("forum_activityapply")." WHERE applyid={$applyid} " .getSlaveID());
			pushActivityMsg(13, $applyShow['uid'], $applyShow['appuserid']);

			//��������(��΢��)���ͻ�����ɹ�֪ͨ
			$activity = DB::fetch_first("SELECT title, clubname FROM ".DB::table('forum_activity')." WHERE tid='{$applyShow['tid']}'");
			sendApplySuccessMsgForWechat($applyShow['uid'], $activity['title'], $activity['clubname']);

			output_msg($data, true);
		} else {
			output_errorMsg(431, 'Verify activity failed.', '����ԭ��������ˢ��');
		}
	}

	// �����
	public function apply()
	{
		parent::base();

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '�û�Ȩ�ޱ���ֹ������ϵ8264�ͷ�');
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
			output_errorMsg(423, 'Param realname/mobile/nums/*userid/*appusername empty.', '������Ϣ��д������');
		}

		$user_apply_status = $this->model->user_apply_status($this->tid, $this->uid, $appuserid, $wechatuserid);
		if($user_apply_status['apply']['applyid']) {
			output_errorMsg(433, 'This user was applyed.', '���Ѿ���������');
		}

		parent::act_info();
		// ��ѹ���
		if($this->activity['exptime'] && ($this->activity['exptime'] < $this->timestamp)) {
			output_errorMsg(433, 'The activity was expired.', '��ѹ���');
		}

		// ��ѿ�ʼ
		if($this->activity['starttime'] && ($this->activity['starttime'] < $this->timestamp)) {
			output_errorMsg(434, 'The activity was started.', '��ѿ�ʼ');
		}

		// �������
		if($this->activity['number'] && ($this->activity['number']-$this->activity['passnumber'] < $nums)) {
			output_errorMsg(434, 'The activity was started.', '��ѱ���');
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
		//������û���̳��Ϣ������̳ID������������ID
		$this->uid = $this->uid ? $this->uid : $this->virtual_uid;
		$this->username = $this->username ? $this->username : $this->virtual_username;

		// ���ӱ�����¼
		DB::query("INSERT INTO ".DB::table("forum_activityapply")." (tid, username, uid, message, verified, dateline, payment, ufielddata, isshow, appuserid, appusername, wechatunionid, wechatuserid, wechatusername, plat)
		 VALUES('$this->tid', '$this->username', '$this->uid', '$message', 0, '$this->timestamp', '-1', '$ufielddata', 1, '$appuserid', '$appusername', '$wechatunionid', '$wechatuserid', '$wechatusername', '$plat')");
		$apply_id = DB::insert_id();

		if($apply_id) {
			// ��������ͳ��
			$result = setPassnumAndApplynum($this->tid);
			$this->logs->log_str('activity apply update applynum:'.$result['applynumber'].', passnumber:'.$result['passnumber']);
			//���㵱ǰ��ȶ�
			setActHot($this->tid);
			//��������߷�վ����֪ͨ
			if($this->activity['uid'] != $this->uid && $this->uid != $this->virtual_uid) {
				$this->model->notification_add($this->activity['uid'], 'activity', 'activity_notice', array(
					'tid' => $this->activity['tid'],
					'subject' => $this->thread['subject'],
					'fromid' => $this->uid,
					'username' => $this->username,
				));
			}

			//��app�û�(�������)��֪ͨ
			pushActivityMsg(12, $this->activity['uid'], 0);

			//��������(��΢��)�����±���֪ͨ
			sendNewActivityMsgForWechat($this->activity['uid'], $this->activity['tid'], $this->activity['title'], $realname, $mobile);

			//���������Ӹ���Ȥ���˻����������¼
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
			//����Ȥ���б�END

			$data['applyid'] = $apply_id;
			$this->logs->log_str('activity apply:'.$this->tid.', applyid:'.$apply_id);

			output_msg($data, true);
		} else {
			$this->logs->log_str('activity apply failed, tid:'.$this->tid.', mobile:'.$mobile.', nums:'.$nums.', message:'.$message.', appuserid:'.$appuserid.', appusername:'.$appusername.', appactid:'.$appactid);

			output_errorMsg(432, 'Item insert failed.', '��������ʧ�ܣ������³���');
		}

	}

	// ȡ������|����δͨ��
	public function applyCancel()
	{
		parent::base();

		$applyid = intval($_GET['applyid']);
		if(!$applyid) {
			output_errorMsg(423, 'Param applyid miss.', '');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '�û�Ȩ�ޱ���ֹ������ϵ8264�ͷ�');
		}

		// ���ȡ�����û���������,���ȡ���ļ�¼�Ƿ�Ϊ������
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$wechatuserid = $_GET['wechatuserid'];
		$is_myapply = $this->model->user_apply_status($this->tid, $this->uid, $appuserid, $wechatuserid);

		//��֤������Ƿ�Ϊ����������
		$authorid = DB::result_first("SELECT authorid FROM ".DB::table("forum_thread")." WHERE tid='$this->tid'");

		$this->model->filelog('apply_cancel', $is_myapply);

		if(!$is_myapply['apply']['applyid'] && $authorid != $this->uid) {
			output_errorMsg(423, 'The applyid Don\'t exist.', '�����ڴ���������Ϣ');
		}

		if($is_myapply['apply']['applyid'] && $is_myapply['apply']['applyid'] != $applyid) {
			output_errorMsg(423, 'The operation Don\'t permitted.', '');
		}

		parent::act_info();
		if($this->activity['starttime'] < $this->timestamp) {
			output_errorMsg(423, 'The act is over. Cancel failed.', '��ѿ�ʼ���޷�ȡ������');
		}

		$activity = unserialize($is_myapply['apply']['ufielddata']);
		$nums 	  = $activity['userfield']['field3'];
		$realname = !empty($activity['userfield']['realname']) ? $activity['userfield']['realname'] : '';

		//������ˣ������������ߵ�userid
		if ($authorid == $this->uid) {
			$applyer = DB::result_first("SELECT uid FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' AND tid='$this->tid' ".getSlaveID());
		}

		DB::query("DELETE FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' AND tid='$this->tid'");
		$result = DB::affected_rows();

		if($result) {

			$data['result'] = 1;
			$this->logs->log_str('activity apply cancel:'.$this->tid.', applyid:'.$applyid.', nums:'.$nums);

			parent::act_info();
			//�Ƿ���δ��˵�
			$data['isVerified'] = $this->activity['applynumber'] - $this->activity['passnumber'] > 0 ? 1 : 0;

			//ȡ������
			if ($is_myapply['apply']['uid'] == $this->uid) {
				//��������(��΢��)����ȡ����������֪ͨ
				sendActivityCancelMsgForWechat($this->activity['uid'], $this->activity['tid'], $this->activity['title'], $realname, '');
			} elseif ($authorid == $this->uid) {
				sendApplyFailMsgForWechat($applyer, $this->activity['title'], $this->activity['starttime'], $this->activity['place']);
			}

			output_msg($data, true);

		} else {
			output_errorMsg(433, 'activity apply cancel failed.', '����ԭ��������ˢ��');
		}
	}

	// ����ʱ�������Ȥ��
	public function follower()
	{
		parent::base();

		$appusername 	= diconv($_GET['appusername'], 'utf-8', 'gbk//TRANSLIT');
		$appuserid 		= number_format($_GET['appuserid'], 0, ".", '');
		$wechatunionid  = $_GET['wechatunionid'] ? $_GET['wechatunionid'] : '';
		$wechatuserid   = $_GET['wechatuserid'] ? $_GET['wechatuserid'] : '';
		$wechatusername = diconv($_GET['wechatusername'], 'utf-8', 'gbk//TRANSLIT');

		//ע�����������ʺ����Ⱥ�˳��������APP�ʺ�Ϊ׼
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

	//����Ȥ����
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

	// �����������һ�����ı�����Ϣ�������´α����������
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

	//����¸���Ȥ����(����������)
	public function delRedis()
	{
		$tid = 5194045;
		$str = '2|370886082297760|ygdtest|0';
		$this->model->follower_rem($tid, $str);
		$str = '2|368099109476000|�������test_001|0';
		$this->model->follower_rem($tid, $str);
		echo 'ok';
	}
	
	// ���ѯ
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
		
		
		//��ˢ��֤
	if($this->activityask_brush($data)){
		//��¼ip �ֻ��� ΢�ź���Ϣ(ÿ�죬��ֹˢ����)��ʼ
		$this->activityask_statistics_addlog($tid,1,$_GET['ip'],1,$_GET['dateline']);
		if($contacts_type===0){
			$this->activityask_statistics_addlog($tid,2,$contacts_mobile,1,$_GET['dateline']);
		}else if($contacts_type==1){
			$this->activityask_statistics_addlog($tid,3,$wechat_no,1,$_GET['dateline']);
		}
		//��¼ip �ֻ��� ΢�ź���Ϣ(ÿ�죬��ֹˢ����)����
		output_msg(array('consultState'=>1,'consultMsg'=>'��ѯ�ɹ�'), true);
	}
	
	DB::insert('forum_activity_consult', $data);
	$askid = DB::insert_id();
	if($askid){
		//��¼ip �ֻ��� ΢�ź���Ϣ(ÿ�죬��ֹˢ����)��ʼ
		$this->activityask_statistics_addlog($tid,1,$_GET['ip'],1,$_GET['dateline']);
		if($contacts_type===0){
			$this->activityask_statistics_addlog($tid,2,$contacts_mobile,1,$_GET['dateline']);
		}else if($contacts_type==1){
			$this->activityask_statistics_addlog($tid,3,$wechat_no,1,$_GET['dateline']);
		}
		//��¼ip �ֻ��� ΢�ź���Ϣ(ÿ�죬��ֹˢ����)����
		$activity = DB::fetch(DB::query("SELECT uid, expiration, ufield, credit, title,mobile FROM ".DB::table('forum_activity')." WHERE tid='$tid'"));
		if($activity['mobile']){
			$contacts_info = $contacts_mobile?"�ֻ���".$contacts_mobile:"΢�ź�".$wechat_no;
			$remarkstr = $remarkother?'��ע��'.$remarkother.'��':'';
			$send_msg_content = iconv('GB2312', 'UTF-8',"8264��������{$contacts_info}���û�������ѯ���{$activity['title']}��{$remarkstr}�뾡����ϵ��");
			$send_msg_res = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=send_msg&tel=".$activity['mobile']."&content=".$send_msg_content);
		}
		output_msg(array('consultState'=>1,'consultMsg'=>'��ѯ�ɹ�'), true);
	}
		
		
	}
	
	
	function activityask_brush($data=array()){
		$currdate = strtotime(date('Y-m-d', $data['dateline']));
		//ͬipĳһ�ĳ�����������ѯ���
		$ipcounts =DB::result_first("SELECT counts FROM " . DB::table('forum_activity_consult_statistics') . " where tid={$data[tid]} and data_val = '{$data[ip]}' and data_type = 1 and datetime = {$currdate} " . getSlaveID());
		if($ipcounts>3){
			return true;
			die;
		}
		//1����ĳһ���ͬ��Ϣ�ظ��ύ��֤��ʼ
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
