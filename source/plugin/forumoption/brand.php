<?php
require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger.php';
require_once DISCUZ_ROOT.'./source/plugin/components/CachedataLogger_config.php';

class ForumOptionBrand {
	
	/*
	* ��ùؼ��ַ���
	*/	
	function getKeyword(){
		global $_G;
	    // �ؼ�������
		$keywords = array();
		if ($_G['forum_option']['brand_name']['value'] && $_G['forum_option']['brand_name']['value'] != '��') {
			$keywords[] = addcslashes(trim($_G['forum_option']['brand_name']['value']), "\\'");
		}
		if ($_G['forum_option']['brand_namech']['value'] && $_G['forum_option']['brand_namech']['value'] != '��') {
			$keywords[] = addcslashes(trim($_G['forum_option']['brand_namech']['value']), "\\'");
		}
		return $keywords;	
	}	
	/*
	 * �������ӹ�������
	 */
	function getRalateArticles($keywords) {		
		$ralateArticles = array();		
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			/*2012-06-25 �޸ģ�ȥ������������t����Ѿ�����ʵ��
            $sql = "SELECT t.aid, t.title, t.pic, t.dateline FROM ".DB::table('portal_article_title')." as t
								LEFT JOIN ".DB::table('portal_article_content')." as c
								ON t.aid = c.aid
								WHERE ";*/
			/*					
			foreach ($keywords as $i => $item) {
				$sql .= "c.content LIKE '%{$item}%' OR t.title LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			*/
			/*2012-06-25 �޸ģ�ȥ������������t����Ѿ�����ʵ��
            foreach ($keywords as $i => $item) {
				$sql .= "t.title LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}			
			$sql .= " GROUP BY c.aid
					  ORDER BY (CASE WHEN ";
			foreach ($keywords as $i => $item) {
				$sql .= "t.title LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= " THEN 0 ELSE 1 END), c.aid DESC
					  LIMIT 10";*/
            //����Ϊ2012-06-25 ������ֻ��t��ʵ�ֹ���
            $sql = "SELECT aid, title, pic, dateline FROM ".DB::table('portal_article_title')."	WHERE ";
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
            //����Ϊ2012-06-25 ����
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$ralateArticles[] = $value;
			}
		}
		return $ralateArticles;
	}
	
	
	function getThumb($tid){
	   global $_G;	 
	   $md5=md5($tid);
	   $pic=$_G['config']['web']['attach']."threadpic/100x50/{$md5[0]}{$md5[1]}/{$md5}.jpg";     
	   $_G['forum_option']['brand_logo']['value']=$pic;    
	   return $_G['forum_option']['brand_logo']['value'];
	}
	
	/*
	 * ����װ���������
	 */
	function getRalateZb($keywords) {
		$ralate_zt = array();
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT p.authorid, p.tid, p.subject FROM ".DB::table('forum_post')." as p
								WHERE (p.fid = 7 OR p.fid = 120) AND p.subject != '' AND (";
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
			$sql .= " THEN 0 ELSE 1 END), p.tid DESC
					  LIMIT 8";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['avatar'] = avatar($value['authorid'], 'small');
				$ralate_zt[] = $value;
			}
		}
		return $ralate_zt;
	}
	/*
	 * ���ش�����������
	 */
	function getRalateDzty($keywords) {
		return null;
		$ralate_bbs = array();	
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT p.authorid, p.tid, p.subject FROM ".DB::table('forum_post')." as p
								WHERE (p.fid = 174 OR p.fid = 378) AND p.subject != '' AND
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
					   LIMIT 5";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['avatar'] = avatar($value['authorid'], 'small');
				$ralate_bbs[] = $value;
			}
		}
		return $ralate_bbs;
	}
	
	/*
	 * ����Ʒ�ƿռ���־
	 */
	function getHomeBlogs($homeid) {		
		$home_blogs = array();
		$home_uid = (int)$homeid;
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
	 * ������ϲ��ͷ���б�
	 */
	function getLikeitUsers() {
		global $_G;
		$users = array();
		$query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('dianping_brand_users')." AS b
						    LEFT JOIN ".DB::table('common_member')." AS m
						        ON b.uid = m.uid
							WHERE b.tid = {$_G['tid']} AND b.type='likeit'
							GROUP BY b.uid
							ORDER BY b.id DESC
							LIMIT 20");
		while ($value = DB::fetch($query)) {
			$value['avatar'] = avatar($value['uid'], 'small');
			$users[] = $value;
		}
		return $users;
	}
	
	/*
	 * ������ϲ������
	 */
	function getLikeitUsersNum() {
		global $_G;
		$query = DB::fetch_first("SELECT count(b.id) as num FROM ".DB::table('dianping_brand_users')." AS b
							WHERE b.tid = {$_G['tid']} AND b.type='likeit'");
		
		return $query['num'];
	}
	
	/*
	 * �������ר��
	 * */
	function getRalateTopics($keywords) {	
		$ralateTopics = array();	
		$keywords_num = count($keywords);		
		if ($keywords_num > 0) {
			$sql = "SELECT t.topicid, t.title , t.cover FROM ".DB::table('portal_topic')." as t
					WHERE t.closed = 0 AND (";
			foreach ($keywords as $i => $item) {
				$sql .= "t.title LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= ") ORDER BY t.topicid DESC
					  LIMIT 5";			
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$ralateTopics[] = $value;
			}
		}
		return $ralateTopics;
	}
	
	function getAttractInvestmentIds($tid) {		
		$thread = DB::fetch_first("SELECT b.id, f.* FROM ".DB::table('plugin_threadoption_field')." as f
								  LEFT JOIN ".DB::table('plugin_threadoption')." as b
									ON b.id = f.optionid
								  WHERE b.tid = {$tid} AND f.name = 'zhaoshang' LIMIT 1");
		
		if ($thread)
			return $thread['value'];
		return '';
	}
	
	/*
	* ���ش�ɽ�������ᣨ��ϸ����ҳ���ã�
	*/
	function getRalatePhotos($keywords) {
		return null;
		$ralate_photos = array();			
		$keywords_num = count($keywords);
		if ($keywords_num > 0) {
			$sql = "SELECT * FROM ".DB::table('home_album')." WHERE  (friend=0 and ";
			foreach ($keywords as $i => $item) {
				$sql .= "albumname LIKE '%{$item}%'";
				if ($i < $keywords_num - 1) {
					$sql .= " OR ";
				}
			}
			$sql .= ") ORDER BY (CASE WHEN albumname LIKE '%{$keywords[0]}%'
					   THEN 0 ELSE 1 END),albumid DESC
					   LIMIT 4";
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				if($value['friend']!= 4){
					$value['pic'] ="album/".$value['pic'];
				}
				$ralate_photos[$value['albumid']] = $value;
			}
		}
		return $ralate_photos;
	}
	
	
	
	
	
	
	/*************
	 *  �·�����ʼ
	 */
	
	/**
	 * Ʒ������ĸ��ȡ
	 */
	function getLetterbyIndex($id=0) {		
	    $arr=array();	
		$arr=array("1"=>"A","2"=>"B","3"=>"C","4"=>"D","5"=>"E","6"=>"F","7"=>"G","8"=>"H","9"=>"I","10"=>"J","11"=>"K","12"=>"L","13"=>"M","14"=>"N","15"=>"O","16"=>"P","17"=>"Q","18"=>"R","19"=>"S","20"=>"T","21"=>"U","22"=>"V","23"=>"W","24"=>"X","25"=>"Y","26"=>"Z");
		return $arr;
	}
	/**
	 * Ʒ�ƹ���
	 */
	function getBrandNationAtIndex($id=0) {		
	    $arr=array();
		if($id){
			$sql = ' AND rid = '.$id;
			$gj = DB::fetch_first("SELECT * FROM ".DB::table('plugin_brand_area')." WHERE 1 $sql");
			if($gj){
				return $gj;
			}else{
				return null;
			}			
		}		
		$query = DB::query("SELECT * FROM ".DB::table('plugin_brand_area')." WHERE 1 $sql");							
		while ($row = DB::fetch($query)) {			
			$arr[] = $row;			
		}	
		return $arr;
	}
	/**
	 * ���ǲ�Ʒ
	 */
	function getProduceAtIndex($id=0) {
		if($id){
			$sql = ' AND id = '.$id;
			$cp = DB::fetch_first("SELECT * FROM ".DB::table('plugin_brand_produce')." WHERE 1 $sql");
			if($cp){
				return $cp;
			}else{
				return null;
			}			
		}	
		$arr=array();	
		$query = DB::query("SELECT * FROM ".DB::table('plugin_brand_produce')." WHERE 1");							
		while ($row = DB::fetch($query)) {
			$num = DB::result_first("SELECT count(*) FROM ".DB::table('dianping_brand_info')." WHERE ranklist like ('%$row[id]%')",0);
			if($num){
				$row['num'] = $num;
				$arr[] = $row;		
			}					
		}	
		return $arr;
	}
	/**	
	 *  ���������Ϣ
	 */
	function getCanvass($tid) {		
		if($tid){
			$thread = DB::fetch_first("SELECT zhaoshang,zstel FROM ".DB::table('dianping_brand_info')." 
						    WHERE tid = {$tid} LIMIT 1");		
			if ($thread)
				return $thread;
			return '';
		}
	}
	
	// ����Ʒ�Ƹ���(��ҳ����)
	function getCountAtIndex($condition){
		$sql = "SELECT count(*) as count FROM ".DB::table('dianping_brand_info')." AS b
			LEFT JOIN ".DB::table('forum_thread')." AS t ON b.tid = t.tid				
			WHERE t.displayorder!=-1 and b.ispublish=1 ";
		if($condition['let']){
			$sql .= " AND b.letter = '$condition[let]'";	
		}
		if($condition['nat']){				
			$sql .= " AND b.nation = '$condition[nat]'";	
		}
		if($condition['cp']){				
			$sql .= " AND b.ranklist like ('%$condition[cp]%') AND b.cnum>=10";	
		}
		if($condition['tj']){				
			$sql .= " AND b.subject like ('%$condition[tj]%')";	
		}
		$count = DB::fetch_first($sql);		
		if($count){
			return $count['count'];
		}
	}
	
	/***
	 * �����������Ʒ����Ϣ�б���ҳ���ã�
	 */
	function getBrandList($condition, $orderby='t.dateline desc', $limit='0,35'){
		$array = array();
		$sql = "SELECT b.showimg,b.serverid,t.tid,t.subject,t.views,t.replies,t.displayorder,b.score FROM ".DB::table('dianping_brand_info')." AS b
			LEFT JOIN ".DB::table('forum_thread')." AS t ON b.tid = t.tid 				
			WHERE t.displayorder!=-1 and b.ispublish=1 ";
		if($condition['let']){
			$sql .= " AND b.letter = '$condition[let]'";	
		}
		if($condition['nat']){
			$sql .= " AND b.nation = '$condition[nat]'";	
		}
		if($condition['cp']){			
			if($orderby=='t.dateline DESC'){
				$orderby = $orderby;	
			}else{
				$orderby = 'b.score desc,b.cnum desc';
			}
			$sql .= " AND b.ranklist like ('%$condition[cp]%') AND b.cnum>=10 ORDER BY $orderby";	
		}
		if($condition['tj']){				
			$sql .= " AND b.subject like ('%$condition[tj]%')";	
		}
		if($orderby&&(!$condition['cp'])){
			$sql .= " ORDER BY t.displayorder DESC,$orderby";	
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
			$name = $value['subject'];
			if(stripos($name,"��")){
				$sp = stripos($name,"��");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;	
			}elseif(stripos($name,"(")){
				$sp = stripos($name,"(");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;	
			 }else{
				$value['ename'] = $name;
			}					
			$value['showimg'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/":"/data/attachment/")."forum/".$value['showimg'];
			$array[] = $value;
		}		
		return $array;	
	}
	
	
	
	/***
	 * �������ӱ�Ų���Ʒ����Ϣ(��ñ༭״̬��Ϣ)
	 */
	function getEditBrandByTid($tid){
		if($tid){
			$brand = DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE tid = $tid limit 1");			
			return $brand;
		}	
	}
	
	/***
	 * �������ӱ�Ų���Ʒ����Ϣ
	 */
	function getBrandInfoByTid($tid){
		if($tid){
			$brand = DB::fetch_first("SELECT b.*,t.views,t.replies,t.displayorder FROM ".DB::table('dianping_brand_info')." as b LEFT JOIN ".DB::table('forum_thread')." AS t ON b.tid = t.tid WHERE b.tid = $tid limit 1");			
			if($brand){
				$nation = self::getBrandNationAtIndex($brand['nation']);
				$brand['nation'] = $nation['area'];
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				$alldomain = $attachserver->get_server_domain('all');
				$brand['showimg'] = ($brand['serverid']>0 ? "http://".$alldomain[$brand['serverid']]."/":"/data/attachment/")."forum/".$brand['showimg'];				
			}
			return $brand;
		}	
	}
	/***
	 * �༭ʱɾ��ͼƬ
	 */
	function deletImageByEdit($tid) {
		$brand = DB::fetch_first("select * FROM ".DB::table('dianping_brand_info')." WHERE tid=$tid");
		if($brand){
			/*��ȡ���еĸ�����������Ϣ*/
			require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
			$attachserver = new attachserver;
			$serverinfo = $attachserver->get_server_domain('all',"*");
			/*����*/
			if($produce['serverid'] > 0){
			    $attachserver->delete($serverinfo[$brand['serverid']]['domain'] , $serverinfo[$brand['serverid']]['api'] , 'forum/'.$brand['showimg']);
			}else{
			    $path1=DISCUZ_ROOT."./data/attachment/forum/".$brand['showimg'];
			   // $path2=DISCUZ_ROOT."./data/attachment/forum/".$brand['bPic'].'.thumb100.jpg';	
			    if(file_exists($path1)){
				    @unlink($path1);
			    }
			  
			}	
		}
	}
	
	/***
	*  ɾ��Ʒ����Ϣ
	*/ 
	function deletBrandInfo($condition) {
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $allserver = $attachserver->get_server_domain('all','*');
		if($condition){
			$query = DB::query("select * FROM ".DB::table('dianping_brand_info')." WHERE $condition");   
			while ($value = DB::fetch($query)) {
				$path1=DISCUZ_ROOT."./data/attachment/forum/".$value['showimg'];				
				if(file_exists($path1)){
                	@unlink($path1);
                }              
                if($value['serverid']>0){
                    $attachserver->delete($allserver[$value['serverid']]['domain'] , $allserver[$value['serverid']]['api'] , 'forum/'.$value['showimg']);
                }
				$qy = DB::fetch_first("select * FROM ".DB::table('dianping_star_statistics')." WHERE typeid=$value[tid]");
				if($qy){
					DB::query("delete from ".DB::table('dianping_star_logs')." WHERE starid='$qy[starid]'");
					DB::query("delete from ".DB::table('dianping_star_statistics')." WHERE id='$qy[id]'");
				}			
			}		
			DB::query("DELETE FROM ".DB::table('dianping_brand_info')." WHERE $condition");				
		}		
	}	
	
	
	/*
	* ������ϲ��ͷ���б�
	*/
	function getLikeitUsersAtNew($tid) {		
		$users = array();
		$query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('dianping_brand_users')." AS b
						   LEFT JOIN ".DB::table('common_member')." AS m
						   ON b.uid = m.uid
						   WHERE b.tid = {$tid} AND b.type='likeit'
						   ORDER BY b.id DESC
						   LIMIT 27");
		while ($value = DB::fetch($query)) {
		   $value['avatar'] = avatar($value['uid'], 'small');
		   $users[] = $value;
		}
		return $users;
	}
	
	/*
	* ���ظ���
	*/
	function getBrandUsersNum($tid,$type) {		
		$query = DB::fetch_first("SELECT count(b.id) as num FROM ".DB::table('dianping_brand_users')." AS b
						WHERE b.tid = {$tid} AND b.type='$type'");	
		return $query['num'];
	}
	
	
	function getTypeBytIdanduid($tid,$uid){
		$user_attentions = array(
			'likeit' => NULL,
			'wantuse' => NULL,
			'using' => NULL,
		);		
		$query = DB::query("SELECT * FROM ".DB::table('dianping_brand_users')." WHERE uid = {$uid} AND tid = {$tid}");
		while ($value = DB::fetch($query)) {
			$user_attentions[$value['type']] = $value;
		}
		return $user_attentions;
	}
	/********
	 *
	 * ��ҳ������Ϣ�б�
	 */
	function getZsInfoatIndex(){
		$arr = array();
		$query = DB::query("SELECT t.tid,t.views,t.replies,b.subject,b.showimg,b.score,b.serverid FROM ".DB::table('dianping_brand_info')." as b LEFT JOIN ".DB::table('forum_thread')." AS t ON b.tid = t.tid WHERE b.zhaoshang = 1 order by t.dateline asc limit 7");
		while ($value = DB::fetch($query)) {
			require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
			$attachserver = new attachserver;
			$alldomain = $attachserver->get_server_domain('all');
			$name = $value['subject'];
			if(stripos($name,"��")){
				$sp = stripos($name,"��");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;	
			}elseif(stripos($name,"(")){
				$sp = stripos($name,"(");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['ename'] = $cn;	
			 }else{
				$value['ename'] = $name;
			}
			$value['showimg'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/":"/data/attachment/")."forum/".$value['showimg'];
			$arr[] = $value;
		}
		return $arr;
	}	
	
	//Ʒ�ƾ��ֲ��Ķ���ҳ����ø�Ʒ���µ����з�����Ϣ
	function getShareBytId($tid){
		if($tid){
			$array=array();
			$sql="SELECT i.cptp,i.serverid,t.subject,t.tid FROM ".DB::table('plugin_produce_info')." AS i
					LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
					WHERE i.isshow=1 and i.type=0 AND t.displayorder >= 0 AND t.closed = 0 AND i.cppp=$tid
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
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." WHERE cppp={$tid} and isshow=1 and type=0");
		}
	}
	
	//���Ʒ���Ƿ񷢲�
	function getisPublish($tid){
		if($tid){
		return DB::result_first("SELECT ispublish FROM ".DB::table('dianping_brand_info')." WHERE tid={$tid} limit 1");
		}
	}
	
	//��ҳ��ȡƷ������
	function getTopBrandatIndex($limit=11){
		$arr = array();
		$query=DB::query("SELECT tid,subject,score FROM ".DB::table('dianping_brand_info')." WHERE ispublish=1 and FIND_IN_SET('156',ranklist) and cnum>=10 order by score desc limit $limit");
		while ($value = DB::fetch($query)) {
			$arr[] = $value;
		} 
		return $arr;
	}
	
	/****
	function loadCacheArray($name) {
		try {			
			global $_G;
			$filename = "tid_{$_G['tid']}";
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
				if (time() - 8640000 < $cache_item['cacheTime']) {
					return $cache_item['content'];
				}
			}
			
			$item_array = array('cacheTime'=>time());
			switch ($name) {
				case 'homeBlogs':
					$item_array['content'] = self::getHomeBlogs(); break;
				case 'ralateDzty':
					$item_array['content'] = self::getRalateDzty(); break;
				case 'ralateArticles':
					$item_array['content'] = self::getRalateArticles(); break;
				case 'ralateZb':
					$item_array['content'] = self::getRalateZb(); break;
				case 'ralateTopics':
					$item_array['content'] = self::getRalateTopics(); break;
				case 'ralatePhotos':
					$item_array['content'] = self::getRalatePhotos(); break;
				default:
					$item_array['content'] = array();
			}
			
			$cache_array[$aray_index] = $item_array;
			ForumOptionCache::writeCache($filename, $cache_array);
			return $item_array['content'];
		} catch(Exception $e) {
			return array();
		}
	}****/
	
	/********
	function loadDataArray($name) {
		switch ($name) {
			case 'homeBlogs':
				return self::getHomeBlogs(); break;
			case 'ralateDzty':
				return self::getRalateDzty(); break;
			case 'ralateArticles':
				return self::getRalateArticles(); break;
			case 'ralateZb':
				return self::getRalateZb(); break;
			case 'ralateTopics':
				return self::getRalateTopics(); break;
			case 'ralatePhotos':
				return self::getRalatePhotos(); break;
			default:
				return array();
		}
	}************/
}

$forumoption_brand = new CachedataLogger;
$forumoption_brand->class = 'ForumOptionBrand';
$forumoption_brand->methods = $CachedateLogger_config['ForumOptionBrand'];
if ($_GET['nocache'] == 1) {
	$forumoption_brand->forceRefreshCache = true;
}