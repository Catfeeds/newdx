<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_album_list', 'common/header');
0
|| checktplrefresh('./template/default/home/space_album_list.htm', './template/default/common/simplesearchform.htm', 1509517888, 'diy', './data/template/2_diy_home_space_album_list.tpl.php', './template/8264', 'home/space_album_list')
|| checktplrefresh('./template/default/home/space_album_list.htm', './template/default/common/userabout.htm', 1509517888, 'diy', './data/template/2_diy_home_space_album_list.tpl.php', './template/8264', 'home/space_album_list')
|| checktplrefresh('./template/default/home/space_album_list.htm', './template/8264/home/space_userabout.htm', 1509517888, 'diy', './data/template/2_diy_home_space_album_list.tpl.php', './template/8264', 'home/space_album_list')
;?>
<?php $friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见'); if(empty($diymode)) { include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
<a href="home.php?mod=space&amp;do=album">相册</a>
<?php if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me"><?php echo $space['username'];?>的相册</a>
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
<h1 class="mt"><img alt="album" src="http://static.8264.com/static/image/feed/album.gif" class="vm" /> 相册</h1>
<?php } if($space['self']) { ?>
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=we">好友的相册</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me">我的相册</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=all">随便看看</a></li>
<li class="o"><a href="home.php?mod=spacecp&amp;op=flash&amp;ac=upload">上传图片</a></li>
</ul>
<?php } else { ?><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;view=me\">TA的所有相册</a>"; include template('home/space_menu'); } if($space['self'] && $_GET['view']=='me') { ?>
<p class="tbmu">
下面列出的是你自行创建相册列表。<br />
						你在日志里面上传的图片附件，全部存放在 <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;id=-1" style="font-weight: 700;">系统默认相册</a> 里面。
</p>
<?php } if($_GET['view'] == 'all') { ?>
<div class="tbmu cl">
<?php if($_GET['view']=='all' && $_G['setting']['albumcategorystat'] && $category) { ?>	
<div class="y">
<select name="albumlist" id="albumlist" width="68" onchange="location.href='home.php?mod=space&do=album&catid='+this.value+'&view=all'">
<option value="">分类浏览</option><?php if(is_array($category)) foreach($category as $value) { ?><option value="<?php echo $value['catid'];?>"<?php if($_GET['catid']==$value['catid']) { ?> selected="selected"<?php } ?>><?php echo $value['catname'];?></option>
<?php } ?>
</select>
</div>
<?php } ?>
<a href="home.php?mod=space&amp;do=album&amp;view=all&amp;order=dateline" <?php echo $orderactives['dateline'];?>>最新更新的相册</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=album&amp;view=all&amp;order=hot" <?php echo $orderactives['hot'];?>>热门图片推荐</a>
</div>
<?php } if(($_GET['view'] == 'we') && $userlist) { ?>
<p class="tbmu">
按好友筛选
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
</p>
<?php } } else { include template('home/space_header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl" style="white-space: normal;">
<h1 class="mt">相册<?php if($space['self'] || $_G['adminid'] > 0) { ?><span class="xs1 xw0">( <a href="home.php?mod=spacecp&amp;ac=upload&amp;op=flash">上传图片</a> )</span ><?php if(getcookie( 'albumerror_kill_' . $space['uid'] ) == 1) { ?><span></span><?php } else { ?><span class="xs1 xw0" id="albumerror" ><span onclick="ajaxget('plugin.php?id=api:albumerror&authorid=<?php echo $space['uid'];?>', 'albumerror');" onmouseover="$('albumtips').style.display = 'block';" onmouseout="$('albumtips').style.display = 'none';">封面不见了？</span><div id="albumtips" style="display:none;"><span>如若相册封面或相册图片数有问题，请点击手动刷新。</span></div></span><?php } ?><div style="clear: both;"></div><?php } ?></h1>
</div>
<div class="bm_c">
<?php } ?>


<div class="ptw">
<?php if($picmode) { if($pricount) { ?>
<p class="mbw">本页有 <?php echo $pricount;?> 张图片因作者的隐私设置或未通过而隐藏</p>
<?php } if($count) { ?>
<ul class="ml mlp cl"><?php if(is_array($list)) foreach($list as $key => $value) { ?><li class="d">
<div class="c">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=album&amp;picid=<?php echo $value['picid'];?>"><?php if($value['pic']) { ?><img src="<?php echo $value['pic'];?>" alt="" /><?php } ?></a>
</div>
<p class="ptm"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=album&amp;id=<?php echo $value['albumid'];?>" class="xi2"><?php echo $value['albumname'];?></a></p>
<span><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo $value['username'];?></a></span>
</li>
<?php } ?>
</ul>
<?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } else { ?>
<div class="emp">没有可浏览的列表。</div>
<?php } } else { if($searchkey) { ?>
<p class="mbw">以下是搜索相册 <span style="color: red; font-weight: 700;"><?php echo $searchkey;?></span> 结果列表</p>
<?php } if($pricount) { ?>
<p class="mbw">提示：本页有 <?php echo $pricount;?> 个相册因作者的隐私设置而隐藏</p>
<?php } if($count) { ?>
<ul class="ml mla cl"><?php if(is_array($list)) foreach($list as $key => $value) { ?><?php $pwdkey = 'view_pwd_album_'.$value['albumid']; ?><li>
<div class="c">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=album&amp;id=<?php echo $value['albumid'];?>" <?php if($value['uid']!=$_G['uid'] && $value['friend']=='4' && $value['password'] && empty($_G['cookie'][$pwdkey])) { ?> onclick="showWindow('list_album_<?php echo $value['albumid'];?>', this.href, 'get', 0);"<?php } ?>><?php if($value['pic']) { ?><img src="<?php echo $value['pic'];?>" alt="<?php echo $value['albumname'];?>" onerror="$('albumerror').style.color='red';$('albumtips').style.display = 'block';"/><?php } ?></a>
</div>
<p class="ptn"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=album&amp;id=<?php echo $value['albumid'];?>" <?php if($value['uid']!=$_G['uid'] && $value['friend']=='4' && $value['password'] && empty($_G['cookie'][$pwdkey])) { ?> onclick="showWindow('list_album_<?php echo $value['albumid'];?>', this.href, 'get', 0);"<?php } ?> class="xi2"><?php if($value['albumname']) { ?><?php echo $value['albumname'];?><?php } else { ?>默认相册<?php } ?></a><?php if($value['picnum']) { ?> (<?php echo $value['picnum'];?>) <?php } ?></p>
<?php if($value['uid']==$_G['uid']) { ?>
<p class="xg1"><a href="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?php echo $value['albumid'];?>">编辑</a> <a href="home.php?mod=spacecp&amp;ac=upload&amp;op=flash&amp;albumid=<?php echo $value['albumid'];?>">上传</a>
</p>
<?php } else { ?>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo $value['username'];?></a></p>
<?php } if($_GET['view']!='me') { ?><span>更新 <?php echo dgmdate($value[updatetime], 'n-j H:i'); ?></span><?php } ?>
</li>
<?php } ?>
</ul>
<?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } else { ?>
<div class="emp">没有可浏览的列表。</div>
<?php } } ?>
</div>

<style>
#albumtips{position:absolute;padding:7px; background: url('./static/image/common/tips_album.png') no-repeat;width:174px;height:64px;white-space: normal;line-height:20px;left:368px;top:152px;}
#albumtips span{margin-right:10px;display:block;color:white;}
#albumerror{margin-left:10px;cursor:pointer;float:right;color:#006699;}
</style> 
<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=album&view=we&fuid='+fuid;
}
if($('albumtips') != null){
$('albumtips').style.top = $('albumerror').offsetTop - 70 + 'px';
$('albumtips').style.left = $('albumerror').offsetLeft + 10 + 'px';
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
<script type="text/javascript">inituserabout();</script></div>
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