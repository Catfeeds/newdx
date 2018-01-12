<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/admincp_thread/class.php';


$optionid = $_GET['opid'];
$option = DB::fetch_first("SELECT * FROM ".DB::table('plugin_threadoption')." WHERE id = {$optionid}");

$option_fields = ThreadClass::getFields($option['class']);

$query = DB::query("SELECT * FROM ".DB::table('plugin_threadoption_field')." WHERE optionid = {$optionid}");
while ($value = DB::fetch($query)) {
	$option_fields[$value['name']] = $value['value'];
}

if (!empty($_POST)) {
	foreach ($option_fields as $i => $field) {
		if (isset($_POST[$i])) {
			$value = $_POST[$i];
			DB::query("REPLACE INTO ".DB::table('plugin_threadoption_field')." (optionid, name, value) VALUES ({$optionid}, '{$i}', '{$value}')");
		}
	}
	cpmsg('设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread', 'succeed');
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">设置</th></tr>
<?php include(DISCUZ_ROOT."./source/plugin/forumoption/admincp_thread/option_form_templete/option_{$option['class']}.php"); ?>

<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>




