<?php
/**
 *	品牌列表
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
//分类配置
$cate_letter = $dp_category['brand']['letter'];
$cate_region = $dp_category['brand']['region'];
$cate_ranklist = $dp_category['brand']['ranklist'];

$pid = $_G['gp_pid'] ? intval($_G['gp_pid']) : 0;
$rid = $_G['gp_rid'] ? intval($_G['gp_rid']) : 0;
$sid = $_G['gp_sid'] ? intval($_G['gp_sid']) : 0;
$cid = $_G['gp_cid'] ? intval($_G['gp_cid']) : 0;
$bid = $_G['gp_bid'] ? intval($_G['gp_bid']) : 0;

//面包屑导航
$navarr = array();
if($pcid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid=0&bid=0&page=1",'title'=>$category[$pcid]['name'])); }
if($pcid && $cid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid={$cid}&bid=0&page=1",'title'=>$category[$pcid]['child'][$cid])); }
$subnav = make_nav($navarr);

//处理列表数据
$perpage = 35;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page-1)*$perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'lastpost','dateline')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = ' i.cnum desc ';
		$ordertitle="最热门的";
		break;
//	case 'score':
//		$orderby = ' i.score desc ';
//		$ordertitle="口碑最好的";
//		break;
	case 'dateline':
		$orderby = ' i.dateline desc ';
		$ordertitle="最新的";
		break;
	default:
		$orderby = ' i.lastpost desc ';
		break;
}
//列表数据
require_once libfile('dianping/modlist_shop', 'class');
$list_obj = new modlist_shop();
$condition =" i.ispublish=1 ";
$where =" i.ispublish=1 ";
if($pid){
	$condition .= " AND i.provinceid = {$pid}";
        $where .= " AND i.provinceid = {$pid}";
}
if($rid){
	$condition .= " AND i.regionid = {$rid}";
        $where .= " AND i.regionid = {$rid}";
}
if($sid){
	if($sid==2){
		$condition .= "  AND i.marketid >= 1";
                $where .= "  AND i.marketid >= 1";
	}elseif($sid==1){
		$condition .= "  AND i.marketid = 0";
                $where .= "  AND i.marketid = 0";
	}elseif($sid!=''){
		$condition .= " AND i.marketid = {$sid}";
                $where .= " AND i.marketid = {$sid}";
	}
}
if($cid){
	$condition .= " AND i.cbrandid = {$cid}";
        $where .= " AND i.cbrandid = {$cid}";
}
if($bid){
	$condition .= " AND i.sbrandid= {$bid}";
        $where .= " AND i.sbrandid= {$bid}";
}


if($order == "score"){
    $orderby = 'i.score desc';
    $ordertitle='口碑最好的';
    $condition .= ' and cnum >=5';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $condition,$start, $perpage,$orderby,'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,0, $offset_con,$orderby,'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,$start_where, $perpage,$orderby, 'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'t.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,$start, $perpage,$orderby, 'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'t.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,$start, $perpage,$orderby, 'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $condition, $start, $perpage, $orderby,'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
    $recordnum = $list_obj->recordnum;
    
}
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&pid={$pid}&rid={$rid}&sid={$sid}&cid={$cid}&bid={$bid}&order={$order}");

//获取地区商场品牌数组
$_G['cache']['dp_shop_region'] ? $arr_region = $_G['cache']['dp_shop_region'] : updatecache('dp_shop_region');


//获取最新店铺
$shop_new = $list_obj->getlist($mod, 'i.dateline', 'i.ispublish=1', 0, 10, ' i.dateline DESC ');

//获取缓存中的品牌和商场
$brand_market=$list_obj->getBrandMarket($pid,$rid,$arr_region);

//获取打折促销信息
$sql =DB::query('SELECT tid,subject FROM  '.DB::table('forum_thread').' where fid = 174 and displayorder=0 order by dateline DESC limit 0,10');
while ($array = DB::fetch($sql)){
	$arrDzcx[]=$array;
}

//页面seo处理
$pname=$pid?$arr_region[$pid]['name']:'';
$rname=$rid?$arr_region[$pid]['city'][$rid]['cityname']:'';
$bname=$bid?$brand_market['brand_array'][$bid]:'';
$cname=$cid?$brand_market['brand_array'][$cid]:'';
if($sid>=2){
	$sname='(商场店)';
}elseif($sid==1){
	$sname='(街边店)';
}
$title = $pname.$rname.$bname.$cname;
if($page > 1) { $page_str = " - 第{$page}页"; }
if ($title) {
	$pageTitle = $metakeywords = "{$ordertitle}{$title}户外旅游用品|户外装备专卖店{$sname}{$page_str} - {$_G['setting']['bbname']}";
	$metadescription = strtr('2016年[province][city][bname]用品店查询、口碑点评，信息真实可靠，是驴友购买装备的重要参考', array(
					'[province]' => $pname,
					'[city]' =>$rname,
					'[bname]' => $bname ? $bname : '户外',
					'[shop]' => $sid ? ($sid == 1 ? '街边店' : '商场店') : ''
		));
}elseif ($ordertitle){
	$pageTitle = $metakeywords = "{$ordertitle}户外用品店,户外用品专营店,户外用品专卖店,旅游用品店 {$page_str} - {$_G['setting']['bbname']}";
	$metadescription ="2016年户外用品店查询、口碑点评，信息真实可靠，是驴友购买装备的重要参考";
}else {
	$pageTitle = $metakeywords = "户外用品店,户外用品专营店,户外用品专卖店,旅游用品店{$page_str} - {$_G['setting']['bbname']}";
	$metadescription ="2016年户外用品店查询、口碑点评，信息真实可靠，是驴友购买装备的重要参考";
}

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');

include template('dianping/'.$mod.'_showlist');

?>
