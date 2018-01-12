<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(is_array($attachlist)) foreach($attachlist as $attach) { ?><script class="needdelete">
addattachlist("{aid: <?php echo $attach['aid'];?>, filename: '<?php echo $attach['filename'];?>', uploadtime: '<?php echo $attach['dateline'];?>', readperm: <?php echo $attach['readperm'];?>, descr: '<?php echo $attach['description'];?>', old :<?php if($attachused) { ?>0<?php } else { ?>1<?php } ?>}");
</script> 
<?php } ?>
<script>
jQuery.noConflict();
;(function($){
function removeallscript(){
$('script.needdelete').remove();
}
setTimeout(removeallscript, 15000);
})(jQuery);
</script>