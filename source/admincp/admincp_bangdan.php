<?php

/**
 * 榜单管理 主要服务于seo
 * @author gtl 20160301
 */
if (!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
set_time_limit(0);
require DISCUZ_ROOT . './config/config_dianping.php';
include_once libfile('function/home');
include_once libfile('function/cloud');
include_once libfile('function/dianping');
$cateid = 910;
$puid = '40344277'; //将此用户设置为榜单发帖人
$puname = '8264户外小编'; //将此用户设置为榜单发帖人
$ranklist_style = "<style>
	.dptitle{display: block; height: 36px; overflow: hidden; padding: 4px 106px 0px 0px; position: relative ;}
	.dptitle i{ font-size:20px; color:#f98361; font-style:normal;}
	.dptitle a{ color:#1e6d9b; font-size:100%; padding:0px 16px; vertical-align:2px}
	.dptitle a.moredp{ padding: 0; position: absolute; right: 0; top: 6px; }
	.dptitle em{color: #585858; font-size: 14px; position: absolute; right: 63px; top: 8px;}
	.newscon p.dpcon{ border-bottom:#eeeeee solid 1px; padding:10px 0px 22px 0px; background:url(http://static.8264.com/static/images/portal/dpicon.jpg) 0 23px no-repeat; text-indent:15px; margin-bottom:6px;}
	.newscon p .namemorelink{ color:#1e6d9b}

	.newscon p .morelink{background: url('http://static.8264.com/static/images/portal/topic-mask.png') no-repeat left top;    bottom: 3px;    color: #1e6d9b;    height: 20px;    position: absolute;    right: 0;
		width: 100px;}

	.newscon p.dpcon span{ display:block; overflow:hidden; position:relative;}
</style>
<script>
jQuery(function (){
	jQuery(\"p.dpcon span\").each(function(i){
		var dph = jQuery(this).height();
		var url = jQuery(this).parent().prev('span').find('a').attr('href');
		if (dph>86){
			jQuery(this).height(86).append(\"<em class='morelink'></em>\");
		}
	});
});
</script>";
$ranklist_style ="";
//$ranklist_html = '<span class="dptitle"><i>NO.%u</i><a href="%s" target="_blank">%s</a><em>%s分</em><a href="%s" class="moredp" target="_blank">详情>></a></span><p class="dpcon"><span>%s</span></p>';
$ranklist_html = '<p class="bangdanbox"><b><i>NO.%u</i>%s</b>得分：%s&nbsp;&nbsp;<a target="_blank" href="%s">详情&gt;&gt;</a><span>%s</span></p>';
$source_html = '<p style="text-align:right">数据来源于 <a href="%s" style="color:#1e6d9b;">8264点评系统</a></p>';
$mod2url = array(
	'brand' => 'http://www.8264.com/pinpai',
	'equipment' => 'http://www.8264.com/zhuangbei.html',
	'shop' => 'http://www.8264.com/dianpu',
	'climb' => 'http://www.8264.com/panpa/',
	'skiing' => 'http://www.8264.com/xuechang',
	'diving' => 'http://www.8264.com/qianshui/',
	'mountain' => 'http://www.8264.com/shanfeng',
	'line' => 'http://www.8264.com/xianlu',
	'fishing' => 'http://www.8264.com/diaoyu/',
	'club' => 'http://www.8264.com/julebu/',
	'hostel' => 'http://www.8264.com/kezhan/'
);
$rand_start = array(
	'<p>8264榜单功能为您提供2016最新户外类排行榜和用户点评大全。8264户外排行榜汇集国内外最专业的户外圈从业者和用户，为您提供最专业最写实的点评信息，玩户外就上8264！</p>',
	'<p>本排行榜是由8264小编精心摘录的由用户提供的专业数据排行榜，最权威的展示了户外界的各项点评信息，户外排行榜可以更方便、更直观的帮助用户找到自己需要的信息。</p>',
	'<p>作为户外行业从业最久、人气最高的专业门户网站，8264为您提供由用户提供、小编精选的最专业户外类点评排行榜系统，帮助您详细了解户外行业，找到您所需要的内容。</p>'
);
$rand_end = array(
	'<p>以上是本文的所有内容，不知是否满足了您的需求，欢迎您持续关注8264！</p>',
	'<p>好了，榜单的内容就到这里，如果您喜欢我们的内容，请为我们的小编在您的心里点个赞，谢谢。</p>',
	'<p>榜单内容到此结束，感谢您的认真阅读，希望您能有所收获。</p>'
);

//ajax 不需要页面展示 初始化列表
if ($operation == 'initlist') {
	$ids = trim($_POST['ids']);
	$ids = str_replace('，', ',', $ids);
	$ids = explode(',', $ids);
	foreach ($ids as $key => $id) {
		$ids[$key] = (int) trim($id);
		if ($ids[$key] < 1) {
			unset($ids[$key]);
		}
	}
	$ids = array_unique($ids);
	if (empty($ids)) {
		echo json_encode(array(
			'status' => 0,
			'data' => '',
			'msg' => diconv("无效的id", "GBK", "UTF-8")
		));
		exit();
	}

	//用于排序
	foreach ($ids as $k => $id) {
		$tmp[$id] = array();
	}
	$ids = implode(',', $ids);
	$query = DB::query('SELECT tid,subject FROM ' . DB::table('forum_thread') . ' where tid in (' . $ids . ')');
	while ($row = DB::fetch($query)) {
		$tmp[$row['tid']] = array(
			'tid' => $row['tid'],
			'title' => diconv($row['subject'], "GBK", "UTF-8")
		);
	}
	//格式转化 用于排序
	foreach ($tmp as $k => $info) {
		!empty($info) && $threads[] = $info;
	}
	if(empty($threads)){
		echo json_encode(array(
			'status' => 0,
			'data' => '',
			'msg' => diconv("无效的id", "GBK", "UTF-8")
		));
		exit();
	}

	echo json_encode($threads);
	exit();
}

//页面展示
cpheader();
shownav('topic', '榜单管理');
showsubmenu('榜单管理', array(
	array('添加新榜单', 'bangdan', !$operation), //第三个参数代表是否是当前菜单
	array('批量添加榜单', 'bangdan&operation=batadd', $operation == 'batadd'), //第三个参数代表是否是当前菜单
	array('榜单列表', "portal-portalcp-ac-category-catid-{$cateid}.html", false, 1, 1),
));
//数据处理
if (!$operation) {
	if (submitcheck('addsubmit')) { //代表提交
		$id = 0;
		$idtype = '';
		$article_status = 0; //默认为发布 可能会根据条件变化而更新
		$allowcomment = 0; //默认不允许评论
		$content = getstr($_POST['content'], 0, 1, 1, 0, 1);
		$summary = portalcp_get_summary(stripslashes($_POST['content']));
		$setarr = array(
			'title' => $_POST['title'], //标题
			'shorttitle' => '', //短标题 为空
			'author' => '', //文章原作者 为空
			'from' => '', //文章来源 为空
			'fromurl' => '', //来源地址 为空
			'dateline' => TIMESTAMP, //发布时间 TIMESTAMP
			'url' => '', //跳转URL 为空
			'allowcomment' => $allowcomment, //默认允许评论
			'summary' => $summary, //摘要从内容中截取 addslashes？
			'prename' => '', //什么鬼
			'preurl' => NULL, //什么鬼
			'catid' => $cateid, //榜单id
			'tag' => 0, //无
			'status' => $article_status, //看其他数据 根据判断来 文章审核状态
			'lastuid' => $puid, //看数据字典 $_G['uid']
			'lastname' => $puname, //看数据字典 $_G['username']
			'ip' => $_G['clientip'], //发布者ip $_G['clientip']
			'lasttime' => TIMESTAMP, //看数据字典 TIMESTAMP
			'uid' => $puid, //数据字典
			'username' => $puname, //数据字典
			'id' => 0, //为0 是一个复制已有帖子内容的功能
			'pubtime' => TIMESTAMP,
		);

		//todo
		//获取到fid
		//获取到点评信息
		//拼接html
		//连接到内容入库
		foreach ($dp_modules as $mod => $modinfo) {
			$tables[$modinfo['fid']] = array(
				'mod' => $mod,
				'tablename' => "dianping_{$mod}_info",
			);
		}
		$initlist = $_POST['initlist'];
		foreach ($initlist as $k => $thread) {
			//评分
			$query = DB::query("SELECT ff.fid,ff.name,ff.fup FROM " . DB::table('forum_thread') . " as ft LEFT JOIN " . DB::table('forum_forum') . " as ff ON ft.fid=ff.fid where ft.tid = " . $thread['tid']);
			$row = DB::fetch($query);
			$tablename = $tables[$row['fid']]['tablename'];
			while ($row['fup'] > 0 && !$tablename) {
				$query = DB::query("SELECT fid,fup FROM " . DB::table('forum_forum') . " where fid = " . $row['fup']);
				$row = DB::fetch($query);
				$tablename = $tables[$row['fid']]['tablename'];
			}
			if ($tablename) {
				$query = DB::query("SELECT i.tid, i.subject, i.showimg, i.dir, i.serverid, i.score, i.cnum FROM " . DB::table($tablename) . " AS i WHERE i.ispublish=1 and tid=" . $thread['tid']);
				$initlist[$k]['info'] = DB::fetch($query); //评分
			}

			//所属模块
			$initlist[$k]['mod'] = $tables[$row['fid']]['mod'];
			//评价
			$initlist[$k]['comment'] = trim($thread['comment']);
			if (empty($initlist[$k]['comment'])) {
				$query = DB::query("SELECT s.starnum,s.uid, s.goodpoint, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
					FROM " . DB::table("dianping_star_logs") . " AS s
					LEFT JOIN " . DB::table("forum_post") . " AS p ON s.pid=p.pid
					LEFT JOIN " . DB::table("forum_thread") . " AS t ON t.tid=p.tid
					WHERE p.first=0 AND p.tid = '{$thread['tid']}' AND p.rate>0
					ORDER BY p.dateline DESC
					LIMIT 1 " . getSlaveID());
				$row = DB::fetch($query);
				if(empty($row)){
					$query = DB::query("SELECT s.starnum,s.uid, s.goodpoint, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
						FROM " . DB::table("dianping_star_logs") . " AS s
						LEFT JOIN " . DB::table("forum_post") . " AS p ON s.pid=p.pid
						LEFT JOIN " . DB::table("forum_thread") . " AS t ON t.tid=p.tid
						WHERE p.first=0 AND p.tid = '{$thread['tid']}' AND p.rate = 0
						ORDER BY p.dateline DESC
						LIMIT 1 " . getSlaveID());
					$row = DB::fetch($query);
				}
				if (!empty($row)) {
					$initlist[$k]['new_comment'] = "（来自<a href='home.php?mod=space&uid={$row['authorid']}' class='namemorelink'>@{$row['author']}</a>）：" . $row['message'];
				}
			}
		}
		$rank_list = $ranklist_style;
		foreach ($initlist as $key => $item) { //组合成html
			$mod = $item['mod'];
			$num = $key+1;
			$rank_list.= sprintf($ranklist_html, $num, $item['subject'], (string)$item['score'], dp_rewrite("http://www.8264.com/dianping.php?mod={$mod}&act=showview&tid={$item['tid']}"), ($item['comment'] ? "推荐理由：{$item['comment']}" : ($item['new_comment'] ? "最新点评{$item['new_comment']}" : '')));
		}
		$content.=addslashes(get_rand($rand_start).$rank_list.get_rand($rand_end).sprintf($source_html, 'http://www.8264.com/zhuangbei.html'));

		//标题入库
		$aid = DB::insert('portal_article_title', $setarr, 1); #标题表
		//统计数据
		DB::update('common_member_status', array('lastpost' => TIMESTAMP), array('uid' => $puid));
		DB::query('UPDATE ' . DB::table('portal_category') . " SET articles=articles+1 WHERE catid = '{$setarr['catid']}'");
		DB::insert('portal_article_count', array('aid' => $aid, 'catid' => $setarr['catid'], 'dateline' => $setarr['dateline'], 'viewnum' => 1));

		//内容入库
		$pageorder = DB::result(DB::query("SELECT MAX(pageorder) FROM " . DB::table('portal_article_content') . " WHERE aid='$aid'"), 0);
		$pageorder = $pageorder + 1;
		#我们只考虑一页
		DB::query("INSERT INTO " . DB::table('portal_article_content') . "
			(aid, content, pageorder, dateline, id, idtype)
			VALUES ('$aid', '{$content}', '{$pageorder}', '{$setarr['pubtime']}', '$id', '$idtype')");

		$url = preg_replace('/\/admin\.php\?/i', '', $url);
		cpmsg('发布成功！', $url, 'succeed');
	}
	//表单框架
	echo <<<EOT
	<script src="static/js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript">jQuery.noConflict();</script>
	<script src="static/image/editor/editor_function.js"></script>
	<script>
	function validate(obj) {
		edit_save();
		window.onbeforeunload = null;
		//标题
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('标题不能为空！');
			return false;
		}
		//排行榜列表
		var initlisttb = jQuery("#initlisttb:visible").length;
		if(initlisttb<1){
			alert('还未生成排行榜列表！');
			return false;
		}
		return true;
	}
	//去除所有空格
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//去除两端空格
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	function setlist(){
		var ids = jsTrimAll(jQuery("input[name=ids]").val());
		jQuery("input[name=ids]").val(ids);
		if(ids == ''){
			return false;
		}
		jQuery.ajax({
			type : 'POST',
			url : '/admin.php?action=bangdan&operation=initlist',
			data : {ids:ids},
			success:function(html){
				html = eval("("+html+")");
				if(html.data == 0){
					alert(html.msg);
					return false;
				}
				var inithtml = '<table width=550>';
				for(i in html){
					num = Number(i)+1;
					inithtml+="<tr><td>第"+num+"条</td><td>"+html[i].title+"</td></tr>";
					inithtml+="<tr><td>tid</td><td><input type='text' name='initlist["+i+"][tid]' value='"+html[i].tid+"'></td></tr>";
					inithtml+="<tr><td>推荐理由</td><td><textarea name='initlist["+i+"][comment]' style='width:476px;'></textarea></td></tr>";
				}
				inithtml+= '</table>';
				jQuery("#initlisttb").html("<td>"+inithtml+"</td>");
				jQuery("#initlisttb").show();
			}
		});
	}
	</script>
EOT;
	showformheader('bangdan', 'onsubmit="return validate(this);"', 'bdforum');
	showtableheader();
	showsetting('榜单标题', 'title', '', 'text', '', '', '', 'style="width:547px;"'); #榜单标题
	showtablerow('', array('class="td27" colspan="2"'), array('榜单导语：<textarea class="userData" name="content" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
	showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
	showtablerow('', array('class="td27" colspan="2"'), array('点评ID：'));
	showtablerow('', array('class="td27" colspan="2"'), array('<input type="text" class="txt" name="ids" style="width:486px;"><a href="javascript:void(0);" onclick="setlist()">生成列表</a>'));
	showtablerow('style="display:none;" id="initlisttb"', array('colspan="2" style="padding: 0px;"'), '');
	showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
	showtablefooter();
	showformfooter();
} elseif ($operation == 'batadd') {
	if (submitcheck('addsubmit')) {
		$redirect = 'action=bangdan&operation=batadd';
		if(empty($_POST['urls'])){
			cpmsg('数据有问题！', $redirect, 'error');
		}

		//数据格式化
		$urls = explode("\r\n", $_POST['urls']);
		$urls = array_unique($urls);
		foreach ($urls as $key => $url) {
			$urls[$key] = trim($url);
			if(empty($urls[$key])){
				unset($urls[$key]);
			}
		}
		if(empty($urls)){
			cpmsg('数据有问题！', $redirect, 'error');
		}

		//循环发出http请求
		foreach ($urls as $key => $url) {
			//获取排行榜数据、格式化数据
			$jsondata = file_get_contents($url.'?ajaxfrom=admin');
			$initlist = json_decode($jsondata, true);
			if(empty($initlist['data'])){
				continue;
			}
			//对每篇排行榜数据格式化
			$initlist['title'] = diconv($initlist['title'], "UTF-8", "GBK");
			foreach($initlist['data'] as $k=>$item){
				foreach($item as $k2=>$v){
					$initlist['data'][$k][$k2] = diconv($v, "UTF-8", "GBK");
				}
			}
			//生成文章中的排行榜部分
			$rank_list = $ranklist_style;
			$mod = $initlist['mod'];
			foreach ($initlist['data'] as $key => $item) { //组合成html
				$num = $key+1;
				$rank_list.= sprintf($ranklist_html, $num, $item['subject'], (string)$item['score'], dp_rewrite("http://www.8264.com/dianping.php?mod={$mod}&act=showview&tid={$item['tid']}"), ($item['comment'] ? "推荐理由：{$item['comment']}" : ($item['new_comment'] ? "最新点评{$item['new_comment']}" : '')));
			}
			$content = addslashes(get_rand($rand_start).$rank_list.get_rand($rand_end).sprintf($source_html, $mod2url[$mod]?$mod2url[$mod]:'http://www.8264.com/zhuangbei.html')); //排行榜 不包括导语
			$id = 0;
			$idtype = '';
			$article_status = 0; //默认为发布 可能会根据条件变化而更新
			$allowcomment = 0; //默认不允许评论
			$summary = portalcp_get_summary(stripslashes($initlist['title']));
			$setarr = array(
				'title' => $initlist['title'], //标题
				'shorttitle' => '', //短标题 为空
				'author' => '', //文章原作者 为空
				'from' => '', //文章来源 为空
				'fromurl' => '', //来源地址 为空
				'dateline' => TIMESTAMP, //发布时间 TIMESTAMP
				'url' => '', //跳转URL 为空
				'allowcomment' => $allowcomment, //默认允许评论
				'summary' => $summary, //摘要从内容中截取 addslashes？
				'prename' => '', //什么鬼
				'preurl' => NULL, //什么鬼
				'catid' => $cateid, //榜单id
				'tag' => 0, //无
				'status' => $article_status, //看其他数据 根据判断来 文章审核状态
				'lastuid' => $puid, //看数据字典 $_G['uid']
				'lastname' => $puname, //看数据字典 $_G['username']
				'ip' => $_G['clientip'], //发布者ip $_G['clientip']
				'lasttime' => TIMESTAMP, //看数据字典 TIMESTAMP
				'uid' => $puid, //数据字典
				'username' => $puname, //数据字典
				'id' => 0, //为0 是一个复制已有帖子内容的功能
				'pubtime' => TIMESTAMP,
			);

			//标题入库
			$aid = DB::insert('portal_article_title', $setarr, 1); #标题表

			//统计数据
			DB::update('common_member_status', array('lastpost' => TIMESTAMP), array('uid' => $puid));
			DB::query('UPDATE ' . DB::table('portal_category') . " SET articles=articles+1 WHERE catid = '{$setarr['catid']}'");
			DB::insert('portal_article_count', array('aid' => $aid, 'catid' => $setarr['catid'], 'dateline' => $setarr['dateline'], 'viewnum' => 1));

			//内容入库
			$pageorder = DB::result(DB::query("SELECT MAX(pageorder) FROM " . DB::table('portal_article_content') . " WHERE aid='$aid'"), 0);
			$pageorder = $pageorder + 1;
			#我们只考虑一页
			DB::query("INSERT INTO " . DB::table('portal_article_content') . "
				(aid, content, pageorder, dateline, id, idtype)
				VALUES ('$aid', '{$content}', '{$pageorder}', '{$setarr['pubtime']}', '$id', '$idtype')");
		}
		cpmsg('创建成功！', $redirect, 'succeed');
	}
	showformheader('bangdan&operation=batadd', '', 'bataddforum');
	showtableheader();
	showtablerow('', array('class="td27" colspan="2"'), array('数据源链接：每条链接以换行分割，仅支持点评下的各级分类列表页'));
	showtablerow('', array('class="td27" colspan="2"'), array('<textarea class="userData" name="urls" style="width: 550px;height: 300px;"></textarea>'));
	showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='提交'  name='addsubmit'>"));
	showtablefooter();
	showformfooter();
}

function portalcp_get_summary($message) {
	$message = preg_replace(array("/\[attach\].*?\[\/attach\]/", "/\&[a-z]+\;/i", "/\<script.*?\<\/script\>/"), '', $message);
	$message = preg_replace("/\[.*?\]/", '', $message);
	$message = getstr(strip_tags($message), 200);
	return $message;
}

function get_rand($rsource){
	$max = count($rsource)-1;
	$index = rand(0,$max);
	return $rsource[$index];
}
