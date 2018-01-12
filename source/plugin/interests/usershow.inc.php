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
	cpmsg("fid����������ѡ��", "action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=usershow", 'error');
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
<form action="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow" method="POST"><p>��ǰ���Ϊ<font color="red"><b><?=$forumname?></b></font>��������fid������<input type="text" name="fid" maxlength="4" size="4" />&nbsp;<input type="submit" name="submit" value="�ύ"/>&nbsp;<?php if (($tuisongcount = count($tuisonguser)) > 0): ?>��ǰ������<b style="color: blue;"><?=$tuisongcount?></b>��<?php endif;?><a style="margin-left: 20px;" href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&alladd=1&fid=<?php echo $fid;?>">ȫ������(�����)</a></form></p>
<br />
<table style="width: 100%;">
	<tbody>
		<tr>
			<th colspan="6">�ۺ��վ�����</th>
		</tr>
		<tr>
			<td>����</td>
			<td>�û���</td>
			<td>�û�����</td>
			<td>���������(����)</td>
			<td>���������(������)</td>
			<td>ƽ����������</td>
		</tr>
<?php
$i = 0;
foreach($count_avg as $_uid => $_count):
	$i++;
	$needarr[] = $_uid;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">�Ѽ�������</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&adduid=<?=$_uid?>"><b style="color: red;">δ��������</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>���[������" . $count_userline[$_uid] . "����ҵ�]</font>";}else{echo "<font color='red'>�����</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_baoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_halfbaoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>�����վ���<?=sprintf("%.4f", $count_week[$_uid])?> ���վ���<?=sprintf("%.4f", $count_month[$_uid])?> �����վ���<?=sprintf("%.4f", $count_threemonth[$_uid])?>��</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="6">ʮ���վ�����</th>
		</tr>
		<tr>
			<td>����</td>
			<td>�û���</td>
			<td>�û�����</td>
			<td>���������(����)</td>
			<td>���������(������)</td>
			<td>ƽ����������</td>
		</tr>
<?php
$i = 0;
foreach($count_week as $_uid => $_count):
	$i++;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">�Ѽ�������</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&adduid=<?=$_uid?>"><b style="color: red;">δ��������</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>���[������" . $count_userline[$_uid] . "����ҵ�]</font>";}else{echo "<font color='red'>�����</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_baoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_halfbaoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>���ۺ��վ���<?=sprintf("%.4f", $count_avg[$_uid])?> ���վ���<?=sprintf("%.4f", $count_month[$_uid])?> �����վ���<?=sprintf("%.4f", $count_threemonth[$_uid])?>��</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="6">��ʮ���վ�����</th>
		</tr>
		<tr>
			<td>����</td>
			<td>�û���</td>
			<td>�û�����</td>
			<td>���������(����)</td>
			<td>���������(������)</td>
			<td>ƽ����������</td>
		</tr>
<?php
$i = 0;
foreach($count_month as $_uid => $_count):
	$i++;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">�Ѽ�������</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&fid=<?php echo $fid; ?>&adduid=<?=$_uid?>"><b style="color: red;">δ��������</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>���[������" . $count_userline[$_uid] . "����ҵ�]</font>";}else{echo "<font color='red'>�����</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_baoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_halfbaoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>���ۺ��վ���<?=sprintf("%.4f", $count_avg[$_uid])?> ���վ���<?=sprintf("%.4f", $count_week[$_uid])?> �����վ���<?=sprintf("%.4f", $count_threemonth[$_uid])?>��</td>
		</tr>
<?php
	if($i >= 100) break;
endforeach;
?>
	</tbody>
	<tbody>
		<tr>
			<th colspan="6">100���վ�����</th>
		</tr>
		<tr>
			<td>����</td>
			<td>�û���</td>
			<td>�û�����</td>
			<td>���������(����)</td>
			<td>���������(������)</td>
			<td>ƽ����������</td>
		</tr>
<?php
$i = 0;
foreach($count_threemonth as $_uid => $_count):
	$i++;
?>
		<tr>
			<td><?=$i?></td>
			<td><a target="_blank" href="http://u.8264.com/<?=$_uid?>"><?=$uidnamearr[$_uid]?></a><?php if($tuisonguser[$_uid]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&deluid=<?=$_uid?>"><b style="color: green;">�Ѽ�������</b></a><?php else: ?><?php if($count_userline[$_uid] > 0){}else{$alltoadd[$_uid] = $uidnamearr[$_uid];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&fid=<?php echo $fid; ?>&adduid=<?=$_uid?>"><b style="color: red;">δ��������</b></a><?php endif; ?></td>
			<td><?php if($count_userline[$_uid] > 0){ echo "<font color='blue'>���[������" . $count_userline[$_uid] . "����ҵ�]</font>";}else{echo "<font color='red'>�����</font>";} ?></td>
			<td><?php if($count_baoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_baoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?php if($count_halfbaoming[$_uid] > 0){ echo "<font color='green'>�μӻ</font>" . $count_halfbaoming[$_uid] . "��";}else{ echo "<font color='red'>δ�μӹ�</font>";} ?></td>
			<td><?=sprintf("%.4f", $_count)?>���ۺ��վ���<?=sprintf("%.4f", $count_avg[$_uid])?> ���վ���<?=sprintf("%.4f", $count_week[$_uid])?> ���վ���<?=sprintf("%.4f", $count_month[$_uid])?>��</td>
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
			<th colspan="3">�����ڲμӻ���Ծ��Աǰ100��(<?=$forumname?>���)</th>
		</tr>
		<tr>
			<td>����</td>
			<td>��Ա��</td>
			<td>�μӴ���</td>
		</tr>
<?php $bianjie_y = $bianjie_n = ""; ?>
<?php foreach($halfyearcanjia as $k => $v): ?>
		<tr>
			<td><?=$k+1?></td>
			<td><span style="margin-right:50px;"><a target="_blank" href="http://u.8264.com/<?=$v['uid']?>"><?=$v['username']?></a></span><?php if($tuisonguser[$v['uid']]): ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&fid=<?php echo $fid; ?>&deluid=<?=$v['uid']?>"><b style="color: green;">�Ѽ�������</b></a><?php else: ?><?php if($count_userline[$v['uid']] > 0){}else{$alltoadd[$v['uid']] = $v['username'];} ?><a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=adduser&fid=<?php echo $fid; ?>&adduid=<?=$v['uid']?>"><b style="color: red;">δ��������</b></a><?php endif; ?><?php if($v['intop']):?><b style="color: green;">���ϱ��ۺ�������</b><?php else: ?><b style="color: red;">�����ϱ��ۺ�������</b><?php endif;?></td>
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
			<th colspan="3">��ݲ鿴</th>
		</tr>
		<tr>
			<td width="15%"><b style="color:green">���б���</b></td>
			<td colspan="2"><?=$bianjie_y?></td>
		</tr>
		<tr>
			<td width="15%"><b style="color:red">�����б���</b></td>
			<td colspan="2"><?=$bianjie_n?></td>
		</tr>	
	</tbody>
	<?php if($tuisongcount > 0): ?>
	<tbody>
		<tr>
			<th colspan="3">��ǰ������Ա��<?=$tuisongcount?> �ˣ�</th>
		</tr>
		<tr>
			<td colspan="3" style="text-align: left;">
				<?php foreach($tuisonguser as $k => $v): ?>
				<a target="_blank" href="http://u.8264.com/<?=$k?>"><?=$v?></a>[<a href="/admin.php?action=plugins&operation=config&do=<?=$pluginid?>&identifier=interests&pmod=usershow&method=deluser&fid=<?php echo $fid; ?>&deluid=<?=$k?>"><b style="color: red;">ɾ��</b></a>]&nbsp;&nbsp;&nbsp;&nbsp;
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