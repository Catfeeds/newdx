<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div id="button_more_menu" class="p_pop" style="display: none; margin-left: 17px;">
<ul>
<li><a href="javascript:;" onclick="spaceDiy.recover();return false;" title="�ָ�����">�ָ�����</a></li>
<li><a href="javascript:;" onclick="drag.frameExport();return false;" title="������ǰҳ��������DIY����">����</a></li>
<li><a href="javascript:;" onclick="drag.openFrameImport();$('button_more_menu').style.display='none';return false;" title="��DIY���ݵ��뵽��ǰҳ��">����</a></li>
<li><a href="javascript:;" onclick="drag.blockForceUpdateBatch();$('button_more_menu').style.display='none';return false;" title="���µ�ǰҳ������ģ�������">����</a></li>
<li><a href="javascript:;" onclick="drag.clearAll();$('button_more_menu').style.display='none';return false;" title="���ҳ��������DIY����">���</a></li>
</ul>
</div>
<div id="controlpanel" class="cl">
<div id="controlheader" class="cl">
<p class="y">
<span id="navcancel"><a href="javascript:;" id="diycancel" onclick="spaceDiy.cancel();return false;">�ر�</a></span>
<a href="javascript:;" title="�������" id="button_more" onmouseover="showMenu(this.id);">More</a>
<span id="navsave"><a href="javascript:;" onclick="javascript:spaceDiy.save();return false;">����</a></span>
<span id="button_redo" class="unusable"><a href="javascript:;" onclick="spaceDiy.redo();return false;" title="����" onfocus="this.blur();">����</a></span>
<span id="button_undo" class="unusable"><a href="javascript:;" onclick="spaceDiy.undo();return false;" title="����" onfocus="this.blur();">����</a></span>
<span id="preview" class="unusable"><a href="javascript:;" onclick="spaceDiy.save('preview');return false;" onfocus="this.blur();" title="Ԥ��DIY��Ч��" id="diy_preview">Ԥ��</a></span>
<span id="savecachemsg" class="xg1" style="display: none;"></span>
</p>
<ul id="controlnav">
<li id="navstart" class="current"><a href="javascript:" onclick="spaceDiy.getdiy('start');this.blur();return false;">��ʼ</a></li>
<li id="navframe"><a href="javascript:;" onclick="spaceDiy.getdiy('frame');this.blur();return false;">���</a></li>
<li id="navblockclass"><a href="javascript:;" onclick="spaceDiy.getdiy('blockclass');this.blur();return false;" id="hd_mod">ģ��</a></li>
<?php if(!empty($topic)) { ?>
<li id="navstyle"><a href="javascript:;" onclick="spaceDiy.getdiy('style');this.blur();return false;">���</a></li>
<li id="navdiy"><a href="javascript:;" onclick="spaceDiy.getdiy('diy', 'topicid', '<?php echo $topic['topicid'];?>');this.blur();return false;">�Զ���</a></li>
<?php } ?>
</ul>
</div>
<div id="controlcontent" class="cl">
<ul id="contentstart" class="content">
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('frame');return false;"><img src="<?php echo STATICURL;?>image/diy/layout.png" />��ӿ��</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('blockclass');return false;"><img src="<?php echo STATICURL;?>image/diy/module.png" />���ģ��</a></li>
  <?php if(!empty($topic)) { ?>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('style');return false;"><img src="<?php echo STATICURL;?>image/diy/style.png" />���</a></li>
  <li><a href="javascript:;" onclick="spaceDiy.getdiy('diy', 'topicid', '<?php echo $topic['topicid'];?>');return false;"><img src="<?php echo STATICURL;?>image/diy/diy.png" />�Զ���</a></li>
  <?php } ?>
</ul>
<ul id="contentframe" class="content hide">
<li><a href="javascript:;" id="frame_1" onmousedown="drag.createObj(event,'frame','1');" onfocus="this.blur();" data="<?php echo $widthstr;?>"><img src="<?php echo STATICURL;?>image/diy/layout-1.png" />100%���</a></li>
<li><a href="javascript:;" id="frame_1_1" onmousedown="drag.createObj(event,'frame','1-1');" onfocus="this.blur();"><img src="<?php echo STATICURL;?>image/diy/layout-1-1.png" />1:1</a></li>
<li><a href="javascript:;" id="frame_1_2" onmousedown="drag.createObj(event,'frame','1-2');" onfocus="this.blur();"><img src="<?php echo STATICURL;?>image/diy/layout-1-2.png" />1:2</a></li>
<li><a href="javascript:;" id="frame_2_1" onmousedown="drag.createObj(event,'frame','2-1');" onfocus="this.blur();"><img src="<?php echo STATICURL;?>image/diy/layout-2-1.png" />2:1</a></li>
<li><a href="javascript:;" id="frame_1_3" onmousedown="drag.createObj(event,'frame','1-3');" onfocus="this.blur();"><img src="<?php echo STATICURL;?>image/diy/layout-1-3.png" />1:3</a></li>
<li><a href="javascript:;" id="frame_3_1" onmousedown="drag.createObj(event,'frame','3-1');" onfocus="this.blur();"><img src="<?php echo STATICURL;?>image/diy/layout-3-1.png" />3:1</a></li>
<li><a href="javascript:;" id="frame_1_1_1" onmousedown="drag.createObj(event,'frame','1-1-1');" onfocus="this.blur();" data="<?php echo $widthstr;?>"><img src="<?php echo STATICURL;?>image/diy/layout-1-1-1.png" />1:1:1</a></li>
<li><a href="javascript:;" id="frame_tab" onmousedown="drag.createObj(event,'tab');" onfocus="this.blur();" data="<?php echo $widthstr;?>"><img src="<?php echo STATICURL;?>image/diy/layout-tab.png" />tab���</a></li>
</ul>
<div id="contentblockclass" class="content"></div>
</div>
<div id="cpfooter"><table cellpadding="0" cellspacing="0" width="100%"><tr><td class="l">&nbsp;</td><td class="c">&nbsp;</td><td class="r">&nbsp;</td></tr></table></div>
</div>

<form method="post" autocomplete="off" name="diyform" id="diyform" action="<?php echo $_G['siteurl'];?>portal.php?mod=portalcp&ac=diy">
<input type="hidden" name="template" value="<?php echo $_G['style']['tplfile'];?>" />
<input type="hidden" name="prefile" id="prefile" value="<?php echo $_G['style']['prefile'];?>" />
<input type="hidden" name="savemod" value="<?php echo $_G['style']['tplsavemod'];?>" />
<input type="hidden" name="spacecss" value="" />
<input type="hidden" name="style" value="" />
<input type="hidden" name="rejs" value="" />
<input type="hidden" name="handlekey" value="" />
<input type="hidden" name="layoutdata" value="" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="gobackurl" id="gobackurl" value=""/>
<input type="hidden" name="recover" value=""/>
<input type="hidden" name="optype" value=""/>

<input type="hidden" name="diysubmit" value="true"/>
</form>