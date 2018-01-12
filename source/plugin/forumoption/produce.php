<?php

require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/resizeimage.php';

class ForumOptionProduce {		
	/***
	*  获得前台产品大类下拉列表
	*/
	function getTypeData($limit=null) {
		//需要加缓存
        $limit = $limit==null ? 'no':$limit;
        $arr = memory('get' ,'produce_type_qtdl_tshow_'.$limit);
        if(!$arr){
    		$str = "SELECT * FROM ".DB::table('plugin_produce_type')." WHERE tparent = 0 and tshow = 1 ORDER BY id ASC";
    		/*if($_GET['sql']==1){			
    			echo "前台产品大类下拉列表：".$str."<br>";
    		}		*/
    		if($limit==1){
    			$str = $str." limit 10";
    		}
    		if($limit==2){
    			$str = $str." limit 10,20";
    		}	
    		$query = DB::query($str);		
    		$arr=array();		
    		while ($value = DB::fetch($query)) {			
    			$arr[] = $value;				
    		}
            memory('set' ,'produce_type_qtdl_tshow_'.$limit ,$arr ,3600*12);
        }
		return $arr;
	}	
	/***
	*  获得前台产品小类下拉列表
	*/
	function getTypeNextData($id=0) {	
	    $arr=array();	
		$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_type')." WHERE tparent = '{$id}' and tshow = 1 ORDER BY id ASC");							
		while ($row = DB::fetch($query)) {			
			$arr[] = array('id'=>mb_convert_encoding($row['id'],'UTF-8', 'GBK'),'title'=>mb_convert_encoding($row['tname'],'UTF-8', 'GBK')); 				
		}	
		return $arr;
	}
	/** 方法相同（获得产品小类的方法，编辑和前台调用时用到） **/
	function getTypeNextDatas($id=0) {
		//需要加缓存
		$arr=memory('get' ,'produce_type_nextdatas');
        if(!$arr){
            $str = "SELECT * FROM ".DB::table('plugin_produce_type')." WHERE tshow = 1 ORDER BY id ASC";
    		/*if($_GET['sql']==1){			
    			echo "前台产品类别的方法调用：".$str."<br>";
    		}*/
    		$query = DB::query($str);
    		while ($row = DB::fetch($query)) {			
    			$arr[] = $row;
    		}
            memory('set' ,'produce_type_nextdatas' ,$arr ,12*3600);
        }
		return $arr;;
	}
	
	function getBrandDataOnPubProduct() {
		//需要加缓存&&改逻辑
        global $_G;
        if($_G['uid']==1) memory('rm' ,'cache_produce_branddataobpubproduct');
		$array = memory('get' ,'cache_produce_branddataobpubproduct');
        if(!$array){
            global $_G;
    		/*$str = "SELECT t.tid, t.subject, v.value AS image, v2.value AS fletter
    			FROM ".DB::table('forum_thread')." AS t
    			LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
    			LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124			
    			WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0
    			ORDER BY fletter+0 ASC";*/
            $str = "SELECT tid, subject,showimg as image ,letter as fletter FROM ".DB::table('dianping_brand_info')." WHERE ispublish=1";
    		/*if($_GET['sql']==1){			
    			echo "获得边栏信息的方法：".$str."<br>";
    		}*/
            if($_G['uid']==1) memory('rm' ,'cache_brandcount');
            $arr = memory('get' ,'cache_brandcount');
            if(!$arr){
        		$sq="select count(*) as count,cppp from ".DB::table('plugin_produce_info')." group by cppp";
        		/*if($_GET['sql']==1){			
        			echo "获得个数方法：".$sq."<br>";
        		}*/
        		$querys = DB::query($sq);
        		while ($values = DB::fetch($querys)) {
        			$arr[$values['cppp']]= $values['count'];
        		}
                memory('set','cache_brandcount',$arr,3600*24*3);
            }
    		$query = DB::query($str);
    		while ($value = DB::fetch($query)) {
    			$value['count']=$arr[$value['tid']]? $arr[$value['tid']]:0;
    			//$value['count'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." WHERE type=0 and cppp = {$value['tid']}");
    			$value['hightlight'] = 0;
    			$imageArr = unserialize($value['image']);
    			$value['image'] = str_replace('bbs.8264.com/data/attachment/', $_G['setting']['domain']['app']['attach'], $imageArr['url']);
    			$value['fletter'] = $value['fletter'] ? chr($value['fletter']+64) : '';
    			$array[$value['fletter']?$value['fletter']:'OTHER'][] = $value;
    		}
    		//print_r($array);exit;			
    		function sortProductByCount($a, $b) {
    			if ($a['count'] == $b['count'])
    				return 0;
    			return $a['count'] > $b['count'] ? -1 : 1;
    		}
    		foreach ($array as $i => $arr) {
    			usort($array[$i], 'sortProductByCount');
    		}
            memory('set' ,'cache_produce_branddataobpubproduct' ,$array ,3600*24*7);
        }
		//print_r($array);exit;
		return $array;
	}

	function getBrandNumberAtBianlian(){
		$array = array();
		$array = self::getBrandDataOnPubProduct();
		$rows = self::sortByCol($array, 'count', SORT_DESC);		
		return $rows;
	}
		
	
	/**
	* 获得前台品牌数据下拉列表
	*/	
	function getBrandData($limit) {
		$sql = "SELECT t.tid, t.subject, v.value AS image, v2.value AS fletter, p.recommend1, p.recommend2, p.recommend3 FROM ".DB::table('forum_thread')." AS t
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124
				LEFT JOIN ".DB::table('plugin_produce_brand_property')." AS p ON p.tid = t.tid
				WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0
				ORDER BY fletter+0 ASC";
		if ($limit) {
			$sql .= " LIMIT $limit";
		}        
		return self::getBrandBySql($sql);
	}
	

	
	
	//显示所有品牌列表页显示
	function getallBrandData($condition=null) {
		global $_G;	
		$perpage =40;
		$page = max(1, intval($_G['gp_page']));
	    $start_limit = ($page - 1) * $perpage;	
		if($condition){
		 $sql1 = " and v2.value={$condition}";	
		}			
		$sql = "SELECT t.tid, t.subject, v.value AS image, v2.value AS fletter, p.recommend1, p.recommend2, p.recommend3 FROM ".DB::table('forum_thread')." AS t LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124
				LEFT JOIN ".DB::table('plugin_produce_brand_property')." AS p ON p.tid = t.tid
				WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0 {$sql1} 
				ORDER BY fletter+0 ASC limit ".$start_limit.",$perpage";
		return self::getBrandBySql($sql);
	}
	
	
	
	
	function getBrandCount($condition=null) {
		if($condition){
		 $sql1 = " AND v2.value={$condition}";	
		}	
        return DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_thread')." AS t
		                         LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124
							     WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0 $sql1");
	}
	
	function getBrandByTid($tid) {
		if (!$tid) {
			return array();
		}		
        return DB::fetch_first("SELECT t.tid, t.subject, v.value AS image, p.recommend1, p.recommend2, p.recommend3 FROM ".DB::table('forum_thread')." AS t
								LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
								LEFT JOIN ".DB::table('plugin_produce_brand_property')." AS p ON p.tid = t.tid
								WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0 AND t.tid = $tid");
	}
	
	
	/**
	* 获得前台品牌数据，在品牌区显示(包括图标)
	*/
	function getBrandLogoAtDH() {     
        $count_tmp = memory('get','cache_brand_type0');
        if(!$count_tmp){
    		$array = array();		
    		$str = "SELECT COUNT(*) as count,cppp FROM ".DB::table('plugin_produce_info')." WHERE type=0 GROUP BY cppp";
    		$query = DB::query($str);
    		while ($value = DB::fetch($query)) {
    			//$value['count'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." WHERE type=0 and cppp = {$value['tid']}");
    			$count_tmp[$value['cppp']] = $value['count'];
    		}
            memory('set','cache_brand_type0',serialize($count_tmp),3600*24*3);
        }else{
            $count_tmp = unserialize($count_tmp);
        }
        $sql = "SELECT t.tid, t.subject FROM ".DB::table('forum_thread')." as t
				WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0";
		if ($limit) {
			$sql .= " LIMIT $limit";
		}
		/*if($_GET['sql']==1){
			echo "导航查询品牌：".$sql."<br>";
		}*/
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			//$value['count'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." WHERE type=0 and cppp = {$value['tid']}");
			$value['count']=!empty($count_tmp[$value['tid']])?$count_tmp[$value['tid']]:0;
			$array[] = $value;
		}
		//print_r($array);exit;
		$rows = self::sortByCol($array, 'count', SORT_DESC);		
		return $rows;
	}	
	/**
	* 获得前台品牌数据，在品牌区显示(包括图标)
	* 	*/
	function getBrandLogo($limit) {
        $sql = "SELECT t.tid, t.subject, v.value AS image, v2.value AS fletter, p.recommend1, p.recommend2, p.recommend3 FROM ".DB::table('forum_thread')." AS t
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124
				LEFT JOIN ".DB::table('plugin_produce_brand_property')." AS p ON p.tid = t.tid
				WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0 AND p.recommend1 = 1
				ORDER BY fletter+0 ASC";
		if ($limit) {
			$sql .= " LIMIT $limit";
		}		
		return self::getBrandBySql($sql);
	}
	
	/**
	* 获得前台品牌数据，在菜单区显示(二级页面显示)
	*/	
	function getBrandMenu($limit) {
        $sql = "SELECT t.tid, t.subject, v.value AS image, v2.value AS fletter, p.recommend1, p.recommend2, p.recommend3 FROM ".DB::table('forum_thread')." AS t
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124
				LEFT JOIN ".DB::table('plugin_produce_brand_property')." AS p ON p.tid = t.tid
				WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0 AND p.recommend3 = 1
				ORDER BY fletter+0 ASC";
		if ($limit) {
			$sql .= " LIMIT $limit";
		}		
		return self::getBrandBySql($sql);
	}
	
	/**
	* 获得前台品牌数据，在推荐区显示(三级页面显示)
	*/	
	function getBrandTj($limit) {
        $sql = "SELECT t.tid, t.subject, v.value AS image, v2.value AS fletter, p.recommend1, p.recommend2, p.recommend3 FROM ".DB::table('forum_thread')." AS t
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v ON t.tid = v.tid AND v.optionid = 106
				LEFT JOIN ".DB::table('forum_typeoptionvar')." AS v2 ON t.tid = v2.tid AND v2.optionid = 124
				LEFT JOIN ".DB::table('plugin_produce_brand_property')." AS p ON p.tid = t.tid
				WHERE t.fid = 408 AND t.displayorder >= 0 AND t.closed = 0 AND p.recommend2 = 1
				ORDER BY fletter+0 ASC";
		if ($limit) {
			$sql .= " LIMIT $limit";
		}
		return self::getBrandBySql($sql);
	}
	
	function getBrandBySql($sql) {
		$query = DB::query($sql);
		$array = array();
		while ($value = DB::fetch($query)) {
			$imageArr = unserialize($value['image']);
			$imageArr['url'] = str_replace('bbs.8264.com/data/attachment/', $_G['setting']['domain']['app']['attach'], $imageArr['url']);
			$value['fletter'] = $value['fletter'] ? chr($value['fletter']+64) : '';
			$value['image'] = $imageArr['url'];
			$array[] = $value;
		}
		return $array;
	}
	
	
	/****
	*  根据编号查询单个商品信息（在编辑产品信息时用到）
	*/	
	function getProduceInfo($tid ,$pic=0) {
        global $_G;
		if($tid){
			$query = DB::fetch_first("SELECT i.*,t.digest,t.displayorder FROM ".DB::table('plugin_produce_info')." as i LEFT JOIN ".DB::table('forum_thread')." as t on i.tid=t.tid WHERE i.tid='{$tid}'");
            /*引入附件服务器*/
            if($query['serverid']>0){
                require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
                $attachserver = new attachserver;
                $domain = $attachserver->get_server_domain($query['serverid']);
            }
            $query['cptp'] = ($query['serverid']>0 ? "http://".$domain."/plugin/" : "/data/attachment/plugin/").$query['cptp'];
            switch($pic){
                case 1:
                    $thumb = '.thumb100.jpg';
                    break;
                case 2:
                    $thumb = '.thumb210.jpg';
                    break;
                case 3:
                    $thumb = '.thumb600.jpg';
                    break;
                default:
                    $thumb = '';
            }
            $query['image'] = $query['cptp'].$thumb;
            $query['url'] = $_G['config']['web']['portal'].'/zb-'.$tid;
			$query['cpjg']=(float)$query['cpjg'];
			//需要改逻辑&&暂时关闭
			//$query['count'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." where parentId=$tid");
			return $query;	
		}	   	
	}
	
	/***
	*   获得产品列表 一级 二级页面调用
	*/
	function getProductList($condition, $orderby='t.dateline desc', $limit='0,20') {
		//需要优化&&推荐时间倒叙&&加缓存1小时&&取消精华、值得买等标志位
		require_once DISCUZ_ROOT.'./source/function/function_post.php';
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";		
		global $_G;
        if($_G['uid']==1) memory('rm' ,'cache_produce_productlist'.$limit.'_brand_'.$condition['brand'].'_type_'.$condition['type']);
		$array = memory('get' ,'cache_produce_productlist'.$limit.'_brand_'.$condition['brand'].'_type_'.$condition['type']);
        if(!$array){
		$sql = "SELECT i.cptp, i.serverid, i.cpjg,i.cpxh, i.index_height, t.* FROM ".DB::table('plugin_produce_info')." AS i
				LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid				
				WHERE i.isshow=1 AND i.type = 0 AND i.isin = 1 ";
		
		/*if($condition['digest']=="digest"){
			$sql .= " AND t.digest = 1";	
		}
		if($condition['digest']=="cpxh"){
			$sql .= " AND i.cpxh = 1";	
		}
		if($condition['digest']=="isworth"){
			$sql .= " AND i.isworth = 1";	
		}*/
		if ($condition['brand']) {
			$sql .= " AND i.cppp = {$condition['brand']}";
		}
		if ($condition['type']) {
			$str = "select * from ".DB::table('plugin_produce_type')." where id=$condition[type]";
			$type = DB::fetch_first($str);
			if($type['tparent']){
				$where = " i.cplx={$condition['type']} ";	
			}else{
				$where = " i.cpdl={$condition['type']} ";	
			}				
			$sql .= " AND $where";
		} /*
	    if ($orderby=="cpxh DESC"||$orderby=="digest DESC"||$orderby=="isworth DESC"){
			$sql .= " ORDER BY t.dateline desc";	
		}else{
			$sql .= " ORDER BY $orderby";	
		}	
		if ($limit) {
			$sql .= " LIMIT {$limit}";
		}*/
		//echo $sql;exit;
		/*if($_GET['sql']==1){			
			echo "获得一二级信息列表方法：".$sql."<br>";
		}	*/
        /*引入附件服务器*/
        $sql .= " ORDER BY t.dateline DESC LIMIT ".$limit;
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*结束*/
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			/*if($value['tid']){
				$str = "select * from ".DB::table('forum_post')." where `first`=1 and tid=$value[tid] limit 1";
			    $post = DB::fetch_first($str);
				if($post){
					$value['message'] = $post['message'];
					$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
					$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
					$value['message'] = discuzcode($value['message']);
					$value['message'] = str_replace('　','',$value['message']);	
					$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
					$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
					$value['message'] = trim($value['message']);
					$value['message'] = messagecutstr($value['message'],100);					
				}				
			}*/
			$value['sharenum'] =  ForumOptionProduce::getShareNumbers($value['authorid']);
			$value['state'] = ForumOptionProduce::getOnlineState($value['authorid']);

			$array[] = array(
				'tid' => $value['tid'],
				'cptp' => ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'],
				'cpjg' => (float)$value['cpjg'],
				'cpxh' => $value['cpxh'],
				'digest' => $value['digest'],
				'authorid' => $value['authorid'],
				'avatar' => avatar($value['authorid'], 'small'),
				'author' => $value['author'],
				'subject' => $value['subject'],
				'dateline' => date('Y-m-d H:i', $value['dateline']),
				'message' => $value['message'],
				'views' => $value['views'],
				'replies' => $value['replies'],
				'index_img_height' => $value['index_height'],
				'sharenum' => $value['sharenum'],
				'state'=>$value['state']
			);
		}
        memory('set' ,'cache_produce_productlist'.$limit ,3600);
        }
		return $array;
	}
	
	
	function getBqProducebyId($parentId){
		//需要改逻辑
	/*	$sql = "SELECT childId FROM ".DB::table('plugin_produce_relation')." where parentId = $parentId";
		$query = DB::query($sql);
		$list = array();
		$array = array();
		while($value = DB::fetch($query)) {
			$list[] =  $value['childId'];
		}
		$arr=implode(',',$list);	*/	
		if($parentId){
			$str="SELECT  r.*, i.cptp, i.serverid, i.cpjg, i.cpxh, i.index_height, i.rank, t.*, FROM ".DB::table('plugin_produce_relation')." AS r
			      LEFT JOIN ".DB::table('plugin_produce_info')." AS i on i.tid = r.childId 
				  LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
				  WHERE i.isshow=1 AND i.isin = 0 and i.type = 0 r.parentId = $parentId 
				  ORDER BY t.dateline DESC limit 0,30";				 
			$query = DB::query($str);
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/
			while ($value = DB::fetch($query)) {
				$value['sharenum'] =  ForumOptionProduce::getShareNumbers($value['authorid']);
				$value['state'] = ForumOptionProduce::getOnlineState($value['authorid']);
	
				$array[] = array(
					'tid' => $value['tid'],
					'cptp' => ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'],
					'cpjg' => (float)$value['cpjg'],
					'cpxh' => $value['cpxh'],
					'digest' => $value['digest'],
					'authorid' => $value['authorid'],
					'avatar' => avatar($value['authorid'], 'small'),
					'author' => $value['author'],
					'subject' => $value['subject'],
					'dateline' => date('Y-m-d H:i', $value['dateline']),
					'message' => $value['message'],
					'views' => $value['views'],
					'replies' => $value['replies'],
					'index_img_height' => $value['index_height'],
					'sharenum' => $value['sharenum'],
					'state'=>$value['state']
				);
			}
			return $array;
		}		
		return $array;
		
	}
	  
	//缓存调用
	function loadCacheArray($name,$sql=null,$offset=null){
		try{		
			global $_G;
			if($name=='thread'){
				$filename = "thread_{$sql}";
				$aray_index = "thread_{$sql}_".$name;
			}elseif($sql=='heats'||$sql=='views'||$sql=='replies'||$sql=='t.heats'){
				$filename = "bbs100_$sql";
				$aray_index = "top100_{$offset}_".$name;
			}else{
				$filename = "fid_{$_G['page']}";
				$aray_index = "fid_{$offset}_".$name;		
			}			
				
			static $cache_array = NULL;
			if ($cache_array == NULL) {
				if($_G['uid']==1){
					ForumOptionCache::deleteCache($filename);
				}
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
				case 'zbindex':
					$item_array['content'] = self::getProductListDefault((($_G['page']-1)*300).',40'); break;				
				case 'ajax':
					$item_array['content'] = self::getAjaxInfo($sql); break;
				case 'erjilbdh':
					$item_array['content'] = self::getTypeNextDatas(); break;					
				case 'thread':
					$item_array['content'] = self::getYoumayLike($sql);break;				
				case 'bbs100':
					$item_array['content'] = self::getBBSTop100($sql,$offset);break;		
				case 'test':
					$item_array['content'] = array(123,456,7891); break;
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
	//缓存(装备分享)
	function loadCacheArrayByAjax($name,$limit=null,$offset=null){
		global $_G;
		try{		
			$filename = "fid_437_".$offset."";
			$aray_index = "fid_{$offset}_".$name;			
			static $cache_array = NULL;
			if ($cache_array == NULL) {
				if($_G['uid']==1){
					ForumOptionCache::deleteCache($filename);
				}
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
				case 'ajax':
					$item_array['content'] = self::getAjaxInfo($limit,$offset); break;
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
	
	
	//缓存装备首页的ajax数据
	function getAjaxInfo($limit,$offset){
		$sql = "SELECT i.cptp, i.serverid, i.cpjg, i.cpxh, i.index_height, i.rank, t.* FROM ".DB::table('plugin_produce_info')." AS i"
		." LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid"		
		." WHERE i.isshow=1 AND i.type = 0 and i.isin = 1 "
		." ORDER BY t.dateline DESC"
		." LIMIT {$limit} OFFSET {$offset}";
		$products = array();
        /*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*结束*/
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			/*if($value['tid']){
				$str = "select * from ".DB::table('forum_post')." where `first`=1 and tid=$value[tid] limit 1";
			    $post = DB::fetch_first($str);
				if($post){
					$value['message'] = $post['message'];
					$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
					$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
					$value['message'] = discuzcode($value['message']);
					$value['message'] = str_replace('　','',$value['message']);	
					$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
					$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
					$value['message'] = trim($value['message']);
					$value['message'] = messagecutstr($value['message'],100);					
				}				
			}*/
            $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];			
			$value['avatar'] = avatar($value['authorid'], 'small');
			$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
			$value['cpxh'] = is_numeric((int)$value['cpxh']) ? $value['cpxh'] : 0;
			$value['digest'] = is_numeric((int)$value['digest']) ? $value['digest'] : 0;
			$value['sharenum'] = ForumOptionProduce::getShareNumbers($value['authorid']);
			
			$value['author'] = mb_convert_encoding($value['author'], 'UTF-8', 'GBK');
			$value['subject'] = mb_convert_encoding($value['subject'], 'UTF-8', 'GBK');
			//$value['message'] = mb_convert_encoding($value['message'], 'UTF-8', 'GBK');			
		
			$products[] = $value;
			
		}
		return $products;
	}
	
	
	
	function getProductListDefault($limit='0,20') {
		//需要优化&&推荐时间倒叙&&加缓存1小时
		require_once DISCUZ_ROOT.'./source/function/function_post.php';
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";		
		$dateline = time() - 172800; // 3600*24*2 = 172800
		global $_G;
        if($_G['uid']==1) memory('rm' ,'cache_product_list_default'.$limit);
		$array = memory('get' ,'cache_product_list_default'.$limit);
        if(!$array){
		$sql = "SELECT i.cptp, i.serverid, i.cpjg, i.cpxh, i.index_height, i.rank, t.* FROM ".DB::table('plugin_produce_info')." AS i
				LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid				
				WHERE i.isshow=1 AND i.type = 0 and i.isin = 1
				ORDER BY t.dateline DESC";
		if ($limit) {
			$sql .= " LIMIT {$limit}";
		}		
		/*if($_GET['sql']==1){
			echo "获得装备首页列表：".$sql."<br>";
		}	*/
		/*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*结束*/
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {			
			/*if($value['tid']){
				$str = "select * from ".DB::table('forum_post')." where `first`=1 and tid=$value[tid] limit 1";
			    $post = DB::fetch_first($str);
				if($post){
					$value['message'] = $post['message'];
					$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
					$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
					$value['message'] = discuzcode($value['message']);
					$value['message'] = str_replace('　','',$value['message']);	
					$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
					$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
					$value['message'] = trim($value['message']);
					$value['message'] = messagecutstr($value['message'],100);					
				}				
			}*/	
			$value['sharenum'] =  ForumOptionProduce::getShareNumbers($value['authorid']);
			$value['state'] = ForumOptionProduce::getOnlineState($value['authorid']);
			
			$array[] = array(
				'tid' => $value['tid'],
				'cptp' => ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'],
				'cpjg' => (float)$value['cpjg'],
				'cpxh' => $value['cpxh'],
				'digest' => $value['digest'],
				'authorid' => $value['authorid'],
				'avatar' => avatar($value['authorid'], 'small'),
				'author' => $value['author'],
				'subject' => $value['subject'],
				'dateline' => date('Y-m-d H:i', $value['dateline']),
				'message' => $value['message'],
				'views' => $value['views'],
				'replies' => $value['replies'],
				'index_img_height' => $value['index_height'],
				'sharenum' => $value['sharenum'],
				'state'=>$value['state']
			);			
		}
        memory('set' ,'cache_product_list_default'.$limit ,3600);
        }
		//print_r($array);exit;
		return $array;
	}
	
	// 获得个人空间的装备发布数量
	function getProduceAtHome($limit='0,20',$uid) {
		//需要加缓存
		$array = array();
		$sql = "SELECT r.cptp, r.serverid, r.cpxh,t.* FROM ".DB::table('plugin_produce_info')." AS r
			   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			   where t.fid=437 AND t.authorid={$uid} AND r.isshow=1 AND r.type = 0 ORDER BY t.dateline desc";
		if ($limit) {
			$sql .= " LIMIT {$limit}";
		}
        /*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*结束*/		
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
            $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];				
			$array[] = $value;
		}
		return $array;
	}
	
	//ajax调用动态在空间展示信息
	function getProduceAtHomeByType($limit='0,20',$uid,$type) {
		return ;
		$array=array();
		$query = DB::query("SELECT tid FROM ".DB::table('plugin_produce_users')." WHERE type='{$type}' AND uid={$uid}");
		while ($value = DB::fetch($query)) {		
			$array[] = $value['tid'];
		}
		$arr=implode(',',$array);		
		if($arr){
		  $str="SELECT r.cptp,r.serverid,t.* FROM ".DB::table('plugin_produce_info')." AS r
			    LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			    where t.fid=437 AND r.isshow=1 and r.type=0 AND t.displayorder >= 0 AND t.tid in ($arr) ORDER BY t.dateline desc";
		if ($limit) {
			$sql .= " LIMIT {$limit}";
		}
        /*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*结束*/		
		$query = DB::query($str);			  
		while ($value = DB::fetch($query)) {
			$value['dateline']=date('Y-m-d ', $value['dateline']);
            $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
			$list[] = $value;
		}
		 return $list;			 
		}
	}	
	
	
	function getFirstbyPid($tid,$pid) {
		if($tid&&$pid) {
		 return DB::result_first("SELECT first FROM ".DB::table('forum_post')." WHERE tid={$tid} and pid={$pid}");	
		}else{
		 return null;	
		}		
	}
	
	/****
	*获得品牌列表图片
	*/
	function getBrandThumb($tid){
		$pic="";	
		if($tid) {  
		 $md5=md5($tid);
		 $pic = $_G['config']['web']['attach']."threadpic/100x50/{$md5[0]}{$md5[1]}/{$md5}.jpg";   
		 return $pic;  
		}else{
		 return $pic="./source/plugin/forumoption/nopic.jpg";
		}	   
	}
		
	/**
	*  根据产品类型查询产品个数(二级页显示)
	*/
	function getCountbytId($tyid) {
	  	$count = DB::result_first("SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." WHERE isshow=1 and isin=1 and (cpdl={$tyid} or cplx={$tyid})");
		return $count;		
	}
	
	function getCountbybqId($tyid) {		  
	  	$count = DB::result_first("SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." WHERE isshow=1 and isin=1 and type=$tyid");
		return $count;		
	}
	
	/**
	*  根据产品类型查询相关的产品个数
	*/
	function getProduceCount() {
		/*$sql="SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." AS r
			  LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			  left join ".DB::table('forum_post')." as p ON t.tid=p.tid
			  WHERE r.isshow=1 and r.type=0 and t.displayorder >= 0 AND t.closed = 0 and p.first=1 
			  ORDER BY t.dateline";*/
		$sql = "SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." where isshow=1 and isin=1 and type=0";			  
		/*if($_GET['sql']==1){			
			echo "装备首页查询总个数：".$sql."<br>";
		}		*/		
	  	$tcount = DB::fetch_first($sql);
		return $tcount;		
	}
	//查询精华个数
	function getDigestCount(){
		return ;
		  $sql="SELECT count(i.tid) as count FROM ".DB::table('plugin_produce_info')." AS i LEFT JOIN pre_forum_thread AS t ON i.tid = t.tid LEFT JOIN pre_forum_post as p ON t.tid = p.tid WHERE i.isshow=1 and i.type=0 and p.first=1 AND t.digest = 1";
		  $tcount = DB::fetch_first($sql);
		  return $tcount;
	}
	//查询真人秀的个数
	function getZhenrenxiuCount(){
		return ;
		  $sql="SELECT count(i.tid) as count FROM ".DB::table('plugin_produce_info')." AS i LEFT JOIN pre_forum_thread AS t ON i.tid = t.tid LEFT JOIN pre_forum_post as p ON t.tid = p.tid WHERE i.isshow=1 and i.type=0 and p.first=1 AND i.cpxh = 1";
		  $tcount = DB::fetch_first($sql);
		  return $tcount;
	}
	//查询值得购买的个数
	function getIsworthCount(){
		return ;
		  $sql="SELECT count(i.tid) as count FROM ".DB::table('plugin_produce_info')." AS i LEFT JOIN pre_forum_thread AS t ON i.tid = t.tid LEFT JOIN pre_forum_post as p ON t.tid = p.tid WHERE i.isshow=1 and i.type=0 and p.first=1 AND i.isworth = 1";
		  $tcount = DB::fetch_first($sql);
		  return $tcount;
	}
	
	/**
	*  根据产品品牌查询产品个数(二级页显示)
	*/
	function getCountbybId($bid) {			
		$tcount = DB::result_first("SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." WHERE isshow=1 and isin=1 and `type`=0 and cppp={$bid}");
		return $tcount;		
	}
	
	/**
	*  根据产品类型和品牌查询产品个数
	*/
	function getCountbytIdandbId($tid,$bid) {
		return ;
	    $count = DB::result_first("SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." WHERE isshow=1 and isin=1 and `type`=0 and cppp={$bid} and (cpdl={$tid} or cplx={$tid})");
	    return $count;
	}
	
	
	function getProduceErjibybIdandtId($tid,$bid) {
		global $_G;	
		$perpage = $_G['tpp'];
		$page = max(1, intval($_G['gp_page']));
	    $start_limit = ($page - 1) * $perpage;				  
	  	$query = DB::query("SELECT r.cptp,r.serverid,r.cpxh,t.* FROM ".DB::table('plugin_produce_info')." AS r
							LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid  WHERE r.isshow=1 and isin=1 and t.displayorder >= 0 AND t.closed = 0 
							and r.cppp={$bid} and cpdl={$tid} ORDER BY t.dateline DESC limit ".$start_limit.",$perpage");
		require_once DISCUZ_ROOT.'./source/function/function_post.php'; 
		require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";  
		$num = 0;
        /*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*结束*/
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['authorid'], 'small');	
			$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
            $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
			$array[$num%4][] = $value;
			++$num;			
		}
		return $array;	
	}	
	
	/***
	*   根据产品类别编号查询相关的品牌
	*/	
	function getBandinfoBytypeId($tyid) {
		$where = "";
		if($tyid){
			$str = "select * from ".DB::table('plugin_produce_type')." where id=$tyid";
			$type = DB::fetch_first($str);
			if($type['tparent']){
				$where = " cplx=$tyid ";
                $keyname = "cache_brand_cplx=$tyid";	
			}else{
				$where = " cpdl=$tyid ";
                $keyname = "cache_brand_cpdl=$tyid";	
			}	
		}
        $array = memory('get',$keyname);
        if(!$array){
    		$str = "select cppp from ".DB::table('plugin_produce_info')." where $where order by cppp";
    		/*if($_GET['sql']==1){
    			echo "产品类别查询相关品牌：".$str."<br>";
    		}	*/	
    		$query = DB::query($str);
    		$array = array();
    		while ($value = DB::fetch($query)) {					
    			$array[] =$value['cppp'];					
    		}
            memory('set',$keyname,serialize($array),3600*24*3);
        }else{
            $array = unserialize($array);
        }
		$array=array_flip(array_flip($array));
		if($array){
			$arr=implode(',',$array);
			$sql = "select tid,subject from ".DB::table('forum_thread')." as t where t.displayorder >= 0 AND t.closed = 0 and tid in ({$arr}) order by tid desc";
			/*if($_GET['sql']==1){
			 echo "品牌信息：".$sql."<br>";
			}	*/
			$query = DB::query($sql);
			$array = array();			
		    $sq="select count(*) as count,cppp from ".DB::table('plugin_produce_info')." where $where group by cppp";
			/*if($_GET['sql']==1){			
				echo "获得个数方法：".$sq."<br>";
			}*/
			$querys = DB::query($sq);
			while ($values = DB::fetch($querys)) {
				$arrs[$values['cppp']]= $values['count'];
			}	
			while ($value = DB::fetch($query)) {
				/*$stt = "select count(*) from ".DB::table('plugin_produce_info')." where $where and cppp={$value['tid']}";
				if($_GET['sql']==1){
					echo "查询个数：".$stt;
				}	
				$count = DB::result_first($stt);*/				
				$value['num']=$arrs[$value['tid']]? $arrs[$value['tid']]:0;//$count;
				$array[] =$value;					
			}			
		}else{
		   return null;	
		}
		$rows = self::sortByCol($array, 'num', SORT_DESC);		
	    return $rows;		
	}
	
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
	/***
	*  根据产品品牌获得产品类型信息
	*/
	function getTypeInfobybrId($bid) {
		$sql = "select cpdl from ".DB::table('plugin_produce_info')." where cppp={$bid}";
		/*if($_GET['sql']==1){
			echo "产品品牌获得产品类型:".$sql."<br>";
		}*/
	    $query = DB::query($sql);
		$array = array();
		while ($value = DB::fetch($query)) {					
			$array[] =$value['cpdl'];					
		}	
		if($array){
			$arr=implode(',',$array);
			$str = "select * from ".DB::table('plugin_produce_type')." where id in ({$arr})";
		/*	if($_GET['sql']==1){
				echo $str;
			}*/
			$query = DB::query($str);
			$array = array();
			while ($value = DB::fetch($query)) {					
				$array[] =$value;					
			}			
		}else{
		   return null;	
		}
	    return $array;  	
	}
	
	/***
	*  根据产品品牌和产品大类查询存在的产品小类
	*/
	function getXltypeBybandt($brand,$dltype) {
		return ;
		$query = DB::query("select cplx from ".DB::table('plugin_produce_info')." where cppp={$brand} and cpdl={$dltype}");
		$array = array();
		while ($value = DB::fetch($query)) {					
			$array[] =$value['cplx'];					
		}	
		if($array){
			$arr=implode(',',$array);		
			$query = DB::query("select * from ".DB::table('plugin_produce_type')." where id in ({$arr})");
			$array = array();
			while ($value = DB::fetch($query)) {					
				$array[] =$value;					
			}			
		}else{
		   return null;	
		}
	    return $array;  		
	}	
	
	/***
	*   根据产品编号查询产品类型
	*/
	function getPoduceTypeBytId($id) {
	   if($id==null||empty($id)){
		return null;   
	   }
	   $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$id");	  
	   return $pord;	   	
	}
	
	/***
	 *  查询帖子信息通过帖子编号
	 */
	function getTheardBytId($tid) {
	   if($tid==null||empty($tid)){
		return null;   
	   }	
	   $thread = DB::fetch_first("select * from ".DB::table('forum_thread')." where tid=$tid");	  
	   return $thread;	   	
	}
	
	function getPoduceTypeStringBytId($id,$dl=0) {
	    if($id||$dl){
			if($id==0) {
			   $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$dl");
			   $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'">'.$pord['tname'].'</a>';  
			}else{
			  $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$id");
			  $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'">'.$pord['tname'].'</a>';  
			}		
			$parentid = $pord['tparent'];
			while ($parentid != 0) {
				 $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$parentid");
				 $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'">'.$pord['tname'].'</a> &gt; '.$string;
				 $parentid = $pord['tparent'];
			}
			return $string;
		}
	}
	
	function getPoduceErjiTypeStringBytId($id,$dl=0) {
       $string = null;
       if($id==0) {
		  $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$dl");
	   }else{
		 $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$id");
	   }		
	   $parentid = $pord['tparent'];
	   while ($parentid != 0) {
			$pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$parentid");
			$string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'">'.$pord['tname'].'</a>';
			$parentid = $pord['tparent'];
	   }
	   return $string;	   
    }
	
	
	//获得当前位置
	function getPoduceTypeStringBytIds($id,$dl=0) {	
	   if($id==0) {
		 $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$dl");
		 $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'" title="'.$pord['tname'].'">'.$pord['tname'].'</a>';  
	   }else{
		 $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$id");
		 $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'" title="'.$pord['tname'].'">'.$pord['tname'].'</a>';  
	   }		
	     $parentid = $pord['tparent'];
	   while ($parentid != 0) {
			$pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$parentid");
			$string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'" title="'.$pord['tname'].'">'.$pord['tname'].'</a> <em>?</em>'.$string;
			$parentid = $pord['tparent'];
	   } 
	   return $string;
	}
	
	//获得当前位置2(用于seo优化)
	function getPoduceTypeStringBytIdss($id,$dl=0) {	
	   if($id==0) {
		 $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$dl");
		 $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'" title="'.$pord['tname'].'"><h1 style="font-weight: normal;">'.$pord['tname'].'</h1></a>';  
	   }else{
		 $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$id");
		 $string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'" title="'.$pord['tname'].'"><h1 style="font-weight: normal;">'.$pord['tname'].'</h1></a>';
	   }		
	   $parentid = $pord['tparent'];
	   while ($parentid != 0) {
			$pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$parentid");
			$string = '<a href="'.$_G['config']['web']['portal'].'zb-type-'.$pord['id'].'" title="'.$pord['tname'].'"><h1 style="font-weight: normal;">'.$pord['tname'].'</h1></a><em>?</em>'.$string;
			$parentid = $pord['tparent'];
	   }
	   return $string;
	}
	
	
	/***
	* 获得title信息
	*/
	function getTitlebyType($type) {
	    $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$type");
	    $string = $pord;
	    return $string;
	}
	
	/***
	*   根据产品编号查询产品品牌信息
	*/
	function getPoduceBrandById($id) {
		return;
	   if($id==null||empty($id)){
		return null;   
	   }		   
	   $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_brand')." where id=$id");	  
	   return $pord;	   	
	}
	
	
	/***
	*  获得当前装备体验活动 输出头图、标题、截止时间、报名人数(一级页面调用)
	*/
	function getApplyZb(){
		$applyzb = array();
		$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." AS t
							LEFT JOIN ".DB::table('forum_activity')." AS a ON a.tid = t.tid
							WHERE t.fid=378 and t.typeid=373 and t.closed=0 and t.displayorder>-1
							ORDER BY t.dateline DESC limit 0,6");					
		while ($value = DB::fetch($query)) {			
			if ($value['tid']) {
				$value['applynum'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_activityapply')." WHERE tid=".$value['tid']);
				$query_pic = DB::query("SELECT * FROM ".DB::table('forum_attachment')." WHERE aid=".$value['aid']);
				$pic = DB::fetch($query_pic);
				$value['pic'] = ($value['serverid'] > 0 ? $_G['config']['web']['attach'] : $_G['setting']['attachurl']).'forum/'.$pic['attachment'];
				$value['expiration'] = date('Y-m-d', $value['expiration']);
				$applyzb[] = $value;
			} else {
				$applyzb=null;
			}
		}
		return $applyzb;
	}
	
	/**
	*  首页二手信息调用（获得二手信息）列表
	*/
	function getSecondhandInfo(){
		$query_second = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE fid=53 ORDER BY dateline DESC limit 0,10");
		while ($value = DB::fetch($query_second)) {
		$value['avatar'] = avatar($value['authorid'], 'small');
		      $secondinfo[] = $value;
		} 
		return $secondinfo;
	}

	/***
	*  首页体验报告的调用
	*/
	function getApplyReport($keyword){	
		if(empty($keyword)){
			$query_report = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE fid=378 and (typeid<>373 or typeid<>372)  order by dateline desc limit 0,10");
		}else{
			$query_report = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE fid=378 and (typeid<>373 or typeid<>372) and subject like '%{$keyword}%' order by dateline desc limit 0,10");	
		}
		while ($value = DB::fetch($query_report)) {
			$value['avatar'] = avatar($value['authorid'], 'small');
			$applyreport[] = $value;
		}	
		return $applyreport;
	}
	
	/***
	*  最新资讯(一级页调用)
	*/
	function getZbzx(){
		$query =  DB::query("SELECT * FROM ".DB::table('common_block_item')." WHERE bid=279 ORDER BY displayorder");
		while($value =  DB::fetch($query)){
			$zbzx[] = $value;
		}
		return $zbzx;
	}
	
	
	//获得产品类型的名称
	function getProduceLx($typeid) {
	    $ptype = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_type')." 
							WHERE tshow=1 and id=$typeid");	
	    return $ptype;
	}
	
	/***
	*  根据品牌编号获得品牌名称（二级页面调用）
	*/
	function getProduceBarndbyId($bid){
		return;
		$brand = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_brand')." 
							WHERE id=$bid");	
	    return $brand;		
	}
	
	/***
	*  根据品牌名称查询 此品牌下的其他产品信息（三级页面调用）
	*/	
	function getOtherInfobyBrand($pro) {
		return ;
	   $sql ="SELECT * FROM ".DB::table('plugin_produce_info')." WHERE cppp='$pro[subject]' and tid!=$pro[tid] ORDER BY id DESC limit 0,8";	
	   $query = DB::query($sql);
	   while ($value = DB::fetch($query)) {			
		$seclist[] = $value;
	   }
	   return $seclist;	
	}
    
	/***
	*  根据产品类型查询此产品下的其他产品信息（三级页面调用）
	*/
	function getproInfobyBrand($pro) {
		return ;
	   $sql ="SELECT * FROM ".DB::table('plugin_produce_info')." WHERE cplx=$pro[cplx]  and tid!=$pro[tid] ORDER BY id DESC limit 8";	
	   $query = DB::query($sql);
	   while ($value = DB::fetch($query)) {			
		$seclist[] = $value;
	   }
	   return $seclist;	
	}
    
	/***
	*  获得往期的产品体验信息(三级页面调用)
	*/
	function getProduceActivity($tp) { 
		return ;
	    $sql="";
		if($tp['tname']){			
			$sql = "SELECT * FROM ".DB::table('forum_thread')." WHERE typeid=372 and subject LIKE '%$tp[tname]%' LIMIT 0, 6";
		}	 
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['authorid'], 'small');
			$activity[] = $value;
		}
		return $activity;
	}

	/***
	*  删除产品信息
	*/ 
	function deletProduceInfo($condition) {		    		
		if($condition){
			ForumOptionProduce::deleteProduceImage($condition);
			$info = DB::fetch_first("select * from ".DB::table('plugin_produce_info')." WHERE $condition");			
			if($info['type']>0){
			    $ab = DB::query("DELETE FROM ".DB::table('plugin_produce_relation')." WHERE parentId = ".$info['tid']);		
			}
			$ralate = DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE $condition");	
			$produce = DB::query("DELETE FROM ".DB::table('plugin_produce_users')." WHERE $condition");	
			$relevance = DB::query("DELETE FROM ".DB::table('plugin_produce_relevance')." WHERE $condition");
			$price = DB::query("update ".DB::table('plugin_produce_price')." set isdelete = 1 WHERE $condition");
		}		
	}
	
	// 删除帖子时删除图片信息
	function deleteProduceImage($condition) {
        /*读取所有的附件服务器信息*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $serverinfo = $attachserver->get_server_domain('all',"*");
        /*结束*/
        $query = DB::query("select * FROM ".DB::table('plugin_produce_info')." WHERE $condition");
	    while ($value = DB::fetch($query)) {
            /*新增，判定是否为附件服务器的图片，并删除*/
            if($value['serverid'] > 0){
                $attachserver->delete($serverinfo[$value['serverid']]['domain'] , $serverinfo[$value['serverid']]['api'] , 'plugin/'.$value['cptp'] , 1 , '210|600|100');
            }else{
                $path1=DISCUZ_ROOT."./data/attachment/plugin/".$value['cptp'];
                $path2=DISCUZ_ROOT."./data/attachment/plugin/".$value['cptp'].'.thumb210.jpg';
                $path3=DISCUZ_ROOT."./data/attachment/plugin/".$value['cptp'].'.thumb600.jpg';
                $path4=DISCUZ_ROOT."./data/attachment/plugin/".$value['cptp'].'.thumb100.jpg';	   
                if(file_exists($path1)){
                    @unlink($path1);
                }
                if(file_exists($path2)){
                    @unlink($path2);
                }
                if(file_exists($path3)){
                    @unlink($path3);
                }
                if(file_exists($path4)){
                    @unlink($path4);
                }
            }
	    }
	}
	
	//编辑帖子时或者在编辑帖子删除帖子时（如果上传新图片删除以前的图片）
	function deletImageByEdit($tid) {
		$produce = DB::fetch_first("select * FROM ".DB::table('plugin_produce_info')." WHERE tid={$tid}");
		if($produce){
            /*读取所有的附件服务器信息*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $serverinfo = $attachserver->get_server_domain('all',"*");
            /*结束*/
            //if($produce['serverid'] > 0){
                $attachserver->delete($serverinfo[$produce['serverid']]['domain'] , $serverinfo[$produce['serverid']]['api'] , 'plugin/'.$produce['cptp'] , 1 , '210|600|100');
            //}else{
                $path1=DISCUZ_ROOT."./data/attachment/plugin/".$produce['cptp'];
                $path2=DISCUZ_ROOT."./data/attachment/plugin/".$produce['cptp'].'.thumb210.jpg';
                $path3=DISCUZ_ROOT."./data/attachment/plugin/".$produce['cptp'].'.thumb600.jpg';
                $path4=DISCUZ_ROOT."./data/attachment/plugin/".$produce['cptp'].'.thumb100.jpg';			
                if(file_exists($path1)){
                	@unlink($path1);
                }
                if(file_exists($path2)){
                	@unlink($path2);
                }
                if(file_exists($path3)){
                	@unlink($path3);
                }
                if(file_exists($path4)){
                	@unlink($path4);
                }
            //}	
		}
	}
	
	//删除主帖
	function deletProduceInfoBytid($tid){
		if($tid){			
			$ralate = DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE tid={$tid}");			
		}
	}	
	
		
	/****
	*  新装备讨论（三级页面调用）
	*/	
	function getEquitmentInfo() {
	 	$sql ="SELECT * FROM ".DB::table('forum_thread')." 	WHERE fid=120 and typeid=89 ORDER BY lastpost DESC limit 0,10";
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['authorid'], 'small');
			$zbxx[] = $value;
		}
		return $zbxx;
	}
	
	/****
	*  最新资讯调用（三级页面调用）
	*/
	function getZxInfo() {
		$sql = "SELECT aid, title, pic, remote, dateline FROM ".DB::table('portal_article_title')." where (catid=209 or catid=211 or catid=209 or catid=212 or 
		        catid=220 or catid=214) order by dateline DESC LIMIT 10";				
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {			
			$zbxx[] = $value;
		}
		return $zbxx;
	}
	
	//用户分享的其他产品(六个)
	function getProduceOtherShare($tid,$uid) {
		return ;
		if($tid&&$uid){
			$sql ="SELECT r.tid,r.cptp,r.serverid FROM ".DB::table('plugin_produce_info')." AS r
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
				   WHERE t.fid=437 and r.isshow=1 and r.type = 0 and r.tid <> {$tid} and t.authorid={$uid} order by t.dateline desc limit 0,6";
			/*if($_GET['sql']==1){
				echo "用户分享的产品：".$sql."<br>";				
			}*/
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$other[] = $value;
			}
			return $other;
		}
	}
	//同类型下的产品
	function getProduceTypelist($tid,$cplx) {
		return ;
		if($tid && $cplx){
			$sql ="SELECT r.tid,r.cptp,r.serverid FROM ".DB::table('plugin_produce_info')." AS r
				   WHERE r.isshow=1 and r.type = 0 and r.tid <>{$tid} and r.cplx={$cplx} order by r.id desc limit 0,4";
			/*if($_GET['sql']==1){
				echo "同类型下的产品：".$sql."<br>";				
			}	*/		
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$zblx[] = $value;
			}
			return $zblx;	
		}		
	}
	//同品牌下的产品
	function getProduceBrandList($tid,$cppp) {
		return ;
		if($tid&&$cppp){
			$sql ="SELECT r.tid,r.cptp,r.serverid FROM ".DB::table('plugin_produce_info')." AS r				
				   WHERE r.isshow=1 and r.type = 0 and r.tid <>{$tid} and r.cppp={$cppp} order by r.id desc limit 0,4";
			/*if($_GET['sql']==1){
				echo "同品牌下的产品：".$sql."<br>";				
			}		*/   
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$pp[] = $value;
			}
			return $pp;
		}
	}
	
	/***
	function getProducelistBypplxuid($tid,$uid,$cplx,$cppp){
		if($tid&&$uid&&($cplx||$cppp)){			
			$sql ="SELECT r.* FROM ".DB::table('plugin_produce_info')." AS r
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
				   WHERE r.isshow=1 and t.displayorder >= 0 and r.tid!={$tid} and (t.authorid={$uid} or r.cplx={$cplx} or r.cppp={$cppp}) order by t.dateline desc limit 0,6";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {								
				$lsit[] = $value;
			}
			return $lsit;			
		}
	}****/
	
	//获得分享的数量()
	function getShareNumber($uid){
		if($uid){
			$sql = "SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." as r LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid WHERE  t.fid=437 AND t.authorid={$uid} AND r.isshow=1 AND r.type=0";
			/*if($_GET['sql']==1){
				echo "分享数量：".$sql."<br>";
			}*/
			$number = DB::result_first($sql);		
			return $number;
		}
	}
	
	//获得分享的数量(2)
	function getShareNumbers($uid){
		if($uid){
			$sql = "SELECT shareNum FROM ".DB::table('plugin_produce_publishers')." WHERE  uid={$uid}";		
			$number = DB::result_first($sql);		
			return $number;
		}
	}
	
	function getNumberbyleixing($uid,$lx) {
		if($uid&&$lx){
			$sql ="SELECT count(*) as num FROM ".DB::table('plugin_produce_users')." WHERE uid={$uid} and type='{$lx}'";
			/*if($_GET['sql']==1){
				echo "根据类型获得个数：".$sql."<br>";
			}*/
			$number = DB::result_first($sql);		
			return $number;
		}
	}
	
	//获得可能感兴趣的人
	function getXingqurenList($uid,$cppp) {
		return ;
		if($uid&&$cppp){
			$sql ="SELECT DISTINCT (t.authorid) FROM ".DB::table('plugin_produce_info')." AS r
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
				   WHERE r.isshow=1 and r.type=0 and r.cppp={$cppp} order by dateline desc limit 0,8";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['avatar'] = avatar($value['authorid'], 'small');						
				$pp[] = $value;
			}
			return $pp;
		}
	}
	
	//获得注册日期和好友个数
	function getFriendandRegdate($uid) {
		return ;
		if($uid){
			$sql="select m.regdate,c.friends from ".DB::table('common_member')." as m LEFT JOIN ".DB::table('common_member_count')." as c on m.uid=c.uid where m.uid={$uid}";
			$num = DB::fetch_first($sql);
			$num['regdate']=date('Y-m-d', $num['regdate']);	
			return $num;
		}
	}
	
   //获得我想用的产品信息
   function getWantitUsers($tid,$type) {
   	return ;
        $users = array();
        /*$query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('plugin_produce_users')." AS b
					   LEFT JOIN ".DB::table('common_member')." AS m
					   ON b.uid = m.uid
					   WHERE b.tid = {$tid} and b.type='{$type}'
					   GROUP BY b.uid
					   ORDER BY b.id DESC
					   LIMIT 26");*/
		$query = DB::query("SELECT b.id, b.uid FROM ".DB::table('plugin_produce_users')." AS b
					   WHERE b.tid = {$tid} and b.type='{$type}'
					   GROUP BY b.uid
					   ORDER BY b.id DESC
					   LIMIT 26");
		   while ($value = DB::fetch($query)) {
			   if($value['uid']) {
					$usernames[] = "userid:".$value['uid'];
				   $qq = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_relevance')." AS r
						 WHERE r.tid = {$tid} AND r.uid={$value['uid']}"); 
				  if($qq){
					$value['message']=$qq['address']; 					
					$value['price']= (float)$qq['price'];				
				  }
			   }
			   $value['avatar'] = avatar($value['uid'], 'small');
			   $users[] = $value;
		   }
           $usernames = self::cache_getUsernamebyUid($usernames);
           foreach($users as $key => $value){
                $users[$key]['username'] = $usernames[$value['uid']];
           }		  
        return $users;
   }
   
   
   function getTidBytid($tid){
		if($tid){
			return DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_thread')." WHERE tid={$tid} limit 1");
		}else{
			return 0;
		}
   }
   
   function getNumber($tid,$type) {
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_users')." WHERE tid={$tid} and type='{$type}'");
   } 
   
   
   function getProduceLxbytid($tid) {
		if(!$tid) {
		  return null; 
		}
		$sql="SELECT * FROM ".DB::table('plugin_produce_info')." WHERE tid={$tid}";
		return $produce = DB::fetch_first($sql);
   }
   //根据产品类别编号查询产品类型信息
   function getLxbyproduce($proLx) {
		if($proLx!=null){
		return $cplx = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_type')." WHERE id ={$proLx}");
		}else{
		return null;	
		}
   }
   
   //根据产品大类别名称和品牌查询产品
   /**
   function getProduceListbydlandbr($type,$brand,$tid) {
	    $sql ="SELECT * FROM ".DB::table('plugin_produce_info')." WHERE (cpdl={$type} or cplx={$type}) and cppp={$brand} and tid!={$tid} ORDER BY id DESC limit 6";
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {			
			$pp[] = $value;
		}	
		return $pp;
   }***/
   
	//获得当前的类型
	function getFirstTypeByTypeid($typeid){
		if($typeid){
			$type = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$typeid");
			if ($type['tparent'] == 0) {
				return $typeid;
			}
			return $type['tparent'];
		}
	}
	
	//获得分享的个数
	function getShareInfoByspace($uid) {
		return ;
		if($uid){
			$sql="SELECT i.cptp,i.serverid,t.*  FROM ".DB::table('plugin_produce_info')." AS i
				  LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid WHERE t.fid=437 and i.isshow=1 and i.type=0 AND t.displayorder >= 0 and t.authorid={$uid}  order by t.dateline desc limit 4";
			$query = DB::query($sql);
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/            
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$value['dateline'] = date('Y-m-d H:i', $value['dateline']);			
				$pp[] = $value;
			}	
			return $pp;
		}
	}
	

	//品牌俱乐部的二级页面调用该品牌下的所有分享信息
	function getShareBytId($tid){
		if($tid){
			$array=array();
			$sql="SELECT i.cptp,i.serverid,t.subject,t.tid FROM ".DB::table('plugin_produce_info')." AS i
					LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
					WHERE i.isshow=1 and isin=1 and i.type=0 AND t.displayorder >= 0 AND t.closed = 0 AND i.cppp=$tid
					ORDER BY t.dateline DESC Limit 0,45";			
			$query=DB::query($sql);
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$array[] = $value;
			}	
			return $array;
		}
	}
	
	//品牌俱乐部调用装备个数
	function getShareNumberAtBrand($tid){
		if($tid){
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." WHERE cppp={$tid}");
		}
	}
		
	//在产品详细页调取（品牌专区）的方法
	function getBrandNamebyTid($tid){
		return ;
		if($tid){
			$arr =  array();
			$str="select * from ".DB::table('forum_typeoptionvar')." where fid=408 and (optionid=99 or optionid=100) and tid={$tid}";
			$query=DB::query($str);
			while ($value = DB::fetch($query)) {
				if($value['optionid']==100 && $value['value']){
					$value['value']="(".$value['value'].")";
				}
				$array[] = $value;				
			}
			return $array;
		}
	}
	
	//装备分享首页调用 装备达人信息
	function getZhuangbeiDaren($type){
		return ;
		$array=array();
		$sql="SELECT * FROM ".DB::table('plugin_produce_recommend')." 
			  WHERE isshow=1 and recommendtype=$type ORDER BY displayorder DESC limit 6";			
		$query=DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['uname'], 'small');			
			$username = DB::fetch_first("select * from ".DB::table('common_member')." where uid={$value['uname']}");			
			$value['uname'] = $username['username'];
			$value['uid'] = $username['uid'];
			$array[] = $value;				
		}
		return $array;
	}
	
	//装备首页装备达人图片列表
	function getPiclist($tids){
		return ;
		$arr=array();
		$sql="SELECT cptp,tid,serverid FROM ".DB::table('plugin_produce_info')." 
			  WHERE tid in($tids) limit 6";			
		$query=DB::query($sql);
        /*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomaininfo = $attachserver->get_server_domain('all','*');
        /*结束*/
		if(!is_dir("./data/attachment/plugin/thumb/")) @mkdir("./data/attachment/plugin/thumb/");	
		while ($value = DB::fetch($query)) {			
			$mc=strtr($value['cptp'],"/",".");
            $cptp = $_G['setting']['attachurl']."plugin/".$value['cptp'];
			$thumbdir="plugin/thumb/".$mc;
            if($value['serverid']>0){
                $thumbfile = "http://".$alldomaininfo[$value['serverid']]['name']."/".$thumbdir;
                if($fp = fopen($thumbfile) === false){
                    $attachserver->Thumb($alldomaininfo[$value['serverid']]['domain'] , $alldomaininfo[$value['serverid']]['api'] , 'plugin/'.$value['cptp'] , $thumbdir , 70 , 70 , 2);
                }
                $value['cptp'] = $thumbfile;
            }else{
    			if(!file_exists($thumbdir)){
    				$resizeimage1 = new resizeimage($cptp, "70", "70", "1","./data/attachment/".$thumbdir);
    			}			
    			$value['cptp'] = $_G['setting']['attachurl']."plugin/thumb/".$mc;
            }	
			$arr[] = $value;				
		}		
		return $arr;
	}
	
	/*
	分享排序
	刚发布时0分，真人秀+5分，精华加15分，
	评论字数大于N的或评论内容里带有两张以上图片的每条+1分，评论被置顶的加2分，
	每条价格购买地信息的加2分 然后这个分值从发起之日起每天会减1分
	*/
	function calPostRank($tid=NULL) {
		return ;
		$sql = "SELECT i.tid, i.cpxh, i.cpjg, t.digest, t.dateline FROM ".DB::table('plugin_produce_info')." i"
			." LEFT JOIN ".DB::table('forum_thread')." t ON i.tid = t.tid";
		if ($tid) {
			$sql .= " WHERE t.tid = $tid";
		} else {
			set_time_limit(99999);
		}
		
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$rank = 0;
			// 真人秀
			if ($value['cpxh'] == 1) {
				$rank += 20;
			}
			// 精华
			if ($value['digest'] == 1) {
				$rank += 70;
			}			
			$rank += 10 * (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_price')." WHERE `tid` = '{$value['tid']}' AND isdelete=0");
			$rank += 5 * (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_poststick')." WHERE `tid` = '{$value['tid']}'"); // 评论置顶
			$commentnum = (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_post')." WHERE `tid` = '{$value['tid']}'") - 1; //评论数
			$cnum = $commentnum >= 100 ? 100 : $commentnum;
			$rank += $cnum;			
			$dates = max(floor((time() - $value['dateline'])/86400), 0);			
			$rank -= floor($dates * 1) * 40;			
			$rank = max($rank, 0);
			DB::query("UPDATE ".DB::table('plugin_produce_info')." SET rank = $rank WHERE tid = {$value['tid']}");
		}
		echo "success!";
	}
	
	/**
	 * event:
	 * 0: 新发布
	 * 1: 设为真人秀
	 * 2: 取消真人秀
	 * 3: 设为精华
	 * 4: 取消精华
	 * 5: 完善价格
	 * 6: 取消完善价格
	 * 7: 每天减40
	 * 8: 评论置顶 +2
	 * 9: 取消评论置顶 -2
	 * 10: 新评论 +1
	 * 11: 删除评论 -1
	 */
	function calPostRankEvent($tid, $event) {
		if (!$tid) {
			return;
		}
		switch ($event) {
			case 0:
				DB::query("UPDATE ".DB::table('plugin_produce_info')." SET rank=11 WHERE tid=$tid");
				return;
				break;
			case 1:
				$rank_incre = 20;
				break;
			case 2:
				$rank_incre = -20;
				break;
			case 3:
				$rank_incre = 70;
				break;
			case 4:
				$rank_incre = -70;
				break;
			case 5:
				$rank_incre = 10;
				break;
			case 6:
				$rank_incre = -10;
				break;
			case 7:
				$rank_incre = -40;
				break;
			case 8:
				$rank_incre = 5;
				break;
			case 9:
				$rank_incre = -5;
				break;
			case 10:
				$rank_incre = 1;
				break;
			case 11:
				$rank_incre = -1;
				break;
			default:
				return;
				break;
		}
		DB::query("UPDATE ".DB::table('plugin_produce_info')." SET rank=rank+($rank_incre) WHERE tid=$tid");
	}

	/*
	装备分享
	装备分享排名（根据装备分享贡献度计算）
	贡献度的计算完全隐藏
	内定规则如下，发布分享+2，完善价格+1，真人秀+5，精华+20
	*/
	function calPublisherRank($uid=NULL) {
		return ;
		if (!empty($uid)) {
			$uids = array($uid);
		} else {
			// 所有用户
			$uids = array();
			$query = DB::query("SELECT authorid FROM ".DB::table('forum_thread')." WHERE fid = 437 GROUP BY authorid");
			while ($value = DB::fetch($query)) {
				$uids[] = $value['authorid'];
			}
			set_time_limit(99999);
		}
		
		foreach ($uids as $uid) {
			$rank = 0;
			$query = DB::query("SELECT i.*, t.digest, t.author FROM ".DB::table('plugin_produce_info')." i".
							   " LEFT JOIN ".DB::table('forum_thread')." t ON t.tid = i.tid".
							   " WHERE t.authorid = $uid");
			$username = '';
			$shareNum = $priceNum = $showNum = $digestNum = 0;
			while ($value = DB::fetch($query)) {
				$shareNum++;
				if ($username === '') {
					$username = $value['author'];
				}
				$tid = $value['tid'];				
				$rank += 2;

				// 真人秀
				if (!empty($value['cpxh'])) {
					$showNum++;
					$rank += 5;
				}
				
				// 精华
				if (!empty($value['digest'])) {
					$digestNum++;
					$rank += 20;
				}
				$rank += (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_poststick')." WHERE `tid` = '{$value['tid']}'");
			}
			if ($username == '') {
				continue;
			}

			$priceNum = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_price')." WHERE `uid` = '$uid' AND isdelete=0");
			$rank += $priceNum;

			DB::query("REPLACE INTO ".DB::table('plugin_produce_publishers')
					  ." (uid, username, rank, shareNum, priceNum, showNum, digestNum)"
					  ." VALUES ($uid, '$username', $rank, $shareNum, $priceNum, $showNum, $digestNum)");
		}
	}
	
	/**
	 * event:
	 * 0: 发布分享 +2
	 * 1: 取消分享 -2
	 * 2: 完善价格 +1
	 * 3: 取消完善价格 -1
	 * 4: 设为真人秀 +5
	 * 5: 取消真人秀 -5
	 * 6: 设为精华 +20
	 * 7: 取消精华 -20
	 * 8: 评论置顶 +1
	 * 9: 取消评论置顶 -1
	 */
	function calPublisherRankEvent($uid, $username, $event) {
		if (!$uid || !$username) {
			return;
		}
		if (!DB::result_first('SELECT COUNT(*) FROM '.DB::table('plugin_produce_publishers')." WHERE uid=$uid")) {
			DB::query("INSERT INTO ".DB::table('plugin_produce_publishers')." (uid, username, rank) VALUES ($uid, '$username', 0)");
		}
		$type = $fields = '';
		$rank_incre='';
		switch ($event) {
			case 0:
				$rank_incre = 2;
				$fields = ', shareNum=shareNum+1';
				break;
			case 1:
				$rank_incre = -2;
				$fields = ', shareNum=shareNum-1';
				break;
			case 2:
				$rank_incre = 1;
				$fields = ', priceNum=priceNum+1';
				break;
			case 3:
				$rank_incre = -1;
				$fields = ', priceNum=priceNum-1';
				break;
			case 4:
				$rank_incre = 5;
				$fields = ', showNum=showNum+1';
				break;
			case 5: 
				$rank_incre = -5;
				$fields = ', showNum=showNum-1';
				break;
			case 6:
				$rank_incre = 20;
				$fields = ', digestNum=digestNum+1';
				break;
			case 7:
				$rank_incre = -20;
				$fields = ', digestNum=digestNum-1';
				break;
			case 8:
				$rank_incre = 1;
				break;
			case 9:
				$rank_incre = -1;
				break;
			default:
				return;
				break;
		}
		DB::query("UPDATE ".DB::table('plugin_produce_publishers')." SET rank=rank+($rank_incre){$fields} WHERE uid=$uid");
	}
	
	
	function getMemberState($uid){
		if($uid){
			$post = DB::fetch_first("select * from ".DB::table('common_session')." where uid=$uid");
			return $post;
		}
	}
	//判断用户是否在线
	function getOnlineState($uid){
		if($uid){
			global $_G;
			$state="";
			$user=self::getMemberState($uid);
			if ($_G['setting']['vtonlinestatus'] && $uid){
				if (($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors'][$uid]) || ($_G['setting']['vtonlinestatus'] == 1 && (TIMESTAMP - $user['lastactivity'] <= 10800) && !$user['authorinvisible'])){
					$state='<img class="vm" title="在线" alt="online" src="static/image/common/ol.gif">';
				}else{
					$state='<img class="vm" title="离线" alt="online" src="static/image/common/out.jpg">';
				}			
			}
			return $state;
		}
	}
		
	//在装备详细页调用你可能喜欢的装备（瀑布流形式调用）
	function getYoumayLike($cplx,$limit=30){		
		return ;
		if($cplx){
            /*引入附件服务器*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*结束*/
			$sql ="SELECT i.cptp,i.serverid, i.cpjg, i.cpxh, i.index_height, t.* FROM ".DB::table('plugin_produce_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid				  
				   WHERE i.isshow=1 and i.type = 0 and i.cplx={$cplx} order by t.lastpost desc limit 0,$limit";				   
			/*	   $sql ="SELECT i.cptp, i.cpjg, i.cpxh, i.index_height, t.*, p.message FROM ".DB::table('plugin_produce_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
				   LEFT JOIN ".DB::table('forum_post')." as p ON t.tid = p.tid
				   WHERE i.isshow=1 and i.type = 0 and p.first=1 and i.cplx={$cplx} order by t.lastpost desc limit 0,$limit";	 */  
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {								
				if($value['tid']){
					$str = "select * from ".DB::table('forum_post')." where `first`=1 and tid=$value[tid] limit 1";
					$post = DB::fetch_first($str);
					if($post){
						$value['message'] = $post['message'];
						$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
						$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
						$value['message'] = discuzcode($value['message']);
						$value['message'] = str_replace('　','',$value['message']);	
						$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
						$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
						$value['message'] = trim($value['message']);
						$value['message'] = messagecutstr($value['message'],100);					
					}			
				}	
				$value['sharenum'] =  ForumOptionProduce::getShareNumbers($value['authorid']);
				$value['state'] = ForumOptionProduce::getOnlineState($value['authorid']);			
				$array[] = array(
					'tid' => $value['tid'],
					'cptp' => ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'],
					'cpjg' => (float)$value['cpjg'],
					'cpxh' => $value['cpxh'],
					'digest' => $value['digest'],
					'authorid' => $value['authorid'],
					'avatar' => avatar($value['authorid'], 'small'),
					'author' => $value['author'],
					'subject' => $value['subject'],
					'dateline' => date('Y-m-d H:i', $value['dateline']),
					'message' => $value['message'],
					'views' => $value['views'],
					'replies' => $value['replies'],
					'index_img_height' => $value['index_height'],
					'sharenum' => $value['sharenum'],
					'state'=>$value['state']
				);			
			}		
			return $array;
		}
	}
	
	//添加分值的的操作记录
	function addOptionRecord($uid,$uname,$action,$score,$tid){
		if(!empty($uid)&&!empty($uname)&&!empty($action)&&!empty($score)&&!empty($tid)){
			$t=time();
			DB::query("insert into ".DB::table('plugin_produce_oprecord')." values(null,$uid,'$uname','$action',$score,$tid,$t)");
		}
	}
	
	//单个帖子的操作记录
	function getRecordByTid($tid){
		if($tid){
			$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_oprecord')." WHERE tid = $tid");
			$list = array();
			while ($value = DB::fetch($query)) {
				$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
				$list[] = $value;
			}
			return $list;
		}
	}
		
	//查询单个类别下的产品信息
	function getProduceInfobytypeId($typeid){
		if($typeid){			
			$sql ="SELECT * FROM ".DB::table('plugin_produce_info')." WHERE cpdl={$typeid} ORDER BY id DESC";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {			
				$cp[] = $value;
							
			}	
			return $cp;			
		}		
	}
		
	function getRelationTid($tid){
		if($tid){			
			$sql ="SELECT childId FROM ".DB::table('plugin_produce_relation')." WHERE parentId={$tid} ORDER BY parentId DESC";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {			
				$array[] = $value['childId'];
			}			
			if($array){			
				$arr=implode(',',$array);				
				$sql ="SELECT tid,cpdl,cpmc FROM ".DB::table('plugin_produce_info')." where type = 0 and tid in ({$arr}) ORDER BY tid DESC";				   
				$query = DB::query($sql);
				while ($value = DB::fetch($query)) {			
					$cp[] = $value;
				}
			}
			return $cp;
		}		
	}
		
	//你可能喜欢的装备
	function getYouMayLikeZb($tid){
		return ;
		if($tid){
			$sql = "select * from ".DB::table('plugin_produce_info')." as i 			        
				    WHERE i.isshow=1 and i.type = 0 and i.tid < $tid order by i.id desc limit 8";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {			
				$cp[] = $value;
			}
			return $cp;
		}
	}
	//通过ajax调用前台数据
	function getInfoBycpdl($where){
		if($where){			
			$sql ="SELECT r.tid,r.cpmc FROM ".DB::table('plugin_produce_info')." AS r
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
				   WHERE r.isshow=1 and r.isin=1 and type=0 and t.displayorder >= 0 $where order by t.dateline desc";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {								
				$pp[] = array('tid'=>mb_convert_encoding($value['tid'],'UTF-8', 'GBK'),'cpmc'=>mb_convert_encoding($value['cpmc'],'UTF-8', 'GBK')); ;
			}
			return $pp;			
		}
	}
	
	//装备首页调用标签
	function getBqInfoAtzbIndex($bq=2){
		return ;
		//require_once DISCUZ_ROOT.'./source/function/function_post.php'; 		
		$sql = "SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where t.fid = 437 and i.isshow=1 and i.isin=1 and type = $bq order by t.dateline desc limit 5";
		/*if($_GET['sql']==1){
			echo "装备首页专题：".$sql."<br>";
		}*/
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['count'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." WHERE parentId = {$value['tid']}");
			//$value['cpmc'] = messagecutstr($value['cpmc'],16);
			$pp[] = $value;
		}
		return $pp;
	}
	
	//装备专题页列表
	function getBqInfoAtzbList($bq=1){
		return ;
		global $_G;	
		$perpage = $_G['tpp'];
		$page = max(1, intval($_G['gp_page']));
	    $start_limit = ($page - 1) * $perpage;
		$sql = "SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where t.fid = 437 and i.isshow=1 and type = $bq order by t.dateline desc limit ".$start_limit.",$perpage";
		//echo $sql;exit;
		/*if($_GET['sql']==1){
			echo "装备专题列表：".$sql."<br>";
		}	*/	
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['count'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." WHERE parentId = {$value['tid']}");			
			$pp[] = $value;
		}
		return $pp;
	}
	
	//装备首页调用标签列表图
	function getBqImageAtzbIndex($parentId){	
		return ;	
		$sql = "SELECT * FROM  ".DB::table('plugin_produce_relation')." where parentId =$parentId limit 9";
		/*if($_GET['sql']==1){
			echo "装备首页专题列表：".$sql."<br>";
		}*/
		$query=DB::query($sql);
		while ($value = DB::fetch($query)) {
			$array[] = $value['childId'];	
		}
        /*引入附件服务器*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomaininfo = $attachserver->get_server_domain('all','*');
        /*结束*/
		$tids=implode(',',$array);		
		if($tids){
			$str = "SELECT * FROM ".DB::table('plugin_produce_info')." where isshow=1 and type=0 and tid in($tids) order by id limit 9";
			$query=DB::query($str);
		    if(!is_dir("./data/attachment/plugin/thumb/")) @mkdir("./data/attachment/plugin/thumb/");	
			while ($value = DB::fetch($query)) {
                $mc=strtr($value['cptp'],"/",".");	
				$cptp="data/attachment/plugin/".$value['cptp'];
                $thumbdir="plugin/thumb/".$mc;
                if($value['serverid']>0){
                    $thumbfile = "http://".$alldomaininfo[$value['serverid']]['name']."/".$thumbdir;
                    if($fp = fopen($thumbfile) === false){
                        $attachserver->Thumb($alldomaininfo[$value['serverid']]['domain'] , $alldomaininfo[$value['serverid']]['api'] , 'plugin/'.$value['cptp'] , $thumbdir , 70 , 70 , 2);
                    }
                    $value['cptp'] = $thumbfile;
                }else{
    				if(!file_exists($thumbdir)){
    					$resizeimage1 = new resizeimage($cptp, "70", "70", "1","./data/attachment/".$thumbdir);
    				}			
    				$value['cptp'] = $_G['setting']['attachurl']."plugin/thumb/".$mc;
                }	
				$arr[] = $value;			
			}			
			return $arr;
		}		
	}	
	
	//查询论坛top100
	function getBBSTop100($filter='t.heats',$dateline=7){
		if($filter&&$dateline){			
			if($dateline=='all'){
				$dt = '';
			}else{
				$dateline = time()-$dateline*3600*24;
				$dt = ' and t.dateline >='.$dateline;
			}
			$str = "select t.tid,t.subject,t.dateline,t.author,t.authorid,t.replies,t.views,t.lastposter,t.lastpost,t.heats,t.fid,t.typeid,p.message,c.name from ".DB::table('forum_thread')." as t
					LEFT JOIN ".DB::table('forum_post')." as p on t.tid = p.tid
					LEFT JOIN ".DB::table('forum_threadclass')." as c on t.typeid = c.typeid
			        where p.first=1 and t.displayorder >= 0 and t.closed=0 and t.fid in (12,69,66,58,161,5,52,39,56,146,42,440,185,68,24,135,88,179,186,178,447,408,7,437,158,101,166,113,110,112,108,176,117,104,106,164,114,159,116,109,111,115,170,143,177,103,165,107,48,105,171,139,100,102,147) $dt order by $filter desc limit 0,100 " . getSlaveID();

			require_once DISCUZ_ROOT.'./source/function/function_post.php';
			require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";  
			$query = DB::query($str);
			while ($value = DB::fetch($query)) {
				$value['dateline'] = date('Y-m-d', $value['dateline']);
				$value['lastpost'] = date('Y-m-d', $value['lastpost']);
				$value['avatar'] = avatar($value['authorid'], 'middle');	
				if($value['tid']==1257194){
					$value['message'] = preg_replace("/<(\/?font.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(font.*?)>(.*?)<(\/font.*?)>/si","",$value['message']); //过滤title标签
					$value['message'] = preg_replace("/<(\/?span.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(span.*?)>(.*?)<(\/span.*?)>/si","",$value['message']); //过滤title标签
					$value['message'] = preg_replace("/<(\/?br.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(\/?img.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(\/?embed.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<table.*>[^{]*?<\/table>/sm","",$value['message']);					
				}else{					
					$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
					$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
					$value['message'] = discuzcode($value['message']);
					$value['message'] = str_replace('　','',$value['message']);	
					$value['message'] = preg_replace('/(&nbsp;)+/', '', $value['message']);
					$value['message'] = preg_replace('/^(&nbsp;)*(.*?)(&nbsp;)*$/', '\2', $value['message']);
				}	
				$value['message'] = trim($value['message']);
				$value['message'] = messagecutstr($value['message'],300);		
				$array[] = $value; 
			}
			//print_r($array);exit;
			return $array;
		}
	}

	/**
     * 缓存所有ID对应用户名
	 * by JiangHong 2012-12-07
     */
    function cache_getUsernamebyUid($arr_uid){
        require_once libfile('class/myredis');
        $redis = & myredis::instance(6378);
        $str_uid = '';
        $first = ($redis->obj->exists("usernamebyid")) ? false : true;
        $incache = $redis->obj->hmget("usernamebyid",$arr_uid);
        foreach($incache as $key=>$value){
            $key = substr($key,7);            
            if(empty($value)){
                $str_uid .= ",".$key;
            }else{
                $result[$key] = $value;
            }
        }
        if(!empty($str_uid)){
            $query = DB::query("select uid,username from ".DB::table('common_member')." where uid in(0{$str_uid})");
            while($values = DB::fetch($query)){
                $needcache["userid:".$values['uid']] = $values['username'];
                $result[$values['uid']] = $values['username'];
            }
            $redis->obj->hmset("usernamebyid",$needcache);
        }
        if($first) $redis->obj->expire("usernamebyid",3600*24*7);
        return $result;
    }
    /**
     * 缓存所有加入推荐的装备分享入redis，并随机调取
     * @author JiangHong
     */
    function getAllproduceRandbyNum($num=10){
        global $_G;
        require_once libfile('class/myredis');
        $redis = & myredis::instance(6378);
        if($_G['uid']==1 || $redis->obj->exists('produce_rand_in_list_info|set')===false){
            $redis->obj->expire('produce_rand_in_list_info|set' ,0);
            $q = DB::query("SELECT id,tid,cpmc,index_height,cptp,serverid FROM ".DB::table('plugin_produce_info')." WHERE isin=1 and isshow=1 and type=0");
            require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            while($v = DB::fetch($q)){
                $redis->obj->sAdd('produce_rand_in_list_info|set' ,$v['tid']);
                $v['cptp'] = ($v['serverid'] > 0 ? "http://{$alldomain[$v['serverid']]}/" : "/data/attachment/").'plugin/'.$v['cptp'];
                $arr['image'] = $v['index_height'] > 100 ? $v['cptp'].'.thumb100.jpg':$v['cptp'];
                $arr['tid'] = $v['tid'];
                $arr['title'] = $v['cpmc'];
                $arr['url'] = $_G['config']['web']['portal'].'/zb-'.$v['tid'];
                $redis->obj->hMset('produce_rand_in_list_info_id_'.$v['tid'].'|hash' ,$arr);
                $redis->obj->expire('produce_rand_in_list_info|set' ,3600*12);
                $redis->obj->expire('produce_rand_in_list_info_id_'.$v['tid'].'|hash' ,3600*12);
            }
        }
        $num = intval($num);
        $allcount = $redis->obj->sCard('produce_rand_in_list_info|set');
        $num = $allcount > $num ? $num : ($allcount - $allcount%2);
        $i = $tmp = 0;
        $return = $array = array();
        if($num > 0){
            while($i < $num){
                $tmp = $redis->obj->sRandMember('produce_rand_in_list_info|set');
                if(in_array($tmp ,$array)) continue;
                $array[] = $tmp;$i++;$return[] = $redis->obj->hGetAll('produce_rand_in_list_info_id_'.$tmp.'|hash');
            }
        }
        return $return;
    }
}