<?php

require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/resizeimage.php';

class ForumOptionProduce {		
	/***
	*  ���ǰ̨��Ʒ���������б�
	*/
	function getTypeData($limit=null) {
		//��Ҫ�ӻ���
        $limit = $limit==null ? 'no':$limit;
        $arr = memory('get' ,'produce_type_qtdl_tshow_'.$limit);
        if(!$arr){
    		$str = "SELECT * FROM ".DB::table('plugin_produce_type')." WHERE tparent = 0 and tshow = 1 ORDER BY id ASC";
    		/*if($_GET['sql']==1){			
    			echo "ǰ̨��Ʒ���������б�".$str."<br>";
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
	*  ���ǰ̨��ƷС�������б�
	*/
	function getTypeNextData($id=0) {	
	    $arr=array();	
		$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_type')." WHERE tparent = '{$id}' and tshow = 1 ORDER BY id ASC");							
		while ($row = DB::fetch($query)) {			
			$arr[] = array('id'=>mb_convert_encoding($row['id'],'UTF-8', 'GBK'),'title'=>mb_convert_encoding($row['tname'],'UTF-8', 'GBK')); 				
		}	
		return $arr;
	}
	/** ������ͬ����ò�ƷС��ķ������༭��ǰ̨����ʱ�õ��� **/
	function getTypeNextDatas($id=0) {
		//��Ҫ�ӻ���
		$arr=memory('get' ,'produce_type_nextdatas');
        if(!$arr){
            $str = "SELECT * FROM ".DB::table('plugin_produce_type')." WHERE tshow = 1 ORDER BY id ASC";
    		/*if($_GET['sql']==1){			
    			echo "ǰ̨��Ʒ���ķ������ã�".$str."<br>";
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
		//��Ҫ�ӻ���&&���߼�
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
    			echo "��ñ�����Ϣ�ķ�����".$str."<br>";
    		}*/
            if($_G['uid']==1) memory('rm' ,'cache_brandcount');
            $arr = memory('get' ,'cache_brandcount');
            if(!$arr){
        		$sq="select count(*) as count,cppp from ".DB::table('plugin_produce_info')." group by cppp";
        		/*if($_GET['sql']==1){			
        			echo "��ø���������".$sq."<br>";
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
	* ���ǰ̨Ʒ�����������б�
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
	

	
	
	//��ʾ����Ʒ���б�ҳ��ʾ
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
	* ���ǰ̨Ʒ�����ݣ���Ʒ������ʾ(����ͼ��)
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
			echo "������ѯƷ�ƣ�".$sql."<br>";
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
	* ���ǰ̨Ʒ�����ݣ���Ʒ������ʾ(����ͼ��)
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
	* ���ǰ̨Ʒ�����ݣ��ڲ˵�����ʾ(����ҳ����ʾ)
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
	* ���ǰ̨Ʒ�����ݣ����Ƽ�����ʾ(����ҳ����ʾ)
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
	*  ���ݱ�Ų�ѯ������Ʒ��Ϣ���ڱ༭��Ʒ��Ϣʱ�õ���
	*/	
	function getProduceInfo($tid ,$pic=0) {
        global $_G;
		if($tid){
			$query = DB::fetch_first("SELECT i.*,t.digest,t.displayorder FROM ".DB::table('plugin_produce_info')." as i LEFT JOIN ".DB::table('forum_thread')." as t on i.tid=t.tid WHERE i.tid='{$tid}'");
            /*���븽��������*/
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
			//��Ҫ���߼�&&��ʱ�ر�
			//$query['count'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." where parentId=$tid");
			return $query;	
		}	   	
	}
	
	/***
	*   ��ò�Ʒ�б� һ�� ����ҳ�����
	*/
	function getProductList($condition, $orderby='t.dateline desc', $limit='0,20') {
		//��Ҫ�Ż�&&�Ƽ�ʱ�䵹��&&�ӻ���1Сʱ&&ȡ��������ֵ����ȱ�־λ
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
			echo "���һ������Ϣ�б�����".$sql."<br>";
		}	*/
        /*���븽��������*/
        $sql .= " ORDER BY t.dateline DESC LIMIT ".$limit;
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*����*/
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
					$value['message'] = str_replace('��','',$value['message']);	
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
		//��Ҫ���߼�
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
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/
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
	  
	//�������
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
	//����(װ������)
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
	
	
	//����װ����ҳ��ajax����
	function getAjaxInfo($limit,$offset){
		$sql = "SELECT i.cptp, i.serverid, i.cpjg, i.cpxh, i.index_height, i.rank, t.* FROM ".DB::table('plugin_produce_info')." AS i"
		." LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid"		
		." WHERE i.isshow=1 AND i.type = 0 and i.isin = 1 "
		." ORDER BY t.dateline DESC"
		." LIMIT {$limit} OFFSET {$offset}";
		$products = array();
        /*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*����*/
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
					$value['message'] = str_replace('��','',$value['message']);	
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
		//��Ҫ�Ż�&&�Ƽ�ʱ�䵹��&&�ӻ���1Сʱ
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
			echo "���װ����ҳ�б�".$sql."<br>";
		}	*/
		/*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*����*/
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
					$value['message'] = str_replace('��','',$value['message']);	
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
	
	// ��ø��˿ռ��װ����������
	function getProduceAtHome($limit='0,20',$uid) {
		//��Ҫ�ӻ���
		$array = array();
		$sql = "SELECT r.cptp, r.serverid, r.cpxh,t.* FROM ".DB::table('plugin_produce_info')." AS r
			   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			   where t.fid=437 AND t.authorid={$uid} AND r.isshow=1 AND r.type = 0 ORDER BY t.dateline desc";
		if ($limit) {
			$sql .= " LIMIT {$limit}";
		}
        /*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*����*/		
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['dateline'] = date('Y-m-d H:i', $value['dateline']);
            $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];				
			$array[] = $value;
		}
		return $array;
	}
	
	//ajax���ö�̬�ڿռ�չʾ��Ϣ
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
        /*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*����*/		
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
	*���Ʒ���б�ͼƬ
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
	*  ���ݲ�Ʒ���Ͳ�ѯ��Ʒ����(����ҳ��ʾ)
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
	*  ���ݲ�Ʒ���Ͳ�ѯ��صĲ�Ʒ����
	*/
	function getProduceCount() {
		/*$sql="SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." AS r
			  LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
			  left join ".DB::table('forum_post')." as p ON t.tid=p.tid
			  WHERE r.isshow=1 and r.type=0 and t.displayorder >= 0 AND t.closed = 0 and p.first=1 
			  ORDER BY t.dateline";*/
		$sql = "SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." where isshow=1 and isin=1 and type=0";			  
		/*if($_GET['sql']==1){			
			echo "װ����ҳ��ѯ�ܸ�����".$sql."<br>";
		}		*/		
	  	$tcount = DB::fetch_first($sql);
		return $tcount;		
	}
	//��ѯ��������
	function getDigestCount(){
		return ;
		  $sql="SELECT count(i.tid) as count FROM ".DB::table('plugin_produce_info')." AS i LEFT JOIN pre_forum_thread AS t ON i.tid = t.tid LEFT JOIN pre_forum_post as p ON t.tid = p.tid WHERE i.isshow=1 and i.type=0 and p.first=1 AND t.digest = 1";
		  $tcount = DB::fetch_first($sql);
		  return $tcount;
	}
	//��ѯ������ĸ���
	function getZhenrenxiuCount(){
		return ;
		  $sql="SELECT count(i.tid) as count FROM ".DB::table('plugin_produce_info')." AS i LEFT JOIN pre_forum_thread AS t ON i.tid = t.tid LEFT JOIN pre_forum_post as p ON t.tid = p.tid WHERE i.isshow=1 and i.type=0 and p.first=1 AND i.cpxh = 1";
		  $tcount = DB::fetch_first($sql);
		  return $tcount;
	}
	//��ѯֵ�ù���ĸ���
	function getIsworthCount(){
		return ;
		  $sql="SELECT count(i.tid) as count FROM ".DB::table('plugin_produce_info')." AS i LEFT JOIN pre_forum_thread AS t ON i.tid = t.tid LEFT JOIN pre_forum_post as p ON t.tid = p.tid WHERE i.isshow=1 and i.type=0 and p.first=1 AND i.isworth = 1";
		  $tcount = DB::fetch_first($sql);
		  return $tcount;
	}
	
	/**
	*  ���ݲ�ƷƷ�Ʋ�ѯ��Ʒ����(����ҳ��ʾ)
	*/
	function getCountbybId($bid) {			
		$tcount = DB::result_first("SELECT count(*) as count FROM ".DB::table('plugin_produce_info')." WHERE isshow=1 and isin=1 and `type`=0 and cppp={$bid}");
		return $tcount;		
	}
	
	/**
	*  ���ݲ�Ʒ���ͺ�Ʒ�Ʋ�ѯ��Ʒ����
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
        /*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomain = $attachserver->get_server_domain('all');
        /*����*/
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
	*   ���ݲ�Ʒ����Ų�ѯ��ص�Ʒ��
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
    			echo "��Ʒ����ѯ���Ʒ�ƣ�".$str."<br>";
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
			 echo "Ʒ����Ϣ��".$sql."<br>";
			}	*/
			$query = DB::query($sql);
			$array = array();			
		    $sq="select count(*) as count,cppp from ".DB::table('plugin_produce_info')." where $where group by cppp";
			/*if($_GET['sql']==1){			
				echo "��ø���������".$sq."<br>";
			}*/
			$querys = DB::query($sq);
			while ($values = DB::fetch($querys)) {
				$arrs[$values['cppp']]= $values['count'];
			}	
			while ($value = DB::fetch($query)) {
				/*$stt = "select count(*) from ".DB::table('plugin_produce_info')." where $where and cppp={$value['tid']}";
				if($_GET['sql']==1){
					echo "��ѯ������".$stt;
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
	*  ���ݲ�ƷƷ�ƻ�ò�Ʒ������Ϣ
	*/
	function getTypeInfobybrId($bid) {
		$sql = "select cpdl from ".DB::table('plugin_produce_info')." where cppp={$bid}";
		/*if($_GET['sql']==1){
			echo "��ƷƷ�ƻ�ò�Ʒ����:".$sql."<br>";
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
	*  ���ݲ�ƷƷ�ƺͲ�Ʒ�����ѯ���ڵĲ�ƷС��
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
	*   ���ݲ�Ʒ��Ų�ѯ��Ʒ����
	*/
	function getPoduceTypeBytId($id) {
	   if($id==null||empty($id)){
		return null;   
	   }
	   $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$id");	  
	   return $pord;	   	
	}
	
	/***
	 *  ��ѯ������Ϣͨ�����ӱ��
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
	
	
	//��õ�ǰλ��
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
	
	//��õ�ǰλ��2(����seo�Ż�)
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
	* ���title��Ϣ
	*/
	function getTitlebyType($type) {
	    $pord = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$type");
	    $string = $pord;
	    return $string;
	}
	
	/***
	*   ���ݲ�Ʒ��Ų�ѯ��ƷƷ����Ϣ
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
	*  ��õ�ǰװ������ ���ͷͼ�����⡢��ֹʱ�䡢��������(һ��ҳ�����)
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
	*  ��ҳ������Ϣ���ã���ö�����Ϣ���б�
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
	*  ��ҳ���鱨��ĵ���
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
	*  ������Ѷ(һ��ҳ����)
	*/
	function getZbzx(){
		$query =  DB::query("SELECT * FROM ".DB::table('common_block_item')." WHERE bid=279 ORDER BY displayorder");
		while($value =  DB::fetch($query)){
			$zbzx[] = $value;
		}
		return $zbzx;
	}
	
	
	//��ò�Ʒ���͵�����
	function getProduceLx($typeid) {
	    $ptype = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_type')." 
							WHERE tshow=1 and id=$typeid");	
	    return $ptype;
	}
	
	/***
	*  ����Ʒ�Ʊ�Ż��Ʒ�����ƣ�����ҳ����ã�
	*/
	function getProduceBarndbyId($bid){
		return;
		$brand = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_brand')." 
							WHERE id=$bid");	
	    return $brand;		
	}
	
	/***
	*  ����Ʒ�����Ʋ�ѯ ��Ʒ���µ�������Ʒ��Ϣ������ҳ����ã�
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
	*  ���ݲ�Ʒ���Ͳ�ѯ�˲�Ʒ�µ�������Ʒ��Ϣ������ҳ����ã�
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
	*  ������ڵĲ�Ʒ������Ϣ(����ҳ�����)
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
	*  ɾ����Ʒ��Ϣ
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
	
	// ɾ������ʱɾ��ͼƬ��Ϣ
	function deleteProduceImage($condition) {
        /*��ȡ���еĸ�����������Ϣ*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $serverinfo = $attachserver->get_server_domain('all',"*");
        /*����*/
        $query = DB::query("select * FROM ".DB::table('plugin_produce_info')." WHERE $condition");
	    while ($value = DB::fetch($query)) {
            /*�������ж��Ƿ�Ϊ������������ͼƬ����ɾ��*/
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
	
	//�༭����ʱ�����ڱ༭����ɾ������ʱ������ϴ���ͼƬɾ����ǰ��ͼƬ��
	function deletImageByEdit($tid) {
		$produce = DB::fetch_first("select * FROM ".DB::table('plugin_produce_info')." WHERE tid={$tid}");
		if($produce){
            /*��ȡ���еĸ�����������Ϣ*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $serverinfo = $attachserver->get_server_domain('all',"*");
            /*����*/
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
	
	//ɾ������
	function deletProduceInfoBytid($tid){
		if($tid){			
			$ralate = DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE tid={$tid}");			
		}
	}	
	
		
	/****
	*  ��װ�����ۣ�����ҳ����ã�
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
	*  ������Ѷ���ã�����ҳ����ã�
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
	
	//�û������������Ʒ(����)
	function getProduceOtherShare($tid,$uid) {
		return ;
		if($tid&&$uid){
			$sql ="SELECT r.tid,r.cptp,r.serverid FROM ".DB::table('plugin_produce_info')." AS r
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
				   WHERE t.fid=437 and r.isshow=1 and r.type = 0 and r.tid <> {$tid} and t.authorid={$uid} order by t.dateline desc limit 0,6";
			/*if($_GET['sql']==1){
				echo "�û�����Ĳ�Ʒ��".$sql."<br>";				
			}*/
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$other[] = $value;
			}
			return $other;
		}
	}
	//ͬ�����µĲ�Ʒ
	function getProduceTypelist($tid,$cplx) {
		return ;
		if($tid && $cplx){
			$sql ="SELECT r.tid,r.cptp,r.serverid FROM ".DB::table('plugin_produce_info')." AS r
				   WHERE r.isshow=1 and r.type = 0 and r.tid <>{$tid} and r.cplx={$cplx} order by r.id desc limit 0,4";
			/*if($_GET['sql']==1){
				echo "ͬ�����µĲ�Ʒ��".$sql."<br>";				
			}	*/		
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$zblx[] = $value;
			}
			return $zblx;	
		}		
	}
	//ͬƷ���µĲ�Ʒ
	function getProduceBrandList($tid,$cppp) {
		return ;
		if($tid&&$cppp){
			$sql ="SELECT r.tid,r.cptp,r.serverid FROM ".DB::table('plugin_produce_info')." AS r				
				   WHERE r.isshow=1 and r.type = 0 and r.tid <>{$tid} and r.cppp={$cppp} order by r.id desc limit 0,4";
			/*if($_GET['sql']==1){
				echo "ͬƷ���µĲ�Ʒ��".$sql."<br>";				
			}		*/   
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/
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
	
	//��÷��������()
	function getShareNumber($uid){
		if($uid){
			$sql = "SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." as r LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid WHERE  t.fid=437 AND t.authorid={$uid} AND r.isshow=1 AND r.type=0";
			/*if($_GET['sql']==1){
				echo "����������".$sql."<br>";
			}*/
			$number = DB::result_first($sql);		
			return $number;
		}
	}
	
	//��÷��������(2)
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
				echo "�������ͻ�ø�����".$sql."<br>";
			}*/
			$number = DB::result_first($sql);		
			return $number;
		}
	}
	
	//��ÿ��ܸ���Ȥ����
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
	
	//���ע�����ںͺ��Ѹ���
	function getFriendandRegdate($uid) {
		return ;
		if($uid){
			$sql="select m.regdate,c.friends from ".DB::table('common_member')." as m LEFT JOIN ".DB::table('common_member_count')." as c on m.uid=c.uid where m.uid={$uid}";
			$num = DB::fetch_first($sql);
			$num['regdate']=date('Y-m-d', $num['regdate']);	
			return $num;
		}
	}
	
   //��������õĲ�Ʒ��Ϣ
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
   //���ݲ�Ʒ����Ų�ѯ��Ʒ������Ϣ
   function getLxbyproduce($proLx) {
		if($proLx!=null){
		return $cplx = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_type')." WHERE id ={$proLx}");
		}else{
		return null;	
		}
   }
   
   //���ݲ�Ʒ��������ƺ�Ʒ�Ʋ�ѯ��Ʒ
   /**
   function getProduceListbydlandbr($type,$brand,$tid) {
	    $sql ="SELECT * FROM ".DB::table('plugin_produce_info')." WHERE (cpdl={$type} or cplx={$type}) and cppp={$brand} and tid!={$tid} ORDER BY id DESC limit 6";
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {			
			$pp[] = $value;
		}	
		return $pp;
   }***/
   
	//��õ�ǰ������
	function getFirstTypeByTypeid($typeid){
		if($typeid){
			$type = DB::fetch_first("select * from ".DB::table('plugin_produce_type')." where id=$typeid");
			if ($type['tparent'] == 0) {
				return $typeid;
			}
			return $type['tparent'];
		}
	}
	
	//��÷���ĸ���
	function getShareInfoByspace($uid) {
		return ;
		if($uid){
			$sql="SELECT i.cptp,i.serverid,t.*  FROM ".DB::table('plugin_produce_info')." AS i
				  LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid WHERE t.fid=437 and i.isshow=1 and i.type=0 AND t.displayorder >= 0 and t.authorid={$uid}  order by t.dateline desc limit 4";
			$query = DB::query($sql);
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/            
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$value['dateline'] = date('Y-m-d H:i', $value['dateline']);			
				$pp[] = $value;
			}	
			return $pp;
		}
	}
	

	//Ʒ�ƾ��ֲ��Ķ���ҳ����ø�Ʒ���µ����з�����Ϣ
	function getShareBytId($tid){
		if($tid){
			$array=array();
			$sql="SELECT i.cptp,i.serverid,t.subject,t.tid FROM ".DB::table('plugin_produce_info')." AS i
					LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
					WHERE i.isshow=1 and isin=1 and i.type=0 AND t.displayorder >= 0 AND t.closed = 0 AND i.cppp=$tid
					ORDER BY t.dateline DESC Limit 0,45";			
			$query=DB::query($sql);
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/
			while ($value = DB::fetch($query)) {
                $value['cptp'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/plugin/" : "/data/attachment/plugin/").$value['cptp'];
				$array[] = $value;
			}	
			return $array;
		}
	}
	
	//Ʒ�ƾ��ֲ�����װ������
	function getShareNumberAtBrand($tid){
		if($tid){
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." WHERE cppp={$tid}");
		}
	}
		
	//�ڲ�Ʒ��ϸҳ��ȡ��Ʒ��ר�����ķ���
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
	
	//װ��������ҳ���� װ��������Ϣ
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
	
	//װ����ҳװ������ͼƬ�б�
	function getPiclist($tids){
		return ;
		$arr=array();
		$sql="SELECT cptp,tid,serverid FROM ".DB::table('plugin_produce_info')." 
			  WHERE tid in($tids) limit 6";			
		$query=DB::query($sql);
        /*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomaininfo = $attachserver->get_server_domain('all','*');
        /*����*/
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
	��������
	�շ���ʱ0�֣�������+5�֣�������15�֣�
	������������N�Ļ����������������������ͼƬ��ÿ��+1�֣����۱��ö��ļ�2�֣�
	ÿ���۸������Ϣ�ļ�2�� Ȼ�������ֵ�ӷ���֮����ÿ����1��
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
			// ������
			if ($value['cpxh'] == 1) {
				$rank += 20;
			}
			// ����
			if ($value['digest'] == 1) {
				$rank += 70;
			}			
			$rank += 10 * (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_price')." WHERE `tid` = '{$value['tid']}' AND isdelete=0");
			$rank += 5 * (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_poststick')." WHERE `tid` = '{$value['tid']}'"); // �����ö�
			$commentnum = (int)DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_post')." WHERE `tid` = '{$value['tid']}'") - 1; //������
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
	 * 0: �·���
	 * 1: ��Ϊ������
	 * 2: ȡ��������
	 * 3: ��Ϊ����
	 * 4: ȡ������
	 * 5: ���Ƽ۸�
	 * 6: ȡ�����Ƽ۸�
	 * 7: ÿ���40
	 * 8: �����ö� +2
	 * 9: ȡ�������ö� -2
	 * 10: ������ +1
	 * 11: ɾ������ -1
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
	װ������
	װ����������������װ�������׶ȼ��㣩
	���׶ȵļ�����ȫ����
	�ڶ��������£���������+2�����Ƽ۸�+1��������+5������+20
	*/
	function calPublisherRank($uid=NULL) {
		return ;
		if (!empty($uid)) {
			$uids = array($uid);
		} else {
			// �����û�
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

				// ������
				if (!empty($value['cpxh'])) {
					$showNum++;
					$rank += 5;
				}
				
				// ����
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
	 * 0: �������� +2
	 * 1: ȡ������ -2
	 * 2: ���Ƽ۸� +1
	 * 3: ȡ�����Ƽ۸� -1
	 * 4: ��Ϊ������ +5
	 * 5: ȡ�������� -5
	 * 6: ��Ϊ���� +20
	 * 7: ȡ������ -20
	 * 8: �����ö� +1
	 * 9: ȡ�������ö� -1
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
	//�ж��û��Ƿ�����
	function getOnlineState($uid){
		if($uid){
			global $_G;
			$state="";
			$user=self::getMemberState($uid);
			if ($_G['setting']['vtonlinestatus'] && $uid){
				if (($_G['setting']['vtonlinestatus'] == 2 && $_G['forum_onlineauthors'][$uid]) || ($_G['setting']['vtonlinestatus'] == 1 && (TIMESTAMP - $user['lastactivity'] <= 10800) && !$user['authorinvisible'])){
					$state='<img class="vm" title="����" alt="online" src="static/image/common/ol.gif">';
				}else{
					$state='<img class="vm" title="����" alt="online" src="static/image/common/out.jpg">';
				}			
			}
			return $state;
		}
	}
		
	//��װ����ϸҳ���������ϲ����װ�����ٲ�����ʽ���ã�
	function getYoumayLike($cplx,$limit=30){		
		return ;
		if($cplx){
            /*���븽��������*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $alldomain = $attachserver->get_server_domain('all');
            /*����*/
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
						$value['message'] = str_replace('��','',$value['message']);	
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
	
	//��ӷ�ֵ�ĵĲ�����¼
	function addOptionRecord($uid,$uname,$action,$score,$tid){
		if(!empty($uid)&&!empty($uname)&&!empty($action)&&!empty($score)&&!empty($tid)){
			$t=time();
			DB::query("insert into ".DB::table('plugin_produce_oprecord')." values(null,$uid,'$uname','$action',$score,$tid,$t)");
		}
	}
	
	//�������ӵĲ�����¼
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
		
	//��ѯ��������µĲ�Ʒ��Ϣ
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
		
	//�����ϲ����װ��
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
	//ͨ��ajax����ǰ̨����
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
	
	//װ����ҳ���ñ�ǩ
	function getBqInfoAtzbIndex($bq=2){
		return ;
		//require_once DISCUZ_ROOT.'./source/function/function_post.php'; 		
		$sql = "SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where t.fid = 437 and i.isshow=1 and i.isin=1 and type = $bq order by t.dateline desc limit 5";
		/*if($_GET['sql']==1){
			echo "װ����ҳר�⣺".$sql."<br>";
		}*/
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['count'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." WHERE parentId = {$value['tid']}");
			//$value['cpmc'] = messagecutstr($value['cpmc'],16);
			$pp[] = $value;
		}
		return $pp;
	}
	
	//װ��ר��ҳ�б�
	function getBqInfoAtzbList($bq=1){
		return ;
		global $_G;	
		$perpage = $_G['tpp'];
		$page = max(1, intval($_G['gp_page']));
	    $start_limit = ($page - 1) * $perpage;
		$sql = "SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where t.fid = 437 and i.isshow=1 and type = $bq order by t.dateline desc limit ".$start_limit.",$perpage";
		//echo $sql;exit;
		/*if($_GET['sql']==1){
			echo "װ��ר���б�".$sql."<br>";
		}	*/	
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$value['count'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." WHERE parentId = {$value['tid']}");			
			$pp[] = $value;
		}
		return $pp;
	}
	
	//װ����ҳ���ñ�ǩ�б�ͼ
	function getBqImageAtzbIndex($parentId){	
		return ;	
		$sql = "SELECT * FROM  ".DB::table('plugin_produce_relation')." where parentId =$parentId limit 9";
		/*if($_GET['sql']==1){
			echo "װ����ҳר���б�".$sql."<br>";
		}*/
		$query=DB::query($sql);
		while ($value = DB::fetch($query)) {
			$array[] = $value['childId'];	
		}
        /*���븽��������*/
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $alldomaininfo = $attachserver->get_server_domain('all','*');
        /*����*/
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
	
	//��ѯ��̳top100
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
					$value['message'] = preg_replace("/<(font.*?)>(.*?)<(\/font.*?)>/si","",$value['message']); //����title��ǩ
					$value['message'] = preg_replace("/<(\/?span.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(span.*?)>(.*?)<(\/span.*?)>/si","",$value['message']); //����title��ǩ
					$value['message'] = preg_replace("/<(\/?br.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(\/?img.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<(\/?embed.*?)>/si","",$value['message']);
					$value['message'] = preg_replace("/<table.*>[^{]*?<\/table>/sm","",$value['message']);					
				}else{					
					$value['message'] = preg_replace('/\r?\n/', '', $value['message']);
					$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
					$value['message'] = discuzcode($value['message']);
					$value['message'] = str_replace('��','',$value['message']);	
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
     * ��������ID��Ӧ�û���
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
     * �������м����Ƽ���װ��������redis���������ȡ
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