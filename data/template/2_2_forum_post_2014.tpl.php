<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/forum/post_2014.htm', './template/8264/common/header_8264_new_ajax.htm', 1509517765, '2', './data/template/2_2_forum_post_2014.tpl.php', './template/8264', 'forum/post_2014')
|| checktplrefresh('./template/8264/forum/post_2014.htm', './template/default/common/simplesearchform.htm', 1509517765, '2', './data/template/2_2_forum_post_2014.tpl.php', './template/8264', 'forum/post_2014')
|| checktplrefresh('./template/8264/forum/post_2014.htm', './template/8264/common/editor_2014.htm', 1509517765, '2', './data/template/2_2_forum_post_2014.tpl.php', './template/8264', 'forum/post_2014')
|| checktplrefresh('./template/8264/forum/post_2014.htm', './template/8264/common/editor_menu_2014.htm', 1509517765, '2', './data/template/2_2_forum_post_2014.tpl.php', './template/8264', 'forum/post_2014')
|| checktplrefresh('./template/8264/forum/post_2014.htm', './template/8264/forum/editor_menu_forum_newimage_2014.htm', 1509517765, '2', './data/template/2_2_forum_post_2014.tpl.php', './template/8264', 'forum/post_2014')
|| checktplrefresh('./template/8264/forum/post_2014.htm', './template/default/common/footer_ajax.htm', 1509517765, '2', './data/template/2_2_forum_post_2014.tpl.php', './template/8264', 'forum/post_2014')
;?>
<?php ob_end_clean();
ob_start();
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: text/xml; charset=".CHARSET);
echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n"; ?><root><![CDATA[<link href="http://static.8264.com/static/css/forum/forum_post.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<?php if($_G['gp_action'] == 'edit') { ?><?php $editor[value] = $postinfo[message]; } else { ?><?php $editor[value] = $message; } ?>
<script src="<?php echo $_G['setting']['jspath'];?>forum_post.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php
$actiontitle = <<<EOF


EOF;
 if($_G['gp_action'] == 'newthread') { if($special == 0) { 
$actiontitle .= <<<EOF
发表帖子

EOF;
 } elseif($special == 1) { 
$actiontitle .= <<<EOF
发起投票

EOF;
 } elseif($special == 2) { 
$actiontitle .= <<<EOF
出售商品

EOF;
 } elseif($special == 3) { 
$actiontitle .= <<<EOF
发布悬赏

EOF;
 } elseif($special == 4) { 
$actiontitle .= <<<EOF
发起活动

EOF;
 } elseif($special == 5) { 
$actiontitle .= <<<EOF
发起辩论

EOF;
 } elseif($specialextra) { 
$actiontitle .= <<<EOF
{$_G['setting']['threadplugins'][$specialextra]['name']}

EOF;
 } } elseif($_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade'])) { 
$actiontitle .= <<<EOF

添加商品

EOF;
 } elseif($_G['gp_action'] == 'reply') { 
$actiontitle .= <<<EOF

参与/回复主题

EOF;
 } elseif($_G['gp_action'] == 'edit') { if($special == 2) { 
$actiontitle .= <<<EOF
编辑商品
EOF;
 } else { 
$actiontitle .= <<<EOF
编辑帖子
EOF;
 } } 
$actiontitle .= <<<EOF


EOF;
?><?php
$icon = <<<EOF


EOF;
 if($special == 1) { 
$icon .= <<<EOF
poll

EOF;
 } elseif($special == 2) { 
$icon .= <<<EOF
trade

EOF;
 } elseif($special == 3) { 
$icon .= <<<EOF
reward

EOF;
 } elseif($special == 4) { 
$icon .= <<<EOF
activity

EOF;
 } elseif($special == 5) { 
$icon .= <<<EOF
debate

EOF;
 } elseif($isfirstpost && $sortid) { 
$icon .= <<<EOF
sort

EOF;
 } 
$icon .= <<<EOF


EOF;
?>

<?php if($_G['gp_action'] != 'newthread') { ?><?php $subjectcut = cutstr($thread[subject], 30); } ?><?php
$actionsubject = <<<EOF


EOF;
 if($_G['gp_action'] == 'reply') { 
$actionsubject .= <<<EOF

<em>&rsaquo;</em><a href="forum.php?mod=viewthread&amp;tid={$thread['tid']}">{$subjectcut}</a>

EOF;
 } elseif($_G['gp_action'] == 'edit') { 
$actionsubject .= <<<EOF

<em>&rsaquo;</em><a href="forum.php?mod=redirect&amp;goto=findpost&amp;ptid={$thread['tid']}&amp;pid={$pid}">{$subjectcut}</a>

EOF;
 } 
$actionsubject .= <<<EOF


EOF;
?>

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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <?php echo $navigation;?><?php echo $actionsubject;?> <em>&rsaquo;</em> <?php echo $actiontitle;?></div>
</div><?php $adveditor = $isfirstpost && $special || $special == 2 && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && $thread['special'] == 2); ?><?php $advmore = !$showthreadsorts && !$special || $_G['gp_action'] == 'reply' && empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && !$isfirstpost && ($thread['special'] == 2 && !$special || $thread['special'] != 2); ?><div id="ct" class="ct2_a wp cl">
<div class="mn">
<form method="post" autocomplete="off" id="postform"
<?php if($_G['gp_action'] == 'newthread') { ?>action="forum.php?mod=post&amp;action=<?php if($special != 2) { ?>newthread<?php } else { ?>newtrade<?php } ?>&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;topicsubmit=yes"
<?php } elseif($_G['gp_action'] == 'reply') { ?>action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $_G['gp_repquote'];?>&amp;postid=<?php echo $_G['gp_postid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=<?php echo $_G['gp_way'];?>&amp;cid=<?php echo $_G['gp_cid'];?>&amp;extra=<?php echo $extra;?>&amp;replysubmit=yes"
<?php } elseif($_G['gp_action'] == 'edit') { ?>action="forum.php?mod=post&amp;action=edit&amp;extra=<?php echo $extra;?>&amp;editsubmit=yes" <?php echo $enctype;?>
<?php } if($_G['fid']==408) { ?>onsubmit="return validatenosymbol(this)"<?php } else { ?>onsubmit="return validate(this)"<?php } ?>>
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<?php if(!empty($_G['gp_modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_G['gp_modthreadkey'];?>" /><?php } ?>
<input type="hidden" name="wysiwyg" id="<?php echo $editorid;?>_mode" value="<?php echo $editormode;?>" />
<?php if($_G['gp_action'] == 'reply') { ?>
<input type="hidden" name="noticeauthor" value="<?php echo $noticeauthor;?>" />
<input type="hidden" name="noticetrimstr" value="<?php echo $noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $noticeauthormsg;?>" />
<?php if($_G['gp_reppost']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_G['gp_reppost'];?>" />
<?php } elseif($_G['gp_repquote']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_G['gp_repquote'];?>" />
<?php } } if($_G['gp_action'] == 'edit') { ?>
<input type="hidden" name="fid" id="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>" />
<input type="hidden" name="pid" value="<?php echo $pid;?>" />
<input type="hidden" name="page" value="<?php echo $_G['gp_page'];?>" />
<?php } if($special) { ?>
<input type="hidden" name="special" value="<?php echo $special;?>" />
<?php } if($specialextra) { ?>
<input type="hidden" name="specialextra" value="<?php echo $specialextra;?>" />
<?php } ?>
<div class="bm bw0 cl"<?php if(!$showthreadsorts && !$adveditor) { ?> id="editorbox"<?php } ?>>
<h1 id="sti" class="mt">
<em class="wx <?php echo $icon;?>" id="returnmessage">
<?php echo $actiontitle;?>
<?php if($showthreadsorts) { ?> <?php echo $_G['forum']['threadsorts']['types'][$sortid];?><?php } if($_G['gp_action'] == 'newthread' && $modnewthreads) { ?><span class="xg1">(需审核)</span><?php } if($_G['gp_action'] == 'reply' && $modnewreplies) { ?><span class="xg1">(需审核)</span><?php } if($_G['gp_action'] == 'edit' && $isfirstpost && $thread['displayorder'] == -4) { ?><span class="xg1">(草稿)</span><?php } ?>
</em>
<?php if(!empty($_G['setting']['pluginhooks']['post_tpfl_return'])) echo $_G['setting']['pluginhooks']['post_tpfl_return']; ?>
<img src="http://static.8264.com/static/image/common/tpflreturn_moretip.gif" style="position: absolute; top: 205px; right: 460px; z-index: 500; cursor: pointer;" id="stip">
</h1>
<div id="postbox">
<?php if(!empty($_G['setting']['pluginhooks']['post_top'])) echo $_G['setting']['pluginhooks']['post_top']; ?>
<div class="pbt cl">
<?php if(!$special && ($threadsorts = $_G['forum']['threadsorts']) && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost && !$thread['sortid'])) { ?>
<div class="ftid">
<select name="sortid" id="sortid" width="80" change="switchsort()">
<?php if(!$_G['forum']['threadsorts']['required']) { ?><option value="0">选择分类信息</option><?php } if(is_array($threadsorts['types'])) foreach($threadsorts['types'] as $tsortid => $name) { ?><option value="<?php echo $tsortid;?>"<?php if($sortid == $tsortid) { ?> selected="selected"<?php } ?>><?php echo strip_tags($name);; ?></option>
<?php } ?>
</select>
</div>
<?php } if($_G['gp_action'] == 'edit' && $isfirstpost && $sortid) { ?>
<input type="hidden" name="sortid" value="<?php echo $sortid;?>" />
<?php } if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
<div class="ftid">
<select name="typeid" id="typeid" width="80">
<option value="0">选择主题分类</option><?php if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { ?><option value="<?php echo $typeid;?>"<?php if($thread['typeid'] == $typeid || $_G['gp_typeid'] == $typeid) { ?> selected="selected"<?php } ?>><?php echo strip_tags($name);; ?></option>
<?php } ?>
</select>
</div>
<?php } ?>
<div class="z">
<?php if($_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade']) || $_G['gp_action'] == 'edit' && $thread['special'] == 2 && !$postinfo['first']) { ?>
<input name="subject" type="hidden" value="" />
<?php } else { if($_G['gp_action'] != 'reply') { ?>
<span><input type="text" name="subject" id="subject" class="px" value="<?php echo $postinfo['subject'];?>" onkeyup="strLenCalc(this, 'checklen', 80);" tabindex="1" style="width: 25em" /></span>
<?php } else { ?>
<span id="subjecthide" class="z">RE: <?php echo $thread['subject'];?> [<a href="javascript:;" onclick="display('subjecthide');display('subjectbox');$('subject').value='RE: <?php echo htmlspecialchars(str_replace('\'', '\\\'', $thread['subject'])); ?>';display('subjectchk');strLenCalc($('subject'), 'checklen', 80);">修改</a>]</span>
<span id="subjectbox" style="display:none"><input type="text" name="subject" id="subject" class="px" value="" onkeyup="strLenCalc(this, 'checklen', 80);" tabindex="1" style="width: 25em" /></span>
<?php } ?>
<span id="subjectchk"<?php if($_G['gp_action'] == 'reply') { ?> style="display:none"<?php } ?>>还可输入 <strong id="checklen">80</strong> 个字符</span>
<?php } ?>
<span style="padding-left: 10px;color: red;">标题严禁使用【】等特殊符号</span>
</div>

<?php if($_G['gp_action'] == 'edit' && $isorigauthor && ($isfirstpost && $thread['replies'] < 1 || !$isfirstpost) && !$rushreply && $_G['setting']['editperdel']) { ?>
<div class="y"><input type="checkbox" name="delete" id="delete" class="pc" value="1" title="删除本帖<?php if($thread['special'] == 3) { ?>，返还悬赏费用，不退还手续费。<?php } ?>"><label for="delete">删?</label></div>
<?php } ?>
</div>
<?php if(!$isfirstpost && $thread['special'] == 5 && empty($firststand) && $_G['gp_action'] != 'edit') { ?>
<div class="pbt cl">
<div class="ftid">
<select name="stand" id="stand">
<option value="">选择观点</option>
<option value="0">中立</option>
<option value="1"<?php if($stand == 1) { ?> selected="selected"<?php } ?>>正方</option>
<option value="2"<?php if($stand == 2) { ?> selected="selected"<?php } ?>>反方</option>
</select>
</div>
</div>
<?php } if($showthreadsorts) { ?>
<div class="exfm cl" id="threadsorts">
<span id="threadsortswait"></span>
</div>
<?php } elseif($adveditor) { if($special == 1) { include template('forum/post_poll'); } elseif($special == 2 && ($_G['gp_action'] != 'edit' || ($_G['gp_action'] == 'edit' && ($thread['authorid'] == $_G['uid'] && $_G['group']['allowposttrade'] || $_G['group']['allowedittrade'])))) { ?><p class="xg1">添加商品信息，完成后可在本帖中继续添加多个商品</p><?php include template('forum/post_trade'); } elseif($special == 3) { include template('forum/post_reward'); } elseif($special == 4) { include template('forum/post_activity'); } elseif($special == 5) { include template('forum/post_debate'); } elseif($specialextra) { ?><div class="specialpost s_clear"><?php echo $threadplughtml;?></div>
<?php } } if($_G['gp_action'] == 'reply' && $quotemessage) { ?>
<div class="pbt cl"><?php echo $quotemessage;?></div>
<?php } ?>
<div id="rstnotice" style="display:none"></div>
<div class="edt" id="<?php echo $editorid;?>_body">
<div id="<?php echo $editorid;?>_controls" class="bar">
<div class="y">
<div class="b2r nbl nbr" id="<?php echo $editorid;?>_adv_5">
<p>
<a id="<?php echo $editorid;?>_undo" title="撤销">Undo</a>
</p>
<p>
<a id="<?php echo $editorid;?>_redo" title="重做">Redo</a>
</p>
</div>
<div class="z">
<span class="mbn"><a id="<?php echo $editorid;?>_fullswitcher"></a><a id="<?php echo $editorid;?>_simple"></a></span>
<label id="<?php echo $editorid;?>_switcher" class="bar_swch ptn"><input id="<?php echo $editorid;?>_switchercheck" type="checkbox" class="pc" name="checkbox" value="0" <?php if(!$editor['editormode']) { ?>checked="checked"<?php } ?> onclick="switchEditor(this.checked?0:1)" />纯文本</label>
</div>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_right'])) { ?>
<div class="y"><?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_right'])) echo $_G['setting']['pluginhooks']['post_editorctrl_right']; ?></div>
<?php } ?>
<div id="<?php echo $editorid;?>_button" class="btn cl">
<div class="b1r" id="<?php echo $editorid;?>_adv_s0">
<a id="<?php echo $editorid;?>_paste" title="粘贴">粘贴</a>
</div>
<div class="b2r nbr" id="<?php echo $editorid;?>_adv_s2">
<a id="<?php echo $editorid;?>_fontname" class="dp" title="设置字体"><span id="<?php echo $editorid;?>_font">字体</span></a>
<a id="<?php echo $editorid;?>_fontsize" class="dp" title="设置文字大小"><span id="<?php echo $editorid;?>_size">大小</span></a>
<br id="<?php echo $editorid;?>_adv_1" />
<a id="<?php echo $editorid;?>_bold" title="文字加粗">B</a>
<a id="<?php echo $editorid;?>_italic" title="文字斜体">I</a>
<a id="<?php echo $editorid;?>_underline" title="文字加下划线">U</a>
<a id="<?php echo $editorid;?>_forecolor" title="设置文字颜色">Color</a>
<a id="<?php echo $editorid;?>_url" title="添加链接">Url</a>
<span id="<?php echo $editorid;?>_adv_8">
<a id="<?php echo $editorid;?>_unlink" title="移除链接">Unlink</a>
<a id="<?php echo $editorid;?>_inserthorizontalrule" title="分隔线">Hr</a>
</span>
</div>
<div class="b2r nbl" id="<?php echo $editorid;?>_adv_2">
<p id="<?php echo $editorid;?>_adv_3">
<a id="<?php echo $editorid;?>_tbl" title="添加表格">Table</a>
</p>
<p>
<a id="<?php echo $editorid;?>_removeformat" title="清除文本格式">Removeformat</a>
</p>
</div>
<div class="b2r">
<p>
<a id="<?php echo $editorid;?>_justifyleft" title="居左">Left</a>
<a id="<?php echo $editorid;?>_justifycenter" title="居中">Center</a>
<a id="<?php echo $editorid;?>_justifyright" title="居右">Right</a>
</p>
<p id="<?php echo $editorid;?>_adv_4">
<a id="<?php echo $editorid;?>_autotypeset" title="自动排版">Autotypeset</a>
<a id="<?php echo $editorid;?>_insertorderedlist" title="排序的列表">Orderedlist</a>
<a id="<?php echo $editorid;?>_insertunorderedlist" title="未排序列表">Unorderedlist</a>
</p>
</div>
<div class="b1r" id="<?php echo $editorid;?>_adv_s1">
<a id="<?php echo $editorid;?>_sml" title="添加表情">表情</a>
<div id="<?php echo $editorid;?>_imagen" style="display:none">!</div>
<a id="<?php echo $editorid;?>_image" title="添加图片">图片</a>
<?php if($_G['group']['allowpostattach']) { ?>
<div id="<?php echo $editorid;?>_attachn" style="display:none">!</div>
<a id="<?php echo $editorid;?>_attach" title="添加附件">附件</a>
<?php } if($_G['forum']['allowmediacode']) { ?>
<a id="<?php echo $editorid;?>_aud" title="添加音乐">音乐</a>
<a id="<?php echo $editorid;?>_vid" title="添加视频">视频</a>

<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_left'])) echo $_G['setting']['pluginhooks']['post_editorctrl_left']; ?>
</div>
<div class="b2r<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { ?> nbr<?php } ?>" id="<?php echo $editorid;?>_adv_6">
<p>
<a id="<?php echo $editorid;?>_code" title="添加代码文字">代码</a>
<?php if($isfirstpost && $_G['group']['allowhidecode']) { ?><a id="<?php echo $editorid;?>_hide" title="添加隐藏内容">Hide</a><?php } ?>
</p>
<p>
<a id="<?php echo $editorid;?>_quote" title="添加引用文字">引用</a>
<?php if($isfirstpost) { ?><a id="<?php echo $editorid;?>_free" title="添加免费信息">Free</a><?php } ?>
</p>
</div>
<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { ?>
<div class="b2r nbl"><?php if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { if($bbcode['i'] % 2 != 0) { ?><a id="<?php echo $editorid;?>_cst<?php echo $bbcode['params'];?>_<?php echo $tag;?>" class="cst" title="<?php echo $bbcode['explanation'];?>"><img src="http://static.8264.com/static/image/common/<?php echo $bbcode['icon'];?>" title="<?php echo $bbcode['explanation'];?>" alt="<?php echo $tag;?>" /></a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_top'])) echo $_G['setting']['pluginhooks']['post_editorctrl_top']; ?>
<br id="<?php echo $editorid;?>_adv_7" /><?php if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { if($bbcode['i'] % 2 == 0) { ?><a id="<?php echo $editorid;?>_cst<?php echo $bbcode['params'];?>_<?php echo $tag;?>" class="cst" title="<?php echo $bbcode['explanation'];?>"><img src="http://static.8264.com/static/image/common/<?php echo $bbcode['icon'];?>" title="<?php echo $bbcode['explanation'];?>" alt="<?php echo $tag;?>" /></a><?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['post_editorctrl_bottom'])) echo $_G['setting']['pluginhooks']['post_editorctrl_bottom']; ?>
</div>
<?php } if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<div class="b2r">
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=<?php echo $editorid;?>_textarea&amp;from=forumeditor" class="cst" onclick="showWindow(this.id, this.href, 'get', 0)"><img src="http://static.8264.com/static/image/magic/doodle.small.gif" alt="doodle" title="<?php echo $_G['setting']['magics']['doodle'];?>" style="margin-top:2px" /></a>
</div>
<?php } ?>
</div>
</div>
                <style>
                #upload_newimage_tools h4 span{padding: 0 5px;display: block;float: left;cursor:pointer;font-size:13px;font-weight: bold;border:1px solid #F6F6F6;border-bottom-width:1px;border-bottom-color: #CCC;margin-right:5px;position: relative;top: 1px;font-family: Arial,PMingLiU,sans-serif;}
                #upload_newimage_tools h4{height:30px;line-height: 28px;padding-top:2px;padding-left:5px;border-bottom: 1px solid #CCC;background:#FFF}
                #tips_limit{position: absolute;background:#FFF;border:5px solid #CCC;display: none;}
#uploadtips{color:blue;text-align:center;}
                </style>
                <div id="tips_limit">
                    <div class="notice upnf">
                        照片可以多个选取，批量上传
    						<br />照片大小：小于8.7MB,边长小于2500像素，否则无法上传。
                        <?php if($_G['group']['maxattachnum'] || $_G['group']['maxsizeperday']) { ?>
                        <br />上传限制: <?php if($_G['group']['maxattachnum']) { ?><strong><?php echo $allowuploadnum;?></strong> 个文件&nbsp;<?php } if($_G['group']['maxsizeperday']) { ?><strong><?php echo $allowuploadsize;?></strong>&nbsp;<?php } ?>
    					<?php } ?>
    					<?php if($imgexts) { ?>
    						<br />可用扩展名: <strong><?php echo $imgexts;?></strong>&nbsp;
    					<?php } ?>
    					<?php if($creditstring) { ?>
    						<br /><a href="forum.php?mod=faq&amp;action=credits&amp;fid=<?php echo $_G['fid'];?>" target="_blank" title="积分说明">每上传一个附件你的&nbsp;<?php echo $creditstring;?></a>
    					<?php } ?>
    				</div>
                </div>
<div class="area">
<div style="float: left;width:75%;"><textarea name="<?php echo $editor['textarea'];?>" id="<?php echo $editorid;?>_textarea" class="pt" tabindex="2" rows="15"><?php echo $editor['value'];?></textarea></div>
                    <div id="upload_newimage_tools" style="float: right;width: 228px;border-left: 1px solid #EBEBEB;background: #F6F6F6;height:400px;">
                        <h4><span>上传图片</span><span>使用相册</span><!--<span>网络图片</span>--></h4>
                            <div class="p_opt" unselectable="on" id="<?php echo $editorid;?>_multi" style="display: none;">
                				<div class="fswf" id="<?php echo $editorid;?>_multiimg" style="width: 100%;height:100%;overflow: hidden;margin: 0 auto;border:0px">
                                    <div id="<?php echo $editorid;?>_multiimg_swf" style="width: 100%;height: 30px;text-align: left;background: #FFF;">
                                        <div style="background:url('http://static.8264.com/static/image/common/upload_img_new.jpg') no-repeat;;font-size:20px;color:#FFF;text-align: center;font-weight:bold;overflow: hidden;cursor:pointer;width:208px;height:30px;"></div>
                                    </div>
                                    <script src="static/js/swfobject.js" type="text/javascript"></script>
                                    <script type="text/javascript">
var params = {site:"<?php echo $_G['siteroot'];?>misc.php%3fmod=swfupload%26type=image%26fid=<?php echo $_G['fid'];?>%26random=<?php echo random(4); ?>"};
swfobject.embedSWF("<?php echo IMGDIR;?>/newupload.swf", "<?php echo $editorid;?>_multiimg_swf", "208", "52", "11.1.0", "playerProductInstall.swf", params, {wmode:"transparent"});
swfobject.createCSS("#<?php echo $editorid;?>_multiimg_swf", "display:block;text-align:left;");
                                    </script>
<div><p style="margin-top:1px;display:none;" id="uploadtips"></p></div>
                                    <div id="<?php echo $editorid;?>_imgattachlist" style='background:#fff;width: 208px;border:1px soild #ccc;'>
                                        <div class="upfilelist">
                                            <div style="background:url('http://static.8264.com/static/image/common/list_img_new.jpg') no-repeat;font-size:20px;color:#FFF;text-align: center;font-weight:bold;overflow: hidden;cursor:pointer;height:30px;width:208px"></div>
                                            <div id="photolist_upload" style="overflow: scroll;overFlow-x: hidden;width:208px;padding-top:10px;">
                                                <?php if(!empty($imgattachs['used'])) { ?><?php $imagelist = $imgattachs['used']; ?>                        					       <?php include template('forum/ajax_imagelist_newimage'); ?>                        				        <?php } ?>
                                                <div id="imgattachlist" style="width: 200px;">
                                                <?php if(empty($imgattachs['used']) && empty($imgattachs['unused'])) { ?>
                                                	<p class="notice">本帖还没有图片附件<?php if($allowuploadnum) { ?>, 请先上传<?php } ?></p>
                                                <?php } ?>
                                                </div>
                                                <div id="unusedimgattachlist"  style="width: 200px;">
                                                <?php if(!empty($imgattachs['unused'])) { ?>
                                                <?php $imagelist = $imgattachs['unused']; ?>                                                <?php include template('forum/ajax_imagelist_newimage'); ?>                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="height:40px;background: #FFF;padding-top:5px;">
                                        <div style="color:#F26C4F;height:20px;font-weight: bold;">点击图片添加到帖子内容中</div>
                                        <div style="background: #FFF;height:20px"><span id="save_to_album" style="font-weight:bolder;color:#336699;cursor: pointer;">保存到相册</span><span id="insert_all_imagelist" style="font-size: 12px;height:20px;position:relative;font-weight: bold;cursor: pointer;background: #FFF;margin-left:10px;">全部添加</span></div>
                                        <div id="album_contrl" style="position: relative;border: 5px solid #CCC;top:-130px;z-index:999;padding:5px;background:#FFF;display: none;">
                                        <?php if($_G['group']['allowupload']) { ?>
                                        <input type="checkbox" id='all_insert_alb' value='insertall'/>保存选中的图片到相册:<div onclick="this.parentNode.style.display='none'" style="float:right;background:url('http://static.8264.com/static/image/common/op.png') no-repeat scroll 0 -2px transparent;height:20px;width:20px;cursor: pointer;"></div>
                                        <select name="uploadalbum" onclick="if(!this.value) {$('newalbum').style.display = ''} else {$('newalbum').style.display = 'none'}">
                                        <?php if(is_array($albumlist)) foreach($albumlist as $album) { ?>                                        		<option value="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></option>
                                        	<?php } ?>
                                        	<option value="">+创建新相册</option>
                                        </select>
                                        <input type="text" name="newalbum" id="newalbum" class="px mtn" size="20" value="" style="display:none" />
                                        <?php } ?>
                                        </div>
                                        </div>
                                    </div>
                				</div>
                			</div>
                            <div class="p_opt" unselectable="on" id="<?php echo $editorid;?>_albumlist" style="display: none;">
                        		<div class="upfilelist">
                        			从我的相册中选择图片:
                        			<select onchange="if(this.value) {ajaxget('forum.php?mod=post&new_image_template=1&action=albumphoto&aid='+this.value, 'albumphoto');}">
                        				<option value="">选择相册</option>
                        <?php if(is_array($albumlist)) foreach($albumlist as $album) { ?>                        					<option value="<?php echo $album['albumid'];?>"><?php echo $album['albumname'];?></option>
                        				<?php } ?>
                        			</select>
                        			<div id="albumphoto"></div>
                        		</div>
                        		<p class="notice xi1 xw1">点击图片添加到帖子内容中</p>
                        	</div>
                            <div class="p_opt popupfix" unselectable="on" id="<?php echo $editorid;?>_www" style="display: none;">
                                <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                            			<th width="74%">请输入图片地址</th>
                            			<th width="13%">宽(可选)</th>
                            			<th width="13%">高(可选)</th>
                            		</tr>
                            		<tr>
                            			<td><input type="text" id="<?php echo $editorid;?>_image_param_1" onchange="loadimgsize(this.value)" style="width: 95%;" value="" class="px" autocomplete="off" /></td>
                            			<td><input id="<?php echo $editorid;?>_image_param_2" size="1" value="" class="px p_fre" autocomplete="off" /></td>
                            			<td><input id="<?php echo $editorid;?>_image_param_3" size="1" value="" class="px p_fre" autocomplete="off" /></td>
                            		</tr>
                            <tr>
                            			<td colspan="3" class="pns mtn">
                            				<button type="button" class="pn pnc" id="<?php echo $editorid;?>_image_submit"><strong>提交</strong></button>
                            				<button type="button" class="pn" onclick="hideMenu();"><em>取消</em></button>
                            			</td>
                            		</tr>
                                </table>
                            </div>
                    </div>
                    <div style="clear: both;"></div>
</div><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/editor.css?<?php echo VERHASH;?>" />
<script src="http://static.8264.com/static/js/editor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var editorid = '<?php echo $editorid;?>';
var textobj = $(editorid + '_textarea');
var wysiwyg = (BROWSER.ie || BROWSER.firefox || (BROWSER.opera >= 9)) && parseInt('<?php echo $editor['editormode'];?>') == 1 ? 1 : 0;
var allowswitcheditor = parseInt('<?php echo $editor['allowswitcheditor'];?>');
var allowhtml = parseInt('<?php echo $editor['allowhtml'];?>');
var allowsmilies = parseInt('<?php echo $editor['allowsmilies'];?>');
var allowbbcode = parseInt('<?php echo $editor['allowbbcode'];?>');
var allowimgcode = parseInt('<?php echo $editor['allowimgcode'];?>');
var simplodemode = parseInt('<?php if($editor['simplemode'] > 0) { ?>1<?php } else { ?>0<?php } ?>');
var fontoptions = new Array("仿宋_GB2312", "黑体", "楷体_GB2312", "宋体", "新宋体", "微软雅黑", "Trebuchet MS", "Tahoma", "Arial", "Impact", "Verdana", "Times New Roman");
var custombbcodes = new Array();
<?php if($_G['cache']['bbcodes_display'][$_G['groupid']]) { if(is_array($_G['cache']['bbcodes_display'][$_G['groupid']])) foreach($_G['cache']['bbcodes_display'][$_G['groupid']] as $tag => $bbcode) { ?>custombbcodes["<?php echo $tag;?>"] = {'prompt' : '<?php echo $bbcode['prompt'];?>'};
<?php } } if($editor['simplemode'] > 0) { ?>
editorsimple();
<?php } ?>
</script>
<div class="aretzt clboth">
<span id="<?php echo $editorid;?>_tip" class="le"></span>
<span class="ri">
&nbsp;
<a href="javascript:;" onclick="discuzcode('svd');return false;" id="<?php echo $editorid;?>_svd">保存数据</a> |&nbsp;
<a href="javascript:;" onclick="discuzcode('rst');return false;" id="<?php echo $editorid;?>_rst">恢复数据</a>
</span>
</div></div>

<?php if(!empty($_G['setting']['pluginhooks']['post_middle'])) echo $_G['setting']['pluginhooks']['post_middle']; if($_G['group']['maxprice'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost)) { ?>
<div class="mtm">
<?php if($_G['setting']['maxincperthread']) { ?><img src="http://static.8264.com/static/image/common/arrow_right.gif" />主题出售最高收入上限为 <?php echo $_G['setting']['maxincperthread'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } if($_G['setting']['maxchargespan']) { ?><img src="http://static.8264.com/static/image/common/arrow_right.gif" />主题最多能销售 <?php echo $_G['setting']['maxchargespan'];?> 个小时<?php if($_G['gp_action'] == 'edit' && $freechargehours) { ?>，本主题还能销售 <?php echo $freechargehours;?> 个小时<?php } } ?>
</div>
<?php } if($_G['gp_action'] != 'edit' && checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id);"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm"><?php include template('common/seccheck'); ?></div>
<?php } ?>

<div class="mtm mbm">
<?php if($_G['gp_action'] == 'newthread' && $_G['setting']['sitemessage']['newthread'] || $_G['gp_action'] == 'reply' && $_G['setting']['sitemessage']['reply']) { ?>
<span id="custominfo" class="y" style="cursor:pointer">&nbsp;<img src="http://static.8264.com/static/image/common/info_small.gif" alt="帮助" /></span>
<?php } ?>
<a href="home.php?mod=spacecp&amp;ac=credit&amp;op=rule&amp;fid=<?php echo $_G['fid'];?>" class="y" target="_blank">本版积分规则</a>
<button type="submit" id="postsubmit" class="pn pnc" value="true" name="<?php if($_G['gp_action'] == 'newthread') { ?>topicsubmit<?php } elseif($_G['gp_action'] == 'reply') { ?>replysubmit<?php } elseif($_G['gp_action'] == 'edit') { ?>editsubmit<?php } ?>">
<?php if($_G['gp_action'] == 'newthread') { if($special == 0) { ?><span>发表帖子</span>
<?php } elseif($special == 1) { ?><span>发起投票</span>
<?php } elseif($special == 2) { ?><span>出售商品</span>
<?php } elseif($special == 3) { ?><span>发布悬赏</span>
<?php } elseif($special == 4) { ?><span>发起活动</span>
<?php } elseif($special == 5) { ?><span>发起辩论</span>
<?php } elseif($special == 127) { ?>
<span><?php if($buttontext) { ?><?php echo $buttontext;?><?php } else { ?>发表帖子<?php } ?></span>
<?php } } elseif($_G['gp_action'] == 'reply' && !empty($_G['gp_addtrade'])) { ?><span>添加商品</span>
<?php } elseif($_G['gp_action'] == 'reply') { ?><span>参与/回复主题</span>
<?php } elseif($_G['gp_action'] == 'edit' && $isfirstpost && $thread['displayorder'] == -4) { ?>
<span>发表帖子</span>
<?php } elseif($_G['gp_action'] == 'edit') { ?><span>保存</span>
<?php } ?>
</button>
<?php if($_G['uid']) { ?>
<input type="hidden" id="postsave" name="save" value="" />
<?php if($_G['gp_action'] == 'newthread' && !$modnewthreads || $_G['gp_action'] == 'edit' && $isfirstpost && !$modnewreplies && $thread['displayorder'] == -4) { ?>
<button  style="display:none;" type="button" id="postsubmit" class="pn" value="true" onclick="$('postsave').value = 1;$('postsubmit').click();" tabindex="4"><em>保存草稿</em></button>
<?php } } ?>
<span style="color:#999; padding:0 5px;vertical-align:middle;">每个贴子最多只能上传三张图片</span>
<?php if($special == 2) { ?><label><input type="checkbox" name="continueadd" value="yes" class="pc" /> 保存后继续添加下一个商品</label><?php } ?>
</div>

<?php if($_G['gp_action'] == 'newthread' && $savethreads) { ?>
<div class="bm bmn mtm">
<div class="mbn pbn bbda">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=save" class="y xi2">查看所有草稿 &rsaquo;</a>
<h2>你在本版有<span class="xi1"> <?php echo $savethreadcount;?> </span>篇草稿 <span class="xw0">点击标题前的<em class="qsv">&nbsp;</em>可以直接引用该草稿内容</span></h2>
</div>
<ul><?php if(is_array($savethreads)) foreach($savethreads as $savethread) { ?><li class="mtn"><em class="qsv" title="引用" onclick="insertsave(<?php echo $savethread['pid'];?>)">&nbsp;</em> <a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $savethread['fid'];?>&amp;tid=<?php echo $savethread['tid'];?>&amp;pid=<?php echo $savethread['pid'];?>" class="xi2" target="_blank"><?php echo $savethread['subject'];?></a> <span class="xg1"><?php echo $savethread['dateline'];?></span></li>
<?php } ?>
</ul>
</div>
<?php } if($_G['gp_action'] == 'newthread' && $savethreadothers) { ?>
<div class="bm bmn mtm">
<div class="mbn pbn bbda">
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me&amp;type=thread&amp;from=&amp;filter=save" class="y xi2">查看所有草稿 &rsaquo;</a>
<h2>你在本版有<span class="xi1"> <?php echo $savethreadothercount;?> </span>篇草稿 <span class="xw0">点击标题前的<em class="qsv">&nbsp;</em>可以直接引用该草稿内容</span></h2>
</div>
<ul><?php if(is_array($savethreadothers)) foreach($savethreadothers as $savethread) { ?><li class="mtn"><em class="qsv" title="引用" onclick="insertsave(<?php echo $savethread['pid'];?>)">&nbsp;</em> <a href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $savethread['fid'];?>&amp;tid=<?php echo $savethread['tid'];?>&amp;pid=<?php echo $savethread['pid'];?>" class="xi2" target="_blank"><?php echo $savethread['subject'];?></a> <span class="xg1"><?php echo $savethread['dateline'];?></span></li>
<?php } ?>
</ul>
</div>
<?php } if(!empty($_G['setting']['pluginhooks']['post_sync_method'])) { ?>
<span>
将此主题同步到:
<?php if(!empty($_G['setting']['pluginhooks']['post_sync_method'])) echo $_G['setting']['pluginhooks']['post_sync_method']; ?>
</span>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['post_bottom'])) echo $_G['setting']['pluginhooks']['post_bottom']; ?>
</div>
</div>

</div>

<div id="psd" class="appl" style="border: 1px solid #BBB;position: absolute;right:165px;">
<h3 class="mbm pbm bbs" id="fujia_tools" style="cursor: pointer;" title="点击显示">附加选项<span>-</span></h3>
<div class="bn">
<?php if(!empty($_G['setting']['pluginhooks']['post_side_top'])) echo $_G['setting']['pluginhooks']['post_side_top']; if($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost) { if($_G['group']['allowsetreadperm']) { ?>
<p class="mbn">阅读权限:</p>
<p class="mbn">
<em class="ftid">
<select name="readperm" id="readperm" class="ps" style="width:90px">
<option value="">不限</option><?php if(is_array($_G['cache']['groupreadaccess'])) foreach($_G['cache']['groupreadaccess'] as $val) { ?><option value="<?php echo $val['readaccess'];?>" title="阅读权限: <?php echo $val['readaccess'];?>"<?php if($thread['readperm'] == $val['readaccess']) { ?> selected="selected"<?php } ?>><?php echo $val['grouptitle'];?></option>
<?php } ?>
<option value="255">最高权限</option>
</select>
</em>
<img src="http://static.8264.com/static/image/common/faq.gif" alt="Tip" class="mtn vm" style="margin: 0;" onmouseover="showTip(this)" tip="阅读权限按由高到低排列，高于或等于选中组的用户才可以阅读。" /></a>
</p>
<?php } if($_G['group']['maxprice'] && !$special) { ?>
<p class="mbn">售价(<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>):</p>
<p><input type="text" name="price" class="px pxs" value="<?php echo $thread['pricedisplay'];?>" /> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></p>
<p class="mbn xg1">(最高 <?php echo $_G['group']['maxprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>)</p>
<?php } } if(($_G['forum']['allowhtml'] || ($_G['gp_action'] == 'edit' && ($orig['htmlon'] & 1))) && $_G['group']['allowhtml']) { ?>
<p class="mbn"><input type="checkbox" name="htmlon" id="htmlon" class="pc" value="1" <?php echo $htmloncheck;?> /><label for="htmlon">HTML 代码</label></p>
<?php } else { ?>
<p class="mbn"><input type="checkbox" name="htmlon" id="htmlon" class="pc" value="0" <?php echo $htmloncheck;?> disabled="disabled" /><label for="htmlon">HTML 代码</label></p>
<?php } ?>
<p class="mbn"><input type="checkbox" id="allowimgcode" class="pc" disabled="disabled"<?php if($_G['forum']['allowimgcode']) { ?> checked="checked"<?php } ?> /><label for="allowimgcode">[img] 代码</label></p>
<p class="mbn"><input type="checkbox" name="parseurloff" id="parseurloff" class="pc" value="1" <?php echo $urloffcheck;?> /><label for="parseurloff">禁用 链接识别</label></p>
<p class="mbn"><input type="checkbox" name="smileyoff" id="smileyoff" class="pc" value="1" <?php echo $smileyoffcheck;?> /><label for="smileyoff">禁用 表情</label></p>
<p class="mbn"><input type="checkbox" name="bbcodeoff" id="bbcodeoff" class="pc" value="1" <?php echo $codeoffcheck;?> /><label for="bbcodeoff">禁用 编辑器代码</label></p>

<hr class="bk" />

<p class="mbn"><input type="checkbox" name="usesig" id="usesig" class="pc" value="1" <?php if(!$_G['group']['maxsigsize']) { ?>disabled <?php } else { ?><?php echo $usesigcheck;?> <?php } ?>/><label for="usesig">使用个人签名</label></p>
<?php if($_G['gp_action'] != 'edit') { if($_G['group']['allowanonymous']) { ?><p class="mbn"><input type="checkbox" name="isanonymous" id="isanonymous" class="pc" value="1" /><label for="isanonymous">使用匿名发帖</label></p><?php } } else { if($_G['group']['allowanonymous'] || (!$_G['group']['allowanonymous'] && $orig['anonymous'])) { ?><p class="mbn"><input type="checkbox" name="isanonymous" id="isanonymous" class="pc" value="1" <?php if($orig['anonymous']) { ?>checked="checked"<?php } ?> /><label for="isanonymous">使用匿名发帖</label></p><?php } } if($_G['gp_action'] == 'newthread' && $_G['group']['allowpostrushreply'] && $special != 2) { ?>
<p class="mbn"><input type="checkbox" name="rushreply" id="rushreply" class="pc" value="1"><label for="rushreply">抢楼帖</label></p>
<?php } if($_G['gp_action'] == 'edit' && getstatus($thread['status'], 3)) { ?>
<p class="mbn"><input type="checkbox" disabled="disabled" class="pc" checked="checked"><label for="rushreply">抢楼帖</label></p>
<?php } if($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost) { ?>
<p class="mbn"><input type="checkbox" name="hiddenreplies" id="hiddenreplies" class="pc"<?php if($thread['hiddenreplies']) { ?> checked="checked"<?php } ?> value="1"><label for="hiddenreplies">回帖仅作者可见</label></p>
<?php } if($_G['uid'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost) && $special != 3) { ?>
<p class="mbn"><input type="checkbox" name="ordertype" id="ordertype" class="pc" value="1" <?php echo $ordertypecheck;?> /><label for="ordertype">回帖倒序排列</label></p>
<?php } if(($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost)) { ?>
<p class="mbn"><input type="checkbox" name="allownoticeauthor" id="allownoticeauthor" class="pc" value="1"<?php if($allownoticeauthor) { ?> checked="checked"<?php } ?> /><label for="allownoticeauthor">接收回复通知</label></p>
<?php } if($_G['gp_action'] != 'edit' && $_G['forum']['allowfeed']) { ?>
<p class="mbn"><input type="checkbox" name="addfeed" id="addfeed" class="pc" value="1" <?php echo $addfeedcheck;?>><label for="addfeed">发送动态</label></p>
<?php } if($_G['gp_action'] == 'newthread' && $_G['forum']['ismoderator'] && ($_G['group']['allowdirectpost'] || !$_G['forum']['modnewposts'])) { ?>
<hr class="bk" />

<?php if($_G['gp_action'] == 'newthread' && $_G['forum']['ismoderator'] && ($_G['group']['allowdirectpost'] || !$_G['forum']['modnewposts'])) { ?>
<p class="mbn"><input type="checkbox" name="sticktopic" id="sticktopic" class="pc" value="1" <?php echo $stickcheck;?> /><label for="sticktopic">主题置顶</label></p>
<p class="mbn"><input type="checkbox" name="addtodigest" id="addtodigest" class="pc" value="1" <?php echo $digestcheck;?> /><label for="addtodigest">精华帖子</label></p>
<?php } } elseif($_G['gp_action'] == 'edit' && $_G['forum_auditstatuson']) { ?>
<hr class="bk" />

<p class="mbn"><input type="checkbox" name="audit" id="audit" class="pc" value="1"><label for="audit">通过审核</label></p>
<?php } ?>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_side_bottom'])) echo $_G['setting']['pluginhooks']['post_side_bottom']; ?>
</div>
</div>
</form>
</div>

<div id="<?php echo $editorid;?>_menus" class="editorrow" style="overflow: hidden; margin-top: -5px; height: 0; border: none; background: transparent;"><div id="<?php echo $editorid;?>_editortoolbar" class="editortoolbar"><?php $fontoptions = array("仿宋_GB2312", "黑体", "楷体_GB2312", "宋体", "新宋体", "微软雅黑", "Trebuchet MS", "Tahoma", "Arial", "Impact", "Verdana", "Times New Roman") ?><div class="p_pop fnm" id="<?php echo $editorid;?>_fontname_menu" style="display: none">
<ul unselectable="on"><?php if(is_array($fontoptions)) foreach($fontoptions as $fontname) { ?><li onclick="discuzcode('fontname', '<?php echo $fontname;?>')" style="font-family: <?php echo $fontname;?>" unselectable="on"><a href="javascript:;" title="<?php echo $fontname;?>"><?php echo $fontname;?></a></li>
<?php } ?>
</ul>
</div><?php $sizeoptions = array(1, 2, 3, 4, 5, 6, 7) ?><div class="p_pop fszm" id="<?php echo $editorid;?>_fontsize_menu" style="display: none">
<ul unselectable="on"><?php if(is_array($sizeoptions)) foreach($sizeoptions as $size) { ?><li onclick="discuzcode('fontsize', <?php echo $size;?>)" unselectable="on"><a href="javascript:;" title="<?php echo $size;?>"><font size="<?php echo $size;?>" unselectable="on"><?php echo $size;?></font></a></li>
<?php } ?>
</ul>
</div>

</div>

<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">smilies_show('smiliesdiv', <?php echo $_G['setting']['smcols'];?>, editorid + '_');</script>
<?php if($_G['group']['allowpostattach']) { if(!empty($attachs['used'])) { ?><?php $attachlist = $attachs['used'];$attachused = true; include template('forum/ajax_attachlist'); } if(!empty($attachs['unused'])) { ?><?php $attachlist = $attachs['unused'];$attachused = false; include template('forum/ajax_attachlist'); } } ?>

<script type="text/javascript">
if(wysiwyg) {
newEditor(1, bbcode2html(textobj.value));
} else {
newEditor(0, textobj.value);
}
var ATTACHNUM = {'imageused':0,'imageunused':0,'attachused':0,'attachunused':0};
function switchImagebutton(btn) {
var btns = ['www'<?php if($allowpostimg) { ?>, 'imgattachlist'<?php } ?>, 'albumlist'];
<?php if($allowpostimg) { if($_G['setting']['swfupload'] != 1) { ?>btns.push('local');<?php } if($_G['setting']['swfupload'] != 0) { ?>btns.push('multi');<?php } } ?>
//switchButton(btn, btns);
//$(editorid + '_image_menu').style.height = '';
}
<?php if($allowpostimg) { ?>
ATTACHNUM['imageused'] = <?php echo @count($imgattachs['used']); ?>;
ATTACHNUM['imageunused'] = <?php echo @count($imgattachs['unused']); ?>;
<?php if(!empty($imgattachs['used']) || !empty($imgattachs['unused'])) { ?>
switchImagebutton('imgattachlist');
//$(editorid + '_image').evt = false;
//updateattachnum('image');
<?php } else { ?>
switchImagebutton('<?php if($_G['setting']['swfupload'] != 0) { ?>multi<?php } else { ?>local<?php } ?>');
<?php } } if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) { ?>
function switchAttachbutton(btn) {
var btns = ['attachlist'];
<?php if($_G['setting']['swfupload'] != 1) { ?>btns.push('upload');<?php } if($_G['setting']['swfupload'] != 0) { ?>btns.push('swfupload');<?php } ?>
switchButton(btn, btns);
}
ATTACHNUM['attachused'] = <?php echo @count($attachs['used']); ?>;
ATTACHNUM['attachunused'] = <?php echo @count($attachs['unused']); ?>;
<?php if(!empty($attachs['used']) || !empty($attachs['unused'])) { ?>
//$(editorid + '_attach').evt = false;
//updateattachnum('attach');
<?php } else { ?>
//switchAttachbutton('<?php if($_G['setting']['swfupload'] != 0) { ?>swfupload<?php } else { ?>upload<?php } ?>');
<?php } } if(!empty($attachs['unused']) || !empty($imgattachs['unused'])) { ?>
var msg = '<form id="unusedform"><div class="c ufl" style="<?php if(count($attachs['unused']) + count($imgattachs['unused']) > 10) { ?>height:180px;<?php } ?>overflow-y:auto;overflow-x:hidden"><p class="xg2">以下是你上次上传但没有使用的附件:</p>'<?php if(is_array($attachs['unused'])) foreach($attachs['unused'] as $attach) { ?>+ '<p>' + (BROWSER.ie && BROWSER.ie <= 6 ? '' : '<a href="javascript:;" class="d" title="忽略">忽略</a><a href="javascript:;" class="d deletepic" title="删除" attachid="<?php echo $attach['aid'];?>">删除</a>') + '<label><input id="unused<?php echo $attach['aid'];?>" name="unused[]" value="<?php echo $attach['aid'];?>" checked type="checkbox" class="pc" /> <span title="<?php echo $attach['filenametitle'];?> <?php echo $attach['dateline'];?>"><?php echo $attach['filename'];?></span></label></p>'
<?php } if(is_array($imgattachs['unused'])) foreach($imgattachs['unused'] as $attach) { ?>+ '<p>' + (BROWSER.ie && BROWSER.ie <= 6 ? '' : '<a href="javascript:;" class="d" title="忽略">忽略</a><a href="javascript:;" class="d deletepic" title="删除"  attachid="<?php echo $attach['aid'];?>">删除</a>') + '<label><input id="unused<?php echo $attach['aid'];?>" name="unused[]" value="<?php echo $attach['aid'];?>" checked type="checkbox" class="pc" /> <span title="<?php echo $attach['filenametitle'];?> <?php echo $attach['dateline'];?>"><?php echo $attach['filename'];?></span></label></p>'
<?php } ?>
+ '</div><div class="o pns cl"><label class="z"><input type="checkbox" name="chkall" class="pc" checked="checked" onclick="checkall(this.form, \'unused\', \'chkall\')" /> 全选</label><button type="button" value="true" class="pn"><span>忽略</span></button> <button type="button" value="true" class="pn deletepic"><span>删除</span></button> <button type="button" value="true" class="pn pnc"><span>使用</span></button> </div></form>';
showDialog(msg, 'info', '', '', 1);
<?php } ?>
setCaretAtEnd();
if(BROWSER.ie >= 5 || BROWSER.firefox >= '2') {
_attachEvent(window, 'beforeunload', saveData);
}
<?php if(!empty($_G['gp_cedit']) && $_G['gp_cedit'] == 'yes') { ?>
loadData(1);		
$(editorid + '_switchercheck').checked = !wysiwyg;
<?php } ?>
</script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
$('#unusedform>.c.ufl>p>a.d').click(function(){
var a_aid = $(this).parent().find('input[type=checkbox]').val();
$('#newattach_id_' + a_aid).remove();
$('#image_td_' + a_aid).remove();
$(this).parent().remove();
});
})(jQuery);
</script>
<style>
.c a.deletepic{background-position: 0 -42px;}
.c a.deletepic:hover{background-position: 0 -62px;}
</style>
<div id="hiddenobj" style="visibility: hidden; display:none; width:0px;height:0px;"></div></div>
<?php if($special) { ?>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript">
var editorsubmit = $('postsubmit');
var editorform = $('postform');
var allowpostattach = parseInt('<?php echo $_G['group']['allowpostattach'];?>');
var allowpostimg = parseInt('<?php echo $allowpostimg;?>');
var pid = parseInt('<?php echo $pid;?>');
var extensions = '<?php echo str_replace(array('jpeg,','gif,','jpg,','png,') ,'' ,$_G['group']['attachextensions']) ?>';
var imgexts = '<?php echo $imgexts;?>';
var postminchars = parseInt('<?php echo $_G['setting']['minpostsize'];?>');
var postmaxchars = parseInt('<?php echo $_G['setting']['maxpostsize'];?>');
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
var seccodecheck = parseInt('<?php if(checkperm('seccode') && $seccodecheck) { ?>1<?php } else { ?>0<?php } ?>');
var secqaacheck = parseInt('<?php if(checkperm('seccode') && $secqaacheck) { ?>1<?php } else { ?>0<?php } ?>');
var typerequired = parseInt('<?php echo $_G['forum']['threadtypes']['required'];?>');
var sortrequired = parseInt('<?php echo $_G['forum']['threadsorts']['required'];?>');
var special = parseInt('<?php echo $special;?>');
var isfirstpost = <?php if($isfirstpost) { ?>1<?php } else { ?>0<?php } ?>;
var allowposttrade = parseInt('<?php echo $_G['group']['allowposttrade'];?>');
var allowpostreward = parseInt('<?php echo $_G['group']['allowpostreward'];?>');
var allowpostactivity = parseInt('<?php echo $_G['group']['allowpostactivity'];?>');
var sortid = parseInt('<?php echo $sortid;?>');
var special = parseInt('<?php echo $special;?>');
var fid = <?php echo $_G['fid'];?>;

<?php if($isfirstpost && !empty($_G['forum']['threadtypes']['types'])) { ?>
simulateSelect('typeid');
<?php } if(!$isfirstpost && $thread['special'] == 5 && empty($firststand) && $_G['gp_action'] != 'edit') { ?>
simulateSelect('stand');
<?php } if(!$special && $_G['forum']['threadsorts'] && ($_G['gp_action'] == 'newthread' || $_G['gp_action'] == 'edit' && $isfirstpost && !$thread['sortid'])) { ?>
simulateSelect('sortid');
function switchsort() {
if($('sortid').value) {
saveData(1);
<?php if($isfirstpost && $sortid) { ?>
ajaxget('forum.php?mod=post&action=threadsorts&sortid=' + $('sortid').value + '&fid=<?php echo $_G['fid'];?><?php if(!empty($modelid)) { ?>&modelid=<?php echo $modelid;?><?php } if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>', 'threadsorts', 'threadsortswait', null, null, function () { seteditorcontrolpos(); });
<?php } else { ?>
location.href = 'forum.php?mod=post&action=<?php echo $_G['gp_action'];?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } if(!empty($pid)) { ?>&pid=<?php echo $pid;?><?php } if(!empty($modelid)) { ?>&modelid=<?php echo $modelid;?><?php } ?>&extra=<?php echo $extra;?><?php if(!$sortid) { ?>&cedit=yes<?php } ?>&sortid=' + $('sortid').value;
<?php } ?>
Editorwin = 0;
}
}
<?php } if($isfirstpost) { if($sortid) { ?>
ajaxget('forum.php?mod=post&action=threadsorts&sortid=<?php echo $sortid;?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } ?>&inajax=1<?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>', 'threadsorts', 'threadsortswait', null, null, function () { seteditorcontrolpos(); });
<?php } elseif($_G['forum']['threadsorts']['required'] && !$special) { ?><?php $threadsortids = array_keys($threadsorts[types]); ?>ajaxget('forum.php?mod=post&action=threadsorts&sortid=<?php echo $threadsortids['0'];?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } ?>&inajax=1<?php if(!empty($_G['gp_modthreadkey'])) { ?>&modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>', 'threadsorts', 'threadsortswait', null, null, function () { seteditorcontrolpos(); });
<?php } } if($_G['gp_action'] == 'newthread' && $_G['setting']['sitemessage']['newthread'] || $_G['gp_action'] == 'reply' && $_G['setting']['sitemessage']['reply']) { ?>
showPrompt('custominfo', 'mouseover', '<?php if($_G['gp_action'] == 'newthread') { echo trim($_G['setting']['sitemessage']['newthread'][array_rand($_G['setting']['sitemessage']['newthread'])]); } elseif($_G['gp_action'] == 'reply') { echo trim($_G['setting']['sitemessage']['reply'][array_rand($_G['setting']['sitemessage']['reply'])]); } ?>', <?php echo $_G['setting']['sitemessage']['time'];?>);
<?php } if($_G['setting']['swfupload'] != 1 && $_G['group']['allowpostattach']) { ?>addAttach();<?php } if($_G['setting']['swfupload'] != 1 && $allowpostimg) { ?>addAttach('img');<?php } ?>

if($('subjectbox')) {
var tmp_obj = $('e_textarea');
if(tmp_obj && tmp_obj.style.display == '') {
tmp_obj.focus();
}
} else if($('subject')) {
$('subject').focus();
}
function uploadsuccess(num,type) {
//$("uploadtips").style.display = 'block';
//$("uploadtips").innerHTML="成功上传"+num+" 个 "+(type=='image' ? '图片' : '附件');
ajaxget('forum.php?mod=ajax&action=imagelist&new_template=1', 'imgattachlist');
//setTimeout("$('uploadtips').style.display = 'none'",3000);
}
</script>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
    $("#psd").hide().css('top','215px').show();
    $("#fujia_tools").click(function(){
        if($("#fujia_tools span").html()=='-'){
            $("#fujia_tools span").html('+');
            $("#fujia_tools").attr('title','点击显示');
            $("#fujia_tools").next().hide();
            $("#fujia_tools").removeClass('bbs pbm mbm');
            $("#ct .mn").css('width',$("#wp").width());
            $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
        }else{
            $("#fujia_tools span").html('-');
            $("#fujia_tools").attr('title','点击隐藏');
            $("#fujia_tools").next().show();
            $("#fujia_tools").addClass('bbs pbm mbm');
            $("#ct .mn").css('width',$("#wp").width()-150);
            $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
        }
    });
    $("#nv_forum").one('mouseover',function(){
        if($("#fujia_tools span").html()=='-'){
            $("#ct .mn").css('width',$("#wp").width()-150);
        }else{
            $("#ct .mn").css('width',$("#wp").width());
        }
        if($("#wp").width()>960){
$("#stip").css('right','295px');
            $("#psd").css('right','165px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','205px');}
        }else{
$("#stip").css('right','460px');
            $("#psd").css('right','230px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','375px');}
        }
        $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
    });
    $("#wh").live('click mouseleave',function(){
        if($("#fujia_tools span").html()=='-'){
            $("#ct .mn").css('width',$("#wp").width()-150);
        }else{
            $("#ct .mn").css('width',$("#wp").width());
        }
        if($("#wp").width()>960){
$("#stip").css('right','295px');
            $("#psd").css('right','165px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','205px');}
        }else{
$("#stip").css('right','460px');
            $("#psd").css('right','230px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','375px');}
        }
        $("#wp").one('mouseenter',function(){
            if($("#fujia_tools span").html()=='-'){
                $("#ct .mn").css('width',$("#wp").width()-150);
            }else{
                $("#ct .mn").css('width',$("#wp").width());
            }
            if($("#wp").width()>960){
$("#stip").css('right','295px');
                $("#psd").css('right','165px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','205px');}
            }else{
$("#stip").css('right','460px');
                $("#psd").css('right','230px');
if($("#tpflreturn")!=null){$("#tpflreturn").css('right','375px');}
            }
        });
        $("#<?php echo $editorid;?>_iframe").parent().width($("#<?php echo $editorid;?>_iframe").parent().parent().width()-$("#upload_newimage_tools").width()-10);
        change__multi_height();
    });

    $("#stip").click(function(){
$(this).hide();
    });
    $("#<?php echo $editorid;?>_image").click(function(){
        if($("#upload_newimage_tools").css('display')=='none'){
            $("#upload_newimage_tools").show();
            $("#<?php echo $editorid;?>_iframe").parent().width('75%');
        }else{
            $("#upload_newimage_tools").hide();
            $("#<?php echo $editorid;?>_iframe").width('99%');
            $("#<?php echo $editorid;?>_iframe").parent().width('99%');
        }
    });
    $("#upload_newimage_tools h4 span").click(function(){
        $(this).css({'border-color':'#CCC','border-bottom-color':'#F2F2F2','background':'#F2F2F2'}).siblings().css({'border-color':'#FFF','border-bottom-color':'#CCC','background':'#FFF'}).end().parent().css({'border-bottom-color':'#CCC'}).end();
        var select_mod=$(this).index();
        switch(select_mod){
            case 0:
            var displaymod='multi';
            break;
            case 1:
            var displaymod='albumlist';
            break;
            default:
            return false;
            break;
        }
        $('#<?php echo $editorid;?>_'+displaymod).show().siblings(':not(h4)').hide();
    });
    function change__multi_height(){
        var zong_height=$("#upload_newimage_tools").height();
        var h4_height=$("#upload_newimage_tools :first").outerHeight();
        var multi_height=zong_height-h4_height-20;
        $("#<?php echo $editorid;?>_multi").height(multi_height);
        $("#<?php echo $editorid;?>_imgattachlist").height($("#<?php echo $editorid;?>_multiimg").height()-$("#<?php echo $editorid;?>_multiimg_swf").height());
        var imgattachlist_height=$("#<?php echo $editorid;?>_imgattachlist").height();
        $("#<?php echo $editorid;?>_imgattachlist :first").height(imgattachlist_height-45-5);
        var upfiles_height=$("#<?php echo $editorid;?>_imgattachlist :first").height();
        $("#photolist_upload").height(upfiles_height-30-5);
    }
    $('#photolist_upload tr td').live('mouseleave',function(){
        $(this).children('.delimg_icon').css('visibility','hidden');
    });
    $('#photolist_upload tr td').live('mouseover',function(){
        $(this).children('.delimg_icon').css('visibility','visible');
    });
    $('#upload_newimage_tools img').live('mouseenter',function(){
        $('#img_display_view').remove();
        var img_src=$(this).attr('src');
        if($(this).parents('#albumphoto').attr('id')=='albumphoto' && img_src.indexOf('.thumb.')>=0){
            img_src=img_src.substr(0,(img_src.length-10));
        }
        var off_left=$("#upload_newimage_tools").offset().left-330;
        var off_top=$("#upload_newimage_tools").offset().top+50;
        $("#<?php echo $editorid;?>_body").append("<div id='img_display_view' style='float:right;display:none;border:5px solid #BBB;padding:10px;background:#FFF;position:absolute;top:"+off_top+"px;left:"+off_left+"px;width:150px;height:30px;z-index:999'><div id='tips_loading' style='font-weight:bold;position:inherit;z-index:101;width:150px;height:30px;font-size:16px;line-height:30px;text-align:center;'>正在载入...</div><img src='"+img_src+"' onload=document.getElementById('tips_loading').style.display='none'; style='display:none;float:left;max-width:300px;max-height:300px;position:inherit'/><div>");
        $("#img_display_view img").error(function(){
            var top_error=$("#<?php echo $editorid;?>_body").offset().top+300;
            $(this).prev().text('载入失败').parent().css({'left':'508px','top':top_error}).end().end().remove();
            var parent_width=$('#tips_loading').width();
            var parent_height=$('#tips_loading').height();
            $('#img_display_view').width(parent_width).height(parent_height).fadeIn(500);
        });
        $('#img_display_view img').load(function(){
            var img_width=$('#img_display_view').offset().left+(300-$(this).width());
            $(this).prev().remove().end().parent().css({'left':img_width});
            var parent_width=$(this).width();
            var parent_height=$(this).height();
            $(this).show();
            $('#img_display_view').width(parent_width).height(parent_height).fadeIn(500);
        });
        $("#img_display_view").fadeIn(500);
    });
    $('#upload_newimage_tools img').live('mouseleave',function(){
        $('#img_display_view').remove();
    });
    if(jQuery.browser.webkit || jQuery.browser.opera){
        $("#<?php echo $editorid;?>_multiimg_swf").live('click',function(){
            //$(this).height('150px');
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideUp(300).siblings().show();
            change__multi_height();
        });
        $("#<?php echo $editorid;?>_multiimg_swf").live('mouseenter',function(){
            dis_tips();
            $("#tips_limit").show();
        });
        $("#<?php echo $editorid;?>_imgattachlist").live('click',function(){
            $("#<?php echo $editorid;?>_multiimg_swf").height('52px');
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideDown(300).siblings().hide();
            change__multi_height();
            dis_tips();
            $("#tips_limit").hide();
        });
        $("#upload_newimage_tools").live('mousemove',function(){
            change__multi_height();
        })
    }else{
        $("#<?php echo $editorid;?>_multiimg_swf").live('mouseenter',function(){
            //$(this).height('150px');
            change__multi_height();
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideUp(300).siblings().show();
            dis_tips();
            $("#tips_limit").show();
        });
        $("#<?php echo $editorid;?>_imgattachlist").live('mouseenter',function(){
            $("#<?php echo $editorid;?>_multiimg_swf").height('52px');
            change__multi_height();
            $("#<?php echo $editorid;?>_multiimg_swf :first").slideDown(300).siblings().hide();
        });
    }
    $("#<?php echo $editorid;?>_multiimg_swf").live('mouseleave',function(){
        dis_tips();
        $("#tips_limit").hide();
    });
    function dis_tips(){
        var tips_left=$("#<?php echo $editorid;?>_multiimg_swf").offset().left-$("#tips_limit").width()-20;
        var tips_top=$("#<?php echo $editorid;?>_multiimg_swf").offset().top+20;
        $("#tips_limit").css({"left":tips_left,"top":tips_top});
    }
    $("#insert_all_imagelist").live('click',function(){
        var have_img_len=$("#<?php echo $editorid;?>_iframe").contents().find('body img').length;
        var len_img=$('.imgl td:not(.imgdeleted) img').length;
        if(len_img>3){
            showDialog('你列表中的文件超过三张，超过三张的图片将会保存在列表内，您可以再次发帖时使用！');
        }
        for(i=0;i<(3-have_img_len);i++){
            $('.imgl td:not(.imgdeleted) img:eq('+i+')').click();
            if(have_img_len>0){
                //$("#<?php echo $editorid;?>_iframe").contents().find('body img:last').before('<br/>');
            }else{
                if(i>=1){
                    //$("#<?php echo $editorid;?>_iframe").contents().find('body img:last').before('<br/>');
                }
            }
        }
    });
    $("#all_insert_alb").live('click',function(){
        $("#photolist_upload input:checkbox").click();
        if($("#photolist_upload input:hidden.pc").val()=="" && $("#all_insert_alb").attr('checked')=='checked'){
            $("#photolist_upload input:checkbox").click();
        }
    });
    $("#<?php echo $editorid;?>_fullswitcher").live('mouseenter',function(){
        $("#e_iframe").parent().width("75%");
        $(".area").one('mouseover mousemove',function(){
            change__multi_height();
        });
    });
    $("#save_to_album").click(function(){
        $("#album_contrl").toggle();
    });
    function img_width_fix(){
        $("#<?php echo $editorid;?>_iframe").contents().find('body').children('img').load(function(){
            $(this).removeAttr('width');
        });
    }
    img_width_fix();
    if($.browser.msie){
        $("#<?php echo $editorid;?>_iframe").one("mousemove",function(){
            img_width_fix();
        });
    }
    $("#<?php echo $editorid;?>_multiimg_swf :eq(1)").hide();
    $("#upload_newimage_tools h4 span:first").click();
    $('#fujia_tools').click();
    $("#<?php echo $editorid;?>_multiimg_swf").click();
    change__multi_height();
})(jQuery);
</script><?php echo output_ajax(); ?>]]></root><?php exit; ?>