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
$cate_type = $dp_category['line']['type'];
$cate_timetype = $dp_category['line']['timetype'];

$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
$timetype = !empty($_G['gp_timetype']) ? intval($_G['gp_timetype']) : 0;
$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

//�����б�����
$perpage = 20;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';
$pageTitle_tmp='';
switch ($order) {
    case 'heats':
        $orderby = 'cnum desc';
        $pageTitle_tmp.='�����ŵ�';
        break;
//    case 'score':
//        $orderby = 'score desc';
//        $pageTitle_tmp.='�ڱ���õ�';
//        break;
    case 'dateline':
        $orderby = 'id desc';
        $pageTitle_tmp.='���µ�';
        break;
    default:
        $orderby = 'lastpost desc';
        break;
}

//��ѯ�б�ҳ��·�����ʡ���������й�����ʾ
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

//������·��·�����ĵ����
$_G['cache']['dp_line_region'] ? $lineregion = $_G['cache']['dp_line_region'] : updatecache('dp_line_region');
$onlycity = $lineregion['onlycity'];
$onlypro = $lineregion['onlypro'];
$_G['cache']['dp_country_region'] ? $regionList = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
$regionList["999999"] = array("cityname" => "����", "shengid" => 0, "shiid" => 0, "citycode" => "999999");

//��������������ȡ��·�б�
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

/*�б�ҳ����ѡ��󣬶�չʾ����·��ȡ��·�����ĵ���*/

if($order == "score"){
    $orderby = 'score desc';
    $pageTitle_tmp='�ڱ���õ�';
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
//�б�ҳ��ҳ����

$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&type={$type}&timetype={$timetype}&provinceid={$provinceid}&cityid={$cityid}");
/*start----�����ȡ��ʡ�к�������������,���������������title������Ҫ*/
if ($provinceid == 0 && $type == 0 && $timetype == 0) {
    $status = 0;
} else {
    //ʡ�б��������ʱ�ַ�����ʡ�м�Ǳˮ���ͱ��������ʱ�ַ���
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

/*end----�����ȡ��ʡ�к�������������,���������������title������Ҫ*/

/*start----lang��,����pagetitleͳһ����*/
$pageTitle = $pageTitle_tmp.strtr(lang('dianping', $_G['gp_mod'] . $status . '_pageTitle'),
    array(
        '[pro_city]' => $pro_city,
        '[pro_city_type]' => $pro_city_type,
        '[page]'=> $page>1 ? '��'.$page.'ҳ -' : ''
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
/*end----����lang��,����pagetitleͳһ����*/

//���ʵ���
$_G['cache']['dp_line_comment_rate'] ? $comment_rate = $_G['cache']['dp_line_comment_rate'] : updatecache('dp_line_comment_rate');

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/line_showlist');