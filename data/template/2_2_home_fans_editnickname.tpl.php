<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('editnickname', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css" />
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">���ѱ�ע</em>
<span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span>
</h3>
<form method="post" autocomplete="off" id="editnoteform_<?php echo $uid;?>" name="editnoteform_<?php echo $uid;?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=editnickname&amp;uid=<?php echo $uid;?>" onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="editnotesubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<p>Ϊ��ǰ������дһ�仰��ע�������Լ�ʶ��</p>
<input type="text" name="note" class="px mtn" value="<?php echo $nickname;?>" size="50" />
</div>
<p class="o pns">
<button type="submit" name="editnotesubmit_btn" class="pn pnc" value="true"><strong>ȷ��</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
var uid=values['uid'];
jQuery("span[fuid=" + uid + "]").parents('div.friend-attention-info').find("span.nickname").text("(" + values['note']+ ")");
}
</script><?php include template('common/footer_8264_new'); ?>