<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<h3 class="flb">
<em style="color:#333;">
<a title="�������<?php echo $data['stateName'];?>������̳" href="<?php echo $_G['config']['web']['forum'];?>forum-<?php echo $data['fid'];?>-1.html" ><?php echo $data['stateName'];?>������̳</a></em>
<span><a title="�ر�" class="flbc" onclick="setcookie('nofocus_difanban', 1, 86400);$('sitefocus').style.display='none'" href="javascript:;">�ر�</a></span></h3>
<hr class="l">
<div class="detail">
<ul class="sitefocuslist"><?php if(is_array($data['threads'])) foreach($data['threads'] as $k => $thread) { if($k == 0) { ?>
<li>
 <a target="_blank" href="http://www.zaiwai.com/xianlu-538?utm_source=s14363562&utm_campaign=p15019693"><span style='background:#FF0;color:#000;'>[�����]</span>ԽҰ��ר��-ţ��ɽ ɫ�� ���� ���ڻ��ߣ�7���г̣�</a>
</li>
<?php } elseif($k == 1 && $xianlu) { ?>
<li>
 <a target="_blank" href="http://www.zaiwai.com/xianlu-<?php echo $xianlu['0']['goods_id'];?>?utm_source=s14363562&utm_campaign=p15004347"><span style='background:#FF0;color:#000;'>[��ĩ�]</span><?php echo diconv($xianlu['0']['title'],'UTF-8','GBK'); ?></a>
</li>
<?php } else { ?>
<li>
 <a target="_blank" href="<?php echo $_G['config']['web']['forum'];?>thread-<?php echo $thread['tid'];?>-1-1.html"><span>[<?php echo $data['localpart'][$thread['typeid']];?>]</span><?php echo $thread['subject'];?></a>
</li>
<?php } } ?>
</ul>
</div>
