<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if ($_POST['tid']) {
	if ($_POST['new_heats']) {
		DB::query("UPDATE ".DB::table('forum_thread')." SET heats = '{$_POST['new_heats']}' WHERE tid = {$_POST['tid']}");
		cpmsg('修改成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_recount_heats', 'succeed');
	}

	$old_heats = DB::result_first("SELECT heats FROM ".DB::table('forum_thread')." WHERE tid = {$_POST['tid']}");
	if ($old_heats == NULL) {
		cpmsg('贴子不存在', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_recount_heats', 'succeed');
	}

	$new_heats = 0;
	$radix = $_G['setting']['heatthread']['reply'] ? $_G['setting']['heatthread']['reply'] : 5;
	$last_poster_id = NULL;
	$replies = array();
	$query = DB::query("SELECT * FROM ".DB::table('forum_post')." WHERE tid = {$_POST['tid']}");

	while ($post = DB::fetch($query)) {
		if ($post['first'] == 1) {
			$last_poster_id = $post['authorid'];
			continue;
		} elseif ($last_poster_id != $post['authorid']) {
			if (empty($replies[$post['authorid']])) {
				$replies[$post['authodid']] = 0;
			}
			$new_heats += round($radix * pow(0.8, $replies[$post['authorid']]));
			++$replies[$post['authorid']];
		}
	}
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><td class="td27" colspan="2">传入贴子ID:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php if ($_POST['tid']): ?>
			<?php echo $_POST['tid']; ?>
			<input type="hidden" name="tid" value="<?php echo $_POST['tid']; ?>"/>
		<?php else: ?>
			<input type="text" name="tid" class="txt" id="" value="<?php echo $_POST['tid']; ?>"/>
		<?php endif; ?>
	</td>
	<td class="vtop tips2">
	</td>
</tr>
<?php if ($old_heats && $new_heats): ?>
<tr><td class="td27" colspan="2">热度:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="new_heats" class="txt" id="" value="<?php echo $new_heats; ?>" />
	</td>
	<td class="vtop tips2">
		(原始heats: <?php echo $old_heats; ?>)
	</td>
</tr>
<?php endif; ?>
<tr>
	<td colspan="2">
		<div class="fixsel">
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>
