<?php
/**
* ===========================================
* Project: ��ѩ��ϵͳ(���)
* Version: 1.0
* Time: 2012-12-25 @ Created
* Copyright (c) 2012 8264.com
* Website: http://www.8264.com
* Developer: zhanghongliang
* ===========================================
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/cache.php';

class ForumOptionSkiing {
	
	/**
	 * ��õ�����Ϣ
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
	 * ��û�ѩ������Ϣ����ϸҳ���ã�
	 */
	function getSkiingBytId($tid){
		if($tid){
			$skiing = DB::fetch_first("SELECT i.*,t.views,t.replies FROM ".DB::table('dianping_skiing_info')." as i LEFT JOIN ".DB::table('forum_thread')." as t on i.tid = t.tid WHERE i.tid = $tid and i.ispublish in (0,1) limit 1");
           	if($skiing['provinceid']){
				$reg = self::getProvincebycatid($skiing['provinceid']);
			    $skiing['addr'] = $reg['name'].$skiing['addr'];
			}		
			if($skiing['serverid'] > 0){
                require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
                $attachserver = new attachserver;
                $domain = $attachserver->get_server_domain($skiing['serverid']);				
                $skiing['showimg'] = "http://".$domain."/plugin/".$skiing['showimg'];
            }else{
                $skiing['showimg'] = "/data/attachment/plugin/".$skiing['showimg'];
            }			
			return $skiing;
		}	
	}
	// ����༭��ѯ��ѩ������Ϣ
	function getskiingEditmapBytId($tid){
		if($tid){
			$sk = DB::fetch_first("SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE tid ='$tid' limit 1");
			if($sk['provinceid']){
				$dq = self::getProvincebycatid($sk['provinceid']);
				$sk['pro'] = $dq['name'];				
			}
			return $sk;
		}	
	}	
	/**
	 * ����ͬʡ���µĻ�ѩ����Ϣ(��ϸҳ����)
	 */
	function getSkiingByregionName($region,$tid){		
		if($region&&$tid){
			$query = DB::query("SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE ispublish=1 and provinceid = '$region' and tid<>'$tid' order by tid asc limit 4");
			while ($row = DB::fetch($query)) {
				if($row['serverid'] > 0){
					require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
					$attachserver = new attachserver;
					$domain = $attachserver->get_server_domain($row['serverid']);				
					$row['showimg'] = "http://".$domain."/plugin/".$row['showimg'];
				}else{
					$row['showimg'] = "/data/attachment/plugin/".$row['showimg'];
				}				
				$arr[] = $row;			
			}	
			return $arr;
		}
	}
	
	/**
	 * ���Ż�ѩ����Ϣ����(��ϸҳ����)
	 */
	function getHotSkiingbyScore($tid){		
		if($tid){
			$query = DB::query("SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE ispublish=1 and tid<>'$tid' order by score desc limit 4");
			while ($row = DB::fetch($query)) {			
				if($row['serverid'] > 0){
					require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
					$attachserver = new attachserver;
					$domain = $attachserver->get_server_domain($row['serverid']);				
					$row['showimg'] = "http://".$domain."/plugin/".$row['showimg'];
				}else{
					$row['showimg'] = "/data/attachment/plugin/".$row['showimg'];
				}				
				$arr[] = $row;		
			}	
			return $arr;
		}
	}
	

	// ���㻬ѩ������(��ҳ����)
	function getCountbyCondition($condition){
		$sql = "SELECT count(*) as count FROM ".DB::table('dianping_skiing_info')." AS s
			LEFT JOIN ".DB::table('forum_thread')." AS t ON s.tid = t.tid				
			WHERE s.ispublish=1 ";
		if($condition['pro']){
			$sql .= " AND s.provinceid = '$condition[pro]'";
		}
		if($condition['tj']){				
			$sql .= " AND s.subject like '%$condition[tj]%'";
		}		
		$skiingcount = DB::fetch_first($sql);		
		if($skiingcount){
			return $skiingcount['count'];
		}
	}
	
	/***
	 * ����������û�ѩ����Ϣ�б�
	 */
	function getSkiingList($condition, $orderby='t.dateline desc', $limit='0,20'){
		$array = array();
		$sql = "SELECT s.*, t.views,t.replies FROM ".DB::table('dianping_skiing_info')." AS s
				LEFT JOIN ".DB::table('forum_thread')." AS t ON s.tid = t.tid				
				WHERE s.ispublish=1 ";
		if($condition['pro']){
			$sql .= " AND s.provinceid = '$condition[pro]'";
		}
		if($condition['tj']){
			$sql .= " AND s.subject like '%$condition[tj]%'";
		}					
		if ($orderby){
			$sql .= " ORDER BY s.displayorder desc,$orderby";
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
			if($value['provinceid']){
				$reg = self::getProvincebycatid($value['provinceid']);
			    $value['addr'] = $reg['name'].$value['addr'];
			}
			$value['showimg'] = ($value['serverid']>0 ? "http://".$alldomain[$value['serverid']]."/":"/data/attachment/")."plugin/".$value['showimg'];
			$array[] = $value;
		}		
		return $array;	
	}
	
	
	/**
	 *���ҵ����껬ѩ������Ϣ
	 */
	function getProvince($reg){
		if($reg){
			$dq = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE name = '$reg' limit 1");
			if($dq){
				return $dq;
			}			
		}
	}		
	/**
	 *���ҵ����껬ѩ������Ϣ
	 */
	function getProvincebycatid($catid){
		if($catid){
			$dq = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE catid = '$catid' limit 1");
			if($dq){
				return $dq;
			}			
		}
	}
	
	/***
	 * ��ѯ��ѩ��ÿ���������ж��ٸ���ѩ��
	 */
	function getCountByregionId($catid){
		if($catid){
			$region = DB::fetch_first("SELECT count(*) as count FROM ".DB::table('dianping_skiing_info')." WHERE provinceid = $catid limit 1");
			return $region['count'];
		}
	}
	
	/***
	 *  ���ݵ�����Ų��ҵ�������
	 */
	function getRegionById($id){
		if($id){
			$region = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_region')." WHERE catid = $id limit 1");		
			return $region;
		}	
	}
	
	// ���������Ƿ����ͨ��
	function getisPublis($tid){
	    if(!$tid) {
		  return null; 
		}
		$sql="SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE tid={$tid} limit 1";
		return $ski = DB::fetch_first($sql);	
	}	
	
	/***
	 *	��ѯ��ѩ���еĵ���
	 */
	function getRegionListbySki($cbrand=null,$brand=null){
		$sql = '';
		$arr = array();		
		$sq="select catid,name from ".DB::table('dianping_shop_region')." WHERE upid=0";
		$query = DB::query($sq);							
		while ($row = DB::fetch($query)) {			
			$row['count'] = self::getCountByregionId($row['catid']);			
			$arr[] = $row;									
		}					
		$rows = self::sortByCol($arr, 'count', SORT_DESC);	
		return $rows;
	}
	
	
	/***
	 * �������ӱ�Ų��ҵ�����Ϣ(��ñ༭״̬��Ϣ)
	 */
	function getEditSkiingByTid($tid){
		if($tid){
			$skiing = DB::fetch_first("SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE tid = $tid limit 1");
			return $skiing;
		}	
	}
	
	/***
	*  ɾ����Ʒ��Ϣ
	*/ 
	function deletSkiingInfo($condition) {
        require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
        $attachserver = new attachserver;
        $allserver = $attachserver->get_server_domain('all','*');
		if($condition){
			$query = DB::query("select * FROM ".DB::table('dianping_skiing_info')." WHERE $condition");
			while ($value = DB::fetch($query)) {
				$path1=DISCUZ_ROOT."./data/attachment/plugin/".$value['showimg'];
				$path2=DISCUZ_ROOT."./data/attachment/plugin/".$value['showimg'].'.thumb100.jpg';
				$path3=DISCUZ_ROOT."./data/attachment/plugin/".$value['showimg'].'.thumb400.jpg';
				if(file_exists($path1)){
                	@unlink($path1);
                }
                if(file_exists($path2)){
                	@unlink($path2);
                }
				if(file_exists($path3)){
                	@unlink($path3);
                }
                if($value['serverid']>0){
                    $attachserver->delete($allserver[$value['serverid']]['domain'] , $allserver[$value['serverid']]['api'] , 'plugin/'.$value['showimg'] , 1 , '100|400');
                }
				$qy = DB::fetch_first("select * FROM ".DB::table('dianping_star_statistics')." WHERE typeid=$value[tid]");
				if($qy){
					DB::query("delete from ".DB::table('dianping_star_logs')." WHERE starid='$qy[starid]'");
					DB::query("delete from ".DB::table('dianping_star_statistics')." WHERE id='$qy[id]'");
				}			
			}		
			DB::query("DELETE FROM ".DB::table('dianping_skiing_info')." WHERE $condition");
		}		
	}	
	
	//�����㷨
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
		
	//modified by �༭��ʱ��ɾ��ԭ��ͼƬ
	function deletImageByEdit($tid) {
		$skiing = DB::fetch_first("select * FROM ".DB::table('dianping_skiing_info')." WHERE tid=$tid");
		if($skiing){
            /*��ȡ���еĸ�����������Ϣ*/
            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
            $attachserver = new attachserver;
            $serverinfo = $attachserver->get_server_domain('all',"*");
            /*����*/
            //if($produce['serverid'] > 0){
                $attachserver->delete($serverinfo[$skiing['serverid']]['domain'] , $serverinfo[$skiing['serverid']]['api'] , 'plugin/'.$skiing['showimg'] , 1 , '100|400');
            //}else{
                $path1=DISCUZ_ROOT."./data/attachment/plugin/".$skiing['showimg'];
                $path2=DISCUZ_ROOT."./data/attachment/plugin/".$skiing['showimg'].'.thumb100.jpg';
				$path3=DISCUZ_ROOT."./data/attachment/plugin/".$skiing['showimg'].'.thumb400.jpg';
                if(file_exists($path1)){
                	@unlink($path1);
                }
                if(file_exists($path2)){
                	@unlink($path2);
                }
				if(file_exists($path3)){
                	@unlink($path3);
                }
            //}	
		}
	}
	
	//��ȡ��ѩ����Ϣ
	function getSkiiingHeatsby($limit = '7'){
		$arr = array();		 
		$str_sql = "SELECT s.*,t.views,t.replies FROM " . DB::table('dianping_skiing_info') . " AS s LEFT JOIN ". DB::table('forum_thread'). " AS t ON s.tid = t.tid WHERE s.ispublish=1 ORDER BY s.displayorder desc,t.heats DESC LIMIT 0,$limit ".getSlaveID();
		$query = DB::query($str_sql);
		while ($value = DB::fetch($query)) {		
			$value['showimg'] = getimagethumb(322, 322, 11, "plugin/".$value['showimg'], $value['aid'], $value['serverid']);
			$arr[] = $value;
		}
		return $arr;
	}
	//��ȡ���㳡��Ϣ
	function getFishingHeatsby($limit = '7'){
		$arr = array();		 
		$str_sql = "SELECT score,tid,showimg,subject,serverid FROM " . DB::table('dianping_fishing_info') . " WHERE ispublish=1 ORDER BY displayorder desc,cnum DESC LIMIT 0,$limit ".getSlaveID();
		$query = DB::query($str_sql);
		while ($value = DB::fetch($query)) {		
			$value['showimg'] = getimagethumb(322, 322, 11, "plugin/".$value['showimg'], $value['aid'], $value['serverid']);
			$arr[] = $value;
		}
		return $arr;
	}	
	//��ȡ������Ϣ
	function getClimbHeatsby($limit = '7'){
		$arr = array();		 
		$str_sql = "SELECT score,tid,showimg,subject,serverid FROM " . DB::table('dianping_climb_info') . " WHERE ispublish=1 ORDER BY displayorder desc,cnum DESC LIMIT 0,$limit ".getSlaveID();
		$query = DB::query($str_sql);
		while ($value = DB::fetch($query)) {		
			$value['showimg'] = getimagethumb(322, 322, 2, "plugin/".$value['showimg'], $value['aid'], $value['serverid']);
			$arr[] = $value;
		}
		return $arr;
	}	
	//��ȡɽ����Ϣ
	function getMountainHeatsby($limit = '7'){
		$arr = array();		 
		$str_sql = "SELECT score,tid,showimg,subject,serverid FROM " . DB::table('dianping_mountain_info') . " WHERE ispublish=1 ORDER BY displayorder desc,cnum DESC LIMIT 0,$limit ".getSlaveID();
		$query = DB::query($str_sql);
		while ($value = DB::fetch($query)) {		
			$value['showimg'] = getimagethumb(322, 322, 2, "plugin/".$value['showimg'], $value['aid'], $value['serverid']);
			$arr[] = $value;
		}
		return $arr;
	}	
	//��ȡǱˮ��Ϣ
	function getDivingHeatsby($limit = '7'){
		$arr = array();		 
		$str_sql = "SELECT score,tid,showimg,subject,serverid FROM " . DB::table('dianping_diving_info') . " WHERE ispublish=1 ORDER BY displayorder desc,cnum DESC LIMIT 0,$limit ".getSlaveID();
		$query = DB::query($str_sql);
		while ($value = DB::fetch($query)) {		
			$value['showimg'] = getimagethumb(322, 322, 2, "plugin/".$value['showimg'], $value['aid'], $value['serverid']);
			$arr[] = $value;
		}
		return $arr;
	}	
	
	
    
}
