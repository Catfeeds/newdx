<?php

/**
 * @author LiShuaiquan
 * @copyright 2015-08-20
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}


/**
 * 更新下某个活动的总报名人数和已通过报名人数
 * @author Gtl 20161021 20161028y
 * @global array $_G
 * @param int $tid
 * @return mixed
 */
function setPassnumAndApplynum($tid) {
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$data = array('applynumber'=>0, 'passnumber'=>0);
	$params = array(
		'app' => 'order',
		'act' => 'bbs_set_passnum_and_applynum',
		'appname' => $appname,
		'qt' => time(),
		'tid' => $tid
	);
	//请求
	$url = global_build_url($params, $appsecret);
	$httpResult = requestRemoteData($url);
	$result = json_decode($httpResult, true);
	if(!empty($result['result'])){
		$data['applynumber'] = $result['result']['applynumber'];
		$data['passnumber']  = $result['result']['passnumber'];
		DB::update('forum_activity', $data, "tid={$tid}");
	}
	
	//统计活动俱乐部活动数/出行人次
	$clubid = DB::result_first("SELECT clubid FROM ".DB::table('forum_activity')." WHERE tid={$tid} ");
	setClubStat($clubid);

	return $data;
}

//更新下某个活动的总报名人数和已通过报名人数
function setPassnumAndApplynumOld($tid) {
	$applynumber = 0;
	$passnumber  = 0;
	$sql = "SELECT tid, uid, verified, ufielddata FROM ".DB::table('forum_activityapply')." WHERE tid={$tid} ";

	$query = DB::query($sql);
	while($v = DB::fetch($query)) {
		$v['ufielddata'] = unserialize($v['ufielddata']);
		$nofilds = $v['ufielddata']['userfield']['field3'];
		$nofilds = !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
		if($v['verified'] == 1) {
			$passnumber += $nofilds;
		}
		$applynumber += $nofilds;
	}
	$data = array('applynumber'=>$applynumber, 'passnumber'=>$passnumber);

	//统计活动俱乐部活动数/出行人次
	$clubid = DB::result_first("SELECT clubid FROM ".DB::table('forum_activity')." WHERE tid={$tid} ");
	setClubStat($activity['clubid']);

	DB::update('forum_activity', $data, "tid={$tid}");
	return $data;
}

//设置俱乐部列表
function setClubList($clubname = '', $clubid = '') {

	if (empty($clubname)) {
		return '0';
	}

	$activity = array();
	$clubid   = intval($clubid);

   	$clubOldShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity_club')." WHERE clubname='{$clubname}' " . getSlaveID());

   	if ($clubOldShow['clubname'] == $clubname) {
   		$activity['clubid']   = $clubOldShow['clubid'];
   		$activity['clubname'] = $clubOldShow['clubname'];
   	} else {
   		if ($clubid) {
   			DB::update('forum_activity_club', array('clubname'=>$clubname), "clubid={$clubid}");
   			DB::update('forum_activity', array('clubname'=>$clubname), "clubid={$clubid}");
   			$activity['clubid'] = $clubid;
   		} else {
   			$activity['clubid']   = DB::insert('forum_activity_club', array('clubname'=>$clubname), true);
   		}
   		$activity['clubname'] = $clubname;
   	}

   	require_once libfile('class/myredis');
	$myredis = myredis::instance(6381);
	$myredis->obj->sAdd("activityClubList", $clubname);
	$myredis->obj->expire('activityClubList', 86400*30);

	//统计活动俱乐部活动数/出行人次
	setClubStat($activity['clubid']);
	if ($clubid != $activity['clubid']) {
		setClubStat($clubid);
	}

   	return $activity['clubid'];
}

//获得俱乐部列表
function getClubList() {
	require_once libfile('class/myredis');
	$myredis = myredis::instance(6381);

	$activityClubList = $myredis->obj->sMembers("activityClubList");
	if (!$activityClubList) {
		$activityClubList = array();
		$sql = "SELECT *FROM ".DB::table('forum_activity_club') . getSlaveID();
		$query = DB::query($sql);
		while($v = DB::fetch($query)) {
			$activityClubList[] = $v['clubname'];
			$myredis->obj->sAdd("activityClubList", $v['clubname']);
		}
		$myredis->obj->expire('activityClubList', 86400*30);
	}

	return $activityClubList;
}

//获得活动人数列表
function getActivityNumberList() {
	$activityNumberList = array();
	for ($i=1;$i<100;$i++) {
		$activityNumberList[] = $i;
	}
	return $activityNumberList;
}

//更新在外app目的地库
function setZaiwaiPlace($arrPlace) {
	/*global $_G;

	$arrPlace = array_filter($arrPlace);

	try {
		if ($arrPlace) {
			$arrPlace = iconv_array($arrPlace);
			foreach ($arrPlace as $v) {
				requestRemoteData("{$_G['config']['zaiwaiapi']['url']}terminiService/addTermini?termini={$v}&sToken={$_G['config']['zaiwaiapi']['token']}");
			}
		}
	} catch(Exception $e) {}*/
}

//根据关键字获得在外app目的地列表
function getZaiwaiPlaceList($keyword, $pageSize = 10) {
	global $_G;

	$data = array();
	try {
		if ($keyword) {
			//约伴的目的地库			
			/*$data    = requestRemoteData("{$_G['config']['zaiwaiapi']['url']}terminiService/searchTermini?keyWord={$keyword}&page=1&pageSize={$pageSize}&sToken={$_G['config']['zaiwaiapi']['token']}");
			$data    = json_decode($data, true);
			$data 	 = !empty($data['terminiList']) ? $data['terminiList'] : array();

			$_G['config']['zaiwaiapi']['url'] = 'http://zaiwai.qunawan.com/';	
			$keyword = iconv("gbk","utf-8",$keyword);*/

			//蚂蜂窝的地址库
			$_data = requestRemoteData("{$_G['config']['zaiwaiapi']['url']}hierarchicalTerminiService/searchTerminiListByKeyWord?keyWord={$keyword}&pageSize={$pageSize}&sToken={$_G['config']['zaiwaiapi']['token']}");	
			$_data = json_decode($_data, true);
			$_data = !empty($_data['customerHierarchicalTerminiList']) ? $_data['customerHierarchicalTerminiList'] : array();
			foreach ($_data as $k=>$v) {
				if (empty($v['poiInfo']['name']) && empty($v['areaInfo']['name'])) {continue;}
				$data[$k]  = !empty($v['poiInfo']['name']) ? $v['poiInfo']['name'] : $v['areaInfo']['name'];
				$data[$k] .= !empty($v['cityInfo']['name']) ? " - {$v['cityInfo']['name']}" : '';
			}
		}
	} catch(Exception $e) {}

	return $data;
}

//统计活动俱乐部活动数/出行人次
function setClubStat($clubid) {
	if(!intval($clubid)) return false;

	$club = DB::fetch_first("SELECT count(*) AS actnum, sum(passnumber) AS usernum FROM ".DB::table("forum_activity")." WHERE clubid='$clubid' " .getSlaveID());
	if($club) {
		DB::query("UPDATE ".DB::table("forum_activity_club")." SET actnum='$club[actnum]', usernum='$club[usernum]' WHERE clubid='$clubid'");
	}

	return $club;
}

//统计地方版版块下有效的活动数量，传入的fid请保证是地方版
function setCityNum($fid) {
	if(!intval($fid)) return false;

	$timestamp = TIMESTAMP;

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	$citynumbers_cache = $redis->get("act_api_citynumbers");
	$cityNumbers = unserialize($citynumbers_cache);	//数据格式 版块fid=>活动数量

	$num = DB::result_first("SELECT count(*) FROM ".DB::table("forum_activity")." AS a LEFT JOIN ".DB::table("forum_thread")." AS t ON a.tid=t.tid WHERE t.fid = '$fid' AND t.tid > 5161751 AND t.displayorder >= 0 AND t.special = 4 AND a.timediff < 4 AND a.credit = 0 AND a.starttimefrom > '$timestamp' ");
	$cityNumbers[$fid] = $num;

	$redis->set("act_api_citynumbers", serialize($cityNumbers));

	return $cityNumbers;
}

//计算当前活动热度
function setActHot($tid) {
	if(!intval($tid)) return false;

	$timestamp = TIMESTAMP;

	$views = 0;
	$views = DB::result_first("SELECT views FROM ".DB::table("forum_thread")." WHERE tid='$tid' " .getSlaveID());

	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);

	if($redis->connected){
		$views += $redis->hashget("viewthread_number",$tid);
	}
	$hot = round($views/100);

	DB::query("UPDATE ".DB::table("forum_activity")." SET hottest=passnumber+{$hot}, lasttime={$timestamp} WHERE tid={$tid}");
}

//检查用户是否绑定了在外帐号
function checkUserBind($uid) {
	if(!intval($uid)) return false;

	$bind_info = array();
	$bind_info = DB::fetch_first("SELECT uid, username, appuid FROM ".DB::table("common_openid")." WHERE uid='$uid' " .getSlaveID());

	return $bind_info;
}

//过滤特殊字符，最多8个字
function dealActivityText($str, $iscut = true) {
	$arrFind = array('\\','&lt;', '&gt;', '（', '）', '+', '、', '-', '(', ')', '“', '”', '：', '.', '&amp;', '《', '【');//；会使逍遥户外变为逍咬外,》会使小分变为兄,】会使健康变为降
	foreach ($arrFind as $v) {
		$str = str_replace($v, '', $str);	
	}
	
//	$str = preg_replace('/[~|`|!|@|#|$|%|^|&|*|\(|\)|_|\-|——|+|=|\{|\[|\}|\]|\||\\|:|;|<|,|>|\.|\?|\/|·|！|￥|……|（|）|【|】|：|；|”|“|‘|’|《|，|》|。|？|、| |　]+/', '', $str);//'"！还有问题,用“绿海户外”测试
//	$str = preg_replace('/[~|`|!|@|#|$|%|^|&|*|\(|\)|_|\-|——|\+|=|\{|\}\||:|;|,|【|】|”|“|‘|’|《|》| |　]+/', '', $str);	
	if ($iscut) {
		$str = mb_substr($str, 0, 8, 'gbk');
	}	
	return $str;
}

//重置活动标题
function resetActivitySubject($activity) {
	$subject  = $activity['clubname'] ? $activity['clubname'] . " " : '';
	$subject .= $activity['starttimefrom_int'] == $activity['starttimeto_int'] ? date("m月d日", $activity['starttimefrom_int']) . " " : date("m月d日", $activity['starttimefrom_int']).'-'.date("m月d日", $activity['starttimeto_int']).' ';
	$subject .= str_replace('，', '-', $activity['place'])." {$activity['class']}{$activity['timediff']}日";	
	return $subject;
}

//http://127.0.0.1//pushActivitieMsgForTianJin?userId=369270778867616&sToken=76879844270 
//向app推送活动消息：12:新的活动报名消息13:新的活动审核消息
function pushActivityMsg($type, $uid, $appuid) {
	global $_G;

	try {
		$appuid = number_format($appuid, 0, ".", '');
		if (empty($appuid)) {
			$bind_info = checkUserBind($uid);
			$appuid    = number_format($bind_info['appuid'], 0, ".", '');
		}		
		if ($appuid) {
			$url = "{$_G['config']['zaiwaiapi']['url']}pushService/pushActivitieMsgForTianJin?userId={$appuid}&type={$type}&sToken={$_G['config']['zaiwaiapi']['token']}";
			requestRemoteData($url);
		}		
		
	} catch(Exception $e) {}
}

//向app清除活动消息：12:新的活动报名消息13:新的活动审核消息
function cleanActivityMsg($type, $appuid) {
	global $_G;

	try {		
		if ($appuid) {
			requestRemoteData("{$_G['config']['zaiwaiapi']['url']}pushService/cleanActivitieMsgForTianJin?userId={$appuid}&type={$type}&sToken={$_G['config']['zaiwaiapi']['token']}");
		}
		
	} catch(Exception $e) {}
}

//向活动发布者(绑定微信)发送新报名通知
function sendNewActivityMsgForWechat($uid, $tid, $title, $realname, $mobile) {
	global $_G;

	$wechatuserid = DB::result_first("SELECT wechatuserid FROM ".DB::table('common_openid_wechat')." WHERE uid='{$uid}' " . getSlaveID());
	try {		
		if ($wechatuserid && $realname && $mobile) {
			$postdata = array();
			$postdata['touser'] 		  = $wechatuserid;
			$postdata['template_id'] 	  = 'z9W_gpw4nhjXk__OS2qtSSDPE7YH5kSaymfYFFP9wPg';
			$postdata['url'] 			  = "http://wei.zaiwai.com/?d=forum&c=activity_publish&m=audit&tid={$tid}";
			$postdata['data']['first']    = array('value'=>"{$realname}报名了您的活动！", 'color'=>'#173177');
			$postdata['data']['keyword1'] = array('value'=>$title, 'color'=>'#173177');
			$postdata['data']['keyword2'] = array('value'=>$realname, 'color'=>'#173177');
			$postdata['data']['keyword3'] = array('value'=>$mobile, 'color'=>'#173177');			
			$postdata['data']['remark']   = array('value'=>"报名时间：".date("Y-m-d H:i"), 'color'=>'#000000');			
			
			requestToWechat($postdata);
		}		
	} catch(Exception $e) {}
}

//向活动发布者(绑定微信)发送取消报名申请通知
function sendActivityCancelMsgForWechat($uid, $tid, $title, $realname, $message) {
	global $_G;	
	
	$wechatuserid = DB::result_first("SELECT wechatuserid FROM ".DB::table('common_openid_wechat')." WHERE uid='{$uid}' " . getSlaveID());
	try {		
		if ($wechatuserid && $realname) {
			$postdata = array();
			$postdata['touser'] 		  = $wechatuserid;
			$postdata['template_id'] 	  = 'XZ95JWFGuONqJPwHATEbqH8yrE47nNGOp2SuQ5o1nis';
			$postdata['url'] 			  = "http://wei.zaiwai.com/?d=forum&c=activity_publish&m=audit&tid={$tid}";
			$postdata['data']['first']    = array('value'=>"{$realname}取消报名了您的活动。", 'color'=>'#173177');
			$postdata['data']['keyword1'] = array('value'=>$title, 'color'=>'#173177');
			$postdata['data']['keyword2'] = array('value'=>$realname, 'color'=>'#173177');
			$postdata['data']['keyword3'] = array('value'=>$message, 'color'=>'#173177');						
			$postdata['data']['remark']   = array('value'=>"退出时间：".date("Y-m-d H:i"), 'color'=>'#000000');
			
			requestToWechat($postdata);
		}		
	} catch(Exception $e) {}
}

//向活动报名者(绑定微信)发送活动报名成功通知
function sendApplySuccessMsgForWechat($uid, $title, $clubname) {
	global $_G;	
	
	$wechatuserid = DB::result_first("SELECT wechatuserid FROM ".DB::table('common_openid_wechat')." WHERE uid='{$uid}' " . getSlaveID());
	try {		
		if ($wechatuserid) {
			$postdata = array();
			$postdata['touser'] 		  = $wechatuserid;
			$postdata['template_id'] 	  = 'q-Bvxy46YOn24U2o1SzgUqnVKVnR9W3PeBgcRlIOKXw';
			$postdata['url'] 			  = "http://wei.zaiwai.com/?d=member&c=member";
			$postdata['data']['first']    = array('value'=>"报名成功，你报名的活动审核已通过", 'color'=>'#173177');
			$postdata['data']['keyword1'] = array('value'=>$title, 'color'=>'#173177');
			$postdata['data']['keyword2'] = array('value'=>$clubname, 'color'=>'#173177');
			$postdata['data']['keyword3'] = array('value'=>date("Y-m-d H:i"), 'color'=>'#173177');
			$postdata['data']['remark']   = array('value'=>"感谢您的参与，点击查看详情", 'color'=>'#000000');
			
			requestToWechat($postdata);
		}		
	} catch(Exception $e) {}
}

//向活动报名者(绑定微信)发送报名失败通知
function sendApplyFailMsgForWechat($uid, $title, $starttime, $place) {
	global $_G;		
	
	$wechatuserid = DB::result_first("SELECT wechatuserid FROM ".DB::table('common_openid_wechat')." WHERE uid='{$uid}' " . getSlaveID());
	try {		
		if ($wechatuserid) {
			$postdata = array();
			$postdata['touser'] 		  = $wechatuserid;
			$postdata['template_id'] 	  = 'L9QVAJ22MXdn_p-QDT_RImDvPnIdGCaJ_ubgr1evAdI';
			$postdata['url'] 			  = "http://wei.zaiwai.com/?d=member&c=member";
			$postdata['data']['first']    = array('value'=>"报名失败，你报名的活动审核未通过", 'color'=>'#173177');
			$postdata['data']['keyword1'] = array('value'=>$title, 'color'=>'#173177');
			$postdata['data']['keyword2'] = array('value'=>date("Y-m-d H:i", $starttime), 'color'=>'#173177');
			$postdata['data']['keyword3'] = array('value'=>$place, 'color'=>'#173177');
			$postdata['data']['remark']   = array('value'=>"亲，下一次早点报名哦。", 'color'=>'#000000');
			
			requestToWechat($postdata);
		}
	} catch(Exception $e) {}
}

// 获得微信公众号(在外app)的wechat_token
function getWechatTokenOfZaiwai() {
	global $_G;
	
	require_once libfile('class/myredis');
	$redis     = & myredis::instance(6381);
	$timestamp = TIMESTAMP;

	$wechat_token = $redis->obj->get('wechat_token_for_api');
	if(!$wechat_token) {
		$request_url = build_url_activity(array('appname'=> 'wechatapi', 'qt'=> $timestamp, 'c' => 'authorize','m'=>'wechat_token'), $_G['config']['apikey']['wechatapi']);
		
		$wechat = requestRemoteData("http://api.8264.com/openid/".$request_url);
		$wechat = json_decode($wechat, true);
		$wechat_token = $wechat['data']['wechat_token'];
		$redis->obj->set('wechat_token_for_api', $wechat_token, $wechat['data']['expires_time'] - $timestamp);
	}
	return $wechat_token;	
}

//自动计算签名
function build_url_activity($params, $secret) {
	ksort($params);
	reset($params);
	$str_q = http_build_query($params);
	$sign = md5($str_q.$secret);
	return '?'.$str_q.'&sign='.$sign;
}

function urlencode_array_wechat($arr)
{
	$func = create_function( '&$value, $key', '$value=urlencode($value);' );
	array_walk_recursive($arr, $func);
	return $arr;
}

function requestToWechat($postdata)
{
	$wechat_token = getWechatTokenOfZaiwai();
			
	//转为utf8编码
	$jsonmenu = iconv_array($postdata);
	
	//解决微信不支持40033：不能包含\uxxxx格式的字符(中文)
	$jsonmenu = urlencode_array_wechat($jsonmenu);
	$jsonmenu = json_encode($jsonmenu);
	$jsonmenu = urldecode($jsonmenu);
	requestRemoteData("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$wechat_token}", 'POST', $jsonmenu);
}

/**
 * 通过接口获取当前用户在当前活动的历史报名数据
 * @author Gtl
 * @version 20161021 第一版
 * @version 20161129 测试完毕准备上线
 * @version 20170110 解决缓存失效后高并发访问导致数据库负载急剧上升的问题
 * @global array $_G
 * @param int $tid
 * @param int $uid
 * @return array
 */
function getapplyhistory($tid, $uid){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$cachekey = 'api_hd_getapplyhistory_uid_'.$uid.'_tid_'.$tid; //数据缓存
	$signkey = 'api_hd_getapplyhistory_sign_uid_'.$uid.'_tid_'.$tid; //已经发出数据请求的标记
	
	//尝试获取缓存数据
	$cachedata = memory('get', $cachekey);
	if($cachedata === null || $cachedata === false){
		$cachedata = array();
		//判断是否已经发出了获取数据的请求
		$sign = memory('get', $signkey);
		if($sign != 1){
			//设置请求标记并发出获取数据的请求并更新缓存
			memory('set', $signkey, 1, 15);
			$params = array(
				'appname' => $appname,
				'qt' => TIMESTAMP,
				'app' => 'order',
				'act' => 'bbs_historyorder',
				'tid' => $tid,
				'uid' => $uid
			);
			$url = global_build_url($params, $appsecret);
			$httpResult = requestRemoteData($url);
			$result = json_decode($httpResult, true);
			if($result['errorCode'] === 0){ //请求成功没有错误
				foreach ($result['result'] as $key => $value) {
					if($key == 'ufielddata' && !empty($value)){
						$result['result']['ufielddata'] = fieldiconv(unserialize($value));
						continue;
					}
					$result['result'][$key] = diconv($value, 'utf-8', 'gbk');
				}
				$cachedata = $result['result'];
				memory('set', $cachekey, $cachedata, 3600); //更新缓存
				memory('rm', $signkey); //删除标记
			}
		}
	}
	return $cachedata;
}

/**
 * 请求api 更新订单
 * @author gtl 20161205y
 */
function updateapply($applyid, $postdata){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$ufielddata = @unserialize($postdata['ufielddata']);
	foreach ($postdata as $key => $value) {
		$postdata[$key] = diconv($value, 'gbk', 'utf-8');
	}
	if(!empty($ufielddata)){
		$postdata['ufielddata'] = fieldiconv($ufielddata, 'gbk', 'utf-8');
	}
	$postdata['payment'] = $postdata['payment']>0?$postdata['payment']:0;
	$params = array(
		'appname' => $appname,
		'qt' => TIMESTAMP,
		'app' => 'order',
		'act' => 'bbs_editorder',
		'order_id' => $applyid
	);
	//请求
	$url = global_build_url($params, $appsecret);
	$httpResult = requestRemoteData($url, 'POST', $postdata);
	$result = json_decode($httpResult, true);
	if(!$result['errorCode'] && $result['result']){
		return true;
	}
	return false;
}

/**
 * 通过接口创建新订单（申请） 成功返回订单号 失败返回布尔 false ok
 * @author gtl 20161205y
 * @global type $appname
 * @global type $appsecret
 * @param type $postdata
 * @return boolean
 */
function newapply($postdata){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	//转码
	$ufielddata = unserialize($postdata['ufielddata']);
	foreach ($postdata as $key => $value) {
		$postdata[$key] = diconv($value, 'gbk', 'utf-8');
	}
	if(!empty($ufielddata)){
		$postdata['ufielddata'] = fieldiconv($ufielddata, 'gbk', 'utf-8');
	}
	//防止@符号的干扰
	foreach($postdata as $thisfield => $thisval){
		$postdata[$thisfield] = base64_encode($thisval);
	}
	//post数据
	$params = array(
		'appname' => $appname,
		'qt' => TIMESTAMP,
		'app' => 'order',
		'act' => 'bbs_order'
	);
	//请求
	$url = global_build_url($params, $appsecret);
	$httpResult = requestRemoteData($url, 'POST', $postdata);
	$result = json_decode($httpResult, true);
	if(!$result['errorCode'] && $result['result']){
		return $result['result'];
	}
	return false;
}

/**
 * 通过接口删除报名
 * @author Gtl 20161021 20161028y
 * @global array $_G
 * @param int $tid
 * @param int $uid
 * @return mixed
 */
function cancelapply($tid, $uid){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$params = array(
		'appname' => $appname,
		'qt'  => TIMESTAMP,
		'app' => 'order',
		'act' => 'bbs_cancelapply',
		'tid' => $tid,
		'uid' => $uid
	);
	$url = global_build_url($params, $appsecret);
	$httpResult = requestRemoteData($url);
	$result = json_decode($httpResult, true);
	if($result['result'] === true){
		return true;
	}
	return $result['errorReason'];
}

/**
 * 根据参数获取某活动贴对应类型的全部报名
 * @author Gtl
 * @version 20161021 创建
 * @version 20161028 测试完毕准备上线
 * @version 20170110 解决缓存失效后高并发访问导致数据库负载急剧上升的问题
 * @global array $_G
 * @param int $tid
 * @param string $type all=>1 pass=>2 nopass=>3
 * @return array
 */
function getallorder($tid, $type='1'){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$cachekey = "api_hd_getallorder_tid_{$tid}_type_{$type}"; //数据缓存
	$signkey = "api_hd_getallorder_sign_tid_{$tid}_type_{$type}"; //已经发出数据请求的标记

	//尝试获取缓存数据
	$cachedata = memory('get', $cachekey);
	if($cachedata === null || $cachedata === false){
		$cachedata = array();
		//判断是否已经发出了获取数据的请求
		$sign = memory('get', $signkey);
		if($sign != 1){
			//设置请求标记并发出获取数据的请求并更新缓存
			memory('set', $signkey, 1, 15);
			$params = array(
				'appname' => $appname,
				'qt' => TIMESTAMP,
				'app' => 'order',
				'act' => 'bbs_thistidallorder',
				'tid' => $tid,
				'type' => $type
			);
			$url = global_build_url($params, $appsecret);
			$httpResult = requestRemoteData($url);
			$result = json_decode($httpResult, true);
			if($result['errorCode'] === 0){ //请求成功没有错误
				!is_array($result['result']) && $result['result'] = array();
				foreach ($result['result'] as $applyid => $item) {
					foreach ($item as $field => $value) {
						if($field == 'ufielddata' && !empty($value)){
							$result['result'][$applyid]['ufielddata'] = fieldiconv(unserialize($value));
						}else{
							$result['result'][$applyid][$field] = diconv($value, 'utf-8', 'gbk');
						}
					}
					$groupinfo = DB::fetch_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid = '{$item['uid']}'");
					$result['result'][$applyid]['groupid'] = $groupinfo['groupid'];
				}
				$cachedata = $result['result'];
				memory('set', $cachekey, $cachedata, 3600);
				memory('rm', $signkey); //删除标记
			}
		}
	}
	return $cachedata;
}

function getapply($conditions) {
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6381);
	$cachekey = "api_hd_getapply_uid_{$conditions['uid']}_{$conditions['page']}_{$conditions['perpage']}";
	$cachecountkey = "api_hd_getapply_uid_{$conditions['uid']}_applycount";
	$cachedata = json_decode($myredis->GET($cachekey), true);
	if(!is_array($cachedata)){
		$cachedata = array('list' => array(), 'count' => 0);
		$params = array(
			'appname' => $appname,
			'qt' => TIMESTAMP,
			'app' => 'order',
			'act' => 'bbs_thisuidallorder',
			'bbs_userid' => $conditions['uid'],
			'is_hide' => $conditions['isshow'] ? 0 : 1,
			'page' => $conditions['page'],
			'perpage' => $conditions['perpage']
		);
		$url = global_build_url($params, $appsecret);
		$httpResult = requestRemoteData($url);
		$result = json_decode($httpResult, true);
		if ($result['errorCode'] === 0) {
			$cachedata = $result['result'];
		}
		$myredis->SET($cachekey, json_encode($cachedata));
		$myredis->SET($cachecountkey, $cachedata['count']);
		$myredis->EXPIRE($cachekey, 300);
		$myredis->EXPIRE($cachecountkey, 300);
	}
	return $cachedata;
}

/**
 * 获取表单助手列表
 * @author Gtl
 * @version 20161021 第一版
 * @version 20161128 测试完毕准备上线
 * @version 20160110 解决缓存失效后高并发访问导致数据库负载急剧上升的问题
 * @global array $_G
 * @param int $uid 用户uid
 * @return array 表单助手列表
 */
function getformtpllist($uid){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$cachekey = 'api_hd_getformtpllist_uid_'.$uid; //数据缓存
	$signkey = 'api_hd_getformtpllist_sign_uid_'.$uid; //已经发出数据请求的标记
	
	//尝试获取缓存数据
	$cachedata = memory('get', $cachekey);
	if($cachedata === null || $cachedata === false){
		$cachedata = array();
		//判断是否已经发出了获取数据的请求
		$sign = memory('get', $signkey);
		if($sign != 1){
			//设置请求标记并发出获取数据的请求并更新缓存
			memory('set', $signkey, 1, 15);
			$params = array(
				'appname' => $appname,
				'qt' => TIMESTAMP,
				'app' => 'formtpl',
				'act' => 'getlist',
				'uid' => $uid
			);
			$apiurl = global_build_url($params, $appsecret);
			$httpResult = requestRemoteData($apiurl);
			$result = json_decode($httpResult, true);
			if($result['errorCode'] === 0){ //请求成功没有错误
				!is_array($result['result']) && $result['result'] = array();
				foreach($result['result'] as $formid=>$forminfo){
					$result['result'][$formid]['formname'] = diconv($forminfo['formname'], 'utf-8', 'gbk');
					$result['result'][$formid]['formfields'] = fieldiconv(unserialize($forminfo['formfields']));
				}
				$cachedata = $result['result'];
				memory('set', $cachekey, $cachedata, 1800);
				memory('rm', $signkey); //删除标记
			}
		}
	}
	return $cachedata;
}

/**
 * 获取模板结构
 * @author Gtl 20161021 20161028y
 * @return array
 */
function getformtpl($param) {
	$userfield = array();
	foreach ($param as $fieldid) {
		$userfield[$fieldid] = '';
	}
	return $userfield;
}

/**
 * 加载活动平台模板字段配置
 * @author Gtl
 * @version 20161021 创建
 * @version 20161028 测试完毕准备上线
 * @version 20160110 解决缓存失效后高并发访问导致数据库负载急剧上升的问题
 * @global array $_G
 * @return array
 */
function gethdfieldsetting(){ //加缓存
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$cachekey = 'api_hd_hdfieldsetting'; //数据缓存
	$signkey = 'api_hd_hdfieldsetting_sign'; //已经发出数据请求的标记

	//尝试获取缓存数据
	//memory('rm', $cachekey);
	$_G['cache']['profilesetting2'] = memory('get', $cachekey);
	if(!$_G['cache']['profilesetting2']){
		$_G['cache']['profilesetting2'] = array();
		//判断是否已经发出了获取数据的请求
		$sign = memory('get', $signkey);
		if($sign != 1){
			//设置请求标记并发出获取数据的请求并更新缓存
			memory('set', $signkey, 1, 15);
			$params = array(
				'appname' => $appname,
				'qt' => TIMESTAMP,
				'app' => 'formtpl',
				'act' => 'getsetting'
			);
			//请求
			$url = global_build_url($params, $appsecret);
			$httpResult = requestRemoteData($url);
			$result = json_decode($httpResult, true);
			if($result['errorCode'] === 0){ //请求成功没有错误
				!is_array($result['result']) && $result['result'] = array();
				foreach($result['result'] as $field=>$info){
					foreach ($info as $key => $value) {
						if($key === 'choices' && $value){
							$choices = unserialize($value);
							foreach ($choices as $key2 => $value2) {
								foreach ($value2 as $key3 => $value3) {
									$choices[$key2][$key3] = diconv($value3, 'utf-8', 'gbk');
								}
							}
							$result['result'][$field][$key] = serialize($choices);
						}else{
							$result['result'][$field][$key] = diconv($value, 'utf-8', 'gbk');
						}
					}
				}
				$_G['cache']['profilesetting2'] = $result['result'];
				memory('set', $cachekey, $_G['cache']['profilesetting2'], 86400); //更新缓存
				memory('rm', $signkey); //删除标记
			}
		}
	}
	return $_G['cache']['profilesetting2'];
}

/**
 * @author Gtl 20161028 20161129y
 * @param array $ufielddata
 * @param string $from
 * @param string $to
 * @return string
 */
function fieldiconv($ufielddata, $from = 'utf-8', $to = 'gbk'){
	foreach ($ufielddata['userfield'] as $field => $content) {
		$ufielddata['userfield'][$field] = diconv($content, $from, $to);
	}
	if (!empty($ufielddata['extfield'])) {
		$tmp = array();
		foreach ($ufielddata['extfield'] as $field => $content) {
			$field = diconv($field, $from, $to);
			$content = diconv($content, $from, $to);
			$tmp[$field] = $content;
		}
		$ufielddata['extfield'] = $tmp;
	}
	return serialize($ufielddata);
}

/**
 * 清除函数 getformtpllist 产生的指定缓存
 * @author gtl 20161129y
 * @param int $uid 用户uid
 */
function clearcache_getformtpllist($uid){
	$uid = (int)$uid;
	$cachekey = 'api_hd_getformtpllist_uid_'.$uid;
	memory('rm', $cachekey);
//	tmplogforhd('clearcache_getformtpllist', $cachekey);
}

/**
 * 清除函数 getapplyhistory 产生的指定缓存
 * @author gtl 20161129y
 * @param int $tid 帖子id
 * @param mixed $uid 用户uid
 */
function clearcache_getapplyhistory($tid, $uid){
	$tid = (int)$tid;
	if(is_array($uid)){
		foreach ($uid as $id) {
			$cachekey = 'api_hd_getapplyhistory_uid_'.(int)$id.'_tid_'.$tid;
			memory('rm', $cachekey);
		}
	}else{
		$uid = (int)$uid;
		$cachekey = 'api_hd_getapplyhistory_uid_'.$uid.'_tid_'.$tid;
		memory('rm', $cachekey);
	}
//	tmplogforhd('clearcache_getapplyhistory', func_get_args());
}

/**
 * 清除函数 getallorder 产生的指定缓存
 * @author gtl 20161129y
 * @param int $tid
 */
function clearcache_getallorder($tid){
	$tid = (int)$tid;
	$cachekey = "api_hd_getallorder_tid_{$tid}_type_1";
	memory('rm', $cachekey);
	$cachekey = "api_hd_getallorder_tid_{$tid}_type_2";
	memory('rm', $cachekey);
	$cachekey = "api_hd_getallorder_tid_{$tid}_type_3";
	memory('rm', $cachekey);
//	tmplogforhd('clearcache_getformtpllist', $cachekey);
}

/**
 * 清除函数 getapply 产生的指定缓存
 * @author gtl 20170116
 * @param int $uid
 */
function clearcache_getapply($uids) {
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6381);
	if(!is_array($uids)){
		$uids = array($uids);
	}
	foreach ($uids as $uid) {
		$cachecountkey = "api_hd_getapply_uid_{$uid}_applycount";
		$applycount = $myredis->GET($cachecountkey); //是否需要清缓存
		if ($applycount > 0) { //说明在近五分钟内有缓存生成
			$pagecount = ceil($applycount / 15);
			for ($i = 1; $i <= $pagecount; $i++) {
				$cachekey = "api_hd_getapply_uid_{$uid}_{$i}_15";
				$myredis->DEL($cachekey);
			}
		}
	}
	
}

/**
 * 当hd模板结构发生变化时会触发这个更新
 * @author gtl 20161202y
 */
function updateuserfieldsbyformid($formid, $ufield){
	$formid = (int)$formid;
	$ufield = addslashes(fieldiconv(unserialize(base64_decode($ufield))));
	$a = DB::query("UPDATE ".DB::table('forum_activity')." SET ufield='{$ufield}' WHERE formid = {$formid}");
//	tmplogforhd('updateuserfieldsbyformid', $a);
}

function getmanagehash($tid, $salt = 'zodrn5') {
	return md5(md5($tid) . $salt).$tid;
}

function updatestatus($tid, $orderids, $status){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	$params = array(
		'appname' => $appname,
		'qt' => TIMESTAMP,
		'app' => 'order',
		'act' => 'updatestatus',
		'tid' => $tid,
		'orderid' => $orderids,
		'status' => $status
	);
	$apiurl = global_build_url($params, $appsecret);
	$httpResult = requestRemoteData($apiurl);
	$result = json_decode($httpResult, true);
	if ($result['errorCode'] === 0) { //请求成功没有错误
		$data['applynumber'] = $result['result']['applynumber'];
		$data['passnumber']  = $result['result']['passnumber'];
		DB::update('forum_activity', $data, "tid={$tid}");
	}
}

/**
 * 任何一个能看见这个函数的人请通知开发者全局停用/删除 这是个临时日志本不应该长期出现在正式环境
 * 如果涨不到当时的开发者，任何一个人都可以全局停用或删除此函数 这只是一个开发阶段用于调试的函数
 * @author gtl 20161129y
 */
function tmplogforhd($name, $data) {
	file_put_contents(DISCUZ_ROOT . "/data/dlogs/api_{$name}_" . date("Ymd") . '.log', var_export($data, true) . PHP_EOL, FILE_APPEND);
}
?>
