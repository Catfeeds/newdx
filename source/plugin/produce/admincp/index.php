<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$ppp = 50;
$page = max(1, intval($_G['gp_page']));

//$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_type')." WHERE 3 = 3");
$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_type').' where tparent=0 LIMIT '.($page - 1)*$ppp.",$ppp");

function getChildType($tid){
  $query = DB::query("SELECT * FROM ".DB::table('plugin_produce_type').' where tparent='.$tid." order by id");
  while ($value = DB::fetch($query)) {
	  echo '<tr>'.
	       '<td>'."".'</td>'.
	       '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<input type="text" readonly="readonly" name="tname" value="'.$value['tname'].'"/></td>'.		
           '<td>'.($value['tparent']?'<font color="#FF00FF">二级</font>':'<font color="#0000FF">一级</font>').'</td>'.
           '<td>'.($value['tshow']?'是':'否').'</td>'.
           '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=editop&opid='.$value['id'].'">编辑</a>&nbsp;&nbsp;'.
		   '<a onclick="return confirm(\'确定删除该记录吗?\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=delop&opid='.$value['id'].'">删除</a></td></tr>';
  }
}
showtableheader();
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=newop">新建类别</a></td></tr>';
echo '<tr class="header"><th> </th><th>类别名称</th><th>级别</th><th>是否显示</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {	
	echo '<tr>'.
         '<td>'."<a href='##' onclick=''>[+]</a>".'</td>'.
	     '<td>'.'<input type="text"  readonly="readonly" name="tname" value="'.$value['tname'].'"/></td>'.		
         '<td>'.($value['tparent']?'<font color="#FF00FF">二级</font>':'<font color="#0000FF">一级</font>').'</td>'.
         '<td>'.($value['tshow']?'是':'否').'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=editop&opid='.$value['id'].'">编辑</a>&nbsp;&nbsp;'.
		 '<a onclick="return confirm(\'提示：\n您删除的是一级分类，它关联的二级分类也会被删除，请谨慎操作！\n确定删除该记录吗?\n\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=delop&opid='.$value['id'].'">删除</a></td></tr>';
		 getChildType($value['id']);	
}
showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_type");
