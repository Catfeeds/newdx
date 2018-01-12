<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(file_exists(DISCUZ_ROOT.'./source/plugin/forumoption/skiing.php')){
	require_once DISCUZ_ROOT.'./source/plugin/forumoption/skiing.php';
}


/***
*  更改审核状态
*/
if (isset($_GET['gid']) && isset($_GET['state'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE id = {$_GET[gid]}");
	if($info&&$_GET['state']==1){
		$thread=DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = {$info[tid]} limit 1");
		$message = '您的店铺信息 <a href="'.$_G['config']['web']['forum'].'thread-'.$info[tid].'-1-1.html" target="_blank">'.$thread[subject].'</a> 被管理员审核通过！';
		notification_add($thread['authorid'], 'system', 'system_notice', array('subject' => '用户您好：', 'message' => $message), 0);
	}
	DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET ispublish = {$_GET['state']} WHERE aid = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

@session_start();
$prefix = 'plugin_skiing_';
if (!empty($_POST)) {
	if (!empty($_POST['search'])) {
		unset($_POST['search']);
		$_G['gp_page'] = 1;
		foreach ($_POST as $postid => $post) {
			$_SESSION[$prefix.$postid] = $post;
		}
	} else {
		$url = $_SERVER['QUERY_STRING'];
		if (count($_POST['guide']) == 0) {
			cpmsg('请至少选择一条信息', $url, 'succeed');
		}
		$gids = implode(',', array_keys($_POST['guide']));
		switch ($_POST['operateNum']) {
			case '1':
				DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET ispublish = 1 WHERE id in ({$gids})");
				cpmsg('操作成功', $url, 'succeed');
				break;
			case '2':
				DB::query("UPDATE ".DB::table('dianping_skiing_info')." SET ispublish = 0 WHERE id in ({$gids})");
				cpmsg('操作成功', $url, 'succeed');
				break;
			case '3':
				DB::query("DELETE FROM ".DB::table('dianping_skiing_info')." WHERE id in ({$gids})");
				cpmsg('删除成功', $url, 'succeed');
				break;
		}
	}
}
$search = array();
foreach (explode(' ', 'kName tid ispublish orderBy orderType') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}
$where = ' WHERE 1=1 ';
if (!empty($search['kName'])) {
	$where .= " AND i.kName LIKE '%{$search['kName']}%'";
}
if (!empty($search['tid'])) {
	$where .= " AND i.tid in ('$search[tid]')";
}
if ($search['ispublish'] != '') {
	$where .= " AND i.ispublish='{$search['ispublish']}'";
}

$orderBy = '';
if ($search['orderBy'] != '') {
	if ($search['orderBy'] == 1) {
		$orderBy .= " ORDER BY t.dateline";
	}
	if ($search['orderBy'] == 2) {
		$orderBy .= " ORDER BY i.orderby";
	}
	if ($orderBy && $search['orderType'] != '') {
		$orderBy .= " {$search['orderType']}";
	}
} else {
	$orderBy .= " ORDER BY t.dateline DESC";
}
require_once libfile('class/region');
$region = region::instance();
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_skiing_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = i.tid $where");
$query = DB::query("SELECT i.*, t.views,t.dateline,t.author,t.authorid FROM ".DB::table('dianping_skiing_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
				   $where $orderBy
				   LIMIT ".($page - 1)*$ppp.", $ppp");

?>
<form action="" method="POST">
	<table class="tb tb2">
		<tbody>
			<tr>
				<th class="partition">搜索</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
					滑雪场名称:
					<input type="text" name="kName" id="kName" size="18" value="<?php echo $search['kName']; ?>" />
					tid:
					<input type="text" name="tid" id="tid" size="18" value="<?php echo $search['tid']; ?>" />
					<select name="ispublish" id="ispublish">
						<option value="">全部</option>
						<option value="1"<?php echo $search['ispublish']==='1'?' selected="selected"':''; ?>>己审核</option>
						<option value="0"<?php echo $search['ispublish']==='0'?' selected="selected"':''; ?>>未审核</option>
					</select>
					排序:
					<select name="orderBy" id="orderBy">
						<option value="">默认</option>
						<option value="1"<?php echo $search['orderBy']==='1'?' selected="selected"':''; ?>>发布时间</option>
						<option value="2"<?php echo $search['orderBy']==='2'?' selected="selected"':''; ?>>列表排序</option>
					</select>
					<select name="orderType" id="orderType">
						<option value="">默认</option>
						<option value="ASC"<?php echo $search['orderType']==='ASC'?' selected="selected"':''; ?>>升序</option>
						<option value="DESC"<?php echo $search['orderType']==='DESC'?' selected="selected"':''; ?>>降序</option>
					</select>
					<input type="submit" value="搜索" class="btn" />(共检索到<?php echo $count; ?>条记录)
				</td>
			</tr>
		</tbody>
	</table>
</form>
<style type="text/css">
.yishen{color: #00FF00;}
.weishen{color: #FF0000;}
</style>
<form action="" method="post" id="guideForm">
<?php
showtableheader();
?>
<tr class="header">
	<th>滑雪场名称</th>
	<th>地区</th>
	<th>地址</th>
	<th>联系电话</th>
	<th>官方网址</th>
	<th>排序</th>
	<th>状态</th>
	<th>操作</th>
</tr>
<?php while ($value = DB::fetch($query)) {?>
<tr>
	<td>
		<input type="checkbox" name="guide[<?php echo $value['id']; ?>]" class="guideCheckbox" />
		<a href="forum.php?mod=viewthread&tid=<?php echo $value['tid']; ?>" target="_blank"><?php echo $value['kName']; ?></a>(<a href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?php echo $value['authorid']; ?>.html" target="_blank" style="color:#C00;"><?php echo $value['author']; ?></a>)
	</td>

	<td>
		<?php echo $region->getNameById($value['provinceid']);?>
	</td>
	<td>
		<?php echo $value['addr']; ?>
	</td>
	<td>
		<?php echo $value['tel']; ?>
	</td>
	<td>
	<?php echo $value['url']; ?>
	</td>
	<td>
	<input type="text" id="order_<?php echo $value['id']; ?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" name="order_<?php echo $value['id']; ?>" size="2" value="<?php echo $value['displayorder']; ?>"/>&nbsp;
	<input type="button" id="submit_<?php echo $value['id'];?>" name="submit_<?php echo $value['id'];?>" value="修改" style="visibility:hidden" onClick="checkvalue('order_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="id" value="<?php echo $value['tid']; ?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $value['tid']; ?>"></span>
	</td>
	<td>
		<span class="yishen" <?php echo ($value['ispublish']== 0 ? "style='display:none'" : "" ); ?>>已审</span>
		<span class="weishen" <?php echo ($value['ispublish']== 1 ? "style='display:none'" : "" ); ?>>未审</span>
	</td>
	<td>
	&nbsp;
	<a class="shen" <?php echo ($value['ispublish']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=1">审过</a>
	<a class="unshen" <?php echo ($value['ispublish']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=0">取审</a>
	</td>
</tr>
<?php }
showtablefooter();
?>

<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />
			全选/全不选
		</label>
		&nbsp;&nbsp;
		<a href="#" id="passOperate">审核通过</a> |
		<a href="#" id="unpassOperate">审核不通过</a> |
		<a href="#" id="delOperate"></a>
	</div>
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=skiing&pmod=admin_skiing");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
function checkvalue(m){
	if(document.getElementById(m).value==""){
		alert('请输入排序号，数字越大排名越高');
		return false;
	}else{
		var order = document.getElementById(m).value;
		var id = jQuery("#"+m).next().next().val();
		var str_url = 'plugin.php?id=skiing:ajax_updateskiing&tid='+id;
		jQuery.ajax({
				url: str_url + '&type=px&order='+order,
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
jQuery.noConflict();
;(function($){
	function submitForm(num) {
		if ($('#guideForm .guideCheckbox:checked').size() == 0) {
			return false;
		}
		$('#guideForm input[name="operateNum"]').val(num);
		$('#guideForm').submit();
	}
	$('#delOperate').click(function(){
		submitForm(3);
	});
	$('#passOperate').click(function(){
		submitForm(1);
	});
	$('#unpassOperate').click(function(){
		submitForm(2);
	});
	$('#selectAll').click(function(){
		if ($(this)[0].checked) {
			$('#guideForm .guideCheckbox').attr('checked', true);
		} else {
			$('#guideForm .guideCheckbox').attr('checked', false);
		}
	});

	//ajax通过审核操作
	  $('.shen').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.yishen').css("display","");
				tr.find('.weishen').css("display","none");
				tr.find('.unshen').css("display","");
				//$('#lx').append("<span style='color:#F0F;'>精</span>");
			}
		});
		return false;
	  });
	  //ajax通过未审核操作
	  $('.unshen').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.shen').css("display","");
				tr.find('.yishen').css("display","none");
				tr.find('.weishen').css("display","");

			}
		});
		return false;
	  });
})(jQuery);
</script>

