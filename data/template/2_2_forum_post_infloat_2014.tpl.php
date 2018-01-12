<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_infloat_2014', 'common/header');
0
|| checktplrefresh('./template/8264/forum/post_infloat_2014.htm', './template/8264/common/seditor_new_2014.htm', 1509518022, '2', './data/template/2_2_forum_post_infloat_2014.tpl.php', './template/8264', 'forum/post_infloat_2014')
;?><?php include template('common/header'); ?><h3 class="flb">
<em id="return_comment">
<?php if($_G['gp_action'] == 'newthread') { ?>发表帖子<?php } elseif($_G['gp_action'] == 'reply') { ?>参与/回复主题<?php } ?>
</em>
<?php if($_G['gp_action'] == 'newthread' && $modnewthreads) { ?><span class="needverify">需审核</span><?php } if($_G['gp_action'] == 'reply' && $modnewreplies) { ?><span class="needverify">需审核</span><?php } ?>
<span>
<a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>')" title="关闭">关闭</a>
</span>
</h3>

<form method="post" autocomplete="off" id="postform" <?php if(!empty($_G['gp_way'])) { ?>onsubmit="<?php if(!empty($_G['gp_infloat'])) { ?>$('postsubmit').disabled=true;ajaxpost('postform', 'return_comment', 'return_comment', 'onerror', 'postsubmit', return_funs);return false;<?php } ?>"<?php } ?> action="forum.php?mod=post&amp;infloat=yes&amp;action=<?php echo $_G['gp_action'];?>&amp;fid=<?php echo $_G['fid'];?>&amp;pid=<?php echo $_G['gp_repquote'];?>&amp;page=<?php echo $_G['page'];?>&amp;postid=<?php echo $_G['gp_postid'];?>&amp;way=<?php echo $_G['gp_way'];?>&amp;cid=<?php echo $_G['gp_cid'];?>&amp;extra=<?php echo $extra;?><?php if($_G['gp_action'] == 'newthread') { ?>&amp;topicsubmit=yes<?php } elseif($_G['gp_action'] == 'reply') { ?>&amp;tid=<?php echo $_G['tid'];?>&amp;replysubmit=yes<?php } ?>" >
<div id="floatlayout_<?php echo $_G['gp_action'];?>" style="padding: 0 10px 0 10px;">
<div class="pinglun" style="margin-left: 0;">
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<?php if($_G['gp_action'] == 'reply') { ?>
<input type="hidden" name="noticeauthor" value="<?php echo $noticeauthor;?>" />
<input type="hidden" name="noticetrimstr" value="<?php echo $noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $noticeauthormsg;?>" />
<?php if($_G['gp_reppost']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_G['gp_reppost'];?>" />
<?php } elseif($_G['gp_repquote']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_G['gp_repquote'];?>" />
<?php } } ?>
<div class="pbt cl">
<?php if($_G['gp_action'] == 'newthread' && ($threadsorts = $_G['forum']['threadsorts'])) { ?>
<div class="ftid">
<select name="sortid" id="sortid" width="80" change="if($('sortid').value) {switchAdvanceMode('forum.php?mod=post&action=<?php echo $_G['gp_action'];?>&fid=<?php echo $_G['fid'];?><?php if(!empty($_G['tid'])) { ?>&tid=<?php echo $_G['tid'];?><?php } if(!empty($pid)) { ?>&pid=<?php echo $pid;?><?php } if(!empty($modelid)) { ?>&modelid=<?php echo $modelid;?><?php } ?>&extra=<?php echo $extra;?>&sortid=' + $('sortid').value)}">
<?php if(!$sortid) { ?><option value="0">分类信息</option><?php } if(is_array($threadsorts['types'])) foreach($threadsorts['types'] as $tsortid => $name) { if(!empty($modelid) && $threadsorts['modelid'][$tsortid] == $modelid || empty($modelid)) { ?>
<option value="<?php echo $tsortid;?>"<?php if($sortid == $tsortid) { ?> selected="selected"<?php } ?>><?php echo strip_tags($name);; ?></option>
<?php } } ?>
</select>
</div>
<script type="text/javascript" reload="1">simulateSelect('sortid');</script>
<?php } if($isfirstpost && $_G['forum']['threadtypes']['types']) { ?>
<div class="ftid">
<select name="typeid" id="typeid" width="80">
<option value="0">选择主题分类</option><?php if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { ?><option value="<?php echo $typeid;?>"<?php if($thread['typeid'] == $typeid) { ?> selected="selected"<?php } ?>><?php echo strip_tags($name);; ?></option>
<?php } ?>
</select>
</div>
<script type="text/javascript" reload="1">simulateSelect('typeid');</script>
<?php } if($_G['gp_action'] != 'reply') { ?>
<span><input name="subject" id="subject" class="px" value="<?php echo $postinfo['subject'];?>" tabindex="21" style="width: 25em" /></span>
<?php } else { ?>
<span id="subjecthide" class="z">RE: <?php echo $thread['subject'];?> <span style="display: none;">[<a href="javascript:;" onclick="display('subjecthide');display('subjectbox');$('subject').value='RE: <?php echo htmlspecialchars(str_replace('\'', '\\\'', $thread['subject'])); ?>'">修改</a>]</span></span>
<span id="subjectbox" style="display:none"><input name="subject" id="subject" class="px" value="" tabindex="21" style="width: 25em" /></span>
<?php } ?>
</div>
<?php if(!$isfirstpost && $thread['special'] == 5 && empty($firststand)) { ?>
<div class="pbt cl">
<div class="ftid sslt">
<select id="stand" name="stand">
<option value="">选择观点</option>
<option value="0">中立</option>
<option value="1"<?php if($stand == 1) { ?> selected<?php } ?>>正方</option>
<option value="2"<?php if($stand == 2) { ?> selected<?php } ?>>反方</option>
</select>
</div>
<script type="text/javascript" reload="1">simulateSelect('stand');</script>
</div>
<?php } if($_G['gp_action'] == 'reply' && $quotemessage) { ?>
<div class="pbt cl"><?php echo $quotemessage;?></div>
<?php } ?>

<div class="pinglunmid">
<div class="edierbar clboth">
<a class="gjms" href="forum.php?mod=post&amp;action=<?php echo $_G['gp_action'];?>&amp;fid=<?php echo $_G['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;postid=<?php echo $_G['gp_postid'];?>&amp;way=<?php echo $_G['gp_way'];?>&amp;cid=<?php echo $_G['gp_cid'];?>&amp;extra=<?php echo $extra;?><?php if($_G['gp_action'] == 'reply') { ?>&amp;tid=<?php echo $_G['tid'];?><?php if(!empty($_G['gp_reppost'])) { ?>&amp;reppost=<?php echo $_G['gp_reppost'];?><?php } if(!empty($_G['gp_repquote'])) { ?>&amp;repquote=<?php echo $_G['gp_repquote'];?><?php } if(!empty($page)) { ?>&amp;page=<?php echo $page;?><?php } } if($stand) { ?>&amp;stand=<?php echo $stand;?><?php } ?>" onclick="switchAdvanceMode(this.href);doane(event);">上传图片请点击高级模式</a><?php $seditor = array('post', array('bold', 'color')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('simpleupload', $seditor['1'])) { ?>
<div class="bq_fjimg" id="uploadpic">
<a href="javascript:;" class="fjimg"></a>
</div><?php require_once libfile('class/simpleupload'); ?><?php $flashstring = simpleUpload::getFlashStr("uploadpic", 24, 23); ?><?php echo $flashstring;?>
<script>
function flashcallback(type, data){
eval("var objbtn = " + data);
switch(type){
case -1:
//alert(objbtn.text);
break;
case 1:
//alert(objbtn.text);alert(objbtn.picurl);
jQuery("#<?php echo $seditor['0'];?>message").val(jQuery("#<?php echo $seditor['0'];?>message").val() + "[img]" + objbtn.picurl + "[/img]");
break;
}
}
</script>
<?php } ?></div>
<div class="areatext">
<textarea rows="7" cols="80" name="message" id="postmessage" onKeyDown="seditor_ctlent(event, '$(\'postsubmit\').click();')" tabindex="22" class="pt"><?php echo $message;?></textarea>
</div>
</div>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</div>
<div style="clear: both;"></div>
</div>
<div id="moreconf">
<?php if($_G['gp_action'] == 'newthread' && $_G['setting']['sitemessage']['newthread'] || $_G['gp_action'] == 'reply' && $_G['setting']['sitemessage']['reply']) { ?>
<a href="javascript:;" id="custominfo" class="y"><img src="http://static.8264.com/static/image/common/info_small.gif" alt="帮助" /></a>
<?php } ?>
        <div id="yincang" style="padding: 5px 0 10px 10px;">

<button id="postsubmit" class="kshf" tabindex="23" value="true" name="<?php if($_G['gp_action'] == 'newthread') { ?>topicsubmit<?php } elseif($_G['gp_action'] == 'reply') { ?>replysubmit<?php } ?>" type="submit"></button>
</div>
<?php if(!empty($_G['setting']['pluginhooks']['post_infloat_btn_extra'])) echo $_G['setting']['pluginhooks']['post_infloat_btn_extra']; ?>
</div>
</form>
<script language="javascript">
function return_funs(){
$('postsubmit').disabled = false;
}
</script>
<?php if($_G['gp_way'] <> 'commentreply' && $_G['gp_way'] <> 'reply') { ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_action'];?>(locationhref, message) {
<?php if($_G['gp_action'] == 'reply') { ?>
try {
var pid = locationhref.lastIndexOf('#pid');
if(pid != -1) {
pid = locationhref.substr(pid + 4);
ajaxget('forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?>&viewpid=' + pid<?php if($_G['gp_from']) { ?> + '&from=<?php echo $_G['gp_from'];?>'<?php } ?>, 'post_new', 'ajaxwaitid', '', null, 'appendreply()');
if(replyreload) {
var reloadpids = replyreload.split(',');
for(i = 1;i < reloadpids.length;i++) {
ajaxget('forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?>&viewpid=' + reloadpids[i]<?php if($_G['gp_from']) { ?> + '&from=<?php echo $_G['gp_from'];?>'<?php } ?>, 'post_' + reloadpids[i]);
}
}
} else {
showDialog(message, 'notice', '', 'location.href="' + locationhref + '"');
}
} catch(e) {
location.href = locationhref;
}
<?php } elseif($_G['gp_action'] == 'newthread') { ?>
var hastid = locationhref.lastIndexOf('tid=');
if(hastid == -1) {
showDialog(message, 'notice', '', 'location.href="' + locationhref + '"');
} else {
location.href = locationhref;
}
<?php } ?>
hideWindow('<?php echo $_G['gp_action'];?>');
}
<?php if($_G['gp_action'] == 'newthread' && $_G['setting']['sitemessage']['newthread'] || $_G['gp_action'] == 'reply' && $_G['setting']['sitemessage']['reply']) { ?>
showPrompt('custominfo', 'mouseover', '<?php if($_G['gp_action'] == 'newthread') { echo trim($_G['setting']['sitemessage']['newthread'][array_rand($_G['setting']['sitemessage']['newthread'])]); } elseif($_G['gp_action'] == 'reply') { echo trim($_G['setting']['sitemessage']['reply'][array_rand($_G['setting']['sitemessage']['reply'])]); } ?>', <?php echo $_G['setting']['sitemessage']['time'];?>);
<?php } ?>

if($('subjectbox')) {
$('postmessage').focus();
} else if($('subject')) {
$('subject').select();
$('subject').focus();
}
</script>
<?php } include template('common/footer'); ?>