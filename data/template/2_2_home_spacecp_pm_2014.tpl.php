<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_pm_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/spacecp_pm_2014.htm', './template/8264/home/space_left_2014.htm', 1509432082, '2', './data/template/2_2_home_spacecp_pm_2014.tpl.php', './template/8264', 'home/spacecp_pm_2014')
|| checktplrefresh('./template/8264/home/spacecp_pm_2014.htm', './template/8264/common/seditor_2014.htm', 1509432082, '2', './data/template/2_2_home_spacecp_pm_2014.tpl.php', './template/8264', 'home/spacecp_pm_2014')
|| checktplrefresh('./template/8264/home/spacecp_pm_2014.htm', './template/8264/common/seditor_new_2014.htm', 1509432082, '2', './data/template/2_2_home_spacecp_pm_2014.tpl.php', './template/8264', 'home/spacecp_pm_2014')
|| checktplrefresh('./template/8264/home/spacecp_pm_2014.htm', './template/8264/common/seditor_2014.htm', 1509432082, '2', './data/template/2_2_home_spacecp_pm_2014.tpl.php', './template/8264', 'home/spacecp_pm_2014')
|| checktplrefresh('./template/8264/home/spacecp_pm_2014.htm', './template/8264/home/space_footer_2014.htm', 1509432082, '2', './data/template/2_2_home_spacecp_pm_2014.tpl.php', './template/8264', 'home/spacecp_pm_2014')
;?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/common/bootstrap.min.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/home/notice.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<?php if(!$_G['inajax']) { ?>
<div class="w980">
<div class="t_980">������Ϣ</div>
<div class="clear_b">	<div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked navigate_notification">
<li <?php if($notify_type == 'notification') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=notification"><s class="menu-nav-icon icon-1">����</s><span showclass="li_tz">֪ͨ
</span><?php if(isset($space['notifications']) && $space['notifications']) { ?><em class="number"><?php echo $space['notifications'];?></em><?php } ?></a>
</li>
<li <?php if($notify_type == 'invitation') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=invitation"><s class="menu-nav-icon icon-2">����</s><span showclass="li_yq">����
</span><?php if(isset($space['newinvite']) && $space['newinvite']) { ?><em class="number"><?php echo $space['newinvite'];?></em><?php } ?></a>
</li>
<!--
<li <?php if($notify_type == 'greeting') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=greeting"><s class="menu-nav-icon icon-5">�к�</s><span showclass="li_dzh">�к�
</span><?php if(isset($space['pokes']) && $space['pokes']) { ?><em class="number"><?php echo $space['pokes'];?></em><?php } ?></a>
</li>
-->
<li <?php if($notify_type == 'smessage' || $_G['gp_ac'] == 'pm' || $_G['gp_do'] == 'pm') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=smessage"><s class="menu-nav-icon icon-7">����Ϣ</s><span showclass="li_dxx">����Ϣ
</span><?php if(isset($space['newpm']) && $space['newpm']) { ?><em class="number smessage_number"><?php echo $space['newpm'];?></em><?php } ?></a>
</li>

<li <?php if($_G['gp_mod'] == 'task') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=task&item=new"><s class="menu-nav-icon icon-8">����</s><span showclass="li_dxx">����
</span><?php if($taskcount) { ?><em class="number smessage_number"><?php echo $taskcount;?></em><?php } ?></a>
</li>
</ul>
        <div style="margin:10px 0px 0px 0px;"><?php echo adshow("custom_435"); ?></div>
</div>
    
<div class="r_760">
<?php } ?>	
<?php if($_GET['op'] == 'getpmuser') { ?>
<?php echo $jsstr;?>
<?php } elseif($_GET['op'] == 'ignore') { ?>

<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">����<?php echo $username;?></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form id="ignoreuserform" name="ignoreuserform" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=ignore&amp;only=1"  <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="ignoresubmit" value="true" />
<input type="hidden" name="ignoreuser" value="<?php echo $_G['gp_username'];?>" />
<input type="hidden" name="single" value="1" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">ȷ�����θ��û���</div>
<p class="o pns">
<button type="submit" name="deletesubmit_btn" value="true" class="pn pnc"><strong>ȷ��</strong></button>
</p>
</form>
<?php } elseif($_GET['op'] == 'showmsg') { if($msgonly) { if(is_array($msglist)) foreach($msglist as $day => $msgarr) { ?><li class="cl">
<h4 class="xg1"><?php echo $day;?></h4>
</li><?php if(is_array($msgarr)) foreach($msgarr as $key => $value) { ?><?php $class=$value['msgtoid']==$_G['uid']?'cl':'cl pmm'; ?><li class="<?php echo $class;?>">
<div class="pmt"><?php echo $value['msgfrom'];?>: </div>
<div class="pmd"><?php echo $value['message'];?></div>
</li>
<?php } } } else { ?>
<div class="pm">
<h3 class="flb">
<em>������<?php echo $msguser;?>�����С���<?php if($online) { ?>[����]<?php } else { ?>[����]<?php } ?></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<div class="pm_tac bbda cl">
<a href="home.php?mod=space&amp;do=pm&amp;subop=view&amp;pmid=<?php echo $pmid;?>&amp;touid=<?php echo $touid;?>&amp;daterange=<?php echo $daterange;?>" class="y" target="_blank">�鿴��<?php echo $msguser;?>�������¼</a>
<a href="home.php?mod=space&amp;uid=<?php echo $touid;?>" target="_blank">����<?php echo $msguser;?>�Ŀռ�</a>
</div>
<div class="c">
<ul class="pmb" id="msglist"><?php if(is_array($msglist)) foreach($msglist as $day => $msgarr) { ?><li class="cl">
<h4 class="xg1"><?php echo $day;?></h4>
</li><?php if(is_array($msgarr)) foreach($msgarr as $key => $value) { ?><?php $class=$value['msgtoid']==$_G['uid']?'cl':'cl pmm'; ?><li class="<?php echo $class;?>">
<div class="pmt"><?php echo $value['msgfrom'];?>: </div>
<div class="pmd"><?php echo $value['message'];?></div>
</li>
<?php } } ?>
</ul>
<script type="text/javascript">
var refresh = true;
var refreshHandle = -1;
</script>
<div class="pmfm">
<form id="pmform_<?php echo $touid;?>" name="pmform_<?php echo $touid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?php echo $touid;?>" onsubmit="parsepmcode(this);<?php if($_G['inajax']) { ?>ajaxpost(this.id,  'return_<?php echo $_G['gp_handlekey'];?>');<?php } ?>">
<input type="hidden" name="pmsubmit" value="true" />
<input type="hidden" name="touid" value="<?php echo $touid;?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" class="xi1" style="margin-bottom:5px"></div>
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<?php } ?>
<div class="tedt">
<div class="bar"><?php $seditor = array('pm', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="���ּӴ�" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="���ɫ"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="��ɫ"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="��ɫ"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<style type="text/css">
#pmimg_menu #pmimg_param_1 {width:93%!important;}
</style>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="ͼƬ" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?> style="margin-left:5px;">ͼƬ</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>����</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } ?></div>
<div class="area">
<textarea rows="3" cols="80" name="message" class="pt" id="pmmessage" onkeydown="ctrlEnter(event, 'pmsubmit_btn');"></textarea>
<input type="hidden" name="messageappend" id="messageappend" value="<?php echo $messageappend;?>" />
</div>
</div>
<div class="mtn pns cl">
 					<button type="submit" class="pn pnc" id="pmsubmit_btn"><strong>����</strong></button>
 					<div class="pma mtn z">
<a href="javascript:;" title="ˢ��" onclick="refreshMsg();"><img src="<?php echo IMGDIR;?>/pm-ico5.png" alt="ˢ��" class="vm" /> ˢ��</a>
 					</div>
</div>
</form>
<script type="text/javascript">var forumallowhtml = 0,allowhtml = 0,allowsmilies = true,allowbbcode = parseInt('<?php echo $_G['group']['allowsigbbcode'];?>'),allowimgcode = parseInt('<?php echo $_G['group']['allowsigimgcode'];?>');var DISCUZCODE = [];DISCUZCODE['num'] = '-1';DISCUZCODE['html'] = [];</script>
<script src="<?php echo $_G['setting']['jspath'];?>bbcode.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">
var msgListObj = $('msglist');
msgListObj.scrollTop = msgListObj.scrollHeight;
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
var liObj = document.createElement("li");
var pmMsg = $('pmmessage');
liObj.className = 'cl pmm';
pmMsg.value = ($('messageappend').value ? $('messageappend').value + '\n' : '') + pmMsg.value;
$('messageappend').value = '';
liObj.innerHTML = '<div class="pmt"><?php echo $_G['username'];?>: </div><div class="pmd">'+bbcode2html(parseurl(pmMsg.value))+'</div>';
msgListObj.appendChild(liObj);
msgListObj.scrollTop = msgListObj.scrollHeight;
pmMsg.value = "";
showCreditPrompt();
}

function refreshMsg() {
if(refresh) {
var x = new Ajax();
x.get('home.php?mod=spacecp&ac=pm&op=showmsg&msgonly=1&touid=<?php echo $touid;?>&pmid=<?php echo $pmid;?>&inajax=1&daterange=<?php echo $daterange;?>', function(s){
msgListObj.innerHTML = s;
msgListObj.scrollTop = msgListObj.scrollHeight;
   						});
} else {
window.clearInterval(refreshHandle);
}
}
refreshHandle = window.setInterval('refreshMsg();', 8000);
hideMenu();
</script>
</div>
</div>
</div>
<?php } } else { if(!$_G['inajax']) { ?>
<div class="top_q_d clear_b">
<a href="javascript:;" class="zhong">������Ϣ</a>
<a href="home.php?mod=space&amp;do=pm&amp;view=inbox" class="ckqb">�����ռ���</a>
</div>
<div class="kuang_gray" id="__pmform_<?php echo $pmid;?>">
<form id="pmform_<?php echo $pmid;?>" name="pmform_<?php echo $pmid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?php echo $touid;?>&amp;pmid=<?php echo $pmid;?>" onsubmit="parsepmcode(this);<?php if($_G['inajax']) { ?>ajaxpost(this.id,  'return_<?php echo $_G['gp_handlekey'];?>');<?php } ?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="pmsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?>
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<?php } if(!$touid) { ?>
<div class="xxfs clear_b">
<span class="nameth">�ռ��ˣ�</span>
<div class="formtd"><input type="text" id="username" name="username" value="" class="input_g w535" /></div>
</div>
<?php } ?>

<div class="xxfs clear_b">
<span class="nameth">д��Ϣ��</span>
<div class="formtd">
<div class="pinglunmid">
<div class="edierbar clboth"><?php $seditor = array('reply', array('bold', 'color')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="���ּӴ�" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="���ɫ"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="��ɫ"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="��ɫ"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="ͼƬ" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
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
<textarea rows="8" cols="40" name="message" class="pt" id="sendmessage" onkeydown="ctrlEnter(event, 'pmsubmit_btn');"></textarea>
</div>
</div>
<div class="mt17">
<button type="submit" name="pmsubmit_btn" id="pmsubmit_btn" value="true" class="fsbutton"></button>
</div>
</div>					
</div>

</form>
</div>
<?php } else { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">������Ϣ</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>

<div id="__pmform_<?php echo $pmid;?>">
<form id="pmform_<?php echo $pmid;?>" name="pmform_<?php echo $pmid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?php echo $touid;?>&amp;pmid=<?php echo $pmid;?>" onsubmit="parsepmcode(this);<?php if($_G['inajax']) { ?>ajaxpost(this.id,  'return_<?php echo $_G['gp_handlekey'];?>');<?php } ?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="pmsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?>
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<?php } ?>
<div class="c">
<table cellspacing="0" cellpadding="0" class="tfm pmform">
<?php if(!$touid) { ?>
<tr>
<th><label for="username">�ռ���:</label></th>
<td>
<input type="text" id="username" name="username" value="" class="px" />
</td>
</tr>

<?php } ?>
<tr>
<th><label for="message">����:</label></th>
<td>
<div class="tedt">
<div class="bar"><?php $seditor = array('send', array('bold', 'color', 'img', 'link', 'quote', 'code', 'smilies')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="���ּӴ�" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="���ɫ"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="��ɫ"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="��ɫ"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<style type="text/css">
#pmimg_menu #pmimg_param_1 {width:93%!important;}
</style>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="ͼƬ" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?> style="margin-left:5px;">ͼƬ</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>����</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } ?></div>
<div class="area">
<textarea rows="8" cols="40" name="message" class="pt" id="sendmessage" onkeydown="ctrlEnter(event, 'pmsubmit_btn');"></textarea>
</div>
</div>
</td>
</tr>
<?php if($_G['inajax']) { ?>
</table>
</div>
<p class="o pns">
<button type="submit" name="pmsubmit_btn" id="pmsubmit_btn" value="true" class="pn pnc"><strong>����</strong></button>
</p>
<?php } else { ?>
<tr>
<th>&nbsp;</th>
<td>
<button type="submit" name="pmsubmit_btn" id="pmsubmit_btn" value="true" class="pn pnp"><strong>����</strong></button>
</td>
</tr>
</table>
</div>
<?php } ?>
</form>
</div>
<?php } } if(!$_G['inajax']) { ?>
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