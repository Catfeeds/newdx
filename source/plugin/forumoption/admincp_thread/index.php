<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT o.id, o.tid, t.subject FROM ".DB::table('plugin_threadoption').' as o
				   LEFT JOIN '.DB::table('forum_thread').' as t
				   ON o.tid = t.tid
				   ');
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=newop">�½�����</a></td></tr>';
echo '<tr class="header"><th>����ID</th><th>���ӱ���</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['tid'].'</td>'.
         '<td>'.$value['subject'].'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=option&opid='.$value['id'].'">����</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=editop&opid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=delop&opid='.$value['id'].'">ɾ��</a></td>';
}
showtablefooter();