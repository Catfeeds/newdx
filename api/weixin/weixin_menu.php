<?php
error_reporting(0);
set_time_limit(0);

//require_once('../../external/fb.ext.php');
require_once('../../source/class/class_core.php');
require_once('../../source/class/class_sockpost.php');

$discuz = & discuz_core::instance();
$discuz->init();

//���access token
//memory('rm', 'cache_weixin_access_token');
if (!$access_token = memory('get', 'cache_weixin_access_token')) {
		$param = array(
			'appname' => 'zaiwaiapp',
			'c' => 'authorize',
			'm' => 'wechat_token_8264',
			'qt' => time(),
		);
		ksort($param);
		reset($param);
		$str_q = http_build_query($param);
		$sign = md5($str_q."VaKeCtYCo1");
		$buildurl = '?' . $str_q . '&sign=' . $sign;
		$url = 'http://api.8264.com/openid/' . $buildurl;

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output 	  = curl_exec($ch);
		curl_close($ch);

		$jsoninfo 	  = json_decode($output, true);
		$access_token = $jsoninfo['data']['wechat_token'];	
		memory( 'set', 'cache_weixin_access_token', $access_token, $jsoninfo['data']['expires_time'] - time());
}

//�Զ���˵�
$url    	= "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$jsonmenu 	= array('button'=>array(
	/*array(
		'name' => '������Ѷ',
		'sub_button' => array(
			array('type'=>'view','name'=>'������Ѷ','url'=>'http://m.8264.com/'),
			array('type'=>'view','name'=>'����ͼ˵','url'=>'http://m.8264.com/list/902'),
			array('type'=>'view','name'=>'��ʷ��Ϣ','url'=>'http://mp.weixin.qq.com/mp/getmasssendmsg?__biz=MzA4MjE2OTcwNA==#wechat_webview_type=1&wechat_redirect')			
		)
	),
	array(
		'name' => '¿������',
		'sub_button' => array(
			array('type'=>'view','name'=>'��·����','url'=>'http://m.wan.8264.com/?from=8264wei'),
			array('type'=>'click','name'=>'��̳��ѡ','key'=>'ltjx'),
			array('type'=>'view','name'=>'�������','url'=>'http://m.8264.com/bbs#1'),
			array('type'=>'view','name'=>'��̳����','url'=>'http://m.8264.com/bbs'),
			array('type'=>'view','name'=>'�һ���Ʒ','url'=>'http://m.8264.com/bbs-483-1.html')
		)			
	),
	array(
		'name' => '����APP',
		'sub_button' => array(
//			array('type'=>'view','name'=>'ӮȡС¿','url'=>'http://mp.weixin.qq.com/s?__biz=MzA4MjE2OTcwNA==&mid=209144922&idx=1&sn=e9eea2a67aec5d5199cc987c85b8affe#rd'),
			array('type'=>'click','name'=>'��ϵ��ʽ','key'=>'lxfs'),
			array('type'=>'view','name'=>'��������','url'=>'http://um0.cn/rtkTB')
		)			
	)*/
//	array('type'=>'view','name'=>'����APP','url'=>"http://a.app.qq.com/o/simple.jsp?pkgname=com.bj8264.zaiwai.android")
	/*array(
		'name' => '8264��̳',
		'sub_button' => array(
			array('type'=>'click','name'=>'��̳��ѡ','key'=>'ltjx'),
			array('type'=>'view','name'=>'��̳����','url'=>'http://m.8264.com/bbs'),
			array('type'=>'view','name'=>'ÿ��һͼ','url'=>'http://m.8264.com/list/842'),
			array('type'=>'view','name'=>'���õ��','url'=>'http://m.8264.com/list/878'),
			//array('type'=>'view','name'=>'��������','url'=>'http://m.8264.com/list/880'),
			array('type'=>'click','name'=>'��ϵ�ͷ�','key'=>'lxkf')
		)
	),
	array(
		'name' => '����',
		'sub_button' => array(
			array('type'=>'view','name'=>'¶Ӫ���','url'=>'http://bbs.8264.com/thread-5252785-1-1.html'),
			array('type'=>'view','name'=>'��Ʒ����','url'=>'http://m.zaiwai.com/'),
			array('type'=>'view','name'=>'��ĩ�','url'=>'http://wei.zaiwai.com/'),
			array('type'=>'view','name'=>'Ʒ������','url'=>'http://www.8264.com/link/marketing.html'),
		)
	),
	array(
		'name' => '����ϵͳ',
		'sub_button' => array(
			array('type'=>'view','name'=>'������Ʒ','url'=>'http://m.8264.com/index.php?d=forum&c=dianping&m=equipmentlist&act=equipmentlist'),
			array('type'=>'view','name'=>'����Ʒ��','url'=>'http://m.8264.com/index.php?d=forum&c=dianping&m=brandlist&act=brandlist'),
			array('type'=>'view','name'=>'��·','url'=>'http://m.8264.com/index.php?d=forum&c=dianping&m=linelist&act=linelist'),
			array('type'=>'view','name'=>'ɽ��','url'=>'http://m.8264.com/index.php?d=forum&c=dianping&m=mountainlist&act=mountainlist'),
			//array('type'=>'view','name'=>'��ѩ��','url'=>'http://m.8264.com/index.php?d=forum&c=dianping&m=skiinglist&act=skiinglist'),
			array('type'=>'view','name'=>'������ֲ�','url'=>'http://m.8264.com/index.php?d=forum&c=dianping&m=clublist&act=clublist')
		)
	)*/
	array('type'=>'view','name'=>'��ϲ','url'=>'https://8264.m.tmall.com/'),
	array('type'=>'view','name'=>'��̳','url'=>'http://m.8264.com/bbs'),
	array(
		'name' => '����',
		'sub_button' => array(
			array('type'=>'view','name'=>'���߻','url'=>'http://m.hd.8264.com/?wechatfrom=8264'),
			array('type'=>'view','name'=>'��ĩ�','url'=>'http://m.hd.8264.com/zmhd?wechatfrom=8264')
		)
	),
));

var_dump($jsonmenu);
print_r($jsonmenu);

//תΪutf8����
$jsonmenu = iconv_array($jsonmenu);

//���΢�Ų�֧��40033�����ܰ���\uxxxx��ʽ���ַ�(����)
$jsonmenu = urlencode_array($jsonmenu);
$jsonmenu = json_encode($jsonmenu);
$jsonmenu = urldecode($jsonmenu);

//print_r($jsonmenu);

$result   = https_request($url, $jsonmenu);
var_dump($result);


function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

function urlencode_array($arr)
{
	$func = create_function( '&$value, $key', '$value=urlencode($value);' );
	array_walk_recursive($arr, $func);
	return $arr;
}

