<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class Wb_loggingCtl extends FrontendCtl{
	
	function __construct()
	{
		parent::__construct();
		
		require_once libfile('function/misc');
                require_once libfile('function/connect');
		loaducenter();
	}
	//登录表单
        function index(){
//            require_once DISCUZ_ROOT . './source/module/sinaconnect/models/sina_user.class.php';
            global $_G;
            global $returnData;
            //$openid = !empty($_G['gp_openid']) ? $_G['gp_openid'] : "";
            //获取sina user
            $bind_info_uid = !empty($_G['gp_uid']) ? $_G['gp_uid'] : "";            
            if($bind_info_uid){
                $sina_user_info = $this->get_sina_user('sina_uid', $bind_info_uid);
                $returnData["sina_user_info"] = $sina_user_info;
            }
            
            if($sina_user_info){
                $member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$sina_user_info[uid]'");
                $this->connect_login($sina_user_info);
                loadcache('usergroups');
                $usergroups = $_G['cache']['usergroups'][$_G['groupid']]['grouptitle'];
                $param = array('username' => $_G['member']['username'], 'usergroup' => $_G['group']['grouptitle']);
                DB::query("UPDATE ".DB::table('common_member_status')." SET lastip='".$_G['clientip']."', lastvisit='".time()."' WHERE uid='$sina_user_info[uid]'");
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
            }
            encodeData($returnData);
            

        }
        function get_sina_user($sina_field='sina_uid', $sina_value) {
		$sina_value = $sina_value ? $sina_value : $this->sina_id;
		if(! $sina_value || empty($sina_value)) {
			return false;
		}

		$sina_field = mysql_escape_string($sina_field);
		$sina_value = mysql_escape_string($sina_value);
		$table_name = DB::table('xwb_bind_info');
		$sina_user = DB::fetch_first("SELECT * FROM  {$table_name} WHERE {$sina_field}='{$sina_value}'");

		return $sina_user ? $sina_user : false;
	}
        
        function connect_login($sina_user_info) {
                global $_G;

                $member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$sina_user_info[uid]'");
                if(!$member) {
                        return false;
                }

                require_once libfile('function/member');
                $cookietime = 1296000;
                setloginstatus($member, $cookietime);

                dsetcookie('connect_login', 1, $cookietime);
                dsetcookie('connect_is_bind', 1, 31536000);

                include_once libfile('function/stat');
                updatestat('login', 1);

                updatecreditbyaction('daylogin', $_G['uid']);
                checkusergroup($_G['uid']);
                return true;
        }
	
}
?>