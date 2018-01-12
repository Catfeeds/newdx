<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title>8264户外运动学校 - 登录</title>
<meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="MobileOptimized" content="width">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title>首页</title>

<link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css">
<script src="http://static.8264.com/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/exam/swiper.min.js" type="text/javascript"></script>
</head>

<body style="background: #f8f8f9;">
<!--头部开始-->
<?php if($isWechat == 0) { ?>
<div class="header-content">
<div class="home-icons" style="display: none;">
<a href="http://www.8264.com/xuexiao/">首页</a>
</div>
<div class="goback-icons">
<a href="http://www.8264.com/xuexiao/">返回</a>
</div>
<div class="logo">
<a href="#">
<img src="http://static.8264.com/static/images/exam/logo.png" alt="">
</a>
</div>
</div>
<?php } ?>
<!--头部结束-->
<div class="page">
<div class="head">
</div>
<div class="logintitle">
<span>填写手机号</span>
<em>留下手机号，我们将给您发送考试报告</em>
</div>
<div id="loginForm" class="mlogin">
<div class="field uname">
<div class="label username">昵称</div>
<div class="field-control">
<input type="text" id="username" class="input-required" name="username" placeholder="昵称">
</div>
<div class="icon-clear"></div>
</div>
<div class="field tel">
<div class="label password">手机号</div>
<div class="field-control">
<input id="phone" class="input-required" name="phone" placeholder="手机号">
</div>
<div class="icon-clear"></div>
</div>

<div class="field yzm">
<div class="label yanzhengma">验证码</div>
<div class="field-control">
<input id="yzcode" type="text" class="input-required" placeholder="验证码">
</div>
<div class="icon-clear"></div>
<div class="yzmbutton">
<input id="codebutton" type="button" value="获取验证码" onclick="sendMessage();">
</div>
</div>
<div class="tips" style="display:none;"><i class="icon-mark"></i>用户名已存在</div>

<div class="submit">
<button id="submit-btn" class="button" type="submit"  onclick="validate();">进入</button>
</div>

</div>
        <input type="hidden" id="ref" value="<?php echo $ref;?>" />
</div>



<script type="text/javascript">
jQuery(function(){
$(".bottompopbox i").click(function() {
$(".bottompopbox").hide();
});
});

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数

function sendMessage() {
if(curCount){
curCount = curCount;
}else{
curCount = count;
}

if(checkMobileState()){

//设置button效果，开始计时
$("#codebutton").attr("disabled", "disabled");
$("#codebutton").val(curCount + "秒后重发");
InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次

//向后台发送处理数据
$.ajax({
type: 'POST',
url: 'http://www.8264.com/exam.php?ctl=topic&act=ajaxMobilesend',
async:false,
data: {phone:$.trim($("#phone").val())},
dataType: 'json',
success: function(data){
if(data.return_state=='-1'){
alert('短信验证码请求太频繁，请稍后再试！');
//window.location.href=SITE_URL+'/wap.php?app=claim';
return false;
}
if(data.return_state=='-2'){
alert("短信发送失败，请联系客服!");
return false;
}
}
});
}

}

//timer处理函数
function SetRemainTime() {
if (curCount == 0) {
window.clearInterval(InterValObj);//停止计时器

$("#codebutton").removeAttr("disabled");//启用按钮

$("#codebutton").val("发送验证码");
}
else {
curCount--;
$("#codebutton").val(curCount + "秒后重发");
}
}

function checkMobileState(){
var phone = jQuery("#phone").val();
phone = jQuery.trim(phone);

if(phone == ''){
r_error("请输入手机号", 'tips', 'tel');
return false;
}

if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){ 
r_error("请输入正确手机号", 'tips', 'tel');
return false;
}

rm_error("tips", "tel");
return true;
}

function checkYzCode(){
var code = jQuery("#yzcode").val();
code = jQuery.trim(code);
if(code.length != 4){
r_error("验证码错误", 'tips', 'yzm');
return false;
}

var phone = jQuery.trim(jQuery("#phone").val());
var username = jQuery.trim(jQuery("#username").val());

//校验 验证码
$.ajax({
type: 'POST',
url: '/exam.php?ctl=topic&act=ajaxcheckcode',
async:false,
data: {code:$.trim($("#yzcode").val()), phone:phone},
dataType: 'json',
success:function(data){
if(data.return_state == '1'){
rm_error("tips", "yzm");
doLogin(username, phone, data.vcode);
}else if(data.return_state == '-1'){
r_error("验证码错误,请仔细查看短信", 'tips', 'yzm');
return false;
}else if(data.return_state == '-2'){
r_error("验证码已失效，请重新获取", 'tips', 'yzm');
return false;
}else{
r_error("非法参数", 'tips', 'yzm');
return false;
}
}
});
}

function doLogin(username, phone, vcode){
if(username == '' || phone == ''){
alert("非法参数！");
return false;
}

//登录
$.ajax({
type: 'POST',
url: '/exam.php?ctl=topic&act=dologin',
async:false,
data: {username:username, phone:phone, vcode:vcode},
dataType: 'json',
success:function(data){
if(data.flag == 1){
var ref = jQuery("#ref").val();
window.location.href = ref;
}
}
});
}

function validate() {
var username = jQuery("#username").val();
username = jQuery.trim(username);
if(username.match(/<|"/ig)) {
r_error("用户名包含敏感字符", 'tips', 'uname');
return false;
}
var unlen = username.replace(/[^\x00-\xff]/g, "**").length;
if(unlen < 3 || unlen > 15) {
r_error(unlen < 3 ? '用户名小于 3 个字符' : '用户名超过 15 个字符', 'tips', 'uname');
return false;
}
rm_error("tips", "uname");

if(checkMobileState()){
checkYzCode();
}

return false;
}


function r_error(msg, tipclass, errorclass){
jQuery("."+tipclass).html("<i class='icon-mark'></i>"+msg).show();
jQuery("."+errorclass).addClass("error");
}
function rm_error(tipclass, errorclass){
jQuery("."+tipclass).html("").hide();
jQuery("."+errorclass).removeClass("error");
}
</script>
</body>
</html>
