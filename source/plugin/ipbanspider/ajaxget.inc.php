<?php
/**
 * @author JiangHong
 * @copyright 2013
 * ����ajax��ȡ��Ϣ���
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
if($_G['gp_inajax'] && $_G['groupid']==1){
    $mode = $_G['gp_m'];
    $v = $_G['gp_v'];
    $other = $_G['gp_other'] ? $_G['gp_other'] : '';
    $arrmod = array('black' ,'white' ,'history' ,'select' ,'spider' ,'doubt', 'linshiwhite', 'userwhite');
    $arrv = array('count' ,'list' ,'find' ,'update' ,'delete' ,'clear');
    if(in_array($mode ,$arrmod) && in_array($v ,$arrv)){
        global $pre,$newredis;
        $pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
        require_once libfile('class/myredis');
        $newredis = & myredis::instance(6379);
        //change db
        $newredis->SELECTDB(1);
        $return = call_user_func('get_ipbanspider_'.$mode , $v ,$other);
    }
}else{
    $return = '<span>��Ȩ��</span>';
}
include template('common/header_ajax');
echo $return;
include template('common/footer_ajax');
function get_ipbanspider_black($v , $arg=''){
    global $pre,$newredis;
    switch($v){
        case 'count':
            $u = $newredis->ZCARD($pre.'blacklist');
            $r = intval($u - $arg);
            $url = "admin.php?action=plugins&operation=config&identifier=ipbanspider&pmod=blacklist&page=1";
            $return = $r > 0 ? '<p onclick="find_new();">��ǰ��<b>'.$r.'</b>������</p>' : '<span></span>';
            break;
        case 'list':
            list($ip ,$y ,$m) = explode('|',$arg);
            $url = "admin.php?action=plugins&operation=config&identifier=ipbanspider&pmod=$y&page=1";
            if($m == 'ban'){
                ban($ip);
                $return = '<p onclick="find_new();"><b class="blue">'.$ip.'</b><b class="red">��Ų���</b>��ɿ��Ե������</p>';
            }elseif($m == 'unban'){
                unban($ip);
                $return = '<p onclick="find_new();"><b class="blue">'.$ip.'</b><b class="green">������</b>��ɿ��Ե������</p>';
            }else{
                $return = '<span></span>';
            }
            break;
        default :
            $return = '<span></span>';
            break;
    }
    return $return;
}
function get_ipbanspider_doubt($v ,$arg=''){
    global $pre,$newredis;
    switch($v){
        case 'delete':
            $newredis->sRem($pre.'config_doubtip_set' ,$arg);
            $return = '<p onclick="find_new();"><b class="red">ɾ������IP��<b class="blue">'.$arg.'</b>����</b>��ɿ��Ե������</p>';
            break;
        case 'clear':
            $newredis->delete($pre.'config_doubtip_set');
            $return = '<p onclick="find_new();"><b class="red">������п���IP����</b>��ɿ��Ե������</p>';
            break;
        default:
            $return = '<span>no</span>';
    }
    return $return;
}
function get_ipbanspider_spider($v ,$arg=''){
    switch($v){
        case 'update':
            list($id ,$friend) = explode('|' ,$arg);
            spider_edit($id ,$friend);
            $return = '<p onclick="find_new();"><b class="green">״̬����</b>��ɿ��Ե������</p>';
            break;
        case 'delete':
            spider_delete($arg);
            $return = '<p onclick="find_new();"><b class="red">ɾ������</b>��ɿ��Ե������</p>';
            break;
        case 'clear':
            spider_clear();
            $return = '<p onclick="find_new();"><b class="red">��ջ������</b>��ɿ��Ե������</p>';
            break;
        default:
            $return = '<span>no</span>';
    }
    return $return;
}
function spider_getkey($friend){
    global $pre ,$_G;
    loadcache('plugin');
    $pre = $_G['cache']['plugin']['ipbanspider']['redis_per'] ? $_G['cache']['plugin']['ipbanspider']['redis_per'] : "BanIpSpider_";
    return $pre.'config_spider_'.($friend == 0 ? 'danger' : 'friend').'_zset';
}
function spider_edit($id ,$friend){
    global $newredis;
    $name = empty($name) ? DB::result_first('SELECT sname FROM '.DB::table('plugin_ipbanspider_spiders')." WHERE sid=$id") : $name;
    DB::update('plugin_ipbanspider_spiders' ,array('friend' => intval($friend)) ,array('sid'=>$id));
    $val = intval($newredis->zScore(spider_getkey(1^$friend) ,$name));
    $newredis->zRem(spider_getkey(1^$friend) ,$name);
    $newredis->ZADD(spider_getkey($friend) ,intval($val) ,$name);
}
function spider_delete($id){
    global $newredis;
    $id = intval($id);
    if($id>0){
        $info = DB::fetch_first("SELECT * FROM ".DB::table('plugin_ipbanspider_spiders')." WHERE sid = $id");
        DB::delete('plugin_ipbanspider_spiders' ,array('sid'=>$id));
        $newredis->zRem(spider_getkey($info['friend']) ,$info['sname']);
    }
}
function spider_clear(){
    global $newredis;
    $newredis->delete(spider_getkey(0) ,0);
    $newredis->delete(spider_getkey(1) ,0);
}
function get_ipbanspider_white($v , $arg=''){
    global $pre,$newredis;
    switch($v){
        case 'count':
            $u = $newredis->ZCARD($pre.'whitelist');
            $r = intval($u - $arg);
            $url = "admin.php?action=plugins&operation=config&identifier=ipbanspider&pmod=whitelist&page=1";
            $return = $r > 0 ? '<p onclick="find_new();">��ǰ��<b>'.$r.'</b>������</p>' : '<span></span>';
            break;
        case 'list':
            list($ip ,$y ,$m) = explode('|',$arg);
            $url = "admin.php?action=plugins&operation=config&identifier=ipbanspider&pmod=$y&page=1";
            if($m == 'safe'){
                safe($ip);
                $return = '<p onclick="find_new();"><b class="blue">'.$ip.'</b><b class="green">�������������</b>��ɿ��Ե������</p>';
            }elseif($m == 'unsafe'){
                unsafe($ip);
                $return = '<p onclick="find_new();"><b class="blue">'.$ip.'</b><b class="red">�Ƴ�����������</b>��ɿ��Ե������</p>';
            }else{
                $return = '<span></span>';
            }
            break;
        default :
            $return = '<span></span>';
            break;
    }
    return $return;
}
function get_ipbanspider_linshiwhite($v , $arg=''){
    global $pre,$newredis;
    switch($v){
        case 'list':
            list($ip ,$y ,$m, $iflogon) = explode('|',$arg);
            $url = "admin.php?action=plugins&operation=config&identifier=ipbanspider&pmod=$y&page=1";
            if($m == 'unsafe'){
                linshiunsafe($ip, $iflogon == 1);
                $return = '<p onclick="find_new();"><b class="blue">'.$ip.'</b><b class="red">�Ƴ���ʱ����������</b>��ɿ��Ե������</p>';
            }else{
                $return = '<span></span>';
            }
            break;
        default :
            $return = '<span></span>';
            break;
    }
    return $return;
}
function get_ipbanspider_userwhite($v , $arg=''){
    global $pre,$newredis;
    switch($v){
        case 'list':
            list($userid ,$y ,$m, $username) = explode('|',$arg);
            $url = "admin.php?action=plugins&operation=config&identifier=ipbanspider&pmod=$y&page=1";
            if($m == 'unsafe'){
                userunsafe($userid);
                $return = '<p onclick="find_new();"><b class="blue">'.($username ? $username : "uid:{$userid}").'</b><b class="red">�Ƴ���ʱ����������</b>��ɿ��Ե������</p>';
            }else{
                $return = '<span></span>';
            }
            break;
        default :
            $return = '<span></span>';
            break;
    }
    return $return;
}
function agentcolor(){
    global $newredis;
    foreach($newredis->zRevRange(spider_getkey(1) ,0 ,-1) as $fsp){
        $return[$fsp] = '<b class="green">'.$fsp.'</b>';
        $sor[] = $fsp;
    }
    foreach($newredis->zRevRange(spider_getkey(0) ,0 ,-1) as $dsp){
        $return[$dsp] = '<b class="red">'.$dsp.'</b>';
        $sor[] = $dsp;
    }
    return empty($sor) ? array() : array('sor'=>$sor ,'replace'=>$return);
}
function get_ipbanspider_select($v ,$arg=''){
    global $pre,$newredis;
    switch($v){
        case 'find':
            $allv = $newredis->zRevRange($pre.'COMMON_IP_'.$arg.'_zset' ,0 ,-1 ,true);
            require libfile('function/admincp');
            include template('common/header_ajax');
            echo '<h3>��ϸ������Ϣ<span onclick="document.getElementById(\'message\').style.display=\'none\'">�ر�</span></h3><div id="content"><div id="list">';
            showtableheader();
            showsubtitle(array('IP' ,'�û�' ,'AGENT' , 'ʱ��' ,'URL'));
            $alluser = array();
            foreach($allv as $k => $v){
                $info = unserialize($k);
                $rows .= "<tr><td>{$arg}</td><td>{$info[user]}</td><td>{$info[agent]}</td><td>".date('Y-m-d H:i:s' ,$v)."</td><td>{$info[url]}</td></tr>";
                $user = empty($info['user']) ? 'δ��½�û�' : $info['user'] ;
                $alluser[$user]++;
                $allurl[$info['url']]++;
            }
            $arr = agentcolor();
            $echo = empty($arr) ? $rows : str_ireplace($arr['sor'] ,$arr['replace'] ,$rows);
            echo empty($echo) ? '��ʱ��ǰIP��Ϣ' : $echo;
            showtablefooter();
            echo '</div>';
            if(!empty($alluser)){
                arsort($alluser);
                echo '<div id="user"><h3>����<b class="blue">'.count($alluser).'</b>���û�<span onclick="document.getElementById(\'message\').style.display=\'none\'">�ر�</span></h3><ul>';
                foreach($alluser as $u => $n){
                    echo '<li><span><b class="blue">'.$u.'</b><b class="red">'.$n.'</b></span></li>';
                }
                echo '</ul><span style="clear:both;"></span></div>';
                echo '<div id="allurl"><h3>����<b class="blue">'.count($allurl).'</b>��URL����</h3><ul>';
                arsort($allurl);
                foreach($allurl as $ur => $un){
                    echo '<li><span><b class="blue">'.$ur.'</b><b class="red">'.$un.'</b></span></li>';
                }
                echo '</ul></div>';
            }
            echo '</div>';
            include template('common/footer_ajax');
            exit;
        default :
            $return = 'δ֪����';break;
    }
    return $return;
}

function ban($ip){
    global $pre,$newredis,$_G;
    $microtime = time();
    if($newredis->sIsMember($pre.'whitelist' ,$ip)) unsafe($ip);
    $time = ($_G['cache']['plugin']['ipbanspider']['defaultban'] ? $_G['cache']['plugin']['ipbanspider']['defaultban'] : 3)*24*3600 + $microtime;
    $newredis->ZADD($pre.'blacklist' , $microtime, $ip);
    $newredis->hashset($pre.'unbantime' , $ip ,$time);
    $newredis->ZADD($pre.'history_ban_'.$ip , $microtime, '[<b class="blue">'.date('Y-m-d H:i:s' ,$microtime).'</b>]�û�IP[<b class="blue">'.$ip.'</b>]������Ա[<b class="green">'.$_G['username'].'</b>]��̨<b class="red">���</b>');
}
function safe($ip){
    global $pre,$newredis,$_G;
    $microtime = time();
    if($newredis->zScore($pre.'blacklist' ,$ip)!==false) unban($ip);
    $newredis->sAdd($pre.'whitelist' ,$ip);
    $newredis->ZADD($pre.'history_safe_'.$ip , $microtime, '[<b class="blue">'.date('Y-m-d H:i:s' ,$microtime).'</b>]�û�IP[<b class="blue">'.$ip.'</b>]������Ա[<b class="green">'.$_G['username'].'</b>]��̨<b class="green">���������</b>');
}
function unsafe($ip){
    global $pre,$newredis,$_G;
    $microtime = time();
    $newredis->sRem($pre.'whitelist' ,$ip);
    $newredis->ZADD($pre.'history_unsafe_'.$ip , $microtime, '[<b class="blue">'.date('Y-m-d H:i:s' ,$microtime).'</b>]�û�IP[<b class="blue">'.$ip.'</b>]������Ա[<b class="green">'.$_G['username'].'</b>]��̨<b class="red">�Ƴ�������</b>');
}
function unban($ip){
    global $pre,$newredis,$_G;
    $microtime = time();
    $newredis->delete($pre.'COMMON_IP_'.$ip.'_zset' ,0);
    $newredis->zRem($pre.'blacklist' ,$ip);
    $newredis->hashdel($pre.'unbantime' ,$ip);
    $res = '[<b class="blue">'.date('Y-m-d H:i:s' ,$microtime).'</b>]��������IP��[<b class="red">'.$ip.'</b>]������Ա[<b class="blue">'.$_G['username'].'</b>]��̨<b class="green">���</b>';
    $newredis->ZADD($pre.'history_unban_'.$ip ,$microtime ,$res);
}
function linshiunsafe($ip, $logon = false){
	global $pre,$newredis,$_G;
	$microtime = time();
	$newredis->EXPIRE($pre.'whitelist_linshi_' . ($logon ? '' : 'no') . 'logon_' . str_replace('.', '_', $ip), 0);
	$newredis->ZADD($pre.'history_unsafe_'.$ip , $microtime, '[<b class="blue">'.date('Y-m-d H:i:s' ,$microtime).'</b>]�û�IP[<b class="blue">'.$ip.'</b>]������Ա[<b class="green">'.$_G['username'].'</b>]��̨<b class="red">�Ƴ���ʱ������</b>');
}
function userunsafe($userid){
	global $pre, $newredis, $_G;
	$newredis->sRem($pre.'whitelist_by_uid', $userid);
}
?>
