<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_reward', 'common/header');
0
|| checktplrefresh('./template/default/home/space_reward.htm', './template/default/common/simplesearchform.htm', 1505972340, 'diy', './data/template/2_diy_home_space_reward.tpl.php', './template/8264', 'home/space_reward')
|| checktplrefresh('./template/default/home/space_reward.htm', './template/default/common/userabout.htm', 1505972340, 'diy', './data/template/2_diy_home_space_reward.tpl.php', './template/8264', 'home/space_reward')
;?>
<?php $_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=reward&amp;view=me\">TA����������</a>"; include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="��������">��������</label></li>
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
 /><label for="mod_article" title="��������">����</label></li>
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
 /><label for="mod_thread" title="����{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
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
 /><label for="mod_blog" title="������־">��־</label></li>
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
 /><label for="mod_album" title="�������">���</label></li>
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
 /><label for="mod_group" title="����{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="�����û�">�û�</label></li>
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
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">����</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="��������������" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">����</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=reward">����</a>
<?php if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=reward&amp;view=me"><?php echo $space['username'];?>������</a>
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
<h1 class="mt"><img alt="reward" src="http://static.8264.com/static/image/common/rewardsmall.gif" class="vm" /> ����</h1>
<?php } if($space['self']) { ?>
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=reward&amp;view=we">���ѷ���������</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=reward&amp;view=me">�ҵ�����</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=reward&amp;view=all">��㿴��</a></li>
<?php if($_G['group']['allowpostreward']) { ?>
<li class="o">
<?php if($_G['setting']['rewardforumid']) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['setting']['rewardforumid'];?>&amp;special=3">����������</a>
<?php } else { ?>
<a href="forum.php?mod=misc&amp;action=nav&amp;special=3" onclick="showWindow('nav', this.href)">����������</a>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php } else { include template('home/space_menu'); } ?>
<p class="tbmu cl"><?php $flag = array(0 => 'ȫ��', 1 => 'δ���', -1 => '�ѽ��'); ?><span class="y">
<select onchange="filterFlag(this.value)"><?php if(is_array($flag)) foreach($flag as $key => $str) { ?><option value="<?php echo $key;?>"<?php if($_G['gp_flag']==$key) { ?> selected="selected"<?php } ?>><?php echo $str;?></option>
<?php } ?>
</select>
</span>
<?php if($_GET['view'] == 'all') { ?>
<a href="home.php?mod=space&amp;do=reward&amp;view=all" <?php echo $orderactives['new'];?>>��������</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=reward&amp;view=all&amp;order=hot" <?php echo $orderactives['hot'];?>>��������</a>
<?php } if($userlist) { ?>
�����Ѳ鿴
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">ȫ������</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
<?php } ?>
</p>
<?php if($count) { ?>
<ul class="rwdl cl"><?php if(is_array($list)) foreach($list as $thread) { ?><li class="bbda">
<div class="uslvd <?php if($thread['price'] < 0) { ?> slvd<?php } ?>">
<cite><?php echo abs($thread['price']); ?><span><?php echo $_G['setting']['extcredits'][$creditid]['title'];?></span></cite>
<em><?php if($thread['price'] < 0) { ?>�ѽ��<?php } else { ?>δ���<?php } ?></em>
</div>
<h4><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>"><?php echo $thread['subject'];?></a></h4>
<p class="mtm"><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" c="1"><?php echo $thread['author'];?></a> <span class="xg1"><?php echo $thread['dateline'];?></span></p>
<p class="mtm xg1"><?php if($thread['replies']) { ?>���� <?php echo $thread['replies'];?> ��<?php } else { ?>����<?php } ?>�ش�<span class="pipe">|</span><a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $thread['fid'];?>&amp;tid=<?php echo $thread['tid'];?>">�����ش�</a></p>
</li>
<?php } if(count($list)%2!=0) { ?>
<li class="bbda">&nbsp;</li>
<?php } ?>
</ul>
<?php if($hiddennum) { ?>
<p class="mtm">��ҳ�� <?php echo $hiddennum;?> ����������˽���������</p>
<?php } if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } else { ?>
<div class="emp">��û����ص����͡�</div>
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
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">չ��</a></p>
<?php } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?php echo IMGDIR;?>/app_add.gif" alt="app_add" />���<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?php echo IMGDIR;?>/app_set.gif" alt="app_set" />����<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
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
window.location.href = 'home.php?mod=space&do=reward&view=we&<?php if($_G['gp_flag']) { ?>flag=<?php echo $_G['gp_flag'];?>&<?php } ?>fuid='+fuid;
}
function filterFlag(flag) {
window.location.href = 'home.php?mod=space&do=<?php echo $_G['gp_do'];?>&<?php if($_G['gp_order']) { ?>order=hot&<?php } ?>view=<?php echo $_G['gp_view'];?>&<?php if($_G['gp_fuid']) { ?>fuid=<?php echo $_G['gp_fuid'];?>&<?php } ?>flag='+flag;
}
</script><?php include template('common/footer'); ?>