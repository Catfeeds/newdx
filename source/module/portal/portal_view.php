<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: portal_view.php 19121 2010-12-16 08:06:35Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}



if(!isset($_GET['isrwurl']) && !empty($_GET['aid']) && !isset($_GET['abc'])){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$_G['config']['web']['portal']."viewnews-".$_GET['aid']."-page-".(isset($_GET['page']) ? $_GET['page'] : "1").".html");
}
//引入产品分享所需的程序类 at 2012.2.9
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/include.php';
$cpdl = ForumOptionProduce::getTypeData();
//end

$aid = empty($_GET['aid'])?0:intval($_GET['aid']);
if(empty($aid)) {
	showmessage("view_no_article_id");
}
$article = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_title')." WHERE aid='$aid'");
require_once libfile('function/portalcp');
$permission = getallowcategory($_G['uid']);

if(empty($article) || ($article['status'] > 0 && $article['uid'] != $_G['uid'] && !$_G['group']['allowmanagearticle'] && empty($permission[$article['catid']]['allowmanage']) && $_G['adminid'] != 1 && $_G['gp_modarticlekey'] != modauthkey($article['aid']))) {
	// showmessage("view_article_no_exist");
	header('HTTP/1.1 404 Not Found');
	header('Status: 404');
	echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 portal</center></body></html>";
	exit;
}

$article_count = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$aid'");
if($article_count) $article = array_merge($article_count, $article);


if($article_count) {
	DB::query("UPDATE ".DB::table('portal_article_count')." SET catid='$article[catid]', dateline='$article[dateline]', viewnum=viewnum+1 WHERE aid='$aid'");
	//记录文章的UV
	require_once libfile('class/myredis');
	$redis = & myredis::instance(6381);
	$uv_key = 'article_uv_'.substr(md5($_G['clientip'].$_SERVER['HTTP_USER_AGENT'].$_G['uid']), 0, 10);
	$is_viewed = $redis->sismember($uv_key, $aid);
	if(!$is_viewed) {
		$redis->sadd($uv_key, $aid);
		$redis->expire($uv_key, 86400);
		DB::query("UPDATE ".DB::table('portal_article_count')." SET uvnum=uvnum+1 WHERE aid='$aid'");
	}

} else {
	DB::insert('portal_article_count', array(
		'aid'=>$aid,
		'catid'=>$article['catid'],
		'dateline'=>$article['dateline'],
		'viewnum'=>1,
		'uvnum'=>1,
		));
}


if($article['url']) {
	dheader("location:{$article['url']}");
	exit();
}


$cat = category_remake($article['catid']);

$article['pic'] = pic_get($article['pic'], 'portal', 0, $article['remote'],1,$article['serverid']);

$page = intval($_GET['page']);
if($page<1) $page = 1;
//增加对URL随意填写的PAGE访问
$real_page = DB::result_first("SELECT count(*) FROM ".DB::table('portal_article_content')." WHERE aid='$aid' ORDER BY pageorder");
if($page > $real_page)
{
	header('HTTP/1.1 404 Not Found');
	header('Status: 404');
	echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 portal</center></body></html>";
	exit;
}
$start = $page-1;

$content = array();
$multi = '';

$query = DB::query("SELECT * FROM ".DB::table('portal_article_content')." WHERE aid='$aid' ORDER BY pageorder LIMIT $start,1");
$content = DB::fetch($query);

require_once libfile('function/blog');
$content['content'] = blog_bbcode($content['content']);
$ss_url = 'http://www.8264.com/'; // 请将此链接地址改为您的 SS 站点地址！！！
$findarr = array(
	$ss_url.'batch.download.php?aid=', // 附件下载地址
	$ss_url.'attachments/',  // 附件图片目录
	$ss_url.'images/base/attachment.gif'  // 附件下载图标
);
$replacearr = array(
	'portal.php?mod=attachment&id=',
	$_G['setting']['attachurl'].'/portal/',
	'http://static.8264.com/static/image/filetype/attachment.gif'
);
$content['content'] = str_replace($findarr, $replacearr, $content['content']);
/*此处因迁移CDN，将2014年9月23日0点0分0秒前的附件地址变更到CDN地址*/
if($content['dateline'] < 1411401600){
	$content['content'] = str_replace($_G['config']['web']['attach'], "http://image1.8264.com/", $content['content']);
}
/*结束*/
$multi = multi($article['contents'], 1, $page, "portal.php?mod=view&aid=$aid");
$org = array();
if($article['idtype'] == 'tid' || $content['idtype']=='pid') {
	require_once libfile('function/discuzcode');
	$posttable = getposttablebytid($article['id']);
	if($content['idtype']=='pid') {
		$firstpost = DB::fetch_first("SELECT p.first, p.authorid AS uid, p.author AS username, p.dateline, p.message, p.smileyoff, p.bbcodeoff, p.htmlon, p.attachment, p.pid, t.displayorder
			FROM ".DB::table($posttable)." p LEFT JOIN ".DB::table('forum_thread')." t USING(tid) WHERE p.pid='$content[id]' AND p.tid='$article[id]' " . getSlaveID());
	} else {
		$firstpost = DB::fetch_first("SELECT p.first, p.authorid AS uid, p.author AS username, p.dateline, p.message, p.smileyoff, p.bbcodeoff, p.htmlon, p.attachment, p.pid, t.displayorder
			FROM ".DB::table($posttable)." p LEFT JOIN ".DB::table('forum_thread')." t USING(tid) WHERE p.tid='$article[id]' AND p.first='1' " . getSlaveID());
	}
	if(!empty($firstpost) && $firstpost['displayorder'] != -1) {
		$attachpids = -1;
		$attachtags = $aimgs = array();
		$firstpost['message'] = $content['content'];
		if($firstpost['attachment']) {
			if($_G['group']['allowgetattach']) {
				$attachpids .= ",$firstpost[pid]";
				if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $firstpost['message'], $matchaids)) {
					$attachtags[$firstpost['pid']] = $matchaids[1];
				}
			} else {
				$firstpost['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $firstpost['message']);
			}
		}

		$post = array();
		$post[$firstpost['pid']] = $firstpost;
		if($attachpids != '-1') {
			require_once libfile('function/attachment');
			parseattach($attachpids, $attachtags, $post);
		}

		$content['content'] = $post[$firstpost['pid']]['message'];
		$content['pid'] = $firstpost['pid'];
		unset($post);

		$org = $firstpost;
		$org_url = "forum.php?mod=viewthread&tid=$article[id]";
	} else {
		DB::update('portal_article_title', array('id' => 0, 'idtype' => ''), array('aid' => $aid));
		DB::update('portal_article_content', array('id' => 0, 'idtype' => ''), array('aid' => $aid));
	}
} elseif($article['idtype']=='blogid') {
	$org = DB::fetch_first("SELECT * FROM ".DB::table('home_blog')." WHERE blogid='$article[id]'");
	if(empty($org)) {
		DB::update('portal_article_title', array('id'=>'0', 'idtype'=>''),array('aid'=>$aid));
		dheader('location: portal.php?mod=view&aid='.$aid);
		exit();
	}
}

$article['related'] = array();
$article_related_limit = $_G['newtpl']?6:5;  // 新版相关文章显示个数 lxp 20140303
$query = DB::query("SELECT a.aid,a.title,a.dateline
	FROM ".DB::table('portal_article_related')." r
	LEFT JOIN ".DB::table('portal_article_title')." a ON a.aid=r.raid
	WHERE r.aid='$aid' ORDER BY r.displayorder limit $article_related_limit");
while ($value = DB::fetch($query)) {
	$value['dateline']= dgmdate($value['dateline']);
	$article['related'][] = $value;
}


// keywords
$article['keyword'] = array();
$query = DB::query("SELECT s.searchid,s.keywords
	FROM ".DB::table('plugin_searchkey_keylink')." k
	LEFT JOIN ".DB::table('plugin_searchkey_searchindex')." s ON s.searchid=k.kid
	WHERE k.aid='$aid' ORDER BY k.displayorder");
while ($value = DB::fetch($query)) {
	$article['keyword'][] = $value;
}

$article['allowcomment'] = !empty($cat['allowcomment']) && !empty($article['allowcomment']) ? 1 : 0;
$_G['catid'] = $_GET['catid'] = $article['catid'];
$common_url = '';
$commentlist = array();
$limit = $_G['newtpl'] ? '' : ' LIMIT 0,20';  // 新版评论显示数 lxp 20140305
if($article['allowcomment']) {
	if($org && empty($article['owncomment'])) {

		if($article['idtype'] == 'blogid') {

			$common_url = "home.php?mod=space&uid=$org[uid]&do=blog&id=$article[id]";
			$form_url = "home.php?mod=spacecp&ac=comment";

			$article['commentnum'] = getcount('home_comment', array('id'=>$article['id'], 'idtype'=>'blogid'));
			if($article['commentnum']) {
				$query = DB::query("SELECT authorid AS uid, author AS username, dateline, message
					FROM ".DB::table('home_comment')." WHERE id='$article[id]' AND idtype='blogid' ORDER BY dateline DESC $limit");
				while ($value = DB::fetch($query)) {
					if($value['status'] == 0 || $_G['adminid'] == 1 || $value['uid'] == $_G['uid']) {
						$commentlist[] = $value;
					}
				}
			}

		} elseif($article['idtype'] == 'tid') {

			$common_url = "forum.php?mod=viewthread&tid=$article[id]";
			$form_url = "forum.php?mod=post&action=reply&tid=$article[id]&replysubmit=yes&infloat=yes&handlekey=fastpost";

			require_once libfile('function/discuzcode');
			$posttable = getposttablebytid($article['id']);
			$article['commentnum'] = getcount($posttable, array('tid'=>$article['id'], 'first'=>'0'));

			if($article['allowcomment'] && $article['commentnum']) {
				$query = DB::query("SELECT pid, first, authorid AS uid, author AS username, dateline, message, smileyoff, bbcodeoff, htmlon, attachment, status
					FROM ".DB::table($posttable)." WHERE tid='$article[id]' AND invisible='0' ORDER BY dateline DESC $limit");
				$attachpids = -1;
				$attachtags = array();
				$_G['group']['allowgetattach'] = 1;
				while ($value = DB::fetch($query)) {
					if(!($value['status'] & 1) && !$value['first']) {
						//$value['message'] = discuzcode($value['message'], $value['smileyoff'], $value['bbcodeoff'], $value['htmlon']);
						$value['message'] = discuzcode($value['message'], 1, 1, $value['htmlon']);
						$value['cid'] = $value['pid'];
						$commentlist[$value['pid']] = $value;
						if($value['attachment']) {
							$attachpids .= ",$value[pid]";
							if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $value['message'], $matchaids)) {
								$attachtags[$value['pid']] = $matchaids[1];
							}
						}
					}
				}

				if($attachpids != '-1') {
					require_once libfile('function/attachment');
					parseattach($attachpids, $attachtags, $commentlist);
				}
			}
		}

	} else {

		$common_url = "portal.php?mod=comment&aid=$aid";
		$form_url = "portal.php?mod=portalcp&ac=comment";

		$query = DB::query("SELECT * FROM ".DB::table('portal_comment')." WHERE aid='$aid' ORDER BY cid DESC $limit");
		while ($value = DB::fetch($query)) {
			if($value['status'] == 0 || $value['uid'] == $_G['uid'] || $_G['adminid'] == 1) {
				$value['allowop'] = 1;
				$commentlist[] = $value;
			}
		}
	}
	foreach ($commentlist as $key=>$value) {
		$commentlist[$key]['avatar'] = avatar($value['uid'], 'small');
	}
}

$hash = md5($article['uid']."\t".$article['dateline']);
$id = $article['aid'];
$idtype = 'aid';

loadcache('click');
$clicks = empty($_G['cache']['click']['aid'])?array():$_G['cache']['click']['aid'];
$maxclicknum = 0;
foreach ($clicks as $key => $value) {
	$value['clicknum'] = $article["click{$key}"];
	$value['classid'] = mt_rand(1, 4);
	if($value['clicknum'] > $maxclicknum) $maxclicknum = $value['clicknum'];
	$clicks[$key] = $value;
}

$clickuserlist = array();
$query = DB::query("SELECT * FROM ".DB::table('home_clickuser')."
	WHERE id='$id' AND idtype='$idtype'
	ORDER BY dateline DESC
	LIMIT 0,24");
while ($value = DB::fetch($query)) {
	$value['clickname'] = $clicks[$value['clickid']]['name'];
	$clickuserlist[] = $value;
}


$article['dateline'] = dgmdate($article['dateline']);

$navtitle = $article['title'].($page>1?" ( $page )":'').' - '.$cat['catname'];
$metakeywords = $article['title'];
$metadescription = $article['summary'] ? $article['summary'] : $article['title'];
$seccodecheck = $_G['group']['seccode'] ? $_G['setting']['seccodestatus'] & 4 : 0;
$secqaacheck = $_G['group']['seccode'] ? $_G['setting']['secqaa']['status'] & 2 : 0;

// 侧边栏点评系统展示 lxp 20140304
if($_G['newtpl']){
	$zb_list = memory('get', 'cache_dianping_equipment_for_portal');
	$pp_list = memory('get', 'cache_dianping_brand_for_portal');
	$xl_list = memory('get', 'cache_dianping_xianlu_for_portal');
	$xc_list = memory('get', 'cache_dianping_skiing_for_portal');
	if( ! $zb_list || ! $pp_list || ! $xl_list || ! $xc_list ){
		require_once DISCUZ_ROOT.'/source/8264/launcher.php';
		require_once DISCUZ_ROOT.'/source/8264/model/model.base.php';
		if( ! $zb_list ){
			$mod_equipment = m('equipment');
			$zb_list = $mod_equipment->getlist(array(
				'where' => 'cnum>9',
				'order' => array('lastpost' => 'DESC'),
				'limit' => 5
			));
			memory( 'set', 'cache_dianping_equipment_for_portal', $zb_list, 300 );
		}
		if( ! $pp_list ){
			$mod_brand = m('brand');
			$pp_list = $mod_brand->getlist(array(
				'where' => 'cnum>9',
				'order' => array('lastpost' => 'DESC'),
				'limit' => 6
			));
			memory( 'set', 'cache_dianping_brand_for_portal', $pp_list, 300 );
		}
		if( ! $xl_list ){
			$mod_skiing = m('line');
			$xc_list = $mod_skiing->getlist(array(
				'where' => 'cnum>9',
				'order' => array('lastpost' => 'DESC'),
				'limit' => 6
			));
			memory( 'set', 'cache_dianping_xianlu_for_portal', $xc_list, 300 );
		}
		if( ! $xc_list ){
			$mod_skiing = m('skiing');
			$xc_list = $mod_skiing->getlist(array(
				'where' => 'cnum>9',
				'order' => array('lastpost' => 'DESC'),
				'limit' => 5
			));
			memory( 'set', 'cache_dianping_skiing_for_portal', $xc_list, 300 );
		}

	}
}


/**榜单详细页 url隐藏开始**/
//var_dump($article[catid]);
if($article[catid]=='910'){
	$content[content] = preg_replace('/<\/i><a href="(.*)" target="_blank">(.*)<\/a>/isU', "</i> <span style=\"font-size:20px;\">\\2</span>", $content[content]);
	$content[content] = preg_replace('/来自<a href=\'(.*)\' class=\'namemorelink\'>(.*)<\/a>/isU','来自\\2', $content[content]);
    $content[content] = preg_replace('/来自<a href="(.*)" class="namemorelink">(.*)<\/a>/isU','来自\\2', $content[content]);	
	$content[content]=preg_replace('/数据来源于 <a href="(.*)" style="color:(.*)">8264点评系统<\/a>/isU', '数据来源于8264点评系统', $content[content]);
	$content[content]=preg_replace('/<style>(.*)<\/style>/isU', '', $content[content]);
	$content[content]=preg_replace('/<script>(.*)<\/script>/isU', '', $content[content]);
    include_once template("diy:portal/view_bangdan_2016:{$article['catid']}");
	die;
}
/**榜单详细页 url隐藏结束**/


//catid=867，值得买栏目，如果有领券链接或者购买链接，替换。add by zhang wenchu 20161012
if(($article['catid'] == '867' || ($article['catid'] >= 958 && $article['catid'] <= 965)) && ($article['couponurl'] || $article['buyurl'])){
    $couponhtml = $article['couponurl'] ? '<span style="padding-right:5px;"><a href='.$article[couponurl].' target="_blank" rel="nofollow"><img src="http://static.8264.com/static/images/couponurl.png" /></a></span>' : '';
    $buyhtml = $article['buyurl'] ? "<span style=''><a href=".$article[buyurl]." target='_blank' rel='nofollow'><img src='http://static.8264.com/static/images/buyurl.jpg' /></a></span>" : '';

    $replace_arr = array($couponhtml, $buyhtml);

    $content[content] = str_replace(array('[点我领券]', '[点我购买]'), $replace_arr, $content[content]);
}


//户外学校专用统计开始
xuexiaoStatistics($aid,$article["catid"],$_G['uid']);
//户外学校专用统计结束

if($_G['uid']==1&&$_GET['abc']==8264){
	include_once template("diy:portal/viewtest:{$article['catid']}");
}else{
	// 新版模板 lxp 20140304
	$newtpl = $_G['newtpl'] ? '_2014' : '';
	include_once template("diy:portal/view{$newtpl}:{$article['catid']}");
}
?>
