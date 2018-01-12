<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('ajax_threadlist', 'common/header_ajax');?><?php include template('common/header_ajax'); if(count($threadlist)>0) { if(is_array($threadlist)) foreach($threadlist as $k => $v) { ?><li>
<div class="upline clear_b">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['icontid'];?>&amp;<?php if($_G['gp_archiveid']) { ?>archiveid=<?php echo $_G['gp_archiveid'];?>&amp;<?php } ?>extra=<?php echo $extra;?>" title="<?php if(in_array($v['displayorder'], array(1, 2, 3, 4,'p'))) { if($v['displayorder'] == 1) { ?>本版置顶主题 - <?php } elseif($v['displayorder'] == 2) { ?>分类置顶主题 - <?php } elseif($v['displayorder'] == 3) { ?>全局置顶主题 - <?php } elseif($v['displayorder'] == 4) { ?>多版置顶主题 - <?php } elseif($v['displayorder'] == 'p') { ?>地区置顶主题 - <?php } } ?>新窗口打开" target="_blank" class="icon17_17">
<?php if($v['folder'] == 'lock') { ?>
<img src="http://static.8264.com/static/image/common/folder_lock.gif" />
<?php } elseif($v['special'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/pollsmall.gif" alt="投票" />
<?php } elseif($v['special'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/tradesmall.gif" alt="商品" />
<?php } elseif($v['special'] == 3) { ?>
<img src="http://static.8264.com/static/image/common/rewardsmall.gif" alt="悬赏" />
<?php } elseif($v['special'] == 4) { ?>
<img src="http://static.8264.com/static/image/common/activitysmall.gif" alt="活动" />
<?php } elseif($v['special'] == 5) { ?>
<img src="http://static.8264.com/static/image/common/debatesmall.gif" alt="辩论" />
<?php } elseif(in_array($v['displayorder'], array(1, 2, 3, 4,'p'))) { ?>
<img src="http://static.8264.com/static/image/common/pin_<?php echo $v['displayorder'];?>.gif" alt="<?php echo $_G['setting']['threadsticky'][3-$v['displayorder']];?>" />
<?php } else { ?>
<img src="http://static.8264.com/static/image/common/folder_<?php echo $v['folder'];?>.gif" />
<?php } ?>
</a>
<?php if(!$_G['gp_archiveid'] && $_G['forum']['ismoderator']==1) { ?>
<span class="czcheckbox">
<?php if($v['fid'] == $_G['fid']) { if($v['displayorder'] <= 3 || $v['displayorder']=='p' || $_G['adminid'] == 1) { ?>
<input onclick="tmodclick(this)" type="checkbox" name="moderate[]" value="<?php echo $v['tid'];?>" />
<?php } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } } else { ?>
<input type="checkbox" disabled="disabled" />
<?php } ?>
</span>
<?php } ?>
<a href="http://bbs.8264.com/forum-forumdisplay-fid-<?php echo $_G['fid'];?>-typeid-<?php echo $v['typeid'];?>-filter-typeid.html" target="_blank" class="zfenlei">[<?php if($_G['forum']['threadtypes']['types'][$v['typeid']]) { ?><?php echo $_G['forum']['threadtypes']['types'][$v['typeid']];?><?php } else { ?><?php echo $_G['forum']['threadtypes']['childtypes'][$_G['forum']['threadtypes']['fatherid'][$v['typeid']]][$v['typeid']];?><?php } ?>]</a><a href="http://bbs.8264.com/thread-<?php echo $v['tid'];?>-1-1.html" <?php echo $v['highlight'];?> target="_blank" class="title14"><?php echo $v['subject'];?></a>
<?php if($v['multipage']) { ?><span class="tps"><?php echo $v['multipage'];?></span><?php } if($v['readperm']) { ?> [阅读权限 <span class="bold"><?php echo $v['readperm'];?></span>]<?php } if($v['price'] > 0) { if($v['special'] == '3') { ?>
<span style="color: #C60">悬赏<?php echo $v['price'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?>
<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?></span>
<?php } else { ?>[售价 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?>
<span class="bold"><?php echo $v['price'];?></span><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?>]
<?php } } elseif($v['special'] == '3' && $v['price'] < 0) { ?>
<span style="color: #C60">[已解决]</span>
<?php } if($v['attachment'] == 2) { ?>
<img src="http://static.8264.com/static/image/common/th_img.jpg" title="图片附件" style="display: none;" />
<?php } elseif($v['attachment'] == 1) { ?>
<img src="http://static.8264.com/static/image/common/th_fj.jpg" title="附件" style="display: none;" />
<?php } if($v['stamp']==0 && $v['rate']>0) { ?><img src="http://static.8264.com/static/image/common/th_b.jpg" title="奖励8264币" /><?php } if($v['weeknew']) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $thread['tid'];?>&amp;goto=lastpost#lastpost" class="newicon" style="display: none;">NEW</a><?php } ?>
</div>
<div class="downline clear_b">
<em>作者：<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>"><?php echo $v['author'];?></a></em>
<em>发表于：<a <?php echo $v['color'];?>><?php echo $v['dateline'];?></a></em>
<em>最后回复：<?php if($v['lastposter']) { ?><a href="home.php?mod=space&amp;username=<?php echo $v['lastposterenc'];?>"><?php echo $v['lastposter'];?></a><?php } else { ?>匿名<?php } ?> <a href="forum.php?mod=redirect&amp;tid=<?php echo $v['tid'];?>&amp;goto=lastpost#lastpost" class="dateend"><?php echo $v['lastpost'];?></a></em>
<em class="review"><?php echo $v['views'];?></em>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['tid'];?>&amp;extra=<?php echo $extra;?>" class="hfs"><?php echo $v['replies'];?></a>
</div>
</li>
<?php } ?>
<div id="threadmore_<?php echo $typeid;?>_<?php echo $nextpage;?>">
<a href="javascript:void(0);" onclick="ajaxget('forum.php?mod=ajax&action=loadthreadlist&fid=<?php echo $fid;?>&typeid=<?php echo $typeid;?>&page=<?php echo $nextpage;?>', 'threadmore_<?php echo $typeid;?>_<?php echo $nextpage;?>');" class="addmore">点击加载更多</a>
</div>
<?php } else { ?>
<div id="threadmore">
<a href="javascript:void(0);" class="addmore">没有更多帖子了，去别的版看看吧</a>
</div>
<?php } include template('common/footer_ajax'); ?>