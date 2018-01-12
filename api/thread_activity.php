<?php
/**
 *  在外App推送活动报名人数据
 */

require '../source/class/class_core.php';
require '../source/function/function_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

$appname = $_GET['appname'];  //请求的APP
$sign = $_GET['sign'];  //请求的签名
$qt = intval($_GET['qt']);  //请求的时间戳 单位：秒
$api_url = 'http://bbs.8264.com/api/thread_activity.php';

define("ZAIWAI_API_URL", $_G['config']['zaiwaiapi']['url']);
define("ZAIWAI_API_TOKEN", $_G['config']['zaiwaiapi']['token']);

function output_msg($msg) {
	header('Content-type: application/json');
	exit($msg);
}

// 日志记录
require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
$logs = new logs('activity_to_app');

// 在外APP KEY 在config_global中配置，此处强制验证app为zaiwaiapp是否合法
if($appname != 'zaiwaiapp') {
	$logs->log_str('appname param error.');
	output_msg('{"msg":{"code":410, "info":"Invalid app."}}');
}

// 签名过期限制10分钟
$timestamp = time();
if(abs($timestamp - $qt) > 600) {
	$logs->log_str('Request time is too long.');
	output_msg('{"msg":{"code":422, "info":"Request time is too long."}}');
}

// 验证签名有效性
if(!sign_test($appname, $sign)) {
	$logs->log_str($_SERVER['QUERY_STRING']);
	$logs->log_str('Invalid signature.');
	output_msg('{"msg":{"code":411, "info":"Invalid signature."}}');
}

$c = $_GET['c'];
$m = $_GET['m'];

if(!in_array($c, array('thread', 'user'))) {
	$logs->log_str('Param c error.');
	output_msg('{"msg":{"code":423, "info":"Param c error."}}');
}

require DISCUZ_ROOT.'./source/function/function_activity.php';

$obj = new $c;

if(!method_exists($obj, $m)) {
	$logs->log_str('Request param m error. c:'.$c.', m:'.$m);
	output_msg('{"msg":{"code":423, "info":"Request param m error."}}');
}

$obj->$m();


/**
* 活动帖子操作
*/
class thread
{
	public $tid;
	public $thread;
	public $activity;
	public $timestamp;
	public $logs;

	function __construct()
	{
		$this->timestamp = time();
		$this->logs = new logs('activity_to_app');
	}

	function base()
	{
		$tid = intval($_GET['tid']);
		if(!$tid) {
			output_msg('{"msg":{"code":423, "info":"Param tid miss."}}');
		}

		$this->thread = DB::fetch_first("SELECT tid, special FROM ".DB::table("forum_thread")." WHERE tid='$tid' ".getSlaveID());
		if(!$this->thread['tid'] || $this->thread['special'] != 4) {
			output_msg('{"msg":{"code":431, "info":"Thread don\'t exist or type error."}}');
		}
		$this->tid = $this->thread['tid'];
	}

	function activity_info()
	{
		//校正报名人数
		setPassnumAndApplynum($this->tid);
		$this->activity = DB::fetch_first("SELECT tid, starttimefrom as starttime, starttimeto as endtime, number, applynumber, passnumber, expiration as exptime FROM ".DB::table("forum_activity")." WHERE tid='$this->tid' ".getSlaveID());
	}

	// 检查活动帖状态
	function status()
	{
		$this->base();
		$this->activity_info();

		$data = array();
		$data['msg'] = array("code" => 200, "info" => "Return data success.");
		$data['data'] = $this->activity;
		output_msg(json_encode($data));
	}
}

/**
* 活动用户操作
*/
class user extends thread
{
	public $virtual_uid = 40269021;
	public $virtual_username = '在外用户';

	function __construct()
	{
		parent::__construct();
	}

	// 活动报名
	function apply()
	{
		parent::base();
		// $realname = $_G['gp_realname'];
		$mobile = $_POST['mobile'];
		$nums = intval($_POST['nums']);
		$message = diconv($_POST['message'], 'utf-8', 'gbk');
		$appuserid = number_format($_POST['appuserid'], 0, ".", '');
		$appusername = diconv($_POST['appusername'], 'utf-8', 'gbk');
		$appactid = number_format($_POST['appactid'], 0, ".", '');

		if(!$nums || !$mobile || !$appuserid || !$appusername || !$appactid) {
			output_msg('{"msg":{"code":423, "info":"Param mobile/nums/appuserid/appusername/appactid empty."}}');
		}

		parent::activity_info();
		// 活动已过期
		if($this->activity['expiration'] && ($this->activity['expiration'] < $this->timestamp)) {
			output_msg('{"msg":{"code":433, "info":"The activity was expired."}}');
		}

		// 活动已开始
		if($this->activity['starttime'] && ($this->activity['starttime'] < $this->timestamp)) {
			output_msg('{"msg":{"code":434, "info":"The activity was started."}}');
		}

		// 超活动人数
		if($this->activity['number'] && ($this->activity['number']-$this->activity['passnumber'] < $nums)) {
			output_msg('{"msg":{"code":434, "info":"More than the maximum number."}}');
		}

		$ufielddata = serialize(array('userfield' => array(
								'mobile' => $mobile,
								'field3' => $nums)
								));

		// 增加报名记录
		DB::query("INSERT INTO ".DB::table("forum_activityapply")." (tid, username, uid, message, verified, dateline, payment, ufielddata, isshow, appuserid, appusername, appactid, plat)
		 VALUES('$this->tid', '$this->virtual_username', '$this->virtual_uid', '$message', 0, '$this->timestamp', '-1', '$ufielddata', 1, '$appuserid', '$appusername', '$appactid', 2)");
		$apply_id = DB::insert_id();

		if($apply_id) {
			// 报名人数统计
			$result = setPassnumAndApplynum($this->tid);
			$this->logs->log_str('activity apply update applynum:'.$result['applynumber'].', passnumber:'.$result['passnumber']);

			$data['msg'] = array("code" => 200, "info" => "Return data success.");
			$data['data'] = $apply_id;
			$this->logs->log_str('activity apply:'.$this->tid.', applyid:'.$apply_id);
		} else {
			$data['msg'] = array("code" => 432, "info" => "Item insert failed.");
			$this->logs->log_str('activity apply failed, tid:'.$this->tid.', mobile:'.$mobile.', nums:'.$nums.', message:'.$message.', appuserid:'.$appuserid.', appusername:'.$appusername.', appactid:'.$appactid);
		}
		output_msg(json_encode($data));
	}

	// 取消报名
	function apply_cancel()
	{
		parent::base();

		$applyid = intval($_GET['applyid']);
		if(!$applyid) {
			output_msg('{"msg":{"code":423, "info":"Param applyid miss."}}');
		}

		// 检查取消的用户报名人数
		$the_activity = DB::fetch_first("SELECT verified, ufielddata, appactid FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' AND tid='$this->tid' ".getSlaveID());
		if(!$the_activity) {
			output_msg('{"msg":{"code":423, "info":"The applyid Don\'t exist."}}');
		}

		$activity = unserialize($the_activity['ufielddata']);
		$nums = $activity['userfield']['field3'];

		DB::query("DELETE FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' AND tid='$this->tid'");
		$result = DB::affected_rows();

		if($result) {
			$apply_nums = setPassnumAndApplynum($this->tid);
			$this->logs->log_str('activity apply update applynum:'.$apply_nums['applynumber'].', passnumber:'.$apply_nums['passnumber']);
			// 如果已被审核，报名人数重新计算 查数据记录中，审核完也没有加数，这里暂时取消计数操作
			if($the_activity['verified']) {
				$apply_pass = $apply_nums['passnumber']+1;

				// 申请接口，同步报名人数
				$zwappShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_zwapp')." WHERE tid='$this->tid' ".getSlaveID());
				$request_result = requestRemoteData(ZAIWAI_API_URL."activitieService/updateActivitieBatchEnrollCount?activitieBatchId={$zwappShow['appabid']}&count={$apply_pass}&sToken=".ZAIWAI_API_TOKEN);
				$this->logs->log_str(ZAIWAI_API_URL."activitieService/updateActivitieBatchEnrollCount?activitieBatchId={$zwappShow['appabid']}&count={$apply_pass}&sToken=".ZAIWAI_API_TOKEN);
				$this->logs->log_str('activity sync nums:'.$request_result);
			}

			$data['msg'] = array("code" => 200, "info" => "Apply cancel success.");
			$data['data'] = $result;
			$this->logs->log_str('activity apply cancel:'.$this->tid.', applyid:'.$applyid.', nums:'.$nums);

		} else {
			$data['msg'] = array("code" => 433, "info" => "Apply cancel failed.");
			$this->logs->log_str('activity apply cancel failed:'.$this->tid.', applyid:'.$applyid.', nums:'.$nums);
		}
		output_msg(json_encode($data));
	}
}
