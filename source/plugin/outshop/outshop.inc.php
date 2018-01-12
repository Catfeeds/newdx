<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/shop.php';

/***
*  �������״̬
*/
if (isset($_GET['gid']) && isset($_GET['state'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE id = {$_GET[gid]}");
	if($info&&$_GET['state']==1){
		$thread=DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = {$info[tid]} limit 1");
		$message = '���ĵ�����Ϣ <a href="'.$_G['config']['web']['forum'].'thread-'.$info[tid].'-1-1.html" target="_blank">'.$thread[subject].'</a> ������Ա���ͨ����';
		notification_add($thread['authorid'], 'system', 'system_notice', array('subject' => '�û����ã�', 'message' => $message), 0);
	}
	DB::query("UPDATE ".DB::table('dianping_shop_info')." SET ispublish = {$_GET['state']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('�����ɹ�', $url, 'succeed');
}


@session_start();
$prefix = 'plugin_produce_shop_';
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
			cpmsg('������ѡ��һ����Ϣ', $url, 'succeed');
		}
		$gids = implode(',', array_keys($_POST['guide']));
		switch ($_POST['operateNum']) {
			case '1':
				DB::query("UPDATE ".DB::table('dianping_shop_info')." SET ispublish = 1 WHERE id in ({$gids})");
				cpmsg('�����ɹ�', $url, 'succeed');
				break;
			case '2':
				DB::query("UPDATE ".DB::table('dianping_shop_info')." SET ispublish = 0 WHERE id in ({$gids})");
				cpmsg('�����ɹ�', $url, 'succeed');
				break;
			case '3':
				DB::query("DELETE FROM ".DB::table('dianping_shop_info')." WHERE id in ({$gids})");
				cpmsg('ɾ���ɹ�', $url, 'succeed');
				break;
		}
	}
}

$search = array();
foreach (explode(' ', 'subject tid marketid sbrandid cbrandid ispublish orderBy orderType') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}
$where = ' WHERE 1=1 ';
if (!empty($search['subject'])) {
	$where .= " AND i.subject LIKE '%{$search['subject']}%'";
}
if (!empty($search['tid'])) {
	$where .= " AND i.tid in ('$search[tid]')";
}
if ($search['marketid'] != '') {

	if($search['marketid']==1){
		$where .= " AND i.marketid>='{$search['marketid']}'";
	}else{
		$where .= " AND i.marketid='{$search['marketid']}'";
	}
}
if ($search['sbrandid'] != '') {

	if($search['sbrandid']==1){
		$where .= " AND i.sbrandid >= '{$search['sbrandid']}'";
	}else{
		$where .= " AND i.sbrandid ='{$search['sbrandid']}'";
	}

}
if ($search['cbrandid'] != '') {

	if($search['cbrandid']==1){
		$where .= " AND i.cbrandid>='{$search['cbrandid']}'";
	}else{
		$where .= " AND i.cbrandid='{$search['cbrandid']}'";
	}


}
if ($search['ispublish'] != '') {
	$where .= " AND i.ispublish='{$search['ispublish']}'";
}

$orderBy = '';
if ($search['orderBy'] != '') {
	if ($search['orderBy'] == 1) {
		$orderBy .= " ORDER BY t.dateline";
	} elseif ($search['orderBy'] == 2) {
		$orderBy .= " ORDER BY t.dateline ";
	}
	if ($orderBy && $search['orderType'] != '') {
		$orderBy .= " {$search['orderType']}";
	}
} else {
	$orderBy .= " ORDER BY t.dateline DESC";
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_shop_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = i.tid $where");
$query = DB::query("SELECT i.*, t.views,t.dateline,t.author,t.authorid FROM ".DB::table('dianping_shop_info')." AS i
				   LEFT JOIN ".DB::table('forum_thread')." AS t ON i.tid = t.tid
				   $where $orderBy
				   LIMIT ".($page - 1)*$ppp.", $ppp");

?>
<form action="" method="POST">
	<table class="tb tb2">
		<tbody>
			<tr>
				<th class="partition">����</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
					��������:
					<input type="text" name="subject" id="sName" size="18" value="<?php echo $search['subject']; ?>" />
					tid:
					<input type="text" name="tid" id="tid" size="18" value="<?php echo $search['tid']; ?>" />
					<select name="ispublish" id="ispublish">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['ispublish']==='1'?' selected="selected"':''; ?>>�����</option>
						<option value="0"<?php echo $search['ispublish']==='0'?' selected="selected"':''; ?>>δ���</option>
					</select>
					<select name="marketid" id="sShop">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['marketid']==='1'?' selected="selected"':''; ?>>�̳���</option>
						<option value="0"<?php echo $search['marketid']==='0'?' selected="selected"':''; ?>>�ֱߵ�</option>
					</select>
					<select name="sbrandid" id="sbrand">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['sbrandid']==='1'?' selected="selected"':''; ?>>רӪ��</option>
						<option value="0"<?php echo $search['sbrandid']==='0'?' selected="selected"':''; ?>>�ۺϵ�</option>
					</select>
					<select name="cbrandid" id="cbrand">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['cbrandid']>='1'?' selected="selected"':''; ?>>����</option>
						<option value="0"<?php echo $search['cbrandid']==='0'?' selected="selected"':''; ?>>������</option>
					</select>
					����:
					<select name="orderBy" id="orderBy">
						<option value="">Ĭ��</option>
						<option value="1"<?php echo $search['orderBy']==='1'?' selected="selected"':''; ?>>����ʱ��</option>
					</select>
					<select name="orderType" id="orderType">
						<option value="">Ĭ��</option>
						<option value="ASC"<?php echo $search['orderType']==='ASC'?' selected="selected"':''; ?>>����</option>
						<option value="DESC"<?php echo $search['orderType']==='DESC'?' selected="selected"':''; ?>>����</option>
					</select>
					<input type="submit" value="����" class="btn" />(��������<?php echo $count; ?>����¼)
				</td>
			</tr>
		</tbody>
	</table>
</form>


<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr class="header">
	<th>��������</th>
	<th>�������</th>
	<th>�̳�����</th>
	<th>����Ʒ��</th>
	<th>ʡ��</th>
	<th>����(��)</th>
	<th>��Ӫ����</th>
	<th>רӪƷ��</th>
	<th>����ʱ��</th>
	<th>״̬</th>
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

<?php while ($value = DB::fetch($query)): ?>
<tr>
	<td>
		<input type="checkbox" name="guide[<?php echo $value['id']; ?>]" class="guideCheckbox" />
		<a href="forum.php?mod=viewthread&tid=<?php echo $value['tid']; ?>" target="_blank"><?php echo $value['subject']; ?></a>(<a href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?php echo $value['authorid']; ?>.html" target="_blank" style="color:#C00;"><?php echo $value['author']; ?></a>)
	</td>
    <td><?php echo $value['marketid']==0? "�ֱߵ�":"�̳���"; ?></td>
	<td>
	<?php  $market = ForumOptionShop::getMarketById($value['marketid']);echo $market['market'];?>
	<?php if($value['marketid']=0){ ?>
	<input type="text" id="shopname_<?php echo $value['id']; ?>" name="shopname" value="<?php echo $value['marketid']; ?>" onfocus="this.select();" onKeyDown="document.getElementById('subbmt_<?php echo $value['id'];?>').style.visibility='visible'" onKeyPress="document.getElementById('subbmt_<?php echo $value['id'];?>').style.visibility='visible'" onChange="document.getElementById('subbmt_<?php echo $value['id'];?>').style.visibility='visible'"/>&nbsp;&nbsp;<input type="button" id="subbmt_<?php echo $value['id'];?>" name="sub_<?php echo $value['id'];?>" value="�޸�" style="visibility:hidden" onClick="checkvalue('shopname_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="sid" value="<?php echo $value['id']; ?>" /><span id="tip<?php echo $value['id']; ?>"></span>
	<?php } ?>
	</td>
	<td>
	<?php  $prov = ForumOptionShop::getChainBrandById($value['cbrandid']);echo $prov['chainbrand'];?>
	<?php if($value['cbrandid']=0){ ?>
	<input type="text" id="cbrand_<?php echo $value['id']; ?>" name="cbrandid" value="<?php echo $value['cbrandid']; ?>" onfocus="this.select();" onKeyDown="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onKeyPress="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'" onChange="document.getElementById('submit_<?php echo $value['id'];?>').style.visibility='visible'"/>&nbsp;&nbsp;<input type="button" id="submit_<?php echo $value['id'];?>" name="submit_<?php echo $value['id'];?>" value="�޸�" style="visibility:hidden" onClick="checkcbrand('cbrand_<?php echo $value['id']; ?>');"/><input type="hidden" name="id" id="id" value="<?php echo $value['id']; ?>" /><span id="tips<?php echo $value['id']; ?>"></span>
	<?php } ?>
	</td>
	<td><?php  $prov = ForumOptionShop::getRegionById($value['provinceid']);echo $prov['name'];?></td>
	<td><?php  $reg = ForumOptionShop::getRegionById($value['regionid']);echo $reg['name'];?></td>
	<td><?php echo $value['sbrandid']==0? "�ۺϵ�":"ר����"; ?></td>
	<td><?php  $sbrand = ForumOptionShop::getSBrandById($value['sbrandid']);echo $sbrand['brand'];?></td>
	<td><span class="fz"><?php echo date('Y-m-d H:i:s', $value['dateline']); ?></span></td>
	<td><span class="yishen" <?php echo ($value['ispublish']== 0 ? "style='display:none'" : "" ); ?>>����</span>
		<span class="weishen" <?php echo ($value['ispublish']== 1 ? "style='display:none'" : "" ); ?>>δ��</span>
	</td>
	<td>
	&nbsp;
	<a class="shen" <?php echo ($value['ispublish']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=1">���</a>
	<a class="unshen" <?php echo ($value['ispublish']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=0">ȡ��</a>
	</td>
</tr>
<?php endwhile; ?>
<?php showtablefooter(); ?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />
			ȫѡ/ȫ��ѡ
		</label>
		&nbsp;&nbsp;
		<a href="#" id="passOperate">���ͨ��</a> |
		<a href="#" id="unpassOperate">��˲�ͨ��</a> |
		<a href="#" id="delOperate"></a>
	</div>
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=outshop&pmod=outshop");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
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

	//ajaxͨ����˲���
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
				//$('#lx').append("<span style='color:#F0F;'>��</span>");
			}
		});
		return false;
	  });
	  //ajaxͨ��δ��˲���
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
