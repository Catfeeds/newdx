<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!-- װ�����ٵ������� -->
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
<div class="commAttr" style="padding:3px 4px">װ������</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="eqname" id="eqnames" cols="30" rows="2" placeholder="����дװ��Ʒ��+�ͺ�"></textarea>
<div id="eqnamesTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both; position:relative"></div>
</div>
<div class="rows-content row-color-1" style="*height:70px;">
<div class="commAttr">
<i class="attrs-icon comm"></i>�Ƽ�
</div>
<div class="attrForms">
<div class="star-rating-box">
<ul class="star-rating-level stars1">
<li><a class="one-star" id="star_1" value='1' href="javascript:void(0);" title="�ܲ�">100</a></li>
<li><a class="two-stars" id="star_2" value='2' href="javascript:void(0);" title="�ϲ�">200</a></li>
<li><a class="three-stars" id="star_3" value='3'  href="javascript:void(0);" title="����">300</a></li>
<li><a class="four-stars" id="star_4" value='4' href="javascript:void(0);" title="�Ƽ�">400</a></li>
<li><a class="five-stars" id="star_5" value='5' href="javascript:void(0);" title="����">500</a></li>
</ul>
<span class="result stars1-tips"  style=""></span>
<div class="clearfix"></div>
<input type="hidden" id="starnums" class="starnum" name="starnum" value="" size="2" />
<div id="starnumsTip" class="valid-tips-container" style="display: none;">
<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>��������ͼ����е���</span></div>
</div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-2" style="*height:70px;">
<div class="commAttr" style="padding:3px 4px">�۸���Դ</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="extdata" id="extdatas" cols="30" rows="2" placeholder="��д���Լ�������õ��ģ�����ʱ�䣬����۸񣬲�д��һ�ɲ�����8264��"></textarea>
<div id="extdatasTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-3" style="*height:70px;">
<div class="commAttr">
<i class="attrs-icon note"></i>����
</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="weakpoint" id="weakpoints" cols="30" rows="2" placeholder="�����Լ�ʹ��һ��ʱ���ĸ�����ϸ˵����װ�������ȱ�㣬�۸�֪���Ȳ���װ�������ȱ�㣬û��д���Լ�ʵ��ʹ������һ�ɲ�����8264��"></textarea>
<div id="weakpointsTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-4" style="*height:70px;">
<div class="commAttr">
<i class="attrs-icon note"></i>�ŵ�
</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="goodpoint" id="goodpoints" cols="30" rows="2" placeholder="�����Լ���ʹ�ø���˵����װ�����ŵ㣬��˵��������������±༭������8264��"></textarea>
<div id="goodpointsTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-5" style="*height:140px;">
<div class="commAttr">
<i class="attrs-icon complex"></i>�ۺ�
</div>
<div class="attrForms">
<div class="issue-forms-group">
<textarea name="message" id="messages" cols="30" rows="6" placeholder="�����Լ���ʹ�ø����ۺ϶Ը�װ�����п͹����ۣ�����ȱ�������ȼӱң��������������ŵ�һ�ɲ��ӱ�"></textarea>
<div id="messagesTip" class="valid-tips-container"></div>
</div>
</div>
                    <div style=" height:0px; line-height:0px; font-size:0px; clear:both;"></div>
</div>
<div class="rows-content row-color-6">
<div class="attrForms">
<div class="issue-submit-group">
<input type="submit" name="submit" value="����" class="btn-issue" />
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
//�ۺ�
$('#messages').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ò�Ʒ���ۺ����ۡ�</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i>����Խ�꾡Խ�ã�����50�ֵ����������л�����8264�ҽ���</span></div>',
defaultValue: ""
}).inputValidator({
min: 20,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ò�Ʒ���ۺ����ۣ���������20���ַ���</span></div>'
});
//ȱ��
$('#weakpoints').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ò�Ʒ�Ĳ���֮����</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i>����Խ�꾡Խ�ã�����50�ֵ����������л�����8264�ҽ���</span></div>',
defaultValue: ""
}).inputValidator({
min: 20,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ò�Ʒ�Ĳ���֮������������20���ַ���</span></div>'
});
//�ŵ�
$('#goodpoints').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д�ò�Ʒ���ŵ�</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i>����Խ�꾡Խ�ã�����50�ֵ����������л�����8264�ҽ���</span></div>',
defaultValue: ""
}).inputValidator({
min: 20,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ò�Ʒ���ŵ㣬��������20���ַ�</span></div>'
});
//�۸���Դ
$('#extdatas').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д��ȷ�ļ۸���Դ</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
defaultValue: ""
}).inputValidator({
min: 5,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>��������д��Ʒ�ļ۸���Դ����������5���ַ�</span></div>'
});
//װ������
$('#eqnames').formValidator({
onShow: '',
onFocus: '<div class="valid-tips-container"><span class="tips-txt prompt"><i class="icon-v icon-prompt-v"></i>����д��Ҫ������װ������</span></div>',
onCorrect: '<div class="valid-tips-container"><span class="tips-txt success"><i class="icon-v icon-success-v"></i></span></div>',
defaultValue: ""
}).inputValidator({
min: 5,
onError: '<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>��д��װ�����Ʋ�������5���ַ�</span></div>'
});

<?php if(!$_G['uid']) { ?>
layer.confirm('��Ҫ��½����ܽ������²���', {
icon: 0,
closeBtn: 0,
btn: ['��½','ȡ��'] //��ť
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

//��ÿ��textarea���ʧȥ������¼�
$(document).ready(function(){		
    $("#publishform textarea").blur(function(){
    	validForm($(this));
    });		    
});

//����
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
 //form����ʼ����֤����ж�����֤
if(starnum == 0){
$("#publishform #starnumsTip").show();
return false;
}
if(jslen(eqname) <5 || jslen(extdata) <5 || jslen(weakpoint) <20 || jslen(goodpoint) <20 || jslen(message) <20){
return false;
}
//��ֹ�����ύ
$(":submit",this).attr("disabled","disabled");

var formPostUrl="http://bbs.8264.com/plugin.php?id=forumoption:quick_reply";
var stararray=['�ܲ�','�ϲ�','����','�Ƽ�','����'];

$.post(formPostUrl,{mod:'equipment',reply_origin:reply_origin,eqname:eqname,starnum:starnum,goodpoint:goodpoint,weakpoint:weakpoint,message:message,extdata:extdata,formhash:'<?php echo FORMHASH;?>',publishsubmit:'yes'},
function(data){
if(data == 1){
layer.msg('�����ɹ�����ȴ�����Ա���', {
icon: 1,
time: 5000
}, function(){
var index = parent.layer.getFrameIndex(window.name);
parent.layer.close(index);
});
} else if(data == -1) {
alert("���Ѿ��������ˣ�");
return false;
} else if(data == -2) {
alert("����ʧ�ܣ������ԣ�");
return false;
} else {
alert("�쳣");
return false;
}
});
});
//��������end
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
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>��д��װ�����ƣ���������5���ַ�</span></div>');
    }
    if(curid=="extdatas"&&jslen(val) <5){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>��������д��Ʒ�ļ۸���Դ����������5���ַ�</span></div>');
    }
    if(curid=="goodpoints"&&jslen(val) <20){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ò�Ʒ���ŵ㣬��������20���ַ�</span></div>');
    }
    if(curid=="weakpoints"&&jslen(val) <20){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ò�Ʒ�Ĳ���֮������������20���ַ���</span></div>');
    }
    if(curid=="messages"&&jslen(val) <20){
        $("#"+curid+"Tip").html(" ");
        $("#"+curid+"Tip").html('<div class="valid-tips-container"><span class="tips-txt error"><i class="icon-v icon-error-v"></i>����д�ò�Ʒ���ۺ����ۣ���������20���ַ���</span></div>');
    }
}
</script>
