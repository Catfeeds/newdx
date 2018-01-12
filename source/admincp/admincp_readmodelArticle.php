<?php

/**
 *      阅读版
 *      by shuaiquan
 */

if(!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
session_start();
set_time_limit(0);
include_once libfile('function/discuzcode');
include_once libfile('function/readmodelTravel');
$operation = !empty($operation) ? $operation : 'list';
cpheader();
showsubmenu('文章阅读版',  array(
	array('列表', "readmodelArticle&operation=list", $operation == 'list'),
	array('发布', "readmodelArticle&operation=add", $operation == 'add' || $operation == 'edit'),
	array('批量发布', "readmodelArticle&operation=multiadd", $operation == 'multiadd')
));
if($operation == 'list') {
	
	if(submitcheck('readmodellistsubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$tids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";		
		$url  = "action=readmodelArticle&operation=list&&perpage={$perpage}&page={$page}";
		
		if ($_G['gp_optype'] == 'trash' && $tids) {			
			DB::delete('forum_articleread', "tid in ({$tids})");
			DB::update('forum_thread', array('readmodel'=>0), "tid in ({$tids})");
			
			cpmsg('删除成功', $url, 'succeed');
		} elseif ($_G['gp_optype'] == 'show' && $tids) {	
			DB::update('forum_articleread', array('isshow'=>1), "tid in ({$tids})");
			DB::update('forum_thread', array('readmodel'=>2), "tid in ({$tids})");
			
			cpmsg('上线成功', $url, 'succeed');
		} elseif ($_G['gp_optype'] == 'noshow' && $tids) {	
			DB::update('forum_articleread', array('isshow'=>0), "tid in ({$tids})");
			DB::update('forum_thread', array('readmodel'=>98), "tid in ({$tids})");
			
			cpmsg('下线成功', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}

	} else {
		
		$mpurl   = ADMINSCRIPT.'?action=readmodelArticle&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		$tid 	 = empty($_G['gp_tid']) ? 0 : intval($_G['gp_tid']);
		$selectadminmember 	 = $_G['gp_selectadminmember'];
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;	
		if($selectadminmember){
			$mpurl .= '&selectadminmember=' . $selectadminmember;
		}
		$query = DB::query("SELECT a.uid,m.username FROM ".DB::table('common_admincp_member'). " AS a ". "LEFT JOIN " . DB::table("common_member") . " AS m ". "ON a.uid=m.uid " . getSlaveID());
		$adminmembers = array('admin');
		while($adminmember = DB::fetch($query)) {
			$adminmembers[] = $adminmember['username'];
		}
		
		$extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">文章阅读版&nbsp;&nbsp;';
		$extraStr .= '&nbsp;&nbsp;<form action="admin.php" method="GET" style="display:inline;" >';
		$extraStr .= '<input type="hidden" name="action" value="readmodelArticle"/>';
		$extraStr .= '<input type="hidden" name="operation" value="list"/>';
		$extraStr .= '<input type="text" name="tid" value="'.$tid.'" style="height:20px;" placeholder="填写帖子id" />&nbsp;&nbsp;';
		$extraStr .= '&nbsp;&nbsp;操作人<select id="selectadminmember" name="selectadminmember"><option value="">请选择操作人</option>';
		foreach ($adminmembers as $v) {
			$selectStr = $selectadminmember == $v ? 'selected=\"selected\"' : '';
			$extraStr .= "<option value=\"{$v}\" {$selectStr}>{$v}</option>";
		}
		$extraStr .= '</select>&nbsp;&nbsp;';
		$extraStr .= '<input type="submit" value="查询" style="cursor:pointer;" /></form></div>';
		echo $extraStr;
		
		showformheader('readmodelArticle&operation=list');
		showtableheader();
		showsubtitle(array('', '文章标题','操作人', '作者', '生成时间', '操作'));

		$multipage = '';
		
		if ($tid) {
			if($selectadminmember){
				$selectadminmembercond = "AND opadmin= '{$selectadminmember}'";
			}
			$sql   = "SELECT tid, subject, author, authorid, dateline, isshow,opadmin  FROM ".DB::table('forum_articleread')." WHERE tid = {$tid} {$selectadminmembercond} " . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$status = $v[isshow] ? '上线' : '<span style="color:red;">下线</span>';				
				showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
						"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$v[tid]\">",
						"<a href=\"{$_G['config']['web']['portal']}wenzhang/$v[tid].html\" target=\"_blank\">[{$status}]{$v[subject]}</a>",
						"$v[opadmin]",
						"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
						date("Y-m-d H:i:s", $v['dateline']),
						"<a href=\"admin.php?&action=readmodelArticle&operation=show&tid=$v[tid]\">详情</a>"
					));
			}
		} else {
			if($selectadminmember){
				$selectadminmembercond = " WHERE opadmin= '{$selectadminmember}'";
			}
			$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_articleread')."{$selectadminmembercond}" . getSlaveID());
			if($count) {
				$sql   = "SELECT tid, subject, author, authorid, dateline, isshow,opadmin  FROM ".DB::table('forum_articleread')." f_r_t{$selectadminmembercond} order by f_r_t.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
				$query = DB::query($sql);
				while ($v = DB::fetch($query)) {
					$status = $v[isshow] ? '上线' : '<span style="color:red;">下线</span>';				
					showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$v[tid]\">",
							"<a href=\"{$_G['config']['web']['portal']}wenzhang/$v[tid].html\" target=\"_blank\">[{$status}]{$v[subject]}</a>",
							"$v[opadmin]",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<a href=\"admin.php?&action=readmodelArticle&operation=show&tid=$v[tid]\">详情</a>"
						));
				}
				$multipage = multi($count, $perpage, $page, $mpurl);
			}
		}		

		$optypehtml = ''
			.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_trash" value="trash" class="radio" /><label for="optype_trash">彻底删除</label>&nbsp;&nbsp;<input type="radio" name="optype" id="optype_show" value="show" class="radio" /><label for="optype_show">上线</label>&nbsp;&nbsp;<input type="radio" name="optype" id="optype_noshow" value="noshow" class="radio" /><label for="optype_noshow">下线</label>&nbsp;&nbsp;';
		showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="readmodellistsubmit" value="'.cplang('submit').'" />', $multipage);
		showtablefooter();
		showformfooter();
	}		
} elseif($operation == 'show') {	
	
	$_SESSION['admincp_travel_show_page'] = 1;
	
	$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
	$url     = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "action=readmodelArticle&operation=list";
	$perpage = 50;
	$page    = max($_G['gp_page'], 1);	
	$start   = ($page-1) * $perpage;
	
	if (empty($tid)) {
		cpmsg('帖子ID为空', $url, 'error');
	}
	
	$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_articleread')." where tid = {$tid} " . getSlaveID());
	if (empty($travelShow)) {
		cpmsg('帖子不存在', $url, 'error');
	}
	
	$select_types =getArticleTypes();
	$select_types_str='';
	foreach ($select_types as $k=>$v) {
		$selectStr = $travelShow['typeid'] == $k ? 'selected=\"selected\"' : '';
		if($v[1] ==0){
		$select_types_str .= "<option value=\"{$k}\" {$selectStr} style=\"font-weight:bold;\">{$v[0]}</option>";
		}else{
		$select_types_str .= "<option value=\"{$k}\" {$selectStr} >&nbsp;{$v[0]}</option>";	
		}
	}
	
	$travelShow['summary'] = unserialize($travelShow['summary']);
	
	/*编辑框*/
	$formhash    = FORMHASH;	
	
	echo '<form id="editform" action="admin.php?action=readmodelArticle&operation=edit" autocomplete="off" method="post" name="editform">';
	echo <<<READMODEL
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}
</style>		
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<tr class="pubDt50">
			<th>标题</th><td><input type="text" name="subject" class="inputText" value="{$travelShow['subject']}" style="width:500px;"/></td>
		</tr>		
		<tr class="pubDt50">
			<th>标签</th><td colspan="2">
				<select name='typeid' id='typeid'>
				<option value="">请选择分类</option>
				{$select_types_str}
				</select>
				</td>
		</tr>
		<tr class="pubDt50">
			<th>摘要</th><td><textarea name="summarytext" style="width:500px;height:150px;">{$travelShow['summary']['text']}</textarea></td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>
				<input type="hidden" name="tid" value="{$travelShow['tid']}" />
				<input type="hidden" name="readmodeleditsubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value=" " class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
READMODEL;
	showformfooter();
	/*编辑框 end*/
	
	echo '<input type="hidden" id="nomore" value="0" />';
	showformheader('');
	showtableheader($travelShow['subject']);
	
	showsubtitle(array('序号', '内容', '作者', '发布时间', '操作'));

	$count = $travelShow['acnt']+$travelShow['ccnt'];
	
	$travelShow['apids'] = $travelShow['apids'] ? explode(',', $travelShow['apids']) : array();
	$travelShow['cpids'] = $travelShow['cpids'] ? explode(',', $travelShow['cpids']) : array();
	$travelShow['rpids'] = $travelShow['rpids'] ? explode(',', $travelShow['rpids']) : array();
	
	$apids = array_flip($travelShow['apids']);
	$rpids = array_flip($travelShow['rpids']);
	
	$pids    	= array_merge($travelShow['apids'], $travelShow['cpids']);
	$pids    	= array_slice($pids, $start, $perpage);
	$strpids    = $pids ? implode(',', $pids) : '';
	$blockquote = array();
	if($strpids) {
		$sql      = "SELECT tid, pid, subject, author, authorid, message, dateline  FROM ".DB::table('forum_post')." WHERE pid in ({$strpids}) order by pid asc " . getSlaveID();
		$query 	  = DB::query($sql);		
		$postList = array();
		while ($v = DB::fetch($query)) {
			$v['isA'] = false;
			$operateStr = "<a href=\"javascript:void(0);\" onclick=\"noshow('{$tid}', '{$v['pid']}', $(this))\">不显示</a>";
			if (isset($apids[$v['pid']])) {
				$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"tocomment('{$tid}', '{$v['pid']}', $(this))\">变为评论</a>";
				$v['isA'] = true;
			} else {
				$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"toarticle('{$tid}', '{$v['pid']}', $(this))\">变为文章</a>";
				if (isset($rpids[$v['pid']])) {
					$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"recommendcancel('{$tid}', '{$v['pid']}', $(this))\">取消推荐</a>";
				} else {
					$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"recommend('{$tid}', '{$v['pid']}', $(this))\">推荐</a>";
				}
			}
			
			$v['operateStr'] = $operateStr;
			$v['message']    = readmodelMessage($v['message'], 0, $v['pid'], $blockquote, 'admincp');		
			$v['authorStr']  = $v['author'] == $travelShow['author'] ? '<span style="color:red;">[作者]</span>' : '';		
			
			$postList[$v['pid']] = $v;
		}
		
		showtablerow('', array('colspan="5" style="font-size:16px;font-weight:700;"'), array('文章列表'));
		$index    = $start;
		$lastSign = false;
		foreach ($pids as $v) {
			if (empty($postList[$v])) {continue;}
			$temp = $postList[$v];
			$index++;			
			if (empty($temp['isA']) && !empty($lastSign)) {
				showtablerow('', array('colspan="5" style="font-size:16px;font-weight:700;"'), array('评论列表'));	
			}
			$lastSign = $temp['isA'];
			showtablerow('', array('width="5%"', 'width="70%" style="font-size:14px;"', 'width="100" style="white-space:nowrap;"', 'class="td28"', 'style="white-space:nowrap;"'), array(
				$index,
				"<div style=\"height:100px;overflow:hidden;\">$temp[message]</div><a class=\"j-rw-toggleDown\" href=\"javascript:void(0)\"><span>展开</span></a>",
				"<a href=\"home.php?mod=space&uid=$temp[authorid]\" target=\"_blank\">{$temp[author]}{$temp[authorStr]}</a>",
				date("Y-m-d H:i:s", $temp['dateline']),
				$temp[operateStr]
			));
		}
	}
	
	showtablefooter();
	showformfooter();
	
	$url   = ADMINSCRIPT.'?action=readmodelArticle&operation=incShow&tid='.$tid;	
	echo <<<READMODEL
<style>
	#cpform img {max-width:600px;margin-bottom:10px;display:block;}
	#cpform a {color:#2366a8;}	
</style>
<script type="text/javascript" src="static/js/jquery.scrollExtend.js"></script>
<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
	$('#cpcontainer').addClass('containerScroll');
	 //加载更多
    jQuery('.containerScroll').scrollExtend({
        'url': '{$url}',
        'beforeStart': function(data){
			if ($('#nomore').val() == '1') {
				 return false;
			}
			$.post('{$url}', '', function(data){
				var dealstr = data.match(/<div class="jsonHtml">([\s\S]*)<\/div>/g);
				dealstr     = String(dealstr);
				dealstr     = dealstr.replace('<div class="jsonHtml">', '').replace('</div>', '');
				var sIndex    = dealstr.lastIndexOf('nomore');		    	
				if (sIndex > -1) {
					dealstr = dealstr.substring(0, sIndex);
				}
				if (sIndex > -1) {
					$('#nomore').val('1');
				} else {
					$('#cpform tbody').append(dealstr);
				}
			});
		},
		'newElementClass': '',
		'target': '#cpform tbody'
    });
    //图片延时加载
    $(".lazy").lazyload({
    	effect:"fadeIn",
    	appear: function(){
		}
    }); 
    
    //内容展开收起
    $('#cpform').delegate('.j-rw-toggleDown', 'click', function(){
		var obj = $(this).prev();
		var btn = $(this);
	    obj.animate({ 
			height: "100%"
		}, 1000 ,function(){
			obj.find('.img_url').each(function(){
				var html = $(this).html();
				html     = '<img src="'+html.replace('[img]', '').replace('[/img]', '')+'" />';
				$(this).html('').html(html);
				$(this).removeClass('img_url');
			});		
			setTimeout(function(){
				if (obj.height() <= 100) {
					btn.remove();
				}
			}, 200);
		});
		btn.addClass('j-rw-toggleUp').removeClass('j-rw-toggleDown');
		btn.html('').html('收起');		
	});
	$('#cpform').delegate('.j-rw-toggleUp', 'click', function(){
	    $(this).prev().animate({
			height: "100px"
		}, 1000 );
		$(this).addClass('j-rw-toggleDown').removeClass('j-rw-toggleUp');
		$(this).html('').html('展开');
	});
});

function noshow(tid, pid, obj) {
	if (confirm("确定此条不显示？")) {
		var url   = 'admin.php?action=readmodelArticle&operation=operate&optype=noshow&tid='+tid+'&pid='+pid;	
		$.post(url, '', function(data){
			obj.parent().parent().remove();
			alert('操作成功');
		});
	}	
}
function tocomment(tid, pid, obj) {
	if (confirm("确定作为评论？")) {
		var url   = 'admin.php?action=readmodelArticle&operation=operate&optype=tocomment&tid='+tid+'&pid='+pid;
		$.post(url, '', function(data){
			
			var html = '<a href="javascript:void(0);" onclick="toarticle('+tid+', '+pid+', $(this))">变为文章</a>';
			
			var dealstr = data.match(/<div class="jsonHtml">([\s\S]*)<\/div>/g);
			
          	dealstr     = String(dealstr);
	    	dealstr     = dealstr.replace('<div class="jsonHtml">', '').replace('<\/div>', '');
	    	dealstr     = parseInt(dealstr, 10);
	    	if (dealstr > 0) {
				html += '|<a href="javascript:void(0);" onclick="recommendcancel('+tid+', '+pid+', $(this))">取消推荐</a>';
	    	} else {
				html += '|<a href="javascript:void(0);" onclick="recommend('+tid+', '+pid+', $(this))">推荐</a>';
	    	}
	    	
	    	obj.parent().append(html);			
	    	obj.remove();
			alert('操作成功');
		});
	}	
}
function toarticle(tid, pid, obj) {
	if (confirm("确定作为文章？")) {
		var url   = 'admin.php?action=readmodelArticle&operation=operate&optype=toarticle&tid='+tid+'&pid='+pid;
		$.post(url, '', function(data){			
			var html = '<a href="javascript:void(0);" onclick="noshow('+tid+', '+pid+', $(this))">不显示</a>';	    	
			html    += '|<a href="javascript:void(0);" onclick="tocomment('+tid+', '+pid+', $(this))">变为评论</a>';	    	
	    	obj.parent().html('').html(html);
			alert('操作成功');
		});
	}	
}
function recommend(tid, pid, obj) {
	if (confirm("确定推荐？")) {
		var url   = 'admin.php?action=readmodelArticle&operation=operate&optype=recommend&tid='+tid+'&pid='+pid;
		$.post(url, '', function(data){	
			var html = '<a href="javascript:void(0);" onclick="recommendcancel('+tid+', '+pid+', $(this))">取消推荐</a>';		
			obj.parent().append(html);			
	    	obj.remove();
			alert('操作成功');
		});
	}	
}
function recommendcancel(tid, pid, obj) {
	if (confirm("确定取消推荐？")) {
		var url   = 'admin.php?action=readmodelArticle&operation=operate&optype=recommendcancel&tid='+tid+'&pid='+pid;
		$.post(url, '', function(data){
			var html = '<a href="javascript:void(0);" onclick="recommend('+tid+', '+pid+', $(this))">推荐</a>';		
			obj.parent().append(html);			
	    	obj.remove();
			alert('操作成功');
		});
	}	
}
</script>	
READMODEL;

} elseif($operation == 'incShow') {
	
	$_SESSION['admincp_travel_show_page']++;
	$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
	$url     = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "action=readmodelArticle&operation=list";
	$perpage = 50;
	$page    = max($_SESSION['admincp_travel_show_page'], 1);
	$start   = ($page-1) * $perpage;
	
	if (empty($tid)) {
		cpmsg('帖子ID为空', $url, 'error');
	}
	
	$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_articleread')." t where tid = {$tid} " . getSlaveID());
	if (empty($travelShow)) {
		cpmsg('帖子不存在', $url, 'error');
	}

	$count = $travelShow['acnt']+$travelShow['ccnt'];
	
	$travelShow['apids'] = $travelShow['apids'] ? explode(',', $travelShow['apids']) : array();
	$travelShow['cpids'] = $travelShow['cpids'] ? explode(',', $travelShow['cpids']) : array();
	$travelShow['rpids'] = $travelShow['rpids'] ? explode(',', $travelShow['rpids']) : array();
	
	$apids = array_flip($travelShow['apids']);
	$rpids = array_flip($travelShow['rpids']);
	
	$pids    = array_merge($travelShow['apids'], $travelShow['cpids']);
	$pids    = array_slice($pids, $start, $perpage);
	$strpids = $pids ? implode(',', $pids) : '';	
	
	$blockquote = array();
	
	$html     = '<div class="jsonHtml">';
	$postList = array();
	if($strpids) {
		$sql   = "SELECT tid, pid, subject, author, authorid, message, dateline  FROM ".DB::table('forum_post')." WHERE pid in ({$strpids}) order by pid asc " . getSlaveID();
		$query = DB::query($sql);		
		while ($v = DB::fetch($query)) {
			$v['isA'] = false;
			$operateStr = "<a href=\"javascript:void(0);\" onclick=\"noshow('{$tid}', '{$v['pid']}', $(this))\">不显示</a>";
			if (isset($apids[$v['pid']])) {
				$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"tocomment('{$tid}', '{$v['pid']}', $(this))\">变为评论</a>";
				$v['isA'] = true;
			} else {
				$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"toarticle('{$tid}', '{$v['pid']}', $(this))\">变为文章</a>";
				if (isset($rpids[$v['pid']])) {
					$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"recommendcancel('{$tid}', '{$v['pid']}', $(this))\">取消推荐</a>";
				} else {
					$operateStr .= "|<a href=\"javascript:void(0);\" onclick=\"recommend('{$tid}', '{$v['pid']}', $(this))\">推荐</a>";
				}
			}
						
			$v['operateStr'] = $operateStr;
			$v['message']    = readmodelMessage($v['message'], 0, $v['pid'], $blockquote, 'admincp');		
			$v['authorStr']  = $v['author'] == $travelShow['author'] ? '<span style="color:red;">[作者]</span>' : '';		
			
			$postList[$v['pid']] = $v;
		}
		
		$index    = $start;
		$lastSign = false;
		foreach ($pids as $v) {
			if (empty($postList[$v])) {continue;}	
			$temp = $postList[$v];		
			$index++;
			if (empty($temp['isA']) && !empty($lastSign)) {
				showtablerow('', array('colspan="5" style="font-size:16px;font-weight:700;"'), array('评论列表'));	
			}
			$lastSign = $temp['isA'];
			$tempHtml  = '<tr class="hover">';
			$tempHtml .= '<td width="50">'.$index.'</td>';
			$tempHtml .= '<td width="70%" style="font-size:14px;"><div style="height:100px;overflow:hidden;">'.$temp[message].'</div><a class="j-rw-toggleDown" href="javascript:void(0)"><span>展开</span></a></td>';
			$tempHtml .= '<td style="width:100px;" style="white-space:nowrap;">';
			$tempHtml .= "<a href=\"home.php?mod=space&uid={$temp['authorid']}\" target=\"_blank\">{$temp['author']}{$temp['authorStr']}</a>";
			$tempHtml .= '</td>';
			$tempHtml .= '<td class="td28">';
			$tempHtml .= date("Y-m-d H:i:s", $temp['dateline']);
			$tempHtml .= '</td>';
			$tempHtml .= '<td style="white-space:nowrap;">';
			$tempHtml .= $temp['operateStr'];
			$tempHtml .= '</td>';
			$tempHtml .= '</tr>';
					
			$html .= $tempHtml;
		}
	}	
	$html .= $index == $start ? 'nomore' : '';
		
	$html .= "</div>";
	echo $html;
	exit();

} elseif($operation == 'operate') {	
	$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
	$pid 	 = !empty($_G['gp_pid']) ? intval($_G['gp_pid']) : 0;
	$optype  = !empty($_G['gp_optype']) ? $_G['gp_optype'] : $_G['gp_optype'];
	if (empty($tid)) {
		exit();
	}
	
	$travelShow = DB::fetch_first("SELECT tid, apids, cpids, rpids, acnt, ccnt, rcnt  FROM ".DB::table('forum_articleread')." t where tid = {$tid} " . getSlaveID());
	if (empty($travelShow)) {
		exit();
	}	
	
	$travelShow['apids'] = !empty($travelShow['apids']) ? explode(',', $travelShow['apids']) : array();
	$travelShow['cpids'] = !empty($travelShow['cpids']) ? explode(',', $travelShow['cpids']) : array();
	$travelShow['rpids'] = !empty($travelShow['rpids']) ? explode(',', $travelShow['rpids']) : array();	
	$travelShow['apids'] = array_flip($travelShow['apids']);
	$travelShow['cpids'] = array_flip($travelShow['cpids']);
	$travelShow['rpids'] = array_flip($travelShow['rpids']);
	
	if ($optype == 'noshow') {
		unset($travelShow['apids'][$pid], $travelShow['cpids'][$pid], $travelShow['rpids'][$pid]);
	} elseif ($optype == 'tocomment') {
		unset($travelShow['apids'][$pid]);
		$travelShow['cpids'][$pid] = -1;
		
		$message = DB::result_first("SELECT message FROM ".DB::table('forum_post')." t where pid = {$pid} " . getSlaveID());
		if(strpos($message, '[attach]') !== false || strpos($message, '[img]') !== false) {				
			$travelShow['rpids'][$pid] = -1;
		}
		if (!isset($travelShow['rpids'][$pid])) {		
			$message = discuzcode($message);
			$message = strip_tags($message);
			$tempCnt = mb_strlen($message);
			if ($tempCnt > 50) {
				$travelShow['rpids'][$pid] = -1;
			}				
		}
		ksort($travelShow['cpids']);
		ksort($travelShow['rpids']);
		
		$html  = '<div class="jsonHtml">';
		$html .= isset($travelShow['rpids'][$pid]) ? 1 : 0;
		$html .= '</div>';
		echo $html;
	} elseif ($optype == 'toarticle') {
		unset($travelShow['cpids'][$pid], $travelShow['rpids'][$pid]);
		$travelShow['apids'][$pid] = -1;		
		
		ksort($travelShow['apids']);
	} elseif ($optype == 'recommend') {
		$travelShow['rpids'][$pid] = -1;
		ksort($travelShow['rpids']);
		
	} elseif ($optype == 'recommendcancel') {
		unset($travelShow['rpids'][$pid]);
	}
	
	$data = array();
	$data['acnt']   	= count($travelShow['apids']);
	$data['ccnt']   	= count($travelShow['cpids']);
	$data['rcnt']   	= count($travelShow['rpids']);
	$data['apids']   	= implode(',', array_flip($travelShow['apids']));
	$data['cpids']   	= implode(',', array_flip($travelShow['cpids']));
	$data['rpids']   	= implode(',', array_flip($travelShow['rpids']));	
			
	DB::update('forum_articleread', $data, "tid={$tid}");
	exit();
	
} elseif($operation == 'add') {
	
	if(submitcheck('readmodeladdsubmit')) {		
		
		$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
		$url     = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "action=readmodelArticle&operation={$operation}";
		
		if (empty($tid)) {
			cpmsg('请填写帖子ID', $url, 'error');
		}
		
		$threadShow = DB::fetch_first("SELECT t.authorid, t.author, t.subject, t.tid, t.readmodel FROM ".DB::table('forum_thread')." t where tid = {$tid} " . getSlaveID());			
		if (empty($threadShow)) {
			cpmsg('帖子不存在', $url, 'error');
		}
		
		if ($threadShow['readmodel']) {
			cpmsg('已经是游记或是文章阅读版', 'action=readmodelArticle&operation=list', 'error');
		}
		
		insertArticleread($threadShow,$_G['member']['username']);
		
		cpmsg('发布成功', 'action=readmodelArticle&operation=list', 'succeed');
	} else {
		$formhash    = FORMHASH;
		
		showformheader("readmodelArticle&operation={$operation}");
	echo <<<READMODEL
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}
#imglist .overlimit {display:none;}
</style>		
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<tr class="pubDt50">
			<th>帖子ID</th><td><input type="text" name="tid" class="inputText" value=""/></td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>
				<input type="hidden" name="readmodeladdsubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value=" " class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
READMODEL;
		showformfooter();
	}
	
} elseif($operation == 'edit') {
	
	if(submitcheck('readmodeleditsubmit')) {
		
		$tid 	 = !empty($_G['gp_tid']) ? intval($_G['gp_tid']) : 0;
		$url     = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "action=readmodelArticle&operation=list";
		$subject = !empty($_G['gp_subject']) ? $_G['gp_subject'] : '';
		$typeid = !empty($_G['gp_typeid']) ? $_G['gp_typeid'] : '0';
		$summarytext = !empty($_G['gp_summarytext']) ? $_G['gp_summarytext'] : '';
		
		if (empty($subject)) {
			cpmsg('请填写阅读版标题', $url, 'error');
		}
		
		if (empty($tid)) {
			cpmsg('请填写帖子ID', $url, 'error');
		}
		
		$threadShow = DB::fetch_first("SELECT t.authorid, t.author, t.subject, t.tid, t.readmodel FROM ".DB::table('forum_thread')." t where tid = {$tid} " . getSlaveID());			
		if (empty($threadShow)) {
			cpmsg('帖子不存在', $url, 'error');
		}
		
		$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_articleread')." where tid = {$tid} " . getSlaveID());
		if (empty($travelShow)) {
			cpmsg('帖子不存在', $url, 'error');
		}
						
		$data['subject']   = $subject;
		$data['typeid']     = $typeid;		
		$data['summary']   = unserialize($travelShow['summary']);			
		
		$summarytext = str_replace('\\', '', $summarytext);	
		$summarytext = str_replace('\'', '’', $summarytext);	
		$summarytext = str_replace('"', '’', $summarytext);	
		$summarytext = mb_substr($summarytext, 0, '200', 'gbk');		
		$summarytext = addslashes($summarytext);			
		
		$data['summary']['text'] = $summarytext;		
		$data['summary'] = serialize($data['summary']);	
		
		DB::update('forum_articleread', $data, "tid={$tid}");
		
		cpmsg('编辑成功', $url, 'succeed');
	} 
}elseif($operation == 'multiadd') {	
	if(submitcheck('multiaddsubmit')) {		
		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$tids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? $_G['gp_ids'] : "";		
		$url  = "action=readmodelArticle&operation=multiadd&&perpage={$perpage}&page={$page}";
		
		if ($_G['gp_optype'] == 'add' && $tids) {
			
			$url     = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "action=readmodelArticle&operation={$operation}";			
			foreach ($tids as $v) {
				$tid = intval($v);
				if (empty($tid)) {continue;}					
				$threadShow = DB::fetch_first("SELECT t.authorid, t.author, t.subject, t.tid, t.readmodel FROM ".DB::table('forum_thread')." t where tid = {$tid} " . getSlaveID());				
				if (empty($threadShow)) {continue;}
				if ($threadShow['readmodel']) {continue;}
				$hasDisplayorder = DB::result_first("SELECT count(*) as count FROM ".DB::table('forum_articleread')." where tid = {$tid} " . getSlaveID());	
				if ($hasDisplayorder) {continue;}	
				insertArticleread($threadShow,$_G['member']['username']);				
			    usleep(0.2*1000000);
			}
			
			cpmsg('批量发布成功', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}
	} else {
		
		//获得文章的板块
		$fids    = getArticleFids();
		$fid     = empty($_G['gp_fid']) ? 0 : intval($_G['gp_fid']);
		$part    = empty($_G['gp_part']) ? 0 : intval($_G['gp_part']);
		$find    = empty($_G['gp_find']) ? '' : $_G['gp_find'];
		
		$mpurl   = ADMINSCRIPT.'?action=readmodelArticle&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		$extraStr = '<div style="margin-top:20px;background-color:#f0f7fd;padding:5px;">文章阅读版&nbsp;&nbsp;<select id="selectFid"><option value="">请选择板块</option>';
		foreach ($fids as $k=>$v) {
			$selectStr = $fid == $k ? 'selected=\"selected\"' : '';
			$extraStr .= "<option value=\"{$k}\" {$selectStr}>{$v}</option>";
		}
		$extraStr .= '</select>';
		$selectStr = $part ? 'checked=\"checked\"' : '';
		$extraStr .= "<input type=\"checkbox\" name=\"part\" id=\"part\" value=\"1\" style=\"vertical-align:-1px;\" {$selectStr} />";
		$extraStr .= '<label for="part">未发布</label>';
		$extraStr .= '&nbsp;&nbsp;<form action="admin.php" method="GET" style="display:inline;" >';
		$extraStr .= '<input type="hidden" name="action" value="readmodelArticle"/>';
		$extraStr .= '<input type="hidden" name="operation" value="multiadd"/>';
		$extraStr .= '<input type="text" name="find" value="'.$find.'" style="height:20px;"/>&nbsp;&nbsp;<input type="submit" value="查询" style="cursor:pointer;" /></form>';
		$extraStr .= '</div>';
		echo $extraStr;
		showformheader('readmodelArticle&operation=multiadd');
		showtableheader();		
		showsubtitle(array('', '文章标题', '可能是文章', '作者', '发布时间', '回复数'));
		
		if ($fid) {
			$multipage = '';
			$where  = " t.fid={$fid} AND t.displayorder > -1 ";
			$where .= $part ? " AND  readmodel = 0 " : '';
			$count  = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('forum_thread')." t WHERE {$where} " . getSlaveID());
			if($count) {
				$arrStatus = array(
					'1'  => '<span style="color:red;">游记版上线</span>',
					'99' => '<span style="color:red;">游记版下线</span>',
					'2'  => '<span style="color:red;">文章版上线</span>',
					'98' => '<span style="color:red;">文章版下线</span>',
				);
				$sql   = "SELECT tid, subject, author, authorid, dateline, replies, readmodel FROM ".DB::table('forum_thread')." t WHERE {$where} ORDER BY t.replies desc LIMIT {$start},{$perpage} " . getSlaveID();
				$query = DB::query($sql);
				while ($v = DB::fetch($query)) {
					if ($v['readmodel'] > 0) {
						$status = $arrStatus[$v['readmodel']] ? $arrStatus[$v['readmodel']] : '';
						showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"&nbsp;",
							"<a href=\"forum.php?mod=viewthread&tid=$v[tid]\" target=\"_blank\">[{$status}]{$v[subject]}</a>",
							"是",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<span>$v[replies]</span>"							
						));
					} else {						
						$isbe = isArticleread($v['tid'], $v['authorid']) ? '是' : '<span style="color:red;">否</span>';
						showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$v[tid]\">",
							"<a href=\"forum.php?mod=viewthread&tid=$v[tid]\" target=\"_blank\">{$v[subject]}</a>",
							"{$isbe}",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<span>$v[replies]</span>"							
						));
					}
				}
				$multipage = multi($count, $perpage, $page, "{$mpurl}&fid={$fid}&part={$part}");
			}
	
			$optypehtml = ''
				.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_add" value="add" class="radio" /><label for="optype_add">批量阅读版</label>&nbsp;&nbsp;';
			showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="multiaddsubmit" value="'.cplang('submit').'" />', $multipage);	
		} elseif ($find) {
			require_once DISCUZ_ROOT . './source/class/sphinxapi.php';
			$core = new SphinxClient();
			$core->SetServer('192.168.1.19', 9312);
			$core->SetConnectTimeout(10);
			$core->SetArrayResult(true);
			$core->SetMatchMode(SPH_MATCH_ANY);
			$core->SetLimits($start, $perpage);
			$findUtf8 = iconv('gbk', 'utf-8', $find);
			$res  = $core->Query($findUtf8, 'threadmainindex');
			
			$tids = array();
			foreach ($res['matches'] as $v) {
				$tids[$v['id']] = $v['id'];				
			}
			if ($tids) {
				$sql   = "SELECT tid, subject, author, authorid, dateline, replies, readmodel FROM ".DB::table('forum_thread')." t WHERE tid in (".implode(',', $tids).")  " . getSlaveID();
				$query = DB::query($sql);
				while ($v = DB::fetch($query)) {
					$v['subject'] = str_replace($find, "<span style='color:red;'>{$find}</span>", $v['subject']);
					if ($v['readmodel'] == 1 || $v['readmodel'] == 99 ||$v['readmodel'] == 2 || $v['readmodel'] == 98) {
						//$status = $v['readmodel'] == 1 ? '<span style="color:red;">游记版上线</span>' : '<span style="color:red;">游记版下线</span>';
						switch($v['readmodel']){
							case 1:
								$status = '<span style="color:red;">游记版上线</span>';
								break;
							case 99:
								$status = '<span style="color:red;">游记版下线</span>';
								break;
							case 2:
								$status = '<span style="color:red;">文章版下线</span>';
								break;
							case 98:
								$status = '<span style="color:red;">文章版下线</span>';
								break;		
						}
						showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"&nbsp;",
							"<a href=\"forum.php?mod=viewthread&tid=$v[tid]\" target=\"_blank\">[{$status}]{$v[subject]}</a>",
							"是",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<span>$v[replies]</span>"							
						));
					} else {						
						$isbe = isArticleread($v['tid'], $v['authorid']) ? '是' : '<span style="color:red;">否</span>';
						showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
							"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$v[tid]\">",
							"<a href=\"forum.php?mod=viewthread&tid=$v[tid]\" target=\"_blank\">{$v[subject]}</a>",
							"{$isbe}",
							"<a href=\"home.php?mod=space&uid=$v[authorid]\" target=\"_blank\">$v[author]</a>",
							date("Y-m-d H:i:s", $v['dateline']),
							"<span>$v[replies]</span>"							
						));
					}
				}					
			}
			
			$multipage = multi($res['total_found'], $perpage, $page, "{$mpurl}&find={$find}");
			$optypehtml = ''
				.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_add" value="add" class="radio" /><label for="optype_add">批量阅读版</label>&nbsp;&nbsp;';
			showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="multiaddsubmit" value="'.cplang('submit').'" />', $multipage);
		}
		
		showtablefooter();
		showformfooter();	
		echo <<<READMODEL
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){	
	$('#selectFid').change(function(){
		location.href = 'http://'+'$_SERVER[HTTP_HOST]'+'/'+'$mpurl'+'&fid='+$(this).val();		
	});
	$('#part').change(function(){	
		var val = $part ? 0 : 1;	
		location.href = 'http://'+'$_SERVER[HTTP_HOST]'+'/'+'$mpurl'+'&fid='+$('#selectFid').val()+'&part='+val;
	});
	
});
</script>
READMODEL;
	}	
		
}
?>