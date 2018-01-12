<?php
/**
 * 全站通用值得买弹出广告
 **/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class ZhidemaiPianyiAd{




	//全站通用值得买弹出广告
	function pianyi_alert($count = 5, $order = 'new', $code = 'jiu', $cid = '', $page = 1) {
		$result_data = memory('get', "cache_pianyi_alert_{$count}_{$order}_{$code}_{$cid}_{$page}");
		$mem_lock = memory('get', "cache_pianyi_alert_{$count}_{$order}_{$code}_{$cid}_{$page}_lock");
		if(!$result_data && !$mem_lock) {
			memory('set', "cache_pianyi_alert_{$count}_{$order}_{$code}_{$cid}_{$page}_lock", 1, 60);
			$api_result = requestRemoteData("http://py.8264.com/index.php?mod=goods&act=api&code={$code}&cid={$cid}&page={$page}&pagesize={$count}&order={$order}");
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$result_data = iconv_array($api_data, 'UTF-8', 'GBK');
				foreach ($result_data as $key => $value) {
					$result_data[$key]['starttime'] = strtotime($value['starttime']);
					$result_data[$key]['endtime'] = strtotime($value['endtime']);
				}

				memory('set', "cache_pianyi_alert_{$count}_{$order}_{$code}_{$cid}_{$page}", $result_data, 300);
				memory('rm', "cache_pianyi_alert_{$count}_{$order}_{$code}_{$cid}_{$page}_lock");
			}
		}
		return $result_data;
	}

}

?>
