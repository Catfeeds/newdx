<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';
if($_POST){	
	$url = $_SERVER['QUERY_STRING'];
	$word = $_POST['keywords'];
	if(!empty($word)&&$word!=""){
		DB::query("insert into ".DB::TABLE('plugin_produce_priceurl')." values(null,'".$word."',1)");
		cpmsg('��ӳɹ�', $url, 'succeed');	
	}else{
		cpmsg('�ؼ��ʲ���Ϊ�գ�', $url, 'error');		
	}	
}
if($_GET['id']){	
	if($_GET['statu']==2||$_GET['statu']==1){
		$url = $_SERVER['QUERY_STRING'];
		$id = $_GET['id'];		
		$statu = $_GET['statu']== 1 ? 1 : 0;
		DB::query("update ".DB::TABLE('plugin_produce_priceurl')." set isused = $statu  where kid=".$id);
		cpmsg('�޸ĳɹ�', 'action=plugins&operation=config&do=43&identifier=produce&pmod=admin_price&op=urllist', 'succeed');
	}else{
		$url = $_SERVER['QUERY_STRING'];
		$id = $_GET['id'];	
		DB::query("delete from ".DB::TABLE('plugin_produce_priceurl')." where kid=".$id);
		cpmsg('ɾ���ɹ�', 'action=plugins&operation=config&do=43&identifier=produce&pmod=admin_price&op=urllist', 'succeed');
	}	
}
$query = DB::query("select * from ".DB::table('plugin_produce_priceurl')." where 1");
?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">������ιؼ���</th></tr>
<tr><td class="td27" colspan="2">�ؼ���:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="keywords" class="txt" id="keywords" />
	</td>
	<td class="vtop tips2">
		����(click,s=mm_m)
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>

<div class="box float clear" style="width:920px;border:1px dotted #CCC;margin-top:10px;">
<div class="box float clear" style="width:920px;">
<tr class="header">
	<th>���</th>
	<th>���δ�</th>
	<th>��ǰ״̬</th>
	<th>����</th>
</tr>
<?php
 while ($value = DB::fetch($query)):
?>
<tr class="header">
	<td><?php
echo $value['kid'];
?></td>
	<td><?php
echo $value['words'];
?></td>
	<td><?php
if($value['isused']==1){echo '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_price&op=urllist&id='.$value['kid'].'&statu=2"><span style="color:green">������</span></a>';}else{echo '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_price&op=urllist&id='.$value['kid'].'&statu=1"><span style="color:red">δ����</span></a>';};
?></td>
	<td><?php
	echo '<a onclick="" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_price&op=urllist&id='.$value['kid'].'">ɾ��</a>';
	?></td>
</tr>			
<?php
  endwhile;
?>		

</div>
</div>
<?php showtablefooter();?>
</form>

