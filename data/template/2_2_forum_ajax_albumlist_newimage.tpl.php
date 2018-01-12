<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('ajax_albumlist_newimage', 'common/header_ajax');?><?php include template('common/header_ajax'); ?><?php $i = 0; ?><table cellspacing="2" cellpadding="2" class="imgl"><tr><?php if(is_array($photolist)) foreach($photolist as $photo) { ?><?php $i++; ?><td valign="bottom" width="50%">
<a href="javascript:;"><img src="<?php echo $photo['thumburl'];?>" title="<?php echo $photo['filename'];?>" onclick="ajaxalbumlist('<?php echo $photo['url'];?>', <?php echo strlen($photo['url']) + 11; ?>)" onload="thumbImg(this, 1)" width="90" _width="90" _height="90"></a>
</td>
<?php if($i % 2 == 0 && isset($photolist[$i])) { ?></tr><tr><?php } } if(($imgpad = $i % 2) > 0) { echo str_repeat('<td width="50%"></td>', 2 - $imgpad);; } ?>
</tr></table>
<div class="pgs cl"><?php echo $multi;?></div>
<?php if($multi) { ?>
<script type="text/javascript">
if(document.getElementById('e_fullswitcher').innerHTML!='»Ö¸´'){
        editorsize('+',500);
}
</script>
<?php } else { ?>
<script type="text/javascript">
if(document.getElementById('e_fullswitcher').innerHTML!='»Ö¸´'){
        editorsize('-');
}
</script>
<?php } include template('common/footer_ajax'); ?>