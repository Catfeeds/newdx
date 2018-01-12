<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));


?>

<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">添加名称</th></tr>
<tr><td class="td27" colspan="2">名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="uname" class="txt" id="" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>
<tr><td class="td27" colspan="2">备注:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<textarea class="tarea" cols="30"  name="settingnew[statcode]" rows="6"></textarea>
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">是否展示:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			
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
<?php showtablefooter();?>
</form>

