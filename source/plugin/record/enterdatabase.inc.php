<?php
	global $_G;
	if($_G['uid']!=1){
		die();
	}
	$link=@mysql_connect($_G['config']['db']['1']['dbhost'],$_G['config']['db']['1']['dbuser'],$_G['config']['db']['1']['dbpw']) or die('MySQL connect failure');
	mysql_select_db($_G['config']['db']['1']['dbname']);
	require_once libfile('class/myredis');
    $redis = & myredis::instance();
	//$redis->obj->expireAt('re_redis_record',1);
	if($redis->connected){//�ж�redis �Ƿ����ӳɹ�
		$redis->obj->renameNx('redis_record','re_redis_record');
		$redis_record_size=$redis->obj->lsize('re_redis_record');
		
		//ÿ�β�����������
		$everysize=1000;
		
		$count=ceil($redis_record_size/$everysize);
		$time_start=time();
		$enter_sql_page=memory('get','enter_sql_page')?memory('get','enter_sql_page'):'1';
		if($enter_sql_page){
			$start=($enter_sql_page-1)*$everysize;
			$end = $enter_sql_page*$everysize-1;
		}
		
		if($enter_sql_page==$count){
			$redis_record=$redis->obj->lRange('re_redis_record',$start,-1);
		}else{
			$redis_record=$redis->obj->lRange('re_redis_record',$start,$end);
		}
		
		if($redis_record){

			$mem_record_setting=memory('get','mem_record_setting');
			$mem_record_setting=unserialize($mem_record_setting);
			$tablename_arr=array_keys($mem_record_setting);
			foreach($redis_record as $value){
				$list=explode(' ',$value);
				$sqltime=$list[0];
				$sqltype=$list[1];
				unset($list[0]);
				$sqlcontent=base64_encode(implode(' ',$list));
				$tablename=array();
				foreach($list as $v){
					$pos = strpos($v,'pre_');
					if($pos === false){
						continue;
					}else{
						$temp=strpos($v,'(');
						if($temp){
							$tablename[]=substr($v,0,$temp);
						}else{
							$tablename[]=$v;
						}
					}
				}
				$othertable='';
				$table='';
				foreach($tablename as $tk => $tn){
					if(in_array($tn,$tablename_arr)){
						$table=trim($tn);
						unset($tablename[$tk]);
						$othertable = implode(',',$tablename);	
						mysql_query("INSERT INTO pre_plugin_record(time,type,tablename,othertable,content) VALUES('{$sqltime}','{$sqltype}','{$table}','{$othertable}','{$sqlcontent}')");
						
					}
				}
			}
			$time_end=time();
			
			if($enter_sql_page==$count){
				$redis->obj->expireAt('re_redis_record',1);
				echo "<p>COMPLETE!</p>";
				$url = "admin.php?action=plugins&operation=config&do={$pluginid}&identifier=record&pmod=setting";
				echo "<meta http-equiv='refresh'content=5;URL='$url'>";
			}else{
				++$enter_sql_page;
				memory('set','enter_sql_page',$enter_sql_page,20);
				$url = "plugin.php?id=record:enterdatabase";	
				
				echo "<div style='position:absolute;left:20%;top:30%'>";
				echo "<h1 style='font-size:18px;'>����ִ���Զ���ӹ��ܣ�ÿ5���Զ�ִ��һ��</h1>";
				echo "<fieldset style='padding:20px;'><legend><b>�����Ϣ</b></legend>";
				echo "<p>ִ�е�".($start+1)."��".($end+1)."����</p>";
				echo "<p>����ʱ<b style='color:green'>".($time_end-$time_start)."</b>��</p></fieldset></div>";
				echo "<meta http-equiv='refresh'content=5;URL='$url'>";
			}
		}		
	}
?>