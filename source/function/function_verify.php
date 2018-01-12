<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

//统计所有登录错误次数
function sumFailedLogin($ip = '', $username = ''){
    require_once libfile('class/myredis');
    $redis = & myredis::instance(6381);
    $key = md5('login_is_verify');
    $where = '1=1';
    $sum = 300;
    if($ip){
        $key = md5($key.'_'.$ip);
        $where = $where . " And ip = '{$ip}'";
        $sum = 30;
    }
    if($username){
        $key = md5($key.'_'.$username);
        $where = $where . " And username = '{$username}'";
        $sum = 2;
    }
    $cache = $redis->GET($key);
    if($cache == 1){
        return 1;
    }else{
        $res = DB::fetch_first("Select sum(count) as count from ".DB::table('common_failedlogin')." where {$where}");
        if($res['count'] > $sum){
            $redis->SET($key,1);
            $redis->EXPIRE($key, 300); //缓存5分钟
            return 1;
        }else{
            return 0;
        }
    }
}
//判断登陆时是否该出现验证码
function loginIsAppearVerify($ip = '', $username = ''){
    return 1;
    global $_G;
    $res = checkperm('seccode') && ($_G['setting']['secqaa']['status'] & 8);
    if($res){
        return 1;
    }else{
        $res = sumFailedLogin();
        if($res){
            return 1;
        }else{
            $res = sumFailedLogin($ip);
            if($res){
                return 1;
            }else{
                return sumFailedLogin('', $username);
            }
        }
    }
}

//统计所有注册成功次数
function sumRegIp($ip = ''){
    global $_G;
    require_once libfile('class/myredis');
    $redis = & myredis::instance(6381);
    $key = md5('reg_is_verify');
    $where = 'count > 0';
    $sum = 750;
    if($ip){
        $key = md5($key.'_'.$ip);
        $where = $where . " And ip = '{$ip}' And dateline BETWEEN " . ($_G['timestamp'] - 900) . ' And ' . $_G['timestamp'];
        //$where = $where . " And ip = '{$ip}'";
        $sum = 3;
    }
    $cache = $redis->GET($key);
    if($cache == 1){
        return 1;
    }else{
        $res = DB::fetch_first("Select sum(count) as count from ".DB::table('common_regip')." where {$where}");
        if($res['count'] > $sum){
            $redis->SET($key,1);
            $redis->EXPIRE($key, 600); //缓存10分钟
            return 1;
        }else{
            return 0;
        }
    }
}
//判断注册时是否该出现验证码
function regIsAppearVerify($ip = ''){
    return 1;
    global $_G;
    $res = checkperm('seccode') && ($_G['setting']['secqaa']['status'] & 8);
    if($res){
        return 1;
    }else{
        $res = sumRegIp();
        if($res){
            return 1;
        }else{
            return sumRegIp($ip);
        }
    }
}
?>