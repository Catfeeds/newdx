<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('register_other', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/media.login.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/showmessage.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script type="text/javascript">
var lang_register_username_tips="�û����� 3 �� 15 ���ַ����",
lang_register_password_tips="����д����",
lang_register_password_tips="����д����",
lang_register_repassword_tips="���ٴ���������",
lang_register_email_tips="��������ȷ�������ַ",
s_url="http://static.8264.com/static/",
base_file = "<?php echo $_G['basefilename'];?>";
var activation_reg=false;
<?php if($_G['gp_action'] == 'activation') { ?>
activation_reg=true;
<?php } ?>
</script>
<script src="http://www.8264.com/static/js/common/register.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<!--<script src="http://static.8264.com/static/js/common/register.js?<?php echo VERHASH;?>" type="text/javascript"></script>-->

<div class="reg_bg">
<div class="reg_bg_img" style="background:url(http://static.8264.com/static/images/common/bg/bg<?php echo $bg_num;?>.jpg) no-repeat center center fixed;background-position: 50% 0px;-webkit-background-size: 100%;-moz-background-size: 100%;-o-background-size: 100%;background-size: 100%;background-size:cover;"></div>
</div>

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

<div class="reg_main" id="main_message">
<div id="r_main">
<h3 class="title_22px">
<em id="r_title"><?php if($_G['gp_action'] != 'activation') { ?><?php echo $this->setting['reglinkname'];?><?php } else { ?>����˺���Ҫ����<?php } ?></em>
<span id="r_tip">
<?php if(!empty($_G['setting']['pluginhooks']['register_side_top'])) echo $_G['setting']['pluginhooks']['register_side_top']; if($_G['gp_action'] == 'activation') { ?>
�����������<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>"><?php echo $_G['setting']['reglinkname'];?></a>w
<?php } else { ?>
<a href="member.php?mod=logging&amp;action=login&amp;referer=<?php echo rawurlencode($dreferer); ?>" onclick="showWindow('login', this.href);return false;">�����˺ţ����ڵ�¼</a>
<?php } ?>
</span>
</h3>
<div class="failure" id="r_message"></div>
<?php if($this->showregisterform) { ?>
<form method="post" autocomplete="off" name="register" id="registerform" enctype="multipart/form-data" onsubmit="checksubmit();return false;" action="member.php?mod=<?php echo $regname;?>">
<input type="hidden" name="regsubmit" value="yes" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $dreferer;?>" />
<input type="hidden" name="activationauth" value="<?php if($_G['gp_action'] == 'activation') { ?><?php echo $activationauth;?><?php } ?>" />

<?php if(!empty($_G['setting']['pluginhooks']['register_top'])) echo $_G['setting']['pluginhooks']['register_top']; if($invite) { if($invite['uid']) { ?>
<div class="inputlist_zc">
�Ƽ��ˣ�<a href="home.php?mod=space&amp;uid=<?php echo $invite['uid'];?>" target="_blank"><?php echo $invite['username'];?></a>
</div>
<?php } else { ?>
<div class="inputlist_zc">
<label for="invitecode">�����룺</label>
<?php echo $_G['gp_invitecode'];?><input type="hidden" id="invitecode" name="invitecode" value="<?php echo $_G['gp_invitecode'];?>" />
</div><?php $invitecode = 1; } } if(empty($invite) && $this->setting['regstatus'] == 2 && !$invitestatus) { ?>
<div class="inputlist_zc">
<span class="rq">*</span><label for="invitecode">�����룺</label>
<input type="text" id="invitecode" name="invitecode" autocomplete="off" size="25" onblur="checkinvite()" tabindex="1" class="px" required />
<?php if($this->setting['inviteconfig']['buyinvitecode'] && $this->setting['inviteconfig']['invitecodeprice'] && ($this->setting['ec_tenpay_bargainor'] || $this->setting['ec_tenpay_opentrans_chnid'] || $this->setting['ec_account'])) { ?>
<p><a href="misc.php?mod=buyinvitecode" target="_blank" class="xi2">��û�������룿����˴���ȡ</a></p>
<?php } ?>
<i id="tip_invitecode" class="p_tip">
<?php if($this->setting['inviteconfig']['invitecodeprompt']) { ?>
<?php echo $this->setting['inviteconfig']['invitecodeprompt'];?>
<?php } ?>
</i>
<kbd id="chk_invitecode" class="p_chk"></kbd>
</div><?php $invitecode = 1; } if($_G['gp_action'] != 'activation') { ?>
<div class="inputlist_zc">
<label class="labelicon" id="n_username">�û���</label>
<input name="<?php echo $this->setting['reginput']['username'];?>" id="r_username" type="text" class="input_text w307 logoicon" tabindex="1" size="25" autocomplete="off" required="required" value="<?php echo $_GET['nickname'];?>"/>
<span class="noteinfo" id="m_username">�û����� 3 �� 15 ���ַ����</span>
</div>
<div class="inputlist_zc" style="display: none">
<label class="labelicon" id="n_password">����</label>
<input name="<?php echo $this->setting['reginput']['password'];?>" id="r_password" type="password" class="input_text w307 passwordicon" tabindex="1" size="25" required="required" value="<?php echo $_G['default_password'];?>"/>
<span class="noteinfo" id="m_password">����д����</span>
</div>
<div class="inputlist_zc" style="display: none">
<label class="labelicon" id="n_password2">ȷ������</label>
<input name="<?php echo $this->setting['reginput']['password2'];?>" id="r_password2" type="password" class="input_text w307 passwordicon" tabindex="1" size="25" required="required" value="<?php echo $_G['default_password'];?>"/>
<span class="noteinfo" id="m_password2">���ٴ���������</span>
</div>
<!--<div class="inputlist_zc">
<label class="labelicon" id="n_email">Email</label>
<input name="<?php echo $this->setting['reginput']['email'];?>" id="r_email" type="text" class="input_text w307 emailicon" tabindex="1" size="25" autocomplete="off"/>
<em id="emailmore" style="display: block; height: 0px;"></em>
<span class="noteinfo" id="m_email">��������ȷ�������ַ</span>
</div>-->
<?php } if($_G['gp_action'] == 'activation') { ?>
<div id="activation_user" class="inputlist_zc">�û�����<strong><?php echo $username;?></strong></div>
<?php } if($this->setting['regverify'] == 2) { ?>
<div class="inputlist_zc">
<span class="rq">*</span><label for="regmessage">ע��ԭ��:</label>
<input id="regmessage" name="regmessage" class="px" autocomplete="off" size="25" tabindex="1" required />
<i id="tip_regmessage" class="p_tip" style="display: block;">����д��ע��ԭ��ᱻ��������ע�����Ҫ�ο����ݣ���������д��</i>
</div>
<?php } if(empty($invite) && $this->setting['regstatus'] == 3) { ?>
<div class="inputlist_zc">
<label for="invitecode">������:</label>
<input type="text" name="invitecode" autocomplete="off" size="25" id="invitecode"<?php if($this->setting['regstatus'] == 2) { ?> onblur="checkinvite()"<?php } ?> tabindex="1" class="px" />
</div><?php $invitecode = 1; } if(is_array($_G['cache']['fields_register'])) foreach($_G['cache']['fields_register'] as $field) { if($htmls[$field['fieldid']]) { ?>
<div class="inputlist_zc">
<?php if($field['required']) { ?><span class="rq">*</span><?php } ?><label for="<?php echo $field['fieldid'];?>"><?php echo $field['title'];?>:</label>
<?php echo $htmls[$field['fieldid']];?>
<i id="tip_<?php echo $field['fieldid'];?>" class="p_tip"><?php if($field['description']) { echo htmlspecialchars($field['description']); } ?></i><kbd id="chk_<?php echo $field['fieldid'];?>" class="p_chk"></kbd>
</div>
<?php } } ?>

<?php if(!empty($_G['setting']['pluginhooks']['register_input'])) echo $_G['setting']['pluginhooks']['register_input']; if(checkperm('seccode') && $secqaacheck) { ?>
<div class="inputlist_zc" style="margin-bottom:10px;"><?php include template('common/seccheck'); ?></div>
<?php } ?>

<div class="inputlist">
<?php if($_G['gp_action'] == 'activation') { ?>
<button class="pn pnc" id="registerformsubmit" type="submit" tabindex="1"><strong>����</strong></button>
<?php } else { ?>
<input id="registerformsubmit" type="submit" class="button_zc" tabindex="1" value="" />
<?php } if($bbrules) { ?>
<input type="checkbox" class="pc" name="agreebbrule" value="<?php echo $bbrulehash;?>" id="agreebbrule" checked="checked" /> <label for="agreebbrule">ͬ��<a href="javascript:;" onclick="showBBRule()">��վ��������</a></label>
<?php } ?>
</div>
</form>
<?php } if(!empty($_G['setting']['pluginhooks']['register_logging_method'])) { ?>
<div class="dz_other">
                <style type="text/css">
                    .login-socialButton{float:left;height:22px;margin-right:39px;line-height:22px}.login-socialButton i{width:22px;height:22px;background:url(http://static.8264.com/static/images/common/socialicon-22x106.png) no-repeat;float:left;margin:0 5px 0 0}.login-socialButton:hover i{animation:icon-jump .2s cubic-bezier(.17, .86, .73, .14)}.Button-wechat{margin-right:0}.login-socialButton .icon-qq{background-position:0 0}.login-socialButton .icon-weibo{background-position:0 -42px}.login-socialButton .icon-wechat{background-position:0 -84px}@-webkit-keyframes icon-jump{0%{margin-top:0}100%{margin-top:4px}}@keyframes icon-jump{0%{margin-top:0}100%{margin-top:4px}}
                </style>
                <a href="<?php echo $_G['connect']['login_url'];?>&statfrom=login" class="login-socialButton Button-qq" target="_top" rel="nofollow"><i class="icon-qq"></i>QQ��¼</a>
                <a href="connect.php?method=sina&amp;action=login&amp;op=init" class="login-socialButton Button-weibo" target="_top" rel="nofollow"><i class="icon-weibo"></i>΢����¼</a>
                <a href="http://www.8264.com/connect.php?method=wechat&amp;action=login&amp;op=init" class="login-socialButton Button-wechat" target="_top" rel="nofollow"><i class="icon-wechat"></i>΢�ŵ�¼</a>
</div>
<?php } ?>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['register_bottom'])) echo $_G['setting']['pluginhooks']['register_bottom']; ?>
</div>
</div>
</div><?php updatesession(); ?><script type="text/javascript">
jQuery(function(){
var height = jQuery(window).height();
if( height<900){
jQuery( window).scrollTop(130);
}
});
</script>
