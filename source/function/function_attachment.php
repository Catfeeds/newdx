<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_attachment.php 16751 2010-09-14 05:16:45Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

/**
* 获取附件类型
* @param $type - 类型
* @param $returnval - html 返回图像代码,否则返回类型id
* @return 返回数据
*/
function attachtype($type, $returnval = 'html') {

	static $attachicons = array(
			1 => 'unknown.gif',
			2 => 'binary.gif',
			3 => 'zip.gif',
			4 => 'rar.gif',
			5 => 'msoffice.gif',
			6 => 'text.gif',
			7 => 'html.gif',
			8 => 'real.gif',
			9 => 'av.gif',
			10 => 'flash.gif',
			11 => 'image.gif',
			12 => 'pdf.gif',
			13 => 'torrent.gif'
		);

	//note 如果是数字类型的就返回数字,否则匹配出类型
	if(is_numeric($type)) {
		$typeid = $type;
	} else {
		if(preg_match("/bittorrent|^torrent\t/", $type)) {
			$typeid = 13;
		} elseif(preg_match("/pdf|^pdf\t/", $type)) {
			$typeid = 12;
		} elseif(preg_match("/image|^(jpg|gif|png|bmp)\t/", $type)) {
			$typeid = 11;
		} elseif(preg_match("/flash|^(swf|fla|flv|swi)\t/", $type)) {
			$typeid = 10;
		} elseif(preg_match("/audio|video|^(wav|mid|mp3|m3u|wma|asf|asx|vqf|mpg|mpeg|avi|wmv)\t/", $type)) {
			$typeid = 9;
		} elseif(preg_match("/real|^(ra|rm|rv)\t/", $type)) {
			$typeid = 8;
		} elseif(preg_match("/htm|^(php|js|pl|cgi|asp)\t/", $type)) {
			$typeid = 7;
		} elseif(preg_match("/text|^(txt|rtf|wri|chm)\t/", $type)) {
			$typeid = 6;
		} elseif(preg_match("/word|powerpoint|^(doc|ppt)\t/", $type)) {
			$typeid = 5;
		} elseif(preg_match("/^rar\t/", $type)) {
			$typeid = 4;
		} elseif(preg_match("/compressed|^(zip|arj|arc|cab|lzh|lha|tar|gz)\t/", $type)) {
			$typeid = 3;
		} elseif(preg_match("/octet-stream|^(exe|com|bat|dll)\t/", $type)) {
			$typeid = 2;
		} elseif($type) {
			$typeid = 1;
		} else {
			$typeid = 0;
		}
	}
	//note 返回代码或者ID
	if($returnval == 'html') {
		return '<img src="http://static.8264.com/static/image/filetype/'.$attachicons[$typeid].'" border="0" class="vm" alt="" />';
	} elseif($returnval == 'id') {
		return $typeid;
	}
}

//debug 处理附件
function parseattach($attachpids, $attachtags, &$postlist, $skipaids = array()) {
	global $_G;

	// $query = DB::query("SELECT a.*, af.description, l.relatedid AS payed
		// FROM ".DB::table('forum_attachment')." a
		// LEFT JOIN ".DB::table('forum_attachmentfield')." af ON a.aid=af.aid
		// LEFT JOIN ".DB::table('common_credit_log')." l ON l.relatedid=a.aid AND l.uid='$_G[uid]' AND l.operation='BAC'
		// WHERE a.pid IN ($attachpids)");
	$pid_array = explode(',', $attachpids);
	$needselect = array();
	foreach($pid_array as $pid){
		if($pid > 0){
			$tmpattachs[$pid] = memory('get', 'attach_cache_pid_'.$pid);
			if(!$tmpattachs[$pid] || $_G['uid']==1){
				$needselect[$pid] = array();
			}else{
                //echo '<pre>'.$pid.'='.var_export($tmpattachs[$pid], true).'</pre>';
                if(is_array($tmpattachs[$pid])){
                    foreach($tmpattachs[$pid] as $tmp){
                        $attachs[] = $tmp;
                    }
                }
			}
		}
	}
	
	if(!empty($needselect)){
		$needselect_str = implode(',', array_keys($needselect));
        //echo '<p>需要查询PID：'.$needselect_str.'</p>';
        $query = DB::query("SELECT a.*, af.description
			FROM ".DB::table('forum_attachment')." a
			LEFT JOIN ".DB::table('forum_attachmentfield')." af ON a.aid=af.aid
			WHERE a.pid IN ($needselect_str)");
        
        while($value = DB::fetch($query)){
            $attachs[] = $value;
            $needselect[$value['pid']][] = $value;
        }
        foreach($needselect as $hpid => $value){
            memory('set', 'attach_cache_pid_'.$hpid,!empty($value) ? $value : 'nullattach', 60*60*24);
        }
	}
	// $query = DB::query("SELECT a.*, l.relatedid AS payed
		// FROM ".DB::table('forum_attachment')." a
		// LEFT JOIN ".DB::table('common_credit_log')." l ON l.relatedid=a.aid AND l.uid='$_G[uid]' AND l.operation='BAC'
		// WHERE a.pid IN ($attachpids)");

	$attachexists = FALSE;
	$skipattachcode = array();
	require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
    $attach_server = new attachserver;
    $alldomaininfo = $attach_server->get_server_domain( 'all', '*' );
	foreach($attachs as $attach){
	//while($attach = DB::fetch($query)) {
		$attachexists = TRUE;
		if($skipaids && in_array($attach['aid'], $skipaids)) {
			$skipattachcode[$attach[pid]][] = "/\[attach\]$attach[aid]\[\/attach\]/i";
			continue;
		}
		$attached = 0;
		$extension = strtolower(fileext($attach['filename']));
		$attach['ext'] = $extension;
		$attach['imgalt'] = $attach['isimage'] ? strip_tags(str_replace('"', '\"', $attach['description'] ? $attach['description'] : $attach['filename'])) : '';
		$attach['attachicon'] = attachtype($extension."\t".$attach['filetype']);
		$attach['attachsize'] = sizecount($attach['filesize']);
		$attach['attachimg'] = $_G['setting']['attachimgpost'] && $attach['isimage'] && (!$attach['readperm'] || $_G['group']['readaccess'] >= $attach['readperm']) ? 1 : 0;
		if($attach['price']) {
			if($_G['setting']['maxchargespan'] && TIMESTAMP - $attach['dateline'] >= $_G['setting']['maxchargespan'] * 3600) {
				DB::query("UPDATE ".DB::table('forum_attachment')." SET price='0' WHERE aid='$attach[aid]'");
				$attach['price'] = 0;
			} else {
				if(!$_G['uid'] || (!$_G['forum']['ismoderator'] && $attach['uid'] != $_G['uid'] && !$attach['payed'])) {
					$attach['unpayed'] = 1;
				}
			}
		}

		$attach['payed'] = $attach['payed'] || $_G['forum_attachmentdown'] || $_G['uid'] == $attach['uid'] ? 1 : 0;
		//debug
		$attach['payed'] = 1;
		$attach['url'] = ($attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl']).'forum/';
        /*增加附件服务器的判定*/
        if($attach['serverid']>0){
            $attach['url'] = "http://".$alldomaininfo[$attach['serverid']]['name']."/forum/";
            /*此处做修改，因论坛现有页面限制宽度825px，而如果读1500px的图片会增加很大的流量，此处将做优化，增加一个thumbattachment的索引，页面展示使用缩略的！！此处只针对CDN！！*/
            $attach['thumbattachment'] = $attach['attachment'] . attachserver::getPreStr($alldomaininfo[$attach['serverid']], 'thumbforum', true, ($_G['fid'] == 443 || $attach['width'] <= 300) ? false : true);
            $attach['attachment'] .= attachserver::getPreStr($alldomaininfo[$attach['serverid']], 'forum', true, $_G['fid'] == 443 ? false : true);
        }
        /*结束*/
		$attach['dateline'] = dgmdate($attach['dateline'], 'u');
		$postlist[$attach['pid']]['attachments'][$attach['aid']] = $attach;
		if(!empty($attachtags[$attach['pid']]) && is_array($attachtags[$attach['pid']]) && in_array($attach['aid'], $attachtags[$attach['pid']])) {
			$findattach[$attach['pid']][] = "/\[attach\]$attach[aid]\[\/attach\]/i";
			$replaceattach[$attach['pid']][] = attachtag($attach['pid'], $attach['aid'], $postlist);
			$attached = 1;
		}

		if(!$attached) {
			if($attach['isimage']) {
				$postlist[$attach['pid']]['imagelist'] .= attachlist($attach,$postlist[$attach['pid']]['first']);
			} else {
				if(!$_G['forum_skipaidlist'] || !in_array($attach['aid'], $_G['forum_skipaidlist'])) {
					$postlist[$attach['pid']]['attachlist'] .= attachlist($attach,$postlist[$attach['pid']]['first']);
				}
			}
		}
    }
	if(!empty($skipattachcode)) {
		foreach($skipattachcode as $pid => $findskipattach) {
			foreach($findskipattach as $findskip) {
				$postlist[$pid]['message'] = preg_replace($findskip, '', $postlist[$pid]['message']);
			}
		}
	}
	
	if($attachexists) {
		foreach($attachtags as $pid => $aids) {
			if($findattach[$pid]) {
				$postlist[$pid]['message'] = preg_replace($findattach[$pid], $replaceattach[$pid], $postlist[$pid]['message'], 1);
				$postlist[$pid]['message'] = preg_replace($findattach[$pid], '', $postlist[$pid]['message']);
			}
		}
	} else {
		updatepost(array('attachment' => '0'), "pid IN ($attachpids)", true);
	}
}

function attachwidth($width,$pid=0,$bigpic = '') {
	global $_G , $img_pid;
	//有修改 20110913 限定未登录时，附件图片的显示大小(2011 12 7二次修改)
	$addarg = '';
    if($_G['fid']==$_G['config']['fids']['zbfx']){
		//at 20120215 modfiy by zhanghongliang
		if($width<680){
			$width=$width;
		}else{
			$width=680;
			$addarg = ' width="'.$width.'" ';
		}
	}else{
		@include_once DISCUZ_ROOT.'./source/plugin/forumoption/include.php';
		global $forumOption;
		if (!$_G['uid'] && $forumOption && $forumOption->getSetting('isSmallPic')) {
			return 'width=80';
		}
	}

	if($_G['setting']['imagemaxwidth'] && $width) {
		//return 'width="'.($width > $_G['setting']['imagemaxwidth'] ? $_G['setting']['imagemaxwidth'].(!defined('IN_MOBILE') ? '" class="zoom" onclick="zoom(this, this.src)"': '') : $width.'"');
		return $addarg.(!defined('IN_MOBILE') ? ' class="zoom" onclick="zoom(this, '.($bigpic ? "'{$bigpic}'" : 'this.src').')"': '').(!$_G['uid'] ? ' width="'.($width > $_G['setting']['imagemaxwidth'] ? $_G['setting']['imagemaxwidth'] : $width).'"' : '');
		//return (!defined('IN_MOBILE') ? ' class="zoom" onclick="zoom(this, this.src)"': '').' origenwidth = '.$width.' onload="fixpicwidth(this,'.$width.','.$_G['setting']['imagemaxwidth'].',postmessage_'.$img_pid.')"';
	} else {
		return 'thumbImg="1"';
	}
}

?>
