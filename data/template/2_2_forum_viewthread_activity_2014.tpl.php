<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style type="text/css">
.activitymessage{position: relative;overflow:hidden;}
.activitymessage h3{width: 125px;float: left;font-size: 18px;color: #585858;}
.activitymessage .ui-title-icon {width: 26px;height: 26px;float: left;margin-right: 10px;background: url(http://static.8264.com/static/images/forum/activity/mXTxKl-26-289.png) no-repeat;}
.activitymessage .ui-tInfo-icon {background-position: 0 -70px;}
.activitymessage .ui-tTrip-icon {background-position: 0 -111px;}
.activitymessage .ui-tPrice-icon {background-position: 0 -152px;}
.activitymessage .ui-tEquip-icon {background-position: 0 -193px;}
.activitymessage .ui-tNotice-icon {background-position: 0 -234px;}
.activitymessage .dotted-line{display: inline-block;width: 700px;height: 2px;background: url(http://static.8264.com/static/images/forum/activity/dotted-icon.png) repeat-x;vertical-align: middle;}
.activitymessage .message{clear:both;margin:20px 0 40px;}
</style>
<div class="clboth mb16">
<div class="actionimg">
<div class="actionimgcon">
<?php if($activity['thumb']) { ?>
<a href="javascript:;"><img src="<?php echo $activity['thumb'];?>" onclick="zoom(this, '<?php echo $activity['attachurl'];?>')" /></a>
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/nophoto.gif" />
<?php } ?>
</div>
<div class="adbx"><a href="http://bx.8264.com/?bbsbxnewcon" target="_blank" title="8264户外保险频道"><img src="http://image1.8264.com/guanggao/bbs/2013/08/bx.jpg" alt="8264户外保险频道" /></a></div>
</div>
<div class="actioncon">
<h3><?php echo $activity['class'];?>
<?php if($post['invisible'] == 0 && ($_G['forum_thread']['authorid'] == $_G['uid'] || (in_array($_G['group']['radminid'], array(1, 2)) && $_G['group']['alloweditactivity']) || ( $_G['group']['radminid'] == 3 && $_G['forum']['ismoderator'] && $_G['group']['alloweditactivity']))) { ?>
<a href="misc.php?mod=invite&amp;action=thread&amp;id=<?php echo $_G['tid'];?>" onclick="showWindow('invite', this.href, 'get', 0);">邀请</a>
                <?php if(($_G['uid'] != $activity['uid']) && ((in_array($_G['group']['radminid'], array(1, 2)) && $_G['group']['alloweditactivity']) || ( $_G['group']['radminid'] == 3 && $_G['forum']['ismoderator'] && $_G['group']['alloweditactivity']))) { ?>
                <a href="forum.php?mod=misc&amp;action=activityapplylist&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('activity', this.href, 'get', 0)" title="管理">管理</a>
                <?php } else { ?>
<a href="http://hd.8264.com/index.php?app=my_manage&amp;act=bbshd&amp;mhash=<?php echo $manageauth;?>" title="管理" target="_blank">管理</a>
                <?php } ?>
                <a href="forum.php?mod=misc&amp;action=activityexport&amp;tid=<?php echo $_G['tid'];?>" title="导出">导出</a>
<?php } ?>
</h3>
<?php if($activity['cost']) { ?><b class="jg">￥<?php echo $activity['cost'];?>/<span>人</span></b><?php } ?>
<ul class="actioninfo">
<li><span>开始时间：</span><em><?php if($activity['starttimeto']) { ?><?php echo $activity['starttimefrom'];?> 至 <?php echo $activity['starttimeto'];?> 商定<?php } else { ?><?php echo $activity['starttimefrom'];?><?php } ?></em></li>
<li><span>活动地点：</span><em><?php echo $activity['place'];?></em></li>
<li><span>集合地点：</span><em><?php echo $activity['collectplace'];?></em></li>
<li style="display: none;">
<span>性<span style="visibility:hidden;">性别</span>别：</span>
<em><?php if($activity['gender'] == 1) { ?>男<?php } elseif($activity['gender'] == 2) { ?>女<?php } else { ?>不限<?php } ?></em>
</li>
<li>
<span>活动性质：</span>
<em style="margin-left: -7px;"><?php if($activity['nature'] == 1) { ?>AA<?php } elseif($activity['nature'] == 2) { ?>商业<?php } else { ?>未选择<?php } ?></em>
</li>
<?php if($activity['expiration']) { ?>
<li><span>报名截止：</span><em><?php echo $activity['expiration'];?></em></li>
<?php } ?>
</ul>

<?php if(!$_G['forum_thread']['is_archived']) { ?>
<div class="bmnum">
<?php if($activity['number'] || $allapplynum != 0) { ?>
<span class="bm">
<b><?php echo $allapplynum;?></b>
<em>报名人数</em>
</span>
<?php } if($activity['number']) { ?>
<span class="sy">
<b><?php echo $aboutmembers;?></b>
<em>剩余名额</em>
</span>
<?php } ?>
</div>

<div class="clboth"></div>
<div class="option-wrap">
<a href="javascript:;" class="goverbutton159_43"></a>
<?php if($post['invisible'] == 0) { if($applied && $isverified < 2) { if(!$activityclose) { ?>
<a href="javascript:;" class="qxbmbutton159_43" onclick="showDialog($('activityjoincancel').innerHTML, 'info', '取消报名')"></a>
<?php } ?>
<p class="xg1 xs1" style="padding: 10px 0px;"><?php if(!$isverified) { ?>你的加入申请已发出，请等待发起者审批<?php } else { ?>你已经参加了此活动<?php } ?></p>
<?php } elseif(!$activityclose) { if($isverified != 2) { if(!$activity['number'] || $aboutmembers > 0) { ?>
<a href="javascript:;" class="bmbutton159_43" onclick="<?php if($_G['uid']) { ?>showDialog($('activityjoin').innerHTML, 'info', '我要参加')<?php } else { ?>showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')<?php } ?>"></a>
<?php } } else { ?>
<a href="javascript:;" onclick="showDialog($('activityjoin').innerHTML, 'info', '完善资料')" class="wszlbutton159_43"></a>
<?php } } } ?>
<!-- <a href="#" class="bmbutton159_43"></a> -->

<?php } if($activity['mobile']&&!$activityclose) { ?>
<a href="javascript:void(0);" class="cons-link">立即咨询</a>
<?php } ?>
</div>
</div>

<script type="text/javascript">
function checkform(theform) {
if (theform.message.value.length > 200) {
alert('你的留言超过 200 个字符的限制。');
theform.message.focus();
return false;
}
return true;
}
</script>	
</div>

<style type="text/css">
.option-wrap{position: relative;}
.cons-link{position:absolute;left:185px;top:12px;color:#2679aa;font-size:14px;text-decoration:underline!important;font-family:"微软雅黑"}
.modal-backdrop{background-color:#000;bottom:0;left:0;position:fixed;right:0;top:0;z-index:1030}
.modal-backdrop.in{opacity:.7;filter:alpha(opacity=70)}
.modal-tpl{position:fixed;_position:absolute;top:0;right:0;bottom:0;left:0;outline:0 none;overflow-x:hidden;overflow-y:auto;font-family:"微软雅黑";display:none;z-index:1040}
.modal-tpl .modal-dialog{width:582px;background-color:#fff;margin:50px auto;padding:0 0 35px;border-radius:3px;}
.dialog-header{position:relative;height:26px;line-height:26px;padding:10px 0;background-color:#f4f4f4;border-radius:3px 3px 0 0;}
.dialog-header .dialog-close{position:absolute;text-indent:-999em;width:15px;height:15px;background:url(http://static.8264.com/static/images/tps/v1/close-x.png) no-repeat;right:20px;top:16px;}
.dh-title{font-size:16px;color:#949494;float:left;padding-left:20px;font-weight:normal;}
.check-form{margin-top:30px}
.check-form .form-group{margin-bottom:13px}
.check-form .form-group .control-label{width:155px;text-align:right;padding-right:14px;font-weight:normal;color:#666;float:left;line-height:34px;font-size:14px;}
.check-form .form-group input[type="text"]{border:1px solid #dfdfdf;box-shadow:0 2px 2px rgba(0, 0, 0, .03) inset;padding:6px 8px;width:280px;height:20px;font-size:14px;}
.check-action{padding-left:169px;margin-top:20px}
.check-action .check-submit{background-color:#f87354;color:#fff;display:block;font-size:14px;height:38px;line-height:38px;position:relative;text-align:center;width:102px;border-radius:3px}
.controls-option{height:36px;}
.controls-option label{margin:0;float:left;}
.controls-option .radio-box{font-weight:normal;display:block;font-size:14px;margin-right:9px;position:relative;vertical-align:middle;border:1px solid #cfcfcf;height:34px;color:#333;outline:0 none;border-radius:1px;line-height:34px;width:54px;text-align:center;}
.controls-option .selected .radio-box{background:#fff;border:2px solid #58b1e5;color:#333;height:32px;line-height:32px;width:52px;}
.controls-option .radio-box .icon-check{height:18px;line-height:14px;width:20px;background:url(http://static.8264.com/static/images/tps/v1/element.png) no-repeat;position:absolute;right:0;top:0;display:none;}
.controls-option .selected .icon-check{display:block;}
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
$("#mode-select-list label").click(function() {
$(this).addClass("selected").siblings().removeClass("selected");
var text = $(this).find(".radio-box").text();
var node = $(this).parents(".form-group").next();
node.find(".control-label").text(text);
node.find("input").attr({placeholder: "请输入"+text+"号"});
var type = $(this).find(".radio-box").attr('type');
$("#contacts_mobile").attr("name",type);
});
$(".cons-link").click(function() {
J_openCheckForm();
});
jQuery("#J_closeCheckForm").click(function() {
J_closeCheckForm();
});
function J_openCheckForm(){
jQuery("body").css({"padding-right":"16px","overflow":"hidden"});
jQuery("body").append("<div class='modal-backdrop in'></div>");
var _mgAuto = (jQuery(window).height() - 470) / 2;
_mgAuto < 0 ? _mgAuto=100 : _mgAuto;
jQuery(".modal-dialog").css({"margin-top": _mgAuto,"margin-bottom": _mgAuto});
jQuery("#J_checkForm").show();
}
function J_closeCheckForm(){
jQuery("body").removeAttr("style");
jQuery("body").find(".modal-backdrop").remove();
jQuery("#J_checkForm").hide();
}

});
</script>
<div id="J_checkForm" class="modal-tpl">
<div class="modal-dialog">
<div class="dialog-header">
<h3 class="dh-title">我要咨询</h3>
<a href="javascript:void(0);" id="J_closeCheckForm" class="dialog-close">关闭</a>
</div>
<div class="dialog-content">
<form method="post" id="order_form" autocomplete="off" action="forum.php?mod=misc&amp;action=activityconsults&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="activityconsults" />
<div class="check-form">
<div class="form-group">
<span class="control-label">联系</span>
<div id="mode-select-list" class="controls-option">
<label class="selected">
<a href="javascript:void(0);" class="radio-box" type="contacts_mobile">手机<i class="icon-check"></i></a>
</label>
<label>
<a href="javascript:void(0);" class="radio-box" type="wechat_no">微信<i class="icon-check"></i></a>
</label>
</div>
</div>
<div class="form-group">
<span class="control-label">手机</span>
<input type="text" id="contacts_mobile" name="contacts_mobile" class="phone-num" placeholder="请输入手机号">
</div>
<div class="form-group">
<span class="control-label">备注</span>
<input type="text" id="other" name="other" class="remark" placeholder="请输入您的需求">
</div>
<div class="check-action">
<div id="_J_PopupSubmit">
<a href="javascript:void(0);" onclick="check_order_form()"  class="check-submit" id="activityask_sub">咨询</a>
<span id='signmessages' style='color:orange;'>&nbsp;</span>
</div>
</div>
</div>
</form>
<script>
function check_order_form(){
var activitymobilemode = /^0?1[3|4|5|8][0-9]\d{8}$/;
var contacts_type =jQuery("#contacts_mobile").attr("name");
var contacts_val = jQuery.trim(jQuery("#contacts_mobile").val());
if(contacts_type == 'contacts_mobile'){
if(contacts_val ==''){
jQuery("#signmessages").html('请填写手机号');
return false;
}
if(!activitymobilemode.test(contacts_val)){
jQuery("#signmessages").html('请填写正确手机号');
return false;
}
}else if(contacts_type == 'wechat_no'){
if(contacts_val ==''){
jQuery("#signmessages").html('请填写微信号');
return false;
}
}

jQuery("#order_form").submit();
}

jQuery(document).ready(function($) {
$("#contacts_mobile").focus(function(){
jQuery("#signmessages").html('&nbsp;');
  });
});
</script>
</div>
</div>
</div>

<?php if($applylistverified ) { ?>
<div class="clboth mt16" id="ratelog_8264_<?php echo $post['pid'];?>">
<div class="pftitle clboth">
<span class="peopleicon17_17"></span>
<span class="peoplenum"><?php echo $noverifiednum;?> 人</span>
<span class="pfzi">未通过</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=activenopass&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;nopassnum=<?php echo $noverifiednum;?>" onclick="showWindow('activepass', this.href)">查看未通过人员</a>
</div>
<div class="clboth pftoulist">
<ul><?php if(is_array($applylistverified)) foreach($applylistverified as $apply) { ?><li>
<?php if(empty($apply['picUrl'])) { ?>
<div id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['uid'];?>_menu" class="attp" style="display: none;">
    <p class="crly"><?php echo $apply['message'];?> &nbsp;&nbsp;
       <em>每人花销：<?php if($apply['payment'] >= 0) { ?><?php echo $apply['payment'];?> 元<?php } else { ?>自付<?php } ?></em>
       <span>申请时间：<?php echo $apply['dateline'];?></span>
<?php if($apply['num']>=2) { ?><br/><span>报名人数: <?php echo $apply['num'];?>人</span><?php } ?>
    </p>
    <p class="mncr"></p>
</div>
<?php } else { ?>
<div id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['appuserid'];?>_menu" class="attp" style="display: none;">
    <p class="crly"><?php echo $apply['message'];?> &nbsp;&nbsp;
       <em>每人花销：<?php if($apply['payment'] >= 0) { ?><?php echo $apply['payment'];?> 元<?php } else { ?>自付<?php } ?></em>
       <span>申请时间：<?php echo $apply['dateline'];?></span>
<?php if($apply['num']>=2) { ?><br/><span>报名人数: <?php echo $apply['num'];?>人</span><?php } ?>
    </p>
    <p class="mncr"></p>
</div>
<?php } if(empty($apply['picUrl'])) { ?>	
<p id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['uid'];?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx">					
<a href="home.php?mod=space&amp;uid=<?php echo $apply['uid'];?>" target="_blank" c="1"><?php echo avatar($apply['uid'], 'small');; ?></a>
</p>	
<a href="home.php?mod=space&amp;uid=<?php echo $apply['uid'];?>" target="_blank" class="name"><?php echo $apply['username'];?></a>
<?php } else { ?>
<p id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['appuserid'];?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx">					
<a href="javascript:void(0);" c="1"><img src="<?php echo $apply['picUrl'];?>"/></a>
</p>	
<a href="javascript:void(0);" class="name"><?php echo $apply['appusername'];?></a>
<?php } ?>
</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
</div>
<?php } if($applylist) { ?>
<div class="clboth mt16" id="ratelog_8264_<?php echo $post['pid'];?>">
<div class="pftitle clboth">
<span class="peopleicon17_17"></span>
<span class="peoplenum"><?php echo $applynumbers;?> 人</span>
<span class="pfzi">通过</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=activepass&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;passnum=<?php echo $applynumbers;?>" onclick="showWindow('activepass', this.href)">查看通过人员</a>
</div>
<div class="clboth pftoulist">
<div id="post_rate_8264_<?php echo $post['pid'];?>"></div>
<ul><?php if(is_array($applylist)) foreach($applylist as $apply) { ?><li>
<?php if(empty($apply['picUrl'])) { ?>
<div id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['uid'];?>_menu" class="attp" style="display: none;">
    <p class="crly"><?php echo $apply['message'];?> &nbsp;&nbsp;
       <em>每人花销：<?php if($apply['payment'] >= 0) { ?><?php echo $apply['payment'];?> 元<?php } else { ?>自付<?php } ?></em>
       <span>申请时间：<?php echo $apply['dateline'];?></span>
<?php if($apply['num']>=2) { ?><br/><span>报名人数: <?php echo $apply['num'];?>人</span><?php } ?>
    </p>
    <p class="mncr"></p>
</div>
<?php } else { ?>
<div id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['appuserid'];?>_menu" class="attp" style="display: none;">
    <p class="crly"><?php echo $apply['message'];?> &nbsp;&nbsp;
       <em>每人花销：<?php if($apply['payment'] >= 0) { ?><?php echo $apply['payment'];?> 元<?php } else { ?>自付<?php } ?></em>
       <span>申请时间：<?php echo $apply['dateline'];?></span>
<?php if($apply['num']>=2) { ?><br/><span>报名人数: <?php echo $apply['num'];?>人</span><?php } ?>
    </p>
    <p class="mncr"></p>
</div>
<?php } if(empty($apply['picUrl'])) { ?>
<p id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['uid'];?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx">
<a href="home.php?mod=space&amp;uid=<?php echo $apply['uid'];?>" target="_blank" c="1"><?php echo avatar($apply['uid'], 'small');; ?></a>
</p>
<a href="home.php?mod=space&amp;uid=<?php echo $apply['uid'];?>" target="_blank" class="name"><?php echo $apply['username'];?></a>
<?php } else { ?>
<p id="rate_8264_<?php echo $post['pid'];?>_<?php echo $apply['appuserid'];?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx">
<a href="javascript:void(0);" c="1"><img src="<?php echo $apply['picUrl'];?>"/></a>
</p>
<a href="javascript:void(0);" class="name"><?php echo $apply['appusername'];?></a>
<?php } ?>

</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
</div>
<?php } ?>

<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php echo $post['message'];?></td></tr></table>

<?php if($_G['uid'] && !$activityclose && (!$applied || $isverified == 2)) { ?>
<div id="activityjoin" style="display:none">
<?php if($_G['forum']['status'] == 3 && $isgroupuser != 'isgroupuser') { ?>
<div class="c">
<p>你还不是本<?php echo $_G['setting']['navs']['3']['navname'];?>群的成员不能参与此活动。</p>
<p><a href="forum.php?mod=group&amp;action=join&amp;fid=<?php echo $_G['fid'];?>" class="xi2">点此处马上加入<?php echo $_G['setting']['navs']['3']['navname'];?>。</a></p>
</div>
<?php } else { ?>
<form name="activity" id="activity" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=activityapplies&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" >
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="activityapplies" />
<div class="c">
<?php if($_G['setting']['activitycredit'] && $activity['credit'] && !$applied) { ?><p class="xi1">注意：参加此活动将扣除你 <?php echo $activity['credit'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['activitycredit']]['title'];?></p><?php } ?>
<div class="actfm">
<table summary="我要参加" cellpadding="0" cellspacing="0" class="actl">
<?php if($activity['cost']) { ?>
<!--<tr>
<th>支付方式</th>
<td>
<p class="mbn"><input class="pr" type="radio" value="0" name="payment" id="payment_0" checked="checked" /> <label for="payment_0">承担自己应付的花销</label></p>
<p><input class="pr" type="radio" value="1" name="payment" id="payment_1" /> <label for="payment_1">支付</label> <input name="payvalue" size="3" class="px pxs vm" onfocus="$('payment_1').checked = true;" /> 元</p>
</td>
</tr>-->						
<?php } if(!empty($activity['ufield']['userfield'])) { if(is_array($activity['ufield']['userfield'])) foreach($activity['ufield']['userfield'] as $fieldid) { if($settings[$fieldid]['available']) { ?>
<tr>
<th id="th_<?php echo $fieldid;?>"><?php if($settings[$fieldid]['required']) { ?><strong class="rq y">*</strong><?php } ?><?php echo $settings[$fieldid]['title'];?></th>
<td id="td_<?php echo $fieldid;?>">									
<?php if($fieldid=='field3') { ?>	
<input type="text" class="px" name="field3" tabindex="1" size="4" value="<?php echo $ufielddata['userfield']['field3'];?>" onkeyup="value=this.value.replace(/\D+/g,'')">人&nbsp;&nbsp;&nbsp;<span style="color: #F26C4F;">(只能填数字)</span>
<?php } else { ?>
<?php echo $htmls[$fieldid];?>
<?php } ?>
</td>
</tr>
<?php } } } if(!empty($activity['ufield']['extfield'])) { if(is_array($activity['ufield']['extfield'])) foreach($activity['ufield']['extfield'] as $extname) { ?><tr>
<th><?php echo $extname;?></th>
<td><input type="text" name="<?php echo $extname;?>" maxlength="200" class="px" value="<?php if(!empty($ufielddata)) { ?><?php echo $ufielddata['extfield'][$extname];?><?php } ?>" /></td>
</tr>
<?php } } ?>
                    <?php if(!$activity['formid']) { ?>
<tr>
<th>留言</th>
<td><textarea name="message" maxlength="200" cols="28" class="pt"><?php echo $applyinfo['message'];?></textarea></td>
</tr>
                    <?php } ?>
</table>
</div>
</div>
<div class="o pns">
<?php if($_G['setting']['activitycredit'] && $activity['credit'] && checklowerlimit(array('extcredits'.$_G['setting']['activitycredit'] => '-'.$activity['credit']), $_G['uid'], 1, 0, 1) !== true) { ?>
<p class="xi1"><?php echo $_G['setting']['extcredits'][$_G['setting']['activitycredit']]['title'];?> 不足<?php echo $activity['credit'];?></p>
<?php } else { ?>
<input type="hidden" name="activitysubmit" value="true">
<em class="xi1" id="return_activityapplies"></em>
<button type="submit" class="pn pnc"><span>提交</span></button>
<?php } ?>
</div>
</form>

<script type="text/javascript">
function succeedhandle_activityapplies(locationhref, message) {
showDialog(message, 'notice', '', 'location.href="' + locationhref + '"');
}
</script>
<?php } ?>
</div>
<?php } elseif($_G['uid'] && !$activityclose && $applied) { ?>
<div id="activityjoincancel" style="display:none">
<form name="activity" method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=activityapplies&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table summary="我要参加" cellpadding="0" cellspacing="0" class="actl">
<tr>
<th>留言</th>
<td><input type="text" name="message" maxlength="200" class="px" value="" /></td>
</tr>
</table>
</div>
<div class="o pns"><button type="submit" name="activitycancel" class="pn pnc" value="true"><span>提交</span></button></div>
</form>
</div>
<?php } ?>