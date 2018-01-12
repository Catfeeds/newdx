<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

$fid = $_G['gp_fid'] ? $_G['gp_fid'] : 102;
$forumname = DB::result_first("SELECT name FROM " . DB::table('forum_forum') . " WHERE fid = {$fid}");
if(!$forumname){
	cpmsg("fid错误，请重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=usershow", 'succeed');
}
$datetime = strtotime("-6 month");
$allarr = $placearr = $placebaomingarr = $placequerenarr = array();
include_once DISCUZ_ROOT . './api/record/wordsmodel.class.php';
$sql = "SELECT a.*, t.dateline FROM " . DB::table('forum_activity') . " AS a LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = a.tid WHERE t.fid = {$fid} AND t.dateline >= {$datetime} ORDER BY applynumber DESC, number DESC " . getSlaveID();
$q = DB::query($sql);
while($v = DB::fetch($q))
{
	$v['keywordarr'] = wordsmodel::getkeywords($v['place']);
	$v['keyword'] = '';
	foreach($v['keywordarr'] as $k){
		//if($k['attr'] != 'ns') continue;
		$wordtmp = $k['word'];
		$boolean_pre = false;
		foreach(array('市', '县', '区', '乡') as $pre)
		{
			if($placearr[$wordtmp . $pre] >= 1)
			{
				//echo "<br />(" . $wordtmp . $pre . ")存在, [$wordtmp] ==> ";
				$wordtmp = $wordtmp . $pre;
				//echo "[$wordtmp]";
				$boolean_pre = true;
				break;
			}
		}
		if(!$boolean_pre){
			$nowordtmp = preg_replace("/(.*)(市|县|区|乡)$/i", "\\1", $wordtmp);
			if($nowordtmp != $wordtmp && isset($placearr[$nowordtmp])){
				//echo "<br />存在, [$wordtmp] => ";
				$wordtmp = $nowordtmp;
				//echo "[$wordtmp]";
			}
		}
		$placearr[$wordtmp]++;
		$placebaomingarr[$wordtmp] += $v['number'];
		$placequerenarr[$wordtmp] += $v['applynumber'];
		$v['keyword'] .= "&nbsp;[$wordtmp]<b class='wordattr'>" . iconv('utf-8', 'gbk', wordsmodel::$wordattr[$k['attr']]) . "</b>&nbsp;";
	}
	$allarr[] = $v;
}
//echo "<pre>";
arsort($placearr, SORT_NUMERIC);
arsort($placebaomingarr, SORT_NUMERIC);
arsort($placequerenarr, SORT_NUMERIC);
?>
<br />
<form action="" method="POST"><p>当前版块为<b><?=$forumname?></b>，输入新fid更换：<input type="text" name="fid" maxlength="4" size="4" />&nbsp;<input type="submit" name="submit" value="提交"/></form></p>
<br />
<table style="width: 100%;">
	<caption><h3><?php echo $forumname ?> 版块活动相关</h3></caption>
	<tbody>
		<tr>
			<th colspan="7">活动排行（报名数排行）</th>
		</tr>
		<tr>
			<td>活动地点</td>
			<td>活动开始时间</td>
			<td>活动结束时间</td>
			<td>活动创建时间</td>
			<td>活动报名人数</td>
			<td>活动确认人数</td>
			<td>活动花费</td>
		</tr>
<?php
$count_i = 0; 
foreach($allarr as $val): 
	$count_i++;
?>
		<tr>
			<td><a target="_blank" href="http://bbs.8264.com/thread-<?=$val['tid']?>-1-1.html"><?=$val['place']?></a>（拆分地点：<?=$val['keyword']?>）</td>
			<td><?php echo date('Y-m-d H:i:s', $val['starttimefrom']); ?></td>
			<td><?php echo date('Y-m-d H:i:s', $val['starttimeto']); ?></td>
			<td><?php echo date('Y-m-d H:i:s', $val['dateline']); ?></td>
			<td><?=$val['applynumber']?></td>
			<td><?=$val['number']?></td>
			<td><?=$val['cost']?></td>
		</tr>
<?php
	if($count_i >= 50) break; 
endforeach; 
?>
	</tbody>
</table>
<table style="width: 100%;">
	<tbody>
		<tr>
			<th colspan="7">活动地点排行（活动数排行）</th>
		</tr>
		<tr>
			<td>活动地点</td>
			<td>活动数量</td>
		</tr>
<?php
$count_i = 0;
foreach($placearr as $key => $val): 
	$count_i++;
?>
		<tr>
			<td><?=$key?></td>
			<td><?=$val?></td>
		</tr>
<?php
	if($count_i >= 50) break; 
endforeach; 
?>
	</tbody>
</table>
<table style="width: 100%;">
	<tbody>
		<tr>
			<th colspan="7">活动地点排行（报名数排行）</th>
		</tr>
		<tr>
			<td>活动地点</td>
			<td>报名人数</td>
		</tr>
<?php
$count_i = 0;
foreach($placebaomingarr as $key => $val): 
	$count_i++;
?>
		<tr>
			<td><?=$key?></td>
			<td><?=$val?></td>
		</tr>
<?php
	if($count_i >= 50) break; 
endforeach; 
?>
	</tbody>
</table>
<table style="width: 100%;">
	<tbody>
		<tr>
			<th colspan="7">活动地点排行（确认数排行）</th>
		</tr>
		<tr>
			<td>活动地点</td>
			<td>确认人数</td>
		</tr>
<?php
$count_i = 0;
foreach($placequerenarr as $key => $val): 
	$count_i++;
?>
		<tr>
			<td><?=$key?></td>
			<td><?=$val?></td>
		</tr>
<?php
	if($count_i >= 50) break; 
endforeach; 
?>
	</tbody>
</table>
<style>
table tbody{border:2px black solid; margin: 20px 10px;}
table td, table th{text-align: center; border-bottom:1px #CCC dotted; padding: 5px 10px;}
table td{background:#EEE}
table th{background: #4DD7F4;}
ul li{float:left; list-style: none;}
ul li{margin-right:20px;padding: 5px;}
.wordattr{margin:0 3px; font-size:12px; color:blue;}
</style>