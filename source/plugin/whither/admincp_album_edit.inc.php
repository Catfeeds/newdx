<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$albumid = $_GET['albumid'];
if (!empty($_POST)) {
    DB::query("UPDATE ".DB::table('mudidi_album')." SET ordernum = '{$_POST['ordernum']}' WHERE id = $albumid");
    cpmsg('�༭�ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_album', 'succeed');
}
$album = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_album')." WHERE id = $albumid");

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">���༭</th></tr>
<tr><td class="td27" colspan="2">����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="ordernum" class="txt" value="<?php echo $album['ordernum']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		����Ϊ�Ӵ�С����
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
