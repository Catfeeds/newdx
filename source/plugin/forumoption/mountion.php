<?php
require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger_config.php';

class ForumOptionMountion {
	
	/*****
	*  获得关键字的方法
	*/
	function getKeyWord() {
		global $_G;
		$keywords = array();
		if ($_G['forum_option']['mingcheng']['value']) {
			$keywords[] = $_G['forum_option']['mingcheng']['value'];
		}
		if ($_G['forum_option']['guanjianzi']['value']) {
			$keywords[] = $_G['forum_option']['guanjianzi']['value'];
		}
		return $keywords;
	}
	
	/*
	 * 返回贴子关联文章
	 */
	function getRalateArticles($keywords) {
		return null;
		$ralateArticles = array();		
		// 关键字数组			
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			/*$sql = "SELECT t.aid, t.title,a.attachment FROM ".DB::table('portal_article_title')." as t
								LEFT JOIN ".DB::table('portal_attachment')." as a
								ON t.aid = a.aid
								WHERE a.isimage=1 and a.attachment!='' and ";*/
			$sql="SELECT aid,title,summary,pic,dateline FROM ".DB::table('portal_article_title')." WHERE  thumb =1 and ";					
			foreach ($keywords as $i => $item) {
				$sql .= "title LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= " GROUP BY aid
					  ORDER BY (CASE WHEN ";
			foreach ($keywords as $i => $item) {
				$sql .= "title LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= " THEN 0 ELSE 1 END), aid DESC
					  LIMIT 10";		  	  
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {				
				$ralateArticles[] = $value;
			}	
						
		}
		//print_r($ralateArticles);exit;
		return $ralateArticles;
	}
	/*
	*  获得山峰的图片信息
	*/
	function getMountionPic($tid){
	  global $_G;
	  $sql="select value from ".DB::table('forum_typeoptionvar')." where tid='".$tid."' and optionid=33 LIMIT 0 , 1";
	  $value = DB::result_first($sql);
	  if($value){
		$value=unserialize($value);
		$aid=$value['aid'];
	  }
	  if($aid){		 
		  $attach=DB::fetch_first("SELECT remote,attachment FROM ".DB::table('forum_attachment')." WHERE aid='{$aid}'");
		  if($attach['remote']){
			   $_G['forum_option']['photo']['value'] = $_G['config']['web']['forum']."forum/".$attach['attachment'];
		  }		  
	  }
	  return $_G['forum_option']['photo']['value'];		
	}
	
	/*
	 * 返回此山峰相关贴子
	 */
	function getRalateZb($keywords) {
		return null;
		$ralate_zt = array();
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT p.authorid, p.tid, p.subject FROM ".DB::table('forum_thread')." as p
								WHERE (p.fid = 24 OR p.fid = 39 or p.fid = 187 OR p.fid = 52 OR p.fid = 56 OR p.fid = 146) AND p.subject != '' AND (";
			foreach ($keywords as $i => $item) {
				$sql .= "p.subject LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= ") ORDER BY (CASE WHEN ";
			foreach ($keywords as $i => $item) {
				$sql .= "p.subject LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= " THEN 0 ELSE 1 END), p.tid DESC
					  LIMIT 10";		
				  
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['avatar'] = avatar($value['authorid'], 'small');
				$ralate_zt[] = $value;
			}
			
		}
		return $ralate_zt;
	}
	 
	/*
	 * 返回相关活动的帖子	
	function getRalateHdty() {
		global $_G;
		$ralate_bbs = array();		
		// 关键字数组
		$keywords = array();
		if ($_G['forum_option']['mingcheng']['value']) {
			$keywords[] = $_G['forum_option']['mingcheng']['value'];
		}	
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT p.authorid, p.tid, p.subject FROM ".DB::table('forum_thread')." as p
								WHERE (p.fid = 161 OR p.fid = 5 or p.fid = 88 OR p.fid = 135 or p.fid = 52) AND p.subject != '' AND
								      (";
			foreach ($keywords as $i => $item) {
				$sql .= "p.subject LIKE '%{$item}%' OR p.message LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= ") ORDER BY (CASE WHEN ";
			foreach ($keywords as $i => $item) {
				$sql .= "p.subject LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= "THEN 0 ELSE 1 END), p.tid DESC
					   LIMIT 10";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['avatar'] = avatar($value['authorid'], 'small');
				$ralate_bbs[] = $value;
			}
		}
		return $ralate_bbs;
	} */
	
    
	
	/*
	 * 返回品牌空间日志
	 */
	function getHomeBlogs() {
		global $_G;
		$home_blogs = array();
		$home_uid = (int)$_G['forum_option']['brand_home_uid']['value'];
		if ($home_uid) {
			$query = DB::query("SELECT b.blogid, b.uid, b.subject FROM ".DB::table('home_blog')." as b
								WHERE b.uid = $home_uid
								ORDER BY b.blogid DESC
								LIMIT 10");
			while ($value = DB::fetch($query)) {
				$home_blogs[] = $value;
			}
		}
		return $home_blogs;
	}
	
	/*
	 * 返回我喜欢头像列表
	 */
	function getLikeitUsers() {
		global $_G;
		$users = array();
		$query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('dianping_brand_users')." AS b
						    LEFT JOIN ".DB::table('common_member')." AS m
						    ON b.uid = m.uid
							WHERE b.tid = {$_G['tid']} AND b.type='likeit'
							ORDER BY b.id DESC
							LIMIT 16");
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['uid'], 'small');
			$users[] = $value;
		}
		return $users;
	}
	
	function loadCacheArray($name) {
		try {			
			global $_G;			
			if($name=='ralateAc'){
				$filename = "fid_{$_G['fid']}";
			}else{			
			    $filename = "tid_{$_G['tid']}";
			}
			$aray_index = "tid_{$_G['tid']}_".$name;
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
				if (time() - 172800 < $cache_item['cacheTime']) {
					return $cache_item['content'];
				}
			}
			
			$item_array = array('cacheTime'=>time());
			switch ($name) {
				case 'homeBlogs':
					$item_array['content'] = self::getHomeBlogs(); break;
				case 'ralateHdty':
					$item_array['content'] = self::getRalateHdty(); break;
				case 'ralateArticles':
					$item_array['content'] = self::getRalateArticles(); break;
				case 'ralateZb':
					$item_array['content'] = self::getRalateZb(); break;
				case 'ralateAc':
					$item_array['content'] = self::getActivityInfo(); break;
				case 'zhuantiAc':
					$item_array['content'] = self::getSfzhuantiInfo(); break;
				case 'ralateHd':
					$item_array['content'] = self::getSfactivity(); break;		
				case 'ralateXc':
					$item_array['content'] = self::getRalateXc(); break;
				case 'test':
					$item_array['content'] = array(123,456,7891); break;
				default:
					$item_array['content'] = array();
			}			
			$cache_array[$aray_index] = $item_array;
			ForumOptionCache::writeCache($filename, $cache_array);
			return $item_array['content'];
		} catch(Exception $e) {
			return array();
		}
	}
	
	
	/*
	*  获得山峰的相关活动信息(山峰列表页调用)
	*/
	function getActivityInfo(){
		return null;
		$activity = array();
		$query = DB::query("SELECT p.subject,a.tid,a.uid FROM ".DB::table('forum_activity')." AS a
						    LEFT JOIN ".DB::table('forum_thread')." AS p
						    ON a.tid = p.tid
							WHERE p.subject like '%攀登%' or p.subject like '%登山%' 
							ORDER BY p.dateline DESC
							LIMIT 6");						
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['uid'], 'small');		
			$activity[] = $value;
		}			
		return $activity;
	}
	
	
	/*
	*  获得山峰的专题信息（山峰列表调用）
	*/
	function getSfzhuantiInfo(){
		return null;
		$zhuanti = array();
		$sql="SELECT aid,title,summary,pic,dateline FROM ".DB::table('portal_article_title')." WHERE (catid=227 or catid=528 or catid=231 or catid=228)  and pic<>'' and thumb =1 ORDER BY dateline DESC LIMIT 8";
		//include_once libfile('function/home');	
		$query = DB::query($sql);						
		while ($value = DB::fetch($query)) {			   
				$zhuanti[] = $value;						
		}					
		return $zhuanti;		
	}
	
	
	
	
	/*
	*  获得单个山峰的相关活动信息（内容页列表调用）
	*/	
	function getSfactivity($keywords){
		return null;
		$ralate_activity = array();		
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT p.tid FROM ".DB::table('forum_post')." as p
					WHERE (p.fid = 5) AND p.subject != '' AND
					(";
			foreach ($keywords as $i => $item) {
				$sql .= "p.subject LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= ") ORDER BY (CASE WHEN ";
			foreach ($keywords as $i => $item) {
				$sql .= "p.subject LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= "THEN 0 ELSE 1 END), p.tid DESC
					   LIMIT 5";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {			
				$ralate_bbs[] = $value['tid'];
			}			
			$tj=implode(",",$ralate_bbs);			
			if($tj){
			    $str="select tid,author,authorid,subject,dateline,views,replies
                from ".DB::table('forum_thread')." 
				where tid in (".$tj.") order by dateline desc limit 5";
				$query = DB::query($str);
		        while ($value = DB::fetch($query)){			
			        $ralate_activity[] = $value;
		        }					
			}else{
				return null;
			}			
		}
		/*
		if($keywords) {			
		$str1="select a.tid from ".DB::table('forum_activity')." as a left join ".DB::table('forum_post')." as p on a.tid = p.tid 
		       where p.subject like '%{$keywords}%' order by p.dateline desc limit 10";
		$str2="select tid from ".DB::table('forum_post')." where fid=5 or fid=161 and subject like '%{$keywords}%' order by dateline desc limit 10";	
		$query1 = DB::query($str1);	
		$query2 = DB::query($str2);			   
		while ($value1 = DB::fetch($query1)) {			
			 $ralate_activity1[] = $value1['tid'];
	    }	
        while ($value2 = DB::fetch($query2)) {			
			 $ralate_activity2[] = $value2['tid'];
	    }
		
		$tj=implode(",",$ralate_activity1);
		$tj2=implode(",",$ralate_activity2);	
		
		if($tj&&$tj2){					
		$sql = "select tid,author,authorid,subject,dateline,views,replies
                from ".DB::table('forum_thread')." 
				where tid in (".$tj.") 
				or tid in (".$tj2.") order by dateline desc limit 5";
		}elseif($tj){
			$sql = "select tid,author,authorid,subject,dateline,views,replies
                from ".DB::table('forum_thread')." 
				where tid in (".$tj.") order by dateline desc limit 5";
		}elseif($tj2){
			$sql = "select tid,author,authorid,subject,dateline,views,replies
                from ".DB::table('forum_thread')." 
				where tid in (".$tj2.") order by dateline desc limit 5";
		}else{
		    $sql="";	
		}
		 $query = DB::query($sql);
		 while ($value = DB::fetch($query)){			
			 $ralate_activity[] = $value;
		 }	
		}*/
		return $ralate_activity;
	}
	
	
	
	
	/*
	 * 返回此山峰相关相册（详细内容页调用）
	 */
	function getRalateXc($keywords) {		
		$ralate_xc = array();					
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT * FROM ".DB::table('home_album')." WHERE  (picflag=1 and friend=0 and ";
			foreach ($keywords as $i => $item) {
				$sql .= "albumname LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= ") ORDER BY (CASE WHEN ";
			foreach ($keywords as $i => $item) {
				$sql .= "albumname LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= " THEN 0 ELSE 1 END),albumid DESC
					  LIMIT 4";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {				
				if($value['friend']!= 4){					
					$value['pic'] ="album/".$value['pic']; 
				}							
				$ralate_xc[$value['albumid']] = $value;
			}		  
		}
		return $ralate_xc;
	}
	
	
	
	/*function loadDataArray($name) {
		switch ($name) {
			case 'homeBlogs':
				return self::getHomeBlogs(); break;
			case 'ralateDzty':
				return self::getRalateDzty(); break;
			case 'ralateArticles':
				return self::getRalateArticles(); break;
			case 'ralateZb':
				return self::getRalateZb(); break;
			case 'ralateAc':
				return self::getActivityInfo(); break;
			case 'test':
				return array(123,456,7891); break;
			default:
				return array();
		}
	}*/
	
	
	/*
	*  得到天气信息
	*/
	function getWeatherInfo($jingdu,$weidu){
	  if(is_numeric($jingdu)&&is_numeric($weidu)){
		$jingdu = number_format($jingdu, 6);
		$weidu = number_format($weidu, 6);
		$jingdu=$jingdu*1000000;
		$weidu=$weidu*1000000;
	  	$content = file_get_contents("http://www.google.com/ig/api?hl=zh-cn&weather=,,,$weidu,$jingdu");	
		$content = mb_convert_encoding($content, 'UTF-8', 'GBK');
		if(stripos($content, 'xml') === false) return;
		$xml = simplexml_load_string($content);

		try {			   
			   if(array($xml)){		
				    if($xml->weather->problem_cause || !$xml->weather->forecast_information){
						return null;
					}
					$date = $xml->weather->forecast_information->forecast_date->attributes();					
					if($date){					
						   $current = $xml->weather->current_conditions;		
						   $condition = $current->condition->attributes();
						   $temp_c = $current->temp_c->attributes();
						   $humidity = $current->humidity->attributes();
						   $icon = $current->icon->attributes();
						   $wind = $current->wind_condition->attributes();
						   $condition && $condition = $xml->weather->forecast_conditions->condition->attributes();
						   $icon && $icon = $xml->weather->forecast_conditions->icon->attributes();	
					   foreach($xml->weather->forecast_conditions as $forecast) {
						   $low = $forecast->low->attributes();
						   $high = $forecast->high->attributes();
						   $icon = $forecast->icon->attributes();
						   $condition = $forecast->condition->attributes();
						   $day_of_week = $forecast->day_of_week->attributes();
						   $html.= "{$day_of_week}   <img src='http://www.google.com{$icon}' width='25px' height='25px'/>    {$condition}    {$high}<sup>o</sup>C/{$low}<sup>o</sup>C  <br />\n";
					   }
				   }else{
						 return null;	
				   }							   
			  }		   
			} catch(Exception $e) {
				return null;
			}	
		}else{
			return null;
		}		
		$html = mb_convert_encoding($html, 'GBK', 'UTF-8');
		return $html;
	}
	
	/*
	*  缓存天气信息
	*/
	function loadWatherInfo($jingdu,$weidu){
		 try {
				global $_G;
				$filename = "tid_{$_G['tid']}";
				$aray_index = "tid_{$_G['tid']}_".$jingdu;
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
					if (time() - 7200 < $cache_item['cacheTime']) {					
						return $cache_item['content'];
					}
				}
				$item_array = array('cacheTime'=>time());				
				$item_array['content'] = self::getWeatherInfo($jingdu,$weidu); 				
				$cache_array[$aray_index] = $item_array;
				ForumOptionCache::writeCache($filename, $cache_array);
				return $item_array['content'];		  
		  }catch(Exception $e){
			  return  array();
		  }
	}	
}



$forumoption_mountion = new CachedataLogger;
$forumoption_mountion->class = 'ForumOptionMountion';
$forumoption_mountion->methods = $CachedateLogger_config['ForumOptionMountion'];
if ($_GET['nocache'] == 1) {
	$forumoption_mountion->forceRefreshCache = true;
}