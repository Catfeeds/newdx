<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';

@session_start();
$prefix = 'plugin_produce_price_';
if (!empty($_POST)) {
	if (!empty($_POST['search'])) {	
		if(!empty($_POST['search'])){
			unset($_POST['search']);
			$_G['gp_page'] = 1;
			foreach ($_POST as $postid => $post) {
				$_SESSION[$prefix.$postid] = $post;		
			}
		}
	}else{
		$url = $_SERVER['QUERY_STRING'];
		if (count($_POST['guide']) == 0) {
			cpmsg('请至少选择一条信息', $url, 'succeed');
		}
		
		
		$gids = implode(',', array_keys($_POST['guide']));		
		$qy = DB::query("select id,tid from ".DB::table('plugin_produce_price')." where id in (".$gids.")");		  
		while ($value = DB::fetch($qy)) {
			DB::query("update ".DB::table('plugin_produce_price')." set isdelete = 1 WHERE id=".$value['id']);
			ForumOptionProduce::calPostRankEvent($value['tid'],6);			
			$threads=ForumOptionProduce::getTheardBytId($value['tid']);
			ForumOptionProduce::calPublisherRankEvent($threads['authorid'],$threads['author'],3);
		}				  
		cpmsg('删除成功', $url, 'succeed');		
	}
}

$search = array();
foreach (explode(' ', 'search_word search_type isdelete pagenum orderBy orderType') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = ' WHERE 1=1';
if ($search['isdelete'] != '') {
	$where .= " AND p.isdelete='{$search['isdelete']}'";
}
if (($search['search_type']=='username'&&$search['search_word'])) {
	$where .= " AND c.username LIKE '%{$search['search_word']}%'";
}
if (($search['search_type']=='url'&&$search['search_word'])) {
	$where .= " AND p.url LIKE '%{$search['search_word']}%'";
}

$ppp = $search['pagenum'] ? $search['pagenum']: 50;
$page = max(1, intval($_G['gp_page']));
$count= DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_price')." AS p
				    LEFT JOIN ".DB::table('plugin_produce_info')." AS i ON  p.tid = i.tid LEFT JOIN ".DB::table('common_member')." as c on c.uid=p.uid
				    ".$where);
$query = DB::query("SELECT p.*,i.cpmc FROM ".DB::table('plugin_produce_price')." AS p
				    LEFT JOIN ".DB::table('plugin_produce_info')." AS i ON  p.tid = i.tid LEFT JOIN ".DB::table('common_member')." as c on c.uid=p.uid
				    ".$where." order by p.dateline desc LIMIT ".($page - 1)*$ppp.",$ppp");


?>

<form action="" method="POST">
	<table class="tb tb2">
		 <tbody>
			<tr>
				<th class="partition">搜索</th>
			</tr>
			<tr>
				<td>
				<div class="box float clear" style="width:910px;height:30px;border:1px dotted #CCC;padding-left:10px;float: left;">
				选择查询方式：
				<input type="radio" name="search_type" value="username" <?php if($search['search_type']=='username'){ ?> checked="true" <?php }?>/>用户名称
				<input type="radio" name="search_type" value="url" <?php if($search['search_type']=='url'){ ?> checked="true" <?php }?>/>网址
				<input type="text" id="search_word" name="search_word" value="<?php echo $search['search_word']; ?>" />
				<select name="isdelete">
					<option value="">全部</option>
					<option value="0" <?php echo $search['isdelete']==='0'?' selected="selected"':''; ?>>未删除</option>
					<option value="1" <?php echo $search['isdelete']==='1'?' selected="selected"':''; ?>>已删除</option>
				</select>
				每页显示条数 <select name="pagenum"><option value="10" <?php if($search['pagenum']==10){ ?> selected="selected" <?php }?>>10</option><option value="20" <?php if($search['pagenum']==20){ ?> selected="selected" <?php }?>>20</option><option value="50" <?php if($search['pagenum']==50){ ?> selected="selected" <?php }?>>50</option><option value="100" <?php if($search['pagenum']==100){ ?> selected="selected" <?php }?>>100</option><option value="500" <?php if($search['pagenum']==500){ ?> selected="selected" <?php }?>>500</option></select>
				<input type="submit" name="submit" value="搜索" class="btn" />
				<input type="hidden" id="search" name="search" value="1"/>
				</div>
				<div style="float: right">
			    <?php echo '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_price&op=urllist">用户网址屏蔽列表</a>'; ?>
				</div>
				</td>
			</tr>
		</tbody>
	</table>
</form>


<form action="" method="post" id="priceForm">
<?php
showtableheader();

echo '<tr class="header"><th>&nbsp;&nbsp;</th><th>用户名</th><th>价格(元)</th><th>帖子名称/URL/留言</th><th>已删除</th><th>添加时间</th><th>删除原因</th><th>操作</th></tr>';

while ($value = DB::fetch($query)) {
	$member=DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE uid = {$value['uid']}");	
	echo '<tr>';
    echo '<td><input type="checkbox" name="guide['.$value['id'].']" class="guideCheckbox" /></td>'. 
	     '<td>'.$member['username'].'</td>'. 
	     '<td>'.$value['price'].'</td>'.
         '<td><a href="forum.php?mod=viewthread&tid='.$value['tid'].'" target="_blank">'.$value['cpmc'].'</a><br>'.$value['url'].'<br><span style="color:#339999">'.$value['comment'].'</span></td>'.		 
		 '<td>'.($value['isdelete']?'<font color="red">是</font>':'否').'</td>'.
		 '<td>'.date('Y-m-d',$value['dateline']).'</td>'.
		 '<td>'.$value['deletereason'].'</td>'.
         '<td>&nbsp;&nbsp;<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_price&op=editop&id='.$value['id'].'">'.($value['isdelete']?'<font color="red"></font>':'删除').'</a>';
}
showtablefooter();
?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">		
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />	
			全选/全不选
		</label>
		&nbsp;|	 
		<a href="#" id="delOperate" onclick="">删除</a>&nbsp;&nbsp;
	</div>
	&nbsp;&nbsp;&nbsp;&nbsp;

	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_price"); ?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	function submitForm(num) {
		if ($('#priceForm .guideCheckbox:checked').size() == 0) {
			return false;
		}
		$('#priceForm input[name="operateNum"]').val(num);
		$('#priceForm').submit();
	}
	$('#delOperate').click(function(){		
		if(confirm('您确认删除？')){
			submitForm(3);
		}else{
			
		}	
	});
	
	$('#selectAll').click(function(){
		if ($(this)[0].checked) {
			$('#priceForm .guideCheckbox').attr('checked', true);
		} else {
			$('#priceForm .guideCheckbox').attr('checked', false);
		}
	});
})(jQuery);
</script>

