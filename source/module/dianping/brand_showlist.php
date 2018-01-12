<?php

/**
 * 	Ʒ���б�
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
//��������
$cate_letter = $dp_category['brand']['letter'];
$cate_region = $dp_category['brand']['region'];
$cate_ranklist = $dp_category['brand']['ranklist'];

$let = $_G['gp_let'] ? intval($_G['gp_let']) : 0;
$nat = $_G['gp_nat'] ? intval($_G['gp_nat']) : 0;
$cp = $_G['gp_cp'] ? intval($_G['gp_cp']) : 0;

//���м����
$navarr = array();
if ($cp) {
    array_push($navarr, array('url' => "&let=0&nat=0&cp={$cp}&order=lastpost&page=1", 'title' => $dp_category['brand']['ranklist'][$cp]));
}
$subnav = make_nav($navarr);
//�����б�����
$perpage = 35;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

$condition = " i.ispublish=1 ";
$where =  'ispublish = 1';
if (!empty($let)) {
    $condition .= " and i.letter = {$let}";
    $where .= " and i.letter = {$let}";
    $title = "����Ʒ�����а�(����ĸ{$dp_category['brand']['letter'][$let]})";
}
if (!empty($nat)) {
    $condition .= " and i.nation = {$nat}";
    $where .= " and i.nation = {$nat}";
    $title = "{$dp_category['brand']['region'][$nat]}����Ʒ�����а�";
}
if (!empty($cp)) {
    $condition .= " and FIND_IN_SET('$cp',i.ranklist) ";
    $where .= " and FIND_IN_SET('$cp',i.ranklist) ";
    $title = "{$dp_category['brand']['ranklist'][$cp]}";
}
if (!empty($let) && !empty($nat) && !empty($cp)) {

    $title = "{$dp_category['brand']['region'][$nat]}{$dp_category['brand']['ranklist'][$cp]}(����ĸ{$dp_category['brand']['letter'][$let]})";
} elseif (!empty($let) && !empty($nat)) {
    $title = "{$dp_category['brand']['region'][$nat]}����Ʒ�����а�(����ĸ{$dp_category['brand']['letter'][$let]})";
} elseif (!empty($nat) && !empty($cp)) {
    $title = "{$dp_category['brand']['ranklist'][$cp]}(����ĸ{$dp_category['brand']['letter'][$let]})";
} elseif (!empty($let) && !empty($cp)) {
    $title = "{$dp_category['brand']['region'][$nat]}{$dp_category['brand']['ranklist'][$cp]}";
}

switch ($order) {
    case 'heats':
        $orderby = 'i.cnum desc';
        $ordertitle = "�����ŵ�";
        break;
//    case 'score':
//        if (!$let && !$nat && !$cp) {
//            $where.= " and i.cnum >= 50 ";
//        }
//        $orderby = 'i.score desc,i.id desc';
//        $ordertitle = "�ڱ���õ�";
//        break;
    case 'dateline':
        $orderby = 'i.dateline desc';
        $ordertitle = "���µ�";
        break;
    default:
        $orderby = 'i.lastpost desc';
        break;
}

//�б�����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();
if($order == "score"){
    $orderby = 'i.score desc,i.id desc';
    $ordertitle = "�ڱ���õ�";
    
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
    $page_str = "-��{$page}ҳ";
}

if ($title) {
    $pageTitle = "{$ordertitle}{$title}{$page_str}-{$_G['setting']['bbname']}";
    $metakeywords = "{$title}���а�����";
    $metadescription = "2016����Ȩ������{$title}��������ʮ����ʵ�û�����ʹ�ú������ֶ�����{$title}Ϊ�û�ѡ����Ʒ���ṩ����ʵ�ο�";
} elseif ($ordertitle) {
    $pageTitle = "{$ordertitle}����Ʒ�����а�{$page_str}-{$_G['setting']['bbname']}";
    $metakeywords = "����Ʒ������,������ƷƷ������,����װ��Ʒ������,�����˶�Ʒ������";
    $metadescription = "����Ʒ�Ʋ�ѯ�����������а�";
} else {
    $pageTitle = "����Ʒ�����а�{$page_str}-{$_G['setting']['bbname']}";
    $metakeywords = "����Ʒ������,������ƷƷ������,����װ��Ʒ������,�����˶�Ʒ������";
    $metadescription = "����Ʒ�Ʋ�ѯ�����������а�";
}

//��ȡ����Ʒ����Ϣ
$zhaolist = $list_obj->getlist($mod, 'i.letter,i.ranklist,i.city,i.cname,i.ename,i.views', 'i.zhaoshang = 1', 0, 7, 'i.dateline asc');

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/brand_showlist');
?>
