<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';

$tid = $_GET['tid'];

if (!empty($_POST)) {
	$recommend1 = $_POST['recommend1'] ? '1' : "0";
	$recommend2 = $_POST['recommend2'] ? '1' : "0";
	$recommend3 = $_POST['recommend3'] ? '1' : "0";
	DB::query("REPLACE INTO ".DB::table('plugin_produce_brand_property')."
			  (tid, recommend1, recommend2, recommend3)
			  VALUES ($tid, '{$recommend1}', '{$recommend2}', '{$recommend3}')");
    cpmsg('编辑成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_brand', 'succeed');
}

$brand = ForumOptionProduce::getBrandByTid($tid);

?>

<form action="" method="post" enctype="multipart/form-data">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">修改品牌: <?php echo $brand['subject']; ?></th></tr>
<tr><td class="td27" colspan="2">显示设置:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<label for="recommend1">
			<input type="checkbox" name="recommend1" id="recommend1"<?php if ($brand['recommend1']) echo ' checked="checked"'; ?> />
			品牌区
		</label>
		<label for="recommend2">
			<input type="checkbox" name="recommend2" id="recommend2"<?php if ($brand['recommend2']) echo ' checked="checked"'; ?> />
			推荐区
		</label>
		<label for="recommend3">
			<input type="checkbox" name="recommend3" id="recommend3"<?php if ($brand['recommend3']) echo ' checked="checked"'; ?> />
			菜单区
		</label>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>