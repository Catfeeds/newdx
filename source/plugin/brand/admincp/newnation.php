<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


if (!empty($_POST)) {
	$nation = $_POST['nation'];	
	DB::query("INSERT INTO ".DB::table('plugin_brand_area')."
			  (area) VALUES ('{$nation}')");
	cpmsg('�½�������Ϣ�ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=brand&pmod=admin_area', 'succeed');
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
  if (validate_required(nation,"�������Ʋ���Ϊ��!")==false)
    {nation.focus();return false}
  }
}
</script>

<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">����¹���</th></tr>
<tr><td class="td27" colspan="2">��������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="nation" class="txt" id="" />
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

