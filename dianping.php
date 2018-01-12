<?php
/**
 *	��������ļ�
 *	��forum���뿪�����������bug
 */
define('APPTYPEID', 6);
define('CURSCRIPT', 'dianping');
require_once './banip.php';
require './source/class/class_core.php';
$discuz = & discuz_core::instance();

$modarray = array('misc', 'equipment', 'brand', 'skiing', 'shop', 'line', 'mountain', 'climb', 'diving', 'fishing','club','hostel', 'chain');
$mod = in_array($_GET['mod'], $modarray) ? $_GET['mod'] : '';
$actarray = array('comment', 'showlist','myshowlist', 'showview', 'dopost', 'downloadgps','commentdetail');
$act = in_array($_GET['act'], $actarray) ? $_GET['act'] : 'showlist';

$modcachelist = array(
	'skiing' => array(
		'showlist'=>array('dp_skiing_pro', 'dp_skiing_index_comment', 'dp_skiing_sidebar_hot', 'dp_skiing_sidebar_new'),
		'showview'=>array('dp_skiing_pro', 'dp_skiing_sidebar_hot'),
		'commentdetail'=>array('dp_skiing_pro', 'dp_skiing_index_comment', 'dp_skiing_sidebar_hot', 'dp_skiing_sidebar_new'),
		'commentdetail'=>array('dp_skiing_pro', 'dp_skiing_sidebar_hot')
		),
	'mountain' => array(
		'showlist'=>array('forumlinks','dp_mountain_comment_rate'),
		'showview'=>array('dp_mountain_sidebar_hot'),
		),
	'equipment' => array(
		'showlist'=>array('dp_equipment_brandlist'),
		),
	'shop' => array(
		'showlist'=>array('dp_shop_region'),
		'showview'=>array('dp_shop_region'),
		'commentdetail'=>array('dp_shop_region'),
		'commentdetail'=>array('dp_shop_region'),
		),
	'climb' => array(
		'showlist'=>array('dp_climb_comment_rate','dp_country_region'),
		'showview'=>array('dp_climb_list_hot','dp_country_region'),
		'commentdetail'=>array('dp_climb_comment_rate','dp_country_region'),
		'commentdetail'=>array('dp_climb_list_hot','dp_country_region'),
		),
	'diving' => array(
		'showlist'=>array('dp_diving_comment_rate','dp_country_region'),
		'showview'=>array('dp_diving_list_hot','dp_country_region'),
		'commentdetail'=>array('dp_diving_comment_rate','dp_country_region'),
		'commentdetail'=>array('dp_diving_list_hot','dp_country_region'),
		),
	'fishing' => array(
		'showlist'=>array('dp_fishing_comment_rate','dp_country_region'),
		'showview'=>array('dp_fishing_list_hot','dp_country_region'),
		'commentdetail'=>array('dp_fishing_comment_rate','dp_country_region'),
		'commentdetail'=>array('dp_fishing_list_hot','dp_country_region'),
		),
	'line' => array(
		'showlist'=>array('dp_line_comment_rate','dp_country_region','dp_line_region'),
		'showview'=>array('dp_line_list_hot','dp_country_region'),
		'commentdetail'=>array('dp_line_comment_rate','dp_country_region','dp_line_region'),
		'commentdetail'=>array('dp_line_list_hot','dp_country_region'),
		),
	'club' => array(
		'showlist'=>array('dp_club_comment_rate','dp_country_region'),
		'myshowlist'=>array('dp_club_comment_rate','dp_country_region'),
		'showview'=>array('dp_club_list_hot','dp_country_region'),
		'commentdetail'=>array('dp_club_comment_rate','dp_country_region'),
		'commentdetail'=>array('dp_club_list_hot','dp_country_region'),
		),
	'hostel' => array(
		'showlist'=>array('dp_hostel_comment_rate','dp_country_region'),
		'myshowlist'=>array('dp_hostel_comment_rate','dp_country_region'),
		'showview'=>array('dp_hostel_list_hot','dp_country_region'),
		'commentdetail'=>array('dp_hostel_comment_rate','dp_country_region'),
		'commentdetail'=>array('dp_hostel_list_hot','dp_country_region'),
		),
	'chain' => array(
		'showlist'=>array('dp_chain_comment_rate','dp_country_region'),
		'showview'=>array('dp_country_region'),
		),

);

$cachelist = array();
if (isset($modcachelist[$mod])) {
	$cachelist = $modcachelist[$mod][$act];
}

$discuz->cachelist = $cachelist;
$discuz->init();

runhooks();
if(!$mod)
{
	showmessage('������������Ϊ����ת��װ����', 'http://www.8264.com/zhuangbei.html');
}

define('CURMODULE', $mod);

require DISCUZ_ROOT.'./config/config_dianping.php';
include_once libfile('function/dianping');
include_once libfile('function/cache');
//�ֶ����»���
if($_G['adminid']==1 && $_GET['nocache']==1)
{
	updatecache($cachelist);
}

//Ŀǰ����SEO�ؼ���ͳ��
$_G['fid'] = $dp_modules[$mod]['fid'];
if(intval($_G['gp_tid'])) {
	$_G['tid'] = $_G['gp_tid'];
}
$url_mod = $dp_modules[$mod][uname];
$_G['url_mod'] = $url_mod;
include DISCUZ_ROOT.'./source/module/dianping/'.$mod.'_'.$act.'.php';
?>
