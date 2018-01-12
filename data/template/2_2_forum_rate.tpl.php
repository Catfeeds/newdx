<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('rate', 'common/header');
0
|| checktplrefresh('./template/default/forum/rate.htm', './template/default/common/simplesearchform.htm', 1509518585, '2', './data/template/2_2_forum_rate.tpl.php', './template/8264', 'forum/rate')
;?><?php include template('common/header'); if(empty($_G['gp_infloat'])) { ?>
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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <?php echo $navigation;?></div>
</div>
<div id="ct" class="wp cl">
<div class="mn">
<div class="bm bw0">
<?php } if($_G['gp_action'] == 'rate') { ?>
<div class="tm_c" id="floatlayout_topicadmin">
<h3 class="flb">
<em id="return_rate">评分</em>
<span>
<?php if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('rate')" title="关闭">关闭</a><?php } ?>
</span>
</h3>
<form id="rateform" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=rate&amp;ratesubmit=yes&amp;infloat=yes" onsubmit="ajaxpost('rateform', 'return_rate', 'return_rate', 'onerror');">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>" />
<input type="hidden" name="pid" value="<?php echo $_G['gp_pid'];?>" />
<?php if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="rate"><?php } ?>
<div class="c mark">
<table class="dt mbm">
<tr>
<th>&nbsp;</th>
<th width="65">&nbsp;</th>
<th width="65">评分区间</th>
<th width="55">今日剩余</th>
</tr><?php if(is_array($ratelist)) foreach($ratelist as $id => $options) { ?><tr>
<td><?php echo $_G['setting']['extcredits'][$id]['img'];?> <?php echo $_G['setting']['extcredits'][$id]['title'];?></td>
<td>
<input type="text" name="score<?php echo $id;?>" id="score<?php echo $id;?>" class="px z" value="0" style="width: 25px;" />
<a href="javascript:;" class="dpbtn" onclick="showselect(this, 'score<?php echo $id;?>', 'scoreoption<?php echo $id;?>')">^</a>
<ul id="scoreoption<?php echo $id;?>" style="display:none"><?php echo $options;?></ul>
</td>
<td><?php echo $_G['group']['raterange'][$id]['min'];?> ~ <?php echo $_G['group']['raterange'][$id]['max'];?></td>
<td><?php echo $maxratetoday[$id];?></td>
</tr>
<?php } ?>
</table>

<div class="tpclg">
<h4>
<a onclick="showselect(this, 'reason', 'reasonselect')" class="dpbtn" href="javascript:;">^</a>
操作说明:
</h4>
<p><textarea id="reason" name="reason" class="pt" onkeyup="seditor_ctlent(event, '$(\'rateform\').ratesubmit.click()')"></textarea></p>
<ul id="reasonselect" style="display: none"><?php echo modreasonselect(); ?></ul>
</div>
</div>
<p class="o pns">
<button name="ratesubmit" type="submit" class="pn pnc" ><span>确定</span></button>
<input type="checkbox" name="sendreasonpm" id="sendreasonpm" class="pc"<?php if($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) { ?> checked="checked" disabled="disabled"<?php } ?> /> <label for="sendreasonpm" />通知作者</label>
</p>
</form>
</div>

<?php } elseif($_G['gp_action'] == 'removerate') { ?>

<form id="rateform" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=removerate&amp;ratesubmit=yes&amp;infloat=yes" onsubmit="ajaxpost('rateform', 'return_rate', 'return_rate', 'onerror');return false;">
<div class="f_c">
<h3 class="flb">
<em id="return_rate">撤销评分</em>
<span>
<?php if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('rate')" title="关闭">关闭</a><?php } ?>
</span>
</h3>	
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>">
<input type="hidden" name="pid" value="<?php echo $_G['gp_pid'];?>">
<?php if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="rate"><?php } ?>
<div class="c floatwrap">
<table class="list" cellspacing="0" cellpadding="0">
<thead>
<tr>
<td>&nbsp;</td>
<td>用户名</td>
<td>时间</td>
<td>积分</td>
<td>理由</td>
</tr>
</thead><?php if(is_array($ratelogs)) foreach($ratelogs as $ratelog) { ?><tr>
<td><input type="checkbox" name="logidarray[]" value="<?php echo $ratelog['uid'];?> <?php echo $ratelog['extcredits'];?> <?php echo $ratelog['dbdateline'];?>" /></td>
<td><a href="home.php?mod=space&amp;uid=<?php echo $ratelog['uid'];?>"><?php echo $ratelog['username'];?></a></td>
<td><?php echo $ratelog['dateline'];?></td>
<td><?php echo $_G['setting']['extcredits'][$ratelog['extcredits']]['title'];?> <span class="xw1"><?php echo $ratelog['scoreview'];?></span> <?php echo $_G['setting']['extcredits'][$ratelog['extcredits']]['unit'];?></td>
<td><?php echo $ratelog['reason'];?></td>
</tr>
<?php } ?>
</table>
</div>
</div>
<div class="o pns">
<label class="z"><input class="pc" type="checkbox" name="chkall" onclick="checkall(this.form, 'logid')" /> 全选</label>
<label><input type="checkbox" name="sendreasonpm" id="sendreasonpm" class="pc"<?php if($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) { ?> checked="checked" disabled="disabled"<?php } ?> /> <label for="sendreasonpm" />通知作者</label>
操作说明: <input name="reason" class="px vm" />
<button class="pn pnc vm" type="submit" value="true" name="ratesubmit"><span>提交</span></button>
</div>
</form>
<?php } ?>

<script type="text/javascript" reload="1">
function succeedhandle_rate(locationhref) {
<?php if(!empty($_G['gp_from'])) { ?>
location.href = locationhref;
<?php } else { ?>
ajaxget('forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?>&viewpid=<?php echo $_G['gp_pid'];?>', 'post_<?php echo $_G['gp_pid'];?>', 'post_<?php echo $_G['gp_pid'];?>');
hideWindow('rate');
<?php } ?>
}
loadcss('forum_moderator');
</script>

<?php if(empty($_G['gp_infloat'])) { ?>
</div>
</div>
</div>
<?php } include template('common/footer'); ?>