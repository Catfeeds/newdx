<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('misc_stat', 'common/header');
0
|| checktplrefresh('./template/default/home/misc_stat.htm', './template/default/common/simplesearchform.htm', 1491491038, '2', './data/template/2_2_home_misc_stat.tpl.php', './template/8264', 'home/misc_stat')
|| checktplrefresh('./template/default/home/misc_stat.htm', './template/default/common/stat.htm', 1491491038, '2', './data/template/2_2_home_misc_stat.tpl.php', './template/8264', 'home/misc_stat')
;?>
<?php $_G['home_tpl_titles'] = array('����ͳ��'); include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_misc.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
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
����ͳ��
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt">����ͳ��</h1>
<form method="get" action="misc.php?mod=stat&amp;op=trend">
<table cellspacing="0" cellpadding="0" class="dt bm mbw">
<caption>
<h2 class="ptm">ͳ�Ʒ���</h2>
<p class="pbm xg1">վ������ͳ��ϵͳ�����¼վ��ÿ�յķ�չ�ſ���ͨ��ÿ�յ����Ʊ仯��Ϊվ����Ӫվ���ṩ��ѧ�����ݻ�����</p>
</caption>
<tr class="tbmu">
<th>��������:</th>
<td>
<a href="misc.php?mod=stat&amp;op=trend"<?php echo $actives['all'];?>>�ۺϸſ�</a> &nbsp;<?php if(is_array($cols['login'])) foreach($cols['login'] as $value) { ?><label<?php echo $actives[$value];?>><input type="checkbox" name="types[]" value="<?php echo $value;?>" class="pc" <?php if(in_array($value, $_G['gp_types'])) { ?> checked="checked"<?php } ?> /> <?php echo lang('spacecp', "do_stat_$value"); ?></label> &nbsp;
<?php } ?>
</td>
</tr>
<tr class="tbmu">
<th><?php echo $_G['setting']['navs']['2']['navname'];?>:</th>
<td><?php if(is_array($cols['forum'])) foreach($cols['forum'] as $value) { ?><label<?php echo $actives[$value];?>><input type="checkbox" name="types[]" value="<?php echo $value;?>" class="pc" <?php if(in_array($value, $_G['gp_types'])) { ?> checked="checked"<?php } ?> /> <?php echo lang('spacecp', "do_stat_$value"); ?></label> &nbsp;
<?php } ?>
</td>
</tr>
<tr class="tbmu">
<th><?php echo $_G['setting']['navs']['3']['navname'];?>:</th>
<td><?php if(is_array($cols['tgroup'])) foreach($cols['tgroup'] as $value) { ?><label <?php echo $actives[$value];?>><input type="checkbox" name="types[]" value="<?php echo $value;?>" class="pc" <?php if(in_array($value, $_G['gp_types'])) { ?> checked="checked"<?php } ?> /> <?php echo lang('spacecp', "do_stat_$value"); ?></label> &nbsp;
<?php } ?>
</td>
</tr>
<tr class="tbmu">
<th><?php echo $_G['setting']['navs']['4']['navname'];?>:</th>
<td><?php if(is_array($cols['home'])) foreach($cols['home'] as $value) { ?><label<?php echo $actives[$value];?>><input type="checkbox" name="types[]" value="<?php echo $value;?>" class="pc" <?php if(in_array($value, $_G['gp_types'])) { ?> checked="checked"<?php } ?> /> <?php echo lang('spacecp', "do_stat_$value"); ?></label> &nbsp;
<?php } ?>
</td>
</tr>

<!--tr class="tbmu">
<th>��Ϣ����:</th>
<td><?php if(is_array($cols['comment'])) foreach($cols['comment'] as $value) { ?><label<?php echo $actives[$value];?>><input type="checkbox" name="types[]" value="<?php echo $value;?>" class="pc" <?php if(in_array($value, $_G['gp_types'])) { ?> checked="checked"<?php } ?> /> <?php echo lang('spacecp', "do_stat_$value"); ?></label> &nbsp;
<?php } ?>
</td>
</tr-->
<tr class="tbmu">
<th>����:</th>
<td><?php if(is_array($cols['space'])) foreach($cols['space'] as $value) { ?><label<?php echo $actives[$value];?>><input type="checkbox" name="types[]" value="<?php echo $value;?>" class="pc" <?php if(in_array($value, $_G['gp_types'])) { ?> checked="checked"<?php } ?> /> <?php echo lang('spacecp', "do_stat_$value"); ?></label> &nbsp;
<?php } ?>
</td>
</tr>
<tr class="tbmu">
<th>ͳ������:</th>
<td>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<input type="text" name="primarybegin" class="px" value="<?php echo $primarybegin;?>" onclick="showcalendar(event, this, false)"/> - <input type="text" name="primaryend" class="px" value="<?php echo $primaryend;?>" onclick="showcalendar(event, this, false)" />
<label><input type="checkbox" name="merge" value="1" class="pc" <?php if(!empty($merge)) { ?> checked="checked"<?php } ?> /> �ϲ�ͳ��</label>
<button type="submit" class="pn pnp"><strong>�鿴</strong></button>
</td>
</tr>
</table>
<input type="hidden" name="type" value="<?php echo $_G['gp_type'];?>" />
<input type="hidden" name="mod" value="stat" />
<input type="hidden" name="op" value="trend" />
</form>
<table cellspacing="0" cellpadding="0" width="100%">
<?php if($type=='all') { ?>
<caption>
<h2>�ۺϸſ�</h2>
<p class="xg1">���￴������վ����ۺϸſ���չͳ��(��Ҫ����ͳ��2������Ч)��</p>
</caption>
<tr>
<td>
<ul class="ptn pbm xl">
<li>�����û���ָ����ÿ����ʱ�վ��Ψһ�û�����һ���û����ʶ�Σ�Ҳֻ��һ�Ρ�</li>
  									<li><?php echo $_G['setting']['navs']['2']['navname'];?>��ָ����ÿ�췢�����⡢ͶƱ��������͡����ۡ���Ʒ�������������������</li>
									<li><?php echo $_G['setting']['navs']['3']['navname'];?>��ָ����ÿ�촴��<?php echo $_G['setting']['navs']['3']['navname'];?>��<?php echo $_G['setting']['navs']['3']['navname'];?>���⡢<?php echo $_G['setting']['navs']['3']['navname'];?>��������������</li>
									<li><?php echo $_G['setting']['navs']['4']['navname'];?>��ָ����ÿ�췢����¼����־��ͼƬ�����⡢ͶƱ���������ͻ������۵���������</li>
									<li>������ָ����ÿ���û�֮�以�����ԡ����к��͵�<?php echo $_G['setting']['navs']['4']['navname'];?>��Ӧ�ı�̬������������</li>
</ul>
</td>
</tr>
<?php } else { ?>
<caption>
<h2><?php if(is_array($_GET['types'])) foreach($_GET['types'] as $key => $type) { ?>&nbsp;<?php echo lang('spacecp', "do_stat_$type"); ?>&nbsp;
<?php } ?>
</h2>
</caption>
<?php } ?>
<tr><td>
<script type="text/javascript">
document.write(AC_FL_RunContent(
'width', '100%', 'height', '300',
'src', '<?php echo STATICURL;?>image/common/stat.swf?<?php echo $statuspara;?>',
'quality', 'high', 'wmode', 'transparent'
));
</script>
</td></tr>
</table>

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