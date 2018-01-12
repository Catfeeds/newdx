<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
block_get('6873');?>
<?php if($imagelist) { if(is_array($imagelist)) foreach($imagelist as $image) { ?><script class="getimagelist_ajax">
uploadsuccess(2, '{filename:"<?php echo $image['filename'];?>", aid:<?php echo $image['aid'];?>, fileid:<?php echo $image['aid'];?>, type:"forum", pic:"<?php echo $image['attachment'];?>", thumbpic:"<?php echo getimagethumb(100, 100, 2, 'forum/' . $image[attachment], $image[aid], $image[serverid]); ?>"}');
jQuery.noConflict();
;(function($){
var value = loadUserdata('descrip_image_<?php echo $image['aid'];?>');
if(value != '' && value != null)
{
$('#watting_' + <?php echo $image['aid'];?>).find('textarea.textshow').val(value).show().addClass('attachshows').end().find('textarea.texttips').removeClass('attachshows').hide();
}
})(jQuery);
</script>
<?php } ?>
<script class="getimagelist_ajax">$('img_num').innerHTML = '<?php echo $nowpicnum;?>';$('img_sy').innerHTML = '<?php echo $canpicnum;?>';$('pic_tools_tips').style.display = 'block';</script>
<?php } else { ?>
<!--此处修改调取模块的名称,修改时同时修改下面两个数字--><?php block_display('6873'); ?><script class="getimagelist_ajax">$('portal_block_6873').className = 'needdelete';</script>
<?php } ?>
<script>
jQuery.noConflict();
;(function($){
function removeallscript(){
$('.getimagelist_ajax').remove();
$('#append_parent script').remove();
}
setTimeout(removeallscript, 5000);
})(jQuery);
</script>