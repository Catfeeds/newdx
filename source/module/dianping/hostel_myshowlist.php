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
$myuid = $_G['uid'];
if($myuid){
    $cate_type = $dp_category['hostel']['type'];
    $cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
    $provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
    //处理列表数据
    $perpage = 20;
    $page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
    $start = ($page - 1) * $perpage;
    //列表数据
    require_once libfile('dianping/modlist', 'class');
    $list_obj = new modlist();
    if($_G['adminid'] ==1){
        $where = "ispublish>=0";
    }else{
        $where = "ispublish>=0 and author_id = {$myuid}";
    }
    
    $orderby = "id desc";
//    if($_G['uid'] == 0){
//        showmessage('您要查看的内容不存在或未审核，请返回'); 
//    }
    $modlist_my = $list_obj->getlist($mod, 'ispublish,cityid,provinceid,addr,cnum,tel', $where, $start, $perpage, $orderby, '', 1);
    $modlistall = $list_obj->getlist($mod, 'ispublish,cityid,provinceid,addr,cnum', 'ispublish>=0', $start, '', $orderby, '', 0);
    
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

    $recordnum = $list_obj->recordnum; //lgt
    $multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=myshowlist");
    /*start----lang包,进行pagetitle统一处理*/
    $pageTitle ="我发布的旅舍客栈-第{$page}页 - 户外资料网8264.com";
    $metakeywords ="旅舍客栈";
    $metadescription = "我发布的旅舍客栈";
    unset($pro_city);
    unset($pro_city_ctype);
    /*end----测试lang包,进行pagetitle统一处理*/
    //精彩点评
    $_G['cache']['dp_hostel_comment_rate'] ? $comment_rate = $_G['cache']['dp_hostel_comment_rate'] : updatecache('dp_hostel_comment_rate');
    include template('dianping/hostel_myshowlist');
}else{
    echo "<script>alert('你需要登陆后才能查看');window.location.href = 'http://www.8264.com/member.php?mod=logging&action=login';</script>";
}
