<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
?>

<form action="" method="POST">
	<table class="tb tb2">
		<tbody>
			<tr>
				<th class="partition">����</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
					������:
					<input type="text" name="threadsFilter" id="" size="6" value="<?php echo $search['threadsFilter']; ?>" />
					�ظ���:
					<input type="text" name="postsFilter" id="" size="6" value="<?php echo $search['postsFilter']; ?>" />
					����¼ʱ��:(��ʽ: ��-��-��)
					<input type="text" name="lastvisitFilter" id="" size="10" value="<?php echo $search['lastvisitFilter']; ?>" />
					&nbsp;&nbsp;
					����:
					<select name="order" id="order">
						<option value="0"<?php echo $search['order']==0?' selected="selected"':''; ?>>������</option>
						<option value="1"<?php echo $search['order']==1?' selected="selected"':''; ?>>������</option>
						<option value="2"<?php echo $search['order']==2?' selected="selected"':''; ?>>�ظ���</option>
						<option value="3"<?php echo $search['order']==3?' selected="selected"':''; ?>>����¼</option>
					</select>
					<select name="orderType" id="orderType">
						<option value="0"<?php echo $search['orderType']==0?' selected="selected"':''; ?>>����</option>
						<option value="1"<?php echo $search['orderType']==1?' selected="selected"':''; ?>>����</option>
					</select>
					&nbsp;&nbsp;
					ÿҳ:
					<select name="ppp" id="pageCount">
						<option value="50"<?php echo $search['ppp']==50?' selected="selected"':''; ?>>50��</option>
						<option value="100"<?php echo $search['ppp']==100?' selected="selected"':''; ?>>100��</option>
						<option value="200"<?php echo $search['ppp']==200?' selected="selected"':''; ?>>200��</option>
					</select>
					&nbsp;&nbsp;
					<input type="submit" value="����" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
echo '<form action="" method="post" id="friendForm">';
showtableheader();
echo '<tr><td colspan="6" class="partition">��ǰ�û�: '.$search['username'].'&nbsp;&nbsp;&nbsp;&nbsp;����: '.$count.'&nbsp;&nbsp;&nbsp;&nbsp;'.($count>0?'<a href="admin.php?action=plugins&amp;operation=config&amp;do='.$pluginid.'&amp;identifier=homefriend&amp;pmod=index&amp;deleteall=1" onclick="return confirmOperate(\'�˲�����ɾ��'.$count.'λ����, ��ȷ��ִ�в���?\');">ɾ������ƥ�����</a>':'').'<a href="admin.php?action=plugins&amp;operation=config&amp;do='.$pluginid.'&amp;identifier=homefriend&amp;pmod=index&amp;reload=1" style="float:right;">����ѡ���û�</a></td></tr>';
echo '<tr class="header"><th>��������</th><th>������</th><th>������</th><th>�ظ���</th><th>����¼</th><th>����</th></tr>';
foreach ($friendData as $value) {
    echo '<tr><td><input type="checkbox" name="friend['.$value['uid'].']" class="friendCheckbox" /> '.
		 '<a href="'.$_G['config']['web']['home'].'space-uid-'.$value['uid'].'.html" target="_blank">'.$value['fusername'].'</a></td>'.
		 '<td>'.$value['friends'].'</td>'.
		 '<td>'.$value['threads'].'</td>'.
		 '<td>'.$value['posts'].'</td>'.
		 '<td>'.($value['lastvisit'] == 0 ? '��δ��¼' : date('Y-m-d H:i:s', $value['lastvisit'])).'</td>'.
         '<td><a href="'.$_SERVER['REQUEST_URI'].'&uid='.$value['uid'].'&del=1" onclick="return confirmOperate();">ɾ��</a></td></tr>';
}
showtablefooter();
?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />	
			ȫѡ/ȫ��ѡ
		</label>
		&nbsp;&nbsp;
		<a href="#" id="delOperate">ɾ��</a>
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
		msg = "��ȷ��Ҫִ�д˲�����";
	}
    return confirm(msg);
}
</script>
