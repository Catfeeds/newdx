<?php
/**
 * ��·�
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

	//���ݵط�����а��id��ȡ��Ӧ����·����������
	function getDataByCity($fid) {
		//�ط�������·���з���id��Ӧ��ϵ
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
				4 => array('name' => 'ͽ��', 'ename' => 'HIKING'),
				5 => array('name' => '����', 'ename' => 'CYCLING'),
				6 => array('name' => '��ѩ', 'ename' => 'SKIING'),
				7 => array('name' => '¶Ӫ', 'ename' => 'CAMPING'),
				9 => array('name' => '��Ӱ', 'ename' => 'PHOTOGRAPHY'),
				11 => array('name' => '����', 'ename' => 'SELF-DRIVING'),
				13 => array('name' => '����', 'ename' => 'OFFSHORE ANGLING'),
				16 => array('name' => 'Ǳˮ', 'ename' => 'DIVING'),
				36 => array('name' => '����', 'ename' => 'WINGSUIT FLYING'),
				45 => array('name' => '�����', 'ename' => 'DEEP TOURISM'),
				48 => array('name' => '��ѵ', 'ename' => 'TRAINING'),
				50 => array('name' => 'ԽҰ��', 'ename' => 'TRAIL RUNNING'),
				51 => array('name' => '��ѩɽ', 'ename' => 'MOUNTAINEERING'),
				52 => array('name' => '����', 'ename' => 'CLIMBING'),
				53 => array('name' => '����', 'ename' => 'SURFING'),
				54 => array('name' => '����', 'ename' => 'HUNTING'),
				58 => array('name' => '����', 'ename' => 'RECREATIONAL VEHICLE'),
				59 => array('name' => '����ɡ', 'ename' => 'PARAGLIDING'),
				60 => array('name' => '�߶���', 'ename' => 'GOLF'),
				61 => array('name' => '����&��ͧ', 'ename' => 'CRUISE & YACHT'),
				62 => array('name' => 'Ƥ��ͧ', 'ename' => 'CANOEING'),
				63 => array('name' => '����', 'ename' => 'RIDING'),
				64 => array('name' => '̽��', 'ename' => 'CAVING'),
				66 => array('name' => '����', 'ename' => 'YATCHING'),
				67 => array('name' => '�ٽ�', 'ename' => 'DOWNHILL'),
				69 => array('name' => '���', 'ename' => 'ARCHERY'),
				70 => array('name' => '����CS', 'ename' => 'LIVE CS'),
				71 => array('name' => 'Ư��', 'ename' => 'DRIFTING'),
				72 => array('name' => '��Ϫ', 'ename' => 'RIVER TRACING'),
				74 => array('name' => '���ݳ���', 'ename' => 'KITE SURFING'),
				75 => array('name' => '�ܲ�������', 'ename' => 'MARATHON'),
				78 => array('name' => '���ӻ���', 'ename' => 'FAMILY OUTDOOR'),
				79 => array('name' => 'ɳĮ', 'ename' => 'DESERT'),
				80 => array('name' => '����', 'ename' => 'SAILBOARD'),
				82 => array('name' => '��ɡ', 'ename' => 'SKYDIVING'),
				83 => array('name' => 'תɽ', 'ename' => 'KORA'),
				85 => array('name' => 'ԽҰ�Լ�', 'ename' => 'OFF-ROAD DRIVING'),
				87 => array('name' => '��', 'ename' => 'GUIDE'),
				88 => array('name' => '����', 'ename' => 'ISLAND'),
				89 => array('name' => '���ⶨ��', 'ename' => 'CUSTOMIZATION'),
			);
		$state_conf = array(
				'����' => array('py' => 'sf19', 'cate' => '9,7,72,5,64'),
				'����' => array('py' => 'sf2', 'cate' => '70,52,71,63,78'),
				'����' => array('py' => 'sf5', 'cate' => '71,58,72,78,52'),
				'����' => array('py' => 'sf21', 'cate' => '72,88,78,66,74'),
				'����' => array('py' => 'sf26', 'cate' => '50,75,89,87,85'),
				'�㶫' => array('py' => 'sf22', 'cate' => '72,88,60,5,48'),
				'����' => array('py' => 'sf23', 'cate' => '71,7,72,74,64'),
				'����' => array('py' => 'sf30', 'cate' => '7,72,71,69,78'),
				'����' => array('py' => 'sf24', 'cate' => '16,48,61,53,80'),
				'�ӱ�' => array('py' => 'sf6', 'cate' => '69,71,50,5,78'),
				'����' => array('py' => 'sf7', 'cate' => '36,59,5,52,69'),
				'����' => array('py' => 'sf17', 'cate' => '72,69,52,67,78'),
				'����' => array('py' => 'sf16', 'cate' => '71,69,52,62,67'),
				'������' => array('py' => 'sf13', 'cate' => '69,71,75,78,5'),
				'����' => array('py' => 'sf14', 'cate' => '7,88,71,75,48'),
				'����' => array('py' => 'sf10', 'cate' => '72,71,64,78,62'),
				'����' => array('py' => 'sf18', 'cate' => '72,59,78,9,88'),
				'����' => array('py' => 'sf15', 'cate' => '88,71,69,61,52'),
				'���ɹ�' => array('py' => 'sf12', 'cate' => '69,63,75,79,7'),
				'����' => array('py' => 'sf27', 'cate' => '79,7,4,85,87'),
				'�ຣ' => array('py' => 'sf32', 'cate' => '9,5,89,7,78'),
				'ɽ��' => array('py' => 'sf8', 'cate' => '13,69,78,88,75'),
				'ɽ��' => array('py' => 'sf9', 'cate' => '4,7,54,71,69'),
				'����' => array('py' => 'sf25', 'cate' => '82,36,9,71,48'),
				'�Ϻ�' => array('py' => 'sf4', 'cate' => '72,88,67,62,70'),
				'�Ĵ�' => array('py' => 'sf20', 'cate' => '59,60,69,71,52'),
				'���' => array('py' => 'sf3', 'cate' => '70,60,78,52,69'),
				'����' => array('py' => 'sf31', 'cate' => '89,11,87,45,7'),
				'�½�' => array('py' => 'sf28', 'cate' => '4,11,87,7,89'),
				'����' => array('py' => 'sf29', 'cate' => '82,9,5,78,36'),
				'�㽭' => array('py' => 'sf11', 'cate' => '72,88,50,67,59'),
			);

		$cate_pic_conf = array(4=>4, 7=>7, 16=>16, 36=>36, 48=>48, 51=>51, 52=>52, 71=>71, 83=>83, 88=>88);

		require_once DISCUZ_ROOT.'./source/plugin/components/ipdata/ipdata.php';
		$ipdata = _convertip($_G['clientip']);
		$states = '���� ���� ���� ���� ���� �㶫 ���� ���� ���� �ӱ� ���� ���� ���� ������ ���� ���� ���� ���� ���ɹ� ���� �ຣ ɽ�� ɽ�� ���� �Ϻ� �Ĵ� ��� ���� �½� ���� �㽭';
		$state = '����';
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

	//ֵ������վ��ҳ�Ҳ�
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
