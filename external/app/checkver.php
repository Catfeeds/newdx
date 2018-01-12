<?php
	function iconv_array($arr, $in="GBK", $out="UTF-8") {
		$func = create_function('&$value, $key, $act', '$act=explode("|", $act); $value=iconv($act[0], $act[1], $value);');
		array_walk_recursive($arr, $func, "$in|$out");
		return $arr;
	}
	isset($_GET['version']) && $curr_ver = $_GET['version'];
	if (!$curr_ver) {
		echo '';
		exit;
	}
	define('LATEST_VER', '3.5');
	define('MIN_VER', '3.5');
	define('IOS_LATEST_VER', '3.0.1');
	define('IOS_MIN_VER', '3.0.0');
	$arr_verinfo['has_new'] = '0';
	$arr_verinfo['must_update'] = '0';
	if ($_GET['plantform'] == 'ios') {
		// @todo rewrite code
		$arr_verinfo['new_version'] = IOS_LATEST_VER;
		$arr_verinfo['info'] = "ȫ�¸��²��޸���3.0.0�汾�Ĵ�����ʾ���Ż�����������ٶȣ�������ȶ�";
		$arr_verinfo['url'] = 'http://itunes.apple.com/us/app/8264/id492167976';
		if ($curr_ver < IOS_LATEST_VER) {
			$arr_verinfo['has_new'] = '1';
			if ($curr_ver < IOS_MIN_VER) {
				$arr_verinfo['must_update'] = '1';
			}
		}
	} else {
		$arr_verinfo['new_version'] = LATEST_VER;
		$arr_verinfo['info'] = "8264�ֻ��ͻ����Ѿ�ȫ���������������⡱��Ӧ���̵����������⡱�����ҵ�";
		$arr_verinfo['url'] = 'http://zaiwai.b0.upaiyun.com/apk/updateeeeeeee/zaiwai.apk';
		if ($curr_ver < LATEST_VER) {
			$arr_verinfo['has_new'] = '1';
			if ($curr_ver < MIN_VER) {
				$arr_verinfo['must_update'] = '1';
			}
		}
	}
	$arr_verinfo = iconv_array($arr_verinfo);
	echo json_encode($arr_verinfo);
	exit;
?>
