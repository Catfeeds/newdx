<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$tag = array();
$tagid = $_GET['tagid'];

if (!empty($_POST)) {
	$name = trim($_POST['name']);
	if (empty($tagid)) {
		DB::query("INSERT INTO ".DB::table('mudidi_tags')." (name) VALUES ('{$name}')");
	} else {
		DB::query("UPDATE ".DB::table('mudidi_tags')." SET name = '{$name}' WHERE tagid = {$tagid}");
	}

    cpmsg('操作成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_tags', 'succeed');
}

if (!empty($tagid)) {
	$tag = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_tags')." WHERE tagid = $tagid");
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">标签编辑</th></tr>
<tr><td class="td27" colspan="2">标签名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="name" class="txt" value="<?php echo $tag['name']; ?>" id="" />
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
