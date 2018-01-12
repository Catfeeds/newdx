<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('ajax_albumlist_2014', 'common/header_ajax');?><?php include template('common/header_ajax'); ?><div class="imglistcon_1 clboth">
<ul><?php if(is_array($photolist)) foreach($photolist as $photo) { ?><li><img onerror="this.src = '<?php echo $_G['config']['web']['forum'];?>static/images/common/imglistbg_1.jpg';this.onclick=null;" src="<?php echo $photo['thumburl'];?>" title="<?php echo $photo['filename'];?>" width="112" height="112" _width="112" _height="112" onload="thumbImg(this, 1)" onclick="ajaxalbumlist('<?php echo $photo['url'];?>', <?php echo strlen($photo['url']) + 11; ?>)" /></li>
<?php } ?>
</ul>
</div>
<div class="imglistfy">
<?php echo $multi;?>
</div>
<span class="djaddtz">点击图片添加到帖子内容中</span><?php include template('common/footer_ajax'); ?>