<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_share.php 6752 2010-03-25 08:47:54Z cnteacher $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$page  = empty($_GET['page']) ? 1 : intval($_GET['page']);
if($page < 1) $page = 1;
$perpage = 20;
$start   = ($page-1)*$perpage;
ckstart($start, $perpage);

$idtypes    = array('thread'=>'tid', 'blog'=>'blogid', 'album'=>'albumid');
$_G['gp_type'] = isset($idtypes[$_G['gp_type']]) ? $_G['gp_type'] : 'all';

$gets = array(
	'mod'  => 'space',
	'uid'  => $space['uid'],
	'do'   => 'favorite',
	'type' => $_G['gp_type']
);
$theurl = 'home.php?'.url_implode($gets);

$list       = array();
$wheresql   = "uid={$_G[uid]}";
$idtype     = isset($idtypes[$_G['gp_type']]) ? $idtypes[$_G['gp_type']] : '';

//สีฒุสý
$arrCount = array();
$arrCount['album']  = DB::result_first("SELECT COUNT(favid) FROM ".DB::table('home_favorite')." WHERE $wheresql and idtype='albumid' " . getSlaveID());
$arrCount['blog']   = DB::result_first("SELECT COUNT(favid) FROM ".DB::table('home_favorite')." WHERE $wheresql and idtype='blogid' " . getSlaveID());
$arrCount['thread'] = DB::result_first("SELECT COUNT(favid) FROM ".DB::table('home_favorite')." WHERE $wheresql and idtype='tid' " . getSlaveID());
$arrCount['all'] 	= array_sum($arrCount);
$count = $arrCount[$_G['gp_type']];
if($count) {
	$sql   = "select favid,id,idtype,title,dateline from ".DB::table('home_favorite')." where $wheresql ";
	$sql  .= $idtype ? " and idtype='{$idtype}'" :  " and idtype in ('albumid','blogid','tid')";
	$sql  .= " order by dateline desc limit {$start},{$perpage} " . getSlaveID();
	$query = DB::query($sql);
	while ($value = DB::fetch($query)) {
		$value['url']          = makeurl($value['id'], $value['idtype'], $space['uid']);
		$list[$value['favid']] = $value;
	}
	
	$multi = multi($count, $perpage, $page, $theurl);
}

$navtitle = lang('core', 'title_'.$_G['gp_type'].'_favorite');
include_once template("home/space_favorite");

function makeurl($id, $idtype, $spaceuid=0) {
	$url = '';
	switch($idtype) {
		case 'tid':
			$url = 'forum.php?mod=viewthread&tid='.$id;
			break;
		case 'blogid':
			$url = 'home.php?mod=space&uid='.$spaceuid.'&do=blog&id='.$id;
			break;
		case 'albumid':
			$url = 'home.php?mod=space&uid='.$spaceuid.'&do=album&id='.$id;
			break;
	}
	return $url;
}

?>