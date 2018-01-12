<?php
/**
 *	山峰列表处理
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
//分类配置
$cate_dq = $dp_category['mountain']['dq'];
$cate_gd = $dp_category['mountain']['gd'];

$dqnum = $_G['gp_dq'] ? intval($_G['gp_dq']) : 0;
$gdnum = $_G['gp_gd'] ? intval($_G['gp_gd']) : 0;

//处理列表数据
$perpage = 20;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page-1)*$perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = 'i.cnum desc';
		$ordertitle="最热门的";
		break;
//	case 'score':
//		$orderby = 'i.score desc';
//		$ordertitle="口碑最好的";
//		break;
	case 'dateline':
		$orderby = 'i.id desc';
		$ordertitle="最新的";
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

//列表数据
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();
if($order == "score"){
    $orderby = 'score desc';
    $ordertitle='口碑最好的';
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

//SEO信息处理
$seo_str = '';
if($dqnum) { $seo_str .= $cate_dq[$dqnum].'地区'; }
if($gdnum) { $seo_str .= '海拔'.$cate_gd[$gdnum]; }
if($page > 1) { $page_str = " - 第{$page}页"; }

if($seo_str)
{
	$pageTitle = "{$ordertitle}{$seo_str}雪山资料查询和用户攀登经验分享{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "{$seo_str}雪山资料查询,用户攀登经验分享";
	$metadescription = "{$seo_str}雪山资料查询和用户攀登经验分享，为登山爱好者攀登西藏地区海拔5000-6000米的雪山提供帮助";
}elseif ($ordertitle){
	$pageTitle = "{$ordertitle}山峰资料,雪山资料,山峰查询 - 山伍成群{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "山峰资料,雪山资料,山峰查询 - 山伍成群 - 户外资料网";
	$metadescription = "雪山资料查询和用户攀登经验分享，为登山爱好者攀登雪山提供帮助";
}else{
	$pageTitle = "山峰资料,雪山资料,山峰查询 - 山伍成群{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "山峰资料,雪山资料,山峰查询 - 山伍成群 - 户外资料网";
	$metadescription = "雪山资料查询和用户攀登经验分享，为登山爱好者攀登雪山提供帮助";
}

//边栏
$_G['cache']['dp_mountain_comment_rate'] ? $comment_rate = $_G['cache']['dp_mountain_comment_rate'] : updatecache('dp_mountain_comment_rate');

//此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用
require_once libfile('dianping/outputjson', 'include');

include template('dianping/mountain_showlist');
?>
