<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_block', 'common/header');
0
|| checktplrefresh('./template/default/portal/portalcp_block.htm', './template/default/common/simplesearchform.htm', 1491464585, '2', './data/template/2_2_portal_portalcp_block.tpl.php', './template/8264', 'portal/portalcp_block')
|| checktplrefresh('./template/default/portal/portalcp_block.htm', './template/default/portal/portalcp_block_setting.htm', 1491464585, '2', './data/template/2_2_portal_portalcp_block.tpl.php', './template/8264', 'portal/portalcp_block')
|| checktplrefresh('./template/default/portal/portalcp_block.htm', './template/default/portal/portalcp_block_thumbsetting.htm', 1491464585, '2', './data/template/2_2_portal_portalcp_block.tpl.php', './template/8264', 'portal/portalcp_block')
|| checktplrefresh('./template/default/portal/portalcp_block.htm', './template/default/portal/portalcp_block_setting.htm', 1491464585, '2', './data/template/2_2_portal_portalcp_block.tpl.php', './template/8264', 'portal/portalcp_block')
|| checktplrefresh('./template/default/portal/portalcp_block.htm', './template/default/portal/portalcp_block_thumbsetting.htm', 1491464585, '2', './data/template/2_2_portal_portalcp_block.tpl.php', './template/8264', 'portal/portalcp_block')
|| checktplrefresh('./template/default/portal/portalcp_block.htm', './template/default/portal/portalcp_nav.htm', 1491464585, '2', './data/template/2_2_portal_portalcp_block.tpl.php', './template/8264', 'portal/portalcp_block')
;?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<?php if(!$_G['inajax'] && in_array($op, array('block', 'data', 'itemdata'))) { ?>
<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="��������">��������</label></li>
EOF;
?><?php } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="��������">����</label></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="����{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="������־">��־</label></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="�������">���</label></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="����{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="�����û�">�û�</label></li>
EOF;
?>
<?php if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?php echo $_G['siteurl'];?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">����</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="��������������" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">����</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="<?php echo $_G['setting']['navs']['1']['filename'];?>"><?php echo $_G['setting']['navs']['1']['navname'];?></a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp">�Ż�����</a> <em>&rsaquo;</em>
<a href="portal.php?mod=portalcp&amp;ac=portalblock">ģ�����</a>
<?php if($bid) { ?> <em>&rsaquo;</em><a href="portal.php?mod=portalcp&amp;ac=block&amp;op=block&amp;bid=<?php echo $bid;?>"><?php if($block['name']) { ?><?php echo $block['name'];?><?php } else { ?># <?php echo $block['bid'];?><?php } ?></a><?php } ?>
</div>
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<div id="block_selection">

<ul class="tb cl">
<?php if($allowmanage) { ?>
<li id="li_setting"<?php if($op=="block") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=block">ģ������</a></li>
<?php } if($bid && !$is_htmlblock) { if($allowmanage || $allowdata) { ?>
<li id="li_data"<?php if($op=="data") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=data">ģ������</a></li>
<?php } } if($is_recommendable) { ?>
<li id="li_itemdata"<?php if($op=="itemdata") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=itemdata">���Ϳ�</a></li>
<?php } ?>
</ul>
<?php } if($op == 'block') { if($_G['inajax']) { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�༭ģ��</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');<?php if(empty($bid) && $_GET['from']!='cp') { ?>drag.removeBlock('<?php echo $_GET['eleid'];?>',true);<?php } ?>return false;" title="�ر�">�ر�</a></span>
</h3>
<ul class="tb cl">
<li id="li_setting"<?php if($op=="block") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=block" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ������</a></li>
<?php if($bid && !$is_htmlblock) { ?>
<li id="li_data"<?php if($op=="data") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=data" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ������</a></li>
<li id="li_style"<?php if($op=="style") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=style" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ��ģ��</a></li>
<?php } ?>
</ul>
<?php } ?>
<form id="blockformsetting" name="blockformsetting" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=block&amp;classname=<?php echo $_GET['classname'];?>&amp;bid=<?php echo $block['bid'];?>&amp;blocktype=<?php echo $blocktype;?>&amp;eleid=<?php echo $_GET['eleid'];?>&amp;tpl=<?php echo $_GET['tpl'];?>"<?php if($_G['inajax']) { ?> onsubmit="if(checkblockname(this)){ajaxpost('blockformsetting','return_<?php echo $_G['gp_handlekey'];?>','return_<?php echo $_G['gp_handlekey'];?>','onerror');} else {return false;}"<?php } else { ?> onsubmit="return checkblockname(this);"<?php } ?> class="fdiy">
<div class="c diywin"<?php if($_G['inajax']) { ?> style="width: 420px; <?php if($_GET['from']=='cp') { ?>max-height:260px;<?php } else { ?>max-height:380px;<?php } ?>height:auto !important; height:320px; _padding-right: 0; _margin-right: 17px; overflow-y: auto;"<?php } ?>>
<div id="block_setting">
<table class="tfm mbm">
<?php if($showhtmltip) { ?>
<tr>
<td colspan="2" style="color: red">
��ģ�����������Ծ�������༭������չʾ��Ҫ������</td>
</tr>
<?php } ?>
<tr>
<th width="80">ģ���ʶ</th>
<td><input type="text" name="name" value="<?php echo $block['name'];?>" class="px" /></td>
</tr>
<tr>
<th width="80">ģ�����</th>
<td><?php list($bigclass) = explode('_',$block['blockclass']); if(!empty($_G['cache']['blockconvert']) && !empty($_G['cache']['blockconvert'][$bigclass][$block['blockclass']])) { ?>
<select name="toblockclass" onchange="blockconver(this, '<?php echo $block['bid'];?>');" class="ps">
<option value="<?php echo $block['blockclass'];?>"><?php echo $blockclassname;?></option><?php if(is_array($_G['cache']['blockconvert'][$bigclass][$block['blockclass']])) foreach($_G['cache']['blockconvert'][$bigclass][$block['blockclass']] as $bblockclass => $convertarr) { ?><option value="<?php echo $bblockclass;?>"><?php echo $convertarr['name'];?></option>
<?php } ?>
</select>
<img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="��ģ�����֧��ת��ģ������ͣ���<font color='red'>���ܻ���ڲ��������ֶεĶ�ʧ��ģ�����ʾ��ʽ�����Ϊ�Զ���ģ��</font>���������Ҫʹ�á�<br/><font color='red'>ע�⣺</font>ѡ�������б��е�ģ�������Ժ�ģ��������������ı䡣" />
<?php } else { ?>
<?php echo $blockclassname;?>
<?php } ?>
</td>
</tr>
<tr>
<th width="80">������Դ</th>
<td>
<select name="script" onchange="block_get_setting('<?php echo $_GET['classname'];?>', this.value, '<?php echo $block['bid'];?>');" class="ps"><?php if(is_array($theclass['script'])) foreach($theclass['script'] as $bkey => $bname) { ?><option value="<?php echo $bkey;?>"<?php echo $scriptarr[$bkey];?>><?php echo $bname;?></option>
<?php } ?>
</select>
</td>
</tr>
<tr class="l">
<th></th>
<td>
<a id="a_setting_show" href="javascript:;" onclick="toggleSettingShow();"class="xi2">����������</a>
</td>
</tr>
<tbody id="tbody_setting"><?php if(is_array($settings)) foreach($settings as $key => $value) { ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<tr class="vt">
<th><?php echo $value['title'];?><?php if($value['comment']) { ?> <img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="<?php echo $value['comment'];?>" /><?php } ?></th>
<td><?php echo $value['html'];?></td>
</tr>
<?php } if(!$is_htmlblock) { ?>
<tr>
<th>��ʾ����</th>
<td><input type="text" name="shownum" value="<?php echo $block['shownum'];?>" class="px" /></td>
</tr>
<?php } if(!$nocachetime) { ?>
<tr>
<th width="80">���ݻ������</th>
<td>
<input type="text" name="cachetime" id="txt_cachetime" class="px" size="4" maxlength="6" value="<?php echo $block['cachetime_min'];?>" /> ����
&nbsp;
<input type="checkbox" name="punctualupdate" id="ckpunctualupdate" class="pc" value="1"<?php if($block['punctualupdate']) { ?> checked="checked"<?php } ?> />
<label for="ckpunctualupdate">׼ʱ����</label>
<img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="Ϊ�˼���ϵͳ���أ�ϵͳ�趨Ϊͬһʱ�����ֻ����һ��ģ�飻��ѡ������Ժ��Դ��Ż�����֤ģ�鰴ָ������ʱ�估ʱ����(���棺������ؼ���ϵͳ���أ���Ҫͬһҳ�������ô�����׼ʱ���¡�ģ�飡)" />
<p class="ptn xi2">
<a href="javascript:;" onclick="blockSetCacheTime(10);this.blur();">10����</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('60');this.blur();">1Сʱ</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('1440');this.blur();">1��</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('10080');this.blur();">1��</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('43200');this.blur();">1��</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('0');this.blur();">������</a>
</p>
</td>
</tr>
<?php } ?></tbody>
<?php if(!$is_htmlblock) { ?>
<tr>
<th width="80">��ʾ��ʽ</th>
<td>
<select name="styleid" onchange="block_show_thumbsetting('<?php echo $_GET['classname'];?>', this.value, '<?php echo $block['bid'];?>')" class="ps">
<?php if($bid && $block['styleid']==0) { ?>
<option value="0" selected>�Զ���ģ��</option>
<?php } if(is_array($theclass['style'])) foreach($theclass['style'] as $key => $value) { ?><?php $thestyle = count($thestyle) > 1 ? $thestyle : $theclass['style'][$key]; ?><option value="<?php echo $key;?>"<?php echo $stylearr[$key];?>><?php echo $value['name'];?></option>
<?php } ?>
</select>
<?php if($blocktype) { ?>
&nbsp;&nbsp;
<input type="checkbox" class="pc" id="ck_hidedisplay" name="hidedisplay" value="1"<?php if($block['hidedisplay']) { ?> checked<?php } ?> />
<label for="ck_hidedisplay">�������</label>
<img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="�����ģ�����ݣ������ṩ���ݹ�ģ����á�" />
<?php } ?>
</td>
</tr>
<?php } ?>
<tbody id="tbody_thumbsetting"><?php if($thestyle['makethumb']) { ?>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<tr>
<th width="80">����ͼ���</th>
<td><input type="text" name="picwidth" value="<?php echo $block['picwidth'];?>" class="px" /></td>
</tr>
<tr>
<th width="80">����ͼ�߶�</th>
<td><input type="text" name="picheight" value="<?php echo $block['picheight'];?>" class="px" /></td>
</tr>
<?php } if($thestyle['settarget']) { ?>
<tr>
<th width="80">���Ӵ򿪷�ʽ</th>
<td>
<select name="a_target">
<option value="blank" <?php echo $targetarr['blank'];?>>�����Ӵ�</option>
<option value="self" <?php echo $targetarr['self'];?>>��ҳ���</option>
<option value="top" <?php echo $targetarr['top'];?>>��ҳ���(�������)</option>
</select>
</td>
</tr>
<?php } if(!$is_htmlblock) { ?>
<tr>
<th width="80">���ڸ�ʽ</th>
<td>
<select name="dateformat"><?php if(is_array($dateformats)) foreach($dateformats as $value) { ?><option value="<?php echo $value['format'];?>"<?php echo $value['selected'];?>><?php echo $value['time'];?></option>
<?php } ?>
</select>
&nbsp;
<input type="checkbox" name="dateuformat" id="ckdateuformat" class="pc" value="1"<?php if($block['dateuformat']) { ?> checked="checked"<?php } ?> />
<label for="ckdateuformat">ʹ�����Ի����ڸ�ʽ</label>
<img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="��ѡ����������ʱ����ʾ������ǰ������ʽ" />
</td>
</tr>
<?php } ?></tbody>
<?php if(!$is_htmlblock) { ?>
<tr>
<th width="80">�Զ�������</th>
<td>
<textarea name="summary" id="block_sumamry_<?php echo $block['bid'];?>" cols="40" rows="3" class="pt" style="display:none"><?php echo $block['summary'];?></textarea>
<p class="pns">
<button type="button" id="a_summary_show" onclick="javascript:$('block_sumamry_<?php echo $block['bid'];?>').style.display='';$('a_summary_show').style.display='none';$('a_summary_hide').style.display='';return false;" class="pn"><em>�༭�Զ�������</em></button>
<a id="a_summary_hide" href="javascript:;" onclick="javascript:$('block_sumamry_<?php echo $block['bid'];?>').style.display='none';$('a_summary_hide').style.display='none';$('a_summary_show').style.display='';return false;" style="display:none;">����</a>
</p>
</td>
</tr>
<?php } ?>
</table>
</div>
</div>
<div class="o pns">
<input type="hidden" name="blocksubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="eleid" value="<?php echo $_GET['eleid'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>ȷ��</strong></button>
</div>
</form>
<?php if($_G['inajax']) { ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {			
<?php if($_GET['from']=='cp') { ?>
location.reload();
<?php } else { ?>
var bid = values['bid'];
var eleid = typeof values['eleid'] == 'undefined' ? 0 : values['eleid'];
var x = new Ajax();
var openTitle = 0;
drag.setClose();
x.get('portal.php?mod=portalcp&ac=block&op=getblock&bid='+bid+'&tpl=<?php echo $_GET['tpl'];?>&inajax=1', function(s) {
var obj = document.createElement('div');
bid = 'portal_block_'+bid;
obj.innerHTML = s;
if ($(bid) != null) {
drag.stopSlide(bid);
if($(bid+'_content')) $(bid+'_content').parentNode.removeChild($(bid+'_content'));
$(bid).innerHTML = obj.childNodes[0].innerHTML;
} else {
$(eleid).parentNode.replaceChild(obj.childNodes[0],$(eleid));
openTitle = 1;
}
drag.initPosition();
evalscript(s);
if (openTitle == 1)	drag.openTitleEdit(bid);
});
<?php } ?>
hideWindow('<?php echo $_G['gp_handlekey'];?>');
}
</script>
<?php } } elseif($op == 'data') { if($_G['inajax']) { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">ģ������</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');<?php if(empty($bid)) { ?>drag.removeBlock('<?php echo $_GET['eleid'];?>',true);<?php } ?>return false;" title="�ر�">�ر�</a></span>
</h3>
<ul class="tb cl">
<li id="li_setting"<?php if($op=="block") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=block" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ������</a></li>
<?php if($bid && !$is_htmlblock) { ?>
<li id="li_data"<?php if($op=="data") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=data" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ������</a></li>
<li id="li_style"<?php if($op=="style") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=style" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ��ģ��</a></li>
<?php } ?>
</ul>
<?php } ?>
<form id="blockformdata" name="blockformdata" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=data&amp;classname=<?php echo $_GET['classname'];?>&amp;bid=<?php echo $block['bid'];?>&amp;eleid=<?php echo $_GET['eleid'];?>&amp;tpl=<?php echo $_GET['tpl'];?>"<?php if($_G['inajax']) { ?> onsubmit="ajaxpost('blockformdata','return_<?php echo $_G['gp_handlekey'];?>','return_<?php echo $_G['gp_handlekey'];?>','onerror');"<?php } ?>>
<div class="c"<?php if($_G['inajax']) { ?> style="width:420px; <?php if($_GET['from']=='cp') { ?>max-height:260px;<?php } else { ?>max-height:380px;<?php } ?>height:auto !important; height:320px; _padding-right: 0; _margin-right: 17px; overflow-y: auto;"<?php } ?>>
<div id="block_data">
<table class="dt mtm mbm" style="table-layout:fixed">
<tr>
<th width="34">�̶�</th>
<th width="50">λ��</th>
<th>����</th>
<th width="80">����</th>
</tr><?php if(is_array($itemlist)) foreach($itemlist as $item) { ?><tr>
<?php if($item['ispreorder']) { ?>
<td>
Ԥ��
</td>
<td>
<?php echo $item['displayorder'];?>
</td>
<?php } else { ?>
<td>
<input type="checkbox" name="locked[<?php echo $item['itemid'];?>]" value="1"<?php if($item['itemtype']=='1') { ?> checked="checked"<?php } ?> />
</td>
<td>
<input type="text" name="displayorder[<?php echo $item['itemid'];?>]" class="px" size="2" maxlength="2" value="<?php echo $item['displayorder'];?>" />
</td>
<?php } ?>
<td><?php echo $item['title'];?></td>
<td>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=item&amp;bid=<?php echo $block['bid'];?>&amp;itemid=<?php echo $item['itemid'];?><?php if($_G['inajax']) { ?>&amp;from=ajax<?php } ?>" onclick="showWindow('showblock', this.getAttribute('href'));">�༭</a><span class="pipe">|</span>
<?php if($item['itemtype']=='1') { ?>
<a href="javascript:;" onclick="block_delete_item('<?php echo $block['bid'];?>', '<?php echo $item['itemid'];?>', 1, '<?php if($_G['inajax']) { ?>ajax<?php } ?>'); return false;">ɾ��</a>
<?php } else { ?>
<a href="javascript:;" onclick="block_delete_item('<?php echo $block['bid'];?>', '<?php echo $item['itemid'];?>', 0, '<?php if($_G['inajax']) { ?>ajax<?php } ?>'); return false;">����</a>
<?php } ?>
</td>
</tr>
<?php } ?>
</table>
<?php if($block['param']['bannedids']) { ?>
<h4><a href="javascript:;" onclick="$('p_bannedids').style.display='block';return false;">�鿴��������</a></h4>
<p id="p_bannedids" style="display:none;">
<label>��������</label>
<input type="text" name="bannedids" value="<?php echo $block['param']['bannedids'];?>" class="px" />
</p>
<?php } ?>
</div>
</div>
<div class="o pns">
<input type="hidden" name="eleid" value="<?php echo $_GET['eleid'];?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="updatesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>����</strong></button>
</div>
</form>
<?php if($_G['inajax']) { ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
<?php if($_GET['from']=='cp') { ?>
location.reload();
<?php } else { ?>
var bid = values['bid'];
var eleid = typeof values['eleid'] == 'undefined' ? 0 : values['eleid'];
var x = new Ajax();
var openTitle = 0;
drag.setClose();
x.get('portal.php?mod=portalcp&ac=block&op=getblock&bid='+bid+'&tpl=<?php echo $_GET['tpl'];?>&inajax=1', function(s) {
var obj = document.createElement('div');
bid = 'portal_block_'+bid;
obj.innerHTML = s;
if ($(bid) != null) {
drag.stopSlide(bid);
if($(bid+'_content')) $(bid+'_content').parentNode.removeChild($(bid+'_content'));
$(bid).innerHTML = obj.childNodes[0].innerHTML;
} else {
$(eleid).parentNode.replaceChild(obj.childNodes[0],$(eleid));
openTitle = 1;
}
drag.initPosition();
evalscript(s);
if (openTitle == 1)	drag.openTitleEdit(bid);
});
<?php } ?>
hideWindow('<?php echo $_G['gp_handlekey'];?>');
}
</script>
<?php } } elseif($op == 'style') { if($_G['inajax']) { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">ģ��ģ��</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');<?php if(empty($bid)) { ?>drag.removeBlock('<?php echo $_GET['eleid'];?>',true);<?php } ?>return false;" title="�ر�">�ر�</a></span>
</h3>
<ul class="tb cl">
<li id="li_setting"<?php if($op=="block") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=block" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ������</a></li>
<?php if($bid && !$is_htmlblock) { ?>
<li id="li_data"<?php if($op=="data") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=data" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ������</a></li>
<li id="li_style"<?php if($op=="style") { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=block&amp;bid=<?php echo $bid;?>&amp;op=style" onclick="showWindow('<?php echo $_G['gp_handlekey'];?>', this.getAttribute('href'));">ģ��ģ��</a></li>
<?php } ?>
</ul>
<?php } ?>	
<form id="blockstyleform" name="blockformdata" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=style&amp;classname=<?php echo $_GET['classname'];?>&amp;bid=<?php echo $block['bid'];?>&amp;eleid=<?php echo $_GET['eleid'];?>&amp;tpl=<?php echo $_GET['tpl'];?>"<?php if($_G['inajax']) { ?> onsubmit="ajaxpost('blockstyleform','return_<?php echo $_G['gp_handlekey'];?>','return_<?php echo $_G['gp_handlekey'];?>','onerror');"<?php } ?>>
<div class="c"<?php if($_G['inajax']) { ?> style="width:420px; <?php if($_GET['from']=='cp') { ?>max-height:260px;<?php } else { ?>max-height:380px;<?php } ?>height:auto !important; height:320px; _padding-right: 0; _margin-right: 17px; overflow-y: auto;"<?php } ?>>
<?php if($block['hidedisplay']) { ?>
<div>
<p style="color:red;">���ѣ� ��ѡ�������������ģ�鲻������κ����ݣ�������������ҳ��ģ���е���ģ������ݡ�</p>
<p>	<b>�ο����ø�ʽ:</b></p>
<p><?php echo $samplecode;?></p>
<p><b>�ɵ����ֶ�:</b></p>
<table width="100%"><?php if(is_array($theclass['fields'])) foreach($theclass['fields'] as $key => $value) { ?> <tr>
 <td><?php echo $value['name'];?></td>
 <td><?php echo '$'; ?><?php echo $key;?></td>
 </tr>
 <?php } ?>
</table>
</div>
<?php } else { ?>
 <div id="block_style">
<p class="pns mtn mbn"><button type="button" id="a_summary_show" onclick="$('stylename').style.display='';" class="pn"><em>ģ�����Ϊ...</em></button></p>
<p class="mtn mbm" id="stylename" style="display:none;">
ģ��ģ������: <input type="text" name="name" class="px" />
<br />
�������ƽ�����ʽ���浽����ģ��ģ��(�Ա�������ģ����ʹ��)
</p>
<textarea name="template" rows="8" style="width: 98%;"><?php echo $template;?></textarea>
</div>
 <table class="dt mtm mbm" width="98%" style="margin-top: 8px; border:1px;">
 <tr>
 <th>�﷨</th>
 <th>���</th>
 </tr><?php if(is_array($theclass['fields'])) foreach($theclass['fields'] as $key => $value) { ?> <tr>
 <td><?php echo $value['name'];?></td>
 <td>{<?php echo $key;?>}</td>
 </tr>
 <?php } ?>
 <tr>
 <td>��ǰ����˳��</td>
 <td>{<?php echo currentorder;?>}</td>
 </tr>
 <tr>
 <td>��ǰ�����Ƿ���������</td>
 <td>{<?php echo parity;?>}</td>
 </tr>
 <tr>
 <td>Ĭ��ѭ����ʾ����</td>
 <td>[loop]...[/loop]</td>
 </tr>
 <tr>
 <td>�����Ӧloop��ָ����������</td>
 <td>[order=N]...[/order]</td>
 </tr>
 <tr>
 <td>����ָ��������ʾ����</td>
 <td>[index=N]...[/index]</td>
 </tr>
 <tr>
 <td>�����ô򿪷�ʽ������</td>
 <td>&lt;a href="{<?php echo url;?>}"{<?php echo target;?>}&gt;{<?php echo title;?>}&lt;/a&gt;</td>
 </tr>
 <tr>
 <td>����������ͼ��С��ͼƬ</td>
 <td>&lt;img src="{<?php echo pic;?>}" width="{<?php echo picwidth;?>}" height="{<?php echo picheight;?>}" /&gt;</td>
 </tr>
 <tr>
 <td>����˵��...</td>
 <td>��ο��� ��̨ - �Ż� - ģ��ģ�� - �༭/���ģ��</td>
 </tr>
</table>
<?php } ?>
</div>
<div class="o pns">
<input type="hidden" name="eleid" value="<?php echo $_GET['eleid'];?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="stylesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>����</strong></button>
</div>
</form>
<?php if($_G['inajax']) { ?>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
<?php if($_GET['from']=='cp') { ?>
location.reload();
<?php } else { ?>
var bid = values['bid'];
var eleid = typeof values['eleid'] == 'undefined' ? 0 : values['eleid'];
var x = new Ajax();
var openTitle = 0;
drag.setClose();
x.get('portal.php?mod=portalcp&ac=block&op=getblock&bid='+bid+'&tpl=<?php echo $_GET['tpl'];?>&inajax=1', function(s) {
var obj = document.createElement('div');
bid = 'portal_block_'+bid;
obj.innerHTML = s;
if ($(bid) != null) {
drag.stopSlide(bid);
if($(bid+'_content')) $(bid+'_content').parentNode.removeChild($(bid+'_content'));
$(bid).innerHTML = obj.childNodes[0].innerHTML;
} else {
$(eleid).parentNode.replaceChild(obj.childNodes[0],$(eleid));
openTitle = 1;
}
drag.initPosition();
evalscript(s);
if (openTitle == 1)	drag.openTitleEdit(bid);
});
<?php } ?>
hideWindow('<?php echo $_G['gp_handlekey'];?>');
}
</script>
<?php } } elseif($op == 'itemdata') { if($datalist) { ?>
<form id="blockformitemdata" name="blockformitemdata" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=itemdata&amp;bid=<?php echo $block['bid'];?>">
<table class="dt mtm mbm">
<tr>
<th width="40">ѡ��</th>
<th>����</th>
<th>ͨ�����ʱ��</th>
<th>�Ƿ��ö�</th>
<th width="80">����</th>
</tr><?php if(is_array($datalist)) foreach($datalist as $item) { ?><tr>
<td><input type="checkbox" class="pc" name="ids[]" value="<?php echo $item['dataid'];?>" /></td>
<td><a href="<?php echo $item['url'];?>" target="_blank"><?php echo $item['title'];?></a></td>
<td><?php echo $item['verifiedtime'];?></td>
<td><?php if($item['stickgrade']) { ?>�ö� <?php echo $item['stickgrade'];?><?php } else { ?>��<?php } ?></td>
<td>
<a href="portal.php?mod=portalcp&amp;ac=block&amp;op=managedata&amp;bid=<?php echo $block['bid'];?>&amp;dataid=<?php echo $item['dataid'];?>" onclick="showWindow('showblock', this.getAttribute('href'));">�༭</a>
</td>
</tr>
<?php } ?>
<tr>
<td><input type="checkbox" id="chkall" name="chkall" onclick="checkall(this.form, 'ids')" /></td>
<td colspan="4">
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>ɾ��</strong></button>
</td>
</tr>
</table>
<?php if($multi) { ?><div class=""><?php echo $multi;?></div><?php } ?>
</form>
<?php } else { ?>
<p class="emp">��ģ������Ϳ��ﻹû���κ�����</p>
<?php } } elseif($op == 'setting') { if(is_array($settings)) foreach($settings as $key => $value) { ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<tr class="vt">
<th><?php echo $value['title'];?><?php if($value['comment']) { ?> <img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="<?php echo $value['comment'];?>" /><?php } ?></th>
<td><?php echo $value['html'];?></td>
</tr>
<?php } if(!$is_htmlblock) { ?>
<tr>
<th>��ʾ����</th>
<td><input type="text" name="shownum" value="<?php echo $block['shownum'];?>" class="px" /></td>
</tr>
<?php } if(!$nocachetime) { ?>
<tr>
<th width="80">���ݻ������</th>
<td>
<input type="text" name="cachetime" id="txt_cachetime" class="px" size="4" maxlength="6" value="<?php echo $block['cachetime_min'];?>" /> ����
&nbsp;
<input type="checkbox" name="punctualupdate" id="ckpunctualupdate" class="pc" value="1"<?php if($block['punctualupdate']) { ?> checked="checked"<?php } ?> />
<label for="ckpunctualupdate">׼ʱ����</label>
<img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="Ϊ�˼���ϵͳ���أ�ϵͳ�趨Ϊͬһʱ�����ֻ����һ��ģ�飻��ѡ������Ժ��Դ��Ż�����֤ģ�鰴ָ������ʱ�估ʱ����(���棺������ؼ���ϵͳ���أ���Ҫͬһҳ�������ô�����׼ʱ���¡�ģ�飡)" />
<p class="ptn xi2">
<a href="javascript:;" onclick="blockSetCacheTime(10);this.blur();">10����</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('60');this.blur();">1Сʱ</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('1440');this.blur();">1��</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('10080');this.blur();">1��</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('43200');this.blur();">1��</a>&nbsp;
<a href="javascript:;" onclick="blockSetCacheTime('0');this.blur();">������</a>
</p>
</td>
</tr>
<?php } } elseif($op == 'item') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�༭ģ��</em>
<span>
<?php if($_GET['from']=='ajax') { ?><a href="portal.php?mod=portalcp&amp;ac=block&amp;op=data&amp;bid=<?php echo $bid;?>" onclick="showWindow('showblock', this.href);closecalendar(e);return false;"> &lt;&lt;���� </a><?php } if($_G['inajax']) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');<?php if(empty($bid)) { ?>drag.removeBlock('<?php echo $_GET['eleid'];?>');<?php } ?>return false;" title="�ر�">�ر�</a><?php } ?>
</span>
</h3>
<form id="blockform" name="blockform" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=item&amp;bid=<?php echo $block['bid'];?>&amp;itemid=<?php echo $itemid;?>" onsubmit="ajaxpost('blockform','return_<?php echo $_G['gp_handlekey'];?>','return_<?php echo $_G['gp_handlekey'];?>','onerror');" enctype="multipart/form-data">
<div class="c" style="height:<?php echo $height;?>; width: 420px; _padding-right: 0; _margin-right: 17px; overflow-y: auto;">
<table class="tfm">
<tr>
<th>������Դ��ȡ</th>
<td>
<select id="push_idtype" class="ps">
<option value="tids" selected="selected">����</option>
<option value="blogids">��־</option>
<option value="aids">����</option>
<option value="picids">ͼƬ</option>
</select>
<input type="text" id="push_id" value=""/>
<input type="button" value="��ȡ" onclick="block_pushitem('<?php echo $block['bid'];?>', '<?php echo $itemid;?>')" class="btn" />
</td>
</tr>
<tr>
<th>��ʾλ��</th>
<td>
<select name="displayorder" class="ps"><?php if(is_array($orders)) foreach($orders as $value) { ?><option value="<?php echo $value;?>"<?php echo $orderarr[$value];?>><?php echo $value;?></option>
<?php } ?>
</select>
&nbsp;&nbsp;
<?php if($itemid) { ?>
<input type="checkbox" class="pc" name="locked" id="lock_item" onclick="$('tbody_orderitem').style.display=this.checked ? '' : 'none';" value="1"<?php if($item['itemtype']=='1') { ?>checked="checked"<?php } ?> />
<label for="lock_item">�̶�</label>
<?php } else { ?>
<input type="checkbox" class="pc" name="locked" id="lock_item" onclick="$('tbody_orderitem').style.display=this.checked ? '' : 'none';" value="1" checked="checked" disabled="disabled" />
<label>�̶�</label>
<?php } ?>
</td>
</tr>
<tbody id="tbody_orderitem"<?php if($itemid && $item['itemtype']!='1') { ?> style="display:none;"<?php } ?>>
<tr>
<th>��ʼʱ��</th>
<td>
<input type="text" class="px" name="startdate"<?php if($item['startdate']) { ?> value="<?php echo $blockitem['startdate'];?>"<?php } ?> onclick="showcalendar(event, this, true)" />
<p class="d">���ձ�ʾ������ʼ</p>
</td>
</tr>
<tr>
<th>ʧЧʱ��</th>
<td>
<input type="text" class="px" name="enddate"<?php if($item['enddate']) { ?> value="<?php echo $blockitem['enddate'];?>"<?php } ?> onclick="showcalendar(event, this, true)" />
<p class="d">���ձ�ʾ��ʧЧ</p>
</td>
</tr>
</tbody>
<tbody id="tbody_pushcontent"><?php include template('portal/portalcp_block_itemfields'); ?></tbody>
</table>
</div>
<div class="o pns">
<input type="hidden" name="itemsubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>�ύ</strong></button>
</div>
</form>
<script type="text/javascript" reload="1">
if (typeof ctitlepb_frame == 'object' && !BROWSER.ie) {delete ctitlepb_frame;}
if (typeof csummarypb_frame == 'object' && !BROWSER.ie) {delete csummarypb_frame;}
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
<?php if($_GET['from']=='ajax') { ?>
showWindow('<?php echo $_G['gp_handlekey'];?>', 'portal.php?mod=portalcp&ac=block&op=data&bid='+values['bid'], 'get' ,0);
<?php } else { ?>
hideWindow('<?php echo $_G['gp_handlekey'];?>');
location.reload();
<?php } ?>
}
</script>

<?php } elseif($op == 'push') { include template('portal/portalcp_block_itemfields'); } elseif($op == 'recommend') { if($isrepeatrecommend) { ?>
<tr>
<th>&nbsp;</th>
<td><p>���ѣ� ����Ϣ�Ѿ��ڸ�ģ������Ϳ����ˡ�</p></td>
</tr>
<?php } ?>
<tr>
<th>��Ҫ���</th>
<td>
<?php if($perm['allowmanage'] || !$perm['needverify']) { ?>
<input type="checkbox" name="needverify" value="1" id="ck_needverify"<?php if(!$item['isverified']) { ?> checked="checked"<?php } ?> />
<?php } else { ?>
<input type="checkbox" disabled="disabled" checked="checked" />
<input type="hidden" name="needverify" value="1" />
<?php } ?>
<label for="ck_needverify"> ��ѡ�������˿⣻����ֱ�Ӽ���ģ�����Ϳ�</label>
</td>
</tr><?php include template('portal/portalcp_block_itemfields'); } elseif($op == 'verifydata') { ?>
<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�������</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');return false;" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form id="dataform" name="dataform" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=verifydata&amp;bid=<?php echo $block['bid'];?>&amp;dataid=<?php echo $dataid;?>" onsubmit="ajaxpost('dataform','return_<?php echo $_G['gp_handlekey'];?>','return_<?php echo $_G['gp_handlekey'];?>','onerror');" enctype="multipart/form-data">
<div class="c" style="height:<?php echo $height;?>; width: 420px; _padding-right: 0; _margin-right: 17px; overflow-y: auto;">
<table class="tfm">
<tbody id="tbody_pushcontent"><?php include template('portal/portalcp_block_itemfields'); ?></tbody>
<tr>
<th>����ģ��</th>
<td>
<input type="checkbox" name="updateblock" id="ckupdateblock" value="1" />
<label for="ckupdateblock">�������¸�ģ������</label>
</td>
</tr>
</table>
</div>
<div class="o pns">
<input type="hidden" name="verifydatasubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>ͨ��</strong></button>
</div>
</form>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
hideWindow('<?php echo $_G['gp_handlekey'];?>');
location.reload();
}
</script>
<?php } elseif($op == 'managedata') { ?>

<script src="<?php echo $_G['setting']['jspath'];?>calendar.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�༭����</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" class="flbc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');return false;" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form id="dataform" name="dataform" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=block&amp;op=managedata&amp;bid=<?php echo $block['bid'];?>&amp;dataid=<?php echo $dataid;?>" onsubmit="ajaxpost('dataform','return_<?php echo $_G['gp_handlekey'];?>','return_<?php echo $_G['gp_handlekey'];?>','onerror');" enctype="multipart/form-data">
<div class="c" style="height:<?php echo $height;?>; width: 420px; _padding-right: 0; _margin-right: 17px; overflow-y: auto;">
<table class="tfm">
<tr>
<th>�ö��ȼ�</th>
<td>
<select name="stickgrade" class="ps">
<option value="0"<?php if(empty($item['stickgrade'])) { ?> selected<?php } ?>>���ö�</option><?php if(is_array(range(1,10))) foreach(range(1,10) as $k) { ?><option value="<?php echo $k;?>"<?php if($item['stickgrade']=='$k') { ?> selected<?php } ?>>�ö�<?php echo $k;?></option>
<?php } ?>
</select>
</td>
</tr>
<tbody id="tbody_pushcontent"><?php include template('portal/portalcp_block_itemfields'); ?></tbody>
</table>
</div>
<div class="o pns">
<input type="hidden" name="managedatasubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<button type="submit" class="pn pnc"><strong>�ύ</strong></button>
</div>
</form>
<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
hideWindow('<?php echo $_G['gp_handlekey'];?>');
location.reload();
}
</script>
<?php } elseif($op == 'thumbsetting') { if($thestyle['makethumb']) { ?>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<tr>
<th width="80">����ͼ���</th>
<td><input type="text" name="picwidth" value="<?php echo $block['picwidth'];?>" class="px" /></td>
</tr>
<tr>
<th width="80">����ͼ�߶�</th>
<td><input type="text" name="picheight" value="<?php echo $block['picheight'];?>" class="px" /></td>
</tr>
<?php } if($thestyle['settarget']) { ?>
<tr>
<th width="80">���Ӵ򿪷�ʽ</th>
<td>
<select name="a_target">
<option value="blank" <?php echo $targetarr['blank'];?>>�����Ӵ�</option>
<option value="self" <?php echo $targetarr['self'];?>>��ҳ���</option>
<option value="top" <?php echo $targetarr['top'];?>>��ҳ���(�������)</option>
</select>
</td>
</tr>
<?php } if(!$is_htmlblock) { ?>
<tr>
<th width="80">���ڸ�ʽ</th>
<td>
<select name="dateformat"><?php if(is_array($dateformats)) foreach($dateformats as $value) { ?><option value="<?php echo $value['format'];?>"<?php echo $value['selected'];?>><?php echo $value['time'];?></option>
<?php } ?>
</select>
&nbsp;
<input type="checkbox" name="dateuformat" id="ckdateuformat" class="pc" value="1"<?php if($block['dateuformat']) { ?> checked="checked"<?php } ?> />
<label for="ckdateuformat">ʹ�����Ի����ڸ�ʽ</label>
<img src="<?php echo IMGDIR;?>/faq.gif" alt="Tip" class="vm" style="margin: 0;" onmouseover="showTip(this)" tip="��ѡ����������ʱ����ʾ������ǰ������ʽ" />
</td>
</tr>
<?php } } elseif($op == 'getblock') { if(!$_G['inajax']) { ?>
<div class="wp"><div class="area"><div class="frame move-span frame-1 cl">
<?php } ?>
<?php echo $html;?>
<?php if(!$_G['inajax']) { ?>
</div></div></div>
<?php } } elseif($op == 'convert') { ?>
<script type="text/javascript" reload="1">
showWindow('showblock', 'portal.php?mod=portalcp&ac=block&op=block&bid='+<?php echo $bid;?>+'&tpl='+document.diyform.template.value, 'get', -1);
drag.blockForceUpdate('portal_block_<?php echo $bid;?>');
</script>
<?php } if(!$_G['inajax'] && in_array($op, array('block', 'data', 'itemdata'))) { ?>
</div>
</div>
</div>
<div class="appl"><div class="tbn">
<ul>
<?php if($_G['group']['allowauthorizedarticle'] || $_G['group']['allowmanagearticle']) { ?><li<?php if($ac == 'index' || $ac == 'category') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=index">Ƶ����Ŀ</a></li><?php } if($_G['group']['allowauthorizedblock'] || $_G['group']['allowdiy']) { ?>
<li<?php if($ac == 'portalblock' || $ac=='block') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=portalblock">ģ�����</a></li>
<li<?php if($ac == 'blockdata') { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=blockdata&amp;op=manage">�������</a></li>
<li><a href="portal.php?mod=portalcp&amp;ac=topic_block">��ר��ģ��</a></li>
<?php } if(!$_G['inajax'] && !empty($_G['setting']['plugins']['portalcp'])) { if(is_array($_G['setting']['plugins']['portalcp'])) foreach($_G['setting']['plugins']['portalcp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="portal.php?mod=portalcp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } if(!empty($modsession->islogin)) { ?>
<li><a href="portal.php?mod=portalcp&amp;ac=logout">�˳�</a></li>
<?php } ?>
</ul>
</div>
</div>
</div>
<?php } include template('common/footer'); ?>