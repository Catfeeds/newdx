<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if ($_GET['op'] == 'del') {
	include_once libfile('function/delete');
	if (deletepost("pid='{$_GET['pid']}'")) {
		if($_GET['cid']){
			$cid = $_GET['cid'];
			/*
			$quer = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." where replyid ={$cid}");
			while ($val = DB::fetch($quer)) {

				DB::query("delete FROM ".DB::table('forum_post')." where pid='{$val[forpid]}'");
				DB::query("delete FROM ".DB::table('forum_postcomment')." where id={$val[id]}");

			}
			$quers = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." where id ={$cid}");
			while ($val = DB::fetch($quers)) {
				if(deletepost("pid='{$val['forpid']}'")){
					DB::query("delete FROM ".DB::table('forum_postcomment')." where id={$val[id]}");
				}
			}*/
			//DB::query("delete FROM ".DB::table('forum_post')." where pid={$_GET['pid']}");
			DB::query("delete FROM ".DB::table('forum_postcomment')." where id={$cid}");
		}
		echo json_encode(array('error_code' => 0));
	} else {
		if($_GET['cid']){
			$cid = $_GET['cid'];
			/*
			$quer = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." where replyid ={$cid}");
			while ($val = DB::fetch($quer)) {
				deletepost("pid='{$val['forpid']}'");
				DB::query("delete FROM ".DB::table('forum_postcomment')." where id={$val[id]}");
			}*/
			DB::query("delete FROM ".DB::table('forum_postcomment')." where id={$_GET['cid']}");
			echo json_encode(array('error_code' => 0));exit;
		}
		echo json_encode(array('error_code' => 1));
	}
	exit;
}

if ($_GET['op'] == 'isshow') {
	if($_GET['cid']){
		DB::query("update ".DB::table('forum_postcomment')." set isshow=1 where id={$_GET['cid']}");
		echo json_encode(array('error_code' => 0));exit;
	}else{
		echo json_encode(array('error_code' => 1));
	}
}

@session_start();
$prefix = 'plugin_forumoption_postcomment_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}

}

$search = array();
foreach (explode(' ', 'pid tid author isshow') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = ' WHERE 1=1';
if ($search['pid']) {
	$where .= " AND p.pid in ({$search['pid']})";
}
if ($search['tid']) {
	$where .= " AND p.tid = '{$search['tid']}'";
}
if ($search['isshow']!='') {
	$where .= " AND p.isshow = '{$search['isshow']}'";
}
if ($search['author']) {
	$authorid = DB::result_first('SELECT uid FROM '.DB::table('common_member')." WHERE username = '{$search['author']}'");
	if ($authorid) {
		$where .= " AND p.authorid='$authorid'";
	} else {
		$where = ' WHERE 1 = 0';
	}
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_postcomment')." p".$where);
$posts = array();
$query = DB::query("select p.* FROM ".DB::table('forum_postcomment')." p$where".
				   " ORDER BY p.dateline desc LIMIT ".($page - 1)*$ppp.",$ppp");
while ($value = DB::fetch($query)) {
	$value['subject'] = DB::result_first('SELECT subject FROM '.DB::table('forum_thread')." WHERE tid = {$value['tid']} limit 1");
	$value['dateline'] = date('Y-m-d H:i:s', $value['dateline']);
	$posts[] = $value;
}
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
					帖子pid:
					<input type="text" name="pid" id="pid" size="18" value="<?php echo $search['pid']; ?>" />
					贴子tid:
					<input type="text" name="tid" id="tid" size="6" value="<?php echo $search['tid']; ?>" />
					作者:
					<input type="text" name="author" id="author" size="10" value="<?php echo $search['author']; ?>" />&nbsp;
					状态:
					<select name="isshow" id="isshow">
						<option value="">全部</option>
						<option value="1"<?php echo $search['isshow']==='1'?' selected="selected"':''; ?>>已显示</option>
						<option value="0"<?php echo $search['isshow']==='0'?' selected="selected"':''; ?>>未通过</option>
					</select>
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>

		</tbody>
	</table>
</form>
<form action="" method="post" id="postForm">
	<?php showtableheader(); ?>
	<tr class="header">
		<th>点评</th>
		<th>所属贴子</th>
		<th>发布人</th>
		<th>发布时间</th>
		<th>操作</th>
	</tr>

	<?php foreach ($posts as $post): ?>
	<tr>
		<td width="40%"><?php echo $post['comment']; ?></td>
		<td><a href="<?php echo $_G['config']['web']['forum']; ?>thread-<?php echo $post['tid']; ?>-1-1.html" target="_blank"><?php echo $post['subject']; ?></a></td>
		<td><?php echo $post['author']; ?></td>
		<td><?php echo $post['dateline']; ?></td>
		<td>
			<a href="/plugin.php?id=forumoption:admincp_postcomment&op=del&cid=<?php echo $post['id'];?>&pid=<?php echo $post['forpid'];?>" class="del" style="white-space:nowrap;">删除</a>
			<?php if($post['isshow']=='0'){ ?><a href="/plugin.php?id=forumoption:admincp_postcomment&op=isshow&cid=<?php echo $post['id'];?>" class="isshow" style="white-space:nowrap;">通过</a><?php }?>
		</td>
	</tr>
	<?php endforeach; ?>

	<?php showtablefooter(); ?>
	<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
		<div style="float:right;">
			<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=forumoption&pmod=admincp_postcomment");?>
		</div>
	</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	$('#group_list_open').bind('click', function() {
		$('#group_list').toggle();
		return false;
	});
	$('#group_list_close').bind('click', function() {
		$('#group_list').hide();
		return false;
	});

	$('#group_list input').live('click', render_group);
	render_group();

	function render_group() {
		var text = '';
		$('#group_list input').each(function() {
			if ($(this).attr('checked')) {
				text += $(this).attr('text-data')+', ';
			}
		});
		text = text.replace(/(, )$/, '');
		$('#group_selected').text(text);
	}

	$('#postForm .del').live('click', function() {
		if(confirm('确认删除此条点评吗？')){
			var _this = $(this),
			url = $(this).attr('href');
			url += '&inajax=1';
			$.getJSON(url, function(data) {
			if (data && data.error_code == 0) {
				_this.parents('tr').animate({opacity: 0}, 200, function() {
				var _this = $(this);
				setTimeout(function() {
				_this.remove();
				}, 100);
				});
				} else {
				alert('网络异常, 删除失败');
				}
			});
		}
		return false;
	});
	$('#postForm .isshow').live('click', function() {
		if(confirm('确认显示此条点评吗？')){
			var _this = $(this),
			url = $(this).attr('href');
			url += '&inajax=1';
			$.getJSON(url, function(data) {
				if (data && data.error_code == 0) {
					_this.remove();
				} else {
					alert('网络异常, 审核失败');
				}
			});
		}
		return false;
	});
})(jQuery);
</script>
