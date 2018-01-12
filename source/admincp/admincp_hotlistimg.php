<?php

/**
 * 热帖图片管理
 * @author gtl 20170302
 */
if (!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
set_time_limit(0);

//页面展示
cpheader();
shownav('topic', '热帖管理');
showsubmenu('热帖管理', array(
	array('热帖列表', 'hotlistimg', !$operation)
));
//数据处理
$memKey = 'cache_mobile_zxrt_list';
$memKeyWeight = 'cache_mobile_zxrt_weight_list';
$memTjKey = "cache_mobile_zxrt_tj_list";
if (!$operation) {
	//若是mencache已到期，则重新缓存
	//deleteranklistthreadcache();
	if (!$hotThreadList = memory('get', $memKey)) {
		$result = _getHotList();
		$hotThreadList = $result['hotThreadList'];
		$weightList = $result['weightList'];
		memory('set', $memKey, $hotThreadList, 3600 * 5);
		memory('set', $memKeyWeight, $weightList, 3600 * 5);
	} else {
		$weightList = memory('get', $memKeyWeight);
	}
	foreach ($weightList as $k => $v) {
		$weightList[$k] = $hotThreadList[$k];
	}

	//推荐+热帖列表
	$alllist = tuijian() + $weightList;

	//表单框架
	echo <<<EOT
	<script src="static/js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript">jQuery.noConflict();</script>
	<script src="static/image/editor/editor_function.js"></script>
	<script>
	function subtype(type){
		jQuery("#submittype").val(type)
	}
   </script>
EOT;

	//添加推荐
	echo "<form method='post' action='admin.php?action=hotlistimg&operation=recommend'>";
	showtableheader('','','style="width:600px"');
	showtablerow('', array('width="120"','','width="200"',''),
		array(
			"推荐帖子ID",
			"<textarea name='tids' rows='5'></textarea>",
			"一行一个",
			"<input type='submit'>"
	));
	showtablefooter();
	echo "</form>";

	//热帖+推荐列表
	echo "<form method='post' action='admin.php?action=hotlistimg&operation=del'>";
	showtableheader();
	showsubtitle(array('','tid', '标题', '操作'));
	foreach ($alllist as $tid => $info) {
		if ($info['forbid']) continue;	//被屏蔽的取消显示
		$poitype = isset($info['poitype'])?1:2;
		$biaoji = isset($info['poitype'])?"<b style='color:blue'>[荐]</b>":"";
		$styletd = $info['forbid']?"style='text-decoration:line-through;color:#c7c6c6;'":"";
		showtablerow('', array('width="30"','class="td25"',$styletd,'width="50"'), array(
								"<input type='checkbox' name='optid[]' value='{$tid}_{$poitype}'>",
								"{$info['tid']}",
								"{$biaoji}<a href='http://bbs.8264.com/thread-{$tid}-1-1.html' target='_blank'>{$info['subject']}</a>",
								"<a href=\"admin.php?action=hotlistimg&operation=edit&tid={$tid}\" target=\"_blank\">[编辑]</a>"
						));
	}
	showtablerow('', array('width="30"','colspan=2','width="50"'), array(
								"",
								"<input type='hidden' name='submittype' id='submittype' value='1'><input type='submit' onclick='subtype(1)' value='删除' class='btn'>&emsp;&emsp;<input type='submit' onclick='subtype(2)' value='撤销删除' class='btn' style='display:none;'>",
								"",
								""
						));
	showtablefooter();
	echo "</form>";
} elseif ($operation == 'edit') {
	$tid = (int) $_GET['tid'];
	if (!$tid) {
		cpmsg(lang('message', '参数错误'), '', 'error');
	}

	//图片上传
	require_once libfile('class/upyun_form');
	$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);
	$opts = array();
	$opts['save-key'] = 'forum/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // 保存路径
	$opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';
	$exptime = TIMESTAMP+1800;

	//获取帖子图片
	$result = DB::fetch_first("SELECT image FROM " . DB::table('forum_post_previewimg') . " WHERE tid = {$tid}" . getSlaveID());
	if($result){
		$piclist = json_decode($result['image'], true);
	}

	//图片列表开始
	showtableheader();
	showtablerow('', array('colspan=2'),array("<a href='http://bbs.8264.com/thread-{$tid}-1-1.html' target='_blank'>点击查看详细页</a>"));
	showsubtitle(array('头图', '替换'));

	//图片上传
	$opts['return-url'] = "http://bbs.8264.com/admin.php?action=hotlistimg&operation=do_back&tid={$tid}&position=0";
	$policy = $upyun->policyCreate($opts);
	$sign = $upyun->signCreate($opts);
	$action = $upyun->action();
	$version = $upyun->version();
	showtablerow('', array('width=300'), array("<img src='".(string)$piclist[0]['pic']."' onerror=\"this.src='http://errorpage.b0.upaiyun.com/img8264-404'\" width=200>", "
		<form method='post' action='{$action}' enctype='multipart/form-data'>
		<input type='hidden' name='bucket' value='{$_G['config']['cdn']['form']['bucket_name']}'>
		<input type='hidden' name='save-key' value='{$opts['save-key']}'>
		<input type='hidden' name='expiration' value='{$exptime}'>
		<input type='hidden' name='signature' value='{$sign}'>
		<input type='hidden' name='policy' value='{$policy}'>
		<input type='hidden' name='return-url' value='{$opts['return-url']}'>
		<input type='hidden' name='allow-file-type' value='{$opts['allow-file-type']}'>
		<input type='file' name='file'>
		<input type='submit' value='替换'></form>
	"));

	//图片上传
	$opts['return-url'] = "http://bbs.8264.com/admin.php?action=hotlistimg&operation=do_back&tid={$tid}&position=1";
	$policy = $upyun->policyCreate($opts);
	$sign = $upyun->signCreate($opts);
	$action = $upyun->action();
	$version = $upyun->version();
	showtablerow('', array('width=300'), array("<img src='".(string)$piclist[1]['pic']."' onerror=\"this.src='http://errorpage.b0.upaiyun.com/img8264-404'\" width=200>", "
		<form method='post' action='{$action}' enctype='multipart/form-data'>
		<input type='hidden' name='bucket' value='{$_G['config']['cdn']['form']['bucket_name']}'>
		<input type='hidden' name='save-key' value='{$opts['save-key']}'>
		<input type='hidden' name='expiration' value='{$exptime}'>
		<input type='hidden' name='signature' value='{$sign}'>
		<input type='hidden' name='policy' value='{$policy}'>
		<input type='hidden' name='return-url' value='{$opts['return-url']}'>
		<input type='hidden' name='allow-file-type' value='{$opts['allow-file-type']}'>
		<input type='file' name='file'>
		<input type='submit' value='替换'></form>
	"));

	//图片上传
	$opts['return-url'] = "http://bbs.8264.com/admin.php?action=hotlistimg&operation=do_back&tid={$tid}&position=2";
	$policy = $upyun->policyCreate($opts);
	$sign = $upyun->signCreate($opts);
	$action = $upyun->action();
	$version = $upyun->version();
	showtablerow('', array('width=300'), array("<img src='".(string)$piclist[2]['pic']."' onerror=\"this.src='http://errorpage.b0.upaiyun.com/img8264-404'\" width=200>", "
		<form method='post' action='{$action}' enctype='multipart/form-data'>
		<input type='hidden' name='bucket' value='{$_G['config']['cdn']['form']['bucket_name']}'>
		<input type='hidden' name='save-key' value='{$opts['save-key']}'>
		<input type='hidden' name='expiration' value='{$exptime}'>
		<input type='hidden' name='signature' value='{$sign}'>
		<input type='hidden' name='policy' value='{$policy}'>
		<input type='hidden' name='return-url' value='{$opts['return-url']}'>
		<input type='hidden' name='allow-file-type' value='{$opts['allow-file-type']}'>
		<input type='file' name='file'>
		<input type='submit' value='替换'></form>
	"));

	showtablefooter();
} elseif ($operation == 'do_back') {
	$tid = (int)$_GET['tid'];
	$position = (int)$_GET['position'];
	if ($_GET['code'] != 200) {
		cpmsg(lang('message', $_GET['message']), '', 'error');
	}
	//签名验证

	//附件信息入库
	$attachdata = array(
		'width' => (int)$_GET['image-width'],
		'dateline' => TIMESTAMP,
		'filetype' => $_GET['mimetype'],
		'filesize' => (int)$_GET['file_size'],
		'attachment' => $_GET['url'],
		'downloads' => 0,
		'isimage' => 1,
		'uid' => 0,
		'dir' => 'forum',
		'serverid' => 99
	);
	$aid = DB::insert('forum_attachment', $attachdata, true);

	//获取帖子图片
	$piclist = array();
	$result = DB::fetch_first("SELECT image FROM " . DB::table('forum_post_previewimg') . " WHERE tid = {$tid}" . getSlaveID());
	if($result){
		$piclist = json_decode($result['image'], true);
	}
	if(isset($piclist[$position])){
		$piclist[$position] = array(
			'pic' => "http://image1.8264.com/{$attachdata['attachment']}",
			'width' => $attachdata['image-width'],
			'aid' => $aid
		);
	}else{
		$piclist[] = array(
			'pic' => "http://image1.8264.com/{$attachdata['attachment']}",
			'width' => $attachdata['image-width'],
			'aid' => $aid
		);
	}
	if($result){
		DB::update('forum_post_previewimg', array('image' => json_encode($piclist), 'isedit' => 1), "tid=$tid");
	}else{
		DB::insert('forum_post_previewimg', array('tid' => $tid, 'image' => json_encode($piclist), 'isedit' => 1, 'dateline' => TIMESTAMP));
	}
	memory('rm', $memTjKey);
	deleteranklistthreadcache();
	clearMCache();
	cpmsg(lang('message', '更新成功'), "admin.php?frames=yes&action=hotlistimg&operation=edit&tid={$tid}", 'success');
} elseif ($operation == 'recommend'){
	$tids = $dbtids = array();
	$tmptids = explode("\r\n", $_POST['tids']);
	foreach ($tmptids as $tid) {
		$tid = (int)trim($tid) && $tids[] = $tid;
	}
	if(empty($tids)){
		cpmsg(lang('message', 'id不可用'), 'admin.php?frames=yes&action=hotlistimg', 'error');
	}
	//和数据库数据对比
	$rows = DB::query("SELECT tid FROM " . DB::table('common_forum_recommend_wap') . " where optype = 1" . getSlaveID());
	while ($row = DB::fetch($rows)) {
		$dbtids[] = $row['tid'];
	}
	$diff = array_diff($tids, $dbtids);
	if(!empty($diff)){
		$diff = array_flip($diff);
	}
	if(empty($diff)){
		cpmsg(lang('message', 'id不可用'), 'admin.php?frames=yes&action=hotlistimg', 'error');
	}

	//去掉已经在热帖中的tid
	if (!$hotThreadList = memory('get', $memKey)) {
		$result = _getHotList();
		$hotThreadList = $result['hotThreadList'];
		$weightList = $result['weightList'];
		memory('set', $memKey, $hotThreadList, 3600 * 5);
		memory('set', $memKeyWeight, $weightList, 3600 * 5);
	} else {
		$weightList = memory('get', $memKeyWeight);
	}
	$diff = array_diff_key($diff, $weightList);
	if(empty($diff)){
		cpmsg(lang('message', 'id不可用'), 'admin.php?frames=yes&action=hotlistimg', 'error');
	}

	//存储、更新缓存
	$data = array();
	foreach ($diff as $key => $value) {
		DB::insert('common_forum_recommend_wap', array('tid' => $key, 'optype' => 1));
	}
	memory('rm', $memTjKey);

	clearMCache();
	cpmsg(lang('message', '更新成功'), "admin.php?frames=yes&action=hotlistimg", 'success');
} elseif ($operation == 'del'){
	$submittype = (int)$_POST['submittype'];
	$tids = $_POST['optid'];
	if(empty($tids)){
		cpmsg(lang('message', '参数错误'), 'admin.php?frames=yes&action=hotlistimg', 'error');
	}
	$caches = array('tuijian' => false, 'retie' => false); //判断需要更新的缓存的种类

	if($submittype == 1){ //删除
		foreach ($tids as $tidstr) {
			list($tid, $poitype) = explode("_", $tidstr);
			if($poitype == 1){
				DB::query("DELETE FROM " . DB::table('common_forum_recommend_wap') . " WHERE tid = {$tid} and optype = 1" . getSlaveID());
				$caches['tuijian'] = true;
			}elseif($poitype == 2){
				$row = DB::fetch_first("SELECT tid FROM " . DB::table('common_forum_recommend_wap') . " where tid = {$tid} and optype = 2" . getSlaveID());
				if(!$row){
					DB::insert('common_forum_recommend_wap', array('tid' => $tid, 'optype' => 2));
					$caches['retie'] = true;
				}
			}
		}
	}elseif($submittype == 2){ //还原
		foreach ($tids as $tidstr) {
			list($tid, $poitype) = explode("_", $tidstr);
			if($poitype == 2){
				$row = DB::fetch_first("SELECT id FROM " . DB::table('common_forum_recommend_wap') . " where tid = {$tid} and optype = 2" . getSlaveID());
				if($row){
					DB::delete('common_forum_recommend_wap', array('id' => $row['id']));
					$caches['retie'] = true;
				}
			}
		}
	}

	$caches['tuijian'] && memory('rm', $memTjKey);
	$caches['retie'] && deleteranklistthreadcache();
	clearMCache();
	cpmsg(lang('message', '更新成功'), "admin.php?frames=yes&action=hotlistimg", 'success');
}

function _getHotList(){
	global $_G;
	$type = 'thread';

	$ranklist_setting = $_G['setting']['ranklist'];
	if (!$ranklist_setting['status']) {
		cpmsg(lang('message', 'ranklist_this_status_off'), '', 'error');
	}
	if (!$ranklist_setting[$type]['available']) {
		cpmsg(lang('message', 'ranklist_this_status_off'), '', 'error');
	}

	$cache_time = $ranklist_setting[$type]['cache_time'];
	$cache_num = $ranklist_setting[$type]['show_num'];
	if ($cache_time <= 0)
		$cache_time = 5;
	$cache_time = $cache_time * 3600;
	if ($cache_num <= 0)
		$cache_num = 20;

	$hotThreadList = array();
	$_hotThreadList = array();
	$before = 604800;
	$orderby = array('replies', 'views', 'favtimes');
	$dateline = !empty($before) ? TIMESTAMP - $before : 0;
	$replyCnt = 0;
	$viewCnt = 0;
	$favCnt = 0;
	$arrUpdate = array();
	$weightList = array();
	$tids = array();
	$postList = array();

	//屏蔽列表 以下查询出的tid将不在热帖展示 查询屏蔽列表-查询本次热帖-筛选应屏蔽数量-再次筛选热帖-设定屏蔽标记-缓存结果
	$rows = DB::query("SELECT tid FROM " . DB::table('common_forum_recommend_wap') . " where optype = 2" . getSlaveID());
	while ($row = DB::fetch($rows)) {
		$forbid[$row['tid']] = $row['tid'];
	}

	$ranklistvars = array();
	loadcache('ranklist_thread');

	foreach ($orderby as $v) {
		$ranklistvars = & $_G['cache']['ranklist_thread']['thisweek_' . $v];
		if (!empty($ranklistvars['lastupdated']) && TIMESTAMP - $ranklistvars['lastupdated'] < $cache_time) {
			$_hotThreadList[$v] = $ranklistvars;
		} else {
			$ranklistvars = _getranklist_threads($cache_num, $dateline, $v, $forbid);
			$ranklistvars['lastupdated'] = TIMESTAMP;
			$ranklistvars['lastupdate'] = dgmdate(TIMESTAMP);
			$ranklistvars['nextupdate'] = dgmdate(TIMESTAMP + $cache_time);
			$_G['cache']['ranklist_thread']['thisweek_' . $v] = $ranklistvars;
			save_syscache('ranklist_thread', $_G['cache']['ranklist_thread']);
		}

		$arrUpdate[$v] = $ranklistvars['lastupdated'];
		unset($ranklistvars['lastupdated'], $ranklistvars['lastupdate'], $ranklistvars['nextupdate']);
		$_hotThreadList[$v] = $ranklistvars;
	}

	//对热帖数据进行整理及算出总回复数、总浏览数、总收藏数
	require_once libfile('function/forumlist');
	foreach ($_hotThreadList as $key => $val) {
		foreach ($val as $v) {
			if ($key == 'replies') {
				$replyCnt += $v['replies'];
			} elseif ($key == 'views') {
				$viewCnt += $v['views'];
			} elseif ($key == 'favtimes') {
				$favCnt += $v['favtimes'];
			}
			if (isset($hotThreadList[$v['tid']])) {
				$hotThreadList[$v['tid']]['lastupdated'] = max($hotThreadList[$v['tid']]['lastupdated'], $arrUpdate[$key]);
				continue;
			}
			$v['lastupdated'] = $arrUpdate[$key];
			$hotThreadList[$v['tid']] = $v;
			$tids[$v['tid']] = $v['tid'];
		}
	}

	//获得头帖内容
	if ($tids) {
		$tids = implode(',', $tids);
		$query = DB::query("SELECT * FROM " . DB::table('forum_post') . " p WHERE p.first=1 and p.tid in ({$tids})" . getSlaveID());
		while ($v = DB::fetch($query)) {
			$v['typeid'] = !empty($hotThreadList[$v['tid']]['typeid']) ? $hotThreadList[$v['tid']]['typeid'] : 0;
			$postList[$v['tid']] = _viewthread_procpost($v);
		}
	}

	//热帖权重计算
	$replyCnt = max($replyCnt, 1);
	$viewCnt = max($viewCnt, 1);
	$favCnt = max($favCnt, 1);
	$r_v = $replyCnt / $viewCnt;
	$r_f = $replyCnt / $favCnt;
	foreach ($hotThreadList as $k => $v) {
		$v['dateline'] = strtotime($v['dateline']);
		$t = ($v['lastupdated'] - $v['dateline']) / 3600;
		$v['weight'] = ($v['replies'] + $v['views'] * $r_v + $v['favtimes'] * $r_f) / $t;
		$v['message'] = !empty($postList[$v['tid']]['message']) ? $postList[$v['tid']]['message'] : '';
		$v['imgList'] = !empty($postList[$v['tid']]['imgList']) ? $postList[$v['tid']]['imgList'] : array();
		unset($v['lastupdated'], $v['rank']);
		$hotThreadList[$k] = $v;
		$weightList[$v['tid']] = $v['weight'];
		if ($v['fid'] == 53) {
			unset($hotThreadList[$v['tid']], $weightList[$v['tid']]);
		} //过滤掉装备交易版帖子
	}
	arsort($weightList);

	return array('hotThreadList' => $hotThreadList, 'weightList' => $weightList);
}

function _getranklist_threads($num = 20, $dateline = 0, $orderby = 'replies', $forbid = array()) {
	$dateline = !$dateline ? TIMESTAMP - 86400 * 30 : $dateline;
	$threadlist = array();

	require_once libfile('function/space');
	$dianpingFids = getdianpingfids();
	$notfids = implode(',', array_merge($dianpingFids, array(161,5,53,489,185)));

	//计算数量 主要是计算本次需要查询出多少数据（$num）
	$query1 = DB::query("SELECT t.tid
			FROM " . DB::table('forum_thread') . " t
			LEFT JOIN " . DB::table('forum_forum') . " f USING(fid)
			WHERE t.dateline>='$dateline' AND t.displayorder>='0' and f.fup not in(36) and t.fid not in({$notfids})
			ORDER BY t.$orderby desc
			LIMIT 0, $num" . getSlaveID());
	while ($thread = DB::fetch($query1)) {
		isset($forbid[$thread['tid']]) && $num++;
	}

	//查询数据
	$query = DB::query("SELECT t.tid, t.fid, t.author, t.authorid, t.subject, t.dateline, t.views, t.replies, t.favtimes, t.sharetimes, t.typeid, f.name AS forum
			FROM " . DB::table('forum_thread') . " t
			LEFT JOIN " . DB::table('forum_forum') . " f USING(fid)
			WHERE t.dateline>='$dateline' AND t.displayorder>='0' and f.fup not in(36) and t.fid not in({$notfids})
			ORDER BY t.$orderby desc
			LIMIT 0, $num" . getSlaveID());
	$rank = 0;
	while ($thread = DB::fetch($query)) {
		++$rank;
		$thread['rank'] = $rank;
		$thread['dateline'] = dgmdate($thread['dateline']);
		$thread['forbid'] = 0; //默认值
		isset($forbid[$thread['tid']]) && $thread['forbid'] = 1;
		$threadlist[] = $thread;
	}
	return $threadlist;
}

function _viewthread_procpost($post) {
	global $_G;

	require_once libfile('function/discuzcode');
	require_once libfile('function/attachment');

	$post['attachments'] = array();
	$post['imagelist'] = $post['attachlist'] = '';

	//只对网络图片起作用
	$post['message'] = preg_replace("/\[swf\]\s*([^\[\<\r\n]+?)\s*\[\/swf\]/ies", "", $post['message']);
	$post['message'] = preg_replace("/\[media=([\w,]+)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/ies", "", $post['message']);

	$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], $post['htmlon'] & 1, 0, 1, 1, 1, 0, 0, $post['authorid'], 1, $post['pid']);

	//户外摄影-每日一图,我秀我户外-女驴秀
	if ($post['fid'] == 39 || $post['fid'] == 443 || ($post['fid'] == 56 && $post['typeid'] == 77)) {
		$post['imgList'] = _getMessageImage($post['tid'], 1, '0');
		$post['message'] = '';
	} else {
		$message = _getMessageText($post);
		$post['imgList'] = _getMessageImage($post['tid'], 3, '230,150');
		$post['message'] = $message;
	}
	return array('message' => $post['message'], 'imgList' => $post['imgList']);
}

//得到帖子中的文本
function _getMessageText($post) {
	$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
	$post['message'] = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $post['message']); //处理掉不显示的font标签
	$post['message'] = preg_replace('/下载地址回复可见.*<\/p>/isU', '</p>', $post['message']);
	$post['message'] = preg_replace('/本帖最后由.*编辑/isU', '', $post['message']); //本帖最后由...编辑
	$post['message'] = strip_tags($post['message']);
	$post['message'] = preg_replace('/\s|&nbsp;/', '', $post['message']);
	return $post['message'];
}

//得到帖子内容中的图片 gtl 新版
function _getMessageImage($tid, $max = 1, $wh) {
	global $_G;
	$imgList = array();
	$result = DB::fetch_first("SELECT tid, image FROM " . DB::table('forum_post_previewimg') . " WHERE tid = $tid" . getSlaveID());
	if ($result) {
		$pic = json_decode($result['image'], true);
		if ($max == 3 && count($pic) < $max) {
			$pic = array($pic[0]);
		}
		$suffix = "wapw320h0";
		foreach ($pic as $info) {
			//$imgList[] = _replace_post_image($info['pic'], $tid, $wh);
			$imgList[] = "<img file='{$info['pic']}!{$suffix}' id='{$tid}' class='lazy' data-original='{$info['pic']}!{$suffix}'/>";
		}
	}
	return $imgList;
}

//获取热帖推荐
function tuijian(){
	$memKey = "cache_mobile_zxrt_tj_list";
	//memory('rm', $memKey);
	if (!$recommendList = memory('get', $memKey)) {
		$recommendList = array();

		$rows = DB::query("SELECT tid FROM " . DB::table('common_forum_recommend_wap') . ' where optype = 1' . getSlaveID());
		while ($row = DB::fetch($rows)) {
			$dbtids[] = $row['tid'];
		}
		if(!empty($dbtids)){
			$wheresql = implode(",", $dbtids);
			$query = DB::query("SELECT t.tid, t.fid, t.author, t.authorid, t.subject, t.dateline, t.views, t.replies, t.favtimes, t.sharetimes, t.typeid, f.fup, f.name AS forum
				FROM " . DB::table('forum_thread') . " t
				LEFT JOIN " . DB::table('forum_forum') . " f USING(fid)
				WHERE t.tid in ({$wheresql})
				ORDER BY FIND_IN_SET(t.tid, '{$wheresql}') " . getSlaveID());
			while ($thread = DB::fetch($query)) {
				$recommendList[$thread['tid']] = $thread;
				$tids[] = $thread['tid'];
			}
		}

		//获得头帖内容
		if ($tids) {
			$tids = implode(',', $tids);
			$query = DB::query("SELECT * FROM " . DB::table('forum_post') . " p WHERE p.first=1 and p.tid in ({$tids})" . getSlaveID());
			while ($v = DB::fetch($query)) {
				$v['typeid'] = !empty($recommendList[$v['tid']]['typeid']) ? $recommendList[$v['tid']]['typeid'] : 0;
				$postList[$v['tid']] = _viewthread_procpost($v);
			}
		}
		if(!empty($recommendList)){
			foreach ($recommendList as $k => $v) {
				$v['dateline'] = strtotime($v['dateline']);
				$v['message'] = !empty($postList[$v['tid']]['message']) ? $postList[$v['tid']]['message'] : '';
				$v['imgList'] = !empty($postList[$v['tid']]['imgList']) ? $postList[$v['tid']]['imgList'] : array();
				$v['poitype'] = 1;
				$v['forbid'] = 0;
				$recommendList[$k] = $v;
			}
		}
		memory('set', $memKey, $recommendList, 3600 * 5);
	}
	return $recommendList;
}

function deleteranklistthreadcache() {
	global $memKey, $memKeyWeight;
	//清理一级缓存
	memory('rm', 'ranklist_thread');
	DB::query("DELETE FROM " . DB::table('common_syscache') . " WHERE cname='ranklist_thread'");
	@unlink(DISCUZ_ROOT . './data/cache/cache_ranklist_thread.php');
	//重新生成缓存并加载到二级缓存中
	$result = _getHotList();
	$hotThreadList = $result['hotThreadList'];
	$weightList = $result['weightList'];
	memory('set', $memKey, $hotThreadList, 3600 * 5);
	memory('set', $memKeyWeight, $weightList, 3600 * 5);
}

function clearMCache(){
	file_get_contents("http://m.8264.com/?nocache=1");
	for ($i = 2; $i < 16; $i++) {
		$url = "http://m.8264.com/index.php?d=forum&c=home&m=ajaxThreadHotMore&nocache=1";
		$post_data = array("page" => $i);
		curlPost($url, $post_data);
	}
}

function curlPost($url, $post_data) {
	$ch = curl_init();
	curl_setopt($ch , CURLOPT_URL, $url);
	curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
	// post数据
	curl_setopt($ch , CURLOPT_POST, 1);
	curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
