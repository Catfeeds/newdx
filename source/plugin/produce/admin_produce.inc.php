<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';

/***
*   ɾ����Ʒ��Ϣ
*/
if (isset($_GET['gid']) && $_GET['del'] == 1) {
	DB::query("DELETE FROM ".DB::table('plugin_produce_info')." WHERE tid = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?del=\d+/', '', $url);
	cpmsg('ɾ���ɹ�', $url, 'succeed');
}

/***
*  �������״̬
*/
if (isset($_GET['gid']) && isset($_GET['state'])) {
	DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isshow = {$_GET['state']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('�����ɹ�', $url, 'succeed');
}

/***
*  �����Ƽ�״̬
*/
if (isset($_GET['gid']) && isset($_GET['in'])) {
    DB::update('plugin_produce_info' ,array('isin'=>$_G['gp_in'] ,'indateline'=>($_G['gp_in']==1?time():0)) ,array('id'=>$_G['gp_gid']));
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?in=\d+/', '', $url);
	cpmsg('�����ɹ�', $url, 'succeed');
}

/***
*  ��Ϊ���������
*/
if (isset($_GET['gid']) && isset($_GET['new'])) {
	$thread=DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_info')." WHERE id = {$_GET['gid']} LIMIT 1");
	DB::query("UPDATE ".DB::table('plugin_produce_info')." SET cpxh = {$_GET['new']}  WHERE id = {$_GET['gid']}");
	if($_GET['new']!=$thread['cpxh']){
		//������ӷֲ���
		if($_GET['new']==1){
		ForumOptionProduce::calPostRankEvent($thread['tid'],1);
		$thread=ForumOptionProduce::getTheardBytId($thread['tid']);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],4);
		}else{
		//ȡ����������ֲ���
		ForumOptionProduce::calPostRankEvent($thread['tid'],2);
		$thread=ForumOptionProduce::getTheardBytId($thread['tid']);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],5);
		}
	}
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?new=\d+/', '', $url);
	cpmsg('�����ɹ�', $url, 'succeed');
}

/***
*  ��Ϊֵ�ù������
*/
if (isset($_GET['gid']) && isset($_GET['hot'])) {
	DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isworth = {$_GET['hot']} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?hot=\d+/', '', $url);
	cpmsg('�����ɹ�', $url, 'succeed');
}

/***
*  ��Ϊ��������
*/
if (isset($_GET['gid']) && isset($_GET['digest'])) {
	$info=DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_info')." WHERE id = {$_GET['gid']} LIMIT 1");
	$thread=ForumOptionProduce::getTheardBytId($info['tid']);
	DB::query("UPDATE ".DB::table('forum_thread')." SET digest = {$_GET['digest']} WHERE tid = {$thread['tid']}");
	if($_GET['digest']!=$thread['digest']){
		if($_GET['digest']==1){
		//�����ӷֲ���
		ForumOptionProduce::calPostRankEvent($thread['tid'],3);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],6);
		}else{
		//ȡ���������ֲ���
		ForumOptionProduce::calPostRankEvent($thread['tid'],4);
		ForumOptionProduce::calPublisherRankEvent($thread['authorid'],$thread['author'],7);
		}
	}
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?digest=\d+/', '', $url);
	cpmsg('�����ɹ�', $url, 'succeed');
}


/***
*  ѭ������
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
			cpmsg('������ѡ��һ����Ϣ', $url, 'succeed');
		}
		$gids = implode(',', array_keys($_POST['guide']));
		switch ($_POST['operateNum']) {
			case '1':
				DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isshow = 1 WHERE id in ({$gids})");
				cpmsg('�����ɹ�', $url, 'succeed');
				break;
			case '2':
				DB::query("UPDATE ".DB::table('plugin_produce_info')." SET isshow = 0 WHERE id in ({$gids})");
				cpmsg('�����ɹ�', $url, 'succeed');
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
				cpmsg('ɾ���ɹ�', $url, 'succeed');
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
				<th class="partition">����</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
                    ��&nbsp;��&nbsp;����<input type="text" name="username" value="<?php echo $search['username']; ?>" size="18"/>
                    <select name="gmdz" id="gmdz">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['gmdz']==='0'?' selected="selected"':''; ?>>�޹����ַ</option>
					</select>
                    <br />
					��Ʒ����:
					<input type="text" name="cpmc" id="cpmc" size="18" value="<?php echo $search['cpmc']; ?>" />
                    <select name="isin" id="isin">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['isin']==='1'?' selected="selected"':''; ?>>���Ƽ�</option>
						<option value="0"<?php echo $search['isin']==='0'?' selected="selected"':''; ?>>δ�Ƽ�</option>
					</select>
					<select name="isshow" id="isshow">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['isshow']==='1'?' selected="selected"':''; ?>>�����</option>
						<option value="0"<?php echo $search['isshow']==='0'?' selected="selected"':''; ?>>δ���</option>
					</select>
					<select name="digest" id="digest">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['digest']==='1'?' selected="selected"':''; ?>>����</option>
						<option value="0"<?php echo $search['digest']==='0'?' selected="selected"':''; ?>>�Ǿ���</option>
					</select>
					<select name="cpxh" id="cpxh">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['cpxh']==='1'?' selected="selected"':''; ?>>������</option>
						<option value="0"<?php echo $search['cpxh']==='0'?' selected="selected"':''; ?>>��������</option>
					</select>
					<select name="isworth" id="isworth">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['isworth']==='1'?' selected="selected"':''; ?>>ֵ�ù���</option>
						<option value="0"<?php echo $search['isworth']==='0'?' selected="selected"':''; ?>>��ֵ�ù���</option>
					</select>
					����:
					<select name="orderBy" id="orderBy">
						<option value="">Ĭ��</option>
						<option value="1"<?php echo $search['orderBy']==='1'?' selected="selected"':''; ?>>����ʱ��</option>
						<option value="2"<?php echo $search['orderBy']==='2'?' selected="selected"':''; ?>>������ֵ</option>
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
	<th>��Ʒ����</th>
    <th>��ƷͼƬ</th>
	<th>��Ʒ���</th>
	<th>����</th>
	<th>����ʱ��</th>
	<th>��ֵ</th>
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
	<td><span class="zhen" <?php echo ($value['cpxh']!= 1 ? "style='display:none'" : "" ); ?>>��</span>&nbsp;<span class="zhi" <?php echo ($value['isworth']!= 1 ? "style='display:none'" : "" ); ?>>ֵ</span>&nbsp;<span class="jing" <?php echo ($value['digest']!= 1 ? "style='display:none'" : "" ); ?>>��</span></td>
	<td><?php echo date('Y-m-d H:i:s', $value['dateline']); ?></td>
	<td><span class="fz"><?php echo $value['rank']; ?></span></td>
	<td><span class="yishen" <?php echo ($value['isshow']== 0 ? "style='display:none'" : "" ); ?>>����</span>
		<span class="weishen" <?php echo ($value['isshow']== 1 ? "style='display:none'" : "" ); ?>>δ��</span>
        <span class="yitui" <?php echo ($value['isin']== 0 ? "style='display:none'" : "" ); ?>>���Ƽ�</span>
		<span class="weitui" <?php echo ($value['isin']== 1 ? "style='display:none'" : "" ); ?>>δ�Ƽ�</span>
	</td>
	<td>
	&nbsp;
	<a class="shen" <?php echo ($value['isshow']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=1">���</a>
	<a class="unshen" <?php echo ($value['isshow']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&state=0">ȡ��</a>
	&nbsp;
	<a class="tui" <?php echo ($value['isin']==1 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&in=1">�Ƽ�</a>
	<a class="untui" <?php echo ($value['isin']==0 ? "style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&in=0">ȡ��</a>
    &nbsp;
	<a class="xiu" <?php echo ($value['cpxh']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&new=1">����</a>
	<a class="unxiu" <?php echo ($value['cpxh']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&new=0">ȡ��</a>
	&nbsp;
	<a class="worth" <?php echo ($value['isworth']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&hot=1">ֵ����</a>
	<a class="unworth" <?php echo ($value['isworth']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&hot=0">ȡֵ</a>
	&nbsp;
	<a class="digest" <?php echo ($value['digest']==1 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&digest=1">����</a>
	<a class="undigest" <?php echo ($value['digest']==0 ?"style='display:none'":""); ?> href="<?php echo $_SERVER['REQUEST_URI']; ?>&gid=<?php echo $value['id']; ?>&digest=0" style="color:#C00;">ȡ��</a>
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
		<b style="color: #F00" id="b_subject">��ѡ���ǩ��Ӹ���</b><span id="tip"></span>
		<div style="clear:both;"></div>
	</div>
	<form id="frm_bq">
	<input type="hidden" value="" name="tid" id="tid" />
	<div id="bq_content" style="overflow: auto;">
		<?php while ($values = DB::fetch($qq)): ?>
		<div class="hover" style="display: block;float: left;" id="bq_rq">
		<div id="dg_id" style="width: 300px;">
		<input type="checkbox" value="<?php echo $values['tid']; ?>" name="chk_detail[]" flg="chk_detail_" id="chk_detail_<?php echo $values['tid']; ?>" /><label for="chk_detail[]"><?php if($values['type']==2){ ?><?php echo $values['cpmc']; ?>(<span style="color: blue;">ר��</span>)<?php }else{ ?><?php echo $values['cpmc']; ?><?php } ?></label></div>
		</div>
		<?php endwhile; ?>
	</div>
	</form>
	<div class="identity_footer">
		<a href="javascript:void(0);" id="a_enter">ȷ��</a>
		&nbsp;&nbsp;
		<a href="javascript:void(0);" id="a_cancel" style="padding-right:5px">ȡ��</a>
	</div>
</div>

<div id="bq_zhuanti" class="div_content" style="position:absolute; z-index:999; padding:10px; line-height:1.8;display: none;">
	<div class="identity_title">
		<a href="javascript:void(0);" id="a_close_zt" style="float:right"><img src="static/image/admincp/x.gif" width="16" height="16" border="0" /></a>
		<b style="color: #F00" id="b_subject_zt">��ѡ���ǩ��Ӹ���</b><span id="tip_zt"></span>
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
		<a href="javascript:void(0);" id="a_enter_zt">ȷ��</a>
		&nbsp;&nbsp;
		<a href="javascript:void(0);" id="a_cancel_zt" style="padding-right:5px">ȡ��</a>
	</div>
</div>
<script type="text/javascript">
// ���ȡ����رհ�ťʱ���ص�����
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
	jQuery('#b_subject').text("��ѡ���ǩ��Ӹ�:"+td);

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
	jQuery('#b_subject_zt').text("��ѡ���ǩ��Ӹ�:"+td);

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
	// ���û��ȡ��tid�򲻽����κδ���
	if (!str_uid) {
		return;
	}
	jQuery.ajax({
				url: str_url + '&op=add',
				type: "get",
				data: data,
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip").css("padding-left","10px").css("color","blue").html('�޸ĳɹ���');
					}else if(msg=="error"){
						jQuery("#tip").css("padding-left","10px").css("color","blue").html('�޸�ʧ�ܣ�');
					}
					jQuery('#bq_add').fadeOut();
				}

	});
});

jQuery('#a_enter_zt').click(function () {
	var str_url = 'plugin.php?id=produce:ajax_updateproducerelation';
	var data = jQuery("#frm_bq_zt").serialize();
	var str_uid = jQuery.trim(jQuery('#tid_zt').val());
	// ���û��ȡ��tid�򲻽����κδ���
	if (!str_uid) {
		return;
	}
	jQuery.ajax({
				url: str_url + '&op=add',
				type: "get",
				data: data,
				success: function(msg){
					if (msg=="success") {
						jQuery("#tip_zt").css("padding-left","10px").css("color","blue").html('�޸ĳɹ���');
					}else if(msg=="error"){
						jQuery("#tip_zt").css("padding-left","10px").css("color","blue").html('�޸�ʧ�ܣ�');
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

	//���checkbox�ĵ���¼�
	//$('input:checkbox:[name=lx]').click(function(){
	//   var lx=$("input:checkbox[name='lx']:checked").val();
	//   alert(lx)
	//});

	//���checkbox�ĵ���¼�
	//$('input:radio:[name=lx]').click(function(){
	    //if(confirm('��ȷ��Ҫ�������ͣ�')){
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

	  //ajax��Ϊ�Ӿ�������
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
				//$('#lx').append("<span style='color:#F0F;'>��</span>");
			}
		});
		return false;
	  });
	  //ajaxȡ����������
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

	  //ajax��Ϊֵ�������
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
				//$('#lx').append("<span style='color:#F0F;'>��</span>");
			}
		});
		return false;
	  });

	  //ajaxȡ��ֵ�������
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
				//$('#lx').append("<span style='color:#F0F;'>��</span>");
			}
		});
		return false;
	  });

	  //ajax��Ϊ���������
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
				//$('#lx').append("<span style='color:#F0F;'>��</span>");
			}
		});
		return false;
	  });
	   //ajaxȡ�����������
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
				//$('#lx').append("<span style='color:#F0F;'>��</span>");
			}
		});
		return false;
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
      //ajaxͨ���Ƽ�����
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
	  //ajaxͨ��δ�Ƽ�����
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
