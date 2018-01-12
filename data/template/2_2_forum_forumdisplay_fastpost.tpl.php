<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/default/forum/forumdisplay_fastpost.htm', './template/8264/common/seditor_2014.htm', 1509517867, '2', './data/template/2_2_forum_forumdisplay_fastpost.tpl.php', './template/8264', 'forum/forumdisplay_fastpost')
;?>
<script type="text/javascript">
var postminchars = parseInt('<?php echo $_G['setting']['minpostsize'];?>');
var postmaxchars = parseInt('<?php echo $_G['setting']['maxpostsize'];?>');
var disablepostctrl = parseInt('<?php echo $_G['group']['disablepostctrl'];?>');
</script>
<div id="f_pst" class="bm">
<div class="bm_h">
<h2>快速发帖</h2>
</div>
<div class="bm_c">
<form method="post" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>&amp;topicsubmit=yes&amp;infloat=yes&amp;handlekey=fastnewpost" onSubmit="return fastpostvalidate(this)">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_fastpost_content'])) echo $_G['setting']['pluginhooks']['forumdisplay_fastpost_content']; ?>

<div id="fastpostreturn" style="margin:-5px 0 5px"></div>

<div class="pbt cl">
<?php if($_G['forum']['threadtypes']['types']) { ?>
<div class="ftid">
<select name="typeid" id="typeid" width="80">
<option value="0">选择主题分类</option><?php if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $typeid => $name) { ?><option value="<?php echo $typeid;?>"><?php echo strip_tags($name);; ?></option>
<?php } ?>
</select>
</div>
<script type="text/javascript" reload="1">simulateSelect('typeid');</script>
<?php } ?>
<input type="text" id="subject" name="subject" class="px" value="" onkeyup="strLenCalc(this, 'checklen', 80);" tabindex="11" style="width: 25em" />
<span>还可输入 <strong id="checklen">80</strong> 个字符</span>
</div>

<div class="cl">
<?php if($_G['setting']['fastsmilies']) { ?><div id="fastsmiliesdiv" class="y"><div id="fastsmiliesdiv_data"><div id="fastsmilies"></div></div></div><?php } ?>
<div<?php if($_G['setting']['fastsmilies']) { ?> class="hasfsl"<?php } ?>>
<div class="tedt">
<div class="bar">                          
                           <span class="y">
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_fastpost_func_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_fastpost_func_extra']; if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['doodle'])) { ?>
<a id="a_magic_doodle" href="home.php?mod=magic&amp;mid=doodle&amp;showid=comment_doodle&amp;target=fastpostmessage&amp;from=fastpost" onclick="showWindow(this.id, this.href, 'get', 0)"><?php echo $_G['setting']['magics']['doodle'];?></a>
<span class="pipe">|</span>
<?php } ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['fid'];?>" onclick="switchAdvanceMode(this.href);doane(event);">上传图片请点击高级模式</a>
</span><?php $seditor = array('fastpost', array('bold', 'color', 'img', 'link', 'quote', 'code'), $guestpost ? 1 : 0); ?><?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_fastpost_ctrl_extra'])) echo $_G['setting']['pluginhooks']['forumdisplay_fastpost_ctrl_extra']; if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<style type="text/css">
#pmimg_menu #pmimg_param_1 {width:93%!important;}
</style>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?> style="margin-left:5px;">图片</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>表情</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } ?></div>
<div class="area">
<?php if(!$guestpost) { ?>
<textarea rows="5" cols="80" name="message" id="fastpostmessage" onKeyDown="seditor_ctlent(event, '$(\'fastpostform\').submit()');" tabindex="12" class="pt"></textarea>
<?php } else { ?>
<div class="pt hm">你需要登录后才可以发帖 <a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)" class="xi2">登录</a> | <a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="showWindow('register', this.href)" class="xi2"><?php echo $_G['setting']['reglinkname'];?></a><?php if($_G['setting']['connect']['allow']) { ?> | <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=forumdisplay_fastpost" target="_top" rel="nofollow"><img src="<?php echo IMGDIR;?>/qq_login.gif" class="vm" /></a><?php } ?></div>
<?php } ?>
</div>
</div>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" onclick="showMenu(this.id)"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm sec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="usesig" value="<?php echo $usesigcheck;?>" />
<p class="ptm">
<button <?php if(!$guestpost) { ?>type="submit" <?php } else { ?>type="button" onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')" <?php } ?>name="topicsubmit" id="fastpostsubmit" value="topicsubmit" tabindex="13" class="pn"><strong>发表帖子</strong></button>
<?php if($allowconnectfeed) { ?>
<label for="connect_publish_feed" class="vm">
<input type="checkbox" name="connect_publish_feed" id="connect_publish_feed" value="1" <?php if($_G['member']['conisbind'] && $_G['member']['conispublishfeed']) { ?>checked="checked" <?php } ?>tabindex="24"<?php if($_G['cookie']['connect_is_bind'] != 1) { ?> onclick="window.open('connect.php?mod=config');this.checked = false"<?php } ?> />
将此主题发送到QQ空间动态
</label>
<?php } ?>
</p>
</div>
</div>
</form>
</div>
</div>