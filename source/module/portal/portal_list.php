<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: portal_list.php 17431 2010-10-19 03:35:51Z zhangguosheng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
//引入产品分享所需的程序类 at 2012.2.9
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/include.php';
$cpdl = ForumOptionProduce::getTypeData();
$fxds = ForumOptionProduce::getTypeNextDatas(32);
$filter = $_GET['filter'];
$dateline = $_GET['dateline'];
if($filter==null||empty($filter)){
	$filter='t.heats';
}
if($dateline==null||empty($dateline)){
	$dateline=7;
}
if($filter=='t.heats'||$filter=='heats'){
	$subject = "论坛热度排行榜";
	if($dateline==7){
		$tm = "7天内排行";
	}elseif($dateline==30){
		$tm = "30天内排行";
	}else{
		$tm = "总排行";
	}
}elseif($filter=='views'){
	$subject = "论坛点击排行榜";
	if($dateline==7){
		$tm = "7天内排行";
	}elseif($dateline==30){
		$tm = "30天内排行";
	}else{
		$tm = "总排行";
	}
}else{
	$subject = "论坛评论排行榜";
	if($dateline==7){
		$tm = "7天内排行";
	}elseif($dateline==30){
		$tm = "30天内排行";
	}else{
		$tm = "总排行";
	}
}
//end
$_G['catid'] = $catid = max(0,intval($_GET['catid']));

if($catid == '874'){
$bbs = ForumOptionProduce::loadCacheArray('bbs100',$filter,$dateline);
}

if(empty($catid)) {
	showmessage("list_choose_category", dreferer());
}
$portalcategory = &$_G['cache']['portalcategory'];
$cat = $portalcategory[$catid];

if(empty($cat)) {
	// showmessage("list_category_noexist", dreferer());
	header('HTTP/1.1 404 Not Found');exit;
}
require_once libfile('function/portalcp');
$categoryperm = getallowcategory($_G['uid']);
if($cat['closed'] && !$_G['group']['allowdiy'] && !$categoryperm[$catid]['allowmanage']) {
	showmessage("list_category_is_closed", dreferer());
}
if(!empty($cat['url']))	dheader('location:'.$cat['url']);
if(defined('SUB_DIR') && $_G['siteurl']. substr(SUB_DIR, 1) != $cat['caturl'] || !defined('SUB_DIR') && $_G['siteurl'] != substr($cat['caturl'], 0, strrpos($cat['caturl'], '/')+1)) {
	dheader('location:'.$cat['caturl'], '301');
}
$cat = category_remake($catid);
$category_nav = category_get_nav($catid);

//装备
if($catid == 204){

	$perpage  = 10;
	$page  = $_G['gp_page'] ? $_G['gp_page'] : 1;
	$start = ($page-1)*$perpage;
	if($start < 0) $start = 0;
	$multi    = '';
	$list     = array();

	if ($cat['subs']) {
		$catids = array();
		foreach ($cat['subs'] as $k=>$v) {
			if ($v['closed'] || $v['catid'] == 867) {continue;}
			$catids[$v['catid']] = $v['catid'];
			if($v['children']) {	//子分类id
				foreach ($v['children'] as $child_catid) {
					$catids[$child_catid] = $child_catid;
				}
			}
		}
		$catids = "{$catid},".implode(',', $catids);
	}
	$conditions = "catid in ({$catids}) and pic<>'' and status='0'";
	$sql   = "select count(*) as count from ".DB::table('portal_article_title')." where {$conditions} " . getSlaveID();
	$count = DB::result_first($sql);
	if($count) {
		$sql   = "SELECT aid,catid,title,url,pic,serverid,summary,author,`from`, dateline FROM ".DB::table('portal_article_title')." WHERE {$conditions} ORDER BY dateline DESC LIMIT {$start},{$perpage} " . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$v['pic'] 		= $v['pic'] ? getimagethumb(300,300,1,'portal/'.$v['pic'], 0, $v['serverid']) : "";
			$v['catname'] 	= $v['catid'] == 867 ? '值得买' : $portalcategory[$v['catid']]['catname'];
			$v['url'] 	    = $v['url'] ? $v['url'] : "portal.php?mod=view&aid={$v['aid']}";
			$list[] 		= $v;
		}
		$multi = multi($count, $perpage, $page, "portal.php?mod=list&catid={$catid}");
	}

	//最新装备点评--参考自首页source/module/portal/portal_index.php
	require_once DISCUZ_ROOT.'./source/plugin/dianping/dianping.fun.php';
	$arrMd = array(
		"mdForumPost" => m('forum_post'),
		"mdEquipment" => m('equipment'),
		"mdSkiing" 	  => m('skiing'),
		"mdMountain"  => m('mountain'),
		"mdBrand" 	  => m('brand'),
		"mdLine" 	  => m('line'),
		"mdDiving"    => m('diving'),
		"mdFishing"   => m('fishing'),
		"mdClimb" 	  => m('climb'),
	);
	// $eqList   = getcommons("equipment", 'pid', 4, $arrMd);

	//装备品牌排行榜--参考自首页source/module/portal/portal_view.php
	$pp_list = memory('get', 'cache_dianping_brand_for_portal');
	if( ! $pp_list ){
		$mod_brand = m('brand');
		$pp_list = $mod_brand->getlist(array(
			'where' => 'cnum>9',
			'order' => array('lastpost' => 'DESC'),
			'limit' => 8
		));
		memory( 'set', 'cache_dianping_brand_for_portal', $pp_list, 300 );
	}

	//装备论坛最新加币帖子
	$sql    = "select t.subject,t.tid,t.authorid from " . DB::table('forum_thread') . " t ";
	$sql   .= " where fid = 7 and stamp = 0 and rate > 0";
	$sql   .= " order by t.dateline desc ";
	$sql   .= " limit 7 " . getSlaveID();
	$query  = DB::query($sql);
	$zbList = array();
	while ($v = DB::fetch($query)) {
		$v['avatar'] = avatar($v['authorid'], 'small');
		$zbList[] = $v;
	}

	//轮播列表
	$sql = "SELECT z.pic,t.title,t.summary,t.catid,t.aid,t.from,t.author,z.dateline FROM ".DB::table('portal_article_zblunbo')." z LEFT JOIN ".DB::table('portal_article_title')." t ON z.aid=t.aid order by z.`order` desc,z.dateline desc LIMIT 0,10 " . getSlaveID();
	$query = DB::query($sql);
	while ($v = DB::fetch($query)) {
		$v['pic'] = $v['pic'] ? getimagethumb(1500,1500,1,'plugin/'.$v['pic'], 0, 99) : '';
		$lunboList[] = $v;
	}
}

//处理勇者先行
if($catid==880){
	if(isset($_COOKIE['yzxx'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("yzxx", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			setcookie("yzxx",$newnum, time()+365*24*60*60,'/','.8264.com');
		}
	}
	$xltjnum = 0;
	if(isset($_COOKIE['xltj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("xltj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			$oldnum = $_COOKIE['xltj'];
			$xltjnum = $newnum-$oldnum;
		}
	}
	$kqmgnum = 0;
	if(isset($_COOKIE['kqmg'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("kqmg", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['kqmg'])){
			$oldnum = $_COOKIE['kqmg'];
			$kqmgnum = $newnum-$oldnum;
		}
	}
        //户外摄影师
        $hwsysnum = 0;
	if(isset($_COOKIE['hwsys'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("hwsys", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['hwsys'])){
			$oldnum = $_COOKIE['hwsys'];
			$hwsysnum = $newnum-$oldnum;
		}
	}
	$mrytnum = 0;
	if(isset($_COOKIE['mryt'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("mryt", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			$oldnum = $_COOKIE['mryt'];
			$mrytnum = $newnum-$oldnum;
		}
	}
	$jctjnum = 0;
	if(isset($_COOKIE['jctj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("jctj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			$oldnum = $_COOKIE['jctj'];
			$jctjnum = $newnum-$oldnum;
		}
	}

	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getYzxxList($page=1,$perpage=100){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,title,url,pic,remote,id,idtype,serverid FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>'' ORDER BY aid DESC LIMIT $start,$perpage");
		$array = array();
		while ($value = DB::fetch($query)) {
			$value['titles'] = trim(substr($value['title'],0,strripos($value['title'],' ')));
			$value['shortname']	= trim(substr($value['title'],(stripos($value['title'],' ')+1)));
			if($value['idtype']=='tid'&& $value['id']!=0){
				$comment = DB::fetch_first("SELECT replies,views,authorid FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
				$value['commentnum'] = $comment['replies'];
				$value['viewnum'] = $comment['views'];
			}else{
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['commentnum'] = $comment['commentnum'];
				$value['viewnum'] = $comment['viewnum'];
			}
			$value['pic'] = ($value['remote'] == 1 ? getglobal('setting/ftp/attachurl')."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}
	$array = array();
	$name = 'yzxx';
	$array = loadCacheArray('yzxx',$page);
}
//处理攻略下载
if($catid==881){

	if(isset($_COOKIE['xltj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("xltj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			setcookie("xltj",$newnum, time()+365*24*60*60,'/','.8264.com');
		}
	}

	$mrytnum = 0;
	if(isset($_COOKIE['mryt'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("mryt", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			$oldnum = $_COOKIE['mryt'];
			$mrytnum = $newnum-$oldnum;
			if($mrytnum>=1){
			       // setcookie("mryt",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$kqmgnum = 0;
	if(isset($_COOKIE['kqmg'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("kqmg", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['kqmg'])){
			$oldnum = $_COOKIE['kqmg'];
			$kqmgnum = $newnum-$oldnum;
			if($kqmgnum>=1){
			       // setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
        //户外摄影师
        $hwsysnum = 0;
	if(isset($_COOKIE['hwsys'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("hwsys", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['hwsys'])){
			$oldnum = $_COOKIE['hwsys'];
			$hwsysnum = $newnum-$oldnum;
			if($hwsysnum>=1){
			       // setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$yzxxnum = 0;
	if(isset($_COOKIE['yzxx'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("yzxx", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			$oldnum = $_COOKIE['yzxx'];
			$yzxxnum = $newnum-$oldnum;
			if($yzxxnum>=1){
			       // setcookie("yzxx",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$jctjnum = 0;
	if(isset($_COOKIE['jctj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("jctj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			$oldnum = $_COOKIE['jctj'];
			$jctjnum = $newnum-$oldnum;
		}
	}


	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getGlxzList($page=1,$perpage=100){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/

		require_once libfile('function/forumlist');
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,title,url,pic,remote,id,idtype,serverid FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>'' ORDER BY aid ASC LIMIT $start,$perpage ".getSlaveID());
		$array = array();
		while ($value = DB::fetch($query)) {
			if($value['idtype']=='tid'&& $value['id']!=0){
				$comment = DB::fetch_first("SELECT replies,views,authorid FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1 ".getSlaveID());
				$post = DB::fetch_first("SELECT pid,tid FROM ".DB::table('forum_post')." WHERE first=1 and tid='$value[id]' LIMIT 0,1 ".getSlaveID());
				$att = DB::fetch_first("SELECT aid,downloads FROM ".DB::table('forum_attachment')." WHERE tid='$post[tid]' and pid='$post[pid]' and isimage=0 LIMIT 0,1 ".getSlaveID());
				$att['downloads'] += get_redis_views($att['aid'],'attachment');
				$value['downnum'] =$att['downloads'] ? $att['downloads'] : 0;
				$value['viewnum'] = $comment['views']+get_redis_views($value[id],'viewthread');
			}else{
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['downnum'] = 0;
				$value['viewnum'] = $comment['viewnum'];
			}
			$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl']."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}
	$array = array();
	$name = 'glxz';
	$array = loadCacheArray('glxz',$page);
}
//处理铿锵玫瑰
if($catid==878){
	if(isset($_COOKIE['kqmg'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("kqmg", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['kqmg'])){
			setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
		}
	}
	$mrytnum = 0;
	if(isset($_COOKIE['mryt'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("mryt", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			$oldnum = $_COOKIE['mryt'];
			$mrytnum = $newnum-$oldnum;
			if($mrytnum>=1){
			       // setcookie("mryt",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$xltjnum = 0;
	if(isset($_COOKIE['xltj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("xltj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			$oldnum = $_COOKIE['xltj'];
			$xltjnum = $newnum-$oldnum;
			if($xltjnum>=1){
			       // setcookie("xltj",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$yzxxnum = 0;
	if(isset($_COOKIE['yzxx'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("yzxx", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			$oldnum = $_COOKIE['yzxx'];
			$yzxxnum = $newnum-$oldnum;
			if($yzxxnum>=1){
			       // setcookie("yzxx",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$jctjnum = 0;
	if(isset($_COOKIE['jctj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("jctj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			$oldnum = $_COOKIE['jctj'];
			$jctjnum = $newnum-$oldnum;
		}
	}


	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getKqmgList($page=1,$perpage=100){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,title,url,pic,remote,id,idtype,serverid FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>'' ORDER BY aid DESC LIMIT $start,$perpage");
		$array = array();
		require_once DISCUZ_ROOT.'./source/function/function_post.php';
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";
		while ($value = DB::fetch($query)) {
			if($value['idtype']=='tid'&& $value['id']!=0){
				$comment = DB::fetch_first("SELECT replies,views,authorid FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
				$value['commentnum'] = $comment['replies'];
				$value['viewnum'] = $comment['views'];
				$str = "SELECT * FROM ".DB::table('forum_post')." WHERE tid='$value[id]' and authorid<>'$comment[authorid]' and first<>'1' and invisible=0 order by dateline desc LIMIT 0,3";
				$querys = DB::query($str);
				$list = array();
				while ($values = DB::fetch($querys)) {
					$values['avatar'] = avatar($values['authorid'], 'small');
					$values['authorid'] = $_G['config']['web']['home']."home.php?mod=space&uid=".$values['authorid'];
					$values['content'] = preg_replace('/\[quote.*?\](.*)\[\/quote\]/', '', $values['message']);
					$values['content'] = preg_replace('/\[img.*?\](.*)\[\/img\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[code.*?\](.*)\[\/code\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[attach.*?\](.*)\[\/attach\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[url.*?\](.*)\[\/url\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[size.*?\](.*)\[\/size\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[media.*?\](.*)\[\/media\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[audio.*?\](.*)\[\/audio\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[wma.*?\](.*)\[\/wma\]/', '', $values['content']);
					$values['content'] = preg_replace('/(&nbsp;)+/', '', $values['content']);
					$values['content'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $values['content']);
					$values['content'] = str_replace('　','',$values['content']);
					$values['content'] =  discuzcode($values['content']);
					$values['content'] =  messagecutstr($values['content'],50);
					$list[]=array("uid"=>$values['authorid'],"uname"=>$values['author'],"tx"=>$values['avatar'],"nr"=>trim($values['content']));
					$value['arr'] = $list;
				}
			}else{
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['commentnum'] = $comment['commentnum'];
				$value['viewnum'] = $comment['viewnum'];
			}
			$value['arr'] = $value['arr'];
			$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl']."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}
	$array = array();
	$name = 'kqmg';
	$array = loadCacheArray('kqmg',$page);
}
//处理户外摄影师

if($catid==912){
	if(isset($_COOKIE['hwsys'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("hwsys", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$hwsysnum = $mg['num']-$_COOKIE['hwsys'];
		// setcookie("hwsys",$hwsysnum, time()+365*24*60*60,'/','.8264.com');
	}
	$mrytnum = 0;
	if(isset($_COOKIE['mryt'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("mryt", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			$oldnum = $_COOKIE['mryt'];
			$mrytnum = $newnum-$oldnum;
			if($mrytnum>=1){
			       // setcookie("mryt",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$xltjnum = 0;
	if(isset($_COOKIE['xltj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("xltj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			$oldnum = $_COOKIE['xltj'];
			$xltjnum = $newnum-$oldnum;
			if($xltjnum>=1){
			       // setcookie("xltj",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$yzxxnum = 0;
	if(isset($_COOKIE['yzxx'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("yzxx", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			$oldnum = $_COOKIE['yzxx'];
			$yzxxnum = $newnum-$oldnum;
			if($yzxxnum>=1){
			       // setcookie("yzxx",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$jctjnum = 0;
	if(isset($_COOKIE['jctj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("jctj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			$oldnum = $_COOKIE['jctj'];
			$jctjnum = $newnum-$oldnum;
		}
	}


	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getHwsysList($page=1,$perpage=102){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,title,url,pic,remote,id,idtype,serverid,pubtime,summary FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>'' ORDER BY aid DESC LIMIT $start,$perpage");
		$array = array();
		require_once DISCUZ_ROOT.'./source/function/function_post.php';
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";

		while ($value = DB::fetch($query)) {

			if($value['idtype']=='tid'&& $value['id']!=0){
				$comment = DB::fetch_first("SELECT replies,views,authorid FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
				$value['commentnum'] = $comment['replies'];
				$value['viewnum'] = $comment['views'];
				$str = "SELECT * FROM ".DB::table('forum_post')." WHERE tid='$value[id]' and authorid<>'$comment[authorid]' and first<>'1' and invisible=0 group by (authorid) order by dateline desc LIMIT 0,8";
				$querys = DB::query($str);
				$list = array();
				while ($values = DB::fetch($querys)) {
					$values['avatar'] = avatar($values['authorid'], 'small');
					$values['authorid'] = $_G['config']['web']['home']."home.php?mod=space&uid=".$values['authorid'];
					$values['content'] = preg_replace('/\[quote.*?\](.*)\[\/quote\]/', '', $values['message']);
					$values['content'] = preg_replace('/\[img.*?\](.*)\[\/img\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[code.*?\](.*)\[\/code\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[attach.*?\](.*)\[\/attach\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[url.*?\](.*)\[\/url\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[size.*?\](.*)\[\/size\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[media.*?\](.*)\[\/media\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[audio.*?\](.*)\[\/audio\]/', '', $values['content']);
					$values['content'] = preg_replace('/\[wma.*?\](.*)\[\/wma\]/', '', $values['content']);
					$values['content'] = preg_replace('/(&nbsp;)+/', '', $values['content']);
					$values['content'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $values['content']);
					$values['content'] = str_replace('　','',$values['content']);
					$values['content'] =  discuzcode($values['content']);
					$values['content'] =  messagecutstr($values['content'],50);
					$list[]=array("uid"=>$values['authorid'],"uname"=>$values['author'],"tx"=>$values['avatar'],"nr"=>trim($values['content']));
					$value['arr'] = $list;
				}
			}else{
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['commentnum'] = $comment['commentnum'];
				$value['viewnum'] = $comment['viewnum'];
			}
			$value['arr'] = $value['arr'];
                        //日期的转换显示
                        //月份全拼英文
                        $pubmf =  date("F",$value['pubtime']);
                        $value['pubmf']= $pubmf;

                        $pubm =  date("M",$value['pubtime']);
                        $pubm = strtoupper($pubm);
                        $pubd =  date("d",$value['pubtime']);
                        $value['pubm']= $pubm;
                        $value['pubd']= $pubd;
                        //title的整理
                        $value['title'] =  str_replace("8264户外摄影师","",$value['title']);

			$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl']."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}

	$array = array();
	$name = 'hwsys';
	$array = loadCacheArray('hwsys',$page);
        $count_array = count($array);
        //print_r($array);
//        //分割数组
        $array_1 = array_slice($array,0,2);
        $array_2 = array_slice($array_1,0,1);
        $array_3 = array_slice($array_1,1,1);
        $array_2[0]['summary'] = cutstr($array_2[0]['summary'],"85",'...');
        $array_3[0]['summary'] = cutstr($array_3[0]['summary'],"85",'...');
//        //去除数组中已分割出去的数组
//        unset($array[0]);
//        unset($array[1]);
        if($page == 1){
            unset($array[0]);
            unset($array[1]);
        }

}



//处理每日一图
if($catid==842){
	if(isset($_COOKIE['mryt'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("mryt", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			        setcookie("mryt",$newnum, time()+365*24*60*60,'/','.8264.com');
		}
	}
	$kqmgnum = 0;
	if(isset($_COOKIE['kqmg'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("kqmg", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['kqmg'])){
			$oldnum = $_COOKIE['kqmg'];
			$kqmgnum = $newnum-$oldnum;
			if($kqmgnum>=1){
			       // setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
        //户外摄影师
        $hwsysnum = 0;
	if(isset($_COOKIE['hwsys'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("hwsys", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['hwsys'])){
			$oldnum = $_COOKIE['hwsys'];
			$hwsysnum = $newnum-$oldnum;
			if($hwsysnum>=1){
			       // setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}


	$xltjnum = 0;
	if(isset($_COOKIE['xltj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("xltj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			$oldnum = $_COOKIE['xltj'];
			$xltjnum = $newnum-$oldnum;
			if($xltjnum>=1){
			       // setcookie("xltj",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$yzxxnum = 0;
	if(isset($_COOKIE['yzxx'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("yzxx", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			$oldnum = $_COOKIE['yzxx'];
			$yzxxnum = $newnum-$oldnum;
		}
	}
	$jctjnum = 0;
	if(isset($_COOKIE['jctj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("jctj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			$oldnum = $_COOKIE['jctj'];
			$jctjnum = $newnum-$oldnum;
		}
	}

	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getMrytList($page=1,$perpage=50){
        /*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		require_once libfile('function/forumlist');
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,author,title,url,pic,remote,serverid,id,idtype FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>'' and idtype<>''  ORDER BY dateline DESC LIMIT $start,$perpage");
		$array = array();
		require_once DISCUZ_ROOT.'./source/function/function_post.php';
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";
		while ($value = DB::fetch($query)) {
			if($value['idtype']=='tid'&& $value['id']!=0){
				$comment = DB::fetch_first("SELECT replies,views,authorid FROM ".DB::table('forum_thread')." WHERE tid='$value[id]' LIMIT 0,1");
				$value['commentnum'] = $comment['replies'];
				$value['viewnum'] = $comment['views']+get_redis_views($value[id],'viewthread');
				$content = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_content')." WHERE aid='$value[aid]' ORDER BY pageorder LIMIT 0,1");
				$value['content'] = $content['content'];
			}elseif($value['idtype']=='picid'&& $value['id']!=0){
				$comment = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('home_comment')." WHERE id='$value[id]' and idtype='picid' order by dateline");
				$value['commentnum'] = $comment['count'];
				$view = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['viewnum'] = $view['viewnum'];
				$content = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_content')." WHERE aid='$value[aid]' ORDER BY pageorder LIMIT 0,1");
				$value['content'] = $content['content'];
			}else{
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['commentnum'] = $comment['commentnum'];
				$value['viewnum'] = $comment['viewnum'];
			}
			$value['arr'] = $value['arr'];
			$value['url'] = str_replace("/thread-", "/picture-", $value['url']);//替换原有帖子地址为新每日一图地址
			$value['pic'] = ($value['remote'] == 1 ? $_G['setting']['ftp']['attachurl']."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}
	$array = array();
	$name = 'mryt';
	$array = loadCacheArray($name,$page);
}
//最新文章专题页
if($catid==884){
	$page = $_GET['page'] ? $_GET['page'] : 1;
	/**根据大类频道查找该频道下的小类信息
	*  需要传入频道大类编号
	*/
	function getCatid_byupid(){
		$param_arr = func_get_args();
		$param_str = implode("','",$param_arr);
		$sql = "select catid from ".DB::table('portal_category')." where upid in('".$param_str."') order by catid";
		$result = DB::query($sql);
		$catid_arr = array();
		while($row = DB::fetch($result)){
			$catid_arr[] = $row['catid'];
		}
		$catid_str = implode("','",$catid_arr);
		$catid_str = "at.catid IN ('".$catid_str."') AND at.catid not in('867') and at.status='0'";
		return $catid_str;
	}
	function getNewArticles($page=1,$perpage =10,$wheresql){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$count = memory('get', 'article_now_count');
		if(!$count)
		{
			$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('portal_article_title')." at WHERE $wheresql"), 0);
			memory('set', 'article_now_count', 1800);
		}
		if($count) {
			$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." at WHERE $wheresql ORDER BY at.dateline DESC LIMIT $start,$perpage");
			while ($value = DB::fetch($query)) {
				$content = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_content')." WHERE aid='$value[aid]' ORDER BY pageorder LIMIT 0,1");
				if($content['idtype']=='pid'&& $content['id']!=0){
					$firstpost = DB::fetch_first("SELECT tid FROM ".DB::table('forum_post')." WHERE pid='$content[id]' and first='1' LIMIT 0,1");
					$comment = DB::fetch_first("SELECT replies FROM ".DB::table('forum_thread')." WHERE tid='$firstpost[tid]' LIMIT 0,1");
					$value['commentnum'] = $comment['replies'];
				}else{
					$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
					$value['commentnum'] = $comment['commentnum'];
				}
				$cat = DB::fetch_first("SELECT catid,catname,upid FROM ".DB::table('portal_category')." WHERE catid='$value[catid]' LIMIT 0,1");
				$value['catname'] = "<a href='portal.php?mod=list&catid=$cat[catid]' target='_blank'>#$cat[catname]</a>";
				if($cat['upid']){
					$ct = DB::fetch_first("SELECT catid,catname FROM ".DB::table('portal_category')." WHERE catid='$cat[upid]' LIMIT 0,1");
					$value['catname'].="<a href='portal.php?mod=list&catid=$ct[catid]' target='_blank'>#$ct[catname]</a>";
				}
				if($value['pic']) {
					$value['pic'] = pic_get($value['pic'], 'portal', $value['thumb'], $value['remote'],1,$value['serverid']);
				}
				$value['dateline'] = dgmdate($value['dateline']);
				if($value['status'] == 0 || $value['uid'] == $_G['uid'] || $_G['adminid'] == 1) {
					$list[] = $value;
				} else {
					$pricount++;
				}
			}
			$multi = multi($count, $perpage, $page, "portal.php?mod=list&catid=884");
		}
		return $return = array('list'=>$list,'count'=>$count,'multi'=>$multi,'pricount'=>$pricount);
	}
}

//处理精彩推荐
if($catid==871){
	if(isset($_COOKIE['jctj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$firstnum = $mg['num'];
			setcookie("jctj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			setcookie("jctj",$newnum, time()+365*24*60*60,'/','.8264.com');
		}
	}
	$mrytnum = 0;
	if(isset($_COOKIE['mryt'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("mryt", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			$oldnum = $_COOKIE['mryt'];
			$mrytnum = $newnum-$oldnum;
		}
	}
	$kqmgnum = 0;
	if(isset($_COOKIE['kqmg'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("kqmg", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['kqmg'])){
			$oldnum = $_COOKIE['kqmg'];
			$kqmgnum = $newnum-$oldnum;
			if($kqmgnum>=1){
			       // setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
        //户外摄影师
        $hwsysnum = 0;
	if(isset($_COOKIE['hwsys'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("hwsys", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['hwsys'])){
			$oldnum = $_COOKIE['hwsys'];
			$hwsysnum = $newnum-$oldnum;
			if($hwsysnum>=1){
			       // setcookie("kqmg",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}

	$xltjnum = 0;
	if(isset($_COOKIE['xltj'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("xltj", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			$oldnum = $_COOKIE['xltj'];
			$xltjnum = $newnum-$oldnum;
			if($xltjnum>=1){
			       // setcookie("xltj",$newnum, time()+365*24*60*60,'/','.8264.com');
			}else{

			}
		}
	}
	$yzxxnum = 0;
	if(isset($_COOKIE['yzxx'])==""){
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$firstnum = $mg['num'];
		setcookie("yzxx", $firstnum, time()+365*24*60*60,'/','.8264.com');
	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			$oldnum = $_COOKIE['yzxx'];
			$yzxxnum = $newnum-$oldnum;
		}
	}

	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getJctjList($page=1,$perpage=40){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,title,url,pic,remote,id,idtype,serverid FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>'' ORDER BY aid DESC LIMIT $start,$perpage");
		$array = array();
		while ($value = DB::fetch($query)) {
			$value['titles'] = trim(substr($value['title'],0,strripos($value['title'],' ')));
			$value['pic'] = ($value['remote'] == 1 ? getglobal('setting/ftp/attachurl')."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}
	$array = array();
	$name = 'jctj';
	$array = loadCacheArray('jctj',$page);
}

//处理图说
if($catid==902){
	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getPicsaylist($page=1,$perpage =16){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$multi = '';
		$list = array();
		$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('portal_article_title')." at WHERE catid in ('902') and pic<>''"), 0);
		if($count) {
			$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." at WHERE catid in ('902') and pic<>'' ORDER BY at.dateline DESC LIMIT $start,$perpage");
			while ($value = DB::fetch($query)) {
				$value['dateline'] = dgmdate($value['dateline']);
				$value['pic'] = ($value['remote'] == 1 ? getglobal('setting/ftp/attachurl')."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
				$list[] = $value;
			}
			$multi = multi($count, $perpage, $page, "portal.php?mod=list&catid=902");
		}
		return $return = array('list'=>$list,'count'=>$count,'multi'=>$multi);
	}
	$arr = getPicsaylist($page);
}

//处理领军人物
if($catid==903){
	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getLjrwlist($page=1,$perpage =20){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$multi = '';
		$list = array();
		$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('portal_article_title')." at WHERE catid in ('903') and pic<>''"), 0);
		if($count) {
			$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." at WHERE catid in ('903') and pic<>'' ORDER BY at.dateline DESC LIMIT $start,$perpage");
			while ($value = DB::fetch($query)) {

				$value['titles'] = trim(substr($value['title'],0,strripos($value['title'],'|')));
				$temp = trim(substr($value['title'],(stripos($value['title'],'|')+1)));
				$value['shortname'] = trim(substr($temp,0,strripos($temp,'*')));
				$value['name'] = trim(substr($temp,(stripos($temp,'*')+1)));

				$value['dateline'] = dgmdate($value['dateline'],'d');
				$value['pic'] = ($value['remote'] == 1 ? getglobal('setting/ftp/attachurl')."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
				$value['view'] = DB::result(DB::query("SELECT viewnum FROM ".DB::table('portal_article_count')." at WHERE aid=$value[aid]"), 0);
				$list[] = $value;
			}
			$multi = multi($count, $perpage, $page, "portal.php?mod=list&catid=903");
		}
		return $return = array('list'=>$list,'count'=>$count,'multi'=>$multi);
	}
	$arr = getLjrwlist($page);
}

//右侧推荐活动
$hddata = gethddata($cat, 7);

$cats = array("886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897", "898", "899", "900", "901");
if(in_array($catid,$cats))
{
	$page = $_GET['page'] ? $_GET['page'] : 1;
	function getpartJctjList($catid,$page=1,$perpage=40){
		/*加入附件服务器*/
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$alldomain = $attachserver->get_server_domain('all');
		/*结束*/
		$start = ($page-1)*$perpage;
		if($start<0) $start = 0;
		$query = DB::query("SELECT aid,title,url,pic,remote,id,idtype,serverid FROM ".DB::table('portal_article_title')." at WHERE catid IN ($catid) AND pic<>'' ORDER BY aid DESC LIMIT $start,$perpage");
		$array = array();
		while ($value = DB::fetch($query)) {
			$value['titles'] = trim(substr($value['title'],0,strripos($value['title'],' ')));
			$value['pic'] = ($value['remote'] == 1 ? getglobal('setting/ftp/attachurl')."portal/" : ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/portal/" : "/data/attachment/portal/")).$value['pic'];
			$array[] = $value;
		}
		return $array;
	}
	$array = array();
	$array = getpartJctjList($catid,$page);
}

$catids = array("201", "204", "224", "232", "238", "751", "886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897","898","899","900","901");
if (in_array($catid,$catids))
{
	$mrytnum = 0;
	if(isset($_COOKIE['mryt'])==""){

	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (842) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['mryt'])){
			$oldnum = $_COOKIE['mryt'];
			$mrytnum = $newnum-$oldnum;
		}
	}
	$kqmgnum = 0;
	if(isset($_COOKIE['kqmg'])==""){

	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (878) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['kqmg'])){
			$oldnum = $_COOKIE['kqmg'];
			$kqmgnum = $newnum-$oldnum;
		}
	}
        //户外摄影师
        $hwsysnum = 0;
	if(isset($_COOKIE['hwsys'])==""){

	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (912) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['hwsys'])){
			$oldnum = $_COOKIE['hwsys'];
			$hwsysnum = $newnum-$oldnum;
		}
	}

	$xltjnum = 0;
	if(isset($_COOKIE['xltj'])==""){

	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (881) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['xltj'])){
			$oldnum = $_COOKIE['xltj'];
			$xltjnum = $newnum-$oldnum;
		}
	}
	$yzxxnum = 0;
	if(isset($_COOKIE['yzxx'])==""){

	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (880) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['yzxx'])){
			$oldnum = $_COOKIE['yzxx'];
			$yzxxnum = $newnum-$oldnum;
		}
	}
	$jctjnum = 0;
	if(isset($_COOKIE['jctj'])==""){

	}else{
		$mg = DB::fetch_first("SELECT count(*) as num FROM ".DB::table('portal_article_title')." at WHERE catid IN (871,886,887,888,889,890,891,892,893,894,895,896,897,898,899,900,901) AND pic<>''");
		$newnum = $mg['num'];
		if(isset($_COOKIE['jctj'])){
			$oldnum = $_COOKIE['jctj'];
			$jctjnum = $newnum-$oldnum;
		}
	}
}

$navid = 'mn_P'.$cat['topid'];
foreach ($_G['setting']['navs'] as $navsvalue) {
	if($navsvalue['navid'] == $navid && $navsvalue['available'] && $navsvalue['level'] == 0) {
		$_G['mnid'] = $navid;
		break;
	}
}

//测试首页
if($catid == 850){
    $navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['portal']);
    if(!$navtitle) {
            $navtitle = $_G['setting']['navs'][1]['navname'];
    } else {
            $nobbname = true;
    }

    $pageTitle = "8264专业的户外运动综合平台 - 户外资料网8264.com";

    $metakeywords = $_G['setting']['seokeywords']['portal'];
    if(!$metakeywords) {
            $metakeywords = $_G['setting']['navs'][1]['navname'];
    }

    $metadescription = $_G['setting']['seodescription']['portal'];
    if(!$metadescription) {
            $metadescription = $_G['setting']['navs'][1]['navname'];
    }

    //首页品牌列表
    require_once DISCUZ_ROOT.'./source/plugin/dianping/dianping.fun.php';

    $arrMd = array(
            "mdForumPost" => m('forum_post'),
            "mdEquipment" => m('equipment'),
            "mdSkiing" 	  => m('skiing'),
            "mdMountain"  => m('mountain'),
            "mdBrand" 	  => m('brand'),
            "mdLine" 	  => m('line'),
            "mdDiving"    => m('diving'),
            "mdFishing"   => m('fishing'),
            "mdClimb" 	  => m('climb'),
    );
    //装备的点评(右侧)
    $eqList   = getcommons("equipment", 'pid', 3, $arrMd);

    //山峰的点评（右侧）
    $moutList = getcommons("mountain", 'pid', 5, $arrMd);

    //装备列表（首页底部）
    $eqdiList = getcommons("equipment", 'tid', 8, $arrMd);

    //滑雪场列表（首页底部）
    $skidiList = getcommons("skiing", 'tid', 8, $arrMd);

    //品牌列表（首页底部）
    $branddiList = getcommons("brand", 'tid', 8, $arrMd);

    //线路列表（首页底部）
    $linediList = getcommons("line", 'tid', 8, $arrMd);

    //山峰列表（首页底部）
    $mountainList = getcommons("mountain", 'tid', 8, $arrMd);

    //潜水点列表（首页底部）
    $divingList = getcommons("diving", 'tid', 8, $arrMd);

    //钓鱼点列表（首页底部）
    $fishingList = getcommons("fishing", 'tid', 8, $arrMd);

    //攀爬列表（首页底部）
    $climbList = getcommons("climb", 'tid', 8, $arrMd);

    $isShouYe = true;

    //首页 资讯(右侧) 装备资讯
    $article204_array = array();

    $keyname = "cache_shouye_zixun_204";
    $article204_array = memory('get', $keyname);

    if(!$article204_array || $_G['gp_nocache'] == 1 || $_G['groupid'] == 1){
        $cat = category_remake("204");
        if ($cat['subs']) {
            $catids = array();
            foreach ($cat['subs'] as $k=>$v) {
                    if ($v['closed'] || $v['catid'] == 867) {continue;}
                    $catids[$v['catid']] = $v['catid'];
                    if($v['children']) {	//子分类id
                            foreach ($v['children'] as $child_catid) {
                                    $catids[$child_catid] = $child_catid;
                            }
                    }
            }
            $catids = "204,".implode(',', $catids);
        }

        $today_str_start = strtotime(date("Y-m-d"));
        $today_str_end = strtotime(date("Y-m-d")) + 86400;

        $article204_array = getArtcile204($today_str_start, $today_str_end, $catids);

        memory('set', $keyname, $article204_array, 60 * 60 * 1);
    }

    //首页 游记 热门旅行地
    $place_array = array("四姑娘山","武功山","五台山","贡嘎","拉萨","亚丁","鳌太","雨崩","阿里","丽江","甘南","年保玉则","尼泊尔","青海湖","哈巴雪山");

    $keyname = "cache_shouye_youji_place";
    $place_result = memory('get', $keyname);

    if(!$place_result || $_G['gp_nocache'] == 1 || $_G['groupid'] == 1){
        $place_result = array();
        foreach($place_array as $v){
            $place = $v;
            $v = str_replace(array('武功山','鳌太','雨崩','年保玉则'), array('武功山风景区','鳌山','雨崩村','年保玉则景区'), $v);
            $sql = "select count(*) as actnum, placeid, level from ".DB::table('forum_travelread_tid_place')." where name ='$v'".getSlaveID();
            $query = DB::query($sql);
            $row = DB::fetch($query);
            $place_result[$place]['placeid'] = $row['placeid'];
            $place_result[$place]['actnum'] = $row['actnum'];
            $place_result[$place]['level'] = $row['level'];
        }

        memory('set', $keyname, $place_result, 60 * 60 * 1);
    }

    //首页 线路 左侧列表
    global $_G;
    $appname = $_G['config']['hdapikey']['8264com']['appname'];
    $appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
    $params = array(
            'appname' => $appname,
            'app' => 'search',
            'act' => 'recommend_4',
            'qt' => time(),
            'xl_nums' => 6
    );

    $xl_result_left = get_hd_data($params, $appsecret, "cache_shouye_xianlu_left_list", 7200);

    $xl_result_left_one = array_slice($xl_result_left, 0, 2);
    foreach($xl_result_left_one as $k=>$v){
        if($v['goods_id']){
            $xl_result_left_one[$k]['default_image'] = str_replace('_1_1', '_2_1', $v['default_image']);
        }
    }
    $xl_result_left_two = array_slice($xl_result_left, 2, 6);
    unset($xl_result_left);

    //首页 线路 右侧周末活动列表 根据ip获取placeinfo信息
    require_once DISCUZ_ROOT.'./source/plugin/components/ipdata/ipdata.php';
    if($_G['uid'] == 1 && $_GET['ip']){
        $place = _convertip($_GET['ip']);
    }else{
        $place = _convertip($_G['clientip']);
    }

    $params = array(
            'appname' => $appname,
            'app' => 'search',
            'act' => 'recommend_6',
            'qt' => time(),
            'id' => 1
    );
    $prolist = get_hd_data($params, $appsecret, "cache_shouye_xianlu_common_area_1", 86400);
    foreach ($prolist as $pro) {
        $imhere = strpos($place, $pro['name']);
        if ($imhere !== false) {
            $currpro = $pro;
            if(!in_array($pro['id'], array(2,3,4,5))){
                $place = substr_replace($place, '', $imhere, strlen($pro['name']));
            }
            break;
        }
    }

    if(empty($currpro)){
        $currpro = $prolist[2];
    }else{
        $params = array(
                'appname' => $appname,
                'app' => 'search',
                'act' => 'recommend_6',
                'qt' => time(),
                'id' => $currpro['id']
        );
        $citylist = get_hd_data($params, $appsecret, "cache_shouye_xianlu_common_area_".$currpro['id'], 86400);
        foreach ($citylist as $city) {
            $imhere = strpos($place, $city['name']);
            if ($imhere !== false){
                $currcity = $city;
                break;
            }
        }
    }

    if(empty($currcity)){
        $currcity = $currpro;
    }

    //首页 线路 右侧周末活动
    $params = array(
        'appname' => $appname,
        'app' => 'search',
        'act' => 'recommend_5',
        'qt' => time(),
        'place' => json_encode( iconv_array($currcity, 'GBK', 'UTF-8') )
    );

    $xl_result_right = get_hd_data($params, $appsecret, "cache_shouye_xianlu_right_list_".$currcity['id'], 7200);

    //首页 线路 右侧底部 热门玩法
    $cate_array = array('徒步','摄影','滑雪','培训','登雪山','包车','潜水','漂流','海钓','露营','攀岩','滑翔伞', '越野车', '高尔夫', '深度游', '向导', '射箭');
    $params = array(
        'appname' => $appname,
        'app' => 'search',
        'act' => 'recommend_7',
        'qt' => time(),
        'cate' => json_encode( iconv_array($cate_array, 'GBK', 'UTF-8') )
    );

    $xl_result_right_bottom = get_hd_data($params, $appsecret, "cache_shouye_xianlu_right_bottom_cate", 7200);

    //首页 问答·点评
    require DISCUZ_ROOT . '/source/function/function_discuzcode.php';
//    require DISCUZ_ROOT . '/source/function/function_readmodelTravel.php';
    require DISCUZ_ROOT . '/source/function/function_question.php';

    $question_list = getQuestionList();
}

$page = max(1, intval($_GET['page']));
if($catid == 849) {$type = $_GET['type'];}	//专题列表增加分类筛选	2014.07.15 Qiudongfang
$navtitle = $cat['catname'].($page>1?" ($page)":'');
$metadescription = empty($cat['description']) ? $cat['catname'] : $cat['description'];
$metakeywords =  empty($cat['keyword']) ? $cat['catname'] : $cat['keyword'];

$file  = 'portal/list:'.$catid;
include template('diy:'.$file, NULL, NULL, NULL, $cat['primaltplname']);

//缓存通用方法 at 20120903 by zhanghongliang
function loadCacheArray($name,$page=1){
	global $_G;
	try{
		$filename = "cat_".$_G['catid']."_".$page;
		$aray_index = "list_$page_".$name;
		static $cache_array = NULL;
		if ($cache_array == NULL) {
            if($_G['uid']==1){
                ForumOptionCache::deleteCache($filename);
            }
			$cache_array = ForumOptionCache::loadCache($filename, $aray_index);
		}
		if (isset($cache_array[$aray_index])) {
			$cache_item = $cache_array[$aray_index];
		} else {
			$cache_item = array();
		}
		if ($cache_item && isset($cache_item['cacheTime'])) {
			//缓存时间：3*3600=10800
			if (time() - 1 < $cache_item['cacheTime']) {
				return $cache_item['content'];
			}
		}
		$item_array = array('cacheTime'=>time());
		switch ($name) {
				case 'kqmg':
					$item_array['content'] = getKqmgList($page); break;
                                //户外摄影师
                                case 'hwsys':
                                    $item_array['content'] = getHwsysList($page); break;
				case 'mryt':
					$item_array['content'] = getMrytList($page); break;
				case 'glxz':
					$item_array['content'] = getGlxzList($page); break;
				case 'yzxx':
					$item_array['content'] = getYzxxList($page); break;
				case 'jctj':
					$item_array['content'] = getJctjList($page); break;
				default:
					$item_array['content'] = array();
		}
		$cache_array[$aray_index] = $item_array;
		ForumOptionCache::writeCache($filename, $cache_array);
		return $item_array['content'];
	}catch(Exception $e){
		return array();
	}
}

function category_get_wheresql($cat) {
	$wheresql = '';
	if(is_array($cat)) {
		$catid = $cat['catid'];
		if(!empty($cat['subs'])) {
			include_once libfile('function/portalcp');
			$subcatids = category_get_childids('portal', $catid);
			$subcatids[] = $catid;

			$wheresql = "at.catid IN (".dimplode($subcatids).")";
		} else {
			$wheresql = "at.catid='$catid'";
		}
	}
	$wheresql .= " AND at.status='0'";
	return $wheresql;
}

function category_get_list($cat, $wheresql, $page = 1, $perpage = 30) {
	global $_G;
	$start = ($page-1)*$perpage;
	if($start<0) $start = 0;
	$list = array();
	$pricount = 0;
	$multi = '';
	$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('portal_article_title')." at WHERE $wheresql"), 0);
	if($count) {
		$query = DB::query("SELECT * FROM ".DB::table('portal_article_title')." at WHERE $wheresql ORDER BY at.stickstate DESC,at.dateline DESC LIMIT $start,$perpage");
		while ($value = DB::fetch($query)) {
			$content = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_content')." WHERE aid='$value[aid]' ORDER BY pageorder LIMIT 0,1");
			if($content['idtype']=='pid'&& $content['id']!=0){
				$firstpost = DB::fetch_first("SELECT tid FROM ".DB::table('forum_post')." WHERE pid='$content[id]' and first='1' LIMIT 0,1");
				$comment = DB::fetch_first("SELECT replies FROM ".DB::table('forum_thread')." WHERE tid='$firstpost[tid]' LIMIT 0,1");
				$value['commentnum'] = $comment['replies'];
			}else{
				$comment = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_count')." WHERE aid='$value[aid]' LIMIT 0,1");
				$value['commentnum'] = $comment['commentnum'];
			}
			$value['catname'] = $value['catid'] == $cat['catid'] ? $cat['catname'] : $_G['cache']['portalcategory'][$value['catid']]['catname'];
			if($value['pic']) {
				$value['pic'] = $value['pic'] ? getimagethumb(400,300,2,'portal/'.$value['pic'], 0, $value['serverid']) : "";
			}
			$value['dateline_ori'] = $value['dateline'];
			$value['dateline'] = dgmdate($value['dateline']);
			if($value['status'] == 0 || $value['uid'] == $_G['uid'] || $_G['adminid'] == 1) {
				$list[] = $value;
			} else {
				$pricount++;
			}
		}
		$multi = multi($count, $perpage, $page, $cat['caturl']);
	}
	return $return = array('list'=>$list,'count'=>$count,'multi'=>$multi,'pricount'=>$pricount);
}

function category_get_list_more($cat, $wheresql, $hassub = true,$hasnew = true,$hashot = true) {
	global $_G;
	$data = array();
	$catid = $cat['catid'];

	$cachearr = array();
	if($hashot) $cachearr[] = 'portalhotarticle';
	if($hasnew) $cachearr[] = 'portalnewarticle';

	if($hassub) {
		foreach($cat['children'] as $childid) {
			$cachearr[] = 'subcate'.$childid;
		}
	}

	$allowmemory = memory('check');
	foreach ($cachearr as $key) {
		$cachekey = $key.$catid;
		$data[$key] = $allowmemory ? memory('get', $cachekey) : '';
		if(empty($data[$key])) {
			$list = array();
			$sql = '';
			if($key == 'portalhotarticle') {
				$dateline = TIMESTAMP - 3600 * 24 * 90;
				$sql = "SELECT at.* FROM ".DB::table('portal_article_count')." ac, ".DB::table('portal_article_title')." at WHERE $wheresql AND ac.dateline>'$dateline' AND ac.aid=at.aid ORDER BY ac.viewnum DESC LIMIT 10";
			} elseif($key == 'portalnewarticle') {
				$sql = "SELECT * FROM ".DB::table('portal_article_title')." at WHERE $wheresql ORDER BY at.dateline DESC LIMIT 10";
			} elseif(substr($key, 0, 7) == 'subcate') {
				$cacheid = intval(str_replace('subcate', '', $key));
				if(!empty($_G['cache']['portalcategory'][$cacheid])) {
					$where = '';
					if(!empty($_G['cache']['portalcategory'][$cacheid]['children']) && dimplode($_G['cache']['portalcategory'][$cacheid]['children'])) {
						$_G['cache']['portalcategory'][$cacheid]['children'][] = $cacheid;
						$where = 'at.catid IN ('.dimplode($_G['cache']['portalcategory'][$cacheid]['children']).')';
					} else {
						$where = 'at.catid='.$cacheid;
					}
					$where .= " AND at.status='0'";
					$sql = "SELECT * FROM ".DB::table('portal_article_title')." at WHERE $where ORDER BY at.dateline DESC LIMIT 10";
				}
			}

			if($sql) {
				$query = DB::query($sql);

				while ($value = DB::fetch($query)) {
					$value['catname'] = $value['catid'] == $cat['catid'] ? $cat['catname'] : $_G['cache']['portalcategory'][$value['catid']]['catname'];
					if($value['pic']) $value['pic'] = pic_get($value['pic'], 'portal', $value['thumb'], $value['remote'],1,$value['serverid']);
					$value['timestamp'] = $value['dateline'];
					$value['dateline'] = dgmdate($value['dateline']);
					$list[] = $value;
				}
			}

			$data[$key] = $list;
			if($allowmemory && !empty($list)) {
				memory('set', $cachekey, $list, 600);
			}
		}
	}
	return $data;
}

//获取分类导航菜单
function category_get_nav($catid) {
	global $_G;

	$nav = " > <a href=\"{$_G['config']['web']['portal']}list/{$catid}/\">{$_G['cache']['portalcategory'][$catid]['catname']}</a>";
	if($_G['cache']['portalcategory'][$catid]['upid']) {
		$nav = category_get_nav($_G['cache']['portalcategory'][$catid]['upid']).$nav;
	}
	return $nav;
}

function getCatbyupid($catid){

	$sql = "select catname,catid from ".DB::table('portal_category')." where upid in('$catid') order by displayorder";
	$result = DB::query($sql);
	$catid_arr = array();
	while($row = DB::fetch($result)){
		$catid_arr[] = $row;
	}
	return $catid_arr;
}

//专题分页调取 add by wangqi 20110117
function topic_get_list($cat, $type, $page = 1, $perpage = 15) {
	global $_G;
	$start = ($page-1)*$perpage;
	if($start<0) $start = 0;
	//增加分类筛选
	$typesql = '';
	if(isset($type) && in_array($type, array(0,1))) {$typesql = " AND type='$type'";$cat['caturl']="portal.php?mod=list&catid=849&type=$type&page=$page";}
	//分类筛选 END
	$list = array();
	$pricount = 0;
	$multi = '';
	$count = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('portal_topic')." WHERE closed = 0 $typesql"), 0);
	if($count) {
		$query = DB::query("SELECT * FROM ".DB::table('portal_topic')." WHERE closed = 0 $typesql ORDER BY topicid DESC LIMIT $start,$perpage");
		while ($value = DB::fetch($query)) {
			if($value['picflag']) {
				$value['pic'] = pic_get($value['cover'], 'portal');
			} else {
				$value['pic'] = $value['cover'];
			}
			$value['dateline'] = dgmdate($value['dateline']);
			$list[] = $value;
		}
		$multi = multi($count, $perpage, $page, $cat['caturl']);
	}
	return $return = array('list'=>$list,'count'=>$count,'multi'=>$multi);
}

//得到tids，pids
function getcommons($module, $field, $limit=5, $arrMd){
	global $_G;
	$dianpingList = array();

	extract($arrMd);
	$needpic = false;
	if ($module == "equipment") {
		$mod 	  = $mdEquipment;
		$needpic = true;
		$tempName = "subject";
	} elseif ($module == "mountain") {
		$mod 	  = $mdMountain;
		$tempName = "subject";
	} elseif ($module == "skiing") {
		$mod 	  = $mdSkiing;
		$tempName = "subject";
	} elseif ($module == "brand") {
		$mod 	  = $mdBrand;
		$tempName = "subject";
	} elseif ($module == "line") {
		$mod 	  = $mdLine;
		$tempName = "subject";
	} elseif ($module == "diving") {
		$mod 	  = $mdDiving;
		$tempName = "subject";
	} elseif ($module == "fishing") {
		$mod 	  = $mdFishing;
		$tempName = "subject";
	} elseif ($module == "climb") {
		$mod 	  = $mdClimb;
		$tempName = "subject";
	}

	$fid    = !empty($_G["config"]['fids'][$module]) ? $_G["config"]['fids'][$module] : "";
	if (empty($fid)) {return array();}

	/*修改下面排行榜部分，排行榜部分将直接单表查询*/
	if($field == "tid"){
 		$dianpingList = $mod->getRank($limit);
	}elseif($field == "pid"){
		$dianpingList = $mod->getNewDianping($limit, $needpic);
	}
	return $dianpingList;
}

//根据当前分类获取推荐数据
function gethddata($cat, $random = 5){
	global $_G;
	$appname = $_G['config']['hdapikey']['8264com']['appname'];
	$appsecret = $_G['config']['hdapikey']['8264com']['appsecret'];
	if($cat['catid'] == 751 || $cat['upid'] == 751){ //业界资讯首列表和子列表
		$params = array(
			'appname' => $appname,
			'app' => 'search',
			'act' => 'recommend',
			'qt' => time(),
			'r' => $random,
			'cate' => '4,15'
		);
		$url = build_url($params, $appsecret);
		$json_data = file_get_contents($url);
		$data = json_decode($json_data, true);
		if($data['errorCode'] == 0){
			return iconv_array($data['result'], 'UTF-8', 'GBK');
		}
		return false;
	}elseif($cat['catid'] == 238 || $cat['upid'] == 238){ //户外知识首列表和子列表
		$relation = array(
			238 => '4,15',
			242 => 4, //露营徒步
			931 => 48, //安全急救
			915 => 51, //登山
			916 => 52, //攀岩速降
			917 => 5, //骑行
			918 => 94, //跑步
			919 => 6, //滑雪
			921 => 66, //水上运动
			920 => 48 //领队
		);
	}elseif(isset($cat['ups'][204])){ //户外装备子列表
		$relation = array(
			209 => 4, //服装
			923 => 4, //冲锋衣
			924 => 4, //抓绒衣
			925 => 4, //皮肤衣
			926 => 4, //速干衣
			927 => 51, //羽绒服
			929 => 51, //软壳
			211 => 4, //户外鞋
			928 => 4, //登山鞋
			930 => 4, //徒步鞋
			933 => 50, //越野跑鞋
			932 => 70, //溯溪鞋
			220 => 51, //登山杖
			208 => 7, //帐篷
			212 => 7, //睡袋
			792 => 7, //炉具
			218 => 7, //灯具
			219 => 7, //水具
			222 => 7, //面料
			207 => 4, //背包
			214 => 7, //防潮垫
			216 => 4, //电子导航
			215 => 4, //冰岩绳索
			223 => '4,15', //综合装备
			867 => '4,15', //值得买
			213 => 7, //刀具
		);
	}
	if (isset($relation[$cat['catid']])) {
		$params = array(
			'appname' => $appname,
			'app' => 'search',
			'act' => 'recommend',
			'qt' => time(),
			'r' => $random,
			'cate' => $relation[$cat['catid']]
		);
		$url = build_url($params, $appsecret);
		$json_data = file_get_contents($url);
		$data = json_decode($json_data, true);
		if ($data['errorCode'] == 0) {
			return iconv_array($data['result'], 'UTF-8', 'GBK');
		}
	}
	return false;
}
function build_url($params, $appsecret, $apiurl = 'http://hd.8264.com/api/index.php') {
	ksort($params);
	reset($params);
	$str_q = http_build_query($params);
	$sign = md5($str_q . $appsecret);
	return $apiurl . '?' . $str_q . '&sign=' . $sign;
}
?>
