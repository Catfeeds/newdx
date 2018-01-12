<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
require_once libfile('function/admincp');

$optionid = $_GET['opid'];
$option = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_type')." WHERE id = {$optionid}");

// 查询一级分类信息
$query = DB::query("SELECT id, tname FROM ".DB::table('plugin_produce_type')." where tparent=0");
$threadtype_select = '<select name="threadtype"><option value="0">无</option>';
while ($value = DB::fetch($query)) {
	$threadtype_select .= '<option value="'.$value['id'].'">'.$value['tname'].'</option>';
}
$threadtype_select .= '</select>';
$threadtype_select = str_replace('<option value="'.$option['tparent'].'"', '<option value="'.$option['tparent'].'" selected="selected"', $threadtype_select);


//做添加操作
if (!empty($_POST)) {
	$name = $_POST['tname'];
	$parentid = $_POST['threadtype'];
	$isshow = $_POST['isshow'];
	
	DB::query("UPDATE ".DB::table('plugin_produce_type')."
			   SET tname = '{$name}',
				   tparent = {$parentid},
				   tshow = {$isshow}
			   WHERE id = {$optionid}");
	cpmsg('修改设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type', 'succeed');
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">修改设置</th></tr>
<tr><td class="td27" colspan="2">类别名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="tname" class="txt" id="" value="<?php echo $option['tname']; ?>" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">所属级别:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php echo $threadtype_select; ?>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">是否显示信息:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option['tshow']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isshow" class="radio" <?php if ($option['tshow']==1) {?> checked="checked"<?php } ?>>&nbsp;是</li>
			<li <?php if ($option['tshow']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isshow" class="radio" <?php if ($option['tshow']==0) {?> checked="checked"<?php } ?>>&nbsp;否</li>
		</ul>
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