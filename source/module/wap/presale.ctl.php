<?php
/**
 * ��èԤ�ۣ��ֻ������ݴ���
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class PresaleCtl extends FrontendCtl{

	private $redis;

	function __construct()
	{
		parent::__construct();

		require_once libfile('class/myredis');
		$this->redis = & myredis::instance(6381);
	}

	//ȡ�õǼ�����
	function getdata()
	{
		$returnData = array();
		$returnData['presale_num'] = $this->redis->obj->get('presale_num');

		if($returnData['presale_num']) {
			$returnData['msg'] = 200;
			$returnData['info'] = 'Get data sucess.';
		} else {
			$returnData['msg'] = 0;
			$returnData['info'] = 'Get data error.';
			$returnData['presale_num'] = 9999;
		}
		encodeData($returnData);
	}

	//��������
	function postdata(){

		$uid = $_POST['uid'] ? $_POST['uid'] : 0;
		$ip = $_POST['ip'];
		$dateline = TIMESTAMP;
		$tel = $_POST['tel'];

		//һ��IP�Ǽǳ���10�������Զ��Թ�
		$log_count = DB::result_first("SELECT count(*) FROM ".DB::table("plugin_presale_log")." WHERE ip='$ip' ".getSlaveID());
		if($log_count > 10 && $ip != '111.160.225.106') {
			file_put_contents(DISCUZ_ROOT."./data/dlogs/presale.log", "{$tel}\tmip:{$ip}\t{$log_count}\ttime:".date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
			encodeData(array('msg' => '1', 'info' => 'Log it sucess.'));
		}

		//�Ǽǹ���
		$log_result = DB::result_first("SELECT id FROM ".DB::table("plugin_presale_log")." WHERE tel='$tel' ".getSlaveID());
		if($log_result) {
			encodeData(array('msg' => '-2', 'info' => 'Logged it.'));
		}

		DB::query("INSERT INTO ".DB::table("plugin_presale_log")."(`uid`, `tel`, `ip`, `dateline`) VALUES('$uid', '$tel', '$ip', '$dateline')");
		$id = DB::insert_id();
		if($id) {
			$this->redis->obj->incrby('presale_num', 1);
			encodeData(array('msg' => '1', 'info' => 'Log it sucess.'));
		} else {
			encodeData(array('msg' => '-3', 'info' => 'Log it failed.'));	//���������쳣
		}
	}



}
?>
