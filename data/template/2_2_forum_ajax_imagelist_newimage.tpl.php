<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($imagelist) { ?><?php $i = 0; ?><table class="imgl" style="width: 190px;"><tr><?php if(is_array($imagelist)) foreach($imagelist as $image) { ?><?php $i++; ?><td valign="bottom" id="image_td_<?php echo $image['aid'];?>" style="width:50%;padding:0px;margin:0px;">
            <a href="javascript:;" class="delimg_icon" onclick="delImgAttach(<?php echo $image['aid'];?>,<?php if(!$attach['pid']) { ?>1<?php } else { ?>0<?php } ?>)" style="visibility: hidden;float:right;background:url('../../static/image/common/op.png') no-repeat scroll 0 -2px transparent;height:20px;width:20px;cursor: pointer;position: relative;left:-42px;z-index:999;"></a>
<?php if($_G['fid']==437 ) { ?>
<a href="javascript:;" title="<?php echo $image['filename'];?>"><img src="<?php echo getimagethumb(300 ,300 ,1 ,$image['dir'].'/'.$image['attachment'],$image['aid'],$image['serverid']);; ?>" id="image_<?php echo $image['aid'];?>" onclick="insertAttachimgTagAtZb('<?php echo $image['aid'];?>');" style='max-width:120px;max-height:120px;' /></a>			
<?php } else { ?>
<a href="javascript:;" title="<?php echo $image['filename'];?>"><img src="<?php echo getimagethumb(300 ,300 ,1 ,$image['dir'].'/'.$image['attachment'],$image['aid'],$image['serverid']);; ?>" id="image_<?php echo $image['aid'];?>" onclick="insertAttachimgTag('<?php echo $image['aid'];?>');" style='max-width:120px;max-height:120px;' /></a>
<?php } ?>
<p class="imgf" style="width: 100px;margin:0;padding:0;">
<!--<a href="javascript:;" onclick="delImgAttach(<?php echo $image['aid'];?>,<?php if(!$attach['pid']) { ?>1<?php } else { ?>0<?php } ?>)" class="d" style='float:left;'>É¾³ý</a>-->
<?php if($image['description']) { ?>
<input style="display: none;" type="text" name="attachnew[<?php echo $image['aid'];?>][description]" class="px xg2" value="<?php echo $image['description'];?>" id="image_desc_<?php echo $image['aid'];?>" />
<?php } else { ?>
<input style="display: none;" type="text" class="px xg2" value="ÃèÊö" onclick="this.style.display='none';$('image_desc_<?php echo $image['aid'];?>').style.display='';$('image_desc_<?php echo $image['aid'];?>').focus();" />
<input style="display: none;" type="text" name="attachnew[<?php echo $image['aid'];?>][description]" class="px" style="display: none" id="image_desc_<?php echo $image['aid'];?>" />
<?php } ?>
</p><p style="height: 5px;"></p>
<?php if($_G['group']['allowupload']) { ?>
<!--<p>-->
                <?php if(!$attach['pid']) { ?><input type="hidden" class="pc" id="albumaid_<?php echo $image['aid'];?>" name="albumaid[]" value="" />
                <label for="albumaidchk_<?php echo $image['aid'];?>">
                    <input id="albumaidchk_<?php echo $image['aid'];?>" style="display: none;" type="checkbox" class="pc" onclick="$('albumaid_<?php echo $image['aid'];?>').value=this.checked?this.value:''" value="<?php echo $image['aid'];?>" />
                </label>
                    <?php } ?>
                <!--</p>-->
<?php } ?>
</td>
<?php if($i % 1 == 0 && isset($imagelist[$i])) { ?></tr><tr><?php } } if(($imgpad = $i % 1) > 0) { echo str_repeat('<td width="50%"></td>', 1 - $imgpad);; } ?>
</tr></table>
<?php if($_G['inajax']) { ?>
<script type="text/javascript" reload="1">
ATTACHNUM['imageunused'] += <?php echo count($imagelist); ?>;
updateattachnum('image');
</script>
<?php } } ?>