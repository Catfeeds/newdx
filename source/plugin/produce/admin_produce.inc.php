<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';

/***
*   删除产品信息
*/
if (isset($_GET['gid']) && $_GET['del'] == 1) {
	DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE tid = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?del=\d+/', '', $url);
	cpmsg('删除成功', $url, 'succeed');
}

/***
*  更改审核状态
*/
if (isset($_GET['gid']) && isset($_GET['state'])) {
	DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isshow = {$_GET['state']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

/***
*  更改推荐状态
*/
if (isset($_GET['gid']) && isset($_GET['in'])) {
    DB::update('plugin_produce_info' ,array('isin'=>$_G['gp_in'] ,'indateline'=>($_G['gp_in']==1?time():0)) ,array('id'=>$_G['gp_gid']));
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?in=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

/***
*  设为真人秀操作
*/
if (isset($_GET['gid']) && isset($_GET['new'])) {
	$thread=DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_info')." WHERE id = {$_GET['gid']} LIMIT 1");
	DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh = {$_GET['new']}  WHERE id = {$_GET['gid']}");
	if($_GET['new']!=$thread['cpxh']){
		//真人秀加分操作
		if($_GET['new']==1){
		ForumOptionProduce::calPostRankEvent($thread['tid'],1);
		$thread=ForumOptionProduce::getTheardBytId($thread['tid']);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],4);
		}else{
		//取消真人秀减分操作
		ForumOptionProduce::calPostRankEvent($thread['tid'],2);
		$thread=ForumOptionProduce::getTheardBytId($thread['tid']);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],5);
		}
	}
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?new=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

/***
*  设为值得购买操作
*/
if (isset($_GET['gid']) && isset($_GET['hot'])) {
	DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isworth = {$_GET['hot']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?hot=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

/***
*  设为精华操作
*/
if (isset($_GET['gid']) && isset($_GET['digest'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_info')." WHERE id = {$_GET['gid']} LIMIT 1");
	$thread=ForumOptionProduce::getTheardBytId($info['tid']);
	DB::query("UPDATE ".DB::table('forum_thread')." SET digest = {$_GET['digest']} WHERE tid = {$thread['tid']}");
	if($_GET['digest']!=$thread['digest']){
		if($_GET['digest']==1){
		//精华加分操作
		ForumOptionProduce::calPostRankEvent($thread['tid'],3);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],6);
		}else{
		//取消精华减分操作
		ForumOptionProduce::calPostRankEvent($thread['tid'],4);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],7);
		}
	}
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?digest=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}


/***
*  循环操作
*/
$adds = '';
if(!empty($_POST['username'])){
    $adds = " AND th.author='".$_POST['username']."' ";
    unset($_POST['username']);
}
@session_start();
$prefix = 'plugin_produce_product_';
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
				DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isshow = 1 WHERE id in ({$gids})");
				cpmsg('操作成功', $url, 'succeed');
				break;
			case '2':
				DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isshow = 0 WHERE id in ({$gids})");
				cpmsg('操作成功', $url, 'succeed');
				break;
			case '3':
				/*
				$sql = "select id,tid,cpmc,cptp from ".DB::table('plugin_produce_info')." where id in({$gids})";
				$query = DB::query($sql);
				$arr = array();
				$str = "<?php\r\n\$result = ";
				while ($value = DB::fetch($query)) {
					$arr[] = $value;
				}
				$str .= var_export($arr,true);
				$str .= ";\n?>";

				file_put_contents(DISCUZ_ROOT.'./data/plugincache/myproducecache.php',$str);

				if(file_exists(DISCUZ_ROOT.'./data/plugincache/myproducecache.php')){
					@include_once DISCUZ_ROOT.'./data/plugincache/myproducecache.php';
					foreach($result as $key => $val){
							 $path1=DISCUZ_ROOT."./data/attachment/plugin/".$val['cptp'];
							 $path2=DISCUZ_ROOT."./data/attachment/plugin/".$val['cptp'].'.thumb210.jpg';
							 $path3=DISCUZ_ROOT."./data/attachment/plugin/".$val['cptp'].'.thumb600.jpg';
							 $path4=DISCUZ_ROOT."./data/attachment/plugin/".$val['cptp'].'.thumb100.jpg';
							if(file_exists($path1)){
								@unlink($path1);
							}
							if(file_exists($path2)){
								@unlink($path2);
							}
							if(file_exists($path3)){
								@unlink($path3);
							}
							if(file_exists($path4)){
								@unlink($path4);
							}
							DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE tid in ({$val[tid]})");
					}
				}*/
				//ForumOptionProduce::deleteProduceImage(" id in({$gids})");
				DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE id in ({$gids})");
				cpmsg('删除成功', $url, 'succeed');
				break;
		}
	}
}


$search = array();
foreach (explode(' ', 'cpmc isshow digest cpxh isworth orderBy orderType isin gmdz') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}
$where = ' WHERE 1=1 and  i.type = 0 '.$adds;
if (!empty($search['cpmc'])) {
	$where .= " AND i.cpmc LIKE '%{$search['cpmc']}%'";
}
if ($search['isshow'] != '') {
	$where .= " AND i.isshow='{$search['isshow']}'";
}
if ($search['digest'] != '') {
	$where .= " AND th.digest='{$search['digest']}'";
}
if ($search['cpxh'] != '') {
	$where .= " AND i.cpxh='{$search['cpxh']}'";
}
if ($search['isworth'] != '') {
	$where .= " AND i.isworth='{$search['isworth']}'";
}
if ($search['isin'] != '') {
	$where .= " AND i.isin='{$search['isin']}'";
}
if ($search['gmdz'] != '') {
	$where .= " AND i.gmdz=''";
}

$orderBy = '';
if ($search['orderBy'] != '') {
	if ($search['orderBy'] == 1) {
		$orderBy .= " ORDER BY th.dateline";
	} elseif ($search['orderBy'] == 2) {
		$orderBy .= " ORDER BY i.rank ";
	}
	if ($orderBy && $search['orderType'] != '') {
		$orderBy .= " {$search['orderType']}";
	}
} else {
	$orderBy .= " ORDER BY th.dateline DESC";
}


$ppp = 100;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." AS i
				   LEFT JOIN ".DB::table('plugin_produce_type')." AS t ON t.id = i.cplx
				   LEFT JOIN ".DB::table('forum_thread')." AS th ON th.tid = i.tid and i.type = 0 $where");
$query = DB::query("SELECT i.*, t.tname, th.dateline, th.author, th.authorid,th.digest FROM ".DB::table('plugin_produce_info')." AS i
				   LEFT JOIN ".DB::table('plugin_produce_type')." AS t ON t.id = i.cplx
				   LEFT JOIN ".DB::table('forum_thread')." AS th ON th.tid = i.tid
				   $where $orderBy
				   LIMIT ".($page - 1)*$ppp.", $ppp");

$qq = DB::query("SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where type = 1 or type =2 order by type;");
//$zt = DB::query("SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where type = 2");
require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
$attachserver = new attachserver;
$alldomain = $attachserver->get_server_domain('all');
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
                    用&nbsp;户&nbsp;名：<input type="text" name="username" value="<?php echo $search['username']; ?>" size="18"/>
                    <select name="gmdz" id="gmdz">
						<option value="">全部</option>
						<option value="1"<?php echo $search['gmdz']==='0'?' selected="selected"':''; ?>>无购买地址</option>
					</select>
                    <br />
					产品名称:
					<input type="text" name="cpmc" id="cpmc" size="18" value="<?php echo $search['cpmc']; ?>" />
                    <select name="isin" id="isin">
						<option value="">全部</option>
						<option value="1"<?php echo $search['isin']==='1'?' selected="selected"':''; ?>>已推荐</option>
						<option value="0"<?php echo $search['isin']==='0'?' selected="selected"':''; ?>>未推荐</option>
					</select>
					<select name="isshow" id="isshow">
						<option value="">全部</option>
						<option value="1"<?php echo $search['isshow']==='1'?' selected="selected"':''; ?>>己审核</option>
						<option value="0"<?php echo $search['isshow']==='0'?' selected="selected"':''; ?>>未审核</option>
					</select>
					<select name="digest" id="digest">
						<option value="">全部</option>
						<option value="1"<?php echo $search['digest']==='1'?' selected="selected"':''; ?>>精华</option>
						<option value="0"<?php echo $search['digest']==='0'?' selected="selected"':''; ?>>非精华</option>
					</select>
					<select name="cpxh" id="cpxh">
						<option value="">全部</option>
						<option value="1"<?php echo $search['cpxh']==='1'?' selected="selected"':''; ?>>真人秀</option>
						<option value="0"<?php echo $search['cpxh']==='0'?' selected="selected"':''; ?>>非真人秀</option>
					</select>
					<select name="isworth" id="isworth">
						<option value="">全部</option>
						<option value="1"<?php echo $search['isworth']==='1'?' selected="selected"':''; ?>>值得购买</option>
						<option value="0"<?php echo $search['isworth']==='0'?' selected="selected"':''; ?>>非值得购买</option>
					</select>
					排序:
					<select name="orderBy" id="orderBy">
						<option value="">默认</option>
						<option value="1"<?php echo $search['orderBy']==='1'?' selected="selected"':''; ?>>发布时间</option>
						<option value="2"<?php echo $search['orderBy']==='2'?' selected="selected"':''; ?>>排名分值</option>
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
<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr class="header">
	<th>产品名称</th>
    <th>产品图片</th>
	<th>产品类别</th>
	<th>类型</th>
	<th>发布时间</th>
	<th>分值</th>
	<th>状态</th>
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
    .yitui{color: #00FF00;}
	.weitui{color: #FF0000;}
</style>

<?php while ($value = DB::fetch($query)): ?>
<tr>
	<td>
		<input type="checkbox" name="guide[<?php echo $value['id']; ?>]" class="guideCheckbox" />
		<a href="forum.php?mod=viewthread&tid=<?php echo $value['tid']; ?>" target="_blank"><?php echo $value['cpmc']; ?></a>
		<?php if ($value['author'] && $value['authorid']): ?>
		(<a href="<?php echo $_G['config']['web']['home'];?>space-uid-<?php echo $value['authorid']; ?>.html" target="_blank" style="color:#C00;"><?php echo $value['author']; ?></a>) &nbsp;&nbsp;<span id="<?php echo $value['tid']; ?>ty" style="font-weight: bold;color: blue;cursor: pointer;" onclick="edit_bq(<?php echo $value['tid']; ?>)"><img alt="" src="static/image/admincp/editable.gif"></span>&nbsp;
		<?php endif; ?>
	</td>
    <td><img src="<?php echo 'http://'.$alldomain[$value['serverid']].'/plugin/'.$value['cptp'].'.thumb100.jpg'; ?>"/></td>
    <td><?php echo $value['tname']; ?></td>
	<td><span class="zhen" <?php echo ($value['cpxh']!= 1 ? "style='display:none'" : "" ); ?>>真</span>&nbsp;<span class="zhi" <?php echo ($value['isworth']!= 1 ? "style='display:none'" : "" ); ?>>值</span>&nbsp;<span class="jing" <?php echo ($value['digest']!= 1 ? "style='display:none'" : "" ); ?>>精</span></td>
	<td><?php echo date('Y-m-d H:i:s', $value['dateline']); ?></td>
	<td><span class="fz"><?php echo $value['rank']; ?></span></td>
	<td><span class="yishen" <?php echo ($value['isshow']== 0 ? "style='display:none'" : "" ); ?>>已审</span>
		<span class="weishen" <?php echo ($value['isshow']== 1 ? "style='display:none'" : "" ); ?>>未审</span>
        <span class="yitui" <?php echo ($value['isin']== 0 ? "style='display:none'" : "" ); ?>>已推荐</span>
		<span class="weitui" <?php echo ($value['isin']== 1 ? "style='display:none'" : "" ); ?>>未推荐</span>
	</td>
	<td>
	&nbsp;
	<a class="shen" <?php echo ($value['isshow']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=1">审过</a>
	<a class="unshen" <?php echo ($value['isshow']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=0">取审</a>
	&nbsp;
	<a class="tui" <?php echo ($value['isin']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&in=1">推荐</a>
	<a class="untui" <?php echo ($value['isin']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&in=0">取推</a>
    &nbsp;
	<a class="xiu" <?php echo ($value['cpxh']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&new=1">真人</a>
	<a class="unxiu" <?php echo ($value['cpxh']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&new=0">取真</a>
	&nbsp;
	<a class="worth" <?php echo ($value['isworth']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&hot=1">值得买</a>
	<a class="unworth" <?php echo ($value['isworth']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&hot=0">取值</a>
	&nbsp;
	<a class="digest" <?php echo ($value['digest']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&digest=1">精华</a>
	<a class="undigest" <?php echo ($value['digest']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&digest=0" style="color:#C00;">取精</a>
	</td>
</tr>

<?php endwhile; ?>

<?php showtablefooter(); ?>
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
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_produce");?>
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
	<input type="hidden" value="" name="tid" id="tid" />
	<div id="bq_content" style="overflow: auto;">
		<?php while ($values = DB::fetch($qq)): ?>
		<div class="hover" style="display: block;float: left;" id="bq_rq">
		<div id="dg_id" style="width: 300px;">
		<input type="checkbox" value="<?php echo $values['tid']; ?>" name="chk_detail[]" flg="chk_detail_" id="chk_detail_<?php echo $values['tid']; ?>" /><label for="chk_detail[]"><?php if($values['type']==2){ ?><?php echo $values['cpmc']; ?>(<span style="color: blue;">专题</span>)<?php }else{ ?><?php echo $values['cpmc']; ?><?php } ?></label></div>
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

<div id="bq_zhuanti" class="div_content" style="position:absolute; z-index:999; padding:10px; line-height:1.8;display: none;">
	<div class="identity_title">
		<a href="javascript:void(0);" id="a_close_zt" style="float:right"><img src="static/image/admincp/x.gif" width="16" height="16" border="0" /></a>
		<b style="color: #F00" id="b_subject_zt">请选择标签添加给：</b><span id="tip_zt"></span>
		<div style="clear:both;"></div>
	</div>
	<form id="frm_bq_zt">
	<input type="hidden" value="" name="tid_zt" id="tid_zt" />
	<div id="bq_content" style="overflow: auto;">
		<?php while ($values = DB::fetch($zt)): ?>
		<div class="hover" style="display: block;float: left;" id="bq_rq">
		<div id="dg_id" style="width: 300px;"><input type="checkbox" value="<?php echo $values['tid']; ?>" name="chk_detail[]" flg="chk_detail_" id="chk_detail_zt_<?php echo $values['tid']; ?>" /><label for="chk_detail[]"><?php echo $values['cpmc']; ?></label></div>
		</div>
		<?php endwhile; ?>
	</div>
	</form>
	<div class="identity_footer">
		<a href="javascript:void(0);" id="a_enter_zt">确定</a>
		&nbsp;&nbsp;
		<a href="javascript:void(0);" id="a_cancel_zt" style="padding-right:5px">取消</a>
	</div>
</div>
<script type="text/javascript">
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
	jQuery("#tid").val(tid);
	var td=jQuery('#' + tid+'ty').parents('td').find('a:first').text();
	jQuery('#b_subject').text("");
	jQuery('#tip').text("");
	jQuery('#b_subject').text("请选择标签添加给:"+td);

	var str_url = 'plugin.php?id=produce:ajax_updateproducerelation&op=edit&tid='+tid;
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

function edit_zt(tid){

	jQuery(':checkbox[id^=chk_detail_zt_]').removeAttr('checked').removeAttr('disabled');
	var int_top = jQuery('#' + tid+'ty').offset().top;
	if (jQuery(document).height() - jQuery('#' + tid+'ty').offset().top-jQuery('#' + tid+'ty').height() < jQuery("#bq_zhuanti").height() + 50) {
			int_top = jQuery('#' + tid+'ty').offset().top - jQuery("#bq_zhuanti").height();
	}
	var int_left = jQuery('#' + tid+'ty').offset().left;
    jQuery("#bq_zhuanti").css("left", int_left);
	jQuery("#bq_zhuanti").css("top", int_top);
	jQuery("#bq_zhuanti").show();
	jQuery("#tid_zt").val(tid);
	var td=jQuery('#' + tid+'ty').parents('td').find('a:first').text();
	jQuery('#b_subject_zt').text("");
	jQuery('#tip_zt').text("");
	jQuery('#b_subject_zt').text("请选择标签添加给:"+td);

	var str_url = 'plugin.php?id=produce:ajax_updateproducerelation&op=edit&tid='+tid;
	jQuery.getJSON(
			str_url,
			function(data) {
				 if(typeof data !== 'undefine'){
					for (var i in data) {
						jQuery("#chk_detail_zt_"+data[i]).attr('checked', 'checked');
					}
				 }
			}
	);
	return false;
}

jQuery('#a_enter').click(function () {
	var str_url = 'plugin.php?id=produce:ajax_updateproducerelation';
	var data = jQuery("#frm_bq").serialize();
	var str_uid = jQuery.trim(jQuery('#tid').val());
	// 如果没有取到tid则不进行任何处理
	if (!str_uid) {
		return;
	}
	jQuery.ajax({
				url: str_url + '&op=add',
				type: "get",
				data: data,
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip").css("padding-left","10px").css("color","blue").html('修改成功！');
					}else if(msg=="error"){
						jQuery("#tip").css("padding-left","10px").css("color","blue").html('修改失败！');
					}
					jQuery('#bq_add').fadeOut();
				}

	});
});

jQuery('#a_enter_zt').click(function () {
	var str_url = 'plugin.php?id=produce:ajax_updateproducerelation';
	var data = jQuery("#frm_bq_zt").serialize();
	var str_uid = jQuery.trim(jQuery('#tid_zt').val());
	// 如果没有取到tid则不进行任何处理
	if (!str_uid) {
		return;
	}
	jQuery.ajax({
				url: str_url + '&op=add',
				type: "get",
				data: data,
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip_zt").css("padding-left","10px").css("color","blue").html('修改成功！');
					}else if(msg=="error"){
						jQuery("#tip_zt").css("padding-left","10px").css("color","blue").html('修改失败！');
					}
					jQuery('#bq_zhuanti').fadeOut();
				}

	});
});

</script>

<script type="text/javascript">
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

	//获得checkbox的点击事件
	//$('input:checkbox:[name=lx]').click(function(){
	//   var lx=$("input:checkbox[name='lx']:checked").val();
	//   alert(lx)
	//});

	//获得checkbox的点击事件
	//$('input:radio:[name=lx]').click(function(){
	    //if(confirm('您确认要更改类型？')){
		//	var lx=$("input:radio[name='lx']:checked").val();
		//	$.ajax({
		//		'type': 'GET',
		//		'url': '/repos/dz15/plugin.php?id=forumoption:updatecplx',
		//		'data': {
		//		    'cpid':	id,
		//			'lxid': lx
		//		},
		//		'success': function(html){
		//		   alert(html);
		//		}
		//	});
	//	}else{
	//		var lx=$("input:radio[name='lx']:checked").val();
	//	  	$("input:radio[name='lx']:checked").attr("checked",false);
	//	}
		//var lx=$("input:radio[name='lx']:checked").val();
	//});

	  //ajax设为加精华操作
	  $('.digest').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.undigest').css("display","");
				tr.find('.jing').css("display","");
				tr.find('.fz').text(tr.find('.fz').text()-0+70);
				//$('#lx').append("<span style='color:#F0F;'>精</span>");
			}
		});
		return false;
	  });
	  //ajax取消精华操作
	  $('.undigest').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.digest').css("display","");
				tr.find('.jing').css("display","none");
				tr.find('.fz').text(tr.find('.fz').text()-0-70);
			}
		});
		return false;
	  });

	  //ajax设为值得买操作
	  $('.worth').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.unworth').css("display","");
				tr.find('.zhi').css("display","");
				//tr.find('.fz').text(tr.find('.fz').text()-0+15);
				//$('#lx').append("<span style='color:#F0F;'>精</span>");
			}
		});
		return false;
	  });

	  //ajax取消值得买操作
	  $('.unworth').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.worth').css("display","");
				tr.find('.zhi').css("display","none");
				//tr.find('.fz').text(tr.find('.fz').text()-0+15);
				//$('#lx').append("<span style='color:#F0F;'>精</span>");
			}
		});
		return false;
	  });

	  //ajax设为真人秀操作
	  $('.xiu').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.unxiu').css("display","");
				tr.find('.zhen').css("display","");
				tr.find('.fz').text(tr.find('.fz').text()-0+20);
				//$('#lx').append("<span style='color:#F0F;'>精</span>");
			}
		});
		return false;
	  });
	   //ajax取消真人秀操作
	  $('.unxiu').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.xiu').css("display","");
				tr.find('.zhen').css("display","none");
				tr.find('.fz').text(tr.find('.fz').text()-0-20);
				//$('#lx').append("<span style='color:#F0F;'>精</span>");
			}
		});
		return false;
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
      //ajax通过推荐操作
	  $('.tui').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.yitui').css("display","");
				tr.find('.weitui').css("display","none");
				tr.find('.untui').css("display","");
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
	  //ajax通过未推荐操作
	  $('.untui').live("click",function(){
		var url=$(this).attr('href');
		var _this=$(this);
		$.ajax({
			type : 'GET',
			url : url,
			success:function(html){
				_this.css("display",'none');
				var tr = _this.parents('tr');
				tr.find('.tui').css("display","");
				tr.find('.yitui').css("display","none");
				tr.find('.weitui').css("display","");

			}
		});
		return false;
	  });




})(jQuery);
</script>
