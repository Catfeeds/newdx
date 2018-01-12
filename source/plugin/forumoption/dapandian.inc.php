<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$subtitle = array(
	'1' => 'plugin_dpd_dazhongqudao',
	'2' => 'plugin_dpd_zhuanyequdao',
	'3' => 'plugin_dpd_danpinpinpai',
	'4' => 'plugin_dpd_lingjunzonghepinpai',
	'5' => 'plugin_dpd_jiechuzonghepinpai',
	'6' => 'plugin_dpd_zhuangbeidajiang',
	);
$tablearr = array(
	'1' => 'plugin_dpd_dzqd',
	'2' => 'plugin_dpd_zyqd',
	'3' => 'plugin_dpd_dppp',
	'4' => 'plugin_dpd_zhpp',
	'5' => 'plugin_dpd_zhpp',
	'6' => 'plugin_dpd_equi',
	);
$tablearrcount = array(
	'1' => 12,
	'2' => 15,
	'3' => 17,
	'4' => 18,
	'5' => 18,
	'6' => 11,
	);
$dtype = max(1, intval($_G['gp_dtype']));
foreach ($subtitle as $k => $v) {
	$selected = $k == $dtype ? " class='selected' " : "";
	$submenu .= "<li{$selected}><a href='admin.php?action=plugins&operation=config&do={$pluginid}&identifier=forumoption&pmod=dapandian&dtype={$k}'>" . cplang($v) . "</a></li>";
}
$nowpage = max(1, $_G['gp_page']);
$perpage = 50;
$start = ($nowpage - 1) * $perpage;
$maxnum = DB::result_first("SELECT count(*) FROM " . DB::table($tablearr[$dtype]) . ($dtype == 4 || $dtype == 5 ? " WHERE dtype = {$dtype}" : ""));
$multipage = multi($maxnum, $perpage, $nowpage, "admin.php?action=plugins&operation=config&do={$pluginid}&identifier=forumoption&pmod=dapandian&dtype={$dtype}");
?>
<style>
#submenu ul li{float:left;margin-left:10px;list-style:none;}
.selected{font-weight:bold;}
table tr td, table tr th{text-align:center;padding: 5px;border-bottom:1px solid #BDBDBD;}
</style>
<div id="submenu"><ul><?php
echo $submenu;
?><div style="clear: both;"></div></ul></div>
<p style="margin:10px 0;"><?php
echo $multipage;
?></p>
<table style="width: 100%;">
	<tr class="header">
<?php
for ($i = 1; $i <= $tablearrcount[$dtype]; $i++) {
	echo '<th>' . cplang($subtitle[$dtype] . '_row_' . $i) . '</th>';
}
?>
	</tr>
<?php
$q = DB::query("SELECT * FROM " . DB::table($tablearr[$dtype]) . ($dtype == 4 || $dtype == 5 ? " WHERE dtype = {$dtype}" : "") . " LIMIT {$start},{$perpage}");
while ($v = DB::fetch($q)) {
	echo '<tr class="hover">';
	foreach ($v as $_k => $_v) {
		$continue = false;
		switch($_k){
			case 'id': $continue = true;break;
			case 'dateline': $_v = date('Y-m-d H:i:s', $_v);break;
			case strpos($_k, '_type') !== false: $_v = '第' . $_v . '个选项';break;
			case strpos($_k, 'if_') !== false: $_v = $_v == 1 ? '是' : '否';break;
			case 'dtype': $continue = true;break;
			case 'site': $_v = trim(str_replace('-', '', $_v));break;
		}
		if($continue) continue;
		if(empty($_v)) $_v = '未填写';
		echo '<td>' . $_v . '</td>';
	}
	echo '</tr>';
}
?>
</table>
<p style="margin:10px 0;"><?php
echo $multipage;
?></p>
