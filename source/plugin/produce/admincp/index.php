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
           '<td>'.($value['tparent']?'<font color="#FF00FF">����</font>':'<font color="#0000FF">һ��</font>').'</td>'.
           '<td>'.($value['tshow']?'��':'��').'</td>'.
           '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=editop&opid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		   '<a onclick="return confirm(\'ȷ��ɾ���ü�¼��?\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=delop&opid='.$value['id'].'">ɾ��</a></td></tr>';
  }
}
showtableheader();
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=newop">�½����</a></td></tr>';
echo '<tr class="header"><th> </th><th>�������</th><th>����</th><th>�Ƿ���ʾ</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {	
	echo '<tr>'.
         '<td>'."<a href='##' onclick=''>[+]</a>".'</td>'.
	     '<td>'.'<input type="text"  readonly="readonly" name="tname" value="'.$value['tname'].'"/></td>'.		
         '<td>'.($value['tparent']?'<font color="#FF00FF">����</font>':'<font color="#0000FF">һ��</font>').'</td>'.
         '<td>'.($value['tshow']?'��':'��').'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=editop&opid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		 '<a onclick="return confirm(\'��ʾ��\n��ɾ������һ�����࣬�������Ķ�������Ҳ�ᱻɾ���������������\nȷ��ɾ���ü�¼��?\n\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_type&op=delop&opid='.$value['id'].'">ɾ��</a></td></tr>';
		 getChildType($value['id']);	
}
showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_type");
