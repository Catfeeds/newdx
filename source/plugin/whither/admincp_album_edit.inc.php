<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$albumid = $_GET['albumid'];
if (!empty($_POST)) {
    DB::query("UPDATE ".DB::table('mudidi_album')." SET ordernum = '{$_POST['ordernum']}' WHERE id = $albumid");
    cpmsg('编辑成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_album', 'succeed');
}
$album = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_album')." WHERE id = $albumid");

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">相册编辑</th></tr>
<tr><td class="td27" colspan="2">排序:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="ordernum" class="txt" value="<?php echo $album['ordernum']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		排序为从大到小排序
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
