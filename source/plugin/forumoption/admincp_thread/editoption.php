<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/admincp_thread/class.php';

$optionid = $_GET['opid'];
$option = DB::fetch_first("SELECT * FROM ".DB::table('plugin_threadoption')." WHERE id = {$optionid}");

if (!empty($_POST)) {
	$tid = (int)$_POST['tid'];
	
	if ($option['class'] != $_POST['class']) {
		DB::query("DELETE FROM ".DB::table('plugin_threadoption_field')." WHERE optionid = ".$optionid);
	}
	
	DB::query("UPDATE ".DB::table('plugin_threadoption')."
			  SET tid = {$tid},
			      class = {$_POST['class']}
			  WHERE id = {$optionid}");
	cpmsg('�޸����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread', 'succeed');
}
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">�༭����</th></tr>
<tr><td class="td27" colspan="2">����id:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="tid" class="txt" value="<?php echo $option['tid']; ?>" id="" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<select name="class">
			<?php foreach(ThreadClass::getClasses() as $i => $item) { ?>
			<option value="<?php echo $i; ?>" <?php if ($option['class'] == $i) { ?> checked="checked"<?php } ?>><?php echo $item['name']; ?></option>
			<?php } ?>
		</select>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" name="editsubmit" id="submit_editsubmit" class="btn" />
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>