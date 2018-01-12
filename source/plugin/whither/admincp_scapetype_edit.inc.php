<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$scapetype = array();
$scapetypeid = $_GET['scapetypeid'];

if (!empty($_POST)) {
	$name = trim($_POST['name']);
	$defaultInfo = trim($_POST['defaultInfo']);
	$defaultInfo = preg_replace('/\s*,\s*/', ',', $defaultInfo);

	if (empty($scapetypeid)) {
		DB::query("INSERT INTO ".DB::table('mudidi_scapetype')." (name, defaultInfo) VALUES ('{$name}', '{$defaultInfo}')");
	} else {
		DB::query("UPDATE ".DB::table('mudidi_scapetype')." SET name = '{$name}', defaultInfo = '{$defaultInfo}' WHERE id = {$scapetypeid}");
	}

    cpmsg('操作成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_scapetype', 'succeed');
}

if (!empty($scapetypeid)) {
	$scapetype = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_scapetype')." WHERE id = $scapetypeid");
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">景点类型编辑</th></tr>
<tr><td class="td27" colspan="2">名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="name" class="txt" value="<?php echo $scapetype['name']; ?>" id="" />
	</td>
	<td class="vtop tips2">
	</td>
</tr>
<tr><td class="td27" colspan="2">默认旅游信息名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<textarea class="tarea" name="defaultInfo" onkeyup="textareasize(this, 0)" ondblclick="textareasize(this, 1)"><?php echo $scapetype['defaultInfo']; ?></textarea>
	</td>
	<td class="vtop tips2">
		多个旅游信息请用,分割(英文逗号)
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
