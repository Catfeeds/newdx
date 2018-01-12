<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/media.login.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/showmessage.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css"><?php $loginhash = 'L'.random(4); ?><script type="text/javascript">
var loginhash="<?php echo $loginhash;?>",
lang_register_username_tips="用户名由 3 到 15 个字符组成",
lang_register_password_tips="请填写密码",
lang_register_repassword_tips="请再次填写密码",
lang_register_email_tips="请输入正确的邮箱地址",
s_url="http://static.8264.com/static/";
</script>
<script src="http://static.8264.com/static/js/common.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<div class="reg_bg">
<div class="reg_bg_img"><img src="http://static.8264.com/static/images/common/bg/bg<?php echo $bg_num;?>.jpg" /></div>
</div>
<script>
    jQuery(document).ready(function($){
        $("#registerform").submit(function(){
            var is_yzm = regIsAppearVerify();
            if(is_yzm){
                $('.yzm').show();
            }
            ajaxpost('registerform', 'r_message', 'r_message', '', '', function(){
                $('#r_message').css('display','block');
            });
            return false;
        });
        function regIsAppearVerify(){
            var flag = false;
            var url = 'forum.php?mod=ajax&inajax=yes&infloat=register&handlekey=register&ajaxmenu=1&action=regIsAppearVerify';
            url = decodeURI(url);
            jQuery.ajax({
                async:false ,
                type: 'POST',
                url: url,
                data: '',
                dataType: 'json',
                success: function(data){
                    flag = data.is_yzm;
                }
            });
            return flag;
        }
    });
</script>
<div class="reg_cnt">
<div class="reg_cntcon">
<div class="ts590 clboth" id="main_succeed" style="margin-top: 120px; display: none;">
<div class="l_400">
<span class="b_b">感谢您注册  8264<em>现在将以会员身份登录站点</em></span>
<a href="#" class="hard_s" id="succeedmessage_href">如果你的浏览器没有自动跳转，请点击此链接</a>
</div>
<div class="r_88">
<a href="home.php?mod=spacecp&amp;t=new" target="_blank">
<span class="wszlimg"></span>
<span class="wszlwz">现在去完善资料</span>
</a>
</div>
</div>

<div class="reg_main" id="main_message"><?php //完善账号 ?><div id="r_main">
<h3 class="title_22px">
<em id="r_title"><?php echo $title;?></em>
<span id="r_tip">已有帐号? <a href="javascript: change_manipulation('r_bind', 'r_main');">绑定我的帐号</a></span>
<script type="text/javascript">
function change_manipulation(show_id, hide_id) {
var show = jQuery('#' + show_id);
var hide = jQuery('#' + hide_id);
/*var show = document.getElementById(show_id);
var hide = document.getElementById(hide_id);*/
if(show == undefined || show.length != 1 || hide == undefined || hide.length != 1) {
alert('Error: more than one element use as ' + id + ' id!');
return;
}
/*show.style.display = '';
hide.style.display = 'none';*/
show.css('display', '');
hide.css('display', 'none');
}
</script>
</h3>
<?php if($top_message) { ?>
<div class="r_top_message" id="r_top_message" style="display: block;">
<?php echo $top_message;?>
</div>
<?php } ?>
<div class="failure" id="r_message"></div>

<form method="post" autocomplete="off" name="register" id="registerform" enctype="multipart/form-data"  action="connect.php?action=login&amp;method=sina&amp;action=register&amp;isSubmit=yes">
                    <input type="hidden" name="wb_reg_submit" value="yes" />
                    <input type="hidden" name="isSubmit" value="yes"/>
<input type="hidden" name="method" value="<?php echo $method;?>" />
<input type="hidden" name="action" value="<?php echo $action;?>" />
<div class="inputlist_zc">
<label class="labelicon" id="n_username"></label>
<input name="siteRegName" id="r_username" type="text" class="input_text w307 logoicon" tabindex="1" size="25" autocomplete="off" required="required" value="<?php echo $default_username;?>" />
<span class="noteinfo" id="m_username">用户名由 3 到 15 个字符组成</span>
</div>
                    <div class="yzm" style="margin-bottom:20px;display: none">
                        <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo time();?>" type="text/javascript"></script>
                    </div>
<div class="inputlist">
<input id="registerformsubmit" type="submit" class="button_qq" tabindex="1" value="" />
</div>
</form>
</div><?php //绑定账号 ?><div id="r_bind" style="display: none;">
<h3 class="title_22px">
<em>绑定帐号</em>
<span>新注册用户？<a href="javascript:change_manipulation('r_main', 'r_bind');" id="connect_register_profile">完善帐号信息</a></span>
</h3>
<?php if($bind_top_message ) { ?>
<div class="r_top_message" style="display: block;">
<?php echo $bind_top_message;?>
</div>
<?php } ?>
<div class="failure" id="r_bind_message"></div>
<form method="post" autocomplete="off" name="login" id="bindform_<?php echo $loginhash;?>" class="cl" action="connect.php?action=login&amp;method=sina&amp;op=bind">
<input type="hidden" name="wb_bind_submit" value="yes">
                        <div class="inputlist">
<label class="labelicon" for="username_<?php echo $loginhash;?>" id="n_username_<?php echo $loginhash;?>">用户名</label>
<input type="text" name="username" id="username_<?php echo $loginhash;?>" autocomplete="off" size="30" class="input_text w307 logoicon" tabindex="1" value="<?php echo $username;?>" />
</div>
<div class="inputlist">
<label class="labelicon" for="password3_<?php echo $loginhash;?>" id="n_password3_<?php echo $loginhash;?>">密码</label>
<input type="password" id="password3_<?php echo $loginhash;?>" name="password" size="30" class="input_text w307 passwordicon" tabindex="1" />
</div>
                        <div class="yzm_bind" style="margin-bottom:20px;display: none">
                            <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo $loginhash;?>" type="text/javascript"></script>
                        </div>
<div class="inputlist_select" style="z-index:10;">
<span class="titlename">安全提问</span>
<div class="selectdivnote" id="qu_select">
<span id="qu_title">
<?php if($questionexist) { ?>
安全提问
<?php } else { ?>
安全提问(未设置请忽略)
<?php } ?>
</span>
<div class="selectdivnote_down" id="qu_list">
<ul>
<li val="0" style="display: none;" id="qu_0">
<?php if($questionexist) { ?>
安全提问
<?php } else { ?>
安全提问(未设置请忽略)
<?php } ?>
</li>
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
}, function(){
$(this).attr('class','');
}).click(function(){
$("#qu_title").text($(this).text());
var qu_val = parseInt($(this).attr('val'));
$("#loginquestionid_<?php echo $loginhash;?>").val(qu_val);
if(! qu_val){
$("#qu_0").hide();
<?php if(! $questionexist) { ?>
$("#loginanswer_<?php echo $loginhash;?>").hide();
<?php } ?>
} else {
$("#qu_0").show();
$("#loginanswer_<?php echo $loginhash;?>").show();
}
});
$(document).click(function(event) {
if (! $(event.target).closest("#qu_select").length) {
$("#qu_list").hide();
};
});

jQuery("#username_<?php echo $loginhash;?>").focus(function(){
jQuery("#n_username_<?php echo $loginhash;?>").html("");
}).blur(function(){
! jQuery(this).val() && jQuery("#n_username_<?php echo $loginhash;?>").html("用户名");
});
jQuery("#password3_<?php echo $loginhash;?>").focus(function(){
jQuery("#n_password3_<?php echo $loginhash;?>").html("");
}).blur(function(){
! jQuery(this).val() && jQuery("#n_password3_<?php echo $loginhash;?>").html("密码");
});
                                $("#bindform_<?php echo $loginhash;?>").submit(function(){
                                    var is_yzm = loginIsAppearVerify();
                                    if(is_yzm){
                                        $('.yzm_bind').show();
                                    }
                                    ajaxpost('bindform_<?php echo $loginhash;?>', 'r_bind_message', 'r_bind_message', '', '', function(){
                                        $('#r_bind_message').css('display','block');
                                    });
                                    return false;
                                });
                                function loginIsAppearVerify(){
                                    var flag = false;
                                    var username = jQuery.trim($('#username_<?php echo $loginhash;?>').val());
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

<div class="inputlist">
<input name="_loginsubmit" type="submit" class="button_bd" tabindex="1" value="" />
</div>
</form>
</div>
</div>

</div>
</div>


<script type="text/javascript">
jQuery(function(){
var height = jQuery(window).height();
if( height<900){
jQuery(window).scrollTop(130);
}
});

//afer call ajax_post to submit, then call ajaxpost to warn user, this is the callback of ajaxpost
function succeedhandle_register(url, msg, object) {
if(url) {
$('main_succeed').style.display = 'block';
$('main_message').style.display = 'none';
$('succeedmessage_href').href = url;
setTimeout(function(){
window.location.href = url;
}, 3000);
}
}
</script>