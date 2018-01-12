<?php
/**
 *	装备列表处理
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
//分类配置
$category = $dp_category['equipment']['category'];

$pcid = $_G['gp_pcid'] ? intval($_G['gp_pcid']) : 0;
$cid = $_G['gp_cid'] ? intval($_G['gp_cid']) : 0;
$min = $_G['gp_min'] ? intval($_G['gp_min']) : 0;
$max = $_G['gp_max'] ? intval($_G['gp_max']) : 0;
$bid = $_G['gp_bid'] ? ($_G['gp_bid'] == 'other' ? '-1' : intval($_G['gp_bid'])) : 0;

//面包屑导航
$navarr = array();
if($pcid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid=0&bid=0&page=1",'title'=>$category[$pcid]['name'])); }
if($pcid && $cid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid={$cid}&bid=0&page=1",'title'=>$category[$pcid]['child'][$cid])); }
$subnav = make_nav($navarr);

//处理列表数据
$perpage = 80;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page-1)*$perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = 'i.cnum DESC';
		break;
//	case 'score':
//		$orderby = 'i.score desc';
//                $condition = 'i.cnum >=10 and ';
//		break;
	case 'newest':
		$orderby = '';
		break;
	default:
		$orderby = 'i.lastpost DESC';
		break;
}
$condition = 'i.ispublish=1';
if($_G['gp_searchtext']){
	$condition_select_brand = $condition.' GROUP BY brandid';   
	
	$searchtext=diconv($_G['gp_searchtext'], "UTF-8","GBK");
	$searchtexts=dhtmlspecialchars($searchtext);
	$searchtexts=preg_replace ("/\s(?=\s)/","\\1", $searchtexts );
	$sflag='dp_eq_search_'.substr(md5($searchtexts.$order),0,8);
	$search=explode(" ",trim($searchtexts));
	$search=array_slice($search,0,3);
	foreach ($search as $k=>$s){
		$condition .=" AND i.subject LIKE '%".$s."%'";
	}
	if($searchtexts){
		DB::query("UPDATE ".DB::table('plugin_search_logs')." SET snum=snum+1 WHERE scontent='".$searchtexts."'");
		if(DB::affected_rows()==0){
			DB::query("INSERT INTO ".DB::table('plugin_search_logs')." (scontent,snum) VALUES ('".$searchtexts."',1)");
		}
	}
}else{
	$condition .= $cid ? ' AND i.cid='.$cid : ($pcid ? ' AND i.pcid='.$pcid : '');
	$condition_select_brand = $condition.' GROUP BY brandid';
	$condition .= $min ? ' AND i.price>='.$min : '';
	$condition .= $max ? ' AND i.price<='.$max : '';
	$condition .= $bid ? ' AND i.brandid='.$bid : '';
}
//列表数据
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

//评分优先显示大于5个人的，按分数降序排
if($searchtexts && memory('get', $sflag."_".$page)){
	$modlist=memory('get', $sflag."_".$page);
	$recordnum=memory('get','dp_'.$mod.'_recordnum_'.substr(md5($condition), 0, 5));
}else{
	if($order == "score"){
	    $orderby = 'i.score DESC';
	    $condition .= ' AND i.cnum >=5';
	    
	    $where = 'i.ispublish=1';
	    if($searchtexts){
	    	foreach ($search as $k=>$s){
	    		$where .= " AND i.subject LIKE '%".$s."%'";
	    	}
	    }else{
		    $where .= $cid ? ' AND i.cid='.$cid : ($pcid ? ' AND i.pcid='.$pcid : '');
		    //$condition_select_brand = $where.' GROUP BY brandid';
		    $where .= $min ? ' AND i.price>='.$min : '';
		    $where .= $max ? ' AND i.price<='.$max : '';
		    $where .= $bid ? ' AND i.brandid='.$bid : '';
	    }
	    $where .= ' AND i.cnum < 5';
	    $modlist_con = $list_obj->getlist($mod, 'i.brandname,i.kaid, i.views', $condition,$start, $perpage,$orderby, '', 1);      
	    $recordnum_con = $list_obj->recordnum;
	    $con_page = ceil($recordnum_con/$perpage);
	    $offset   = $recordnum_con % $perpage;
	    $offset_con = $perpage - $offset;
	    if ($page <= $con_page ) {
	        if ($page == $con_page && $offset > 0) {            
	            $modlist_where = $list_obj->getlist($mod, 'i.brandname, i.kaid, i.views', $where,0, $offset_con,$orderby, '', 1);
	            $modlist = array_merge($modlist_con,$modlist_where);
	        } else {
	            $modlist = $modlist_con;
	        }
	        
	    } else {
	        $start_where = ($page-$con_page)*$perpage + $offset_con;
	        $modlist_where = $list_obj->getlist($mod, 'i.brandname, i.kaid, i.views', $where,$start_where, $perpage,$orderby, '', 1);
	        $modlist = $modlist_where;
	    }
	    $modlist_where_all = $list_obj->getlist($mod, 'i.brandname,i.kaid, i.views', $where,$start, $perpage,$orderby, '', 1);
	    $recordnum_where = $list_obj->recordnum;
	    
	    $recordnum = $recordnum_con + $recordnum_where;
	}else{
	    $modlist = $list_obj->getlist($mod, 'i.brandname, i.kaid, i.views', $condition, $start, $perpage, $orderby, '', 1);
	    $recordnum = $list_obj->recordnum;
	    
	}
	if($searchtexts){
		memory("set", $sflag."_".$page,$modlist,3600);
	}
}
$theurl = "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&pcid={$pcid}&cid={$cid}&bid={$bid}&min={$min}&max={$max}";
if($searchtexts!=""){
	$theurl .= "&page=$page?searchtext=".urlencode(iconv("GBK", "UTF-8", $searchtexts));
}
$multipage = multi($recordnum, $perpage, $page, $theurl);
//取该条件下所有数据，用于重置筛选列表
$eq = memory('get','dp_equipment_brand_select_'.substr(md5($condition_select_brand), 0, 5));
if(!$eq) {
	$query = DB::query("SELECT brandid FROM ".DB::table('dianping_equipment_info')." AS i WHERE $condition_select_brand ORDER BY id ASC ".getSlaveID());
	while ($row = DB::fetch($query)) {
		$eq[$row['brandid']] = $row['brandid'];
	}
	memory('set','dp_equipment_brand_select_'.substr(md5($condition_select_brand), 0, 5), $eq, 3600);
}

//品牌列表缓存
$_G['cache']['dp_equipment_brandlist'] ? $brandlist = $_G['cache']['dp_equipment_brandlist'] : updatecache('dp_equipment_brandlist');
$dp_category['brand']['letter']['-1'] = '其它品牌';

$show_all_brand = array_intersect_key($brandlist, $eq);
foreach ($show_all_brand as $key => $value) {
	$letterlist[$value['letter']] = $dp_category['brand']['letter'][$value['letter']];
}
ksort($letterlist);

if(count($show_all_brand) > 20)
{
	$show_brand = array_slice($show_all_brand, 0, 5);
}
//SEO信息处理
$seo_str = $seo_str2 = '';
switch ($order) {
	case 'heats':
		$seo_str = '最热门的';
		break;
	case 'score':
		$seo_str = '口碑最好的';
		break;
	case 'newest':
		$seo_str = '最新的';
		break;
	default:
		break;
}
if($bid) { $seo_str .= $brandlist[$bid]['subject']; }
if($max && !$min) { $seo_str .= $max.'元以下'; }
if($min && !$max) { $seo_str .= $min.'元以上'; }
if($min && $max) { $seo_str .= "{$min}~{$max}元"; }
if($pcid && !$cid) { $seo_str2 .= $category[$pcid]['name']; }
if($pcid && $cid) { $seo_str2 .= $category[$pcid]['child'][$cid]; }
if($page > 1) { $page_str = " - 第{$page}页"; }

if($seo_str || $seo_str2)
{
	if (!$seo_str2){
		$seo_str2="装备";
	}
	$pageTitle = "{$seo_str}户外{$seo_str2}哪个好|品牌推荐{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "{$seo_str}{$seo_str2}哪个好，十大{$seo_str}{$seo_str2}排行榜";
	$metadescription = "2016年最新{$seo_str}{$seo_str2}推荐展示介绍,{$seo_str}{$seo_str2}排行榜大全,包括{$seo_str}{$seo_str2}价格、规格参数、照片以及用户真实使用点评使用心得，为驴友购买{$seo_str}{$seo_str2}提供最准确的参考信息";
}
else
{
	$pageTitle = "户外装备大全，装备用品推荐点评，户外用品使用心得{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "户外用品库大全 , 户外用品库哪个好,十大户外用品库排行榜";
	$metadescription = "户外资料网装备库汇集各类户外装备，与驴友交流分享装备购买、使用心得，点评讨论最新最前沿的装备";
}

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');
include template('dianping/equipment_showlist');
?>
