<?php
/**
 *	Ʒ���б�
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
//��������
$cate_letter = $dp_category['brand']['letter'];
$cate_region = $dp_category['brand']['region'];
$cate_ranklist = $dp_category['brand']['ranklist'];

$pid = $_G['gp_pid'] ? intval($_G['gp_pid']) : 0;
$rid = $_G['gp_rid'] ? intval($_G['gp_rid']) : 0;
$sid = $_G['gp_sid'] ? intval($_G['gp_sid']) : 0;
$cid = $_G['gp_cid'] ? intval($_G['gp_cid']) : 0;
$bid = $_G['gp_bid'] ? intval($_G['gp_bid']) : 0;

//���м����
$navarr = array();
if($pcid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid=0&bid=0&page=1",'title'=>$category[$pcid]['name'])); }
if($pcid && $cid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid={$cid}&bid=0&page=1",'title'=>$category[$pcid]['child'][$cid])); }
$subnav = make_nav($navarr);

//�����б�����
$perpage = 35;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page-1)*$perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'lastpost','dateline')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = ' i.cnum desc ';
		$ordertitle="�����ŵ�";
		break;
//	case 'score':
//		$orderby = ' i.score desc ';
//		$ordertitle="�ڱ���õ�";
//		break;
	case 'dateline':
		$orderby = ' i.dateline desc ';
		$ordertitle="���µ�";
		break;
	default:
		$orderby = ' i.lastpost desc ';
		break;
}
//�б�����
require_once libfile('dianping/modlist_shop', 'class');
$list_obj = new modlist_shop();
$condition =" i.ispublish=1 ";
$where =" i.ispublish=1 ";
if($pid){
	$condition .= " AND i.provinceid = {$pid}";
        $where .= " AND i.provinceid = {$pid}";
}
if($rid){
	$condition .= " AND i.regionid = {$rid}";
        $where .= " AND i.regionid = {$rid}";
}
if($sid){
	if($sid==2){
		$condition .= "  AND i.marketid >= 1";
                $where .= "  AND i.marketid >= 1";
	}elseif($sid==1){
		$condition .= "  AND i.marketid = 0";
                $where .= "  AND i.marketid = 0";
	}elseif($sid!=''){
		$condition .= " AND i.marketid = {$sid}";
                $where .= " AND i.marketid = {$sid}";
	}
}
if($cid){
	$condition .= " AND i.cbrandid = {$cid}";
        $where .= " AND i.cbrandid = {$cid}";
}
if($bid){
	$condition .= " AND i.sbrandid= {$bid}";
        $where .= " AND i.sbrandid= {$bid}";
}


if($order == "score"){
    $orderby = 'i.score desc';
    $ordertitle='�ڱ���õ�';
    $condition .= ' and cnum >=5';
    $where .= ' and cnum < 5';
    $modlist_con = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $condition,$start, $perpage,$orderby,'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);      
    $recordnum_con = $list_obj->recordnum;
    if($modlist_con){
        $con_page = ceil($recordnum_con/$perpage);
        $offset   = $recordnum_con % $perpage;
        $offset_con = $perpage - $offset;
        if ($page <= $con_page ) {
            if ($page == $con_page && $offset > 0) {            
                $modlist_where = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,0, $offset_con,$orderby,'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
                $modlist = array_merge($modlist_con,$modlist_where);
            } else {
                $modlist = $modlist_con;
            }

        } else {
            $start_where = ($page-$con_page)*$perpage + $offset_con;
            $modlist_where = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,$start_where, $perpage,$orderby, 'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
            $modlist = $modlist_where;
        }
        $modlist_where_all = $list_obj->getlist($mod,'t.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,$start, $perpage,$orderby, 'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
        $recordnum_where = $list_obj->recordnum;
        $recordnum = $recordnum_con + $recordnum_where;
    }else{
        $modlist = $list_obj->getlist($mod,'t.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $where,$start, $perpage,$orderby, 'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
        $recordnum = $list_obj->recordnum;
    }
    
    
    
}else{
    $modlist = $list_obj->getlist($mod, 't.views,i.addr,i.provinceid,i.cbrandid,i.sbrandid,i.regionid,marketid', $condition, $start, $perpage, $orderby,'LEFT JOIN '.DB::table('forum_thread').' AS t ON t.tid=i.tid', 1);
    $recordnum = $list_obj->recordnum;
    
}
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&pid={$pid}&rid={$rid}&sid={$sid}&cid={$cid}&bid={$bid}&order={$order}");

//��ȡ�����̳�Ʒ������
$_G['cache']['dp_shop_region'] ? $arr_region = $_G['cache']['dp_shop_region'] : updatecache('dp_shop_region');


//��ȡ���µ���
$shop_new = $list_obj->getlist($mod, 'i.dateline', 'i.ispublish=1', 0, 10, ' i.dateline DESC ');

//��ȡ�����е�Ʒ�ƺ��̳�
$brand_market=$list_obj->getBrandMarket($pid,$rid,$arr_region);

//��ȡ���۴�����Ϣ
$sql =DB::query('SELECT tid,subject FROM  '.DB::table('forum_thread').' where fid = 174 and displayorder=0 order by dateline DESC limit 0,10');
while ($array = DB::fetch($sql)){
	$arrDzcx[]=$array;
}

//ҳ��seo����
$pname=$pid?$arr_region[$pid]['name']:'';
$rname=$rid?$arr_region[$pid]['city'][$rid]['cityname']:'';
$bname=$bid?$brand_market['brand_array'][$bid]:'';
$cname=$cid?$brand_market['brand_array'][$cid]:'';
if($sid>=2){
	$sname='(�̳���)';
}elseif($sid==1){
	$sname='(�ֱߵ�)';
}
$title = $pname.$rname.$bname.$cname;
if($page > 1) { $page_str = " - ��{$page}ҳ"; }
if ($title) {
	$pageTitle = $metakeywords = "{$ordertitle}{$title}����������Ʒ|����װ��ר����{$sname}{$page_str} - {$_G['setting']['bbname']}";
	$metadescription = strtr('2016��[province][city][bname]��Ʒ���ѯ���ڱ���������Ϣ��ʵ�ɿ�����¿�ѹ���װ������Ҫ�ο�', array(
					'[province]' => $pname,
					'[city]' =>$rname,
					'[bname]' => $bname ? $bname : '����',
					'[shop]' => $sid ? ($sid == 1 ? '�ֱߵ�' : '�̳���') : ''
		));
}elseif ($ordertitle){
	$pageTitle = $metakeywords = "{$ordertitle}������Ʒ��,������ƷרӪ��,������Ʒר����,������Ʒ�� {$page_str} - {$_G['setting']['bbname']}";
	$metadescription ="2016�껧����Ʒ���ѯ���ڱ���������Ϣ��ʵ�ɿ�����¿�ѹ���װ������Ҫ�ο�";
}else {
	$pageTitle = $metakeywords = "������Ʒ��,������ƷרӪ��,������Ʒר����,������Ʒ��{$page_str} - {$_G['setting']['bbname']}";
	$metadescription ="2016�껧����Ʒ���ѯ���ڱ���������Ϣ��ʵ�ɿ�����¿�ѹ���װ������Ҫ�ο�";
}

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');

include template('dianping/'.$mod.'_showlist');

?>
