<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_usergroup', 'common/header');
0
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_usergroup_header.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_footer.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_usergroup_header.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_footer.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_usergroup_header.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_footer.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/common/simplesearchform.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header_name.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header_name.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/common/simplesearchform.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header_name.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header_name.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/common/simplesearchform.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header_name.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
|| checktplrefresh('./template/default/home/spacecp_usergroup.htm', './template/default/home/spacecp_header_name.htm', 1509344895, '2', './data/template/2_2_home_spacecp_usergroup.tpl.php', './template/8264', 'home/spacecp_usergroup')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_spacecp.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<?php if(in_array($do, array('buy', 'exit'))) { ?>
<div class="f_c">
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>"><?php if($join) { ?>加入或者购买用户组<?php } else { ?>退出<?php } ?></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>

<form id="buygroupform_<?php echo $groupid;?>" name="buygroupform_<?php echo $groupid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $groupid;?>"<?php if(!empty($_G['gp_inajax'])) { ?> onsubmit="ajaxpost('buygroupform_<?php echo $groupid;?>', 'return_<?php echo $_G['gp_handlekey'];?>', 'return_<?php echo $_G['gp_handlekey'];?>', 'onerror');return false;"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="buysubmit" value="true" />
<input type="hidden" name="tab" value="<?php echo $_G['gp_tab'];?>" />
<input type="hidden" name="perms" value="<?php echo $_G['gp_perms'];?>" />

<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table class="list" cellspacing="0" cellpadding="0" style="width:300px">
<tr>
<td>用户组头衔</td><td><?php echo $group['grouptitle'];?></td>
</tr>
<?php if($join) { if($group['dailyprice']) { ?>
<tr>
<td>日价格</td><td><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['title'];?> <?php echo $group['dailyprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstrans']]['unit'];?></td>
</tr>
<tr>
<td>你目前可以购买</td><td><?php echo $usermaxdays;?> 天</td>
</tr>
<tr>
<td>购买时间</td><td><input type="text" size="2" name="days" value="<?php echo $group['minspan'];?>" class="px" /> 天</td>
</tr>
<tr>
<td colspan="2">说明:
<?php if($join) { ?>
本组是收费用户组，你可以根据日价格按天购买，<br/>但是不能少于 <?php echo $group['minspan'];?> 天。请注意，购买后不能退款。
<?php } else { ?>
本操作不可恢复，你退出收费用户组后，如需再次加入，将重新支付相应的费用，因此请在提交前仔细确定是否退出本组。
<?php } ?>
</td>
</tr>
<?php } else { ?>
<tr>
<td colspan="2">说明: 加入该组是免费的，且没有时间限制，你可以随时加入或者退出</td>
</tr>
<?php } } else { ?>
<tr>
<td colspan="2">说明:
<?php if($group['type'] != 'special' || $group['system']=='private') { ?>
注意: 该组不是开放用户组，一旦你退出，只有管理员才能将你重新加入进来
<?php } elseif($group['dailyprice']) { ?>
本操作不可恢复，你退出收费用户组后，如需再次加入，将重新支付相应的费用，因此请在提交前仔细确定是否退出本组。
<?php } else { ?>
该组是开放的用户组，你退出后，可以随时加入进来
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
</div>
<p class="o pns">
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="pn pnc"><strong>提交</strong></button>
</p>
</form>
</div>

<?php } elseif($do == 'switch') { ?>
<div class="f_c">
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">切换</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form id="switchgroupform_<?php echo $groupid;?>" name="switchgroupform_<?php echo $groupid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=usergroup&amp;do=switch&amp;groupid=<?php echo $groupid;?>"<?php if(!empty($_G['gp_inajax'])) { ?> onsubmit="ajaxpost('switchgroupform_<?php echo $groupid;?>', 'return_<?php echo $_G['gp_handlekey'];?>', 'return_<?php echo $_G['gp_handlekey'];?>', 'onerror');return false;"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="groupsubmit" value="true" />
<input type="hidden" name="tab" value="<?php echo $_G['gp_tab'];?>" />
<input type="hidden" name="perms" value="<?php echo $_G['gp_perms'];?>" />

<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table class="list" cellspacing="0" cellpadding="0" style="width:300px">
<tr>
<td>原主用户组</td><td><?php echo $_G['group']['grouptitle'];?></td>
</tr>
<tr>
<td>新主用户组</td><td><?php echo $group['grouptitle'];?></td>
</tr>
<tr>
<td colspan="2">
说明: 主用户组决定了你在本论坛拥有哪些权限，<br/>你可以通过查看权限详细了解它
</td>
</tr>
<?php if(!$group['allowmultigroups']) { ?>
<tr>
<td colspan="2">
重要提醒:你选择的用户组《 <?php echo $group['grouptitle'];?> 》有使用限制。<br /><strong>一旦将它设为主用户组，你将失去购买其他扩展组的权利。</strong>
</td>
</tr>
<?php } ?>
</table>
</div>
<p class="o pns">
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="pn pnc"><strong>提交</strong></button>
</p>
</form>
</div>
<?php } elseif($do == 'forum') { ?><div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
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
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">设置</a> <em>&rsaquo;</em><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></h1>
<!--don't close the div here--><ul class="tb cl">
<?php if($usergroups) { ?>
<li class="y<?php echo $activegs['my'];?>"><a href="home.php?mod=spacecp&amp;ac=usergroup" class="showmenu" id="gmy" onmouseover="showMenu(this.id)">我的用户组</a></li>
<li class="y<?php echo $activegs['upgrade'];?>"><a class="showmenu" id="gupgrade" onmouseover="showMenu(this.id)">晋级用户组</a></li>
<li class="y<?php echo $activegs['user'];?>"><a class="showmenu" id="guser" onmouseover="showMenu(this.id)">普通用户组</a></li>
<li class="y<?php echo $activegs['admin'];?>"><a class="showmenu" id="gadmin" onmouseover="showMenu(this.id)">站点管理组</a></li>
<?php } ?>
<li<?php echo $activeus['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">我的用户组</a></li>
<?php if($_G['member']['groupexpiry']) { ?>
<li<?php echo $activeus['expiry'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=expiry">用户组有效期</a></li>
<?php } ?>
<li<?php echo $activeus['forum'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=forum">我的<?php echo $_G['setting']['navs']['2']['navname'];?>权限</a></li>
</ul><table cellpadding="0" cellspacing="0" class="tdat ftb mtm mbm">
<tr class="alt">
<th class="xw1">版块名称</th><?php if(is_array($perms)) foreach($perms as $perm) { ?><td class="xw1"><?php echo $permlang['perms_'.$perm];?></td>
<?php } ?>
</tr><?php $key = 1; if(is_array($_G['cache']['forums'])) foreach($_G['cache']['forums'] as $fid => $forum) { if($forum['status']) { ?>
<tr <?php if($key++%2==0) { ?>class="alt"<?php } ?>>
<th<?php if($forum['type'] == 'forum') { ?> style="padding-left:30px"<?php } elseif($forum['type'] == 'sub') { ?> style="padding-left:60px"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>"><?php echo $forum['name'];?></th><?php if(is_array($perms)) foreach($perms as $perm) { ?><td>
<?php if(!empty($verifyperm[$fid][$perm])) { if($myverifyperm[$fid][$perm] || $forumperm[$fid][$perm]) { ?>
<img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" class="vm" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" class="vm" />
<?php } ?>
&nbsp;<?php echo $verifyperm[$fid][$perm];?>
<?php } else { if($forumperm[$fid][$perm]) { ?><img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" /><?php } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" /><?php } ?>																						
<?php } ?>
</td>
<?php } ?>
</tr>
<?php } } ?>
</table>
<img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" class="vm" /> 表示有权操作&nbsp;
<img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" class="vm" /> 表示无权操作&nbsp;
<?php if($_G['setting']['verify']['enabled']) { echo implode('', $verifyicon); ?> 表示必须拥有指定的认证
<?php } ?>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ绑定</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
</div>
<?php } elseif($do == 'expiry') { ?><div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
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
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">设置</a> <em>&rsaquo;</em><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></h1>
<!--don't close the div here--><ul class="tb cl">
<?php if($usergroups) { ?>
<li class="y<?php echo $activegs['my'];?>"><a href="home.php?mod=spacecp&amp;ac=usergroup" class="showmenu" id="gmy" onmouseover="showMenu(this.id)">我的用户组</a></li>
<li class="y<?php echo $activegs['upgrade'];?>"><a class="showmenu" id="gupgrade" onmouseover="showMenu(this.id)">晋级用户组</a></li>
<li class="y<?php echo $activegs['user'];?>"><a class="showmenu" id="guser" onmouseover="showMenu(this.id)">普通用户组</a></li>
<li class="y<?php echo $activegs['admin'];?>"><a class="showmenu" id="gadmin" onmouseover="showMenu(this.id)">站点管理组</a></li>
<?php } ?>
<li<?php echo $activeus['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">我的用户组</a></li>
<?php if($_G['member']['groupexpiry']) { ?>
<li<?php echo $activeus['expiry'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=expiry">用户组有效期</a></li>
<?php } ?>
<li<?php echo $activeus['forum'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=forum">我的<?php echo $_G['setting']['navs']['2']['navname'];?>权限</a></li>
</ul><table cellspacing="0" cellpadding="0" class="dt mtm mbm">
<tbody class="th">
<tr>
<th>用户组</th>
<th>到期时间</th>
<th>类型</th>
</tr>
</tbody>
<tbody><?php if(is_array($expirylist)) foreach($expirylist as $group) { ?><tr class="<?php echo swapclass('alt'); ?>">
<td><?php echo $group['grouptitle'];?></td>
<td><?php echo $group['time'];?></td>
<td ><?php if($group['type'] == 'main') { ?>主用户组<?php } else { ?>扩展用户组<?php } ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ绑定</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
</div>
<?php } else { ?><div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
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
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">设置</a> <em>&rsaquo;</em><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><?php if($actives['profile']) { ?>
个人资料
<?php } elseif($actives['verify']) { ?>
认证
<?php } elseif($actives['avatar']) { ?>
修改头像
<?php } elseif($actives['credit']) { ?>
积分
<?php } elseif($actives['usergroup']) { ?>
用户组
<?php } elseif($actives['privacy']) { ?>
隐私筛选
<?php } elseif($actives['sendmail']) { ?>
邮件提醒
<?php } elseif($actives['password']) { ?>
密码安全
<?php } elseif($actives['qq']) { ?>
QQ绑定
<?php } elseif($actives['plugin']) { ?>
<?php echo $_G['setting']['plugins'][$pluginkey][$_G['gp_id']]['name'];?>
<?php } ?></h1>
<!--don't close the div here--><ul class="tb cl">
<?php if($usergroups) { ?>
<li class="y<?php echo $activegs['my'];?>"><a href="home.php?mod=spacecp&amp;ac=usergroup" class="showmenu" id="gmy" onmouseover="showMenu(this.id)">我的用户组</a></li>
<li class="y<?php echo $activegs['upgrade'];?>"><a class="showmenu" id="gupgrade" onmouseover="showMenu(this.id)">晋级用户组</a></li>
<li class="y<?php echo $activegs['user'];?>"><a class="showmenu" id="guser" onmouseover="showMenu(this.id)">普通用户组</a></li>
<li class="y<?php echo $activegs['admin'];?>"><a class="showmenu" id="gadmin" onmouseover="showMenu(this.id)">站点管理组</a></li>
<?php } ?>
<li<?php echo $activeus['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">我的用户组</a></li>
<?php if($_G['member']['groupexpiry']) { ?>
<li<?php echo $activeus['expiry'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=expiry">用户组有效期</a></li>
<?php } ?>
<li<?php echo $activeus['forum'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=forum">我的<?php echo $_G['setting']['navs']['2']['navname'];?>权限</a></li>
</ul><?php $permtype = array(0 => '普通权限', 1 => '管理权限'); ?><div class="tdats">
<table cellpadding="0" cellspacing="0" class="tdat">
<tr><th class="c0">&nbsp;</th></tr>
<tr><th class="alt">&nbsp;</th></tr>
<tbody class="ca"><?php if(is_array($bperms)) foreach($bperms as $key => $perm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th>帖子相关</th>
</tr>
<tbody class="cb"><?php if(is_array($pperms)) foreach($pperms as $key => $perm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>
<tr class="alt h">
<th>空间相关</th>
</tr>
<tbody class="cc"><?php if(is_array($sperms)) foreach($sperms as $key => $perm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th>附件相关</th>
</tr>
<tbody class="cd"><?php if(is_array($aperms)) foreach($aperms as $key => $perm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td><?php echo $permlang['perms_'.$perm];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<table cellpadding="0" cellspacing="0" class="tdat tfx<?php if(!$group) { ?>f<?php } ?>">
<tr>
<th class="c0"><h4>我的主用户组 - <?php echo $maingroup['grouptitle'];?></h4></th>
</tr>
<tr>
<th class="alt"><span class="notice">积分: <?php echo $space['credits'];?></span></th>
</tr><?php echo permtbody($maingroup); ?></table>
<?php if($group) { if($switchtype == 'user') { ?><?php $cid = 1;$tlang = '普通用户组'; } if($switchtype == 'upgrade') { ?><?php $cid = 2;$tlang = '晋级用户组'; } if($switchtype == 'admin') { ?><?php $cid = 3;$tlang = '站点管理组'; } ?>
<ul id="tba" class="tb c<?php echo $cid;?>">
<li id="c<?php echo $cid;?>"><?php echo $tlang;?> - <?php echo $currentgrouptitle;?></li>
</ul>
<div class="tscr">
<table cellpadding="0" cellspacing="0" class="tdat">
<tr>
<th class="alt h">
<?php if($group['grouptype'] == 'member') { ?><?php $v = $group[groupcreditshigher] - $_G['member']['credits']; if($_G['group']['grouptype'] == 'member' && $v > 0) { ?>
<span class="notice">你升级到此用户组还需积分 <?php echo $v;?></span>
<?php } else { ?>
<span class="notice">积分下限 <?php echo $group['groupcreditshigher'];?></span>
<?php } } if(isset($publicgroup[$group['groupid']]) && $group['groupid'] != $_G['groupid'] && $publicgroup[$group['groupid']]['allowsetmain']) { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=switch&amp;groupid=<?php echo $group['groupid'];?>&amp;perms=<?php echo $type;?>&amp;handlekey=switchgrouphk" class="xw1 xi2" onclick="showWindow('group', this.href, 'get', 0);">切换</a>
<?php } if(in_array($group['groupid'], $extgroupids) && $switchmaingroup && $group['grouptype'] == 'special' && $group['groupid'] != $_G['groupid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=exit&amp;groupid=<?php echo $group['groupid'];?>&amp;perms=<?php echo $type;?>&amp;handlekey=exitgrouphk" class="xw1 xi2" onclick="showWindow('group', this.href, 'get', 0);">退出</a>
<?php } if($group['grouptype']=='special' && $group['groupid'] != $_G['groupid'] && array_key_exists($group['groupid'], $publicgroup) && !$publicgroup[$group['groupid']]['allowsetmain']) { ?>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;do=buy&amp;groupid=<?php echo $group['groupid'];?>&amp;perms=<?php echo $type;?>&amp;handlekey=buygrouphk" class="xw1 xi2" onclick="showWindow('group', this.href, 'get', 0);">购买</a>
<?php } if(array_key_exists($group['groupid'], $groupterms['ext'])) { ?>
<span class="notice">用户组过期时间: <?php echo dgmdate($groupterms[ext][$group['groupid']]); ?></span>
<?php } ?>
</th>
</tr><?php echo permtbody($group); ?></table>
</div>
<?php } ?>
</div>
<img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" class="vm" /> 表示有权操作&nbsp;
<img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" class="vm" /> 表示无权操作
<div id="gmy_menu" class="p_pop" style="display:none"><?php echo $usergroups['my'];?></div>
<div id="gupgrade_menu" class="p_pop" style="display:none"><?php echo $usergroups['upgrade'];?></div>
<div id="guser_menu" class="p_pop" style="display:none"><?php echo $usergroups['user'];?></div>
<div id="gadmin_menu" class="p_pop" style="display:none"><?php echo $usergroups['admin'];?></div>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ绑定</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
</div>
<?php } ?><?php function permtbody($maingroup) {
global $bperms, $pperms, $sperms, $aperms; ?><tbody class="ca"><?php if(is_array($bperms)) foreach($bperms as $key => $groupbperm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if($groupbperm == 'creditshigher' || $groupbperm == 'readaccess' || $groupbperm == 'maxpmnum') { ?>
<?php echo $maingroup[$groupbperm];?>
<?php } elseif($groupbperm == 'allowsearch') { if($maingroup['allowsearch'] == '0') { ?>禁用搜索<?php } elseif($maingroup['allowsearch'] == '1') { ?>只允许搜索标题<?php } else { ?>允许搜索帖子内容<?php } } else { if($maingroup[$groupbperm] >= 1) { ?><img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" /><?php } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" /><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th><?php echo $maingroup['grouptitle'];?></th>
</tr>
<tbody class="cb"><?php if(is_array($pperms)) foreach($pperms as $key => $grouppperm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if($grouppperm == 'maxsigsize' || $grouppperm == 'maxbiosize') { ?>
<?php echo $maingroup[$grouppperm];?> 字节
<?php } elseif($grouppperm == 'allowrecommend') { if($maingroup['allowrecommend'] > 0) { ?>+<?php echo $maingroup['allowrecommend'];?><?php } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" /><?php } } else { if($maingroup[$grouppperm] == 1) { ?><img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" /><?php } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" /><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody>
<tr class="alt h">
<th><?php echo $maingroup['grouptitle'];?></th>
</tr>
<tbody class="cc"><?php if(is_array($sperms)) foreach($sperms as $key => $perm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if(in_array($perm, array('maxspacesize'))) { if($maingroup[$perm]) { ?><?php echo $maingroup[$perm];?><?php } else { ?>没有限制<?php } } else { if($maingroup[$perm] == 1) { ?><img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" /><?php } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" /><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody>

<tr class="alt h">
<th><?php echo $maingroup['grouptitle'];?></th>
</tr>
<tbody class="cd"><?php if(is_array($aperms)) foreach($aperms as $key => $groupaperm) { ?><tr <?php if($key!=0&&($key+1)%2==0) { ?>class="alt"<?php } ?>>
<td>
<?php if(in_array($groupaperm, array('maxattachsize', 'maxsizeperday', 'maxattachnum'))) { if($maingroup[$groupaperm]) { ?><?php echo $maingroup[$groupaperm];?><?php } else { ?>没有限制<?php } } elseif($groupaperm == 'attachextensions') { if($maingroup['allowpostattach'] == 1) { if($maingroup['attachextensions']) { ?><p class="nwp" title="<?php echo $maingroup['attachextensions'];?>"><?php echo $maingroup['attachextensions'];?></p><?php } else { ?>没有限制<?php } } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" /><?php } } else { if($maingroup[$groupaperm] == 1) { ?><img src="http://static.8264.com/static/image/common/data_valid.gif" alt="data_valid" /><?php } else { ?><img src="http://static.8264.com/static/image/common/data_invalid.gif" alt="data_invalid" /><?php } } ?>
</td>
</tr>
<?php } ?>
</tbody><?php } include template('common/footer'); ?>