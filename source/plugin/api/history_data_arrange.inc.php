<?php
	//http://bbs.8264.com/plugin.php?id=api:history_data_arrange
	if(!defined('IN_DISCUZ')){
		exit('Access Denied');
	}

	/*
	$time_start = time();

	// $typeiddataarr = memory('get','typeiddataarr');

	// if(!$typeiddataarr){
		$query = DB::query("SELECT typeid FROM ".DB::table('forum_threadclass')." ORDER BY typeid");
		$typeidarr = array();
		while($row = DB::fetch($query)){
			$typeidarr[$row['typeid']] = 1;
		}
		$typeiddataarr = $typeidarr;
		// memory('set','typeiddataarr',$typeiddataarr,1800);
	// }

	// var_dump($typeiddataarr);exit;

	//��ǰͳ�Ƶ�����ʱ��
	$logdate_min = DB::result_first("SELECT MIN(logdate) FROM ".DB::table('plugin_statlog_detail'));

	$logdate_arr = explode('-',$logdate_min);

	$endtime = $_GET['endtime']?$_GET['endtime']:mktime(0,0,0,$logdate_arr[1],$logdate_arr[2],$logdate_arr[0]);

	$starttime = $_GET['starttime']?$_GET['starttime']:($endtime-24*3600);

	//ǰһ������ʱ�����
	$time = date("Y-m-d",$endtime-7200);

	if($time == "2012-10-15"){
		echo "<div style='position:absolute;left:20%;top:30%'>";
		echo "<h1 style='font-size:18px;'>�����ʷ���ݹ���</h1>";
		echo "<fieldset style='padding:20px;'><legend><b>�������</b></legend>";
		echo "<p>���ڣ�<b style='color:red'>".$time."</b></p>";
		echo "<p>ִ�б������������</p>";
		exit;
	}

	$query1 = DB::query("SELECT tid,typeid FROM ".DB::table('forum_thread')." WHERE typeid >0 AND dateline <$endtime AND lastpost >=$starttime");

	// echo "SELECT typeid,tid FROM ".DB::table('forum_thread')." WHERE typeid >0 AND (dateline >=$starttime OR lastpost >=$starttime) ORDER BY typeid ";exit;

	$tidarr = array();
	while($row = DB::fetch($query1)){
		$tidarr[$row['typeid']][] = $row['tid'];
	}


	foreach($tidarr as $key => $value){

		unset($typeiddataarr[$key]);

		$tidstr = implode(',',$value);

		if(isset($tidstr{0})){
			$todaycount = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid in (".$tidstr.") AND dateline >= {$starttime} AND dateline < {$endtime}");
			$count = $todaycount;
		}else{
			$count = '0';
		}

		DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$time}','{$key}','1','{$count}')");

	}

	foreach($typeiddataarr as $key => $value){

		DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$time}','{$key}','1','0')");

	}

	// $i = memory('get','typeid_arr_i');
	// if(!$i) $i = 0;

	// $one_count = $i+50;

	// $typeidcount = count($typeiddataarr);

	// for($i;$i<$one_count;++$i){
		// $typeid = $typeiddataarr[$i];

		// if(!$typeid)break;

		// $query1 = DB::query("SELECT tid FROM ".DB::table('forum_thread')." WHERE typeid = {$typeid} ORDER BY tid ");

		// $tidarr = array();
		// while($row = DB::fetch($query1)){
			// $tidarr[] = $row['tid'];
		// }

		// $tidstr = implode(',',$tidarr);

		// if(isset($tidstr{0})){
			// $todaycount = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid in (".$tidstr.") AND dateline >= {$starttime} AND dateline < {$endtime}");
			// $count = $todaycount;
		// }else{
			// $count = '0';
		// }

		// DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$time}','{$typeid}','1','{$count}')");

		// memory('set','typeid_arr_i',$i,1800);

	// }

	$time_end = time();
	$time_cha = $time_end-$time_start;

	// if($i == $typeidcount){
		// memory('rm','typeiddataarr');
		// memory('rm','typeid_arr_i');
		// $url = "plugin.php?id=api:history_data_arrange";
		// echo "<div style='position:absolute;left:20%;top:30%'>";
		// echo "<h1 style='font-size:18px;'>�����ʷ���ݹ���</h1>";
		// echo "<fieldset style='padding:20px;'><legend><b>�������</b></legend>";
		// echo "<p>���ڣ�<b style='color:red'>".$time."</b></p>";
		// echo "<p>ִ�б������������</p>";
		// echo "<meta http-equiv='refresh'content=1;URL='$url'>";
		// exit;
	// }

	$url = "plugin.php?id=api:history_data_arrange";
	echo "<div style='position:absolute;left:20%;top:30%'>";
	echo "<h1 style='font-size:18px;'>�����ʷ���ݹ���</h1>";
	echo "<fieldset style='padding:20px;'><legend><b>������Ϣ</b></legend>";
	echo "<p>���ڣ�<b style='color:red'>".$time."</b></p>";
	echo "<p>������ʱ<b style='color:green'>".$time_cha."</b>��</p></fieldset></div>";
	echo "<meta http-equiv='refresh'content=1;URL='$url'>";


	*/
	//------�����ǹ����Ӱ���������
	//**********************************************************************
	//**********************************************************************
	//**********************************************************************
	//**********************************************************************
	//**********************************************************************
	//�޸����շ���
//	$yesterdayposts = intval(DB::result_first("SELECT sum(todayposts) FROM ".DB::table('forum_forum').""));
//	$historypost = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='historyposts'");
//	save_syscache('historyposts', $historypost);
	//------�������޸�ĳЩ��Ĵ�������
	$time = array("2015-01-13");
	$mtime = array();
	foreach($time as $key => $value){
		$timearr = explode('-',$value);
		$mtime[] = mktime(0,0,0,$timearr[1],$timearr[2],$timearr[0]);
	}

	//�õ�typeid ����
	$query = DB::query("SELECT typeid FROM ".DB::table('forum_threadclass')." ORDER BY typeid");
	$typeidarr = array();
	while($row = DB::fetch($query)){
		$typeidarr[$row['typeid']] = 0;
	}
	$typeiddataarr = $typeidarr;

	//�õ�fid ����
	$query2 = DB::query("SELECT fid FROM ".DB::table('forum_forum')." WHERE `type`<>'group' AND `status`<>'3'");
	$fidarr = array();
	while($row = DB::fetch($query2)){
		$fidarr[$row['fid']] = 1;
	}

	$fiddataarr = $fidarr;
	$j = count($time);
	for($i=0;$i<$j;++$i){

		$starttime = $mtime[$i];
		$endtime = $starttime + 60 * 60 * 24;
		$day = $time[$i];
		//----�Ӱ�ͳ��start------
		// $query1 = DB::query("SELECT tid,typeid FROM ".DB::table('forum_thread')." WHERE typeid >0 AND dateline <$endtime AND lastpost >=$starttime");

		// $tidarr = array();
		// while($row = DB::fetch($query1)){
			// $tidarr[$row['typeid']][] = $row['tid'];
		// }

		// foreach($tidarr as $key => $value){

			// unset($typeiddataarr[$key]);
			// $tidstr = implode(',',$value);
			// if(isset($tidstr{0})){
				// $todaycount = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid in (".$tidstr.") AND dateline >= {$starttime} AND dateline < {$endtime}");
				// $count = $todaycount;
			// }else{
				// $count = '0';
			// }

			// DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$day}','{$key}','1','{$count}')");

		// }
        $sql = "SELECT count(*) as count ,t.typeid FROM ".DB::table('forum_thread')." t LEFT JOIN ".DB::table('forum_post')." p ON t.tid=p.tid WHERE t.typeid>0 and p.dateline >= {$starttime} AND p.dateline < {$endtime} GROUP BY t.typeid " . getSlaveID();
		$query = DB::query($sql);
		echo '<br/>'.$day.':'.$sql;
        while($value = DB::fetch($query)){
			$typeiddataarr[$value['typeid']] = $value['count'];
		}
		foreach($typeiddataarr as $k => $v){
			DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$day}','{$k}','1','{$v}')");
		}
		// if(count($typeiddataarr)>0){
			// foreach($typeiddataarr as $key => $value){
				// DB::query("REPLACE INTO ".DB::table('plugin_statlog_detail')."(logdate, typeid, `type`, `value`) VALUES('{$day}','{$key}','1','0')");
			// }
		// }

		$typeiddataarr = $typeidarr;
		//----�Ӱ�ͳ��end------

		//----���ͳ��start------
		$query3 = DB::query("SELECT fid,count(*) as c FROM ".DB::table('forum_post')." WHERE fid >0 AND dateline <$endtime AND dateline >=$starttime group by fid ". getSlaveID());

		while($row = DB::fetch($query3)){
			DB::query("REPLACE INTO ".DB::table('forum_statlog')."(logdate, fid, `type`, `value`) VALUES('{$day}','{$row['fid']}','1','{$row['c']}')");

			unset($fiddataarr[$row['fid']]);
		}

		if(count($fiddataarr)>0){
			foreach($fiddataarr as $key => $value){
				DB::query("REPLACE INTO ".DB::table('forum_statlog')."(logdate, fid, `type`, `value`) VALUES('{$day}','{$key}','1','0')");
			}
		}

		$fiddataarr = $fidarr;

		//----���ͳ��end------
	}

