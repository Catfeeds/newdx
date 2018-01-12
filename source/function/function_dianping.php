<?php
/**
 *	点评系统公用函数
 */

/**
 * 将reids中的点击量提取出来事实显示帖子点击量
 * @param tid int 帖子id或附件aid
 * @param type string 类型（帖子点击量或附件点击量）
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

/* 生成面包屑导航 */
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
	//装备
	if($type == 'zhuangbei'){
		$zhuangbei = array(
			//服装
			71 => 4, 72 => 4, 73 => 4, 76 => 4, 77 => 4, 80 => 4, 154 => 4, //徒步
			74 => 51, 75 => 51, //登雪山
			78 => array(6, 5, 66, 94, 52), //随机
			202 => 5, //骑行
			//鞋袜
			81 => 51, 82 => 5, 83 => 52, 84 => 4, 85 => 50, 86 => 72, //对应的玩法
			87 => 4, 141 => 4, 178 => 4, //徒步
			//背包
			12 => 4,
			//露营装备
			13 => 7,
			//登山攀岩装备
			19 => array(51, 52),
			//手表/眼镜/仪器/数码 综合装备
			21 => 0, 23 => 0, //全部 调另一个接口
			//骑行装备
			70 => 5,
			//滑雪装备
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

	//其他
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
