<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('ajax', 'common/header_ajax');?><?php include template('common/header_ajax'); if($op == 'del_fav') { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">删除该项</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" id="doingform_<?php echo $disp;?>" name="doingform" action="fav.php?mod=ajax&amp;id=<?php echo $id;?>&amp;op=del_fav" onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');" >
        <input name="delimgsubmit" id="delimgsubmit" value="true" type="hidden">
        <?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">确认删除该项吗？</div>
<p class="o pns">
<button type="submit" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">

function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
window.location.reload();

}
</script>
<?php } elseif($op=='mycenter') { ?>    
    <?php if($_G['uid']) { ?>
<ul><?php if(is_array($_G['setting']['mynavs'])) foreach($_G['setting']['mynavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { ?>
<li><?php echo $nav['code'];?></li>
<?php } } ?>
</ul>
<?php if(!empty($_G['style']['extstyle'])) { ?>
<div class="sslct cl">
<?php if(!$_G['style']['defaultextstyle']) { ?><span class="sslct_btn" onClick="extstyle('')" title="默认"><i>&nbsp;</i></span><?php } if(is_array($_G['style']['extstyle'])) foreach($_G['style']['extstyle'] as $extstyle) { ?><span class="sslct_btn" onClick="extstyle('<?php echo $extstyle['0'];?>')" title="<?php echo $extstyle['1'];?>"><i style='background:<?php echo $extstyle['2'];?>'>&nbsp;</i></span>
<?php } ?>
</div>
<?php } } else { ?>
<p class="reg_tip">
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href)" class="xi2">注册新用户，开通自己的个人中心</a>
</p>
<?php } } elseif($op == 'tishi') { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">提示</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<div id="showmessage" class="c">
    	<h2>自定义网址<br />数量最多为35！</h2>
    </div>
    <p class="o pns">
        <button type="button" class="pn pnc" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="true"><strong>确定</strong></button>
    </p>
<script type="text/javascript">

function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
window.location.reload();

}
</script>
<?php } elseif($op=='header') { include template('common/header_link'); ?> <?php } elseif($op=='footer') { include template('common/footer_link'); ?>     
     
     
<?php } elseif($op=='login_info_favs') { ?>     
 <?php if($_G['uid']) { ?>

<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a></strong>



<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus" class="">
<a href="member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);">
<?php if($_G['session']['invisible']) { ?>
隐身
<?php } else { ?>
在线
<?php } ?>
</a>
</span>
<?php } ?>


 <a href="home.php?mod=space&amp;do=friend">好友</a> 


<?php if($_G['setting']['regstatus'] > 1) { ?>
<a href="home.php?mod=spacecp&amp;ac=invite" class="">邀请</a> 
<?php } ?>


 <span id="usersetup" class="showmenu" onMouseOver="showMenu(this.id);">
<a href="home.php?mod=spacecp">设置</a>
</span>


 <a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>提醒
<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?>
</a><span id="myprompt_check"></span>



 <a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>短消息
<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>




<?php if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || in_array($_G['uid'], $_G['setting']['ext_portalmanager'])) { ?>
 <a href="portal.php?mod=portalcp">门户管理</a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
 <a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
 <a href="admin.php" target="_blank">管理中心</a>
<?php } ?>




 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<strong><a id="loginuser"><?php echo $_G['cookie']['loginuser'];?></a></strong>


 
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">激活</a>


 <a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>


<?php } else { ?>
<a href="http://bbs.8264.com/connect.php?method=sina&amp;action=login&amp;op=init" class="log_wb">微博登陆</a>
<a href="http://bbs.8264.com/connect-login-op-init-referer-index.php-statfrom-login_simple.html" class="log_qq">QQ登陆</a>
<div style=" float:right;">
<a>欢迎来到8264!</a>
<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onClick="showWindow('register', this.href);hideWindow('login');"><?php echo $_G['setting']['reglinkname'];?></a>
<a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">登录</a></div>

<?php } ?>
    
     
     
     
     
     
<?php } elseif($op=='login_info_fav') { if($_G['uid']) { ?>

<div id="um">

<div class="avt y"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" c="34"><?php echo avatar($_G[uid],small); ?></a></div>
<p>
<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" class="vwmy" target="_blank" title="访问我的空间"><?php echo $_G['member']['username'];?></a></strong>
<?php if($_G['group']['allowinvisible']) { ?>
<span id="loginstatus" class="xg1">
<a href="member.php?mod=switchstatus" title="切换在线状态" onClick="ajaxget(this.href, 'loginstatus');doane(event);">
<?php if($_G['session']['invisible']) { ?>
隐身
<?php } else { ?>
在线
<?php } ?>
</a>
</span>
<?php } ?>
<span class="pipe">|</span><span id="usersetup" class="showmenu" onMouseOver="showMenu(this.id);"><a href="home.php?mod=spacecp">设置</a></span>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1']; ?>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=notice" id="myprompt"<?php if($_G['member']['newprompt']) { ?> class="new"<?php } ?>>提醒<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?></a><span id="myprompt_check"></span>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=pm" id="pm_ntc"<?php if($_G['member']['newpm']) { ?> class="new"<?php } ?>>短消息<?php if($_G['member']['newpm']) { ?>(<?php echo $_G['member']['newpm'];?>)<?php } ?></a>
<span class="pipe">|</span><a href="home.php?mod=space&amp;do=friend">好友</a> <?php if($_G['setting']['regstatus'] > 1) { ?><a href="home.php?mod=spacecp&amp;ac=invite" class="xg1">邀请</a> <?php } if($_G['setting']['taskon']) { ?>
<span class="pipe">|</span>
<?php if(empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?>
<a href="home.php?mod=task&amp;item=new">任务</a>
<?php } else { ?>
<a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="new">进行中的任务</a>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2']; if($_G['group']['allowmanagearticle'] || $_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock'] || $_G['group']['allowauthorizedarticle']) { ?>
<span class="pipe">|</span><a href="portal.php?mod=portalcp">门户管理</a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
<span class="pipe">|</span><a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) { ?>
<span class="pipe">|</span><a href="admin.php" target="_blank">管理中心</a>
<?php } ?>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
</p>
<p><?php $upgradecredit = $_G['uid'] && $_G['group']['grouptype'] == 'member' && $_G['group']['groupcreditslower'] != 999999999 ? $_G['group']['groupcreditslower'] - $_G['member']['credits'] : false; ?>积分: <a href="home.php?mod=spacecp&amp;ac=credit"><?php echo $_G['member']['credits'];?></a><?php if(is_array($_G['setting']['extcredits'])) foreach($_G['setting']['extcredits'] as $extcreditid => $extcredit) { if(empty($extcredit['hiddeninheader'])) { ?> , <?php echo $extcredit['img'];?><?php echo $extcredit['title'];?>: <a href="home.php?mod=spacecp&amp;ac=credit" id="hcredit_<?php echo $extcreditid;?>"><?php echo getuserprofile('extcredits'.$extcreditid);; ?></a> <?php echo $extcredit['unit'];?><?php } } ?> , 用户组: <a href="home.php?mod=spacecp&amp;ac=usergroup"<?php if($upgradecredit !== 'false') { ?> id="g_upmine" class="xi2" onMouseOver="showMenu({'ctrlid':this.id, 'pos':'21'});"<?php } ?>><?php echo $_G['group']['grouptitle'];?></a>
</p>
</div>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<p>
<strong><a id="loginuser" class="noborder"><?php echo $_G['cookie']['loginuser'];?></a></strong>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onClick="showWindow('login', this.href);hideWindow('register');">激活</a>
<span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
</p>
<?php } else { include template('member/login_simple'); } ?>
</div>
<?php } include template('common/footer_ajax'); ?>