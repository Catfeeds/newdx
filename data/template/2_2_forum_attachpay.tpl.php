<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('attachpay', 'common/header');
0
|| checktplrefresh('./template/default/forum/attachpay.htm', './template/default/common/simplesearchform.htm', 1492478667, '2', './data/template/2_2_forum_attachpay.tpl.php', './template/8264', 'forum/attachpay')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/forum/forum_misc.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<?php if(empty($_G['gp_infloat'])) { ?>
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

<form id="attachpayform" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=attachpay<?php if(!empty($_G['gp_infloat'])) { ?>&amp;paysubmit=yes&amp;infloat=yes" onsubmit="ajaxpost('attachpayform', 'return_<?php echo $_G['gp_handlekey'];?>', 'return_<?php echo $_G['gp_handlekey'];?>', 'onerror');return false;"<?php } else { ?>"<?php } ?>>
<div class="f_c">
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">���򸽼�</em>
<span>
<?php if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>')" title="�ر�">�ر�</a><?php } ?>
</span>
</h3>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="aid" value="<?php echo $aid;?>" />
<?php if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div class="c">
<table class="list" cellspacing="0" cellpadding="0" style="width: 400px">
<tr>
<td>����</td>
<td><a href="home.php?mod=space&amp;uid=<?php echo $attach['uid'];?>"><?php echo $attach['author'];?></a></td>
</tr>
<tr>
<td>����</td>
<td><div style="overflow:hidden"><?php echo $attach['filename'];?> <?php if($attach['description']) { ?>(<?php echo $attach['description'];?>)<?php } ?></div></td>
</tr>
<tr>
<td>�ۼ�(<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>)</td>
<td><?php echo $attach['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></td>
</tr>
<?php if($status != 1) { ?>
<tr>
<td>��������(<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>)</td>
<td><?php echo $attach['netprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></td>
</tr>
<tr>
<td>��������(<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>)</td>
<td><?php echo $balance;?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></td>
</tr>
<?php } if($status == 1) { ?>
<tr>
<td>&nbsp;</td>
<td>��� <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> ���㣬�޷�����</td>
</tr>
<?php } elseif($status == 2) { ?>
<tr>
<td>&nbsp;</td>
<td>�����ڵ��û�������������, <a href="forum.php?mod=attachment&amp;aid=<?php echo $aidencode;?>" target="_blank">���ظ���</a></td>
</tr>
<?php } ?>
</table>
</div>
<div class="o pns">
<?php if($status != 1) { ?>
<label><input name="buyall" type="checkbox" class="pc" value="yes" /> �������и���</label>
<button class="pn pnc" type="submit" name="paysubmit" value="true"><span><?php if($status == 0) { ?>���򸽼�<?php } else { ?>��ѹ���<?php } ?></span></button>
<?php } ?>
<button class="pn pnc" type="button" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"><span>�ر�</span></button>
</div>
</div>
</form>

<?php if(!empty($_G['gp_infloat'])) { ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(locationhref) {
ajaxget('forum.php?mod=viewthread&tid=<?php echo $attach['tid'];?>&viewpid=<?php echo $attach['pid'];?>', 'post_<?php echo $attach['pid'];?>');
hideWindow('<?php echo $_G['gp_handlekey'];?>');
showCreditPrompt();
}
</script>
<?php } if(empty($_G['gp_infloat'])) { ?>
</div>
</div>
</div>
<?php } include template('common/footer'); ?>