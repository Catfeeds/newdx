<?php
require_once libfile('class/searchengine');
require_once DISCUZ_ROOT . './api/record/wordsmodel.class.php';
$thisurl = "http://bbs.8264.com/plugin.php?id=api:testsearch";
$searchtype = $_G['gp_searchtype'] >= 0 ? $_G['gp_searchtype'] : searchengine::SEARCH_TYPE_THREADTITLE;
$searchstring = $_G['gp_searchstring'];
$searchtime = empty($_G['gp_stime']) ? 'all' : $_G['gp_stime'];
$limit = 50;
$page = max(intval($_G['gp_page']), 1);
$offset = $limit * ($page - 1);
if($searchstring)
{
	$searchstring = iconv('utf-8', 'GBK', $searchstring);
	/*此处查找品牌*/
	$q = DB::query("SELECT subject, ename, cname FROM " . DB::table('dianping_brand_info'));
	while($v = DB::fetch($q))
	{
		
	}
	$returnarr = array();
	$hotwords = wordsmodel::getkeywords($searchstring);
	$fencistring = "";
	$mustarr = $noneedarr = array();
	$selectkey = $_G['gp_selectkey'] ? $_G['gp_selectkey'] : array();
	$deletearr = iconv_array($selectkey, 'utf-8', 'gbk');
	$otherwords = $searchstring;
	foreach($hotwords as $vals)
	{
		if(in_array($vals['word'], $deletearr))
		{
			continue;
		}
		if($vals['attr'] == 'vn' || substr($vals['attr'], 0, 1) == 'n' && strlen($vals['attr']) > 1)
		{
			$mustarr[] = $vals['word'];
		}else{
			$noneedarr[] = $vals['word'];
		}
		$otherwords = str_replace($vals, "", $otherwords);
	}
	if($mustarr || $noneedarr)
	{
		if($noneedarr){
			foreach($noneedarr as $ww)
			{
				$muststr = empty($mustarr) ? "" : implode("", $mustarr);
				$fencistring = trim($fencistring) . (empty($fencistring) ? ' ' : ' | ') . "({$muststr}{$ww}) ";
			}
		}else{
			$muststr = empty($mustarr) ? "" : implode("", $mustarr);
			$fencistring = "{$muststr} ";
		}
		$fencistring .= " {$otherwords}";		
	}else{
		$fencistring = $searchstring;
	}
	$resultarr = array();
	$searchengine = new searchengine;
	switch($searchtime){
		case 'week':
			$searchengine->setfilterrange('findtime', strtotime('-1 week'), time());
			break;
		case 'month':
			$searchengine->setfilterrange('findtime', strtotime('-1 month'), time());
			break;
		case 'halfyear':
			$searchengine->setfilterrange('findtime', strtotime('-6 month'), time());
			break;
		default:
			$searchengine->setfilterrange('findtime', strtotime('-1 year'), time());
			break;
	}
	$searchengine->setmatchmode(SPH_MATCH_EXTENDED2);
	switch($searchtype){
		case searchengine::SEARCH_TYPE_BBS:
			$searchindex = searchengine::SEARCH_INDEX_THREAD_MAIN;break;
			//$result = searchengine::querybbs($fencistring, $limit, $offset);break;
		case searchengine::SEARCH_TYPE_PORTAL:
			$searchindex = searchengine::SEARCH_INDEX_PORTAL;break;
			//$result = searchengine::queryportal($fencistring, $limit, $offset);break;
		case searchengine::SEARCH_TYPE_USER:
			$searchindex = searchengine::SEARCH_INDEX_USER;break;
			//$result = searchengine::queryuser($fencistring, $limit, $offset);break;
		case searchengine::SEARCH_TYPE_THREADTITLE:
			$searchindex = searchengine::SEARCH_INDEX_THREAD;break;
			//$result = searchengine::querythread($fencistring, $limit, $offset);break;
		case searchengine::SEARCH_TYPE_THREADCONTENT:
			$searchindex = searchengine::SEARCH_INDEX_POST;break;
			//$result = searchengine::querypost($fencistring, $limit, $offset);break;
		default:
			$searchindex = searchengine::SEARCH_INDEX_ALL;break;
			//$result = searchengine::simplequery($fencistring, searchengine::SEARCH_INDEX_ALL, $limit, $offset);break;
	}
	//$searchengine->searchcore->SetSortMode(SPH_SORT_ATTR_DESC, 'findtime');
	$result = $searchengine->query($fencistring, $searchindex, $limit, $offset);
	//var_dump($result);exit;
	if($result['matches'])
	{
		$returnarr['queryinfo'] = array(
									'foundcount' => $result['total_found'],
									'timeused' => $result['time']);
		foreach($result['words'] as $_key => $_val)
		{
			$returnarr['keyword'][] = iconv('gbk', 'utf-8', $_key);
		}
		if(!$returnarr['keyword'])
		{
			$returnarr['keyword'] = iconv_array($hotwords);
		}
		foreach($result['matches'] as $_id => $_tmp)
		{
			$tmps = array();
			switch($_tmp[searchengine::RETURN_TYPE_ATTR][searchengine::RETURN_ATTR_TYPE])
			{
				case searchengine::SEARCH_TYPE_USER:
					$tt = DB::fetch_first("SELECT username, uid FROM " . DB::table('common_member') . " WHERE uid = {$_id}");
					if($tt){
						$tmps['turl'] = $_G['config']['web']['home'] . $tt['uid'];
						$tmps['ttitle'] = iconv('gbk', 'utf-8', $tt['username']);
						$tmps['avatar'] = avatar($tt['uid'], 'middle', true);
						$tmps['tcontent'] = iconv('gbk', 'utf-8', "<a href='" . $_G['config']['web']['home'] . $tt['uid'] . "' targent='_blank'>点击访问用户空间</a>");
						$tmps['typename'] = iconv('gbk', 'utf-8', '用户');
						$tmps['labelname'] = 'success';
					}
					break;
				case searchengine::SEARCH_TYPE_THREADTITLE:
					$tt = DB::fetch_first("SELECT t.subject, t.tid, p.pid, p.message FROM " . DB::table('forum_thread') . " t LEFT JOIN " . DB::table('forum_post') . " p ON t.tid = p.tid WHERE t.tid = {$_id} AND p.first = 1");
					if($tt){
						$tmps['turl'] = $_G['config']['web']['forum'] . 'thread-' . $tt['tid'] . '-1-1.html';
						$tmps['ttitle'] = iconv('gbk', 'utf-8', $tt['subject']);
						$tt['message'] = preg_replace('#\[.*?\]#i', '', $tt['message']);
						$tt['message'] = preg_replace('#[attach]\d+[/attach]#i', '', $tt['message']);
						$tt['message'] = preg_replace("/\本帖.*编辑/is", "", $tt['message']);
						$tt['message'] = iconv('gbk', 'utf-8', cutstr($tt['message'], 300, '......'));
						$tmps['tcontent'] = $tt['message'];
						$tmps['typename'] = iconv('gbk', 'utf-8', '帖子');
						$tmps['labelname'] = 'info';
					}
					break;
				case searchengine::SEARCH_TYPE_THREADCONTENT:
					$tt = DB::fetch_first("SELECT t.subject, t.tid, p.pid, p.message FROM " . DB::table('forum_thread') . " t LEFT JOIN " . DB::table('forum_post') . " p ON t.tid = p.tid WHERE p.pid = {$_id}");
					if($tt){
						$tmps['turl'] = $_G['config']['web']['forum'] . 'forum-redirect-goto-findpost-ptid-' . $tt['tid'] . '-pid-' . $tt['pid'] . '.html';
						$tmps['ttitle'] = iconv('gbk', 'utf-8', $tt['subject']);
						$tt['message'] = preg_replace('#\[.*?\]#i', '', $tt['message']);
						$tt['message'] = preg_replace('#[attach]\d+[/attach]#i', '', $tt['message']);
						$tt['message'] = preg_replace("/\本帖.*编辑/is", "", $tt['message']);
						$tt['message'] = iconv('gbk', 'utf-8', cutstr($tt['message'], 300, '......'));
						$tmps['tcontent'] = $tt['message'];
						$tmps['typename'] = iconv('gbk', 'utf-8', '帖子');
						$tmps['labelname'] = 'info';
					}
					break;
				case searchengine::SEARCH_TYPE_PORTAL:
					$tt = DB::fetch_first("SELECT aid, title, summary FROM " . DB::table('portal_article_title') . " WHERE aid = {$_id}");
					if($tt){
						$tmps['turl'] = $_G['config']['web']['portal'] . 'http://www.8264.com/viewnews-' . $tt['aid'] . '-page-1.html';
						$tmps['ttitle'] = iconv('gbk', 'utf-8', $tt['title']);
						$contenttmp = empty($tt['summary']) ? DB::result_first("SELECT content FROM " . DB::table('portal_article_content') . " WHERE aid = {$tt[aid]} AND pageorder IN(0,1) order by content") : $tt['summary'];
						$tmps['tcontent'] = iconv('gbk', 'utf-8', cutstr(preg_replace('#<.*?>#', '', $contenttmp), 300, '......'));
						$tmps['typename'] = iconv('gbk', 'utf-8', '文章');
						$tmps['labelname'] = 'warning';
					}
					break;
			}
			if(!empty($tmps))
			{
				$tmps['time'] = date('Y-m-d H:i:s', $_tmp[searchengine::RETURN_TYPE_ATTR][searchengine::RETURN_ATTR_TIME]);
				$resultarr[] = $tmps;
			}
		}
	}
	if(empty($resultarr))
	{
		$returnarr['errormsg'] = iconv('gbk', 'utf-8', "未搜索到任何结果");
	}
	$returnarr['teststring'] = iconv('gbk', 'utf-8', $fencistring);
	$returnarr['resultlist'] = $resultarr;
	$returnarr['searchtype'] = $searchtype;
	$returnarr['delword'] = $selectkey;
	$returnarr['total'] = $result['total'];
	$returnarr['timeused'] = $result['time'];
	if($selectkey){
		$returnarr['teststring'] .= implode(" ", $selectkey);
		$returnarr['keyword'] = array_merge($returnarr['keyword'], $selectkey);
	}
	$returnarr['keyword'] = array_unique($returnarr['keyword']);
	$returnarr['searchtime'] = $searchtime;
	$returnarr['mustkey'] = !empty($mustarr) ? iconv('gbk', 'utf-8', implode(' ', $mustarr)) : '';
}else{
	$returnarr['errormsg'] = iconv('gbk', 'utf-8', "请输入搜索词");
}
if($_G['gp_ajax'] == 1)
{
	echo json_encode($returnarr);
	exit;
}
?><!DOCTYPE HTML>
<html>
<head>
	<meta content="text/html" http-equiv="content-type" charset="GBK2312" />
	<meta name="description" content="8264搜索系统 全能搜索" />
	<title>搜索系统</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="static/js/jquery.form.js"></script>
	<style>
		.searchtype{margin-right:10px;}
		#loadingicon{position: absolute;z-index: 999;}
	</style>
	<script>
	$(document).ready(function(){
		$('.form').on('click', '.input-group-btn>.dropdown-menu>li', function(){
			var selectype = $(this).attr('typeid');
			var selectname = $(this).children('a').html();
			$(this).hide().siblings().show();
			$(this).parent().siblings('input[name=searchtype]').val(selectype).end().parent().find('.searchtype').html(selectname);
		});
	});
	function loadiconload(imgobj)
	{
		var xs = ($(window).width() - imgobj.width)/2;
		var ys = ($(window).height() - imgobj.height)/2;
		imgobj.style.left = xs + 'px';
		imgobj.style.top = ys + 'px';
	}
	</script>
</head>
<body class="container-fluid">
	<img src="/static/image/searchloading.gif" id="loadingicon" style="display: none;" onload="loadiconload(this);"/>
	<div class="row" style="margin-top: 10px;">
		<div class="col-md-2"></div>
		<div class="col-md-6">
			<form id="searchform" class="form" action="<?php echo $thisurl; ?>" method="POST" autocomplete="off" onsubmit="return false;">
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown"><span class="searchtype">选择搜索类型</span><span class="caret"></span></button>
						<ul id="searchtypelist" class="dropdown-menu dropdown-menu-left" role="menu">
							<li typeid="<?php echo searchengine::SEARCH_TYPE_ALL; ?>" style="display: none;"><a href="javascript:;">全站</a></li>
							<li typeid="<?php echo searchengine::SEARCH_TYPE_BBS; ?>"><a href="javascript:;">论坛</a></li>
							<li typeid="<?php echo searchengine::SEARCH_TYPE_THREADTITLE; ?>"><a href="javascript:;">帖子标题</a></li>
							<li typeid="<?php echo searchengine::SEARCH_TYPE_THREADCONTENT; ?>"><a href="javascript:;">帖子内容</a></li>
							<li typeid="<?php echo searchengine::SEARCH_TYPE_PORTAL; ?>"><a href="javascript:;">文章</a></li>
							<li typeid="<?php echo searchengine::SEARCH_TYPE_USER; ?>"><a href="javascript:;">用户</a></li>
				        </ul>
				        <input type="hidden" name="searchtype" value="<?php echo searchengine::SEARCH_TYPE_ALL; ?>" />
					</div>
					<input type="hidden" name="stime" id="stime" />
					<input type="text" class="form-control" name="searchstring" value="<?php echo $searchstring; ?>" />
					<div class="input-group-btn">
						<button id="submits" type="submit" class="btn btn-primary">查询</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-10" id="keyworddiv"></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-10">
			<div class="row" id="maybediv" style="display: none;"><div class="col-md-12">结果太少？试试搜索：<span id="maybekeyword"></span></div></div>
			<div class="row" style="display: none;"><div class="col-md-12"><span id="searchinfos"></span></div></div>
		</div>
	</div>
	<div class="row" style="margin-top: 10px;">
		<div class="col-md-2">
			<div class="list-group" style="padding-top: 50px;" id="searchtimelist">
				<a href="javascript:;" class="list-group-item" timeid="<?php echo 'all'; ?>">所有</a>
				<a href="javascript:;" class="list-group-item" timeid="<?php echo 'week'; ?>">一周内</a>
				<a href="javascript:;" class="list-group-item" timeid="<?php echo 'month'; ?>">当月内</a>
				<a href="javascript:;" class="list-group-item" timeid="<?php echo 'halfyear'; ?>">半年内</a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="alert alert-danger hidden" id="errortips" role="alert"><?php echo $returnarr['errormsg']; ?></div>
			<div id="resultlistdiv">
			<?php if(!empty($resultarr)): ?>
			<?php foreach($resultarr as $listitem): ?>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3 class="panel-title"><a href="<?php echo $listitem['turl']; ?>"><?php echo $listitem['ttitle']; ?></a></h3>
				</div>
				<div class="panel-body">
				<?php echo $listitem['tcontent'] ?>
				</div>
			</div>
			<?php endforeach; ?>
			<?php elseif($_POST): ?>
			<script>$('#errortips').removeClass('hidden');</script>
			<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>
<style>
#keyworddiv{font-size:18px;margin-top:8px;}
#keyworddiv span{margin-right:10px;}
#maybediv{font-size: 12px;font-weight: bold; margin-top:5px;}
#maybekeyword{color: #0080C0;cursor: pointer;}
#keyworddiv .label b{margin-left:5px;margin-right:2px;}
#keyworddiv .label{cursor:pointer;}
.panel .label{font-size:12px;margin-right:10px;}
</style>
<script type="text/javascript">
var nowpage = 0;
$('#submits').click(function(){
	$('#loadingicon').show();
	$('#keyworddiv').html('');
	$('#resultlistdiv').html('');
	$('#errortips').addClass('hidden');
	$('#searchform').ajaxSubmit({
			dataType: 'json',
			url: '<?php echo $thisurl . '&ajax=1'; ?>',
			success: function(data){
				$('#loadingicon').hide();
				if(data.errormsg != null)
				{
					$('#searchinfos').html("").parent().parent().hide();
					$('#errortips').html(data.errormsg).removeClass('hidden');
				}else{
					var listarr = data.resultlist;
					var htmlstr = '';
					var keywords = data.keyword;
					var keywordstr = '';
					if(keywords != null && keywords.length > 0)
					{
						for(var i=0; i < keywords.length; i++)
						{
							var delkey = false;
							for(var j=0; j < data.delword.length; j++)
							{
								if(data.delword[j] == keywords[i])
								{
									delkey = true;
								}
							}
							keywordstr += "<span class='label " + (delkey ? 'label-default' : 'label-primary') + "' title='" + keywords[i] + "'>" + (delkey ? '<del>' : '') + keywords[i] + (delkey ? '</del>' : '') + "<b>&times;</b></span>";
						}
						//keywordstr += data.teststring;
						$('#keyworddiv').html(keywordstr);
					}
					if(listarr != null && listarr.length > 0 && listarr != '')
					{
						for(var i=0; i < listarr.length; i++)
						{
							htmlstr += "<div class='panel panel-default'><div class='panel-heading'><span class='label label-" + listarr[i].labelname + "'>" + listarr[i].typename + "</span><a class='panel-title' href='" + listarr[i].turl + "' target='_blank' class='list-group-item'>" + listarr[i].ttitle + "</a><span class='pull-right'>" + listarr[i].time + "</span></div><div class='panel-body'>" + listarr[i].tcontent + "</div></div>";
						}
						$('#resultlistdiv').html(htmlstr);
						$('#searchinfos').html("用时" + data.timeused + "秒，共查询到" + data.total + "个结果").parent().parent().show();
					}else{
						$('#searchinfos').html("").parent().parent().hide();
					}
				}
				console.log(data.mustkey);
				if(data.mustkey != "" && data.mustkey != undefined){
					$('#maybekeyword').html(data.mustkey);
					$('#maybediv').show();
					console.log('ddd');
				}
				console.log("search:" + data.teststring);
				$('#searchtypelist li').each(function(){
					if($(this).attr('typeid') == data.searchtype)
					{
						$(this).click();
					}
				});
				$('#searchtimelist a').each(function(){
					if($(this).attr('timeid') == data.searchtime)
					{
						$(this).addClass('active').siblings().removeClass('active');
					}
				});
				nowpage = 1;
			},
			error: function(error){
				$('#loadingicon').hide();
				$('#errortips').attr('title', 'error').html("意外错误请重试！").remove('hidden');
			}});
});
$('#searchtimelist').on('click', 'a', function(){
	$('#stime').val($(this).attr('timeid'));
	$('#submits').click();
});
$('#maybekeyword').click(function(){
	$('#searchform input[type=text]').val($(this).html());
	$('#submits').click();
});
$('#keyworddiv').on('click', 'span>b', function(){
	var keyname = $(this).parent().attr('title');
	if($('#searchform input[value=' + keyname + ']').length > 0)
	{
		$('#searchform input[value=' + keyname + ']').remove();
	}else{
		$('#searchform').append('<input type="hidden" name="selectkey[]" value="' + keyname + '" />');
	}
	$('#submits').click();
});
var loadingnext = false;
function loadingmorepage()
{
	loadingnext = true;
	$('#searchform').ajaxSubmit({
			dataType: 'json',
			url: '<?php echo $thisurl . '&ajax=1'; ?>&page=' + (nowpage+1),
			success: function(data){
				if(data.errormsg != null)
				{
				}else{
					nowpage++;
					var listarr = data.resultlist;
					var htmlstr = $('#resultlistdiv').html();
					if(listarr != null && listarr.length > 0 && listarr != '')
					{
						for(var i=0; i < listarr.length; i++)
						{
							htmlstr += "<div class='panel panel-default'><div class='panel-heading'><span class='label label-" + listarr[i].labelname + "'>" + listarr[i].typename + "</span><a class='panel-title' href='" + listarr[i].turl + "' target='_blank' class='list-group-item'>" + listarr[i].ttitle + "</a><span class='pull-right'>" + listarr[i].time + "</span></div><div class='panel-body'>" + listarr[i].tcontent + "</div></div>";
						}
						$('#resultlistdiv').html(htmlstr);
					}
				}
				console.log("search:" + data.teststring);
				loadingnext = false;
			},
			error: function(error){
				loadingnext = false;
			}});
}
$(window).scroll(function(){
	var divbottom = $('#resultlistdiv').offset().top + $('#resultlistdiv').height();
	//console.log(divbottom + "-" + $(window).scrollTop() + "-" + $(window).height());
	if(!loadingnext && divbottom - $(window).scrollTop() - $(window).height() < 50){
		loadingmorepage();
	}
});
</script>
<!--<pre>
<?php 
var_dump(wordsmodel::getkeywords("天津周边去哪里滑雪呢"));
var_dump(wordsmodel::getkeywords("12月天津周边去哪里自驾游比较好"));
var_dump(wordsmodel::getkeywords("四姑娘山游记攻略"));
$deepsearch = new searchengine();
$deepsearch->setmatchmode(SPH_MATCH_EXTENDED2);
var_dump($deepsearch->query("(四姑娘山 游记) | (四姑娘山 攻略) -求", searchengine::SEARCH_INDEX_THREAD_MAIN, 50));
echo "=======================[查天气]=======================";
$searchkey = "四姑娘山";
require_once libfile('class/weather');
var_dump(weather::getweather($searchkey));
?>
</pre>-->