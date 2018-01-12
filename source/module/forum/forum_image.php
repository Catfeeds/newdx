<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_image.php 14183 2010-08-09 03:49:46Z monkey $
 */

if(!defined('IN_DISCUZ') || empty($_G['gp_aid']) || empty($_G['gp_size']) || empty($_G['gp_key'])) {
	header('location: '.$_G['siteurl'].'static/image/common/none.gif');
	exit;
}


$nocache = !empty($_G['gp_nocache']) ? 1 : 0;
//使用缓存
$nocache = 0;
$aid = intval($_G['gp_aid']);
$type = !empty($_G['gp_type']) ? $_G['gp_type'] : 'fixwr';
list($w, $h) = explode('x', $_G['gp_size']);
$w = intval($w);
$h = intval($h);
$thumbfile = 'image/'.$aid.'_'.$w.'_'.$h.'.jpg';
$parse = parse_url($_G['setting']['attachurl']);
$attachurl = !isset($parse['host']) ? $_G['siteurl'].$_G['setting']['attachurl'] : $_G['setting']['attachurl'];
if(!$nocache) {
	//if(is_exists($_G['config']['web']['attach'].$thumbfile,250)){
    if(is_exists('http://avatar.8264.com/'.$thumbfile,250)){
		dheader('location: '.$_G['config']['web']['attach'].$thumbfile);
    }
	if(file_exists($_G['setting']['attachdir'].$thumbfile)) {
		dheader('location: '.$attachurl.$thumbfile);
	}
}

define('NOROBOT', TRUE);

list($daid, $dw, $dh) = explode("\t", authcode($_G['gp_key'], 'DECODE', $_G['config']['security']['authkey']));

if($daid != $aid || $dw != $w || $dh != $h) {
	dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
}

if($attach = DB::fetch(DB::query("SELECT remote, attachment, serverid,width FROM ".DB::table('forum_attachment')." WHERE aid='$aid' AND isimage IN ('1', '-1')"))) {
	dheader('Expires: '.gmdate('D, d M Y H:i:s', TIMESTAMP + 3600).' GMT');
	if($attach['remote']){
		$filename = $_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'];
	}else {
        /**增加对是否为附件服务器进行判定**/
        if($attach['serverid']>0){
            if(file_exists(DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php")){
                require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
                $attach_server = new attachserver;
                $serverinfo = $attach_server->get_server_domain($attach['serverid'],'*');
                //$filename = "http://".$attach_server->get_server_domain($attach['serverid'])."/";
                $filename = "http://avatar.8264.com/";
                $return = ($attach['width']==0 || $attach['width'] > $w) ? $attach_server->Thumb($serverinfo['domain'] , $serverinfo['api'] , 'forum/'.$attach['attachment'] , $thumbfile , $w , $h , $type) : false;
                if($return){
					dheader('location: http://'.$serverinfo['name'].'/'.$thumbfile);
                    //@readfile($filename.$thumbfile);
                    /*if($nocache){
                        $attach_server->delete($serverinfo['domain'] , $serverinfo['api'] , $thumbfile);
                    }*/
                }else{
                    @readfile($filename."forum/".$attach['attachment']);
                }
                exit();
            }
        }
        $filename = $_G['setting']['attachdir'].'forum/'.$attach['attachment'];
	}
	require_once libfile('class/image');
	$img = new image;
	if($img->Thumb($filename, $thumbfile, $w, $h, $type)) {
		if($nocache) {
			@readfile($_G['setting']['attachdir'].$thumbfile);
			@unlink($_G['setting']['attachdir'].$thumbfile);
		} else {
			dheader('location: '.$attachurl.$thumbfile);
		}
	} else {
		@readfile($filename);
	}
}
function is_exists($file,$num){
    require libfile('class/myredis');
    $redis = & myredis::instance();
    if($redis->sIsMember('all_cache_forum_image|set' ,$file)){
        return true;
    }elseif(file_exists($file)){
        $redis->sAdd('all_cache_forum_image|set' ,$file);
        return true;
    }else{
        $fp = @fopen($file,'rb');
        $str = '';
        $len = 0;
        if($fp){
            $str = @fread($fp,256);
            @fclose($fp);
            if(($len = strlen($str))>$num){
                $redis->sAdd('all_cache_forum_image|set' ,$file);
                return true;
            }
        }
        //echo "长度".$len;
        return false;
    }
}
?>