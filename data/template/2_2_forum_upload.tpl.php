<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('upload', 'common/header');?><?php include template('common/header'); ?><div>
<h3 class="flb">
<em id="return_upload">�ϴ�</em>
<span><a href="javascript:;" class="flbc" onclick="hideWindow('upload')" title="�ر�">�ر�</a></span>
</h3>

<form id="uploadform" method="post" autocomplete="off" target="uploadattachframe" onsubmit="uploadWindowstart()" action="misc.php?mod=swfupload&amp;operation=upload&amp;type=<?php echo $_G['gp_type'];?>&amp;inajax=yes&amp;infloat=yes&amp;simple=2" enctype="multipart/form-data">
<div class="c">
<input type="hidden" name="handlekey" value="upload" />
<input type="hidden" name="uid" value="<?php echo $_G['uid'];?>">
<input type="hidden" name="hash" value="<?php echo md5(substr(md5($_G['config']['security']['authkey']), 8).$_G['uid']); ?>">
<input type="file" name="Filedata" size="30" class="filedata" />
<p class="mtn" id="uploadwindowing" style="visibility:hidden"><img src="<?php echo IMGDIR;?>/uploading.gif" /></p>
<?php if($type == 'image') { ?>������չ��: <strong><?php echo $imgexts;?></strong><?php } elseif($_G['group']['attachextensions']) { ?>������չ��: <strong><?php echo $_G['group']['attachextensions'];?></strong><?php } ?>
</div>
<p class="o pns">
<button type="submit" name="uploadsubmit" id="uploadsubmit" class="pn pnc" tabindex="1" value="true"><span>�ϴ�</span></button>
</p>
</form>
<iframe name="uploadattachframe" id="uploadattachframe" style="display: none;" onload="uploadWindowload();"></iframe>
</div><?php include template('common/footer'); ?>