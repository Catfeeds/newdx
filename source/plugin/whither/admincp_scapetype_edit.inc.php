<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$scapetype = array();
$scapetypeid = $_GET['scapetypeid'];

if (!empty($_POST)) {
	$name = trim($_POST['name']);
	$defaultInfo = trim($_POST['defaultInfo']);
	$defaultInfo = preg_replace('/\s*,\s*/', ',', $defaultInfo);

	if (empty($scapetypeid)) {
		DB::query("INSERT INTO ".DB::table('mudidi_scapetype')." (name, defaultInfo) VALUES ('{$name}', '{$defaultInfo}')");
	} else {
		DB::query("UPDATE ".DB::table('mudidi_scapetype')." SET name = '{$name}', defaultInfo = '{$defaultInfo}' WHERE id = {$scapetypeid}");
	}

    cpmsg('�����ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_scapetype', 'succeed');
}

if (!empty($scapetypeid)) {
	$scapetype = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_scapetype')." WHERE id = $scapetypeid");
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">�������ͱ༭</th></tr>
<tr><td class="td27" colspan="2">����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="name" class="txt" value="<?php echo $scapetype['name']; ?>" id="" />
	</td>
	<td class="vtop tips2">
	</td>
</tr>
<tr><td class="td27" colspan="2">Ĭ��������Ϣ����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<textarea class="tarea" name="defaultInfo" onkeyup="textareasize(this, 0)" ondblclick="textareasize(this, 1)"><?php echo $scapetype['defaultInfo']; ?></textarea>
	</td>
	<td class="vtop tips2">
		���������Ϣ����,�ָ�(Ӣ�Ķ���)
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
