<?php
/**
 * Created by PhpStorm.
 * User: lgt
 * Date: 14-11-14
 * Time: ����10:11
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
//��������
$cate_type = $dp_category['climb']['type'];
$cate_placetype = $dp_category['climb']['placetype'];

$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
$placetype = !empty($_G['gp_placetype']) ? intval($_G['gp_placetype']) : 0;
$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

//�����б�����
$perpage = 20;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
    case 'heats':
        $orderby = 'cnum desc';
        $pageTitle_tmp='�����ŵ�';
        break;
//    case 'score':
//        $orderby = 'score desc';
//        $pageTitle_tmp='�ڱ���õ�';
//        break;
    case 'dateline':
        $orderby = 'id desc';
        $pageTitle_tmp='���µ�';
        break;
    default:
        $orderby = 'lastpost desc';
        break;
}
//�б�����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

$condition = 'ispublish = 1';
if ($type) {
    $condition .= " and  FIND_IN_SET('{$type}',type)";
}
if ($placetype) {
    $condition .= " and  placetype = {$placetype}";
}
if ($cityid) {
    $condition .= " and  cityid = {$cityid}";
}
if ($provinceid) {
    $condition .= " and  provinceid = {$provinceid}";
}

if($order == "score"){
    $orderby = 'score desc';
    $pageTitle_tmp='�ڱ���õ�';
    $condition .= ' and cnum >=5';
    
    $where =  'ispublish = 1';
    if ($type) {
        $where .= " and  FIND_IN_SET('{$type}',type)";
    }
    if ($placetype) {
        $where .= " and  placetype = {$placetype}";
    }
    if ($cityid) {
        $where .= " and  cityid = {$cityid}";
    }
    if ($provinceid) {
        $where .= " and  provinceid = {$provinceid}";
    }
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum,tel,placetype', $condition,$start, $perpage,$orderby, '', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum,tel,placetype', $where,0, $offset_con,$orderby, '', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum,tel,placetype', $where,$start_where, $perpage,$orderby, '', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum,tel,placetype', $where,$start, $perpage,$orderby, '', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum,tel,placetype', $where,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum,tel,placetype', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&type={$type}&placetype={$placetype}&provinceid={$provinceid}&cityid={$cityid}");
//$modlist = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum,tel,placetype', $condition, $start, $perpage, $orderby, '', 1);
$modlistall = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

/*start----Ϊʡ�У����ǹ��������У���ȡ����ʡ�н��й���,info����ڲŽ�����ʾ����***************************/
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

/*end----Ϊʡ�У����ǹ��������У���ȡ����ʡ�н��й���,info���д��ڲŽ�����ʾ����***************************/



/*start----�����ȡ��ʡ�к�������������,���������������title������Ҫ*/
if ($provinceid == 0 && $type == 0 && $placetype == 0) {
    $status = 0;
}
elseif($type && !$provinceid && !$placetype){
    $typename = $cate_type[$type];
    $status = 1;
}
elseif(!$type && !$provinceid && $placetype){
    $placetypename = $cate_placetype[$placetype];
    $status = 2;
}
elseif(!$type && $provinceid && !$placetype){
    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
    $status = 3;
}elseif($type || $provinceid || $placetype){
    $pro_city_ctype = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'] . $cate_type[$type] .$cate_placetype[$placetype];
    $status = 4;
}

/*end----�����ȡ��ʡ�к�������������,���������������title������Ҫ*/

/*start----lang��,����pagetitleͳһ����*/
$pageTitle = $pageTitle_tmp.strtr(lang('dianping', $_G['gp_mod'] . $status . '_pageTitle'),
    array(
        '[pro_city]' => $pro_city,
        '[typename]' => $typename,
        '[placetypename]' => $placetypename,
        '[pro_city_ctype]' => $pro_city_ctype,
        '[page]'=> $page>1 ? '��'.$page.'ҳ -' : ''
    )
);
$metakeywords = strtr(lang('dianping', $_G['gp_mod'] . $status . '_metakeywords'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_ctype]' => $pro_city_ctype
    )
);
$metadescription = strtr(lang('dianping', $_G['gp_mod'] . $status . '_metadescription'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_ctype]' => $pro_city_ctype
    )
);
unset($pro_city);
unset($pro_city_ctype);
/*end----����lang��,����pagetitleͳһ����*/

//���ʵ���
$_G['cache']['dp_climb_comment_rate'] ? $comment_rate = $_G['cache']['dp_climb_comment_rate'] : updatecache('dp_climb_comment_rate');

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/climb_showlist');