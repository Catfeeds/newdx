<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if (!empty($_POST)) {
	foreach ($_POST as $name => $value) {
		DB::query("REPLACE INTO ".DB::table('plugin_forumoption_setting')."  (`name`, `value`) VALUES ('$name', '$value')");
	}
	memory('rm','plugin_forumoption_setting_BvSjK');
	cpmsg('���óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_setting', 'succeed');
}


$setting = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_forumoption_setting'));
while ($value = DB::fetch($query)) {
	$setting[$value['name']] = $value['value'];
}

?>
<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">ȫ������</th></tr>
<tr><td class="td27" colspan="2">�Ƿ���δ��¼ʱ��Сͼ��ʾ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<label for="isSmallPic_true">
			<input type="radio" name="isSmallPic" id="isSmallPic_true"<?php echo $setting['isSmallPic'] ? ' checked="checked"' : ''; ?> value="1" />
			��
		</label>
		<label for="isSmallPic_false">
			<input type="radio" name="isSmallPic" id="isSmallPic_false"<?php echo !$setting['isSmallPic'] ? ' checked="checked"' : ''; ?> value="0" />
			��
		</label>
	</td>
	<td class="vtop tips2">

	</td>
</tr>
<tr><td class="td27" colspan="2">�Ƿ����ط��������Ƽ�����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<label for="recom_thread_opened_true">
			<input type="radio" name="recom_thread_opened" id="recom_thread_opened_true"<?php echo $setting['recom_thread_opened'] ? ' checked="checked"' : ''; ?> value="1" />
			��
		</label>
		<label for="recom_thread_opened_false">
			<input type="radio" name="recom_thread_opened" id="recom_thread_opened_false"<?php echo !$setting['recom_thread_opened'] ? ' checked="checked"' : ''; ?> value="0" />
			��
		</label>
	</td>
	<td class="vtop tips2">

	</td>
</tr>
<tr><td class="td27" colspan="2">�ط��������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="set_title" id="set_title" value="<?php echo $setting['set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="set_keywords" id="set_keywords" value="<?php echo $setting['set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="set_desc" id="set_desc" value="<?php echo $setting['set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>

<tr><td class="td27" colspan="2">�߳����Ű�������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="zcgm_set_title" id="set_title" value="<?php echo $setting['zcgm_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="zcgm_set_keywords" id="set_keywords" value="<?php echo $setting['zcgm_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="zcgm_set_desc" id="set_desc" value="<?php echo $setting['zcgm_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">�����������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="dy_set_title" id="dy_set_title" value="<?php echo $setting['dy_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="dy_set_keywords" id="dy_set_keywords" value="<?php echo $setting['dy_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="dy_set_desc" id="dy_set_desc" value="<?php echo $setting['dy_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>



<tr><td class="td27" colspan="2">¿��֮�Ұ�������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="lyzj_set_title" id="lyzj_set_title" value="<?php echo $setting['lyzj_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="lyzj_set_keywords" id="lyzj_set_keywords" value="<?php echo $setting['lyzj_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="lyzj_set_desc" id="lyzj_set_desc" value="<?php echo $setting['lyzj_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">������ʳ��������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="hwms_set_title" id="hwms_set_title" value="<?php echo $setting['hwms_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="hwms_set_keywords" id="hwms_set_keywords" value="<?php echo $setting['hwms_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="hwms_set_desc" id="hwms_set_desc" value="<?php echo $setting['hwms_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">�Լ�ƴ����������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="zjpc_set_title" id="zjpc_set_title" value="<?php echo $setting['zjpc_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="zjpc_set_keywords" id="zjpc_set_keywords" value="<?php echo $setting['zjpc_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="zjpc_set_desc" id="zjpc_set_desc" value="<?php echo $setting['zjpc_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">��ѩ��������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="hx_set_title" id="hx_set_title" value="<?php echo $setting['hx_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="hx_set_keywords" id="hx_set_keywords" value="<?php echo $setting['hx_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="hx_set_desc" id="hx_set_desc" value="<?php echo $setting['hx_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>



<tr><td class="td27" colspan="2">װ�����°�������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="zbtx_set_title" id="zbtx_set_title" value="<?php echo $setting['zbtx_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="zbtx_set_keywords" id="zbtx_set_keywords" value="<?php echo $setting['zbtx_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="zbtx_set_desc" id="zbtx_set_desc" value="<?php echo $setting['zbtx_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">��ҵ���������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="syhd_set_title" id="syhd_set_title" value="<?php echo $setting['syhd_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="syhd_set_keywords" id="syhd_set_keywords" value="<?php echo $setting['syhd_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="syhd_set_desc" id="syhd_set_desc" value="<?php echo $setting['syhd_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">װ�����װ�������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="zbjy_set_title" id="zbjy_set_title" value="<?php echo $setting['zbjy_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="zbjy_set_keywords" id="zbjy_set_keywords" value="<?php echo $setting['zbjy_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="zbjy_set_desc" id="zbjy_set_desc" value="<?php echo $setting['zbjy_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>



<tr><td class="td27" colspan="2">�������°�������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="qxtx_set_title" id="qxtx_set_title" value="<?php echo $setting['qxtx_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="qxtx_set_keywords" id="qxtx_set_keywords" value="<?php echo $setting['qxtx_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="qxtx_set_desc" id="qxtx_set_desc" value="<?php echo $setting['qxtx_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>

<tr><td class="td27" colspan="2">ˮ���˶���������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="ssyd_set_title" id="ssyd_set_title" value="<?php echo $setting['ssyd_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="ssyd_set_keywords" id="ssyd_set_keywords" value="<?php echo $setting['ssyd_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="ssyd_set_desc" id="ssyd_set_desc" value="<?php echo $setting['ssyd_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">���ʱش��������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="ywbd_set_title" id="ywbd_set_title" value="<?php echo $setting['ywbd_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="ywbd_set_keywords" id="ywbd_set_keywords" value="<?php echo $setting['ywbd_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="ywbd_set_desc" id="ywbd_set_desc" value="<?php echo $setting['ywbd_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>

<tr><td class="td27" colspan="2">¿�з����������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="lxfw_set_title" id="lxfw_set_title" value="<?php echo $setting['lxfw_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="lxfw_set_keywords" id="lxfw_set_keywords" value="<?php echo $setting['lxfw_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="lxfw_set_desc" id="lxfw_set_desc" value="<?php echo $setting['lxfw_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>



<tr><td class="td27" colspan="2">ɽ���Ⱥ��������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="swcq_set_title" id="swcq_set_title" value="<?php echo $setting['swcq_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="swcq_set_keywords" id="swcq_set_keywords" value="<?php echo $setting['swcq_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="swcq_set_desc" id="swcq_set_desc" value="<?php echo $setting['swcq_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">�ұڰ��ٰ�������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="ybbl_set_title" id="ybbl_set_title" value="<?php echo $setting['ybbl_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="ybbl_set_keywords" id="ybbl_set_keywords" value="<?php echo $setting['ybbl_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="ybbl_set_desc" id="ybbl_set_desc" value="<?php echo $setting['ybbl_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>


<tr><td class="td27" colspan="2">AA��Լ��������Ϣ����(SEO)ͳһ���ù���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title��<input type="text" name="aa_set_title" id="aa_set_title" value="<?php echo $setting['aa_set_title']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		&nbsp;&nbsp;keywords��<input type="text" name="aa_set_keywords" id="aa_set_keywords" value="<?php echo $setting['aa_set_keywords']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		description��<input type="text" name="aa_set_desc" id="aa_set_desc" value="<?php echo $setting['aa_set_desc']?>" />
	</td>
	<td class="vtop tips2">
		("*"�������·�����Ϣ���⣬����*���ɣ���д��ʽ�磺*��������*��̳��*��������)
	</td>
</tr>

<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>
