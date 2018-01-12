<?php

/**
 * openid_model
 */


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class openid
{
	// �ͻ���ID���ã����ڴ洢����
	/*public $client = array(
						// 'appname' => 'client_id',
						'zaiwaiapp' => 1,
						);*/

	protected $wechat_api;

	function __construct()
	{
		global $_G, $appname;

		$this->timestamp = time();

		$key_search = array_keys($_G['config']['apikey']);
		if(in_array($appname, $key_search)) {
			$this->secret = $_G['config']['apikey'][$appname];
			// $this->client_id = $this->client[$appname];
		} else {
			return false;
		}

		//΢�Ź��ں�api����
		$this->wechat_api = $_G['config']['wechat'];	//����app
		$this->wechat_api_8264 = $_G['config']['wechat8264'];	//8264����������
		$this->wechat_api_8264_hd = $_G['config']['wechat8264hd'];	//8264�ƽ̨
        $this->wechat_api_8264_fwh = $_G['config']['wechat8264fwh'];	//8264�����
	}

	public function build_url($params)
	{
		ksort($params);
		reset($params);
		$str_q = http_build_query($params);
		$sign = md5($str_q.$this->secret);
		return '?'.$str_q.'&sign='.$sign;
	}

	// ��֤�û��Ƿ�������Ȩ��¼
	public function isauth($uid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid')." WHERE uid='{$uid}' " . getSlaveID());
	}

	// ��֤�û��Ƿ�������Ȩ��¼
	public function isauthByAppuid($appuid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid')." WHERE appuid='{$appuid}' " . getSlaveID());
	}

	// ������Ȩ��¼
	public function allow($uid, $username, $appuid, $appusername, $web = false)
	{
		if(!$uid || !$username || !$appuid || !$appusername) {
			return false;
		}

		$status  = $this->isauth($uid);
		$status2 = $this->isauthByAppuid($appuid);

		//�û��Ѿ�����APP ID
		if($status || $status2) {
			return false;
		}

		//��Ȩ���ڵĻ�������������Ȩ��Ŀǰ��Ȩ���ڻ���δ����
		$expriestime = $this->timestamp + 2592000;
		// $userkey = authcode($uid."\t".$username."\t".$expriestime, 'ENCODE');
		$userkey = $uid."|".$username;

		DB::query("INSERT INTO ".DB::table('common_openid')." (uid, username, appuid, appusername, userkey, expriestime) VALUES('$uid', '$username', '$appuid', '$appusername', '$userkey', '$expriestime')");
		DB::update('forum_activityapply', array('uid' => $uid, 'username' => $username), "appuserid='{$appuid}'");

		//�����web��Ȩ���򻺴��û�����Ϣ������ȡ
		if($web) {
			$code = md5($uid.$appuid);
			$md5str = md5($code.'&'.$this->secret);
			//��md5str��������������
			require_once libfile('class/myredis');
			$redis = & myredis::instance(6381);
			$redis->obj->set('openid_'.$md5str, serialize(array("uid"=>$uid, "username"=>$username, "userkey"=>$userkey)), 600);
			return $code;
		} else {
			return array("uid"=>$uid, "username"=>$username, "userkey"=>$userkey);
		}
	}

	public function token($md5str)
	{
		$result = '';
		//�ӻ�����ȡ��md5str��Ӧ�İ��û���Ϣ
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);
		$result = $redis->obj->get('openid_'.$md5str);
		return unserialize($result);
	}

	// ˢ����Ȩ������ʱ���Զ��ӳ�30�졣δ���ڵ���Ȩ�����Զ����ڣ�������������Ȩ
	public function token_refresh($userkey)
	{
		$userinfo = authcode($userkey, 'DECODE');
		list($uid, $username, $expriestime) = explode("\t", $userinfo);
		if($uid && $expriestime > $this->timestamp)
		{
			DB::query("UPDATE ".DB::table('common_openid')." SET expriestime=expriestime+2592000 WHERE uid='$uid'");
			if(DB::affected_rows()) {
				return array("uid"=>$uid, "username"=>$username, "expriestime"=>$expriestime);
			}
		} else {
			return false;
		}
	}

	// ����û�
	public function token_unbind($uid, $appuid)
	{
		file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', 'token_unbind|'.$appuid.'|'.$uid.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
		DB::query("DELETE FROM ".DB::table('common_openid')." WHERE uid='$uid' AND appuid='$appuid'");
		return DB::affected_rows();
	}

	// ������Ӧ�û�ȡAPI TOKEN
	public function access_token($appname)
	{
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$result = array();
		$result['access_token'] = $redis->obj->get('access_token_'.$appname);
		if(!$result['access_token']) {
			$result['access_token'] = md5($appname.time());
			$result['expires_time'] = time() + 3600;
			$redis->obj->set('access_token_'.$appname, $result['access_token'], 3600);
		} else {
			$result['expires_time'] = time() + $redis->obj->ttl('access_token_'.$appname);
		}

		return $result;
	}

	// ΢�Ź��ں�API TOKEN�пؽӿ�
	public function wechat_token()
	{
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$result = array();
		$result['wechat_token'] = $redis->obj->get('wechat_token_zaiwaiapp');
		if(!$result['wechat_token']) {
			$wechat = requestRemoteData($this->wechat_api['url']."token?grant_type=client_credential&appid=".$this->wechat_api['appid']."&secret=".$this->wechat_api['appsecret']);
			$wechat = json_decode($wechat, true);
			$result['wechat_token'] = $wechat['access_token'];
			$result['expires_time'] = time() + $wechat['expires_in'];
			$redis->obj->set('wechat_token_zaiwaiapp', $result['wechat_token'], $wechat['expires_in']);
		} else {
			$result['expires_time'] = time() + $redis->obj->ttl('wechat_token_zaiwaiapp');
		}
		return $result;
	}

	// 8264���������� ΢�Ź��ں�API TOKEN�пؽӿ�
	public function wechat_token_8264()
	{
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$result = array();
		$result['wechat_token'] = $redis->obj->get('wechat_token_8264');
		if(!$result['wechat_token']) {
			$wechat = requestRemoteData($this->wechat_api_8264['url']."token?grant_type=client_credential&appid=".$this->wechat_api_8264['appid']."&secret=".$this->wechat_api_8264['appsecret']);
			$wechat = json_decode($wechat, true);
			$result['wechat_token'] = $wechat['access_token'];
			$result['expires_time'] = time() + $wechat['expires_in'];
			$redis->obj->set('wechat_token_8264', $result['wechat_token'], $wechat['expires_in']);
		} else {
			$result['expires_time'] = time() + $redis->obj->ttl('wechat_token_8264');
		}
		return $result;
	}
	// 8264�ƽ̨ ΢�Ź��ں�API TOKEN�пؽӿ�
	public function wechat_token_8264_hd()
	{
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);

		$result = array();
		$result['wechat_token'] = $redis->obj->get('wechat_token_8264_hd_zaiwaiapp');
		if(!$result['wechat_token']) {
			$wechat = requestRemoteData($this->wechat_api_8264_hd['url']."token?grant_type=client_credential&appid=".$this->wechat_api_8264_hd['appid']."&secret=".$this->wechat_api_8264_hd['appsecret']);
			$wechat = json_decode($wechat, true);
			$result['wechat_token'] = $wechat['access_token'];
			$result['expires_time'] = time() + $wechat['expires_in'];
			$redis->obj->set('wechat_token_8264_hd_zaiwaiapp', $result['wechat_token'], $wechat['expires_in']);
		} else {
			$result['expires_time'] = time() + $redis->obj->ttl('wechat_token_8264_hd_zaiwaiapp');
		}
		return $result;
	}


    // 8264����� ΢�Ź��ں�API TOKEN�пؽӿ�
    public function wechat_token_8264_fwh()
    {
        require_once libfile('class/myredis');
        $redis = & myredis::instance(6381);

        $result = array();
        $result['wechat_token'] = $redis->obj->get('wechat_token_8264_fwh_zaiwaiapp');
        if(!$result['wechat_token']) {
            $wechat = requestRemoteData($this->wechat_api_8264_fwh['url']."token?grant_type=client_credential&appid=".$this->wechat_api_8264_fwh['appid']."&secret=".$this->wechat_api_8264_fwh['appsecret']);
            $wechat = json_decode($wechat, true);
            $result['wechat_token'] = $wechat['access_token'];
            $result['expires_time'] = time() + $wechat['expires_in'];
            $redis->obj->set('wechat_token_8264_fwh_zaiwaiapp', $result['wechat_token'], $wechat['expires_in']);
        } else {
            $result['expires_time'] = time() + $redis->obj->ttl('wechat_token_8264_fwh_zaiwaiapp');
        }
        return $result;
    }

	//��֤�û��Ƿ�������Ȩ��¼(΢��)
	public function isWechatAuthByUid($uid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid_wechat')." WHERE uid='{$uid}' " . getSlaveID());
	}

	//��֤�û��Ƿ�������Ȩ��¼(΢��)
	public function isWechatAuthByUnionid($wechatunionid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid_wechat')." WHERE wechatunionid='{$wechatunionid}' " . getSlaveID());
	}

	//������Ȩ��¼(΢��)
	public function allow_wechat($uid, $username, $wechatunionid, $wechatuserid, $wechatusername)
	{
		if(!$uid || !$username || !$wechatunionid || !$wechatuserid) {
			return false;
		}

		$status  = $this->isWechatAuthByUid($uid);
		$status2 = $this->isWechatAuthByUnionid($wechatunionid);

		//�û��Ѿ�����wechat ID
		if($status || $status2) {
			return false;
		}
		$isSuccess = DB::insert('common_openid_wechat', array('uid' => $uid, 'username' => $username, 'wechatunionid' => $wechatunionid, 'wechatuserid' => $wechatuserid ,'wechatusername' => $wechatusername, 'dateline' => $this->timestamp));

		if ($isSuccess) {
			DB::update('forum_activityapply', array('uid' => $uid, 'username' => $username), "wechatuserid='{$wechatuserid}'");
		}

		return $isSuccess;
	}

	//������̳�û�����û���Ϣ(΢��)
	public function user_info_wechat($uid, $username)
	{
		$avatar = avatar($uid, 'middle', true);
		return array('uid' => $uid, 'username' => $username, 'userkey' => "{$uid}|{$username}", 'avatar' => $avatar);
	}

	//����unionid����û���Ϣ(΢��)
	public function user_info_wechatunionid($wechatunionid)
	{
		$wechatShow = DB::fetch_first("SELECT uid, username FROM ".DB::table('common_openid_wechat')." WHERE wechatunionid='{$wechatunionid}' " . getSlaveID());
		if ($wechatShow) {
			$avatar = avatar($wechatShow['uid'], 'middle', true);
			return array('uid' => $wechatShow['uid'], 'username' => $wechatShow['username'], 'userkey' => "{$wechatShow['uid']}|{$wechatShow['username']}", 'avatar' => $avatar);
		}
		return false;
	}
}
