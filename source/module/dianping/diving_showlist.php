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
$cate_type = $dp_category['diving']['type'];

$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
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
$where =  'ispublish = 1';
if($type){
    $condition .= " and  FIND_IN_SET('{$type}',type)";
    $where .= " and  FIND_IN_SET('{$type}',type)";
}
if($cityid){
    $condition .= " and  cityid = {$cityid}";
    $where .= " and  cityid = {$cityid}";
}
if($provinceid){
    $condition .= " and  provinceid = {$provinceid}";
    $where .= " and  provinceid = {$provinceid}";
}


if($order == "score"){
    $orderby = 'score desc';
    $pageTitle_tmp='�ڱ���õ�';
    $condition .= ' and cnum >=5';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum', $condition,$start, $perpage,$orderby, '', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum', $where,0, $offset_con,$orderby, '', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum', $where,$start_where, $perpage,$orderby, '', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum', $where,$start, $perpage,$orderby, '', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'type,cityid,provinceid,addr,cnum', $where,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}

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

$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&type={$type}&provinceid={$provinceid}&cityid={$cityid}");

/*start----�����ȡ��ʡ�к�Ǳˮ����,���������������title������Ҫ*/
if ($provinceid == 0 && $type == 0) {
    $status = 0;
} else {
    //ʡ�б��������ʱ�ַ�����ʡ�м�Ǳˮ���ͱ��������ʱ�ַ���
    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
    $pro_city_type = $pro_city . $cate_type[$type];
    if (($provinceid || $cityid) && $type == 0) {
        $status = 1;
    }else{
        $status = 2;
    }
}
/*end----�����ȡ��ʡ�к�Ǳˮ����,���������������title������Ҫ*/

/*start----lang��,����pagetitleͳһ����*/
$pageTitle = $pageTitle_tmp.strtr(lang('dianping', $_G['gp_mod'] . $status . '_pageTitle'),
    array(
        '[pro_city]'=>$pro_city,
        '[pro_city_type]'=>$pro_city_type,
        '[page]'=> $page>1 ? '��'.$page.'ҳ -' : ''
    )
);
$metakeywords = strtr(lang('dianping', $_G['gp_mod'] . $status . '_metakeywords'),
    array(
        '[pro_city]'=>$pro_city,
        '[pro_city_type]'=>$pro_city_type
    )
);
$metadescription = strtr(lang('dianping', $_G['gp_mod'] . $status . '_metadescription'),
    array(
        '[pro_city]'=>$pro_city,
        '[pro_city_type]'=>$pro_city_type
    )
);
unset($pro_city);unset($pro_city_type);
/*end----����lang��,����pagetitleͳһ����*/

//���ʵ���
$_G['cache']['dp_diving_comment_rate'] ? $comment_rate = $_G['cache']['dp_diving_comment_rate'] : updatecache('dp_diving_comment_rate');

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/diving_showlist');