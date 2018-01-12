<?php

/**
 * @author JiangHong
 * @copyright 2014
 */
$hash = $_G['gp_hash'];
if(!empty($_POST['uid']) || ($_G['gp_newflash']==1 && $op != 'config')) {
	//$_G['uid'] = intval($_POST['uid']);
    $_G['uid'] = intval($_G['gp_uid']);
    if($_G['gp_uid'] == 35732735){
		$_G['config']['cdns']['opend'] = true;
	}
	if(empty($_G['uid']) || $_G['gp_hash'] != md5($_G['uid'].UC_KEY)) {
		exit('err');
	}
	$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid='$_G[uid]' LIMIT 1");
	$_G['username'] = addslashes($member['username']);

	loadcache('usergroup_'.$member['groupid']);
	$_G['group'] = $_G['cache']['usergroup_'.$member['groupid']];

} elseif (empty($_G['uid'])) {
	$text = "nouser";
}
if($_G['uid']){	
	if($_FILES && $_POST) {
		if($_FILES["Filedata"]['error']) {
			$uploadfiles = lang('spacecp', 'file_is_too_big');
		} else {
			$_FILES["Filedata"]['name'] = addslashes(diconv(urldecode($_FILES["Filedata"]['name']), 'UTF-8'));
			$_POST['albumid'] = addslashes(diconv(urldecode($_POST['albumid']), 'UTF-8'));
			$catid = $_POST['catid'] ? intval($_POST['catid']) : 0;
			require_once libfile('function/spacecp');
			$uploadfiles = pic_save($_FILES["Filedata"], $_POST['albumid'], addslashes(diconv(urldecode($_POST['title']), 'UTF-8')), true, $catid);
			
			//个人中心封面
			if ($_G['gp_uc_cover']) {		
				DB::query("DELETE FROM ".DB::table('home_cover')." WHERE uid={$_G['uid']}");			
				DB::insert('home_cover', array('uid'=>$_G['uid'],'picid'=>$uploadfiles['picid']));
			}
		}
		$proid = $_POST['proid'];
		$uploadResponse = true;
		$albumid = 0;
		if($uploadfiles && is_array($uploadfiles)) {
			$text = "uploadsuccess";
			$albumid = $uploadfiles['albumid'];
			require_once libfile('function/home');
			$homepic = pic_get($uploadfiles['filepath'], 'album', $uploadfiles['thumb'], 0, 0, $uploadfiles['serverid'], true);
		} else {
			$text = "uploaderror";
		}
	}else{
		$text = "nofile";
	}
}else{
	$text = "hasherror[hash:$hash][swfhash:$swfhash][{$_G[uid]}]";
}
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><parameter><text>{$text}</text><picurl>{$homepic}</picurl></parameter>";
?>