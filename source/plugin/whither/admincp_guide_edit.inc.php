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
    cpmsg('编辑成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_guide', 'succeed');
}
$guide = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_guide')." WHERE id = $gid");

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">攻略编辑</th></tr>
<tr><td class="td27" colspan="2">封面图片路径:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="coverPic" class="txt" value="<?php echo $guide['coverPic']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		若要禁用图片请输入"#"
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
