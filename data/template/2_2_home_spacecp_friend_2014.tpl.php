<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_friend_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/spacecp_friend_2014.htm', './template/8264/home/space_left_2014_old.htm', 1506049981, '2', './data/template/2_2_home_spacecp_friend_2014.tpl.php', './template/8264', 'home/spacecp_friend_2014')
|| checktplrefresh('./template/8264/home/spacecp_friend_2014.htm', './template/8264/home/space_footer_2014.htm', 1506049981, '2', './data/template/2_2_home_spacecp_friend_2014.tpl.php', './template/8264', 'home/spacecp_friend_2014')
;?><?php include template('common/header_8264_new'); if(!$_G['inajax']) { ?>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/home/home_spacecp.css?<?php echo VERHASH;?>" />
<link href="http://static.8264.com/static/css/home/notice.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<div class="w980">
<div class="t_980">����</div>
<div class="clear_b"><div class="pl">
<div class="l_196" id="h_left_menu">
<ul>
<li><a href="home.php?mod=space&amp;do=notice"><span class="tz">֪ͨ<?php if($space['notifications']) { ?>(<i><?php echo $space['notifications'];?></i>)<?php } ?></span></a></li>
<li><a href="home.php?mod=space&amp;do=notice&amp;type=invitation">
<span class="yq">����<?php if($invite_thread_count) { ?>(<i id="sidenewinvitecount"><?php echo $invite_thread_count;?></i>)<?php } ?></span></a>
</li>
<li>
<a href="home.php?mod=space&amp;do=notice&amp;type=smessage"><span class="xx" id="pm_link">����Ϣ<?php if($_G['member']['newpm']) { ?>(<i id="sidepmcount"><?php echo $_G['member']['newpm'];?></i>)<?php } ?></span></a>
</li>
<li><a href="home.php?mod=task&amp;item=new"><span class="rw">����<?php if($taskcount) { ?>(<i><?php echo $taskcount;?></i>)<?php } ?></span></a></li>
<li><a href="home.php?mod=space&amp;do=notice&amp;type=friend">
<span class="fqq">����<?php if($space['pendingfriends']) { ?>(<i id="sidependingFriendsNum"><?php echo $space['pendingfriends'];?></i>)<?php } ?></span></a>
</li>
<li>
<a href="home.php?mod=space&amp;do=notice&amp;type=greeting"><span class="zh">�к�<?php if($space['pokes']) { ?>(<i id="sidepokesNum"><?php echo $space['pokes'];?></i>)<?php } ?></span></a>
</li>
</ul>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
var m_t=$("#h_left_menu").position().top;
$(window).scroll(function(){
if ($(document).scrollTop()-50 >= m_t){
$("#h_left_menu").addClass("l_196_fixd");
}else{
$("#h_left_menu").removeClass("l_196_fixd");
}
});
});
jQuery(".w980").css('min-height',jQuery(window).height()-130);
</script><div style="float:right; width:760px;">
<?php if($op == 'syn' || $op == 'find' || $op == 'search' || $op == 'group' || $op == 'request') { ?>
<div class="top_q_d clear_b">
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=friend">�����б�</a>
<a href="home.php?mod=spacecp&amp;ac=search">���Һ���</a>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=find"<?php if($op=='find') { ?> class="zhong"<?php } ?>>������ʶ����</a>
<a href="home.php?mod=space&amp;do=notice&amp;type=friend"<?php if($op=='request') { ?> class="zhong"<?php } ?>>��������</a>
<?php if($op=='group') { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group"<?php if($op=='group') { ?> class="zhong"<?php } ?>>��ע����</a>
<?php } if($op=='request') { if($list) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;confirm=1&amp;key=<?php echo $space['key'];?>" onclick="return confirm('��ȷ��Ҫ�������еĺ���������');" class="ckqb">�������к�������(����)</a>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=addconfirm&amp;key=<?php echo $space['key'];?>" class="ckqb">��׼ȫ������</a>
<?php } } ?>



</div>
<?php } } if($op == 'search') { ?>

<h3 class="tbmu">�����û����:</h3><?php include template('home/space_list'); } elseif($op=='changenum') { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�����ȶ�</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" id="changenumform_<?php echo $uid;?>" name="changenumform_<?php echo $uid;?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=changenum&amp;uid=<?php echo $uid;?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<p>�������ѵ��ȶ�</p>
<p>�µ��ȶ�:<input type="text" name="num" value="<?php echo $friend['num'];?>" size="5" class="px" /> (0~9999֮���һ������)</p>
</div>
<p class="o pns">
<button type="submit" name="changenumsubmit" class="pn pnc" value="true"><strong>ȷ��</strong></button>
</p>
</form>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
friend_delete(values['uid']);
$('spannum_'+values['fid']).innerHTML = values['num'];
hideWindow('<?php echo $_G['gp_handlekey'];?>');
}
</script>
<?php } elseif($op=='group') { ?>

<p class="tbmu">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group"<?php if(!isset($_GET['group'])) { ?> class="a"<?php } ?>>ȫ������</a><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=group&amp;group=<?php echo $key;?>"<?php if(isset($_GET['group']) && $_GET['group']==$key) { ?> class="a"<?php } ?>><?php echo $value;?></a>
<?php } ?>
</p>
<p class="tbmu">��ѡ���ĺ��ѽ��з��飬�ȶȱ�ʾ����������ѻ����Ĵ�����</p>

<?php if($list) { ?>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=friend&amp;op=group&amp;ref">
<div id="friend_ul">
<ul class="buddy cl"><?php if(is_array($list)) foreach($list as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo avatar($value[uid],small); ?></a></div>
<input type="checkbox" name="fuids[]" value="<?php echo $value['uid'];?>" class="pc" /> <a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo $value['username'];?></a>
<p class="xg1">�ȶ�:<?php echo $value['num'];?></p>
<p class="xg1"><?php echo $value['group'];?></p>
</li>
<?php } ?>
</ul>
</div>
<div class="mtn">
<input type="checkbox" id="chkall" name="chkall" onclick="checkAll(this.form, 'fuids')" class="pc" />
<label for="chkall">ȫѡ</label>
�����û���:
<select name="group" class="ps vm select_g" ><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><option value="<?php echo $key;?>"><?php echo $value;?></option>
<?php } ?>
</select>&nbsp;
<button type="submit" name="btnsubmit" value="true" class="pn pnp vm"><strong>ȷ��</strong></button>
</div>
<?php if($multi) { ?>
<div class="fenyewarpten pgs cl mtm"><?php echo $multi;?></div>
<?php } else { ?>
<div class="fheight"></div>
<?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="groupsubmin" value="true" />
</form>
<?php } else { ?>
<div class="emp">û������û��б�</div>
<?php } } elseif($op=='groupignore') { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�����û��鶯̬</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<div id="<?php echo $group;?>">
<form method="post" autocomplete="off" id="groupignoreform" name="groupignoreform" action="home.php?mod=spacecp&amp;ac=friend&amp;op=groupignore&amp;group=<?php echo $group;?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="groupignoresubmit" value="true" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<?php if(!isset($space['privacy']['filter_gid'][$group])) { ?>
<p>����ҳ����ʾ���û���ĺ��Ѷ�̬</p>
<?php } else { ?>
<p>����ҳ��ʾ���û���ĺ��Ѷ�̬</p>
<?php } ?>
</div>
<p class="o pns">
<button type="submit" name="groupignoresubmit_btn" class="pn pnc" value="true"><strong>ȷ��</strong></button>
</p>
</form>
</div>
<?php } elseif($op=='request') { if($maxfriendnum) { ?>
<p>(��������� <?php echo $maxfriendnum;?> ������)</p>
<p>
<?php if($_G['magic']['friendnum']) { ?>
<img src="http://static.8264.com/static/image/magic/friendnum.small.gif" alt="friendnum" class="vm" />
<a id="a_magic_friendnum" href="home.php?mod=magic&amp;mid=friendnum" onclick="showWindow(this.id, this.href, 'get', '0')">��Ҫ���ݺ�����</a>
(����Թ�����ߡ�<?php echo $_G['setting']['magics']['friendnum'];?>�������ݣ����Լ�������Ӹ���ĺ��ѡ�)
<?php } ?>
</p>
<?php } ?>

<div class="list760_bimg">
<?php if($list) { ?>
<ul id="friend_ul"><?php if(is_array($list)) foreach($list as $key => $value) { ?><li id="friend_tbody_<?php echo $value['fuid'];?>">
<a href="home.php?mod=space&amp;uid=<?php echo $value['fuid'];?>" class="tx"><?php echo avatar($value[fuid],middle); ?></a>
<div class="hy_rcon">
<a href="home.php?mod=space&amp;uid=<?php echo $value['fuid'];?>" class="name"><?php echo $value['fusername'];?></a>
<?php if($ols[$value['fuid']]) { ?><img src="http://static.8264.com/static/image/common/ol.gif" alt="online" title="����" class="vm" /><?php } if($value['videostatus']) { ?><img src="http://static.8264.com/static/image/common/videophoto.gif" alt="videophoto" class="vm" /> <span class="xg1">��ͨ����Ƶ��֤</span><?php } if($value['note']) { ?><div class="quote"><blockquote id="quote"><?php echo $value['note'];?></blockquote></div><?php } ?>
<span class="date"><?php echo dgmdate($value[dateline], 'Y-m-d H:i'); ?></span>
<div id="friend_<?php echo $value['fuid'];?>">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $value['fuid'];?>&amp;handlekey=afrfriendhk_<?php echo $value['uid'];?>" id="afr_<?php echo $value['fuid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="pzsq">��׼</a>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $value['fuid'];?>&amp;confirm=1&amp;handlekey=afifriendhk_<?php echo $value['uid'];?>" id="afi_<?php echo $value['fuid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="hlsq">����</a>
</div>
</div>
<div id="cf_<?php echo $value['fuid'];?>"></div>
</li>
<?php } ?>
</ul>
<script type="text/javascript">
jQuery("#friend_ul>li").eq(0).addClass('bt_without');
</script>
<?php } else { ?>
û���µĺ�������
<?php } ?>
</div>
<?php if($multi) { ?>
<div class="fenyewarpten clear_b"><?php echo $multi;?></div>
<?php } else { ?>
<div class="fheight"></div>
<?php } } elseif($op=='getcfriend') { ?>

<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">��ͬ����</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<div class="c" style="width: 370px;">
<?php if($list) { if(count($list)>14) { ?>
<p>��ǰ�����ʾ 15 λ��ͬ�ĺ���</p>
<?php } else { ?>
<p>����Ŀǰ�� <?php echo count($list) ?> λ��ͬ�ĺ���</p>
<?php } ?>
<ul class="mtm ml mls cl"><?php if(is_array($list)) foreach($list as $key => $value) { ?><li>
<div class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>"><?php echo avatar($value[uid],small); ?></a></div>
<p><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" title="<?php echo $value['username'];?>"><?php echo $value['username'];?></a></p>
</li>
<?php } ?>
</ul>
<?php } else { ?>
<p>����Ŀǰ��û�й�ͬ�ĺ���</p>
<?php } ?>
</div>
<?php } elseif($op=='add2') { ?>

<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">��׼����</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" id="addratifyform_<?php echo $tospace['uid'];?>" name="addratifyform_<?php echo $tospace['uid'];?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $tospace['uid'];?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="add2submit" value="true" />
<input type="hidden" name="from" value="<?php echo $_G['gp_from'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table cellspacing="0" cellpadding="0">
<tr>
<th valign="top" width="60" class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $tospace['uid'];?>"><?php echo avatar($tospace[uid],small); ?></th>
<td valign="top">
<p>��׼ <strong><?php echo $tospace['username'];?></strong> �ĺ������󣬲�����:</p>
<table><tr><?php $i=0; if(is_array($groups)) foreach($groups as $key => $value) { ?><td style="padding:8px 8px 0 0;"><input type="radio" name="gid" id="group_<?php echo $key;?>" value="<?php echo $key;?>"<?php echo $groupselect[$key];?>> <label for="group_<?php echo $key;?>"><?php echo $value;?></label></td>
<?php if($i%2==1) { ?></tr><tr><?php } ?><?php $i++; } ?>
</tr></table>
</td>
</tr>
</table>
</div>
<p class="o pns">
<button type="submit" name="add2submit_btn" value="true" class="pn pnc"><strong>��׼</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
if(values['from'] == 'notice') {
getNewFriendQuery(values['uid']);
} else {
var totalPage = 1;
var curPage = 1;
if(jQuery('span.mulitpage').length == 1) {
if(jQuery('span.mulitpage strong').length == 1) {
curPage = parseInt(jQuery('span.mulitpage strong').text());
}
if(jQuery('span.mulitpage *:last').prop("tagName") != 'STRONG') {
totalPage = parseInt(jQuery('span.mulitpage a[class!=nxt]:last').text().replace(/[^0-9]/gi, ''));
}
else {
totalPage = curPage;
}
}
var ul = jQuery('#friend_tbody_' + values['uid']).parent('ul');
$('friend_tbody_' + values['uid']).remove();
var pageCount =  ul.children('li').length;
if(pageCount == 0) {
if(totalPage == 1) {
ul.html('<li id="more_tips_new" style="text-align:center;"><div style="font-size:14px; text-align:center; padding:10px 0px;"><img src="http://static.8264.com/static/images/no_new_notice.png"/><span style="padding-top:10px; display:block;"><p>����ǰû�� <em>����</em> ������ʾ</p></span></div></li>');
}
else {
var page = curPage < totalPage ? curPage : (totalPage - 1);
var redirect = "home.php?mod=space-do=notice-type=friend-action=show-page=" + page + "-refresh=" + new Date().getTime();
window.location.href = redirect.replace(/-/g, '&');
}
}
}
}
</script>
<?php } elseif($op=='getonequery') { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $friendquery['fuid'];?>" class="tx"><?php echo avatar($friendquery[fuid],small); ?></a>
<div class="listcon" id="pendingfriend_<?php echo $friendquery['fuid'];?>">
<div class="con615">
<div class="upcon">
<a href="home.php?mod=space&amp;uid=<?php echo $friendquery['fuid'];?>" class="name"><?php echo $friendquery['fusername'];?></a>
<span class="wz58">�������Ϊ����<?php if($friendquery['note']) { ?>,&nbsp;����:<?php echo $friendquery['note'];?><?php } ?></span>
<span class="time"><?php echo dgmdate($friendquery[dateline], 'Y-m-d H:i'); ?></span>
</div>
<div class="downcon">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $friendquery['fuid'];?>&amp;from=notice" id="afr_<?php echo $friendquery['fuid'];?>" class="pzsq" onclick="showWindow(this.id, this.href, 'get', 0);">��׼</a>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $friendquery['fuid'];?>&amp;confirm=1&amp;from=notice" id="afi_<?php echo $friendquery['fuid'];?>" class="hlsq" onclick="showWindow(this.id, this.href, 'get', 0);">����</a>
</div>								
</div>
</div>
<?php } elseif($op=='getinviteuser') { ?>
<?php echo $jsstr;?>
<?php } if(!$_G['inajax']) { ?>
</div>
</div>
</div><script type="text/javascript">
var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
ie6=true;
}
if(ie6){
jQuery(".w980").css('height',jQuery(window).height()-130);
} else {
jQuery(".w980").css('min-height',jQuery(window).height()-130);
}

jQuery(".list760 li").hover(function(){
jQuery(this).addClass("z");
},function(){
jQuery(this).removeClass("z");
})
</script><?php } include template('common/footer_8264_new'); ?>