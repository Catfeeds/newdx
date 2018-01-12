<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home_task.php 16614 2010-09-10 06:26:06Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//�˴�redis���룬��¼�û�����״̬
require_once libfile('class/myredis');
$myredis = & myredis::instance(6381);
if($_GET['is_qr_']){
	//΢�Ź�ע����APP���ں�
	if($_GET['is_qr_']=='getIsfollow'){
		$res = requestRemoteData("http://front.zaiwai.com/index.php?c=follow&m=getIsfollow&taskid=".$_GET['taskid'].'&zhuzhan_user='.$_G['uid']);
		if($res){
			echo $res;
		}else{
			echo -1;
		}
		exit;
	}
    //$tiezi_data = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=setWeiChatTask&8264uid=".$_G['uid'].'&8264task='.$_GET['taskid'].'&is8264=1');
    $res_data = requestRemoteData("http://www.zaiwai.com/index.php?app=goods&act=check_sharr_zhuzhan&taskid=".$_GET['taskid'].'&zhuzhan_user='.$_G['uid']);

    $res = json_decode($res_data,true);
    if($myredis->connected){
        if($res && $res['is_appshare'] == 0){
            //΢�ŷ����¼д�뻺�棬�������ж��û������Ƿ�����������
            //�����ʱ�������
            //$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
            $expire = $endToday - time();
            $myredis->obj->SETEX('weixin_0_t_u_'.$_G['uid'], $expire,"1"); //bool(true);
        }elseif($res && $res['is_appshare'] == 2){
            //APPС¿������ȡ����¼�������¼д�뻺�棬�������ж��û������Ƿ�����������
            //�����ʱ�������
            //$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
            $expire = $endToday - time();
            $myredis->obj->SETEX('weixin_2_t_u_'.$_G['uid'], $expire,"1"); //bool(true);
        }elseif($res && $res['is_appshare'] == 20){
            //APPС¿������ȡ����¼�������¼д�뻺�棬�������ж��û������Ƿ�����������
            //�����ʱ�������
            //$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
            $expire = $endToday - time();
            $myredis->obj->SETEX('weixin_20_t_u_'.$_G['uid'], $expire,"1"); //bool(true);
        }elseif($res && $res['is_appshare'] == 25){
            //APPС¿������ȡ����¼�������¼д�뻺�棬�������ж��û������Ƿ�����������
            //�����ʱ�������
            //$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
            $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
            $expire = $endToday - time();
            $myredis->obj->SETEX('weixin_25_t_u_'.$_G['uid'], $expire,"1"); //bool(true);
        }
    }
    if($res){
        echo 1;exit;
    }
}
if($_GET['is_tiezi']){
    $isshare_tiezi_res = DB::result_first("SELECT * FROM ".DB::table('common_share_task_tiezi')." WHERE uid={$_G['uid']} and taskid = '{$_GET['taskid']}' " . getSlaveID());
    if($isshare_tiezi_res){
        echo 1;exit;
    }else{
        echo -1;exit;
    }
}
//΢����������¼��⣬һ��һ���û����ܷ���һ��
$flag_share = $myredis->obj->GET('weixin_0_t_u_'.$_G['uid']);

if($flag_share == 1){
    //�����Ѿ��������
    $is_share = 1;
}else{
   $is_share = 0;
}

//APPС¿������ȡ����¼�������¼��⣬һ��һ���û����ܷ���һ��
$flag_share_appshare = $myredis->obj->GET('weixin_2_t_u_'.$_G['uid']);
if($flag_share_appshare == 1){
    //�����Ѿ��������
    $is_share_appshare = 1;
}else{
    $is_share_appshare = 0;
}

//΢����������ߣ�һ��һ���û����ܷ���һ��
$flag_share_changxian = $myredis->obj->GET('weixin_20_t_u_'.$_G['uid']);
if($flag_share_changxian == 1){
    //�����Ѿ��������
    $is_share_changxian = 1;
}else{
    $is_share_changxian = 0;
}
//΢������������ӣ�һ��һ���û����ܷ���һ��
$isshare_tiezi = DB::result_first("SELECT * FROM ".DB::table('common_share_task_tiezi')." WHERE uid={$_G['uid']} and taskid = '{$_GET['taskid']}' " . getSlaveID());
//$flag_share_tiezi = $myredis->obj->GET('weixin_25_t_u_'.$_G['uid']);
if($isshare_tiezi){
    //�����Ѿ��������
    $is_share_tiezi = 1;
}else{
    $is_share_tiezi = 0;
}

if($_GET['is_qr_display'] == 1){
    //��ȡ΢�ŷ�������
    $query = DB::query("SELECT t.taskid FROM pre_common_task t
			LEFT JOIN pre_common_mytask  mt ON mt.taskid=t.taskid AND mt.uid='$_G[uid]'
			WHERE (mt.taskid IS NULL OR (ABS(mt.status)='1' AND t.period>0)) AND t.available='2' AND t.scriptname = 'weixin' ORDER BY t.displayorder, t.taskid DESC LIMIT 1");
    while($task = DB::fetch($query)){
        $res_qr[] = $task;
    }
    if($res_qr){
        echo json_encode($res_qr[0]);
    }else{
        echo 0;
    }
    exit;
}
require_once libfile('function/spacecp');
if(!$_G['setting']['taskon'] && $_G['adminid']  != 1) {
	showmessage('task_close');
}

require_once libfile('class/task');
$tasklib = & task::instance();

$id = intval($_G['gp_id']);
$do = empty($_GET['do']) ? '' : $_GET['do'];



// ȥ������չʾ��δ��½�û��Ŀ��� 2014.07.14 by qiudongfang
//if(empty($_G['uid'])) {
//	showmessage('to_login', null, array(), array('showmsg' => true, 'login' => 1));
//}

$navtitle = lang('core', 'title_task');

if(empty($do)) {
    $_G['gp_item'] = empty($_G['gp_item']) ? 'new' : $_G['gp_item'];
    $actives = array($_G['gp_item'] => ' class="a"');
    $tasklist = $tasklib->tasklist($_G['gp_item']);
    $tasklist_weixin  = array();
    $tasklist_changxian  = array();
    $tasklist_appshare = array();
    $tasklist_appfollow  = array();
    $tasklist_tiezi  = array();
    foreach($tasklist as $key => $val){
        /*if($_G['groupid']!=1 && $val['scriptname'] == 'changxian'){
            unset($tasklist[$key]);continue;
        }*/
        if($val['scriptname'] == 'weixin'){
            $tasklist_weixin[] = $val;
            unset($tasklist[$key]);
        }
        if($val['scriptname'] == 'changxian'){
            $tasklist_changxian[] = $val;
            unset($tasklist[$key]);
        }
        if($val['scriptname'] == 'tiezi'){
            $tasklist_tiezi[] = $val;
            unset($tasklist[$key]);
        }
        if($val['scriptname'] == 'appshare'){
            $tasklist_appshare[] = $val;
            unset($tasklist[$key]);
        }
        if($val['scriptname'] == 'appfollow'){
            $tasklist_appfollow[] = $val;
            unset($tasklist[$key]);
        }

    }
    //��¼�����б�ҳ�����
    DB::query("INSERT LOW_PRIORITY ".DB::table('task_views') ."(dateline,uid,ip,username) values (".time().",".$_G['uid'].", '".$_SERVER['SERVER_ADDR']."',"."'".$_G['username']."')");
    $re = DB::query("SELECT * FROM ".DB::table('common_mytask')." m  left join ".DB::table("common_task")." t on m.taskid = t.taskid where (t.scriptname = 'weixin' or t.scriptname = 'changxian') and  uid='$_G[uid]' AND status='0'" );
    while ($v = DB::fetch($re)){
        $res[] = $v;
    }

    if($res){
        $is_doing = true;//�����ڽ��е�����
    }

    if($tasklist_weixin){
       foreach($tasklist_weixin as $key => $val){
           if($key > 0){
               unset($tasklist_weixin[$key]);
           }
       }
    }

    if($tasklist_changxian){
        foreach($tasklist_changxian as $key => $val){
            if($key > 0){
                unset($tasklist_changxian[$key]);
            }
        }
    }
    if($tasklist_tiezi){
        foreach($tasklist_tiezi as $key => $val){
            if($key > 0){
                unset($tasklist_tiezi[$key]);
            }
        }
    }
	
	if($tasklist_appfollow){
        foreach($tasklist_appfollow as $key => $val){
            if($key > 0){
                unset($tasklist_appfollow[$key]);
            }
        }
    }

    $tasklist  =  array_merge_recursive($tasklist_appfollow,$tasklist_appshare,$tasklist_weixin,$tasklist_changxian,$tasklist_tiezi,$tasklist);

	$listdata = $tasklib->listdata;
	if($_G['gp_item'] == 'doing' && empty($tasklist)) {
		dsetcookie('taskdoing_'.$_G['uid']);
	}


} elseif($do == 'view' && $id) {

    $re = DB::fetch_first("SELECT scriptname FROM ".DB::table("common_task")." where taskid = $id" );
	cleartaskstatus();
	$allowapply = $tasklib->view($id);
	$task = & $tasklib->task;//echo  '<pre>';print_r($task);exit;
	$navtitle = $task['name'].' - '.$navtitle;
	$taskvars = & $tasklib->taskvars;
    if($re['scriptname']=='appshare'){
        $redirect_uri = urlencode("http://front.qunawan.com/huodong-share?from=8264bbs&is_appshare=2&iszhuzhan=1&taskid=".$id."&key=".time()."&zhuzhan_user=".$_G['uid']."&subject=".urlencode($taskvars['complete']['subject']['value']));

        //&subject=".$taskvars['complete']['subject']['value'].'&iszhuzhan=1&taskid='.$id.'&zhuzhan_user='.$_G['uid'].'&key='.time()
        //$qr_url = 'http://m.zaiwai.com/xianlu-213?is_appshare=1&subject='.$taskvars['complete']['subject']['value'].'&iszhuzhan=1&taskid='.$id.'&zhuzhan_user='.$_G['uid'].'&key='.time().'&is_appshare=1';
        //$qr_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6bd2e50596006318&redirect_uri=http%3A%2F%2Ffront.zaiwai.com%2Fhuodong-share%3Ffrom%3D8264bbs&response_type=code&scope=snsapi_base&state=8264bbs#wechat_redirect';
        $qr_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6bd2e50596006318&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=8264bbs#wechat_redirect";

    }elseif($re['scriptname']=='weixin'){
        $qr_url = $taskvars['complete']['url']['value'].'?subject='.$taskvars['complete']['subject']['value'].'&iszhuzhan=1&taskid='.$id.'&zhuzhan_user='.$_G['uid'].'&key='.time();
    }elseif($re['scriptname']=='changxian'){
        $qr_url = $taskvars['complete']['url']['value'].'?subject='.$taskvars['complete']['subject']['value'].'&iszhuzhan=1&taskid='.$id.'&zhuzhan_user='.$_G['uid'].'&is_appshare=20';//is_appshare=20 ������������

    }elseif($re['scriptname']=='tiezi'){
        $qr_url = $taskvars['complete']['url']['value'].'?iszhuzhan=1&taskid='.$id.'&zhuzhanuser='.$_G['uid'];//is_appshare=25 ������������
    }elseif($re['scriptname']=='appfollow'){
        $qr_url = requestRemoteData('http://front.zaiwai.com/index.php?c=follow&m=getQRcode&uid='.$_G['uid'].'&key='.time());
    }else{
        $qr_url = '';
    }
    

} elseif($do == 'apply' && $id) {

	if(!$_G['uid']) {
		showmessage('not_loggedin', NULL, array(), array('login' => 1));
	}

	$result = $tasklib->apply($id);
    if($_GET['is_qr']){
      echo $result;
      exit;
    }
	if($result === -1) {
		showmessage('task_relatedtask', 'home.php?mod=task&do=view&id='.$tasklib->task['relatedtaskid']);
	} elseif($result === -2) {
		showmessage('task_grouplimit', 'home.php?mod=task&item=new');
	} elseif($result === -3) {
		showmessage('task_duplicate', 'home.php?mod=task&item=new');
	} elseif($result === -4) {
		showmessage('task_nextperiod', 'home.php?mod=task&item=new');
	} else {
		dsetcookie('taskdoing_'.$_G['uid'], 1, 7776000);
		showmessage('task_applied', 'home.php?mod=task&do=view&id='.$id);
	}

} elseif($do == 'draw' && $id) {

	if(!$_G['uid']) {
		showmessage('not_loggedin', NULL, array(), array('login' => 1));
	}

	$result = $tasklib->draw($id);
	if($result === -1) {
		showmessage('task_up_to_limit', 'home.php?mod=task', array('tasklimits' => $tasklib->task['tasklimits']));
	} elseif($result === -2) {
		showmessage('task_failed', 'home.php?mod=task&item=failed');
	} elseif($result === -3) {
		showmessage($tasklib->messagevalues['msg'], 'home.php?mod=task&do=view&id='.$id, $tasklib->messagevalues['values']);
	} else {
		cleartaskstatus();
		showmessage('task_completed', 'home.php?mod=task&item=done');
	}

} elseif($do == 'giveup' && $id) {

	$tasklib->giveup($id);
	showmessage('task_giveup', 'home.php?mod=task&item=view&id='.$id);

} elseif($do == 'parter' && $id) {

	$parterlist = $tasklib->parter($id);
	include template('home/space_task_parter');
	dexit();

} else {

	showmessage('undefined_action', NULL);

}

// lxp 20140327
if($_G['newtpl']){
	$_G['uid'] && $space = getspace($_G['uid']);
	// �����б�
	/*$invite_thread = memory('get' , 'plugin_invite_cache_uid_'.$_G['uid']);
	if(!$invite_thread){
		$invite_thread = array();
		$query = DB::query('SELECT im.* FROM '.DB::table('plugin_invite_relation').' ir
			LEFT JOIN '.DB::table('plugin_invite_message').' im ON ir.mid = im.mid
			WHERE ir.status = 1 AND ir.tousers LIKE \'%('.$_G['uid'].')%\' ORDER BY ir.dateline DESC');
		while($v = DB::fetch($query)){
			$reads_mid = memory('get' , 'plugin_invite_cache_mid_reads_'.$v['mid']);
			if(!$reads_mid){
				$midread = DB::result_first("SELECT readuid FROM ".DB::table('plugin_invite_readed')." WHERE mid = {$v[mid]}");
				$reads_mid = explode(',' ,$midread);
				memory('set' , 'plugin_invite_cache_mid_reads_'.$v['mid'] , $reads_mid , 3600);
			}
			if(in_array($_G['uid'] , $reads_mid)) continue;
			$invite_thread['invite_'.$v['mid']] = $v;
		}
		memory('set' , 'plugin_invite_cache_uid_'.$_G['uid'] , $invite_thread , 60);
	}
	$invite_thread_count = count($invite_thread);*/
	$invite_thread_count = $_G['member']['newinvite'];
	// ����Ϣ����
// 	loaducenter();
// 	$newpm = uc_pm_list($_G['uid']);
	// ��������
	/*$sql = "SELECT COUNT(*) AS count FROM ".DB::table('common_task')." t
		LEFT JOIN ".DB::table('common_mytask')." mt ON mt.taskid=t.taskid AND mt.uid='$_G[uid]'
		WHERE (mt.taskid IS NULL OR (ABS(mt.status)='1' AND t.period>0)) AND t.available='2' ORDER BY t.displayorder, t.taskid DESC";
	$taskcount = DB::result_first($sql);*/
	require_once libfile('class/task');
	$tasklib = & task::instance();
	$newtasklist = $tasklib->tasklist('new');
    $is_one = 0;
    //���¼��������񣬽�΢�ź�������������Ϊ1

    foreach($newtasklist as $k => $v){
        if(($v['scriptname'] == 'weixin' || $v['scriptname'] == 'changxian' || $v['scriptname'] == 'tiezi') && $is_doing){
            unset($newtasklist[$k]);
        }elseif(($v['scriptname'] == 'weixin' || $v['scriptname'] == 'changxian' || $v['scriptname'] == 'tiezi') && !$is_doing){
            $is_one = 1;
            unset($newtasklist[$k]);
        }
    }
    $taskcount = count($newtasklist);
    if($is_one == 1){
        $taskcount = $taskcount + 1;
    }
	member_status_view_update($taskcount);
}

include template('home/space_task');

function cleartaskstatus() {
	global $_G;
	if(!DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_mytask')." WHERE uid='$_G[uid]' AND status='0'")) {
		dsetcookie('taskdoing_'.$_G['uid']);
	}
}



?>
