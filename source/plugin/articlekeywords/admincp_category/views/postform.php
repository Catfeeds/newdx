<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15"><?php echo $_GET['op']=='new'?'新建':'修改'; ?>分类</th></tr>
<tr><td class="td27" colspan="2">分类名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="name" class="txt" value="<?php echo $category['name']; ?>" id="" />
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