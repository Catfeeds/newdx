<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_space.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function getuserdefaultdiy() {
	$defaultdiy = array(
			'currentlayout' => '1:2:1',
			'block' => array(
					'frame`frame1' => array(
							'attr' => array('name'=>'frame1'),
							'column`frame1_left' => array(
									'block`profile' => array('attr' => array('name'=>'profile')),
									'block`statistic' => array('attr' => array('name'=>'statistic')),
									'block`album' => array('attr' => array('name'=>'album')),
									'block`doing' => array('attr' => array('name'=>'doing'))
							),
							'column`frame1_center' => array(
									'block`feed' => array('attr' => array('name'=>'feed')),
									'block`share' => array('attr' => array('name'=>'share')),
									'block`blog' => array('attr' => array('name'=>'blog')),
									'block`thread' => array('attr' => array('name'=>'thread')),
									'block`wall' => array('attr' => array('name'=>'wall'))
							),
							'column`frame1_right' => array(
									'block`friend' => array('attr' => array('name'=>'friend')),
									'block`visitor' => array('attr' => array('name'=>'visitor')),
									'block`group' => array('attr' => array('name'=>'group'))
							)
					)
			),
			'parameters' => array(
					'blog' => array('showmessage' => true, 'shownum' => 6),
					'doing' => array('shownum' => 15),
					'album' => array('shownum' => 8),
					'thread' => array('shownum' => 10),
					'share' => array('shownum' => 10),
					'friend' => array('shownum' => 18),
					'group' => array('shownum' => 12),
					'visitor' => array('shownum' => 18),
					'wall' => array('shownum' => 16),
					'feed' => array('shownum' => 16)
			)
	);
	return $defaultdiy;
}

function getuserdiydata($space) {
	$userdiy = getuserdefaultdiy();
	if (!empty($space['blockposition'])) {
		$blockdata = unserialize($space['blockposition']);
		foreach ((array)$blockdata as $key => $value) {
			if ($key == 'parameters') {
				foreach ((array)$value as $k=>$v) {
					if (!empty($v)) $userdiy[$key][$k] = $v;
				}
			} else {
				if (!empty($value)) $userdiy[$key] = $value;
			}
		}
	}
	return $userdiy;
}

function mkfeedhtml($value) {
	global $_G;

	$html = '';
	$html .= "<li class=\"cl $value[magic_class]\" id=\"feed_{$value[feedid]}_li\">";
	$html .= "<div class=\"cl\" {$value[style]}>";
	$html .= "<a class=\"t\" href=\"home.php?mod=space&uid=$_GET[uid]&do=home&view=$_GET[view]&appid=$value[appid]&icon=$value[icon]\" title=\"".lang('space', 'feed_view_only')."\"><img src=\"$value[icon_image]\" /></a>$value[title_template]";
	$html .= "\t<span class=\"xg1\">".dgmdate($value[dateline], 'n-j H:i')."</span>";

	$html .= "<div class=\"ec\">";

	if ($value['image_1']) {
		$html .= "<a href=\"$value[image_1_link]\"{$value[target]}><img src=\"$value[image_1]\" alt=\"\" class=\"tn\" /></a>";
	}
	if ($value['image_2']) {
		$html .= "<a href=\"$value[image_2_link]\"{$value[target]}><img src=\"$value[image_2]\" alt=\"\" class=\"tn\" /></a>";
	}
	if ($value['image_3']) {
		$html .= "<a href=\"$value[image_3_link]\"{$value[target]}><img src=\"$value[image_3]\" alt=\"\" class=\"tn\" /></a>";
	}
	if ($value['image_4']) {
		$html .= "<a href=\"$value[image_4_link]\"{$value[target]}><img src=\"$value[image_4]\" alt=\"\" class=\"tn\" /></a>";
	}

	if ($value['body_template']) {
		$style = $value['image_3'] ? ' style="clear: both; zoom: 1;"' : '';
		$html .= "<div class=\"d\" $style>$value[body_template]</div>";
	}

	if (!empty($value['body_data']['flashvar'])) {
		if(!empty($value['body_data']['imgurl'])) {
			$html .= '<table class="mtm" title="'.lang('space', 'click_play').'" onclick="javascript:showFlash(\''.$value['body_data']['host'].'\', \''.$value['body_data']['flashvar'].'\', this, \''.$value['sid'].'\');"><tr><td class="vdtn hm" style="background: url('.$value['body_data']['imgurl'].') no-repeat"><img src="http://static.8264.com/static/image/common/vds.png" alt="'.lang('space', 'click_play').'" /></td></tr></table>';
		} else {
			$html .= "<img src=\"http://static.8264.com/static/image/common/vd.gif\" alt=\"".lang('space', 'click_play')."\" onclick=\"javascript:showFlash('{$value['body_data']['host']}', '{$value['body_data']['flashvar']}', this, '{$value['sid']}');\" class=\"tn\" />";
		}
	}elseif (!empty($value['body_data']['musicvar'])) {
		$html .= "<img src=\"http://static.8264.com/static/image/common/music.gif\" alt=\"".lang('space', 'click_play')."\" onclick=\"javascript:showFlash('music', '{$value['body_data']['musicvar']}', this, '{$value['feedid']}');\" class=\"tn\" />";
	}elseif (!empty($value['body_data']['flashaddr'])) {
		$html .= "<img src=\"http://static.8264.com/static/image/common/flash.gif\" alt=\"".lang('space', 'click_view')."\" onclick=\"javascript:showFlash('flash', '{$value['body_data']['flashaddr']}', this, '{$value['feedid']}');\" class=\"tn\" />";
	}

	if ($value['body_general']) {
		$classname = $value['image_1'] ? ' z' : '';
		$html .= "<div class=\"quote$classname\"><blockquote>$value[body_general]</blockquote></div>";
	}
	$html .= "</div>";
	$html .= "</div>";
	$html .= "</li>";
	return $html;
}

function &getlayout($layout='') {
	$layoutarr = array(
			'1:2:1' => array('240', '480', '240'),
			'1:1:2' => array('240', '240', '480'),
			'2:1:1' => array('480', '240', '240'),
			'2:2' => array('480', '480'),
			'1:3' => array('240', '720'),
			'3:1' => array('720', '240'),
			'1:4' => array('190', '770'),
			'4:1' => array('770', '190'),
			'2:2:1' => array('385', '385', '190'),
			'1:2:2' => array('190', '385', '385'),
			'1:1:3' => array('190', '190', '570'),
			'1:3:1' => array('190', '570', '190'),
			'3:1:1' => array('570', '190', '190'),
			'3:2' => array('575', '385'),
			'2:3' => array('385', '575')
	);

	if (!empty($layout)) {
		$rt = (isset($layoutarr[$layout])) ? $layoutarr[$layout] : false;
	} else {
		$rt = $layoutarr;
	}

	return $rt;
}

function getblockdata($blockname = '') {
	$blockarr = lang('space', 'blockdata');
	$r = empty($blockname) ? $blockarr : (isset($blockarr[$blockname]) ? $blockarr[$blockname] : false);
	return $r;
}

//������ʾ���ݵĸ�ʽ��,������Ҫ�����Ķ�--�ο�module/wap/forumIndex.ctl.php
function space_viewthread_procpost($post) {
	global $_G;

	require_once libfile('function/discuzcode');
	require_once libfile('function/attachment');

	$post['attachments'] = array();
	$post['imagelist'] = $post['attachlist'] = '';

	//ֻ������ͼƬ������
	$post['message'] = preg_replace("/\[swf\]\s*([^\[\<\r\n]+?)\s*\[\/swf\]/ies", "", $post['message']);
	$post['message'] = preg_replace("/\[media=([\w,]+)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/ies", "", $post['message']);

	$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], $post['htmlon'] & 1, 1, 1, 1, 1, 0, 0, $post['authorid'], 1, $post['pid']);

	//���ͼƬ
	$post['imgList'] = space_getMessageImage($post, 3, '180,120');

	//�����������
	$message = space_getMessageText($post);
	$post['message'] = $message;

	return array('message'=>$post['message'],'imgList'=>$post['imgList']);
}

//�õ������е��ı�
function space_getMessageText($post) {
	$post["message"] = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/isU", '', $post["message"]);
	$post["message"] = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $post["message"]);
	$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
	$post['message'] = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $post['message']);//���������ʾ��font��ǩ
	$post['message'] = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $post['message']);
	$post['message'] = preg_replace('/���������.*�༭/isU', '', $post['message']);//���������...�༭
	$post['message'] = strip_tags($post['message']);
	$post['message'] = preg_replace('/����iPhone�ͻ���/isU', '', $post['message']);
	$post['message'] = preg_replace('/\s|&nbsp;/', '', $post['message']);
	return $post['message'];
}

//�õ����������е�ͼƬ
function space_getMessageImage($post, $max = 1, $wh) {
	$index = 0;
	$post["message"] = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $post["message"]);
	preg_match_all("/\[attach\](\d+)\[\/attach\]/isU", $post['message'], $matA);
	if ($matA[0][0]) {
		foreach ($matA[0] as $k=>$v) {
			$post['message'] = $matA[0][$k];
			$postList = array($post['pid']=>$post);
			parseattach($post['pid'], array($post['pid']=>array($matA[1][$k])), $postList);
			$temp = $postList[$post['pid']]['message'];

			//�������ص��ļ�
			if (strrpos($temp, 'zip.gif') !== false || strrpos($temp, 'rar.gif') !== false) {
				continue;
			}

			$temp = preg_replace("/<div.*>.*<\/div>/is", '', $temp);
			if (strrpos($temp, 'file=') === false) {
				$temp = preg_replace("/<img.*zoom\(this,.*[\"|'](.[^>]*)[\"|'].*\).*id=[\"|'](.[^>]*)[\"|'].*>/iseU", "space_replace_post_image('\\1', '$wh')", $temp);
			} else {
				$temp = preg_replace("/<img.*file=[\"|'](.[^>]*)[\"|'].*id=[\"|'](.[^>]*)[\"|'].*>/iseU", "space_replace_post_image('\\1', '$wh')", $temp);
			}
			if (strrpos($temp, 'http://') === false) {continue;}
			$post['imgList'][$index] = $temp;
			$index++;
			if ($index == $max) {break;}
		}
	}
	if ($index < $max) {
		preg_match_all("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/isU", $post['message'], $matA);
		foreach ($matA[1] as $v) {
			if (strrpos($v, 'http://') === false || strrpos($v, 'thumbimg') !== false) {continue;}
			$post['imgList'][$index] = space_replace_image($v, $wh);
			$index++;
			if ($index == $max) {break;}
		}
	}

	return $post['imgList'];
}

//���������������滻ͼƬ
function space_replace_post_image($imgsrc, $wh){
	global $_G;

	list($width, $height) = explode(",", $wh);
	if(preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
		if(($pos2 = strrpos($imgsrc, '!')) !== false){
			$imgsrc = substr($imgsrc, 0, $pos2);
		}
		$imgsrc .= getUpYun( true, $width, $height, 2, 0, 1, true, $_G['config']['cdns']['ids'][99]);
		return $imgsrc;
	}else{
		$imgsrc = str_replace($_G['config']['web']['attach'], "", $imgsrc);
		$imgsrc = getimagethumb($width, $height , 2, $imgsrc, 0, 1);
		return $imgsrc;
	}
}

/**
 * @todo �������������滻ͼƬ���ʵĺ���
 * @author JiangHong
 * @param String $imgsrc ͼƬ��ַ
 * @return String
 */
function space_replace_image($imgsrc, $wh){
	global $_G;

	list($width, $height) = explode(",", $wh);

	/*����ͼƬ��ַ����ĺ�׺#*/
	if(($pos = stripos($imgsrc, "#")) !== false){
		$imgsrc = substr($imgsrc, 0, $pos);
	}

	$imgsrc 	= str_replace($_G['config']['web']['attach'], "", $imgsrc);
	if (strrpos($imgsrc, "static/") === false) {
		if(preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
			if(($pos2 = strrpos($imgsrc, '!')) !== false){
				$imgsrc = substr($imgsrc, 0, $pos2);
			}
			$imgsrc .= getUpYun( true, $width, $height, 2, 0, 1, true, $_G['config']['cdns']['ids'][99]);
		} else{
			$imgsrc = getimagethumb($width, $height , 2, $imgsrc, 0, 1);
		}
	}

	//��ʱ����
	return $imgsrc;
}

//���������ﶯ̬��message����
function dealmessage($message) {
	$message = str_replace('!t2w231h231', '!t2w180h120', $message);
	$message = str_replace('$', '', $message);
	$message = preg_replace("/\(.*\)\.innerHTML.*\);/isU", "", $message);
	$tempmessage = unserialize(dstripslashes($message));
	if (!$tempmessage) {
		preg_match_all("/s:\d+\:\"(.*?)\";/is", $message, $matA);
		if ($matA[1]) {
			$tempmessage = array();

			//��������ͼƬ�б�
			$hasimglist =false;
			foreach ($matA[1] as $k=>$v) {
				if ($v == 'imgList') {
					$hasimglist = true;
					$tempmessage['imgList'] = array();
					unset($matA[1][$k]);
					continue;
				}
				if ($v == 'subject') {
					break;
				}
				if ($hasimglist) {
					$tempmessage['imgList'][] = $v;
					unset($matA[1][$k]);
				}
			}

			$matA[1] = array_values($matA[1]);
			foreach ($matA[1] as $k=>$v) {
				if ($k % 2 == 0) {
					$tempmessage[$v] = '';
				} else {
					$tempkey = $k-1;
					$tempmessage[$matA[1][$tempkey]] = $v;
				}
			}
			$tempmessage = dstripslashes($tempmessage);
		}
	}

	return $tempmessage;
}

//��������--���ĳ���û��Ļظ���
function getpostbyuid($space, $notfids, $infids) {
	if ($space['posts'] < 21 && $space['posts'] > 0) {
		$sql  = "SELECT count(*) FROM ".DB::table('forum_post')." p ";
		$sql .= " INNER JOIN ".DB::table('forum_thread')." t ON t.tid=p.tid ";
		$sql .= " WHERE p.authorid={$space['uid']} AND p.first=0 and t.displayorder>=0 ";
		$sql .= $space['self'] ? " and t.fid not in ({$notfids}) " : " and t.fid in ({$infids}) ";
		$sql .= getSlaveID();
		$space['posts'] = DB::result_first($sql);
		return $space['posts'];
	}
	return $space['posts'];
}

//��������--���ĳ���û��ķ�����
function getthreadbyuid($space, $notfids, $infids) {
	if ($space['threads'] < 21 && $space['threads'] > 0) {
		$sql  = "SELECT COUNT(*) FROM ".DB::table('forum_thread')." t WHERE t.authorid = {$space['uid']} and t.displayorder>=0 and t.special<>4";
		$sql .= $space['self'] ? " and t.fid not in ({$notfids}) " : " and t.fid in ({$infids}) ";
		$sql .= getSlaveID();		
		$space['threads'] = DB::result_first($sql);
		return $space['threads'];
	}
	return $space['threads'];
}

//����ѿ����ĵ���ģ���б�
function getdianpingfids() {
	$dianpingFids 	= array();
	require DISCUZ_ROOT . 'config/config_dianping.php';
	foreach ($dp_modules as $k=>$v) {
		if (!$v['enable']) {continue;}	
		$dianpingFids[$v['fid']] = $v['fid'];
	}
	return $dianpingFids;
}

?>
