<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<span class="ui-title-manage">管理</span>
<ul class="op-manage-list">
<li>
<a href="http://www.8264.com/forum.php?ctl=<?php echo $mod;?>&amp;act=dopost&amp;do=edit&amp;tid=<?php echo $detail['tid'];?>&amp;pid=<?php echo $detail['pid'];?>" class="op-edit">编辑</a>
</li>
<li>
<a href="http://www.8264.com/forum.php?ctl=<?php echo $mod;?>&amp;act=deleteit&amp;tid=<?php echo $detail['tid'];?>&amp;pid=<?php echo $detail['pid'];?>" class="op-delete" onclick="return confirm('确认删除这个<?php echo $modname;?>？删除后将不可恢复！');">删除</a>
</li>
<li>
<a class="op-audit op-audit-ok" href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=dopost&amp;do=checkit&amp;tid=<?php echo $detail['tid'];?>&amp;pid=<?php echo $detail['pid'];?>&amp;type=1" <?php if($detail['ispublish']==1) { ?>style="display:none;"<?php } ?>>通过审核</a>
<a class="op-audit op-audit-cancle" href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=dopost&amp;do=checkit&amp;tid=<?php echo $detail['tid'];?>&amp;pid=<?php echo $detail['pid'];?>&amp;type=0" <?php if($detail['ispublish']==0) { ?>style="display:none;"<?php } ?>>取消审核</a>
</li>
</ul>
