<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!-- 装备快速点评弹窗 -->
<link rel="stylesheet" href="http://static.8264.com/dianping/style/layout_review.css?<?php echo VERHASH;?>">
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/formValidator-4.0.1.js?<?php echo VERHASH;?>" type="text/javascript" type="text/javascript"></script>
<script src="/static/js/layer/layer.js?v=2.3" type="text/javascript" type="text/javascript"></script>
<div class="mod-edit-popup">
<div class="write-comment-box">
<?php if($des_text[$des_type]) { ?>
<div class="ui-block ui-block-title">
<div class="ui-title ui-title-line">
<?php echo $des_text[$des_type];?>
</div>
</div>
<?php } ?>
<form method="post"  id="publishform" action="" autocomplete="off">
<input name="reply_origin" type="hidden" value="<?php echo $postdata['des_type'];?>"/> 
<div class="ui-block ui-block-content">
<div class="comment-form-box">
<div class="rows-content row-color-1" style="*height:70px;">
<div class="commAttr" style="padding:3px 4px">装备名称</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="eqname" id="eqnames" cols="30" rows="2" placeholder="请填写装备品牌+型号"></textarea>
<div id="eqnamesTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both; position:relative"></div>
</div>
<div class="rows-content row-color-1" style="*height:70px;">
<div class="commAttr">
<i class="attrs-icon comm"></i>推荐
</div>
<div class="attrForms">
<div class="star-rating-box">
<ul class="star-rating-level stars1">
<li><a class="one-star" id="star_1" value='1' href="javascript:void(0);" title="很差">100</a></li>
<li><a class="two-stars" id="star_2" value='2' href="javascript:void(0);" title="较差">200</a></li>
<li><a class="three-stars" id="star_3" value='3'  href="javascript:void(0);" title="还行">300</a></li>
<li><a class="four-stars" id="star_4" value='4' href="javascript:void(0);" title="推荐">400</a></li>
<li><a class="five-stars" id="star_5" value='5' href="javascript:void(0);" title="力荐">500</a></li>
</ul>
<span class="result stars1-tips"  style=""></span>
<div class="clearfix"></div>
<input type="hidden" id="starnums" class="starnum" name="starnum" value="" size="2" />
<div id="starnumsTip" class="valid-tips-container" style="display: none;">
<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请点击星星图标进行点评</span></div>
</div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-2" style="*height:70px;">
<div class="commAttr" style="padding:3px 4px">价格来源</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="extdata" id="extdatas" cols="30" rows="2" placeholder="请写明自己从哪里得到的，入手时间，购买价格，不写者一律不奖励8264币"></textarea>
<div id="extdatasTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-3" style="*height:70px;">
<div class="commAttr">
<i class="attrs-icon note"></i>不足
</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="weakpoint" id="weakpoints" cols="30" rows="2" placeholder="请结合自己使用一段时间后的感受详细说明该装备本身的缺点，价格知名度不是装备本身的缺点，没有写明自己实际使用体会的一律不奖励8264币"></textarea>
<div id="weakpointsTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-4" style="*height:70px;">
<div class="commAttr">
<i class="attrs-icon note"></i>优点
</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="goodpoint" id="goodpoints" cols="30" rows="2" placeholder="请结合自己的使用感受说明该装备的优点，把说明书里的文字重新编辑不奖励8264币"></textarea>
<div id="goodpointsTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-5" style="*height:140px;">
<div class="commAttr">
<i class="attrs-icon complex"></i>综合
</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="message" id="messages" cols="30" rows="6" placeholder="请结合自己的使用感受综合对该装备进行客观评价，描述缺点多的优先加币，胡编乱造捧臭脚的一律不加币"></textarea>
<div id="messagesTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-6">
<div class="attrForms">
<div class="issue-submit-group">
<input type="submit" name="submit" value="发布" class="btn-issue" />
</div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
<script>
(function($){
$(function(){
$(".stars1").on("click","a",function(){
var starnum = $(this).attr('value');
var title   = $(this).attr('title');
$('.stars1 li a').removeClass('current-star-rating');
$(this).addClass('current-star-rating');
$('#starnums').val(starnum);
$('.star_title').show();
$(this).parents('ul').siblings('.stars1-tips').html(title);
$("#publishform #starnumsTip").hide();
});

$.formValidator.initConfig({
formID: "publishform",
debug: false,
submitOnce: false,
onError:function(msg,obj,errorlist){
}
});
//综合
$('#messages').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>请填写该产品的综合评价。</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i>描述越详尽越好，超过50字的描述，更有机会获得8264币奖励</span></div>',
defaultValue: ""
}).inputValidator({
min: 20,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写该产品的综合评价，不能少于20个字符。</span></div>'
});
//缺点
$('#weakpoints').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>请填写该产品的不足之处。</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i>描述越详尽越好，超过50字的描述，更有机会获得8264币奖励</span></div>',
defaultValue: ""
}).inputValidator({
min: 20,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写该产品的不足之处，不能少于20个字符。</span></div>'
});
//优点
$('#goodpoints').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>请填写该产品的优点</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i>描述越详尽越好，超过50字的描述，更有机会获得8264币奖励</span></div>',
defaultValue: ""
}).inputValidator({
min: 20,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写该产品的优点，不能少于20个字符</span></div>'
});
//价格来源
$('#extdatas').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>请填写正确的价格来源</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
defaultValue: ""
}).inputValidator({
min: 5,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请认真填写产品的价格来源，不能少于5个字符</span></div>'
});
//装备名称
$('#eqnames').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>请填写您要点评的装备名称</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
defaultValue: ""
}).inputValidator({
min: 5,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>填写的装备名称不能少于5个字符</span></div>'
});

<?php if(!$_G['uid']) { ?>
layer.confirm('需要登陆后才能进行以下操作', {
icon: 0,
closeBtn: 0,
btn: ['登陆','取消'] //按钮
}, function(){
window.open("http://bbs.8264.com/member.php?mod=logging"+"&action=login");
var index = parent.layer.getFrameIndex(window.name);
parent.layer.close(index);
return false;
}, function(){
var index = parent.layer.getFrameIndex(window.name);
parent.layer.close(index);
});
<?php } ?>

//给每个textarea添加失去焦点的事件
$(document).ready(function(){		
    $("#publishform textarea").blur(function(){
    	validForm($(this));
    });		    
});

//发布
$('#publishform').submit(function(event){
event.preventDefault();
var eqname = $("#publishform #eqnames").val();
var starnum = $("#publishform #starnums").val();
var extdata = $.trim($("#publishform #extdatas").val());
var goodpoint = $.trim($("#publishform #goodpoints").val());
var weakpoint = $.trim($("#publishform #weakpoints").val());
var message = $.trim($("#publishform #messages").val());
var reply_origin = $("#publishform input[name=reply_origin]").val();
$("#publishform textarea").each(function(){
validForm($(this));
});
 //form表单初始化验证后进行二次验证
if(starnum == 0){
$("#publishform #starnumsTip").show();
return false;
}
if(jslen(eqname) <5 || jslen(extdata) <5 || jslen(weakpoint) <20 || jslen(goodpoint) <20 || jslen(message) <20){
return false;
}
//防止二次提交
$(":submit",this).attr("disabled","disabled");

var formPostUrl="http://bbs.8264.com/plugin.php?id=forumoption:quick_reply";
var stararray=['很差','较差','还行','推荐','力荐'];

$.post(formPostUrl,{mod:'equipment',reply_origin:reply_origin,eqname:eqname,starnum:starnum,goodpoint:goodpoint,weakpoint:weakpoint,message:message,extdata:extdata,formhash:'<?php echo FORMHASH;?>',publishsubmit:'yes'},
function(data){
if(data == 1){
layer.msg('发布成功，请等待管理员审核', {
icon: 1,
time: 5000
}, function(){
var index = parent.layer.getFrameIndex(window.name);
parent.layer.close(index);
});
} else if(data == -1) {
alert("您已经点评过了！");
return false;
} else if(data == -2) {
alert("点评失败，请重试！");
return false;
} else {
alert("异常");
return false;
}
});
});
//发布点评end
});
})(jQuery);
function jslen(sname){
len=0;
sname=sname.replace(/[\r\n]/g, '');
sname=$.trim(sname);
    for (var i = 0; i < sname.length; i++) 
    {
        len = len + ((sname.charCodeAt(i) >= 0x4e00 && sname.charCodeAt(i) <= 0x9fa5) ? 2 : 1); 
    }
    return len;
}
function validForm(obj){
    var curid=obj.attr("id");
    var val=obj.val();
    val=val.replace(/[\r\n]/g, '');
    val=$.trim(val);
    if(curid=="eqnames"&&jslen(val) <5){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>填写的装备名称，不能少于5个字符</span></div>');
    }
    if(curid=="extdatas"&&jslen(val) <5){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请认真填写产品的价格来源，不能少于5个字符</span></div>');
    }
    if(curid=="goodpoints"&&jslen(val) <20){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写该产品的优点，不能少于20个字符</span></div>');
    }
    if(curid=="weakpoints"&&jslen(val) <20){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写该产品的不足之处，不能少于20个字符。</span></div>');
    }
    if(curid=="messages"&&jslen(val) <20){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>请填写该产品的综合评价，不能少于20个字符。</span></div>');
    }
}
</script>
