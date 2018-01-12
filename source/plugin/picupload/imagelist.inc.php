<?php

/**
 * @author JiangHong
 * 上传图片的列表文件
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if($_G['gp_inajax']){
    if($_G['uid']){
        require_once libfile('function/post');
        $attachlist = getattach(0);
        $imagelist = $attachlist['imgattachs']['unused'];
		$maxpic = $_G['cache']['plugin']['picupload']['maxpic'] > 0 ? $_G['cache']['plugin']['picupload']['maxpic'] : 50;
		$imagelist = array_chunk($imagelist , $maxpic ,true);
		$imagelist = $imagelist[0];
		$ajaxnum = $_G['cache']['plugin']['picupload']['ajaxnum'] > 0 ? $_G['cache']['plugin']['picupload']['ajaxnum'] : 5;
		$nowpicnum = count($imagelist);
		$canpicnum = $maxpic - $nowpicnum;
        include template('common/header_ajax');
        include template('picupload:imagelist');
        include template('common/footer_ajax');
    }else{
        showmessage('postperm_login_nopermission', NULL, array(), array('login' => 1));
    }
}

?>