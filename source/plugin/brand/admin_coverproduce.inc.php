<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';

if ($_GET['op']=='newproduce') {
	$include_path = dirname(__file__).'/admincp/newproduce.php';
	include $include_path;
	exit;
}


if($_GET['id']){
	$id = $_GET['id'];
	$url = 'action=plugins&operation=config&do='.$pluginid.'&identifier=brand&pmod=admin_coverproduce';
	$dq = DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE ranklist in ('$id')");
	if($dq){
		cpmsg('�й���������ʱ����ɾ����tid='.$dq['tid'], $url, 'error');
	}else{
		DB::query("delete from ".DB::table('plugin_brand_produce')." WHERE id=".$id);
		cpmsg('ɾ���ɹ�', $url, 'succeed');
	}
}



$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_brand_produce')." where 1");
$query = DB::query("SELECT * FROM ".DB::table('plugin_brand_produce')." where 1
				   LIMIT ".($page - 1)*$ppp.", $ppp");
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=brand&pmod=admin_coverproduce&op=newproduce">����²�Ʒ</a></td></tr>';
?>


<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr class="header">
	<th>���</th>
	<th>��Ʒ</th>
	<th>Ʒ�Ƹ���</th>
	<th>����</th>
</tr>
<style type="text/css">
	.zhen{color:blue;}
	.zhi{color:#0F0;}
	.jing{color:#F0F;}
	.undigest{color: #C00;}
	.unworth{color: #C00;}
	.unxiu{color: #C00;}
	.yishen{color: #00FF00;}
	.weishen{color: #FF0000;}
</style>

<?php while ($value = DB::fetch($query)):
?>
<tr>
	<td>
		<?php echo $value['id']; ?>
	</td>
    <td>
		<input type="text" id="produce_<?php echo $value['id']; ?>" name="produce" value="<?php echo $value['produce']; ?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'"/>
		&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="submit_<?php echo $value['id'];?>" name="submit_<?php echo $value['id'];?>" value="�޸�" style="visibility:hidden" onClick="checkvalue('produce_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="id" value="<?php echo $value['id']; ?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $value['id']; ?>"></span>

	</td>
	<td>
		<?php
		$numn = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_brand_info')." where ranklist like ('%$value[id]%')");
		echo $numn;
		?>
	</td>
	<td>
	<a onclick="return confirm('��ȷ��ɾ����');" href="<?php echo ADMINSCRIPT;?>?action=plugins&operation=config&do=<?php echo $pluginid;?>&identifier=brand&pmod=admin_coverproduce&id=<?php echo $value['id']; ?>">ɾ��</a>
	</td>
</tr>
<?php endwhile; ?>
<?php showtablefooter(); ?>

</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
function checkvalue(m){
	if(document.getElementById(m).value==""){
		alert('�������Ʒ����');
		return false;
	}else{
		var produce = document.getElementById(m).value;
		var id = jQuery("#"+m).next().next().val();
		var str_url = 'plugin.php?id=brand:ajax_updateproduce&op=update&sid='+id;
		jQuery.ajax({
				url: str_url + '&produce='+produce,
				type: "get",
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('�޸ĳɹ���');
					}else if(msg=="error"){
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('�޸�ʧ�ܣ�');
					}else if(msg=="cunzai"){
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('��Ʒ�����Ѵ��ڣ��޸�ʧ�ܣ�');
					}
					jQuery('#submit_'+id).css("visibility","hidden");
				}
		});
	}
}
</script>

