<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_index', 'common/header');
0
|| checktplrefresh('./template/8264/portal/portalcp_index.htm', './template/default/common/simplesearchform.htm', 1489110078, '2', './data/template/2_2_portal_portalcp_index.tpl.php', './template/8264', 'portal/portalcp_index')
|| checktplrefresh('./template/8264/portal/portalcp_index.htm', './template/default/portal/portalcp_nav.htm', 1489110078, '2', './data/template/2_2_portal_portalcp_index.tpl.php', './template/8264', 'portal/portalcp_index')
;?><?php include template('common/header'); if($op == 'push') { if(!$_G['gp_is_uc']) { ?>
<h3 class="flb">
<em>生成文章</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>

<div class="c" style="width:260px; height: 300px; overflow: hidden; overflow-y: scroll;">
<p>选择一个频道分类：</p>
<?php if($categorytree) { ?>
<table class="mtw dt">
<?php echo $categorytree;?>
</table>
<?php } else { ?>
<p>您还未被授权管理任何频道栏目</p>
<?php } ?>
</div>
<script language="javascript">
function toggle_group(oid, obj, conf) {
obj = obj ? obj : $('a_'+oid);
if(!conf) {
var conf = {'show':'[-]','hide':'[+]'};
}
var obody = $(oid);
if(obody.style.display == 'none') {
obody.style.display = '';
obj.innerHTML = conf.show;
} else {
obody.style.display = 'none';
obj.innerHTML = conf.hide;
}
}
</script>
<?php } else { ?>
<div class="popbox w300">
<div class="flb">
<div class="popbox_title clearfix">
<span>生成文章</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div class="articlelist">
<span class="blue12">选择一个频道分类</span>
<div class="height400 sortlistonly">				
<?php if($categorytree) { ?>
<table>
<?php echo $categorytree;?>
</table>
<?php } else { ?>
<p>您还未被授权管理任何频道栏目</p>
<?php } ?>
</div>			
</div>
</div>
<script language="javascript">		
jQuery(function(){
//把[-]换成样式
jQuery("a[id^='a_group_']").each(function(){
if (jQuery(this).html() == '[-]') {
jQuery(this).html('').addClass('blueiconminus');
} else {
jQuery(this).html('').addClass('blueiconadd');
}
});

jQuery('.lastchildcat').addClass('childcat');
jQuery('.childcat').parent().parent().addClass('childList').hide();

jQuery(".cat").each(function(){
var tempnext = jQuery(this).parent().parent().next();
if (tempnext.find('.childcat').length > 0) {
jQuery(this).prepend('<i class="grayiconminus">&nbsp</i>');
}
});

jQuery(".grayiconminus").on("click", function(){
var thisObj = jQuery(this);
setTimeout(function(){
thisObj.addClass('grayiconadd').removeClass('grayiconminus');	
}, 10);
var nextObj = jQuery(this).parent().parent().parent().next();
while (nextObj.hasClass('childList')) {
    nextObj.show();
    nextObj = nextObj.next();
    if (nextObj.length == 0) {
    	break;
    }
}

});

jQuery(".cat").delegate(".grayiconadd","click",function(){				
var thisObj = jQuery(this);
setTimeout(function(){
thisObj.addClass('grayiconminus').removeClass('grayiconadd');
}, 10);				
var nextObj = jQuery(this).parent().parent().parent().next();
while (nextObj.hasClass('childList')) {
    nextObj.hide();
    nextObj = nextObj.next();
    if (nextObj.length == 0) {
    	break;
    }
}
});
});	

function toggle_group(oid, obj, conf) {
obj = obj ? obj : jQuery('#a_'+oid);
var obody = $(oid);
if(obj.hasClass('blueiconadd')) {
obody.style.display = '';		
obj.addClass('blueiconminus').removeClass('blueiconadd');
} else {
obody.style.display = 'none';			
obj.addClass('blueiconadd').removeClass('blueiconminus');
}			
}
</script>
<?php } } else { ?>
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
频道栏目
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<h1 class="mt">频道栏目</h1>
<div class="bm bw0">
<?php if($categorytree) { ?>
<table class="dt">
<tr>
<th>分类名称</th>
<th width="80">文章数</th>
<th width="120">操作</th>
</tr>
<?php echo $categorytree;?>
</table>
<?php } elseif(empty($_G['cache']['portalcategory'])) { ?>
<p>您还没有创建任何频道栏目</p>
<?php } else { ?>
<p>您还未被授权管理任何频道栏目</p>
<?php } ?>
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
<?php } include template('common/footer'); ?>