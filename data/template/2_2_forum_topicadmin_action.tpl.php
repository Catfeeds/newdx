<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('topicadmin_action', 'common/header');
0
|| checktplrefresh('./template/default/forum/topicadmin_action.htm', './template/default/common/simplesearchform.htm', 1500951339, '2', './data/template/2_2_forum_topicadmin_action.tpl.php', './template/8264', 'forum/topicadmin_action')
;?><?php include template('common/header'); if(empty($_G['gp_infloat'])) { ?>
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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <?php echo $navigation;?></div>
</div>
<div id="ct" class="wp cl">
<div class="mn">
<div class="bm bw0">
<?php } ?>

<div class="tm_c" id="floatlayout_topicadmin">
<h3 class="flb">
<em id="return_mods"><?php if(in_array($_G['gp_action'], array('delpost', 'banpost', 'warn'))) { ?>ѡ���� <?php echo $modpostsnum;?> ƪ����<?php } elseif($_G['gp_action'] == 'delcomment') { ?>ѡ���� 1 ������<?php } else { ?>ѡ���� 1 ƪ����<?php } ?></em>
<span>
<a href="javascript:;" class="flbc" onclick="<?php if($_G['gp_action'] == 'stamp') { ?>if ($('threadstamp')) $('threadstamp').innerHTML = oldthreadstamp;<?php } ?>hideWindow('mods')" title="�ر�">�ر�</a>
</span>
</h3>
<form id="topicadminform" method="post" autocomplete="off" action="forum.php?mod=topicadmin&amp;action=<?php echo $_G['gp_action'];?>&amp;modsubmit=yes&amp;infloat=yes&amp;modclick=yes" onsubmit="ajaxpost('topicadminform', 'return_mods', 'return_mods', 'onerror');return false;">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>">
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>">
<?php if(!empty($_REQUEST['page'])) { ?><input type="hidden" name="page" value="<?php echo $_REQUEST['page'];?>" /><?php } if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div class="c">
<div class="<?php if($_G['gp_action'] != 'split') { ?>tplw<?php } else { ?>tpmh<?php } ?>">
<?php if($_G['gp_action'] == 'delpost') { ?>
<?php echo $deleteid;?>
ɾ��ѡ������
<?php } elseif($_G['gp_action'] == 'delcomment') { ?>
<?php echo $deleteid;?>
<!-- <?php if($_REQUEST['count'] <> 0) { ?> -->
ɾ����������ظ�Ҳ�ᱻɾ����ȷ����
<!-- <?php } else { ?> -->
ɾ��ѡ������
<!-- <?php } ?> -->
<?php } elseif($_G['gp_action'] == 'restore') { ?>
<input type="hidden" name="archiveid" value="<?php echo $archiveid;?>" />
��ȷ��Ҫ���������Ƴ��浵����
<?php } elseif($_G['gp_action'] == 'copy') { ?>
<p>Ŀ����:</p>
<p class="tah_body">
<select name="copyto" class="ps"><?php echo $forumselect;?></select>
</p>
<?php } elseif($_G['gp_action'] == 'banpost') { ?>
<?php echo $banid;?>
<ul class="llst">
<li><label><input type="radio" name="banned" class="pr" value="1" <?php echo $checkban;?> /> ����</label></li>
<li><label><input type="radio" name="banned" class="pr" value="0" <?php echo $checkunban;?> /> ���</label></li>
</ul>
<?php } elseif($_G['gp_action'] == 'warn') { ?>
<?php echo $warnpid;?>
<ul class="llst">
<li><label><input type="radio" name="warned" class="pr" value="1" <?php echo $checkwarn;?> /> ����</label></li>
<li><label><input type="radio" name="warned" class="pr" value="0" <?php echo $checkunwarn;?> /> ���</label></li>
</ul>
<?php if(($modpostsnum == 1 || $authorcount == 1) && $authorwarnings > 0) { ?>
<br /><div style="clear: both; text-align: right;" title="<?php echo $_G['setting']['warningexpiration'];?> �����ۼƱ����� <?php echo $_G['setting']['warninglimit'];?> �Σ������Զ���ֹ���� <?php echo $_G['setting']['warningexpiration'];?> ��">�û� <?php echo $warningauthor;?> �ѱ����� <?php echo $authorwarnings;?> ��</div>
<?php } } elseif($_G['gp_action'] == 'merge') { ?>
<table cellspacing="0" cellpadding="0">
<tr>
<td><label for="othertid">�ϲ� &larr;</label></td>
<td>��дҪ�ϲ������� ID (tid)</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="text" name="othertid" id="othertid" class="px" size="10" /></td>
</tr>
</table>
<?php } elseif($_G['gp_action'] == 'refund') { ?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<th>�ѹ�������</th>
<td><?php echo $payment['payers'];?></td>
</tr>
<tr>
<th>��������</th>
<td><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $payment['netincome'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></td>
</tr>
</table>
<?php } elseif($_G['gp_action'] == 'split') { ?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td><label for="subject">�±���</label></td>
</tr>
<tr>
<td><input type="text" name="subject" id="subject" class="px" size="20" /></td>
</tr>
<tr>
<td><label for="split">�ָ� &rarr;��д¥�� (�� "," ���)</label></td>
</tr>
<tr>
<td><textarea name="split" id="split" class="pt" style="width: 212px; height:120px" /></textarea></td>
</tr>
</table>
<?php } elseif($_G['gp_action'] == 'stamp') { ?>
<p>ѡ������ͼ��:</p>
<p class="tah_body">
<select name="stamp" id="stamp" class="ps" onchange="updatestampimg()">
<option value="">��ͼ��</option><?php if(is_array($_G['cache']['stamps'])) foreach($_G['cache']['stamps'] as $stampid => $stamp) { if($stamp['type'] == 'stamp') { ?>
<option value="<?php echo $stampid;?>"<?php if($thread['stamp'] == $stampid) { ?> selected="selected"<?php } ?>><?php echo $stamp['text'];?></option>
<?php } } ?>
</select>
</p>
<script type="text/javascript" reload="1">
if($('threadstamp')) {
var oldthreadstamp = $('threadstamp').innerHTML;
}
var stampurls = new Array();<?php if(is_array($_G['cache']['stamps'])) foreach($_G['cache']['stamps'] as $stampid => $stamp) { ?>stampurls[<?php echo $stampid;?>] = '<?php echo $stamp['url'];?>';
<?php } ?>
function updatestampimg() {
if($('threadstamp')) {
$('threadstamp').innerHTML = $('stamp').value ? '<img src="<?php echo STATICURL;?>image/stamp/' + stampurls[$('stamp').value] + '">' : '<img src="<?php echo STATICURL;?>image/common/none.gif">';
}
}
</script>
<?php } elseif($_G['gp_action'] == 'stamplist') { ?>
<p>ѡ������ͼ��:</p>
<p class="tah_body mbm">
<select name="stamplist" id="stamplist" class="ps" onchange="updatestamplistimg()">
<?php if($thread['icon'] >= 0) { ?><option value="<?php echo $thread['icon'];?>">��ǰͼ��</option><?php } ?>
<option value="">��ͼ��</option><?php if(is_array($_G['cache']['stamps'])) foreach($_G['cache']['stamps'] as $stampid => $stamp) { if($stamp['type'] == 'stamplist' && $stamp['icon']) { ?>
<option value="<?php echo $stampid;?>"<?php if($thread['icon'] == $stampid) { ?> selected="selected"<?php } ?>><?php echo $stamp['text'];?></option>
<?php } } ?>
</select>
</p>
<p class="tah_body" id="stamplistprev"></p>
<script type="text/javascript" reload="1">
var stampurls = new Array();<?php if(is_array($_G['cache']['stamps'])) foreach($_G['cache']['stamps'] as $stampid => $stamp) { ?>stampurls[<?php echo $stampid;?>] = '<?php echo $stamp['url'];?>';
<?php } ?>
function updatestamplistimg(icon) {
icon = !icon ? $('stamplist').value : icon;

if($('stamplistprev')) {
$('stamplistprev').innerHTML = icon && icon >= 0 ? '<img src="<?php echo STATICURL;?>image/stamp/' + stampurls[icon] + '">' : '<img src="<?php echo STATICURL;?>image/common/none.gif">';
}
}
<?php if($thread['icon']) { ?>
updatestamplistimg(<?php echo $thread['icon'];?>);
<?php } ?>
</script>
<?php } elseif($_G['gp_action'] == 'stickreply') { ?>
<?php echo $stickpid;?>
<ul class="llst">
<li><label><input type="radio" name="stickreply" class="pr" value="1"<?php if(empty($_G['gp_undo'])) { ?> checked="checked"<?php } ?>/> �ö��������� </label></li>
<li><label><input type="radio" name="stickreply" class="pr" value="0"<?php if(!empty($_G['gp_undo'])) { ?> checked="checked"<?php } ?>/> ����ö� </label></li>
</ul>
<?php } ?>
</div>
<div class="tpclg">
<h4>
<a onclick="showselect(this, 'reason', 'reasonselect')" class="dpbtn y" href="javascript:;">^</a>
����˵��:
</h4>
<p><textarea name="reason" id="reason" class="pt" onkeyup="seditor_ctlent(event, '$(\'modsubmit\').click()')"></textarea></p>
<ul id="reasonselect" style="display: none"><?php echo modreasonselect(); ?></ul>
</div>
</div>
<div class="o pns">
<button type="submit" name="modsubmit" id="modsubmit" value="ture" class="pn pnc"><span>ȷ��</span></button>
<input type="checkbox" name="sendreasonpm" id="sendreasonpm" class="pc"<?php if($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) { ?> checked="checked" disabled="disabled"<?php } ?> /> <label for="sendreasonpm" />֪ͨ����</label>
</div>
</form>
</div>
<script type="text/javascript" reload="1">
function succeedhandle_mods(locationhref) {
<?php if($_G['gp_action'] == 'delcomment') { if(!empty($_REQUEST['parentpid'])) { ?>
ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $_G['tid'];?>&pid=<?php echo $_REQUEST['parentpid'];?>', 'comment_<?php echo $_REQUEST['parentpid'];?>');
<?php } else { ?>
ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $_G['tid'];?>&pid=<?php echo $pid;?>', 'comment_<?php echo $pid;?>');
<?php } ?>
hideWindow('mods');
<?php } elseif($_G['gp_action'] == 'banpost' || $_G['gp_action'] == 'warn') { if(is_array($topiclist)) foreach($topiclist as $pid) { ?>ajaxget('forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?>&viewpid=<?php echo $pid;?>&modclick=yes', 'post_<?php echo $pid;?>', 'post_<?php echo $pid;?>');
if($('topiclist_<?php echo $pid;?>')) {
$('modactions').removeChild($('topiclist_<?php echo $pid;?>'));
}
<?php } ?>
hideWindow('mods');
resetmodcount();
<?php } else { ?>
hideWindow('mods');
location.href = locationhref;
<?php } ?>
}
</script>

<?php if(empty($_G['gp_infloat'])) { ?>
</div>
</div>
</div>
<?php } include template('common/footer'); ?>