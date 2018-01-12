<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(file_exists(DISCUZ_ROOT.'./source/plugin/forumoption/brand.php')){
	require_once DISCUZ_ROOT.'./source/plugin/forumoption/brand.php';
}


/***
*  更改审核状态
*/
if (isset($_GET['gid']) && isset($_GET['state'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE id = {$_GET[gid]}");
	if($info&&$_GET['state']==1){
		$thread=DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = {$info[tid]} limit 1");
		$message = '您的品牌信息 <a href="'.$_G['config']['web']['forum'].'thread-'.$info[tid].'-1-1.html" target="_blank">'.$thread[subject].'</a> 被管理员审核通过！';
		notification_add($thread['authorid'], 'system', 'system_notice', array('subject' => '用户您好：', 'message' => $message), 0);
	}
	DB::query("UPDATE ".DB::table('dianping_brand_info')." SET ispublish = {$_GET['state']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}
/***
*  更改招商状态
*/
if (isset($_GET['gid']) && isset($_GET['zs'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE id = {$_GET[gid]}");
	DB::query("UPDATE ".DB::table('dianping_brand_info')." SET zhaoshang = {$_GET['zs']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?zs=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}
/***
*  更改置顶状态
*/
if (isset($_GET['gid']) && isset($_GET['zd'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE id = {$_GET[gid]}");
	DB::query("UPDATE ".DB::table('forum_thread')." SET displayorder = {$_GET['zd']} WHERE tid = {$info['tid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?zd=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

@session_start();
$prefix = 'plugin_brand_';
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
				DB::query("UPDATE ".DB::table('dianping_brand_info')." SET ispublish = 1 WHERE id in ({$gids})");
				cpmsg('操作成功', $url, 'succeed');
				break;
			case '2':
				DB::query("UPDATE ".DB::table('dianping_brand_info')." SET ispublish = 0 WHERE id in ({$gids})");
				cpmsg('操作成功', $url, 'succeed');
				break;
			case '3':
				DB::query("DELETE FROM ".DB::table('dianping_brand_info')." WHERE id in ({$gids})");
				cpmsg('删除成功', $url, 'succeed');
				break;
		}
	}

}
$search = array();
foreach (explode(' ', 'subject tid ispublish zhaoshang displayorder orderBy orderType') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}
$where = ' WHERE 1=1 and t.displayorder!=-1 ';
if (!empty($search['subject'])) {
	$where .= " AND i.subject LIKE '%{$search['subject']}%'";
}
if (!empty($search['tid'])) {
	$where .= " AND i.tid in ('$search[tid]')";
}
if ($search['ispublish'] != '') {
	$where .= " AND i.ispublish='{$search['ispublish']}'";
}
if ($search['displayorder'] != '') {
	$where .= " AND t.displayorder='{$search['displayorder']}'";
}
if ($search['zhaoshang'] != '') {
	$where .= " AND i.zhaoshang='{$search['zhaoshang']}'";
}

$orderBy = '';
if ($search['orderBy'] != '') {
	if ($search['orderBy'] == 1) {
		$orderBy .= " ORDER BY t.dateline";
	}
	if ($orderBy && $search['orderType'] != '') {
		$orderBy .= " {$search['orderType']}";
	}
} else {
	$orderBy .= " ORDER BY t.dateline DESC";
}



$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_brand_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = i.tid $where");
$query = DB::query("SELECT i.*, t.views,t.dateline,t.author,t.authorid,t.displayorder FROM ".DB::table('dianping_brand_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
				   $where $orderBy
				   LIMIT ".($page - 1)*$ppp.", $ppp");


$qq = DB::query("SELECT * FROM ".DB::table('plugin_brand_produce')." where 1");

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
					品牌名称:
					<input type="text" name="subject" id="bName" size="18" value="<?php echo $search['subject']; ?>" />
					tid:
					<input type="text" name="tid" id="tid" size="18" value="<?php echo $search['tid']; ?>" />
					<select name="ispublish" id="isPublish">
						<option value="">全部</option>
						<option value="1"<?php echo $search['ispublish']==='1'?' selected="selected"':''; ?>>己审核</option>
						<option value="0"<?php echo $search['ispublish']==='0'?' selected="selected"':''; ?>>未审核</option>
					</select>
						<select name="displayorder" id="displayorder">
						<option value="">全部</option>
						<option value="1"<?php echo $search['displayorder']==='1'?' selected="selected"':''; ?>>置顶中</option>
						<option value="0"<?php echo $search['displayorder']==='0'?' selected="selected"':''; ?>>未置顶</option>
					</select>
					<select name="zhaoshang" id="zhaoshang">
						<option value="">全部</option>
						<option value="1"<?php echo $search['zhaoshang']==='1'?' selected="selected"':''; ?>>招商中</option>
						<option value="0"<?php echo $search['zhaoshang']==='0'?' selected="selected"':''; ?>>未招商</option>
					</select>
					排序:
					<select name="orderBy" id="orderBy">
						<option value="">默认</option>
						<option value="1"<?php echo $search['orderBy']==='1'?' selected="selected"':''; ?>>发布时间</option>
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
.zhaoshangzhong{color: #00FF00;}
.weizhaoshang{color: #FF0000;}
.zhiding{color: #00FF00;}
.unzhiding{color: #FF0000;}
</style>
<form action="" method="post" id="guideForm">
<?php
showtableheader();
?>
<tr class="header">
	<th>品牌名称</th>
	<th>添加时间</th>
	<th>是否已置顶</th>
	<th>是否开通招商</th>
	<th>招商电话</th>
	<th>审核状态</th>
	<th>操作</th>
</tr>
<?php while ($value = DB::fetch($query)) {?>
<tr>
	<td>
		<input type="checkbox" name="guide[<?php echo $value['id']; ?>]" class="guideCheckbox" />
		<a href="forum.php?mod=viewthread&tid=<?php echo $value['tid']; ?>" target="_blank"><?php echo $value['subject']; ?></a>
		(<a href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?php echo $value['authorid']; ?>.html" target="_blank" style="color:#C00;"><?php echo $value['author']; ?></a>)

		 &nbsp;&nbsp;<span id="<?php echo $value['tid']; ?>ty" style="font-weight: bold;color: blue;cursor: pointer;" onclick="edit_bq(<?php echo $value['tid']; ?>)"><img alt="" src="static/image/admincp/editable.gif"></span>&nbsp;
	</td>

	<td>
	<?php echo date('Y-m-d H:i', $value['dateline']); ?>
	</td>
	<td>

		<span class="zhiding" <?php echo ($value['displayorder']== 0||$value['displayorder']== -1 ? "style='display:none'" : "" ); ?>>置顶中</span>
		<span class="unzhiding" <?php echo ($value['displayorder']== 1 ? "style='display:none'" : "" ); ?>>未置顶</span>
	</td>
	<td>

		<span class="zhaoshangzhong" <?php echo ($value['zhaoshang']== 0 ? "style='display:none'" : "" ); ?>>招商中</span>
		<span class="weizhaoshang" <?php echo ($value['zhaoshang']== 1 ? "style='display:none'" : "" ); ?>>未招商</span>
	</td>
	<td>
		<span>
			<input type="text" id="zs_<?php echo $value['id']; ?>" name="zs" value="<?php echo $value['zstel']; ?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $value['bid'];?>').style.visibility='visible'"/>
			&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="submit_<?php echo $value['id'];?>" name="submit_<?php echo $value['id'];?>" value="修改" style="visibility:hidden" onClick="checkvalue('zs_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="id" value="<?php echo $value['id']; ?>" />&nbsp;&nbsp;&nbsp;<span id="tip<?php echo $value['id']; ?>">

		</span>

	</td>
	<td>

		<span class="yishen" <?php echo ($value['ispublish']== 0 ? "style='display:none'" : "" ); ?>>已审</span>
		<span class="weishen" <?php echo ($value['ispublish']== 1 ? "style='display:none'" : "" ); ?>>未审</span>
	</td>
	<td>
	&nbsp;
	<a class="shen" <?php echo ($value['ispublish']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=1">审过</a>
	<a class="unshen" <?php echo ($value['ispublish']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=0">取审</a>
	&nbsp;&nbsp;
	<a class="zhaoshang" <?php echo ($value['zhaoshang']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&zs=1">设为招商</a>
	<a class="unzhaoshang" <?php echo ($value['zhaoshang']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&zs=0">取消招商</a>
	&nbsp;&nbsp;
	<a class="zding" <?php echo ($value['displayorder']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&zd=1">设为置顶</a>
	<a class="buzhiding" <?php echo ($value['displayorder']==0||$value['displayorder']==-1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&zd=0">取消置顶</a>

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
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=brand&pmod=admin_brand");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>

<style type="text/css">
	.hover input, #chk_all {border: none;}
	.fixsel input { vertical-align:middle; margin-right:10px;}
	.div_content {background: none repeat scroll 0 0 #FEFEFE; border: 1px solid #639BB0; width:630px;}
	.identity_title {border-bottom: 1px dashed #CCCCCC; padding: 5px 10px}
	.identity_footer {border-top: 1px dashed #CCCCCC; padding: 2px 5px 5px 0; text-align: right; height:20px; padding-top:6px}
</style>


<div id="bq_add" class="div_content" style="position:absolute; z-index:999; padding:10px; line-height:1.8;display: none;">
	<div class="identity_title">
		<a href="javascript:void(0);" id="a_close" style="float:right"><img src="static/image/admincp/x.gif" width="16" height="16" border="0" /></a>
		<b style="color: #F00" id="b_subject">请选择标签添加给：</b><span id="tip"></span>
		<div style="clear:both;"></div>
	</div>
	<form id="frm_bq">
	<input type="hidden" value="" name="tidd" id="tidd" />
	<div id="bq_content" style="overflow: auto;">
		<?php while ($values = DB::fetch($qq)): ?>
		<div class="hover" style="display: block;float: left;" id="bq_rq">
		<div id="dg_id" style="width: 300px;">
		<input type="checkbox" value="<?php echo $values['id']; ?>" name="chk_detail[]" flg="chk_detail_" id="chk_detail_<?php echo $values['id']; ?>" /><label for="chk_detail[]"><?php echo $values['produce']; ?></label></div>
		</div>
		<?php endwhile; ?>
	</div>
	</form>
	<div class="identity_footer">
		<a href="javascript:void(0);" id="a_enter">确定</a>
		&nbsp;&nbsp;
		<a href="javascript:void(0);" id="a_cancel" style="padding-right:5px">取消</a>
	</div>
</div>
<script type="text/javascript">
function checkvalue(m){
	if(document.getElementById(m).value==""){
		alert('请输入招商电话');
		return false;
	}else{
		var dh = document.getElementById(m).value;
		var id = jQuery("#"+m).next().next().val();
		var str_url = 'plugin.php?id=brand:ajax_updateproduce&op=zhaoshang&bid='+id;
		jQuery.ajax({
				url: str_url + '&dh='+dh,
				type: "get",
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改成功！');
					}else if(msg=="error"){
						jQuery("#tip"+id).html('');
						jQuery("#tip"+id).css("padding-left","5px").css("color","blue").html('修改失败！');
					}
					jQuery('#submit_'+id).css("visibility","hidden");
				}
		});
	}
}


jQuery.noConflict();


// 点击取消或关闭按钮时隐藏弹出层
jQuery('#a_close, #a_cancel').click(function () {
	jQuery('#bq_add').hide();
});
jQuery('#a_close_zt, #a_cancel_zt').click(function () {
	jQuery('#bq_zhuanti').hide();
});

function edit_bq(tid){

	jQuery(':checkbox[id^=chk_detail_]').removeAttr('checked').removeAttr('disabled');
	var int_top = jQuery('#' + tid+'ty').offset().top;
	if (jQuery(document).height() - jQuery('#' + tid+'ty').offset().top-jQuery('#' + tid+'ty').height() < jQuery("#bq_add").height() + 50) {
			int_top = jQuery('#' + tid+'ty').offset().top - jQuery("#bq_add").height();
	}
	var int_left = jQuery('#' + tid+'ty').offset().left;
    jQuery("#bq_add").css("left", int_left);
	jQuery("#bq_add").css("top", int_top);
	jQuery("#bq_add").show();
	jQuery("#tidd").val(tid);
	var td=jQuery('#' + tid+'ty').parents('td').find('a:first').text();
	jQuery('#b_subject').text("");
	jQuery('#tip').text("");
	jQuery('#b_subject').text("请选择 ("+td+") 品牌下覆盖产品:");

	var str_url = 'plugin.php?id=brand:ajax_updateproduce&op=getids&tid='+tid;
	jQuery.getJSON(
			str_url,
			function(data) {
				 if(typeof data !== 'undefine'){
					for (var i in data) {
						jQuery("#chk_detail_"+data[i]).attr('checked', 'checked');
					}
				 }
			}
	);
	return false;
}


jQuery('#a_enter').click(function () {
	var str_url = 'plugin.php?id=brand:ajax_updateproduce';
	var data = jQuery("#frm_bq").serialize();
	var str_uid = jQuery.trim(jQuery('#tidd').val());
	// 如果没有取到tid则不进行任何处理
	if (!str_uid) {
		return;
	}
	jQuery.ajax({
				url: str_url + '&op=edit',
				type: "get",
				data: data,
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip").css("padding-left","10px").css("color","blue").html('修改成功！');
					}else if(msg=="error"){
						jQuery("#tip").css("padding-left","10px").css("color","blue").html('修改失败！');
					}
					jQuery('#bq_add').fadeOut('3000');
				}

	});
});

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

	   //ajax设为招商操作
	  $('.zhaoshang').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.weizhaoshang').css("display","none");
				tr.find('.unzhaoshang').css("display","");
				tr.find('.zhaoshangzhong').css("display","");

			}
		});
		return false;
	  });

	   //ajax取消招商操作
	  $('.unzhaoshang').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.zhaoshangzhong').css("display","none");
				tr.find('.zhaoshang').css("display","");
				tr.find('.weizhaoshang').css("display","");

			}
		});
		return false;
	  });


	   //ajax设为置顶操作
	  $('.zding').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.unzhiding').css("display","none");
				tr.find('.zhiding').css("display","");
				tr.find('.buzhiding').css("display","");

			}
		});
		return false;
	  });
	   //ajax取消置顶操作
	  $('.buzhiding').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.zhiding').css("display","none");
				tr.find('.unzhiding').css("display","");
				tr.find('.zding').css("display","");

			}
		});
		return false;
	  });
})(jQuery);
</script>

