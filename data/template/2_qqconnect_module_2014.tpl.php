<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<?php function tpl_global_login_extra() {
global $_G; ?><?php
$__IMGDIR = IMGDIR;$return = <<<EOF

<div class="fastlg_fm y" style="margin-right: 10px; padding-right: 10px">
<p><a href="{$_G['connect']['login_url']}&statfrom=login_simple"><img src="{$__IMGDIR}/qq_login.gif" class="vm" alt="QQ登录" /></a></p>
<p class="hm xg1" style="padding-top: 2px;">只需一步，快速开始</p>
</div>

EOF;
?><?php return $return; ?><?php }

function tpl_global_usernav_extra1() { ?><?php
$__IMGDIR = IMGDIR;$return = <<<EOF

<span class="pipe">|</span><a href="connect.php?mod=config" target="_blank"><img src="{$__IMGDIR}/qq_bind_small.gif" class="vm qq_bind" alt="QQ绑定" /></a>

EOF;
?><?php return $return; ?><?php }

function tpl_login_bar() {
global $_G; ?><?php
$__IMGDIR = IMGDIR;$return = <<<EOF

<a href="{$_G['connect']['login_url']}&statfrom=login" target="_top" rel="nofollow"><img src="{$__IMGDIR}/qq_login.gif" class="vm" /></a>

EOF;
?><?php return $return; ?><?php }

function tpl_index_status_extra() {
global $_G; ?><?php
$return = <<<EOF

<iframe id="connectlike" allowtransparency="true" scrolling="no" border="0" width="280" height="25" frameborder="0"></iframe>
<script type="text/javascript">_attachEvent(window, 'load', function () { $('connectlike').src = 'api/connect/like.php';}, document);</script>

EOF;
?><?php return $return; ?><?php }

function tpl_sync_method($allowconnectfeed, $allowconnectt, $cssextra = '') {
global $_G; ?><?php
$return = <<<EOF


EOF;
 if($allowconnectfeed || $allowconnectt) { 
$return .= <<<EOF

<script type="text/javascript">
var _allow_qq = 
EOF;
 if($allowconnectfeed) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
var _allow_t = 
EOF;
 if($allowconnectt) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
var _syn_qq = 
EOF;
 if($_G['member']['conisbind'] && $_G['member']['conispublishfeed']) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
var _syn_t = 
EOF;
 if($_G['member']['conisbind'] && $_G['member']['conispublisht']) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
var _is_oauth_user = 
EOF;
 if($_G['member']['conisbind']) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
var _is_feed_auth = 
EOF;
 if($_G['member']['conuinsecret'] && $_G['member']['is_feed']) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
function connect_post_init() {
if (_is_feed_auth && _allow_qq && _syn_qq) {
$('connectPost_synQQ').className = 'syn_qq_check';
$('connectPost_synQQ').title = '已设置同步至QQ空间';
$('connect_publish_feed').value = 1;
}
if (_is_feed_auth && _allow_t && _syn_t) {
$('connectPost_synT').className = 'syn_tqq_check';
$('connectPost_synT').title = '已设置同步至腾讯微博';
$('connect_publish_t').value = 1;
}
if (_allow_qq) {
$('connectPost_synQQ').onclick = function () {
connect_syn_option_toggle(this);
}
}
if (_allow_t) {
$('connectPost_synT').onclick = function () {
connect_syn_option_toggle(this);
}
}
if (getcookie('connect_synpost_tip')) {
connect_post_tip();
}
}
function connect_syn_option_toggle(opt) {
if (_is_feed_auth) {
if ($(opt.getAttribute('rel')).value == 1) {
opt.className = opt.className.replace('_check', '');
opt.title = opt.title.replace('已', '未');
$(opt.getAttribute('rel')).value = 0;
} else {
$(opt.getAttribute('rel')).value = 1;
opt.className += '_check';
opt.title = opt.title.replace('未', '已');
}
} else {
var _auth_text = '马上完善授权，您将可以发表主题时同步到QQ空间和腾讯微博，第一时间和大家分享您在论坛中的新鲜事儿。';
if (!_is_oauth_user) {
_auth_text = '马上绑定QQ账号，您将可以发表主题时同步到QQ空间和腾讯微博，第一时间和大家分享您在论坛中的新鲜事儿。';
}
showDialog(_auth_text, 'notice', '授权提示', 'connect_goto_setting()', 0, null, null, '修改授权');
}
}
function connect_post_tip() {
if ($('fastpostform')) {
return;
}
var r = document.getElementById('rstnotice');
var c = document.createElement('div');
c.setAttribute('id', 'synnotice');
c.setAttribute('class', 'ntc_l bbs');
if(BROWSER.ie) {
c.id = 'synnotice';
c.className = 'ntc_l bbs';
}
c.style.display = 'block';
r.parentNode.insertBefore(c, r.nextSibling);
c.innerHTML = '<a href="javascript:void(0);" title="关闭同步发帖提示" class="d y" onclick="connect_syn_tip_hide();">close</a>此主题将同步到QQ空间和腾讯微博，您的好友或听众能够看到您发表的主题。&nbsp;&nbsp;<a class="xi2" href="javascript:void(0);" onclick="connect_syn_cancel();" title="取消发表主题时同步到QQ空间和腾讯微博，将来您可以到“设置-QQ绑定”页面重新设置。"><strong>暂不同步</strong></a>';
}
function connect_syn_tip_hide() {
setcookie('connect_synpost_tip', '', '-1');
$('synnotice').style.display = 'none';
}
function connect_syn_cancel() {
ajaxget('{$_G['siteurl']}connect.php?mod=config&op=synconfig', '');
$('connectPost_synQQ').className = 'syn_qq';
$('connectPost_synQQ').title = '未设置同步至QQ空间';
$('connect_publish_feed').value = 0;
$('connectPost_synT').className = 'syn_tqq';
$('connectPost_synT').title = '未设置同步至腾讯微博';
$('connect_publish_t').value = 0;
$('synnotice').style.display = 'none';
}
function connect_goto_setting() {
var _url = "{$_G['siteurl']}home.php?mod=spacecp&ac=plugin&id=qqconnect:spacecp";
hideMenu('fwin_dialog', 'dialog')
var _newWindow = window.open(_url, 'newWindow');
_newWindow.focus();
}
_attachEvent(window, 'load', function(){
connect_post_init();
});
</script>

EOF;
 if($allowconnectfeed) { 
$return .= <<<EOF

<a title="未设置同步至QQ空间" class="syn_qq" href="javascript:void(0);" id="connectPost_synQQ" rel="connect_publish_feed">QQ空间</a>
<input type="hidden" name="connect_publish_feed" id="connect_publish_feed" value="0" />

EOF;
 } if($allowconnectt) { 
$return .= <<<EOF

<a title="未设置同步至腾讯微博" class="syn_tqq" href="javascript:void(0);" id="connectPost_synT" rel="connect_publish_t">腾讯微博</a>
<input type="hidden" name="connect_publish_t" id="connect_publish_t" value="0" />

EOF;
 } } 
$return .= <<<EOF


EOF;
?><?php return $return; ?><?php }

function tpl_viewthread_share_method() {
global $_G; ?><?php
$__IMGDIR = IMGDIR;$__FORMHASH = FORMHASH;$return = <<<EOF


EOF;
 if($_G['member']['conisbind']) { 
$return .= <<<EOF

<a href="javascript:void(0);" ref="{$_G['connect']['qzone_share_url']}" id="k_qqshare" title="QQ空间" style="background-image: url({$__IMGDIR}/qzone.gif)">QQ空间</a>
<a href="javascript:void(0);" ref="{$_G['connect']['weibo_share_url']}" id="k_weiboshare" title="腾讯微博" style="background-image: url({$__IMGDIR}/weibo.png)">腾讯微博</a>
<a href="javascript:void(0);" ref="{$_G['connect']['pengyou_share_url']}" id="k_pengyoushare" title="腾讯朋友" style="background-image: url({$__IMGDIR}/pengyou.png)">腾讯朋友</a>
<script type="text/javascript">
var _is_oauth_user = 
EOF;
 if($_G['member']['conuinsecret']) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
var _is_feed_auth = 
EOF;
 if($_G['member']['conuinsecret'] && $_G['member']['is_feed']) { 
$return .= <<<EOF
true
EOF;
 } else { 
$return .= <<<EOF
false
EOF;
 } 
$return .= <<<EOF
;
_is_feed_auth = true;
var _share_buttons = ['k_qqshare', 'k_weiboshare', 'k_pengyoushare'];
function connect_share_init() {
for (var i = 0; i < _share_buttons.length; i++) {
$(_share_buttons[i]).onclick = function () {
connect_share_form(this);
return false;
}
}
}
function connect_share_form(obj) {
if (_is_oauth_user && _is_feed_auth) {
var _url = obj.getAttribute('ref');
showWindow(obj.id, _url, 'get', 1);
} else {
if (!_is_oauth_user) {
var _text = '很抱歉，由于分享功能升级，您需要使用QQ帐号重新登录本站，即可马上体验全新的分享到QQ空间、腾讯微博和腾讯朋友功能。<br /><span style="font-size: 12px;">提示：点击<a href="member.php?mod=logging&amp;action=logout&amp;formhash={$__FORMHASH}" class="xi2">这里退出</a>后，重新使用QQ账号登录。</span>';
var _button = '我知道了';
showDialog(_text, 'notice', null, 'connect_goto_setting()', 0, null, null, _button);
} else if (!_is_feed_auth) {
var _title = '授权提示';
var _text = '独乐乐不如众乐乐，马上完善授权，您将可以把本站精彩内容分享到QQ空间、腾讯微博和腾讯朋友，跟大家分享每个精彩瞬间。';
var _button = '修改授权';
showDialog(_text, 'notice', _title, 'connect_goto_setting()', 0, null, null, _button);
}
}
}
function connect_goto_setting() {
if (_is_oauth_user) {
var _url = "{$_G['siteurl']}home.php?mod=spacecp&ac=plugin&id=qqconnect:spacecp";
hideMenu('fwin_dialog', 'dialog');
var _newWindow = window.open(_url, 'newWindow');
_newWindow.focus();
} else {
hideMenu('fwin_dialog', 'dialog');
}
}
_attachEvent(window, 'load', function(){
connect_share_init();
});
</script>

EOF;
 } else { 
$return .= <<<EOF

<a href="javascript:void(0);" id="k_qqshare" onclick="window.open('{$_G['connect']['qzone_public_share_url']}?url='+encodeURIComponent(document.location.href));return false;" title="QQ空间" style="background-image: url({$__IMGDIR}/qzone.gif)">QQ空间</a>
<a href="javascript:void(0)" onclick="postToWb();" id="k_weiboshare" title="腾讯微博" style="background-image: url({$__IMGDIR}/weibo.png)">腾讯微博</a>
<a href="javascript:void(0);" onclick="window.open('{$_G['connect']['qzone_public_share_url']}?to=pengyou&url='+encodeURIComponent(document.location.href));return false;" id="k_pengyoushare" title="腾讯朋友" style="background-image: url({$__IMGDIR}/pengyou.png)">腾讯朋友</a>
<script type="text/javascript">
function postToWb(){
var _t = encodeURI(document.title);
var _url = encodeURIComponent(document.location);
var _appkey = encodeURI("{$_G['connect']['weibo_appkey']}");
var _pic = "{$_G['connect']['share_images']}";
var _site = '';
var _u = 'http://v.t.qq.com/share/share.php?url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic+'&title='+_t;
window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
}
</script>

EOF;
 } 
$return .= <<<EOF


EOF;
?><?php return $return; ?><?php }

function tpl_viewthread_bottom() {
global $_G; ?><?php
$__IMGDIR = IMGDIR;$return = <<<EOF

<script type="text/javascript">
var connect_qzone_share_url = '{$_G['connect']['qzone_share_url']}';
var connect_weibo_share_url = '{$_G['connect']['weibo_share_url']}';
var connect_thread_info = {
thread_url: '{$_G['siteurl']}{$GLOBALS['canonical']}',
thread_id: '{$_G['tid']}',
post_id: '{$_G['connect']['first_post']['pid']}',
forum_id: '{$_G['fid']}',
author_id: '{$_G['connect']['first_post']['authorid']}',
author: '{$_G['connect']['first_post']['author']}'
};

connect_autoshare = '{$_G['gp_connect_autoshare']}';
connect_isbind = '{$_G['member']['conisbind']}';
if(connect_autoshare == 1 && connect_isbind) {
_attachEvent(window, 'load', function(){
connect_share(connect_weibo_share_url, connect_openid);
});
}
</script>

EOF;
 if($_G['member']['conisbind']) { 
$return .= <<<EOF

<div id="connect_share_unbind" style="display: none;">
<div class="c hm">
<div style="font-size:14px; margin:10px 0;">绑定QQ帐号，轻松分享到QQ空间与腾讯微博</div>
<div><a href="connect.php?mod=config&amp;connect_autoshare=1" target="_blank"><img src="{$__IMGDIR}/qq_bind.gif" align="absmiddle" style="margin-top:5px;" /></a></div>
</div>
<input type="hidden" id="connect_thread_title" name="connect_thread_title" value="{$_G['forum_thread']['subject']}" />
</div>

EOF;
 } 
$return .= <<<EOF


EOF;
?><?php return $return; ?><?php }

function tpl_register_input() {
global $_G;

$connect_app_id = $_G['qc']['connect_app_id'];
$connect_openid = $_G['qc']['connect_openid']; ?><?php
$return = <<<EOF


EOF;
 if($_G['qc']['connect_is_user_info']) { 
$return .= <<<EOF

<div class="inputlist_zc" style="margin-bottom: 16px;">
<span style="vertical-align: top;">头像：</span>
<img src="{$_G['connect']['avatar_url']}/{$connect_app_id}/{$connect_openid}" width="48" height="48" style="margin: 0px 10px 10px 10px;" />
<p style="margin-left: 50px;"><label for="use_qzone_avatar">
<input type="checkbox" name="use_qzone_avatar" id="use_qzone_avatar" class="pc" value="1" checked="checked" tabindex="1" />
使用QQ空间头像
</label><p>
</div>

EOF;
 } 
$return .= <<<EOF

<input type="hidden" id="auth_hash" name="auth_hash" value="{$_G['qc']['connect_auth_hash']}" />
<input type="hidden" id="is_notify" name="is_notify" value="{$_G['qc']['connect_is_notify']}" />
<input type="hidden" id="is_feed" name="is_feed" value="{$_G['qc']['connect_is_feed']}" />

EOF;
?><?php return $return; ?><?php }

function tpl_register_bottom() {
global $_G;

$loginhash = 'L'.random(4); ?><?php
$js1 = <<<EOF


EOF;
 if($_G['qc']['usernames']) { 
$js1 .= <<<EOF

<div class="mtn">
常用名:
<a href="javascript:;" onclick="display('used_usernames_div')" class="xi2">{$_G['qc']['available_username_count']} 个可用</a>
<div id="used_usernames_div" class="pbm" style="display:none;">
EOF;
 if(is_array($_G['qc']['usernames'])) foreach($_G['qc']['usernames'] as $key => $val) { 
$js1 .= <<<EOF
<div>

EOF;
 if($val['available']) { 
$js1 .= <<<EOF

<label for="username_{$key}" style="margin-bottom:1px;" onclick="connect_use_available($('username_{$key}').value)">
<em>&nbsp;</em><input type="radio" id="username_{$key}" name="used_username" class="pr" value="{$val['username']}"
EOF;
 if($_G['qc']['first_available_username'] == $val['username']) { 
$js1 .= <<<EOF
 checked="checked"
EOF;
 } 
$js1 .= <<<EOF
 />
{$val['username']}
</label>

EOF;
 } else { 
$js1 .= <<<EOF

<label for="username_{$key}" style="margin-bottom:1px;">
<em>&nbsp;</em><input type="radio" id="username_{$key}" name="used_username" disabled="disabled" class="pr" value="{$val['username']}" />
<strike>{$val['username']}</strike>
</label>

EOF;
 } 
$js1 .= <<<EOF

</div>

EOF;
 } 
$js1 .= <<<EOF

</div>
</div>

EOF;
 } 
$js1 .= <<<EOF


EOF;
?><?php $js1 = str_replace(array("'", "\r", "\n"), array("\'", '', ''), $js1);
$change_qq_url = $_G['connect']['discuz_change_qq_url'];
$qq_nick = $_G['qc']['qq_nick']; ?><?php
$__IMGDIR = IMGDIR;$js2 = <<<EOF

<div class="tb cl qqregtb">
<ul>
<li id="connect_tab_1" class="a"><a href="javascript:;" onclick="connect_switch(1);this.blur();" tabindex="900">完善帐号信息</a></li>
<li id="connect_tab_2"><a onclick="connect_switch(2);this.blur();" href="javascript:;" tabindex="900">已有帐号？ 绑定我的帐号</a></li>
</ul>
</div>
<div class="rfm" id="connect_member_register_tip" style="display:block;">
<table>
<tr>
<th><img src="{$__IMGDIR}/connect_qq.gif" alt="QQ" class="mtn" /></th>
<td>您将使用QQ账号{$qq_nick}注册本站，<a href="{$change_qq_url}">更换QQ账号</a>？</td>
</tr>
</table>
</div>
<div class="rfm" id="connect_member_loginbind_tip" style="display:none;">
<table>
<tr>
<th><img src="{$__IMGDIR}/connect_qq.gif" alt="QQ" class="mtn" /></th>
<td>您将使用QQ账号{$qq_nick}绑定本站账号，<a href="{$change_qq_url}">更换QQ账号</a>？</td>
</tr>
</table>
</div>

EOF;
?><?php $js2 = str_replace(array("'", "\r", "\n"), array("\'", '', ''), $js2);
$first_available_username = str_replace("'", "\'", $_G['qc']['first_available_username']);
$connect_email = str_replace("'", "\'", $_G['qc']['connect_email']); ?><?php
$__FORMHASH = FORMHASH;$__IMGDIR = IMGDIR;$return = <<<EOF

<div id="r_bind" style="display: none;">
<h3 class="title_22px">
<em>绑定账号</em>
<span><a href="javascript:;" id="connect_register_profile">完善账号信息</a></span>
</h3>
<div class="r_top_message" style="display: block;">您将使用QQ账号{$qq_nick}绑定本站账号，<a href="{$change_qq_url}">更换QQ账号</a>？</div>
<div class="failure" id="returnmessage4"></div>

<form method="post" autocomplete="off" name="login" id="loginform_{$loginhash}" class="cl"  action="member.php?mod=connect&amp;action=login&amp;loginsubmit=yes
EOF;
 if(!empty($_G['gp_handlekey'])) { 
$return .= <<<EOF
&amp;handlekey={$_G['gp_handlekey']}
EOF;
 } 
$return .= <<<EOF
&amp;loginhash={$loginhash}">
<input type="hidden" name="formhash" value="{$__FORMHASH}" />
<input type="hidden" name="referer" value="{$_G['qc']['dreferer']}" />
<input type="hidden" id="auth_hash" name="auth_hash" value="{$_G['qc']['connect_auth_hash']}" />
<input type="hidden" id="is_notify" name="is_notify" value="{$_G['qc']['connect_is_notify']}" />
<input type="hidden" id="is_feed" name="is_feed" value="{$_G['qc']['connect_is_feed']}" />


EOF;
 if($_G['qc']['uinlimit']) { 
$return .= <<<EOF

<!--<div class="bm xi1 xw1"><div class="bm_c"><img src="{$__IMGDIR}/connect_qq.gif" alt="QQ" class="vm" />&nbsp;您的QQ帐号在本站注册的帐号数量达到上限，请绑定已有帐号，或<a href="{$change_qq_url}">更换其他QQ账号</a></div></div>-->
<div class="inputlist">
<img src="{$__IMGDIR}/connect_qq.gif" alt="QQ" class="mtn" />
您的QQ帐号在本站注册的帐号数量达到上限，请绑定已有帐号，或<a href="{$change_qq_url}">更换其他QQ账号</a>
</div>

EOF;
 } 
$return .= <<<EOF


<div class="inputlist">
<label class="labelicon" for="username_{$loginhash}" id="n_username_{$loginhash}">账号</label>
<input type="text" name="username" id="username_{$loginhash}" autocomplete="off" size="30" class="input_text w307 logoicon" tabindex="1" value="{$username}" />
</div>
<div class="inputlist">
<label class="labelicon" for="password3_{$loginhash}" id="n_password3_{$loginhash}">密码</label>
<input type="password" id="password3_{$loginhash}" name="password" size="30" class="input_text w307 passwordicon" tabindex="1" />
</div>
            <div class="yzm_bind" style="margin-bottom: 20px;display: none">
                <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r={$loginhash}" type="text/javascript"></script>
            </div>
            
EOF;
 if(empty($_G['gp_auth']) || $questionexist) { 
$return .= <<<EOF

<div class="inputlist_select" style="z-index:10;">
<span class="titlename">安全提问</span>
<div class="selectdivnote" id="qu_select">
<span id="qu_title">
EOF;
 if($questionexist) { 
$return .= <<<EOF
安全提问
EOF;
 } else { 
$return .= <<<EOF
安全提问(未设置请忽略)
EOF;
 } 
$return .= <<<EOF
</span>
<div class="selectdivnote_down" id="qu_list">
<ul>
<li val="0" style="display: none;" id="qu_0">
EOF;
 if($questionexist) { 
$return .= <<<EOF
安全提问
EOF;
 } else { 
$return .= <<<EOF
安全提问(未设置请忽略)
EOF;
 } 
$return .= <<<EOF
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
<input type="text" name="answer" id="loginanswer_{$loginhash}" class="safeanswer" autocomplete="off" tabindex="1"
EOF;
 if($questionexist) { 
$return .= <<<EOF
 style="display:block;"
EOF;
 } 
$return .= <<<EOF
/>
</div>
</div>
<input type="hidden" name="questionid" id="loginquestionid_{$loginhash}" value="0" />
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
$("#loginquestionid_{$loginhash}").val(qu_val);
if(!qu_val){
$("#qu_0").hide();

EOF;
 if(!$questionexist) { 
$return .= <<<EOF

$("#loginanswer_{$loginhash}").hide();

EOF;
 } 
$return .= <<<EOF

} else {
$("#qu_0").show();
$("#loginanswer_{$loginhash}").show();
}
});
$(document).click(function(event) {
if (!$(event.target).closest("#qu_select").length) {
$("#qu_list").hide();
};
});
                $("#loginform_{$loginhash}").submit(function(){
                    var is_yzm = loginIsAppearVerify();
                    if(is_yzm){
                        $('.yzm_bind').show();
                    }
                    ajaxpost('loginform_{$loginhash}', 'returnmessage4', 'returnmessage4', '','',function(){
                        $('#returnmessage4').css('display','block');

                    });
                    return false;
                });
                function loginIsAppearVerify(){
                    var flag = false;
                    var username = jQuery.trim($('#username_{$loginhash}').val());
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

EOF;
 } 
$return .= <<<EOF


<div class="inputlist">
<input name="_loginsubmit" type="submit" class="button_bd" tabindex="1" value="" />
</div>
</form>
</div>

<script type="text/javascript">

EOF;
 if($_G['setting']['regconnect']) { 
$return .= <<<EOF

//$('reginfo_a').parentNode.className = '';
/*when try to use qq account to login, it will redirect to registeration page, enable password textarea

$('r_{$_G['setting']['reginput']['password']}').parentNode.style.display = 'none';
$('r_{$_G['setting']['reginput']['password']}').parentNode.outerHTML += '{$js1}';
$('r_{$_G['setting']['reginput']['password']}').required = 0;
$('r_{$_G['setting']['reginput']['password2']}').parentNode.style.display = 'none';
$('r_{$_G['setting']['reginput']['password2']}').required = 0;

var cPwd = true,cPwd2 = true;
*/
//$('main_hnav').outerHTML = '{$js2}';
jQuery('#r_title').html("完善帐号信息");
jQuery('#r_tip').html('<a href="javascript:;" id="connect_register_bind">已有帐号？ 绑定我的帐号</a>');
jQuery('#r_top_message').html('<img src="{$__IMGDIR}/connect_qq.gif" alt="QQ" /> 您将使用QQ账号{$qq_nick}注册本站，<a href="{$change_qq_url}">更换QQ账号</a>？').show();
jQuery('#connect_register_bind').click(function(){
jQuery('#r_main').hide();
jQuery('#r_bind').show();
});
jQuery('#connect_register_profile').click(function(){
jQuery('#r_bind').hide();
jQuery('#r_main').show();
});
function connect_switch(op) {
$('returnmessage4').className='';
$('returnmessage4').innerHTML='';
if(op == 1) {
$('loginform_{$loginhash}').style.display='none';$('registerform').style.display='block';$('connect_member_register_tip').style.display='block';$('connect_member_loginbind_tip').style.display='none';
EOF;
 if($_G['setting']['regconnect']) { 
$return .= <<<EOF
$('connect_tab_1').className='a';$('connect_tab_2').className='';
EOF;
 } 
$return .= <<<EOF

} else {
$('loginform_{$loginhash}').style.display='block';$('registerform').style.display='none';$('connect_member_register_tip').style.display='none';$('connect_member_loginbind_tip').style.display='block';
EOF;
 if($_G['setting']['regconnect']) { 
$return .= <<<EOF
$('connect_tab_1').className='';$('connect_tab_2').className='a';
EOF;
 } 
$return .= <<<EOF

}
}
function connect_use_available(value) {
$('r_{$_G['setting']['reginput']['username']}').value = value;
checkusername(value);
}

EOF;
 if(!$_G['setting']['regconnect']) { 
$return .= <<<EOF

_attachEvent(window, 'load', function () { connect_switch(2); }, document);

EOF;
 } if($_G['qc']['uinlimit']) { 
$return .= <<<EOF

$('registerformsubmit').disabled = true;

EOF;
 } if($first_available_username) { 
$return .= <<<EOF

$('r_{$_G['setting']['reginput']['username']}').value = '{$first_available_username}';

EOF;
 } 
$return .= <<<EOF

//$('r_{$_G['setting']['reginput']['email']}').value = '{$connect_email}';

EOF;
 if($_G['gp_action'] != 'activation') { 
$return .= <<<EOF

$('registerformsubmit').className = 'button_qq';

EOF;
 } } else { 
$return .= <<<EOF

$('layer_reginfo_t').innerHTML = '绑定我的帐号';

EOF;
 } if($_G['gp_action'] != 'activation') { if(!$_G['setting']['autoidselect']) { 
$return .= <<<EOF

simulateSelect('loginfield_{$loginhash}');

EOF;
 } } 
$return .= <<<EOF


jQuery("#username_{$loginhash}").focus(function(){
jQuery("#n_username_{$loginhash}").html("");
}).blur(function(){
!jQuery(this).val() && jQuery("#n_username_{$loginhash}").html("账号");
});
jQuery("#password3_{$loginhash}").focus(function(){
jQuery("#n_password3_{$loginhash}").html("");
}).blur(function(){
!jQuery(this).val() && jQuery("#n_password3_{$loginhash}").html("密码");
});
</script>

EOF;
?><?php return $return; ?><?php } ?>