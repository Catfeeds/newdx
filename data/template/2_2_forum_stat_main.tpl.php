<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('stat_main', 'common/header');
0
|| checktplrefresh('./template/default/forum/stat_main.htm', './template/default/common/simplesearchform.htm', 1494490950, '2', './data/template/2_2_forum_stat_main.tpl.php', './template/8264', 'forum/stat_main')
|| checktplrefresh('./template/default/forum/stat_main.htm', './template/default/common/stat.htm', 1494490950, '2', './data/template/2_2_forum_stat_main.tpl.php', './template/8264', 'forum/stat_main')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/home/misc_stat.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em> վ��ͳ��
</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt">�����ſ�</h1>
<table summary="��Աͳ��" class="dt bm mbw">
<caption><h2 class="mbn">��Աͳ��</h2></caption>
<tr>
<th width="16%">ע���Ա</th>
<td width="34%"><?php echo $members;?></td>
<th width="16%">������Ա</th>
<td width="34%"><?php echo $mempost;?></td>
</tr>
<tr>
<th>�����Ա</th>
<td><?php echo $admins;?></td>
<th>δ������Ա</th>
<td><?php echo $memnonpost;?></td>
</tr>
<tr>
<th>�»�Ա</th>
<td><?php echo $lastmember;?></td>
<th>������Առ����</th>
<td><?php echo $mempostpercent;?>%</td>
</tr>
<tr>
<th>������̳֮��</th>
<td><?php if($bestmemposts) { ?><?php echo $bestmem;?> <em title="������">(<?php echo $bestmemposts;?>)</em><?php } else { ?><em>��</em><?php } ?></td>
<th>ƽ��ÿ�˷�����</th>
<td><?php echo $mempostavg;?></td>
</tr>
</table>

<table summary="վ��ͳ��" class="dt bm">
<caption><h2 class="mbn">վ��ͳ��</h2></caption>
<tr>
<th width="150">�����</th>
<td width="60"><?php echo $forums;?></td>
<th width="150">ƽ��ÿ������������</th>
<td width="60"><?php echo $postsaddavg;?></td>
<th width="150">�����ŵİ��</th>
<td><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $hotforum['fid'];?>" target="_blank"><?php echo $hotforum['name'];?></a></td>
</tr>
<tr>
<th>������</th>
<td><?php echo $threads;?></td>
<th>ƽ��ÿ��ע���Ա��</th>
<td><?php echo $membersaddavg;?></td>
<th>������</th>
<td><?php echo $hotforum['threads'];?></td>
</tr>
<tr>
<th>������</th>
<td><?php echo $posts;?></td>
<th>��� 24 Сʱ����������</th>
<td><?php echo $postsaddtoday;?></td>
<th>������</th>
<td><?php echo $hotforum['posts'];?></td>
</tr>
<tr>
<th>ƽ��ÿ�����ⱻ�ظ�����</th>
<td><?php echo $threadreplyavg;?></td>
<th>��� 24 Сʱ������Ա��</th>
<td><?php echo $membersaddtoday;?></td>
<th>��̳��Ծָ��</th>
<td><?php echo $activeindex;?></td>
</tr>
</table>
<div class="notice">ͳ�������ѱ����棬�ϴ��� <?php echo $lastupdate;?> �����£��´ν��� <?php echo $nextupdate;?> ���и���</div>
</div>
</div><div class="appl">
<div class="tbn">
<ul>
<li class="cl<?php if($op == 'basic') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=basic">�����ſ�</a></li>
<li class="cl<?php if($op == 'forumstat') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=forumstat">���ͳ��</a></li>
<li class="cl<?php if($op == 'forumstatdetail') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=forumstatdetail">�Ӱ��ͳ��</a></li>
<li class="cl<?php if($op == 'team') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=team">�����Ŷ�</a></li>
<?php if($_G['setting']['modworkstatus']) { ?>
<li class="cl<?php if($op == 'modworks') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=modworks">����ͳ��</a></li>
<?php } if($_G['setting']['memliststatus']) { ?>
<li class="cl<?php if($op == 'memberlist') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=memberlist">��Ա�б�</a></li>
<?php } if($_G['setting']['updatestat']) { ?>
<li class="cl<?php if($op == 'trend') { ?> a<?php } ?>"><a href="misc.php?mod=stat&amp;op=trend">����ͳ��</a></li>
<?php } ?>
</ul>
</div>
</div></div><?php include template('common/footer'); ?>