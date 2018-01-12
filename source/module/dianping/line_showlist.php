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
$cate_type = $dp_category['line']['type'];
$cate_timetype = $dp_category['line']['timetype'];

$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
$timetype = !empty($_G['gp_timetype']) ? intval($_G['gp_timetype']) : 0;
$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

//处理列表数据
$perpage = 20;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';
$pageTitle_tmp='';
switch ($order) {
    case 'heats':
        $orderby = 'cnum desc';
        $pageTitle_tmp.='最热门的';
        break;
//    case 'score':
//        $orderby = 'score desc';
//        $pageTitle_tmp.='口碑最好的';
//        break;
    case 'dateline':
        $orderby = 'id desc';
        $pageTitle_tmp.='最新的';
        break;
    default:
        $orderby = 'lastpost desc';
        break;
}

//查询列表页线路标题对省市条件进行过滤显示
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();
$condition = 'ispublish = 1';
$where = 'ispublish = 1';
$wherecross = '';
if ($type) {
    $condition .= " and  type = {$type}";
    $where .= " and  type = {$type}";
    $wherecross .= " ltype = {$type}";
}
if ($timetype) {
    $condition .= " and  timetype = {$timetype}";
    $where .= " and  timetype = {$timetype}";
    $wherecross .= $wherecross ? " and  ltime = {$timetype}" : " ltime = {$timetype}";
}
if ($cityid) {
    $wherecross .= $wherecross ? " and  city = {$cityid}" : "city = {$cityid}";
}
if ($provinceid) {
    $wherecross .= $wherecross ? " and  province = {$provinceid}" : " province = {$provinceid}";
}

require_once libfile('dianping/zone', 'class');
$zone = new zone();

//缓存线路线路经过的地域表
$_G['cache']['dp_line_region'] ? $lineregion = $_G['cache']['dp_line_region'] : updatecache('dp_line_region');
$onlycity = $lineregion['onlycity'];
$onlypro = $lineregion['onlypro'];
$_G['cache']['dp_country_region'] ? $regionList = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
$regionList["999999"] = array("cityname" => "国外", "shengid" => 0, "shiid" => 0, "citycode" => "999999");

//根据条件参数获取线路列表
if ($wherecross) {
    $crosslist = $zone->getcrosslist($wherecross);
    foreach ($crosslist as $key => $val) {
        $tidlist[$val['tid']] = 1;
        $proList[$val['province']]++;
        $citylist[$val['province']][$val['city']]++;
    }
    $tids = implode(',', array_keys($tidlist));
    if ($tids) {
        $condition .= " and tid in ({$tids})";
        $where .= " and tid in ({$tids})";
    } else {
        $condition .= " and tid in (0)";
        $where .= " and tid in (0)";
    }
    foreach ($citylist as $k => $v) {
        arsort($citylist[$k]);
    }
    arsort($proList);
} else {
    $proList = ($lineregion['allpro']);
    arsort($proList);
}

/*列表页条件选择后，对展示的线路获取线路经过的地域*/

if($order == "score"){
    $orderby = 'score desc';
    $pageTitle_tmp='口碑最好的';
    $condition .= ' and cnum >=5';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod, 'type', $condition,$start, $perpage,$orderby, '', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod, 'type', $where,0, $offset_con,$orderby, '', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod, 'type', $where,$start_where, $perpage,$orderby, '', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'type', $where,$start, $perpage,$orderby, '', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'type', $where,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 'type', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}



foreach ($modlist as $k => $v) {
    $linecross = $zone->getlinecross($v['tid']);
    foreach ($linecross as $key => $val) {
        if ($key == 0) {
            $modlist[$k]['provincename'] = $regionList[$val['province']]['cityname'];
            $modlist[$k]['province'] = $val['province'];
        }
        $modlist[$k]['cityids'][$val['city']] = $val['province'];
    }
}
//列表页分页处理

$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&type={$type}&timetype={$timetype}&provinceid={$provinceid}&cityid={$cityid}");
/*start----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/
if ($provinceid == 0 && $type == 0 && $timetype == 0) {
    $status = 0;
} else {
    //省市变量组合临时字符串，省市及潜水类型变量组合临时字符串
    $pro_city = $regionList[$provinceid]['cityname'] . $onlycity[$cityid]['name'];
    $pro_city_type = $pro_city.$cate_timetype[$timetype].$cate_type[$type];
    if($type == 0 ) {
        $status = 3;
    }else if($type == 160){
        $status = 1;
    }else if($type == 164){
        $status = 2;
    }
}

/*end----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/

/*start----lang包,进行pagetitle统一处理*/
$pageTitle = $pageTitle_tmp.strtr(lang('dianping', $_G['gp_mod'] . $status . '_pageTitle'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_type]' => $pro_city_type,
        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
    )
);
$metakeywords = strtr(lang('dianping', $_G['gp_mod'] . $status . '_pagekeywords'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_type]' => $pro_city_type
    )
);
$metadescription = strtr(lang('dianping', $_G['gp_mod'] . $status .'_pagedescription'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_type]' => $pro_city_type
    )
);
unset($pro_city);
unset($pro_city_type);
/*end----测试lang包,进行pagetitle统一处理*/

//精彩点评
$_G['cache']['dp_line_comment_rate'] ? $comment_rate = $_G['cache']['dp_line_comment_rate'] : updatecache('dp_line_comment_rate');

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');

include template('dianping/line_showlist');