<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if ($_GET['tagid']) {
	if (!empty($_POST)) {
		DB::query("UPDATE ".DB::table('plugin_daily_picture_tags')." SET name = '{$_POST['name']}' WHERE id = {$_GET['tagid']}");
		cpmsg('�༭�ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dailypicture&pmod=admincp_tag', 'succeed');
	}
	$tag = DB::fetch_first("SELECT * FROM ".DB::table('plugin_daily_picture_tags')." WHERE id = {$_GET['tagid']}");
} else {
	if (!empty($_POST)) {
		DB::query("INSERT INTO ".DB::table('plugin_daily_picture_tags')." (name) VALUES ('{$_POST['name']}')");
		cpmsg('�����ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dailypicture&pmod=admincp_tag', 'succeed');
	}
	$tag = array();
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">��ǩ�༭</th></tr>
<tr><td class="td27" colspan="2">��ǩ����:</td></tr>
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
			<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>
