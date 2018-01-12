<?php
/**
 * @author LiJinYu
 * @copyright 2015
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class DianpingCtl extends FrontendCtl{
	
	function __construct()
	{
		parent::__construct();
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';	
	}

	function  indexlist(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
                require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		require_once libfile('dianping/modlist', 'class');
		$cate_region = $dp_category['brand']['region'];
		$list_obj = new modlist();
		$brandlist = $list_obj->getbrandindex();
		foreach($brandlist as $k=>$v){
			//$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,$v['dir'].'/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['showimg']= $v['showimg'] ? "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['showimg']}!wap" : "";
			$v['pic'] = $v['showimg'];
			$brandlist[$k] = $v;
		}
		$equipmentlist = $list_obj->getequipmentindex();
		foreach($equipmentlist as $k=>$v){

			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,$v['dir'].'/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$ename = $list_obj->getbrandename($v['brandid']);
			$v['ename'] = $ename;
			$equipmentlist[$k] = $v;
		}
		$cate_dq = $dp_category['mountain']['dq'];
		$mountainlist = $list_obj->getmountainindex();
		foreach($mountainlist as $k=>$v){

			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,$v['dir'].'/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$mountainlist[$k] = $v;
		}
                
		$cate_type = $dp_category['diving']['type'];
		$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
		$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
		$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
		$divinglist = $list_obj->getdivingindex();
                
		$allcodeList = array();
		foreach ($divinglist as $key => $val) {
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
		if ($provinceid == 0 && $type == 0) {
		    $status = 0;
		} else {
		  
		    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
		    $pro_city_type = $pro_city . $cate_type[$type];
		    if (($provinceid || $cityid) && $type == 0) {
		        $status = 1;
		    }else{
		        $status = 2;
		    }
		}
		foreach($divinglist as $k=>$v){

			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,$v['dir'].'/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$divinglist[$k] = $v;
		}
		//print_r($countries);
		$returnData['brandlist'] = $brandlist;
		$returnData['cityList'] = $cityList;
		$returnData['cate_dq'] = $cate_dq;
		$returnData['proList'] = $proList;
		$returnData['cate_type'] = $cate_type;
		$returnData['equipmentlist'] = $equipmentlist;
		$returnData['mountainlist'] = $mountainlist;
		$returnData['cate_region'] = $cate_region;
		$returnData['divinglist'] = $divinglist;
		encodeData($returnData);
	}
	function ajaxindex(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$lng = $_G['gp_lng'] ? intval($_G['gp_lng']) : '';
		$lat = $_G['gp_lat'] ? intval($_G['gp_lat']) : '';
		$climblist = $list_obj->getclimbindex($lat,$lng);
		$allcodeList = array();
		foreach ($climblist as $key => $val) {
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
		foreach($climblist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$climblist[$k] = $v;
		}
		$_G['cache']['dp_skiing_pro'] ? $region = $_G['cache']['dp_skiing_pro'] : updatecache('dp_skiing_pro');
		$skiinglist = $list_obj->getskiingindex($lat,$lng);
		foreach($skiinglist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$skiinglist[$k] = $v;
		}
		$returnData['skiinglist'] = $skiinglist;
		$returnData['region'] = $region;
		$returnData['climblist'] = $climblist;
		$returnData['cate_type'] = $cate_type;
		$returnData['cate_placetype'] = $cate_placetype;
		$returnData['proList'] = $proList;
		$returnData['cityList'] = $cityList;
		encodeData($returnData);

	}
	function equipmentlist()
	{
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		$category = $dp_category['equipment']['category'];
		$pcid = $_G['gp_pcid'] ? intval($_G['gp_pcid']) : 0;
		$cid = $_G['gp_cid'] ? intval($_G['gp_cid']) : 0;
		$min = $_G['gp_min'] ? intval($_G['gp_min']) : 0;
		$max = $_G['gp_max'] ? intval($_G['gp_max']) : 0;
		$bid = $_G['gp_bid'] ? ($_G['gp_bid'] == 'other' ? '-1' : intval($_G['gp_bid'])) : 0;

		$navarr = array();
		if($pcid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid=0&bid=0&page=1",'title'=>$category[$pcid]['name'])); }
		if($pcid && $cid) { array_push($navarr, array('url'=>"&order=lastpost&pcid={$pcid}&cid={$cid}&bid=0&page=1",'title'=>$category[$pcid]['child'][$cid])); }
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page-1)*$perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'newest', 'lastpost')) ? $_G['gp_order'] : 'lastpost';
		switch ($order) {
			case 'heats':
				$orderby = 'i.cnum desc';
				break;
			case 'score':
				$orderby = 'i.score desc';
				break;
			case 'newest':
				$orderby = '';
				break;
			default:
				$orderby = 'i.lastpost desc';
				break;
		}

		$condition = 'i.ispublish=1';
		$condition .= $cid ? ' AND i.cid='.$cid : ($pcid ? ' AND i.pcid='.$pcid : '');
		$condition_select_brand = $condition.' GROUP BY brandid';
		$condition .= $min ? ' AND i.price>='.$min : '';
		$condition .= $max ? ' AND i.price<='.$max : '';
		$condition .= $bid ? ' AND i.brandid='.$bid : '';
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$equipmentlist = $list_obj->getlist('equipment', 'i.brandname,i.brandid,i.pcname, i.kaid, i.views', $condition, $start, $perpage, $orderby, '', 1);
		$eq = memory('get','dp_equipment_brand_select_'.substr(md5($condition_select_brand), 0, 5));
		if(!$eq) {
			$query = DB::query("SELECT brandid FROM ".DB::table('dianping_equipment_info')." AS i WHERE $condition_select_brand ORDER BY id ASC ".getSlaveID());
			while ($row = DB::fetch($query)) {
				$eq[$row['brandid']] = $row['brandid'];
			}
			memory('set','dp_equipment_brand_select_'.substr(md5($condition_select_brand), 0, 5), $eq, 3600);
		}
		$_G['cache']['dp_equipment_brandlist'] ? $brandlist = $_G['cache']['dp_equipment_brandlist'] : updatecache('dp_equipment_brandlist');

		$dp_category['brand']['letter']['-1'] = '其他品牌';
		$show_all_brand = array_intersect_key($brandlist, $eq);

		foreach ($show_all_brand as $key => $value) {
			$letterlist[$value['letter']] = $dp_category['brand']['letter'][$value['letter']];
		}
		ksort($letterlist);

		if(count($show_all_brand) > 20)
		{
			$show_brand = array_slice($show_all_brand, 0, 5);
		}
		foreach($equipmentlist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'forum/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			
			$ename = $list_obj->getbrandename($v['brandid']);
			$v['ename'] = $ename;
			$equipmentlist[$k] = $v;
		}
		$letter1 = $_G['gp_letter1'] ? $_G['gp_letter1'] :"";
		$letter2 = $_G['gp_letter2'] ? $_G['gp_letter2'] :"";
		$letter3 = $_G['gp_letter3'] ? $_G['gp_letter3'] :"";
		$letter4 = $_G['gp_letter4'] ? $_G['gp_letter4'] :"";
		$letter5 = $_G['gp_letter5'] ? $_G['gp_letter5'] :"";
		$letter6 = $_G['gp_letter6'] ? $_G['gp_letter6'] :"";
		$letter7 = $_G['gp_letter7'] ? $_G['gp_letter7'] :"";
		$brand_name = $list_obj->getbrand_name($letter1,$letter2,$letter3,$letter4,$letter5,$letter6,$letter7);
		$brandname = $_G['gp_brandname'] ? $_G['gp_brandname'] :"";
		$brandname = $list_obj->getbrandname($brandname);
		$seo_str = $seo_str2 = '';
		switch ($order) {
			case 'heats':
				$seo_str = '最热门的';
				break;
			case 'score':
				$seo_str = '口碑最好的';
				break;
			case 'newest':
				$seo_str = '最新的';
				break;
			default:
				break;
		}
		if($bid) { $seo_str .= $brandlist[$bid]['subject']; }
		if($max && !$min) { $seo_str .= $max.'元以下'; }
		if($min && !$max) { $seo_str .= $min.'元以上'; }
		if($min && $max) { $seo_str .= "{$min}~{$max}元"; }
		if($pcid && !$cid) { $seo_str2 .= $category[$pcid]['name']; }
		if($pcid && $cid) { $seo_str2 .= $category[$pcid]['child'][$cid]; }
		if($page > 1) { $page_str = " - 第{$page}页"; }

		if($seo_str || $seo_str2)
		{
			if (!$seo_str2){
				$seo_str2="装备";
			}
			$pageTitle = "{$seo_str}户外{$seo_str2}哪个好|品牌推荐{$page_str}";
			
		}
		else
		{
			$pageTitle = "户外装备大全，装备用品推荐点评，户外用品使用心得{$page_str}";
			
		}
		$returnData['pageTitle'] = $pageTitle;
		$returnData['brandname'] = $brandname;
		$returnData['ename'] = $ename;
		$returnData['equipmentlist'] = $equipmentlist;
		$returnData['brand_name'] = $brand_name;
		$returnData['category'] = $category;
		$returnData['show_all_brand'] = $show_all_brand;
		$returnData['show_brand'] = $show_brand;
		encodeData($returnData);
		
	}
	function linelist()
	{
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		include_once libfile('function/cache');
		$cate_type = $dp_category['line']['type'];
		$cate_timetype = $dp_category['line']['timetype'];

		$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
		$timetype = !empty($_G['gp_timetype']) ? intval($_G['gp_timetype']) : 0;
		$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
		$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

		
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page - 1) * $perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';
		$pageTitle_tmp='';
		switch ($order) {
		    case 'heats':
		        $orderby = 'cnum desc';
		        $pageTitle_tmp.='最热门的';
		        break;
		    case 'score':
		        $orderby = 'score desc';
		        $pageTitle_tmp.='口碑最好的';
		        break;
		    case 'dateline':
		        $orderby = 'id desc';
		        $pageTitle_tmp.='最新的';
		        break;
		    default:
		        $orderby = 'lastpost desc';
		        break;
		}

		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$where = 'ispublish = 1';
		$wherecross = '';
		if ($type) {
		    $where .= " and  type = {$type}";
		    $wherecross .= " ltype = {$type}";
		}
		if ($timetype) {
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
		
		
		$_G['cache']['dp_line_region'] ? $lineregion = $_G['cache']['dp_line_region'] : updatecache('dp_line_region');
		$onlycity = $lineregion['onlycity'];
		$onlypro = $lineregion['onlypro'];
		$_G['cache']['dp_country_region'] ? $regionList = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
		$regionList["999999"] = array("cityname" => "国外", "shengid" => 0, "shiid" => 0, "citycode" => "999999");

		
		if ($wherecross) {
			
		    $crosslist = $zone->getcrosslist($wherecross);
		    foreach ($crosslist as $key => $val) {
		        $tidlist[$val['tid']] = 1;
		        $proList[$val['province']]++;
		        $citylist[$val['province']][$val['city']]++;
		    }
		    $tids = implode(',', array_keys($tidlist));
		    if ($tids) {
		        $where .= " and tid in ({$tids})";
		    } else {
		        $where .= " and tid in (0)";
		    }
		    foreach ($citylist as $k => $v) {
		        arsort($citylist[$k]);
		    }
		    $proList = ($lineregion['allpro']);
		    arsort($proList);
		} else {
			
		    $proList = ($lineregion['allpro']);
		    arsort($proList);
		}
		

		
		$linelist = $list_obj->getlist('line', 'type', $where, $start, $perpage, $orderby, '', 1);
		foreach ($linelist as $k => $v) {
		    $linecross = $zone->getlinecross($v['tid']);
		    foreach ($linecross as $key => $val) {
		        if ($key == 0) {
		            $linelist[$k]['provincename'] = $regionList[$val['province']]['cityname'];
		            $linelist[$k]['province'] = $val['province'];
		        }
		        $linelist[$k]['cityids'][$val['city']] = $val['province'];
		    }
		}
		$recordnum = $list_obj->recordnum; //lgt
		$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&type={$type}&timetype={$timetype}&provinceid={$provinceid}&cityid={$cityid}");
		
		if ($provinceid == 0 && $type == 0 && $timetype == 0) {
		    $status = 0;
		} else {

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
		$pageTitle = $pageTitle_tmp.strtr(lang('dianping', 'line' . $status . '_pageTitle'),
		    array(
		        '[pro_city]' => $pro_city,
		        '[pro_city_type]' => $pro_city_type,
		        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
		    )
		);
		
		foreach($linelist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'forum/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$linelist[$k] = $v;
		}
		$returnData['pageTitle'] = $pageTitle;
		$returnData['linelist'] = $linelist;
		$returnData['onlypro'] = $onlypro;
		$returnData['onlycity'] = $onlycity;
		$returnData['cate_type'] = $cate_type;
		$returnData['cate_timetype'] = $cate_timetype;
		$returnData['proList'] = $proList;
		$returnData['citylist'] = $citylist;
		$returnData['regionList'] = $regionList;
		encodeData($returnData);
	}

	function brandlist(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		$cate_letter = $dp_category['brand']['letter'];
		$cate_region = $dp_category['brand']['region'];
		$cate_ranklist = $dp_category['brand']['ranklist'];

		$let = $_G['gp_let'] ? intval($_G['gp_let']) : 0;
		$nat = $_G['gp_nat'] ? intval($_G['gp_nat']) : 0;
		$cp = $_G['gp_cp'] ? intval($_G['gp_cp']) : 0;

	
		$navarr = array();
		if($cp) { array_push($navarr, array('url'=>"&let=0&nat=0&cp={$cp}&order=lastpost&page=1",'title'=>$dp_category['brand']['ranklist'][$cp])); }
		//$subnav = make_nav($navarr);
		
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page-1)*$perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'newest','dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';

		$where =" i.ispublish=1 ";
		if (! empty($let)) {
			$where .= " and i.letter = {$let}";
			$title="户外品牌排行榜(首字母{$dp_category['brand']['letter'][$let]}) -户外品牌排行榜";
		}
		if (! empty($nat)) {
			$where .= " and i.nation = {$nat}";
			$title="{$dp_category['brand']['region'][$nat]}户外品牌排行榜-户外品牌排行榜";
		}
		if (! empty($cp)) {
			$where .= " and FIND_IN_SET('$cp',i.ranklist) ";
			$title="{$dp_category['brand']['ranklist'][$cp]}-户外品牌排行榜";
		}
		if (! empty($let) && ! empty($nat) && ! empty($cp)){

			$title="{$dp_category['brand']['region'][$nat]}{$dp_category['brand']['ranklist'][$cp]}(首字母{$dp_category['brand']['letter'][$let]}) -户外品牌排行榜";

		}elseif(! empty($let) && ! empty($nat)){
			$title="{$dp_category['brand']['region'][$nat]}户外品牌排行榜(首字母{$dp_category['brand']['letter'][$let]})";
		}elseif (! empty($nat) && ! empty($cp)){
			$title="{$dp_category['brand']['ranklist'][$cp]}(首字母{$dp_category['brand']['letter'][$let]})-户外品牌排行榜";

		}elseif (! empty($let) && ! empty($cp)){
			$title="{$dp_category['brand']['region'][$nat]}{$dp_category['brand']['ranklist'][$cp]}-户外品牌排行榜";

		}

		switch ($order) {
			case 'heats':
				$orderby = 'i.cnum desc';
				$ordertitle="最热门的";
				break;
			case 'score':
				if(!$let && !$nat && !$cp){
					$where.= " and i.cnum >= 50 ";
				}
				$orderby = 'i.score desc,i.id desc';
				$ordertitle="口碑最好的";
				break;
			case 'dateline':
				$orderby = 'i.dateline desc';
				$ordertitle="最新的";
				break;
			default:
				$orderby = 'i.lastpost desc';
				break;
		}
		if($page > 1) { $page_str = "-第{$page}页"; }
			if ($title) {
				$pageTitle = "{$ordertitle}{$title}{$page_str}-{$_G['setting']['bbname']}";
				
			}elseif ($ordertitle){
				$pageTitle = "{$ordertitle}户外品牌排行榜-户外品牌排行榜{$page_str}-{$_G['setting']['bbname']}";
				
			}else {
				$pageTitle = "户外品牌排行榜-户外品牌排行榜{$page_str}-{$_G['setting']['bbname']}";
		}
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$brandlist = $list_obj->getlist('brand', 'i.letter,i.ranklist,i.city,i.nation,i.cname,i.ename,i.views', $where, $start, $perpage, $orderby,'',1);
		foreach($brandlist as $k=>$v){
			//$v['showimg']= $v['showimg'] ? getimagethumb(1000,1000,1,'forum/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['showimg']= $v['showimg'] ? "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['showimg']}!wap" : "";
			$v['pic'] = $v['showimg'];
			$brandlist[$k] = $v;
		}
		$returnData['pageTitle'] = $pageTitle;
		$returnData['brandlist'] = $brandlist;
		$returnData['cate_region'] = $cate_region;
		$returnData['cate_letter'] = $cate_letter;
		encodeData($returnData);
	}
	
	function climblist(){

		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		
		$cate_type = $dp_category['climb']['type'];
		$cate_placetype = $dp_category['climb']['placetype'];

		$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
		$placetype = !empty($_G['gp_placetype']) ? intval($_G['gp_placetype']) : 0;
		$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
		$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

		
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page - 1) * $perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';

		switch ($order) {
		    case 'heats':
		        $orderby = 'cnum desc';
		        $pageTitle_tmp='最热门的';
		        break;
		    case 'score':
		        $orderby = 'score desc';
		        $pageTitle_tmp='口碑最好的';
		        break;
		    case 'dateline':
		        $orderby = 'id desc';
		        $pageTitle_tmp='最新的';
		        break;
		    default:
		        $orderby = 'lastpost desc';
		        break;
		}
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();

		$where = 'ispublish = 1';
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

		$climblist = $list_obj->getlist('climb', 'type,cityid,provinceid,addr,cnum,tel,placetype', $where, $start, $perpage, $orderby, '', 1);
		$modlistall = $list_obj->getlist('climb', 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

		
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
		
		$pagetitle = $pageTitle_tmp.strtr(lang('dianping',"climb" . $status . '_pageTitle'),
		    array(
		        '[pro_city]' => $pro_city,
		        '[typename]' => $typename,
		        '[placetypename]' => $placetypename,
		        '[pro_city_ctype]' => $pro_city_ctype,
		        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
		    )
		);
		//$pagetitle1 = explode("户外资料网8264.com",$pagetitle);
		foreach($climblist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$climblist[$k] = $v;
		}
		$returnData['pagetitle'] = $pagetitle;
		$returnData['climblist'] = $climblist;
		$returnData['cate_type'] = $cate_type;
		$returnData['cate_placetype'] = $cate_placetype;
		$returnData['proList'] = $proList;
		$returnData['cityList'] = $cityList;
		encodeData($returnData);
	}
        function clublist(){

		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		
		$cate_type = $dp_category['club']['type'];
                $gongsitype = !empty($_G['gp_gongsitype']) ? intval($_G['gp_gongsitype']) : 0;
                $cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
                $provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
                //处理列表数据
                $perpage = 15;
                $page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
                $start = ($page - 1) * $perpage;
                $order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

                switch ($order) {
                    case 'heats':
                        $orderby = 'cnum desc';
                        $pageTitle_tmp='最热门的';
                        break;
                    case 'score':
                        $orderby = 'score desc';
                        $pageTitle_tmp='口碑最好的';
                        break;
                    case 'dateline':
                        $orderby = 'id desc';
                        $pageTitle_tmp='最新的';
                        break;
                    default:
                        $orderby = 'lastpost desc';
                        break;
                }
                //列表数据
                require_once libfile('dianping/modlist', 'class');
                $list_obj = new modlist();
                $where = 'ispublish = 1';
                if ($gongsitype) {
                    $where .= " and  gongsitype = {$gongsitype}";
                }
                if ($cityid) {
                    $where .= " and  cityid = {$cityid}";
                }
                if ($provinceid) {
                    $where .= " and  provinceid = {$provinceid}";
                }
                $clublist = $list_obj->getlist('club', 'cityid,provinceid,addr,cnum,tel,chenglishijian,lingduinum,gongsitype', $where, $start, $perpage, $orderby, '', 1);
                $modlistall = $list_obj->getlist('club', 'cityid,provinceid,addr,cnum,chenglishijian,lingduinum,gongsitype', 'ispublish=1', $start, '', $orderby, '', 0);
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
                $multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&gongsitype={$gongsitype}&provinceid={$provinceid}&cityid={$cityid}");

                /*start----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/
                if ($provinceid == 0 && $gongsitype == 0) {
                    $status = 0;
                }
                elseif($gongsitype && !$provinceid){
                    $typename = $cate_type[$gongsitype];
                    $status = 1;
                }
                elseif(!$gongsitype && $provinceid ){
                    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
                    $status = 2;
                }elseif($gongsitype || $provinceid ){
                    $typename = $cate_type[$gongsitype];
                    $pro_city_ctype = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'] . $cate_type[$gongsitype] ;
                    $status = 3;
                }
                /*end----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/

                /*start----lang包,进行pagetitle统一处理*/
                $pagetitle = $pageTitle_tmp.strtr(lang('dianping', "club" . $status . '_pageTitle'),
                    array(
                        '[pro_city]' => $pro_city,
                        '[typename]' => $typename,
                        '[pro_city_ctype]' => $pro_city_ctype,
                        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
                    )
                );
		//$pagetitle1 = explode("户外资料网8264.com",$pagetitle);
		foreach($clublist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$clublist[$k] = $v;
		}
		$returnData['pagetitle'] = $pagetitle;
		$returnData['clublist'] = $clublist;
		$returnData['cate_type'] = $cate_type;
		$returnData['proList'] = $proList;
		$returnData['cityList'] = $cityList;
		encodeData($returnData);
	}
	
	function divinglist(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		
		$cate_type = $dp_category['diving']['type'];
		$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
		$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
		$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

		
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page - 1) * $perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';
		switch ($order) {
		    case 'heats':
		        $orderby = 'cnum desc';
		        $pageTitle_tmp='最热门的';
		        break;
		    case 'score':
		        $orderby = 'score desc';
		        $pageTitle_tmp='口碑最好的';
		        break;
		    case 'dateline':
		        $orderby = 'id desc';
		        $pageTitle_tmp='最新的';
		        break;
		    default:
		        $orderby = 'lastpost desc';
		        break;
		}
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$where = 'ispublish = 1';
		if($type){
		    $where .= " and  FIND_IN_SET('{$type}',type)";
		}
		if($cityid){
		    $where .= " and  cityid = {$cityid}";
		}
		if($provinceid){
		    $where .= " and  provinceid = {$provinceid}";
		}

		$divinglist = $list_obj->getlist('diving', 'type,cityid,provinceid,addr,cnum', $where, $start, $perpage, $orderby, '', 1);
		$modlistall = $list_obj->getlist('diving', 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);
		
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
		
		
		
		if ($provinceid == 0 && $type == 0) {
		    $status = 0;
		} else {
		  
		    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
		    $pro_city_type = $pro_city . $cate_type[$type];
		    if (($provinceid || $cityid) && $type == 0) {
		        $status = 1;
		    }else{
		        $status = 2;
		    }
		}

		
		

		foreach($divinglist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$divinglist[$k] = $v;
		}

		$pagetitle = $pageTitle_tmp.strtr(lang('dianping',"diving" . $status . '_pageTitle'),
		    array(
		        '[pro_city]'=>$pro_city,
		        '[pro_city_type]'=>$pro_city_type,
		        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
		    )
		);
		$returnData['pagetitle'] = $pagetitle;
		$returnData['divinglist'] = $divinglist;
		$returnData['cate_type'] = $cate_type;
		$returnData['cate_placetype'] = $cate_placetype;
		$returnData['proList'] = $proList;
		$returnData['cityList'] = $cityList;
		encodeData($returnData);
	}
	function skiinglist(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		include_once libfile('function/cache');
		$pro = $_G['gp_pro'] ? intval($_G['gp_pro']) : 0;
		
		$_G['cache']['dp_skiing_pro'] ? $region = $_G['cache']['dp_skiing_pro'] : updatecache('dp_skiing_pro');
	
		$perpage = 15;
		$page = max(intval($_G['gp_page']), 1);
		$start = ($page - 1) * $perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';
		switch ($order) {
			case 'heats':
				$orderby = 'i.cnum desc';
				$ordertitle="最热门的";
				break;
			case 'score':
				$orderby = 'i.score desc';
				$ordertitle="口碑最好的";
				break;
			case 'dateline':
				$orderby = 'i.id desc';
				$ordertitle="最新的";
				break;
			default:
				$orderby = 'i.lastpost desc';
				break;
		}
		$condition = 'i.ispublish=1';
		$condition .= $pro ? ' AND i.provinceid='.$pro : '';
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$skiinglist = $list_obj->getlist('skiing', 'provinceid', $condition, $start, $perpage, $orderby, '', 1);
		foreach($skiinglist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$skiinglist[$k] = $v;
		}
		
		$seo_str = '';
		if($pro) { $seo_str .= $region[$pro]['name']; }
		if($page > 1) { $page_str = " - 第{$page}页"; }
		if($seo_str)
		{
			$pageTitle = "{$ordertitle}{$seo_str}滑雪场哪个好|{$seo_str}滑雪场排行榜{$page_str}";
			
		}elseif ($ordertitle){
			$pageTitle = "{$ordertitle}滑雪场哪个好|滑雪场排行榜{$page_str}";
		
		}
		else
		{
			$pageTitle = "滑雪场哪个好|滑雪场排行榜{$page_str}";
			
		}
		$returnData['pageTitle'] = $pageTitle;
		$returnData['skiinglist'] = $skiinglist;
		$returnData['region'] = $region;
		encodeData($returnData);
	}
	
	
	function mountainlist(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		
		
		$cate_dq = $dp_category['mountain']['dq'];
		$cate_gd = $dp_category['mountain']['gd'];

		$dqnum = $_G['gp_dq'] ? intval($_G['gp_dq']) : 0;
		$gdnum = $_G['gp_gd'] ? intval($_G['gp_gd']) : 0;
		
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page-1)*$perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';

		switch ($order) {
			case 'heats':
				$orderby = 'i.cnum desc';
				$ordertitle="最热门的";
				break;
			case 'score':
				$orderby = 'i.score desc';
				$ordertitle="口碑最好的";
				break;
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
		
		require_once libfile('dianping/modlist', 'class');
		$_G['cache']['dp_mountain_comment_rate'] ? $comment_rate = $_G['cache']['dp_mountain_comment_rate'] : updatecache('dp_mountain_comment_rate');
		$list_obj = new modlist();
		$mountainlist = $list_obj->getlist('mountain', 'i.type, i.height, i.region, i.season', $condition, $start, $perpage, $orderby, '', 1);
		foreach($mountainlist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$mountainlist[$k] = $v;
		}
		
		$seo_str = '';
		if($dqnum) { $seo_str .= $cate_dq[$dqnum].'地区'; }
		if($gdnum) { $seo_str .= '海拔'.$cate_gd[$gdnum]; }
		if($page > 1) { $page_str = " - 第{$page}页"; }

		if($seo_str)
		{
			$pageTitle = "{$ordertitle}{$seo_str}雪山资料查询和用户攀登经验分享{$page_str} - {$_G['setting']['bbname']}";
			
		}elseif ($ordertitle){
			$pageTitle = "{$ordertitle}山峰资料,雪山资料,山峰查询 - 山伍成群{$page_str} - {$_G['setting']['bbname']}";
			
		}else{
			$pageTitle = "山峰资料,雪山资料,山峰查询 - 山伍成群{$page_str} - {$_G['setting']['bbname']}";
			
		}
		$returnData['pageTitle'] = $pageTitle;
		$returnData['mountainlist'] = $mountainlist;
		$returnData['cate_gd'] = $cate_gd;
		$returnData['dqnum'] = $dqnum;
		$returnData['gdnum'] = $gdnum;
		$returnData['cate_dq'] = $cate_dq;
		encodeData($returnData);
	}
	function fishinglist(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		
		$cate_type = $dp_category['fishing']['type'];
		$cate_childtype = $dp_category['fishing']['childtype'];
		$alltypename = $dp_category['fishing']['alltypename'];
		$cate_isfree = $dp_category['fishing']['isfree'];

		$type = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
		$isfree = !empty($_G['gp_isfree']) ? intval($_G['gp_isfree']) : 0;
		$cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
		$provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;

		
		$perpage = 15;
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$start = ($page - 1) * $perpage;
		$order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'heats';

		switch ($order) {
		    case 'heats':
		        $orderby = 'cnum desc';
		        $pageTitle_tmp='最热门的';
		        break;
		    case 'score':
		        $orderby = 'score desc';
		        $pageTitle_tmp='口碑最好的';
		        break;
		    case 'dateline':
		        $orderby = 'id desc';
		        $pageTitle_tmp='最新的';
		        break;
		    default:
		        $orderby = 'lastpost desc';
		        break;
		}
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist();
		$where = 'ispublish = 1';
		if ($type) {
		    foreach ($cate_childtype as $key => $val) {
		        if ($type == $key) {
		            $child_type = $val;
		            break;
		        }
		    }
		    $where .= " and type in ({$child_type})";
		}

		if ($isfree) {
		    $where .= " and  isfree = {$isfree}";
		}
		if ($cityid) {
		    $where .= " and  cityid = {$cityid}";
		}
		if ($provinceid) {
		    $where .= " and  provinceid = {$provinceid}";
		}

		$fishinglist = $list_obj->getlist('fishing', 'type,cityid,provinceid,addr,cnum,isfree', $where, $start, $perpage, $orderby, '', 1);

		$modlistall = $list_obj->getlist('fishing', 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

		
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

		
		$recordnum = $list_obj->recordnum;
		$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&type={$type}&isfree={$isfree}&provinceid={$provinceid}&cityid={$cityid}&order={$order}");

		
		if ($provinceid == 0 && $type == 0) {
		    $status = 0;
		} else {
		    
		    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
		    $pro_city_type = $pro_city.$cate_type[$type];
		    if (($provinceid || $cityid) && $type == 0) {
		        $status = 1;
		    } else{
		        $status = 2;
		    }
		}
		

		foreach($fishinglist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$fishinglist[$k] = $v;
		}
		$pageTitle = $pageTitle_tmp.strtr(lang('dianping', 'fishing' . $status . '_pageTitle'),
		    array(
		        '[pro_city]' => $pro_city,
		        '[pro_city_type]' => $pro_city_type,
		        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
		    )
		);
		$returnData['pageTitle'] = $pageTitle;
		$returnData['fishinglist'] = $fishinglist;
		$returnData['cate_type'] = $cate_type;
		$returnData['cate_placetype'] = $cate_placetype;
		$returnData['proList'] = $proList;
		$returnData['cityList'] = $cityList;
		$returnData['cate_isfree'] = $cate_isfree;
		$returnData['alltypename'] = $alltypename;
		encodeData($returnData);
	}
        function hostellist(){

		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		global $_G;
		global $returnData;
		
                $cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
                $provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
                //处理列表数据
                $perpage = 15;
                $page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
                $start = ($page - 1) * $perpage;
                $order = in_array($_G['gp_order'], array('heats', 'score', 'dateline', 'lastpost')) ? $_G['gp_order'] : 'lastpost';

                switch ($order) {
                    case 'heats':
                        $orderby = 'cnum desc';
                        $pageTitle_tmp='最热门的';
                        break;
                    case 'score':
                        $orderby = 'score desc';
                        $pageTitle_tmp='口碑最好的';
                        break;
                    case 'dateline':
                        $orderby = 'id desc';
                        $pageTitle_tmp='最新的';
                        break;
                    default:
                        $orderby = 'lastpost desc';
                        break;
                }
                //列表数据
                require_once libfile('dianping/modlist', 'class');
                $list_obj = new modlist();
                $where = 'ispublish = 1';
                if ($cityid) {
                    $where .= " and  cityid = {$cityid}";
                }
                if ($provinceid) {
                    $where .= " and  provinceid = {$provinceid}";
                }
                $hostellist = $list_obj->getlist('hostel', 'cityid,provinceid,addr,cnum,tel', $where, $start, $perpage, $orderby, '', 1);
                $modlistall = $list_obj->getlist('hostel', 'cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);
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
                $multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showlist&order={$order}&provinceid={$provinceid}&cityid={$cityid}");

                /*start----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/
                if ($provinceid == 0) {
                    $status = 0;
                }
                elseif(!$provinceid){
                    
                    $status = 1;
                }
                elseif($provinceid ){
                    $pro_city = $proList[$provinceid]['cityname'] . $cityList[$provinceid][$cityid]['cityname'];
                    $status = 2;
                }
                /*end----处理获取的省市和攀爬场地类型,进行重新组合满足title定制需要*/

                /*start----lang包,进行pagetitle统一处理*/
                $pagetitle = $pageTitle_tmp.strtr(lang('dianping', "hostel" . $status . '_pageTitle'),
                    array(
                        '[pro_city]' => $pro_city,
                        '[pro_city_ctype]' => $pro_city_ctype,
                        '[page]'=> $page>1 ? '第'.$page.'页 -' : ''
                    )
                );
		//$pagetitle1 = explode("户外资料网8264.com",$pagetitle);
		foreach($hostellist as $k=>$v){
			$v['showimg']= $v['showimg'] ? getimagethumb(100,75,2,'plugin/'.$v['showimg'], 0, $v['serverid']) : "";
			$v['pic'] = $v['showimg'];
			$hostellist[$k] = $v;
		}
		$returnData['pagetitle'] = $pagetitle;
		$returnData['hostellist'] = $hostellist;
		$returnData['proList'] = $proList;
		$returnData['cityList'] = $cityList;
		encodeData($returnData);
	}
		

		
}
?>