<?php
	if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
		exit('Access Denied');
	}
	require_once libfile('class/myredis');
    $redis= & myredis::instance();
	$abc=$redis->obj->lrange('redis_record',0,-1);
	$count_taday=count($abc);
	$insert_taday=0;
	$replace_taday=0;
	$update_taday=0;
	$select_taday=0;
	$delete_taday=0;
	foreach($abc as $v){
		$arr=explode(' ',$v);
		if($arr[1]=='INSERT'){
			$insert_taday++;
		}
		if($arr[1]=='REPLACE'){
			$replace_taday++;
		}
		if($arr[1]=='UPDATE'){
			$update_taday++;
		}
		if($arr[1]=='SELECT'){
			$select_taday++;
		}
		if($arr[1]=='DELETE'){
			$delete_taday++;
		}
	}
?>
<div>
	<table border='1' width='800' >
		<caption size='18'>今日统计</caption>
		<tr align='center'>
			<td>时间</td>
			<td>SQL次数</td>
			<td>SELECT</td>
			<td>REPLACE</td>
			<td>INSERT</td>
			<td>DELETE</td>
			<td>UPDATE</td>
		</tr>
		<tr align='center'>
			<td><?php echo date('Y-m-d',time()); ?></td>
			<td><?php echo $count_taday; ?></td>
			<td><?php echo $select_taday;echo '('.round($select_taday/$count_taday*100,1).'%)'; ?></td>
			<td><?php echo $replace_taday;echo '('.round($replace_taday/$count_taday*100,1).'%)'; ?></td>
			<td><?php echo $insert_taday;echo '('.round($insert_taday/$count_taday*100,1).'%)'; ?></td>
			<td><?php echo $delete_taday;echo '('.round($delete_taday/$count_taday*100,1).'%)'; ?></td>
			<td><?php echo $update_taday;echo '('.round($update_taday/$count_taday*100,1).'%)'; ?></td>
		</tr>
		<tr></tr>
		<tr><td colspan='7' align='right'><a href=<?php echo ADMINSCRIPT.'?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=record_today'; ?>>今日详情请点击-></a></td></tr>

	</table>
	<br/>

<?php
	$count_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record'));
	$select_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='SELECT'");
	$replace_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='REPLACE'");
	$insert_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='INSERT'");
	$delete_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='DELETE'");
	$update_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='UPDATE'");
?>
	<table border='1' width='800' >
		<caption size='18'>历史统计</caption>
		<tr align='center'>
			<td>截至时间</td>
			<td>SQL次数</td>
			<td>SELECT</td>
			<td>REPLACE</td>
			<td>INSERT</td>
			<td>DELETE</td>
			<td>UPDATE</td>
		</tr>
		<tr align='center'>
			<td><?php echo date('Y-m-d',time()-24*3600); ?></td>
			<td><?php echo $count_history; ?></td>
			<td><?php echo $select_history;echo '('.round($select_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $replace_history;echo '('.round($replace_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $insert_history;echo '('.round($insert_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $delete_history;echo '('.round($delete_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $update_history;echo '('.round($update_history/$count_history*100,1).'%)'; ?></td>
		</tr>
		<tr></tr>
		<tr><td colspan='7' align='right'><a href=<?php echo ADMINSCRIPT.'?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=record_history'; ?>>历史详情请点击-></a></td></tr>

	</table>
</div>
