<?php
	if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
		exit('Access Denied');
	}
	require_once libfile('class/myredis');
    $redis= & myredis::instance();
	$loglist=$redis->obj->lrange('redis_record',0,-1);

	$count=count($loglist);
	$ppp = 200;
	$page = max(1, intval($_G['gp_page']));

	echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=record_today");
	showtableheader();
	echo "<tr align='center'><td>序号</td><td>执行时间</td><td>操作类型</td><td width='1000'>SQL语句</td></tr>";
	$i=1;

	$loglist=array_chunk($loglist,$ppp);

	foreach($loglist[$page-1] as $value){
		$sqllogline=explode(' ',$value);
		$time=date('Y-m-d H:i:s',$sqllogline[0]);
		unset($sqllogline[0]);
		$type=$sqllogline[1];
		$content=implode(' ',$sqllogline);
		echo "<tr align='center'><td>{$i}</td><td>{$time}</td><td>{$type}</td><td>";

		if(strlen($content)>150){
			$short_content = substr($content,0,150).'...';
		}else{
			$short_content = $content;
		}
		echo "<div onclick=show(this); style='display:block'>{$short_content}</div>";
		echo "<div onclick=hide(this); style='background:#cccccc;display:none'><br>{$content}</div>";

		echo "</td></tr>";
		$i++;
	}

	showtablefooter();
	echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=record_today");
?>
<script>
	function show(obj){
		if(obj.nextSibling.style.display=="none"){
			obj.nextSibling.style.display="block";
		}else if(obj.nextSibling.style.display=="block"){
			obj.nextSibling.style.display="none";
		}
	}
	function hide(obj){
		obj.style.display="none";
	}
</script>
