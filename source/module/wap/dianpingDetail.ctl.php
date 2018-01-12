<?php
/**
 * @author LiJinYu
 * @copyright 2015
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

Class DianpingDetailCtl extends FrontendCtl{
	
	//private $dp_modules;

	function __construct()
	{
		parent::__construct();		
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		// require_once DISCUZ_ROOT.'./config/config_dianping.php';
		// $this->dp_modules = $dp_modules;
		//var_dump($dp_modules);

	}
	function equipmentDetail()
	{
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];

		if($tid <= 0) { showmessage('参数错误'); }
		
		
		
		require_once libfile('dianping/detail', 'class');
		$detail_obj =  new detail($tid);
		$equipmentDetail = $detail_obj->getdetail('equipment', 'i.cid, cname, i.pcid, i.pcname, i.price, i.relatedtid, i.brandid, i.brandname, i.brandtid');
		if($equipmentDetail['fid'] != $dp_modules['equipment']['fid'] || ($equipmentDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}

		$equipmentDetail['showimg']= getimagethumb(130,90,2,'forum/'.$equipmentDetail['showimg'], 0, $equipmentDetail['serverid']);
		$equipmentDetail['pic'] = $equipmentDetail['showimg'];
		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		foreach($commentlist as $key=>$value){
			if($value['attachlist']){
				foreach($value['attachlist'] as $k=>$v){
					$v['attachment'] =  getimagethumb(80,80,2, $v['dir'].'/'.$v['attachment'], '', $v['serverid']);
					$commentlist[$key]['attachlist'][$k] = $v;
				}	
			}
			
		}
		$returnData['equipmentDetail'] = $equipmentDetail;
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}
	function lineDetail()
	{
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
	
		require_once libfile('dianping/detail', 'class');
		$detail_obj = new detail($tid);
		$lineDetail = $detail_obj->getdetail('line', 'i.type,i.timetype');
		if($lineDetail['fid'] != $dp_modules['line']['fid'] || ($lineDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		$lineDetail['showimg']= getimagethumb(322,322,2,'forum/'.$lineDetail['showimg'], 0, $lineDetail['serverid']);
		$lineDetail['pic'] = $lineDetail['showimg'];
		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist;
		$_G['cache']['dp_line_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_line_list_hot'] : updatecache('dp_line_list_hot');
		require libfile('dianping/zone', 'class');
		$zone = new zone();
		$linecross = $zone->getlinecross($tid);
		foreach ($linecross as $k => $v) {
		    if ($k == 0) {
		        $proid = $v['province'];
		    }
		    $cityids_tmp[] = $v['city'];
		}
		if (!empty($proid)) {
		    $tids = $zone->getsamecross($tid, $proid, $limit = 4);
		}
		if (!empty($tids)) {
		    $sidebar_list_same = $list_obj->getlist('line', '', 'ispublish=1 and tid in ( ' . $tids . ' )', 0, 0, 'id asc');
		};


		$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
		$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
		$lineregion = $zone->getlineregion();
		$onlycity = $lineregion['onlycity'];
		$proList = ($lineregion['allpro']);
		arsort($proList);
		$_G['cache']['dp_country_region'] ? $regionList = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
		$regionList["999999"] = array("cityname" => "国外", "shengid" => 0, "shiid" => 0, "citycode" => "999999");

		foreach($commentlist as $key=>$value){
			if($value['attachlist']){
				foreach($value['attachlist'] as $k=>$v){
					$v['attachment'] =  getimagethumb(80,80,2, $v['dir'].'/'.$v['attachment'], '', $v['serverid']);
					$commentlist[$key]['attachlist'][$k] = $v;
				}	
			}
			
		}
	
		$returnData['lineDetail'] = $lineDetail;
		$returnData['cityids_tmp'] = $cityids_tmp;
		$returnData['onlycity'] = $onlycity;
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}	

	function brandDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];

		if($tid <= 0) { showmessage('参数错误'); }
		$cate_letter = $dp_category['brand']['letter'];
		$cate_region = $dp_category['brand']['region'];
		$cate_ranklist = $dp_category['brand']['ranklist'];

		require_once libfile('dianping/detail_brand', 'class');
		require_once libfile('dianping/comment_brand', 'class');
		require_once libfile('dianping/modlist', 'class');
		$detail_obj =  new detail_brand($tid);
		$brandDetail = $detail_obj->getdetail('brand', 'i.id,i.url,i.showimg,i.dir,i.serverid,i.cname,i.ename,i.nation,i.company,i.addr,i.ranklist,i.city,i.tel,i.url');
		if($brandDetail['fid'] != $dp_modules['brand']['fid'] || ($brandDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
	
		$brandDetail['showimg']= $brandDetail['showimg'] ? "http://{$_G['config']['cdn']['images']['cdnurl']}/{$brandDetail['dir']}/{$brandDetail['showimg']}!wap" : "";
		$brandDetail['pic'] = $brandDetail['showimg'];

		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		$comment_obj = new comment_brand();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");
		
		if($_G['uid'])
		{
			$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);

		
			$comment['tid'] = $mycomment['tid'];
			$comment['pid'] = $mycomment['pid'];

			unset($commentlist[$mycomment['pid']]);
		}
		foreach($commentlist as $key=>$value){
			if($value['attachlist']){
				foreach($value['attachlist'] as $k=>$v){
					$v['attachment'] =  getimagethumb(80,80,2, $v['dir'].'/'.$v['attachment'], '', $v['serverid']);
					$commentlist[$key]['attachlist'][$k] = $v;
				}	
			}
			
		}

		$returnData['brandDetail'] = $brandDetail;
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}

	function climbDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
	
		$cate_type = $dp_category['climb']['type'];
		$cate_placetype = $dp_category['climb']['placetype'];
		
		require_once libfile('dianping/detail', 'class');
		$detail_obj = new detail($tid);
		$climbDetail = $detail_obj->getdetail('climb', 'i.lon, i.lat, i.addr,i.tel,i.provinceid,i.placetype,i.type,i.cityid,i.serverid');
		if($climbDetail['fid'] != $dp_modules['climb']['fid'] || ($climbDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}

		$climbDetail['showimg']= getimagethumb(125,167,2,'plugin/'.$climbDetail['showimg'], 0, $climbDetail['serverid']);
		$climbDetail['pic'] = $climbDetail['showimg'];
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist;
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
		    if (!$rv['shengid']) {
		        $proList[$rk] = $rv;
		    }
		}
		
		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where="";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		foreach($commentlist as $k=>$v){
			foreach($v['attachlist'] as $key=>$value){
				$value['attachment'] = $value['attachment'] ? getimagethumb(80,80,2,$value['dir'].'/'.$value['attachment'], 0, $value['serverid']) : "";
				$v['attachlist'][$key] = $value;
				$commentlist[$k]=$v;
			}
		}
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['climbDetail'] = $climbDetail;
		$returnData['cate_placetype'] = $cate_placetype;
		$returnData['countries'] = $countries;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}

	function divingDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
		$cate_type = $dp_category['diving']['type'];
		
		
		require_once libfile('dianping/detail', 'class');
		$detail_obj = new detail($tid);
		$divingDetail = $detail_obj->getdetail('diving', 'i.lon, i.lat, i.addr, i.provinceid, p.pid,i.type,i.cityid');
		
		if($divingDetail['fid'] != $dp_modules['diving']['fid'] || ($divingDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist;
		$_G['cache']['dp_diving_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_diving_list_hot'] : updatecache('dp_diving_list_hot');
		if ($divingDetail['provinceid']) {
		    $sidebar_list_same = $list_obj->getlist('diving', '', 'ispublish=1 and provinceid=' . $divingDetail['provinceid'], 0, 4, 'id asc');
		}
		
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
		
		if($divingDetail['type']){
			$type_array=explode(',', $divingDetail['type']);
			$typename='';
			foreach ($type_array as $value){
				
				$typename.=$cate_type[$value];
			}
		}
		$divingDetail['showimg']= getimagethumb(125,167,2,'plugin/'.$divingDetail['showimg'], 0, $divingDetail['serverid']);
		$divingDetail['pic'] = $divingDetail['showimg'];

		
		$page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		foreach($commentlist as $k=>$v){
			foreach($v['attachlist'] as $key=>$value){
				$value['attachment'] = $value['attachment'] ? getimagethumb(80,80,2,$value['dir'].'/'.$value['attachment'], 0, $value['serverid']) : "";
				$v['attachlist'][$key] = $value;
				$commentlist[$k]=$v;
			}
		}
		
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['typename'] = $typename;
		$returnData['divingDetail'] = $divingDetail;
		$returnData['countries'] = $countries;
		$returnData['cate_type'] = $cate_type;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}
	
	function skiingDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
		
		require_once libfile('dianping/detail', 'class');
		$detail_obj =  new detail($tid);
		$skiingDetail = $detail_obj->getdetail('skiing', 'showimg,url,tel,addr,provinceid,lon,lat,serverid,dir');
		if($skiingDetail['fid'] != $dp_modules['skiing']['fid'] || ($skiingDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		$skiingDetail['showimg']= getimagethumb(322,322,2,'plugin/'.$skiingDetail['showimg'], 0, $skiingDetail['serverid']);
		$skiingDetail['pic'] = $skiingDetail['showimg'];

		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}

		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		
		foreach($commentlist as $key=>$value){
			if($value['attachlist']){
				foreach($value['attachlist'] as $k=>$v){
					$v['attachment'] =  getimagethumb(80,80,2, $v['dir'].'/'.$v['attachment'], '', $v['serverid']);
					$commentlist[$key]['attachlist'][$k] = $v;
				}	
			}
			
		}
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;

		$returnData['skiingDetail'] = $skiingDetail;
		encodeData($returnData);
	}

	
	function mountainDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
		require_once libfile('dianping/detail', 'class');
		$detail_obj =  new detail($tid);
		$mountainDetail = $detail_obj->getdetail('mountain', 'i.type, i.height, i.region, i.altitude, i.lon, i.lat, i.season');
		if($mountainDetail['fid'] != $dp_modules['mountain']['fid'] || ($mountainDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		$mountainDetail['showimg']= getimagethumb(322,322,2,'forum/'.$mountainDetail['showimg'], 0, $mountainDetail['serverid']);
		$mountainDetail['pic'] = $mountainDetail['showimg'];
		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");

		
		foreach($commentlist as $key=>$value){
			if($value['attachlist']){
				foreach($value['attachlist'] as $k=>$v){
					$v['attachment'] =  getimagethumb(80,80,2, $v['dir'].'/'.$v['attachment'], '', $v['serverid']);
					$commentlist[$key]['attachlist'][$k] = $v;
				}	
			}
			
		}
		
		$returnData['mountainDetail'] = $mountainDetail;
		$returnData['countries'] = $countries;
		$returnData['catetype'] = $catetype;
		$returnData['cate_isfree'] = $cate_isfree;
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}

	function fishingDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
		require_once libfile('dianping/detail', 'class');
		$detail_obj = new detail($tid);
		$fishingDetail = $detail_obj->getdetail('fishing', 'i.lon, i.lat, i.addr,i.provinceid,i.cityid,i.type,i.isfree');
		if($fishingDetail['fid'] != $dp_modules['fishing']['fid'] || ($fishingDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		$fishingDetail['showimg']= getimagethumb(322,322,2,'plugin/'.$fishingDetail['showimg'], 0, $fishingDetail['serverid']);
		$fishingDetail['pic'] = $fishingDetail['showimg'];

		
		$page = max(1, $_G['gp_page']);
		$perpage = 10;
		$start = ($page - 1) * $perpage;
		$where = " ";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist;
		$modlistall = $list_obj->getlist('fishing', 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);
		$allcodeList = array();
		foreach ($modlistall as $key => $val) {
		    $allcodeList[$val['provinceid']] = 1;
		    $allcodeList[$val['cityid']] = 1;
		}
		$_G['cache']['dp_country_region'] ? $countries = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
		$cate_isfree = $dp_category['fishing']['isfree'];
		foreach ($countries as $rk => $rv) {
		    if (!$allcodeList[$rk]) {
		        unset($countries[$rk]);
		        continue;
		    }
		    if (!$rv['shengid']) {
		        $proList[$rk] = $rv;
		    }
		}
		
		foreach($commentlist as $key=>$value){
			if($value['attachlist']){
				foreach($value['attachlist'] as $k=>$v){
					$v['attachment'] =  getimagethumb(80,80,2, $v['dir'].'/'.$v['attachment'], '', $v['serverid']);
					$commentlist[$key]['attachlist'][$k] = $v;
				}	
			}
			
		}
		$catetype = $dp_category['fishing']['catetype'];
		$returnData['countries'] = $countries;
		$returnData['fishingDetail'] = $fishingDetail;
		$returnData['catetype'] = $catetype;
		$returnData['cate_isfree'] = $cate_isfree;
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}
        
        
        function clubDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
	
		$cate_type = $dp_category['club']['type'];
		require_once libfile('dianping/detail', 'class');
		$detail_obj = new detail($tid);
		$clubDetail = $detail_obj->getdetail('club', 'i.weixin,i.qq,i.lon, i.lat, i.addr,i.tel,i.provinceid,i.placetype,i.type,i.cityid,i.serverid');
		if($clubDetail['fid'] != $dp_modules['club']['fid'] || ($clubDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		$clubDetail['showimg']= getimagethumb(125,167,2,'plugin/'.$clubDetail['showimg'], 0, $clubDetail['serverid']);
		$clubDetail['pic'] = $clubDetail['showimg'];
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist;
		$modlistall = $list_obj->getlist('club', 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

		
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
		    if (!$rv['shengid']) {
		        $proList[$rk] = $rv;
		    }
		}
		
		$page = max(1, $_G['gp_page']);
		$perpage = 15;
		$start = ($page - 1) * $perpage;
		$where="";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		foreach($commentlist as $k=>$v){
			foreach($v['attachlist'] as $key=>$value){
				$value['attachment'] = $value['attachment'] ? getimagethumb(80,80,2,$value['dir'].'/'.$value['attachment'], 0, $value['serverid']) : "";
				$v['attachlist'][$key] = $value;
				$commentlist[$k]=$v;
			}
		}
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['clubDetail'] = $clubDetail;
		$returnData['countries'] = $countries;
                $returnData['cate_type'] = $cate_type;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}
        function hostelDetail(){
		require_once DISCUZ_ROOT.'./config/config_dianping.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
		global $_G;
		global $returnData;
		$tid = $_G['gp_tid'];
		if ($tid <= 0) {
		    showmessage('参数错误');
		}
	
		require_once libfile('dianping/detail', 'class');
		$detail_obj = new detail($tid);
		$hostelDetail = $detail_obj->getdetail('hostel', 'i.lon, i.lat, i.addr,i.tel,i.weixin,i.qq,i.provinceid,i.placetype,i.type,i.cityid,i.serverid');
		if($hostelDetail['fid'] != $dp_modules['hostel']['fid'] || ($hostelDetail['ispublish'] == 0 && $_G['adminid'] != 1)) {
			encodeData(array('error'=>true , 'errorinfo'=>'您要查看的内容不存在或未审核，请返回'));
		}
		$hostelDetail['showimg']= getimagethumb(125,167,2,'plugin/'.$hostelDetail['showimg'], 0, $hostelDetail['serverid']);
		$hostelDetail['pic'] = $hostelDetail['showimg'];
		require_once libfile('dianping/modlist', 'class');
		$list_obj = new modlist;
		$modlistall = $list_obj->getlist('hostel', 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

		
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
		    if (!$rv['shengid']) {
		        $proList[$rk] = $rv;
		    }
		}
		
		$page = max(1, $_G['gp_page']);
		$perpage = 15;
		$start = ($page - 1) * $perpage;
		$where="";
		if($_G['gp_starnum']){
			$where.=' and starnum='.$_G['gp_starnum'].' ';
			$starnum=$_G['gp_starnum'];
		}
		require_once libfile('dianping/comment', 'class');
		$comment_obj = new comment();
		$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
		$recordnum = $comment_obj->recordnum;
		foreach($commentlist as $k=>$v){
			foreach($v['attachlist'] as $key=>$value){
				$value['attachment'] = $value['attachment'] ? getimagethumb(80,80,2,$value['dir'].'/'.$value['attachment'], 0, $value['serverid']) : "";
				$v['attachlist'][$key] = $value;
				$commentlist[$k]=$v;
			}
		}
		$returnData['commentlist'] = $commentlist;
		$returnData['recordnum'] = $recordnum;
		$returnData['hostelDetail'] = $hostelDetail;
		$returnData['countries'] = $countries;
		$returnData['page'] = $page;
		$returnData['tid'] = $tid;
		encodeData($returnData);
	}
		

		
}
?>