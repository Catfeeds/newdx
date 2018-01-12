<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$fid = $_GET['fid'];
if (!empty($_POST)) {
	DB::query("DELETE FROM ".DB::table('plugin_forumoption_town_recommends')." WHERE fid = $fid");
	$values = array();
	foreach ($_POST['recommend_thread'] as $tid) {
		$values[] = "($fid, $tid)";
	}
	$values = implode(', ', $values);
	if ($values) {
		DB::query("INSERT INTO ".DB::table('plugin_forumoption_town_recommends')." (fid, tid) VALUES $values");
	}
	cpmsg('修改设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_town', 'succeed');
}

$forum = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." WHERE fid = $fid");
$threads = array();
$query = DB::query("SELECT t.*, r.tid AS recommended FROM ".DB::table('forum_thread')." t".
				   " LEFT JOIN ".DB::table('plugin_forumoption_town_recommends')." r ON r.fid = $fid AND r.tid=t.tid".
				   " WHERE t.fid = $fid AND t.displayorder > -1 ORDER BY r.tid DESC, tid DESC");
while ($thread = DB::fetch($query)) {
	$thread['recommended'] = (bool)$thread['recommended'];
	$threads[] = $thread;
}

?>
<style type="text/css">
#town_edit_form .vtop div.item { width:500px; height: 300px; overflow: auto;}
#town_edit_form .vtop div.item label { display: block; border-bottom:1px dashed #eee; padding: 3px;}
</style>
<form action="" method="post" id="town_edit_form">
<input type="hidden" name="submit" value="1" />
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15"><?php echo $forum['name']; ?>编辑</th></tr>
<tr><td class="td27" colspan="2">推荐贴子:</td></tr>
<tr class="noborder">
	<td class="vtop" colspan="2">
		<div class="item">
		<?php foreach($threads as $thread) { ?>
			<label for="recommend_thread_<?php echo $thread['tid']; ?>" title="<?php echo $thread['subject']; ?>">
				<input type="checkbox" name="recommend_thread[]" id="recommend_thread_<?php echo $thread['tid']; ?>" value="<?php echo $thread['tid']; ?>"<?php if ($thread['recommended']) : ?> checked="checked"<?php endif; ?> />
				<?php echo $thread['subject']; ?>
			</label>
		<?php } ?>
		</div>
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn" />
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>
