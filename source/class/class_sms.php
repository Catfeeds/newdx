<?php
/*
 * ���ŷ���
 * API: https://www.yunpian.com/api2.0/api-domestic.html
 */

class Sms
{
	public $apikey;
	public $signature = '��8264���⡿';
	public $yunpian_config = array(
			'RETRY_TIMES' => 3,
			'URI_SEND_SINGLE_SMS' => 'https://sms.yunpian.com/v2/sms/single_send.json',
			'URI_SEND_BATCH_SMS' => 'https://sms.yunpian.com/v2/sms/batch_send.json',
			'URI_SEND_MULTI_SMS' => 'https://sms.yunpian.com/v2/sms/multi_send.json',
			'URI_SEND_TPL_SMS' => 'https://sms.yunpian.com/v2/sms/tpl_single_send.json',
		);

	public function __construct()
	{
		global $_G;

		if(!$_G['config']['ypsms']['isopen']) return 'SMS is not open.';

		$this->apikey = $_G['config']['ypsms']['apikey'];
	}

	public function send($data = array(), $type = 'single')
	{
		$_methodname = $type.'_send';

		if (preg_match('/^\w+$/', $type) && method_exists($this, $_methodname)) {
			return call_user_func_array(array($this, $_methodname), array($data));
		} else {
			return 'undefined func';
		}
	}

	//��ϸ����˵������https://www.yunpian.com/api2.0/api-domestic/single_send.html
	private function single_send($data = array())
	{
		if (!array_key_exists('mobile', $data))
			return 'mobile Ϊ��';
		if (!array_key_exists('text', $data))
			return 'text Ϊ��';

		$data['text'] = $this->signature.$data['text'];
		$data['apikey'] = $this->apikey;

		return $this->post_curl($this->yunpian_config['URI_SEND_SINGLE_SMS'], $data);
	}

	private function batch_send($data = array())
	{
		if (!array_key_exists('mobile', $data))
			return 'mobile Ϊ��';
		if (!array_key_exists('text', $data))
			return 'text Ϊ��';

		$data['text'] = $this->signature.$data['text'];
		$data['apikey'] = $this->apikey;

		return $this->post_curl($this->yunpian_config['URI_SEND_BATCH_SMS'], $data);
	}

	private function multi_send($data = array())
	{
		if (!array_key_exists('mobile', $data))
			return 'mobile Ϊ��';
		if (!array_key_exists('text', $data))
			return 'text Ϊ��';
		if (count(explode(',', $data['mobile'])) != count(explode(',', $data['text'])))
			return 'mobile �� text ������ƥ��';
		$data['apikey'] = $this->apikey;
		$text_array = explode(',', $data['text']);
		$data['text'] = '';
		for ($index = 0; $index < count($text_array); $index++) {
			$data['text'] .= $this->signature.urlencode($text_array[$index]) . ',';
		}
		$data['text'] = substr($data['text'],0,-1);
		return $this->post_curl($this->yunpian_config['URI_SEND_MULTI_SMS'], $data);
	}

	//�Ѳ��Ƽ�ʹ��
	private function tpl_send($data = array())
	{
		if (!array_key_exists('mobile', $data))
			return 'mobile Ϊ��';
		if (!array_key_exists('tpl_id', $data))
			return 'tpl_id Ϊ��';
		if (!array_key_exists('tpl_value', $data))
			return 'tpl_value Ϊ��';

		$data['apikey'] = $this->apikey;

		return $this->post_curl($this->yunpian_config['URI_SEND_TPL_SMS'], $data);
	}

	private function post_curl($url,$post_data)
	{
		$ch = curl_init();

		/* ������֤��ʽ */
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:text/plain;charset=utf-8', 'Content-Type:application/x-www-form-urlencoded','charset=utf-8'));

		/* ���÷��ؽ��Ϊ�� */
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		/* ���ó�ʱʱ��*/
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		/* ����ͨ�ŷ�ʽ */
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(iconv_array($post_data)));

		$retry = 0;
		// ��ִ��ʧ��������
		do{
			$output = curl_exec($ch);
			$retry++;
		}while((curl_errno($ch) !== 0) && $retry < $this->yunpian_config['RETRY_TIMES']);

		if (curl_errno($ch) !== 0) {
			curl_close($ch);
			return $result['error'] = curl_error($ch);
		}

		$output = trim($output, "\xEF\xBB\xBF");
		$statusCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

		$result['httpcode'] = $statusCode;
		$result['data'] = json_decode($output,true);

		curl_close($ch);
		return iconv_array($result, 'UTF-8', 'GBK');
	}
}
