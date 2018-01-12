<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('stat_misc', 'common/header');
0
|| checktplrefresh('./template/default/forum/stat_misc.htm', './template/default/common/simplesearchform.htm', 1489671707, '2', './data/template/2_2_forum_stat_misc.tpl.php', './template/8264', 'forum/stat_misc')
|| checktplrefresh('./template/default/forum/stat_misc.htm', './template/default/common/stat.htm', 1489671707, '2', './data/template/2_2_forum_stat_misc.tpl.php', './template/8264', 'forum/stat_misc')
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
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em>
<a href="misc.php?mod=stat">站点统计</a><em>&rsaquo;</em>
<?php if($op == 'views') { ?>
流量统计
<?php } elseif($op == 'agent') { ?>
客户软件
<?php } elseif($op == 'posts') { ?>
发帖量记录
<?php } elseif($op == 'forumsrank') { ?>
版块排行
<?php } elseif($op == 'threadsrank') { ?>
主题排行
<?php } elseif($op == 'postsrank') { ?>
发帖排行
<?php } elseif($op == 'creditsrank') { ?>
积分排行
<?php } elseif($op == 'modworks') { ?>
管理统计
<?php } elseif($op == 'forumstat') { ?>
版块统计
<?php } elseif($op == 'forumstatdetail') { ?>
子版块统计
<?php } ?>
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<?php if($op == 'views') { ?>
<div class="bm bw0">
<h1 class="mt">流量统计</h1>
<table summary="星期流量" class="dt bm">
<caption><h2 class="mbn">星期流量</h2></caption>
<?php echo $statsbar_week;?>
</table>

<table summary="时段流量" class="dt bm">
<caption><h2 class="mbn">时段流量</h2></caption>
<?php echo $statsbar_hour;?>
</table>
</div>
<?php } elseif($op == 'agent') { ?>
<div class="bm bw0">
<h1 class="mt">客户软件</h1>
<table summary="客户软件" class="dt bm">
<caption><h2 class="mbn">操作系统</h2></caption>
<?php echo $statsbar_os;?>
</table>

<table summary="浏览器" class="dt bm">
<caption><h2 class="mbn">浏览器</h2></caption>
<?php echo $statsbar_browser;?>
</table>
</div>
<?php } elseif($op == 'posts') { ?>
<div class="bm bw0">
<h1 class="mt">发帖量记录</h1>
<table summary="每月新增帖子记录" class="dt bm">
<caption><h2 class="mbn">每月新增帖子记录</h2></caption>
<?php echo $statsbar_monthposts;?>
</table>

<table summary="每日新增帖子记录" class="dt bm">
<caption><h2 class="mbn">每日新增帖子记录</h2></caption>
<?php echo $statsbar_dayposts;?>
</table>
<?php } elseif($op == 'forumsrank') { ?>
<div class="bm bw0">
<h1 class="mt">版块排行</h1>
<table summary="版块排行" class="dt bm mbw">
<tr>
<th colspan="2" class="xw1" width="50%">发帖排行榜</th>
<th colspan="2" class="xw1">回复排行榜</th>
</tr>
<?php echo $forumsrank['0'];?>
</table>

<table summary="版块排行" class="dt bm">
<tr>
<th colspan="2" class="xw1" width="50%">最近 30 天发帖排行榜</th>
<th colspan="2" class="xw1">最近 24 小时发帖排行榜</th>
</tr>
<?php echo $forumsrank['1'];?>
</table>

<div class="notice">统计数据已被缓存，上次于 <?php echo $lastupdate;?> 被更新，下次将于 <?php echo $nextupdate;?> 进行更新</div>
</div>
<?php } elseif($op == 'forumstat' && !$_G['gp_fid']) { ?>
<div class="bm bw0">
<h1 class="mt">版块统计</h1>
<table summary="!stats_forum_stat!" class="dt bm">
<tr>
<th class="xw1">版块名称</td>
<th class="xw1">帖子数</td>
</tr><?php if(is_array($forums)) foreach($forums as $forum) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><a href="misc.php?mod=stat&amp;op=forumstat&amp;fid=<?php echo $forum['fid'];?>"><?php echo $forum['name'];?></a></td>
<td><?php echo $forum['posts'];?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } elseif($op == 'forumstat' && $_G['gp_fid']) { ?>
<div class="bm bw0">
<h1 class="mt">版块统计日志 - <?php echo $foruminfo['name'];?> - <?php echo $month;?></h1>
<script type="text/javascript">
document.write(AC_FL_RunContent(
'width', '100%', 'height', '300',
'src', '<?php echo STATICURL;?>image/common/stat.swf?<?php echo $statuspara;?>',
'quality', 'high'
));
</script>
<table summary="版块统计日志" class="dt bm mtw mbw">
<tr>
<th width="100">日期</th>
<th>发帖数</th>
</tr><?php if(is_array($logs)) foreach($logs as $log) { ?><tr>
<td><?php echo $log['logdate'];?></td>
<td><?php echo $log['value'];?></td>
</tr>
<?php } ?>
</table>

<table class="dt bm">
<caption><h2 class="mbn">历史记录 - <?php echo $foruminfo['name'];?></h2></caption>
<tr>
<th width="100">月份</th>
<th>发帖数</th>
</tr><?php if(is_array($monthlist)) foreach($monthlist as $month) { ?><tr>
<td><a href="misc.php?mod=stat&amp;op=forumstat&amp;fid=<?php echo $_G['gp_fid'];?>&amp;month=<?php echo $month;?>"><?php echo $month;?></a></td>
<td><?php echo $monthposts[$month];?></td>
</tr>
<?php } ?>
</table>
</div>		
<?php } elseif($op == 'forumstatdetail' && !$_G['gp_typeid']) { ?>
<div class="bm bw0">
<h1 class="mt">子版块统计</h1>
<table summary="!stats_forum_stat!" class="dt bm">
<tr>
<th class="xw1" width="17%">版块名称</td>
<th class="xw1">子版块名称</td>
</tr><?php if(is_array($forums)) foreach($forums as $key => $value) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><a href="misc.php?mod=stat&amp;op=forumstat&amp;fid=<?php echo $key;?>"><?php echo $value['name'];?></a></td>
<td>
<ol type="I"><?php if(is_array($value['more'])) foreach($value['more'] as $key1 => $value1) { ?><a href="misc.php?mod=stat&amp;op=forumstatdetail&amp;typeid=<?php echo $key1;?>"><?php echo $value1;?></a>
<?php } ?>
</ol>
</td>
</tr>

<?php } ?>
</table>
</div>
<?php } elseif($op == 'forumstatdetail' && $_G['gp_typeid']) { ?>
<div class="bm bw0">
<h1 class="mt">子版块统计日志 - <?php echo $foruminfo['name'];?> - <?php echo $month;?></h1>
<script type="text/javascript">
document.write(AC_FL_RunContent(
'width', '100%', 'height', '300',
'src', '<?php echo STATICURL;?>image/common/stat.swf?<?php echo $statuspara;?>',
'quality', 'high'
));
</script>
<table summary="子版块统计日志" class="dt bm mtw mbw">
<tr>
<th width="100">日期</th>
<th>发帖数</th>
</tr><?php if(is_array($logs)) foreach($logs as $log) { ?><tr>
<td><?php echo $log['logdate'];?></td>
<td><?php echo $log['value'];?></td>
</tr>
<?php } ?>
</table>

<table class="dt bm">
<caption><h2 class="mbn">历史记录 - <?php echo $foruminfo['name'];?></h2></caption>
<tr>
<th width="100">月份</th>
<th>发帖数</th>
</tr><?php if(is_array($monthlist)) foreach($monthlist as $month) { ?><tr>
<td><a href="misc.php?mod=stat&amp;op=forumstatdetail&amp;typeid=<?php echo $_G['gp_typeid'];?>&amp;month=<?php echo $month;?>"><?php echo $month;?></a></td>
<td><?php echo $monthposts[$month];?></td>
</tr>
<?php } ?>
</table>
</div>		
<?php } elseif($op == 'threadsrank') { ?>
<div class="bm bw0">
<h1 class="mt">主题排行</h1>
<table summary="主题排行" class="dt bm">
<tr>
<th colspan="2" class="xw1" width="50%">被浏览最多的主题</th>
<th colspan="2" class="xw1">被回复最多的主题</th>
</tr>
<?php echo $threadsrank;?>
</table>
</div>
<?php } elseif($op == 'postsrank') { ?>
<div class="bm bw0">
<h1 class="mt">发帖排行</h1>
<table summary="发帖排行" class="dt bm">
<tr>
<th colspan="2" class="xw1" width="25%">发帖 排行榜</th>
<th colspan="2" class="xw1" width="25%">精华帖 排行榜</th>
<th colspan="2" class="xw1" width="25%">最近 30 天发帖 排行榜</th>
<th colspan="2" class="xw1" width="25%">最近 24 小时发帖 排行榜</th>
</tr>
<?php echo $postsrank;?>
</table>
</div>
<?php } elseif($op == 'creditsrank') { ?>
<div class="bm bw0">
<h1 class="mt">积分排行</h1>
<ul class="tb cl"><?php if(is_array($extendedcredits)) foreach($extendedcredits as $key => $extendedcredit) { ?><li<?php if($_G['gp_extcredit'] == $key) { ?> class="a" id="extendedcredit_current"<?php } ?>><a href="misc.php?mod=stat&amp;op=creditsrank&amp;extcredit=<?php echo $key;?>" onclick="swtichcurrent(this, <?php echo $key;?>);return false;"><?php echo $_G['setting']['extcredits'][$key]['title'];?></a></li>
<?php } ?>
</ul><?php if(is_array($extendedcredits)) foreach($extendedcredits as $key => $extendedcredit) { ?><table id="extendedcredit_<?php echo $key;?>" summary="积分排行" class="dt bw0 mtw" style="display:<?php if($_G['gp_extcredit'] != $key) { ?> none<?php } ?>">
<?php echo $creditsrank[$key];?>
</table>
<?php } ?>
<script type="text/javascript">
var lastcurrent = $('extendedcredit_current');
var lastextcredit = <?php echo $_G['gp_extcredit'];?>;
function swtichcurrent(obj, extcredit) {
if(lastcurrent) {
lastcurrent.className = '';
}
$('extendedcredit_' + lastextcredit).style.display = 'none';
$('extendedcredit_' + extcredit).style.display = '';
obj.parentNode.className = 'a';
lastcurrent = obj.parentNode;
lastextcredit = extcredit;
}
</script>
</div>
<?php } elseif($op == 'modworks' && $uid) { ?>
<div class="bm bw0">
<h1 class="mt">管理统计 - <?php echo $_G['username'];?></h1>
<ul class="ttp cl"><?php if(is_array($monthlinks)) foreach($monthlinks as $link) { ?><?php echo $link;?>
<?php } ?>
</ul>
<div class="cl">
<div class="stl">
<table class="dt bm">
<tr>
<th>时间</th>
</tr><?php if(is_array($modactions)) foreach($modactions as $day => $modaction) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><?php echo $day;?></td>
</tr>
<?php } ?>
<tr class="alt"><td></td></tr>
<tr>
<td>本月管理</td>
</tr>
</table>
</div>
<div class="str">
<table class="dt" style="width: 3000px;">
<tr><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { ?><th width="<?php echo $tdwidth;?>"><?php echo $val;?></th><?php } ?>
</tr><?php unset($swapc); if(is_array($modactions)) foreach($modactions as $day => $modaction) { ?><tr class="<?php echo swapclass('alt'); ?>"><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { if($modaction[$key]['posts']) { ?><td title="帖子: <?php echo $modaction[$key]['posts'];?>"><?php echo $modaction[$key]['count'];?><?php } else { ?><td>&nbsp;<?php } ?></td>
<?php } ?>
</tr>
<?php } ?>
<tr class="alt"><td colspan="23"></td></tr>
<tr><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { ?><td class="<?php echo $bgarray[$key];?>" <?php if($totalactions[$key]['posts']) { ?>title="帖子: <?php echo $totalactions[$key]['posts'];?>"<?php } ?>><?php echo $totalactions[$key]['count'];?>&nbsp;</td>
<?php } ?>
</tr>
</table>
</div>
</div>
</div>

<?php } elseif($op == 'modworks') { ?>
<div class="bm bw0">
<h1 class="mt">管理统计 - 全体管理人员</h1>
<ul class="ttp cl"><?php if(is_array($monthlinks)) foreach($monthlinks as $link) { ?><?php echo $link;?>
<?php } ?>
</ul>
<div class="cl">
<div class="stl">
<table class="dt bm">
<tr>
<th>用户名</th>
</tr><?php if(is_array($members)) foreach($members as $uid => $member) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><a href="misc.php?mod=stat&amp;op=modworks&amp;before=<?php echo $_G['gp_before'];?>&amp;uid=<?php echo $uid;?>" title="查看详细管理统计"><?php echo $member['username'];?></a></td>
</tr>
<?php } ?>
</table>
</div>

<div class="str">
<table class="dt" style="width: 3000px;">
<tr><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { ?><th width="<?php echo $tdwidth;?>"><?php echo $val;?></th><?php } ?>
</tr><?php unset($swapc); if(is_array($members)) foreach($members as $uid => $member) { ?><tr class="<?php echo swapclass('alt'); ?>"><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { if($member[$key]['posts']) { ?><td title="帖子: <?php echo $member[$key]['posts'];?>"><?php echo $member[$key]['count'];?><?php } else { ?><td>&nbsp;<?php } ?></td>
<?php } ?>
</tr>
<?php } ?>
</table>
</div>
</div>
</div>
<?php } ?>

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