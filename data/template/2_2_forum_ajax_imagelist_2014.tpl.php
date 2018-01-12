<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($imagelist) { if(is_array($imagelist)) foreach($imagelist as $image) { ?><script class="needdelete">
uploadsuccess(1, "{type: '<?php echo $image['dir'];?>', pic:'<?php echo $image['attachment'];?>', aid:<?php echo $image['aid'];?>, fileid:'<?php echo $image['aid'];?>', filename:'<?php echo $image['filename'];?>', thumbpic:'<?php echo getimagethumb(112, 112, 2, $image[dir] . '/' . $image[attachment], $image[aid], $image[serverid]); ?>', bigthumbpic:'<?php echo getimagethumb(300, 300, 1, $image[dir] . '/' . $image[attachment], $image[aid], $image[serverid]); ?>'}");
</script>
<?php } ?>
<script>
jQuery.noConflict();
;(function($){
function removeallscript(){
$('script.needdelete').remove();
}
setTimeout(removeallscript, 15000);
$('#uploadimagelist').parent().scrollTop(0);
})(jQuery);
</script>
<?php } ?>