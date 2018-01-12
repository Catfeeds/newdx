<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('modcp', 'common/header');
0
|| checktplrefresh('./template/default/forum/modcp.htm', './template/default/common/simplesearchform.htm', 1494326535, '2', './data/template/2_2_forum_modcp.tpl.php', './template/8264', 'forum/modcp')
|| checktplrefresh('./template/default/forum/modcp.htm', './template/8264/common/footer.htm', 1494326535, '2', './data/template/2_2_forum_modcp.tpl.php', './template/8264', 'forum/modcp')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/forum/forum_modcp.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="<?php echo $_G['setting']['navs']['2']['filename'];?>"><?php echo $_G['setting']['navs']['2']['navname'];?></a> <em>&rsaquo;</em>
<a href="forum.php?mod=modcp"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<?php if($script == 'noperm') { ?>
<div class="bm bw0">
<h1 class="mt">系统错误</h1>
<p>对不起，你无此权限。</p>
<p class="notice">论坛管理员在“管理面版”中权限和超级版主基本相同，如果需要更多功能，请进入 <a href="admin.php?mod=forum" target="_blank"><u>管理中心</u></a> </p>
</div>
<?php } elseif(!empty($modtpl)) { ?><?php include(template($modtpl)); } ?>
</div>
<div class="appl">
<div class="tbn">
<ul>
<li<?php if($_G['gp_action'] == 'home') { ?> class="a cl"<?php } else { ?> class="cl"<?php } ?>><span class="y mtn"><?php echo $notenum;?></span><a href="<?php echo $cpscript;?>?mod=modcp&action=home<?php echo $forcefid;?>">内部留言</a></li>
<?php if($modforums['fids']) { if($_G['group']['allowmodpost'] || $_G['group']['allowmoduser']) { ?>
<li<?php if($_G['gp_action'] == 'moderate') { ?> class="a cl"<?php } else { ?> class="cl"<?php } ?>><span class="y mtn"><?php echo $modnum;?></span><a href="<?php echo $cpscript;?>?mod=modcp&action=moderate&op=<?php if($_G['group']['allowmodpost']) { ?>threads<?php echo $forcefid;?><?php } else { ?>members<?php } ?>">审核</a></li>
<?php } } if(!empty($_G['setting']['plugins']['modcp_base'])) { if(is_array($_G['setting']['plugins']['modcp_base'])) foreach($_G['setting']['plugins']['modcp_base'] as $id => $module) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=plugin&op=base&id=<?php echo $id;?><?php echo $forcefid;?>"><?php echo $module['name'];?></a></li>
<?php } } if($_G['group']['allowedituser'] || $_G['group']['allowbanuser'] || $_G['group']['allowbanip']) { if($_G['group']['allowbanuser']) { ?><li<?php if($_G['gp_action'] == 'member' && $op == 'ban') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=member&op=ban<?php echo $forcefid;?>">禁止用户</a></li><?php } if($_G['group']['allowbanip']) { ?><li<?php if($_G['gp_action'] == 'member' && $op == 'ipban') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=member&op=ipban<?php echo $forcefid;?>">禁止 IP</a></li><?php } if($modforums['fids']) { ?><li<?php if($_G['gp_action'] == 'forumaccess') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=forumaccess<?php echo $forcefid;?>">用户权限</a></li><?php } if($_G['group']['allowedituser']) { ?><li<?php if($_G['gp_action'] == 'member' && $op == 'edit') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=member&op=edit<?php echo $forcefid;?>">编辑用户</a></li><?php } } if($modforums['fids']) { ?>
<li<?php if($_G['gp_action'] == 'thread' || $_G['gp_action'] == 'recyclebin') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=thread&op=thread<?php echo $forcefid;?>">主题管理</a></li>
<?php if($_G['group']['allowrecommendthread']) { ?><li<?php if($_G['gp_action'] == 'forum' && $op == 'recommend') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=forum&op=recommend&show=all<?php echo $forcefid;?>">推荐主题</a></li><?php } if($_G['group']['alloweditforum']) { ?><li<?php if($_G['gp_action'] == 'forum' && $op == 'editforum') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=forum&op=editforum<?php echo $forcefid;?>">版块编辑</a></li><?php } } if($_G['group']['allowpostannounce'] || $_G['group']['allowviewlog']) { if($_G['group']['allowpostannounce']) { ?><li<?php if($_G['gp_action'] == 'announcement') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=announcement<?php echo $forcefid;?>">公告</a></li><?php } if($_G['group']['allowviewlog']) { ?><li<?php if($_G['gp_action'] == 'log') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=log<?php echo $forcefid;?>">管理日志</a></li><?php } } if(!empty($_G['setting']['plugins']['modcp_tools'])) { if(is_array($_G['setting']['plugins']['modcp_tools'])) foreach($_G['setting']['plugins']['modcp_tools'] as $id => $module) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=plugin&op=tools&id=<?php echo $id;?>"><?php echo $module['name'];?></a></li>
<?php } } ?>
<li><a href="<?php if($forcefid) { ?>forum.php?mod=forumdisplay<?php echo $forcefid;?><?php } else { ?>forum.php<?php } ?>">返回论坛</a></li>
<li><a href="<?php echo $cpscript;?>?mod=modcp&action=logout">退出</a></li>
</ul>
</div>
</div>
</div></div>
<?php if(empty($topic) || ($topic['usefooter'])) { ?>
<style type="text/css">
.focus{ float:right;}
.sitefocuslist li { background: url(http://static.8264.com/static/images/dot.gif) 0px 7px no-repeat; padding-left: 10px; margin-bottom: 3px;}
.sitefocuslist li a,#sitefocus h3 a,#sitefocus h3 a:visited{ color:#186dd7; font-size: 12px;}
.sitefocuslist li a:hover{ color:#e00000;}
#sitefocus h3 em a:hover{color:red;}
</style>
<?php if($_G['fid']!=489) { ?>
<div id="sitefocus" class="focus" style="display:none;"></div><?php $focusid = getfocus_rand($_G['basescript']); if(getcookie('nofocus_difanban')!=1 && $discuz ) { ?>
<script type="text/javascript">
ajaxget('plugin.php?id=forumoption:ajaxip&difangban=1&focusid=<?php echo $focusid;?>', 'sitefocus');
</script>
<?php } elseif(getcookie('nofocus_'.$focusid) != 1 && $discuz && $focusid !== null) { ?>
<script type="text/javascript">
ajaxget('plugin.php?id=forumoption:ajaxip&difangban=0&focusid=<?php echo $focusid;?>', 'sitefocus');
</script>
<?php } } ?><?php echo adshow("footerbanner/wp a_f/1"); ?><?php echo adshow("footerbanner/wp a_f/2"); ?><?php echo adshow("footerbanner/wp a_f/3"); ?><?php echo adshow("float/a_fl/1"); ?><?php echo adshow("float/a_fr/2"); ?><?php echo adshow("couplebanner/a_fl a_cb/1"); ?><?php echo adshow("couplebanner/a_fr a_cb/2"); ?><?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>
<div id="ft" class="wp cl" style="padding:10px 0px 0px 0px;">
<div id="flk" class="y">
<p>
<strong><a href="http://bbs.8264.com/member.php?mod=clearcookies&amp;formhash=<?php echo formhash();; ?>" target="_blank">清除COOKIE</a></strong><span class="pipe">|</span><?php $fnavcount=0; if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
!$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile'))) { if($nav['id'] == 'mobile' && $_G['setting']['mobile']['allowmobile'] != 1) { ?><?php continue; } ?><?php echo $nav['code'];?><span class="pipe">|</span><?php } } if($_G['setting']['icp']) { ?>( <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_G['setting']['icp'];?></a> )<?php } if($_G['setting']['statcode']) { ?><?php echo $_G['setting']['statcode'];?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footerlink'])) echo $_G['setting']['pluginhooks']['global_footerlink']; ?>
</p>
<p class="xs0">
<span id="debuginfo">
<?php if(debuginfo()) { ?> Processed in <?php echo $_G['debuginfo']['time'];?> second(s), <?php echo $_G['debuginfo']['queries'];?> queries
<?php if($_G['gzipcompress']) { ?>, Gzip On<?php } if($_G['memory']) { ?>, <?php echo ucwords($_G['memory']); ?> On<?php } ?>.
<?php } ?>
</span>
</p>
</div>
<div id="frt">
<p style="color:#333">户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">户外保险</a><?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?></p>
<p class="xs0"></p>
</div>
<?php if($_G['extcnzz']) { ?>
<div style="display:none;"><?php if(is_array($_G['extcnzz'])) foreach($_G['extcnzz'] as $value) { ?><?php echo $value;?>
<?php } ?>
</div>
<?php } ?><?php updatesession(); ?></div><?php } ?><ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?></ul><?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
</div>
<div class="mncr"></div>
</div>
<?php } if(!$_G['setting']['bbclosed']) { if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="home.php?mod=misc&ac=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?><script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script><script src="http://static.8264.com/static/js/portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
<script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_G['member']['newprompt'] && (empty($_G['cookie']['promptstate_'.$_G['uid']]) || $_G['cookie']['promptstate_'.$_G['uid']] != $_G['member']['newprompt']) && $_G['gp_do'] != 'notice') { ?>
<script type="text/javascript">noticeTitle();</script>
<?php } ?>
</body>
</html><?php output(); ?>