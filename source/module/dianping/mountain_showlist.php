<?php
/**
 *	ɽ���б���
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
//��������
$cate_dq = $dp_category['mountain']['dq'];
$cate_gd = $dp_category['mountain']['gd'];

$dqnum = $_G['gp_dq'] ? intval($_G['gp_dq']) : 0;
$gdnum = $_G['gp_gd'] ? intval($_G['gp_gd']) : 0;

//�����б�����
$perpage = 20;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page-1)*$perpage;
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
$condition .= $dqnum ? ' AND i.type='.$dqnum : '';
$condition .= $gdnum ? ' AND i.altitude='.$gdnum : '';
$where = 'i.ispublish=1';
$where .= $dqnum ? ' AND i.type='.$dqnum : '';
$where .= $gdnum ? ' AND i.altitude='.$gdnum : '';

//�б�����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();
if($order == "score"){
    $orderby = 'score desc';
    $ordertitle='�ڱ���õ�';
    $condition .= ' and cnum >=5';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod,'i.type, i.height, i.region, i.season', $condition,$start, $perpage,$orderby, '', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod,'i.type, i.height, i.region, i.season', $where,0, $offset_con,$orderby, '', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod,'i.type, i.height, i.region, i.season', $where,$start_where, $perpage,$orderby, '', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'i.type, i.height, i.region, i.season', $where,$start, $perpage,$orderby, '', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'i.type, i.height, i.region, i.season', $where,$start, $perpage,$orderby, '', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 'i.type, i.height, i.region, i.season', $condition, $start, $perpage, $orderby, '', 1);
    $recordnum = $list_obj->recordnum;
    
}

$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&dq={$dqnum}&gd={$gdnum}");

//SEO��Ϣ����
$seo_str = '';
if($dqnum) { $seo_str .= $cate_dq[$dqnum].'����'; }
if($gdnum) { $seo_str .= '����'.$cate_gd[$gdnum]; }
if($page > 1) { $page_str = " - ��{$page}ҳ"; }

if($seo_str)
{
	$pageTitle = "{$ordertitle}{$seo_str}ѩɽ���ϲ�ѯ���û��ʵǾ������{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "{$seo_str}ѩɽ���ϲ�ѯ,�û��ʵǾ������";
	$metadescription = "{$seo_str}ѩɽ���ϲ�ѯ���û��ʵǾ������Ϊ��ɽ�������ʵ����ص�������5000-6000�׵�ѩɽ�ṩ����";
}elseif ($ordertitle){
	$pageTitle = "{$ordertitle}ɽ������,ѩɽ����,ɽ���ѯ - ɽ���Ⱥ{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "ɽ������,ѩɽ����,ɽ���ѯ - ɽ���Ⱥ - ����������";
	$metadescription = "ѩɽ���ϲ�ѯ���û��ʵǾ������Ϊ��ɽ�������ʵ�ѩɽ�ṩ����";
}else{
	$pageTitle = "ɽ������,ѩɽ����,ɽ���ѯ - ɽ���Ⱥ{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "ɽ������,ѩɽ����,ɽ���ѯ - ɽ���Ⱥ - ����������";
	$metadescription = "ѩɽ���ϲ�ѯ���û��ʵǾ������Ϊ��ɽ�������ʵ�ѩɽ�ṩ����";
}

//����
$_G['cache']['dp_mountain_comment_rate'] ? $comment_rate = $_G['cache']['dp_mountain_comment_rate'] : updatecache('dp_mountain_comment_rate');

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/mountain_showlist');
?>
