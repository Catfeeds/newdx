<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
require_once libfile('function/admincp');

$optionid = $_GET['opid'];
$option = DB::fetch_first("SELECT * FROM ".DB::table('plugin_forumoption')." WHERE id = {$optionid}");

// ������ѡ��
$forum_select = '<select name="forum"><option value="0">��</option>';
$forum_select .= forumselect(FALSE, 0, 0, TRUE);
$forum_select .= '</select>';
$forum_select = str_replace('<option value="'.$option['fid'].'"', '<option value="'.$option['fid'].'" selected="selected"', $forum_select);

// ������Ϣ����ѡ��
$query = DB::query("SELECT typeid, name FROM ".DB::table('forum_threadtype')."");
$threadtype_select = '<select name="threadtype"><option value="0">��</option>';
while ($value = DB::fetch($query)) {
	$threadtype_select .= '<option value="'.$value['typeid'].'">'.$value['name'].'</option>';
}
$threadtype_select .= '</select>';
$threadtype_select = str_replace('<option value="'.$option['typeid'].'"', '<option value="'.$option['typeid'].'" selected="selected"', $threadtype_select);

if (!empty($_POST)) {
	$name = $_POST['name'];
	$forumid = $_POST['forum'];
	$threadtype = $_POST['threadtype'];
	
	DB::query("UPDATE ".DB::table('plugin_forumoption')."
			   SET name = '{$name}',
				   fid = {$forumid},
				   typeid = {$threadtype}
			   WHERE id = {$optionid}");
	memory('rm', 'oBmjvS_fid');
	cpmsg('�޸����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp', 'succeed');
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">�޸�����</th></tr>
<tr><td class="td27" colspan="2">����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="name" class="txt" id="" value="<?php echo $option['name']; ?>" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">�������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php echo $forum_select; ?>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">����������Ϣ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<?php echo $threadtype_select; ?>
	</td>
	<td class="vtop tips2">
		�����ѡ����Ϊ������ϵ,���û���ͬʱ�ڴ�ģ��ʹ˷�����Ϣ����Ч <br/>
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