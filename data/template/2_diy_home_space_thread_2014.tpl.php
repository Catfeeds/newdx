<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_thread_2014', 'common/header');
0
|| checktplrefresh('./template/8264/home/space_thread_2014.htm', './template/default/common/simplesearchform.htm', 1509518352, 'diy', './data/template/2_diy_home_space_thread_2014.tpl.php', './template/8264', 'home/space_thread_2014')
|| checktplrefresh('./template/8264/home/space_thread_2014.htm', './template/default/common/userabout.htm', 1509518352, 'diy', './data/template/2_diy_home_space_thread_2014.tpl.php', './template/8264', 'home/space_thread_2014')
|| checktplrefresh('./template/8264/home/space_thread_2014.htm', './template/8264/home/space_userabout.htm', 1509518352, 'diy', './data/template/2_diy_home_space_thread_2014.tpl.php', './template/8264', 'home/space_thread_2014')
;?>
<?php $filter = array( 'common' => '已发表', 'save' => '草稿箱', 'close' => '已关闭', 'aduit' => '待审核', 'recyclebin' => '回收站');
$_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=thread&amp;view=me\">TA的所有帖子</a>"; if(empty($diymode)) { include template('common/header'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" />
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
<a href="home.php?mod=space&amp;do=thread">帖子</a>
<?php if($_G['gp_view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me"><?php echo $space['username'];?>的帖子</a>
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
<h1 class="mt"><img alt="thread" src="http://static.8264.com/static/image/feed/thread.gif" class="vm" /> 帖子</h1>
<?php } if($space['self']) { ?>
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=we">好友的帖子</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me">我的帖子</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=all&amp;order=dateline">随便看看</a></li>
<li class="o"><a href="forum.php?mod=misc&amp;action=nav" onclick="showWindow('nav', this.href, 'get', 0)">发帖</a></li>
</ul>
<?php if($_G['gp_view'] == 'me') { ?>
<p class="tbmu bw0">
<?php if($viewtype != 'postcomment') { ?>
<span class="y">
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me&amp;type=<?php echo $viewtype;?>&amp;from=<?php echo $_G['gp_from'];?>&amp;filter=" <?php if(!$_G['gp_filter']) { ?>class="a"<?php } ?>>全部</a><?php if(is_array($filter)) foreach($filter as $key => $name) { ?><span class="pipe">|</span><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=thread&amp;view=me&amp;type=<?php echo $viewtype;?>&amp;from=<?php echo $_G['gp_from'];?>&amp;filter=<?php echo $key;?>" <?php if($key == $_G['gp_filter']) { ?>class="a"<?php } ?>><?php echo $name;?></a>
<?php } ?>
</span>
<?php } ?>
<a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=thread&amp;uid=<?php echo $space['uid'];?>" <?php echo $orderactives['thread'];?>>主题</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=reply&amp;uid=<?php echo $space['uid'];?>" <?php echo $orderactives['reply'];?>>回复</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=postcomment&amp;uid=<?php echo $space['uid'];?>" <?php echo $orderactives['postcomment'];?>>点评</a>
</p>
<?php } elseif($_G['gp_view'] == 'all') { ?>
<p class="tbmu bw0">
<a href="home.php?mod=space&amp;do=thread&amp;view=all&amp;order=dateline" <?php echo $orderactives['dateline'];?>>最新帖子</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=thread&amp;view=all&amp;order=hot" <?php echo $orderactives['hot'];?>>热门帖子</a>
</p>
<?php } } else { include template('home/space_menu'); ?><p class="tbmu bw0">按照发布时间排序</p>
<?php } if($userlist) { ?>
<p class="tbmu bw0">
按好友查看
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
</p>
<?php } if($actives['we'] && !$userlist && !$list) { ?>
<p class="mbm"></p>
<?php } } else { include template('home/space_header'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" />
<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl">
<h1 class="mt">
<?php if($_G['gp_type'] == 'reply') { ?>
<span class="xs1 xw0"><a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=thread&amp;uid=<?php echo $space['uid'];?>&amp;from=space">主题</a><span class="pipe">|</span></span>回复
<?php } else { ?>
主题<span class="xs1 xw0"><span class="pipe">|</span><a href="home.php?mod=space&amp;do=thread&amp;view=me&amp;type=reply&amp;uid=<?php echo $space['uid'];?>&amp;from=space">回复</a></span>
<?php } if($space['self']) { ?><span class="xs1 xw0">( <a href="forum.php?mod=misc&amp;action=nav" onclick="showWindow('nav', this.href, 'get', 0)">发帖</a> )</span><?php } ?>
</h1>
</div>
<div class="bm_c">
<?php } ?>

<div class="tl">
<form method="post" autocomplete="off" name="delform" id="delform" action="home.php?mod=space&amp;do=thread&amp;view=all&amp;order=dateline" onsubmit="showDialog('确定要删除选中的主题吗？', 'confirm', '', '$(\'delform\').submit();'); return false;">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="delthread" value="true" />

<table cellspacing="0" cellpadding="0">
<tr class="th">
<td class="icn">&nbsp;</td>
<?php if($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid']) { ?>
<td class="o">&nbsp;</td>
<?php } ?>
<th><?php if($viewtype == 'reply' || $viewtype == 'postcomment') { ?>帖子<?php } else { ?>主题<?php } ?></th>
<td class="frm">版块<?php if($actives['me'] && $space['uid'] == $_G['uid']) { ?>/群组<?php } ?></td>
<?php if($viewtype != 'postcomment') { if(!$actives['me']) { ?>
<td class="by">作者</td>
<?php } ?>
<td class="num">回复/查看</td>
<?php if($actives['me']) { ?>
<td class="by"><cite>最后发帖</cite></td>
<?php } } ?>
</tr>

<?php if($list) { if(is_array($list)) foreach($list as $thread) { ?><tr<?php if($actives['me'] && $viewtype=='reply' || $viewtype=='postcomment') { ?> class="bw0_all"<?php } ?>>
<td class="icn">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" title="新窗口打开" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="投票" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="商品" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="悬赏" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="活动" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" />
<?php } ?>
</a>
</td>
<?php if($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid']) { ?>
<td class="o">
<?php if($thread['digest'] == 0) { if($thread['displayorder'] == 0) { ?>
<input type="checkbox" name="moderate[]" value="<?php echo $thread['tid'];?>" class="pc" />
<?php } else { ?>
<input type="checkbox" class="pc" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" class="pc" disabled="disabled" />
<?php } ?>
</td>
<?php } ?>
<th>
<?php if($viewtype == 'reply' || $viewtype == 'postcomment') { ?>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;ptid=<?php echo $thread['tid'];?>&amp;pid=<?php echo $thread['pid'];?>" target="_blank" rel="nofollow"><?php echo $thread['subject'];?></a>
<?php } else { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" target="_blank" <?php if($thread['displayorder'] == -1) { ?>class="recy"<?php } ?>><?php echo $thread['subject'];?></a>
<?php } if($thread['stamp']==0 && $thread['rate']>0) { ?><img src="http://static.8264.com/static/image/common/th_b.jpg" title="奖励8264币" align="absmiddle" style="padding-right: 3px;" /><?php } if($thread['digest'] > 0) { } if($thread['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/filetype/image_s.gif" alt="图片附件" align="absmiddle" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/filetype/common.gif" alt="附件" align="absmiddle" />
<?php } if($thread['multipage']) { ?><span class="tps"><?php echo $thread['multipage'];?></span><?php } if(!$_G['gp_filter']) { if($thread['displayorder'] == -1) { ?><span class="xg1"><?php echo $filter['recyclebin'];?></span>
<?php } elseif($thread['displayorder'] == -2) { ?><span class="xg1"><?php echo $filter['aduit'];?></span>
<?php } elseif($thread['displayorder'] == -3) { ?><span class="xg1"><?php echo $filter['ignored'];?></span>
<?php } elseif($thread['displayorder'] == -4) { ?><span class="xg1"><?php echo $filter['save'];?></span>
<?php } elseif($thread['closed'] == 1) { ?><span class="xg1"><?php echo $filter['close'];?></span>
<?php } } ?>
</th>
<td>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $thread['fid'];?>" class="xg1"><?php echo $forums[$thread['fid']];?></a>
</td>
<?php if($viewtype != 'postcomment') { if(!$actives['me']) { ?>
<td>
<cite><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>"><?php echo $thread['author'];?></a></cite>
<em><?php echo $thread['dateline'];?></em>
</td>
<?php } ?>

<td class="num">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" class="xi2"><?php echo $thread['replies'];?></a>
<em><?php echo $thread['views'];?></em>
</td>

<?php if($actives['me']) { ?>
<td class="by">
<cite><a href="home.php?mod=space&amp;username=<?php echo $thread['lastposterenc'];?>" rel="nofollow"><?php echo $thread['lastposter'];?></a></cite>
<em><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" rel="nofollow"><?php echo $thread['lastpost'];?></a></em>
</td>
<?php } } ?>
</tr>
<?php if($actives['me'] && $viewtype=='reply') { ?>
<tr>
<td colspan="5" class="xg1"><?php if($thread['message']) { ?>&nbsp;<img src="http://static.8264.com/static/image/common/icon_quote_m_s.gif" style="vertical-align:middle;" /> <?php echo $thread['message'];?> <img src="http://static.8264.com/static/image/common/icon_quote_m_e.gif" style="vertical-align:middle;" /><?php } ?></td>
</tr>
<?php } if($actives['me'] && $viewtype=='postcomment') { ?>
<tr>
<td class="icn">&nbsp;</td>
<td colspan="2" class="xg1"><?php echo $thread['comment'];?></td>
</tr>
<?php } } } else { ?>
<tr>
<td colspan="<?php if($viewtype != 'postcomment') { if(($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid'])) { ?>6<?php } else { ?>5<?php } } else { ?>3<?php } ?>"><p class="emp">还没有相关的帖子</p></td>
</tr>
<?php } ?>
</table>

<?php if($_G['gp_view'] == 'all' && $pruneperm && !$_G['gp_archiveid'] && $list) { ?>
<p class="mtm pns">
<input type="checkbox" name="chkall" id="chkall" class="pc vm" onclick="checkall(this.form, 'moderate')" />
<label for="chkall">全选</label>&nbsp;&nbsp;
<button type="submit" name="delsubmit" value="true" class="pn vm"><em>删除选中主题</em></button>
</p>
<?php } ?>
</form>

<?php if($hiddennum) { ?>
<p class="mtm">本页有 <?php echo $hiddennum;?> 篇帖子因隐私问题而隐藏</p>
<?php } ?>
</div>
<?php if($multi) { ?>
<div class="pgs cl mtm"><?php echo $multi;?></div>
<?php } else { ?>
<div class="fheight"></div>
<?php } ?>


<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=thread&view=we&fuid='+fuid;
}
</script>

<?php if(empty($diymode)) { ?>

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


<?php } else { ?>
</div>
</div>
</div>
<div class="sd"><div id="pcd" class="bm cl">
<div class="hm">
<p><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo avatar($space[uid],middle); ?></a></p>
<h2 class="xs2"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo $space['username'];?></a></h2>
</div>
<?php if(file_exists(DISCUZ_ROOT.'/source/plugin/userverify/UserVerify.php')) { ?><?php require_once DISCUZ_ROOT.'/source/plugin/userverify/UserVerify.php'; ?><?php UserVerify::renderUserInfoHtml($space['uid']); } ?>
<ul class="xl xl2 cl ul_list">
<?php if($space['self']) { ?>
<li class="ul_diy"><a href="home.php?mod=space&amp;diy=yes">装扮空间</a></li>
<li class="ul_msg"><a href="home.php?mod=space&amp;do=wall">查看留言</a></li>
<li class="ul_avt"><a href="home.php?mod=spacecp&amp;ac=avatar">编辑头像</a></li>
<li class="ul_profile"><a href="home.php?mod=spacecp&amp;ac=profile">更新资料</a></li>
<?php } else { ?><?php require_once libfile('function/friend');$isfriend=followed_by_me($_G[uid], $space[uid]); ?><li class="ul_add" <?php if($isfriend) { ?>style="display:none;"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=addfriendhk_<?php echo $space['uid'];?>" id="a_friend_li_<?php echo $space['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">添加关注</a></li>
<li class="ul_ignore" <?php if(! $isfriend) { ?>style="display:none;"<?php } ?>><a href="javascript:void(0);" class="unfollow" fuid="<?php echo $space['uid'];?>">取消关注</a></li>
<li class="ul_contect"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=wall">给我留言</a></li>
<li class="ul_poke"><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=propokehk_<?php echo $space['uid'];?>" id="a_poke_<?php echo $space['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">打个招呼</a></li>
<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;touid=<?php echo $space['uid'];?>">发送消息</a></li>
<!--<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $space['uid'];?>&amp;touid=<?php echo $space['uid'];?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?php echo $space['uid'];?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></li>-->
<?php } ?>
</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<hr class="da mtn m0">
<ul class="ptn xl xl2 cl">
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<li>
<?php if(checkperm('allowbanuser')) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?php echo $space['username'];?>&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?php echo $space['uid'];?><?php } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<?php } else { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?php echo $space['username'];?>&submit=yes&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $space['uid'];?><?php } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<?php } ?>
</li>
<?php } if($_G['adminid'] == 1) { ?>
<li><a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?php echo $space['username'];?>" id="umanageli" onmouseover="showMenu(this.id)" class="showmenu">内容管理</a></li>
<?php } ?>
</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<ul id="usermanageli_menu" class="p_pop" style="width: 80px; display:none;">
<?php if(checkperm('allowbanuser')) { ?>
<li><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?php echo $space['username'];?>&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?php echo $space['uid'];?><?php } ?>" target="_blank">禁止用户</a></li>
<?php } if(checkperm('allowedituser')) { ?>
<li><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?php echo $space['username'];?>&submit=yes&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $space['uid'];?><?php } ?>" target="_blank">编辑用户</a></li>
<?php } ?>
</ul>
<?php } if($_G['adminid'] == 1) { ?>
<ul id="umanageli_menu" class="p_pop" style="width: 80px; display:none;">
<li><a href="admin.php?action=threads&amp;users=<?php echo $space['username'];?>" target="_blank">管理帖子</a></li>
<li><a href="admin.php?action=doing&amp;searchsubmit=1&amp;users=<?php echo $space['username'];?>" target="_blank">管理记录</a></li>
<li><a href="admin.php?action=blog&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理日志</a></li>
<li><a href="admin.php?action=feed&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理动态</a></li>
<li><a href="admin.php?action=album&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理相册</a></li>
<li><a href="admin.php?action=pic&amp;searchsubmit=1&amp;users=<?php echo $space['username'];?>" target="_blank">管理图片</a></li>
<li><a href="admin.php?action=comment&amp;searchsubmit=1&amp;authorid=<?php echo $space['uid'];?>" target="_blank">管理评论</a></li>
<li><a href="admin.php?action=share&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理分享</a></li>
<li><a href="admin.php?action=threads&amp;operation=group&amp;users=<?php echo $space['username'];?>" target="_blank">群组主题</a></li>
<li><a href="admin.php?action=prune&amp;searchsubmit=1&amp;operation=group&amp;users=<?php echo $space['username'];?>" target="_blank">群组帖子</a></li>
</ul>
<?php } } ?>
</div>
</div>
<script type="text/javascript">
setTimeout(function() {
jQuery(document).ready(function() {
/*unfollow to somebody*/
jQuery("li.ul_ignore a.unfollow").off("click").click(function(e) {
var uid = jQuery(this).attr("fuid");
var url = "home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=%uid&amp;confirm=1";
url = url.replace(/%uid/g, uid).replace(/&amp;/g, "&");
dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, {uid:uid}, function(data) {
if(data == 'success') {
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
jQuery("li.ul_add").show();
jQuery("li.ul_ignore").hide();
}
});
});
e.preventDefault();
});
});
}, 3000);
function callback_follow_successfully(mutual) {
jQuery("li.ul_add").hide();
jQuery("li.ul_ignore").show();
}
</script></div>
</div>
<?php } include template('common/footer'); ?>