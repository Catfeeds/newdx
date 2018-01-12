<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_comment', 'common/header');
0
|| checktplrefresh('./template/8264/home/spacecp_comment.htm', './template/default/common/simplesearchform.htm', 1490019991, '2', './data/template/2_2_home_spacecp_comment.tpl.php', './template/8264', 'home/spacecp_comment')
|| checktplrefresh('./template/8264/home/spacecp_comment.htm', './template/8264/common/seccheck_2014.htm', 1490019991, '2', './data/template/2_2_home_spacecp_comment.tpl.php', './template/8264', 'home/spacecp_comment')
|| checktplrefresh('./template/8264/home/spacecp_comment.htm', './template/default/common/userabout.htm', 1490019991, '2', './data/template/2_2_home_spacecp_comment.tpl.php', './template/8264', 'home/spacecp_comment')
;?><?php include template('common/header'); if(!$_G['inajax']) { ?>
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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a></div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<?php } if($_GET['op'] == 'edit') { ?>
<form id="editcommentform_<?php echo $cid;?>" name="editcommentform_<?php echo $cid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $cid;?>&amp;is_uc=1<?php if($_G['gp_modcommentkey']) { ?>&amp;modcommentkey=<?php echo $_G['gp_modcommentkey'];?><?php } ?>" <?php if($_G['inajax']) { ?> onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox w570">
<div class="flb">
<div class="popbox_title clearfix">
<span>编辑</span>			
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div class="textareabox">
<textarea id="message_<?php echo $cid;?>" name="message" cols="" rows="" onkeydown="ctrlEnter(event, 'editsubmit_btn');" placeholder="编辑描述"><?php echo $comment['message'];?></textarea>
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="button_confirm"><strong>提交</strong></button>
</div>		
</div>	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="editsubmit" value="true" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>	
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
comment_edit(values['cid']);
}
</script>
<?php } elseif($_GET['op'] == 'delete') { ?>
<form id="deletecommentform_<?php echo $cid;?>" name="deletecommentform_<?php echo $cid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $cid;?>&amp;is_uc=1" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>		
<div class="popbox w450 textcenter">			
<div class="dhinfo">
<span>确定删除指定的回复吗？</span>
<em></em>
</div>
<div>
<button type="submit" name="deletesubmitbtn" value="true" class="button_cancel"><strong>确定</strong></button>
<?php if($_G['inajax']) { ?><input class="button_confirm" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="取消" type="button"/><?php } ?>
</div>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="margin-top:20px;display:none;">删除回复</div>				
</div>	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
comment_delete(values['cid']);
}
</script>
<?php } elseif($_GET['op'] == 'reply') { ?>
<form id="replycommentform_<?php echo $comment['cid'];?>" name="replycommentform_<?php echo $comment['cid'];?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=comment&amp;is_uc=1" <?php if($_G['inajax']) { ?> onsubmit="ajaxpost('replycommentform_<?php echo $comment['cid'];?>', 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox w570">
<div class="flb">
<div class="popbox_title clearfix">
<span id="return_<?php echo $_G['gp_handlekey'];?>">回复</span>			
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div class="textareabox" id="reply_msg_<?php echo $comment['cid'];?>">
<textarea id="message_pop_<?php echo $comment['cid'];?>" name="message" cols="" rows="" onkeydown="ctrlEnter(event, 'commentsubmit_btn');"></textarea>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
<style type="text/css">
.code-wrap{
font-size: 12px;
position: relative;
}
.code-wrap .que{
display: block;
padding-bottom: 5px!important;
font-size: 12px!important;
}
.code-wrap em{
display: block;
float: left;
width: 60px;
margin-top: 4px;;
}
.code-wrap [id^="checksec"]{
width: 0;
height: 0;
padding: 0!important;
margin: 0;
}
.code-wrap input{
padding: 3px 5px;
height: 18px;
margin-left: 5px;
border: 1px solid #d6d6d6;
}
.code-wrap span{
display: inline-block!important;
*display: inline!important;
*zoom: 1!important;
}
</style>
<div class="code-wrap"><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="que" onclick="showMenu(this.id);" style="width:50%;"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none;"><sec></div>
EOF;
?>
<div class="mtm mbm sec"><?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplqaa = str_replace('<classname>', 'tw', $sectplqaa);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$sectplcode = str_replace('<classname>', 'yzm', $sectplcode);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex; ?><?php
$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

<script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r={$sechash}" type="text/javascript"></script>

EOF;
 } if($seccodecheck) { 
$seccheckhtml .= <<<EOF

{$sectplcode['0']}{$sectplcode['1']}<em>验证码</em><input name="seccodeverify" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="width:100px" onblur="checksec('code', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checkseccodeverify_{$sechash}"><img src="http://static.8264.com/static/image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplcode['2']}<span id="seccode_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}', undefined, '点击换一个，更换验证码');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}

EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow); if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?>
</div>
</div>							
<?php } ?>
<button type="submit" name="commentsubmit_btn" id="commentsubmit_btn" value="true" class="button_confirm"><strong>回复</strong></button>
</div>		
</div>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="id" value="<?php echo $comment['id'];?>" />
<input type="hidden" name="idtype" value="<?php echo $comment['idtype'];?>" />
<input type="hidden" name="cid" value="<?php echo $comment['cid'];?>" />
<input type="hidden" name="commentsubmit" value="true" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
<?php if($comment['idtype']!='uid') { if($_GET['feedid']) { ?>
feedcomment_add(values['cid'], <?php echo $_GET['feedid'];?>);
<?php } else { ?>
comment_add(values['cid']);
<?php } } ?>
}
</script>

<?php } if(!$_G['inajax']) { ?>
</div>
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
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">展开</a></p>
<?php } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?php echo IMGDIR;?>/app_add.gif" alt="app_add" />添加<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?php echo IMGDIR;?>/app_set.gif" alt="app_set" />管理<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
</ul>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script></div>
</div>
<?php } include template('common/footer'); ?>