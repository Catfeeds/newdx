<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style type="text/css">
.rwdn img { max-width:715px; _width:expression(this.width>715?"715px":true); overflow:hidden;}
.psth{margin:2em 0 ;}
</style>
<div class="rwd cl">
<div class="<?php if($_G['forum_thread']['price'] > 0) { ?>sx_wjj90_118<?php } elseif($_G['forum_thread']['price'] < 0) { ?>sx_jj90_118<?php } ?>">
<b><?php echo $rewardprice;?></b><span><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?></span>
</div>
<div class="rwdn">
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php echo $post['message'];?></td></tr></table>
<?php if($_G['forum_thread']['price'] > 0 && !$_G['forum_thread']['is_archived']) { ?>
<a href="javascript:;" class="wyhd94_30" onclick="showWindow('reply', 'forum.php?mod=post&action=reply&fid=<?php echo $_G['fid'];?>&tid=<?php echo $_G['tid'];?><?php if($_G['gp_from']) { ?>&from=<?php echo $_G['gp_from'];?><?php } ?>')"></a>
<?php } ?>
</div>
</div>

<?php if($post['attachment']) { ?>
<div class="locked">附件: <em><?php if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<?php } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
<div class="pattl">
<?php if($post['imagelist']) { ?>
<?php echo $post['imagelist'];?>
<?php } if($post['attachlist']) { ?>
<?php echo $post['attachlist'];?>
<?php } ?>
</div>
<?php } ?><?php $post['attachment'] = $post['imagelist'] = $post['attachlist'] = ''; if($bestpost) { ?>
<div class="rwdbst">
<h3 class="psth">最佳答案</h3>
<div class="pstl">
<div class="psta"><?php echo $bestpost['avatar'];?></div>
<div class="psti">
<p class="xi2">
<a href="home.php?mod=space&amp;uid=<?php echo $bestpost['authorid'];?>" class="xw1"><?php echo $bestpost['author'];?></a>
<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $bestpost['tid'];?>&pid=<?php echo $bestpost['pid'];?>')">查看完整内容</a>
</p>
<div class="mtn"><?php echo $bestpost['message'];?></div>
</div>
</div>
</div>
<?php } ?>