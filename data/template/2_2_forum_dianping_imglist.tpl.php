<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($imglist) { ?><?php $i = $j = 0; if(is_array($imglist)) foreach($imglist as $img) { ?><?php $i++; if($i <= $imgselectlimit) { ?><?php $j++; ?><span id="imagelist_id_<?php echo $img['aid'];?>">
<img src="<?php echo getimagethumb(60,60,2,$dir . '/'.$img['attachment'], $img['aid'], $img['serverid']); ?>"/>
<!--<img src="<?php echo $img['url'];?><?php echo $img['attachment'];?>" />--><b class="deleteimg">É¾³ý</b>
<input type="hidden" name="imgselect[]" value="<?php echo $img['aid'];?>"/>
</span>
<?php } else { ?>
<span class="overlimit" id="imagelist_id_<?php echo $img['aid'];?>">
<img src="<?php echo getimagethumb(60,60,2,$dir . '/'.$img['attachment'], $img['aid'], $img['serverid']); ?>"/>
<!--<img src="<?php echo $img['url'];?><?php echo $img['attachment'];?>" />--><b class="deleteimg">É¾³ý</b>
<input type="hidden" disabled = "true" name="imgselect[]" value="<?php echo $img['aid'];?>"/>
</span>
<?php } } ?>
<script>$('numimage').value = <?php echo $j;?>;</script>
<?php } ?>