<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('topicadmin', 'common/header');
0
|| checktplrefresh('./template/default/forum/topicadmin.htm', './template/default/common/simplesearchform.htm', 1505274330, '2', './data/template/2_2_forum_topicadmin.tpl.php', './template/8264', 'forum/topicadmin')
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
<?php } ?>

<div class="tm_c" id="floatlayout_topicadmin">
<h3 class="flb">
<em id="return_mods">选择了 <?php echo $modpostsnum;?> 篇帖子</em>
<span>
<a href="javascript:;" class="flbc" onclick="hideWindow('mods')" title="关闭">关闭</a>
</span>
</h3>
<form id="moderateform" method="post" autocomplete="off" action="<?php echo $_G['config']['web']['forum'];?>forum.php?mod=topicadmin&action=moderate&optgroup=<?php echo $optgroup;?>&modsubmit=yes&infloat=yes" onsubmit="ajaxpost('moderateform', 'return_mods', 'return_mods', 'onerror');return false;">
<input type="hidden" name="frommodcp" value="<?php echo $frommodcp;?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>" />
<?php if($_G['gp_typeid']) { ?>
<input type="hidden" name="typeid" value="<?php echo $_G['gp_typeid'];?>" />
<?php } ?>
<input type="hidden" name="redirect" value="<?php echo dreferer(); ?>" />
<?php if(!empty($_G['gp_listextra'])) { ?><input type="hidden" name="listextra" value="<?php echo $_G['gp_listextra'];?>" /><?php } if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } if(is_array($threadlist)) foreach($threadlist as $thread) { ?><input type="hidden" name="moderate[]" value="<?php echo $thread['tid'];?>" />
<?php } ?>
<div class="c">
<?php if($_G['gp_optgroup'] == 1) { ?>
<ul class="tpcl">
<?php if(count($threadlist) > 1 || empty($defaultcheck['recommend'])) { if($_G['group']['allowstickthread']) { ?>

<li id="itemcp_stick">
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
<td width="15"><input type="checkbox" name="operations[]" class="pc" onclick="if(this.checked) switchitemcp('itemcp_stick')" value="stick" <?php echo $defaultcheck['stick'];?> /></td>
<td class="hasd">
<label onclick="switchitemcp('itemcp_stick')" class="labeltxt">置顶</label>
<div class="dopt">
<select class="ps" name="sticklevel">
<?php if($_G['forum']['status'] != 3) { ?>
<option value="0">取消置顶</option>
<option value="9" <?php echo $stickcheck['9'];?>><?php echo $_G['setting']['threadsticky']['3'];?> </option>
<?php if(! $nobanlevel) { ?>
<option value="1" <?php echo $stickcheck['1'];?>><?php echo $_G['setting']['threadsticky']['2'];?></option>
<?php } if($_G['group']['allowstickthread'] >= 2) { ?>
<option value="2" <?php echo $stickcheck['2'];?>><?php echo $_G['setting']['threadsticky']['1'];?></option>
<?php if($_G['group']['allowstickthread'] == 3) { ?>
<option value="3" <?php echo $stickcheck['3'];?>><?php echo $_G['setting']['threadsticky']['0'];?></option>
<?php } } } else { ?>
<option value="0">否&nbsp;</option>
<option value="1" <?php echo $stickcheck['1'];?>>是&nbsp;</option>
<?php } ?>
</select>
</div>
</td>
</tr>
<tr class="dopt">
<td>&nbsp;</td>
<td>
<p class="hasd">
<label for="expirationstick" class="labeltxt">有效期</label>
<input onclick="showcalendar(event, this, true)" type="text" autocomplete="off" id="expirationstick" name="expirationstick" class="px" value="<?php echo $expirationstick;?>" tabindex="1" />
<a href="javascript:;" class="dpbtn" onclick="showselect(this, 'expirationstick')">^</a>
</p>
</td>
</tr>
</table>
</li>
<?php } if($_G['group']['allowdigestthread']) { ?>
<li id="itemcp_digest">
<table cellspacing="0" cellpadding="5">
<tr>
<td width="15"><input type="checkbox" name="operations[]" class="pc" onclick="if(this.checked) switchitemcp('itemcp_digest')" value="digest" <?php echo $defaultcheck['digest'];?> /></td>
<td class="hasd">
<label onclick="switchitemcp('itemcp_digest')" class="labeltxt">精华</label>
<div class="dopt">
<select name="digestlevel">
<option value="0">解除</option>
<option value="1" <?php echo $digestcheck['1'];?>>精华 1</option>
<?php if($_G['group']['allowdigestthread'] >= 2) { ?>
<option value="2" <?php echo $digestcheck['2'];?>>精华 2</option>
<?php if($_G['group']['allowdigestthread'] == 3) { ?>
<option value="3" <?php echo $digestcheck['3'];?>>精华 3</option>
<?php } } ?>
</select>
</div>
</td>
</tr>
<tr class="dopt" style="display: none;">
<td>&nbsp;</td>
<td>
<p class="hasd">
<label for="expirationdigest" class="labeltxt">有效期</label>
<input onclick="showcalendar(event, this, true)" type="text" name="expirationdigest" id="expirationdigest" class="px" autocomplete="off" value="<?php echo $expirationdigest;?>" tabindex="1" />
<a href="javascript:;" class="dpbtn" onclick="showselect(this, 'expirationdigest')">^</a>
</p>
</td>
</tr>
</table>
</li>
<?php } if($_G['group']['allowbumpthread']) { ?>
<li>
<table cellspacing="0" cellpadding="5">
<tr>
<td width="15"><input type="checkbox" name="operations[]" class="pc" value="bump" <?php echo $defaultcheck['bump'];?> /></td>
<td><label for="">提升</label></td>
</tr>
</table>
</li>
<?php } if($_G['group']['allowhighlightthread']) { ?>
<li id="itemcp_highlight">
<table cellspacing="0" cellpadding="5">
<tr>
<td width="15"><input type="checkbox" name="operations[]" onclick="if(this.checked) switchitemcp('itemcp_highlight')" value="highlight" <?php echo $defaultcheck['highlight'];?> /></td>
<td class="hasd"><?php $_G['forum_colorarray'] = array(1=>'#EE1B2E', 2=>'#EE5023', 3=>'#996600', 4=>'#3C9D40', 5=>'#2897C5', 6=>'#2B65B7', 7=>'#8F2A90', 8=>'#EC1282'); ?><label onclick="switchitemcp('itemcp_highlight')" class="labeltxt">高亮</label>
<div class="dopt">
<span class="hasd">
<input type="hidden" id="highlight_color" name="highlight_color" value="<?php echo $colorcheck;?>" />
<input type="hidden" id="highlight_style_1" name="highlight_style[1]" value="<?php echo $stylecheck['1'];?>" />
<input type="hidden" id="highlight_style_2" name="highlight_style[2]" value="<?php echo $stylecheck['2'];?>" />
<input type="hidden" id="highlight_style_3" name="highlight_style[3]" value="<?php echo $stylecheck['3'];?>" />
<input id="highlight_color_show" type="text" class="crl" readonly="readonly" <?php if($colorcheck) { ?>style="background: <?php echo $_G['colorarray'][$colorcheck];?>" <?php } ?>/>
<a href="javascript:;" id="highlight_color_ctrl" onclick="showHighLightColor('highlight_color')" class="dpbtn">^</a>
</span>
<a href="javascript:;" id="highlight_op_1" onclick="switchhl(this, 1)" class="dopt_b<?php if($stylecheck['1']) { ?> cnt<?php } ?>" style="text-indent:0;text-decoration:none;font-weight:700;" title="文字加粗">B</a>
<a href="javascript:;" id="highlight_op_2" onclick="switchhl(this, 2)" class="dopt_i<?php if($stylecheck['2']) { ?> cnt<?php } ?>" style="text-indent:0;text-decoration:none;font-style:italic;" title="文字斜体">I</a>
<a href="javascript:;" id="highlight_op_3" onclick="switchhl(this, 3)" class="dopt_l<?php if($stylecheck['3']) { ?> cnt<?php } ?>" style="text-indent:0;text-decoration:underline;" title="文字加下划线">U</a>
</div>
</td>
</tr>
<tr class="dopt">
<td>&nbsp;</td>
<td>
<p class="hasd">
<label for="expirationhighlight" class="labeltxt">有效期</label>
<input type="text" name="expirationhighlight" id="expirationhighlight" class="px" onclick="showcalendar(event, this, true)" autocomplete="off" value="<?php echo $expirationhighlight;?>" tabindex="1" />
<a href="javascript:;" class="dpbtn" onclick="showselect(this, 'expirationhighlight')">^</a>
</p>
</td>
</tr>
</table>
</li>
<?php } } if($_G['group']['allowrecommendthread'] && !empty($_G['forum']['modrecommend']['open']) && $_G['forum']['modrecommend']['sort'] != 1) { ?>
<li id="itemcp_recommend">
<table cellspacing="0" cellpadding="5">
<tr>
<td width="15"><input name="operations[]" onclick="if(this.checked) switchitemcp('itemcp_recommend')" type="checkbox" value="recommend" <?php echo $defaultcheck['recommend'];?> /></td>
<td>
<label onclick="switchitemcp('itemcp_recommend')" class="labeltxt">推荐</label>
<div class="dopt">
<label><input type="radio" name="isrecommend" class="pr" value="1" checked="checked" /> 推荐</label>
<label><input type="radio" name="isrecommend" class="pr" value="0" /> 解除</label>
</div>
</td>
</tr>
<tr class="dopt">
<td>&nbsp;</td>
<td>
<p class="hasd">
<label for="expirationrecommend" class="labeltxt">有效期</label>
<input type="text" name="expirationrecommend" id="expirationrecommend" class="px" onclick="showcalendar(event, this, true)" autocomplete="off" value="<?php echo $expirationrecommend;?>" tabindex="1" />
<a href="javascript:;" class="dpbtn" onclick="showselect(this, 'expirationrecommend')">^</a>
</p>
</td>
</tr>
<?php if($defaultcheck['recommend'] && count($threadlist) == 1) { ?>
<input type="hidden" name="position" value="1" />
<tr class="dopt">
<td>&nbsp;</td>
<td>
<label for="reducetitle" class="labeltxt">标题</label>
<input type="text" name="reducetitle" id="reducetitle" class="px" style="width: 125px" value="<?php echo $thread['subject'];?>" tabindex="2" />
</td>
</tr>
<?php if($imgattach) { ?>
<tr class="dopt">
<td>&nbsp;</td>
<td>
<label class="labeltxt">图片</label>
<select name="selectattach" onchange="updateimginfo(this.value)" class="ps" style="width: 125px">
<option value="">不显示</option><?php if(is_array($imgattach)) foreach($imgattach as $imginfo) { ?><option value="<?php echo $imginfo['aid'];?>"<?php if($selectattach == $imginfo['aid']) { ?> selected="selected"<?php } ?>><?php echo $imginfo['filename'];?></option>
<?php } ?>
</select>
</td>
</tr>
<tr class="dopt">
<td>&nbsp;</td>
<td>
<label class="labeltxt">&nbsp;</label>
<img id="selectimg" src="<?php echo STATICURL;?>image/common/none.gif"  width="120" height="80" />
<script type="text/javascript" reload="1">
var imgk = new Array();<?php if(is_array($imgattach)) foreach($imgattach as $imginfo) { ?><?php $a = '\"\'\t\\""\\\''."\\\\";$k = $imginfo['aid'].'&size=120x80&key='.rawurlencode(authcode($imginfo['aid']."\t120\t80", 'ENCODE', $_G['config']['security']['authkey'])).'&nocache=yes'; ?>imgk[<?php echo $imginfo['aid'];?>] = '<?php echo $k;?>';
<?php } ?>
function updateimginfo(aid) {
if(aid) {
$('selectimg').src='forum.php?mod=image&aid=' + imgk[aid];
} else {
$('selectimg').src='<?php echo STATICURL;?>image/common/none.gif';
}
}
<?php if($selectattach) { ?>updateimginfo('<?php echo $selectattach;?>');<?php } ?>
</script>
</td>
</tr>
<?php } } ?>
</table>
</li>
<?php } ?>
</ul>
<?php } elseif($_G['gp_optgroup'] == 2) { ?>
<div class="tplw">
<?php if($operation != 'type') { ?>
<input type="hidden" name="operations[]" value="move" />
<p class="mbn tahfx">
目标版块: <select name="moveto" id="moveto" class="ps vm" onchange="ajaxget('forum.php?mod=ajax&action=getthreadtypes&fid=' + this.value, 'threadtypes');if(this.value) {$('moveext').style.display='';} else {$('moveext').style.display='none';}">
<?php echo $forumselect;?>
</select>
</p>
<p class="mbn tahfx">
目标分类: <span id="threadtypes"><select name="threadtypeid" class="ps vm"><option value="0" /></option></select></span>
</p>
<ul class="llst" id="moveext" style="display:none;margin:5px 0;">
<li class="wide"><label><input type="radio" name="type" class="pr" value="normal" checked="checked" /> 移动主题</label></li>
<li class="wide"><label><input type="radio" name="type" class="pr" value="redirect" /> 保留转向</label></li>
</ul>
<?php } else { if($typeselect) { ?>
<input type="hidden" name="operations[]" value="type" />
<p>分类: <?php echo $typeselect;?></p>
<?php } else { ?>
当前版块无分类设置，请联系管理员到后台设置主题分类<?php $hiddensubmit = true; } } ?>
</div>
<?php } elseif($_G['gp_optgroup'] == 3) { ?>
<div class="tplw">
<ul class="llst">
<?php if($operation == 'delete') { ?>
<li>
<?php if($_G['group']['allowdelpost']) { ?>
<input name="operations[]" type="hidden" value="delete"/>
<p>你确认要 <strong>删除</strong> 选择的主题么?</p>
<?php } else { ?>
<p>你没有删除此主题权限</p>
<?php } ?>
</li>
<?php } elseif($operation == 'down' || $operation='bump') { ?>
<li class="wide"><label><input type="radio" name="operations[]" class="pr" value="bump" checked="checked"/> 提升主题</label></li>
<li class="wide"><label><input type="radio" name="operations[]" class="pr" value="down" /> 下沉主题</label></li>
<?php } ?>
</ul>
</div>
<?php } elseif($_G['gp_optgroup'] == 4) { ?>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>有效期:&nbsp;</td>
<td>
<p class="hasd">
<input type="text" name="expirationclose" id="expirationclose" class="px" onclick="showcalendar(event, this, true)" autocomplete="off" value="<?php echo $expirationclose;?>" tabindex="1" />
<a href="javascript:;" class="dpbtn" onclick="showselect(this, 'expirationclose')">^</a>
</p>
</td>
</tr>
<tr>
<td colspan="2" style="padding: 5px 0;">
<ul class="llst">
<li class="wide"><label><input type="radio" name="operations[]" class="pr" value="open" <?php echo $closecheck['0'];?> />打开主题</label></li>
<li class="wide"><label><input type="radio" name="operations[]" class="pr" value="close" <?php echo $closecheck['1'];?> />关闭主题</label></li>
</ul>
</td>
</tr>
</table>
<?php } elseif($_G['gp_optgroup'] == 5) { ?>
<div class="tplw">
<?php if($operation == 'recommend_group') { ?>
<input type="hidden" name="operations[]" value="recommend_group" />
<p class="mbn tahfx">
目标版块: <select id="moveto" name="moveto" class="ps vm">
<?php echo $forumselect;?>
</select>
</p>
<?php } ?>
</div>
<?php } ?>
<div class="tpclg">
<?php if(empty($hiddensubmit)) { ?>
<h4 class="cl"><a onclick="showselect(this, 'reason', 'reasonselect')" class="dpbtn" href="javascript:;">^</a><span>操作原因:</span></h4>
<p>
<textarea id="reason" name="reason" class="pt" onkeyup="seditor_ctlent(event, '$(\'modsubmit\').click();')" rows="3"></textarea>
</p>
<ul id="reasonselect" style="display: none"><?php echo modreasonselect(); ?></ul>
<?php } ?>
</div>
</div>
<?php if(empty($hiddensubmit)) { ?>
<p class="o pns">
<button type="submit" name="modsubmit" id="modsubmit" class="pn pnc" value="确定"><span>确定</span></button>
<input type="checkbox" name="sendreasonpm" id="sendreasonpm" class="pc"<?php if($_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3) { ?> checked="checked" disabled="disabled"<?php } ?> /> <label for="sendreasonpm" />通知作者</label>
</p>
<?php } ?>
</form>
</div>

<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>

<script type="text/javascript" reload="1">
function succeedhandle_mods(locationhref) {
hideWindow('mods');
<?php if(!empty($_G['gp_from'])) { ?>
location.href = 'forum.php?mod=viewthread&tid=<?php echo $_G['gp_from'];?>&extra=<?php echo $_G['gp_listextra'];?>';
<?php } else { ?>
location.href = locationhref;
<?php } ?>
}
var lastsel = null;
function switchitemcp(id) {
if(lastsel) {
lastsel.className = '';
}
$(id).className = 'copt';
lastsel = $(id);
}

<?php if(!empty($operation)) { ?>
if($('itemcp_<?php echo $operation;?>')) {
switchitemcp('itemcp_<?php echo $operation;?>');
}
<?php } ?>
function switchhl(obj, v) {
if(parseInt($('highlight_style_' + v).value)) {
$('highlight_style_' + v).value = 0;
obj.className = obj.className.replace(/ cnt/, '');
} else {
$('highlight_style_' + v).value = 1;
obj.className += ' cnt';
}
}
function showHighLightColor(hlid) {
var showid = hlid + '_show';
if(!$(showid + '_menu')) {
var str = '';
var coloroptions = {'0' : '#000', '1' : '#EE1B2E', '2' : '#EE5023', '3' : '#996600', '4' : '#3C9D40', '5' : '#2897C5', '6' : '#2B65B7', '7' : '#8F2A90', '8' : '#EC1282'};
var menu = document.createElement('div');
menu.id = showid + '_menu';
menu.className = 'cmen';
menu.style.display = 'none';
for(var i in coloroptions) {
str += '<a href="javascript:;" onclick="$(\'' + hlid + '\').value=' + i + ';$(\'' + showid + '\').style.backgroundColor=\'' + coloroptions[i] + '\';hideMenu(\'' + menu.id + '\')" style="background:' + coloroptions[i] + ';color:' + coloroptions[i] + ';">' + coloroptions[i] + '</a>';
}
menu.innerHTML = str;
$('append_parent').appendChild(menu);
}
showMenu({'ctrlid':hlid + '_ctrl','evt':'click','showid':showid});
}
</script>

<?php if(empty($_G['gp_infloat'])) { ?>
</div>
</div>
</div>
<?php } include template('common/footer'); ?>