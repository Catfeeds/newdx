<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$gid = $_GET['gid'];
if (!empty($_POST)) {
    $query = DB::query("SELECT typeid FROM ".DB::table('mudidi_guide')." WHERE id = $gid");
    $typeidArr = array();
    while ($value = DB::fetch($query)) {
        $typeidArr[] = $value['typeid'];
    }
    DB::query("UPDATE ".DB::table('mudidi_guide')." SET coverPic = '{$_POST['coverPic']}' WHERE typeid IN (".implode(',', $typeidArr).")");
    cpmsg('�༭�ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_guide', 'succeed');
}
$guide = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_guide')." WHERE id = $gid");

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">���Ա༭</th></tr>
<tr><td class="td27" colspan="2">����ͼƬ·��:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="coverPic" class="txt" value="<?php echo $guide['coverPic']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		��Ҫ����ͼƬ������"#"
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
