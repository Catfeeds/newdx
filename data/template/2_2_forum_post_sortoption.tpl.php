<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_sortoption', 'common/header');?><?php include template('common/header'); ?><input type="hidden" name="selectsortid" size="45" value="<?php echo $_G['forum_selectsortid'];?>" />
<?php if($_G['forum_typetemplate']) { if($_G['forum']['threadsorts']['expiration'][$_G['forum_selectsortid']]) { ?>
<div class="sinf bw0">
<dl>
<dt><strong class="rq">*</strong>��Ϣ��Ч��</dt>
<dd>
<span class="ftid">
<select name="typeexpiration" tabindex="1" id="typeexpiration">
<option value="259200">3��</option>
<option value="432000">5��</option>
<option value="604800">7��</option>
<option value="2592000">1����</option>
<option value="7776000">3����</option>
<option value="15552000">����</option>
<option value="31536000">1��</option>
</select>
</span>
<?php if($_G['forum_optiondata']['expiration']) { ?><span class="fb">��Ч����: <?php echo $_G['forum_optiondata']['expiration'];?></span><?php } ?>
</dd>
</dl>
</div>
<?php } ?>
<?php echo $_G['forum_typetemplate'];?>
<?php } else { ?>
<table cellspacing="0" cellpadding="0" class="tfm">
<?php if($threaddesc) { ?>
<tr>
<th>����˵��</th>
<td><?php echo $threaddesc;?></td>
</tr>
<?php } if($_G['forum']['threadsorts']['expiration'][$_G['forum_selectsortid']]) { ?>
<tr>
<th>��Ϣ��Ч��</th>
<td>
<span class="ftid">
<select name="typeexpiration" tabindex="1" id="typeexpiration">
<option value="259200">3��</option>
<option value="432000">5��</option>
<option value="604800">7��</option>
<option value="2592000">1����</option>
<option value="7776000">3����</option>
<option value="15552000">����</option>
<option value="31536000">1��</option>
</select>
</span>
<?php if($_G['forum_optiondata']['expiration']) { ?>��Ч����: <?php echo $_G['forum_optiondata']['expiration'];?><?php } ?>
</td>
</tr>
<?php } if(is_array($_G['forum_optionlist'])) foreach($_G['forum_optionlist'] as $optionid => $option) { ?><tr>
<th><?php if($option['required']) { ?><span class="rq">*</span><?php } ?><?php echo $option['title'];?></th>
<td>
<?php if(in_array($option['type'], array('number', 'text', 'email', 'calendar', 'image', 'url', 'range', 'upload', 'range'))) { if($option['type'] == 'calendar') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<input type="text" name="typeoption[<?php echo $option['identifier'];?>]" id="typeoption_<?php echo $option['identifier'];?>" tabindex="1" size="<?php echo $option['inputsize'];?>" onBlur="checkoption('<?php echo $option['identifier'];?>', '<?php echo $option['required'];?>', '<?php echo $option['type'];?>')" value="<?php echo $option['value'];?>" onclick="showcalendar(event, this, false)" <?php echo $option['unchangeable'];?> class="px"/>
<?php } elseif($option['type'] == 'image') { ?>
<dd class="pns">
<button type="button" class="pn" onclick="uploadWindow(function (aid, url){updatesortattach(aid, url, '<?php echo $_G['setting']['attachurl'];?>forum', '<?php echo $option['identifier'];?>')})"><span><?php if($option['value']) { ?>����<?php } else { ?>�ϴ�<?php } ?></span></button>
<input type="hidden" name="typeoption[<?php echo $option['identifier'];?>][aid]" value="<?php echo $option['value']['aid'];?>" id="sortaid_<?php echo $option['identifier'];?>" tabindex="1" />
<?php if($option['value']) { ?><input type="hidden" name="oldsortaid[<?php echo $option['identifier'];?>]" value="<?php echo $option['value']['aid'];?>" tabindex="1" /><?php } ?>
<input type="hidden" name="typeoption[<?php echo $option['identifier'];?>][url]" id="sortattachurl_<?php echo $option['identifier'];?>" <?php if($option['value']['url']) { ?>value="<?php echo $option['value']['url'];?>"<?php } ?> tabindex="1" />
<div id="sortattach_image_<?php echo $option['identifier'];?>" class="ptn">
<?php if($option['value']['url']) { ?>
<a href="<?php echo $option['value']['url'];?>" target="_blank"><img class="spimg" src="<?php echo $option['value']['url'];?>" alt="" /></a>
<?php } ?>
</div>
</dd>
<?php } else { ?>
<input type="text" name="typeoption[<?php echo $option['identifier'];?>]" id="typeoption_<?php echo $option['identifier'];?>" class="px" tabindex="1" size="<?php echo $option['inputsize'];?>" onBlur="checkoption('<?php echo $option['identifier'];?>', '<?php echo $option['required'];?>', '<?php echo $option['type'];?>'<?php if($option['maxnum']) { ?>, '<?php echo $option['maxnum'];?>'<?php } else { ?>, '0'<?php } if($option['minnum']) { ?>, '<?php echo $option['minnum'];?>'<?php } else { ?>, '0'<?php } if($option['maxlength']) { ?>, '<?php echo $option['maxlength'];?>'<?php } ?>)" value="<?php echo $option['value'];?>" <?php echo $option['unchangeable'];?> />
<?php } } elseif(in_array($option['type'], array('radio', 'checkbox', 'select'))) { if($option['type'] == 'select') { ?>
<span class="ftid">
<select name="typeoption[<?php echo $option['identifier'];?>]" id="typeoption_<?php echo $option['identifier'];?>" tabindex="1" <?php echo $option['unchangeable'];?> class="ps"><?php if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><option value="<?php echo $id;?>" <?php echo $option['value'][$id];?>><?php echo $value;?></option>
<?php } ?>
</select>
</span>
<?php } elseif($option['type'] == 'radio') { ?>
<ul class="inlinelist"><?php if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><li><label><input type="radio" name="typeoption[<?php echo $option['identifier'];?>]" id="typeoption_<?php echo $option['identifier'];?>" class="pr" tabindex="1" onclick="checkoption('<?php echo $option['identifier'];?>', '<?php echo $option['required'];?>', '<?php echo $option['type'];?>')" value="<?php echo $id;?>" <?php echo $option['value'][$id];?> <?php echo $option['unchangeable'];?> class="pr"> <?php echo $value;?></label></li>
<?php } ?>
</ul>
<?php } elseif($option['type'] == 'checkbox') { ?>
<ul class="mbm"><?php if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { ?><li><label><input type="checkbox" name="typeoption[<?php echo $option['identifier'];?>][]" id="typeoption_<?php echo $option['identifier'];?>" class="pc" tabindex="1" onclick="checkoption('<?php echo $option['identifier'];?>', '<?php echo $option['required'];?>', '<?php echo $option['type'];?>')" value="<?php echo $id;?>" <?php echo $option['value'][$id][$id];?> <?php echo $option['unchangeable'];?> class="pc"> <?php echo $value;?></label></li>
<?php } ?>
</ul>
<?php } } elseif(in_array($option['type'], array('textarea'))) { ?>
<textarea name="typeoption[<?php echo $option['identifier'];?>]" tabindex="1" id="typeoption_<?php echo $option['identifier'];?>" rows="<?php echo $option['rowsize'];?>" cols="<?php echo $option['colsize'];?>" onBlur="checkoption('<?php echo $option['identifier'];?>', '<?php echo $option['required'];?>', '<?php echo $option['type'];?>', 0, 0<?php if($option['maxlength']) { ?>, '<?php echo $option['maxlength'];?>'<?php } ?>)" <?php echo $option['unchangeable'];?> class="pt"><?php echo $option['value'];?></textarea>
<?php } ?>
 <?php echo $option['unit'];?>
<span id="check<?php echo $option['identifier'];?>"></span>
<?php if($option['maxnum'] || $option['minnum'] || $option['maxlength'] || $option['unchangeable'] || $option['description']) { ?>
<div class="d">
<?php if($option['maxnum']) { ?>
���ֵ <?php echo $option['maxnum'];?>&nbsp;
<?php } if($option['minnum']) { ?>
��Сֵ <?php echo $option['minnum'];?>&nbsp;
<?php } if($option['maxlength']) { ?>
��󳤶� <?php echo $option['maxlength'];?>&nbsp;
<?php } if($option['unchangeable']) { ?>
�����޸�&nbsp;
<?php } if($option['description']) { ?>
<?php echo $option['description'];?>
<?php } ?>
</div>
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
<?php } ?>

<script type="text/javascript">
var CHECKALLSORT = false;
function checkoption(identifier, required, checktype, checkmaxnum, checkminnum, checkmaxlength) {
if(checktype != 'image' && !$('typeoption_' + identifier) || !$('check' + identifier)) {
return true;
}
var ce = $('check' + identifier);
ce.innerHTML = '';
if(checktype == 'image') {
var checkvalue = $('sortaid_' + identifier).value;
} else {
var checkvalue = $('typeoption_' + identifier).value;
}
if(required != '0') {
if(checkvalue == '') {
warning(ce, '������Ŀû����д��');
return false;
} else {
ce.innerHTML = '<img src="<?php echo IMGDIR;?>/check_right.gif" width="16" height="16" class="vm" />';
}
}

if(checkvalue) {
if((checktype == 'number' || checktype == 'range') && isNaN(checkvalue)) {
warning(ce, '������д����ȷ');
return false;
} else if(checktype == 'email' && !(/^[\-\.\w]+@[\.\-\w]+(\.\w+)+$/.test(checkvalue))) {
warning(ce, '�ʼ���ַ����ȷ');
return false;
} else if((checktype == 'text' || checktype == 'textarea') && checkmaxlength != '0' && mb_strlen(checkvalue) > checkmaxlength) {
warning(ce, '��д��Ŀ���ȹ���');
return false;
} else if((checktype == 'number' || checktype == 'range')) {
if(checkmaxnum != '0' && parseInt(checkvalue) > parseInt(checkmaxnum)) {
warning(ce, '�����������ֵ');
return false;
} else if(checkminnum != '0' && parseInt(checkvalue) < parseInt(checkminnum)) {
warning(ce, 'С��������Сֵ');
return false;
}
} else {
ce.innerHTML = '<img src="<?php echo IMGDIR;?>/check_right.gif" width="16" height="16" class="vm" />';
}
}
return true;
}

function warning(obj, msg) {
obj.style.display = '';
obj.innerHTML = '<img src="<?php echo IMGDIR;?>/check_error.gif" width="16" height="16" class="vm" /> ' + msg;
obj.className = "warning";
if(CHECKALLSORT) {
showDialog(msg);
}
}
function validateextra() {
CHECKALLSORT = true;<?php if(is_array($_G['forum_optionlist'])) foreach($_G['forum_optionlist'] as $optionid => $option) { ?>if(!checkoption('<?php echo $option['identifier'];?>', '<?php echo $option['required'];?>', '<?php echo $option['type'];?>')) {
return false;
}
<?php } ?>
return true;
}

<?php if($_G['forum']['threadsorts']['expiration'][$_G['forum_selectsortid']]) { ?>
simulateSelect('typeexpiration');
<?php } if(is_array($_G['forum_optionlist'])) foreach($_G['forum_optionlist'] as $optionid => $option) { ?>if('<?php echo $option['type'];?>' == 'select') {
simulateSelect('typeoption_<?php echo $option['identifier'];?>', '<?php echo $option['inputsize'];?>');
}
<?php } ?>

</script><?php include template('common/footer'); ?>