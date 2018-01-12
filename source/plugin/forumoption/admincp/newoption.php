<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
require_once libfile('function/admincp');

// 板块表单单选框
$forum_select = '<select name="forum"><option value="0">空</option>';
$forum_select .= forumselect(FALSE, 0, 0, TRUE);
$forum_select .= '</select>';

// 分类信息表单单选框
$query = DB::query("SELECT typeid, name FROM ".DB::table('forum_threadtype')."");
$threadtype_select = '<select name="threadtype"><option value="0">空</option>';
while ($value = DB::fetch($query)) {
	$threadtype_select .= '<option value="'.$value['typeid'].'">'.$value['name'].'</option>';
}
$threadtype_select .= '</select>';

if (!empty($_POST)) {
	$name = $_POST['name'];
	$forumid = $_POST['forum'];
	$threadtype = $_POST['threadtype'];
	
	DB::query("INSERT INTO ".DB::table('plugin_forumoption')."
			  (name, fid, typeid) VALUES ('{$name}', {$forumid}, {$threadtype})");
	memory('rm', 'oBmjvS_fid');
	cpmsg('新建设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp', 'succeed');
}


?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">新建设置</th></tr>
<tr><td class="td27" colspan="2">名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="name" class="txt" id="" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">所属板块:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php echo $forum_select; ?>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">所属分类信息:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php echo $threadtype_select; ?>
	</td>
	<td class="vtop tips2">
		若两项都选择则为交集关系,设置会在同时在此模块和此分类信息下生效 <br/>
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