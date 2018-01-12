<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

//���ı��е�ͼƬ���н��ʴ���
function dealTextPic($content) {
	/*�˴�ʹ������ֱ���滻����ʹ��ѭ����������滻������Ч��*/
	$content = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/iseU", "_replace_image('\\1')", $content);
	return $content;
}

function _replace_image($imgsrc){
	global $_G;
	
	/*����ͼƬ��ַ����ĺ�׺#*/
	if(($pos = stripos($imgsrc, "#")) !== false){
		$imgsrc = substr($imgsrc, 0, $pos);
	}
	$smileClass = "";
	$imgsrc 	= str_replace($_G['config']['web']['attach'], "", $imgsrc);
	
	if (preg_match("#(http|https)://.*\.(com|cn|org|net).*#is", $imgsrc) && !preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
	} elseif (strrpos($imgsrc, "static/") === false) {
		if (strrpos($imgsrc, "file:") !== false) {return false;}
		
		$imgsrc = str_replace('image.', 'image1.', $imgsrc);
		if(!preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
			$imgsrc = 'http://'.$_G['config']['cdn']['images']['cdnurl'].'/'.$imgsrc;
		}				
		if(($pos2 = strrpos($imgsrc, '!')) !== false){
			$imgsrc = substr($imgsrc, 0, $pos2);
		}
		$imgsrc .= '!t1w1500h1500';		
	} else {
		$imgsrc     = $_G["config"]['web']['portal'].$imgsrc;		
		$smileClass = "smile";
	}
	
	//��ʱ����
	return "<img src='http://static.8264.com/static/images/forum/readmodelTravel/loadding.jpg' class='lazy {$smileClass}' data-original='{$imgsrc}'/>";
}

//�����Ķ����message(��ϸҳ)
function readmodelMessage($message, $tid= 0, $pid = 0, &$blockquote = array(), $type = '') {
	global $_G;
	
	include_once libfile('function/discuzcode');
	include_once libfile('function/readmodelTravel');
	include_once libfile('function/post');	
	
	$message = discuzcode($message);
	
	if (!empty($tid)) {
		//��message�����õĴ���
		preg_match_all("/<blockquote>(.*)<a.*pid=(\d*)&.*>.*<\/a>(.*)<\/blockquote>/isU", $message, $matA);
		if (!empty($matA[2][0])) {
			
			$blockquote[$pid]["message_quote_content"] = strip_tags($matA[3][0]);
			
			$arr = explode(" ", strip_tags($matA[1][0]));
			$blockquote[$pid]["message_quote_author"]   = $arr[0];
			$blockquote[$pid]["message_quote_dateline"] = $arr[2]." ".$arr[3];
			$blockquote[$pid]["message_quote_pid"] 	  = $matA[2][0];
			
			$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//����
		}		
	}
	
	$message = preg_replace('/<media[^>]*>.*<\/media>/isU', '', $message);//[/media]
	$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//���������ʾ��font��ǩ
	$message = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $message);
	
	$message = strip_tags($message, "<a><p><img><table><tbody><tr><th><td><span><script><br>");	
	
	$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n������<br/>
	$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
	$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
	$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
	
	$message = str_replace('target="_blank"', "", $message);
	$message = str_replace('&nbsp;', "", $message);
	$message = preg_replace('/���������.*�༭/isU', '', $message);//���������...�༭
	
	$message = dealTextPic($message);
	
	preg_match_all('/\[attach\](\d+)\[\/attach\]/isU', $message, $matA);
	
	if ($pid) {
		$sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE pid = {$pid} LIMIT 10 " . getSlaveID();
		$query = DB::query($sql);		
		while ($v = DB::fetch($query)) {
			$imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['attachment']}!t1w1500h1500";	
			$pics[$v['aid']] = $type == 'admincp' ? "<span class='img_url'>[img]{$imgsrc}[/img]</span>" : "<img src='http://static.8264.com/static/images/forum/readmodelTravel/loadding.jpg' class='lazy preview' data-original='{$imgsrc}'/>";
		}
		foreach ($matA[1] as $k=>$v) {
			if (isset($pics[$v])) {
				$message = str_replace("[attach]{$v}[/attach]", $pics[$v], $message);
			} else {
				$message = str_replace("[attach]{$v}[/attach]", '', $message);
			}
			unset($pics[$v]);
		}
		foreach ($pics as $v) {
			$message .= $v;
		}
	} else {
		if ($matA[1]) {
			$aids  = implode(',', $matA[1]);
			$sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE aid in ({$aids}) " . getSlaveID();
			
			$query = DB::query($sql);		
			while ($v = DB::fetch($query)) {
				$imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['attachment']}!t1w1500h1500";	
				$pics[$v['aid']] = $type == 'admincp' ? "<span class='img_url'>[img]{$imgsrc}[/img]</span>" : "<img src='http://static.8264.com/static/images/forum/readmodelTravel/loadding.jpg' class='lazy preview' data-original='{$imgsrc}'/>";
			}		
			foreach ($matA[1] as $k=>$v) {
				if (isset($pics[$v])) {
					$message = str_replace("[attach]{$v}[/attach]", $pics[$v], $message);
				} else {
					$message = str_replace("[attach]{$v}[/attach]", '', $message);
				}
			}
		}
	}
		
	$message = preg_replace('/(<img.*>)\s*<br[^>]*\/?>/isU', '\1', $message);//<img><br/>	
	
	return $message;	
}

//�����Ķ����summary
function readmodelSummary($message, $pid, &$summary, &$imgList) {
	global $_G;
	
	include_once libfile('function/discuzcode');
	include_once libfile('function/readmodelTravel');
	include_once libfile('function/post');	
	
	$message = discuzcode($message);	
	$message = preg_replace('/<media[^>]*>.*<\/media>/isU', '', $message);//[/media]
	$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//����
	$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//���������ʾ��font��ǩ
	$message = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $message);
	$message = preg_replace('/���������.*�༭/isU', '', $message);//���������...�༭	
	$message = str_replace('&nbsp;', "", $message);
	$message = dealTextPic($message);
	
	preg_match_all('/\[attach\](\d+)\[\/attach\]/isU', $message, $matA);
	
	$sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE pid = {$pid} LIMIT 3 " . getSlaveID();
	$query = DB::query($sql);		
	while ($v = DB::fetch($query)) {
		$imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['attachment']}!t1w1500h1500";	
		$pics[$v['aid']] = "<img src='http://static.8264.com/static/images/forum/readmodelTravel/loadding.jpg' class='lazy preview' data-original='{$imgsrc}'/>";
	}
	
	foreach ($matA[1] as $k=>$v) {
		if (isset($pics[$v])) {
			$message = str_replace("[attach]{$v}[/attach]", $pics[$v], $message);
		} else {
			$message = str_replace("[attach]{$v}[/attach]", '', $message);
		}
		unset($pics[$v]);
	}
	foreach ($pics as $v) {
		$message .= $v;
	}
	
	preg_match_all("/<img.*data-original=[\"|'](.[^>]*)[\"|'].*>/isU", $message, $matA);	
	
	foreach ($matA[1] as $k=>$v) {
		if (strpos($v, 'http://') === false || strpos($v, 'bbs.8264.com') !== false || strpos($v, 'static.') !== false) {
			unset($matA[1][$k]);
		} else {
			$matA[1][$k] = str_replace('!t1w1500h1500', '', $v);	
		}
	}
	$imgList = array_merge($imgList, $matA[1]);	
	
	$message = strip_tags($message);		
	
	if (empty($summary)) {
		$message = str_replace('\\', '', $message);	
		$message = str_replace('\'', '��', $message);	
		$message = str_replace('"', '��', $message);	
		$summary = mb_substr($message, 0, '200', 'gbk');		
		$summary = addslashes($summary);
	}
}

//�����ʴ��message
function questionmodelMessage($message, $tid= 0, $pid = 0, &$blockquote = array()) {
	global $_G;
	
	include_once libfile('function/discuzcode');
	include_once libfile('function/readmodelTravel');	
	$message=preg_replace('/\[img=(\d+),(\d+)\]/', '[img]', $message);
	//����΢��ͼƬ
	//http://mmbiz.qpic.cn/mmbiz/6kkeDPr2oySKH7ibQY1KhKI7skA4LwTeNSPF1Ze8ganjibs8wSaqSLcjjp6cApN68Xy8yWV8HwP82aZTtEMgy4MQ/0
	//http://mmbiz.qpic.cn/mmbiz/TTfzHvFaeQ6czbhVoDOicgwlvB0TbZwWibruDt1tosSm7hmT6Zuc0uDxvq2uJnjCR10d9zvv2FmV6dVuoHA8QKAA/0
	//http://mmbiz.qpic.cn/mmbiz/Sf6nibvavkZqvPFGpVdHx2pE6SNChpKtrDeRffeic3LeeibyUKiak1srtFmUs8jZM12eNxNwiaKZNTcs0MPSLicbAJ0g/0?wxfrom=5
	$message=preg_replace('/\[img\]http:\/\/mmbiz\.qpic\.cn\/mmbiz\/(.*)\[\/img\]/isU', '', $message);
	$message = discuzcode($message);
	
	if (!empty($tid)) {
		//��message�����õĴ���
		preg_match_all("/<blockquote>(.*)<a.*pid=(\d*)&.*>.*<\/a>(.*)<\/blockquote>/isU", $message, $matA);
		if (!empty($matA[2][0])) {
			
			$blockquote[$tid][$pid]["message_quote_content"] = strip_tags($matA[3][0]);
			
			$arr = explode(" ", strip_tags($matA[1][0]));
			$blockquote[$tid][$pid]["message_quote_author"]   = $arr[0];
			$blockquote[$tid][$pid]["message_quote_dateline"] = $arr[2]." ".$arr[3];
			$blockquote[$tid][$pid]["message_quote_pid"] 	  = $matA[2][0];
			
			$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//����
		}		
	}

	$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//���������ʾ��font��ǩ
	$message = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $message);
	
	$message = strip_tags($message, "<a><p><img><table><tbody><tr><th><td><span><script><br>");	
	
	$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n������<br/>
	$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
	$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
	$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
	
	$message = str_replace('target="_blank"', "", $message);
	$message = str_replace('¥��', "����", $message);
	$message = preg_replace('/\{\:.*\:\}/isU', '', $message);//{:4_111:}
	$message = preg_replace('/���������.*�༭/isU', '', $message);//���������...�༭
	
	//$message = dealTextPic($message);
	
	preg_match_all('/\[attach\](\d+)\[\/attach\]/isU', $message, $matA);
	
	if ($matA[1]) {
		$aids  = implode(',', $matA[1]);
		$sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE aid in ({$aids}) " . getSlaveID();
		
		$query = DB::query($sql);		
		while ($v = DB::fetch($query)) {
			$imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['attachment']}!t1w1500h1500";	
			$pics[$v['aid']] = "<img src='{$_G["config"]['web']['portal']}static/images/loadding.gif' class='lazy preview zoom' onclick='zoom(this,this.src)' bigpic='{$imgsrc}' data-original='{$imgsrc}'/>";
		}
		foreach ($matA[1] as $k=>$v) {
			if (isset($pics[$v])) {
				$message = str_replace("[attach]{$v}[/attach]", $pics[$v], $message);
			} else {
				$message = str_replace("[attach]{$v}[/attach]", '', $message);
			}
		}
	}
		
	$message = preg_replace('/(<img.*>)\s*<br[^>]*\/?>/isU', '\1', $message);//<img><br/>
	
	return $message;
	
}


function createReadmodel($data, $message, $pid, $pauthorid, $tauthorid, $action = 'append') {
	$hasQuote = strpos($message, '[quote]') === false ? false : true;
	$message  = preg_replace('/\[quote\](.*)\[\/quote\]/isU', '', $message);//����
	
	if(strpos($message, '[attach]') !== false || strpos($message, '[img]') !== false) {
		if ($pauthorid == $tauthorid && !$hasQuote) {
			$data['apids'][$pid] = $pid;
			$data['acnt']++;
		} else {
			$data['cpids'][$pid] = $pid;
			$data['ccnt']++;
			$data['rpids'][$pid] = $pid;
			$data['rcnt']++;
		}
		return $data;
	}
	$message = discuzcode($message);
	$message = strip_tags($message);
	$tempCnt = mb_strlen($message);
	if ($tempCnt > 50) {
		if ($pauthorid == $tauthorid && !$hasQuote) {
			$data['apids'][$pid] = $pid;
			$data['acnt']++;
		} else {
			$data['cpids'][$pid] = $pid;
			$data['ccnt']++;
			$data['rpids'][$pid] = $pid;
			$data['rcnt']++;
		}
	} else {
		$data['cpids'][$pid] = $pid;
		$data['ccnt']++;
	}
	
	return $data;
}

//�������õ��ı�
function getNoticeauthormsg($message) {	
	include_once libfile('function/post');
	$message = strip_tags($message);
	$message = preg_replace('/\s*/isU', '', $message);
	$message = preg_replace('/<br[^>]*\/?>/isU', '', $message);//<br/>
	$message = mb_substr($message, 0, 50, 'gbk');
	return $message;
}

// ���������û�|������ļ��뻺��
function setReadmodelCache($tid, $uid, $min, $uids = array(), $type = '') {
	global $_G;
	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$key  	= $type == 'share' ? "readmodelShare_{$tid}" : "readmodelViews_{$tid}";
//	$redis->obj->delete($key);
	$prev   = "viewtid_";
	
	$isadd  = $uid && ($type == 'views' || ($type == 'share' && $_G['gp_is_wei']))? true : false;
	
	if ($isadd) {
		$redis->obj->hdel($key, $prev.$uid);
		$redis->obj->hSet($key, $prev.$uid, $uid);
	}
	$cnt = (int)$redis->obj->hlen($key);
	if ($cnt < $min && !empty($uids)) {
		$iscycle = true;
		$usercnt = count($uids) - 1;
		while ($iscycle) {
			$rand = rand(0, $usercnt);
			$temp = !empty($uids[$rand]) ? $uids[$rand] : '';
			if (empty($temp)) {continue;}
			$redis->obj->hdel($key, $prev.$temp);
			$redis->obj->hSet($key, $prev.$temp, $temp);
			$cnt++;
			$iscycle = $cnt >= $min ? false : true;
		}
	}	
}

// ���������û�|��������û��б�
function readmodelCache($tid, $max, $type = '') {	
	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);
	$key   = $type == 'share' ? "readmodelShare_{$tid}" : "readmodelViews_{$tid}";
	$list  = $redis->obj->hgetall($key);	
	$list  = array_reverse($list);
	$list  = array_slice($list, 0, $max);	
	if ($type == 'share') {
		global $shareCnt;
		$shareCnt = $redis->obj->hlen($key);
	}	
	return $list;
}

// �����������Ķ�����뻺��
function setArticlereadCache($tid) {	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$key  	= "articleread";
	$redis->obj->hIncrBy($key, $tid, 1);
}

//��ȡ�����Ķ������������
function articlereadCache() {	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$key  	= "articleread";	
	$list   = $redis->obj->hgetall($key);	
	$list   = array_flip($list);	
	krsort($list, SORT_NUMERIC);
	$list  = array_slice($list, 0, 5, true);
	$list  = array_flip($list);		
	return $list;
}

//�μ����
function insertTravelread($threadShow,$opadmin) {
	$tid        = $threadShow['tid'];
	$perpage 	= 200;
	$start   	= 0;
	$cycleSign  = true;
	$summary    = '';
	$imgList    = array();
	$data['authorid']  = $threadShow['authorid'];	
	$data['author']    = $threadShow['author'];	
	$data['subject']   = daddslashes($threadShow['subject']);
	$data['tid']       = $threadShow['tid'];
	$data['editcnt']   = 0;
	$data['bgpic']     = rand(1, 14);
	$data['days']      = 0;
	$data['shareInit'] = rand(50, 99);
	
	while ($cycleSign) {
		$sql   = "SELECT p.pid, p.message, p.authorid FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} AND p.invisible = 0 ORDER BY p.dateline asc limit {$start},{$perpage} " . getSlaveID();
		$query = DB::query($sql);
		
		$tempsign = 0;
		while($v = DB::fetch($query)) {
			$tempsign++;				
			$data = createReadmodel($data, $v['message'], $v['pid'], $v['authorid'], $threadShow['authorid'], 'add'); 
			if (empty($summary) || count($imgList) < 5) {
				readmodelSummary($v['message'], $v['pid'], $summary, $imgList);	
			}			
		}
		
		$cycleSign = $tempsign > 0 ? true : false;
		$start    += $perpage;			
	}
	
	$imgList = array_slice($imgList, 0, 5);
	$data['summary'] = array('text'=>$summary, 'img'=>$imgList);
	$data['summary'] = serialize($data['summary']);
	$data['pic']     = $imgList[0];
	
	$data['apids']   	= implode(',', $data['apids']);
	$data['cpids']   	= implode(',', $data['cpids']);
	$data['rpids']   	= implode(',', $data['rpids']);
	$data['dateline']   = TIMESTAMP;
	$data['opadmin']   = $opadmin;
	
	DB::insert('forum_travelread', $data);
	DB::update('forum_thread', array('readmodel'=>99), "tid = {$tid}");
	
	/*�ӱ������ҵ�������ǩ*/
	$nationList   = array();
	$provinceList = array();
	$finalSql 	  = array();
	$hasDeal  	  = array();
	
	$sql   = "SELECT id, alias FROM ".DB::table('t_nation_info') . getSlaveID();
	$query = DB::query($sql);	
	while($v = DB::fetch($query)) {
		$nationList[$v['id']] = $v['alias'];
		if (strpos($threadShow['subject'], $v['alias']) !== false) {
			getSqlForPlace($hasDeal, $finalSql, $tid, $v['id'], $v['alias'], 1);			
		}		
	}
	
	$sql   = "SELECT id, alias, nation_id FROM ".DB::table('t_province_info') . getSlaveID();
	$query = DB::query($sql);	
	while($v = DB::fetch($query)) {
		$provinceList[$v['id']] = $v['alias'];
		if (strpos($threadShow['subject'], $v['alias']) !== false) {
			getSqlForPlace($hasDeal, $finalSql, $tid, $v['id'], $v['alias'], 2);
			getSqlForPlace($hasDeal, $finalSql, $tid, $v['nation_id'], $nationList[$v['nation_id']], 1);			
		}
	}
	
	$sql   = "SELECT id, alias, nation_id, province_id FROM ".DB::table('t_city_info') . getSlaveID();
	$query = DB::query($sql);	
	while($v = DB::fetch($query)) {
		if (strpos($threadShow['subject'], $v['alias']) !== false) {
			getSqlForPlace($hasDeal, $finalSql, $tid, $v['id'], $v['alias'], 3);
			if ($v['province_id'] > 0) {
				getSqlForPlace($hasDeal, $finalSql, $tid, $v['province_id'], $provinceList[$v['province_id']], 2);
			}
			getSqlForPlace($hasDeal, $finalSql, $tid, $v['nation_id'], $nationList[$v['nation_id']], 1);	
		}
	}

	if ($finalSql) {
		$finalSql = 'INSERT INTO '.DB::table('forum_travelread_tid_place').'(tid, placeid, name, level) VALUES '.implode(',', $finalSql);
		DB::query($finalSql);
	}
	/*�ӱ������ҵ�������ǩ end*/
	
	updateTravelActnum($hasDeal);
	
}

//�����Ķ������
function insertArticleread($threadShow,$opadmin) {
	$tid        = $threadShow['tid'];
	$perpage 	= 200;
	$start   	= 0;
	$cycleSign  = true;
	$summary    = '';
	$imgList    = array();
	$data['authorid']  = $threadShow['authorid'];	
	$data['author']    = $threadShow['author'];	
	$data['subject']   = daddslashes($threadShow['subject']);
	$data['tid']       = $threadShow['tid'];
	$data['editcnt']   = 0;
	$data['shareInit'] = rand(50, 99);
	
	while ($cycleSign) {
		$sql   = "SELECT p.pid, p.message, p.authorid FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} AND p.invisible = 0 ORDER BY p.dateline asc limit {$start},{$perpage} " . getSlaveID();
		$query = DB::query($sql);
		
		$tempsign = 0;
		while($v = DB::fetch($query)) {
			$tempsign++;				
			$data = createReadmodel($data, $v['message'], $v['pid'], $v['authorid'], $threadShow['authorid'], 'add'); 	
			if (empty($summary) || count($imgList) < 5) {
				readmodelSummary($v['message'], $v['pid'], $summary, $imgList);	
			}			
		}
		
		$cycleSign = $tempsign > 0 ? true : false;
		$start    += $perpage;			
	}
	
	$imgList = array_slice($imgList, 0, 5);
	$data['summary'] = array('text'=>$summary, 'img'=>$imgList);
	$data['summary'] = serialize($data['summary']);
	$data['pic']        = $imgList[0];
	
	$data['apids']   	= implode(',', $data['apids']);
	$data['cpids']   	= implode(',', $data['cpids']);
	$data['rpids']   	= implode(',', $data['rpids']);
	$data['dateline']   = TIMESTAMP;
	$data['opadmin']   = $opadmin;
	
	DB::insert('forum_articleread', $data);
	DB::update('forum_thread', array('readmodel'=>98), "tid = {$tid}");	
}

//�õ�������ǩ��sql
function getSqlForPlace(&$hasDeal, &$finalSql, $tid, $placeid, $name, $level) {
	if (empty($placeid)) {return false;}
	$tempkey = "{$placeid}-{$level}";
	if (!isset($hasDeal[$tempkey])) {
		$finalSql[] = "({$tid}, {$placeid}, '{$name}', {$level})";
		$hasDeal[$tempkey] = 1;
	}
}

//���µ�ַ���μ���
function updateTravelActnum($hasDeal) {
	$level1 = array();
	$level2 = array();
	foreach ($hasDeal as $k=>$v) {
		list($tempPlaceid, $tempLevel) = explode('-', $k);
		if ($tempLevel == 1) {
			$level1[$tempPlaceid] = DB::result_first("SELECT count(*) FROM ".DB::table('forum_travelread_tid_place')." WHERE placeid = {$tempPlaceid} AND level = 1 ");
		}
		if ($tempLevel == 2) {
			$level2[$tempPlaceid] = DB::result_first("SELECT count(*) FROM ".DB::table('forum_travelread_tid_place')." WHERE placeid = {$tempPlaceid} AND level = 2 ");
		}
	}
	
	if ($level1) {
		$ids = implode(',', array_keys($level1));
		$sql = "UPDATE ".DB::table('forum_travelread_place')." SET actnum = CASE placeid ";
		foreach ($level1 as $k => $v) {
		    $sql .= "WHEN {$k} THEN {$v} ";
		}
		$sql .= "END WHERE placeid IN ($ids) AND level = 1 ";
		DB::query($sql);
	}
	if ($level2) {
		$ids = implode(',', array_keys($level2));
		$sql = "UPDATE ".DB::table('forum_travelread_place')." SET actnum = CASE placeid ";
		foreach ($level2 as $k => $v) {
		    $sql .= "WHEN {$k} THEN {$v} ";
		}
		$sql .= "END WHERE placeid IN ($ids) AND level = 2 ";
		DB::query($sql);
	}

}

//����μǵİ��
function getTravelFids() {
	return array(
		"52"=> '�μǹ���',
		"69"=> '�߳�����',
		"39"=> '������Ӱ',
		"56"=> '�����һ���',
		"24"=> 'ɽ���Ⱥ',
		"88"=> '��������',
		"66"=> '�Լ�|ƴ��',
		"101"=> '����',
		"100"=> '���',
		"166"=> '����',
		"48"=> '�Ϻ�',
		"104"=> '�ӱ�',
		"165"=> 'ɽ��',
		"115"=> '����',
		"116"=> '����',
		"159"=> '������',
		"109"=> '����',
		"147"=> '�㽭',
		"158"=> '����',
		"113"=> '����',
		"111"=> '����',
		"103"=> 'ɽ��',
		"106"=> '����',
		"164"=> '�ӱ�',
		"114"=> '����',
		"112"=> '�㶫',
		"117"=> '����',
		"102"=> '�Ĵ�',
		"176"=> '����',
		"105"=> '����',
		"107"=> '����',
		"110"=> '����',
		"177"=> '�ຣ',
		"170"=> '���ɹ�',
		"108"=> '����',
		"143"=> '����',
		"171"=> '�½�'	
	);
}

//�ж��Ƿ�Ϊ�μ��Ķ���
function isTravelread($tid, $authorid) {
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$key    = "isTravelread";
	
	$val = $redis->obj->hget($key, $tid);
	if ($val == 1) {
		return true;
	} elseif ($val == -1) {
		return false;
	}	
	
	$perpage 		= 50;
	$start   		= 0;
	$authorPostCnt  = 0;
	$authorPicCnt   = 0;
	$isbe           = true;	
	
	while (true) {
		$sql   = "SELECT p.pid, p.message, p.authorid, p.first FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} AND p.invisible = 0 ORDER BY p.dateline asc limit {$start},{$perpage} " . getSlaveID();
		$query = DB::query($sql);
		
		$tempsign = 0;
		while($v = DB::fetch($query)) {
			$tempsign++;
			
			//��¥����100����
			if ($v['first']) {				
				$message = discuzcode($v['message']);
				$message = strip_tags($message);
				$tempCnt = mb_strlen($message);
				if ($tempCnt < 100) {
					$isbe = false;
					break;
				}
			}
			
			//���ߵ�¥������9
			if ($v['authorid'] == $authorid) {
				preg_match_all('/\[attach\]\d+\[\/attach\]/isU', $message, $matA);				
				$authorPicCnt += count($matA[0]);
				$authorPostCnt++;
				if ($authorPicCnt > 19 && $authorPostCnt > 9) {
					break;
				}				
			}
		}
				
		$start    += $perpage;
		if ($tempsign == 0 || !$isbe || ($authorPostCnt > 9 && $authorPicCnt > 19)) {
			break;
		}
	}	
	$val  = $isbe && $authorPostCnt > 9 && $authorPicCnt > 19 ? true : false;
	$temp = $val ? 1 : -1;
	$redis->obj->hSet($key, $tid, $temp);
	return $val;
}


//������µİ��
function getArticleFids() {
	return array(
		"12"=> '�������',
		"146"=> '������ʳ',
		"58"=> '���⾭����',
		"489"=> '�����ȷ�Ӫ',
		"24"=> 'ɽ���Ⱥ',
		"135"=> '�ұڰ���',
		"88"=> '��������',
		"178"=> '̽��|��������',
		"447"=> 'ˮ���˶�',
		"179"=> '����',
		"186"=> '��ѩ',
		"66"=> '�Լ�|ƴ��',
		"495"=> '�ܲ�|ԽҰ��',
		"7"=> 'װ������',
		"101"=> '����',
		"100"=> '���',
		"166"=> '����',
		"48"=> '�Ϻ�',
		"104"=> '�ӱ�',
		"165"=> 'ɽ��',
		"115"=> '����',
		"116"=> '����',
		"159"=> '������',
		"109"=> '����',
		"147"=> '�㽭',
		"158"=> '����',
		"113"=> '����',
		"111"=> '����',
		"103"=> 'ɽ��',
		"106"=> '����',
		"164"=> '�ӱ�',
		"114"=> '����',
		"112"=> '�㶫',
		"117"=> '����',
		"102"=> '�Ĵ�',
		"176"=> '����',
		"105"=> '����',
		"107"=> '����',
		"110"=> '����',
		"177"=> '�ຣ',
		"170"=> '���ɹ�',
		"108"=> '����',
		"143"=> '����',
		"171"=> '�½�'	
	);
}


//�ж��Ƿ�Ϊ�����Ķ���
function isArticleread($tid, $authorid) {
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$key    = "isArticleread";
	
	$val = $redis->obj->hget($key, $tid);
	if ($val == 1) {
		return true;
	} elseif ($val == -1) {
		return false;
	}	
	
	$perpage 		= 1;
	$start   		= 0;
	$authorPostCnt  = 0;
	$authorPicCnt   = 0;
	$isbe           = true;	
	
	while (true) {
		$sql   = "SELECT p.pid, p.message, p.authorid, p.first FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} AND p.invisible = 0 ORDER BY p.dateline asc limit {$start},{$perpage} " . getSlaveID();
		$query = DB::query($sql);
		
		$tempsign = 0;
		while($v = DB::fetch($query)) {
			$tempsign++;
			
			//��¥����500����
			if ($v['first']) {				
				$message = discuzcode($v['message']);
				$message = strip_tags($message);
				$tempCnt = mb_strlen($message);
				if ($tempCnt < 500) {
					$isbe = false;
					break;
				}
			}
			
		}
		
		break;		
//		$start    += $perpage;
//		if ($tempsign == 0 || !$isbe ) {
//			break;
//		}
	}	
	

	$val  = $isbe ? true : false;
	$temp = $val ? 1 : -1;
	$redis->obj->hSet($key, $tid, $temp);
	return $val;
}



//��������Ķ���ķ���
function getArticleTypes() {
	$showtypes_query = DB::query("SELECT type_id,type_name,father_id FROM " . DB::table("forum_articleread_type") . " WHERE type_name != '' ORDER BY disorder desc " . getSlaveID());
	$list = array();
	while ($row = DB::fetch($showtypes_query)) {
		$list[$row[type_id]][0]= $row[type_name];
		$list[$row[type_id]][1]= $row[father_id];
	}
	return $list;
}

function build_url($params, $appsecret, $apiurl = 'http://hd.8264.com/api/index.php') {
	ksort($params);
	reset($params);
	$str_q = http_build_query($params);
	$sign = md5($str_q . $appsecret);
	return $apiurl . '?' . $str_q . '&sign=' . $sign;
}
?>