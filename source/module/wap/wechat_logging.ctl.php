<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class Wechat_loggingCtl extends FrontendCtl{
	
	function __construct()
	{
		parent::__construct();
		require_once libfile('function/misc');
        require_once libfile('function/connect');
		//引入ucenter相关文件
		loaducenter();
	}
	
	//登录表单
        function index(){
            global $_G;
            global $returnData;
            $unionid = !empty($_G['gp_unionid']) ? $_G['gp_unionid'] : "";
            //encodeData(array('error' => true, 'errorinfo' => 456));
            if($unionid){
                $connect_member = DB::fetch_first("SELECT uid, unionid FROM ". DB::table('common_member_connect_wechat')." WHERE unionid='$unionid'");
                $returnData["connect_member"] = $connect_member;
            }
            if($connect_member) {
                $member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$connect_member[uid]'");
                if($member) {
                    $this->connect_login($connect_member);

                    loadcache('usergroups');
                    $usergroups = $_G['cache']['usergroups'][$_G['groupid']]['grouptitle'];
                    $param = array('username' => $_G['member']['username'], 'usergroup' => $_G['group']['grouptitle']);
                    DB::query("UPDATE ".DB::table('common_member_status')." SET lastip='".$_G['clientip']."', lastvisit='".time()."' WHERE uid='$connect_member[uid]'");
                    $ucsynlogin = '';
                    // if($_G['setting']['allowsynlogin']) {
                    //         loaducenter();
                    //         $ucsynlogin = uc_user_synlogin($_G['uid']);
                    // }
                    /**同步登陆 lvshuo 2017.2.8 start**/
                    loaducenter();
                    $ucsynlogin =uc_user_synlogin($_G['uid']);
                    $returnData['str_ucsynlogin'] =$ucsynlogin;
                    /**同步登陆 lvshuo 2017.2.8 end**/

                    $returnData['G']['member']	  = $_G['member'];
                    $returnData['G']['group']  	  = $_G['group'];
                    $returnData['G']['formhash']  = formhash();
                    $returnData["G"]["auth"] = !empty($_G["cookie"]["auth"]) ? $_G["cookie"]["auth"] : "";
                    $returnData["member"] = $member;
                } else {
                    DB::delete('common_member_connect_wechat', array('uid' => $connect_member['uid']));
                    unset($connect_member);
                }
                
            }
            
            encodeData($returnData);
            

        }
        
        function connect_login($connect_member) {
                global $_G;

                $member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$connect_member[uid]'");
                if(!$member) {
                        return false;
                }

                require_once libfile('function/member');
                $cookietime = 1296000;
                setloginstatus($member, $cookietime);

                dsetcookie('connect_login', 1, $cookietime);
                dsetcookie('connect_is_bind', 1, 31536000);
                dsetcookie('connect_uin', $connect_member['conopenid'], 31536000);

                include_once libfile('function/stat');
                updatestat('login', 1);

                updatecreditbyaction('daylogin', $_G['uid']);
                checkusergroup($_G['uid']);
                return true;
        }
	
}
?>