<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if (!empty($_POST)) {
	$values = array();
	foreach ($_POST['tags'] as $tag) {
		$values[] = "({$_GET['picid']}, {$tag})";
	}
	$values = implode(',', $values);
	DB::query("DELETE FROM ".DB::table('plugin_daily_picture_pic_tag_mapping')." WHERE picId = {$_GET['picid']}");
	if ($values) {
		DB::query("INSERT INTO ".DB::table('plugin_daily_picture_pic_tag_mapping')." (picId, tagId) VALUES $values");
	}
	cpmsg('编辑成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dailypicture&pmod=admincp_pic', 'succeed');
}

$mappings = $tags = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_daily_picture_pic_tag_mapping')." WHERE picId = {$_GET['picid']}");
while ($value = DB::fetch($query)) {
	$mappings[] = $value['tagId'];
}
$query = DB::query("SELECT * FROM ".DB::table('plugin_daily_picture_tags'));
while ($value = DB::fetch($query)) {
	$value['used'] = in_array($value['id'], $mappings) ? true : false;
	$tags[] = $value;
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">作品编辑</th></tr>
<tr><td class="td27" colspan="2">标签设置:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php foreach ($tags as $tag): ?>
		<label for="tag_<?php echo $tag['id']; ?>">
			<input type="checkbox" name="tags[<?php echo $tag['id']; ?>]" id="tag_<?php echo $tag['id']; ?>" value="<?php echo $tag['id']; ?>"<?php echo $tag['used'] ? ' checked="checked"' : '';?> />
			<?php echo $tag['name']; ?>
		</label>
		<?php endforeach; ?>
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
