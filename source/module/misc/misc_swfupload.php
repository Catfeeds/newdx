<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: misc_swfupload.php 17148 2010-09-25 03:56:14Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$_G['gp_twidth'] = $_G['gp_twidth'] > 0 ? $_G['gp_twidth'] : 400;
$_G['gp_theight'] = $_G['gp_theight'] > 0 ? $_G['gp_theight'] : 300;
if($_G['gp_operation'] == 'config') {

	$swfhash = md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid']);
	$xmllang = lang('forum/swfupload');
	$imageexts = array('jpg','jpeg','gif','png','bmp');
	$forumattachextensions = '';
	if(!empty($_G['gp_fid'])) {
		$forum = DB::fetch_first("SELECT ff.attachextensions, f.status, f.level FROM ".DB::table('forum_forumfield')." ff LEFT JOIN ".DB::table('forum_forum')." f ON f.fid=ff.fid WHERE ff.fid='$_G[gp_fid]'");
        if($forum['status'] == 3 && $forum['level'] && $postpolicy = DB::result_first("SELECT postpolicy FROM ".DB::table('forum_grouplevel')." WHERE levelid='$forum[level]'")) {
			$postpolicy = unserialize($postpolicy);
			$forumattachextensions = $postpolicy['attachextensions'];
		} else {
			$forumattachextensions = $forum['attachextensions'];
		}
	}
	$_G['group']['attachextensions'] = !$forumattachextensions ? $_G['group']['attachextensions'] : $forumattachextensions;
	if($_G['group']['attachextensions'] !== '') {
		$_G['group']['attachextensions'] = str_replace(' ', '', $_G['group']['attachextensions']);
		$exts = explode(',', $_G['group']['attachextensions']);
		if($_G['gp_type'] == 'image') {
			$exts = array_intersect($imageexts, $exts);
		}
		$_G['group']['attachextensions'] = '*.'.implode(',*.', $exts);
	} else {
		$_G['group']['attachextensions'] = $_G['gp_type'] == 'image' ? '*.'.implode(',*.', $imageexts) : '*.*';
	}
	$depict = $_G['gp_type'] == 'image' ? 'Image File ' : 'All Support Formats ';
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><parameter><allowsExtend><extend depict=\"$depict\">{$_G[group][attachextensions]}</extend></allowsExtend><language>$xmllang</language><config><userid>$_G[uid]</userid><fid>$_G[gp_fid]</fid><hash>$swfhash</hash><maxupload>{$_G[group][maxattachsize]}</maxupload><thumbminsize>1000000</thumbminsize><maxsize>8000000</maxsize><uploadtype>{$_G[gp_type]}</uploadtype></config></parameter>";

} elseif($_G['gp_operation'] == 'upload') {
	require_once libfile('class/forumupload');
	if(empty($_G['gp_simple']) || ($_G['newtpl'] && $_G['gp_simple'] && mb_detect_encoding($_FILES['Filedata']['name'], array('ASCII', 'GBK2312', 'GBK', 'UTF-8'), true) == 'UTF-8')) {
		$_FILES['Filedata']['name'] = addslashes(diconv(urldecode($_FILES['Filedata']['name']), 'UTF-8'));
	}

	$upload = new forum_upload();

} elseif($_G['gp_operation'] == 'newconfig') {
	$swfhash = md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid']);
	$imageexts = array('jpg','jpeg','gif','png','bmp');
	$gpsexts = array('gpx', 'kml');
	$forumattachextensions = '';
	if(!empty($_G['gp_fid'])) {
		$forum = DB::fetch_first("SELECT ff.attachextensions, f.status, f.level FROM ".DB::table('forum_forumfield')." ff LEFT JOIN ".DB::table('forum_forum')." f ON f.fid=ff.fid WHERE ff.fid='$_G[gp_fid]'");
        if($forum['status'] == 3 && $forum['level'] && $postpolicy = DB::result_first("SELECT postpolicy FROM ".DB::table('forum_grouplevel')." WHERE levelid='$forum[level]'")) {
			$postpolicy = unserialize($postpolicy);
			$forumattachextensions = $postpolicy['attachextensions'];
		} else {
			$forumattachextensions = $forum['attachextensions'];
		}
	}
	$_G['group']['attachextensions'] = !$forumattachextensions ? $_G['group']['attachextensions'] : $forumattachextensions;
	if($_G['group']['attachextensions'] !== '') {
		$_G['group']['attachextensions'] = str_replace(' ', '', $_G['group']['attachextensions']);
		$exts = explode(',', $_G['group']['attachextensions']);
		if($_G['gp_type'] == 'image') {
			$exts = array_intersect($imageexts, $exts);
		}
		$_G['group']['attachextensions'] = '*.'.implode(',*.', $exts);
	} else {
		$_G['group']['attachextensions'] = $_G['gp_type'] == 'image' ? '*.'.implode(',*.', $imageexts) : '*.*';
	}
	$fileextensions = $_G['group']['attachextensions'];
	
	$_fengmian = isset($_G['gp_head']) && $_G['gp_head'] == 1 ? true : false;
	if ($_fengmian) {
		$xmllang = lang('forum/newswfupload_head');
	} elseif ($_G['gp_tipbg']) {
		$xmllang = lang('forum/newswfupload_tipbg');
	} else {		
		$xmllang = lang('forum/newswfupload');
	}
	
	$maxheight = $_G['setting']['thumbheight'];
	$maxwidth = $_G['setting']['thumbwidth'];
	$quality = $_G['setting']['thumbquality'];
	$maxfileuploadnumber = 50;
	switch($_G['gp_type']){
		case 'image':
			$depict = 'Image File ';
			if($_fengmian){
				$maxfileuploadnumber = 1;
			}
			break;
		case 'gps':
			$depict = 'Gps File';
			$fileextensions = '*.'.implode(',*.', $gpsexts);
			$maxfileuploadnumber = 1;
			break;
		default:
			$depict = 'All Support Formats ';
			break;
	}
	$callback = isset($_G['gp_back']) ? trim($_G['gp_back']) : 'uploadsuccess';
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><parameter><allowsExtend><extend>{$fileextensions}</extend><suports>{$depict}</suports></allowsExtend><config><userid>{$_G[uid]}</userid><fid>{$_G[gp_fid]}</fid><hash>{$swfhash}</hash><maxupload>{$_G[group][maxattachsize]}</maxupload><uploadtype>{$_G[gp_type]}</uploadtype><quality>{$quality}</quality><maxwidth>{$maxwidth}</maxwidth><maxheight>{$maxheight}</maxheight><back>{$callback}</back><ifthumb>" . ($_G['config']['cdns']['opend'] === true ? "0" : "1") . "</ifthumb><errorcontinue>0</errorcontinue><loginurl>{$_G[config][web][forum]}member.php?mod=logging&action=login</loginurl><thumbminsize>200000</thumbminsize><process><showthumb>0</showthumb><showupload>0</showupload/><showfilenum>0</showfilenum></process><maxfileuploadnumber>{$maxfileuploadnumber}</maxfileuploadnumber><uploadsession>5</uploadsession></config><language>{$xmllang}</language></parameter>";
} elseif($_G['gp_operation'] == 'newupload') {
	$filename = $_G['gp_source']==1 ? null : date('His').strtolower(random(16));
    $swfhash = md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['gp_uid']);
    if($_G['gp_uid'] == 35732735){
    	$_G['config']['cdns']['opend'] = true;
    }
    if($swfhash != $_G['gp_hash']){
        // file_put_contents(DISCUZ_ROOT.'./newmisc.log' ,'错误' ,FILE_APPEND);
    }
    if($_G['gp_type'] == 'gps'){
    	if ( isset( $_FILES ) && ! empty( $_FILES ) )
		{
			$xmlstring = file_get_contents( $_FILES['Filedata']['tmp_name'] );
			$xml = simplexml_load_string( $xmlstring );
			$json = json_encode( $xml );
			$array = json_decode( $json, true );
			$type = strtolower( substr( $_FILES['Filedata']['name'], strrpos( $_FILES['Filedata']['name'], '.' ) + 1 ) );
			$lxname = iconv( 'utf-8', 'gbk', $_FILES['Filedata']['name'] );
			require_once DISCUZ_ROOT . './source/plugin/attachment_server/attachment_server.class.php';
			$attachserver = new attachserver;
			$servers_arr = $attachserver->get_server();
			/*此处需要将gpx上传至服务器保存*/
			$savefilename = date( 'His' ) . strtolower( random( 8 ) ) . '.attach';
			$dir = date('Ym').'/'.date('d').'/';
			$uploadargs = array(
					'classname' => 'xianlu',
					'dir' => 'plugin/' . $dir,
					'attachment' => 'plugin/' . $dir . $savefilename,
					'replace' => true,
					'lxtype' => $type,
					'method' => 'ver_file',
					);
			require_once libfile( 'class/sockpost' );
			$return = sockpost::post( $_FILES['Filedata']['tmp_name'], $servers_arr['domain'], $servers_arr['api'], $savefilename, $type, $uploadargs, array());
			if($return['save'] && $return['classreturn']['others']['save']){
				$kmlfile = $return['classreturn']['others']['kmlfile'];
				require_once libfile( 'class/gpxtokml' );
				$gpxtokml = new gpxtokml();
				switch ( $type )
				{
					case 'kml':
						#此处为kml处理#
						$gpxtokml->lat_max = $return['classreturn']['info']['lat_max'];
						$gpxtokml->lat_min = $return['classreturn']['info']['lat_min'];
						$gpxtokml->lon_max = $return['classreturn']['info']['lon_max'];
						$gpxtokml->lon_min = $return['classreturn']['info']['lon_min'];
						$gpxtokml->_loadCitys();
						break;
					case 'gpx':
						##此处为gpx处理##
						$gpxtokml->load($array);
						break;
				}
				$gpsdata = array(
						'filename' => $lxname,
						'filetype' => $type,
						'filesize' => $return['classreturn']['filesize'],
						'attachment' => $dir . $savefilename,
						'serverid' => $servers_arr['serverid'],
						'dir' => 'plugin',
						'uid' => $_G['gp_uid'],
						'dateline' => $_G['timestamp'],
						'citys' => serialize($gpxtokml->citys),
						'latmax' => $return['classreturn']['info']['lat_max'],
						'latmin' => $return['classreturn']['info']['lat_min'],
						'lonmax' => $return['classreturn']['info']['lon_max'],
						'lonmin' => $return['classreturn']['info']['lon_min'],
						'timestart' => strtotime($return['classreturn']['info']['time_start']),
						'timeend' => strtotime($return['classreturn']['info']['time_end']),
						'speedmax' => $return['classreturn']['info']['speed_max'],
						'speedmin' => $return['classreturn']['info']['speed_min'],
						'elemax' => $return['classreturn']['info']['ele_max'],
						'elemin' => $return['classreturn']['info']['ele_min'],
						'kmlfile' => $kmlfile,
						'area' => $return['classreturn']['info']['area'],
						'htmlfiledir' => $return['classreturn']['html']['save'] ? $return['classreturn']['html']['dir'] : '',
						'htmlfilename' => $return['classreturn']['html']['save'] ? $return['classreturn']['html']['file'] : '',
						);
				$kaid = DB::insert('dianping_line_gpsattachment', $gpsdata, true);
			}
			$htmlmap = $return['classreturn']['html']['dir'] . $return['classreturn']['html']['file'];
			echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><uploadreturn><status>ok</status><picinfo><aid>$kaid</aid><picdir>$htmlmap</picdir><pictype>{$type}</pictype></picinfo></uploadreturn>";
			//exit('<pre>' . var_export($return, true));

		}
		exit;
    }
	$mtype = in_array($_G['gp_mtype'], array('plugin', 'forum', 'portal')) ? $_G['gp_mtype'] : 'forum';
	if(!empty($_FILES['Filedata'])){
        /*文件形式传输*/
        $_FILES['Filedata']['name'] = iconv('utf-8', 'gbk', $_FILES['Filedata']['name']);
        $swfhash = md5($swfhash.md5($_FILES['Filedata']['name']).$_G['gp_filekey']);
        if($_G['gp_source']==1){
            require_once libfile('class/upload');
            $upload = new discuz_upload();
    		$upload->init($_FILES['Filedata'], $mtype);
            if(!$upload->error()) {
    			if($upload->save(0 ,false ,false ,false)){
                    require_once libfile('class/myredis');
                    $redis = & myredis::instance(6382);
                    $thumbargs = $redis->hashget('THUMB_WAITTING_HASH' ,$swfhash);
                    if($thumbargs){
                        $thumbargs = json_decode($thumbargs ,true);
                        $thumbargs['source'] = $mtype.'/'.$upload->attach['attachment'];
                        $thumbargs['width'] = $_G['setting']['thumbwidth'];
                        $thumbargs['height'] = $_G['setting']['thumbheight'];
                        $thumbargs['quality'] = $_G['setting']['thumbquality'];
                        if($_G['gp_fid']!=443 && $mtype != 'plugin' && $_G['gp_water'] !== 'no')
						{
							$watermarktrans = unserialize($_G['setting']['watermarktrans']);
							$watermarkstatus = unserialize($_G['setting']['watermarkstatus']);
							$watermarkquality = unserialize($_G['setting']['watermarkquality']);
							$thumbargs['watermarktype'] = $_G['setting']['watermarktype']['forum'];
							$thumbargs['watermarktrans'] = $watermarktrans['forum'];
							$thumbargs['watermarkstatus'] = $watermarkstatus['forum'];
							$thumbargs['watermarkquality'] = $watermarkquality['forum'];
						}
                        $redis->RPUSH('THUMB_WATTING_LIST_QUEUE' ,json_encode($thumbargs));
                        $redis->hashdel('THUMB_WAITTING_HASH' ,$swfhash);
                        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><uploadreturn><status>ok</status><picinfo><aid>0</aid><picdir>{$thumbargs['source']}</picdir></picinfo></uploadreturn>";
                    }
    			}
    		}
        }else{
            require_once libfile('class/forumupload');
    		$upload = new forum_upload($mtype);
        }
	}else{
	   /**
        * 二进制流形式传输
        */
		$savefilename = date('His').strtolower(random(16)).'.jpg';
        if(empty($GLOBALS['HTTP_RAW_POST_DATA'])) $GLOBALS['HTTP_RAW_POST_DATA'] = file_get_contents("php://input");
		require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
        $attachserver = new attachserver;
        $servers_arr = $attachserver->get_server();
        require_once libfile('class/sockpost');
		$dir = date('Ym').'/'.date('d').'/';
		$args = array(
					'classname' => 'discuz',
					'dir' => $mtype.'/'.$dir,
					'attachment' => $mtype.'/'.$dir.$savefilename,
					'replace' => true,
					'method' => 'ver_file',
            );
		$return = sockpost::post($GLOBALS['HTTP_RAW_POST_DATA'] ,$servers_arr['domain'] ,$servers_arr['api'] ,$savefilename ,'image/jpeg' ,$args ,array() ,false);
		$attachment = $return['save'] ? $dir.$savefilename : false;
		if($attachment!==false)
        {
            DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
			VALUES ('0', '0', '$_G[timestamp]', '0', '0', '".$_G['gp_filename']."', 'image/jpeg', '".intval($_G['gp_ssize'])."', '".$attachment."', '0', '1', '".$_G['gp_uid']."', '0', '0', '".intval($_G['gp_swidth'])."', '{$servers_arr[serverid]}', '{$mtype}')");
            $aid = DB::insert_id();
            $swfhash = md5($swfhash.md5($_G['gp_filename']).$_G['gp_filekey']);
            require_once libfile('class/myredis');
            $redis = & myredis::instance(6382);
            $redis->hashset('THUMB_WAITTING_HASH' ,$swfhash ,json_encode(array('time' => time() ,'target' => $mtype.'/'.$attachment)));
            $picnamediv = str_replace('.', '', $_G['gp_filename']);
            echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><uploadreturn><status>ok</status><picinfo><aid>$aid</aid><picdir>{$attachment}</picdir><pictype>{$mtype}</pictype><thumbpic>" . getimagethumb($_G['gp_twidth'], $_G['gp_theight'], 2, $mtype . '/' . $attachment, $aid, $servers_arr['serverid']) . "</thumbpic><picname>{$picnamediv}</picname></picinfo></uploadreturn>";
        }
	}
} elseif($_G['gp_operation'] == 'upyunform') {
	//upyun的form上传 add by zhangwenchu 20170111
	$filesize = intval($_G['gp_filesize']);
	if($filesize && $_G['gp_url'] && $_G['uid']){

		$raw = (array)json_decode(stripslashes($_G['gp_raw']));
		$filename = iconv("UTF-8","GBK",$_G['gp_filename']);

		$width = intval($raw['image-width']);

		$attachment = str_replace("/forum/", "", $_G['gp_url']);
		DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
			VALUES ('0', '0', '$_G[timestamp]', '0', '0', '".$filename."', '".$raw['mimetype']."', '".$filesize."', '".$attachment."', '0', '1', '".$_G['uid']."', '0', '0', '".$width."', '99', 'forum')");
		$aid = DB::insert_id();
		echo json_encode(array('flag'=>1, 'aid'=>$aid));die();
	}else{
		echo json_encode(array('flag'=>0, 'aid'=>""));die();
	}

} elseif($_G['gp_operation'] == 'upyunformlog') {
	// upyun的form上传，记录log
	require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";
	if($_G['gp_flag']){
		$logs = new logs('upyun_form_succ');
		$reason = (array)json_decode(stripslashes($_G['gp_reason']));

		$str = "";
		if($_G['gp_noFenlou']){
			$str .= "普通发帖：<br>";
		}
		$str .= "img_url:".$reason['url']." <br> img_size:".$reason['file_size'];
		$logs->log_str($str);
	}else{
		if($_G['gp_huodong'] == '1'){
			$logs = new logs('huodong_upyun_fail');
		}else{
			$logs = new logs('upyun_form_fail');
		}

		$reason = (array)json_decode(stripslashes($_G['gp_reason']));

		$reason['upyun_ip'] = $_G['gp_upyun_ip'];
		$reason['user_ip'] = $_G['gp_user_ip'];

		$reason['isp'] = iconv("UTF-8","GBK",$_G['gp_user_location']['isp']);
		$reason['b'] = iconv("UTF-8","GBK",$_G['gp_user_location']['province']);
		$reason['c'] = iconv("UTF-8","GBK",$_G['gp_user_location']['city']);

		$str = "";
		if($_G['gp_noFenlou']){
			$str .= "普通发帖：<br>";
		}

		$str .= "uid: ".$_G['uid']." code:".$reason['code']." message:".$reason['message']."<br> user_ip:".$reason['user_ip']." upyun_ip:".$reason['upyun_ip']."<br> isp:".$reason['isp']."-".$reason['b']."-".$reason['c'];
		unset($reason);

		$logs->log_str($str);

	}


} elseif($_G['gp_operation'] == 'upyunalbumlog') {
	// 相册传图，记录log
	require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";

	$logs = new logs('upyun_album_fail');

	$reason = (array)json_decode(stripslashes($_G['gp_reason']));

	$reason['upyun_ip'] = $_G['gp_upyun_ip'];
	$reason['user_ip'] = $_G['gp_user_ip'];

	$reason['isp'] = iconv("UTF-8","GBK",$_G['gp_user_location']['isp']);
	$reason['b'] = iconv("UTF-8","GBK",$_G['gp_user_location']['province']);
	$reason['c'] = iconv("UTF-8","GBK",$_G['gp_user_location']['city']);

	$str = "";
	if($_G['gp_noFenlou']){
		$str .= "普通发帖：<br>";
	}

	$str .= "uid: ".$_G['uid']." code:".$reason['code']." message:".$reason['message']."<br> user_ip:".$reason['user_ip']." upyun_ip:".$reason['upyun_ip']."<br> isp:".$reason['isp']."-".$reason['b']."-".$reason['c'];
	unset($reason);

	$logs->log_str($str);




}
?>
