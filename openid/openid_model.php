<?php

/**
 * openid_model
 */


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class openid
{
	// 客户端ID配置，用于存储检索
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

		//微信公众号api配置
		$this->wechat_api = $_G['config']['wechat'];	//在外app
		$this->wechat_api_8264 = $_G['config']['wechat8264'];	//8264户外资料网
		$this->wechat_api_8264_hd = $_G['config']['wechat8264hd'];	//8264活动平台
        $this->wechat_api_8264_fwh = $_G['config']['wechat8264fwh'];	//8264服务号
	}

	public function build_url($params)
	{
		ksort($params);
		reset($params);
		$str_q = http_build_query($params);
		$sign = md5($str_q.$this->secret);
		return '?'.$str_q.'&sign='.$sign;
	}

	// 验证用户是否已有授权记录
	public function isauth($uid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid')." WHERE uid='{$uid}' " . getSlaveID());
	}

	// 验证用户是否已有授权记录
	public function isauthByAppuid($appuid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid')." WHERE appuid='{$appuid}' " . getSlaveID());
	}

	// 增加授权记录
	public function allow($uid, $username, $appuid, $appusername, $web = false)
	{
		if(!$uid || !$username || !$appuid || !$appusername) {
			return false;
		}

		$status  = $this->isauth($uid);
		$status2 = $this->isauthByAppuid($appuid);

		//用户已经绑定了APP ID
		if($status || $status2) {
			return false;
		}

		//授权过期的话，重新生成授权。目前授权过期机制未启用
		$expriestime = $this->timestamp + 2592000;
		// $userkey = authcode($uid."\t".$username."\t".$expriestime, 'ENCODE');
		$userkey = $uid."|".$username;

		DB::query("INSERT INTO ".DB::table('common_openid')." (uid, username, appuid, appusername, userkey, expriestime) VALUES('$uid', '$username', '$appuid', '$appusername', '$userkey', '$expriestime')");
		DB::update('forum_activityapply', array('uid' => $uid, 'username' => $username), "appuserid='{$appuid}'");

		//如果是web授权绑定则缓存用户绑定信息，待获取
		if($web) {
			$code = md5($uid.$appuid);
			$md5str = md5($code.'&'.$this->secret);
			//将md5str缓存起来，待查
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
		//从缓存中取出md5str对应的绑定用户信息
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);
		$result = $redis->obj->get('openid_'.$md5str);
		return unserialize($result);
	}

	// 刷新授权，过期时间自动延长30天。未过期的授权可以自动延期，否则需重新授权
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

	// 解绑用户
	public function token_unbind($uid, $appuid)
	{
		file_put_contents(DISCUZ_ROOT.'data/dlogs/unbinduser.log', 'token_unbind|'.$appuid.'|'.$uid.'|'.date("Y-m-d H:i:s", time())."\r\n", FILE_APPEND);
		DB::query("DELETE FROM ".DB::table('common_openid')." WHERE uid='$uid' AND appuid='$appuid'");
		return DB::affected_rows();
	}

	// 第三方应用获取API TOKEN
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

	// 微信公众号API TOKEN中控接口
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

	// 8264户外资料网 微信公众号API TOKEN中控接口
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
	// 8264活动平台 微信公众号API TOKEN中控接口
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


    // 8264服务号 微信公众号API TOKEN中控接口
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

	//验证用户是否已有授权记录(微信)
	public function isWechatAuthByUid($uid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid_wechat')." WHERE uid='{$uid}' " . getSlaveID());
	}

	//验证用户是否已有授权记录(微信)
	public function isWechatAuthByUnionid($wechatunionid)
	{
		return DB::result_first("SELECT uid FROM ".DB::table('common_openid_wechat')." WHERE wechatunionid='{$wechatunionid}' " . getSlaveID());
	}

	//增加授权记录(微信)
	public function allow_wechat($uid, $username, $wechatunionid, $wechatuserid, $wechatusername)
	{
		if(!$uid || !$username || !$wechatunionid || !$wechatuserid) {
			return false;
		}

		$status  = $this->isWechatAuthByUid($uid);
		$status2 = $this->isWechatAuthByUnionid($wechatunionid);

		//用户已经绑定了wechat ID
		if($status || $status2) {
			return false;
		}
		$isSuccess = DB::insert('common_openid_wechat', array('uid' => $uid, 'username' => $username, 'wechatunionid' => $wechatunionid, 'wechatuserid' => $wechatuserid ,'wechatusername' => $wechatusername, 'dateline' => $this->timestamp));

		if ($isSuccess) {
			DB::update('forum_activityapply', array('uid' => $uid, 'username' => $username), "wechatuserid='{$wechatuserid}'");
		}

		return $isSuccess;
	}

	//根据论坛用户获得用户信息(微信)
	public function user_info_wechat($uid, $username)
	{
		$avatar = avatar($uid, 'middle', true);
		return array('uid' => $uid, 'username' => $username, 'userkey' => "{$uid}|{$username}", 'avatar' => $avatar);
	}

	//根据unionid获得用户信息(微信)
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
