<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('group', 'common/header');
0
|| checktplrefresh('./template/default/group/group.htm', './template/default/common/simplesearchform.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_index.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_list.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_memberlist.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_create.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_invite.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_manage.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/default/group/group_right.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
|| checktplrefresh('./template/default/group/group.htm', './template/8264/common/footer.htm', 1509518693, 'diy', './data/template/2_diy_group_group.tpl.php', './template/8264', 'group/group')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/group/group_group.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em><a href="group.php"><?php echo $_G['setting']['navs']['3']['navname'];?></a><?php if($groupnav) { ?><?php echo $groupnav;?><?php } elseif($action == 'create') { ?><em>&rsaquo;</em>����<?php echo $_G['setting']['navs']['3']['navname'];?><?php } ?>
</div>
</div><?php echo adshow("text/wp a_t"); ?><style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2 wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<?php if($action != 'create') { if($_G['forum']['banner']) { ?>
<div id="gh">
<img src="<?php echo $_G['forum']['banner'];?>?<?php echo date('Ymd'); ?>" width="100%" alt="" />
<div class="bm bmw bw0">
<div class="bm_h bw0 cl">
<h1 class="xs2"><?php echo $_G['forum']['name'];?></h1>
</div>
<div class="bm_c">
<?php if($_G['forum']['description']) { ?><div class="pbn"><?php echo $_G['forum']['description'];?></div><?php } ?>
<div>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=group&amp;id=<?php echo $_G['forum']['fid'];?>&amp;handlekey=sharealbumhk_<?php echo $_G['forum']['fid'];?>" id="a_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" title="�ղ�" class="fa_fav">�ղ�</a><span class="pipe">|</span><?php if($_G['setting']['rssstatus'] && !$_G['gp_archiveid']) { ?><a href="forum.php?mod=rss&amp;fid=<?php echo $_G['fid'];?>&amp;auth=<?php echo $rssauth;?>" target="_blank" title="RSS" class="fa_rss">RSS</a><?php } if($status == 'isgroupuser') { ?><span class="pipe">|</span><a href="javascript:;" onclick="showWindow('invite','misc.php?mod=invite&action=group&id=<?php echo $_G['fid'];?>')" class="fa_ivt"><strong class="xi2">�������</strong></a><?php } ?>
<span class="pipe">|</span><?php if($_G['current_grouplevel']['icon']) { ?><img src="<?php echo $_G['current_grouplevel']['icon'];?>" title="<?php echo $_G['setting']['navs']['3']['navname'];?>�ȼ�: <?php echo $_G['current_grouplevel']['leveltitle'];?>" class="vm"> <?php } ?>����: <?php echo $_G['forum']['commoncredits'];?><span class="pipe">|</span>Ⱥ��: <?php $i = 1; if(is_array($groupmanagers)) foreach($groupmanagers as $manage) { if($i <= 0) { ?>, <?php } ?><?php $i--; ?><a href="home.php?mod=space&amp;uid=<?php echo $manage['uid'];?>" target="_blank" class="xi2"><?php echo $manage['username'];?></a><?php } ?>
</div>
<?php if($status != 2 && $status != 3 && $status != 5) { if($status != 'isgroupuser') { ?>
<div class="ptm pbn">
<button type="button" class="pn" onclick="location.href='forum.php?mod=group&action=join&fid=<?php echo $_G['fid'];?>'"><em>����<?php echo $_G['setting']['navs']['3']['navname'];?></em></button>
</div>
<?php } if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_navlink'])) echo $_G['setting']['pluginhooks']['group_navlink']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_navlink'])) echo $_G['setting']['pluginhooks']['forumdisplay_navlink']; } } if($action == 'index' && ($status == 2 || $status == 3 || $status == 5)) { ?>
<p class="mtm">
���뷽ʽ: 
<?php if($_G['forum']['jointype'] == 1) { ?>
<strong>�������</strong>
<?php } elseif($_G['forum']['jointype'] == 2) { ?>
<strong>��˼���</strong>
<?php } else { ?>
<strong>���ɼ���</strong>
<?php } ?>
���Ȩ��: <strong><?php if($_G['forum']['gviewperm'] == 0) { ?>����Ա<?php } else { ?>������<?php } ?></strong>
</p>
<p class="mtm xi1">
<?php if($status == 3 || $status == 5) { ?>
�Ѽ����<?php echo $_G['setting']['navs']['3']['navname'];?>���ȴ�Ⱥ�������...
<?php } else { ?>
<button type="button" class="pn" onclick="location.href='forum.php?mod=group&action=join&fid=<?php echo $_G['fid'];?>'"><em>����<?php echo $_G['setting']['navs']['3']['navname'];?></em></button>
<?php } ?>
</p>
<?php } ?>
</div>
</div>
</div>
<?php } else { ?>
<div class="bm">
<div class="bm_c xld xlda cl">
<dl>
<dd class="m"><img src="<?php echo $_G['forum']['icon'];?>" alt="<?php echo $_G['forum']['name'];?>" width="48" height="48" /></dd>
<dt><?php echo $_G['forum']['name'];?></dt>
<?php if($_G['forum']['description']) { ?><dd><?php echo $_G['forum']['description'];?></dd><?php } ?>
<dd class="cl">
<span class="y"><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=group&amp;id=<?php echo $_G['forum']['fid'];?>&amp;handlekey=sharealbumhk_<?php echo $_G['forum']['fid'];?>" id="a_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" title="�ղ�" class="fa_fav">�ղ�</a><span class="pipe">|</span><?php if($_G['setting']['rssstatus'] && !$_G['gp_archiveid']) { ?><a href="forum.php?mod=rss&amp;fid=<?php echo $_G['fid'];?>&amp;auth=<?php echo $rssauth;?>" target="_blank" title="RSS" class="fa_rss">RSS</a><?php } if($status == 'isgroupuser') { ?><span class="pipe">|</span><a href="javascript:;" onclick="showWindow('invite','misc.php?mod=invite&action=group&id=<?php echo $_G['fid'];?>')" class="fa_ivt"><strong class="xi2">�������</strong></a><?php } ?></span>
<?php if($_G['current_grouplevel']['icon']) { ?><img src="<?php echo $_G['current_grouplevel']['icon'];?>" title="<?php echo $_G['setting']['navs']['3']['navname'];?>�ȼ�: <?php echo $_G['current_grouplevel']['leveltitle'];?>" class="vm"> <?php } ?>����: <?php echo $_G['forum']['commoncredits'];?><span class="pipe">|</span>Ⱥ��: <?php $i = 1; if(is_array($groupmanagers)) foreach($groupmanagers as $manage) { if($i <= 0) { ?>, <?php } ?><?php $i--; ?><a href="home.php?mod=space&amp;uid=<?php echo $manage['uid'];?>" target="_blank" class="xi2"><?php echo $manage['username'];?></a> <?php } ?>
</dd>
<?php if($action == 'index' && ($status == 2 || $status == 3 || $status == 5)) { ?>
<dd>
���뷽ʽ: 
<?php if($_G['forum']['jointype'] == 1) { ?>
<strong>�������</strong>
<?php } elseif($_G['forum']['jointype'] == 2) { ?>
<strong>��˼���</strong>
<?php } else { ?>
<strong>���ɼ���</strong>
<?php } ?>
���Ȩ��: <strong><?php if($_G['forum']['gviewperm'] == 0) { ?>����Ա<?php } else { ?>������<?php } ?></strong>
</dd>
<dd class="xi1">
<?php if($status == 3 || $status == 5) { ?>
�Ѽ����<?php echo $_G['setting']['navs']['3']['navname'];?>���ȴ�Ⱥ�������...
<?php } else { ?>
<button type="button" class="pn" onclick="location.href='forum.php?mod=group&action=join&fid=<?php echo $_G['fid'];?>'"><em>����<?php echo $_G['setting']['navs']['3']['navname'];?></em></button>
<?php } ?>
</dd>
<?php } ?>
</dl>
<?php if($status != 2 && $status != 3 && $status != 5) { if($status != 'isgroupuser') { ?>
<div class="ptm pbm">
<button type="button" class="pn" onclick="location.href='forum.php?mod=group&action=join&fid=<?php echo $_G['fid'];?>'"><em>����<?php echo $_G['setting']['navs']['3']['navname'];?></em></button>
</div>
<?php } if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_navlink'])) echo $_G['setting']['pluginhooks']['group_navlink']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_navlink'])) echo $_G['setting']['pluginhooks']['forumdisplay_navlink']; } } ?>
</div>
</div>
<?php } ?>
<!--[diy=diycontentmiddle]--><div id="diycontentmiddle" class="area"></div><!--[/diy]-->
<?php if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_top'])) echo $_G['setting']['pluginhooks']['group_top']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_top']; } if($status != 2 && $status != 3) { ?>
<div class="tb cl<?php if($action != 'manage') { ?> mbm<?php } ?>">
<?php if(in_array($_G['adminid'], array(1,2))) { ?><span class="a bw0_all y xi2"><a href="javascript:;" onclick="showWindow('grecommend<?php echo $_G['fid'];?>', 'forum.php?mod=group&action=recommend&fid=<?php echo $_G['fid'];?>');return false;">�Ƽ������</a></span><?php } ?>
<ul id="groupnav">
<li <?php if($action == 'index') { ?>class="a"<?php } ?>><a href="forum.php?mod=group&amp;fid=<?php echo $_G['fid'];?>#groupnav" title="">��ҳ</a></li>
<li <?php if($action == 'list') { ?>class="a"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $_G['fid'];?>#groupnav" title="">������</a></li>
<li <?php if($action == 'memberlist' || $action == 'invite') { ?>class="a"<?php } ?>><a href="forum.php?mod=group&amp;action=memberlist&amp;fid=<?php echo $_G['fid'];?>#groupnav" title="">��Ա�б�</a></li>
<?php if($_G['forum']['ismoderator']) { ?><li <?php if($action == 'manage') { ?>class="a"<?php } ?>><a href="forum.php?mod=group&amp;action=manage&amp;fid=<?php echo $_G['fid'];?>#groupnav">����<?php echo $_G['setting']['navs']['3']['navname'];?></a></li><?php } if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_nav_extra'])) echo $_G['setting']['pluginhooks']['group_nav_extra']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_nav_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_nav_extra']; } ?>
</ul>
</div>
<?php } } if($action == 'index' && $status != 2 && $status != 3) { if($status != 2) { ?>
<div id="pgt" class="bm bw0 pgs cl">
<div class="pg">
<a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $_G['fid'];?>" class="nxt">�鿴��������</a>
</div>
<a href="javascript:;" id="newspecial" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})" onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?>')" title="����"><img src="http://static.8264.com/static/image/common/pn_post.png" alt="����" /></a>
</div>
<div class="tl bm bml">
<div class="th">
<table cellpadding="0" cellspacing="0" border="0">
<thead>
<tr>
<td class="icn">&nbsp;</td>
<th>��������</th>
<td class="by">����/ʱ��</td>
<td class="num">�ظ�/�鿴</td>
<td class="by">��󷢱�</td>
</tr>
</thead>
</table>
</div>
<div class="bm_c">
<?php if($newthreadlist['dateline']['data']) { ?>
<table cellpadding="0" cellspacing="0" border="0">
<tbody id="<?php echo $thread['id'];?>"><?php if(is_array($newthreadlist['dateline']['data'])) foreach($newthreadlist['dateline']['data'] as $tid => $thread) { ?><tr>
<td class="icn">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $tid;?>&amp;extra=<?php echo $extra;?>" title="�´��ڴ�" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="ͶƱ" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="��Ʒ" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="����" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="�" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="����" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" />
<?php } ?>
</a>
</td>
<th>
<span id="thread_<?php echo $thread['tid'];?>"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $tid;?>" class="xst"><?php echo $thread['subject'];?></a></span>
</th>
<td class="by">
<cite>
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>"><?php echo $thread['author'];?></a>
<?php } else { if($_G['forum']['ismoderator']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>">����</a>
<?php } else { ?>
����
<?php } } ?>
</cite>
<em><?php echo $thread['dateline'];?></em>
</td>
<td class="num">
<a class="xi2" href="forum.php?mod=viewthread&amp;tid=<?php echo $tid;?>"><?php echo $thread['replies'];?></a><em><?php echo $thread['views'];?></em>
</td>
<td class="by">
<cite>
<?php if($thread['lastposterenc']) { ?>
<a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $tid;?>&page=<?php echo max(1, $thread['pages']);; } ?>"><?php echo $thread['lastposter'];?></a>
<?php } else { ?>
����
<?php } ?>
</cite>
<em><a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $tid;?>&goto=lastpost#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>"><?php echo $thread['lastpost'];?></a></em>
</td>
</tr>
<?php } ?>
</tbody>
<?php if($_G['forum']['threads'] > 10) { ?>
<tbody>
<tr class="bw0_all">
<td colspan="5" class="ptm"><a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $_G['fid'];?>#groupnav" class="y xi2">����鿴���໰��</a></td>
</tr>
</tbody>
<?php } ?>
</table>
<?php } else { ?>
<p class="emp">������ָ���ķ�Χ���������⡣</p>
<?php } ?>
</div>
</div>
<div class="bm bml">
<div class="bm_h cl">
<h2>��Ա��̬</h2>
</div>
<div class="bm_c">
<?php if($groupfeedlist) { ?>
<ul class="el"><?php if(is_array($groupfeedlist)) foreach($groupfeedlist as $feed) { ?><li>
<img src="<?php echo $feed['icon_image'];?>" class="t" />
<?php if(!empty($feed['title_template'])) { ?><?php echo $feed['title_template'];?><?php } ?> <?php if(!empty($feed['body_data']['subject'])) { ?><?php echo $feed['body_data']['subject'];?><?php } ?>
</li>
<?php } ?>
</ul>
<?php } else { ?>
<p class="emp">��<?php echo $_G['setting']['navs']['3']['navname'];?>û�����¶�̬</p>
<?php } ?>
</div>
</div>
<?php if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<?php if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>">���»���</a></li><?php } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">����ͶƱ</a></li><?php } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">��������</a></li><?php } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">��������</a></li><?php } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">�����</a></li><?php } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">������Ʒ</a></li><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<?php if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?php echo $_G['setting']['threadplugins'][$tpid]['icon'];?>)"<?php } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a></li>
<?php } } } if($_G['forum']['threadsorts'] && !$_G['forum']['allowspecialonly']) { if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $threadsorts) { if($_G['forum']['threadsorts']['show'][$id]) { ?>
<li class="popupmenu_option"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;sortid=<?php echo $id;?>"><?php echo $threadsorts;?></a></li>
<?php } } } ?>
</ul>
<?php } } } elseif($action == 'list') { if($_G['forum']['ismoderator']) { ?>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<div id="pgt" class="bm bw0 pgs cl">
<?php echo $multipage;?>
<span <?php if($_G['setting']['visitedforums']) { ?>id="visitedforums" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id})"<?php } ?> class="pgb y"><a href="forum.php?mod=group&amp;fid=<?php echo $_G['fid'];?>">������ҳ</a></span>
<a href="javascript:;" id="newspecial" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})" onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?>')" title="����"><img src="http://static.8264.com/static/image/common/pn_post.png" alt="����" /></a>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_postbutton_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_postbutton_top']; ?>
</div>
<?php if($_G['forum']['threadtypes']) { ?>
<ul class="ttp bm cl">
<li<?php if(!$_G['gp_typeid']) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $_G['fid'];?>">ȫ��</a></li>
<?php if($_G['forum']['threadtypes']) { if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $id => $name) { ?><li<?php if($_G['gp_typeid'] == $id) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;action=list&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $id;?><?php echo $forumdisplayadd['typeid'];?>"><?php echo $name;?></a>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_filter_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_filter_extra']; ?>
</ul>
<?php } ?>
<div id="threadlist" class="tl bm" style="position: relative;">
<div class="th">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="icn">&nbsp;</td>
<?php if($_G['forum']['ismoderator']) { ?><td class="o">&nbsp;</td><?php } ?>
<th>����</th>
<td class="by">����/ʱ��</td>
<td class="num">�ظ�/�鿴</td>
<td class="by">��󷢱�</td>
</tr>
</table>
</div>
<div class="bm_c">
<form method="post" autocomplete="off" name="moderate" id="moderate" action="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;infloat=yes&amp;nopost=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="listextra" value="<?php echo $extra;?>" />
<table cellpadding="0" cellspacing="0" border="0">
<?php if($_G['forum_threadcount']) { if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { ?><?php echo adshow("threadlist"); ?><tbody id="<?php echo $thread['id'];?>">
<tr>
<td class="icn">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>" title="�´��ڴ�" target="_blank">
<?php if($thread['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($thread['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="ͶƱ" />
<?php } elseif($thread['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="��Ʒ" />
<?php } elseif($thread['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="����" />
<?php } elseif($thread['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="�" />
<?php } elseif($thread['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="����" />
<?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $thread['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$thread['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $thread['folder'];?>.gif" />
<?php } ?>
</td>
<?php if($_G['forum']['ismoderator']) { ?>
<td class="o">
<?php if($thread['fid'] == $_G['fid']) { if($thread['displayorder'] <= 3 || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" class="pc" value="<?php echo $thread['tid'];?>" />
<?php } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } ?>
</td>
<?php } ?>
<th>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_thread'][$key])) echo $_G['setting']['pluginhooks']['forumdisplay_thread'][$key]; if($thread['moved']) { if($_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=topicadmin&amp;action=moderate&amp;optgroup=3&amp;operation=delete&amp;tid=<?php echo $thread['moved'];?>" onclick="showWindow('mods', this.href);return false">�ƶ�:</a>
<?php } else { ?>
�ƶ�:
<?php } } ?>
<?php echo $thread['typehtml'];?>
<span id="thread_<?php echo $thread['tid'];?>"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"<?php echo $thread['highlight'];?> class="xst"><?php echo $thread['subject'];?></a></span>
<?php if($thread['readperm']) { ?> - [�Ķ�Ȩ�� <span class="xw1"><?php echo $thread['readperm'];?></span>]<?php } if($thread['price'] > 0) { if($thread['special'] == '3') { ?>
- <span style="color: #C60">[����<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <span class="bold"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>]</span>
<?php } else { ?>
- [�ۼ� <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <span class="bold"><?php echo $thread['price'];?></span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>]
<?php } } elseif($thread['special'] == '3' && $thread['price'] < 0) { ?>
- <span style="color: #269F11">[�ѽ��]</span>
<?php } if($thread['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/filetype/image_s.gif" alt="ͼƬ����" align="absmiddle" />
<?php } elseif($thread['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/filetype/common.gif" alt="����" align="absmiddle" />
<?php } if($thread['displayorder'] == 0) { if($thread['recommendicon']) { ?>
<img src="http://static.8264.com/static/image/common/recommend_<?php echo $thread['recommendicon'];?>.gif" align="absmiddle" alt="recommend" title="����ָ�� <?php echo $thread['recommends'];?>" />
<?php } if($thread['heatlevel']) { ?>
<img src="http://static.8264.com/static/image/common/hot_<?php echo $thread['heatlevel'];?>.gif" align="absmiddle" alt="heatlevel" title="<?php echo $thread['heatlevel'];?> ������" />
<?php } if($thread['digest'] > 0) { ?>
<img src="http://static.8264.com/static/image/common/digest_<?php echo $thread['digest'];?>.gif" align="absmiddle" alt="digest" title="���� <?php echo $thread['digest'];?>" />
<?php } if($thread['rate'] > 0) { ?>
<img src="http://static.8264.com/static/image/common/agree.gif" align="absmiddle" alt="agree" title="���ӱ��ӷ�" />
<?php } } if($thread['multipage']) { ?>
<span class="tps"><?php echo $thread['multipage'];?></span>
<?php } ?>
</th>
<td class="by">
<cite>
<?php if($thread['authorid'] && $thread['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>"><?php echo $thread['author'];?></a><?php if(!empty($verify[$thread['authorid']])) { ?><?php echo $verify[$thread['authorid']];?><?php } } else { if($_G['forum']['ismoderator']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>">����</a>
<?php } else { ?>
����
<?php } } ?>
</cite>
<em><?php echo $thread['dateline'];?></em>
</td>
<td class="num">
<?php echo $thread['replies'];?><em><?php echo $thread['views'];?></em>
</td>
<td class="by">
<cite><?php if($thread['lastposter']) { ?><a href="<?php if($thread['digest'] != -2) { ?>home.php?mod=space&username=<?php echo $thread['lastposterenc'];?><?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>"><?php echo $thread['lastposter'];?></a></cite><?php } else { ?>����<?php } ?></cite><em><a href="<?php if($thread['digest'] != -2) { ?>forum.php?mod=redirect&tid=<?php echo $thread['tid'];?>&goto=lastpost<?php echo $highlight;?>#lastpost<?php } else { ?>forum.php?mod=viewthread&tid=<?php echo $thread['tid'];?>&page=<?php echo max(1, $thread['pages']);; } ?>"><?php echo $thread['lastpost'];?></a></em>
</td>
</tr>
</tbody>
<?php } } else { ?>
<tbody><tr><th colspan="6"><p class="emp">������ָ���ķ�Χ���������⡣</p></th></tr></tbody>
<?php } ?>
</table>
<?php if($_G['forum']['ismoderator'] && $_G['forum_threadcount']) { include template('forum/topicadmin_modlayer'); } ?>
</form>
</div>
</div>
<div class="bm bw0 pgs cl">
<?php echo $multipage;?>
<span <?php if($_G['setting']['visitedforums']) { ?>id="visitedforums" onmouseover="$('visitedforums').id = 'visitedforumstmp';this.id = 'visitedforums';showMenu({'ctrlid':this.id})"<?php } ?> class="pgb y"><a href="forum.php?mod=group&amp;fid=<?php echo $_G['fid'];?>">������ҳ</a></span>
<a href="javascript:;" id="newspecialtmp" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})" onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=<?php echo $_G['fid'];?>')" title="����"><img src="http://static.8264.com/static/image/common/pn_post.png" alt="����" /></a>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_postbutton_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_postbutton_bottom']; ?>
</div>

<?php if($_G['setting']['fastpost']) { include template('forum/forumdisplay_fastpost'); } if($_G['group']['allowpost'] && ($_G['group']['allowposttrade'] || $_G['group']['allowpostpoll'] || $_G['group']['allowpostreward'] || $_G['group']['allowpostactivity'] || $_G['group']['allowpostdebate'] || $_G['setting']['threadplugins'] || $_G['forum']['threadsorts'])) { ?>
<ul class="p_pop" id="newspecial_menu" style="display: none">
<?php if(!$_G['forum']['allowspecialonly']) { ?><li><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" onclick="showWindow('newthread', this.href);doane(event)">���»���</a></li><?php } if($_G['group']['allowpostpoll']) { ?><li class="poll"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=1">����ͶƱ</a></li><?php } if($_G['group']['allowpostreward']) { ?><li class="reward"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=3">��������</a></li><?php } if($_G['group']['allowpostdebate']) { ?><li class="debate"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=5">��������</a></li><?php } if($_G['group']['allowpostactivity']) { ?><li class="activity"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=4">�����</a></li><?php } if($_G['group']['allowposttrade']) { ?><li class="trade"><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;special=2">������Ʒ</a></li><?php } if($_G['setting']['threadplugins']) { if(is_array($_G['forum']['threadplugin'])) foreach($_G['forum']['threadplugin'] as $tpid) { if(array_key_exists($tpid, $_G['setting']['threadplugins']) && @in_array($tpid, $_G['group']['allowthreadplugin'])) { ?>
<li class="popupmenu_option"<?php if($_G['setting']['threadplugins'][$tpid]['icon']) { ?> style="background-image:url(<?php echo $_G['setting']['threadplugins'][$tpid]['icon'];?>)"<?php } ?>><a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;specialextra=<?php echo $tpid;?>"><?php echo $_G['setting']['threadplugins'][$tpid]['name'];?></a></li>
<?php } } } ?>
</ul>
<?php } } elseif($action == 'memberlist') { if($op == 'alluser') { if($adminuserlist) { ?>
<div class="bm bml">
<div class="bm_h cl">
<h2>�����Ա</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($adminuserlist)) foreach($adminuserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="<?php if($user['level'] == 1) { ?>Ⱥ��<?php } elseif($user['level'] == 2) { ?>��Ⱥ��<?php } if($user['online']) { ?> ����<?php } ?>" class="avt" c="1">
<?php if($user['level'] == 1) { ?>
<em class="gm"></em>
<?php } elseif($user['level'] == 2) { ?>
<em class="gm" style="filter:alpha(opacity=50); opacity: 0.5"></em>
<?php } if($user['online']) { ?>
<em class="gol" style="margin-top: 15px;"></em>
<?php } echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($staruserlist || $alluserlist) { ?>
<div class="bm bml">
<div class="bm_h cl">
<h2>��Ա</h2>
</div>
<div class="bm_c">
<?php if($staruserlist) { ?>
<ul class="ml mls cl"><?php if(is_array($staruserlist)) foreach($staruserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="���ǳ�Ա<?php if($user['online']) { ?> ����<?php } ?>" class="avt" c="1">
<em class="gs"></em>
<?php if($user['online']) { ?>
<em class="gol"<?php if($user['level'] <= 3) { ?> style="margin-top: 15px;"<?php } ?> title="����"></em>
<?php } echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
</li>
<?php } ?>
</ul>
<?php } if($alluserlist) { ?>
<ul class="ml mls cl"><?php if(is_array($alluserlist)) foreach($alluserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" class="avt" c="1"><?php echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
</li>
<?php } ?>
</ul>
<?php } ?>
</div>
</div>
<?php } if($multipage) { ?><div class="pgs cl"><?php echo $multipage;?></div><?php } } } elseif($action == 'create') { ?><div class="bm bml" id="main_messaqge">
<div class="bm_h cl">		
<h1 class="xs2">������<?php echo $_G['setting']['navs']['3']['navname'];?></h1>
</div>
<div class="bm_c">
<form method="post" autocomplete="off" name="groupform" id="groupform" class="s_clear" onsubmit="ajaxpost('groupform', 'returnmessage4', 'returnmessage4', 'onerror');return false;" action="forum.php?mod=group&amp;action=create">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="handlekey" value="creategroup" />
<table cellspacing="0" cellpadding="0" class="tfm" summary="����<?php echo $_G['setting']['navs']['3']['navname'];?>">
<tbody>
<tr>
<th><strong class="rq y">*</strong><?php echo $_G['setting']['navs']['3']['navname'];?>����:</th>
<td>
<input type="text" name="name" id="name" class="px" size="36" tabindex="1" value="" autocomplete="off" onBlur="checkgroupname()" tabindex="1" />
<span id="groupnamecheck" class="xi1"></span>
</td>
</tr>
<tr>
<th><strong class="rq y">*</strong>��������:</th>
<td>
<select name="" tabindex="2" class="ps" onchange="ajaxget('forum.php?mod=ajax&action=secondgroup&fupid='+ this.value, 'secondgroup');">
<option value="0">��ѡ��</option>
<?php echo $groupselect['first'];?>
</select>
<em id="secondgroup"><select name="fup" id="fup" class="ps" ><option value="">��ѡ��</option></select></em>
</td>
</tr>
<tr>
<th><?php echo $_G['setting']['navs']['3']['navname'];?>���:</th>
<td><textarea rows="4" cols="40" name="descriptionnew" tabindex="3" class="pt"></textarea></td>
</tr>
<tr>
<th><strong class="rq y">*</strong>���Ȩ��:</th>
<td><label><input type="radio" name="gviewperm" class="pr" tabindex="4" value="1" checked="checked"> ������</label> <label><input type="radio" class="pr" name="gviewperm" value="0"> ����Ա</label></td>
</tr>
<tr>
<th><strong class="rq y">*</strong>���뷽ʽ:</th>
<td><label><input type="radio" name="jointype" class="pr" tabindex="5" value="0" checked="checked"> ���ɼ���</label> <label><input type="radio" class="pr" name="jointype" value="2"> ��˼���</label> <label><input type="radio" class="pr" name="jointype" value="1"> �������</label></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>ע����<?php echo $_G['setting']['navs']['3']['navname'];?>���ƺͷ�����ʱ�����޸��⣬������Ŀ�ڴ�����ɺ��Կ��޸ġ�</td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="createsubmit" value="true"><button type="submit" class="pn pnp" tabindex="6"><strong>����</strong></button>
<span id="returnmessage4"></span>
</td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
<script type="text/javascript">
function checkgroupname() {
var groupname = trim($('name').value);
ajaxget('forum.php?mod=ajax&forumcheck=1&infloat=creategroup&handlekey=creategroup&action=checkgroupname&groupname=' + (BROWSER.ie && document.charset == 'utf-8' ? encodeURIComponent(groupname) : groupname), 'groupnamecheck');
}
function succeedhandle_creategroup(locationhref, message) {
showDialog(message, 'notice', '', 'location.href="' + locationhref + '"');
}
<?php if($_G['gp_fupid']) { ?>
ajaxget('forum.php?mod=ajax&action=secondgroup&fupid=<?php echo $_G['gp_fupid'];?><?php if($_G['gp_groupid']) { ?>&groupid=<?php echo $_G['gp_groupid'];?><?php } ?>', 'secondgroup');
<?php } ?>
if($('name')) {
$('name').focus();
}
</script><?php } elseif($action == 'invite') { ?><div class="bm" id="main_messaqge">
<form method="post" autocomplete="off" name="groupform" id="groupform" class="s_clear" action="forum.php?mod=group&amp;action=invite">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" /><?php if(is_array($friendarray)) foreach($friendarray as $uid => $member) { ?><input type="checkbox" name="inviteuid[]" value="<?php echo $uid;?>"><?php echo $member['username'];?> <?php echo $member['avatar'];?>
<?php } ?>
<table cellspacing="0" cellpadding="0" class="tfm" summary="�������">
<caption>��ѡ����Ҫ����ĺ���</caption>
<tbody>
<tr>
<th>�����б�</th>
<td><textarea rows="4" cols="40" name="invitemsg" class="pt"></textarea></td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button class="pn pnc" type="submit" name="invitesubmit" value="true" tabindex="1"><strong>���</strong></button></td>
</tr>
</tbody>
</table>
</form>
</div><?php } elseif($action == 'manage') { ?><p class="tbmu">
<a href="forum.php?mod=group&amp;action=manage&amp;op=group&amp;fid=<?php echo $_G['fid'];?>"<?php if($_G['gp_op'] == 'group') { ?> class="a"<?php } ?>><?php echo $_G['setting']['navs']['3']['navname'];?>����</a>
<?php if(!empty($groupmanagers[$_G['uid']]) || $_G['adminid'] == 1) { ?>
<span class="pipe">|</span><a href="forum.php?mod=group&amp;action=manage&amp;op=checkuser&amp;fid=<?php echo $_G['fid'];?>"<?php if($_G['gp_op'] == 'checkuser') { ?> class="a"<?php } ?>>��Ա���</a>
<span class="pipe">|</span><a href="forum.php?mod=group&amp;action=manage&amp;op=manageuser&amp;fid=<?php echo $_G['fid'];?>"<?php if($_G['gp_op'] == 'manageuser') { ?> class="a"<?php } ?>>��Ա����</a>
<?php } if($_G['forum']['founderuid'] == $_G['uid'] || $_G['adminid'] == 1) { ?>
<span class="pipe">|</span><a href="forum.php?mod=group&amp;action=manage&amp;op=threadtype&amp;fid=<?php echo $_G['fid'];?>"<?php if($_G['gp_op'] == 'threadtype') { ?> class="a"<?php } ?>>�������</a>
<span class="pipe">|</span><a href="forum.php?mod=group&amp;action=manage&amp;op=demise&amp;fid=<?php echo $_G['fid'];?>"<?php if($_G['gp_op'] == 'demise') { ?> class="a"<?php } ?>><?php echo $_G['setting']['navs']['3']['navname'];?>ת��</a>
<?php } ?>
</p>

<?php if($_G['gp_op'] == 'group') { ?>
<div class="bm bw0">
<form enctype="multipart/form-data" action="forum.php?mod=group&amp;action=manage&amp;op=group&amp;fid=<?php echo $_G['fid'];?>" name="manage" method="post" autocomplete="off">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table cellspacing="0" cellpadding="0" class="tfm vt" summary="<?php echo $_G['setting']['navs']['3']['navname'];?>�������">
<tbody>
<tr>
<th>&nbsp;</th>
<td><strong class="rq"><em id="returnmessage4"></em></strong></td>
</tr>
<?php if(!empty($specialswitch['allowchangename']) && ($_G['uid'] == $_G['forum']['founderuid'] || $_G['adminid'] == 1)) { ?>
<tr>
<th><strong class="rq">*</strong><?php echo $_G['setting']['navs']['3']['navname'];?>����:</th>
<td><input type="text" id="name" name="name" class="px" size="36" tabindex="1" value="<?php echo $_G['forum']['name'];?>" autocomplete="off" tabindex="1" /></td>
</tr>
<?php } if(!empty($specialswitch['allowchangetype']) && ($_G['uid'] == $_G['forum']['founderuid'] || $_G['adminid'] == 1)) { ?>
<tr>
<th><strong class="rq">*</strong>��������:</th>
<td>
<select tabindex="2" class="ps" onchange="ajaxget('forum.php?mod=ajax&action=secondgroup&fupid='+ this.value, 'secondgroup');">
<?php echo $groupselect['first'];?>
</select>
<em id="secondgroup"><select id="fup" name="fup" class="ps" ><?php echo $groupselect['second'];?></select></em>
</td>
</tr>
<?php } ?>
<tr>
<th><?php echo $_G['setting']['navs']['3']['navname'];?>���</th>
<td><textarea name="descriptionnew" class="pt" rows="3" cols="40"><?php echo $_G['forum']['descriptionnew'];?></textarea></td>
</tr>
<tr>
<th>���Ȩ��</th>
<td><label><input type="radio" name="gviewpermnew" class="pr" value="1" <?php echo $gviewpermselect['1'];?>> ������</label> <label><input type="radio" name="gviewpermnew" class="pr" value="0" <?php echo $gviewpermselect['0'];?>> ����Ա</label></td>
</tr>
<tr>
<th>���뷽ʽ</th>
<td>
<label><input type="radio" name="jointypenew" class="pr" value="0" <?php echo $jointypeselect['0'];?> /> ���ɼ��� </label>
<label><input type="radio" name="jointypenew" class="pr" value="2" <?php echo $jointypeselect['2'];?> /> ��˼��� </label>
<label><input type="radio" name="jointypenew" class="pr" value="1" <?php echo $jointypeselect['1'];?> /> ������� </label>
<?php if(!empty($specialswitch['allowclosegroup'])) { ?>
<label><input type="radio" name="jointypenew" class="pr" value="-1" <?php echo $jointypeselect['-1'];?> /> �ر�</label>
<p class="d">ע��<?php echo $_G['setting']['navs']['3']['navname'];?>�رպ�ֻ��Ⱥ���ſ������</p>
<?php } ?>
</td>
</tr>
<?php if($_G['setting']['allowgroupdomain'] && !empty($_G['setting']['domain']['root']['group']) && $domainlength) { ?>
<tr>
<th>��������</th>
<td>
http://<input type="text" name="domain" class="px" value="<?php echo $_G['forum']['domain'];?>" style="width: 100px;" />.<?php echo $_G['setting']['domain']['root']['group'];?>
<p class="d">
������ʹ������ <?php echo $domainlength;?> �� ����� 30 ������ĸ��������ϣ��ұ�����ĸ��ͷ��<br/>
<?php if($_G['forum']['domain'] && $consume) { ?>�޸���������Ҫ֧������<strong><?php echo $consume;?></strong>����������ӵ��<strong><?php echo $credits;?></strong><?php } ?>
</p>
</td>
</tr>
<?php } if(!empty($_G['group']['allowupbanner']) || $_G['adminid'] == 1) { ?>
<tr>
<th><?php echo $_G['setting']['navs']['3']['navname'];?>����ͼƬ</th>
<td>
<input type="file" name="bannernew" id="bannernew" class="pf" size="25" />
<?php if($_G['forum']['banner']) { ?>
<label><input type="checkbox" name="deletebanner" class="pc" value="1" /> ��ʹ��ͼƬ</label>
<p class="d">����<?php echo $_G['setting']['navs']['3']['navname'];?>ͼƬ��ʹ�õĻ���<?php echo $_G['setting']['navs']['3']['navname'];?>ͼ���ڸ�<?php echo $_G['setting']['navs']['3']['navname'];?>ҳ�治����ʾ</p>
</td>
<tr>
<th>&nbsp;</th>
<td>
<img width="544" src="<?php echo $_G['forum']['banner'];?>?<?php echo TIMESTAMP;?>" />
<?php } ?>
<p class="d">
�Զ����Գ� 720 X 168 ���ش�С��ͼƬ &nbsp;
<?php if($_G['setting']['group_imgsizelimit']) { ?>
�ļ�С�� <?php echo $_G['setting']['group_imgsizelimit'];?> kb
<?php } ?>
</p>
</td>
</tr>
<?php } ?>
<tr>
<th><?php echo $_G['setting']['navs']['3']['navname'];?>ͼ��</th>
<td>
<input type="file" id="iconnew" class="pf vm" size="25" name="iconnew" />
<p class="d">
�Զ����Գ� 48 X 48 ���ش�С��ͼƬ &nbsp; 
<?php if($_G['setting']['group_imgsizelimit']) { ?>
�ļ�С�� <?php echo $_G['setting']['group_imgsizelimit'];?> kb
<?php } ?></p>
<?php if($_G['forum']['icon']) { ?>
<img width="48" height="48" alt="" class="vm" style="margin-right: 1em;" src="<?php echo $_G['forum']['icon'];?>?<?php echo TIMESTAMP;?>" />
<?php } ?>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><button type="submit" name="groupmanage" class="pn pnp" value="1"><strong>�ύ</strong></button></td>
</tr>
</tbody>
</table>
</form>
</div>
<?php } elseif($_G['gp_op'] == 'checkuser') { if($checkusers) { ?>
<p class="tbmu cl">
<span class="y">
<a href="forum.php?mod=group&amp;action=manage&amp;op=checkuser&amp;fid=<?php echo $_G['fid'];?>&amp;checkall=2">����ȫ��</a><span class="pipe">|</span>
<a href="forum.php?mod=group&amp;action=manage&amp;op=checkuser&amp;fid=<?php echo $_G['fid'];?>&amp;checkall=1">ȫ��ͨ��</a>
</span>
</p>
<div class="xld xlda"><?php if(is_array($checkusers)) foreach($checkusers as $uid => $user) { ?><dl class="bbda cl">
<dd class="m avt"><?php echo avatar($user['uid'], 'small'); ?></dd>
<dt><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a> <span class="xw0">(<?php echo $user['joindateline'];?>)</span></dt>
<dd class="pns"><button type="submit" name="checkusertrue" class="pn pnp" value="true" onclick="location.href='forum.php?mod=group&action=manage&op=checkuser&fid=<?php echo $_G['fid'];?>&uid=<?php echo $user['uid'];?>&checktype=1'"><em>ͨ��</em></button> &nbsp; <button type="submit" name="checkuserfalse" class="pn" value="true" onclick="location.href='forum.php?mod=group&action=manage&op=checkuser&fid=<?php echo $_G['fid'];?>&uid=<?php echo $user['uid'];?>&checktype=2'"><em>����</em></button></dd>
</dl>
<?php } ?>
</div>
<?php if($multipage) { ?><div class="pgs cl mtm"><?php echo $multipage;?></div><?php } } else { ?>
<p class="emp">������Ҫ��˳�Ա��</p>
<?php } } elseif($_G['gp_op'] == 'manageuser') { ?>
<script type="text/javascript">
function groupManageUser(targetlevel_val) {
$('targetlevel').value = targetlevel_val;
$('manageuser').submit();
}
</script>
<?php if($_G['forum']['membernum'] > 50) { ?>
<div class="bm_c pns">
<form action="forum.php?mod=group&amp;action=manage&amp;op=manageuser&amp;fid=<?php echo $_G['fid'];?>" method="post">
<input type="text" onclick="$('groupsearch').value=''" value="�������Ա����" size="15" class="px p_fre vm" id="groupsearch" name="srchuser">&nbsp;
<button class="pn vm" type="submit"><span>����</span></button>
</form>
</div>
<?php } ?>
<form action="forum.php?mod=group&amp;action=manage&amp;op=manageuser&amp;fid=<?php echo $_G['fid'];?>&amp;manageuser=true" name="manageuser" id="manageuser" method="post" autocomplete="off" class="ptm">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
        <input type="hidden" value="0" name="targetlevel" id="targetlevel" />
<?php if($adminuserlist) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>�����Ա</h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($adminuserlist)) foreach($adminuserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="<?php if($user['level'] == 1) { ?>Ⱥ��<?php } elseif($user['level'] == 2) { ?>��Ⱥ��<?php } if($user['online']) { ?> ����<?php } ?>" class="avt">
<?php if($user['level'] == 1) { ?>
<em class="gm"></em>
<?php } elseif($user['level'] == 2) { ?>
<em class="gm" style="filter: alpha(opacity=50); opacity: 0.5"></em>
<?php } if($user['online']) { ?>
<em class="gol"></em>
<?php } echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
<p><?php if($_G['adminid'] == 1 || ($_G['uid'] != $user['uid'] && ($_G['uid'] == $_G['forum']['founderuid'] || $user['level'] > $groupuser['level']))) { ?><input type="checkbox" class="pc" name="muid[<?php echo $user['uid'];?>]" value="<?php echo $user['level'];?>" /><?php } ?></p>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($staruserlist || $userlist) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>��Ա</h2>
</div>
<div class="bm_c">
<?php if($staruserlist) { ?>
<ul class="ml mls cl"><?php if(is_array($staruserlist)) foreach($staruserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="���ǳ�Ա<?php if($user['online']) { ?> ����<?php } ?>" class="avt">
<em class="gs"></em>
<?php if($user['online']) { ?>
<em class="gol"<?php if($user['level'] <= 3) { ?> style="margin-top: 15px;"<?php } ?>></em>
<?php } echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
<p><?php if($_G['adminid'] == 1 || $user['level'] > $groupuser['level']) { ?><input type="checkbox" class="pc" name="muid[<?php echo $user['uid'];?>]" value="<?php echo $user['level'];?>" /><?php } ?></p>
</li>
<?php } ?>
</ul>
<?php } if($userlist) { ?>
<ul class="ml mls cl"><?php if(is_array($userlist)) foreach($userlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" class="avt"><?php echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
<p><?php if($_G['adminid'] == 1 || $user['level'] > $groupuser['level']) { ?><input type="checkbox" class="pc" name="muid[<?php echo $user['uid'];?>]" value="<?php echo $user['level'];?>" /><?php } ?></p>
</li>
<?php } ?>
</ul>
<?php } ?>
</div>
</div>
<?php } if($multipage) { ?><div class="pgs cl mbm"><?php echo $multipage;?></div><?php } ?>
<div class="cl"><?php if(is_array($mtype)) foreach($mtype as $key => $name) { ?>            	<?php if($_G['forum']['founderuid'] == $_G['uid'] || $key > $groupuser['level'] || $_G['adminid'] == 1) { ?>
                <button type="button" name="manageuser" value="true" class="pn" onclick="groupManageUser('<?php echo $key;?>')"><span><?php echo $name;?></span></button>
                <?php } ?>
            <?php } ?>
</div>
</form>
<?php } elseif($_G['gp_op'] == 'threadtype') { ?>
<div class="bm bw0">
<?php if(empty($specialswitch['allowthreadtype'])) { ?>
Ŀǰ���<?php echo $_G['setting']['navs']['3']['navname'];?>�ȼ�����ʹ�ô˹��ܡ�
<?php } else { ?>
<script type="text/JavaScript">
var rowtypedata = [
[
[1,'<input type="checkbox" class="pc" disabled="disabled" />', ''],
[1,'<input type="checkbox" class="pc" name="newenable[]" checked="checked" />', ''],
[1,'<input class="px" type="text" size="2" name="newdisplayorder[]" value="0" />'],
[1,'<input class="px" type="text" name="newname[]" />']
],
];
var addrowdirect = 0;
var typenumlimit = <?php echo $typenumlimit;?>;
function addrow(obj, type) {
var table = obj.parentNode.parentNode.parentNode.parentNode;
if(typenumlimit <= obj.parentNode.parentNode.parentNode.rowIndex - 1) {
alert('���ֻ����'+typenumlimit+'��������ࡣ');
return false;
}
if(!addrowdirect) {
var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex);
} else {
var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex + 1);
}

var typedata = rowtypedata[type];
for(var i = 0; i <= typedata.length - 1; i++) {
var cell = row.insertCell(i);
cell.colSpan = typedata[i][0];
var tmp = typedata[i][1];
if(typedata[i][2]) {
cell.className = typedata[i][2];
}
tmp = tmp.replace(/\{(\d+)\}/g, function($1, $2) {return addrow.arguments[parseInt($2) + 1];});
cell.innerHTML = tmp;
}
addrowdirect = 0;
}
</script>
<div id="threadtypes">
<form id="threadtypeform" action="forum.php?mod=group&amp;action=manage&amp;op=threadtype&amp;fid=<?php echo $_G['fid'];?>" autocomplete="off" method="post" name="threadtypeform">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table cellspacing="0" cellpadding="0" class="tfm vt">
<tr>
<th>�����������:</th>
<td>
<label><input type="radio" name="threadtypesnew[status]" class="pr" value="1" onclick="$('threadtypes_config').style.display = '';$('threadtypes_manage').style.display = '';" <?php echo $checkeds['status']['1'];?>> ��</label>
<label><input type="radio" name="threadtypesnew[status]" class="pr" value="0" onclick="$('threadtypes_config').style.display = 'none';$('threadtypes_manage').style.display = 'none';"  <?php echo $checkeds['status']['0'];?>> ��</label>
<p class="d">�����Ƿ�����������๦�ܣ�����Ҫͬʱ�趨��Ӧ�ķ���ѡ��������ñ�����</p>
</td>
</tr>
<tbody id="threadtypes_config" style="display: <?php echo $display;?>">
<tr>
<th>�����������:</th>
<td>
<label><input type="radio" name="threadtypesnew[required]" class="pr" value="1" <?php echo $checkeds['required']['1'];?>> ��</label>
<label><input type="radio" name="threadtypesnew[required]" class="pr" value="0" <?php echo $checkeds['required']['0'];?>> ��</label>
<p class="d">�Ƿ�ǿ���û�����������ʱ����ѡ�����</p>
</td>
</tr>
<tr>
<th>���ǰ׺:</th>
<td>
<label><input type="radio" name="threadtypesnew[prefix]" class="pr" value="0" <?php echo $checkeds['prefix']['0'];?>> ����ʾ</label>
<label><input type="radio" name="threadtypesnew[prefix]" class="pr" value="1" <?php echo $checkeds['prefix']['1'];?>> ��ʾ</label>
<p class="d">�Ƿ�������ǰ����ʾ���������</p>
</td>
</tr>
</tbody>
</table>
<div id="threadtypes_manage" style="display: <?php echo $display;?>">
<h2 class="ptm pbm">�������</h2>
<table cellspacing="0" cellpadding="0" class="dt">
<thead>
<tr>
<th width="25">ɾ��</th>
<th>����</th>
<th>˳��</th>
<th>��������</th>
</tr>
</thead>
<?php if($threadtypes) { if(is_array($threadtypes)) foreach($threadtypes as $val) { ?><tbody>
<tr>
<td><input type="checkbox" class="pc" name="threadtypesnew[options][delete][]" value="<?php echo $val['typeid'];?>" /></td>
<td><input type="checkbox" class="pc" name="threadtypesnew[options][enable][<?php echo $val['typeid'];?>]" value="1" class="pc" <?php echo $val['enablechecked'];?> /></td>
<td><input type="text" name="threadtypesnew[options][displayorder][<?php echo $val['typeid'];?>]" class="px" size="2" value="<?php echo $val['displayorder'];?>" /></td>
<td><input type="text" name="threadtypesnew[options][name][<?php echo $val['typeid'];?>]" class="px" value="<?php echo $val['name'];?>" /></td>
</tr>
</tbody>
<?php } } ?>
<tr>
<td colspan="4"><img class="vm" src="http://static.8264.com/static/image/common/addicn.gif" /> <a href="javascript:;" onclick="addrow(this, 0)">��ӷ���</a></td>
</tr>
</table>
</div>
<button type="submit" class="pn pnp mtm" name="groupthreadtype" value="1"><strong>�ύ</strong></button>
</form>
</div>
<?php } ?>
</div>
<?php } elseif($_G['gp_op'] == 'demise') { ?>
<div class="bm bw0">
<?php if($groupmanagers) { ?>
<div class="tbmu">
<h2>����ת���ʸ�</h2><p>ֻ��ת�ø���<?php echo $_G['setting']['navs']['3']['navname'];?>�Ĺ����Ա��</p><p>������Ҫ�߱����ٴ�����<?php echo $_G['setting']['navs']['3']['navname'];?>���ʸ�</p>
<div class="mtm"><h2>��ܰ��ʾ��</h2><p><?php echo $_G['setting']['navs']['3']['navname'];?>ת�óɹ�������Ȼ�Ǹ�Ⱥ��Ⱥ������������<?php echo $_G['setting']['navs']['3']['navname'];?>��ʼ�ˣ����Կ������˳���<?php echo $_G['setting']['navs']['3']['navname'];?>��</p><p>ת�ú��޷�ֱ�ӻָ�Ⱥ���豻���������������ſ����ٴ�ת�أ������������</p></div>
</div>
<form action="forum.php?mod=group&amp;action=manage&amp;op=demise&amp;fid=<?php echo $_G['fid'];?>" name="groupdemise" method="post" class="exfm">
<input type="hidden" value="<?php echo FORMHASH;?>" name="formhash" />
<table cellspacing="0" cellpadding="0" class="tfm vt">
<tr>
<th>��Ⱥ��ת�ø�:</th>
<td>
<ul class="ml mls cl"><?php if(is_array($groupmanagers)) foreach($groupmanagers as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="<?php if($user['level'] == 1) { ?>��ΪȺ��<?php } elseif($user['level'] == 2) { ?>��Ϊ��Ⱥ��<?php } if($user['online']) { ?> ����<?php } ?>" class="avt"><?php echo avatar($user['uid'], 'small'); ?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a></p>
<p><?php if($user['uid'] != $_G['uid']) { ?><input type="radio" class="pr" name="suid" value="<?php echo $user['uid'];?>" /><?php } ?></p>
</li>
<?php } ?>
</ul>
</td>
</tr>
<tr>
<th>�������¼����</th>
<td><input type="password" name="grouppwd" class="px p_fre" /></td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<button type="submit" name="groupdemise" class="pn pnp" value="1"><strong>�ύ</strong></button>
</td>
</tr>
</table>
</form>
<?php } else { ?>
<p class="emp"><?php echo $_G['setting']['navs']['3']['navname'];?>Ŀǰ��û�й����Ա��</p>
<?php } ?>
</div>
<?php } } if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_bottom'])) echo $_G['setting']['pluginhooks']['group_bottom']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_bottom']; } ?>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
<div class="sd">
<div class="drag">
<!--[diy=diysidetop]--><div id="diysidetop" class="area"></div><!--[/diy]-->
</div><?php if($action == 'index') { ?>
<div class="bm bml tns">
<table cellpadding="4" cellspacing="0" border="0">
<tr>
<th><p><?php echo $_G['forum']['posts'];?></p>����</th>
<th><p><?php echo $_G['forum']['membernum'];?></p>��Ա</th>
<td><p><?php echo $groupcache['ranking']['data']['today'];?></p>����</td>
</tr>
</table>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['group_index_side'])) echo $_G['setting']['pluginhooks']['group_index_side']; if($status != 2 && $status != 3) { ?>
<div class="bm">
<ul class="tb tb_h cl">
<li class="a" id="new" onmouseover="this.className='a';$('top').className='';$('newuserlist').style.display='block';$('topuserlist').style.display='none';"><a href="javascript:;">�¼���</a></li>
<li id="top" onmouseover="this.className='a';$('new').className='';$('topuserlist').style.display='block';$('newuserlist').style.display='none';"><a href="javascript:;">��Ծ��Ա</a></li>
</ul>
<div class="bm_c">
<ul class="ml mls cl" id="newuserlist" style="display:block;"><?php if(is_array($newuserlist)) foreach($newuserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="<?php if($user['level'] == 1) { ?>Ⱥ��<?php } elseif($user['level'] == 2) { ?>��Ⱥ��<?php } elseif($user['level'] == 3) { ?>���ǳ�Ա<?php } if($user['online']) { ?> ����<?php } ?>" class="avt" c="1">
<?php if($user['level'] == 1) { ?>
<em class="gm"></em>
<?php } elseif($user['level'] == 2) { ?>
<em class="gm" style="filter: alpha(opacity=50); opacity: 0.5"></em>
<?php } elseif($user['level'] == 3) { ?>
<em class="gs"></em>
<?php } if($user['online']) { ?>
<em class="gol"<?php if($user['level'] <= 3) { ?> style="margin-top: 15px;"<?php } ?>></em>
<?php } echo avatar($user['uid'], 'small'); ?></a>
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a>
</p>
</li>
<?php } ?>
</ul>
<ul class="ml mls cl" id="topuserlist" style="display:none;"><?php if(is_array($activityuserlist)) foreach($activityuserlist as $user) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>" title="<?php if($user['level'] == 1) { ?>Ⱥ��<?php } elseif($user['level'] == 2) { ?>��Ⱥ��<?php } elseif($user['level'] == 3) { ?>���ǳ�Ա<?php } if($user['online']) { ?> ����<?php } ?>" class="avt" c="1">
<?php if($user['level'] == 1) { ?>
<em class="gm"></em>
<?php } elseif($user['level'] == 2) { ?>
<em class="gm" style="filter: alpha(opacity=50); opacity: 0.5"></em>
<?php } elseif($user['level'] == 3) { ?>
<em class="gs"></em>
<?php } if($user['online']) { ?>
<em class="gol"<?php if($user['level'] <= 3) { ?> style="margin-top: 15px;"<?php } ?>></em>
<?php } echo avatar($user['uid'], 'small'); ?></a>
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $user['uid'];?>"><?php echo $user['username'];?></a>
</p>
</li>
<?php } ?>
</ul>
</div>
</div>

<?php if($groupviewed_list) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>�������<?php echo $_G['setting']['navs']['3']['navname'];?></h2>
</div>
<div class="bm_c">
<ul class="ml mls cl"><?php if(is_array($groupviewed_list)) foreach($groupviewed_list as $groupid => $group) { ?><li>
<a href="forum.php?mod=group&amp;fid=<?php echo $groupid;?>" title="<?php echo $group['name'];?>" class="avt"><img src="<?php echo $group['icon'];?>" alt="<?php echo $group['name'];?>" /></a>
<p><a href="forum.php?mod=group&amp;fid=<?php echo $groupid;?>" title="<?php echo $group['name'];?>"><?php echo $group['name'];?></a></p>
<span><?php echo $group['membernum'];?></span>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } } } elseif($action == 'list') { if($groupcache['replies']['data']) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>�����Ҷ������۵Ļ���</h2>
</div>
<div class="bm_c">
<ul class="xl"><?php if(is_array($groupcache['replies']['data'])) foreach($groupcache['replies']['data'] as $tid => $thread) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $tid;?>"><?php echo $thread['subject'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($groupcache['digest']['data']) { ?>
<div class="bm">
<div class="bm_h cl">
<h2>�����Ƽ�</h2>
</div>
<div class="bm_c">
<ul class="xl"><?php if(is_array($groupcache['digest']['data'])) foreach($groupcache['digest']['data'] as $tid => $thread) { ?><li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $tid;?>"><?php echo $thread['subject'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } } if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_side_top'])) echo $_G['setting']['pluginhooks']['group_side_top']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_side_top'])) echo $_G['setting']['pluginhooks']['forumdisplay_side_top']; } if($action == 'create') { ?>
<div class="bm bmn">
<div class="bm_c xw1 xi1">������ <?php echo $groupnum;?> ��<?php echo $_G['setting']['navs']['3']['navname'];?>�����ܴ��� <?php echo $allowbuildgroup;?> ����</div>
</div>
<?php } else { if($action != 'index' && ($status != 2 || $status != 3)) { ?>
<div class="bm bml">
<div class="bm_h cl">
<h2>�ڱ�<?php echo $_G['setting']['navs']['3']['navname'];?>��Ѱ������</h2>
</div>
<div class="bm_c hm pns">
<form method="post" action="search.php?mod=group&amp;srchfid=<?php echo $_G['fid'];?>&amp;searchsubmit=1">
<input type="text" name="srchtxt" id="groupsearch" class="px p_fre vm" size="15" value="�����������ؼ���" onclick="$('groupsearch').value=''" />&nbsp;
<button type="submit" class="pn vm"><span>����</span></button>
</form>
</div>
</div>
<?php } ?>

<div class="bm bml">
<div class="bm_h cl">
<h2><?php echo $_G['setting']['navs']['3']['navname'];?>��ַ</h2>
</div>
<div class="bm_c">
<p>
<?php if($_G['setting']['allowgroupdomain'] && !empty($_G['setting']['domain']['root']['group']) && !empty($_G['forum']['domain'])) { ?>
<a href="http://<?php echo $_G['forum']['domain'];?>.<?php echo $_G['setting']['domain']['root']['group'];?>" id="group_link"></a>
<?php } else { ?>
<a href="forum.php?mod=group&amp;fid=<?php echo $_G['fid'];?>" id="group_link"></a>
<?php } ?>
[<a href="javascript:;" onclick="setCopy($('group_link').href, '<?php echo $_G['setting']['navs']['3']['navname'];?>��ַ�Ѿ����Ƶ�������')" class="xi2">����</a>]
</p>
<script type="text/javascript">$('group_link').innerHTML = $('group_link').href</script>
<p class="ptn xg1"><?php echo $_G['forum']['foundername'];?> ������ <?php echo $_G['forum']['dateline'];?></p>
<?php if($status == 'isgroupuser') { ?><p class="ptn"><a onclick="showDialog('��ȷ��Ҫ�˳���<?php echo $_G['setting']['navs']['3']['navname'];?>��', 'confirm', '', function(){location.href='forum.php?mod=group&action=out&fid=<?php echo $_G['fid'];?>'})" href="javascript:;" class="xi2">�˳�<?php echo $_G['setting']['navs']['3']['navname'];?></a><p><?php } ?>
</div>
</div>
<?php } if(CURMODULE == 'group') { ?><?php if(!empty($_G['setting']['pluginhooks']['group_side_bottom'])) echo $_G['setting']['pluginhooks']['group_side_bottom']; } else { ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_side_bottom'])) echo $_G['setting']['pluginhooks']['forumdisplay_side_bottom']; } ?>

<div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>

</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
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
<strong><a href="http://bbs.8264.com/member.php?mod=clearcookies&amp;formhash=<?php echo formhash();; ?>" target="_blank">���COOKIE</a></strong><span class="pipe">|</span><?php $fnavcount=0; if(is_array($_G['setting']['footernavs'])) foreach($_G['setting']['footernavs'] as $nav) { if($nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
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
<p style="color:#333">�����з��գ�8264����������<a href="http://bx.8264.com/?8264com" target="_blank" style=" color:#2A85E8;">���Ᵽ��</a><?php if(!empty($_G['setting']['boardlicensed'])) { ?> <a href="http://license.comsenz.com/?pid=1&amp;host=<?php echo $_SERVER['HTTP_HOST'];?>" target="_blank">Licensed</a><?php } ?></p>
<p class="xs0"></p>
</div>
<?php if($_G['extcnzz']) { ?>
<div style="display:none;"><?php if(is_array($_G['extcnzz'])) foreach($_G['extcnzz'] as $value) { ?><?php echo $value;?>
<?php } ?>
</div>
<?php } ?><?php updatesession(); ?></div><?php } ?><ul id="usersetup_menu" class="p_pop" style="display:none;">
<li><a href="home.php?mod=spacecp&amp;ac=avatar">�޸�ͷ��</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=profile">��������</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">��֤</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=credit">����</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=usergroup">�û���</a></li>
<li><a href="home.php?mod=spacecp&amp;ac=privacy">��˽ɸѡ</a></li>
<?php if($_G['setting']['sendmailday']) { ?>
<li><a href="home.php?mod=spacecp&amp;ac=sendmail">�ʼ�����</a></li>
<?php } ?>
<li><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">���밲ȫ</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?></ul><?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
<div class="crly">
���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����
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