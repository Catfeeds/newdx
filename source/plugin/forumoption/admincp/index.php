<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT o.id, o.name, o.fid, o.typeid, t.name as typeName, f.name as forumName FROM ".DB::table('plugin_forumoption').' as o
				   LEFT JOIN '.DB::table('forum_threadtype').' as t
				   ON o.typeid != 0 AND o.typeid = t.typeid
				   LEFT JOIN '.DB::table('forum_forum').' as f
				   ON o.fid != 0 AND o.fid = f.fid
				   ');
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=newop">�½�����</a></td></tr>';
echo '<tr class="header"><th>����</th><th>����ģ��</th><th>����������Ϣ</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['name'].'</td>'.
         '<td>'.($value['forumName']?$value['forumName']:'��').'</td>'.
         '<td>'.($value['typeName']?$value['typeName']:'��').'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=option&opid='.$value['id'].'">����</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=editop&opid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=delop&opid='.$value['id'].'">ɾ��</a></td>';
}
showtablefooter();

