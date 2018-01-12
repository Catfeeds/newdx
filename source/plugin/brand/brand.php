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
				$value['cname'] = $cn;	
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
		$query=DB::query("SELECT tid,subject,score FROM ".DB::table('dianping_brand_info')." WHERE ispublish=1 and ranklist like ('%43%') and cnum>=10 order by score desc limit $limit");
		while ($value = DB::fetch($query)) {
			$arr[] = $value;
		} 
		return $arr;
	}
	
	
	//2012-06-27 ��������ȡ����������Ϣ	
	function get_cache_index($key,$module){
	    if($module==""){
		//echo "ģ��δѡ��";
		return false;
	    }
	    $query=DB::fetch_first("SELECT * FROM ".DB::table('plugin_cache_tableindex')." WHERE type='".$module."'");
	    if(empty($query)){
		//echo "��ǰģ�鲻����";
		return false;
	    }
	    $tablename = $query['table_name'];
	    $tid = (int)$key;
	    $query=DB::query("SELECT * FROM ".DB::TABLE('plugin_cache_brand')." where id=$tid");
	    while($value=DB::fetch($query)){
		$info[$value['type']]=$value; 
	    }
	    return $info;
	}
	//2012-06-27 ������ͨ������������Ϣ
	function get_info_by_index($method,$result){
	    $allmethod = array("articles","zb","dzty","topics","blogs","photos");
	    //echo "<p>����$method:";
	    if(!in_array($method, $allmethod)){
	      // echo "���ڷ�����";
	       return false;
	    }
	    if(empty($result[$method])){
		return null;
	    }
	    $dl_id = $result[$method]['id_array'];
	    switch ($method) {
		    case "articles" :
		    $sql = "SELECT aid, title, pic, remote,serverid, dateline FROM ".DB::table('portal_article_title')."	WHERE aid in($dl_id)  GROUP BY aid ORDER BY aid DESC LIMIT ".$result[$method]['limit'];
		    break;
		    case "topics" :
		$sql = "SELECT topicid,title,cover FROM ".DB::table('portal_topic')." WHERE closed = 0 AND topicid in($dl_id)  ORDER BY topicid DESC LIMIT ".$result[$method]['limit'];
		break;
		case "blogs" :
		$sql = "SELECT blogid,uid,subject FROM ".DB::table('home_blog')." WHERE blogid in($dl_id)  ORDER BY blogid DESC LIMIT ".$result[$method]['limit'];
		break;
		case "photos" :
		$sql = "SELECT * FROM ".DB::table('home_album')." WHERE  (friend=0 and albumid in($dl_id))  ORDER BY albumid DESC LIMIT ".$result[$method]['limit'];
		break;
		    default:
		    $sql = "SELECT pid,authorid,tid,subject FROM ".DB::table('forum_post')." WHERE subject != '' AND pid in($dl_id)  ORDER BY tid desc LIMIT ".$result[$method]['limit'];
		break;
	    }
	    $query = DB::query($sql);
	    $return = false;
	    /*���븽��������*/
	    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
	    $attachserver = new attachserver;
	    $alldomain = $attachserver->get_server_domain('all');
	    /*����*/
	    while($value = DB::fetch($query)){
		if(in_array($method,array("zb","dzty"))){
		    $value['avatar'] = avatar($value['authorid'], 'small');
		}
		$pic_domain = (isset($value['remote']) && $value['remote']>0) ? $_G['setting']['ftp']['attachurl'] : ((isset($value['serverid']) && $value['serverid']>0) ? "http://".$alldomain[$value['serverid']]."/" : "/data/attachment/"); 
		if($method=='photos'){
		    if($value['friend']!= 4){
					    $value['pic'] =$pic_domain."album/".$value['pic'];
				    }
		}
		if($method=='articles' && !empty($value['pic'])){
		    $value['pic'] =$pic_domain."portal/".$value['pic'];
		}
		$return[] = $value;
	    }
	    return $return;
	}
	//2012-06-28 ���������ڲ�ѯ��ǰ�Ƿ���Ʒ����
	function get_produce_id_arr($search_arr){
	    $search_num = count($search_arr);
	    if($search_num==0){
		//echo "�����ѯ����Ϊ��";
		return false;
	    }
	    $produce_info = array();
	    $keywords = array();
	    $query = DB::query("SELECT f.tid,f.subject FROM ".DB::TABLE("forum_thread")." as f WHERE f.fid = 408 and f.displayorder >=0");
	    while($value = DB::fetch($query)){
		$keywords = self::get_keyword($value['subject']);
		$count_kw = 0; //����һ�������������ڲ�ѯ�������Ƿ��йؼ���
		for($kw=0;$kw<count($keywords);$kw++){
		    for($sea=0;$sea<$search_num;$sea++){
			$count_kw = $count_kw + preg_match("/".$keywords[$kw]."/",$search_arr[$sea]);
		    }
		}
		if($count_kw>0){
		    $produce_info[] = $value['tid'];
		}
	   }
	   return empty($produce_info) ? false : $produce_info;
	}
	//2012-06-28 ���������ڷ��عؼ���
	function get_keyword($str){
	    $keyword = array();
	    if(preg_match("/(\(|��|\)|��)/",$str)==0){
		$keyword[0] = trim($str);//ֻ��Ӣ������
		$keyword[0] = addcslashes($keyword[0],"\\'");
	    }else{//������������
		$keyword[0] = trim(preg_replace("/(\(|��).*(\)|��)/",'',$str));
		$keyword[1] = trim(preg_replace("/.*(\(|��)(.*)(\)|��)/",'\2',$str));
		$keyword[0] = addcslashes($keyword[0],"\\'");
		$keyword[1] = addcslashes($keyword[1],"\\'");
	    }
	    return $keyword;
	}
	//2012-06-28 ���� ���ڸ��»���
	function update_cache_produce($t_tid,$type){
	    $t_tid = (int)$t_tid;
	    if($t_tid==0 || $t_tid==null){
		//echo "�ύ��tid����";
		return false;
	    }
	    $typelist=array("articles","zb","dzty","topics","blogs","photos");
	    $numlist=array('articles'=>10,
			    'zb'=>8,
			    'dzty'=>8,
			    'topics'=>5,
			    'blogs'=>10,
			    'photos'=>4
			);
	    if(!in_array($type,$typelist)){
		//echo "��������ȷ";
		return false;
	    }
	    self::update_dl($t_tid,$type,$numlist[$type]);
	    return true;
	}
	//2012-07-02 �������û����ܻ����и��»������
	function update_dl($tid,$type,$limit){
	    $query=in_array($type,array("zb","dzty")) ? DB::query("SELECT pid from ".DB::table('plugin_cache_brand_index')." WHERE tid=$tid and type='".$type."' and displayorder >=0 order by pid desc limit 0,$limit") : DB::query("SELECT otherid from ".DB::table('plugin_cache_brand_otherindex')." WHERE id=$tid and type='".$type."'  and displayorder >=0 order by otherid desc limit 0,$limit");
	    $list = array();
	    while($value = DB::fetch($query)){
		$list[]=in_array($type,array("zb","dzty")) ? $value['pid'] : $value['otherid'];
	    }
	    if(empty($list)){
		return false;
	    }
	    $arr['id_array'] = implode(",",$list);
	    $arr['limit'] = $limit;
	    $arr['dateline'] = time();
	    if(DB::result_first("SELECT count(*) from ".DB::table('plugin_cache_brand')." WHERE id=$tid and type='".$type."'")==0){
		$arr['id'] = $tid;
		$arr['type'] = $type;
		$sql = DB::insert("plugin_cache_brand",$arr);
	    }else{
		$where = array('id'=>$tid,'type'=>$type);
		DB::update("plugin_cache_brand",$arr,$where);
	    }
	}
	//2012-07-02 �޸ģ����·���������֮�������Ʒ�Ʒ����ܻ�����У����ñ��档
	function produce_update_cache_all($value,$module,$other=1){
	    if(!is_array($value) || empty($value)){
		//echo "���ݲ��������Ϊ��";
		return false;
	    }
	    if(DB::result_first("SELECT count(*) from ".DB::table('plugin_cache_tableindex')." where type='".$module."'")==0){
		//echo "ģ�鲻����";
		return false;
	    }
	    $table = $other==1 ? "plugin_cache_".$module."_otherindex" : "plugin_cache_".$module."_index";
	    DB::insert($table,$value);
	    return true;
	}
	//2012-07-02 ���� ��ѯ��ǰID�Ƿ�Ϊ�ռ�Ʒ�ƣ�����ѯ���Ӧ��Ʒ��ID
	function get_tid_by_uid($uid){
	    $query = DB::query("SELECT tid FROM ".DB::table('forum_thread')." WHERE fid=408 and authorid=$uid and displayorder >=0 ");
	    while($value = DB::fetch($query)){
		$tid[] = $value['tid'];
	    }
	    if(!empty($tid)){
		return $tid;
	    }else{
		return false;
	    }
	}
	
	//������Ʒ����Ϣ
	function add_brand_info($subject, $tid){
		global $_G;
		//���Ʒ����Ϣ
		$bEn = $_POST['ename'];  //Ӣ������
		$bCn = $_POST['cname'];  //��������
		$company = $_POST['company']; //������˾
		$link = $_POST['link'];     //��ϵ�绰
		$nation = $_POST['nation'];  //����			
		$lett = $_POST['lett'];    //Ʒ������ĸ
		$city = $_POST['city'];    //����
		$url = $_POST['url'];      //�ٷ���ַ			
		$address = $_POST['address'];    //��ַ
		
		$uptypes=array('image/jpg',  //�ϴ��ļ������б�
			 'image/jpeg',
			 'image/png',
			 'image/pjpeg',
			 'image/gif',							 
			 'image/x-png',							
		 );				
		$max_file_size=5000000;   //�ϴ��ļ���С����, ��λBYTE		
		require_once libfile('function/delete');
		require libfile('class/image');
		$new_image = new image();
		$file = $_FILES["upfile"];
		$file['tmp_name'] = str_replace('\\\\', '\\', $file['tmp_name']);
		if (!is_uploaded_file($file['tmp_name'])){		
			echo "<font color='red'>�ļ������ڣ�</font>";			
			deletethread(" tid=$tid");
			exit;
		}
		$prowidth = getimagesize($file['tmp_name']);			
		$bl = $prowidth[0]/$prowidth[1];				
		if($prowidth[0]<100) {
			echo "<font color='red'>logoͼƬ�Ŀ��̫С�ˣ��������ϴ���</font>";			
			deletethread(" tid=$tid");
			exit;
		}
		if($prowidth[1]<50) {
			echo "<font color='red'>logoͼƬ�ĸ߶�̫С�ˣ��������ϴ���</font>";			
			deletethread(" tid=$tid");
			exit;
		}			
		if($prowidth[0]>150) {
			echo "<font color='red'>logoͼƬ�Ŀ��̫���ˣ��������ϴ���</font>";			
			deletethread(" tid=$tid");
			exit;
		}
		if($prowidth[1]>75) {
			echo "<font color='red'>logoͼƬ�ĸ߶�̫���ˣ��������ϴ���</font>";			
			deletethread(" tid=$tid");
			exit;
		}
		if($max_file_size < $file["size"])
		//����ļ���С
		{
			echo "<font color='red'>�ļ�̫��</font>";				
			deletethread(" tid=$tid");
			exit;
		}			
		if(!in_array($file["type"], $uptypes))
		//����ļ�����
		{
			 echo "<font color='red'>�����ϴ��������ļ���</font>";
			 deletethread(" tid=$tid");
			 exit;
		}			
		require_once libfile('class/upload');
		$upload = new discuz_upload();
		$upload->init($_FILES['upfile'],'forum');
		if($upload->error()){
			echo "<font color='red'>δ֪���������ԣ�</font>";			
			deletethread(" tid=$tid");
			exit;
		}
		$upload->save();
		if($upload->error()){
			echo "<font color='red'>�ϴ�ʧ�ܣ�������".$upload->errorcode."</font>";			
			deletethread(" tid=$tid");
			exit;
		}
		$serverid = (isset($upload->attach['serverid']) && $upload->attach['serverid'] > 0) ? $upload->attach['serverid'] : 0;			
		$insertarry = array(
				'tid' => $tid,
				'subject' => $subject,
				'showimg' => $upload->attach['attachment'],
				'ename' => $bEn,
				'cname' => $bCn,
				'company' => $company,					
				'tel' => $link,
				'nation' => $nation,
				'letter' => $lett,
				'city' => $city,
				'url' => $url,
				'addr' => $address,
				'score' => 0,
				'ispublish' => 0,
				'serverid' => $serverid
		);			
		DB::insert('dianping_brand_info',$insertarry);
	}
	
	//�޸�Ʒ��
	function edit_brand_info($subject){
		global $_G;
		//�޸�Ʒ����Ϣ						
		$bEn = $_POST['ename'];  //Ӣ������
		$bCn = $_POST['cname'];  //��������
		$company = $_POST['company']; //������˾
		$link = $_POST['link'];     //��ϵ�绰
		$nation = $_POST['nation'];  //����
		
		$lett = $_POST['lett'];    //Ʒ������ĸ
		$city = $_POST['city'];    //����
		$url = $_POST['url'];      //�ٷ���ַ			
		$address = $_POST['address'];    //��ַ			
		
		if($_FILES["upfile"]['name']!=null){				
			$uptypes=array('image/jpg',  //�ϴ��ļ������б�
				 'image/jpeg',
				 'image/png',
				 'image/pjpeg',
				 'image/gif',							 
				 'image/x-png',		
				 'image/bmp',				
			 );				
			$max_file_size=5000000;   //�ϴ��ļ���С����, ��λBYTE
			/*************/                
			require_once libfile('function/delete');
			require libfile('class/image');
			$new_image = new image();
			$file = $_FILES["upfile"];
			$file['tmp_name'] = str_replace('\\\\', '\\', $file['tmp_name']);
			if (!is_uploaded_file($file['tmp_name'])){		
				echo "<font color='red'>�ļ������ڣ�</font>";						
				exit;
			}
			$prowidth = getimagesize($file['tmp_name']);                
			$bl = $prowidth[0]/$prowidth[1];				
			if($prowidth[0]<100) {
				echo "<font color='red'>logoͼƬ�Ŀ��̫С�ˣ��������ϴ���</font>";							
				exit;
			}
			if($prowidth[1]<50) {
				echo "<font color='red'>logoͼƬ�ĸ߶�̫С�ˣ��������ϴ���</font>";					
				exit;
			}
			if($prowidth[0]>150) {
				echo "<font color='red'>logoͼƬ�Ŀ��̫���ˣ��������ϴ���</font>";						
				exit;
			}
			if($prowidth[1]>75) {
				echo "<font color='red'>logoͼƬ�ĸ߶�̫���ˣ��������ϴ���</font>";						
				exit;
			}
			if($max_file_size < $file["size"])
			//����ļ���С
			{
				echo "<font color='red'>ͼƬ�ļ�̫��</font>";					
				exit;
			}			
			if(!in_array($file["type"], $uptypes))
			//����ļ�����
			{
				 echo "<font color='red'>�����ϴ��������ļ���</font>";					
				 exit;
			}
			require_once libfile('class/upload');
			$upload = new discuz_upload();
			$upload->init($_FILES['upfile'],'forum');
			if($upload->error()){
			    echo "<font color='red'>δ֪���������ԣ�</font>";							
						exit;
			}
			$upload->save();
			if($upload->error()){
			    echo "<font color='red'>�ϴ�ʧ�ܣ�������".$upload->errorcode."</font>";								
						exit;
			}
			$serverid = (isset($upload->attach['serverid']) && $upload->attach['serverid'] > 0) ? $upload->attach['serverid'] : 0;				
			//�ϴ�����ͼƬ ����ͼƬɾ����
			ForumOptionBrand::deletImageByEdit($_G['tid']);				
			$updatearry = array(					
				 'subject' => $subject,
				 'showimg' => $upload->attach['attachment'],
				 'ename' => $bEn,
				 'cname' => $bCn,
				 'company' => $company,					
				 'tel' => $link,
				 'nation' => $nation,
				 'letter' => $lett,
				 'city' => $city,
				 'url' => $url,
				 'addr' => $address,					 
				 'serverid' => $serverid
			);	
			DB::update('dianping_brand_info',$updatearry,array('tid'=>$_G['tid']));               
		}else{
			$updatearry = array(					
				 'subject' => $subject,					
				 'ename' => $bEn,
				 'cname' => $bCn,
				 'company' => $company,					
				 'tel' => $link,
				 'nation' => $nation,
				 'letter' => $lett,
				 'city' => $city,
				 'url' => $url,
				 'addr' => $address					 				
			);	
			DB::update('dianping_brand_info',$updatearry,array('tid'=>$_G['tid']));	
		}		
	}
	
	function getviewthreadTemplate(){
		global $_G;
		$pub =self::getisPublish($_G['tid']);
		if($pub['ispublish']==0&&!in_array($_G['groupid'],array(1,45,62))){		
			showmessage('����������˽׶Σ���ʱ���ܲ鿴', "forum.php?mod=forumdisplay&fid=$_G[fid]", $param);									
		}else{				
			global $brand;
			global $zs;
			global $likenum;
			global $wantnum;
			global $usednum;
			global $likeitUsers;
			global $albumlist;
			global $bsharenum;
			$brand = ForumOptionBrand::getBrandInfoByTid($_GET['tid']);
			$zs = ForumOptionBrand::getCanvass($_GET['tid']);
			//ϲ��
			$likenum = ForumOptionBrand::getBrandUsersNum($_G['tid'],'likeit');
			//��Ҫ
			$wantnum = ForumOptionBrand::getBrandUsersNum($_G['tid'],'wantuse');
			//�ù�
			$usednum = ForumOptionBrand::getBrandUsersNum($_G['tid'],'using');
			//ϲ���б�
			$likeitUsers = ForumOptionBrand::getLikeitUsersAtNew($_G['tid']);				
			$albumlist = ForumOptionBrand::getShareBytId($_G['tid']);
			//����
			$bsharenum = ForumOptionBrand::getShareNumberAtBrand($_G['tid']);				
			return template('diy:forum/viewthreadbrand_new'.$sufix.':'.$_G['fid']);
		}
	}
	
	
	function getforumdisplaytemplate($template){
		//�°�Ʒ��
		global $_G;
		global $multipage;
		$condition = array();
		$condition['let'] = $_GET['let']? $_GET['let'] : 0;
		$condition['nat'] = $_GET['nat']? $_GET['nat'] : 0;
		$condition['cp'] = $_GET['cp']? $_GET['cp'] : 0;			
		$filter =  $_GET['filter'] ? $_GET['filter'] : 'heats';
		
		$_GET['key'] = urlencode($_GET['key']);			
		$_GET['key'] = urldecode($_GET['key']);
		$condition['tj'] = $_GET['key'];
		
		$pages ='';
		if($condition['let']||$condition['let']==0){
			$pages.= '&let='.$condition['let'];
		}
		if($condition['nat']||$condition['nat']==0){
			$pages.= '&nat='.$condition['nat'];
		}
		if($condition['cp']||$condition['cp']==0){
			$pages.= '&cp='.$condition['cp'];
		}
		if($filter){					
			$pages.= '&filter='.$filter;
			$_GET['gp_page'] = max(1, intval($_GET['gp_page']));
		}				
		$tb = ForumOptionBrand::getCountAtIndex($condition);			
		$_G['forum_threadcount'] = $tb;
		
		if($filter=='heats'){
			$con=2;
		}
		if($filter=='dateline'){
			$con=1;
		}
		if($condition['tj']){
			$multipage=multis($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'], PORTAL_HOST."pinpai-$condition[tj]-$con");
		}else{			
			$multipage=multis($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'], PORTAL_HOST."pinpai-$condition[let]-$condition[nat]-$condition[cp]-$con");
		}				
		global $letterlist;
		global $nations;
		global $prolist;
		$letterlist = ForumOptionBrand::getLetterbyIndex();
		$nations= ForumOptionBrand::getBrandNationAtIndex();
		$prolist= ForumOptionBrand::getProduceAtIndex();			
		$template = 'diy:forum/forumdisplaybrand_new:'.$_G['fid'];
		return $template;
	}
	
	//�༭Ʒ����Ҫ�ߵ�ģ��
	function getEditDatabyId($tid){
		global $edit;
		global $brandlist;
		global $letlist;
		$edit = ForumOptionBrand::getEditBrandByTid($tid);
		$brandlist = ForumOptionBrand::getBrandNationAtIndex();
		$letlist = ForumOptionBrand::getLetterbyIndex();
		return template('forum/post_brand');
	}
}

$forumoption_brand = new CachedataLogger;
$forumoption_brand->class = 'ForumOptionBrand';
$forumoption_brand->methods = $CachedateLogger_config['ForumOptionBrand'];
if ($_GET['nocache'] == 1) {
	$forumoption_brand->forceRefreshCache = true;
}