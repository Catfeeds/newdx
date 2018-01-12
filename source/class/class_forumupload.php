<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: class_forumupload.php 16864 2010-09-16 04:48:29Z monkey $
 */
class forum_upload_wap {

	var $uid;
	var $aid;
	var $simple;
	var $statusid;
	var $attach;
	var $error_sizelimit;

	function forum_upload_wap() {
		global $_G;
		$this->uid = intval($_G['uid']);
		$this->aid = 0;
		$this->simple = !empty($_G['gp_simple']) ? $_G['gp_simple'] : 0;

		$_G['groupid'] = intval(DB::result_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid='".$this->uid."'"));
		loadcache('usergroup_'.$_G['groupid']);
		$_G['group'] = $_G['cache']['usergroup_'.$_G['groupid']];

		$uploadPic['name']  	= iconv("utf-8","gbk//TRANSLIT",$_G['gp_name']);
		$uploadPic['type']  	= $_G['gp_type'];
		$uploadPic['tmp_name']  = iconv("utf-8","gbk//TRANSLIT",$_G['gp_tmp_name']);
		$uploadPic['error'] 	= $_G['gp_error'];
		$uploadPic['size']  	= $_G['gp_size'];

		require_once libfile('class/upload');

		$upload = new discuz_upload();
		$upload->init_wap($uploadPic, 'forum');
		$this->attach = &$upload->attach;

		if($upload->error()) {
			encodeData(array('errorinfo'=>"2"));
		}

		$allowupload = !$_G['group']['maxattachnum'] || $_G['group']['maxattachnum'] && $_G['group']['maxattachnum'] > DB::result_first("SELECT count(*) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400");
		if(!$allowupload) {
			encodeData(array('errorinfo'=>"9"));
		}

		if($_G['group']['attachextensions'] && (!preg_match("/(^|\s|,)".preg_quote($upload->attach['ext'], '/')."($|\s|,)/i", $_G['group']['attachextensions']) || !$upload->attach['ext'])) {
			encodeData(array('errorinfo'=>"1"));
		}

		if(empty($upload->attach['size'])) {
			encodeData(array('errorinfo'=>"2"));
		}

		if($_G['group']['maxattachsize'] && $upload->attach['size'] > $_G['group']['maxattachsize']) {
			$this->error_sizelimit = $_G['group']['maxattachsize'];
			encodeData(array('errorinfo'=>"3"));
		}

		if($type = DB::fetch_first("SELECT maxsize FROM ".DB::table('forum_attachtype')." WHERE extension='".addslashes($upload->attach['ext'])."'")) {
			if($type['maxsize'] == 0) {
				$this->error_sizelimit = 'ban';
				encodeData(array('errorinfo'=>"4"));
			} elseif($upload->attach['size'] > $type['maxsize']) {
				$this->error_sizelimit = $type['maxsize'];
				encodeData(array('errorinfo'=>"5"));
			}
		}

		if($upload->attach['size'] && $_G['group']['maxsizeperday']) {
			$todaysize = intval(DB::result_first("SELECT SUM(filesize) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400"));
			$todaysize += $upload->attach['size'];
			if($todaysize >= $_G['group']['maxsizeperday']) {
				$this->error_sizelimit = 'perday|'.$_G['group']['maxsizeperday'];
				encodeData(array('errorinfo'=>"6"));
			}
		}
		$upload->save_wap();
		if ($errorMsg = $upload->error()) {
			encodeData(array('errorinfo'=>$errorMsg));
		}

	}
}

class forum_upload {

	var $uid;
	var $aid;
	var $simple;
	var $statusid;
	var $attach;
	var $error_sizelimit;
	var $mytype = 'forum';
	var $picname = '';

	function forum_upload($mtype = 'forum') {
		global $_G;

		$this->uid = intval($_G['gp_uid']);
		$_G['uid'] = $this->uid;
		$swfhash = md5(substr(md5($_G['config']['security']['authkey']), 8).$this->uid);
		$this->aid = 0;
		$this->simple = !empty($_G['gp_simple']) ? $_G['gp_simple'] : 0;
		$this->mytype = $mtype;
		if($_G['gp_hash'] != $swfhash) {
			$this->uploadmsg(10);
		}

		$_G['groupid'] = intval(DB::result_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid='".$this->uid."'"));
		loadcache('usergroup_'.$_G['groupid']);
		$_G['group'] = $_G['cache']['usergroup_'.$_G['groupid']];

		require_once libfile('class/upload');

		$upload = new discuz_upload();
		$upload->init($_FILES['Filedata'], $mtype);
		$this->attach = &$upload->attach;

		if($upload->error()) {
			$this->uploadmsg(2);
		}

		$allowupload = !$_G['group']['maxattachnum'] || $_G['group']['maxattachnum'] && $_G['group']['maxattachnum'] > DB::result_first("SELECT count(*) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400");
		if(!$allowupload) {
			$this->uploadmsg(9);
		}

		if($_G['group']['attachextensions'] && (!preg_match("/(^|\s|,)".preg_quote($upload->attach['ext'], '/')."($|\s|,)/i", $_G['group']['attachextensions']) || !$upload->attach['ext'])) {
			$this->uploadmsg(1);
		}

		if(empty($upload->attach['size'])) {
			$this->uploadmsg(2);
		}

		if($_G['group']['maxattachsize'] && $upload->attach['size'] > $_G['group']['maxattachsize']) {
			$this->error_sizelimit = $_G['group']['maxattachsize'];
			$this->uploadmsg(3);
		}

		if($type = DB::fetch_first("SELECT maxsize FROM ".DB::table('forum_attachtype')." WHERE extension='".addslashes($upload->attach['ext'])."'")) {
			if($type['maxsize'] == 0) {
				$this->error_sizelimit = 'ban';
				$this->uploadmsg(4);
			} elseif($upload->attach['size'] > $type['maxsize']) {
				$this->error_sizelimit = $type['maxsize'];
				$this->uploadmsg(5);
			}
		}

		if($upload->attach['size'] && $_G['group']['maxsizeperday']) {
			$todaysize = intval(DB::result_first("SELECT SUM(filesize) FROM ".DB::table('forum_attachment')." WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400"));
			$todaysize += $upload->attach['size'];
			if($todaysize >= $_G['group']['maxsizeperday']) {
				$this->error_sizelimit = 'perday|'.$_G['group']['maxsizeperday'];
				$this->uploadmsg(6);
			}
		}
		$watermark = $_G['gp_water'] == 'no' ? false : true;
		$upload->save(0, true, true, $watermark);
		if($upload->error() == -103) {
			$this->uploadmsg(8);
		} elseif($upload->error()) {
			$this->uploadmsg(9);
		}
        /*增加附件服务器的操作*/
        $serverid = isset($upload->attach['serverid']) ? $upload->attach['serverid'] : 0;
        /*结束*/
		$thumb = $remote = $width = 0;
		if($upload->attach['isimage']) {
            if($serverid > 0){
                $thumb = $upload->attach['thumb'];
                $width = $upload->attach['width'];
            }else{
                if($_G['setting']['thumbstatus']) {
    				require_once libfile('class/image');
    				$image = new image;
    				$thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['thumbwidth'], $_G['setting']['thumbheight'], $_G['setting']['thumbstatus'], $_G['setting']['thumbsource']) ? 1 : 0;
    				$width = $image->imginfo['width'];
    			}
    			if($_G['setting']['thumbsource'] || !$_G['setting']['thumbstatus']) {
    				list($width) = @getimagesize($upload->attach['target']);
    			}
            }
		}
		if($_G['gp_type'] != 'image' && $upload->attach['isimage']) {
			$upload->attach['isimage'] = -1;
		}
		$this->picname = $upload->attach['name'];
		DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
			VALUES ('0', '0', '$_G[timestamp]', '0', '0', '".$upload->attach['name']."', '".$upload->attach['type']."', '".$upload->attach['size']."', '".$upload->attach['attachment']."', '0', '".$upload->attach['isimage']."', '".$this->uid."', '$thumb', '$remote', '$width', $serverid, '$mtype')");
		$this->aid = DB::insert_id();
		$this->uploadmsg(0, $serverid);
	}

	function uploadmsg($statusid, $serverid = 0) {
		global $_G;
		if($this->simple == 1) {
			echo 'DISCUZUPLOAD|'.$statusid.'|'.$this->aid.'|'.$this->attach['isimage'];
		} elseif($this->simple == 2) {
			if(empty($this->error_sizelimit)) $this->error_sizelimit = 0;
			echo 'DISCUZUPLOAD|'.($_G['gp_type'] == 'image' ? '1' : '0').'|'.$statusid.'|'.$this->aid.'|'.$this->attach['isimage'].'|'.$this->attach['attachment'].($this->attach['serverid'] > 50 ? getUpYun(true, 200, 200, 1, 0, 1, true, $_G['config']['cdns']['ids'][$this->attach['serverid']]) : '').'|'.$this->attach['name'].'|'.$this->error_sizelimit;
		} else {
			if($_G['gp_operation'] == 'newupload'){
				$picname = str_replace('.', '', $this->picname);

				echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><uploadreturn><status>ok</status><picinfo><aid>{$this->aid}</aid><picdir>{$this->attach[attachment]}</picdir><pictype>{$this->mytype}</pictype><thumbpic>" . getimagethumb($_G['gp_twidth'], $_G['gp_theight'], 2, $this->mytype . '/' . $this->attach['attachment'], $this->aid, $serverid) . "</thumbpic><picname>{$picname}</picname></picinfo></uploadreturn>";
			}else{
				echo $this->aid;
			}
		}
		exit;
	}
}

?>
