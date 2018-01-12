<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 用于新的邀请信息的管理
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$op = empty($_GET['op'])?'':trim($_GET['op']);
$_G['gp_inajax'] ? include template('common/header') : template('common/header_ajax');
require_once libfile('class/myredis');
$redis = & myredis::instance(6378);
if($op == 'delete'){
    $mid = intval($_G['gp_mid']);
    deletenewinvite($mid);
    if($_G['member']['newinvite'] > 0){
    	$redis->zIncrBy("common_member_invite_users_list", -1, 'uid_' . $_G['uid']);
    }else{
    	$redis->zRem("common_member_invite_users_list", 'uid_' . $_G['uid']);
    }
    exit('deleted');
}elseif($op == 'deleteall'){
    $mids = array();
    $query = DB::query('SELECT ir.mid FROM '.DB::table('plugin_invite_relation').' ir WHERE ir.status = 1 AND ir.tousers LIKE \'%('.$_G['uid'].')%\'' . ' ' . getSlaveID());
    while($v = DB::fetch($query)){
        $reads_mid = memory('get' , 'plugin_invite_cache_mid_reads_'.$v['mid']);
        if(!$reads_mid){
            $midread = DB::result_first("SELECT readuid FROM ".DB::table('plugin_invite_readed')." WHERE mid = {$v[mid]}");
            $reads_mid = explode(',' ,$midread);
            memory('set' , 'plugin_invite_cache_mid_reads_'.$v['mid'] , $reads_mid , 3600);
        }
        if(in_array($_G['uid'] , $reads_mid)) continue;
        deletenewinvite($v['mid']);
    }
    $redis->zRem("common_member_invite_users_list", 'uid_' . $_G['uid']);
    dsetcookie('invite_user_' . $_G['uid'], '');
    echo <<<EOF
<p style="margin:5px 10px;">全部删除成功，2秒后关闭窗口。</p>
<script>
function closstips(){
    $('fwin_deleteallinvite').style.display='none';
}
$('all_invite').style.display='none';
$('newinvitecount').innerHTML = 0;
$('sidenewinvitecount')&&($('sidenewinvitecount').innerHTML = 0);
setTimeout(closstips ,2000);
</script>
EOF;
}else{
    showmessage('postperm_none_nopermission', NULL);
}
$_G['gp_inajax'] ? include template('common/footer') : template('common/footer_ajax');
?>