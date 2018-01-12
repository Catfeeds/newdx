<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

require_once DISCUZ_ROOT . './api/record/recordmodel.class.php';
require_once DISCUZ_ROOT . './api/record/keywordmodel.class.php';

$fid = $_POST['fid'] ? $_POST['fid'] : ($_G['gp_fid'] ? $_G['gp_fid'] : 102);
$forumname = DB::result_first("SELECT name FROM " . DB::table('forum_forum') . " WHERE fid = {$fid}");
if(!$forumname){
	cpmsg("fid错误，请重新选择", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=usershow", 'error');
}
$uidarr = $uidnamearr = array();
$count_week = $count_month = $count_threemonth = $count_userline = $count_baoming = $count_halfbaoming = array();
$nowtime = time();
$threemonthbefore = $nowtime - 100*24*3600;
$monthbefore = $nowtime - 50*24*3600;
$weekbefore = $nowtime - 20*24*3600;
$halfyearbefore = strtotime('-6 month');
$sql = "SELECT count(*)/7 AS threadcount, authorid, author FROM " . DB::table('forum_thread') . " WHERE fid = {$fid} AND displayorder >= 0 AND dateline >= {$weekbefore} AND dateline <= {$nowtime} GROUP BY authorid " . getSlaveID();
$q = DB::query($sql);
while($v = DB::fetch($q)){
	$uidarr[] = $v['authorid'];
	$uidnamearr[$v['authorid']] = $v['author'];
	$count_week[$v['authorid']] = $v['threadcount'];
}
require_once libfile('class/myredis');
$myredis = myredis::instance(6382);
$keyname = 'plugin_tuisong_user_array_fid_' . $fid;
$tuisonguser = $myredis->HGETALL($keyname);
if($_G['gp_method'] == 'adduser'){
	if($_G['gp_adduid'] > 0){
		$addusername = DB::result_first("SELECT username FROM " . DB::table('common_member') . " WHERE uid = {$_G['gp_adduid']}");
		if($addusername){
			$myredis->hashset($keyname, $_G['gp_adduid'], $addusername);
		}
		//$tuisonguser[$_G['gp_adduid']] = $_G['gp_adduid'];
		//memory('set', 'plugin_tuisong_user_array', $tuisonguser);
	}
}elseif($_G['gp_method'] == 'deluser'){
	if($_G['gp_deluid'] > 0){
		$myredis->hashdel($keyname, $_G['gp_deluid']);
		//unset($tuisonguser[$_G['gp_deluid']]);
		//memory('set', 'plugin_tuisong_user_array', $tuisonguser);
	}
}
$tuisonguser = $myredis->HGETALL($keyname);
$ids = "";
foreach($uidarr as $_uid){
	$ids[] = $_uid;
	if(count($ids) >= 100){
		$sql = "SELECT count(*)/30 AS threadcount, authorid FROM " . DB::table('forum_thread') . " WHERE fid = {$fid} AND  authorid IN(" . implode(',', $ids) . ") AND displayorder >= 0 AND dateline >= {$monthbefore} AND dateline <= {$nowtime} GROUP BY authorid " . getSlaveID();
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$count_month[$v['authorid']] = $v['threadcount'];
		}
		$sql = "SELECT count(*)/90 AS threadcount, authorid FROM " . DB::table('forum_thread') . " WHERE fid = {$fid} AND  authorid IN(" . implode(',', $ids) . ") AND displayorder >= 0 AND dateline >= {$threemonthbefore} AND dateline <= {$nowtime} GROUP BY authorid " . getSlaveID();
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$count_threemonth[$v['authorid']] = $v['threadcount'];
		}
		$sql = "SELECT count(*) as count, a.uid FROM " . DB::table('forum_activity') . " AS a LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = a.tid WHERE t.fid = {$fid} AND a.nature = 2 AND a.uid IN(" . implode(',', $uidarr) . ") GROUP BY a.uid " . getSlaveID();
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$count_userline[$v['uid']] = $v['count'];
		}
		$sql = "SELECT count(*) as count, aa.uid FROM " . DB::table('forum_activityapply') . " AS aa LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = aa.tid WHERE t.fid = {$fid} AND aa.verified = 1 AND aa.uid IN(" . implode(',', $uidarr) . ") GROUP BY aa.uid " . getSlaveID();
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$count_baoming[$v['uid']] = $v['count'];
		}
		$sql = "SELECT count(*) as count, aa.uid FROM " . DB::table('forum_activityapply') . " AS aa LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = aa.tid WHERE t.fid = {$fid} AND aa.verified = 1 AND aa.uid IN(" . implode(',', $uidarr) . ") AND t.dateline >= {$halfyearbefore} GROUP BY aa.uid " . getSlaveID();
		$q = DB::query($sql);
		while($v = DB::fetch($q)){
			$count_halfbaoming[$v['uid']] = $v['count'];
		}
		$ids = array();
	}
}
if($ids){
	$sql = "SELECT count(*)/30 AS threadcount, authorid FROM " . DB::table('forum_thread') . " WHERE fid = {$fid} AND  authorid IN(" . implode(',', $ids) . ") AND displayorder >= 0 AND dateline >= {$monthbefore} AND dateline <= {$nowtime} GROUP BY authorid " . getSlaveID();
	$q = DB::query($sql);
	while($v = DB::fetch($q)){
		$count_month[$v['authorid']] = $v['threadcount'];
	}
	$sql = "SELECT count(*)/90 AS threadcount, authorid FROM " . DB::table('forum_thread') . " WHERE fid = {$fid} AND  authorid IN(" . implode(',', $ids) . ") AND displayorder >= 0 AND dateline >= {$threemonthbefore} AND dateline <= {$nowtime} GROUP BY authorid " . getSlaveID();
	$q = DB::query($sql);
	while($v = DB::fetch($q)){
		$count_threemonth[$v['authorid']] = $v['threadcount'];
	}
	$sql = "SELECT count(*) as count, a.uid FROM " . DB::table('forum_activity') . " AS a LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = a.tid WHERE t.fid = {$fid} AND a.nature = 2 AND a.uid IN(" . implode(',', $uidarr) . ") GROUP BY a.uid " . getSlaveID();
	$q = DB::query($sql);
	while($v = DB::fetch($q)){
		$count_userline[$v['uid']] = $v['count'];
	}
	$sql = "SELECT count(*) as count, aa.uid FROM " . DB::table('forum_activityapply') . " AS aa LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = aa.tid WHERE t.fid = {$fid} AND aa.verified = 1 AND aa.uid IN(" . implode(',', $uidarr) . ") GROUP BY aa.uid " . getSlaveID();
	$q = DB::query($sql);
	while($v = DB::fetch($q)){
		$count_baoming[$v['uid']] = $v['count'];
	}
	$sql = "SELECT count(*) as count, aa.uid FROM " . DB::table('forum_activityapply') . " AS aa LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = aa.tid WHERE t.fid = {$fid} AND aa.verified = 1 AND aa.uid IN(" . implode(',', $uidarr) . ") AND t.dateline >= {$halfyearbefore} GROUP BY aa.uid " . getSlaveID();
	$q = DB::query($sql);
	while($v = DB::fetch($q)){
		$count_halfbaoming[$v['uid']] = $v['count'];
	}
	$ids = array();
}
$count_avg = array();
foreach($uidarr as $_uid){
	$count_avg[$_uid] = ($count_week[$_uid] + $count_month[$_uid] + $count_threemonth[$_uid]) / 3;
}

$sql = "SELECT count(*) as count, aa.uid, m.username FROM " . DB::table('forum_activityapply') . " AS aa LEFT JOIN " . DB::table('forum_thread') . " AS t ON t.tid = aa.tid LEFT JOIN " . DB::table('common_member') . " AS m ON m.uid = aa.uid WHERE t.fid = {$fid} AND aa.verified = 1 AND t.dateline >= {$halfyearbefore} GROUP BY aa.uid ORDER BY count DESC LIMIT 200 " . getSlaveID();
$q = DB::query($sql);
$halfyearcanjia = $canjiauid = array();
while($v = DB::fetch($q)){
	$v['intop'] = in_array($v['uid'], $uidarr) ? true : false;
	$halfyearcanjia[] = $v;
}

arsort($count_avg, SORT_NUMERIC);
arsort($count_week, SORT_NUMERIC);
arsort($count_month, SORT_NUMERIC);
arsort($count_threemonth, SORT_NUMERIC);
?>
<br />
<form action="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow" method="POST"><p>当前版块为<font color="red"><b><?=$forumname?></b></font>，输入新fid更换：<input type="text" name="fid" maxlength="4" size="4" />&nbsp;<input type="submit" name="submit" value="提交"/>&nbsp;<?php if (($tuisongcount = count($tuisonguser)) > 0): ?>当前共推送<b style="color: blue;"><?=$tuisongcount?></b>人<?php endif;?><a style="margin-left: 20px;" href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&alladd=1&fid=<?php echo $fid;?>">全部加入(非领队)</a></form></p>
<br />
<table style="width: 100%;">
	<tbody>
		<tr>
			<th colspan="6">综合日均排行</th>
		</tr>
		<tr>
			<td>排名</td>
			<td>用户名</td>
			<td>用户类型</td>
			<td>报名活动次数(总数)</td>
			<td>报名活动次数(半年内)</td>
			<td>平均发帖次数</td>
		</tr>
<?php
$i = 0;
foreach($count_avg as $_uid => $_count):
	$i++;
	$needarr[] = $_uid;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">已加入推送</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&adduid=<?=$_uid?>"><b style="color: red;">未加入推送</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>领队[发布过" . $count_userline[$_uid] . "个商业活动]</font>";}else{echo "<font color='red'>非领队</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_baoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_halfbaoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>（周日均：<?=sprintf("%.4f", $count_week[$_uid])?> 月日均：<?=sprintf("%.4f", $count_month[$_uid])?> 季度日均：<?=sprintf("%.4f", $count_threemonth[$_uid])?>）</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="6">十天日均排行</th>
		</tr>
		<tr>
			<td>排名</td>
			<td>用户名</td>
			<td>用户类型</td>
			<td>报名活动次数(总数)</td>
			<td>报名活动次数(半年内)</td>
			<td>平均发帖次数</td>
		</tr>
<?php
$i = 0;
foreach($count_week as $_uid => $_count):
	$i++;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">已加入推送</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&adduid=<?=$_uid?>"><b style="color: red;">未加入推送</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>领队[发布过" . $count_userline[$_uid] . "个商业活动]</font>";}else{echo "<font color='red'>非领队</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_baoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_halfbaoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>（综合日均：<?=sprintf("%.4f", $count_avg[$_uid])?> 月日均：<?=sprintf("%.4f", $count_month[$_uid])?> 季度日均：<?=sprintf("%.4f", $count_threemonth[$_uid])?>）</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="6">五十天日均排行</th>
		</tr>
		<tr>
			<td>排名</td>
			<td>用户名</td>
			<td>用户类型</td>
			<td>报名活动次数(总数)</td>
			<td>报名活动次数(半年内)</td>
			<td>平均发帖次数</td>
		</tr>
<?php
$i = 0;
foreach($count_month as $_uid => $_count):
	$i++;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">已加入推送</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&fid=<?php echo $fid; ?>&adduid=<?=$_uid?>"><b style="color: red;">未加入推送</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>领队[发布过" . $count_userline[$_uid] . "个商业活动]</font>";}else{echo "<font color='red'>非领队</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_baoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_halfbaoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>（综合日均：<?=sprintf("%.4f", $count_avg[$_uid])?> 周日均：<?=sprintf("%.4f", $count_week[$_uid])?> 季度日均：<?=sprintf("%.4f", $count_threemonth[$_uid])?>）</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="6">100天日均排行</th>
		</tr>
		<tr>
			<td>排名</td>
			<td>用户名</td>
			<td>用户类型</td>
			<td>报名活动次数(总数)</td>
			<td>报名活动次数(半年内)</td>
			<td>平均发帖次数</td>
		</tr>
<?php
$i = 0;
foreach($count_threemonth as $_uid => $_count):
	$i++;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">已加入推送</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&fid=<?php echo $fid; ?>&adduid=<?=$_uid?>"><b style="color: red;">未加入推送</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>领队[发布过" . $count_userline[$_uid] . "个商业活动]</font>";}else{echo "<font color='red'>非领队</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_baoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>参加活动</font>" . $count_halfbaoming[$_uid] . "次";}else{ echo "<font color='red'>未参加过</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>（综合日均：<?=sprintf("%.4f", $count_avg[$_uid])?> 周日均：<?=sprintf("%.4f", $count_week[$_uid])?> 月日均：<?=sprintf("%.4f", $count_month[$_uid])?>）</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
</table>
<table style="width: 100%;">
	<tbody>
		<tr>
			<th colspan="3">半年内参加活动最活跃会员前100名(<?=$forumname?>版块)</th>
		</tr>
		<tr>
			<td>排名</td>
			<td>会员名</td>
			<td>参加次数</td>
		</tr>
<?php $bianjie_y = $bianjie_n = ""; ?>
<?php foreach($halfyearcanjia as $k => $v): ?>
		<tr>
			<td><?=$k+1?></td>
			<td><span style="margin-right:50px;"><a target="_blank" href="http://u.8264.com/<?=$v['uid']?>"><?=$v['username']?></a></span><?php if($tuisonguser[$v['uid']]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&fid=<?php echo $fid; ?>&deluid=<?=$v['uid']?>"><b style="color: green;">已加入推送</b></a><?php else: ?><?php if($count_userline[$v['uid']] > 0){}else{$alltoadd[$v['uid']] = $v['username'];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&fid=<?php echo $fid; ?>&adduid=<?=$v['uid']?>"><b style="color: red;">未加入推送</b></a><?php endif; ?><?php if($v['intop']):?><b style="color: green;">在上表综合排行中</b><?php else: ?><b style="color: red;">不在上表综合排行中</b><?php endif;?></td>
<?php
		if($v['intop']){
			$bianjie_y .= "<a target='_blank' style=\"margin-right:20px;\" target=\"_blank\" href=\"http://u.8264.com/{$v['uid']}\">{$v['username']}</a>";
		}else{
			$bianjie_n .= "<a target='_blank' style=\"margin-right:20px;\" target=\"_blank\" href=\"http://u.8264.com/{$v['uid']}\">{$v['username']}</a>";
		}
?>
			<td width="15%"><?=$v['count']?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="3">便捷查看</th>
		</tr>
		<tr>
			<td width="15%"><b style="color:green">在列表中</b></td>
			<td colspan="2"><?=$bianjie_y?></td>
		</tr>
		<tr>
			<td width="15%"><b style="color:red">不在列表中</b></td>
			<td colspan="2"><?=$bianjie_n?></td>
		</tr>	
	</tbody>
	<?php if($tuisongcount > 0): ?>
	<tbody>
		<tr>
			<th colspan="3">当前推送人员（<?=$tuisongcount?> 人）</th>
		</tr>
		<tr>
			<td colspan="3" style="text-align: left;">
				<?php foreach($tuisonguser as $k => $v): ?>
				<a target="_blank" href="http://u.8264.com/<?=$k?>"><?=$v?></a>[<a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&fid=<?php echo $fid; ?>&deluid=<?=$k?>"><b style="color: red;">删除</b></a>]&nbsp;&nbsp;&nbsp;&nbsp;
				<?php endforeach; ?>
			</td>
		</tr>	
	</tbody>
	<?php endif; ?>
</table>
<style>
table tbody{border:2px black solid; margin: 20px 10px;}
table td, table th{text-align: center; border-bottom:1px #CCC dotted; padding: 5px 10px;}
table td{background:#EEE}
table th{background: #4DD7F4;}
table td b{margin:0 5px;}
ul li{float:left; list-style: none;}
ul li{margin-right:20px;padding: 5px;}
.wordattr{margin:0 3px; font-size:12px; color:blue;}
</style>
<?php
if($_G['gp_alladd'] == 1){
	foreach($alltoadd as $k => $v){
		$myredis->hashset($keyname, $k, $v);
	}
	if(count($alltoadd) > 0){
		echo "<script>window.location.href='http://bbs.8264.com/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=usershow&fid={$fid}';</script>";
	}
}
?>