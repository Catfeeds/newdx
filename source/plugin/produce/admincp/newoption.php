<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$ppp = 30;
$page = max(1, intval($_G['gp_page']));

/** ��ѯ������������б� */
$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_type')." WHERE 1 = 1");
$query = DB::query("SELECT id, tname FROM ".DB::table('plugin_produce_type')." where tparent=0 LIMIT ".($page - 1)*$ppp.", $ppp");
$type_select = '<select name="produce_type"><option value="0">��</option>';
while ($value = DB::fetch($query)) {
	$type_select .= '<option value="'.$value['id'].'">'.$value['tname'].'</option>';
}
$type_select .= '</select>';


if (!empty($_POST)) {
	$name = $_POST['tname'];
	$typename = $_POST['produce_type'];
	$isshow = $_POST['isshow'];
	
	DB::query("INSERT INTO ".DB::table('plugin_produce_type')."
			  (tname, tparent, tshow) VALUES ('{$name}', {$typename}, {$isshow})");
	cpmsg('�½����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type', 'succeed');
}

?>

<script type="text/javascript">
function validate_required(field,alerttxt)
{
  with (field)
  {
  if (value==null||value=="")
    {alert(alerttxt);return false}
  else {return true}
  }
}

function validate_form(thisform)
{
  with (thisform)
  {
  if (validate_required(tname,"������Ʋ���Ϊ��!")==false)
    {tname.focus();return false}
  }
}
</script>

<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">�½����</th></tr>
<tr><td class="td27" colspan="2">�������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="tname" class="txt" id="" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">��������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<?php echo $type_select; ?>
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>


<tr><td class="td27" colspan="2">�Ƿ���ʾ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="radio" value="1" name="isshow" checked="checked"/>�� &nbsp;&nbsp; <input type="radio" value="0" name="isshow"/>��
	</td>
	<td class="vtop tips2">
		 
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

