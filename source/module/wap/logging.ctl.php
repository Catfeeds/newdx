<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class LoggingCtl extends FrontendCtl
{

    function __construct()
    {
        parent::__construct();

        require_once libfile('function/misc');
        require_once libfile('function/verify');
        //����ucenter����ļ�
        loaducenter();
    }

    //��¼��
    function form()
    {
        global $_G;
        global $returnData;

        $returnData["isYzm"] = loginIsAppearVerify($_G['gp_ip']);
        encodeData($returnData);

    }

    //��¼--�ο�class/class_member.php��on_login()
    function doLogin()
    {
        global $_G;
        global $returnData;

        //�Ѿ���¼
        if ($_G['uid']) {
            $ucsynlogin = $_G["setting"]['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';
            encodeData($returnData);
        }
        $from_connect = $_G['setting']['connect']['allow'] && !empty($_G['gp_from']) ? 1 : 0;
        $secqaacheck = $from_connect ? false : loginIsAppearVerify($_G['gp_ip']);
        if (!submitcheck('login_submit', 1, 0, $secqaacheck, 'wap')) {
            encodeData(array('error' => true, 'errorinfo' => "δ֪����"));
        } else {
            //��������
            /*if (! empty($_G['gp_auth'])) {
                list($_G['gp_username'], $_G['gp_password']) = daddslashes(explode("\t", authcode($_G['gp_auth'], 'DECODE')));
            }*/

            $_G['gp_username'] = isset($_G['gp_username']) ? iconv("utf-8", "gbk//TRANSLIT", $_G['gp_username']) : '';

            //���������������������ʾ
            if (!logincheck($_G['gp_username'], $_G['gp_ip'])) {
                encodeData(array('error' => true, 'errorinfo' => lang('message', 'login_strike')));
            }
            if ($_G['gp_fastloginfield']) {
                $_G['gp_loginfield'] = $_G['gp_fastloginfield'];
            }

            $_G['uid'] = $_G['member']['uid'] = 0;
            $_G['username'] = $_G['member']['username'] = $_G['member']['password'] = '';

            //����������ʾ
            if (!$_G['gp_password'] || $_G['gp_password'] != addslashes($_G['gp_password'])) {
                encodeData(array('error' => true, 'errorinfo' => lang('message', 'profile_passwd_illegal')));
            }

            //��¼-ȥ���˰�ȫ����
            $result = userlogin_m($_G['gp_username'], $_G['gp_password'], $_G['gp_questionid'], $_G['gp_answer'], $_G["setting"]['autoidselect'] ? 'auto' : $_G['gp_loginfield']);
            //encodeData(array('error' => true, 'errorinfo' => $result['status']+23));
            $uid = $result['ucresult']['uid'];
            /*if (! empty($_G['gp_lssubmit']) && ($result['ucresult']['uid'] == -3 || $seccodecheck && $result['status'] > 0)) {
                $_G['gp_username'] = $result['ucresult']['username'];
                $_G['gp_password'] = stripslashes($_G['gp_password']);
                $this->logging_more($result['ucresult']['uid'] == -3);
            }*/
            //ucenter��������,��discuz��û��,����
            if ($result['status'] == -1) {
                if (!$_G["setting"]['fastactivation']) {
                    encodeData(array('error' => true, 'errorinfo' => lang('message', 'location_activation')));
                } else {
                    //ucenter��������,��discuz��û��,����
                    $result = daddslashes($result);
                    $init_arr = explode(',', $_G['initcredits']);
                    DB::insert('common_member', array(
                        'uid' => $uid,
                        'username' => $result['ucresult']['username'],
                        'password' => md5(random(10)),
                        'email' => $result['ucresult']['email'],
                        'adminid' => 0,
                        'groupid' => $_G['regverify'] ? 8 : $_G['newusergroupid'],
                        'regdate' => TIMESTAMP,
                        'credits' => $init_arr[0],
                        'timeoffset' => 9999));
                    DB::insert('common_member_status', array(
                        'uid' => $uid,
                        'regip' => $_G['clientip'],
                        'lastip' => $_G['clientip'],
                        'lastvisit' => TIMESTAMP,
                        'lastactivity' => TIMESTAMP,
                        'lastpost' => 0,
                        'lastsendmail' => 0));
                    DB::insert('common_member_profile', array('uid' => $uid));
                    DB::insert('common_member_field_forum', array('uid' => $uid));
                    DB::insert('common_member_field_home', array('uid' => $uid));
                    DB::insert('common_member_count', array(
                        'uid' => $uid,
                        'extcredits1' => $init_arr[1],
                        'extcredits2' => $init_arr[2],
                        'extcredits3' => $init_arr[3],
                        'extcredits4' => $init_arr[4],
                        'extcredits5' => $init_arr[5],
                        'extcredits6' => $init_arr[6],
                        'extcredits7' => $init_arr[7],
                        'extcredits8' => $init_arr[8]));
                    manyoulog('user', $uid, 'add');
                    $result['member'] = DB::fetch_first("SELECT * FROM " . DB::table('common_member') . " WHERE uid='$uid'");
                    $result['status'] = 1;
                }
            }
            if ($result['status'] > 0) {

                //qq���˺�
                if ($_G['gp_openid']) {
                    $this->qq_bind($uid, $_G['gp_openid'], $_G['timestamp']);
                }
                //΢�����˺�
                if ($_G['gp_access_token'] && $_G['gp_sina_uid'] && $_G['gp_wb'] == 'wb') {
                    $this->wb_bind($uid, $_G['gp_sina_uid'], $_G['gp_access_token']);
                }
                //΢�Ű��˺�
                if ($_G['gp_unionid']){
                    $this->wechat_bind($uid, $_G['gp_unionid'], $_G['timestamp']);
                }
                /*
                $extrafile = "connect_logging";
                if ($extrafile && file_exists(libfile('member/' . $extrafile, 'module'))) {
                    require_once libfile('member/' . $extrafile, 'module');
                }*/
                //��¼�û�״̬,�������¼��$_G["cookie"]["auth"]
                setloginstatus($result['member'], $_G['gp_cookietime'] ? 2592000 : 0);

                //�����û�״̬
                DB::query("UPDATE " . DB::table('common_member_status') . " SET lastip='" . $_G['clientip'] . "', lastvisit='" . time() . "', lastactivity='" . TIMESTAMP . "' WHERE uid='$_G[uid]'");
                //$ucsynlogin = $_G['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';
                /**ͬ����½ lvshuo 2017.2.8 start**/
                $ucsynlogin = uc_user_synlogin($_G['uid']);
                $returnData['str_ucsynlogin'] = $ucsynlogin;
                /**ͬ����½ lvshuo 2017.2.8 end**/

                $returnData['G']['member'] = $_G['member'];
                $returnData['G']['group'] = $_G['group'];
                $returnData['G']['formhash'] = formhash();

                //��¼�û���¼
                $uparr = array('logontype' => '1', 'action' => '1');

                addrecorduserupdownlog($uparr);

                if ($_G['groupid'] == 8) {
                    encodeData(array('error' => true, 'errorinfo' => "����ʺŴ��ڷǼ���״̬"));
                }

                $returnData["G"]["auth"] = !empty($_G["cookie"]["auth"]) ? $_G["cookie"]["auth"] : "";
                encodeData($returnData);

            } else {
                //��¼��¼ʧ��ԭ��
                $password = preg_replace("/^(.{" . round(strlen($_G['gp_password']) / 4) . "})(.+?)(.{" . round(strlen($_G['gp_password']) / 6) . "})$/s", "\\1***\\3", $_G['gp_password']);
                $errorlog = dhtmlspecialchars(TIMESTAMP . "\t" . ($result['ucresult']['username'] ? $result['ucresult']['username'] : dstripslashes($_G['gp_username'])) . "\t" . $password . "\t" . "Ques #" . intval($_G['gp_questionid']) . "\t" . $_G['clientip']);
                writelog('illegallog', $errorlog);
                loginfailed($_G['gp_username'], $_G['gp_ip']);
                $fmsg = $result['ucresult']['uid'] == '-3' ? (empty($_G['gp_questionid']) || $answer == '' ? 'login_question_empty' : 'login_question_invalid') : 'login_invalid';
                $num = logincheck($_G['gp_username'], $_G['gp_ip']);
                encodeData(array('error' => true, 'errorinfo' => lang('message', $fmsg, array('loginperm' => $num))));
            }
        }
    }

    //�ǳ�--�ο�class/class_member.php��on_logout()
    function doLogout()
    {
        global $_G;
        global $returnData;

        $ucsynlogout = $_G['allowsynlogin'] ? uc_user_synlogout() : '';
        if ($_G['gp_formhash'] != $_G['formhash']) {
            encodeData(array('error' => true, 'errorinfo' => $_G['gp_formhash'] . '===' . $_G['formhash']));
//			encodeData($returnData);
        }

        //��¼�û��˳�
        $downarr = array('logontype' => '1', 'action' => '2');
        addrecorduserupdownlog($downarr);

        //���cookie
        clearcookies();

        $returnData['G']['member']['groupid'] = 7;
        $returnData['G']['member']['uid'] = 0;
        $returnData['G']['member']['username'] = '';
        $returnData['G']['member']['password'] = '';

        encodeData($returnData);
    }

    //qq��ԭ��8264�ʺ�
    function qq_bind($uid, $openid, $time)
    {
        $connect_member = DB::fetch_first("SELECT uid FROM " . DB::table('common_member_connect') . " WHERE uid='$uid'");
        if ($connect_member) {
            encodeData(array('error' => true, 'errorinfo' => lang('message', 'connect_register_bind_already')));
        } else {
            DB::query("INSERT INTO " . DB::table('common_member_connect') . " (uid, conopenid) VALUES ('$uid','$openid')");
        }
        DB::query("UPDATE " . DB::table('common_member') . " SET conisbind='1' WHERE uid='$uid'");
        DB::query("INSERT INTO " . DB::table('connect_memberbindlog') . " (uid, uin, type, dateline) VALUES ('$uid', '', '1', '$time')");

    }
    //΢����ԭ��8264�ʺ�
    function wb_bind($uid, $sina_uid, $access_token)
    {
        $connect_member = DB::fetch_first("SELECT uid FROM " . DB::table('xwb_bind_info') . " WHERE uid='$uid'");
        if ($connect_member) {
            encodeData(array('error' => true, 'errorinfo' => lang('message', 'user_had_binded_sina')));
        } else {
            $wb_data = array(
                'uid' => $uid,
                'sina_uid' => $sina_uid,
                'token' => $access_token,
                'tsecret' => '',
                'profile' => '[]'

            );
            DB::insert('xwb_bind_info', $wb_data);
        }
    }

    //΢�Ű�ԭ��8264�ʺ�
    function wechat_bind($uid, $unionid, $time)
    {
        $connect_member = DB::fetch_first("SELECT uid FROM " . DB::table('common_member_connect_wechat') . " WHERE uid='$uid'");
        if ($connect_member) {
            encodeData(array('error' => true, 'errorinfo' => lang('message', 'user_had_binded_wechat')));
        } else {
            $wechat_data = array(
                'uid' => $uid,
                'unionid' => $unionid,
                'bind_time' => $time
            );
            DB::insert('common_member_connect_wechat', $wechat_data);
        }
    }
}