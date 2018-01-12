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
		cpmsg('有关联数据暂时不能删除！tid='.$dq['tid'], $url, 'error');
	}else{
		DB::query("delete from ".DB::table('plugin_brand_produce')." WHERE id=".$id);
		cpmsg('删除成功', $url, 'succeed');
	}
}



$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_brand_produce')." where 1");
$query = DB::query("SELECT * FROM ".DB::table('plugin_brand_produce')." where 1
				   LIMIT ".($page - 1)*$ppp.", $ppp");
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=brand&pmod=admin_coverproduce&op=newproduce">添加新产品</a></td></tr>';
?>


<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr class="header">
	<th>编号</th>
	<th>产品</th>
	<th>品牌个数</th>
	<th>操作</th>
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
		&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="submit_<?php echo $value['id'];?>" name="submit_<?php echo $value['id'];?>" value="修改" style="visibility:hidden" onClick="checkvalue('produce_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="id" value="<?php echo $value['id']; ?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $value['id']; ?>"></span>

	</td>
	<td>
		<?php
		$numn = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_brand_info')." where ranklist like ('%$value[id]%')");
		echo $numn;
		?>
	</td>
	<td>
	<a onclick="return confirm('您确认删除？');" href="<?php echo ADMINSCRIPT;?>?action=plugins&operation=config&do=<?php echo $pluginid;?>&identifier=brand&pmod=admin_coverproduce&id=<?php echo $value['id']; ?>">删除</a>
	</td>
</tr>
<?php endwhile; ?>
<?php showtablefooter(); ?>

</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
function checkvalue(m){
	if(document.getElementById(m).value==""){
		alert('请输入产品名称');
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
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改成功！');
					}else if(msg=="error"){
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改失败！');
					}else if(msg=="cunzai"){
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('产品名称已存在，修改失败！');
					}
					jQuery('#submit_'+id).css("visibility","hidden");
				}
		});
	}
}
</script>

