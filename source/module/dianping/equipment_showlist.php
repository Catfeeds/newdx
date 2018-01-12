<?php
/**
 *	װ���б���
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
//��������
$category = $dp_category['equipment']['category'];

$pcid = $_G['gp_pcid'] ? intval($_G['gp_pcid']) : 0;
$cid = $_G['gp_cid'] ? intval($_G['gp_cid']) : 0;
$min = $_G['gp_min'] ? intval($_G['gp_min']) : 0;
$max = $_G['gp_max'] ? intval($_G['gp_max']) : 0;
$bid = $_G['gp_bid'] ? ($_G['gp_bid'] == 'other' ? '-1' : intval($_G['gp_bid'])) : 0;

//���м����
$navarr = array();
if($pcid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid=0&bid=0&page=1",'title'=>$category[$pcid]['name'])); }
if($pcid && $cid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid={$cid}&bid=0&page=1",'title'=>$category[$pcid]['child'][$cid])); }
$subnav = make_nav($navarr);

//�����б�����
$perpage = 80;
$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
$start = ($page-1)*$perpage;
$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

switch ($order) {
	case 'heats':
		$orderby = 'i.cnum DESC';
		break;
//	case 'score':
//		$orderby = 'i.score desc';
//                $condition = 'i.cnum >=10 and ';
//		break;
	case 'newest':
		$orderby = '';
		break;
	default:
		$orderby = 'i.lastpost DESC';
		break;
}
$condition = 'i.ispublish=1';
if($_G['gp_searchtext']){
	$condition_select_brand = $condition.' GROUP BY brandid';   
	
	$searchtext=diconv($_G['gp_searchtext'], "UTF-8","GBK");
	$searchtexts=dhtmlspecialchars($searchtext);
	$searchtexts=preg_replace ("/\s(?=\s)/","\\1", $searchtexts );
	$sflag='dp_eq_search_'.substr(md5($searchtexts.$order),0,8);
	$search=explode(" ",trim($searchtexts));
	$search=array_slice($search,0,3);
	foreach ($search as $k=>$s){
		$condition .=" AND i.subject LIKE '%".$s."%'";
	}
	if($searchtexts){
		DB::query("UPDATE ".DB::table('plugin_search_logs')." SET snum=snum+1 WHERE scontent='".$searchtexts."'");
		if(DB::affected_rows()==0){
			DB::query("INSERT INTO ".DB::table('plugin_search_logs')." (scontent,snum) VALUES ('".$searchtexts."',1)");
		}
	}
}else{
	$condition .= $cid ? ' AND i.cid='.$cid : ($pcid ? ' AND i.pcid='.$pcid : '');
	$condition_select_brand = $condition.' GROUP BY brandid';
	$condition .= $min ? ' AND i.price>='.$min : '';
	$condition .= $max ? ' AND i.price<='.$max : '';
	$condition .= $bid ? ' AND i.brandid='.$bid : '';
}
//�б�����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

//����������ʾ����5���˵ģ�������������
if($searchtexts && memory('get', $sflag."_".$page)){
	$modlist=memory('get', $sflag."_".$page);
	$recordnum=memory('get','dp_'.$mod.'_recordnum_'.substr(md5($condition), 0, 5));
}else{
	if($order == "score"){
	    $orderby = 'i.score DESC';
	    $condition .= ' AND i.cnum >=5';
	    
	    $where = 'i.ispublish=1';
	    if($searchtexts){
	    	foreach ($search as $k=>$s){
	    		$where .= " AND i.subject LIKE '%".$s."%'";
	    	}
	    }else{
		    $where .= $cid ? ' AND i.cid='.$cid : ($pcid ? ' AND i.pcid='.$pcid : '');
		    //$condition_select_brand = $where.' GROUP BY brandid';
		    $where .= $min ? ' AND i.price>='.$min : '';
		    $where .= $max ? ' AND i.price<='.$max : '';
		    $where .= $bid ? ' AND i.brandid='.$bid : '';
	    }
	    $where .= ' AND i.cnum < 5';
	    $modlist_con = $list_obj->getlist($mod, 'i.brandname,i.kaid, i.views', $condition,$start, $perpage,$orderby, '', 1);      
	    $recordnum_con = $list_obj->recordnum;
	    $con_page = ceil($recordnum_con/$perpage);
	    $offset   = $recordnum_con % $perpage;
	    $offset_con = $perpage - $offset;
	    if ($page <= $con_page ) {
	        if ($page == $con_page && $offset > 0) {            
	            $modlist_where = $list_obj->getlist($mod, 'i.brandname, i.kaid, i.views', $where,0, $offset_con,$orderby, '', 1);
	            $modlist = array_merge($modlist_con,$modlist_where);
	        } else {
	            $modlist = $modlist_con;
	        }
	        
	    } else {
	        $start_where = ($page-$con_page)*$perpage + $offset_con;
	        $modlist_where = $list_obj->getlist($mod, 'i.brandname, i.kaid, i.views', $where,$start_where, $perpage,$orderby, '', 1);
	        $modlist = $modlist_where;
	    }
	    $modlist_where_all = $list_obj->getlist($mod, 'i.brandname,i.kaid, i.views', $where,$start, $perpage,$orderby, '', 1);
	    $recordnum_where = $list_obj->recordnum;
	    
	    $recordnum = $recordnum_con + $recordnum_where;
	}else{
	    $modlist = $list_obj->getlist($mod, 'i.brandname, i.kaid, i.views', $condition, $start, $perpage, $orderby, '', 1);
	    $recordnum = $list_obj->recordnum;
	    
	}
	if($searchtexts){
		memory("set", $sflag."_".$page,$modlist,3600);
	}
}
$theurl = "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&pcid={$pcid}&cid={$cid}&bid={$bid}&min={$min}&max={$max}";
if($searchtexts!=""){
	$theurl .= "&page=$page?searchtext=".urlencode(iconv("GBK", "UTF-8", $searchtexts));
}
$multipage = multi($recordnum, $perpage, $page, $theurl);
//ȡ���������������ݣ���������ɸѡ�б�
$eq = memory('get','dp_equipment_brand_select_'.substr(md5($condition_select_brand), 0, 5));
if(!$eq) {
	$query = DB::query("SELECT brandid FROM ".DB::table('dianping_equipment_info')." AS i WHERE $condition_select_brand ORDER BY id ASC ".getSlaveID());
	while ($row = DB::fetch($query)) {
		$eq[$row['brandid']] = $row['brandid'];
	}
	memory('set','dp_equipment_brand_select_'.substr(md5($condition_select_brand), 0, 5), $eq, 3600);
}

//Ʒ���б���
$_G['cache']['dp_equipment_brandlist'] ? $brandlist = $_G['cache']['dp_equipment_brandlist'] : updatecache('dp_equipment_brandlist');
$dp_category['brand']['letter']['-1'] = '����Ʒ��';

$show_all_brand = array_intersect_key($brandlist, $eq);
foreach ($show_all_brand as $key => $value) {
	$letterlist[$value['letter']] = $dp_category['brand']['letter'][$value['letter']];
}
ksort($letterlist);

if(count($show_all_brand) > 20)
{
	$show_brand = array_slice($show_all_brand, 0, 5);
}
//SEO��Ϣ����
$seo_str = $seo_str2 = '';
switch ($order) {
	case 'heats':
		$seo_str = '�����ŵ�';
		break;
	case 'score':
		$seo_str = '�ڱ���õ�';
		break;
	case 'newest':
		$seo_str = '���µ�';
		break;
	default:
		break;
}
if($bid) { $seo_str .= $brandlist[$bid]['subject']; }
if($max && !$min) { $seo_str .= $max.'Ԫ����'; }
if($min && !$max) { $seo_str .= $min.'Ԫ����'; }
if($min && $max) { $seo_str .= "{$min}~{$max}Ԫ"; }
if($pcid && !$cid) { $seo_str2 .= $category[$pcid]['name']; }
if($pcid && $cid) { $seo_str2 .= $category[$pcid]['child'][$cid]; }
if($page > 1) { $page_str = " - ��{$page}ҳ"; }

if($seo_str || $seo_str2)
{
	if (!$seo_str2){
		$seo_str2="װ��";
	}
	$pageTitle = "{$seo_str}����{$seo_str2}�ĸ���|Ʒ���Ƽ�{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "{$seo_str}{$seo_str2}�ĸ��ã�ʮ��{$seo_str}{$seo_str2}���а�";
	$metadescription = "2016������{$seo_str}{$seo_str2}�Ƽ�չʾ����,{$seo_str}{$seo_str2}���а��ȫ,����{$seo_str}{$seo_str2}�۸񡢹���������Ƭ�Լ��û���ʵʹ�õ���ʹ���ĵã�Ϊ¿�ѹ���{$seo_str}{$seo_str2}�ṩ��׼ȷ�Ĳο���Ϣ";
}
else
{
	$pageTitle = "����װ����ȫ��װ����Ʒ�Ƽ�������������Ʒʹ���ĵ�{$page_str} - {$_G['setting']['bbname']}";
	$metakeywords = "������Ʒ���ȫ , ������Ʒ���ĸ���,ʮ������Ʒ�����а�";
	$metadescription = "����������װ����㼯���໧��װ������¿�ѽ�������װ������ʹ���ĵã���������������ǰ�ص�װ��";
}

//�˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע������
require_once libfile('dianping/outputjson', 'include');
include template('dianping/equipment_showlist');
?>
