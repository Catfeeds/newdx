<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: portal_index.php 16700 2010-09-13 05:46:20Z wangjinbo $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//�ֲ��б�
$lunboList = array();
$sql = "SELECT bannerurl,pic FROM ".DB::table('portal_article_actplatform')."  order by `order` asc,dateline desc LIMIT 10 " . getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
	$v['pic'] = $v['pic'] ? getimagethumb(1500,1500,1,'plugin/'.$v['pic'], 0, 99) : '';
	$lunboList[] = $v;
}

//���Ż�б�
$hotactList= array();
$sql = "SELECT url,title FROM ".DB::table('portal_article_hotact')."  order by `order` desc,dateline desc LIMIT 5 " . getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
	$hotactList[] = $v;
}

require_once libfile('function/discuzcode');
require_once libfile('function/attachment');
require_once libfile('function/wap');

//��б�
$perpage  = 10;	
$page  = $_G['gp_page'] ? $_G['gp_page'] : 1;	
$start = ($page-1)*$perpage;
if($start < 0) $start = 0;
$multi    = '';
$list     = array();
$sql   = "SELECT COUNT(*) AS count FROM ".DB::table('portal_article_actawards')." " . getSlaveID();
$count = DB::result_first($sql);
if($count) {			
		$where = 'p.first = 1';
		$sql ="SELECT a.* ,t.subject ,p.pid, p.message FROM ".DB::table("portal_article_actawards")." AS a "
			. "LEFT JOIN ".DB::table("forum_thread")." AS t "
			. "ON a.aid=t.tid "
			. "LEFT JOIN ".DB::table("forum_post")." AS p "
			. "ON t.tid=p.tid "
			. "WHERE $where ORDER BY a.`order` DESC ,a.dateline DESC LIMIT $start, $perpage ".getSlaveID();
		
		
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['textmessage'] = _getMessageText($v);
			if($v['pic1']||$v['pic2']||$v['pic3']||$v['pic4']){
				$v['pic1'] =$v['pic1']? getimagethumb(150,150,1,'plugin/'.$v['pic1'], 0, 99):'';
				$v['pic2'] =$v['pic2']? getimagethumb(150,150,1,'plugin/'.$v['pic2'], 0, 99):'';
				$v['pic3'] =$v['pic3']? getimagethumb(150,150,1,'plugin/'.$v['pic3'], 0, 99):'';
				$v['pic4'] =$v['pic4']? getimagethumb(150,150,1,'plugin/'.$v['pic4'], 0, 99):'';
			}else{
				$v['imgList'] = _getMessageImage($v, 3, '150,150');
			}
			
			$closetime = strtotime($v['endtime'].' 23:59:59');
			if($_G['timestamp'] > $closetime){
				$v['is_closed'] = 1;
			}else{
				$v['is_closed'] = 0;
			}
			
			//file_put_contents("follow.txt",var_dump($v['imgList'])."   "."\r\n",FILE_APPEND);
			$list[] 		= $v;				
		}
		$multi = multi($count, $perpage, $page, "portal.php?mod=actplat");
	}
	
	
//�õ����������е�ͼƬ
	function _getMessageImage($post, $max = 1, $wh) {
		preg_match_all("/\[attach\](\d+)\[\/attach\]/isU", $post['message'], $matA);		
		if ($matA[0][0]) {
			$index = 0;
			foreach ($matA[0] as $k=>$v) {
				$post['message'] = $matA[0][$k];
				$postList = array($post['pid']=>$post);
				parseattach($post['pid'], array($post['pid']=>array($matA[1][$k])), $postList);
				$temp = $postList[$post['pid']]['message'];
				$temp = preg_replace("/<div.*>.*<\/div>/is", '', $temp);
				$temp = _dealThreadPic_actplat($temp, $wh);
				//����ϵͳͼƬ	
				if (strrpos($temp, 'data-original') === false) {continue;}
				$post['imgList'][$k] = $temp;
				$index++;
				if ($index == $max) {break;}
			}	
		}
		return $post['imgList'];
	}
	
	//�õ������е��ı�
	function _getMessageText($post) {
		$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
		$post['message'] = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $post['message']);//���������ʾ��font��ǩ
		$post['message'] = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $post['message']);
		$post['message'] = preg_replace('/���������.*�༭/isU', '', $post['message']);//���������...�༭		
		$post['message'] = preg_replace('/\s|&nbsp;/', '', $post['message']);
		$post['message'] = discuzcode($post['message'],$post['pid']);
		$post['message'] = strip_tags($post['message']);
		return $post['message'];
	}	
	
	
	
	//�������е�ͼƬ���н��ʴ���
function _dealThreadPic_actplat($content, $wh = '0') {
	/*�˴�ʹ������ֱ���滻����ʹ��ѭ����������滻������Ч��*/
	$content = preg_replace("/<img.*file=[\"|'](.[^>]*)[\"|'].*id=[\"|'](.[^>]*)[\"|'].*>/iseU", "_replace_post_image_actplat('\\1', '\\2', '$wh')", $content);
	return $content;
}

//���������������滻ͼƬ���ʵĺ���
function _replace_post_image_actplat($imgsrc, $id, $wh){
	global $_G;
	if (preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
		if(($pos2 = strrpos($imgsrc, '!')) !== false){
			$imgsrc = substr($imgsrc, 0, $pos2);
		}
		$imgsrc .= '!wap';
		return "<img file='{$imgsrc}' id='{$id}' src='{$imgsrc}' class='lazy' data-original='{$imgsrc}'/>";	
	} else {
		//ͼƬ�ߴ�Ĵ���
		if ($wh) {
			list($width, $height) = explode(",", $wh);
			$imgsrc = getimagethumb($width, $height , 2, str_replace($_G['config']['web']['attach'], "", $imgsrc));	
		} else {
			//����ѡ��ԭͼ����ͼƬ����,��һ������������ֵ,�ڶ�������Ϊ0,����������Ϊ5
			$imgsrc = getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, str_replace($_G['config']['web']['attach'], "", $imgsrc));		
		}
		
		//��ʱ����	
		return "<img file='{$imgsrc}' id='{$id}' src='{$imgsrc}' class='lazy' data-original='{$imgsrc}'/>";
	}
}

$pageTitle ='�ƽ̨ - ';

include template('diy:portal/actplat');
?>
