<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: thread_activity.php 18840 2010-12-07 06:59:19Z liulanbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/activity');
$isverified = $applied = 0;
$ufielddata = $applyinfo = '';
if($_G['uid']) {
	$applyinfo = getapplyhistory($_G['tid'], $_G['uid']);
	if($applyinfo){
		$isverified = $applyinfo['verified'];
		if($applyinfo['ufielddata']) {
			$ufielddata = unserialize($applyinfo['ufielddata']);
		}
		$applied = 1;
	}
}
$applylist = array();
$activity = DB::fetch_first("SELECT * FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'");
$activityclose = $activity['expiration'] ? ($activity['expiration'] > TIMESTAMP ? 0 : 1) : 0;
$activity['starttimefrom'] = date('Y-m-d', $activity['starttimefrom']);
$activity['starttimeto'] = $activity['starttimeto'] ? date('Y-m-d', $activity['starttimeto']) : 0;
$activity['expiration'] = $activity['expiration'] ? date('Y-m-d', $activity['expiration']) : 0;
$activity['attachurl'] = $activity['thumb'] = '';
if($activity['ufield']) {
	$activity['ufield'] = unserialize($activity['ufield']);
	if($activity['ufield']['userfield']) {
		$htmls = $settings = array();
		require_once libfile('function/profile');
		if(empty($ufielddata['userfield'])) {
			if ($_G[uid]) {
				if($activity['formid']){ //使用了表单助手
					$ufielddata['userfield'] = getformtpl($activity['ufield']['userfield']);
				}else{
					$query = DB::query("SELECT ".implode(',', $activity['ufield']['userfield'])." FROM ".DB::table('common_member_profile')." WHERE uid='$_G[uid]'");
					$ufielddata['userfield'] = DB::fetch($query);
				}
			}
		}
		if($activity['formid']){ //使用了表单助手
			foreach($activity['ufield']['userfield'] as $fieldid) {						
				$html = profile_setting2($fieldid, $ufielddata['userfield']);
				if($html) {
					$settings[$fieldid] = $_G['cache']['profilesetting2'][$fieldid];
					$htmls[$fieldid] = $html;
				}
			}
		}else{
			foreach($activity['ufield']['userfield'] as $fieldid) {						
				$html = profile_setting($fieldid, $ufielddata['userfield'], false, true);		
				if($html) {			
					$settings[$fieldid] = $_G['cache']['profilesetting'][$fieldid];
					$htmls[$fieldid] = $html;
				}
			}
		}
		
	}
} else {
	$activity['ufield'] = '';
}

if($activity['aid']) {
	$attach = DB::fetch_first("SELECT a.*,af.description FROM ".DB::table('forum_attachment')." a LEFT JOIN ".DB::table('forum_attachmentfield')." af USING(aid) WHERE a.aid='$activity[aid]'");
	/*引入判定是否为附件服务器*/
    if($attach['serverid']>0){
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
    	$attachserver = new attachserver;
        $domain = $attachserver->get_server_domain($attach['serverid'], '*');
    }
    /*结束*/
	if($attach['isimage']) {
	   /*以下一行进行了修改，增加判定是否为附件服务器的图片*/
		$activity['attachurl'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : ($attach['serverid']>0 ? "http://".$domain['name']."/" : $_G['setting']['attachurl'])).'forum/'.$attach['attachment'];
		$activity['thumb'] = $activity['attachurl'].($attach['thumb'] ? '.thumb.jpg' : '');
		$activity['width'] = $attach['thumb'] && $_G['setting']['thumbwidth'] < $attach['width'] ? $_G['setting']['thumbwidth'] : $attach['width'];
		if(is_array($domain['api'])){
			$activity['thumb'] = $activity['attachurl'] . getUpYun(true, 300, 300, 1, 0, 1, true, $_G['config']['cdns']['ids'][$attach['serverid']]);
		}
	}
	$skipaids[] = $activity['aid'];
}

$applylistverified = array();
$noverifiednum = 0;
$applynumbers  = 0;
$allorderinfos = getallorder($_G['tid']);
foreach ($allorderinfos as $activityapplies) {
	$activityapplies['dateline'] = dgmdate($activityapplies['dateline'], 'u');
	if($activityapplies['verified'] == 1) {
		$activityapplies['ufielddata'] = unserialize($activityapplies['ufielddata']);	
		if(count($applylist) < 1000) {			
			$cjnum=$activityapplies['ufielddata']['userfield']['field3'];
			if(!empty($cjnum)&&is_numeric($cjnum)){
			$activityapplies['num'] = $cjnum;
			}
			$activityapplies['message'] = preg_replace("/(".lang('forum/misc', 'contact').".*)/", '', $activityapplies['message']);
			$applylist[] = $activityapplies;

		}
		
		$nofilds = 0;		
		$nofilds=$activityapplies['ufielddata']['userfield']['field3'];
		if(!empty($nofilds)&&is_numeric($nofilds)){
			if(intval($nofilds)){
				$applynumbers += $nofilds;
			}
		}else{
			$applynumbers++;
		}
		
	} else {
		$activityapplies['ufielddata'] = unserialize($activityapplies['ufielddata']);
		if(count($applylistverified) < 1000) {
			$cjnum=$activityapplies['ufielddata']['userfield']['field3'];
			if(!empty($cjnum)&&is_numeric($cjnum)){
			$activityapplies['num'] = $cjnum;
			}
			$applylistverified[] = $activityapplies;
		}
		
		$nofilds = 0;		
		$nofilds=$activityapplies['ufielddata']['userfield']['field3'];
		if(!empty($nofilds)&&is_numeric($nofilds)){
			if(intval($nofilds)){
				$noverifiednum += $nofilds;
			}
		}else{
			$noverifiednum++;
		}
	}

}

//获得微信token
require_once libfile('function/activity');
$wechat_token = getWechatTokenOfZaiwai();

//区分在外、论坛、微信报名
//未审核调取app图像和名字
if($applylistverified){
	foreach($applylistverified as $k=>$v){
		if(!empty($v['appuserid']) && $v['uid'] == 40269021){
			$url = "{$_G['config']['zaiwaiapi']['url']}userService/findCustomerUserListByUserIdList?userIdList={$v['appuserid']}&sourceUserId={$v['appuserid']}&sToken={$_G['config']['zaiwaiapi']['token']}";
			$temp = requestRemoteData($url);
			$temp = json_decode($temp, true);
			$temp = iconv_array($temp, 'utf-8', 'gbk');			
			$temp = $temp['customerUserList'][0]['userBasic'];
			$applylistverified[$k]['appusername'] = $temp['name'];
			$applylistverified[$k]['picUrl'] 	  = $temp['picUrl'] ? $temp['picUrl'] : 'http://static.8264.com/wei/images/default.png';
		}	
		if(!empty($v['wechatuserid']) && $v['uid'] == 40269021){
			$wechat_result = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token={$wechat_token}&openid={$v['wechatuserid']}&lang=zh_CN");
			$wechat_result = json_decode($wechat_result, true);
			$applylistverified[$k]['appusername'] = $v['wechatusername'];
			$applylistverified[$k]['picUrl'] 	  = $wechat_result['headimgurl'] ? $wechat_result['headimgurl'] : 'http://static.8264.com/wei/images/default.png';
			$applylistverified[$k]['appuserid']   = $v['wechatuserid'];
		}
	}
}
//审核调取app图像和名字
if($applylist){
	foreach($applylist as $k=>$v){		
		if(!empty($v['appuserid']) && $v['uid'] == 40269021){
			$url = "{$_G['config']['zaiwaiapi']['url']}userService/findCustomerUserListByUserIdList?userIdList={$v['appuserid']}&sourceUserId={$v['appuserid']}&sToken={$_G['config']['zaiwaiapi']['token']}";
			$temp = requestRemoteData($url);
			$temp = json_decode($temp, true);
			$temp = iconv_array($temp, 'utf-8', 'gbk');			
			$temp = $temp['customerUserList'][0]['userBasic'];
			$applylist[$k]['appusername'] = $temp['name'];
			$applylist[$k]['picUrl'] 	  = $temp['picUrl'] ? $temp['picUrl'] : 'http://static.8264.com/wei/images/default.png';
		}			
		if(!empty($v['wechatuserid']) && $v['uid'] == 40269021){
			$wechat_result = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token={$wechat_token}&openid={$v['wechatuserid']}&lang=zh_CN");
			$wechat_result = json_decode($wechat_result, true);
			$applylist[$k]['appusername'] = $v['wechatusername'];
			$applylist[$k]['picUrl'] 	  = $wechat_result['headimgurl'] ? $wechat_result['headimgurl'] : 'http://static.8264.com/wei/images/default.png';
			$applylist[$k]['appuserid']   = $v['wechatuserid'];
		}	
	}
}
//做修改
$ufild = DB::fetch_first("select * FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'");
$ufild['ufield'] = unserialize($ufild['ufield']);
if(!empty($ufild['ufield']['userfield'])) {		
	foreach($ufild['ufield']['userfield'] as $key => $value){
		if($value=='field3'){			
			$applynumbers = $applynumbers;			
			$aboutmembers = $activity['number'] >= $applynumbers ? $activity['number'] - $applynumbers : 0;
			$aboutmembers = $aboutmembers > 0 ? $aboutmembers : 0;
		}else{
			$applynumbers = $applynumbers;			
			$aboutmembers = $activity['number'] >= $applynumbers ? $activity['number'] - $applynumbers : 0;
			$aboutmembers = $aboutmembers > 0 ? $aboutmembers : 0;
		}		
	}	
}else{
$applynumbers = $activity['applynumber'];
$aboutmembers = $activity['number'] >= $applynumbers ? $activity['number'] - $applynumbers : 0;
$aboutmembers = $aboutmembers > 0 ? $aboutmembers : 0;
}

$allapplynum =  $applynumbers + $noverifiednum;

//end
/*$applynumbers = $activity['applynumber'];
$aboutmembers = $activity['number'] >= $applynumbers ? $activity['number'] - $applynumbers : 0;
$allapplynum = $applynumbers + $noverifiednum;*/
if($_G['forum']['status'] == 3) {
	$isgroupuser = groupperm($_G['forum'], $_G['uid']);
}

//根据此字符串识别管理
$manageauth = getmanagehash($_G['tid']);
?>