<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$op=$_GET['op'];
if($op=='forum'){
	 include dirname(__FILE__)."/attach_forumupload.php";	exit;
}

$url = ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=forumoption&pmod=attach_upload";


require_once libfile('function/spacecp');

if (!empty($_POST)) {
	$url = $_SERVER['QUERY_STRING'];
	$list = $_POST['guide'];
	if(!is_array($list)){
		cpmsg('请选择要上传的图片！', $url, 'error');
		return;
	}
	foreach ($list as &$value) {
		$pic = DB::fetch_first("SELECT * FROM ".DB::table('home_pic')." where picid=".$value);
		if(getglobal('setting/ftp/on')) {
			//$ftpresult_thumb = 0;
			$ftpresult = ftpcmd('upload', 'album/'.$pic['filepath']);
			if($ftpresult) {
				//@unlink($_G['setting']['attachdir'].'album/'.$pic['filepath']);
				if($pic['thumb']) {
					ftpcmd('upload', 'album/'.$pic['filepath'].'.thumb.jpg');
					//@unlink($_G['setting']['attachdir'].'album/'.$pic['filepath'].'.thumb.jpg');
				}
				$pic_remote = 1;
				DB::query("UPDATE ".DB::table('home_pic')." SET remote ={$pic_remote} WHERE picid={$pic['picid']}");
			}else{
			cpmsg('在上传'.$value.'时意外终止！', $url, 'error');exit;
			}
		}
	}
	cpmsg('成功上传至ftp服务器！', $url, 'succeed');
	exit;
}
/*
@session_start();
$prefix = 'plugin_forumoption_post_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
	if (empty($_POST['group'])) {
		unset($_SESSION[$prefix.'group']);
	}
}


$search = array();
foreach (explode(' ', 'fid tid author group') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = ' WHERE 1=1';
if ($search['fid']) {
	$where .= " AND p.fid = '{$search['fid']}'";
}
if ($search['tid']) {
	$where .= " AND p.tid = '{$search['tid']}'";
}
if ($search['author']) {
	$authorid = DB::result_first('SELECT uid FROM '.DB::table('common_member')." WHERE username = '{$search['author']}'");
	if ($authorid) {
		$where .= " AND p.authorid='$authorid'";
	} else {
		$where = ' WHERE 1 = 0';
	}
}
if ($search['group']) {
	$groupid = implode(',', $search['group']);
	if ($groupid) {
		$query = DB::query("SELECT uid FROM ".DB::table('common_member')." WHERE groupid IN ($groupid)");
		$uids = array();
		while ($value = DB::fetch($query)) {
			$uids[] = $value['uid'];
		}
		if ($uids) {
			$where .= " AND p.authorid IN (".implode(", ",$uids).")";
		} else {
			$where = ' WHERE 1 = 0';
		}
	} else {
		$where = ' WHERE 1 = 0';
	}
}*/

$where = " where remote=0";

$ppp = 20;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('home_pic')." p".$where);

$posts = array();
$query = DB::query("SELECT p.* FROM ".DB::table('home_pic')." p$where".
				   " ORDER BY p.dateline DESC LIMIT ".($page - 1)*$ppp.",$ppp");
while ($value = DB::fetch($query)) {
	$value['dateline'] = date('Y-m-d H:i:s', $value['dateline']);
	$posts[] = $value;
}

?>

<style type="text/css">
#config_menu{position:absolute;left:20px;top:50px;}
#config_menu ul li{float:left;margin-right:10px}
.tb{margin-top: 30px;}
</style>
<div id="config_menu">
	<ul>
		<li><a href="<?=$url?>" <?php if($op==null){ ?> style='color:red' <?php } ?>>相册图片上传</a></li>
		<li><a href="<?=$url?>&op=forum" <?php if($op=='forum'){ ?>style='color:red' <?php } ?>>论坛帖子图片上传</a></li>
	</ul>
</div>

<form action="" method="post" id="albumForm">
	<?php showtableheader(); ?>
	<tr class="header">
		<th>编号</th>
		<th>图片描述</th>
		<th>发布时间</th>
		<th>图片路径</th>
	</tr>
	<?php foreach ($posts as $pic): ?>
	<tr>
		<td width="10%"><input type="checkbox" name="guide[]" class="guideCheckbox" value="<?php echo $pic['picid']; ?>" /><?php echo $pic['picid']; ?></td>
		<td><a href="<?php echo $_G['config']['web']['home']; ?>home-space-uid-<?php echo $pic['uid']; ?>-do-album-picid-<?php echo $pic['picid']; ?>.html" target="_blank"><?php echo $pic['title']; ?></a></td>
		<td><?php echo $pic['dateline']; ?></td>
		<td><?php echo $pic['filepath']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php showtablefooter(); ?>
	<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	    <div style="float:left;">
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />
			全选/全不选
		</label>
		&nbsp;&nbsp;
		<button onclick="" value="true" id="btnupload" type="submit"><strong>开始上传到远程</strong></button>
	</div>
		<div style="float:right;">
			<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=forumoption&pmod=attach_upload");?>
		</div>
	</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	function submitForm() {
		/*if ($('#albumForm .guideCheckbox:checked').size() == 0) {
			return false;
		}
		$('#albumForm input[name="operateNum"]').val(num);*/
		$('#albumForm').submit();
	}
	$('#btnupload').click(function(){
		submitForm();
	});
	$('#selectAll').click(function(){
		if ($(this)[0].checked) {
			$('#albumForm .guideCheckbox').attr('checked', true);
		} else {
			$('#albumForm .guideCheckbox').attr('checked', false);
		}
	});
})(jQuery);
</script>
