<?php
//����ԭ�����ݵ��ٶ�

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/**
 *
 *  �ٶȽӿڷ���ֵ˵��
 *  ------------------
	success	��	int	�ɹ����͵�url����
	remain	��	int	����ʣ��Ŀ�����url����
	not_same_site	��	array	���ڲ��Ǳ�վurl��δ�����url�б�
	not_valid	��	array	���Ϸ���url�б�
	------------------
	error	��	int	�����룬��״̬����ͬ
	message	��	string	��������
 */
if($_G['groupid'] ==1 && $_GET['url'] && stristr($_GET['url'], '8264.com') !== false) {
	$url_hash = md5($_GET['url']);
	$is_pushed = DB::result_first("SELECT id FROM ".DB::table('plugin_pushoriginal')." WHERE md5='$url_hash'");
	if($is_pushed > 0) {
		echo '{"error":410, "message":"�˵�ַ���͹���"}';exit;
	}

	$api = 'http://data.zz.baidu.com/urls?site=http://www.8264.com/&token=HmPYx1L8wxnNfo6e&type=original';
	$ch = curl_init();
	$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => $_GET['url'],
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
	);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);

	$data = json_decode($result);
	if($data->success == 1) {
		//����¼
		DB::query("INSERT INTO ".DB::table("plugin_pushoriginal")." SET `md5`='$url_hash', `url`='$_GET[url]', `uid`='$_G[uid]', `dateline`='".time()."'");
	}

	echo $result;exit;
}
