<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_debate', 'common/header');
0
|| checktplrefresh('./template/default/home/space_debate.htm', './template/default/common/simplesearchform.htm', 1502186505, 'diy', './data/template/2_diy_home_space_debate.tpl.php', './template/8264', 'home/space_debate')
|| checktplrefresh('./template/default/home/space_debate.htm', './template/default/common/userabout.htm', 1502186505, 'diy', './data/template/2_diy_home_space_debate.tpl.php', './template/8264', 'home/space_debate')
;?>
<?php $_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=debate&amp;view=me\">TA的所有辩论</a>"; include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=debate">辩论</a>
<?php if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=debate&amp;view=me"><?php echo $space['username'];?>的辩论</a>
<?php } ?>
</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bw0">
<?php if((!$_G['uid'] && !$space['uid']) || $space['self']) { ?>
<h1 class="mt"><img alt="debate" src="http://static.8264.com/static/image/common/debatesmall.gif" class="vm" /> 辩论</h1>
<?php } if($space['self']) { ?>
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=debate&amp;view=we">好友发起的辩论</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=debate&amp;view=me">我的辩论</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=debate&amp;view=all">随便看看</a></li>
<?php if($_G['group']['allowpostdebate']) { ?>
<li class="o">
<?php if($_G['setting']['debateforumid']) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['setting']['debateforumid'];?>&amp;special=5">发起新辩论</a>
<?php } else { ?>
<a href="forum.php?mod=misc&amp;action=nav&amp;special=5" onclick="showWindow('nav', this.href)">发起新辩论</a>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php } else { include template('home/space_menu'); } if($_GET['view'] == 'me') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=debate&amp;view=me&amp;type=orig"<?php echo $typeactives['orig'];?>>我发起的辩论</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=debate&amp;view=me&amp;type=reply"<?php echo $typeactives['reply'];?>>我参与的辩论</a>
</p>
<?php } elseif($_GET['view'] == 'all') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=debate&amp;view=all"<?php echo $orderactives['dateline'];?>>最新辩论</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=debate&amp;view=all&amp;order=hot"<?php echo $orderactives['hot'];?>>热门辩论</a>
</p>
<?php } if($userlist) { ?>
<p class="tbmu">
按好友查看
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
</p>
<?php } if($count) { if(is_array($special)) foreach($special as $tid => $thread) { ?><div class="ds bbda mbw">
<h3 class="ph mbn"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" class="xi2"><?php echo $thread['subject'];?></a></h3>
<p class="xg2 mbw hm"><?php echo $thread['message'];?></p>
<table summary="全部观点" cellspacing="0" cellpadding="0">
<tr>
<td class="si_1">
<div class="point">
<strong>正方观点 (<?php echo $thread['affirmvotes'];?>)</strong>
<p><?php echo $thread['affirmpoint'];?></p>
</div>
</td>
<td class="sc_1">
<div class="point_chart" title="点击支持" style="cursor: pointer;" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $thread['tid'];?>&amp;stand=1" id="affirmbutton_<?php echo $thread['tid'];?>" onclick="ajaxmenu(this);doane(event);" >
<div class="chart" style="height: <?php echo $thread['affirmvotesheight'];?>;" title="正方 (<?php echo $thread['affirmvotes'];?>)"></div>
</div>
</td>
<th><div></div></th>
<td class="sc_2">
<div class="point_chart" title="点击支持" style="cursor: pointer;" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $thread['tid'];?>&amp;stand=2" id="negabutton_<?php echo $thread['tid'];?>" onclick="ajaxmenu(this);doane(event);">
<div class="chart" style="height: <?php echo $thread['negavotesheight'];?>;" title="反方 (<?php echo $thread['negavotes'];?>)"></div>
</div>
</td>
<td class="si_2">
<div class="point">
<strong>反方观点 (<?php echo $thread['negavotes'];?>)</strong>
<p><?php echo $thread['negapoint'];?></p>
</div>
</td>
</tr>
</table>
</div>
<?php } ?>

<div class="tl">
<?php if($list) { ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="icn">&nbsp;</td>
<th>&nbsp;</th>
<td class="num">正方</td>
<td class="num">反方</td>
<td class="num">人气</td>
<td width="55">进度</td>
</tr><?php if(is_array($list)) foreach($list as $tid => $thread) { ?><tr>
<td>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" title="新窗口打开">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" class="vm" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" class="vm" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" class="vm" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" class="vm" />
<?php } ?>
</a>
</td>
<th height="45">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" class="xi2"><?php echo $thread['subject'];?></a>
<?php if($thread['digest'] > 0) { ?>
<img src="http://static.8264.com/static/image/common/digest_<?php echo $thread['digest'];?>.gif" alt="精华 <?php echo $thread['digest'];?>" align="absmiddle" />
<?php } if($thread['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/filetype/image_s.gif" alt="图片附件" align="absmiddle" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/filetype/common.gif" alt="附件" align="absmiddle" />
<?php } if($thread['multipage']) { ?><span class="tps"><?php echo $thread['multipage'];?></span><?php } ?>
</th>
<td class="xi1"><?php echo $thread['affirmvotes'];?></td>
<td class="xi2"><?php echo $thread['negavotes'];?></td>
<td><?php echo $thread['replies'];?></td>
<td><?php if(!$thread['closed']) { ?>进行中<?php } else { if($thread['winner']) { if($thread['winner']==1) { ?>正方<?php } else { ?>反方<?php } ?>获胜<?php } else { ?>平局<?php } } ?></td>
</tr>
<?php } ?>
</table>
<?php } if($hiddennum) { ?>
<p class="mtm">本页有 <?php echo $hiddennum;?> 个 辩论因隐私问题而隐藏</p>
<?php } ?>
</div>

<?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } else { ?>
<div class="emp">还没有相关的辩论。</div>
<?php } ?>
</div>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
<div class="appl"><?php if(!empty($_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE]; ?><?php getuserapp(1); ?><ul><?php if(is_array($_G['setting']['spacenavs'])) foreach($_G['setting']['spacenavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { if(in_array($nav['code'], array('userpanelarea1', 'userpanelarea2'))) { if(!empty($_G['my_panelapp']) && $_G['setting']['my_app_status']) { if($nav['code']=='userpanelarea1' && !empty($_G['my_panelapp']['1'])) { if(is_array($_G['my_panelapp']['1'])) foreach($_G['my_panelapp']['1'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?php echo $app['appid'];?>" title="<?php echo $app['appname'];?>"><img <?php if($app['icon']) { ?>src="<?php echo $app['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $app['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $app['appid'];?>"<?php } ?> name="<?php echo $appid;?>" alt="<?php echo $app['appname'];?>" /><?php echo $app['appname'];?></a>
</li>
<?php } } elseif($nav['code']=='userpanelarea2' && !empty($_G['my_panelapp']['2'])) { if(is_array($_G['my_panelapp']['2'])) foreach($_G['my_panelapp']['2'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?php echo $app['appid'];?>" title="<?php echo $app['appname'];?>"><img <?php if($app['icon']) { ?>src="<?php echo $app['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $app['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $app['appid'];?>"<?php } ?> name="<?php echo $appid;?>" alt="<?php echo $app['appname'];?>" /><?php echo $app['appname'];?></a>
</li>
<?php } } } } else { ?>
<?php echo $nav['code'];?>
<?php } } } ?>
</ul>
<?php if($_G['setting']['my_app_status']) { if(!empty($_G['cache']['userapp'])) { ?>
<ul id="my_defaultapp"><?php if(is_array($_G['cache']['userapp'])) foreach($_G['cache']['userapp'] as $value) { ?><li><a href="userapp.php?mod=app&amp;id=<?php echo $value['appid'];?>"><img <?php if($value['icon']) { ?>src="<?php echo $value['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $value['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $value['appid'];?>"<?php } ?> alt="<?php echo $value['appname'];?>" /><?php echo $value['appname'];?></a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_top'])) echo $_G['setting']['pluginhooks']['userapp_menu_top']; ?>
</ul>
<?php } if($_G['my_menu']) { ?>
<ul id="my_userapp"><?php if(is_array($_G['my_menu'])) foreach($_G['my_menu'] as $value) { ?><li id="userapp_li_<?php echo $value['appid'];?>"><a href="userapp.php?mod=app&amp;id=<?php echo $value['appid'];?>" title="<?php echo $value['appname'];?>"><img <?php if($value['icon']) { ?>src="<?php echo $value['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $value['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $value['appid'];?>"<?php } ?> alt="<?php echo $value['appname'];?>" /><?php echo $value['appname'];?></a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_middle'])) echo $_G['setting']['pluginhooks']['userapp_menu_middle']; ?>
</ul>
<?php } if($_G['my_menu_more']) { ?>
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">展开</a></p>
<?php } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?php echo IMGDIR;?>/app_add.gif" alt="app_add" />添加<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?php echo IMGDIR;?>/app_set.gif" alt="app_set" />管理<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
</ul>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script><div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>

</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=debate&view=we&fuid='+fuid;
}
</script><?php include template('common/footer'); ?>