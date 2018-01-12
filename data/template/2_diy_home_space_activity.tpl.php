<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_activity', 'common/header');
0
|| checktplrefresh('./template/default/home/space_activity.htm', './template/default/common/simplesearchform.htm', 1509518214, 'diy', './data/template/2_diy_home_space_activity.tpl.php', 'data/diy', 'home/space_activity')
;
block_get('1882');?>
<?php $_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=activity&amp;view=me\">TA的所有活动</a>"; include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<div id="pt" class="bm cl"> <?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
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
<?php } } ?><div class="z"> <a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> <a href="home.php?mod=space&amp;do=activity">活动</a> 
<?php if($_GET['view']=='me') { ?> 
<em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=me"><?php echo $space['username'];?>的活动</a> 
<?php } ?> 
</div>
</div>
<div style="width:958px; margin:0 auto; margin-bottom:10px; text-align:left;"> <?php echo adshow("custom_38"); ?><div style="clear:both;"></div>
</div>
<div style="display:none;">
<div class="title_yyall">有奖活动进行中</div>
<div style="width:958px; border:#ccc solid 1px; margin:auto;"> 
<!--[diy=adbinz]--><div id="adbinz" class="area"><div id="frameysq932" class=" frame move-span cl frame-1"><div id="frameysq932_left" class="column frame-1-c"><div id="frameysq932_left_temp" class="move-span temp"></div><?php block_display('1882'); ?></div></div></div><!--[/diy]-->
<div style="clear:both;"></div>
</div>
<style>
.title_yyall{ width:948px; height:23px; padding:5px 0px 0px 10px; font-size:12px; font-weight:bold; border:#ccc solid 1px; border-bottom:0; background:#e5edf2; margin:auto;}
.img_yy_all{ width:172px; float:left; margin:5px 9px 5px 10px!important; margin:5px 8px 5px 8px;}
.img_yy_all img{ width:170px; height:80px; border:#ccc solid 1px; margin-bottom:5px;}
.img_yy_name{ width:100%; height:17px; overflow:hidden; line-height:1.4; }
.img_yy_name span{ color:#ff6600;}
.img_yy_name a{ font-weight:bold;}
.img_yy_name a:hover{ font-weight:bold;}


.act4587_r{ width:960px; margin:10px auto;}
.act4587_top_y{}
.act_y{ background:url(http://static.8264.com/static/image/common/title_bottom_bg.jpg) left top repeat-y; margin-bottom:10px;}
.act_title{  text-align:center;  background: url(http://static.8264.com/static/image/common/title_bottom_bg.jpg) bottom repeat-x;}
.act_title_one{ width:60px; padding:3px 5px 2px 5px; float:left; border:#c2d5e3 solid 1px; border-bottom:0; background:#fff; margin-left:5px;}
.act_title_other{ width:60px; padding:2px 5px 2px 5px; float:left; border:#c2d5e3 solid 1px; background:#f2f2f2; margin-right:5px;}

.act_con_y_all{ border:#c2d5e3 solid 1px; border-top:0; padding:3px 5px 5px 5px;}
.act_con_y_all a{ float:left; margin:5px 0px 2px 10px; font-size:14px; color:#336699;}
.act_con_y_all a:hover{ float:left; margin:5px 0px 2px 10px; font-size:14px; color:#336699;}
.act_timeall{ border-top:#c2d5e3 solid 1px; border-bottom:#c2d5e3 solid 1px; background:#f2f2f2; padding:5px 5px 4px 5px; margin-bottom:10px; font-size:14px;}
.act_timeall a{ font-size:14px; color:#336699; margin-right:5px;}
.act_timeall a:hover{ font-size:14px; color:#336699;}
a.timeone:link { color:#cc0000; font-weight:bold;}
a.timeone:visited{ color:#cc0000; font-weight:bold;}
a.timeone:hover { color:#cc0000; font-weight:bold;}
a.timeone:active{ color:#cc0000; font-weight:bold;}
.fenye{ margin-bottom:10px;}
.tdwidth { width: 85px; }
</style>
</div>
<div class="act4587_r">
<div class="act4587_top_y">
<div class="act_y">
<div class="act_title">
<div class="act_title_one">活动类别</div>
<div class="act_title_other" style="display:none;">活动类别</div>
<div style="clear:both"></div>
</div>
<div class="act_con_y_all"> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=<?php echo $_GET['date'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderclass['default'];?>>全部</a> 
<?php if($activitytypelist) { ?> <?php if(is_array($activitytypelist)) foreach($activitytypelist as $class) { ?> 
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=<?php echo $_GET['date'];?>&amp;class=<?php echo $class;?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderclass[$class];?>><?php echo $class;?></a> 
<?php } ?> 
<?php } ?>
<div style=" clear:both;"></div>
</div>
</div>
<div class="act_timeall"> 活动地区： <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=<?php echo $_GET['date'];?>&amp;class=<?php echo $_GET['class'];?>&amp;area=0" <?php echo $orderarea['0'];?>>所有</a> 
<?php if($arealist) { ?> <?php if(is_array($arealist)) foreach($arealist as $key => $value) { ?> 
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=week&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $key;?>" <?php echo $orderarea[$key];?>><?php echo $value;?></a> 
<?php } ?> 
<?php } ?> 
</div>
<div class="act_timeall"> 时间排序： <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['default'];?>>所有</a> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=week&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['week'];?>>本周</a> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=nextweek&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['nextweek'];?>>下周</a> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=month&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['month'];?>>本月</a> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=nextmonth&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['nextmonth'];?>>下月</a> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=halfyear&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['halfyear'];?>>半年后</a> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=old&amp;class=<?php echo $_GET['class'];?>&amp;area=<?php echo $_GET['area'];?>" <?php echo $orderdate['old'];?>>已过期</a> </div>
<div class="act_timeall"> 活动筛选： <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=all&amp;date=<?php echo $_GET['date'];?>&amp;class=<?php echo $_GET['class'];?>" <?php echo $orderview['all'];?>>全部活动</a><span class="pipe">|</span> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=we&amp;date=<?php echo $_GET['date'];?>&amp;class=<?php echo $_GET['class'];?>" <?php echo $orderview['we'];?>>好友发起的活动</a><span class="pipe">|</span> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=activity&amp;view=me&amp;date=me&amp;class=<?php echo $_GET['class'];?>" <?php echo $orderview['me'];?>>我的活动</a><span class="pipe">|</span> 
<?php if($_GET['view'] == 'me') { ?> 
<a href="home.php?mod=space&amp;do=activity&amp;view=me&amp;type=orig&amp;date=me&amp;class=<?php echo $_GET['class'];?>">我发起的活动</a> <a href="home.php?mod=space&amp;do=activity&amp;view=me&amp;type=apply&amp;date=me&amp;class=<?php echo $_GET['class'];?>">我参与的活动</a> 
<?php } ?> 
<?php if($_GET['view'] == 'all') { ?> 
<a href="home.php?mod=space&amp;do=activity&amp;view=all&amp;date=<?php echo $_GET['date'];?>&amp;class=<?php echo $_GET['class'];?>">最新活动</a> <a href="home.php?mod=space&amp;do=activity&amp;view=all&amp;order=hot&amp;date=<?php echo $_GET['date'];?>&amp;class=<?php echo $_GET['class'];?>">热门活动</a> 
<?php } ?> 
</div>
<div class="fenye"> <span style="float:left"> <b style="float:left;"> 
<?php if($_G['group']['allowpostactivity']) { ?> 
<?php if($_G['setting']['activityforumid']) { ?> 
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['setting']['activityforumid'];?>&amp;special=4"><img src="http://static.8264.com/static/image/common/actbegin.gif" border="0"/></a> 
<?php } else { ?> 
<a href="forum.php?mod=misc&amp;action=nav&amp;special=4" onclick="showWindow('nav', this.href)"><img src="http://static.8264.com/static/image/common/actbegin.gif" border="0"/></a> 
<?php } ?> 
<?php } ?> 
</b> <b style=" margin-left:10px;border:#f2dca8 solid 1px; background:#fffcf1; float:left; padding:5px 10px 2px 10px; color:#336699; font-weight:normal;">小技巧：点击标题前面的图标可以新窗口打开帖子</b>
<div style="clear:both;"></div>
</span> <em style="float:right;"><?php if($multi) { ?>
<div class="pgs cl"><?php echo $multi;?></div>
<?php } ?></em>
<div style="clear:both;"></div
    >
</div>
</div>
<div id="threadlist" class="tl bm bmw" >
<div style="background:#f2f2f2;">
<table cellpadding="0" cellspacing="0">
<tr>
<th colspan="2"> <div class="tf" style="padding-left:10px;"> </div>
</th>
<td class="tdwidth" >类别</td>
<td class="tdwidth" >报名</td>
<td class="tdwidth" >出发/结束</td>
<td class="tdwidth" >发起者</td>
<td class="num">回复/查看</td>
</tr>
</table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php if($list) { ?> <?php if(is_array($list)) foreach($list as $key => $activitylist) { ?> <?php if(is_array($activitylist)) foreach($activitylist as $tid => $thread) { ?><tr>
<td class="icn"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" target="_blank" title="新窗口打开"><img src="http://static.8264.com/static/image/common/folder_new.gif" width="18" height="18" border="0"></a></td>
<th class="new"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" class="xst"><?php if($thread['areaname']) { ?><span style="color:#336699;">[<?php echo $thread['areaname'];?>]</span><?php } ?><?php echo $thread['subject'];?></a> </th>
<td class="tdwidth"> <?php echo $thread['class'];?> </td>
<td class="tdwidth"> <?php echo $thread['applynumber'];?> 人参加 </td>
<td class="tdwidth"> <?php echo $thread['time'];?><br>
<?php echo $thread['endtime'];?> </td>
<td class="tdwidth"><cite><a title="<?php echo $thread['author'];?>" href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>"><?php echo $thread['author'];?></a></cite> <em><?php echo $thread['postdate'];?></em></td>
<td class="num"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" class="xi2"><?php echo $thread['replies'];?></a><em><?php echo $thread['views'];?></em></td>
</tr>
<?php } ?> 
<?php } ?> 
<?php } ?>
</table>
</div>
<div class="fenye"> <em style="float:right;"><?php if($multi) { ?>
<div class="pgs cl"><?php echo $multi;?></div>
<?php } ?></em>
<div style="clear:both;"></div
    >
</div>
</div>
<div>
<style id="diy_style" type="text/css">#frame4yrWde {  background-image:none !important;background-color:#e7f0f7 !important;border:#cccccc !important;}#frameysq932 {  margin:0px !important;border:medium none !important;}#portal_block_1882 {  margin:0px !important;border:medium none !important;}#portal_block_1882 .content {  margin:0px !important;}</style>
<div class="wp"> 
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]--> 
</div>
<div class="wp mtn"> 
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]--> 
</div>
<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=activity&view=we&fuid='+fuid;
}
</script> 
</div><?php include template('common/footer'); ?>