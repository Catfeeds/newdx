<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_category', 'common/header');
0
|| checktplrefresh('./template/default/portal/portalcp_category.htm', './template/default/common/simplesearchform.htm', 1489800601, '2', './data/template/2_2_portal_portalcp_category.tpl.php', './template/8264', 'portal/portalcp_category')
|| checktplrefresh('./template/default/portal/portalcp_category.htm', './template/default/portal/portalcp_nav.htm', 1489800601, '2', './data/template/2_2_portal_portalcp_category.tpl.php', './template/8264', 'portal/portalcp_category')
;?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
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
<a href="portal.php"><?php echo $_G['setting']['navs']['1']['navname'];?></a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp">门户管理</a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp&amp;ac=index">频道栏目</a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp&amp;ac=category&amp;catid=<?php echo $cate['catid'];?>"><?php echo $cate['catname'];?></a>
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<form method="get" href="portal.php" class="pns mtm y">
<input type="hidden" name="mod" value="portalcp" />
<input type="hidden" name="ac" value="category" />
<input type="hidden" name="type" value="<?php echo $_GET['type'];?>" />
<input type="hidden" value="<?php echo $cate['catid'];?>" name="catid" />
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<input type="text" name="searchkey" class="px vm" value="<?php echo $_GET['searchkey'];?>" /> 
<button type="submit" value="true" class="pn vm"><em>搜索</em></button>
</form>
<h1 class="mt">
<a href="portal.php?mod=portalcp">频道栏目</a> - <?php echo $cate['catname'];?>
<?php if(empty($cate['disallowpublish']) && $allowpublish) { ?>&nbsp;&nbsp;<button onclick="window.location.href='portal.php?mod=portalcp&ac=article&catid=<?php echo $catid;?>';" class="pn vm" target="_blank"><em>新文章</em></button><?php } ?>
</h1>
<div class="bm bw0">
<!--ul class="tb cl">
<li <?php echo $typearr['all'];?>><a href="portal.php?mod=portalcp&amp;ac=category&amp;catid=<?php echo $cate['catid'];?>&amp;type=all">全部</a></li>
<li class="o y"><a href="portal.php?mod=portalcp&amp;ac=article&amp;catid=<?php echo $catid;?>" target="_blank">新文章</a></li>
</ul-->
<form name="articlelist" id="articlelist" action="portal.php?mod=portalcp&amp;ac=article&amp;op=batch" method="post" onsubmit="return checkPushSubmit(this);">
<input type="hidden" value="true" name="batchsubmit"/>
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash"/>
<input type="hidden" value="<?php echo $cate['catid'];?>" name="catid"/>
<table class="dt mtm">
<tr>
<th width="24">&nbsp;</th>
<th>文章标题</th>
<th>分类</th>
<th width="105">作者</th>
<th width="160">操作</th>
</tr><?php if(is_array($list)) foreach($list as $key => $value) { ?><tr>
<td><input type="checkbox" value="<?php echo $value['aid'];?>" name="aids[]" class="pc" /></td>
<td>
<a href="portal.php?mod=view&amp;aid=<?php echo $value['aid'];?>" title="<?php echo $value['title'];?>" target="_blank"><?php if($value['shorttitle']) { ?><?php echo $value['shorttitle'];?><?php } else { ?><?php echo $value['title'];?><?php } ?></a>
<?php if($value['taghtml']) { ?><em><?php echo $value['taghtml'];?></em><?php } if($value['status'] == 1) { ?><b>(待审核)</b><?php } if($value['status'] == 2) { ?><b>(已忽略)</b><?php } ?>
</td>
<td><?php echo $category[$value['catid']]['catname'];?></td>
<td>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="查看空间" target="_blank"><?php echo $value['username'];?></a>
<br /><span class="xs0 xg1"><?php echo $value['dateline'];?></span>
</td>
<td>
<?php if($value['allowmanage']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=edit&amp;aid=<?php echo $value['aid'];?>" target="_blank">编辑</a>
<?php if($value['status']>0) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=verify&amp;aid=<?php echo $value['aid'];?>" onclick="showWindow('articleverify', this.href, 'get', 0);" id="article_verify_<?php echo $value['aid'];?>">审核</a>
<?php } else { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=delete&amp;aid=<?php echo $value['aid'];?>" onclick="showWindow('articledelete', this.href, 'get', 0);" id="article_delete_<?php echo $value['aid'];?>">删除</a>
<?php } } if($_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock']) { ?>
<a href="portal.php?mod=portalcp&amp;ac=portalblock&amp;op=recommend&amp;idtype=aid&amp;id=<?php echo $value['aid'];?>" onclick="showWindow('recommend', this.href, 'get', 0)">模块推送</a>
<?php } if($value['allowmanage']) { if($value['stickstate'] > 0) { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=stick&amp;aid=<?php echo $value['aid'];?>&amp;stickstate=0&amp;currenturlEncode=<?php echo $_G['currenturl_encode'];?>"  id="article_stick_<?php echo $value['aid'];?>">取消置顶</a>
<?php } else { ?>
<a href="portal.php?mod=portalcp&amp;ac=article&amp;op=stick&amp;aid=<?php echo $value['aid'];?>&amp;stickstate=1&amp;currenturlEncode=<?php echo $_G['currenturl_encode'];?>"  id="article_stick_<?php echo $value['aid'];?>">置顶</a>
<?php } } ?>

</td>
</tr>
<?php } ?>
<tr>
<td colspan="5">
<input type="checkbox" onclick="checkall(this.form, 'aids')" class="pc" id="chkall" name="chkall" />
<label for="chkall">全选</label> &nbsp;&nbsp; 
<input type="radio" id="op_trash" class="pr" value="trash" name="optype"><label for="op_trash"> 放入回收站</label>&nbsp;&nbsp;
<input type="radio" id="op_delete" class="pr" value="delete" name="optype"><label for="op_delete"> 直接删除</label>&nbsp;&nbsp;
<button type="submit" value="true" class="pn vm"><em>提交</em></button>
</td>
</tr>
</table>
</form>
<?php if($multi) { ?><div class="pgs cl"><?php echo $multi;?></div><?php } ?>

</div>
</div>
<div class="appl"><div class="tbn">
<ul>
<?php if($_G['group']['allowauthorizedarticle'] || $_G['group']['allowmanagearticle']) { ?><li<?php if($ac == 'index' || $ac == 'category') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=index">频道栏目</a></li><?php } if($_G['group']['allowauthorizedblock'] || $_G['group']['allowdiy']) { ?>
<li<?php if($ac == 'portalblock' || $ac=='block') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=portalblock">模块管理</a></li>
<li<?php if($ac == 'blockdata') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=blockdata&amp;op=manage">推送审核</a></li>
<li><a href="portal.php?mod=portalcp&amp;ac=topic_block">新专题模块</a></li>
<?php } if(!$_G['inajax'] && !empty($_G['setting']['plugins']['portalcp'])) { if(is_array($_G['setting']['plugins']['portalcp'])) foreach($_G['setting']['plugins']['portalcp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } if(!empty($modsession->islogin)) { ?>
<li><a href="portal.php?mod=portalcp&amp;ac=logout">退出</a></li>
<?php } ?>
</ul>
</div>
</div>
</div>

<script type="text/javascript">
function checkPushSubmit(form){
var arr = [];
var checkbox = form.getElementsByTagName('input');
for(var i = 0; i<checkbox.length; i++){
if (checkbox[i].name == 'aids[]' && checkbox[i].checked) arr.push(checkbox[i].value);
}
if (arr.length == 0) {
alert('请选择要操作的文章');
return false;
}
if(!$('op_trash').checked && !$('op_delete').checked) {
alert('请选择要进行的操作');
return false;
}
return true;
}
</script><?php include template('common/footer'); ?>