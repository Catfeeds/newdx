<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('stat_misc', 'common/header');
0
|| checktplrefresh('./template/default/forum/stat_misc.htm', './template/default/common/simplesearchform.htm', 1489671707, '2', './data/template/2_2_forum_stat_misc.tpl.php', './template/8264', 'forum/stat_misc')
|| checktplrefresh('./template/default/forum/stat_misc.htm', './template/default/common/stat.htm', 1489671707, '2', './data/template/2_2_forum_stat_misc.tpl.php', './template/8264', 'forum/stat_misc')
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
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a><em>&rsaquo;</em>
<a href="misc.php?mod=stat">վ��ͳ��</a><em>&rsaquo;</em>
<?php if($op == 'views') { ?>
����ͳ��
<?php } elseif($op == 'agent') { ?>
�ͻ����
<?php } elseif($op == 'posts') { ?>
��������¼
<?php } elseif($op == 'forumsrank') { ?>
�������
<?php } elseif($op == 'threadsrank') { ?>
��������
<?php } elseif($op == 'postsrank') { ?>
��������
<?php } elseif($op == 'creditsrank') { ?>
��������
<?php } elseif($op == 'modworks') { ?>
����ͳ��
<?php } elseif($op == 'forumstat') { ?>
���ͳ��
<?php } elseif($op == 'forumstatdetail') { ?>
�Ӱ��ͳ��
<?php } ?>
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<?php if($op == 'views') { ?>
<div class="bm bw0">
<h1 class="mt">����ͳ��</h1>
<table summary="��������" class="dt bm">
<caption><h2 class="mbn">��������</h2></caption>
<?php echo $statsbar_week;?>
</table>

<table summary="ʱ������" class="dt bm">
<caption><h2 class="mbn">ʱ������</h2></caption>
<?php echo $statsbar_hour;?>
</table>
</div>
<?php } elseif($op == 'agent') { ?>
<div class="bm bw0">
<h1 class="mt">�ͻ����</h1>
<table summary="�ͻ����" class="dt bm">
<caption><h2 class="mbn">����ϵͳ</h2></caption>
<?php echo $statsbar_os;?>
</table>

<table summary="�����" class="dt bm">
<caption><h2 class="mbn">�����</h2></caption>
<?php echo $statsbar_browser;?>
</table>
</div>
<?php } elseif($op == 'posts') { ?>
<div class="bm bw0">
<h1 class="mt">��������¼</h1>
<table summary="ÿ���������Ӽ�¼" class="dt bm">
<caption><h2 class="mbn">ÿ���������Ӽ�¼</h2></caption>
<?php echo $statsbar_monthposts;?>
</table>

<table summary="ÿ���������Ӽ�¼" class="dt bm">
<caption><h2 class="mbn">ÿ���������Ӽ�¼</h2></caption>
<?php echo $statsbar_dayposts;?>
</table>
<?php } elseif($op == 'forumsrank') { ?>
<div class="bm bw0">
<h1 class="mt">�������</h1>
<table summary="�������" class="dt bm mbw">
<tr>
<th colspan="2" class="xw1" width="50%">�������а�</th>
<th colspan="2" class="xw1">�ظ����а�</th>
</tr>
<?php echo $forumsrank['0'];?>
</table>

<table summary="�������" class="dt bm">
<tr>
<th colspan="2" class="xw1" width="50%">��� 30 �췢�����а�</th>
<th colspan="2" class="xw1">��� 24 Сʱ�������а�</th>
</tr>
<?php echo $forumsrank['1'];?>
</table>

<div class="notice">ͳ�������ѱ����棬�ϴ��� <?php echo $lastupdate;?> �����£��´ν��� <?php echo $nextupdate;?> ���и���</div>
</div>
<?php } elseif($op == 'forumstat' && !$_G['gp_fid']) { ?>
<div class="bm bw0">
<h1 class="mt">���ͳ��</h1>
<table summary="!stats_forum_stat!" class="dt bm">
<tr>
<th class="xw1">�������</td>
<th class="xw1">������</td>
</tr><?php if(is_array($forums)) foreach($forums as $forum) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><a href="misc.php?mod=stat&amp;op=forumstat&amp;fid=<?php echo $forum['fid'];?>"><?php echo $forum['name'];?></a></td>
<td><?php echo $forum['posts'];?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } elseif($op == 'forumstat' && $_G['gp_fid']) { ?>
<div class="bm bw0">
<h1 class="mt">���ͳ����־ - <?php echo $foruminfo['name'];?> - <?php echo $month;?></h1>
<script type="text/javascript">
document.write(AC_FL_RunContent(
'width', '100%', 'height', '300',
'src', '<?php echo STATICURL;?>image/common/stat.swf?<?php echo $statuspara;?>',
'quality', 'high'
));
</script>
<table summary="���ͳ����־" class="dt bm mtw mbw">
<tr>
<th width="100">����</th>
<th>������</th>
</tr><?php if(is_array($logs)) foreach($logs as $log) { ?><tr>
<td><?php echo $log['logdate'];?></td>
<td><?php echo $log['value'];?></td>
</tr>
<?php } ?>
</table>

<table class="dt bm">
<caption><h2 class="mbn">��ʷ��¼ - <?php echo $foruminfo['name'];?></h2></caption>
<tr>
<th width="100">�·�</th>
<th>������</th>
</tr><?php if(is_array($monthlist)) foreach($monthlist as $month) { ?><tr>
<td><a href="misc.php?mod=stat&amp;op=forumstat&amp;fid=<?php echo $_G['gp_fid'];?>&amp;month=<?php echo $month;?>"><?php echo $month;?></a></td>
<td><?php echo $monthposts[$month];?></td>
</tr>
<?php } ?>
</table>
</div>		
<?php } elseif($op == 'forumstatdetail' && !$_G['gp_typeid']) { ?>
<div class="bm bw0">
<h1 class="mt">�Ӱ��ͳ��</h1>
<table summary="!stats_forum_stat!" class="dt bm">
<tr>
<th class="xw1" width="17%">�������</td>
<th class="xw1">�Ӱ������</td>
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
<h1 class="mt">�Ӱ��ͳ����־ - <?php echo $foruminfo['name'];?> - <?php echo $month;?></h1>
<script type="text/javascript">
document.write(AC_FL_RunContent(
'width', '100%', 'height', '300',
'src', '<?php echo STATICURL;?>image/common/stat.swf?<?php echo $statuspara;?>',
'quality', 'high'
));
</script>
<table summary="�Ӱ��ͳ����־" class="dt bm mtw mbw">
<tr>
<th width="100">����</th>
<th>������</th>
</tr><?php if(is_array($logs)) foreach($logs as $log) { ?><tr>
<td><?php echo $log['logdate'];?></td>
<td><?php echo $log['value'];?></td>
</tr>
<?php } ?>
</table>

<table class="dt bm">
<caption><h2 class="mbn">��ʷ��¼ - <?php echo $foruminfo['name'];?></h2></caption>
<tr>
<th width="100">�·�</th>
<th>������</th>
</tr><?php if(is_array($monthlist)) foreach($monthlist as $month) { ?><tr>
<td><a href="misc.php?mod=stat&amp;op=forumstatdetail&amp;typeid=<?php echo $_G['gp_typeid'];?>&amp;month=<?php echo $month;?>"><?php echo $month;?></a></td>
<td><?php echo $monthposts[$month];?></td>
</tr>
<?php } ?>
</table>
</div>		
<?php } elseif($op == 'threadsrank') { ?>
<div class="bm bw0">
<h1 class="mt">��������</h1>
<table summary="��������" class="dt bm">
<tr>
<th colspan="2" class="xw1" width="50%">�������������</th>
<th colspan="2" class="xw1">���ظ���������</th>
</tr>
<?php echo $threadsrank;?>
</table>
</div>
<?php } elseif($op == 'postsrank') { ?>
<div class="bm bw0">
<h1 class="mt">��������</h1>
<table summary="��������" class="dt bm">
<tr>
<th colspan="2" class="xw1" width="25%">���� ���а�</th>
<th colspan="2" class="xw1" width="25%">������ ���а�</th>
<th colspan="2" class="xw1" width="25%">��� 30 �췢�� ���а�</th>
<th colspan="2" class="xw1" width="25%">��� 24 Сʱ���� ���а�</th>
</tr>
<?php echo $postsrank;?>
</table>
</div>
<?php } elseif($op == 'creditsrank') { ?>
<div class="bm bw0">
<h1 class="mt">��������</h1>
<ul class="tb cl"><?php if(is_array($extendedcredits)) foreach($extendedcredits as $key => $extendedcredit) { ?><li<?php if($_G['gp_extcredit'] == $key) { ?> class="a" id="extendedcredit_current"<?php } ?>><a href="misc.php?mod=stat&amp;op=creditsrank&amp;extcredit=<?php echo $key;?>" onclick="swtichcurrent(this, <?php echo $key;?>);return false;"><?php echo $_G['setting']['extcredits'][$key]['title'];?></a></li>
<?php } ?>
</ul><?php if(is_array($extendedcredits)) foreach($extendedcredits as $key => $extendedcredit) { ?><table id="extendedcredit_<?php echo $key;?>" summary="��������" class="dt bw0 mtw" style="display:<?php if($_G['gp_extcredit'] != $key) { ?> none<?php } ?>">
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
<h1 class="mt">����ͳ�� - <?php echo $_G['username'];?></h1>
<ul class="ttp cl"><?php if(is_array($monthlinks)) foreach($monthlinks as $link) { ?><?php echo $link;?>
<?php } ?>
</ul>
<div class="cl">
<div class="stl">
<table class="dt bm">
<tr>
<th>ʱ��</th>
</tr><?php if(is_array($modactions)) foreach($modactions as $day => $modaction) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><?php echo $day;?></td>
</tr>
<?php } ?>
<tr class="alt"><td></td></tr>
<tr>
<td>���¹���</td>
</tr>
</table>
</div>
<div class="str">
<table class="dt" style="width: 3000px;">
<tr><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { ?><th width="<?php echo $tdwidth;?>"><?php echo $val;?></th><?php } ?>
</tr><?php unset($swapc); if(is_array($modactions)) foreach($modactions as $day => $modaction) { ?><tr class="<?php echo swapclass('alt'); ?>"><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { if($modaction[$key]['posts']) { ?><td title="����: <?php echo $modaction[$key]['posts'];?>"><?php echo $modaction[$key]['count'];?><?php } else { ?><td>&nbsp;<?php } ?></td>
<?php } ?>
</tr>
<?php } ?>
<tr class="alt"><td colspan="23"></td></tr>
<tr><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { ?><td class="<?php echo $bgarray[$key];?>" <?php if($totalactions[$key]['posts']) { ?>title="����: <?php echo $totalactions[$key]['posts'];?>"<?php } ?>><?php echo $totalactions[$key]['count'];?>&nbsp;</td>
<?php } ?>
</tr>
</table>
</div>
</div>
</div>

<?php } elseif($op == 'modworks') { ?>
<div class="bm bw0">
<h1 class="mt">����ͳ�� - ȫ�������Ա</h1>
<ul class="ttp cl"><?php if(is_array($monthlinks)) foreach($monthlinks as $link) { ?><?php echo $link;?>
<?php } ?>
</ul>
<div class="cl">
<div class="stl">
<table class="dt bm">
<tr>
<th>�û���</th>
</tr><?php if(is_array($members)) foreach($members as $uid => $member) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><a href="misc.php?mod=stat&amp;op=modworks&amp;before=<?php echo $_G['gp_before'];?>&amp;uid=<?php echo $uid;?>" title="�鿴��ϸ����ͳ��"><?php echo $member['username'];?></a></td>
</tr>
<?php } ?>
</table>
</div>

<div class="str">
<table class="dt" style="width: 3000px;">
<tr><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { ?><th width="<?php echo $tdwidth;?>"><?php echo $val;?></th><?php } ?>
</tr><?php unset($swapc); if(is_array($members)) foreach($members as $uid => $member) { ?><tr class="<?php echo swapclass('alt'); ?>"><?php if(is_array($modactioncode)) foreach($modactioncode as $key => $val) { if($member[$key]['posts']) { ?><td title="����: <?php echo $member[$key]['posts'];?>"><?php echo $member[$key]['count'];?><?php } else { ?><td>&nbsp;<?php } ?></td>
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