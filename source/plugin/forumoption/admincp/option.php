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
	cpmsg('设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp', 'succeed');
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">设置</th></tr>
<tr><td class="td27" colspan="2">页首广告id:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="headerAd" class="txt" id="" value="<?php echo $option_fields['headerAd']; ?>" />
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">板块页是否固固定显示:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isFullScreen']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isFullScreen" class="radio" <?php if ($option_fields['isFullScreen']==1) {?> checked="checked"<?php } ?>>&nbsp;固定宽屏</li>
			<li <?php if ($option_fields['isFullScreen']==2) {?> class="checked"<?php } ?>><input type="radio" value="2" name="isFullScreen" class="radio" <?php if ($option_fields['isFullScreen']==2) {?> checked="checked"<?php } ?>>&nbsp;固定窄屏</li>
			<li <?php if ($option_fields['isFullScreen']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isFullScreen" class="radio" <?php if ($option_fields['isFullScreen']==0) {?> checked="checked"<?php } ?>>&nbsp;默认</li>
		</ul>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">贴子详细页是否宽屏显示:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isFullScreen_viewthread']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isFullScreen_viewthread" class="radio" <?php if ($option_fields['isFullScreen_viewthread']==1) {?> checked="checked"<?php } ?>>&nbsp;固定宽屏</li>
			<li <?php if ($option_fields['isFullScreen_viewthread']==2) {?> class="checked"<?php } ?>><input type="radio" value="2" name="isFullScreen_viewthread" class="radio" <?php if ($option_fields['isFullScreen_viewthread']==2) {?> checked="checked"<?php } ?>>&nbsp;固定窄屏</li>
			<li <?php if ($option_fields['isFullScreen_viewthread']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isFullScreen_viewthread" class="radio" <?php if ($option_fields['isFullScreen_viewthread']==0) {?> checked="checked"<?php } ?>>&nbsp;默认</li>
		</ul>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>


<tr><td class="td27" colspan="2">版块是否加载js广告:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isLoadjs']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isLoadjs" class="radio" <?php if ($option_fields['isLoadjs']==1) {?> checked="checked"<?php } ?>>&nbsp;是</li>
			<li <?php if ($option_fields['isLoadjs']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isLoadjs" class="radio" <?php if ($option_fields['isLoadjs']==0) {?> checked="checked"<?php } ?>>&nbsp;否</li>
		</ul>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>
<tr><td class="td27" colspan="2">是否默认显示精华贴:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<ul onmouseover="altStyle(this);">
			<li <?php if ($option_fields['isDigest']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="isDigest" class="radio" <?php if ($option_fields['isDigest']==1) {?> checked="checked"<?php } ?>>&nbsp;是</li>
			<li <?php if ($option_fields['isDigest']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="isDigest" class="radio" <?php if ($option_fields['isDigest']==0) {?> checked="checked"<?php } ?>>&nbsp;否</li>
		</ul>
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
