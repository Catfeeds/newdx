<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/shop.php';

$ppp = 50;
$page = max(1, intval($_G['gp_page']));

if (isset($_GET['id']) && isset($_GET['isshow'])) {
	DB::query("UPDATE ".DB::table('plugin_shop_taobao')." SET isshow = {$_GET['isshow']} WHERE id = {$_GET['id']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?id=\d+/', '', $url);
	$url = preg_replace('/&?isshow=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

if ($_GET['del'] == 1 && $_GET['id']) {
	$url = $_SERVER['QUERY_STRING'];
    $url = preg_replace('/(&|\?)id=\d+/i', '', $url);
    $url = preg_replace('/(&|\?)del=1/i', '', $url);
	DB::query("delete from ".DB::table('plugin_shop_taobao')." WHERE id = {$_GET['id']}");
	cpmsg('操作成功', $url, 'succeed');
}

$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_shop_taobao')." where 1");
$query = DB::query("SELECT * FROM ".DB::table('plugin_shop_taobao').' where 1 LIMIT '.($page - 1)*$ppp.",$ppp");
showtableheader();
?>
<tr class="header"><th>编号</th><th>卖家昵称</th><th>用户名</th><th>添加时间</th><th>操作</th></tr>
<?php while ($value = DB::fetch($query)) {?>
<tr>
	<td>
		<?php echo $value['id']; ?>
	</td>
	<td>
	  <?php echo $value['nick']; ?>
	</td>
	<td>
	   <?php echo $value['username']; ?>
	</td>
		<td>
		<?php echo date('Y-m-d H:i:s', $value['dateline']); ?>
	</td>
		<td>

		<a class="digest" <?php echo ($value['isshow']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&id=<?php echo $value['id']; ?>&isshow=1">通过</a>
		<a class="undigest" <?php echo ($value['isshow']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&id=<?php echo $value['id']; ?>&isshow=0" style="color:#C00;">取审</a>
	&nbsp;
		<a onclick="return confirm('您确认删除此条信息么?');" href="<?php echo $_SERVER['REQUEST_URI']; ?>&id=<?php echo $value['id']; ?>&del=1">删除</a>
	</td>
</tr>
<?php }
showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=outshop&pmod=admin_taobao");
?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function checkvalue(m){
	if(document.getElementById(m).value==""){
		alert('请输入连锁品牌名称');
		return false;
	}else{
		var cbrand = document.getElementById(m).value;
		var id = jQuery("#"+m).next().next().val();
		var str_url = 'plugin.php?id=outshop:ajax_updateshop&op=chainbrand&sid='+id;
		jQuery.ajax({
				url: str_url + '&cbrand='+cbrand,
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
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('连锁品牌已存在，修改失败！');
					}
					jQuery('#submit_'+id).css("visibility","hidden");
				}
		});
	}
}
</script>
