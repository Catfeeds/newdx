<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

require_once dirname(__FILE__) . '/model/couponmod.php';
$limit = 50;
$page = intval($_G['gp_page']);
$page = max($page, 1);
$start = ($page - 1) * $limit;
$sql = "SELECT * FROM " . couponmod::TABLE_NAME . " LIMIT {$start}, {$limit} " . getSlaveID();
$q = DB::query($sql);
$list = array();
$needusername = array();
while($v = DB::fetch($q)){
	$v[couponmod::_COUPON_NUMBER] = substr($v[couponmod::_COUPON_NUMBER], 0, 2) . str_repeat('*', strlen($v[couponmod::_COUPON_NUMBER]) - 4) . substr($v[couponmod::_COUPON_NUMBER], -2);
	if($v[couponmod::_UID] > 0){
		$needusername[$v[couponmod::_UID]] = $v[couponmod::_UID];
	}
	$v[couponmod::_TIME_TOUSER] = $v[couponmod::_TIME_TOUSER] > 0 ? date('Y-m-d H:i', $v[couponmod::_TIME_TOUSER]) : '未推送';
	$v[couponmod::_TIME_CREATE] = date('Y-m-d H:i', $v[couponmod::_TIME_CREATE]);
	$list[] = $v;	
}
if($needusername){
	$sql = "SELECT username, uid FROM " . DB::table('common_member') . " WHERE uid IN(" . implode(',', $needusername) . ") " . getSlaveID();
	$q = DB::query($sql);
	while($vvv = DB::fetch($q)){
		$usernamearr[$vvv['uid']] = $vvv['username'];
	}
}
$max = DB::result_first("SELECT count(*) FROM " . couponmod::TABLE_NAME);
$multi = multi($max, $limit, $page, "/admin.php?action=plugins&operation=config&do={$pluginid}&identifier=interests&pmod=couponmgr");
//echo "<pre>" . var_export($usernamearr, true) . "</pre>";
?>
<style>
#mycontainer table{width:100%;}
#mycontainer table tbody{border-bottom:2px black solid; margin: 20px 10px;}
#mycontainer table td, table th{text-align: center; border-bottom:1px #CCC dotted; padding: 5px 10px;}
#mycontainer table td{background:#EEE}
#mycontainer table th{background: #4DD7F4;}
</style>
<div id="mycontainer">
<table>
	<tbody>
		<tr>
			<th>优惠券号</th>
			<th>相关线路</th>
			<th>创建时间</th>
			<th>推送用户</th>
			<th>推送时间</th>
			<th>当前状态</th>
		</tr>
	</tbody>
	<tbody>
<?php if($list): ?>
	<?php foreach($list as $val): ?>
		<tr>
			<td><?=$val[couponmod::_COUPON_NUMBER]?></td>
			<td><a href="<?=$val[couponmod::_URL]?>" target="_blank"><?=$val[couponmod::_NAME]?></a></td>
			<td><?=$val[couponmod::_TIME_CREATE]?></td>
			<td><?php if($val[couponmod::_UID] > 0): ?><a target="_blank" href="http://u.8264.com/<?=$val[couponmod::_UID]?>"><?=$usernamearr[$val[couponmod::_UID]]?></a><?php else: ?>未推送任何用户<?php endif; ?></td>
			<td><?=$val[couponmod::_TIME_TOUSER]?></td>
			<td><?php if($val[couponmod::_USED]): ?><b><font color='blue'>已使用</font></b><?php else: ?><b><font color='green'>未使用</font></b><?php endif; ?></td>
		</tr>
	<?php endforeach; ?>
	<?php if($multi): ?>
		<tr>
			<td colspan="6"><?=$multi?></td>
		</tr>
	<?php endif; ?>
<?php else: ?>
		<tr>
			<td colspan="6">当前没有优惠券信息</td>
		</tr>
<?php endif; ?>
	</tbody>
</table>
</div>