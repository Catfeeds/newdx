<?php

/**
* 活动用户操作
*/


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require DISCUZ_ROOT.'api/activity/thread_ctl.php';
require_once libfile('function/activity');

class manage extends thread
{
	function __construct()
	{
		parent::__construct();
	}

	// 获取发布活动时需要的属性
	public function actAttr()
	{
		// 省份板块及下级分类
		$data['actAttr']['province'] = $this->model->zone();

		// 活动玩法
		$data['actAttr']['type'] = $this->model->act_type();
		if($data) {
			$data = iconv_array($data);
			output_msg(json_encode($data));
		} else {
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"Get actAttr data error."}}');
		}
	}
	

	// 取消报名
	public function applyCancel()
	{
		parent::base();

		$applyid = intval($_GET['applyid']);
		if(!$applyid) {
			output_msg('{'.$this->errmsg.'"msg":{"code":423, "info":"Param applyid miss."}}');
		}

		/** // 检查取消的用户报名人数,检查取消的记录是否为请求者
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$wechatuserid = $_GET['wechatuserid'];
		$is_myapply = $this->model->user_apply_status($this->tid, $this->uid, $appuserid, $wechatuserid);
		if(!$is_myapply['apply']['applyid']) {
			$err_msg = diconv('"errorCode": 2, "errorReason":"您无权操作该记录", ', 'gbk', 'utf-8');
			output_msg('{'.$err_msg.'"msg":{"code":423, "info":"Param userid miss."}}');
		}*/

		$the_activity = DB::fetch_first("SELECT verified, ufielddata FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid' ".getSlaveID());

		if(!$the_activity) {
			output_msg('{'.$this->errmsg.'"msg":{"code":423, "info":"The applyid Don\'t exist."}}');
		}

		$activity = unserialize($the_activity['ufielddata']);
		$nums = $activity['userfield']['field3'];

		DB::query("DELETE FROM ".DB::table("forum_activityapply")." WHERE applyid='$applyid'");
		$result = DB::affected_rows();

		if($result) {
			// 如果已被审核，报名人数重新计算
			if($the_activity['verified']) {
				$apply_nums = setPassnumAndApplynum($this->tid);
				$this->logs->log_str('activity apply update applynum:'.$apply_nums['applynumber'].', passnumber:'.$apply_nums['passnumber']);
			}
			//给活动发起者发站内信通知
			$reason= diconv(urldecode($_GET['reason']), 'utf-8', 'gbk//TRANSLIT');
			if($the_activity['uid'] != $this->uid) {
					notification_add($the_activity['uid'], 'activity', 'activity_cancel', array(
							'tid' => $this->tid,
							'subject' => $the_activity['clubname'].' '.date('m月d日',$the_activity['starttime']).'-'.date('m月d日',$the_activity['endtime']).' '.$the_activity['title'],
							'reason' => $reason
					));
			}
                                        

			$data['result'] = 1;
			$this->logs->log_str('activity apply cancel:'.$this->tid.', applyid:'.$applyid.', nums:'.$nums);

		} else {
			$data['errorCode'] = 2;
			$data['errorReason'] = diconv("服务器出错，请与我们工作人员联系", 'gbk', 'utf-8');
			$data['msg'] = array("code" => 433, "info" => "Apply cancel failed.");
			$this->logs->log_str('activity apply cancel failed:'.$this->tid.', applyid:'.$applyid.', nums:'.$nums);
		}
		output_msg(json_encode($data));
	}

	
        
	//省份数据处理
	public function Prodata(){
		$province = $this->model->province();
		$infid= "";
		$fidtoname =array();
		$fids_array =array();
		$count_pro = count($province);
		for($i=0;$i<$count_pro;$i++){
			$infid .= $province[$i]['fid'].",";
			$fidtoname[$province[$i]['fid']] = $province[$i]['name'];
			$fids_array[]=$province[$i]['fid'];
		}

		$newinfid = substr($infid,0,strlen($infid)-1);  
		return array($newinfid,$fidtoname,$fids_array);
    }
	
	//某省份下地区数据
	public function zoneByfid($fid){
		$sql = "SELECT typeid, name FROM ".DB::table("forum_threadclass")." WHERE fid = '$fid' ORDER BY displayorder ASC ".getSlaveID();
		$list_cache = $this->redis->get("act_api_zoneByfid_".md5($sql));
		$zone = unserialize($list_cache);
		if(!$zone){
			$query = DB::query($sql);
			$zone =array();
			while($row = DB::fetch($query)){
				$zone[$row['typeid']] = $row;
			}
			$this->redis->obj->set("act_api_zoneByfid_".md5($sql), serialize($zone), 864000);
		}
		return $zone;
    }
	
	
	//通过typeid查询name
	public function zoneBytypeid($fid,$typeid){
		//$fid = $_GET['fid'];
		//$typeid = $_GET['typeid'];
		$sql = "SELECT  name FROM ".DB::table("forum_threadclass")." WHERE fid = '$fid' AND typeid = '$typeid' ORDER BY displayorder ASC ".getSlaveID();
		$list_cache = $this->redis->get("act_api_zoneBytypeid_".md5($sql));
		$typename = unserialize($list_cache);
		if(!$typename){
			$typename = DB::fetch_first($sql);
			$this->redis->obj->set("act_api_zoneBytypeid_".md5($sql), serialize($typename), 864000);
		}
		return $typename['name'];
	}  
	
	//条件查询报名列表
	public function applyListBycond()
   {
		$Prodata =$this->Prodata();
		$page = max(intval($_GET['page']), 1);
		$perpage  = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start = ($page-1)*$perpage;

		$applyid = intval($_GET['applyid']);
		$subject = diconv(urldecode($_GET['subject']), 'utf-8', 'gbk//TRANSLIT');
		$ufielddata = diconv(urldecode($_GET['ufielddata']), 'utf-8', 'gbk//TRANSLIT');
		$plat = intval($_GET['plat']);


		$where= " t.fid IN ($Prodata[0]) AND t.special = 4 AND a.timediff < 4 AND t.displayorder >=0 AND t.tid > 5161751 AND a.credit = 0";
		if($applyid){ 
			$where .= " AND aa.applyid = '$applyid'";
		}	
		if($subject){
			$where .= " AND t.subject LIKE '%$subject%'";   
		}
		if($ufielddata){
			$where .= " AND aa.ufielddata LIKE '%$ufielddata%'";   
		}
		if($plat){
			$where .= " AND aa.plat = '$plat'";
		}

		$sql ="SELECT  aa.applyid, aa.username, aa.appusername, aa.wechatusername, aa.ufielddata, t.tid, t.subject, aa.plat, aa.dateline, a.cost, a.starttimefrom AS starttime, a.starttimeto AS endtime FROM ".DB::table("forum_thread")." AS t "
			. "LEFT JOIN ".DB::table("forum_activity")." AS a "
			. "ON t.tid=a.tid "
			. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
			. "ON t.tid=aa.tid "
			. "WHERE $where ORDER BY dateline DESC LIMIT $start, $perpage ".getSlaveID();
        $list_cache = $this->redis->get("act_api_applyListBycond_".md5($sql));
		$list = unserialize($list_cache); 
		if(!$list) {
			$query = DB::query($sql);
			while($row = DB::fetch($query)){
				   $s = unserialize($row['ufielddata']);
				   unset($row['ufielddata']);
				   $row['realname'] = $s['userfield']['realname'];
				   $row['mobile'] = $s['userfield']['mobile'];
				   $list[] = $row;
			 }
			 $this->redis->obj->set("act_api_applyListBycond_".md5($sql), serialize($list), 3600);
		}
		if($list) {
			$data['applyList'] = iconv_array($list);
			output_msg(json_encode($data));
		}else{
			output_msg('{"applyList":""}');
		}
	}
	
	
	
	
	//条件tid查询报名列表
	public function applyListBytid()
   {
		$Prodata =$this->Prodata();
		$page = max(intval($_GET['page']), 1);
		$perpage  = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start = ($page-1)*$perpage;

		$tid = intval($_GET['tid']);


		$where= " t.fid IN ($Prodata[0]) AND t.special = 4 AND a.timediff < 4 AND t.displayorder >=0 AND t.tid > 5161751 AND a.credit = 0";
		if($tid){
			$where .= " AND aa.tid = '$tid'";
		}

		$sql ="SELECT  aa.applyid, aa.username, aa.appusername, aa.wechatusername, aa.ufielddata, t.tid, t.subject, aa.plat, aa.dateline, a.cost, a.starttimefrom AS starttime, a.starttimeto AS endtime FROM ".DB::table("forum_thread")." AS t "
			. "LEFT JOIN ".DB::table("forum_activity")." AS a "
			. "ON t.tid=a.tid "
			. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
			. "ON t.tid=aa.tid "
			. "WHERE $where ORDER BY dateline DESC LIMIT $start, $perpage ".getSlaveID();
        $list_cache = $this->redis->get("act_api_applyListBytid_".md5($sql));
		$list = unserialize($list_cache); 
		if(!$list) {
			$query = DB::query($sql);
			while($row = DB::fetch($query)){
				   $s = unserialize($row['ufielddata']);
				   unset($row['ufielddata']);
				   $row['realname'] = $s['userfield']['realname'];
				   $row['mobile'] = $s['userfield']['mobile'];
				   $list[] = $row;
			 }
			 $this->redis->obj->set("act_api_applyListBytid_".md5($sql), serialize($list), 3600);
		}
		if($list) {
			$data['applyList'] = iconv_array($list);
			output_msg(json_encode($data));
		}else{
			output_msg('{"applyList":""}');
		}
	}
        
        
        
        
        //条件查询活动列表
	public function actListBycond()
	{
		$Prodata =$this->Prodata();
		$page = max(intval($_GET['page']), 1);
		$perpage  = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start = ($page-1)*$perpage;

		$tid = intval($_GET['tid']);
		$place = diconv(urldecode($_GET['place']), 'utf-8', 'gbk//TRANSLIT');
		$fid = intval($_GET['fid']);
		$typeid = intval($_GET['typeid']);
		$plat = intval($_GET['plat']);
		$class = diconv(urldecode($_GET['class']), 'utf-8', 'gbk//TRANSLIT');
		$clubname = diconv(urldecode($_GET['clubname']), 'utf-8', 'gbk//TRANSLIT');

		$where= " t.fid IN ($Prodata[0]) AND t.special = 4 AND a.timediff < 4 AND t.displayorder >=0 AND t.tid > 5161751 AND a.credit = 0";
		if($tid){
			$where .= " AND a.tid = '$tid'";
		}
		if($place){
			$where .= " AND a.place LIKE '%$place%'";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($typeid){
			$where .= " AND t.typeid = $typeid";
		}
		if($plat){
			$where .= " AND a.plat = $plat";
		}
		if($class){
			$where .= " AND a.class LIKE '%$class%'";
		}
		if($clubname){
			$where .= " AND a.clubname LIKE '%$clubname%'";
		}

		$sql ="SELECT  a.tid, a.place, t.fid, t.typeid, a.clubname, t.dateline, a.plat, a.starttimefrom AS starttime, a.starttimeto AS endtime, a.class, a.cost, a.number FROM ".DB::table("forum_thread")." AS t "
				. "LEFT JOIN ".DB::table("forum_activity")." AS a "
				. "ON t.tid=a.tid "
				. "WHERE $where ORDER BY dateline DESC LIMIT $start, $perpage ".getSlaveID();
		
		$list_cache = $this->redis->get("act_api_actListBycond_".md5($sql));
		$list = unserialize($list_cache); 
		if(!$list) {
			$query = DB::query($sql);
			while($row = DB::fetch($query)){
				$row['name'] = $Prodata[1][$row['fid']];
				$row['typename'] = $this->zoneBytypeid($row['fid'],$row['typeid']);	
				$row['applynumber'] = 0;
				$sql_applynumber ="SELECT COUNT(*) AS applynumber  FROM ".DB::table("forum_activityapply")." WHERE tid = '".$row['tid']."'";
				$applynumber = DB::fetch_first($sql_applynumber);
				$row['applynumber'] = $applynumber['applynumber'];
				
				$list[] = $row;
			}
			$this->redis->obj->set("act_api_actListBycond_".md5($sql), serialize($list), 3600);
		}

		if($list) {
			$data['actList'] = iconv_array($list);
			output_msg(json_encode($data));
		}else{
			output_msg('{"actList":""}');
		}  
	}
        
        
	
          
    //活动统计接口；
	public function act_statistics()
	{
		$Prodata =$this->Prodata();
		$starttime =intval($_GET['starttime']);
		$endtime =intval($_GET['endtime']);
		$fid = intval($_GET['fid']);
		$plat = intval($_GET['plat']);
		
		$cache_flag =md5('starttime='.$starttime.'&endtime='.$endtime.'&fid='.$fid.'&plat='.$plat);
		
		$where= " t.fid IN ($Prodata[0]) AND t.special = 4 AND a.timediff < 4 AND t.displayorder >=0 AND t.tid > 5161751 AND a.credit = 0";
		
		$data_cache = $this->redis->get("act_api_act_statistics_".$cache_flag);
		$data = unserialize($data_cache);
		if(!$data){
			$res_fbplat = $this->tongjiAct_fbplat($starttime, $endtime, $fid, $plat, $where);
			$res_bmplat = $this->tongjiAct_bmplat($starttime, $endtime, $fid, $plat, $where);
			$res_fbpro = $this->tongjiAct_fbpro($starttime, $endtime, $fid, $plat, $where, $Prodata);
			$res_bmpro = $this->tongjiAct_bmpro($starttime, $endtime, $fid, $plat, $where, $Prodata);
			$res_fbpro_plat = $this->tongjiAct_fbpro_plat($starttime, $endtime, $fid, $plat, $where, $Prodata);
			$res_bmpro_plat = $this->tongjiAct_bmpro_plat($starttime, $endtime, $fid, $plat, $where, $Prodata);
			$pbnum_total = 0;
			$bmnum_total = 0;
			$res_plat = array();
			for($i=1; $i<4; $i++){
				$res_plat[$i]['plat'] = $i;
				$res_plat[$i]['pbnum'] = empty($res_fbplat[$i]) ? '0' : $res_fbplat[$i];
				$res_plat[$i]['bmnum'] = empty($res_bmplat[$i]) ? '0' : $res_bmplat[$i];
				$pbnum_total += $res_plat[$i]['pbnum'];
				$bmnum_total += $res_plat[$i]['bmnum'];
			}

			$fids_array =$Prodata[2];
			$count_fids = count($fids_array);
			$res_pro = array();
			for($i=0;$i<$count_fids;$i++){
				 $res_pro[$fids_array[$i]]['pbnum'] = empty($res_fbpro[$fids_array[$i]]['pbnum']) ? '0' : $res_fbpro[$fids_array[$i]]['pbnum'];
				 $res_pro[$fids_array[$i]]['bmnum'] = empty($res_bmpro[$fids_array[$i]]['bmnum']) ? '0' : $res_bmpro[$fids_array[$i]]['bmnum'];
				 $res_pro[$fids_array[$i]]['fid'] = $fids_array[$i];
				 $res_pro[$fids_array[$i]]['name'] = $Prodata[1][$fids_array[$i]];
				 $zone_now = $this->zoneByfid($fids_array[$i]);


				 $zone_list_new=array();
				 foreach($zone_now as $z_k=>$z_v){
					 $zone_list_new[$z_k]['fid'] = $fids_array[$i];
					 $zone_list_new[$z_k]['pbnum'] = empty($res_fbpro[$fids_array[$i]]['zone'][$z_k]['pbnum']) ? '0' : $res_fbpro[$fids_array[$i]]['zone'][$z_k]['pbnum'];
					 $zone_list_new[$z_k]['bmnum'] = empty($res_bmpro[$fids_array[$i]]['zone'][$z_k]['bmnum']) ? '0' : $res_bmpro[$fids_array[$i]]['zone'][$z_k]['bmnum'];
					 $zone_list_new[$z_k]['typeid']  = $z_v['typeid'];
					 $zone_list_new[$z_k]['name']  = $z_v['name'];
				 }
				 $res_pro[$fids_array[$i]]['zone'] =$zone_list_new;
			}

			$res_pro_plat = array();
			for($i=0;$i<$count_fids;$i++){
				$res_pro_plat[$fids_array[$i]]['pbnum'] = empty($res_fbpro_plat[$fids_array[$i]]['pbnum']) ? '0' : $res_fbpro_plat[$fids_array[$i]]['pbnum'];
				$res_pro_plat[$fids_array[$i]]['bmnum'] = empty($res_bmpro_plat[$fids_array[$i]]['bmnum']) ? '0' : $res_bmpro_plat[$fids_array[$i]]['bmnum'];
				$res_pro_plat[$fids_array[$i]]['fid'] = $fids_array[$i];
				$res_pro_plat[$fids_array[$i]]['name'] = $Prodata[1][$fids_array[$i]];
				$zone_list_new=array();
				for($j=1; $j<4; $j++){
					$zone_list_new[$j]['fid'] = $fids_array[$i];
					$zone_list_new[$j]['pbnum'] = empty($res_fbpro_plat[$fids_array[$i]]['zone'][$j]['pbnum']) ? '0' : $res_fbpro_plat[$fids_array[$i]]['zone'][$j]['pbnum'];
					$zone_list_new[$j]['bmnum'] = empty($res_bmpro_plat[$fids_array[$i]]['zone'][$j]['bmnum']) ? '0' : $res_bmpro_plat[$fids_array[$i]]['zone'][$j]['bmnum'];
					$zone_list_new[$j]['plat']  = $j;
				}
				$res_pro_plat[$fids_array[$i]]['zone'] =$zone_list_new;

			}
			$data['pbnum_total'] = iconv_array($pbnum_total);
			$data['bmnum_total'] = iconv_array($bmnum_total);
			$data['res_fbplat'] = iconv_array($res_fbplat);
			$data['res_bmplat'] = iconv_array($res_bmplat);
			$data['res_fbpro'] = iconv_array($res_fbpro);
			$data['res_bmpro'] = iconv_array($res_bmpro);
			$data['res_plat'] = iconv_array($res_plat);
			$data['res_pro'] = iconv_array($res_pro);
			$data['res_pro_plat'] = iconv_array($res_pro_plat);
			$this->redis->obj->set("act_api_act_statistics_".$cache_flag, serialize($data), 3600);
		}
		output_msg(json_encode($data));
	  
	}
	
	
	//根据发布平台统计活动的发布数
	public function tongjiAct_fbplat($starttime, $endtime, $fid, $plat, $where)
	{
		if($starttime>0){
			$where .=" AND t.dateline > $starttime";
		}
		if($endtime>0){
			$where .=" AND t.dateline < $endtime";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($plat){
			if($plat == '1'){
				$where .= " AND a.plat IN ('0', '1')";
			}else{
				$where .= " AND a.plat = $plat";
			}
		}
		$return = array();
		if($plat){
		   $plat_sql ="SELECT COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where ".getSlaveID();
			$query = DB::fetch_first($plat_sql);
			$return[$plat] = $query['pbnum'];
		}else{
			$bbs_sql ="SELECT COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND a.plat IN ('0', '1') ".getSlaveID();
			$bbs_query = DB::fetch_first($bbs_sql);
			$return['1'] = $bbs_query['pbnum'];
			
			$app_sql ="SELECT COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND a.plat = '2' ".getSlaveID();
			$app_query = DB::fetch_first($app_sql);
			$return['2'] = $app_query['pbnum'];
			
			$wechat_sql ="SELECT COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND a.plat = '3' ".getSlaveID();
			$wechat_query = DB::fetch_first($wechat_sql);
			$return['3'] = $wechat_query['pbnum'];
			
		}
		return $return;
	}
	
	
	//根据报名平台统计活动的报名数
	public function tongjiAct_bmplat($starttime, $endtime, $fid, $plat, $where)
	{
		if($starttime>0){
			$where .=" AND aa.dateline > $starttime";
		}
		if($endtime>0){
			$where .=" AND aa.dateline < $endtime";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($plat){
			if($plat == '1'){
				$where .= " AND aa.plat IN ('0', '1')";
			}else{
				$where .= " AND aa.plat = $plat";
			}
		}
		$return = array();
		if($plat){
		   $plat_sql ="SELECT COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where ".getSlaveID();
			$query = DB::fetch_first($plat_sql);
			$return[$plat] = $query['bmnum'];
		}else{
			$bbs_sql ="SELECT COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND aa.plat IN ('0', '1') ".getSlaveID();
			$bbs_query = DB::fetch_first($bbs_sql);
			$return['1'] = $bbs_query['bmnum'];
			
			$app_sql ="SELECT COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND aa.plat = '2' ".getSlaveID();
			$app_query = DB::fetch_first($app_sql);
			$return['2'] = $app_query['bmnum'];
			
			$wechat_sql ="SELECT COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND aa.plat = '3' ".getSlaveID();
			$wechat_query = DB::fetch_first($wechat_sql);
			$return['3'] = $wechat_query['bmnum'];
			
		}
		return $return;
	}
	
	
	
	
	//根据发布省份统计活动的发布数
	public function tongjiAct_fbpro($starttime, $endtime, $fid, $plat, $where, $Prodata)
	{
		if($starttime>0){
			$where .=" AND t.dateline > $starttime";
		}
		if($endtime>0){
			$where .=" AND t.dateline < $endtime";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($plat){
			if($plat == '1'){
				$where .= " AND a.plat IN ('0', '1')";
			}else{
				$where .= " AND a.plat = $plat";
			}
		}
		$return = array();
		
		if($fid){
			$sql ="SELECT DISTINCT(t.typeid) AS distypeid, t.fid, t.typeid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where GROUP BY t.typeid ".getSlaveID();
			$query = DB::query($sql);
			$province_now =array('pbnum'=>0);
			$zone =array();
			while($row = DB::fetch($query)){
					$row['typename'] = $this->zoneBytypeid($row['fid'], $row['typeid']);	
					$zone[$row['typeid']] = $row;
					$province_now['pbnum'] += $row['pbnum'];
					$province_now['fid'] =$row['fid'];
					$province_now['name'] =$Prodata[1][$row['fid']];
			}
			$province_now['zone'] = $zone;
			$return[$fid] = $province_now;
			
		}else{
			$fids_array =$Prodata[2];
			$count_fids = count($fids_array);
			for($i=0;$i<$count_fids;$i++){
				$sql ="SELECT DISTINCT(t.typeid) AS distypeid, t.fid, t.typeid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND t.fid ='$fids_array[$i]' GROUP BY t.typeid ".getSlaveID();
				$query = DB::query($sql);
				$province_now =array('pbnum'=>0);
				$zone =array();
				while($row = DB::fetch($query)){
						$row['typename'] = $this->zoneBytypeid($row['fid'], $row['typeid']);	
						$zone[$row['typeid']] = $row;
						$province_now['pbnum'] += $row['pbnum'];
						if($province_now['fid'] ==''){
							$province_now['fid'] =$row['fid'];
							$province_now['name'] =$Prodata[1][$row['fid']];
						}
				}
				$province_now['zone'] = $zone;
				if($province_now['fid']){
					$return[$fids_array[$i]] = $province_now;
				}
			}
		}
		
		return $return;
	}
	
	
	
	
	//根据报名省份统计活动的报名数
	public function tongjiAct_bmpro($starttime, $endtime, $fid, $plat, $where, $Prodata)
	{
		if($starttime>0){
			$where .=" AND aa.dateline > $starttime";
		}
		if($endtime>0){
			$where .=" AND aa.dateline < $endtime";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($plat){
			if($plat == '1'){
				$where .= " AND aa.plat IN ('0', '1')";
			}else{
				$where .= " AND aa.plat = $plat";
			}
		}
		$return = array();
		
		if($fid){
			$sql ="SELECT DISTINCT(t.typeid) AS distypeid, t.fid, t.typeid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where GROUP BY t.typeid ".getSlaveID();
			$query = DB::query($sql);
			$province_now =array('bmnum'=>0);
			$zone =array();
			while($row = DB::fetch($query)){
					$row['typename'] = $this->zoneBytypeid($row['fid'], $row['typeid']);	
					$zone[$row['typeid']] = $row;
					$province_now['bmnum'] += $row['bmnum'];
					$province_now['fid'] =$row['fid'];
					$province_now['name'] =$Prodata[1][$row['fid']];
			}
			$province_now['zone'] = $zone;
			$return[$fid] = $province_now;
			
		}else{
			$fids_array =$Prodata[2];
			$count_fids = count($fids_array);
			for($i=0;$i<$count_fids;$i++){
				$sql ="SELECT DISTINCT(t.typeid) AS distypeid, t.fid, t.typeid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND t.fid ='$fids_array[$i]' GROUP BY t.typeid ".getSlaveID();
				$query = DB::query($sql);
				$province_now =array('pbnum'=>0);
				$zone =array();
				while($row = DB::fetch($query)){
						$row['typename'] = $this->zoneBytypeid($row['fid'], $row['typeid']);	
						$zone[$row['typeid']] = $row;
						$province_now['bmnum'] += $row['bmnum'];
						if($province_now['fid'] ==''){
							$province_now['fid'] =$row['fid'];
							$province_now['name'] =$Prodata[1][$row['fid']];
						}
				}
				$province_now['zone'] = $zone;
				if($province_now['fid']){
					$return[$fids_array[$i]] = $province_now;
				}
			}
		}
		
		return $return;
	}
	
	
	
	
	
	
	//根据发布省份和发布平台统计活动的发布数
	public function tongjiAct_fbpro_plat($starttime, $endtime, $fid, $plat, $where, $Prodata)
	{
		if($starttime>0){
			$where .=" AND t.dateline > $starttime";
		}
		if($endtime>0){
			$where .=" AND t.dateline < $endtime";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($plat){
			if($plat == '1'){
				$where .= " AND a.plat IN ('0', '1')";
			}else{
				$where .= " AND a.plat = $plat";
			}
		}
		$return = array();
		
		if($fid){
			$province_now =array('pbnum'=>0, 'fid'=>$fid, 'name'=>$Prodata[1][$fid]);
			$zone =array();
			if($plat){
			$sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where ".getSlaveID();
			$query = DB::fetch_first($sql);
			$query['plat'] =  $plat;
			$zone[$plat] =$query;
			$province_now['pbnum'] += $query['pbnum'];
			
			$province_now['zone'] = $zone;
			$return[$fid] = $province_now;
			}else{
				$bbs_sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND a.plat IN ('0', '1') ".getSlaveID();
				$bbs_query = DB::fetch_first($bbs_sql);
                $bbs_query['plat'] =  '1';
				$zone['1'] =$bbs_query;
				$province_now['pbnum'] += $bbs_query['pbnum'];
				
				$app_sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND a.plat = '2' ".getSlaveID();
				$app_query = DB::fetch_first($app_sql);
                $app_query['plat'] =  '2';
				$zone['2'] =$app_query;
				$province_now['pbnum'] += $app_query['pbnum'];
				
				$wechat_sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "WHERE $where AND a.plat = '3' ".getSlaveID();
				$wechat_query = DB::fetch_first($wechat_sql);
                $wechat_query['plat'] =  '3';
				$zone['3'] =$wechat_query;
				$province_now['pbnum'] += $wechat_query['pbnum'];
				
	            $province_now['zone'] = $zone;
			    $return[$fid] = $province_now;
				
			}
		}else{
			$fids_array =$Prodata[2];
			$count_fids = count($fids_array);
			for($i=0;$i<$count_fids;$i++){
				$province_now =array('pbnum'=>0, 'fid'=>$fids_array[$i], 'name'=>$Prodata[1][$fids_array[$i]]);
				$zone =array();
				if($plat){
				$sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "WHERE $where AND t.fid ='$fids_array[$i]' ".getSlaveID();
				$query = DB::fetch_first($sql);
				$query['plat'] =  $plat;
				$zone[$plat] =$query;
				$province_now['pbnum'] += $query['pbnum'];

				$province_now['zone'] = $zone;
				$return[$fids_array[$i]] = $province_now;
				}else{
					$bbs_sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "WHERE $where AND a.plat IN ('0', '1') AND t.fid ='$fids_array[$i]' ".getSlaveID();
					$bbs_query = DB::fetch_first($bbs_sql);
					$bbs_query['plat'] =  '1';
					$zone['1'] =$bbs_query;
					$province_now['pbnum'] += $bbs_query['pbnum'];

					$app_sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "WHERE $where AND a.plat = '2' AND t.fid ='$fids_array[$i]' ".getSlaveID();
					$app_query = DB::fetch_first($app_sql);
					$app_query['plat'] =  '2';
					$zone['2'] =$app_query;
					$province_now['pbnum'] += $app_query['pbnum'];

					$wechat_sql ="SELECT t.fid, COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "WHERE $where AND a.plat = '3' AND t.fid ='$fids_array[$i]' ".getSlaveID();
					$wechat_query = DB::fetch_first($wechat_sql);
					$wechat_query['plat'] =  '3';
					$zone['3'] =$wechat_query;
					$province_now['pbnum'] += $wechat_query['pbnum'];

					$province_now['zone'] = $zone;
					$return[$fids_array[$i]] = $province_now;

				}
			}
		}
		
		return $return;
	}
	
	
	
	//根据报名省份和报名平台统计活动的报名数
	public function tongjiAct_bmpro_plat($starttime, $endtime, $fid, $plat, $where, $Prodata)
	{
		if($starttime>0){
			$where .=" AND aa.dateline > $starttime";
		}
		if($endtime>0){
			$where .=" AND aa.dateline < $endtime";
		}
		if($fid){
			$where .= " AND t.fid = $fid";
		}
		if($plat){
			if($plat == '1'){
				$where .= " AND aa.plat IN ('0', '1')";
			}else{
				$where .= " AND aa.plat = $plat";
			}
		}
		$return = array();
		
		if($fid){
			$province_now =array('bmnum'=>0, 'fid'=>$fid, 'name'=>$Prodata[1][$fid]);
			$zone =array();
			if($plat){
			$sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where ".getSlaveID();
			$query = DB::fetch_first($sql);
			$query['plat'] =  $plat;
			$zone[$plat] =$query;
			$province_now['bmnum'] += $query['bmnum'];
			
			$province_now['zone'] = $zone;
			$return[$fid] = $province_now;
			}else{
				$bbs_sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND aa.plat IN ('0', '1') ".getSlaveID();
				$bbs_query = DB::fetch_first($bbs_sql);
                $bbs_query['plat'] =  '1';
				$zone['1'] =$bbs_query;
				$province_now['bmnum'] += $bbs_query['bmnum'];
				
				$app_sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND aa.plat = '2' ".getSlaveID();
				$app_query = DB::fetch_first($app_sql);
                $app_query['plat'] =  '2';
				$zone['2'] =$app_query;
				$province_now['bmnum'] += $app_query['bmnum'];
				
				$wechat_sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
					. "LEFT JOIN ".DB::table("forum_activity")." AS a "
					. "ON t.tid=a.tid "
					. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
					. "ON t.tid=aa.tid "
					. "WHERE $where AND aa.plat = '3' ".getSlaveID();
				$wechat_query = DB::fetch_first($wechat_sql);
                $wechat_query['plat'] =  '3';
				$zone['3'] =$wechat_query;
				$province_now['bmnum'] += $wechat_query['bmnum'];
				
	            $province_now['zone'] = $zone;
			    $return[$fid] = $province_now;
				
			}
		}else{
			$fids_array =$Prodata[2];
			$count_fids = count($fids_array);
			for($i=0;$i<$count_fids;$i++){
				$province_now =array('bmnum'=>0, 'fid'=>$fids_array[$i], 'name'=>$Prodata[1][$fids_array[$i]]);
				$zone =array();
				if($plat){
				$sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
						. "ON t.tid=aa.tid "
						. "WHERE $where AND t.fid ='$fids_array[$i]' ".getSlaveID();
				$query = DB::fetch_first($sql);
				$query['plat'] =  $plat;
				$zone[$plat] =$query;
				$province_now['bmnum'] += $query['bmnum'];

				$province_now['zone'] = $zone;
				$return[$fids_array[$i]] = $province_now;
				}else{
					$bbs_sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
						. "ON t.tid=aa.tid "
						. "WHERE $where AND aa.plat IN ('0', '1') AND t.fid ='$fids_array[$i]' ".getSlaveID();
					$bbs_query = DB::fetch_first($bbs_sql);
					$bbs_query['plat'] =  '1';
					$zone['1'] =$bbs_query;
					$province_now['bmnum'] += $bbs_query['bmnum'];

					$app_sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
						. "ON t.tid=aa.tid "
						. "WHERE $where AND aa.plat = '2' AND t.fid ='$fids_array[$i]' ".getSlaveID();
					$app_query = DB::fetch_first($app_sql);
					$app_query['plat'] =  '2';
					$zone['2'] =$app_query;
					$province_now['bmnum'] += $app_query['bmnum'];

					$wechat_sql ="SELECT t.fid, COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
						. "ON t.tid=aa.tid "
						. "WHERE $where AND aa.plat = '3' AND t.fid ='$fids_array[$i]' ".getSlaveID();
					$wechat_query = DB::fetch_first($wechat_sql);
					$wechat_query['plat'] =  '3';
					$zone['3'] =$wechat_query;
					$province_now['bmnum'] += $wechat_query['bmnum'];

					$province_now['zone'] = $zone;
					$return[$fids_array[$i]] = $province_now;

				}
			}
		}
		
		return $return;
	}
	
	
	
	
	//活动统计接口按天；
	public function act_statistics_byday()
	{
		$Prodata =$this->Prodata();
		$starttime =intval($_GET['starttime']);
		$endtime =intval($_GET['endtime']);
		
		$cache_flag =md5('starttime='.$starttime.'&endtime='.$endtime);
		
		$data_cache = $this->redis->get("act_api_act_statistics_byday_".$cache_flag);
		$data = unserialize($data_cache);
		
		if(!$data){
			$count_day = ($endtime - $starttime)/(60*60*24);
			$where= " t.fid IN ($Prodata[0]) AND t.special = 4 AND a.timediff < 4 AND t.displayorder >=0 AND t.tid > 5161751 AND a.credit = 0";

			$return =array();
			$pbnum_total = 0;
			$bmnum_total = 0;

			for($i=0;$i<$count_day;$i++){

				$i_starttime = $starttime+(60*60*24)*$i;
				$i_endtime = $starttime+(60*60*24)*($i+1);
				$where_pb  =" AND t.dateline > $i_starttime AND t.dateline < $i_endtime";

				$pb_sql ="SELECT COUNT(a.tid) AS pbnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "WHERE $where $where_pb ".getSlaveID();
				$pb_query = DB::fetch_first($pb_sql);
				$return[$i]['pbnum'] = $pb_query['pbnum'];
				$pbnum_total += $pb_query['pbnum'];

				$where_bm  =" AND aa.dateline > $i_starttime AND aa.dateline < $i_endtime";
				$bm_sql ="SELECT COUNT(aa.uid) AS bmnum FROM ".DB::table("forum_thread")." AS t "
						. "LEFT JOIN ".DB::table("forum_activity")." AS a "
						. "ON t.tid=a.tid "
						. "LEFT JOIN ".DB::table("forum_activityapply")." AS aa "
						. "ON t.tid=aa.tid "
						. "WHERE $where $where_bm ".getSlaveID();
				$bm_query = DB::fetch_first($bm_sql);
				$return[$i]['bmnum'] = $bm_query['bmnum'];
				$bmnum_total += $bm_query['bmnum'];
				$return[$i]['date'] = date('Y-m-d',$i_starttime);
			}
			
			$data['pbnum_total'] = iconv_array($pbnum_total);
			$data['bmnum_total'] = iconv_array($bmnum_total);
			$data['res_byday'] = iconv_array($return);
			$this->redis->obj->set("act_api_act_statistics_byday_".$cache_flag, serialize($data), 3600);
		
		}
		
		output_msg(json_encode($data));
		
	}
	
	
	
	
	//删除指定活动
	public function actDel()
	{
		$this->base();
		$this->act_info();

		if($this->activity['starttime'] < $this->timestamp) {
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"Delete activity failed. Activity is over."}}');
		}

		DB::query("UPDATE ".DB::table("forum_thread")." SET displayorder='-1' WHERE tid='$this->tid'");
		if(DB::affected_rows()) {
			output_msg('{"result":1}');
		} else {
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"Delete activity failed."}}');
		}
	}

	/**
	 * 输出配置
	 * @author Gtl 20161025 20161028
	 * @global array $_G
	 */
	function getprofilesetting(){
		global $_G;
		loadcache('profilesetting');
		$profilesetting = array();
		if(!empty($_G['cache']['profilesetting'])){
			foreach($_G['cache']['profilesetting'] as $field => $info){
				foreach($info as $key => $value){
					$info[$key] = diconv($value, 'gbk', 'utf-8');
				}
				$profilesetting[$field] = $info;
			}
		}
		output_msg(json_encode($profilesetting));
	}
	
	/**
	 * 给指定用户发送通知
	 * @author Gtl 20161027 20161028
	 * @global array $_G
	 */
	function notificationadd(){
		global $_G;
		$uidarray = unserialize(stripcslashes($_POST['uidarray']));
		$reason = $_POST['reason'];
		$activity_subject = $_POST['subject'];
		$tid = (int)$_GET['tid'];
		if(!$tid || empty($uidarray) || !is_array($uidarray) || empty($_GET['noticetype'])){
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"param error"}}');
		}
		foreach ($uidarray as $uid) {
			notification_add($uid, 'activity', $_GET['noticetype'], array('tid' => $tid, 'subject' => $activity_subject, 'reason' => $reason, 'msg' => $reason,));
		}
		output_msg('{"result":1}');
	}
	
	/**
	 * 更新活动贴的报名人数量
	 * @deprecated since version 20161028
	 * @author Gtl 20161027
	 * 正数执行加操作 负数执行减操作
	 */
	function updateapplynum(){
		$tid = (int)$_GET['tid'];
		$qty = (int)$_GET['qty'];
		if(!$tid || !$qty){
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"param error"}}');
		}
		if($qty>0){
			$sql = "applynumber = applynumber + $qty";
		}else{
			$sql = "applynumber = applynumber $qty";
		}
		$result = DB::query("update ".DB::table('forum_activity')." set $sql WHERE tid='$tid'");
		if($result){
			output_msg('{"result":1}');
		}
		output_msg('{"result":0}');
	}
	
	/**
	 * 更新活动贴的报名人数量和通过人数
	 * @author Gtl 20161027 20161028FY
	 */
	function updatepassnum(){
		$tid = (int)$_GET['tid'];
		$applynumber = abs((int)$_GET['applynumber']);
		$passnumber = abs((int)$_GET['passnumber']);
		if(!$tid){
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"param error"}}');
		}
		$data = array('applynumber'=>$applynumber, 'passnumber'=>$passnumber);
		DB::update('forum_activity', $data, "tid='{$tid}'");
//		tmplogforhd('updatepassnum', $data);
		//统计活动俱乐部活动数/出行人次
		$clubid = DB::result_first("SELECT clubid FROM ".DB::table('forum_activity')." WHERE tid='{$tid}' ");
		@setClubStat($clubid);
		
		output_msg('{"result":1}');
	}
	
	/**
	 * 是否有正在使用某模板的活动
	 * @author gtl 20161027y
	 * @global array $_G
	 */
	function hastpl(){
		global $_G;
		$formid = (int)$_GET['formid'];
		if(!$formid){
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"param error"}}');
		}
		$sql = "SELECT a.tid FROM ".DB::table('forum_thread')." t 
				INNER JOIN ".DB::table('forum_activity')." a ON t.tid = a.tid
				WHERE formid='{$formid}'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' OR t.displayorder IN ('-4', '-3', '-2'))");
		$tid = DB::fetch_first($sql);
		if($tid){
			output_msg('{"result":1}');
		}
		output_msg('{"result":0}');
	}
	
	/**
	 * 查询使用了某一表单助手的线路
	 * @author Gtl 20161110F
	 * @global array $_G
	 * @return array
	 */
	function getbbsxlbyformid(){
		global $_G;
		$result = array();

		$formid = (int)$_GET['formid'];
		$authorid = (int)$_GET['bbsuid'];
		$tid = (int)$_GET['tid'];
		$force = (int)$_GET['force'];
		if($force && !$authorid){
			output_msg('{"result":0}');
		}
		
		//为获取图片做准备
		require_once DISCUZ_ROOT.'source/plugin/attachment_server/attachment_server.class.php';
		$attachserver = new attachserver;
		$attachlist = $attachserver->get_server_domain('all', '*');
		
		$wheresql = 'a.tid > 5161751';
		if($tid>0){
			$wheresql = "a.tid = $tid";
		}
		if($force){
			$wheresql.=" and authorid = $authorid ";
		}
		
		$sql = "SELECT a.tid, t.subject, t.dateline, t.authorid, a.aid, a.cost, a.starttimefrom, a.starttimeto, a.expiration, a.number, a.passnumber, a.timediff FROM ".DB::table('forum_thread')." t 
				INNER JOIN ".DB::table('forum_activity')." a ON t.tid = a.tid
				WHERE $wheresql and formid={$formid}".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0')");
		$query = DB::query($sql);
		while ($row = DB::fetch($query)) {
			$attachment = DB::fetch_first("SELECT attachment, isimage, serverid, dir FROM " . DB::table('forum_attachment') . " WHERE aid={$row['aid']} ".getSlaveID());
			if($attachment['isimage'] && $attachment['serverid'] > 0) {
				$coverpic = "http://" . $attachlist[$attachment['serverid']]['name'] . "/".$attachment['dir']."/" . $attachment['attachment'];
			}
			$result[] = array(
				'goods_id' => $row['tid'],
				'title' => diconv($row['subject'], 'gbk', 'utf-8'),
				'add_time' => $row['dateline'],
				'authorid' => $row['authorid'],
				'cost' => $row['cost'],
				'starttimefrom' => $row['starttimefrom'],
				'starttimeto' => $row['starttimeto'],
				'expiration' => $row['expiration'],
				'number' => $row['number'],
				'passnumber' => $row['passnumber'],
				'days' => $row['timediff'],
				'goods_image' => $coverpic?$coverpic:''
			);
		}
		output_msg(json_encode(array("result"=>$result)));
	}
	
	/**
	 * 找到某人某帖关联的formid
	 * @author gtl 20161205y
	 * @global array $_G
	 */
	function getbbsxlbytid(){
		global $_G;
		$result = array();
		
		$authorid = (int)$_GET['bbsuid'];
		$tid = (int)$_GET['tid'];
		//$formid = (int)$_GET['formid'];
		if(!$authorid || !$tid){
			output_msg('{"result":0}');
		}
		
		$sql = "SELECT a.tid,formid FROM ".DB::table('forum_thread')." t 
				INNER JOIN ".DB::table('forum_activity')." a ON t.tid = a.tid
				WHERE a.tid = $tid and authorid = $authorid ".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0')");
		$result = DB::fetch_first($sql);
		if($result){
			output_msg(json_encode(array("result"=>array('tid'=>$result['tid'],'formid'=>$result['formid']))));
		}
		output_msg('{"result":0}');
	}
	
	/**
	 * 这个用户下是否同名活动
	 * @author gtl 20161205y
	 * @global array $_G
	 */
	function isonlyinbbs(){
		global $_G;
		$title = diconv($_GET['title'], "utf-8", 'gbk');
		$uid = (int)$_GET['uid'];		
		if(!$uid || !$title){
			output_msg('{'.$this->errmsg.'"msg":{"code":431, "info":"param error"}}');
		}
		$sql = "SELECT a.tid FROM ".DB::table('forum_thread')." t 
				INNER JOIN ".DB::table('forum_activity')." a ON t.tid = a.tid
				WHERE t.authorid = $uid and subject = '$title' and displayorder>=0  ";
		$tid = DB::fetch_first($sql);
		if($tid){
			output_msg('{"result":'.$tid['tid'].'}');
		}
		output_msg('{"result":0}');
	}
	
	/**
	 * 发生关联的情况下的数据更新
	 * @author gtl 20161205y
	 */
	function updatebbsxlformid(){
		$tid = (int)$_GET['tid'];
		$formid = (int)$_POST['formid'];
		$ufield = $_POST['ufield'];
		if(!$tid || !$formid || !$ufield){
			output_msg('{"result":0}');
		}
		$data = array(
			'formid' => $formid,
			'ufield' => $ufield
		);
		DB::update('forum_activity', $data, "tid='{$tid}'");
		output_msg('{"result":1}');
	}
	
	/**
	 * 报名后需要做的一些事
	 * @author gtl 20161205y
	 */
	function afterorder(){
		global $_G;
		$apply_uid = (int)$_GET['uid'];
		$tid = (int)$_GET['tid'];
		$applynumber = (int)$_GET['applynumber'];

		//获取用户信息
		$userinfo = DB::fetch_first("SELECT username FROM ".DB::table('common_member')." where uid = ".$apply_uid);
		if(!$userinfo){
			output_msg('{"result":0}');
		}
		
		//获取帖子信息
		$postinfo = DB::fetch_first("SELECT pid, fid, tid, authorid, subject FROM ".DB::table('forum_post')." where tid = $tid and first = 1");
		if(!$postinfo){
			output_msg('{"result":0}');
		}

		//清除缓存
		clearcache_getapplyhistory($tid, $apply_uid);
		clearcache_getallorder($_G['tid']);
		clearcache_getapply($apply_uid);
		
		//新的动态表的增加
		$feedarr = array(
			'uid' 	    => $apply_uid,
			'fid' 	    => $postinfo['fid'],
			'id' 	    => $postinfo['tid'],
			'pid'  	    => $postinfo['pid'],
			'type'      => 7,
			'dateline'  => $_G[timestamp],
			'subject'   => '参加了活动',
			'message'   => '',
			'title'     => $postinfo['subject'],
			'username'  => $userinfo['username'],
		);
		require_once libfile('function/feed');
		feed_add_ucenter($feedarr);
		
		//更新下某个活动的总报名人数和已通过报名人数
		if($applynumber>0){
			$data = array('applynumber'=>"applynumber+$applynumber");
			DB::query("UPDATE ".DB::table('forum_activity')." SET applynumber=applynumber+$applynumber WHERE tid = {$tid}");
		}

		//计算当前活动热度
		setActHot($tid);

		if($postinfo['authorid'] != $apply_uid) {
			notification_add($postinfo['authorid'], 'activity', 'activity_notice', array(
				'tid' => $apply_uid,
				'subject' => $postinfo['subject'],
			));
			$space = array();
			space_merge($space, 'field_home');
		}
		
		output_msg('{"result":1}'); 
	}
	
	/**
	 * 主要用途是调用可以清除本系统缓存数据的函数 原则上这个函数的性质是可以远程执行一切函数当前环境函数 当然这还得看$funclist有没有定义 所以……
	 * @author gtl 20161129y
	 */
	function needtodo() {
		$funclist = array(
			100 => 'clearcache_getformtpllist',
			101 => 'clearcache_getapplyhistory',
			102 => 'clearcache_getallorder',
			103 => 'updateuserfieldsbyformid',
			104 => 'clearcache_getapply',
		);
		foreach ($_POST as $funccode => $args) {
			if (isset($funclist[$funccode])) {
				call_user_func_array($funclist[$funccode], unserialize(stripslashes($args)));
//				tmplogforhd('needtodo', array($funclist[$funccode], unserialize(stripslashes($args))));
			}
		}
		output_msg('{"result":1}');
	}

}

?>
