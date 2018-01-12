<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('stat_main', 'common/header');
0
|| checktplrefresh('./template/default/forum/stat_main.htm', './template/default/common/simplesearchform.htm', 1494490950, '2', './data/template/2_2_forum_stat_main.tpl.php', './template/8264', 'forum/stat_main')
|| checktplrefresh('./template/default/forum/stat_main.htm', './template/default/common/stat.htm', 1494490950, '2', './data/template/2_2_forum_stat_main.tpl.php', './template/8264', 'forum/stat_main')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/home/misc_stat.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em> 站点统计
</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt">基本概况</h1>
<table summary="会员统计" class="dt bm mbw">
<caption><h2 class="mbn">会员统计</h2></caption>
<tr>
<th width="16%">注册会员</th>
<td width="34%"><?php echo $members;?></td>
<th width="16%">发帖会员</th>
<td width="34%"><?php echo $mempost;?></td>
</tr>
<tr>
<th>管理成员</th>
<td><?php echo $admins;?></td>
<th>未发帖会员</th>
<td><?php echo $memnonpost;?></td>
</tr>
<tr>
<th>新会员</th>
<td><?php echo $lastmember;?></td>
<th>发帖会员占总数</th>
<td><?php echo $mempostpercent;?>%</td>
</tr>
<tr>
<th>今日论坛之星</th>
<td><?php if($bestmemposts) { ?><?php echo $bestmem;?> <em title="发帖数">(<?php echo $bestmemposts;?>)</em><?php } else { ?><em>无</em><?php } ?></td>
<th>平均每人发帖数</th>
<td><?php echo $mempostavg;?></td>
</tr>
</table>

<table summary="站点统计" class="dt bm">
<caption><h2 class="mbn">站点统计</h2></caption>
<tr>
<th width="150">版块数</th>
<td width="60"><?php echo $forums;?></td>
<th width="150">平均每日新增帖子数</th>
<td width="60"><?php echo $postsaddavg;?></td>
<th width="150">最热门的版块</th>
<td><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $hotforum['fid'];?>" target="_blank"><?php echo $hotforum['name'];?></a></td>
</tr>
<tr>
<th>主题数</th>
<td><?php echo $threads;?></td>
<th>平均每日注册会员数</th>
<td><?php echo $membersaddavg;?></td>
<th>主题数</th>
<td><?php echo $hotforum['threads'];?></td>
</tr>
<tr>
<th>帖子数</th>
<td><?php echo $posts;?></td>
<th>最近 24 小时新增帖子数</th>
<td><?php echo $postsaddtoday;?></td>
<th>帖子数</th>
<td><?php echo $hotforum['posts'];?></td>
</tr>
<tr>
<th>平均每个主题被回复次数</th>
<td><?php echo $threadreplyavg;?></td>
<th>最近 24 小时新增会员数</th>
<td><?php echo $membersaddtoday;?></td>
<th>论坛活跃指数</th>
<td><?php echo $activeindex;?></td>
</tr>
</table>
<div class="notice">统计数据已被缓存，上次于 <?php echo $lastupdate;?> 被更新，下次将于 <?php echo $nextupdate;?> 进行更新</div>
</div>
</div><div class="appl">
<div class="tbn">
<ul>
<li class="cl<?php if($op == 'basic') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=basic">基本概况</a></li>
<li class="cl<?php if($op == 'forumstat') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=forumstat">版块统计</a></li>
<li class="cl<?php if($op == 'forumstatdetail') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=forumstatdetail">子版块统计</a></li>
<li class="cl<?php if($op == 'team') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=team">管理团队</a></li>
<?php if($_G['setting']['modworkstatus']) { ?>
<li class="cl<?php if($op == 'modworks') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=modworks">管理统计</a></li>
<?php } if($_G['setting']['memliststatus']) { ?>
<li class="cl<?php if($op == 'memberlist') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=memberlist">会员列表</a></li>
<?php } if($_G['setting']['updatestat']) { ?>
<li class="cl<?php if($op == 'trend') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=trend">趋势统计</a></li>
<?php } ?>
</ul>
</div>
</div></div><?php include template('common/footer'); ?>