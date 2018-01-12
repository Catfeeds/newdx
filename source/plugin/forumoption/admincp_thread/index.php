<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT o.id, o.tid, t.subject FROM ".DB::table('plugin_threadoption').' as o
				   LEFT JOIN '.DB::table('forum_thread').' as t
				   ON o.tid = t.tid
				   ');
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=newop">新建设置</a></td></tr>';
echo '<tr class="header"><th>贴子ID</th><th>贴子标题</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['tid'].'</td>'.
         '<td>'.$value['subject'].'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=option&opid='.$value['id'].'">设置</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=editop&opid='.$value['id'].'">编辑</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp_thread&op=delop&opid='.$value['id'].'">删除</a></td>';
}
showtablefooter();