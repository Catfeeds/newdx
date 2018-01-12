<?php
/**
 * 线路活动
 **/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class ForumOptionHuoDong {

	function getData($cate) {
		$data = memory('get', 'cache_huodong_zaiwai_'.$cate);
		if(!$data) {
			// $api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=category&type_id='.$cate.'&limit=0-12');
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$data = iconv_array($api_data, 'UTF-8', 'GBK');
				memory('set', 'cache_huodong_zaiwai_'.$cate, $data, 3600);
			}
		}
		$rand_keys = array_rand($data, 3);
		$r_data[] = $data[$rand_keys[0]];
		$r_data[] = $data[$rand_keys[1]];
		$r_data[] = $data[$rand_keys[2]];
		return $r_data;
	}

	function getDataBySearch($keyword) {
		$m_key = substr(md5($keyword), 0, 8);
		$data = memory('get', 'cache_huodong_zaiwai_'.$m_key);
		if(!$data) {
			// $api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=search&keyword='.urlencode(diconv($keyword, 'gbk', 'utf-8')).'&limit=0-12');
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$data = iconv_array($api_data, 'UTF-8', 'GBK');
				memory('set', 'cache_huodong_zaiwai_'.$m_key, $data, 3600);
			}
		}
		$rand_keys = array_rand($data, 3);
		$r_data[] = $data[$rand_keys[0]];
		$r_data[] = $data[$rand_keys[1]];
		$r_data[] = $data[$rand_keys[2]];
		return $r_data;
	}

	function getDataAll() {
		$data = memory('get', 'cache_huodong_zaiwai_r'.rand(0, 5));
		if(!$data) {
			// $api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=all3&limit=0-18');
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$result_data = iconv_array($api_data, 'UTF-8', 'GBK');
				for($i=0; $i<6; $i++) {
					$data = array_slice($result_data, $i*3, 3);
					memory('set', 'cache_huodong_zaiwai_r'.$i, $data, 3600);
				}
			}
		}
		return $data;
	}

	function getDataAll_new() {
		$result_data = memory('get', 'cache_bbs_indexnew_huodong_zaiwai');
		if(!$result_data) {
			$api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=all3&limit=0-12');
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$result_data = iconv_array($api_data, 'UTF-8', 'GBK');
				memory('set', 'cache_bbs_indexnew_huodong_zaiwai', $result_data, 3600);
			}
		}
		return $result_data;
	}

	//根据地方版城市版块id调取对应的线路城市下数据
	function getDataByCity($fid) {
		//地方版与线路城市分类id对应关系
		$conf_df_xl = array(
			158 => 'anhui',
			101 => 'beijing',
			166 => 'chongqing',
			113 => 'fujian',
			110 => 'gansu',
			112 => 'guangdong',
			108 => 'guangxi',
			176 => 'guizhou',
			117 => 'hainan',
			104 => 'hebei',
			106 => 'henan',
			164 => 'hubei',
			114 => 'hunan',
			159 => 'heilongjiang',
			116 => 'jilin',
			109 => 'jiangsu',
			111 => 'jiangxi',
			115 => 'liaoning',
			170 => 'neimenggu',
			143 => 'ningxia',
			177 => 'qinghai',
			103 => 'shandong',
			165 => 'shanxi',
			107 => 'sx',
			48 => 'shanghai',
			102 => 'sichuan',
			100 => 'tianjin',
			171 => 'xinjiang',
			105 => 'yunnan',
			147 => 'jiejiang',
			139 => 'xizang',
			);

		$df_fids = array_keys($conf_df_xl);
		if(!in_array($fid, $df_fids)) {
			return ForumOptionHuoDong::getDataAll();
		}

		$result_data = memory('get', 'cache_huodong_zaiwai_df_'.$fid);
		if(!$result_data) {
			$api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=startplace&type_id='.$conf_df_xl[$fid].'&limit=0-3');
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$result_data = iconv_array($api_data, 'UTF-8', 'GBK');
				memory('set', 'cache_huodong_zaiwai_df_'.$fid, $result_data, 3600);
			}
		}
		return $result_data;
	}

	function categoryData() {
		global $_G;

		$cate_conf = array(
				4 => array('name' => '徒步', 'ename' => 'HIKING'),
				5 => array('name' => '骑行', 'ename' => 'CYCLING'),
				6 => array('name' => '滑雪', 'ename' => 'SKIING'),
				7 => array('name' => '露营', 'ename' => 'CAMPING'),
				9 => array('name' => '摄影', 'ename' => 'PHOTOGRAPHY'),
				11 => array('name' => '包车', 'ename' => 'SELF-DRIVING'),
				13 => array('name' => '海钓', 'ename' => 'OFFSHORE ANGLING'),
				16 => array('name' => '潜水', 'ename' => 'DIVING'),
				36 => array('name' => '飞行', 'ename' => 'WINGSUIT FLYING'),
				45 => array('name' => '深度游', 'ename' => 'DEEP TOURISM'),
				48 => array('name' => '培训', 'ename' => 'TRAINING'),
				50 => array('name' => '越野跑', 'ename' => 'TRAIL RUNNING'),
				51 => array('name' => '登雪山', 'ename' => 'MOUNTAINEERING'),
				52 => array('name' => '攀岩', 'ename' => 'CLIMBING'),
				53 => array('name' => '冲浪', 'ename' => 'SURFING'),
				54 => array('name' => '狩猎', 'ename' => 'HUNTING'),
				58 => array('name' => '房车', 'ename' => 'RECREATIONAL VEHICLE'),
				59 => array('name' => '滑翔伞', 'ename' => 'PARAGLIDING'),
				60 => array('name' => '高尔夫', 'ename' => 'GOLF'),
				61 => array('name' => '邮轮&游艇', 'ename' => 'CRUISE & YACHT'),
				62 => array('name' => '皮划艇', 'ename' => 'CANOEING'),
				63 => array('name' => '骑马', 'ename' => 'RIDING'),
				64 => array('name' => '探洞', 'ename' => 'CAVING'),
				66 => array('name' => '帆船', 'ename' => 'YATCHING'),
				67 => array('name' => '速降', 'ename' => 'DOWNHILL'),
				69 => array('name' => '射箭', 'ename' => 'ARCHERY'),
				70 => array('name' => '真人CS', 'ename' => 'LIVE CS'),
				71 => array('name' => '漂流', 'ename' => 'DRIFTING'),
				72 => array('name' => '溯溪', 'ename' => 'RIVER TRACING'),
				74 => array('name' => '风筝冲浪', 'ename' => 'KITE SURFING'),
				75 => array('name' => '跑步马拉松', 'ename' => 'MARATHON'),
				78 => array('name' => '亲子户外', 'ename' => 'FAMILY OUTDOOR'),
				79 => array('name' => '沙漠', 'ename' => 'DESERT'),
				80 => array('name' => '帆板', 'ename' => 'SAILBOARD'),
				82 => array('name' => '跳伞', 'ename' => 'SKYDIVING'),
				83 => array('name' => '转山', 'ename' => 'KORA'),
				85 => array('name' => '越野自驾', 'ename' => 'OFF-ROAD DRIVING'),
				87 => array('name' => '向导', 'ename' => 'GUIDE'),
				88 => array('name' => '海岛', 'ename' => 'ISLAND'),
				89 => array('name' => '户外定制', 'ename' => 'CUSTOMIZATION'),
			);
		$state_conf = array(
				'安徽' => array('py' => 'sf19', 'cate' => '9,7,72,5,64'),
				'北京' => array('py' => 'sf2', 'cate' => '70,52,71,63,78'),
				'重庆' => array('py' => 'sf5', 'cate' => '71,58,72,78,52'),
				'福建' => array('py' => 'sf21', 'cate' => '72,88,78,66,74'),
				'甘肃' => array('py' => 'sf26', 'cate' => '50,75,89,87,85'),
				'广东' => array('py' => 'sf22', 'cate' => '72,88,60,5,48'),
				'广西' => array('py' => 'sf23', 'cate' => '71,7,72,74,64'),
				'贵州' => array('py' => 'sf30', 'cate' => '7,72,71,69,78'),
				'海南' => array('py' => 'sf24', 'cate' => '16,48,61,53,80'),
				'河北' => array('py' => 'sf6', 'cate' => '69,71,50,5,78'),
				'河南' => array('py' => 'sf7', 'cate' => '36,59,5,52,69'),
				'湖北' => array('py' => 'sf17', 'cate' => '72,69,52,67,78'),
				'湖南' => array('py' => 'sf16', 'cate' => '71,69,52,62,67'),
				'黑龙江' => array('py' => 'sf13', 'cate' => '69,71,75,78,5'),
				'吉林' => array('py' => 'sf14', 'cate' => '7,88,71,75,48'),
				'江苏' => array('py' => 'sf10', 'cate' => '72,71,64,78,62'),
				'江西' => array('py' => 'sf18', 'cate' => '72,59,78,9,88'),
				'辽宁' => array('py' => 'sf15', 'cate' => '88,71,69,61,52'),
				'内蒙古' => array('py' => 'sf12', 'cate' => '69,63,75,79,7'),
				'宁夏' => array('py' => 'sf27', 'cate' => '79,7,4,85,87'),
				'青海' => array('py' => 'sf32', 'cate' => '9,5,89,7,78'),
				'山东' => array('py' => 'sf8', 'cate' => '13,69,78,88,75'),
				'山西' => array('py' => 'sf9', 'cate' => '4,7,54,71,69'),
				'陕西' => array('py' => 'sf25', 'cate' => '82,36,9,71,48'),
				'上海' => array('py' => 'sf4', 'cate' => '72,88,67,62,70'),
				'四川' => array('py' => 'sf20', 'cate' => '59,60,69,71,52'),
				'天津' => array('py' => 'sf3', 'cate' => '70,60,78,52,69'),
				'西藏' => array('py' => 'sf31', 'cate' => '89,11,87,45,7'),
				'新疆' => array('py' => 'sf28', 'cate' => '4,11,87,7,89'),
				'云南' => array('py' => 'sf29', 'cate' => '82,9,5,78,36'),
				'浙江' => array('py' => 'sf11', 'cate' => '72,88,50,67,59'),
			);

		$cate_pic_conf = array(4=>4, 7=>7, 16=>16, 36=>36, 48=>48, 51=>51, 52=>52, 71=>71, 83=>83, 88=>88);

		require_once DISCUZ_ROOT.'./source/plugin/components/ipdata/ipdata.php';
		$ipdata = _convertip($_G['clientip']);
		$states = '安徽 北京 重庆 福建 甘肃 广东 广西 贵州 海南 河北 河南 湖北 湖南 黑龙江 吉林 江苏 江西 辽宁 内蒙古 宁夏 青海 山东 山西 陕西 上海 四川 天津 西藏 新疆 云南 浙江';
		$state = '北京';
		foreach (explode(' ', $states) as $name) {
			if (strpos($ipdata, $name) !== false) {
				$state = $name;
				break;
			}
		}

		$state_cate = $state_conf[$state];
		$state_cate_ids = explode(',', $state_cate['cate']);
		foreach ($state_cate_ids as $id) {
			$state_cate['cates'][$id] = $cate_conf[$id]['name'];
		}

		$pic_ids = array_rand($cate_pic_conf, 5);
		$other_ids = array_diff($cate_pic_conf, $pic_ids);
		$data_pic = array_intersect_key($cate_conf, array_flip($pic_ids));
		$data_other = array_intersect_key($cate_conf, $other_ids);
		$data = array(
			'pic' => $data_pic,
			'other' => $data_other,
			'state' => $state,
			'state_cate' => $state_cate,
			);

		return $data;

	}

	//值得买网站首页右侧
	function pianyi_sidebar($count = 5, $order = 'new', $code = 'jiu', $cid = '', $page = 1) {
		$result_data = memory('get', "cache_pianyi_{$count}_{$order}_{$code}_{$cid}_{$page}");
		$mem_lock = memory('get', "cache_pianyi_{$count}_{$order}_{$code}_{$cid}_{$page}_lock");
		if(!$result_data && !$mem_lock) {
			memory('set', "cache_pianyi_{$count}_{$order}_{$code}_{$cid}_{$page}_lock", 1, 60);
			$api_result = requestRemoteData("http://py.8264.com/index.php?mod=goods&act=api&code={$code}&cid={$cid}&page={$page}&pagesize={$count}&order={$order}");
			if($api_result) {
				$api_data = json_decode($api_result, true);
				$result_data = iconv_array($api_data, 'UTF-8', 'GBK');
				foreach ($result_data as $key => $value) {
					$result_data[$key]['starttime'] = strtotime($value['starttime']);
					$result_data[$key]['endtime'] = strtotime($value['endtime']);
				}

				memory('set', "cache_pianyi_{$count}_{$order}_{$code}_{$cid}_{$page}", $result_data, 300);
				memory('rm', "cache_pianyi_{$count}_{$order}_{$code}_{$cid}_{$page}_lock");
			}
		}
		return $result_data;
	}

}

?>
