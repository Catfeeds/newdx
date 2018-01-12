<?php
/**
* ===========================================
* Project: 店铺系统(插件)
* Version: 1.0
* Time: 2007-7-17 @ Created
* Copyright (c) 2012 8264.com
* Website: http://www.8264.com
* Developer: zhanghongliang
* ===========================================
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';

class ForumOptionShop {
	
	/**
	 * 获得地区信息（发布页面调用）
	 */
	function getRegionData($id=0) {
		$sql = "";
		if($id&&$id!='all'){				
			$sql = ' and upid='.$id;	
		}		
	    $arr=array();	
		$query = DB::query("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE 1 $sql order by catid asc");							
		while ($row = DB::fetch($query)) {			
			$arr[] = $row;			
		}	
		return $arr;
	}	
	/***
	 * 获得店铺的信息（店铺详细页调用）
	 */
	function getShopBytId($tid){
		if($tid){
			$shop = DB::fetch_first("SELECT i.*,t.views,t.replies FROM ".DB::table('dianping_shop_info')." as i LEFT JOIN ".DB::table('forum_thread')." as t on i.tid = t.tid WHERE i.tid = $tid and i.ispublish in (0,1) limit 1");
            if($shop['serverid'] > 0){
                require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
                $attachserver = new attachserver;
                $domain = $attachserver->get_server_domain($shop['serverid']);
                $shop['sPic'] = "http://".$domain."/plugin/".$shop['sPic'];
            }else{
                $shop['sPic'] = "/data/attachment/plugin/".$shop['sPic'];
            }		
			return $shop;
		}	
	}
	
	function getShopEditmapBytId($tid){
		if($tid){
			$shop = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE tid ='$tid' limit 1");
			$dq = self::getProvince($shop['provinceid']);
			$xdq = self::getProvince($shop['regionid']);
			$shop['pro'] = $dq['name'];
			$shop['reg'] = $xdq['name'];
			return $shop;
		}	
	}
	
	/***
	 * 根据店铺的经纬度获取当前店铺附件的店信息(详细页调用)
	 */
	function getShopNearbyInfobyjw($long,$lat,$tid){		
		if($long&&$lat&&$tid){
			$longup = $long + 0.001;
			$longdown = $long -0.01;
			$latup = $lat + 0.01;
			$latdown = $lat - 0.01;		
			$arr=array();
			$sql = "SELECT * FROM ".DB::table('dianping_shop_info')." as i LEFT JOIN ".DB::table('forum_thread')." as t on i.tid = t.tid WHERE i.ispublish=1 and (i.lon BETWEEN '$longdown' and '$longup') and (i.lat between '$latdown' and '$latup') and i.tid not in($tid) order by i.tid asc limit 4";
			$query = DB::query($sql);							
			while ($row = DB::fetch($query)) {			
				$arr[] = $row;			
			}	
			return $arr;				
		}
	}
	
	/**
	 * 根据店铺所在的商场查找该商场内的其他户外店(详细页调用)
	 */
	function getShopBystrorName($region,$store){		
		if($store&&$region){
			$query = DB::query("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 and regionid = '$region' and marketid='$store' order by tid asc limit 5");							
			while ($row = DB::fetch($query)) {			
				$arr[] = $row;			
			}	
			return $arr;
		}
	}
	
	/**
	 * 根据店铺所在的地区查找该地区的其他户外店(详细页调用)
	 */
	function getShopByRegionName($region,$cbrand){		
		if($region&&$cbrand){
			$query = DB::query("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 and regionid='$region' and cbrandid='$cbrand' order by tid asc limit 5");							
			while ($row = DB::fetch($query)) {			
				$arr[] = $row;			
			}	
			return $arr;
		}
	}
	
	/***
	 * 店铺首页获得推荐店铺的信息
	 */
	function getRecommendinfo(){
		$arr = array();		
		$query = DB::query("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 order by score desc");							
		while ($row = DB::fetch($query)) {			
			$arr[] = $row;			
		}
	    return $arr;
	}	
		
	/***
	 *获得热门商场店的数据根据浏览数量调取
	 */
	function getShopInfoByviews($type){		
		$arr = array();
		$query = DB::query("SELECT s.*,t.views from ".DB::table('dianping_shop_info')." as s LEFT JOIN ".DB::table('forum_thread')." as t on s.tid = t.tid WHERE s.ispublish=1 ORDER BY t.views LIMIT 6");							
		while ($row = DB::fetch($query)) {
			$arr[] = $row;			
		}		
	    return $arr;		
	}
	
	// 计算店铺个数(首页调用)
	function getCountbyCondition($condition){
		$sql = "SELECT count(*) as count FROM ".DB::table('dianping_shop_info')." AS s
			LEFT JOIN ".DB::table('forum_thread')." AS t ON s.tid = t.tid				
			WHERE s.ispublish=1 ";
		if($condition['pro']){
			$sql .= " AND s.provinceid = '$condition[pro]'";	
		}
		if($condition['reg']){
			$sql .= " AND s.regionid = '$condition[reg]'";	
		}
		if($condition['sshop']){
			if($condition['sshop']==2){
				$sql .= " AND s.marketid >= 1";	
			}elseif($condition['sshop']==1){
				$sql .= " AND s.marketid = '0'";
			}elseif($condition['sshop']!=''){
				$sql .= " AND s.marketid = '$condition[sshop]'";
			}				
		}
		if($condition['cbrand']){
			$sql .= " AND s.cbrandid = '$condition[cbrand]'";	
		}
		if($condition['sbrand']){
			$sql .= " AND s.sbrandid = '$condition[sbrand]'";	
		}
		if($condition['tj']){
			$str =" and (";
			$brand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_brand')." WHERE brand like '%$condition[tj]%'");
			if($brand){
				$str .= " s.sbrandid in ($brand[id]) or ";
			}
			$cbrand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_cbrand')." WHERE chainbrand like '%$condition[tj]%'");
			if($cbrand){
				$str .= " s.cbrandid in ($cbrand[id]) or ";
			}			
			$sql .= $str." s.subject like '%$condition[tj]%')";	
		}
		//echo $sql;exit;
		$shopcount = DB::fetch_first($sql);		
		if($shopcount){
			return $shopcount['count'];
		}
	}
	
	/***
	 * 根据条件获得店铺信息列表
	 */
	function getShopList($condition, $orderby='t.dateline desc', $limit='0,20'){
		$array = array();
		$sql = "SELECT s.*, t.views FROM ".DB::table('dianping_shop_info')." AS s
				LEFT JOIN ".DB::table('forum_thread')." AS t ON s.tid = t.tid				
				WHERE s.ispublish=1 ";
		if($condition['pro']){
			$sql .= " AND s.provinceid = '$condition[pro]'";	
		}
		if($condition['reg']){
			$sql .= " AND s.regionid = '$condition[reg]'";	
		}
		if($condition['sshop']){
			if($condition['sshop']==2){
				$sql .= " AND s.marketid >= 1";	
			}elseif($condition['marketid']==1){
				$sql .= " AND s.marketid = '0'";
			}elseif($condition['sshop']!=''){
				$sql .= " AND s.marketid = '$condition[sshop]'";
			}			
		}
		if($condition['cbrand']){
			$sql .= " AND s.cbrandid = '$condition[cbrand]'";	
		}
		if($condition['sbrand']){
			$sql .= " AND s.sbrandid = '$condition[sbrand]'";	
		}
		if($condition['tj']){
			$str =" and (";
			$brand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_brand')." WHERE brand like '%$condition[tj]%'");
			if($brand){
				$str .= " s.sbrandid in ($brand[id]) or ";
			}
			$cbrand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_cbrand')." WHERE chainbrand like '%$condition[tj]%'");
			if($cbrand){
				$str .= " s.cbrandid in ($cbrand[id]) or ";
			}			
			$sql .= $str." s.subject like '%$condition[tj]%')";	
		}					
		if ($orderby){
			$sql .= " ORDER BY $orderby";	
		}		
		if ($limit) {
			$sql .= " LIMIT $limit";
		}
		//echo $sql;exit;
		$query = DB::query($sql);
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
		while ($value = DB::fetch($query)) {
			$value['score']=$value['score'];
            $value['sPic'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/":"/data/attachment/")."plugin/".$value['showimg'];
			$array[] = $value;
		}		
		return $array;	
	}
		
	/***
	 * 查找热门(最新)店铺信息(列表页调用)
	 */
	function getHotShopList($con=null){
		$arr = array();
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
		$query = DB::query("SELECT s.tid,s.showimg,s.subject,s.score,t.dateline,serverid FROM ".DB::table('dianping_shop_info')." AS s
				LEFT JOIN ".DB::table('forum_thread')." AS t ON s.tid = t.tid WHERE s.ispublish=1 order by $con desc limit 8");							
		while ($row = DB::fetch($query)) {
			$row['dateline'] = date('Y-m-d', $row['dateline']);
            $row['sPic'] = ($row['serverid']>0 ? "http://".$alldomain[$row['serverid']]."/":"/data/attachment/")."plugin/".$row['showimg'];
			$arr[] = $row;			
		}
		return $arr;
	}
	
	/**
	 *查找单个店铺的地区信息
	 */
	function getProvince($reg){
		if($reg){
			$dq = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE catid = '$reg' limit 1");
			if($dq){
				return $dq;
			}			
		}
	}
	
	function getsShoplist($pro=null,$reg=null){
		if($pro){
			$arr = array();
			$sql = ' and provinceid='.$pro;
			if($reg){
				$sql.=' and regionid='.$reg;
			}
			$query = DB::query("SELECT distinct(marketid) FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql order by marketid desc");							
			while ($row = DB::fetch($query)) {			
				$arr[] = $row['marketid'];			
			}
			$str=implode(',',$arr);
			if($str){
				$list = array();
				$query = DB::query("SELECT * FROM ".DB::table('plugin_shop_market')." WHERE id in ($str)");							
				while ($row = DB::fetch($query)) {			
					$list[] = $row;			
				}
				return $list;
			}	
		}		
	}
	
	// 查询店铺是否是街边店
	function isjiebian($pro=null,$reg=null){
		$sql = '';
		if($pro){
			$sql = ' and provinceid='.$pro;
			if($reg){
				$sql.=' and regionid='.$reg;
			}			
			$query = DB::query("SELECT distinct(marketid) FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql order by marketid desc");							
			while ($row = DB::fetch($query)) {
				
				if($row['marketid']==0){
					return true;
				}
				$arr[] = $row['marketid'];				
			}
			return false;			
		}		
	}
	
	/***
	 *	查询店铺中的地区
	 */
	function getRegionListbyshop($cbrand=null,$brand=null){
		$sql = '';
		if($cbrand){
			$sql.= ' and cbrandid='.$cbrand;
		}
		if($brand){
			$sql.= ' and sbrandid='.$brand;
		}
		$arr = array();		
		$sq="select count(*) as count,provinceid from ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql group by provinceid";
		$query = DB::query($sq);
		//$query = DB::query("SELECT distinct(sProvince) FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql order by sRegion desc");							
		while ($row = DB::fetch($query)) {
			if($row['provinceid']){
				$cb = self::getRegionById($row['provinceid']);
				$row['name'] = $cb['name'];
				$row['catid'] = $cb['catid'];
				$arr[] = $row;			
			}						
		}
		$rows = self::sortByCol($arr, 'count', SORT_DESC);	
		return $rows;		
		/*$str=implode(',',$arr);
		if($str){
			$list = array();
			$query = DB::query("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE catid in ($str) and upid=0");							
			while ($row = DB::fetch($query)) {			
				$list[] = $row;			
			}		
			return $list;
		}*/
	}
	
	/***
	 *  根据地区编号查找地区名称
	 */
	function getRegionById($id){
		if($id){
			$region = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE catid = $id limit 1");		
			return $region;
		}	
	}
	
	/***
	 * 根据帖子编号查找店铺信息(获得编辑状态信息)
	 */
	function getEditShopByTid($tid){
		if($tid){
			$shop = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE tid = $tid limit 1");
			if($shop['marketid']){
				$sShop = self::getMarketById($shop['marketid']);
				$shop['marketid'] = $sShop['market'];
			}
			if($shop['sbrandid']){
				$brand = self::getSBrandById($shop['sbrandid']);
				$shop['sbrandid'] = $brand['brand'];
			}
			if($shop['cbrandid']){
				$cbrand = self::getChainBrandById($shop['cbrandid']);
				$shop['cbrandid'] = $cbrand['chainbrand'];
			}
			return $shop;
		}	
	}
	
	/***
	*  删除产品信息
	*/ 
	function deletShopInfo($condition) {
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $allserver = $attachserver->get_server_domain('all','*');
		if($condition){
			$query = DB::query("select * FROM ".DB::table('dianping_shop_info')." WHERE $condition");   
			while ($value = DB::fetch($query)) {
				$path1=DISCUZ_ROOT."./data/attachment/plugin/".$value['showimg'];
				$path2=DISCUZ_ROOT."./data/attachment/plugin/".$value['showimg'].'.thumb200.jpg';
				if(file_exists($path1)){
					@unlink($path1);
				}
				if(file_exists($path2)){
					@unlink($path2);
				}
                if($value['serverid']>0){
                    $attachserver->delete($allserver[$value['serverid']]['domain'] , $allserver[$value['serverid']]['api'] , 'plugin/'.$value['showimg'] , 0 , '200');
                }
				$qy = DB::fetch_first("select * FROM ".DB::table('dianping_star_statistics')." WHERE typeid=$value[tid]");
				if($qy){
					DB::query("delete from ".DB::table('dianping_star_logs')." WHERE starid='$qy[starid]'");
					DB::query("delete from ".DB::table('dianping_star_statistics')." WHERE id='$qy[id]'");
				}			
			}		
			DB::query("DELETE FROM ".DB::table('dianping_shop_info')." WHERE $condition");				
		}		
	}
	/***
	 * 根据连锁品牌查询有多少个店铺
	 */
	function getCountBycbId($id){
		if($id){			
			$count = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('dianping_shop_info')." WHERE cbrandid = $id limit 1");			
			return $count;
		}	
	}	
	
	/***
	 * 根据品牌查询有多少个店铺
	 */
	function getCountBybrandId($id){
		if($id){			
			$count = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('dianping_shop_info')." WHERE sbrandid = $id limit 1");			
			return $count;
		}	
	}
	
	/***
	 * 根据连锁品牌查询连锁品牌名称
	 */
	function getChainBrandById($id){
		if($id){
			$brand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_cbrand')." WHERE id = $id limit 1");		
			return $brand;
		}	
	}
	
	/***
	 * 根据专营品牌编号查询专营名称
	 */
	function getSBrandById($sbrand){
		if($sbrand){
			$brand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_brand')." WHERE id = $sbrand limit 1");		
			return $brand;
		}	
	}
	
	/***
	 *  根据商场店编号查询商场店名称
	 */
	function getMarketById($id){
		if($id){
			$market = DB::fetch_first("SELECT * FROM ".DB::table('plugin_shop_market')." WHERE id = $id limit 1");		
			return $market;
		}	
	}	
	/***
	 *  店铺的点评，最新10条
	 */
	function getCommentList(){
		$sql = "SELECT i.*,p.* FROM ".DB::table('dianping_shop_info')." as i LEFT JOIN ".DB::table('plugin_forum_post')." as p
				on i.tid = p.tid where p.fid=421 and p.`first`=0 ORDER BY p.dateline";		
	}
	
	/***
	 * 根据商场店名称查找该商场店的其他户外店铺
	 */
	function getsShopListbyShop($sregion,$sShop,$tid){
		if($sregion&&$sShop&&$tid){
			$arr = array();
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
			$sql = "SELECT * FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 and regionid='$sregion' and marketid='$sShop' and tid<>$tid order by score desc limit 4";
			$query = DB::query($sql);							
			while ($row = DB::fetch($query)) {
                $row['sPic'] = ($row['serverid']>0 ? "http://".$alldomain[$row['serverid']]."/":"/data/attachment/")."plugin/".$row['sPic'];
				$arr[] = $row;			
			}
			return $arr;	
		}
	}
	
	/***
	 *  根据店铺地区和连锁品牌查找该地区的其他店铺
	 */
	function getShopcBrandbysBrand($sprovince,$cbrand,$tid){
		if($sprovince&&$cbrand&&$tid){
			$arr = array();
			$sql = "SELECT * FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 and provinceid='$sprovince' and cbrandid='$cbrand' and tid<>$tid order by score desc limit 4";
			$query = DB::query($sql);							
			while ($row = DB::fetch($query)) {			
				$arr[] = $row;			
			}
			return $arr;
		}		
	}
		
	/***
	 * 获得店铺的经营品牌信息（发布页面调用）
	 */
	function getsbrand(){
		$arr = array();
		$list = array();
		$sq="select count(*) as count,sbrand from ".DB::table('dianping_shop_info')." group by sbrand";	
		$querys = DB::query($sq);
		while ($values = DB::fetch($querys)) {
			$arr[$values['sbrand']]= $values['count'];
		}		
		$sqt = "SELECT * FROM ".DB::table('dianping_shop_brand')." WHERE 1";
		$query = DB::query($sqt);							
		while ($value = DB::fetch($query)) {
			$value['count']=$arr[$value['id']]? $arr[$value['id']]:0;	
			$list[] = $value;			
		}						
		$rows = self::sortByCol($list, 'count', SORT_DESC);	
		return $rows;		
	}
	
	//排序算法
	static function sortByCol($array, $keyname, $dir = SORT_ASC)
	{
		return self::sortByMultiCols($array, array($keyname => $dir));
	}
	static function sortByMultiCols($rowset, $args)
	{
		$sortArray = array();
		$sortRule = '';
		foreach ($args as $sortField => $sortDir) 
		{
			foreach ($rowset as $offset => $row) 
			{
				$sortArray[$sortField][$offset] = $row[$sortField];
			}
			$sortRule .= '$sortArray[\'' . $sortField . '\'], ' . $sortDir . ', ';
		}
		if (empty($sortArray) || empty($sortRule)) { return $rowset; }
		eval('array_multisort(' . $sortRule . '$rowset);');
		return $rowset;
	}
	
	/****
	 *  获得店铺的连锁品牌(发布页面调用)
	 */
	function getchain(){
		$arr = array();
		$list = array();
		$sql="select count(*) as count,cbrandid from ".DB::table('dianping_shop_info')." group by cbrandid";		
		$query = DB::query($sql);		
		while ($values = DB::fetch($query)) {
			$arr[$values['cbrand']]= $values['count'];
		}		
		$sqt = "SELECT * FROM ".DB::table('dianping_shop_cbrand')." WHERE 1";
		$query = DB::query($sqt);			
		while ($value = DB::fetch($query)) {			
			$value['count']=$arr[$value['id']]? $arr[$value['id']]:0;
			$value['cbrand']=$value['chainbrand'];
			$list[] = $value;			
		}
		$rows = self::sortByCol($list, 'count', SORT_DESC);	
		return $rows;			
	}
	
	
	/****
	 *  获得店铺的连锁品牌(首页调用)
	 */
	function getchainlist($pro=null,$reg=null,$sshop=null){
		$sql = '';
		if($pro){
			$sql = ' and provinceid='.$pro;
			if($reg){
				$sql.=' and regionid='.$reg;
			}
			if($sshop){
				$sql.=' and marketid>='.$sshop;
			}			
		}
		$arr = array();		
		$sq="select count(*) as count,cbrandid from ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql group by cbrandid";
		$query = DB::query($sq);
		//$query = DB::query("SELECT distinct(cbrand) FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql order by cbrand desc");							
		while ($row = DB::fetch($query)) {
			if($row['cbrand']){
				$cb = self::getChainBrandById($row['cbrand']);
				$row['chainbrand'] = $cb['chainbrand'];
				$row['id'] = $cb['id'];
				$arr[] = $row;			
			}				
		}
		$rows = self::sortByCol($arr, 'count', SORT_DESC);		
		return $rows;
		/*$str=implode(',',$arr);
		if($str){
			$list = array();
			$sqt = "SELECT * FROM ".DB::table('dianping_shop_cbrand')." WHERE id in ($str)";
			$query = DB::query($sqt);			
			while ($value = DB::fetch($query)) {	
				$list[] = $value;			
			}		
			return $list;	
		}	*/		
	}
	/***
	 * 获得店铺的经营品牌信息（首页调用）
	 */
	function getbrandlist($pro=null,$reg=null,$sshop=null){
		$sql = '';
		if($pro){
			$sql = ' and provinceid='.$pro;
			if($reg){
				$sql.=' and regionid='.$reg;
			}
			if($sshop){
				$sql.=' and marketid>='.$sshop;
			}			
		}
		$arr = array();
		$sq="select count(*) as count,sbrandid from ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql group by sbrandid";
		$query = DB::query($sq);
		//$query = DB::query("SELECT distinct(sbrand) FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql order by sbrand desc");							
		while ($row = DB::fetch($query)) {			
			if($row['sbrand']){
				$cb = self::getSBrandById($row['sbrand']);
				$row['brand'] = $cb['brand'];
				$row['id'] = $cb['id'];
				$arr[] = $row;	
			}			
		}
		$rows = self::sortByCol($arr, 'count', SORT_DESC);		
		return $rows;
		/*$str=implode(',',$arr);
		if($str){
			$list = array();		
			$sqt = "SELECT * FROM ".DB::table('dianping_shop_brand')." WHERE id in ($str)";
			$query = DB::query($sqt);							
			while ($value = DB::fetch($query)) {			
				$list[] = $value;			
			}		
			return $list;
		}*/		
	}
	/***
	 * 获得店铺的地区信息（首页筛选调用）
	 */
	function getRegionlist($province=0,$cbrand=0,$brand=0){		
		$arr = array();
		$sql = '';
		if($province){
			$sql.= ' and provinceid='.$province;
		}
		if($cbrand){
			$sql.= ' and cbrandid='.$cbrand;
		}
		if($brand){
			$sql.= ' and sbrandid='.$brand;
		}
		$query = DB::query("SELECT distinct(regionid) FROM ".DB::table('dianping_shop_info')." WHERE ispublish=1 $sql order by regionid desc");							
		while ($row = DB::fetch($query)) {			
			$arr[] = $row['regionid'];			
		}
		$str=implode(',',$arr);		
		if($str){
			$list = array();		
			$sqt = "SELECT * FROM ".DB::table('dianping_shop_region')." WHERE catid in ($str)";
			$query = DB::query($sqt);							
			while ($value = DB::fetch($query)) {			
				$list[] = $value;			
			}
			return $list;	
		}		
	}
	
	
	//taobao api 的数据调用	
	//签名函数
	function createSign ($paramArr,$appSecret) {		 
		 $sign = $appSecret;
		 ksort($paramArr);
		 foreach ($paramArr as $key => $val) {
			 if ($key != '' && $val != '') {
				 $sign .= $key.$val;
			 }
		 }
		 $sign.=$appSecret;
		 $sign = strtoupper(md5($sign));
		 return $sign;
	}
	//组参函数
	function createStrParam ($paramArr) {
		 $strParam = '';
		 foreach ($paramArr as $key => $val) {
			 if ($key != '' && $val != '') {
				 $strParam .= $key.'='.urlencode($val).'&';
			 }
		 }
		 return $strParam;
	}	
	/****
	 *   查询用户数据是否存在
	 */
	function getShopInfo($nick=null){
		$appKey = '21212754';
		$appSecret = '4d9c665be198e76dc097ca9a44f864cb';		
		$paramArr = array(
			'app_key' => $appKey,
			'method' => 'taobao.shop.get',
			'format' => 'json',
			'v' => '2.0',
			'sign_method'=>'md5',
			'timestamp' => date('Y-m-d H:i:s'),
			'fields' => 'sid,cid,title,nick,desc,bulletin,pic_path,created,modified,shop_score',
			'nick' => mb_convert_encoding($nick,"UTF-8", "GBK")
		);
		//生成签名
		$sign = self::createSign($paramArr,$appSecret);
		//组织参数
		$strParam = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		//访问服务
		$url = 'http://gw.api.taobao.com/router/rest?'.$strParam; 
		$result = file_get_contents($url);		
		$result = json_decode($result);
		$shop = array();
		$shop['code']  = $result->error_response->code;
		$shop['sub_msg']  = mb_convert_encoding($result->error_response->sub_msg,'GBK','UTF-8');		
		return $shop;
	}
	
	/***
	 *  根据淘宝昵称查询店铺地址
	 */
	function getShopUrlByNick($nick=null){
		$appKey = '21212754';
		$appSecret = '4d9c665be198e76dc097ca9a44f864cb';		
		$paramArr = array(
			'app_key' => $appKey,
			'method' => 'taobao.shop.get',
			'format' => 'json',
			'v' => '2.0',
			'sign_method'=>'md5',
			'timestamp' => date('Y-m-d H:i:s'),
			'fields' => 'sid,cid,title,nick,desc,bulletin,pic_path,created,modified,shop_score',
			'nick' => mb_convert_encoding($nick,"UTF-8", "GBK")
		);
		//生成签名
		$sign = self::createSign($paramArr,$appSecret);
		//组织参数
		$strParam = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		//访问服务
		$url = 'http://gw.api.taobao.com/router/rest?'.$strParam; 
		$result = file_get_contents($url);		
		$result = json_decode($result);
		$shop = array();
		$shop['sid'] = $result->shop_get_response->shop->sid;
		$shop['url'] = 'http://shop'.$result->shop_get_response->shop->sid.'.taobao.com';
		if($shop){
			return $shop;
		}
		return $shop;
	}
	
	//查询是否有重复的淘宝用户添加店铺
	function checkNickByNick($nc){
		if($nc){
		  $tb = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('plugin_shop_taobao')." WHERE nick='$nc' limit 1");
		  if($tb){
			return $tb['count'];
		  }
		}		
	}	
	
	
	
	function getTaobaoBySort($page=1){		
		$list = self::gettaobaodate($page);	
		$rows = self::sortByCol($list, 'num', SORT_DESC);				
		$page=isset($page) ? $page:1;		
		$page = ($page-1)*3;		
		$arr=array_slice($rows,$page,3,true);		
		return $arr;				
	}
	
	
	//查询淘宝店铺的个数
	function gettaobaocount(){
		$arr =  array();		
		$tb = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('plugin_shop_taobao')." WHERE isshow=1 limit 1");
		if($tb){
			return $tb['count'];
		}		
	}
	
	// 点击查看原图的方法
    function getsPicbytid($tid) {
		if(!$tid) {
		  return null; 
		}
		$sql="SELECT * FROM ".DB::table('dianping_shop_info')." WHERE tid={$tid} limit 1";
		return $shop = DB::fetch_first($sql);
    }
	// 查找帖子是否审核通过
	function getisPublis($tid){
	    if(!$tid) {
		  return null; 
		}
		$sql="SELECT * FROM ".DB::table('dianping_shop_info')." WHERE tid={$tid} limit 1";
		return $shop = DB::fetch_first($sql);	
	}	
	function getTaobaolist($nick){
		$appKey = '21212754';
		$appSecret = '4d9c665be198e76dc097ca9a44f864cb';		
		$paramArr = array(
			'app_key' => $appKey,
			'method' => 'taobao.shop.get',
			'format' => 'json',
			'v' => '2.0',
			'sign_method'=>'md5',
			'timestamp' => date('Y-m-d H:i:s'),
			'fields' => 'sid,cid,title,nick,desc,bulletin,pic_path,created,modified,shop_score',
			'nick' => mb_convert_encoding($nick,"UTF-8", "GBK")
		);
		//生成签名
		$sign = self::createSign($paramArr,$appSecret);
		//组织参数
		$strParam = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		//访问服务
		$url = 'http://gw.api.taobao.com/router/rest?'.$strParam;
		$result = file_get_contents($url);
		$result = json_decode($result);
		$shop = array();
		$shop['nick']  = mb_convert_encoding($result->shop_get_response->shop->nick,'GBK','UTF-8');
		$shop['title']  = mb_convert_encoding($result->shop_get_response->shop->title,'GBK','UTF-8');		
		$shop['sid'] = $result->shop_get_response->shop->sid;
		$shop['url'] = 'http://shop'.$result->shop_get_response->shop->sid.'.taobao.com';		
		if($result->shop_get_response->shop->pic_path){
			$shop['pic_path'] = 'http://logo.taobao.com/shop-logo/'.$result->shop_get_response->shop->pic_path;
		}else{
			$shop['pic_path'] = '/static/images/default.jpg';
		}		
		//$shop['shop_score'] = $result->shop_get_response->shop->shop_score;		
		$shop['delivery_score'] = $result->shop_get_response->shop->shop_score->delivery_score;
		$shop['item_score'] = $result->shop_get_response->shop->shop_score->item_score;
		$shop['service_score'] = $result->shop_get_response->shop->shop_score->service_score;
		//$shop['cid'] = $result->shop_get_response->shop->cid;		
		$paramArr = array(
			'app_key' => $appKey,
			'method' => 'taobao.sellercats.list.get',
			'format' => 'json',
			'v' => '2.0',
			'sign_method'=>'md5',
			'timestamp' => date('Y-m-d H:i:s'),
			'fields' => 'sid,cid,name',
			'nick' => mb_convert_encoding($nick,"UTF-8", "GBK")
		);
		//生成签名
		$sign = self::createSign($paramArr,$appSecret);
		//组织参数
		$strParam = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		//访问服务
		$url = 'http://gw.api.taobao.com/router/rest?'.$strParam;
		$result = file_get_contents($url);
		$result = json_decode($result);
		$arr = array();
		foreach($result->sellercats_list_get_response->seller_cats->seller_cat as $val){
			$name['name'] = mb_convert_encoding($val->name,'GBK','UTF-8');
			$arr[] =  $name;		
		}
		$shop['cats'] = $arr;		
		/*
		$paramArr = array(
			'app_key' => $appKey,
			'method' => 'taobao.taobaoke.shops.convert',			
			'format' => 'json',
			'v' => '2.0',
			'sign_method'=>'md5',
			'timestamp' => date('Y-m-d H:i:s'),			
			'seller_nicks' =>mb_convert_encoding($nick,"UTF-8", "GBK"),
			'fields' => 'shop_title,click_url,commission_rate,shop_type,seller_credit,auction_count,commission_rate'
		);
		//生成签名
		$sign = self::createSign($paramArr,$appSecret);
		//组织参数
		$strParam = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		//访问服务
		$url = 'http://gw.api.taobao.com/router/rest?'.$strParam; 
		$result = file_get_contents($url);
		$result = json_decode($result);
		$ar = array();
		foreach($result->taobaoke_shops_convert_response->taobaoke_shops->taobaoke_shop as $val){			
			$sp['shop_type'] = mb_convert_encoding($val->shop_type,'GBK','UTF-8');
			$sp['num'] = $val->seller_credit;
			$num = $val->seller_credit;
			switch ($num) { 
				case 1: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_red_1.gif' />" ; 
				break; 
				case 2: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_red_2.gif' />" ; 
				break; 
				case 3: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_red_3.gif' />" ; 
				break; 
				case 4: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_red_4.gif' />" ; 
				break; 
				case 5: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_red_5.gif' />" ; 
				break; 
				case 6: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_blue_1.gif' />" ; 
				break; 
				case 7: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_blue_2.gif' />" ; 
				break; 
				case 8: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_blue_3.gif' />" ; 
				break; 
				case 9: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_blue_4.gif' />" ; 
				break; 
				case 10: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_blue_5.gif' />" ; 
				break; 
				case 11: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_cap_1.gif' />" ; 
				break; 
				case 12: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_cap_2.gif' />" ; 
				break; 
				case 13: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_cap_3.gif' />" ; 
				break; 
				case 14: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_cap_4.gif' />" ; 
				break; 
				case 15: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_cap_5.gif' />" ; 
				break; 
				case 16: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_crown_1.gif' />" ; 
				break; 
				case 17: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_crown_2.gif' />" ; 
				break; 
				case 18: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_crown_3.gif' />" ; 
				break; 
				case 19: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_crown_4.gif' />" ; 
				break; 
				case 20: 
				$sp['seller_credit']="<img border='0' src='http://pics.taobaocdn.com/newrank/s_crown_5.gif' />" ; 
				break;
				default:
				$sp['seller_credit']="no date";
			} 			
			$ar[] = $sp; 									 
		}
		$shop['seller_credits'] = $ar;*/
		return $shop;		
	}
	
	
	//店铺信誉度调取
	function getSeller_credits($nick){
		$appKey = '21212754';
		$appSecret = '4d9c665be198e76dc097ca9a44f864cb';	
		$paramArr = array(
			'app_key' => $appKey,
			'method' => 'taobao.user.get',
			'format' => 'json',
			'v' => '2.0',
			'sign_method'=>'md5',
			'timestamp' => date('Y-m-d H:i:s'),
			'fields' => 'buyer_credit',
			'nick' => mb_convert_encoding('shoptaobao2012',"UTF-8", "GBK")
		);
		//生成签名
		$sign = self::createSign($paramArr,$appSecret);
		//组织参数
		$strParam = self::createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		//访问服务
		
		
		$url = 'http://gw.api.taobao.com/router/rest?'.$strParam;
		
		$result = file_get_contents($url);
		print_r($result);exit;
		$result = json_decode($result);
		//$result['sub'] = mb_convert_encoding($result->sub_msg,'GBK','UTF-8');
		return $result;
	}
	
	
	
	//调用淘宝店铺列表	
	function gettaobaodate($page){
		$arr =  array();		
		$query = DB::query("SELECT * FROM ".DB::table('plugin_shop_taobao')." WHERE isshow=1 order by id desc limit $page,20");							
		while ($row = DB::fetch($query)) {
			$row['list'] = self::getTaobaolist($row['nick']);
			$row['list']['nick'] = $row['nick'];	
			$arr[] = $row['list'];			
		}
		return $arr;
	}
	
	//淘宝数据缓存调用
	function loadCacheArray($name,$page=0){
		//global $_G;
		try{			
			if($name=='taobaodate'){
				$filename = "fid_471_taobao_".$page."";
				$aray_index = "fid_{$page}_".$name;				
			}elseif($name=='new'){
				$filename = "fid_471_bynew";
				$aray_index = "fid_".$name;				
			}elseif($name=='hot'){
				$filename = "fid_471_byhot";
				$aray_index = "fid_".$name;				
			}
			static $cache_array = NULL;
			if ($cache_array == NULL) {
				//ForumOptionCache::deleteCache($filename);
				$cache_array = ForumOptionCache::loadCache($filename, $aray_index);
			}
			if (isset($cache_array[$aray_index])) {
				$cache_item = $cache_array[$aray_index];
			} else {
				$cache_item = array();
			}			
			if ($cache_item && isset($cache_item['cacheTime'])) {			
				//3600*3 =10800 
				if (time() - 10800 < $cache_item['cacheTime']) {					
					return $cache_item['content'];
				}
			}			
			$item_array = array('cacheTime'=>time());			
			switch ($name) {
				case 'taobaodate':
					$item_array['content'] = self::gettaobaodate($page); break;				
				case 'hot':
					$item_array['content'] = self::getHotShopList('s.score'); break;
				case 'new':
					$item_array['content'] = self::getHotShopList('s.sid'); break;	
				default:
					$item_array['content'] = array();
			}			
			$cache_array[$aray_index] = $item_array;			
			ForumOptionCache::writeCache($filename, $cache_array);
			return $item_array['content'];			
		}catch(Exception $e){
			return array();
		}
	}
	
	//缓存店铺列表（首页）
	function loadCacheArrayAtShoplist($name,$condition,$orderby,$page){
		global $_G;
		try{			
			$filename = "fid_421_list_".$page."";
			$aray_index = "fid_{$page}_".$name;	
			static $cache_array = NULL;
			if ($cache_array == NULL) {				
				$cache_array = ForumOptionCache::loadCache($filename, $aray_index);
			}
			if (isset($cache_array[$aray_index])) {
				$cache_item = $cache_array[$aray_index];
			} else {
				$cache_item = array();
			}			
			if ($cache_item && isset($cache_item['cacheTime'])) {
				//3600*3 =10800 
				if (time() - 10800 < $cache_item['cacheTime']) {					
					return $cache_item['content'];
				}
			}			
			$item_array = array('cacheTime'=>time());			
			switch ($name) {
				case 'shoplist':
					$item_array['content'] = self::getShopList($condition, $orderby='s.score desc',$page); break;				
				default:
					$item_array['content'] = array();
			}			
			$cache_array[$aray_index] = $item_array;			
			ForumOptionCache::writeCache($filename, $cache_array);
			return $item_array['content'];			
		}catch(Exception $e){
			return array();
		}
	}
	
    //modified by JiangHong 编辑贴时，删除原先图片
    function deletImageByEdit($tid) {
		$shopinfo = DB::fetch_first("select * FROM ".DB::table('dianping_shop_info')." WHERE tid=$tid");
		if($shopinfo){
            /*读取所有的附件服务器信息*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $serverinfo = $attachserver->get_server_domain('all',"*");
            /*结束*/
            //if($produce['serverid'] > 0){
                $attachserver->delete($serverinfo[$shopinfo['serverid']]['domain'] , $serverinfo[$shopinfo['serverid']]['api'] , 'plugin/'.$shopinfo['sPic'] , 1 , '200');
            //}else{
                $path1=DISCUZ_ROOT."./data/attachment/plugin/".$shopinfo['sPic'];
                $path2=DISCUZ_ROOT."./data/attachment/plugin/".$shopinfo['sPic'].'.thumb200.jpg';	
                if(file_exists($path1)){
                	@unlink($path1);
                }
                if(file_exists($path2)){
                	@unlink($path2);
                }
            //}	
		}
	}
	//获得装备交易信息
	function getZbjyatOutShop($limit=10){
		$list = array();
		$sqt = "SELECT tid,subject FROM ".DB::table('forum_thread')." WHERE fid=174 and displayorder=0 order by dateline desc limit $limit";
		$query = DB::query($sqt);							
		while ($value = DB::fetch($query)) {	
			$list[] = $value;			
		}
		return $list;
	}	
    
}
