<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
/*
if(isset($_POST['inajax']) && $_POST['inajax']==1){
    if($_POST['method']=='unban'){
        $unbanip = $_G['clientip'];
        echo unban($unbanip);
    }
    if($_POST['method']=='yzm'){
        $yzm=iconv("utf-8","gbk",$_POST['yzm']);
        if($_COOKIE['8264unbanyzm']==$yzm){
            echo "ok";
        }else{
            echo '��֤�����';
        }
    }
}else{
    echo "���������";
}
*/
require_once dirname(__FILE__) . '/geetestlib.php';
if(function_exists('geetest_validate')){
	$validate_response = geetest_validate(@$_POST['geetest_challenge'], @$_POST['geetest_validate'], @$_POST['geetest_seccode']);
	if ($validate_response) {
		unban($_G['clientip']);
		echo '<script>var c_time = 3;function unbansuccess(){c_time--;document.getElementById("ctime").innerHTML = c_time;if(c_time <= 0){location' . (@$_GET['newmod'] == 1 ? '.href="http://bbs.8264.com"' : '.reload()') . ';}else{setTimeout(unbansuccess, 1000);}};setTimeout(unbansuccess, 1000);</script><span class="green">���ɹ���<span id="ctime">3</span>�����ת</span>';
		die();
	}
}
echo '<span class="red">��֤ʧ�ܣ������³���</span>';
function unban($ip){
    global $_G ;
    $pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
    $max = $_G['cache']['plugin']['ipbanspider']['maxzznum'] > 0 ? $_G['cache']['plugin']['ipbanspider']['maxzznum'] : 10;
    $expire_logon = $_G['cache']['plugin']['ipbanspider']['linshi_white_logon'] >= 1 ? $_G['cache']['plugin']['ipbanspider']['linshi_white_logon'] : 24;
    $expire_nologon = $_G['cache']['plugin']['ipbanspider']['linshi_white_nologon'] >= 1 ? $_G['cache']['plugin']['ipbanspider']['linshi_white_nologon'] : 3;
	$agent = trim($_SERVER['HTTP_USER_AGENT']);
    require_once libfile('class/myredis');
    $newredis = & myredis::instance(6379);
	//change db
	$newredis->SELECTDB(1);
    $mynum = $newredis->ZCARD($pre.'history_ban_'.$ip);
	$mykey = $pre.'whitelist_linshi_'.($_G['uid'] ? '' : 'no').'logon_' . str_replace('.', '_', $ip);
	$md5id = md5("{$ip}_" . ($_G['uid'] ? $_G['uid'] : 'nolog') ."_{$agent}");
	$newredis->sAdd($mykey, $md5id);
	if($newredis->ttl($mykey) == -1){
		$newredis->EXPIRE($mykey, $_G['uid'] ? 3600 * $expire_logon : 3600 * $expire_nologon);
	}
    if($mynum > $max) return "���쳣̫Ƶ���ˣ�����<b style='color:red'>".$mynum."</b>�Σ�����ϵ����Ա<a target='_blank' href='http://wpa.qq.com/msgrd?v=3&uin=7171608&site=qq&menu=yes'><img border='0' src='http://wpa.qq.com/pa?p=2:7171608:51' alt='���������ҷ���Ϣ' title='���������ҷ���Ϣ'/></a><br>�ṩ����������Ϣ��<br />IP:<b style='color:blue'>$ip</b> | �����:<b style='color:blue'>{$_SERVER['HTTP_USER_AGENT']}</b>";
    if($newredis->zScore($pre.'blacklist' ,$ip)!==false){
        $microtime = microtime(true);
        $newredis->delete($pre.'COMMON_IP_'.$ip.'_zset' ,0);
        $newredis->zRem($pre.'blacklist' ,$ip);
        $newredis->hashdel($pre.'unbantime' ,$ip);
        $res = '[<b class="blue">'.date('Y-m-d H:i:s' ,$microtime).'</b>]��������IP��[<b class="red">'.$ip.'</b>]ͨ��'.($_G['uid'] ? '�û�[<a href="'.$_G['config']['web']['home'].$_G['uid'].'" class="blue">'.$_G['username'].'</a>]' : 'δ��¼�û�[agent:<b class="blue">'.$agent.'</b>]').'<b class="green">�������</b>';
        $newredis->ZADD($pre.'history_unban_'.$ip ,$microtime ,$res);
    }
    return "<p>�����ɹ�3��󷵻���ҳ,<a href='http://www.8264.com' style='font-weight:bold;color:#0099CC'>���������ҳ</a></p>";
}
?>
