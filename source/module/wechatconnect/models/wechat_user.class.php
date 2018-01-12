<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(! defined('EXAM_WECHAT')){
    require_once WECHAT_CONNECT . '/API/class/wechat.class.php';
}

class Wechat_User {
	var $uid = -999;
	var $unionid=-1000;
	var $username = '';
	var $password = '';
	var $email = '';
	var $question = '';
	var $answer = '';
	var $groupid = -999;
	var $ip;
	var $timestamp = 0;
	const HAS_BINDED = 1;
	const BIND_FAILED = 2;
	const BIND_SUCCESSFULLY = 3;

	const USER_ERROR = -1;
	const EMAIL_ERROR = -4;
	const REGISTER_SUCCESS = 30000;
	const REGISTER_FAIL = 40000;
	static $errArr = array(
		self::USER_ERROR => '用户名已经存在或者不符合要求',
		self::EMAIL_ERROR => '邮箱已存在或者格式不正确',
		self::REGISTER_SUCCESS => '使用微信登录注册成功!',
		self::REGISTER_FAIL => '使用微信登录注册失败!'
		);

	function __construct($unionid='', $username='', $password='', $email='') {
		global $_G;

		loaducenter();
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->unionid = $unionid;
		$this->timestamp = time();
		$this->ip = $_G['clientip'];
	}
	/*just accept one condition, if user is binded, return the user*/
	public function get_wechat_user($table_field, $table_value) {
		$table_value = $table_value ? $table_value : $this->table_value;
		if(! $table_value || empty($table_value)) {
			return false;
		}

		$table_field = in_array($table_field, array("uid", "unionid")) ? $table_field : 'unionid';
		$table_value = mysql_escape_string($table_value);
		$table_name = DB::table('common_member_connect_wechat');
		$wechat_user = DB::fetch_first("SELECT * FROM  {$table_name} WHERE {$table_field}='{$table_value}'");

		return $wechat_user ? $wechat_user : false;
	}

	/*when register, insert user into database*/
	public function  add_wechat_user($nickname = '',$open_id = '',$unionid = '') {
		if(! $this->_checkUserName()) {
			return self::USER_ERROR;
		}

//		if(! $this->_checkEmail()) {
//			return self::EMAIL_ERROR;
//		}

		if($this->_regToUCDZX() && $this->uid > 0) {
	        $site_uid = mysql_escape_string($this->uid);
	        //use cookie to limit user to register in 2 minutes

            if(defined('EXAM_WECHAT')){
                $openid = $open_id;
                $wechat_unionid = $unionid;
                $wechat_nickname = $nickname;
            }else{
                $wechat = new Wechat();
                $openid = mysql_escape_string($wechat->getInfo('bind_info/openid'));
                $wechat_unionid = mysql_escape_string($this->unionid ? $this->unionid : $wechat->getInfo('bind_info/unionid'));
            }
	        $rst = DB::insert('common_member_connect_wechat', array(
                    'nickname' => $wechat_nickname ? $wechat_nickname : '',
	        		'uid' => $site_uid,
	        		'unionid' => $wechat_unionid,
	        		'openid' => $openid,
	        		'bind_time' => $this->timestamp
	        	));
		}

		return $this->uid;
	}

	public function bind_wechat_user() {
		$get_wechat_user = $this->get_wechat_user('unionid', $this->unionid);

        $wechat_user =  $get_wechat_user ? $get_wechat_user : $this->get_wechat_user('uid', $this->uid);
		//already binded
		if($wechat_user['uid']) {
			return Wechat_User::HAS_BINDED;
		}
		$site_uid = mysql_escape_string($this->uid);
        //use cookie to limit user to register in 2 minutes
        $wechat = new Wechat();
        $wechat_unionid = mysql_escape_string($this->unionid ? $this->unionid : $wechat->getInfo('bind_info/unionid'));
        $openid = mysql_escape_string($wechat->getInfo('bind_info/openid'));
        if(! $wechat_unionid || ! $site_uid || ! $openid) {
        	return Wechat_User::BIND_FAILED;
        }
        $rst = DB::insert('common_member_connect_wechat', array(
            'uid' => $site_uid,
            'unionid' => $wechat_unionid,
            'openid' => $openid,
            'bind_time' => $this->timestamp
        ));
        //binded successfully
        return Wechat_User::BIND_SUCCESSFULLY;
	}

	/*when user registers successfully, this user will login. TO DO: extend from parent class*/
	function connect_login($uid) {
		global $_G;
		$uid = $uid ? $uid : $this->uid;
		if(! ($uid > 0)) return false;

		$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='" . $uid . "'");
		$wechat_user = $this->get_wechat_user('uid', $uid);
		if( ! $member || ! $wechat_user) {
			return false;
		}

		require_once DISCUZ_ROOT . '/source/function/function_member.php';
	  	setloginstatus($member, time() + 60*60*24 ? 2592000 : 0);

	    DB::query("UPDATE ".DB::table('common_member_status')." SET lastip='".$_G['clientip']."', lastvisit='".time()."' WHERE uid='$uid'");

	    include_once libfile('function/stat');
	    updatestat('login');
	    updatecreditbyaction('daylogin', $uid);
	    checkusergroup($uid);
	    return true;
	}

	/**
	 * 在UC和DZX进行用户初始化注册
	 * @access protected
	 * @return boolen
	 */
	private function _regToUCDZX(){
		global $_G;

		$this->uid = (int)uc_user_register($this->username, $this->password, $this->email, $this->questionid, $this->answer);

		if ($this->uid > 0){
			//在有UC的情况下，附属论坛的members表password列并不存储真实密码，只是用于cookies登陆状态校样。
			$init_arr = explode ( ',', $_G ['setting'] ['initcredits'] );
			$userdata = array (
				'uid' => $this->uid,
				'username' => $this->username,
				'password' => md5(rand(100000,999999)),
				'email' => $this->email,
				'conisbind' => 0,
				'adminid' => 0,
				'groupid' => $this->groupid,
				'regdate' => $this->timestamp,
				'credits' => $init_arr[0],
				'timeoffset' => 9999
			);
				//pre_common_member 用户主表
			$insert = DB::insert ('common_member', $userdata, false, false, true);
			if(! $insert) return false;

			$status_data = array (
				'uid' => $this->uid,
				'regip' => $this->ip,
				'lastip' => $this->ip,
				'lastvisit' => $this->timestamp,
				'lastactivity' => $this->timestamp,
				'lastpost' => 0,
				'lastsendmail' => 0
			);

			//pre_common_member_status 用户状态表
			$insert = DB::insert ( 'common_member_status', $status_data, false, false, true);
			if(! $insert) return false;

			$profile ['uid'] = $this->uid;
			//pre_common_member_profile 用户栏目表
			$insert = DB::insert ( 'common_member_profile', $profile, false, false, true);
			if(! $insert) return false;

			//pre_common_member_field_forum 用户论坛字段表
			$insert = DB::insert ( 'common_member_field_forum', array ('uid' => $this->uid ), false, false, true);
			if(! $insert) return false;

			//pre_common_member_field_home 用户家园字段表
			$insert = DB::insert ( 'common_member_field_home', array ('uid' => $this->uid ), false, false, true);
			if(! $insert) return false;

			//初始化积分
			$count_data = array (
				'uid' => $this->uid,
				'extcredits1' => $init_arr [1],
				'extcredits2' => $init_arr [2],
				'extcredits3' => $init_arr [3],
				'extcredits4' => $init_arr [4],
				'extcredits5' => $init_arr [5],
				'extcredits6' => $init_arr [6],
				'extcredits7' => $init_arr [7],
				'extcredits8' => $init_arr [8]
			);
			//pre_common_member_count 用户统计表
			$insert = DB::insert ('common_member_count', $count_data, false, false, true);
			if(! $insert) return false;

			return true;
		}else{
			return false;
		}
	}

	function deleteWechatUser($uid) {
		$uid = $uid ? $uid : $this->uid;
		if(! $uid) return;

		uc_user_delete($uid);
		DB::delete('common_member_connect_wechat', "uid={$uid}", 1);
		DB::delete('common_member', "uid={$uid}", 1);
		DB::delete('common_member_status', "uid={$uid}", 1);
		DB::delete('common_member_profile', "uid={$uid}", 1);
		DB::delete('common_member_field_forum', "uid={$uid}", 1);
		DB::delete('common_member_field_home', "uid={$uid}", 1);
		DB::delete('common_member_count', "uid={$uid}", 1);
	}

	private function _checkEmail() {
		//error_log('email: ' . $this->email);
		if(! $this->email) return false;
		//check database, to do
		return true;
	}

	private function _checkIsExist($table_name, $where) {
		$table = DB::table($table_name);
		$result = DB::fetch_first("SELECT * FROM {$table} where {$where}");
		return $result ? true : false;
	}
	private function _checkUserName() {
		//error_log('username: ' . $this->username);
		if(! $this->username) return false;
		//check database, to do
		return true;
	}











}
