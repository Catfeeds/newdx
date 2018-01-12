<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: portalcp_upload.php 17351 2010-10-11 05:03:55Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$operation = $_G['gp_op'] ? $_G['gp_op'] : '';
$_G['config']['cdns']['opend'] = true;
require_once libfile('class/upload');
$upload = new discuz_upload();
$downremotefile = false;
$aid = intval(getgpc('aid'));
$catid = intval(getgpc('catid'));
if($aid) {
	$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." WHERE aid='$aid'");
	if(!$article = DB::fetch($query)) {
		portal_upload_error(lang('portalcp', 'article_noexist'));
	}
	if(check_articleperm($catid, $aid, $article, false, true) !== true) {
		portal_upload_error(lang('portalcp', 'article_noallowed'));
	}
} else {
	if(check_articleperm($catid, $aid, null, false, true) !== true) {
		portal_upload_error(lang('portalcp', 'article_publish_noallowed'));
	}
}

if($operation == 'downremotefile') {
	$arrayimageurl = $temp = $imagereplace = array();
	$string = stripcslashes($_G['gp_content']);
	$downremotefile = true;
	preg_match_all("/\<img.+src=('|\"|)?(.*)(\\1)([\s].*)?\>/ismUe", $string, $temp, PREG_SET_ORDER);
	if(is_array($temp) && !empty($temp)) {
		foreach($temp as $tempvalue) {
			$tempvalue[2] = str_replace('\"', '', $tempvalue[2]);
			if(strlen($tempvalue[2])){
				$arrayimageurl[] = $tempvalue[2];
			}
		}
		$arrayimageurl = array_unique($arrayimageurl);
		if($arrayimageurl) {
			foreach($arrayimageurl as $tempvalue) {
				$imageurl = $tempvalue;
				$imagereplace['oldimageurl'][] = $imageurl;
				$attach['ext'] = $upload->fileext($imageurl);
				if(!$upload->is_image_ext($attach['ext'])) {
					continue;
				}
				$content = '';
				if(preg_match('/^(http:\/\/|\.)/i', $imageurl)) {
					$content = dfsockopen($imageurl);
				} elseif(checkperm('allowdownlocalimg')) {
					if(preg_match('/^data\/(.*?)\.thumb\.jpg$/i', $imageurl)) {
						$content = file_get_contents(substr($imageurl, 0, strrpos($imageurl, '.')-6));
					} elseif(preg_match('/^data\/(.*?)\.(jpg|jpeg|gif|png)$/i', $imageurl)) {
						$content = file_get_contents($imageurl);
					}
				}
				if(empty($content)) continue;
				$temp = explode('/', $imageurl);

				$attach['name'] =  trim($temp[count($temp)-1]);
				$attach['thumb'] = '';

				$attach['isimage'] = $upload -> is_image_ext($attach['ext']);
				$attach['extension'] = $upload -> get_target_extension($attach['ext']);
				$attach['attachdir'] = $upload -> get_target_dir('portal');
				$attach['attachment'] = $attach['attachdir'] . $upload->get_target_filename('portal').'.'.$attach['extension'];
				$attach['target'] = getglobal('setting/attachdir').'./portal/'.$attach['attachment'];

				if(!@$fp = fopen($attach['target'], 'wb')) {
					continue;
				} else {
					flock($fp, 2);
					fwrite($fp, $content);
					fclose($fp);
				}
				if(!$upload->get_image_info($attach['target'])) {
					@unlink($attach['target']);
					continue;
				}
				$attach['size'] = filesize($attach['target']);
				$attachs[] = daddslashes($attach);
			}
		}
	}
} elseif($operation == 'upyunlog') {
	//记录图片上传失败日志
	require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";
	$logs = new logs('article_upyun_fail');
	$reason = (array)json_decode(stripslashes($_G['gp_reason']));

	$reason['upyun_ip'] = $_G['gp_upyun_ip'];
	$reason['user_ip'] = $_G['gp_user_ip'];

	$reason['isp'] = iconv("UTF-8","GBK",$_G['gp_user_location']['isp']);
	$reason['b'] = iconv("UTF-8","GBK",$_G['gp_user_location']['province']);
	$reason['c'] = iconv("UTF-8","GBK",$_G['gp_user_location']['city']);

	$str = "uid: ".$_G['uid']." code:".$reason['code']." message:".$reason['message']."<br> user_ip:".$reason['user_ip']." upyun_ip:".$reason['upyun_ip']."<br> isp:".$reason['isp']."-".$reason['b']."-".$reason['c'];

	$logs->log_str($str);

} else {
	if(getgpc('code') == '200'){
		$attachment = getgpc('url');
		$fileext = addslashes(strtolower(substr(strrchr($attachment, '.'), 1, 10)));

		$setarr = array(
			'uid' => $_G['uid'],
			'filename' => iconv("UTF-8", "GBK", getgpc('filename')),
			'attachment' => str_replace("/portal/", "", $attachment),
			'filesize' => getgpc('filesize'),
			'isimage' => strstr(getgpc('type'), 'image') ? 1 : 0,
			'thumb' => 1,
			'remote' => 0,
			'filetype' => in_array($fileext, array('jpg', 'jpeg', 'gif', 'png', 'bmp')) ? $fileext : 'attach',
			'dateline' => $_G['timestamp'],
			'aid' => $aid,
			'serverid' => 99
		);

		$setarr['attachid'] = DB::insert("portal_attachment", $setarr, true);

		if($setarr['isimage']){
		$setarr['img_url'] = pic_get($setarr['attachment'], 'portal', $setarr['thumb'], $setarr['remote'], 0, $setarr['serverid'], false);
		$setarr['small_img_url'] = $setarr['thumb'] ? ($setarr['img_url'].'.thumb.jpg') : '';
		if($setarr['small_img_url'] && $setarr['serverid'] > 50){
			$setarr['small_img_url'] = preg_replace("/(!|_|-)(t\d+w\d+h\d+)?(x\d+m\d+)?/i", "!t1w140h140", $setarr['img_url']);
		}

		$setarr['setConver'] = addslashes(serialize(array('pic'=>$setarr['attachment'], 'thumb'=>$setarr['thumb'], 'remote'=>$setarr['remote'], 'serverid'=>$setarr['serverid'])));
		$setarr['setMConver'] = addslashes(serialize(array('pic'=>$setarr['attachment'], 'thumb'=>$setarr['thumb'], 'remote'=>$setarr['remote'], 'serverid'=>$setarr['serverid'])));

		$setarr['delete_url'] = 'portal.php?mod=attachment&id='.$setarr['attachid'].'&aid='.$aid.'&op=delete&isMpic='.$isMpic;
		}

		if($setarr['attachid']){
		$setarr['flag'] = 1;
		}

		echo json_encode( iconv_array($setarr) );die();
	}

//	$upload->init($_FILES['attach'], 'portal');
//	if(!$upload->error()) {
//	//add new cat 886 887 898 891 893 897 899 888 889 890 892 894 896 900 901 895 912
//		$needwater = in_array($catid, array(902,880,878,842,886,887,898,891,893,897,899,888,889,890,892,894,896,900,901,895,904,905,909,912)) ? false : true;
//
//		//装备文章缩略图不打水印
//		// $arrZb = array(204,207,208,209,211,212,214,215,216,218,219,220,222,223,792,906,907);
//		// $arrZb = array_flip($arrZb);
//		// if (isset($arrZb[$catid])) {
//		// 文章列表缩略图改为400*300的不加水印 2016.08.30
//			$arrInfo = getimagesize($upload->attach['tmp_name']);
//			if ($arrInfo[0] == 400 && $arrInfo[1] == 300) {
//				$needwater = false;
//			}
//		// }
//
//		$upload->save(0, true, false, $_G['config']['cdns']['opend'] === true ? $needwater : false);
//	}
//	if($upload->error()) {
//		portal_upload_error($upload->error());
//	}
//    $attach = $upload->attach;
//	$attachs[] = $attach;
}

if($attachs) {
/**读入附件服务器的信息**/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$allserverinfo = $attachserver->get_server_domain('all','*');
/**结束**/
	foreach($attachs as $attach) {
		if($attach['isimage'] && empty($_G['setting']['portalarticleimgthumbclosed'])) {
            $thumbimgwidth = $_G['setting']['portalarticleimgthumbwidth'] ? $_G['setting']['portalarticleimgthumbwidth'] : 300;
			$thumbimgheight = $_G['setting']['portalarticleimgthumbheight'] ? $_G['setting']['portalarticleimgthumbheight'] : 300;
            if(isset($attach['serverid']) && $attach['serverid']>0){
			/*此处使用*/
				$attach['thumb'] = $attachserver->Thumb($allserverinfo[$attach['serverid']]['domain'] , $allserverinfo[$attach['serverid']]['api'] , 'portal/'.$attach['attachment'] , 'portal/'.$attach['attachment'] . '.thumb.jpg' , $thumbimgwidth , $thumbimgheight , 2, 0, true) ? 1:0;
				if($needwater && ($attach['height'] >= $attachserver->get_watermark_args('portal', 'watermarkminheight') || $attach['width'] >= $attachserver->get_watermark_args('portal', 'watermarkminwidth'))){
					$attachserver->Watermark($allserverinfo[$attach['serverid']]['domain'] , $allserverinfo[$attach['serverid']]['api'] , 'portal/'.$attach['attachment'] , 'portal' , '', array('waterfile' => 'cmsshuibai', 'watermarkstatus' => 11));
					$attachserver->Watermark($allserverinfo[$attach['serverid']]['domain'] , $allserverinfo[$attach['serverid']]['api'] , 'portal/'.$attach['attachment'] , 'portal' , '', array('waterfile' => 'cmsshuihei', 'watermarkstatus' => 10));
				}
            }else{
				require_once libfile('class/image');
				$image = new image();

				$attach['thumb'] = $image->Thumb($attach['target'], '', $thumbimgwidth, $thumbimgheight, 2);
				$image->Watermark($attach['target'], '', 'portal');
			}
		}

		if(getglobal('setting/ftp/on') && ((!$_G['setting']['ftp']['allowedexts'] && !$_G['setting']['ftp']['disallowedexts']) || ($_G['setting']['ftp']['allowedexts'] && in_array($attach['ext'], $_G['setting']['ftp']['allowedexts'])) || ($_G['setting']['ftp']['disallowedexts'] && !in_array($attach['ext'], $_G['setting']['ftp']['disallowedexts']))) && (!$_G['setting']['ftp']['minsize'] || $attach['size'] >= $_G['setting']['ftp']['minsize'] * 1024)) {
			if(ftpcmd('upload', 'portal/'.$attach['attachment']) && (!$attach['thumb'] || ftpcmd('upload', 'portal/'.$attach['attachment'].'.thumb.jpg'))) {
				@unlink($_G['setting']['attachdir'].'/portal/'.$attach['attachment']);
				@unlink($_G['setting']['attachdir'].'/portal/'.$attach['attachment'].'.thumb.jpg');
				$attach['remote'] = 1;
			} else {
				if(getglobal('setting/ftp/mirror')) {
					@unlink($attach['target']);
					@unlink($attach['target'].'.thumb.jpg');
					portal_upload_error(lang('portalcp', 'upload_remote_failed'));
				}
			}
		}

		$setarr = array(
			'uid' => $_G['uid'],
			'filename' => $attach['name'],
			'attachment' => $attach['attachment'],
			'filesize' => $attach['size'],
			'isimage' => $attach['isimage'],
			'thumb' => $attach['thumb'],
			'remote' => $attach['remote'],
			'filetype' => $attach['extension'],
			'dateline' => $_G['timestamp'],
			'aid' => $aid,
            'serverid' => $attach['serverid']
		);
		$setarr['attachid'] = DB::insert("portal_attachment", $setarr, true);
		if( ! $needwater ){
			$setarr['nowater'] = true;
		}
		if($downremotefile) {
			$attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : ($attach['serverid']>0 ? "http://".$allserverinfo[$attach['serverid']]['name']."/" : $_G['setting']['attachurl'])).'portal/';
			$imagereplace['newimageurl'][] = $attach['url'].$attach['attachment'];
		}
		portal_upload_show($setarr);
	}
	if($downremotefile && $imagereplace) {
		$string = preg_replace(array("/\<(script|style|iframe)[^\>]*?\>.*?\<\/(\\1)\>/si", "/\<!*(--|doctype|html|head|meta|link|body)[^\>]*?\>/si"), '', $string);
		$string = str_replace($imagereplace['oldimageurl'], $imagereplace['newimageurl'], $string);
		$string = str_replace(array("\r", "\n", "\r\n"), '', addcslashes($string, '/"\\'));
		print <<<EOF
		<script type="text/javascript">
			var f = parent.window.frames["uchome-ifrHtmlEditor"].window.frames["HtmlEditor"];
			f.document.body.innerHTML = '$string';
		</script>
EOF;
	}
	exit();
}


function portal_upload_error($msg) {
	echo '<script>';
	echo 'if(parent.$(\'localfile_'.$_GET['attach_target_id'].'\') != null)parent.$(\'localfile_'.$_GET['attach_target_id'].'\').innerHTML = \''.lang('portalcp', 'upload_error').$msg.'\';else alert(\''.$msg.'\')';
	echo '</script>';
	exit();
}

function portal_upload_show($attach) {

	$imagehtml = $filehtml = '';

	if($attach['isimage']) {
		$imagehtml = get_uploadcontent($attach);
	} else {
		$filehtml = get_uploadcontent($attach);
	}

	echo '<script>';
	if($imagehtml) echo 'parent.$(\'attach_image_body\').innerHTML += \''.addslashes($imagehtml).'\';';
	if($filehtml) echo 'parent.$(\'attach_file_body\').innerHTML += \''.addslashes($filehtml).'\';';

//	echo 'if(parent.$(\'localfile_'.$_GET['attach_target_id'].'\') != null)parent.$(\'localfile_'.$_GET['attach_target_id'].'\').style.display = \'none\';';
	echo 'parent.$(\'attach_ids\').value += \','.$attach['attachid'].'\';';
	echo '</script>';
}

?>
