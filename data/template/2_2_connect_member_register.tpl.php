<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/media.login.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/showmessage.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css"><?php $loginhash = 'L'.random(4); ?><script type="text/javascript">
var loginhash="<?php echo $loginhash;?>",
lang_register_username_tips="�û����� 3 �� 15 ���ַ����",
lang_register_password_tips="����д����",
lang_register_repassword_tips="���ٴ���д����",
lang_register_email_tips="��������ȷ�������ַ",
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
<span class="b_b">��л��ע��  8264<em>���ڽ��Ի�Ա��ݵ�¼վ��</em></span>
<a href="#" class="hard_s" id="succeedmessage_href">�����������û���Զ���ת������������</a>
</div>
<div class="r_88">
<a href="home.php?mod=spacecp&amp;t=new" target="_blank">
<span class="wszlimg"></span>
<span class="wszlwz">����ȥ��������</span>
</a>
</div>
</div>

<div class="reg_main" id="main_message"><?php //�����˺� ?><div id="r_main">
<h3 class="title_22px">
<em id="r_title"><?php echo $title;?></em>
<span id="r_tip">�����ʺ�? <a href="javascript: change_manipulation('r_bind', 'r_main');">���ҵ��ʺ�</a></span>
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
<span class="noteinfo" id="m_username">�û����� 3 �� 15 ���ַ����</span>
</div>
                    <div class="yzm" style="margin-bottom:20px;display: none">
                        <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo time();?>" type="text/javascript"></script>
                    </div>
<div class="inputlist">
<input id="registerformsubmit" type="submit" class="button_qq" tabindex="1" value="" />
</div>
</form>
</div><?php //���˺� ?><div id="r_bind" style="display: none;">
<h3 class="title_22px">
<em>���ʺ�</em>
<span>��ע���û���<a href="javascript:change_manipulation('r_main', 'r_bind');" id="connect_register_profile">�����ʺ���Ϣ</a></span>
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
<label class="labelicon" for="username_<?php echo $loginhash;?>" id="n_username_<?php echo $loginhash;?>">�û���</label>
<input type="text" name="username" id="username_<?php echo $loginhash;?>" autocomplete="off" size="30" class="input_text w307 logoicon" tabindex="1" value="<?php echo $username;?>" />
</div>
<div class="inputlist">
<label class="labelicon" for="password3_<?php echo $loginhash;?>" id="n_password3_<?php echo $loginhash;?>">����</label>
<input type="password" id="password3_<?php echo $loginhash;?>" name="password" size="30" class="input_text w307 passwordicon" tabindex="1" />
</div>
                        <div class="yzm_bind" style="margin-bottom:20px;display: none">
                            <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo $loginhash;?>" type="text/javascript"></script>
                        </div>
<div class="inputlist_select" style="z-index:10;">
<span class="titlename">��ȫ����</span>
<div class="selectdivnote" id="qu_select">
<span id="qu_title">
<?php if($questionexist) { ?>
��ȫ����
<?php } else { ?>
��ȫ����(δ���������)
<?php } ?>
</span>
<div class="selectdivnote_down" id="qu_list">
<ul>
<li val="0" style="display: none;" id="qu_0">
<?php if($questionexist) { ?>
��ȫ����
<?php } else { ?>
��ȫ����(δ���������)
<?php } ?>
</li>
<li val="1">ĸ�׵�����</li>
<li val="2">үү������</li>
<li val="3">���׳����ĳ���</li>
<li val="4">������һλ��ʦ������</li>
<li val="5">����˼�������ͺ�</li>
<li val="6">����ϲ���Ĳ͹�����</li>
<li val="7">��ʻִ�������λ����</li>
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
! jQuery(this).val() && jQuery("#n_username_<?php echo $loginhash;?>").html("�û���");
});
jQuery("#password3_<?php echo $loginhash;?>").focus(function(){
jQuery("#n_password3_<?php echo $loginhash;?>").html("");
}).blur(function(){
! jQuery(this).val() && jQuery("#n_password3_<?php echo $loginhash;?>").html("����");
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