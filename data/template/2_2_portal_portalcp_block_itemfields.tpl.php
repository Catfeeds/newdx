<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(is_array($theclass['fields'])) foreach($theclass['fields'] as $fieldname => $field) { ?><tr<?php if(empty($showfields[$fieldname])) { ?> style="display:none;"<?php } ?>>
<th><?php echo $field['name'];?></th>
<td>
<?php if($field['formtype']=='title') { ?>
<input type="text" name="title" value="<?php echo $itemfields['title'];?>" class="px" />
<div class="ss">
<em <?php echo $showstylearr['title_b'];?> id="span_title_b"  onclick="block_showstyle('title_b')">B</em>
<input type="hidden" id="value_title_b" name="showstyle[title_b]" value="<?php echo $blockitem['showstyle']['title_b'];?>" />
<em <?php echo $showstylearr['title_i'];?> id="span_title_i"  onclick="block_showstyle('title_i')"><i>I</i></em>
<input type="hidden" id="value_title_i" name="showstyle[title_i]" value="<?php echo $blockitem['showstyle']['title_i'];?>" />
<em <?php echo $showstylearr['title_u'];?> id="span_title_u"  onclick="block_showstyle('title_u')">U</em>
<input type="hidden" id="value_title_u" name="showstyle[title_u]" value="<?php echo $blockitem['showstyle']['title_u'];?>" />
<input size="6" id="title_color_value" type="text" name="showstyle[title_c]" value="<?php echo $blockitem['showstyle']['title_c'];?>" />
<input id="ctitlepb" onclick="createPalette('titlepb', 'title_color_value');" type="button" class="colorwd" value="" style="background: <?php echo $blockitem['showstyle']['title_c'];?>">
</div>
<?php } elseif($field['formtype']=='summary') { ?>
<textarea name="summary" class="pt"><?php echo $itemfields['summary'];?></textarea>
<div class="ss">
<em <?php echo $showstylearr['summary_b'];?> id="span_summary_b"  onclick="block_showstyle('summary_b')">B</em>
<input type="hidden" id="value_summary_b" name="showstyle[summary_b]" value="<?php echo $blockitem['showstyle']['summary_b'];?>" />
<em <?php echo $showstylearr['summary_i'];?> id="span_summary_i"  onclick="block_showstyle('summary_i')"><i>I</em>
<input type="hidden" id="value_summary_i" name="showstyle[summary_i]" value="<?php echo $blockitem['showstyle']['summary_i'];?>" />
<em <?php echo $showstylearr['summary_u'];?> id="span_summary_u"  onclick="block_showstyle('summary_u')">U</em>
<input type="hidden" id="value_summary_u" name="showstyle[summary_u]" value="<?php echo $blockitem['showstyle']['summary_u'];?>" />
<input size="6" id="summary_color_value" type="text" name="showstyle[summary_c]" value="<?php echo $blockitem['showstyle']['summary_c'];?>" />
<input id="csummarypb" onclick="createPalette('summarypb', 'summary_color_value');" type="button" class="colorwd" value="" style="background: <?php echo $blockitem['showstyle']['summary_c'];?>">
</div>
<?php } elseif($field['formtype'] == 'textarea') { ?>
<textarea name="<?php echo $fieldname;?>"><?php echo $itemfields[$fieldname];?></textarea>
<?php } elseif($field['formtype'] == 'pic') { ?>
<input type="radio" class="pr" id="picway_remote" name="picway" onclick="showpicedit()" checked="checked" /><label for="picway_remote">远程</label> &nbsp;
<input type="radio" class="pr" id="picway_upload" name="picway" onclick="showpicedit()" /><label for="picway_upload">上传</label><br />
<input type="text" name="pic" class="px" id="pic_remote" value="<?php echo $itemfields['pic'];?>" style="display: block" />
<input type="hidden" name="picflag" value="<?php echo $itemfields['picflag'];?>" />
<input type="file" name="pic" class="pf" id="pic_upload" style="display: none" />
<?php if($itemfields['pic']) { ?>
<br />
<a href="<?php echo $itemfields['pic'];?>" target="_blank" title="查看原图"><img src="<?php if($itemfields['thumbpic']) { ?><?php echo $itemfields['thumbpic'];?><?php } else { ?><?php echo $itemfields['pic'];?><?php } ?>" alt="" width="80" height="80" /></a>
<?php } } elseif($field['formtype'] == 'date') { ?>
<input type="text" class="px" name="<?php echo $fieldname;?>" value="<?php echo $itemfields[$fieldname];?>" onclick="showcalendar(event, this, true)" />
<?php } else { ?>
<input type="text" class="px" name="<?php echo $fieldname;?>" value="<?php echo $itemfields[$fieldname];?>" />
<?php } ?>
</td>
</tr>
<?php } ?>