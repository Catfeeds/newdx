<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_album_editpic', 'common/header');?>
<?php $_G[home_tpl_titles] = array($album[albumname], '���'); ?><?php $friendsname = array(0 => 'ȫվ�û��ɼ�',1 => '���Լ��ɼ�',2 => '���Լ��ɼ�',3 => '���Լ��ɼ�',4 => '���Լ��ɼ�'); include template('common/header'); if($_GET['op'] == 'editpic') { if($_GET['subop'] == 'move') { ?><?php $albumlist = $albumlist ? $albumlist : array(); ?><?php //$albumlist = array_slice($albumlist, 0, 6); ?><?php $islistbig = count($albumlist) > 15 ? true : false; ?><form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?php echo $albumid;?>&amp;is_uc=1" id="movepicform" name="movepicform" <?php if($_G['inajax']) { ?> onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox" style="<?php if($islistbig) { ?>width:600px;<?php } else { ?>width:580px;<?php } ?>">
<div class="flb">
<div class="popbox_title clearfix">
<span>�ƶ������</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>		
<?php if($albumlist) { ?>
<div class="popwarpten pl20 clearfix" style="<?php if($islistbig) { ?>width:575px;height:350px;overflow-x:hidden;overflow-y:scroll;<?php } else { ?>width:550px;<?php } ?>">
<ul class="popbbslist w165">	
<li class="createalbum" onclick="createalbum();">
<a href="javascript:void(0);" class="iconbox44">
&nbsp;
<i class="row"></i>
<i class="col"></i>
</a>
<p><a href="javascript:void(0);" class="titlename pt0">�½����</a></p>
</li><?php if(is_array($albumlist)) foreach($albumlist as $key => $value) { if($albumid != $value['albumid']) { ?>
<li class="li_<?php echo $value['albumid'];?> selectAlbumid" rel="<?php echo $value['albumid'];?>">
<a href="javascript:void(0);" class="iconbox44"><img src="<?php echo $value['pic'];?>"></a>
<p>
<a href="javascript:void(0);" class="titlename pt0"><?php echo $value['albumname'];?></a>
<span class="notetxt"><?php echo $friendsname[$album['friend']];?></span>
</p>
</li>
<?php } } ?>
</ul>
</div>
<div class="buttonbox">
<button type="submit" name="editpicsubmit" value="true" class="button_confirm" onclick="this.form.action+='&subop=move';" id="editpicsubmit">ȷ��</button>
</div>
<?php } ?>
</div>
<?php if($_G['gp_picids']) { ?><?php $_G[gp_picids] = explode(',', $_G[gp_picids]); if(is_array($_G['gp_picids'])) foreach($_G['gp_picids'] as $value) { ?><input type="checkbox" name="ids[<?php echo $value;?>]" value="<?php echo $value;?>" style="display:none;" checked="checked">
<?php } } ?>
<input type="hidden" name="page" value="<?php echo $page;?>" />
<input type="hidden" name="editpicsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="newalbumid" id="selectAlbumid" value="0" />	
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>	
</form>
<script type="text/javascript">	
function createalbum() {
jQuery('#movepicform').hide();
showWindow('createalbum', 'home.php?mod=spacecp&ac=album&op=createalbum', 'get', 0);
}
jQuery(function(){
jQuery(".popbbslist").on("click", ".selectAlbumid", function() {
var albumid = jQuery(this).attr('rel');
jQuery('#selectAlbumid').val(albumid);
jQuery('.popbbslist li').removeClass('active');
jQuery('.li_'+albumid).addClass('active');
});

});
</script>	
<?php } elseif($_GET['subop'] == 'delete') { ?>		
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?php echo $albumid;?>&amp;subop=delete&amp;is_uc=1" id="deletepicform" name="deletepicform">
<div class="popbox w450 textcenter">			
<div class="dhinfo">
<span>ȷ��Ҫɾ��ѡ�е�ͼƬ��</span>
<em></em>
</div>
<div>
<!--<button type="submit" name="editpicsubmit" value="true" class="button_cancel" onclick="this.form.action+='&subop=delete';showDialog('', 'info', '<img src="' + IMGDIR + '/loading.gif"> ���Ժ�...');" id="editpicsubmit"><strong>ȷ��</strong></button>-->
<button type="button" name="editpicsubmit" value="true" class="button_cancel" id="editpicsubmit"><strong>ȷ��</strong></button>
<?php if($_G['inajax']) { ?><input class="button_confirm" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="ȡ��" type="button"/><?php } ?>
</div>
<!--			<div id="return_<?php echo $_G['gp_handlekey'];?>" style="margin-top:20px;display:none;">ɾ���ظ�</div>-->
</div>
<?php if($_G['gp_picids']) { ?><?php $_G[gp_picids] = explode(',', $_G[gp_picids]); if(is_array($_G['gp_picids'])) foreach($_G['gp_picids'] as $value) { ?><input type="checkbox" name="ids[<?php echo $value;?>]" value="<?php echo $value;?>" style="display:none;" checked="checked">
<?php } } ?>
<input type="hidden" name="editpicsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>	
</form>	
<script type="text/javascript">
jQuery(function(){		
jQuery('#editpicsubmit').click(function(){

//���Ժ����ʽ��д,�ᵽ�˸��������ܵ���ʽ
jQuery('#fwin_albumpicdelete').hide();			
showDialog('', 'info', '<img src="' + IMGDIR + '/loading.gif"> ���Ժ�...');

ajaxpost('deletepicform', 'return_<?php echo $_G['gp_handlekey'];?>');
});
});
</script>
<?php } } elseif($_GET['op'] == 'edit') { ?>
<form method="post" autocomplete="off" id="albumeditform" name="albumeditform" action="home.php?mod=spacecp&amp;ac=album&amp;op=edit&amp;albumid=<?php echo $albumid;?>&amp;is_uc=1" <?php if($_G['inajax']) { ?> onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox w570">
<div class="flb">
<div class="popbox_title clearfix">
<span>�����Ϣ</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="albumform">
<li>
<label>�������</label>
<input type="text" id="albumname" name="albumname" value="<?php echo $album['albumname'];?>" class="inputtext" />
</li>					
<li>
<label>��˽���ã�</label>
<select name="friend" class="h36">
<option value="0" <?php if($album['friend'] == 0) { ?>selected="selected"<?php } ?>>ȫվ�û��ɼ�</option>
<option value="3" <?php if($album['friend'] > 0) { ?>selected="selected"<?php } ?>>���Լ��ɼ�</option>
</select>						
</li>
<li>
<label></label>
<button type="submit" name="editsubmit" value="true" class="button_confirm" id="editsubmit">ȷ��</button>
<a href="home.php?mod=spacecp&amp;ac=album&amp;op=delete&amp;albumid=<?php echo $album['albumid'];?>&amp;handlekey=delalbumhk_<?php echo $album['albumid'];?>&amp;is_uc=1" id="album_delete_<?php echo $album['albumid'];?>" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');showWindow(this.id, this.href, 'get', 0);" class="delalbum">ɾ�����</a>
</li>
</ul>
</div>
</div>
<input type="hidden" name="editsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>	
</form>
<script type="text/javascript">
//���༭�Ļص�����
function succeedhandle_albumedit(url, msg, values) {
if (values['success']) {
location.reload();
}
}
</script>
<?php } elseif($_GET['op'] == 'createalbum') { ?>
<form method="post" autocomplete="off" id="albumeditform" name="albumeditform" action="home.php?mod=spacecp&amp;ac=album&amp;op=createalbum&amp;is_uc=1" <?php if($_G['inajax']) { ?> onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox w570">
<div class="flb">
<div class="popbox_title clearfix">
<span>�����Ϣ</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="albumform">
<li>
<label>�������</label>
<input type="text" id="albumid" name="albumid" value="" class="inputtext" />
</li>
<li>
<label></label>
<button type="submit" name="createalbumsubmit" value="true" class="button_confirm" id="createalbumsubmit">ȷ��</button>
</li>
</ul>
</div>
</div>
<input type="hidden" name="createalbumsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>	
</form>	
<script type="text/javascript">
//�½����Ļص�����
function succeedhandle_createalbum(url, msg, values) {
if (values['success']) {
jQuery('#selectAlbumid').val(values['albumid']);
jQuery('#movepicform').show();			
jQuery('#movepicform li').removeClass('active');			
var html = '<li class="li_'+values['albumid']+' active selectAlbumid" rel="'+values['albumid']+'">';			
html    += '<a class="iconbox44" href="javascript:void(0);"><img src=""></a>';
html    += '<p>';
html    += '<a class="titlename pt0" href="javascript:void(0);">'+values['albumname']+'</a>';
html    += '<span class="notetxt">ȫվ�û��ɼ�</span>';
html    += '</p></li>';			

jQuery('.createalbum').after(html);			

albummovehandle = setInterval(function(){																								
if (jQuery('#fctrl_albummove').length > 0) {
jQuery('#fctrl_albummove').show();
clearInterval(albummovehandle);
}
},100);			
}
}
</script>

<?php } include template('common/footer'); ?>