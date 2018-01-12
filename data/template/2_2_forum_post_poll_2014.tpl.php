<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<input type="hidden" name="polls" value="yes" />
<div class="t_a_x clboth">
<div class="tq_l">
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>" />
<?php if($_G['gp_action'] == 'newthread') { ?>
<input type="hidden" name="tpolloption" value="1" />
<div class="tq_cz clboth">
<span class="tq_cz_r"><input id="pollchecked" type="checkbox" class="c_b" onclick="switchpollm(1)" /><label class="f_12_l" for="pollchecked">单框模式</label></span>
<span class="tq_cz_l">最多可填写 <?php echo $_G['setting']['maxpolloptions'];?> 个选项</span>
</div>
<div id="pollm_c_1" class="tq_box clboth">
<span id="polloption_new"></span>
<a href="javascript:;" class="tq_add_button" onclick="addpolloption()">+增加一项</a>
<p id="polloption_hidden" style="display: none">
<a href="javascript:;" class="d" onclick="delpolloption(this)">del</a>
<input type="text" name="polloption[]" class="px" autocomplete="off" tabindex="1" />
</p>
</div>
<div id="pollm_c_2" style="display:none">
<textarea name="polloptions" tabindex="1" rows="6" onchange="switchpollm(0)" /></textarea>
<p class="cl">每行填写 1 个选项</p>
</div>
<?php } else { ?>
<div id="pollm_c_1" class="tq_box clboth edited"><?php if(is_array($poll['polloption'])) foreach($poll['polloption'] as $key => $option) { ?><p>
<input type="hidden" name="polloptionid[<?php echo $poll['polloptionid'][$key];?>]" value="<?php echo $poll['polloptionid'][$key];?>" />
<input type="text" name="displayorder[<?php echo $poll['polloptionid'][$key];?>]" class="px onum pxs" autocomplete="off" tabindex="1" value="<?php echo $poll['displayorder'][$key];?>" />
<input type="text" name="polloption[<?php echo $poll['polloptionid'][$key];?>]" class="px" autocomplete="off" tabindex="1" value="<?php echo $option;?>"<?php if(!$_G['group']['alloweditpoll']) { ?> readonly="readonly"<?php } ?> />
</p>
<?php } ?>
<span id="polloption_new"></span>
<p id="polloption_hidden" style="display: none">
<a href="javascript:;" class="d" onclick="delpolloption(this)">del</a>
<input type="text" name="displayorder[]" class="px onum pxs" autocomplete="off" tabindex="1" />
<input type="text" name="polloption[]" class="px" autocomplete="off" tabindex="1" />
</p>
<a href="javascript:;" class="tq_add_button" onclick="addpolloption()">+增加一项</a>
</div>
<?php } ?>
</div>
<div class="tq_r">
<ul class="tq_rcon">
<li>
<label for="maxchoices"><span>最多可选</span></label>
<input name="maxchoices" id="maxchoices" type="text" class="tq_sr" value="<?php if($_G['gp_action'] == 'edit' && $poll['maxchoices']) { ?><?php echo $poll['maxchoices'];?><?php } else { ?>1<?php } ?>" tabindex="1" /><em>项</em>
</li>
<li>
<label for="expirationchecked"><span>记票天数</span></label>
<input name="expiration" id="polldatas" type="text" class="tq_sr" value="<?php if($_G['gp_action'] == 'edit') { if(!$poll['expiration']) { ?>0<?php } elseif($poll['expiration'] < 0) { ?>关闭投票<?php } elseif($poll['expiration'] < TIMESTAMP) { ?>已结束<?php } else { echo (round(($poll['expiration'] - TIMESTAMP) / 86400)); } } ?>" tabindex="1" /><em>天</em>
</li>
<li>
<span class="tq_fx"><input id="visibilitypoll" name="visibilitypoll" type="checkbox" value="1"<?php if($_G['gp_action'] == 'edit' && !$poll['visible']) { ?> checked<?php } ?> tabindex="1" class="c_b" /><label for="visibilitypoll" class="f_12_l">投票后结果可见</label></span>
<span><input id="overt" name="overt" type="checkbox" value="1"<?php if($_G['gp_action'] == 'edit' && $poll['overt']) { ?> checked<?php } ?> tabindex="1" class="c_b" /><label for="overt" class="f_12_l">公开投票参与人</label></span>
</li>
</ul>
</div>
</div>

<script type="text/javascript" reload="1">
var maxoptions = parseInt('<?php echo $_G['setting']['maxpolloptions'];?>');
<?php if($_G['gp_action'] == 'newthread') { ?>
var curoptions = 0;
addpolloption();
addpolloption();
addpolloption();
<?php } else { ?>
var curoptions = <?php echo count($poll['polloption']); ?>;
<?php } ?>
</script>