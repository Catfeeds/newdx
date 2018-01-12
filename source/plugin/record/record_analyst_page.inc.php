<?php
	if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
		exit('Access Denied');
	}

	$time_start=time();
	$mem_tablename=memory('get','mem_tablename');
	$sql_type_arr=unserialize(memory('get',$mem_tablename));
	$analyst_page=memory('get','analyst_page')?memory('get','analyst_page'):'1';
	$ppp=memory('get','ppp');
	$count=memory('get','count');
	$totalpage = ceil($count/$ppp);

	$start=($analyst_page-1)*$ppp;
	$end=$analyst_page*$ppp;
	$limit=" limit {$start},{$ppp}";

	$result = DB::query("SELECT time,type,tablename,othertable,content FROM ".DB::table(plugin_record)." WHERE type='select' {$where} ORDER BY time desc {$limit}");

	while($row=DB::fetch($result)){
		$sql=base64_decode($row['content']);
		workedsql($sql);
	}

	$time_end=time();

	if($analyst_page==$totalpage){
		echo "<p>COMPLETE!</p>";
		$data=serialize($sql_type_arr);
		memory('set',$mem_tablename,$data,3600*4);
		$url = "admin.php?action=plugins&operation=config&do={$pluginid}&identifier=record&pmod=record_analyst";
		echo "<meta http-equiv='refresh'content=5;URL='$url'>";
	}else{
		++$analyst_page;
		memory('set','analyst_page',$analyst_page,100);
		$url = "plugin.php?id=record:record_analyst_page";

		$data=serialize($sql_type_arr);
		memory('set',$mem_tablename,$data,3600*4);

		echo "<div style='position:absolute;left:20%;top:30%'>";
		echo "<h1 style='font-size:18px;'>正在执行自动分析功能，每5秒自动执行一次</h1>";
		echo "<fieldset style='padding:20px;'><legend><b>分析信息</b></legend>";
		echo "<p>表名：<b style='color:red'>".$mem_tablename."</b></p>";
		echo "<p>一共<b style='color:red'>".$count."</b>条。</p>";
		echo "<p>执行第".($start+1)."到".$end."条。</p>";
		echo "<p>共用时<b style='color:green'>".($time_end-$time_start)."</b>秒</p></fieldset></div>";
		echo "<meta http-equiv='refresh'content=5;URL='$url'>";
	}

	function workedsql($sql){
		global $sql_type_arr;

		$startleftjoin=strpos($sql,' join ');
		$startwhere=strpos($sql,'where ');
		$startorder=strpos($sql,'order by');
		$startlimit=strpos($sql,'limit');

		if($startleftjoin){
			$str_leftjoin=substr($sql,$startleftjoin,$startwhere-$startleftjoin);
			$str_join = sqlhaveleftjoin($str_leftjoin);
		}

		//每种类型存储sql的条数
		$sql_count=5;

		if($startwhere){//有where
			if($startorder){//有 order by
				if($startlimit){//有 limit
					//where  order by  limit
					$str_where=substr($sql,$startwhere,$startorder-$startwhere);
					$str_order=substr($sql,$startorder,$startlimit-$startorder);
					$str_limit=substr($sql,$startlimit);
					$preg_whereorderlimit_arr=array_keys($sql_type_arr['7']);
					$mark=false;
					foreach($preg_whereorderlimit_arr as $value){
						if(preg_match($value,$sql)){
							$mark=true;
							$key=$value;
							break;
						}else{
							$mark=false;
						}
					}

					if($mark){
						$sql_type_arr['7'][$key][0]+=1;
						if($sql_type_arr['7'][$key][0]<=$sql_count){
							$sql_type_arr['7'][$key][1][]=$sql;
						}
					}else{
						$preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).sqlhaveorder($str_order).'limit (.*)/ius';
						$preg_str = str_replace(' ','\s*',$preg_str);
						if(in_array($preg_str,$preg_whereorderlimit_arr)){
							$sql_type_arr['7'][$preg_str][0]+=1;
						}else{
							$sql_type_arr['7'][$preg_str][0]=1;
						}
						if($sql_type_arr['7'][$preg_str][0]<=$sql_count){
							$sql_type_arr['7'][$preg_str][1][]=$sql;
						}
					}

				}else{//没有 limit
					//where  order by
					$str_where=substr($sql,$startwhere,$startorder-$startwhere);
					$str_order=substr($sql,$startorder);

					$preg_whereorder_arr=array_keys($sql_type_arr['4']);
					$mark=false;
					foreach($preg_whereorder_arr as $v){
						if(preg_match($v,$sql)){
							$mark=true;
							$key=$v;
							break;
						}else{
							$mark=false;
						}
					}
					if($mark){
						$sql_type_arr['4'][$key][0]+=1;
						if($sql_type_arr['4'][$key][0]<=$sql_count){
							$sql_type_arr['4'][$key][1][]=$sql;
						}
					}else{
						$preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).sqlhaveorder($str_order).'/ius';
						$preg_str = str_replace(' ','\s*',$preg_str);
						if(in_array($preg_str,$preg_whereorder_arr)){
							$sql_type_arr['4'][$preg_str][0]+=1;
						}else{
							$sql_type_arr['4'][$preg_str][0]=1;
						}
						if($sql_type_arr['4'][$preg_str][0]<=$sql_count){
							$sql_type_arr['4'][$preg_str][1][]=$sql;
						}

					}
				}
			}else{//没有 order by
				if($startlimit){//有 limit
					//where limit
					$str_where=substr($sql,$startwhere,$startlimit-$startwhere);
					$str_limit=substr($sql,$startlimit);

					$preg_wherelimit_arr=array_keys($sql_type_arr['5']);
					$mark=false;
					foreach($preg_wherelimit_arr as $v){
						if(preg_match($v,$sql)){
							$mark=true;
							$key=$v;
							break;
						}else{
							$mark=false;
						}
					}
					if($mark){
						$sql_type_arr['5'][$key][0]+=1;
						if($sql_type_arr['5'][$key][0]<=$sql_count){
							$sql_type_arr['5'][$key][1][]=$sql;
						}
					}else{
						$preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).'limit (.*)/ius';
						$preg_str = str_replace(' ','\s*',$preg_str);
						if(in_array($preg_str,$preg_wherelimit_arr)){
							$sql_type_arr['5'][$preg_str][0]+=1;
						}else{
							$sql_type_arr['5'][$preg_str][0]=1;
						}
						if($sql_type_arr['5'][$preg_str][0]<=$sql_count){
							$sql_type_arr['5'][$preg_str][1][]=$sql;
						}
					}

				}else{//没有 limit
					//where
					$str_where=substr($sql,$startwhere);

					$preg_where_arr=array_keys($sql_type_arr['1']);
					$mark=false;
					foreach($preg_where_arr as $v){
						if(preg_match($v,$str_where)){
							$mark=true;
							$key=$v;
							break;
						}else{
							$mark=false;
						}
					}
					if($mark){
						$sql_type_arr['1'][$key][0]+=1;
						if($sql_type_arr['1'][$key][0]<=$sql_count){
							$sql_type_arr['1'][$key][1][]=$sql;
						}
					}else{
						$preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).'/ius';
						$preg_str = str_replace(' ','\s*',$preg_str);
						if(in_array($preg_str,$preg_where_arr)){
							$sql_type_arr['1'][$preg_str][0]+=1;
						}else{
							$sql_type_arr['1'][$preg_str][0]=1;
						}
						if($sql_type_arr['1'][$preg_str][0]<=$sql_count){
							$sql_type_arr['1'][$preg_str][1][]=$sql;
						}
					}
				}
			}
		}else{//没有where条件

			if($startorder){//有 order by
				if($startlimit){//有 limit
					//order by  limit

					$str_order=substr($sql,$startorder,$startlimit-$startorder);
					$str_limit=substr($sql,$startlimit);

					$preg_orderlimit_arr=array_keys($sql_type_arr['6']);
					$mark=false;
					foreach($preg_orderlimit_arr as $v){
						if(preg_match($v,$sql)){
							$mark=true;
							$key=$v;
							break;
						}else{
							$mark=false;
						}
					}
					if($mark){
						$sql_type_arr['6'][$key][0]+=1;
						if($sql_type_arr['6'][$key][0]<=$sql_count){
							$sql_type_arr['6'][$key][1][]=$sql;
						}
					}else{
						$preg_str='/select(.*)from(.*)'.$str_join.sqlhaveorder($str_order).'limit (.*)/ius';
						$preg_str = str_replace(' ','\s*',$preg_str);
						if(in_array($preg_str,$preg_orderlimit_arr)){
							$sql_type_arr['6'][$preg_str][0]+=1;
						}else{
							$sql_type_arr['6'][$preg_str][0]=1;
						}
						if($sql_type_arr['6'][$preg_str][0]<=$sql_count){
							$sql_type_arr['6'][$preg_str][1][]=$sql;
						}
					}
				}else{//没有 limit
					//order by

					$str_order=substr($sql,$startorder);
					$preg_order_arr=array_keys($sql_type_arr['2']);
					$mark=false;
					foreach($preg_order_arr as $v){
						if(preg_match($v,$str_order)){
							$mark=true;
							$key=$v;
							break;
						}else{
							$mark=false;
						}
					}
					if($mark){
						$sql_type_arr['2'][$key][0]+=1;
						if($sql_type_arr['2'][$key][0]<=$sql_count){
							$sql_type_arr['2'][$key][1][]=$sql;
						}
					}else{
						$preg_str='/select(.*)from(.*)'.$str_join.sqlhaveorder($str_order).'/ius';
						$preg_str = str_replace(' ','\s*',$preg_str);
						if(in_array($preg_str,$preg_order_arr)){
							$sql_type_arr['2'][$preg_str][0]+=1;
						}else{
							$sql_type_arr['2'][$preg_str][0]=1;
						}
						if($sql_type_arr['2'][$preg_str][0]<=$sql_count){
							$sql_type_arr['2'][$preg_str][1][]=$sql;
						}
					}
				}
			}else{//没有 order by
				if($startlimit){//有 limit
					//limit

					$str_limit=substr($sql,$startlimit);
					$preg_str='/select(.*)from(.*)'.$str_join.'limit (.*)/ius';

					if(preg_match($preg_str,$str_limit)){
						$sql_type_arr['3'][$preg_str][0]+=1;
						if($sql_type_arr['3'][$preg_str][0]<=$sql_count){
							$sql_type_arr['3'][$preg_str][1][]=$sql;
						}
					}

				}else{//没有 limit
					//select * from AAA
					$sql_type_arr['8']['select A from B'][0]+=1;
					if($sql_type_arr['8']['select A from B'][0]<=$sql_count){
						$sql_type_arr['8']['select A from B'][1][]=$sql;
					}
				}
			}
		}
	}

	function sqlhaveleftjoin($sql){
		$num=substr_count($sql,' join ');
		$str_join='';
		for($i=0;$i<$num;$i++){
			$str_join.='[(left join)|(right join)]+(.*)';
		}
		$preg_join="/".$str_join."/ius";
		if(preg_match($preg_join,$sql)){
			return $str_join;
		}else{
			return '';
		}
	}

	function sqlhavewhere($sql){

		$num=substr_count($sql,' and ');
		$str_where='';
		for($i=0;$i<$num;$i++){
			$str_where.=' and (.*)[=|<>|in|like](.*)';
		}
		$arr=array();
		$str='/where (.*)[=|<>|in|like](.*)'.$str_where.'/ius';
		preg_match($str,$sql,$arr);
		$j=count($arr);
		$string='';
		$arr_temp=array();
		for($i=1;$i<$j;$i+=2){
			$arr[$i]=addcslashes($arr[$i],'.');
			$arr[$i]=addcslashes($arr[$i],'*');
			$or_num=substr_count($arr[$i],' or ');
			if($or_num){
				$arr[$i]=substr($arr[$i],1);
				$or_str='';
				if($or_num==1){
					$or_str.=" or (.*)";
				}else{
					for($k=0;$k<$or_num;++$k){
						$or_str.=" or (.*)[=|<>|in|like]\s*\w*";
					}
				}
				$or_str="/(.*)[=|<>|in|like]\s*\w*".$or_str."/ius";
				$or_arr=array();
				$or_temp=array();
				$or_sql=$arr[$i];
				preg_match($or_str,$or_sql,$or_arr);
				$n=count($or_arr);
				for($m=1;$m<$n;++$m){
					$or_temp[]="{$or_arr[$m]}=\s*\w*";
				}
				$arr_temp[]="\(".implode(' or ',$or_temp)."\)";
			}else{
				$arr_temp[]="{$arr[$i]}[=|<>|in|like](.*)";
			}
		}
		$string=implode(' and ',$arr_temp);
		$str='where '.$string;
		return $str;

	}

	function sqlhaveorder($sql){
		$str='/order by (.*)[ desc| asc]?/ius';
		preg_match($str,$sql,$arr);
		$arr[1]=addcslashes($arr[1],'.');
		$str='order by '.$arr[1];
		return $str;
	}
