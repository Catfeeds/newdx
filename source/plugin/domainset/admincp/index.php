<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT * FROM ".DB::table('plugin_domainset').' where 1=1');
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=newop">�½�����</a></td></tr>';
echo '<tr class="header"><th>�����ַ</th><th>��ת��ַ</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['reqaddress'].'</td>'.
         '<td>'.$value['resaddress'].'</td>'.
         '<td>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		 '<a onclick="return confirm(\'��ȷ��ִ��ɾ������ô��\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=delop&opid='.$value['id'].'">ɾ��</a></td>';
}
showtablefooter();

