<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>
<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">搜索用户</th></tr>
<tr><td class="td27" colspan="2">用户名:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="username" class="txt" value="<?php echo $user['username']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		用户名或用户ID只填写一项即可
	</td>
</tr>
<tr><td class="td27" colspan="2">用户ID:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="uid" class="txt" value="<?php echo $user['uid']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="hidden" name="searchUser" value="1" />
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>