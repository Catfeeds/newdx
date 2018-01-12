<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portal', 'search/header');
0
|| checktplrefresh('./template/default/search/portal.htm', './template/default/search/header.htm', 1505852792, '2', './data/template/2_2_search_portal.tpl.php', './template/8264', 'search/portal')
|| checktplrefresh('./template/default/search/portal.htm', './template/default/search/pubsearch.htm', 1505852792, '2', './data/template/2_2_search_portal.tpl.php', './template/8264', 'search/portal')
|| checktplrefresh('./template/default/search/portal.htm', './template/default/search/portal_list.htm', 1505852792, '2', './data/template/2_2_search_portal.tpl.php', './template/8264', 'search/portal')
|| checktplrefresh('./template/default/search/portal.htm', './template/default/search/footer.htm', 1505852792, '2', './data/template/2_2_search_portal.tpl.php', './template/8264', 'search/portal')
|| checktplrefresh('./template/default/search/portal.htm', './template/8264/common/header_common.htm', 1505852792, '2', './data/template/2_2_search_portal.tpl.php', './template/8264', 'search/portal')
;?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="apple-itunes-app" content="app-id=492167976">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link rel="dns-prefetch" href="http://stats.8264.com/">
<title>
<?php if(isset($forumOption)) { ?><?php $forumOption->initPageTitle(); } if($pageTitle) { ?><?php echo $pageTitle; } elseif($_G['basescript']=='portal' && $_G['gp_mod']=='list' && $metakeywords && $_G['catid']!=874 ) { if($_G['catid']==878) { ?>
户外美女图片_驴友图片_最健康的户外美女照片
<?php } else { ?>
            <?php echo $metakeywords;?>
            <?php if($_G['setting']['bbname']) { ?> - <?php echo $_G['setting']['bbname'];?><?php } } } else { ?>
            <?php if($_GET['do']=="produce"&&$_G['uid']) { ?>
               <?php echo $navtitle;?><?php echo "的装备分享"; ?>             <?php } elseif($_G['basescript']=='group') { if($_G['uid']) { ?>
<?php echo $navtitle;?>
<?php } else { ?><?php $navtitle ='群组 - 8264'; ?><?php echo $navtitle;?>
<?php } } else { ?><?php $navtitle = preg_replace('/的记录/', '的微博', $navtitle); if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?><?php } ?>
            <?php } } ?>
</title>
<?php echo $_G['setting']['seohead'];?>
    <meta name="keywords" content="<?php if(!empty($metakeywords)) { ?> <?php echo htmlspecialchars($metakeywords, ENT_COMPAT | ENT_HTML401, GB2312); ?> <?php } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { ?> <?php echo htmlspecialchars($metadescription, ENT_COMPAT | ENT_HTML401, GB2312); ?>,<?php echo $_G['setting']['bbname'];?> <?php } ?>" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<?php if($_G['basescript']=='portal') { if($_G['gp_mod']=='list') { if($_G['catid'] == '849') { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/topic">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/list/<?php echo $_G['catid'];?>">
<?php } } elseif($_G['gp_aid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/viewnews-<?php echo $_G['gp_aid'];?>-page-1.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/">
<?php } } elseif($_G['basescript']=='forum') { if($_G['gp_mod']=='viewthread' && $_G['tid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/thread-<?php echo $_G['tid'];?>-<?php echo $page;?>.html">
<?php } elseif($_G['fid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/bbs-<?php echo $_G['fid'];?>-1.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/bbs">
<?php } ?>
        <?php } elseif($_G['basescript']=='dianping') { if($_G['url_mod'] && $_G['tid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/<?php echo $_G['url_mod'];?>/<?php echo $_G['tid'];?>.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/<?php echo $_G['url_mod'];?>/">
<?php } } if(isset($forumOption)) { ?><?php $flag = $forumOption->getSiteUrlbyUrl($_G['siteurl']); if(($flag==1)) { ?><?php $_G['siteurl'] = "http://bbs.8264.com/"; } else { ?><?php $_G['siteurl'] = $_G['siteurl']; } } ?>
<base href="<?php echo $_G['siteurl'];?>" />
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/common.css?<?php echo VERHASH;?>" />
<script type="text/javascript">
var STYLEID = '<?php echo STYLEID;?>',
STATICURL = '<?php echo STATICURL;?>',
IMGDIR = 'http://static.8264.com/static/image/common',
VERHASH = '<?php echo VERHASH;?>',
charset = '<?php echo CHARSET;?>',
discuz_uid = '<?php echo $_G['uid'];?>',
cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>',
cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>',
cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',
showusercard = '<?php echo $_G['setting']['showusercard'];?>',
attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>',
disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',
creditnotice = '<?php if($_G['setting ']['creditnotice ']) { ?><?php echo $_G;?>['setting ']['creditnames ']<?php } ?>',
defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>',
REPORTURL = '<?php echo $_G['currenturl_encode'];?>',
SITEURL = '<?php echo $_G['siteurl'];?>';
</script>
<script src="http://static.8264.com/static/js/common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
/* 头部广告文字 */
.textAdBox { float: left; width: 978px; border: 1px solid #f0f0f0; border-bottom: 0 none; overflow: hidden; }
.textAdBox ul { float: left; width: 100%; margin-left: -1px; }
.textAdBox ul li { float: left; width:20%; padding: 4px 0; border-bottom: 1px solid #f0f0f0; }
.textAdBox a { display: block; font-size:12px; line-height:24px; font-family: "Microsoft Yahei"; height: 24px; color: #585858; text-align: center; border-left: 1px dashed #d6d6d6; overflow: hidden; }
.textAdBox a:hover { color: #162833; }
.textAdBox .cRed,
.textAdBox .cRed:hover { color: #ff0000; }
.layout:after,
.hd:after,
.bd:after,
.ft:after,
.layoutLeft:after,
.layoutRight:after,
.w980:after { content: ""; display: block; clear: both; visibility: hidden; }
.layout,
.hd,
.bd,
.ft,
.layoutLeft,
.layoutRight,
.w980 { zoom: 1; }
/* 论坛首页 Start */
.layout { width: 980px; margin: 0 auto; }
.layoutLeft { float: left; display: inline; width: 660px; }
.layoutRight { float: right; display: inline; width: 260px; }
.w980 { width: 980px; margin: 0 auto; }
.oldad .textAdBox{width: 100%;}
.wp .oldad{width: 98%;}

/* 头部广告文字 */
.a_t #textadbox_old { border: 1px solid #cdcdcd; border-bottom: 0 none; overflow: hidden; width:100%; float:none;}
.a_t #textadbox_old ul {  width: 100%; margin-left: -1px; }
.a_t #textadbox_old ul li { float: left; width: 20%; padding:0px; border-bottom: 1px solid #cdcdcd }
.a_t #textadbox_old a { display: block; font: 14px; font-family: Tahoma,Helvetica,SimSun,sans-serif,Hei; height: 28px; color: #333; text-align: center; border-left: 1px solid #cdcdcd; overflow: hidden; line-height: 28px;}
.a_t #textadbox_old a:hover { color: #162833; }
.a_t #textadbox_old .cRed,
.a_t #textadbox_old .cRed:hover { color: #ff0000; }
</style>
</head>

<body id="nv_search" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<div id="hd">
<div class="bbs cl">
<div class="z">
<span id="navs" class="xg1 showmenu" onmouseover="showMenu(this.id);"><a href="./">返回首页</a></span>
</div>
<div class="sch y">
<p>
<?php if($_G['uid']) { ?>
<strong><a href="home.php?mod=space" class="vwmy" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a></strong>
<?php if($_G['group']['allowinvisible']) { ?><span id="loginstatus" class="xg1"><a href="member.php?mod=switchstatus" title="切换在线状态" onclick="ajaxget(this.href, 'loginstatus');doane(event);"><?php if($_G['session']['invisible']) { ?>隐身<?php } else { ?>在线<?php } ?></a></span><?php } ?>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=home">我的中心</a>
<span class="xg1"><a href="home.php?mod=spacecp">设置</a></span>

<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>提醒<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?></a><span id="myprompt_check"></span>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>短消息<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>

<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?><span class="pipe">|</span><a href="portal.php?mod=portalcp">门户管理</a><?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?><span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a><?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?><span class="pipe">|</span><a href="admin.php" target="_blank">管理中心</a><?php } ?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser" class="noborder"><?php echo $_G['cookie']['loginuser'];?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);hideWindow('register');">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } else { ?>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href);hideWindow('login');" class="noborder"><?php echo $_G['setting']['reglinkname'];?></a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);hideWindow('register');">登录</a>
<?php } ?>
</p>
</div>
</div>
</div>
<?php if(!empty($_G['setting']['plugins']['jsmenu'])) { ?>
<ul class="p_pop h_pop" id="plugin_menu" style="display: none"><?php if(is_array($_G['setting']['plugins']['jsmenu'])) foreach($_G['setting']['plugins']['jsmenu'] as $module) { ?>     <?php if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?>
     <li><?php echo $module['url'];?></li>
     <?php } } ?>
</ul>
<?php } ?>
<?php echo $_G['setting']['menunavs'];?>

<?php if($_G['setting']['navs']) { ?>
<ul class="p_pop h_pop" id="navs_menu" style="display: none"><?php if(is_array($_G['setting']['navs'])) foreach($_G['setting']['navs'] as $nav) { ?><?php $nav_showmenu = strpos($nav['nav'], 'onmouseover="showMenu('); ?>    <?php $nav_navshow = strpos($nav['nav'], 'onmouseover="navShow(') ?>    <?php if($nav_hidden !== false || $nav_navshow !== false) { ?><?php $nav['nav'] = preg_replace("/onmouseover\=\"(.*?)\"/i", '',$nav['nav']) ?>    <?php } if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?><li <?php echo $nav['nav'];?>></li><?php } } ?>
</ul>
<?php } ?><div id="ct" class="w">
<form class="searchform" method="post" autocomplete="off" action="search.php?mod=portal">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" /><?php $keywordenc = $keyword ? rawurlencode($keyword) : ''; if($searchid || ($_G['gp_adv'] && $checkarray['posts'] && CURMODULE == 'forum')) { ?>	
<table id="tpsch" class="mbm" cellspacing="0" cellpadding="0">
<tr>
<td><h1><a href="./" title="<?php echo $_G['setting']['bbname'];?>"><?php echo BOARDLOGO;?></a></h1></td>
<td>
<ul class="tb cl">
<?php if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li
EOF;
 if(CURMODULE == 'portal') { 
$slist[portal] .= <<<EOF
 class="a"
EOF;
 } 
$slist[portal] .= <<<EOF
><a href="search.php?mod=portal
EOF;
 if($keyword) { 
$slist[portal] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[portal] .= <<<EOF
">文章</a></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li
EOF;
 if(CURMODULE == 'forum') { 
$slist[forum] .= <<<EOF
 class="a"
EOF;
 } 
$slist[forum] .= <<<EOF
><a href="search.php?mod=forum
EOF;
 if($keyword) { 
$slist[forum] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[forum] .= <<<EOF
">{$_G['setting']['navs']['2']['navname']}</a></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li
EOF;
 if(CURMODULE == 'blog') { 
$slist[blog] .= <<<EOF
 class="a"
EOF;
 } 
$slist[blog] .= <<<EOF
><a href="search.php?mod=blog
EOF;
 if($keyword) { 
$slist[blog] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[blog] .= <<<EOF
">日志</a></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li
EOF;
 if(CURMODULE == 'album') { 
$slist[album] .= <<<EOF
 class="a"
EOF;
 } 
$slist[album] .= <<<EOF
><a href="search.php?mod=album
EOF;
 if($keyword) { 
$slist[album] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[album] .= <<<EOF
">相册</a></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li
EOF;
 if(CURMODULE == 'group') { 
$slist[group] .= <<<EOF
 class="a"
EOF;
 } 
$slist[group] .= <<<EOF
><a href="search.php?mod=group
EOF;
 if($keyword) { 
$slist[group] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[group] .= <<<EOF
">{$_G['setting']['navs']['3']['navname']}</a></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li
EOF;
 if(CURMODULE == 'user') { 
$slist[user] .= <<<EOF
 class="a"
EOF;
 } 
$slist[user] .= <<<EOF
><a href="search.php?mod=user
EOF;
 if($keyword) { 
$slist[user] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[user] .= <<<EOF
">用户</a></li>
EOF;
?><?php echo implode("", $slist);; ?></ul>
<table id="tps_form" cellspacing="0" cellpadding="0">
<tr>
<td>
<input type="text" id="srchtxt" name="srchtxt" class="schtxt" size="45" maxlength="40" value="<?php echo $keyword;?>" tabindex="1" />
<script type="text/javascript">$('srchtxt').focus();</script>
</td>
<td>
<input type="hidden" name="searchsubmit" value="yes" />
<button type="submit" id="tps_btn" class="schbtn"><strong>搜索</strong></button>
</td>
<?php if(CURMODULE == 'forum') { ?>
<td style="padding-left: 10px; background: #FFF;">
<?php if(($_G['group']['allowsearch'] & 32)) { ?><label><input type="checkbox" name="srchtype" class="pc" value="fulltext" <?php echo $fulltextchecked;?>/> 全文</label><br /><?php } if($checkarray['posts']) { if(!$_G['gp_adv']) { ?>
<a href="search.php?mod=forum&amp;adv=yes">高级</a>
<?php } else { ?>
<a href="search.php?mod=forum">返回普通搜索</a>
<?php } } ?>
</td>
<?php } ?>
</tr>
</table>
</td>
</tr>
</table>
<?php if($_G['gp_adv']) { ?>
<div id="search_option">
<h2 class="mt">搜索选项</h2>
<table summary="搜索" cellspacing="0" cellpadding="0" class="tfm">
<?php if($srchtype == 'threadsort') { ?>
<tr>
<th><label for="typeid">分类信息</label></th>
<td>
<select name="sortid" onchange="ajaxget('forum.php?mod=post&action=threadsorts&sortid='+this.options[this.selectedIndex].value+'&operate=1', 'threadsorts', 'threadsortswait')">
<option value="0">无</option><?php echo $threadsorts;?>
</select>
<span id="threadsortswait"></span>
</td>
</tr>
<tbody id="threadsorts"></tbody>
<?php } if($checkarray['posts'] || $srchtype == 'trade') { ?>
<tr>
<th>作者</th>
<td><input type="text" id="srchname" name="srchuname" size="25" maxlength="40" class="px" value="<?php echo $srchuname;?>" /></td>
</tr>

<tr>
<th>主题范围</th>
<td>
<label><input type="radio" class="pr" name="srchfilter" value="all" checked="checked" /> 全部主题</label>
<label><input type="radio" class="pr" name="srchfilter" value="digest" /> 精华主题</label>
<label><input type="radio" class="pr" name="srchfilter" value="top" /> 置顶主题</label>
</td>
</tr>
<?php } if($checkarray['posts']) { ?>
<tr>
<th>特殊主题</th>
<td>
<label><input type="checkbox" class="pc" name="special[]" value="1" /> 投票主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="2" /> 商品主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="3" /> 悬赏主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="4" /> 活动主题</label>
<label><input type="checkbox" class="pc" name="special[]" value="5" /> 辩论主题</label>
</td>
</tr>
<?php } if($checkarray['posts'] || $srchtype == 'trade') { ?>
<tr>
<th><label for="srchfrom">搜索时间</label></th>
<td>
<select id="srchfrom" name="srchfrom">
<option value="0">全部时间</option>
<option value="86400">1 天</option>
<option value="172800">2 天</option>
<option value="604800">1 周</option>
<option value="2592000">1 个月</option>
<option value="7776000">3 个月</option>
<option value="15552000">6 个月</option>
<option value="31536000">1 年</option>
</select>
<label><input type="radio" class="pr" name="before" value="" checked="checked" /> 以内</label>
<label><input type="radio" class="pr" name="before" value="1" /> 以前</label>
</td>
</tr>

<tr>
<th><label for="orderby">排序类型</label></th>
<td>
<select id="orderby1" name="orderby">
<option value="lastpost" selected="selected">回复时间</option>
<option value="dateline">发布时间</option>
<option value="replies">回复数量</option>
<option value="views">浏览次数</option>
</select>
<select id="orderby2" name="orderby" style="position: absolute; display: none" disabled>
<option value="dateline" selected="selected">发布时间</option>
<option value="price">商品价格</option>
<option value="expiration">剩余时间</option>
</select>
<label><input type="radio" class="pr" name="ascdesc" value="asc" /> 按升序排列</label>
<label><input type="radio" class="pr" name="ascdesc" value="desc" checked="checked" /> 按降序排列</label>
</td>
</tr>
<?php } ?>

<tr>
<th valign="top"><label for="srchfid">搜索范围</label></th>
<td>
<select id="srchfid" name="srchfid[]" multiple="multiple" size="10" style="width: 26em;">
<option value="all"<?php if(!$srchfid) { ?> selected="selected"<?php } ?>>全部版块</option>
<?php echo $forumselect;?>
</select>
</td>
</tr>

<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="searchsubmit" value="yes" />
<button type="submit" class="pn pnc"><strong>搜索</strong></button>
</td>
</tr>
</table>
<?php if(empty($srchtype) && empty($keyword)) { ?>
<div class="bm bw0">
<h3>便捷搜索</h3>
<table cellspacing="4" cellpadding="0" width="100%">
<tr>
<td><a href="search.php?mod=forum&amp;srchfrom=3600&amp;searchsubmit=yes">1 小时以内的新帖</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=14400&amp;searchsubmit=yes">4 小时以内的新帖</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=28800&amp;searchsubmit=yes">8 小时以内的新帖</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=86400&amp;searchsubmit=yes">24 小时以内的新帖</a></td>
</tr>
<tr>
<td><a href="search.php?mod=forum&amp;srchfrom=604800&amp;searchsubmit=yes">1 周内帖子</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=2592000&amp;searchsubmit=yes">1 月内帖子</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=15552000&amp;searchsubmit=yes">6 月内帖子</a></td>
<td><a href="search.php?mod=forum&amp;srchfrom=31536000&amp;searchsubmit=yes">1 年内帖子</a></td>
</tr>
</table>
</div>
<?php } ?>
</div>
<?php } } else { if(!empty($srchtype)) { ?><input type="hidden" name="srchtype" value="<?php echo $srchtype;?>" /><?php } if($srchtype != 'threadsort') { ?>
<div>
<table id="tpsch" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
<tr>
<td class="hm mtw ptw pbw"><h1 class="mtw ptw"><a href="./" title="<?php echo $_G['setting']['bbname'];?>"><?php echo BOARDLOGO;?></a></h1></td>
<td></td>
</tr>
<tr>
<td class="hm xs2 pbm" width="400">
<?php if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF

EOF;
 if(CURMODULE == 'portal') { 
$slist[portal] .= <<<EOF
<strong>文章</strong>
EOF;
 } else { 
$slist[portal] .= <<<EOF
<a href="search.php?mod=portal
EOF;
 if($keyword) { 
$slist[portal] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[portal] .= <<<EOF
">文章</a>
EOF;
 } 
$slist[portal] .= <<<EOF

EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF

EOF;
 if(CURMODULE == 'forum') { 
$slist[forum] .= <<<EOF
<strong>{$_G['setting']['navs']['2']['navname']}</strong>
EOF;
 } else { 
$slist[forum] .= <<<EOF
<a href="search.php?mod=forum
EOF;
 if($keyword) { 
$slist[forum] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[forum] .= <<<EOF
">{$_G['setting']['navs']['2']['navname']}</a>
EOF;
 } 
$slist[forum] .= <<<EOF

EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF

EOF;
 if(CURMODULE == 'blog') { 
$slist[blog] .= <<<EOF
<strong>日志</strong>
EOF;
 } else { 
$slist[blog] .= <<<EOF
<a href="search.php?mod=blog
EOF;
 if($keyword) { 
$slist[blog] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[blog] .= <<<EOF
">日志</a>
EOF;
 } 
$slist[blog] .= <<<EOF

EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF

EOF;
 if(CURMODULE == 'album') { 
$slist[album] .= <<<EOF
<strong>相册</strong>
EOF;
 } else { 
$slist[album] .= <<<EOF
<a href="search.php?mod=album
EOF;
 if($keyword) { 
$slist[album] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[album] .= <<<EOF
">相册</a>
EOF;
 } 
$slist[album] .= <<<EOF

EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF

EOF;
 if(CURMODULE == 'group') { 
$slist[group] .= <<<EOF
<strong>{$_G['setting']['navs']['3']['navname']}</strong>
EOF;
 } else { 
$slist[group] .= <<<EOF
<a href="search.php?mod=group
EOF;
 if($keyword) { 
$slist[group] .= <<<EOF
&amp;srchtxt={$keywordenc}&amp;searchsubmit=yes
EOF;
 } 
$slist[group] .= <<<EOF
">{$_G['setting']['navs']['3']['navname']}</a>
EOF;
 } 
$slist[group] .= <<<EOF

EOF;
?><?php } echo implode("<span class=\"pipe\">|</span>", $slist);; ?><span class="pipe">|</span>
<?php if(CURMODULE == 'user') { ?><strong>用户</strong><?php } else { ?><a href="search.php?mod=user<?php if($keyword) { ?>&amp;srchtxt=<?php echo $keywordenc;?>&amp;searchsubmit=yes<?php } ?>">用户</a><?php } ?>
</td>
<td></td>
</tr>
<tr id="tps_form">
<td>
<input type="text" id="srchtxt" name="srchtxt" size="65" maxlength="40" value="<?php echo $keyword;?>" class="schtxt" tabindex="1" />
<script type="text/javascript">$('srchtxt').focus();</script>
</td>
<td>
<input type="hidden" name="searchsubmit" value="yes" />
<button type="submit" id="tps_btn" value="true" class="schbtn"><strong>搜索</strong></button>
</td>

<td style="padding-left: 10px; width: 50px; background: #FFF; text-align: left;">
<?php if(CURMODULE == 'forum') { if(($_G['group']['allowsearch'] & 32)) { ?><label><input type="checkbox" name="srchtype" class="pc" value="fulltext" <?php echo $fulltextchecked;?>/> 全文</label><br /><?php } if($checkarray['posts']) { ?>
<a href="search.php?mod=forum&amp;adv=yes">高级</a>
<?php } } ?>
</td>
</tr>
</table>
</div>
<?php } } ?><?php if(!empty($_G['setting']['pluginhooks']['portal_top'])) echo $_G['setting']['pluginhooks']['portal_top']; ?>

</form>
<?php if(!empty($searchid) && submitcheck('searchsubmit', 1)) { ?><div class="tl">
<div class="sttl mbn">
<h2><?php if($keyword) { ?>结果: <em>找到 “<span class="emfont"><?php echo $keyword;?></span>” 相关内容 <?php echo $index['num'];?> 个</em><?php } else { ?>结果: <em>找到相关主题 <?php echo $index['num'];?> 个</em><?php } ?></h2>
</div>
<?php if(empty($articlelist)) { ?>
<p class="emp xg2 xs2">对不起，没有找到匹配结果。</p>
<?php } else { ?>
<div class="slst mtw">
<ul><?php if(is_array($articlelist)) foreach($articlelist as $article) { ?><li class="pbw">
<h3 class="xs3"><a href="portal.php?mod=view&amp;aid=<?php echo $article['aid'];?>" target="_blank"><?php echo $article['title'];?></a></h3>
<p class="xg1"><?php echo $article['commentnum'];?> 个评论 - <?php echo $article['viewnum'];?> 次查看</p>
<p><?php echo $article['summary'];?></p>
<p>
<span><?php echo $article['dateline'];?></span>
 - 
<span><a href="home.php?mod=space&amp;uid=<?php echo $article['uid'];?>" target="_blank"><?php echo $article['username'];?></a></span>
</p>
</li>
<?php } ?>
</ul>
</div>
<?php } if(!empty($multipage)) { ?><div class="pgs cl mbm"><?php echo $multipage;?></div><?php } ?>
</div><?php } ?>

</div>
<?php if(!empty($_G['setting']['pluginhooks']['portal_bottom'])) echo $_G['setting']['pluginhooks']['portal_bottom']; ?><?php $focusid = getfocus_rand($_G[basescript]); if($focusid !== null) { ?><?php $focus = $_G['cache']['focus']['data'][$focusid]; ?><div class="focus" id="focus">
<h3 class="flb">
<em><?php if($_G['cache']['focus']['title']) { ?><?php echo $_G['cache']['focus']['title'];?><?php } else { ?>站长推荐<?php } ?></em>
<span><a href="javascript:;" onclick="setcookie('nofocus_<?php echo $focusid;?>', 1, 86400);$('focus').style.display='none'" class="flbc" title="关闭">关闭</a></span>
</h3>
<hr class="l" />
<div class="detail">
<h4><a href="<?php echo $focus['url'];?>" target="_blank"><?php echo $focus['subject'];?></a></h4>
<p>
<?php if($focus['image']) { ?>
<a href="<?php echo $focus['url'];?>" target="_blank"><img src="<?php echo $focus['image'];?>" onload="thumbImg(this, 1)" _width="58" _height="58" /></a>
<?php } ?>
<?php echo $focus['summary'];?>
</p>
</div>
<hr class="l" />
<a href="<?php echo $focus['url'];?>" class="moreinfo" target="_blank">查看</a>
</div>
<?php } ?><?php echo adshow("footerbanner/wp a_f hm/1"); ?><?php echo adshow("footerbanner/wp a_f hm/2"); ?><?php echo adshow("footerbanner/wp a_f hm/3"); ?><?php echo adshow("float/a_fl/1"); ?><?php echo adshow("float/a_fr/2"); ?><?php echo adshow("couplebanner/a_fl a_cb/1"); ?><?php echo adshow("couplebanner/a_fr a_cb/2"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>

<div id="ft" class="w cl">
<strong><a href="<?php echo $_G['setting']['siteurl'];?>" target="_blank"><?php echo $_G['setting']['sitename'];?></a></strong>
<?php if($_G['setting']['icp']) { ?>( <a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo $_G['setting']['icp'];?></a>)<?php } if($_G['setting']['adminemail']) { ?><span class="pipe">|</span><a href="mailto:<?php echo $_G['setting']['adminemail'];?>">联系我们</a><?php } if($_G['setting']['statcode']) { ?><span class="pipe">| <?php echo $_G['setting']['statcode'];?></span><?php } ?>
<span class="pipe">|</span>

<em>Powered by <strong><a href="http://www.discuz.net" target="_blank">Discuz!</a></strong> <em><?php echo $_G['setting']['version'];?></em><?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?></em> &nbsp; 
<em class="xs0">&copy; 2001-2010 <a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a></em><?php updatesession(); ?></div>
<?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } ?><?php output(); ?></body>
</html>