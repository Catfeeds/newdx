<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords_category'));
showtableheader();
echo '<tr><td colspan="2"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category&op=new">�½�����</a></td></tr>';
echo '<tr class="header"><th>��������</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['name'].'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category&op=edit&cid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp_category&op=del&cid='.$value['id'].'">ɾ��</a></td>';
}
showtablefooter();
