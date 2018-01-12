<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/default/forum/modcp_forum.htm', './template/8264/common/seditor_2014.htm', 1496325345, '2', './data/template/2_2_forum_modcp_forum.tpl.php', './template/8264', 'forum/modcp_forum')
;?>
<div class="bm bw0 mdcp">
<?php if($_G['fid'] && $_G['forum']['ismoderator']) { ?>

<h1 class="mt cl">
<span class="z">
<?php if($op == 'editforum') { ?>版块编辑<?php } elseif($op == 'recommend') { ?>推荐主题<?php } if($modforums['fids']) { ?> -&nbsp;
</span>
<span class="ftid">
<select name="fid" id="fid" width="150" class="ps" change="location.href='<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>&fid='+$('fid').value"><?php if(is_array($modforums['list'])) foreach($modforums['list'] as $id => $name) { ?><option value="<?php echo $id;?>" <?php if($id == $_G['fid']) { ?>selected="selected"<?php } ?>><?php echo $name;?></option>
<?php } ?>
</select>
</span>
<?php } else { ?>
对不起，你无此权限！
<?php } ?>
</h1>
<?php } if($_G['fid'] && $_G['forum']['ismoderator']) { if($op == 'editforum') { ?>
<script type="text/javascript">
var allowbbcode = allowimgcode = 1;
var allowhtml = forumallowhtml = allowsmilies = 0;
function parseurl(str, mode) {
str = str.replace(/([^>=\]"'\/]|^)((((https?|ftp):\/\/)|www\.)([\w\-]+\.)*[\w\-\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!]*)+\.(jpg|gif|png|bmp))/ig, mode == 'html' ? '$1<img src="$2" border="0">' : '$1[img]$2[/img]');
str = str.replace(/([^>=\]"'\/@]|^)((((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k):\/\/)|www\.)([\w\-]+\.)*[:\.@\-\w\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!#]*)*)/ig, mode == 'html' ? '$1<a href="$2" target="_blank">$2</a>' : '$1[url]$2[/url]');
str = str.replace(/([^\w>=\]:"'\.\/]|^)(([\-\.\w]+@[\.\-\w]+(\.\w+)+))/ig, mode == 'html' ? '$1<a href="mailto:$2">$2</a>' : '$1[email]$2[/email]');
return str;
}
</script>
<div class="exfm">
<script src="http://static.8264.com/static/js/bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<form method="post" autocomplete="off" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>">
<table cellspacing="0" cellpadding="0">
<caption>
<h4>本版规则</h4>
<div id="rulespreview"></div>
</caption>
<tr>
<td class="ptm">
<div class="tedt">
<div class="bar">
<div class="y"><a href="javascript:;" onclick="$('rulespreview').innerHTML = bbcode2html($('rulesmessage').value)">预览</a></div><?php $seditor = array('rules', array('bold', 'color', 'img', 'link')); if(in_array('bold', $seditor['1'])) { ?>
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
<textarea id="rulesmessage" name="rulesnew" class="pt" rows="8" <?php if(!$alloweditrules) { ?>disabled="disabled" readonly="readonly"<?php } ?>><?php echo $_G['forum']['rules'];?></textarea>
</div>
</div>
<?php if(!$alloweditrules) { ?>
<div>你所在的用户组不允许修改版规！</div>
<?php } ?>
</td>
<td width="15%" valign="top" class="ptm">
<p>编辑器代码 可用</p>
<p>[img] 代码 可用</p>
<p>HTML 代码 禁用</p>
</td>
</tr>
<tr>
<td colspan="2">
<button type="submit" name="editsubmit" class="pn" value="true"><strong>提交</strong></button>
<?php if($forumupdate) { ?>
版规更新成功，请继续操作
<?php } ?>
</td>
</tr>
</table>
</form>
</div>

<?php } elseif($op == 'recommend') { ?>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php if($threadlist) { ?>
<form method="post" autocomplete="off" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&show=<?php echo $show;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="op" value="<?php echo $op;?>" />
<input type="hidden" name="page" value="<?php echo $page;?>" />
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="check" value="<?php echo $check;?>" />
<table cellspacing="0" cellpadding="0" class="dt">
<thead>
<tr>
<th class="c">&nbsp;</th>
<th>顺序</th>
<th>标题</th>
<th>作者</th>
<th>推荐人</th>
<th>时间期限</th>
<th></th>
</tr>
</thead><?php if(is_array($threadlist)) foreach($threadlist as $thread) { ?><tr>
<td><input<?php if($_G['forum']['modrecommend']['sort'] == 1) { ?> readonly="readonly"<?php } ?> type="checkbox" name="delete[]" class="pc" value="<?php echo $thread['tid'];?>" /></td>
<td><input<?php if($_G['forum']['modrecommend']['sort'] == 1) { ?> readonly="readonly"<?php } ?> type="text" name="order[<?php echo $thread['tid'];?>]" class="px" size="3" value="<?php echo $thread['displayorder'];?>" /></td>
<td><input<?php if($_G['forum']['modrecommend']['sort'] == 1) { ?> readonly="readonly"<?php } ?> type="text" name="subject[<?php echo $thread['tid'];?>]" class="px" value="<?php echo $thread['subject'];?>" /></td>
<td class="xi2"><?php echo $thread['authorlink'];?></td>
<td class="xi2"><?php echo $thread['moderatorlink'];?></td>
<td><input type="text" name="expirationrecommend[<?php echo $thread['tid'];?>]" id="expirationrecommend" class="px" value="<?php echo $thread['expiration'];?>" autocomplete="off" <?php if($_G['forum']['modrecommend']['sort'] == 1) { ?> readonly="readonly"<?php } else { ?> onclick="showcalendar(event, this, true)"<?php } ?> /></td>
<td><?php if($_G['forum']['modrecommend']['sort'] != 1) { ?><a href="javascript:;" onclick="showWindow('mods', 'forum.php?mod=topicadmin&optgroup=1&action=moderate&operation=recommend&frommodcp=2&show=<?php echo $show;?>&tid=<?php echo $thread['tid'];?>')" class="xi2">更多设置</a><?php } ?></td>
</tr>
<?php } ?>
<tr class="bw0_all">
<td><input type="checkbox" name="chkall" id="chkall" class="pc" onclick="checkall(this.form)" /> <label for="chkall">删?</label></td>
<td colspan="6">
<?php if(!empty($reportlist['pagelink'])) { ?><?php echo $reportlist['pagelink'];?><?php } ?>
<button type="submit" name="editsubmit" class="pn" value="yes"><strong>更新列表</strong></button>
<?php if($listupdate) { ?>
推荐主题更新成功，请继续操作
<?php } ?>
</td>
</tr>
</table>
</form>
<?php } else { ?>
<div class="emp">对不起，没有找到匹配结果。</div>
<?php } } } ?>
</div>
<script type="text/javascript" reload="1">
if($('fid')) {
simulateSelect('fid');
}
</script>
<script src="http://static.8264.com/static/js/calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>