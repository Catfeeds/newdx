<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('comment', 'common/header');
0
|| checktplrefresh('./template/default/forum/comment.htm', './template/8264/common/seditor_2014.htm', 1503437371, '2', './data/template/2_2_forum_comment.tpl.php', './template/8264', 'forum/comment')
|| checktplrefresh('./template/default/forum/comment.htm', './template/8264/common/seccheck_2014.htm', 1503437371, '2', './data/template/2_2_forum_comment.tpl.php', './template/8264', 'forum/comment')
;?><?php include template('common/header'); if(empty($_G['gp_infloat'])) { ?>
<div id="ct" class="wp cl">
<div class="mn">
<div class="bm bw0">
<?php } ?>

<form method="post" autocomplete="off" id="commentform" action="forum.php?mod=post&amp;action=reply&amp;comment=yes&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $_G['gp_pid'];?>&amp;extra=<?php echo $extra;?><?php if(!empty($_G['gp_page'])) { ?>&amp;page=<?php echo $_G['gp_page'];?><?php } ?>&amp;commentsubmit=yes&amp;infloat=yes" onsubmit="<?php if(!empty($_G['gp_infloat'])) { ?>ajaxpost('commentform', 'return_<?php echo $_G['gp_handlekey'];?>', 'return_<?php echo $_G['gp_handlekey'];?>', 'onerror');return false;<?php } ?>">
<div class="f_c">
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">点评</em>
<span>
<?php if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>')" title="关闭">关闭</a><?php } ?>
</span>
</h3>
<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<div class="c">
<div class="tedt">
<div class="bar cm"><?php $seditor = array('comment', array('bold', 'color')); if(in_array('bold', $seditor['1'])) { ?>
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
<?php } } ?><span id="itemdiv"></span>
</div>
<div class="area">
<textarea rows="2" cols="50" name="message" id="commentmessage" onKeyUp="strLenCalc(this, 'checklen')" onKeyDown="seditor_ctlent(event, '$(\'commentsubmit\').click();')" tabindex="2" class="pt" style="overflow: auto"></textarea>
</div>
<script type="text/javascript" reload="1">
<?php if($commentitem) { ?>
var items = itemrow = itemcmm = '';<?php $items = range(0, 5);$itemlang = array('差', '一般', '还行', '好', '很好', '非常好');$i = $cmm = 0; if(is_array($commentitem)) foreach($commentitem as $item) { ?><?php $item = trim($item); if($item) { ?>
items += '<input type="hidden" id="itemc_<?php echo $i;?>" name="commentitem[<?php echo $item;?>]" value="" />';
itemrow = '<span id="itemt_<?php echo $i;?>" class="z xg1" style="cursor:pointer" title="放弃此观点" onclick="itemdisable(<?php echo $i;?>)">&nbsp;<?php echo $item;?></span>';
itemstar = '';<?php if(is_array($items)) foreach($items as $j) { ?>itemstar += '<em onclick="itemclk(<?php echo $i;?>, <?php echo $j;?>)" onmouseover="itemop(<?php echo $i;?>, <?php echo $j;?>)" onmouseout="itemset(<?php echo $i;?>)" title="<?php echo $itemlang[$j];?>(<?php echo $j;?>)"<?php if(!$j) { ?> style="width: 10px;"<?php } ?>><?php echo $itemlang[$j];?></em>';
<?php } ?>
itemrow += '<span id="item_<?php echo $i;?>" class="z cmstar">' + itemstar + '</span>';<?php $i++; if(!$cmm) { ?>items += itemrow;<?php } else { ?>itemcmm += '<div class="cl cmm" style="margin:5px">' + itemrow + '</div>';<?php } } elseif(!$cmm) { ?>
items += '<span class="z" id="itemmore" onmouseover="showMenu({\'ctrlid\':this.id,\'pos\':\'13\'})">&nbsp;&raquo; 更多</span>';<?php $cmm = 1; } } ?>
$('itemdiv').innerHTML = items;
if(itemcmm) {
cmmdiv = document.createElement('div');
cmmdiv.id = 'itemmore_menu';
cmmdiv.style.display = 'none';
cmmdiv.className = 'p_pop';
cmmdiv.innerHTML = itemcmm;
$('append_parent').appendChild(cmmdiv);
}
<?php } ?>
$('commentmessage').focus();
</script>
</div>
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec>: <span id="sec<hash>" onclick="showMenu({'ctrlid':this.id,'win':'{$_G['gp_handlekey']}'})"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt" style="display:none"><sec></div>
EOF;
?>
<div class="mtm"><?php $sechash = 'S'.random(4);
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
<?php } ?>
</div>
</div>
<div class="o pns cl<?php if(empty($_G['gp_infloat'])) { ?> mtm<?php } ?>">
<button type="submit" id="commentsubmit" class="pn pnc z" value="true" name="commentsubmit" tabindex="3"><span>发布</span></button>
<span class="y">还可输入 <strong id="checklen">200</strong> 个字符</span>
</div>
</form>

<?php if(empty($_G['gp_infloat'])) { ?>
</div>
</div>
</div>
<?php } include template('common/footer'); ?>