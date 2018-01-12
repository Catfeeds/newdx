<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_favorite', 'common/header');
0
|| checktplrefresh('./template/8264/home/spacecp_favorite.htm', './template/default/common/simplesearchform.htm', 1509519089, '2', './data/template/2_2_home_spacecp_favorite.tpl.php', './template/8264', 'home/spacecp_favorite')
|| checktplrefresh('./template/8264/home/spacecp_favorite.htm', './template/default/common/userabout.htm', 1509519089, '2', './data/template/2_2_home_spacecp_favorite.tpl.php', './template/8264', 'home/spacecp_favorite')
;?><?php include template('common/header'); if(!$_G['inajax']) { ?>
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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm">
<?php } if($_GET['op'] == 'delete') { ?>	
<form id="favoriteform_<?php echo $favid;?>" name="favoriteform_<?php echo $favid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=favorite&amp;op=delete&amp;favid=<?php echo $favid;?>&amp;type=<?php echo $_GET['type'];?>&amp;is_uc=1" <?php if($_G['inajax'] && $_GET['gp_type']!='view') { ?> onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>


<div class="popbox w450 textcenter">			
<div class="dhinfo">
<span>你确定要删除此收藏吗？</span>
<em></em>
</div>
<div>
<button type="submit" name="deletesubmitbtn" value="true" class="button_cancel"><strong>确定</strong></button>
<?php if($_G['inajax']) { ?><input class="button_confirm" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="取消" type="button"/><?php } ?>
</div>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="margin-top:20px;display:none;">删除回复</div>				
</div>	

<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>		
</form>
<?php if($_G['inajax'] && $_GET['gp_type']!='view') { ?>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
if (values['success']) {
location.reload();
}
}
</script>
<?php } } else { if(!$_G['gp_is_uc']) { ?>

<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">收藏</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" id="favoriteform_<?php echo $id;?>" name="favoriteform_<?php echo $id;?>" action="home.php?mod=spacecp&amp;ac=favorite&amp;type=<?php echo $type;?>&amp;id=<?php echo $id;?>&amp;spaceuid=<?php echo $spaceuid;?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>'<?php if($type == 'thread') { ?>, null, null, null, 'favoriteupdate()'<?php } ?>);"<?php } ?>>
<input type="hidden" name="favoritesubmit" value="true" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div class="c">
<p>已有 <b><?php echo $fav_count;?></b> 个人收藏过本条目</p>
<p>收藏说明:</p>
<textarea id="general_<?php echo $id;?>" name="description" cols="50" rows="5" class="pt mtn" style="width: 400px;" onkeydown="ctrlEnter(event, 'favoritesubmit_btn')"><?php echo $description;?></textarea>
</div>
<p class="o pns">
<button type="submit" name="favoritesubmit_btn" id="favoritesubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<?php } else { ?>
<form method="post" autocomplete="off" id="favoriteform_<?php echo $id;?>" name="favoriteform_<?php echo $id;?>" action="home.php?mod=spacecp&amp;ac=favorite&amp;type=<?php echo $type;?>&amp;id=<?php echo $id;?>&amp;spaceuid=<?php echo $spaceuid;?>&amp;is_uc=1" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>'<?php if($type == 'thread') { ?>, null, null, null, 'favoriteupdate()'<?php } ?>);"<?php } ?>>
<div class="popbox w570">
<div class="popbox_title clearfix">
<span id="return_<?php echo $_G['gp_handlekey'];?>">收藏</span>			
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
<div class="textareabox">
<p style="margin-bottom:10px;">已有 <b><?php echo $fav_count;?></b> 个人收藏过本条目</p>
<textarea id="general_<?php echo $cid;?>" name="description" cols="" rows="" onkeydown="ctrlEnter(event, 'favoritesubmit_btn');" placeholder="收藏说明"><?php echo $description;?></textarea>
<button type="submit" name="favoritesubmit_btn" id="favoritesubmit_btn" value="true" class="button_confirm"><strong>确定</strong></button>
</div>		
</div>
<input type="hidden" name="favoritesubmit" value="true" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
if (values['success']) {
location.reload();
}
}
</script>
<?php } } if(!$_G['inajax']) { ?>
</div>
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
<?php } include template('common/footer'); ?>