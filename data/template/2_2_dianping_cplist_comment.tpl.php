<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="rows-content row-color-6 review-op-bar">
<ul class="review-op-list">
<?php if($_G['adminid'] == 1) { ?>
<!-- <li>
<a href="javascript:;" onclick="stickreply(<?php echo $comment['pid'];?>);">�ö�</a>
</li>
<li>
<a href="javascript:;" onclick="delpost(<?php echo $comment['pid'];?>);">ɾ��</a>
</li> -->
<li><input type="checkbox" id="manage<?php echo $comment['pid'];?>" class="pc" onclick="pidchecked(this);modclick(this, <?php echo $comment['pid'];?>)" value="<?php echo $comment['pid'];?>" autocomplete="off"> ����</li>
<li>
<a href="javascript:;" id="k_rate" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $comment['tid'];?>&pid=<?php echo $comment['pid'];?>', 'get', -1);return false;">����</a>
</li>
<?php if($comment['rate']) { ?>
<li>
<a href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=removerate&tid=<?php echo $comment['tid'];?>&pid=<?php echo $comment['pid'];?>', 'get', -1);return false;">��������</a>
</li>
<?php } } ?>
<li>
<a href="javascript:void(0);" id="<?php echo $comment['pid'];?>" class="editclick"><i class="icon-m icon-edit-m"></i>�޸�</a>
</li>
</ul>
</div>