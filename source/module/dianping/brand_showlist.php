<?php

/**
 * 	品牌列表
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
//分类配置
$cate_letter = $dp_category['brand']['letter'];
$cate_region = $dp_category['brand']['region'];
$cate_ranklist = $dp_category['brand']['ranklist'];

$let = $_G['gp_let'] ? intval($_G['gp_let']) : 0;
$nat = $_G['gp_nat'] ? intval($_G['gp_nat']) : 0;
$cp = $_G['gp_cp'] ? intval($_G['gp_cp']) : 0;

//面包屑处理
$navarr = array();
if ($cp) {
    array_push($navarr, array('url' => "&let=0&nat=0&cp={$cp}&order=lastpost&page=1", 'title' => $dp_category['brand']['ranklist'][$cp]));
}
$subnav = make_nav($navarr);
//处理列表数据
$perpage = 35;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

$condition = " i.ispublish=1 ";
$where =  'ispublish = 1';
if (!empty($let)) {
    $condition .= " and i.letter = {$let}";
    $where .= " and i.letter = {$let}";
    $title = "户外品牌排行榜(首字母{$dp_category['brand']['letter'][$let]})";
}
if (!empty($nat)) {
    $condition .= " and i.nation = {$nat}";
    $where .= " and i.nation = {$nat}";
    $title = "{$dp_category['brand']['region'][$nat]}户外品牌排行榜";
}
if (!empty($cp)) {
    $condition .= " and FIND_IN_SET('$cp',i.ranklist) ";
    $where .= " and FIND_IN_SET('$cp',i.ranklist) ";
    $title = "{$dp_category['brand']['ranklist'][$cp]}";
}
if (!empty($let) && !empty($nat) && !empty($cp)) {

    $title = "{$dp_category['brand']['region'][$nat]}{$dp_category['brand']['ranklist'][$cp]}(首字母{$dp_category['brand']['letter'][$let]})";
} elseif (!empty($let) && !empty($nat)) {
    $title = "{$dp_category['brand']['region'][$nat]}户外品牌排行榜(首字母{$dp_category['brand']['letter'][$let]})";
} elseif (!empty($nat) && !empty($cp)) {
    $title = "{$dp_category['brand']['ranklist'][$cp]}(首字母{$dp_category['brand']['letter'][$let]})";
} elseif (!empty($let) && !empty($cp)) {
    $title = "{$dp_category['brand']['region'][$nat]}{$dp_category['brand']['ranklist'][$cp]}";
}

switch ($order) {
    case 'heats':
        $orderby = 'i.cnum desc';
        $ordertitle = "最热门的";
        break;
//    case 'score':
//        if (!$let && !$nat && !$cp) {
//            $where.= " and i.cnum >= 50 ";
//        }
//        $orderby = 'i.score desc,i.id desc';
//        $ordertitle = "口碑最好的";
//        break;
    case 'dateline':
        $orderby = 'i.dateline desc';
        $ordertitle = "最新的";
        break;
    default:
        $orderby = 'i.lastpost desc';
        break;
}

//列表数据
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();
if($order == "score"){
    $orderby = 'i.score desc,i.id desc';
    $ordertitle = "口碑最好的";
    
    if (!$let && !$nat && !$cp) {
        $condition.= " and i.cnum >= 50 ";
        $modlist = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $condition,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
        }else{
            $condition .= ' and cnum >=5';
            $where .= ' and cnum <5';
            $modlist_con = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $condition,$start, $perpage,$orderby, '', 1);      
            $recordnum_con = $list_obj->recordnum;
            if($modlist_con){
                $con_page = ceil($recordnum_con/$perpage);
                $offset   = $recordnum_con % $perpage;
                $offset_con = $perpage - $offset;
                if ($page <= $con_page ) {
                    if ($page == $con_page && $offset > 0) {
                        $modlist_where = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $where,0, $offset_con,$orderby, '', 1);
                        if($modlist_where){
                            $modlist = array_merge($modlist_con,$modlist_where);
                        }else{
                            $modlist = $modlist_con;
                        }
                    } else {
                        $modlist = $modlist_con;
                    }
                } else {
                    $start_where = ($page-$con_page)*$perpage + $offset_con;
                    $modlist_where = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $where,$start_where, $perpage,$orderby, '', 1);
                    $modlist = $modlist_where;
                }
                $modlist_where_all = $list_obj->getlist($mod,'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $where,$start, $perpage,$orderby, '', 1);
                $recordnum_where = $list_obj->recordnum;
                $recordnum = $recordnum_con + $recordnum_where;
            }else{
                $modlist = $list_obj->getlist($mod,'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $where,$start, $perpage,$orderby, '', 1);
                $recordnum = $list_obj->recordnum;
            }
        }
    
}else{
    $modlist = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&let={$let}&nat={$nat}&cp={$cp}&order={$order}");


if ($page > 1) {
    $page_str = "-第{$page}页";
}

if ($title) {
    $pageTitle = "{$ordertitle}{$title}{$page_str}-{$_G['setting']['bbname']}";
    $metakeywords = "{$title}排行榜排名";
    $metadescription = "2016年最权威最新{$title}，根据数十万真实用户长期使用后点评打分而出，{$title}为用户选择户外品牌提供最真实参考";
} elseif ($ordertitle) {
    $pageTitle = "{$ordertitle}户外品牌排行榜{$page_str}-{$_G['setting']['bbname']}";
    $metakeywords = "户外品牌排名,户外用品品牌排名,户外装备品牌排名,户外运动品牌排名";
    $metadescription = "户外品牌查询、点评、排行榜";
} else {
    $pageTitle = "户外品牌排行榜{$page_str}-{$_G['setting']['bbname']}";
    $metakeywords = "户外品牌排名,户外用品品牌排名,户外装备品牌排名,户外运动品牌排名";
    $metadescription = "户外品牌查询、点评、排行榜";
}

//获取招商品牌信息
$zhaolist = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', 'i.zhaoshang = 1', 0, 7, 'i.dateline asc');

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');

include template('dianping/brand_showlist');
?>
