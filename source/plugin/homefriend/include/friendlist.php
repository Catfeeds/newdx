<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>

<form action="" method="POST">
	<table class="tb tb2">
		<tbody>
			<tr>
				<th class="partition">搜索</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
					贴子数:
					<input type="text" name="threadsFilter" id="" size="6" value="<?php echo $search['threadsFilter']; ?>" />
					回复数:
					<input type="text" name="postsFilter" id="" size="6" value="<?php echo $search['postsFilter']; ?>" />
					最后登录时间:(格式: 年-月-日)
					<input type="text" name="lastvisitFilter" id="" size="10" value="<?php echo $search['lastvisitFilter']; ?>" />
					&nbsp;&nbsp;
					排序:
					<select name="order" id="order">
						<option value="0"<?php echo $search['order']==0?' selected="selected"':''; ?>>好友数</option>
						<option value="1"<?php echo $search['order']==1?' selected="selected"':''; ?>>主题数</option>
						<option value="2"<?php echo $search['order']==2?' selected="selected"':''; ?>>回复数</option>
						<option value="3"<?php echo $search['order']==3?' selected="selected"':''; ?>>最后登录</option>
					</select>
					<select name="orderType" id="orderType">
						<option value="0"<?php echo $search['orderType']==0?' selected="selected"':''; ?>>升序</option>
						<option value="1"<?php echo $search['orderType']==1?' selected="selected"':''; ?>>降序</option>
					</select>
					&nbsp;&nbsp;
					每页:
					<select name="ppp" id="pageCount">
						<option value="50"<?php echo $search['ppp']==50?' selected="selected"':''; ?>>50项</option>
						<option value="100"<?php echo $search['ppp']==100?' selected="selected"':''; ?>>100项</option>
						<option value="200"<?php echo $search['ppp']==200?' selected="selected"':''; ?>>200项</option>
					</select>
					&nbsp;&nbsp;
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
echo '<form action="" method="post" id="friendForm">';
showtableheader();
echo '<tr><td colspan="6" class="partition">当前用户: '.$search['username'].'&nbsp;&nbsp;&nbsp;&nbsp;好友: '.$count.'&nbsp;&nbsp;&nbsp;&nbsp;'.($count>0?'<a href="admin.php?action=plugins&amp;operation=config&amp;do='.$pluginid.'&amp;identifier=homefriend&amp;pmod=index&amp;deleteall=1" onclick="return confirmOperate(\'此操作将删除'.$count.'位好友, 您确定执行操作?\');">删除所有匹配好友</a>':'').'<a href="admin.php?action=plugins&amp;operation=config&amp;do='.$pluginid.'&amp;identifier=homefriend&amp;pmod=index&amp;reload=1" style="float:right;">重新选择用户</a></td></tr>';
echo '<tr class="header"><th>好友名称</th><th>好友数</th><th>主题数</th><th>回复数</th><th>最后登录</th><th>操作</th></tr>';
foreach ($friendData as $value) {
    echo '<tr><td><input type="checkbox" name="friend['.$value['uid'].']" class="friendCheckbox" /> '.
		 '<a href="'.$_G['config']['web']['home'].'space-uid-'.$value['uid'].'.html" target="_blank">'.$value['fusername'].'</a></td>'.
		 '<td>'.$value['friends'].'</td>'.
		 '<td>'.$value['threads'].'</td>'.
		 '<td>'.$value['posts'].'</td>'.
		 '<td>'.($value['lastvisit'] == 0 ? '从未登录' : date('Y-m-d H:i:s', $value['lastvisit'])).'</td>'.
         '<td><a href="'.$_SERVER['REQUEST_URI'].'&uid='.$value['uid'].'&del=1" onclick="return confirmOperate();">删除</a></td></tr>';
}
showtablefooter();
?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />	
			全选/全不选
		</label>
		&nbsp;&nbsp;
		<a href="#" id="delOperate">删除</a>
	</div>
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=homefriend&pmod=index");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	function submitForm(num) {
		if ($('#friendForm .friendCheckbox:checked').size() == 0) {
			return false;
		}
		$('#friendForm input[name="operateNum"]').val(num);
		$('#friendForm').submit();
	}
    $('#delOperate').click(function(){
        if (!confirmOperate()) {
            return false;
        }
		submitForm(3);
	});
	$('#passOperate').click(function(){
		submitForm(1);
	});
	$('#unpassOperate').click(function(){
		submitForm(2);
	});
	
	$('#selectAll').click(function(){
		if ($(this)[0].checked) {
			$('#friendForm .friendCheckbox').attr('checked', true);
		} else {
			$('#friendForm .friendCheckbox').attr('checked', false);
		}
	});
})(jQuery);
function confirmOperate(msg) {
	if (msg == null) {
		msg = "您确定要执行此操作吗";
	}
    return confirm(msg);
}
</script>
