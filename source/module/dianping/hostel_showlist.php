<?php
/**
 * Created by PhpStorm.
 * User: lgt
 * Date: 14-11-14
 * Time: 上午10:11
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
//分类配置
$cate_type = $dp_category['hostel']['type'];
$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
//处理列表数据
$perpage = 20;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
    case 'heats':
        $orderby = 'cnum desc';
        $pageTitle_tmp='最热门的';
        break;
//    case 'score':
//        $orderby = 'score desc';
//        $pageTitle_tmp='口碑最好的';
//        break;
    case 'dateline':
        $orderby = 'id desc';
        $pageTitle_tmp='最新的';
        break;
    default:
        $orderby = 'lastpost desc';
        break;
}
//列表数据
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();
$condition = 'ispublish = 1';
$where = 'ispublish = 1';
if ($cityid) {
    $condition .= " and  cityid = {$cityid}";
    $where .= " and  cityid = {$cityid}";
}
if ($provinceid) {
    $condition .= " and  provinceid = {$provinceid}";
    $where .= " and  provinceid = {$provinceid}";
}


if($order == "score"){
    $orderby = 'score desc';
    $pageTitle_tmp='口碑最好的';
    $condition .= ' and cnum >=5';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod, 'cityid,provinceid,addr,cnum,tel', $condition,$start, $perpage,$orderby, '', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod, 'cityid,provinceid,addr,cnum,tel', $where,0, $offset_con,$orderby, '', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod, 'cityid,provinceid,addr,cnum,tel', $where,$start_where, $perpage,$orderby, '', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'cityid,provinceid,addr,cnum,tel', $where,$start, $perpage,$orderby, '', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'cityid,provinceid,addr,cnum,tel', $where,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 'cityid,provinceid,addr,cnum,tel', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}


$myuid = $_G['uid'];
$condition_if = "ispublish>=0 and author_id={$myuid}";
$modlistcount = $list_obj->getlist($mod, 'cityid,provinceid,addr,cnum,tel', $condition_if, $start, $perpage, $orderby, '', 1);
$listcount = count($modlistcount);
$modlistall = $list_obj->getlist($mod, 'cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);
/*start----为省市（涵盖国内外所有）获取及对省市进行过滤,info表存在才将其显示出来***************************/
$allcodeList = array();
foreach ($modlistall as $key => $val) {
    $allcodeList[$val['provinceid']] = 1;
    $allcodeList[$val['cityid']] = 1;
}
$_G['cache']['dp_country_region'] ? $countries = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
foreach ($countries as $rk => $rv) {
    if (!$allcodeList[$rk]) {
        unset($countries[$rk]);
        continue;
    }
    if ($rv['shengid']) {
        if ($allcodeList[$rv['codeid']]) {
            $cityList[$rv['shengid']][$rk] = $rv;
        }
    } else {
        $proList[$rk] = $rv;
    }
}
/*end----为省市（涵盖国内外所有）获取及对省市进行过滤,info表中存在才将其显示出来***************************/
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&provinceid={$provinceid}&cityid={$cityid}");

/*start----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/
if ($provinceid == 0 && $gongsitype == 0) {
    $status = 0;
}
elseif($gongsitype && !$provinceid){
    $typename = $cate_type[$gongsitype];
    $status = 1;
}
elseif(!$gongsitype && $provinceid ){
    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
    $status = 2;
}elseif($gongsitype || $provinceid ){
    $typename = $cate_type[$gongsitype];
    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
    $pro_city_ctype = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'] . $cate_type[$gongsitype] ;
    $status = 3;
}
/*end----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/

/*start----lang包,进行pagetitle统一处理*/
$pageTitle = $pageTitle_tmp.strtr(lang('dianping', $_G['gp_mod'] . $status . '_pageTitle'),
    array(
        '[pro_city]' => $pro_city,
        '[typename]' => $typename,
        '[pro_city_ctype]' => $pro_city_ctype,
        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
    )
);
$metakeywords = strtr(lang('dianping', $_G['gp_mod'] . $status . '_metakeywords'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_ctype]' => $pro_city_ctype,
        '[typename]' => $typename
    )
);
$metadescription = strtr(lang('dianping', $_G['gp_mod'] . $status . '_metadescription'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_ctype]' => $pro_city_ctype,
        '[typename]' => $typename
    )
);
unset($pro_city);
unset($pro_city_ctype);
/*end----测试lang包,进行pagetitle统一处理*/
//删除缓存
//memory('rm', 'dp_hostel_comment_rate');
//精彩点评
$_G['cache']['dp_hostel_comment_rate'] ? $comment_rate = $_G['cache']['dp_hostel_comment_rate'] : updatecache('dp_hostel_comment_rate');

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');

include template('dianping/hostel_showlist');