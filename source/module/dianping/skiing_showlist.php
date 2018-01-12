<?php
/**
 *	��ѩ���б�
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

ob_start();

$pro = $_G['gp_pro'] ? intval($_G['gp_pro']) : 0;

//���ص������໺��
$_G['cache']['dp_skiing_pro'] ? $region = $_G['cache']['dp_skiing_pro'] : updatecache('dp_skiing_pro');

//���м����
// $subnav = make_nav(array(array('url'=>"&order=lastpost&pro={$pro}&page=1",'title'=>$region[$pro]['name'].'��ѩ��')));

// �����б�����
$perpage = 18;
$page = max(intval($_G['gp_page']), 1);
$start = ($page - 1) * $perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = 'i.cnum desc';
		$ordertitle="�����ŵ�";
		break;
//	case 'score':
//		$orderby = 'i.score desc';
//		$ordertitle="�ڱ���õ�";
//		break;
	case 'dateline':
		$orderby = 'i.id desc';
		$ordertitle="���µ�";
		break;
	default:
		$orderby = 'i.lastpost desc';
		break;
}

$condition = 'i.ispublish=1';
$condition .= $pro ? ' AND i.provinceid='.$pro : '';

// �б�����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

if($order == "score"){
    $orderby = 'score desc';
    $ordertitle='�ڱ���õ�';
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

//SEO��Ϣ����
$seo_str = '';
if($pro) { $seo_str .= $region[$pro]['name']; }
if($page > 1) { $page_str = " - ��{$page}ҳ"; }

if($seo_str)
{
	$pageTitle = "{$ordertitle}{$seo_str}��ѩ���ĸ���|{$seo_str}��ѩ�����а�{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "{$seo_str}��ѩ����ѯ��ʮ��{$seo_str}��ѩ���ڱ����а�{$seo_str}��õĻ�ѩ�� - ����������";
	$metadescription = "2016������{$seo_str}��ѩ����Ϣ��ѯ��������ַ�۸�ѩ�����ĵȽ��ܣ�ʮ��{$seo_str}��ѩ���ڱ����а�{$seo_str}��õĻ�ѩ����Ϊ��ѩ�������ṩ׼ȷ����";
}elseif ($ordertitle){
	$pageTitle = "{$ordertitle}��ѩ���ĸ���|��ѩ�����а�{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "��ѩ����ѯ��ʮ��ѩ���ڱ����а���õĻ�ѩ�� - ����������";
	$metadescription = "2016�����»�ѩ����Ϣ��ѯ��������ַ�۸�ѩ�����ĵȽ��ܣ�ʮ��ѩ���ڱ����а���õĻ�ѩ����Ϊ��ѩ�������ṩ׼ȷ����";
}
else
{
	$pageTitle = "��ѩ���ĸ���|��ѩ�����а�{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "��ѩ����ѯ��ʮ��ѩ���ڱ����а���õĻ�ѩ�� - ����������";
	$metadescription = "2016�����»�ѩ����Ϣ��ѯ��������ַ�۸�ѩ�����ĵȽ��ܣ�ʮ��ѩ���ڱ����а���õĻ�ѩ����Ϊ��ѩ�������ṩ׼ȷ����";
}

//�����б�
$_G['cache']['dp_skiing_index_comment'] ? $commentlist = $_G['cache']['dp_skiing_index_comment'] : updatecache('dp_skiing_index_comment');

//����
$_G['cache']['dp_skiing_sidebar_hot'] ? $sidebar_hot = $_G['cache']['dp_skiing_sidebar_hot'] : updatecache('dp_skiing_sidebar_hot');
$_G['cache']['dp_skiing_sidebar_new'] ? $sidebar_new = $_G['cache']['dp_skiing_sidebar_new'] : updatecache('dp_skiing_sidebar_new');

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/skiing_showlist');
?>
