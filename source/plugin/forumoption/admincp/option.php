<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/admincp');



$option_fields = array(
	'headerAd' => '',
	'isFullScreen' => '',
	'isFullScreen_viewthread' => '',
	'isLoadjs' => '',
	'isDigest' => 0
);

$optionid = $_GET['opid'];
$query = DB::query("SELECT * FROM ".DB::table('plugin_forumoption_field')." WHERE optionid = {$optionid}");

while ($value = DB::fetch($query)) {
	$option_fields[$value['type']] = $value['value'];
}

if (!empty($_POST)) {
	foreach ($option_fields as $i => $field) {
		if (isset($_POST[$i])) {
			$value = $_POST[$i];
			DB::query("REPLACE INTO ".DB::table('plugin_forumoption_field')." (optionid, value, type) VALUES ({$optionid}, '{$value}', '{$i}')");
		}
	}
	memory('rm', 'oBmjvS_fid');
	cpmsg('���óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp', 'succeed');
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">����</th></tr>
<tr><td class="td27" colspan="2">ҳ�׹��id:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="headerAd" class="txt" id="" value="<?php echo $option_fields['headerAd']; ?>" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">���ҳ�Ƿ�̶̹���ʾ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isFullScreen']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isFullScreen" class="radio" <?php if ($option_fields['isFullScreen']==1) {?> checked="checked"<?php } ?>>&nbsp;�̶�����</li>
			<li <?php if ($option_fields['isFullScreen']==2) {?> class="checked"<?php } ?>><input type="radio" value="2" name="isFullScreen" class="radio" <?php if ($option_fields['isFullScreen']==2) {?> checked="checked"<?php } ?>>&nbsp;�̶�խ��</li>
			<li <?php if ($option_fields['isFullScreen']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isFullScreen" class="radio" <?php if ($option_fields['isFullScreen']==0) {?> checked="checked"<?php } ?>>&nbsp;Ĭ��</li>
		</ul>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">������ϸҳ�Ƿ������ʾ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isFullScreen_viewthread']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isFullScreen_viewthread" class="radio" <?php if ($option_fields['isFullScreen_viewthread']==1) {?> checked="checked"<?php } ?>>&nbsp;�̶�����</li>
			<li <?php if ($option_fields['isFullScreen_viewthread']==2) {?> class="checked"<?php } ?>><input type="radio" value="2" name="isFullScreen_viewthread" class="radio" <?php if ($option_fields['isFullScreen_viewthread']==2) {?> checked="checked"<?php } ?>>&nbsp;�̶�խ��</li>
			<li <?php if ($option_fields['isFullScreen_viewthread']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isFullScreen_viewthread" class="radio" <?php if ($option_fields['isFullScreen_viewthread']==0) {?> checked="checked"<?php } ?>>&nbsp;Ĭ��</li>
		</ul>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>


<tr><td class="td27" colspan="2">����Ƿ����js���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isLoadjs']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isLoadjs" class="radio" <?php if ($option_fields['isLoadjs']==1) {?> checked="checked"<?php } ?>>&nbsp;��</li>
			<li <?php if ($option_fields['isLoadjs']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isLoadjs" class="radio" <?php if ($option_fields['isLoadjs']==0) {?> checked="checked"<?php } ?>>&nbsp;��</li>
		</ul>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">�Ƿ�Ĭ����ʾ������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isDigest']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isDigest" class="radio" <?php if ($option_fields['isDigest']==1) {?> checked="checked"<?php } ?>>&nbsp;��</li>
			<li <?php if ($option_fields['isDigest']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isDigest" class="radio" <?php if ($option_fields['isDigest']==0) {?> checked="checked"<?php } ?>>&nbsp;��</li>
		</ul>
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
