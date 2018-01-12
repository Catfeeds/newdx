<?php
/**
 *	����ϵͳ���ú���
 */

/**
 * ��reids�еĵ������ȡ������ʵ��ʾ���ӵ����
 * @param tid int ����id�򸽼�aid
 * @param type string ���ͣ����ӵ�����򸽼��������
 */
function get_redis_views($tid,$type){
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6381);
    $view = 0;
    if($myredis->connected){
        $view = $myredis->hashget($type."_number",$tid);
        $view += $myredis->hashget($type."_doing",$tid);
    }
    return $view;
}

function dp_rewrite($content)
{
	global $dp_rewrite, $mod;
	if(!empty($dp_rewrite[$mod]) && is_array($dp_rewrite[$mod]))
	{
		foreach($dp_rewrite[$mod] as $k => $v)
		{
			$content = preg_replace('/dianping.php\?mod='.$mod.$k.'/i', $v, $content);
		}
	}
	if(!empty($dp_rewrite['global']) && is_array($dp_rewrite['global']))
	{
		foreach($dp_rewrite['global'] as $k => $v)
		{
			$content = preg_replace('/dianping.php\?'.$k.'/i', $v, $content);
		}
	}

	return $content;
}

function dp_output()
{
	$html = ob_get_clean();
	echo dp_rewrite($html);
}

/* �������м���� */
function make_nav($data)
{
	global $mod;
	$html = '';
	foreach ($data as $value) {
		$html .= "<span>&gt;</span><a href=\"http://www.8264.com/dianping.php?mod={$mod}&act=showlist{$value['url']}\" title=\"{$value['title']}\">{$value['title']}</a>";
	}
	return $html;
}

function build_url($params, $appsecret, $apiurl = 'http://hd.8264.com/api/index.php') {
	ksort($params);
	reset($params);
	$str_q = http_build_query($params);
	$sign = md5($str_q . $appsecret);
	return $apiurl . '?' . $str_q . '&sign=' . $sign;
}

function gethddata($type, $pcid, $cid, $random = 5, $ip = ''){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	//װ��
	if($type == 'zhuangbei'){
		$zhuangbei = array(
			//��װ
			71 => 4, 72 => 4, 73 => 4, 76 => 4, 77 => 4, 80 => 4, 154 => 4, //ͽ��
			74 => 51, 75 => 51, //��ѩɽ
			78 => array(6, 5, 66, 94, 52), //���
			202 => 5, //����
			//Ь��
			81 => 51, 82 => 5, 83 => 52, 84 => 4, 85 => 50, 86 => 72, //��Ӧ���淨
			87 => 4, 141 => 4, 178 => 4, //ͽ��
			//����
			12 => 4,
			//¶Ӫװ��
			13 => 7,
			//��ɽ����װ��
			19 => array(51, 52),
			//�ֱ�/�۾�/����/���� �ۺ�װ��
			21 => 0, 23 => 0, //ȫ�� ����һ���ӿ�
			//����װ��
			70 => 5,
			//��ѩװ��
			118 => 6,
		);
		if($pcid == 10 || $pcid == 11){
			$cate = $zhuangbei[$cid];
		}else{
			$cate = $zhuangbei[$pcid];
		}
		if(is_array($cate)){
			$cate = $cate[array_rand($cate)];
		}
		if($cate){
			$params = array(
				'appname' => $appname,
				'app' => 'search',
				'act' => 'recommend',
				'qt' => time(),
				'r' => $random,
				'cate' => $cate
			);
		}else{
			$params = array(
				'appname' => $appname,
				'app' => 'search',
				'act' => 'recommend_2',
				'qt' => time(),
				'r' => $random,
				'cate' => $cate,
				'ip' => $ip
			);
		}
	}

	//����
	if (in_array($type, array('xuechang', 'mountain', 'line', 'climb', 'diving', 'fishing'))) {
		$params = array(
			'appname' => $appname,
			'app' => 'search',
			'act' => 'recommend_2',
			'qt' => time(),
			'r' => $random,
			'cate' => $pcid,
			'ip' => $ip
		);
	}

	$url = build_url($params, $appsecret);
	$json_data = file_get_contents($url);
	$data = json_decode($json_data, true);
	if ($data['errorCode'] == 0) {
		return iconv_array($data['result'], 'UTF-8', 'GBK');
	}
	return false;
}
?>
