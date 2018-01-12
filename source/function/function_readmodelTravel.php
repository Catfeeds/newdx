<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

//对文本中的图片进行降质处理
function dealTextPic($content) {
	/*此处使用正则直接替换，不使用循环多次正则替换，提升效率*/
	$content = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/iseU", "_replace_image('\\1')", $content);
	return $content;
}

function _replace_image($imgsrc){
	global $_G;
	
	/*过滤图片地址后面的后缀#*/
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
	
	//延时加载
	return "<img src='http://static.8264.com/static/images/forum/readmodelTravel/loadding.jpg' class='lazy {$smileClass}' data-original='{$imgsrc}'/>";
}

//处理阅读版的message(详细页)
function readmodelMessage($message, $tid= 0, $pid = 0, &$blockquote = array(), $type = '') {
	global $_G;
	
	include_once libfile('function/discuzcode');
	include_once libfile('function/readmodelTravel');
	include_once libfile('function/post');	
	
	$message = discuzcode($message);
	
	if (!empty($tid)) {
		//对message中引用的处理
		preg_match_all("/<blockquote>(.*)<a.*pid=(\d*)&.*>.*<\/a>(.*)<\/blockquote>/isU", $message, $matA);
		if (!empty($matA[2][0])) {
			
			$blockquote[$pid]["message_quote_content"] = strip_tags($matA[3][0]);
			
			$arr = explode(" ", strip_tags($matA[1][0]));
			$blockquote[$pid]["message_quote_author"]   = $arr[0];
			$blockquote[$pid]["message_quote_dateline"] = $arr[2]." ".$arr[3];
			$blockquote[$pid]["message_quote_pid"] 	  = $matA[2][0];
			
			$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//引用
		}		
	}
	
	$message = preg_replace('/<media[^>]*>.*<\/media>/isU', '', $message);//[/media]
	$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//处理掉不显示的font标签
	$message = preg_replace('/下载地址回复可见.*<\/p>/isU', '</p>', $message);
	
	$message = strip_tags($message, "<a><p><img><table><tbody><tr><th><td><span><script><br>");	
	
	$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
	$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
	$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
	$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
	
	$message = str_replace('target="_blank"', "", $message);
	$message = str_replace('&nbsp;', "", $message);
	$message = preg_replace('/本帖最后由.*编辑/isU', '', $message);//本帖最后由...编辑
	
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

//处理阅读版的summary
function readmodelSummary($message, $pid, &$summary, &$imgList) {
	global $_G;
	
	include_once libfile('function/discuzcode');
	include_once libfile('function/readmodelTravel');
	include_once libfile('function/post');	
	
	$message = discuzcode($message);	
	$message = preg_replace('/<media[^>]*>.*<\/media>/isU', '', $message);//[/media]
	$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//引用
	$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//处理掉不显示的font标签
	$message = preg_replace('/下载地址回复可见.*<\/p>/isU', '</p>', $message);
	$message = preg_replace('/本帖最后由.*编辑/isU', '', $message);//本帖最后由...编辑	
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
		$message = str_replace('\'', '’', $message);	
		$message = str_replace('"', '’', $message);	
		$summary = mb_substr($message, 0, '200', 'gbk');		
		$summary = addslashes($summary);
	}
}

//处理问答的message
function questionmodelMessage($message, $tid= 0, $pid = 0, &$blockquote = array()) {
	global $_G;
	
	include_once libfile('function/discuzcode');
	include_once libfile('function/readmodelTravel');	
	$message=preg_replace('/\[img=(\d+),(\d+)\]/', '[img]', $message);
	//过滤微信图片
	//http://mmbiz.qpic.cn/mmbiz/6kkeDPr2oySKH7ibQY1KhKI7skA4LwTeNSPF1Ze8ganjibs8wSaqSLcjjp6cApN68Xy8yWV8HwP82aZTtEMgy4MQ/0
	//http://mmbiz.qpic.cn/mmbiz/TTfzHvFaeQ6czbhVoDOicgwlvB0TbZwWibruDt1tosSm7hmT6Zuc0uDxvq2uJnjCR10d9zvv2FmV6dVuoHA8QKAA/0
	//http://mmbiz.qpic.cn/mmbiz/Sf6nibvavkZqvPFGpVdHx2pE6SNChpKtrDeRffeic3LeeibyUKiak1srtFmUs8jZM12eNxNwiaKZNTcs0MPSLicbAJ0g/0?wxfrom=5
	$message=preg_replace('/\[img\]http:\/\/mmbiz\.qpic\.cn\/mmbiz\/(.*)\[\/img\]/isU', '', $message);
	$message = discuzcode($message);
	
	if (!empty($tid)) {
		//对message中引用的处理
		preg_match_all("/<blockquote>(.*)<a.*pid=(\d*)&.*>.*<\/a>(.*)<\/blockquote>/isU", $message, $matA);
		if (!empty($matA[2][0])) {
			
			$blockquote[$tid][$pid]["message_quote_content"] = strip_tags($matA[3][0]);
			
			$arr = explode(" ", strip_tags($matA[1][0]));
			$blockquote[$tid][$pid]["message_quote_author"]   = $arr[0];
			$blockquote[$tid][$pid]["message_quote_dateline"] = $arr[2]." ".$arr[3];
			$blockquote[$tid][$pid]["message_quote_pid"] 	  = $matA[2][0];
			
			$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//引用
		}		
	}

	$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//处理掉不显示的font标签
	$message = preg_replace('/下载地址回复可见.*<\/p>/isU', '</p>', $message);
	
	$message = strip_tags($message, "<a><p><img><table><tbody><tr><th><td><span><script><br>");	
	
	$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
	$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
	$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
	$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
	
	$message = str_replace('target="_blank"', "", $message);
	$message = str_replace('楼主', "题主", $message);
	$message = preg_replace('/\{\:.*\:\}/isU', '', $message);//{:4_111:}
	$message = preg_replace('/本帖最后由.*编辑/isU', '', $message);//本帖最后由...编辑
	
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
	$message  = preg_replace('/\[quote\](.*)\[\/quote\]/isU', '', $message);//引用
	
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

//处理引用的文本
function getNoticeauthormsg($message) {	
	include_once libfile('function/post');
	$message = strip_tags($message);
	$message = preg_replace('/\s*/isU', '', $message);
	$message = preg_replace('/<br[^>]*\/?>/isU', '', $message);//<br/>
	$message = mb_substr($message, 0, 50, 'gbk');
	return $message;
}

// 游览过的用户|分享过的记入缓存
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

// 游览过的用户|分享过的用户列表
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

// 游览过文章阅读版记入缓存
function setArticlereadCache($tid) {	
	require_once libfile('class/myredis');
	$redis  = & myredis::instance(6381);
	$key  	= "articleread";
	$redis->obj->hIncrBy($key, $tid, 1);
}

//读取文章阅读版浏览数缓存
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

//游记入库
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
	
	/*从标题中找到地名标签*/
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
	/*从标题中找到地名标签 end*/
	
	updateTravelActnum($hasDeal);
	
}

//文章阅读版入库
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

//得到地名标签的sql
function getSqlForPlace(&$hasDeal, &$finalSql, $tid, $placeid, $name, $level) {
	if (empty($placeid)) {return false;}
	$tempkey = "{$placeid}-{$level}";
	if (!isset($hasDeal[$tempkey])) {
		$finalSql[] = "({$tid}, {$placeid}, '{$name}', {$level})";
		$hasDeal[$tempkey] = 1;
	}
}

//更新地址的游记数
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

//获得游记的板块
function getTravelFids() {
	return array(
		"52"=> '游记攻略',
		"69"=> '走出国门',
		"39"=> '户外摄影',
		"56"=> '我秀我户外',
		"24"=> '山伍成群',
		"88"=> '骑行天下',
		"66"=> '自驾|拼车',
		"101"=> '北京',
		"100"=> '天津',
		"166"=> '重庆',
		"48"=> '上海',
		"104"=> '河北',
		"165"=> '山西',
		"115"=> '辽宁',
		"116"=> '吉林',
		"159"=> '黑龙江',
		"109"=> '江苏',
		"147"=> '浙江',
		"158"=> '安徽',
		"113"=> '福建',
		"111"=> '江西',
		"103"=> '山东',
		"106"=> '河南',
		"164"=> '河北',
		"114"=> '湖南',
		"112"=> '广东',
		"117"=> '海南',
		"102"=> '四川',
		"176"=> '贵州',
		"105"=> '云南',
		"107"=> '陕西',
		"110"=> '甘肃',
		"177"=> '青海',
		"170"=> '内蒙古',
		"108"=> '广西',
		"143"=> '宁夏',
		"171"=> '新疆'	
	);
}

//判断是否为游记阅读版
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
			
			//首楼大于100个字
			if ($v['first']) {				
				$message = discuzcode($v['message']);
				$message = strip_tags($message);
				$tempCnt = mb_strlen($message);
				if ($tempCnt < 100) {
					$isbe = false;
					break;
				}
			}
			
			//作者的楼数大于9
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


//获得文章的板块
function getArticleFids() {
	return array(
		"12"=> '户外大厅',
		"146"=> '户外美食',
		"58"=> '户外经理人',
		"489"=> '户外先锋营',
		"24"=> '山伍成群',
		"135"=> '岩壁芭蕾',
		"88"=> '骑行天下',
		"178"=> '探洞|绳索运用',
		"447"=> '水上运动',
		"179"=> '钓鱼',
		"186"=> '滑雪',
		"66"=> '自驾|拼车',
		"495"=> '跑步|越野跑',
		"7"=> '装备天下',
		"101"=> '北京',
		"100"=> '天津',
		"166"=> '重庆',
		"48"=> '上海',
		"104"=> '河北',
		"165"=> '山西',
		"115"=> '辽宁',
		"116"=> '吉林',
		"159"=> '黑龙江',
		"109"=> '江苏',
		"147"=> '浙江',
		"158"=> '安徽',
		"113"=> '福建',
		"111"=> '江西',
		"103"=> '山东',
		"106"=> '河南',
		"164"=> '河北',
		"114"=> '湖南',
		"112"=> '广东',
		"117"=> '海南',
		"102"=> '四川',
		"176"=> '贵州',
		"105"=> '云南',
		"107"=> '陕西',
		"110"=> '甘肃',
		"177"=> '青海',
		"170"=> '内蒙古',
		"108"=> '广西',
		"143"=> '宁夏',
		"171"=> '新疆'	
	);
}


//判断是否为文章阅读版
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
			
			//首楼大于500个字
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



//获得文章阅读版的分类
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