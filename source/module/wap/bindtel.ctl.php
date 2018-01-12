<?php
/**
 * �ֻ��Ű�
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class BindtelCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();

	}

	function  bindCode(){
		global $_G;

		if(empty($_G['gp_telphone'])) { encodeData(array('result'=>'-1')); }
		if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $_G['gp_telphone'])) { encodeData(array('result'=>'-2')); }

		if(empty($_G['gp_geetest_challenge']) || empty($_G['gp_geetest_validate']) || empty($_G['gp_geetest_seccode'])) {
			encodeData(array('result'=>'-3'));
		} else {
			//У�黬����֤�룬��Ӫ��Ҫ�󣬷�������������
			$gt_test = array('geetest_challenge' => $_G['gp_geetest_challenge'], 'geetest_validate' => $_G['gp_geetest_validate'], 'geetest_seccode' => $_G['gp_geetest_seccode']);
			if(!check_geetest($gt_test)) {
				encodeData(array('result'=>'-4'));
			}
		}
        //�����ֻ����Ƿ�󶨹��˺�
        $telcheck = DB::result_first('SELECT count(*) FROM '.DB::table('common_member')." WHERE telephone = '$_G[gp_telphone]'");
        if($telcheck) { encodeData(array('result'=>'-10')); }

		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$sendcode_count = $redis->obj->get("bbsbindtel_count_".$_G['uid']);
		if($sendcode_count > 5) {
			encodeData(array('result'=>'-7')); //���͹���Ƶ��
		}

		$telcode = mt_rand(1000, 9999);
		$redis->obj->set("bbsbindtel_".$_G['uid'], $_G['gp_telphone'].$telcode, 1200);

		require_once libfile('class/sms');
		$sms = new sms;

		$msg_data['mobile'] = $_G['gp_telphone'];
		$msg_data['text'] = "������֤���� {$telcode}��20��������Ч����Ǳ��˷��ͣ������";
		$sms_result = $sms->send($msg_data);
		if($sms_result['httpcode'] == 200) {
			if($sms_result['data']['code'] == 0) {
				$redis->obj->incr("bbsbindtel_count_".$_G['uid']);
				$redis->obj->expire("bbsbindtel_count_".$_G['uid'], 43200);

				$logs_msg = "m|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
				require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
				$logs = new logs('sendtelcode');
				$logs->log_str($logs_msg);

				encodeData(array('result'=>1));
			}else{
				$logs_msg = "m|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
				require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
				$logs = new logs('sendtelcode');
				$logs->log_str($logs_msg);

				if($sms_result['data']['code'] == 33) {
					encodeData(array('result'=>'-8'));
				} else if($sms_result['data']['code'] == 22) {
					encodeData(array('result'=>'-9'));
				} else {
					encodeData(array('result'=>'-5'));
				}
			}
		}else{
			$logs_msg = "m|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);
			encodeData(array('result'=>'-6'));
		}

		encodeData(array('result'=>1));
	}

	//���ֻ�
	function bindOp(){
		global $_G;

		if(empty($_G['gp_telphone'])) { encodeData(array('result'=>'-1')); }
		if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/", $_G['gp_telphone'])) { encodeData(array('result'=>'-2')); }
		if(empty($_G['gp_telcode'])) { encodeData(array('result'=>'-3')); }

		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$codelog = $redis->obj->get("bbsbindtel_".$_G['uid']);
		$waittest = $_G['gp_telphone'].$_G['gp_telcode'];
		if($waittest != $codelog) { encodeData(array('result'=>'-4')); }
		//�����ֻ����Ƿ�󶨹��˺�
		$telcheck = DB::result_first('SELECT count(*) FROM '.DB::table('common_member')." WHERE telephone = '$_G[gp_telphone]'");
		if($telcheck) { encodeData(array('result'=>'-5')); }

		DB::query('UPDATE '.DB::table('common_member')." SET telephone='$_G[gp_telphone]', telstatus=1 WHERE uid='$_G[uid]'");
		encodeData(array('result'=>1));
	}

	//���ֻ��ŷ���֤��
	function sendtelcodeold(){
		global $_G;

		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$sendcode_count = $redis->obj->get("bbsbindtel_count_".$_G['uid']);
		if($sendcode_count > 5) {
			encodeData(array('result'=>'-7')); //���͹���Ƶ��
		}

		$telcode = mt_rand(1000, 9999);
		$telephone = DB::result_first('SELECT telephone FROM '.DB::table('common_member')." WHERE uid = '$_G[uid]'");

		$redis->obj->set("bbsbindtelold_".$_G['uid'], $telephone.$telcode, 1200);

		require_once libfile('class/sms');
		$sms = new sms;

		$msg_data['mobile'] = $telephone;
		$msg_data['text'] = "������֤���� {$telcode}��20��������Ч����Ǳ��˷��ͣ������";
		$sms_result = $sms->send($msg_data);
		if($sms_result['httpcode'] == 200) {
			if($sms_result['data']['code'] == 0) {
				$redis->obj->incr("bbsbindtel_count_".$_G['uid']);
				$redis->obj->expire("bbsbindtel_count_".$_G['uid'], 43200);

				$logs_msg = "m|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
				require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
				$logs = new logs('sendtelcode');
				$logs->log_str($logs_msg);

				encodeData(array('result'=>1));
			}else{
				$logs_msg = "m|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
				require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
				$logs = new logs('sendtelcode');
				$logs->log_str($logs_msg);

				if($sms_result['data']['code'] == 33) {
					encodeData(array('result'=>'-8'));
				} else if($sms_result['data']['code'] == 22) {
					encodeData(array('result'=>'-9'));
				} else {
					encodeData(array('result'=>'-5'));
				}
			}
		}else{
			$logs_msg = "m|{$_G['uid']}|{$_G['clientip']}|{$sms_result['httpcode']}|{$msg_data['mobile']}|{$msg_data['text']}|".var_export($sms_result['data'], true);
			require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
			$logs = new logs('sendtelcode');
			$logs->log_str($logs_msg);
			encodeData(array('result'=>'-6'));
		}
	}
	//��֤���ֻ���֤��
	function unbindtelold(){
		global $_G;

		if(empty($_G['gp_telcode'])) { encodeData(array('result'=>'-3')); }
		$telephone = DB::result_first('SELECT telephone FROM '.DB::table('common_member')." WHERE uid = '$_G[uid]'");

		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$codelog = $redis->obj->get("bbsbindtelold_".$_G['uid']);
		$waittest = $telephone.$_G['gp_telcode'];

		if($waittest != $codelog) { encodeData(array('result'=>'-4')); }

		encodeData(array('result'=>1));
	}

}
?>
