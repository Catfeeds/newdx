<?php
/**
 * 天猫预售登记
 */

require '../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require_once libfile('class/myredis');
$redis = & myredis::instance(6381);

if($_POST['dosubmit'] == 'yes') {
	$uid = $_G['uid'] ? $_G['uid'] : 0;
	$ip = $_G['clientip'];
	$dateline = TIMESTAMP;
	$tel = $_POST['tel'];

	//非法手机号
	if(!preg_match("/^1[34578]{1}\d{9}$/",$tel) || empty($tel)) {
		echo '-1';exit;
	}

	$log_cookie = getcookie("hm_ssid");
	if($log_cookie != 1) {
		file_put_contents(DISCUZ_ROOT."./data/dlogs/presale.log", "{$tel}\tip:{$ip}\tcookie error\ttime:".date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
		echo '1';exit;
	}

	//一个IP登记超过10条，则自动略过
	$log_count = DB::result_first("SELECT count(*) FROM ".DB::table("plugin_presale_log")." WHERE ip='$ip' ".getSlaveID());
	if($log_count > 10 && $ip != '111.160.225.106') {
		file_put_contents(DISCUZ_ROOT."./data/dlogs/presale.log", "{$tel}\tip:{$ip}\t{$log_count}\ttime:".date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
		echo '1';exit;
	}

	//登记过了
	$log_result = DB::result_first("SELECT id FROM ".DB::table("plugin_presale_log")." WHERE tel='$tel' ".getSlaveID());
	if($log_result) {
		echo '-2';exit;
	}

	DB::query("INSERT INTO ".DB::table("plugin_presale_log")."(`uid`, `tel`, `ip`, `dateline`) VALUES('$uid', '$tel', '$ip', '$dateline')");
	$id = DB::insert_id();
	if($id) {
		$redis->obj->incrby('presale_num', 1);
		echo '1';exit;
	} else {
		echo '-3';exit;	//插入数据异常
	}

} else {
	//设置cookie，简单防刷
	dsetcookie("hm_ssid", 1, 1200);
	//显示报名人数
	$presale_num = $redis->obj->get('presale_num');
	echo $presale_num;
	exit;
}
?>
