<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_article', 'common/header');
0
|| checktplrefresh('./template/default/portal/portalcp_article.htm', './template/default/common/simplesearchform.htm', 1506662263, '2', './data/template/2_2_portal_portalcp_article.tpl.php', './template/8264', 'portal/portalcp_article')
;?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />

<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script src="http://static.8264.com/static/js/webuploader.js" type="text/javascript"></script>

<?php if($op == 'delete') { ?>

<h3 class="flb">
<em>删除文章</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>

<form method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=article&amp;op=delete&amp;aid=<?php echo $_GET['aid'];?>">
<div class="c">
<?php if($_G['group']['allowpostarticlemod'] && $article['status'] == 1) { ?>
确认要删除此文章吗？
<input type="hidden" name="optype" value="0" class="pc" />
<?php } else { ?>
<label><input type="radio" name="optype" value="0" class="pc" /> 直接删除</label>&nbsp;&nbsp;&nbsp;
<label><input type="radio" name="optype" value="1" class="pc" checked="checked" /> 放入回收站</label>
<?php } ?>
</div>
<p class="o pns">
<button type="submit" name="btnsubmit" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
<input type="hidden" name="aid" value="<?php echo $_GET['aid'];?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
<?php } elseif($op == 'verify') { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">审核文章</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>

<form method="post" autocomplete="off" id="aritcle_verify_<?php echo $aid;?>" action="portal.php?mod=portalcp&amp;ac=article&amp;op=verify&amp;aid=<?php echo $aid;?>">
<div class="c">
<input type="radio" class="pr" name="status" value="0" id="status_0"<?php if($article['status']=='1') { ?> checked<?php } ?> /><label for="status_0">通过</label>&nbsp;
<input type="radio" class="pr" name="status" value="-1" id="status_x" /><label for="status_x">删除</label>&nbsp;
<input type="radio" class="pr" name="status" value="2" id="status_2"<?php if($article['status']=='2') { ?> checked<?php } ?> /><label for="status_2">忽略</label>
</div>
<p class="o pns">
<button type="submit" name="btnsubmit" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
<input type="hidden" name="aid" value="<?php echo $aid;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="verifysubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
<?php } elseif($op == 'related') { if($ra) { ?>
<li id="raid_li_<?php echo $ra['aid'];?>"><input type="hidden" name="raids[]" value="<?php echo $ra['aid'];?>" size="5">[ <?php echo $ra['aid'];?> ] <a href="portal.php?mod=view&amp;aid=<?php echo $ra['aid'];?>" target="_blank"><?php echo $ra['title'];?></a> <a href="javascript:;" onclick="raid_delete(<?php echo $ra['aid'];?>);">删除</a></li>
<?php } } elseif($op == 'pushplus') { ?>
<h3 class="flb">
<em>文章连载</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form method="post" target="_blank" action="portal.php?mod=portalcp&amp;ac=article&amp;tid=<?php echo $tid;?>&amp;aid=<?php echo $aid;?>">
<div class="c">
<b><?php echo $pushcount;?></b> 个新帖将添加到文章连载。<a href="portal.php?mod=view&amp;aid=<?php echo $aid;?>" target="_blank" class="xi2">(查看文章)</a>
<?php if($pushedcount) { ?><br />提示：<?php echo $pushedcount;?> 个帖子已经在连载中了<?php } ?>
<div id="pushplus_list"><?php if(is_array($pids)) foreach($pids as $pid) { ?><input type="hidden" name="pushpluspids[]" value="<?php echo $pid;?>" />
<?php } ?>
</div>
</div>
<p class="o pns">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="pushplussubmit" value="1" />

<input type="hidden" name="toedit" value="1" />
<button type="submit" class="pn pnc vm"><span>提交</span></button>
</p>
</form>
<?php } else { ?>

<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="搜索本版">搜索本版</label></li>
EOF;
?><?php } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="搜索文章">文章</label></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="搜索日志">日志</label></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="搜索相册">相册</label></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="搜索用户">用户</label></li>
EOF;
?>
<?php if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?php echo $_G['siteurl'];?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="<?php echo $_G['setting']['navs']['1']['filename'];?>"><?php echo $_G['setting']['navs']['1']['navname'];?></a> <em>&rsaquo;</em>
<a href="<?php echo $cate['caturl'];?>"><?php echo $cate['catname'];?></a> <em>&rsaquo;</em>
<?php if(!empty($aid)) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;aid=<?php echo $article['aid'];?>">编辑文章</a>
<?php } else { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;catid=<?php echo $catid;?>">发布文章</a>
<?php } ?>
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn" style="float: left;">
<div class="bm bw0">
<h1 class="mt"><?php if(!empty($aid)) { ?>编辑文章<?php } else { ?>发布文章<?php } ?></h1>
<script src="http://static.8264.com/static/js/calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<form method="post" autocomplete="off" id="articleform" action="portal.php?mod=portalcp&amp;ac=article<?php if($_G['gp_modarticlekey']) { ?>&amp;modarticlekey=<?php echo $_G['gp_modarticlekey'];?><?php } ?>" enctype="multipart/form-data">
<?php if(!empty($_G['setting']['pluginhooks']['portalcp_top'])) echo $_G['setting']['pluginhooks']['portalcp_top']; ?>
<div class="pbn">
<input type="text" class="px p_fre" id="title" name="title" value="<?php echo $article['title'];?>" size="80" />
</div>
<div class="exfm pns cl">
<div class="sinf sppoll z">
<?php if(empty($article['aid']) || $article['catid']==842 || $article['catid']==878 || $article['catid']==880 ||
                                                    $article['catid']==881 || $article['catid']==871 || $article['catid']==886 ||$article['catid']==887 ||$article['catid']==888
      ||$article['catid']==890 ||$article['catid']==891 ||$article['catid']==892 ||$article['catid']==893 ||$article['catid']==894 ||$article['catid']==895
      ||$article['catid']==896 ||$article['catid']==897 ||$article['catid']==898 ||$article['catid']==899 ||$article['catid']==900 ||$article['catid']==901 || $article['catid']==912) { ?>
<dl>
<dt>自动获取</dt>
<dd>
<span class="ftid">
<select name="from_idtype" id="from_idtype" class="ps">
<option value="tid"<?php echo $idtypes['tid'];?>>帖子 tid</option>
<option value="blogid"<?php echo $idtypes['blogid'];?>>日志 id</option>
</select>
</span>
<script type="text/javascript">simulateSelect('from_idtype');</script>
<input type="text" name="from_id" id="from_id" value="<?php if($article['id']) { ?><?php echo $article['id'];?><?php } else { ?><?php echo $_GET['from_id'];?><?php } ?>" size="8" class="px p_fre vm" />&nbsp;
<button type="button" name="from_button" class="pn vm" onclick="return from_get();"><em>获取</em></button>
<input type="hidden" name="id" value="<?php echo $_GET['from_id'];?>" />
<input type="hidden" name="idtype" value="<?php echo $_GET['from_idtype'];?>" />
</dd>
</dl>
<?php } ?>
<dl>
<dt>跳转URL</dt>
<dd><input type="text" class="px p_fre" name="url" value="<?php echo $article['url'];?>" size="30" /></dd>
</dl>
<dl>
<dt>原作者</dt>
<dd><input type="text" name="author" class="px p_fre" value="<?php echo $article['author'];?>" size="30" /></dd>
</dl>

<?php if($catid==867 || ($catid >= 958 && $catid <= 965) ) { ?>
<dl>
<dt>领券链接</dt>
<dd><input type="text" class="px p_fre" name="couponurl" value="<?php echo $article['couponurl'];?>" size="30" /></dd>
</dl>
<?php } if($article['aid']) { ?>
<dl>
<dt>分页管理</dt>
<dd>
<span class="z">保存为第 <?php echo $pageselect;?> 页</span>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=addpage&amp;aid=<?php echo $aid;?>" class="y">添加新分页</a>
<?php if($article_content) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=delpage&amp;aid=<?php echo $aid;?>&amp;cid=<?php echo $article_content['cid'];?>" class="y" style="padding-right:10px;">删除分页</a>
<?php } else { ?>
<a href="javascript:history.back();" class="y" style="padding-right:10px;">删除分页</a>
<?php } ?>
<a href=""></a>
<div class="pgm cl"><?php echo $multi;?></div>
</dd>
</tr>
<?php } ?>
</div>
<div class="sadd z">
<dl>
<dt>文章来源</dt>
<dd><input type="text" name="from" class="px p_fre" value="<?php echo $article['from'];?>" size="30" /></dd>
</dl>
<dl>
<dt>来源地址</dt>
<dd><input type="text" name="fromurl" class="px p_fre" value="<?php echo $article['fromurl'];?>" size="30" /></dd>
</dl>
                        <dl>
<dt>发布时间</dt>
<dd><input type="text" name="dateline" class="px p_fre" value="<?php echo $article['dateline'];?>" size="30" onclick="showcalendar(event, this, true)" /></dd>
</dl>
<?php if($catid==867 || ($catid >= 958 && $catid <= 965) ) { ?>
<dl>
<dt>购买链接</dt>
<dd><input type="text" class="px p_fre" name="buyurl" value="<?php echo $article['buyurl'];?>" size="30" /></dd>
</dl>
<?php } ?>
<div><input type="hidden" id="conver" name="conver" value="" /><input type="hidden" id="mconver" name="mconver" value="" /></div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['portalcp_extend'])) echo $_G['setting']['pluginhooks']['portalcp_extend']; ?>
</div>

<div class="pbw">
<script src="http://static.8264.com/static/image/editor/editor_function.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<textarea class="userData" name="content" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"><?php echo $article_content['content'];?></textarea>
<iframe src="home.php?mod=editor&amp;charset=<?php echo CHARSET;?>&amp;allowhtml=1&amp;isportal=1" name="uchome-ifrHtmlEditor" id="uchome-ifrHtmlEditor" scrolling="no" border="0" frameborder="0" style="width:808px;height:400px;border: 1px solid #C5C5C5;"></iframe>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['portalcp_middle'])) echo $_G['setting']['pluginhooks']['portalcp_middle']; ?>

<div class="bm bml">
<div class="bm_h cl">
<h2>摘要</h2>
</div>
<div class="bm_c"><textarea name="summary" cols="80" class="pt" style="width: 846px; w\idth: 744px;"><?php echo $article['summary'];?></textarea></div>
</div>

<div class="bm bml">
<div class="bm_h cl">
<h2>聚合标签</h2>
</div>
<div class="bm_c"><?php if(is_array($article_tags)) foreach($article_tags as $key => $tag) { ?><input type="checkbox" name="tag[<?php echo $key;?>]" id="article_tag_<?php echo $key;?>" class="pc"<?php if($article_tags[$key]) { ?> checked="checked"<?php } ?> />
<label for="article_tag_<?php echo $key;?>"><?php echo $tag_names[$key];?></label>
&nbsp;&nbsp;
<?php } ?>
</div>
</div>

<?php if($page<2 && $op != 'addpage') { ?>
<div class="exfm">
<h2>添加相关文章 <a id="related_article" href="portal.php?mod=portalcp&amp;ac=related&amp;catid=<?php echo $catid;?>&amp;aid=<?php echo $aid;?>" class="xi2" style="text-decoration: underline;" onclick="showWindow(this.id, this.href, 'get', 0)">选择</a></h2>
<ul id="raid_div" class="xl">
<?php if($article['related']) { if(is_array($article['related'])) foreach($article['related'] as $ra) { ?><li id="raid_li_<?php echo $ra['aid'];?>"><input type="hidden" name="raids[]" value="<?php echo $ra['aid'];?>" size="5"><a href="portal.php?mod=view&amp;aid=<?php echo $ra['aid'];?>" target="_blank"><?php echo $ra['title'];?></a> (文章 ID: <?php echo $ra['aid'];?>) <a href="javascript:;" onclick="raid_delete(<?php echo $ra['aid'];?>);" class="xg1">删除</a></li>
<?php } } ?>
</ul>
</div>
<?php } ?>

<div class="exfm">
<h2>添加相关关建字 <a id="related_keywords" href="plugin.php?id=searchindex:assignkeywords" class="xi2" style="text-decoration: underline;" onclick="showWindow(this.id, this.href, 'get', 0)">选择</a></h2>
<ul id="keyword_div" class="xl">
<?php if($article['keyword']) { if(is_array($article['keyword'])) foreach($article['keyword'] as $ra) { ?><li id="keyword_li_<?php echo $ra['searchid'];?>"><input type="hidden" name="keywords[]" value="<?php echo $ra['searchid'];?>" size="5"><a href="portal.php?mod=view&amp;aid=<?php echo $ra['aid'];?>" target="_blank"><?php echo $ra['keywords'];?></a> (关键字ID: <?php echo $ra['searchid'];?>) <a href="javascript:;" onclick="keyword_delete(<?php echo $ra['searchid'];?>);" class="xg1">删除</a></li>
<?php } } ?>
</ul>
</div>
<script type="text/javascript">
function keyword_add() {
var raid = $('raid').value;
if($('keyword_li_'+raid)) {
alert('该文章已经添加过了');
return false;
}
var url = 'portal.php?mod=portalcp&ac=article&op=related&inajax=1&aid=<?php echo $article['aid'];?>&raid='+raid;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$('keyword_div').innerHTML += s;
} else {
alert('没有找到指定的文章');
return false;
}
});
}
function keyword_delete(aid) {
var node = $('keyword_li_'+aid);
var p;
if(p = node.parentNode) {
p.removeChild(node);
}
}
</script>

<?php if(!empty($_G['setting']['pluginhooks']['portalcp_bottom'])) echo $_G['setting']['pluginhooks']['portalcp_bottom']; if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="exfm pns"><?php include template('common/seccheck'); ?></div>
<?php } ?>

<div class="ptm pbm">
<button type="button" id="issuance" class="pn pnc" name="articlebutton" onclick="validate(this);"><strong>提交</strong></button>
<label><input type="checkbox" name="addpage" value="1" class="pc"> 保存后继续添加新分页</label>
<?php if($cate['allowcomment']) { ?><span class="pipe">|</span><label for="ck_allowcomment"><input type="checkbox" name="forbidcomment" id="ck_allowcomment" class="pc" value="1"<?php if(isset($article['allowcomment']) && empty($article['allowcomment'])) { ?>checked="checked"<?php } ?> /> 禁止对本文章发表评论</label><?php } ?>
</div>

<input type="hidden" id="aid" name="aid" value="<?php echo $article['aid'];?>" />
<input type="hidden" name="catid" id="catid" value="<?php echo $catid;?>" />
<input type="hidden" name="cid" value="<?php echo $article_content['cid'];?>" />
<input type="hidden" id="attach_ids" name="attach_ids" value="0" />
<input type="hidden" name="articlesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
</div>
</div>
<div class="appl" style="float: right; margin-top: 45px; border: none; background-color: transparent;">
<h3 class="mbm pbm bbs">上传附件</h3>
<div class="pbm xg1">为当前文章上传图片、文件附件资源。<br>上传完毕后，需要插入到文章内容中才可以显示。</div>
<div class="error_tips"></div>
<div id="attachbodyhidden">
<input id="url_action" value="<?php echo $action;?>" type="hidden">
<input id="url_policy" value="<?php echo $policy;?>" type="hidden">
<input id="url_signature" value="<?php echo $sign;?>" type="hidden">
<input id="catid" value="<?php echo $catid;?>" type="hidden">

<div id="filePicker">选择文件</div>
</div>
<div id="attachbody" class="bn"></div>

<script src="/static/js/portal_upload.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<iframe id="uploadframe" name="uploadframe" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank"></iframe>

<div id="attach_image_body" class="bn"><?php echo $article['attach_image'];?></div>
<div id="attach_file_body" class="bn"><?php echo $article['attach_file'];?></div>

<table id="table_img" width="100%" class="xi2" style="display:none;">
<td width="50" class="bbs list_img">
<a href=" " target="_blank"><img src=" " width="40" height="40" style="display:none;"></a>
</td>
<td class="bbs">
<label for="setconver"><input type="radio" name="setconver" id="setconver" class="pr" value="1" onclick="">设为封面</label><br>
<label for="setmconver"><input type="radio" name="setmconver" id="setmconver" class="pr" value="1" onclick="">手机封面</label><br>
<a href="javascript:void(0);" onclick="" class="insert_small">插入小图</a><br>
<a href="javascript:void(0);" onclick="" class="insert_large">插入大图</a><br>
<a href="javascript:void(0);" onclick="" class="delete_img">删除</a>
</td>
</table>

<table id="table_file" width="100%" style="display:none;">
<tr class="list_file">
<td><a href=" " target="_blank"></a></td>
</tr>
<tr class="insert_file">
<td>
<a href="javascript:void(0);" onclick="">插入文件</a><br>
<a href="javascript:void(0);" onclick="">删除</a>
</td>
</tr>
</table>

<script src="/static/js/webuploader_portalcp_article.js?<?php echo VERHASH;?>" type="text/javascript"></script>

</div>
</div>

<style>
.webuploader-container {
position: relative;
}
.webuploader-element-invisible {
position: absolute !important;
clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
position: relative;
display: inline-block;
cursor: pointer;
background: #00b7ee;
padding: 4px 15px;
font-size: 14px;
color: #fff;
text-align: center;
width:85px;
border-radius: 3px;
overflow: hidden;
}
.webuploader-pick-hover {
background: #00a2d4;
}

.webuploader-pick-disable {
opacity: 0.6;
pointer-events:none;
}

</style>


<script type="text/javascript">
function from_get() {
var el = $('catid');
var catid = el ? el.value : 0;
window.location.href='portal.php?mod=portalcp&ac=article&from_idtype='+$('from_idtype').value+'&catid='+catid+'&from_id='+$('from_id').value;
return true;
}
function validate(obj) {
var title = $('title');
if(title) {
var slen = strlen(title.value);
if (slen < 1 || slen > 80) {
alert("标题长度(1~80字符)不符合要求");
title.focus();
return false;
}
}
var catObj = $("catid");
if(catObj) {
if (catObj.value < 1) {
alert("请选择系统分类");
catObj.focus();
return false;
}
}
edit_save();
obj.form.submit();
return false;
}
function raid_add() {
var raid = $('raid').value;
if($('raid_li_'+raid)) {
alert('该文章已经添加过了');
return false;
}
var url = 'portal.php?mod=portalcp&ac=article&op=related&inajax=1&aid=<?php echo $article['aid'];?>&raid='+raid;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$('raid_div').innerHTML += s;
} else {
alert('没有找到指定的文章');
return false;
}
});
}
function raid_delete(aid) {
var node = $('raid_li_'+aid);
var p;
if(p = node.parentNode) {
p.removeChild(node);
}
}
if($('title')) {
$('title').focus();
}
</script>

<?php } include template('common/footer'); ?>