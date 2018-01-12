<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">修改关键字</th></tr>
<tr><td class="td27" colspan="2">关键字:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="keyword" class="txt" value="<?php echo $article_keyword['keyword']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">链接:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="link" class="txt" value="<?php echo $article_keyword['link'] ? $article_keyword['link'] : $_G['config']['web']['forum'].'thread-*-1-1.html'; ?>" id="" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">分类:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<select name="category" id="category">
			<option value="">无</option>
			<?php foreach ($categorys as $category) { ?>
			<option value="<?php echo $category['id']; ?>"<?php if ($article_keyword['category'] == $category['id']) {echo ' selected="selected"';} ?>><?php echo $category['name']; ?></option>
			<?php } ?>
		</select>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">关键字类型:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<label for="keyword_enabled_true">
			<input type="radio" name="enabled" value="1" id="keyword_enabled_true"<?php if ($article_keyword['enabled'] == 1) { echo ' checked="checked"';} ?> /> 文章
		</label>
		<label for="keyword_enabled_false">
			<input type="radio" name="enabled" value="0" id="keyword_enabled_false"<?php if ($article_keyword['enabled'] != 1) { echo ' checked="checked"';} ?> /> 普通
		</label>
		<?php if ($article_keyword['enabled'] == 1) { } ?>
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