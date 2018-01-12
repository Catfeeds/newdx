<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: search.php 19871 2011-01-21 04:28:33Z zhengqingpeng $
 */

define('APPTYPEID', 0);
define('CURSCRIPT', 'search');

require './source/class/class_core.php';

$discuz = & discuz_core::instance();

$modarray = array('my', 'user', 'curforum');

$modcachelist = array('register' => array('modreasons', 'stamptypeid', 'fields_required', 'fields_optional'));

$cachelist = $slist = array();
if(isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];
}

$discuz->cachelist = $cachelist;
$discuz->init();

if(in_array($discuz->var['mod'], $modarray) || !empty($_G['setting']['search'][$discuz->var['mod']]['status'])) {
	$mod = $discuz->var['mod'];
} else {
	foreach($_G['setting']['search'] as $mod => $value) {
		if(!empty($value['status'])) {
			break;
		}
	}
}

define('CURMODULE', $mod);

$viewtime = strtotime(date('Y-m-d H:m:i'));
runhooks();

require_once libfile('function/discuzcode');


$navtitle = lang('core', 'title_search');

if($mod == 'curforum') {
	$mod = 'forum';
	$_G['gp_srchfid'] = array($_G['gp_srhfid']);
	$_G['gp_srhfid'] = $_G['gp_srhfid'];
} elseif($mod == 'forum') {
	$_G['gp_srchfid'] = array();
	$_G['gp_srhfid'] = 0;
}
/*
	function orstr($keys,$or){
		$orlist;
		$nbsps = "/[\s]+/";
		$keyslist=preg_split($nbsps,$keys);
        if(count($keyslist)>1){
			foreach ($keyslist as $keysrow) {
				if($keysrow !=""){
					$orlist.= "or ".$or."'%$keysrow%'";
				}
		    }
			return substr($orlist,2);
		}else{
			$orlist=$or."'%$keys%'";
			return $orlist;
		}
	}


if($mod=="portal" || $mod=="forum" || $mod=="blog"){

	$keywords = $_G['gp_srchtxt'];
	$keywords = mb_ereg_replace('^(ã€?| )+', '', $keywords);
    $keywords = mb_ereg_replace('(ã€?| )+$', '', $keywords);
    $keywords = mb_ereg_replace('ã€?ã€?', "\nã€?ã€?", $keywords);
	$srchmod;
    $sqltxt;
	$idstxt;
	if($mod=="portal"){
		$srchmod=1;
		$idstxt="aid";
		$sqltxt="SELECT aid FROM ".DB::table('portal_article_title')." WHERE " .orstr($keywords,"title LIKE")."ORDER BY aid DESC LIMIT 500";
		
	}
	if($mod=="forum"){
		$srchmod=2;
		$idstxt="tid";
		$sqltxt="SELECT tid FROM ".DB::table('forum_thread')." WHERE isgroup='0' AND displayorder>='0' AND ".orstr($keywords,"subject LIKE")."ORDER BY tid DESC LIMIT 500";
	}
	if($mod=="blog"){
		$srchmod=3;
		$idstxt="blogid";
		$sqltxt="SELECT blogid FROM ".DB::table('home_blog'). " WHERE ".orstr($keywords,"subject LIKE")." ORDER BY blogid DESC LIMIT 500";
	}

	$num = $ids = 0;
	$query = DB::query($sqltxt);
		while($article = DB::fetch($query)) {
			$ids .= ','.$article[$idstxt];
			$num++;
		}

	$temp;
	$query_temp = DB::query("select * from ".DB::table('plugin_searchkey_searchindex'));
	if($keywords==" " || $keywords==null || empty($keywords) || !isset($keywords) || $keywords==""){
		$temp="1";
	}else{
		if(!DB::fetch($query_temp)){
			$temp="0";
        }

		while($search = DB::fetch($query_temp)) {
			if($search['keywords']==$keywords){
				$temp="1";
				break;
			}else{
				$temp="0";
			}
		}
		if($temp=="0"){
			DB::query("INSERT INTO ".DB::table('plugin_searchkey_searchindex')." (srchmod, keywords,useip, uid, dateline, num, ids,state)
					VALUES ('$srchmod', '$keywords', '$_G[clientip]', '$_G[uid]', '$_G[timestamp]', '$num', '$ids','0')");
		}else{
			DB::query("UPDATE ".DB::table('plugin_searchkey_searchindex')." set srchmod='$srchmod',useip='$_G[clientip]',uid='$_G[uid]',dateline='$_G[timestamp]',num='$num',ids='$ids' where keywords='$keywords'");
		}
	}
}
    $searchidnum = DB::fetch_first("SELECT * FROM ".DB::table('plugin_searchkey_searchindex')." WHERE keywords='".$_G['gp_srchtxt']."'");
	if($searchidnum) {
		DB::query("INSERT INTO ".DB::table('plugin_searchkey_searchindex_viewnum')." (time,searchid) VALUES ('$viewtime','$searchidnum[searchid]')");
		if($searchidnum['viewnum']=="" || $searchidnum['viewnum']==null){
			DB::query("UPDATE ".DB::table('plugin_searchkey_searchindex')." SET viewnum=0 WHERE searchid=".$searchidnum['searchid']);
		}
		DB::query("UPDATE ".DB::table('plugin_searchkey_searchindex')." SET viewnum=viewnum+1 WHERE searchid=".$searchidnum['searchid']);
	}*/
require DISCUZ_ROOT.'./source/module/search/search_'.$mod.'.php';


?>