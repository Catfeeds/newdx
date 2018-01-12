<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_pm_new_2014', 'home/space_notice_new_header');
0
|| checktplrefresh('./template/8264/home/space_pm_new_2014.htm', './template/8264/home/space_pm_node_new_2014.htm', 1509434443, 'diy', './data/template/2_diy_home_space_pm_new_2014.tpl.php', './template/8264', 'home/space_pm_new_2014')
|| checktplrefresh('./template/8264/home/space_pm_new_2014.htm', './template/8264/common/seditor_new_2014.htm', 1509434443, 'diy', './data/template/2_diy_home_space_pm_new_2014.tpl.php', './template/8264', 'home/space_pm_new_2014')
;?>
<?php $_G['home_tpl_titles'] = array('提醒'); include template('home/space_notice_new_header'); if($_GET['subop'] == 'view') { ?>
<!--对话开始-->
<div class="form-box profile" id="pm_n_p">
<div class="info-hd">
<?php if($_G['username'] == $vsmeusername) { ?><span>我发送的消息</span><?php } else { ?><span>我与<?php echo $vsmeusername;?>的对话</span><?php } ?>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=smessage" class="bluefs"><<我的短消息</a>
</div>
<div class="info-bd">
<ul class="talkcon" id="pm_ul">
<?php if($nextrage <= 5) { ?><li style="text-align:center;font-size: 12px;"><a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=pm&subop=view&touid=<?php echo $touid;?>&daterange=<?php echo $nextrage;?>&count=<?php echo $count;?>#pm_n_p">查看更多历史信息</a></li><?php } if(is_array($list)) foreach($list as $key => $value) { ?><li <?php if($value['msgfromid'] == $_G['uid']) { ?>class="mytalk"<?php } else { ?>class="othertalk"<?php } ?>>
<?php if($value['msgfromid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $value['msgfromid'];?>" <?php if($value['msgfromid'] == $_G['uid']) { ?>class="tx_l"<?php } else { ?>class="tx_r"<?php } ?>><?php echo avatar($value[msgfromid],small); ?></a>
<?php } else { ?>
<a href="javascript:;" class="rwtx"></a>
<?php } ?>
<div class="<?php if($value['msgfromid'] == $_G['uid']) { ?>mytalk_con<?php } else { ?>othertalk_con<?php } ?>">
<p><?php echo $value['message'];?></p>
<span><?php echo dgmdate($value[dateline], 'u'); ?></span>
</div>
</li><?php } ?>
<div id="pm_append" style="display: none"></div>
</ul>
</div>
</div>
<!--对话结束-->
<div class="form-box profile">
<!--回复主题内容开始-->
<div id="f_pst" class="pingluncon">
<form id="pmform" class="pmform" name="pmform" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?php echo $touid;?>&amp;pmid=<?php echo $pmid;?>&amp;daterange=<?php echo $daterange;?>&amp;handlekey=pmsend&amp;pmsubmit=yes&amp;news=1" onsubmit="parsepmcode(this);ajaxpost('pmform', 'pmforum_return', 'pmforum_return');return false;">
<a target="_blank" href="#" class="pingluntou"><?php echo avatar($_G[uid],small); ?></a>
<span id="pmforum_return"></span>
<div class="pinglun">
<div class="pinglunmid">
<div class="edierbar clboth"><?php $seditor = array('reply', array('bold', 'color', 'smilies', 'simpleupload')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('simpleupload', $seditor['1'])) { ?>
<div class="bq_fjimg" id="uploadpic">
<a href="javascript:;" class="fjimg"></a>
</div><?php require_once libfile('class/simpleupload'); ?><?php $flashstring = simpleUpload::getFlashStr("uploadpic", 24, 23); ?><?php echo $flashstring;?>
<script>
function flashcallback(type, data){
eval("var objbtn = " + data);
switch(type){
case -1:
//alert(objbtn.text);
break;
case 1:
//alert(objbtn.text);alert(objbtn.picurl);
jQuery("#<?php echo $seditor['0'];?>message").val(jQuery("#<?php echo $seditor['0'];?>message").val() + "[img]" + objbtn.picurl + "[/img]");
break;
}
}
</script>
<?php } ?></div>
<div class="areatext">
<textarea class="pt" tabindex="4" name="message" cols="80" rows="5" id="replymessage" onkeydown="ctrlEnter(event, 'pmsubmit');"></textarea>
</div>
</div>
<button  name="pmsubmit" id="pmsubmit" value="true" class="kshf" type="submit">回复</button>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</div>
</form>
</div>
<!--回复主题内容结束-->
<style>
img.thumbautopic{cursor:pointer}
</style>
</div>
<?php } ?>
<!--封黑色屏div开始-->
<div class="fpall">
<div class="imgbox">
<img alt="" class="bigimg" id="showbigimg">
<a href="javascript:;" class="close42"></a>
</div>
</div>
<div id="loadimg" style="over-flow:hidden;height:0px;"></div>
<script>
jQuery('#pm_ul').on('click', 'img.thumbautopic', function(){
var bigpic = jQuery(this).attr('bigpic');
jQuery('#showbigimg').remove();
jQuery('#loadimg').html("<img src='"+bigpic+"' onload='showpic();' id='showbigimg'/>");
});
function showpic(){
var send_img_w = jQuery("#showbigimg").width();
var send_img_h = jQuery("#showbigimg").height();
jQuery("#showbigimg").attr({_width:send_img_w,_height:send_img_h});
jQuery('#showbigimg').appendTo('.imgbox');
jQuery('.fpall').show();
resizepic();
}
var timehandle;
function resizepic() {
clearTimeout(timehandle);
var send_img_w = jQuery("#showbigimg").width();
var send_img_h = jQuery("#showbigimg").height();
var org_img_w = jQuery('#showbigimg').attr('_width');
var org_img_h = jQuery('#showbigimg').attr('_height');
var pixs = org_img_w/org_img_h;
var window_w = jQuery(window).width()-60;
var window_h = jQuery(window).height();
var pixs_w = window_w/window_h;
if(pixs > pixs_w){
if(send_img_w >= window_w){
send_img_w = window_w > org_img_w ? org_img_w : window_w;
}else{
send_img_w = org_img_w;
}
send_img_h = 'auto';
}else{
window_h = window_h - 60;
if(send_img_h >= window_h){
send_img_h = window_h > org_img_h ? org_img_h : window_h;
}else{
send_img_h = org_img_h;
}
send_img_w = 'auto';
}
timehandle = setTimeout(function(){doPicSize(send_img_w, send_img_h);}, 100)
}
function doPicSize(nw,nh){
jQuery('#showbigimg').animate({width:nw,height:nh}, 'fast', 'swing', function(){
var window_h = jQuery(window).height() - 60;
var top = (window_h - jQuery(".imgbox").height())/2;
jQuery(".imgbox").css('marginTop',top);
});
}
jQuery(window).resize(function(){
if(jQuery('.fpall').is(':visible')){
resizepic();
}
});

jQuery(".close42").click( function () {
jQuery(".fpall").hide();
});
</script><?php include template('home/space_notice_new_footer'); ?>