<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($debate['umpire']) { ?>	
<?php if($debate['umpirepoint']) { ?>
<div id="umpirepoint">
<p class="dbresult">
<?php if($debate['winner']) { if($debate['winner'] == 1) { ?>
<label class="winner_1"><strong>正方</strong>获胜</label>
<?php } elseif($debate['winner'] == 2) { ?>
<label class="winner_2"><strong>反方</strong>获胜</label>
<?php } else { ?>
<label class="winner_0"><strong>平局</strong></label>
<?php } } ?>
<em>评判时间: <?php echo $debate['endtime'];?></em>
</p>
<?php if($debate['umpirepoint']) { ?><p class="umpirepoint"><strong>裁判观点</strong>: <?php echo $debate['umpirepoint'];?></p><?php } if($debate['bestdebater']) { ?><p class="bestdebater"><strong>最佳辩手</strong>: <?php echo $debate['bestdebater'];?></p><?php } ?>
</div>
<?php } } ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php echo $post['message'];?></td></tr></table>

<?php if($debate['endtime']) { ?>
<p class="dtm">结束时间: <?php echo $debate['endtime'];?> <?php if($debate['umpire']) { ?>裁判: <?php echo $debate['umpire'];?><?php } ?></p>
<?php } if($debate['umpire'] && $_G['username'] && $debate['umpire'] == $_G['member']['username']) { ?>
<p class="dtm pns">
<?php if($debate['remaintime'] && !$debate['umpirepoint']) { ?>
 <button type="button" class="pn" onclick="showWindow('debate', 'forum.php?mod=misc&action=debateumpire&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&from=<?php echo $_G['gp_from'];?><?php } ?>')"><span>结束此次辩论</span></button>
<?php } elseif(TIMESTAMP - $debate['dbendtime'] < 3600) { ?>
 <button type="button" class="pn" onclick="showWindow('debate', 'forum.php?mod=misc&action=debateumpire&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php if($_G['gp_from']) { ?>&from=<?php echo $_G['gp_from'];?><?php } ?>')"><span>编辑裁判观点</span></button>
<?php } ?>
</p>
<?php } ?>

<div class="ds">
<table summary="全部观点" cellspacing="0" cellpadding="0">
<tr>
<td class="si_1">
<div class="point">
<strong>正方观点 (<?php echo $debate['affirmvotes'];?>)</strong>
<p><?php echo $debate['affirmpoint'];?></p>
</div>
</td>
<td class="sc_1">
<div class="point_chart">
<div class="chart" style="height: <?php echo $debate['affirmvoteswidth']; ?>%;" title="正方 (<?php echo $debate['affirmvotes'];?>)"></div>
</div>
</td>
<th><div></div></th>
<td class="sc_2">
<div class="point_chart">
<div class="chart" style="height: <?php echo $debate['negavoteswidth']; ?>%;" title="反方 (<?php echo $debate['negavotes'];?>)"></div>
</div>
</td>
<td class="si_2">
<div class="point">
<strong>反方观点 (<?php echo $debate['negavotes'];?>)</strong>
<p><?php echo $debate['negapoint'];?></p>
</div>
</td>
</tr>
</table>
</div>
<div class="dr">
<table summary="全部观点" cellspacing="0" cellpadding="0">
<?php if(!$_G['forum_thread']['is_archived']) { ?>
<tr>
<td class="sr_1 pns">
<button href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;stand=1" id="affirmbutton" onclick="<?php if($_G['uid']) { ?>ajaxmenu(this);<?php } else { ?>showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes');<?php } ?>doane(event);" class="pn"<?php if($post['invisible'] < 0) { ?> disabled<?php } ?>><span>支持</span></button>
<h5>辩手:<?php echo $debate['affirmdebaters'];?> ( <a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;stand=1<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">加入</a> )</h5>
<ul class="ml mls cl"><?php if(is_array($debate['affirmavatars'])) foreach($debate['affirmavatars'] as $user) { ?><li style="float: right;">
<a title="<?php echo $user['author'];?>" target="_blank" href="home.php?mod=space&amp;uid=<?php echo $user['authorid'];?>" class="avt"><?php echo $user['avatar'];?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['authorid'];?>"><?php echo $user['author'];?></a></p>
</li>
<?php } ?>
</ul>
</td>
<th>&nbsp;</th>
<td class="sr_2 pns">
<h5>辩手:<?php echo $debate['negadebaters'];?> ( <a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;stand=2<?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="showWindow('reply', this.href)">加入</a> )</h5>
<button href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;stand=2" id="negabutton" onclick="<?php if($_G['uid']) { ?>ajaxmenu(this);<?php } else { ?>showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes');<?php } ?>doane(event);" class="pn"<?php if($post['invisible'] < 0) { ?> disabled<?php } ?>><span>支持</span></button>
<ul class="ml mls cl"><?php if(is_array($debate['negaavatars'])) foreach($debate['negaavatars'] as $user) { ?><li>
<a title="<?php echo $user['author'];?>" target="_blank" href="home.php?mod=space&amp;uid=<?php echo $user['authorid'];?>" class="avt"><?php echo $user['avatar'];?></a>
<p><a href="home.php?mod=space&amp;uid=<?php echo $user['authorid'];?>"><?php echo $user['author'];?></a></p>
</li>
<?php } ?>
</ul>
</td>
</tr>
<?php } ?>
</table>
</div>