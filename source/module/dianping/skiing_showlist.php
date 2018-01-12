<?php
/**
 *	滑雪场列表
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

ob_start();

$pro = $_G['gp_pro'] ? intval($_G['gp_pro']) : 0;

//加载地区分类缓存
$_G['cache']['dp_skiing_pro'] ? $region = $_G['cache']['dp_skiing_pro'] : updatecache('dp_skiing_pro');

//面包屑导航
// $subnav = make_nav(array(array('url'=>"&order=lastpost&pro={$pro}&page=1",'title'=>$region[$pro]['name'].'滑雪场')));

// 处理列表数据
$perpage = 18;
$page = max(intval($_G['gp_page']), 1);
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = 'i.cnum desc';
		$ordertitle="最热门的";
		break;
//	case 'score':
//		$orderby = 'i.score desc';
//		$ordertitle="口碑最好的";
//		break;
	case 'dateline':
		$orderby = 'i.id desc';
		$ordertitle="最新的";
		break;
	default:
		$orderby = 'i.lastpost desc';
		break;
}

$condition = 'i.ispublish=1';
$condition .= $pro ? ' AND i.provinceid='.$pro : '';

// 列表数据
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

if($order == "score"){
    $orderby = 'score desc';
    $ordertitle='口碑最好的';
    $condition .= ' and cnum >=5';
    
    $where =  'ispublish = 1';
    $where .= $pro ? ' AND i.provinceid='.$pro : '';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod, '', $condition,$start, $perpage,$orderby, '', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod, '', $where,0, $offset_con,$orderby, '', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod, '', $where,$start_where, $perpage,$orderby, '', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'', $where,$start, $perpage,$orderby, '', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'', $where,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, '', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}

$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&pro={$pro}");

//SEO信息处理
$seo_str = '';
if($pro) { $seo_str .= $region[$pro]['name']; }
if($page > 1) { $page_str = " - 第{$page}页"; }

if($seo_str)
{
	$pageTitle = "{$ordertitle}{$seo_str}滑雪场哪个好|{$seo_str}滑雪场排行榜{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "{$seo_str}滑雪场查询，十大{$seo_str}滑雪场口碑排行榜，{$seo_str}最好的滑雪场 - 户外资料网";
	$metadescription = "2016年最新{$seo_str}滑雪场信息查询，包括地址价格雪道器材等介绍，十大{$seo_str}滑雪场口碑排行榜，{$seo_str}最好的滑雪场，为滑雪爱好者提供准确帮助";
}elseif ($ordertitle){
	$pageTitle = "{$ordertitle}滑雪场哪个好|滑雪场排行榜{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "滑雪场查询，十大滑雪场口碑排行榜，最好的滑雪场 - 户外资料网";
	$metadescription = "2016年最新滑雪场信息查询，包括地址价格雪道器材等介绍，十大滑雪场口碑排行榜，最好的滑雪场，为滑雪爱好者提供准确帮助";
}
else
{
	$pageTitle = "滑雪场哪个好|滑雪场排行榜{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "滑雪场查询，十大滑雪场口碑排行榜，最好的滑雪场 - 户外资料网";
	$metadescription = "2016年最新滑雪场信息查询，包括地址价格雪道器材等介绍，十大滑雪场口碑排行榜，最好的滑雪场，为滑雪爱好者提供准确帮助";
}

//点评列表
$_G['cache']['dp_skiing_index_comment'] ? $commentlist = $_G['cache']['dp_skiing_index_comment'] : updatecache('dp_skiing_index_comment');

//边栏
$_G['cache']['dp_skiing_sidebar_hot'] ? $sidebar_hot = $_G['cache']['dp_skiing_sidebar_hot'] : updatecache('dp_skiing_sidebar_hot');
$_G['cache']['dp_skiing_sidebar_new'] ? $sidebar_new = $_G['cache']['dp_skiing_sidebar_new'] : updatecache('dp_skiing_sidebar_new');

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');

include template('dianping/skiing_showlist');
?>
