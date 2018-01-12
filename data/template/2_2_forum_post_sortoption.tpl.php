<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_sortoption', 'common/header');?><?php include template('common/header'); ?><input type="hidden" name="selectsortid" size="45" value="<?php echo $_G['forum_selectsortid'];?>" />
<?php if($_G['forum_typetemplate']) { if($_G['forum']['threadsorts']['expiration'][$_G['forum_selectsortid']]) { ?>
<div class="sinf bw0">
<dl>
<dt><strong class="rq">*</strong>信息有效期</dt>
<dd>
<span class="ftid">
<select name="typeexpiration" tabindex="1" id="typeexpiration">
<option value="259200">3天</option>
<option value="432000">5天</option>
<option value="604800">7天</option>
<option value="2592000">1个月</option>
<option value="7776000">3个月</option>
<option value="15552000">半年</option>
<option value="31536000">1年</option>
</select>
</span>
<?php if($_G['forum_optiondata']['expiration']) { ?><span class="fb">有效期至: <?php echo $_G['forum_optiondata']['expiration'];?></span><?php } ?>
</dd>
</dl>
</div>
<?php } ?>
<?php echo $_G['forum_typetemplate'];?>
<?php } else { ?>
<table cellspacing="0" cellpadding="0" class="tfm">
<?php if($threaddesc) { ?>
<tr>
<th>发帖说明</th>
<td><?php echo $threaddesc;?></td>
</tr>
<?php } if($_G['forum']['threadsorts']['expiration'][$_G['forum_selectsortid']]) { ?>
<tr>
<th>信息有效期</th>
<td>
<span class="ftid">
<select name="typeexpiration" tabindex="1" id="typeexpiration">
<option value="259200">3天</option>
<option value="432000">5天</option>
<option value="604800">7天</option>
<option value="2592000">1个月</option>
<option value="7776000">3个月</option>
<option value="15552000">半年</option>
<option value="31536000">1年</option>
</select>
</span>
<?php if($_G['forum_optiondata']['expiration']) { ?>有效期至: <?php echo $_G['forum_optiondata']['expiration'];?><?php } ?>
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
<button type="button" class="pn" onclick="uploadWindow(function (aid, url){updatesortattach(aid, url, '<?php echo $_G['setting']['attachurl'];?>forum', '<?php echo $option['identifier'];?>')})"><span><?php if($option['value']) { ?>更新<?php } else { ?>上传<?php } ?></span></button>
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
最大值 <?php echo $option['maxnum'];?>&nbsp;
<?php } if($option['minnum']) { ?>
最小值 <?php echo $option['minnum'];?>&nbsp;
<?php } if($option['maxlength']) { ?>
最大长度 <?php echo $option['maxlength'];?>&nbsp;
<?php } if($option['unchangeable']) { ?>
不可修改&nbsp;
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
warning(ce, '必填项目没有填写。');
return false;
} else {
ce.innerHTML = '<img src="<?php echo IMGDIR;?>/check_right.gif" width="16" height="16" class="vm" />';
}
}

if(checkvalue) {
if((checktype == 'number' || checktype == 'range') && isNaN(checkvalue)) {
warning(ce, '数字填写不正确');
return false;
} else if(checktype == 'email' && !(/^[\-\.\w]+@[\.\-\w]+(\.\w+)+$/.test(checkvalue))) {
warning(ce, '邮件地址不正确');
return false;
} else if((checktype == 'text' || checktype == 'textarea') && checkmaxlength != '0' && mb_strlen(checkvalue) > checkmaxlength) {
warning(ce, '填写项目长度过长');
return false;
} else if((checktype == 'number' || checktype == 'range')) {
if(checkmaxnum != '0' && parseInt(checkvalue) > parseInt(checkmaxnum)) {
warning(ce, '大于设置最大值');
return false;
} else if(checkminnum != '0' && parseInt(checkvalue) < parseInt(checkminnum)) {
warning(ce, '小于设置最小值');
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