<?php
/**
 *
 * @author Apple (qiu.dongfang@8264.com)
 * @date    2017-10-24 09:32:38
 * @version 0.1
 */

if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

define('EXAM_WECHAT', true);

Class LoginCtl extends FrontendCtl
{

	function __construct() {
		parent::__construct();
	}

	// 小程序接口文档 https://mp.weixin.qq.com/debug/wxadoc/dev/api/api-login.html#wxloginobject
	function wechat() {
        // 调用微信接口获取用户unionid
		// https://api.weixin.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code
		global $_G;
		if(!$_GET['wxcode']) {
			encodeData(array('error'=>true , 'errorinfo'=>'wxcode param missing'));
		}
		$wxapi = requestRemoteData("https://api.weixin.qq.com/sns/jscode2session?appid={$_G['config']['sapp']['appid']}&secret={$_G['config']['sapp']['appsecret']}&js_code={$_GET['wxcode']}&grant_type=authorization_code");
		$wxresult = json_decode($wxapi, true);
		if($wxresult['errcode']) {
			encodeData(array('error'=>true , 'errorinfo'=>$wxresult['errmsg']));
		}
		//取得用户unionid之后，去查该微信用户绑定的8264账户
        $unionid = $wxresult['unionid'];
        $info = $this->_is_unionid_bind($unionid);
        if($info){
            //得到8264账户信息之后，将uid/username放入$_G，调用_jwt生成结果返回给前端
            $prams['uid'] = $info['uid'];
            //获取用户名
            $data = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid=".$prams['uid'].getSlaveID());
            $prams['username'] = $data['username'];
            //登录成功
            encodeData(array('status'=>1,'token'=>_jwt('encode','',$prams,'')));
        }else{
            $prams['unionid'] = $unionid;
            //第一次用微信登录，没有绑定论坛账户，返回随机4个字的用户名和加密的unionid串 有效期5分钟 随后进入绑定注册流程
            $unionid_token = _jwt('encode','',$prams,'unionid');
            encodeData(array('status'=>2,'username'=>$this->_rand_chinese_word(),'unionid_token'=>$unionid_token));
        }

	}

    function check_username(){
        $username = addslashes(trim($_POST['username']));
        if(!$username){
            encodeData(array('error'=>true , 'errorinfo'=>'uname param missing'));exit;
        }
        if(!$username){
            encodeData(array('error'=>true , 'errorinfo'=>lang('message',"connect_register_no_username")));exit;
        }
        $data = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE username='{$username}'".getSlaveID());
        if($data){
            encodeData(array('error'=>true , 'errorinfo'=>lang('message','user_name_already_exists')));
        }else{
            encodeData(array('error'=>0));
        }
    }

    function rand_username(){
        encodeData(array('username'=>$this->_rand_chinese_word()));
    }

    function register(){
        require_once libfile('function/member');
        $username = addslashes(trim($_POST['username']));
        if(!$username){
            encodeData(array('error'=>true , 'errorinfo'=>'uname param missing'));exit;
        }
        $unionid_token = trim($_POST['unionid_token']);
        $jwt = _jwt('decode',$unionid_token);
        if($jwt['unionid']){
            //注册一个
            $password = md5(random(10));
            $email = '';
            include DISCUZ_ROOT .'/source/module/wechatconnect/models/wechat_user.class.php';

            $wechat_user = new Wechat_User($jwt['unionid'], $username, $password, $email);
            $uid = $wechat_user->add_wechat_user($username, 'sapp',$jwt['unionid']);
            if($uid){
                encodeData(array('token'=>_jwt('encode','',array('uid'=>$uid,'username'=>$username),''))); //jwt
            }else{
                encodeData(array('error'=>true , 'errorinfo'=>'register fail'));
            }
        }else{
            encodeData(array('error'=>true , 'errorinfo'=>'unionid_token wrong'));
        }
    }

    function bind(){
        $username = addslashes(trim($_POST['username']));
        $password = addslashes(trim($_POST['password']));
        $unionid_token = trim($_POST['unionid_token']);
        if(!$username){
            encodeData(array('error'=>true , 'errorinfo'=>'uname param missing'));exit;
        }
        if(!$password){
            encodeData(array('error'=>true , 'errorinfo'=>'pwd param missing'));exit;
        }
        $jwt = _jwt('decode',$unionid_token);
        if($jwt['unionid']){
            $result = userlogin(iconv("utf-8", "gbk", $username), $password, '0', '','auto');
            if($result['status'] == 1){
                $uid = $result['member']['uid'];
                $bind = DB::insert('common_member_connect_wechat', array(
                    'uid' => $uid,
                    'unionid' => $jwt['unionid'],
                    'openid' => 'sapp',
                    'nickname' => $result['member']['username'],
                    'bind_time' => time()
                ));
                if($bind){
                    encodeData(array('token'=>_jwt('encode','',array('uid'=>$uid,'username'=>$result['member']['username']),''))); //jwt
                }else{
                    encodeData(array('error'=>true , 'errorinfo'=>'bind fail'));
                }
            }else{
                encodeData(array('error'=>true , 'errorinfo'=>'login fail'));
            }
        }else{
            encodeData(array('error'=>true , 'errorinfo'=>'unionid_token wrong'));
        }

    }

    protected function _is_unionid_bind($unionid){
        include DISCUZ_ROOT .'/source/module/wechatconnect/models/wechat_user.class.php';
        $wechat_user = new Wechat_User();
        return $wechat_user->get_wechat_user('unionid', $unionid);

    }

    protected function _rand_chinese_word($len = 4){
        $str = lang('seccode', 'chn');
        $word = '';
        for($i=0;$i<$len;$i++){
            $start = rand(1,999) * 2;
            $word .= substr($str,$start,2);
        }
        return $word;
    }
}
