<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$tid = $_GET['tid'];
if (!$tid) {
    showmessage('URL错误, 请重试', '/');
}

$ralation = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = $tid");
$sn = $ralation['sn'];

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';


$forumoption_mudidi->recordUser();


$page = max(1, intval($_G['gp_page']));

$ppp = 20;
//$count = $forumoption_mudidi->getCountGuideByTid($tid);
//$guideData = $forumoption_mudidi->getGuideByTid($tid, (($page-1)*$ppp).", $ppp");


switch ($ralation['type']) {
	case 1:
		$scapeareaSn = $forumoption_mudidi->getParentSn($sn);
		$scapeareaTid = $forumoption_mudidi->getTidBySn($scapeareaSn);
		$count = $forumoption_mudidi->getCountGuideByTid($scapeareaTid);
		$guideData = $forumoption_mudidi->getGuideByTid($scapeareaTid, (($page-1)*$ppp).", $ppp");
		break;
	case 2:
		$count = $forumoption_mudidi->getCountGuideByTid($tid);
		$guideData = $forumoption_mudidi->getGuideByTid($tid, (($page-1)*$ppp).", $ppp");
		break;
	case 3:
		$count = $forumoption_mudidi->getCountGuideByRegionTid($tid);
		$guideData = $forumoption_mudidi->getGuideByRegionTid($tid, (($page-1)*$ppp).", $ppp");
		break;
	default:
		break;
}


$mudidi_data = DB::fetch_first("SELECT t.*, r.* FROM ".DB::table('mudidi_thread_ralation')." AS r
								LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
							    WHERE r.tid = '{$tid}'");
$pageTitle = "2015最新{$mudidi_data['subject']}旅游攻略下载 - {$mudidi_data['subject']}自助游攻略 - {$mudidi_data['subject']}自由行攻略 - 户外资料网";

include template('whither:guidelist');
