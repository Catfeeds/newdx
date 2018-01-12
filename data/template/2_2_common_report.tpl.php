<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('report', 'common/header');?><?php include template('common/header'); if($_G['gp_is_uc']) { ?>
<form method="post" autocomplete="off" id="form_<?php echo $_G['gp_handlekey'];?>" name="form_<?php echo $_G['gp_handlekey'];?>" action="misc.php?mod=report&amp;is_uc=1" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'form_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox" style="width:345px;">
<div class="flb">
<div class="popbox_title clearfix">
<span>举报</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="albumform" style="width:90%;margin:0 auto;">
<li>
<label style="text-align:left;width:auto;">举报理由：</label>
<a onclick="showselect(this, 'message', 'reasonselect')" href="javascript:;" style="float:none;border:1px solid #666;">^</a>
<ul id="reasonselect" style="display:none;"><?php echo modreasonselect(); ?></ul>	
</li>					
<li>
<textarea id="message" name="message" class="pt" onkeydown="ctrlEnter(event, 'reportsubmit', 1);" onkeyup="strLenCalc(this, 'checklen');" rows="8" style="width:100%;"></textarea>

<div class="dhinfo" style="text-align:left;margin-top:15px;">
<span>还可输入 <strong id="checklen">200</strong> 个字符</span>
</div>		
</li>
<li>
<button type="submit" name="reportsubmit" value="true" class="button_confirm" id="reportsubmit">确定</button>
</li>
</ul>
</div>
</div>

<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="reportsubmit" value="true" />
<input type="hidden" name="rtype" value="<?php echo $_G['gp_rtype'];?>" />
<input type="hidden" name="rid" value="<?php echo $_G['gp_rid'];?>" />
<input type="hidden" name="url" value="<?php echo $_G['gp_url'];?>" />
<input type="hidden" name="inajax" value="<?php echo $_G['inajax'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>
</form>
<?php } else { ?>
<h3 class="flb">
<em>举报</em>
<span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span>
</h3>
<form method="post" autocomplete="off" id="form_<?php echo $_G['gp_handlekey'];?>" name="form_<?php echo $_G['gp_handlekey'];?>" action="misc.php?mod=report" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'form_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="reportsubmit" value="true" />
<input type="hidden" name="rtype" value="<?php echo $_G['gp_rtype'];?>" />
<input type="hidden" name="rid" value="<?php echo $_G['gp_rid'];?>" />
<input type="hidden" name="url" value="<?php echo $_G['gp_url'];?>" />
<input type="hidden" name="inajax" value="<?php echo $_G['inajax'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c" id="return_<?php echo $_G['gp_handlekey'];?>">
<div class="tpclg">
<h4 class="cl">
<span class="z">举报理由:</span>
<a onclick="showselect(this, 'message', 'reasonselect')" class="dpbtn" href="javascript:;">^</a>
</h4>
<p>
<textarea id="message" name="message" class="pt" onkeydown="ctrlEnter(event, 'reportsubmit', 1);" onkeyup="strLenCalc(this, 'checklen');" rows="8"></textarea>
</p>
<ul id="reasonselect" style="display: none"><?php echo modreasonselect(); ?></ul>
</div>
</div>
<p class="o pns">
<span class="z">还可输入 <strong id="checklen">200</strong> 个字符</span>
<button type="submit" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<?php } include template('common/footer'); ?>