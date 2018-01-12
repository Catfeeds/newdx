<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/shop.php';



if($_GET['id']){
	$id = $_GET['id'];
	$url = 'action=plugins&operation=config&do='.$pluginid.'&identifier=outshop&pmod=admin_market';
	$dq = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE marketid = '$id'");
	if($dq){
		cpmsg('有关联数据暂时不能删除！', $url, 'error');
	}else{
		DB::query("delete from ".DB::table('plugin_shop_market')." WHERE id=".$id);
		cpmsg('删除成功', $url, 'succeed');
	}
}


$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_shop_market')." where 1");
$query = DB::query("SELECT * FROM ".DB::table('plugin_shop_market').' where 1 LIMIT '.($page - 1)*$ppp.",$ppp");

showtableheader();
?>
<tr class="header"><th>编号</th><th>商场名称</th><th>店铺个数</th><th>操作</th><th></th></tr>

<?php while ($value = DB::fetch($query)) {?>
<tr>
	<td>
		<?php echo $value['id']; ?>
	</td>
	<td>
		<input type="text" id="market_<?php echo $value['id']; ?>" name="market" value="<?php echo $value['market']; ?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'"/>
		&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="submit_<?php echo $value['id'];?>" name="submit_<?php echo $value['id'];?>" value="修改" style="visibility:hidden" onClick="checkvalue('market_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="id" value="<?php echo $value['id']; ?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $value['id']; ?>"></span>
	</td>
	<td>
		<?php
		$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_shop_info')." where marketid=$value[id]");
		echo $count;
		?>
	</td>
	<td>
	<a onclick="return confirm('您确认删除？');" href="<?php echo ADMINSCRIPT;?>?action=plugins&operation=config&do=<?php echo $pluginid;?>&identifier=outshop&pmod=admin_market&id=<?php echo $value['id']; ?>">删除</a>
	</td>
</tr>
<?php }
showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=outshop&pmod=admin_market");
?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function checkvalue(m){
	if(document.getElementById(m).value==""){
		alert('请输入商场名称');
		return false;
	}else{
		var market = document.getElementById(m).value;
		var id = jQuery("#"+m).next().next().val();
		var str_url = 'plugin.php?id=outshop:ajax_updateshop&op=market&sid='+id;
		jQuery.ajax({
				url: str_url + '&market='+market,
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
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('商场名称已存在！修改失败！');
					}
					jQuery('#submit_'+id).css("visibility","hidden");
				}
		});
	}
}
</script>
