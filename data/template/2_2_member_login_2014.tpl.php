<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('login_2014', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/media.login.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/showmessage.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css"><?php $loginhash = 'L'.random(4); ?><script type="text/javascript">
var loginhash="<?php echo $loginhash;?>",lang_login_id="账号",lang_login_password="密码",lang_username="用户名",lang_email="Email";

jQuery(document).ready(function($){
$("#loginform_"+loginhash).submit(function(){
        var is_yzm = loginIsAppearVerify();
        if(is_yzm){
            $('.yzm').show();
        }
<?php if($this->setting['pwdsafety']) { ?>
pwmd5('password3_'+loginhash);
<?php } ?>
pwdclear = 1;
ajaxpost('loginform_'+loginhash, 'returnmessage_'+loginhash, 'returnmessage_'+loginhash, '', '', function(){
$('#returnmessage_'+loginhash).css('display','block');
});
return false;
});
    function loginIsAppearVerify(){
        var flag = false;
        var username = jQuery.trim($('#username_'+loginhash).val());
        var postData = 'username='+username;
        var url = 'forum.php?mod=ajax&inajax=yes&infloat=register&handlekey=register&ajaxmenu=1&action=loginIsAppearVerify';
        url = decodeURI(url);
        $.ajax({
            async:false ,
            type: 'POST',
            url: url,
            data: postData,
            dataType: 'json',
            success: function(data){
                flag = data.is_yzm;
            }
        });
        return flag;
    }
});
</script>
<script src="http://static.8264.com/static/js/common/login.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<?php if(empty($_G['gp_infloat'])) { ?>
<div class="reg_bg">
<div class="reg_bg_img" style="background:url(http://static.8264.com/static/images/common/bg/bg<?php echo $bg_num;?>.jpg) no-repeat center center fixed;background-position: 50% 0px;-webkit-background-size: 100%;-moz-background-size: 100%;-o-background-size: 100%;background-size: 100%;background-size:cover;"></div>
</div>

<div class="reg_cnt">
<div class="reg_cntcon">
<div class="ts590 clboth" id="main_succeed" style="margin-top: 120px; display: none;">
<div class="l_400">
<span class="b_b" id="succeedlocation"></span>
<a href="#" class="hard_s" id="succeedmessage_href">如果你的浏览器没有自动跳转，请点击此链接</a>
</div>
<div class="r_102"></div>
</div>

<div class="reg_main" id="main_message">
<?php } ?>
<div id="login_box">
<h3 class="title_22px">
<?php if(empty($_G['gp_infloat'])) { ?><em>登录</em><?php } ?>
<span><?php if(!empty($_G['setting']['pluginhooks']['logging_side_top'])) echo $_G['setting']['pluginhooks']['logging_side_top']; ?><a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" class="xi2">没有账号？<?php echo $_G['setting']['reglinkname'];?></a></span>
</h3>
<span class="failure" id="returnmessage_<?php echo $loginhash;?>">
<?php if(!empty($_G['gp_infloat'])) { if(!empty($_G['gp_guestmessage'])) { ?>你需要先登录才能继续本操作<?php } elseif($auth) { ?>请补充下面的登录信息<?php } else { ?>用户登录<?php } } ?>
</span>

<?php if(!empty($_G['setting']['pluginhooks']['logging_top'])) echo $_G['setting']['pluginhooks']['logging_top']; ?>
<form method="post" autocomplete="off" name="login" id="loginform_<?php echo $loginhash;?>" class="cl" action="member.php?mod=logging&amp;action=login&amp;loginsubmit=yes<?php if(!empty($_G['gp_handlekey'])) { ?>&amp;handlekey=<?php echo $_G['gp_handlekey'];?><?php } if(isset($_G['gp_frommessage'])) { ?>&amp;frommessage<?php } ?>&amp;loginhash=<?php echo $loginhash;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo dreferer(); ?>" />
<?php if($auth) { ?>
<input type="hidden" name="auth" value="<?php echo $auth;?>" />
<?php } if($invite) { ?>
<div class="inputlist">
推荐人
<a href="home.php?mod=space&amp;uid=<?php echo $invite['uid'];?>" target="_blank"><?php echo $invite['username'];?></a>
</div>
<?php } if(!$auth) { ?>
<div class="inputlist">
<?php if($this->setting['autoidselect']) { ?>
<label class="labelicon" for="username_<?php echo $loginhash;?>" id="n_username_<?php echo $loginhash;?>">账号</label>
<?php } else { ?>
<span class="login_slct">
<select name="loginfield" style="float: left;" width="45" id="loginfield_<?php echo $loginhash;?>">
<option value="username">用户名</option>
<option value="uid">UID</option>
<option value="email">Email</option>
</select>
</span>
<?php } ?>
<input type="text" name="username" id="username_<?php echo $loginhash;?>" autocomplete="off" size="30" class="input_text w307 logoicon" tabindex="1" value="<?php echo $username;?>" />
</div>
<div class="inputlist">
<label class="labelicon" for="password3_<?php echo $loginhash;?>" id="n_password3_<?php echo $loginhash;?>">密码</label>
<input type="password" id="password3_<?php echo $loginhash;?>" name="password" onfocus="clearpwd()" size="30" class="input_text w307 passwordicon" tabindex="1" />
</div>
<?php } if(empty($_G['gp_auth']) || $questionexist) { ?>
<div class="inputlist_select" style="z-index:10;">
<span class="titlename">安全提问</span>
<div class="selectdivnote" id="qu_select">
<span id="qu_title"><?php if($questionexist) { ?>安全提问<?php } else { ?>安全提问(未设置请忽略)<?php } ?></span>
<div class="selectdivnote_down" id="qu_list">
<ul>
<li val="0" style="display: none;" id="qu_0"><?php if($questionexist) { ?>安全提问<?php } else { ?>安全提问(未设置请忽略)<?php } ?></li>
<li val="1">母亲的名字</li>
<li val="2">爷爷的名字</li>
<li val="3">父亲出生的城市</li>
<li val="4">你其中一位老师的名字</li>
<li val="5">你个人计算机的型号</li>
<li val="6">你最喜欢的餐馆名称</li>
<li val="7">驾驶执照最后四位数字</li>
</ul>
</div>
</div>
<div class="selectdiv">
<input type="text" name="answer" id="loginanswer_<?php echo $loginhash;?>" class="safeanswer" autocomplete="off" tabindex="1"<?php if($questionexist) { ?> style="display:block;"<?php } ?>/>
</div>
</div>
<input type="hidden" name="questionid" id="loginquestionid_<?php echo $loginhash;?>" value="0" />
<script type="text/javascript">
jQuery(document).ready(function($){
$("#qu_select").click(function(){
$("#qu_list").toggle();
});
$("#qu_list li").hover(function(){
$(this).attr('class','select');
},function(){
$(this).attr('class','');
}).click(function(){
$("#qu_title").text($(this).text());
var qu_val = parseInt($(this).attr('val'));
$("#loginquestionid_<?php echo $loginhash;?>").val(qu_val);
if(!qu_val){
$("#qu_0").hide();
<?php if(!$questionexist) { ?>
$("#loginanswer_<?php echo $loginhash;?>").hide();
<?php } ?>
} else {
$("#qu_0").show();
$("#loginanswer_<?php echo $loginhash;?>").show();
}
});
$(document).click(function(event) {
if (!$(event.target).closest("#qu_select").length) {
$("#qu_list").hide();
};
});
});
</script>
<?php } ?>


                    <div class="yzm" style="display: <?php if($secqaacheck) { ?>block<?php } else { ?>none<?php } ?>">
                        <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo time();?>" type="text/javascript"></script>
                    </div>

<?php if(!empty($_G['setting']['pluginhooks']['logging_input'])) echo $_G['setting']['pluginhooks']['logging_input']; ?>

<div class="dz_function" style="margin-top:10px;">
<span class="dz_function_l"><input name="cookietime" type="checkbox" value="2592000" id="cookietime_<?php echo $loginhash;?>" tabindex="1" <?php echo $cookietimecheck;?> />自动登录</span>
<span class="dz_function_r"><a href="javascript:;" title="找回密码" id="getpassword">找回密码</a></span>
</div>

<div class="inputlist">
<input name="_loginsubmit" type="submit" class="button_dl" tabindex="1" value="" /><?php echo adshow("custom_95"); if($this->setting['sitemessage']['login'] && empty($_G['gp_infloat'])) { ?><a href="javascript:;" id="custominfo_login_<?php echo $loginhash;?>" class="y">&nbsp;<img src="http://static.8264.com/static/image/common/info_small.gif" alt="帮助" class="vm" /></a><?php } ?>
</div>
</form>

<?php if(!empty($_G['setting']['pluginhooks']['logging_method'])) { ?>
<div class="dz_other"><?php $referer = rawurlencode(dreferer()); ?>                    <style type="text/css">
                        .login-socialButton{float:left;height:22px;margin-right:39px;line-height:22px}.login-socialButton i{width:22px;height:22px;background:url(http://static.8264.com/static/images/common/socialicon-22x106.png) no-repeat;float:left;margin:0 5px 0 0}.login-socialButton:hover i{animation:icon-jump .2s cubic-bezier(.17, .86, .73, .14)}.Button-wechat{margin-right:0}.login-socialButton .icon-qq{background-position:0 0}.login-socialButton .icon-weibo{background-position:0 -42px}.login-socialButton .icon-wechat{background-position:0 -84px}@-webkit-keyframes icon-jump{0%{margin-top:0}100%{margin-top:4px}}@keyframes icon-jump{0%{margin-top:0}100%{margin-top:4px}}
                    </style>
                    <a referer="<?php echo $referer;?>" href="http://bbs.8264.com/connect.php?mod=login&amp;op=init&amp;referer=<?php echo $referer;?>&amp;statfrom=login" class="login-socialButton Button-qq" target="_top" rel="nofollow"><i class="icon-qq"></i>QQ登录</a>
                    <a href="connect.php?method=sina&amp;action=login&amp;op=init" class="login-socialButton Button-weibo" target="_top" rel="nofollow"><i class="icon-weibo"></i>微博登录</a>
                    <a href="http://www.8264.com/connect.php?method=wechat&amp;action=login&amp;op=init" class="login-socialButton Button-wechat" target="_top" rel="nofollow"><i class="icon-wechat"></i>微信登录</a>
                </div>
<?php } ?>
</div>

<div id="layer_lostpw_<?php echo $loginhash;?>" style="display: none;">
<h3 class="title_22px">
<em id="returnmessage3_<?php echo $loginhash;?>">找回密码</em>
<span><a href="javascript:;" id="login_back">已有账号？现在登录</a></span>
</h3>
<form method="post" autocomplete="off" id="lostpwform_<?php echo $loginhash;?>" class="cl" onsubmit="ajaxpost('lostpwform_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', 'returnmessage3_<?php echo $loginhash;?>', '', '', function(){ jQuery('#returnmessage_<?php echo $loginhash;?>').css('display','block'); });return false;" action="member.php?mod=lostpasswd&amp;lostpwsubmit=yes&amp;infloat=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="lostpwform" />
<div class="inputlist">
<label class="labelicon" for="lostpw_username" id="n_lostpw_username">用户名</label>
<input type="text" id="lostpw_username" name="username" value="" size="30" class="input_text w307 logoicon" tabindex="1" />
</div>
<div class="inputlist">
<label class="labelicon" for="lostpw_email" id="n_lostpw_email">Email</label>
<input type="text" id="lostpw_email" name="email" value="" size="30" class="input_text w307 emailicon" tabindex="1" />
</div>
<div class="inputlist">
<input name="_loginsubmit" type="submit" class="button_pwd" tabindex="1" value="" tabindex="100" />
</div>
<div class="inputlist">如果账号和邮箱忘记请联系工作人员</br>彬彬 QQ 2534155085</div>
</form>
</div>

<script src="http://static.8264.com/static/js/md5.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">
<?php if(!isset($_G['gp_viewlostpw'])) { ?>
var pwdclear = 0;
function initinput_login() {
document.body.focus();
<?php if(!$auth) { ?>
if($('loginform_<?php echo $loginhash;?>')) {
$('loginform_<?php echo $loginhash;?>').username.focus();
}
<?php if(!$this->setting['autoidselect']) { ?>
simulateSelect('loginfield_<?php echo $loginhash;?>');
<?php } } ?>
}
initinput_login();
<?php if($this->setting['sitemessage']['login']) { ?>
showPrompt('custominfo_login_<?php echo $loginhash;?>', 'mouseover', '<?php echo trim($this->setting['sitemessage']['login'][array_rand($this->setting['sitemessage']['login'])]); ?>', <?php echo $this->setting['sitemessage']['time'];?>);
<?php } if($this->setting['pwdsafety']) { ?>
var pwmd5log = new Array();
function pwmd5() {
if(!$(pwmd5.arguments[i])) {
return;
}
numargs = pwmd5.arguments.length;
for(var i = 0; i < numargs; i++) {
if(!pwmd5log[pwmd5.arguments[i]] || $(pwmd5.arguments[i]).value.length != 32) {
pwmd5log[pwmd5.arguments[i]] = $(pwmd5.arguments[i]).value = hex_md5($(pwmd5.arguments[i]).value);
}
}
}
<?php } ?>

function clearpwd() {
if(pwdclear) {
$('password3_<?php echo $loginhash;?>').value = '';
}
pwdclear = 0;
}

function succeedhandle_lostpwform(url, msg) {
showDialog(msg, 'notice');
hideWindow('login');
}
<?php } else { ?>
display('layer_login_<?php echo $loginhash;?>');
display('layer_lostpw_<?php echo $loginhash;?>');
$('lostpw_username').focus();
<?php } ?>
</script>

<?php if(empty($_G['gp_infloat'])) { ?>
</div>
</div>
</div>
<?php } ?><?php updatesession(); ?><script type="text/javascript">
jQuery(function(){
var height = jQuery(window).height();
if( height<900){
jQuery( window).scrollTop(130);
}
});
</script>
