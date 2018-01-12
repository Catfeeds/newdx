<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if (!empty($_GET['picid'])) {
	$pic = DB::fetch_first("SELECT picPath,serverid FROM ".DB::table('plugin_daily_picture_pics')." WHERE id = {$_GET['picid']}");
	if ($pic['picPath']) {
		// delete picture
		$pic_path = DISCUZ_ROOT.'./data/attachment/plugin/'.$pic['picPath'];
		//$pic_thumb_path = preg_replace('/(?=\.([^.]+)$)/i', '.thumb', $pic_path);
        $pic_thumb_path = $pic_path.'.thumb.jpg';
        $serverid = $pic['serverid'];
        if($serverid > 0){
            require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
            $attachserver = new attachserver;
            $domain = $attachserver->get_server_domain($serverid , '*');
            $attachserver->delete($domain['domain'] , $domain['api'] , 'plugin/'.$pic['picPath'] , 1);
        }else{
            @unlink($pic_path);
            @unlink($pic_thumb_path);
        }
	}
	DB::query("DELETE FROM ".DB::table('plugin_daily_picture_pics')." WHERE id = {$_GET['picid']}");
	cpmsg('É¾³ý³É¹¦', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dailypicture&pmod=admincp_pic', 'succeed');
}
