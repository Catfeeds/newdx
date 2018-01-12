<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_task_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/space_task_2014.htm', './template/8264/home/space_left_2014.htm', 1509517894, '2', './data/template/2_2_home_space_task_2014.tpl.php', './template/8264', 'home/space_task_2014')
|| checktplrefresh('./template/8264/home/space_task_2014.htm', './template/8264/home/space_task_list_2014.htm', 1509517894, '2', './data/template/2_2_home_space_task_2014.tpl.php', './template/8264', 'home/space_task_2014')
|| checktplrefresh('./template/8264/home/space_task_2014.htm', './template/8264/home/space_task_detail_2014.htm', 1509517894, '2', './data/template/2_2_home_space_task_2014.tpl.php', './template/8264', 'home/space_task_2014')
|| checktplrefresh('./template/8264/home/space_task_2014.htm', './template/8264/home/space_footer_2014.htm', 1509517894, '2', './data/template/2_2_home_space_task_2014.tpl.php', './template/8264', 'home/space_task_2014')
|| checktplrefresh('./template/8264/home/space_task_2014.htm', './template/8264/common/footer_8264_new.htm', 1509517894, '2', './data/template/2_2_home_space_task_2014.tpl.php', './template/8264', 'home/space_task_2014')
;?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/notice.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/common/bootstrap.min.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<div class="w980">
<div class="clear_b module user-setting-wrap"><!--去除任务展示对未登陆用户的控制-->
<?php if(!empty($_G['uid'])) { ?>	<div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked navigate_notification">
<li <?php if($notify_type == 'notification') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=notification"><s class="menu-nav-icon icon-1">提醒</s><span showclass="li_tz">通知
</span><?php if(isset($space['notifications']) && $space['notifications']) { ?><em class="number"><?php echo $space['notifications'];?></em><?php } ?></a>
</li>
<li <?php if($notify_type == 'invitation') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=invitation"><s class="menu-nav-icon icon-2">邀请</s><span showclass="li_yq">邀请
</span><?php if(isset($space['newinvite']) && $space['newinvite']) { ?><em class="number"><?php echo $space['newinvite'];?></em><?php } ?></a>
</li>
<!--
<li <?php if($notify_type == 'greeting') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=greeting"><s class="menu-nav-icon icon-5">招呼</s><span showclass="li_dzh">招呼
</span><?php if(isset($space['pokes']) && $space['pokes']) { ?><em class="number"><?php echo $space['pokes'];?></em><?php } ?></a>
</li>
-->
<li <?php if($notify_type == 'smessage' || $_G['gp_ac'] == 'pm' || $_G['gp_do'] == 'pm') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=smessage"><s class="menu-nav-icon icon-7">短消息</s><span showclass="li_dxx">短消息
</span><?php if(isset($space['newpm']) && $space['newpm']) { ?><em class="number smessage_number"><?php echo $space['newpm'];?></em><?php } ?></a>
</li>

<li <?php if($_G['gp_mod'] == 'task') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=task&item=new"><s class="menu-nav-icon icon-8">任务</s><span showclass="li_dxx">任务
</span><?php if($taskcount) { ?><em class="number smessage_number"><?php echo $taskcount;?></em><?php } ?></a>
</li>
</ul>
        <div style="margin:10px 0px 0px 0px;"><?php echo adshow("custom_435"); ?></div>
</div>
    
<?php } ?>
<div <?php if(!empty($_G['uid'])) { ?>class="r_760"<?php } ?>>
<?php if(empty($do)) { ?><div class="top_q_d clear_b">
<a href="home.php?mod=task&amp;item=new"<?php if($actives['new']) { ?> class="zhong"<?php } ?>>新任务</a>
<a href="home.php?mod=task&amp;item=doing"<?php if($actives['doing']) { ?> class="zhong"<?php } ?>>进行中的任务</a>
<a href="home.php?mod=task&amp;item=done"<?php if($actives['done']) { ?> class="zhong"<?php } ?>>已完成的任务</a>
<a href="home.php?mod=task&amp;item=failed"<?php if($actives['failed']) { ?> class="zhong"<?php } ?>>失败的任务</a>
</div>

<?php if($tasklist) { ?>
<div class="rw_s_l clear_b">
    <ul class="clear_b">
    <?php if(is_array($tasklist)) foreach($tasklist as $task) { ?>        <?php if($task['scriptname'] != 'weixin') { ?>
                <?php if($task['scriptname'] == 'appshare' || $task['scriptname'] == 'changxian' || $task['scriptname'] == 'appfollow') { ?>
                <li class="zaiwaibox">
                    <span class="rwicon49_50zaiwainew"></span>
                <?php } else { ?>
                <li>
                    <span class="rwicon49_50"></span>
                <?php } ?>
                <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="rwname"><?php echo $task['name'];?></a>
                <span class="lbrq">
                    <span>
                    <?php if($task['reward'] == 'credit') { ?>
                            <?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?>：<i class="orange"><?php echo $task['bonus'];?></i>
                    <?php } elseif($task['reward'] == 'magic') { ?>
                            道具 <?php echo $listdata[$task['prize']];?> <?php echo $task['bonus'];?> 张
                    <?php } elseif($task['reward'] == 'medal') { ?>
                            勋章 <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?>有效期 <?php echo $task['bonus'];?> 天 <?php } ?>
                    <?php } elseif($task['reward'] == 'invite') { ?>
                            邀请码 <?php echo $task['prize'];?> 有效期 <?php echo $task['bonus'];?> 天
                    <?php } elseif($task['reward'] == 'group') { ?>
                            用户组 <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> 天 <?php } ?>
                    <?php } ?>
                    </span>
                    <span>人气：<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>#parter"><?php echo $task['applicants'];?></a></span>
                </span>
                <?php if($_G['gp_item'] == 'new') { ?>
                    <?php if($task['noperm']) { ?>
                            <a href="javascript:;" onclick="doane(event);showDialog('你所在的用户组无法申请此任务')" class="ljsq_g" title="你所在的用户组无法申请此任务"></a>
                    <?php } elseif($task['appliesfull']) { ?>
                            <a href="javascript:;" onclick="doane(event);showDialog('人数已满')" class="ljsq_g" title="人数已满"></a>
                    <?php } else { ?>
                        <?php if($task['scriptname'] == 'weixin') { ?>
                            <?php if(!$is_share) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                            <?php } else { ?>
                            <div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>
                            <?php } ?>
                        <?php } elseif($task['scriptname'] == 'changxian') { ?>
                            <?php if(!$is_share_changxian) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zaiwailink">立即申请</a></div>
                            <?php } else { ?>
                            <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>-->
                            <div class="mingtianzai"><span>今天已完成，请明天再申请</span></div>
                            <?php } ?>
                        <?php } elseif($task['scriptname'] == 'tiezi') { ?>
                            <?php if(!$is_share_tiezi) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                            <?php } else { ?>
                            <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>-->
                            <div class="mingtianzai"><span>今天已完成，请明天再申请</span></div>
                            <?php } ?>    
                        <?php } elseif($task['scriptname'] == 'appshare') { ?>
                            <?php if(!$is_share_appshare) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zaiwailink">立即申请</a></div>
                            <?php } else { ?>
                            <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>-->
                            <div class="mingtianzai"><span>今天已完成，请明天再申请</span></div>
                            <?php } ?>
                        <?php } elseif($task['scriptname'] == 'appfollow') { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zaiwailink">立即申请</a></div>	
                        <?php } else { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } ?>
                    <?php } ?>
                <?php } elseif($_G['gp_item'] == 'doing') { ?>
                    <div class="jdtwarpten">
                            <div class="gojdt" style="width:<?php echo $task['csc'];?>%;"></div>
                            <span class="wczt">已完成<i id="csc_<?php echo $task['taskid'];?>"><?php echo $task['csc'];?></i>%</span>
                    </div>
                    <div class="rw_b_45"><a href="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" class="<?php if($task['csc']>=100 && $task['checked']) { ?>lqjl<?php } else { ?>lqjl_no<?php } ?>"></a></div>
                    <?php if($task['csc'] >=100 && !$task['checked'] ) { ?>
                    <div style="text-align:center;"><font color="green">已完成</font>,<font color="red">等待审核</font></div>
                    <?php } ?>
                <?php } elseif($_G['gp_item'] == 'done') { ?>
                    <div class="jdtwarpten_dg"><span>完成于 <?php echo $task['dateline'];?></span></div>
                    <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                            <?php if($task['allowapply']) { ?>
                                <?php if($task['scriptname'] == 'tiezi') { ?>
                                    <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a>
                                <?php } else { ?>    
                                    <a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a>
                                <?php } ?>
                            <?php } else { ?>
                                <span><?php echo $task['t'];?> 后可以再次申请</span>
                            <?php } ?>
                    <?php } ?>
                    </div>
                <?php } elseif($_G['gp_item'] == 'failed') { ?>
                    <div class="jdtwarpten_sb"><span>失败于 <?php echo $task['dateline'];?><?php if($task['checked'] == -1) { ?> 审核未通过<?php } ?></span></div>
                    <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                            <?php if($task['allowapply']) { ?><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a><?php } else { ?><?php echo $task['t'];?>后可以重新申请<?php } ?>
                    <?php } ?>
                    </div>
                <?php } ?>
</li>
        <?php } else { ?>
            <?php if($_G['gp_item'] == 'new') { ?>
                <?php if(!$is_doing) { ?>
                <li>
                <span class="rwicon49_50"></span>
                <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="rwname"><?php echo $task['name'];?></a>
                <span class="lbrq">
                    <span>
                    <?php if($task['reward'] == 'credit') { ?>
                            <?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?>：<i class="orange"><?php echo $task['bonus'];?></i>
                    <?php } elseif($task['reward'] == 'magic') { ?>
                            道具 <?php echo $listdata[$task['prize']];?> <?php echo $task['bonus'];?> 张
                    <?php } elseif($task['reward'] == 'medal') { ?>
                            勋章 <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?>有效期 <?php echo $task['bonus'];?> 天 <?php } ?>
                    <?php } elseif($task['reward'] == 'invite') { ?>
                            邀请码 <?php echo $task['prize'];?> 有效期 <?php echo $task['bonus'];?> 天
                    <?php } elseif($task['reward'] == 'group') { ?>
                            用户组 <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> 天 <?php } ?>
                    <?php } ?>
                    </span>
                    <span>人气：<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>#parter"><?php echo $task['applicants'];?></a></span>
                </span>
                <?php } ?>
            <?php } else { ?>
                <li>
                <span class="rwicon49_50"></span>
                <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="rwname"><?php echo $task['name'];?></a>
                <span class="lbrq">
                    <span>
                    <?php if($task['reward'] == 'credit') { ?>
                            <?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?>：<i class="orange"><?php echo $task['bonus'];?></i>
                    <?php } elseif($task['reward'] == 'magic') { ?>
                            道具 <?php echo $listdata[$task['prize']];?> <?php echo $task['bonus'];?> 张
                    <?php } elseif($task['reward'] == 'medal') { ?>
                            勋章 <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?>有效期 <?php echo $task['bonus'];?> 天 <?php } ?>
                    <?php } elseif($task['reward'] == 'invite') { ?>
                            邀请码 <?php echo $task['prize'];?> 有效期 <?php echo $task['bonus'];?> 天
                    <?php } elseif($task['reward'] == 'group') { ?>
                            用户组 <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> 天 <?php } ?>
                    <?php } ?>
                    </span>
                    <span>人气：<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>#parter"><?php echo $task['applicants'];?></a></span>
                </span>
            <?php } ?>

            <?php if($_G['gp_item'] == 'new') { ?>
                <?php if($task['noperm']) { ?>
                <a href="javascript:;" onclick="doane(event);showDialog('你所在的用户组无法申请此任务')" class="ljsq_g" title="你所在的用户组无法申请此任务"></a>
                <?php } elseif($task['appliesfull']) { ?>
                <a href="javascript:;" onclick="doane(event);showDialog('人数已满')" class="ljsq_g" title="人数已满"></a>
                <?php } else { ?>

                <?php if(!$is_doing) { ?>
                    <?php if($task['scriptname'] == 'weixin') { ?>
                        <?php if(!$is_share) { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } else { ?>
                        <div class="mingtianzai"><span>今天已完成，请明天再申请</span></div>
                        <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>-->
                        <?php } ?>
                    <?php } elseif($task['scriptname'] == 'changxian') { ?>
                        <?php if(!$is_share_changxian) { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } else { ?>
                        <div class="mingtianzai"><span>今天已完成，请明天再申请</span></div>
                        <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>-->
                        <?php } ?>
                    <?php } elseif($task['scriptname'] == 'tiezi') { ?>
                        <?php if(!$is_share_tiezi) { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } else { ?>
                        <div class="mingtianzai"><span>今天已完成，请明天再申请</span></div>
                        <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">明天再赚</a></div>-->
                        <?php } ?>
                    <?php } else { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                    <?php } ?>
            <?php } ?>

        <?php } ?>
            <?php } elseif($_G['gp_item'] == 'doing') { ?>
                <div class="jdtwarpten">
                    <div class="gojdt" style="width:<?php echo $task['csc'];?>%;"></div>
                    <span class="wczt">已完成<i id="csc_<?php echo $task['taskid'];?>"><?php echo $task['csc'];?></i>%</span>
                </div>
                <div class="rw_b_45"><a href="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" class="<?php if($task['csc']>=100 && $task['checked']) { ?>lqjl<?php } else { ?>lqjl_no<?php } ?>"></a></div>
                <?php if($task['csc'] >=100 && !$task['checked'] ) { ?>
                <div style="text-align:center;"><font color="green">已完成</font>,<font color="red">等待审核</font></div>
                <?php } ?>
            <?php } elseif($_G['gp_item'] == 'done') { ?>
                <div class="jdtwarpten_dg"><span>完成于 <?php echo $task['dateline'];?></span></div>
                <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                    <?php if($task['allowapply']) { ?><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a><?php } else { ?><span><?php echo $task['t'];?> 后可以再次申请</span><?php } ?>
                    <?php } ?>
                </div>
            <?php } elseif($_G['gp_item'] == 'failed') { ?>
                <div class="jdtwarpten_sb"><span>失败于 <?php echo $task['dateline'];?><?php if($task['checked'] == -1) { ?> 审核未通过<?php } ?></span></div>
                <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                    <?php if($task['allowapply']) { ?><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a><?php } else { ?><?php echo $task['t'];?>后可以重新申请<?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
            </li>
        <?php } ?>

    <?php } ?>
    </ul>
</div>
<?php } else { ?>
<div class="rwsbwarpten clear_b">
<span class="rwsbicon66_80"></span>
<span class="rwsbwen"><?php if($_G['gp_item'] == 'new') { ?>暂无新任务，周期性任务完成后可以再次申请，敬请关注！<?php } elseif($_G['gp_item'] == 'doing') { ?>暂无进行中的任务，请到新任务中申请！<?php } else { ?>暂无数据<?php } ?></span>
</div>
<?php } } elseif($do == 'view') { ?><div class="clear_b">
<a class="y xs1 xw0 mtn" href="home.php?mod=task&amp;item=<?php if($task['status'] == '1') { ?>done<?php } elseif($task['status'] == '0') { ?>doing<?php } elseif($task['status'] == '-1') { ?>failed<?php } else { ?>new<?php } ?>">返回</a>
<h4 class="rwt_14">任务详情</h4>

<div class="h98_g clear_b">
    <div class="rwicon49"></div>
    <div class="rwp">
        <a href="javascript:;"><?php echo $task['name'];?></a>
        <?php if($task['period']) { ?>
            <span>
            <?php if($task['periodtype'] == 0) { ?>
                    ( 每隔 <?php echo $task['period'];?> 小时允许申请一次 )
            <?php } elseif($task['periodtype'] == 1) { ?>
                    ( 每 <?php echo $task['period'];?> 天允许申请一次 )
            <?php } elseif($task['periodtype'] == 2) { ?>
                    <?php $periodweek = $_G['lang']['core']['weeks'][$task[period]]; ?>                    ( 每周 <?php echo $periodweek;?> 允许申请一次 )
            <?php } elseif($task['periodtype'] == 3) { ?>
                    ( 每月 <?php echo $task['period'];?> 日允许申请一次 )
            <?php } ?>
            </span>
        <?php } ?>
        <span><?php echo $task['description'];?></span>
    </div>
    <div class="rwbz">
        <?php if($task['reward'] == 'credit') { ?>
            <span class="bz"><?php echo $task['bonus'];?></span>
            <span class="bzw"><?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?></span>
        <?php } elseif($task['reward'] == 'magic') { ?>
            道具 <?php echo $task['rewardtext'];?> <?php echo $task['bonus'];?> 张
        <?php } elseif($task['reward'] == 'medal') { ?>
            勋章 <?php echo $task['rewardtext'];?> <?php if($task['bonus']) { ?>有效期 <?php echo $task['bonus'];?> 天 <?php } ?>
        <?php } elseif($task['reward'] == 'invite') { ?>
            邀请码 <?php echo $task['prize'];?> 有效期 <?php echo $task['bonus'];?> 天
        <?php } elseif($task['reward'] == 'group') { ?>
            用户组 <?php echo $task['rewardtext'];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> 天 <?php } ?>
        <?php } else { ?>
            无
        <?php } ?>
    </div>
</div>
<style>
    .biao{
        color: #ff0000;
    }
    .biao_blue{
        color: cornflowerblue;
    }
</style>
<?php if($task['scriptname'] == 'weixin') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
                    <span class="sqtj">
    1、打开微信，点击底部的<em class="biao">“发现”</em>按钮，使用<em class="biao">“扫一扫”</em>功能
                    </span>
            <span class="sqtj">
    2、扫过二维码后，在朋友圈中输入您想说的话，点击<em class="biao">“发送”</em>
                    </span>
            <span class="sqtj ">
    3、发送成功后，回到电脑页面，点击<em class="biao">“领取奖励”</em>，即可获得8264币
                    </span>

    </div>
<?php } elseif($task['scriptname'] == 'appshare') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1、打开微信，点击底部的<em class="biao">“发现”</em>按钮，使用<em class="biao">“扫一扫”</em>功能
                    </span>
            <span class="sqtj">
    2、扫过二维码后，在朋友圈中输入您想说的话，点击<em class="biao">“发送”</em>
                    </span>
        <span class="sqtj">
    3、发送成功后，回到电脑页面，点击<em class="biao">“领取奖励”</em>，即可获得8264币
                    </span>
    </div>
<?php } elseif($task['scriptname'] == 'changxian') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1、打开微信，点击底部的<em class="biao">“发现”</em>按钮，使用<em class="biao">“扫一扫”</em>功能
                    </span>
            <span class="sqtj">
    2、扫过二维码后，在朋友圈中输入您想说的话，点击<em class="biao">“发送”</em>
                    </span>
        <span class="sqtj">
    3、发送成功后，回到电脑页面，点击<em class="biao">“领取奖励”</em>，即可获得驴币
                    </span>
    </div>
<?php } elseif($task['scriptname'] == 'tiezi') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1、打开微信，点击底部的<em class="biao">“发现”</em>按钮，使用<em class="biao">“扫一扫”</em>功能
                    </span>
            <span class="sqtj">
    2、扫过二维码后，在朋友圈中输入您想说的话，点击<em class="biao">“发送”</em>
                    </span>
        <span class="sqtj">
    3、发送成功后，回到电脑页面，点击<em class="biao">“领取奖励”</em>，即可获得驴币
                    </span>
    </div>
<?php } elseif($task['scriptname'] == 'appfollow') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1、打开微信，点击底部的<em class="biao">“发现”</em>按钮，使用<em class="biao">“扫一扫”</em>功能
                    </span>
            <span class="sqtj">
    2、扫过二维码后，点击“关注”，即可关注“在外APP”公众号<br/>
                    </span>
        <span class="sqtj">
    3、关注成功后，回到电脑页面，点击<em class="biao">“领取奖励”</em>，即可获得驴币

                    </span>
            <span class="sqtj" id="ghhao_img">
    <center><img src='<?php echo $qr_url;?>' width='180px' height='180px'/></center>
    </span>
    </div>
<?php } else { ?>
    <div class="rwtl">
        <?php if($task['viewmessage']) { ?>
            <span><?php echo $task['viewmessage'];?></span>
        <?php } else { ?>
            <span>完成此任务所需条件</span>
            <?php if($taskvars['complete']) { ?>
                <?php if(is_array($taskvars['complete'])) foreach($taskvars['complete'] as $taskvar) { ?>                <span><?php echo $taskvar['name'];?> : <?php echo $taskvar['value'];?></span>
                <?php } ?>
            <?php } else { ?>
                <span>不限</span>
            <?php } ?>
        <?php } ?>
        <?php if($task['endtime']) { ?><span class="gray_s">当前任务下线时间为 <?php echo $task['endtime'];?>，过期后你将不能申请此任务</span><?php } ?>
            <span class="sqtj">
                申请此任务所需条件：
                <?php if($task['applyperm'] || $task['relatedtaskid'] || $task['tasklimits'] || $taskvars['apply']) { ?>
                        <?php if($task['grouprequired']) { ?>用户组: <?php echo $task['grouprequired'];?> <?php } elseif($task['applyperm'] == 'member') { ?>普通会员<?php } elseif($task['applyperm'] == 'admin') { ?>管理人员<?php } ?>
                        <?php if($task['relatedtaskid']) { ?>必须完成指定任务: <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['relatedtaskid'];?>"><?php echo $_G['taskrequired'];?></a><?php } ?>
                        <?php if($task['tasklimits']) { ?>人次上限: <?php echo $task['tasklimits'];?><?php } ?>
                        <?php if($taskvars['apply']) { ?>
                                <?php if(is_array($taskvars['apply'])) foreach($taskvars['apply'] as $taskvar) { ?>                                        <?php echo $taskvar['name'];?>: <?php echo $taskvar['value'];?>
                                <?php } ?>
                        <?php } ?>
                <?php } else { ?>
                        不限
                <?php } ?>
            </span>
    </div>
<?php } if($allowapply == '-1') { ?>
    <div class="jdtwarpten mt17">
        <div class="gojdt" style="width:<?php echo $task['csc'];?>%;"></div>
        <span class="wczt">已完成 <i><?php echo $task['csc'];?></i>%</span>
    </div>
    <div class="mt17"><a href="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" class="<?php if($task['csc']>=100 && $task['checked']) { ?>lqjl<?php } else { ?>lqjl_no<?php } ?>" id="apply_qr" taskid="<?php echo $task['taskid'];?>"></a></div>
    <?php if($task['csc'] >=100 && !$task['checked'] ) { ?><div><font color="green">已完成</font>,<font color="red">等待审核</font></div><?php } } elseif($allowapply == '-2') { ?>
    <div class="rwts">你所在的用户组无法申请此任务</div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('你所在的用户组无法申请此任务')" class="ljsq_g" title="你所在的用户组无法申请此任务"></a></div>
<?php } elseif($allowapply == '-3') { ?>
    <div class="rwts">人数已满</div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('人数已满')" class="ljsq_g" title="人数已满"></a></div>
<?php } elseif($allowapply == '-4') { ?>
    <div class="rwts">失败于<?php echo $task['dateline'];?></div>
<?php } elseif($allowapply == '-5') { ?>

    <?php if($task['scriptname'] == 'weixin') { ?>
    <?php if($is_share == 1) { ?>
    <div class="wancheng">
        <span>今天已完成，请明天再申请</span>
    </div>
    <?php } ?>
    <?php } else { ?>
    <div class="rwts">完成于<?php echo $task['dateline'];?></div>
    <?php } } elseif($allowapply == '-6') { ?>
    <?php if($task['scriptname'] == 'appshare') { ?>
        <div class="rwts">
        完成于<?php echo $task['dateline'];?> &nbsp; <?php echo $task['t'];?> 后可以再次申请
        <?php if($task['checked'] == -1) { ?><b style='margin-left:5px;color:red'>审核未通过</b><br/><br/><?php } ?>
        </div>
        <div class="wancheng">
            <span>今天已完成，请明天再申请</span>
        </div>
    <?php } else { ?>
    <div class="rwts">
        完成于<?php echo $task['dateline'];?> &nbsp; <?php echo $task['t'];?> 后可以再次申请
        <?php if($task['checked'] == -1) { ?><b style='margin-left:5px;color:red'>审核未通过</b><br/><br/><?php } ?>
    </div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('<?php echo $task['t'];?> 后可以再次申请')" class="ljsq_g" title="立即申请"></a></div>
    <?php } } elseif($allowapply == '-7') { ?>
    <div class="rwts">
        失败于<?php echo $task['dateline'];?> &nbsp; <?php echo $task['t'];?>后可以重新申请
        <?php if($task['checked'] == -1) { ?><br/><b style='margin-left:5px;color:red'>审核未通过</b><?php } ?>
    </div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('<?php echo $task['t'];?>后可以重新申请')" class="ljsq_g" title="人数已满"></a>
<?php } elseif($allowapply == '2') { ?>
    <div class="rwts">完成于<?php echo $task['dateline'];?> &nbsp; 现在可以再次申请</div>
<?php } elseif($allowapply == '3') { ?>
    <div class="rwts">
        失败于<?php echo $task['dateline'];?> &nbsp; 现在可以重新申请
        <?php if($task['checked'] == -1) { ?><br/><b style='margin-left:5px;color:red'>审核未通过</b><?php } ?>
    </div>
<?php } ?>

    <?php if($allowapply > '0') { ?>
        <?php if($task['scriptname'] == 'weixin') { ?>
            <?php if($is_share == 1) { ?>
                <div class="wancheng">
                    <span>今天已完成，请明天再申请</span>
                </div>
            <?php } else { ?>
                    <?php if($_G['uid']) { ?>
                        <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="立即申请" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                        <div class="shop-qrcode" style="text-align: center">
                            <img src="http://image1.8264.com/forum/201506/09/105105pvl3k3i4l4lidpso.png" title="扫一扫，用手机浏览" id="qr" width="150" height="150" style="display:none">
                        </div>
                    <?php } else { ?>
                        <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="立即申请" ></a></div>
                    <?php } ?>
            <?php } ?>
        <?php } elseif($task['scriptname'] == 'appshare') { ?>


                <?php if($is_share_appshare == 1) { ?>
                        <div class="wancheng">
                            <span>今天已完成，请明天再申请</span>
                        </div>
                <?php } else { ?>
                        <?php if($_G['uid']) { ?>
                            <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="立即申请" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                            <div class="shop-qrcode" style="text-align: center">
                                <img src="http://image1.8264.com/forum/201506/09/105105pvl3k3i4l4lidpso.png" title="扫一扫，用手机浏览" id="qr" width="150" height="150" style="display:none">
                            </div>
                        <?php } else { ?>
                            <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="立即申请" ></a></div>
                        <?php } ?>
                <?php } ?>

        <?php } elseif($task['scriptname'] == 'changxian') { ?>


            <?php if($is_share_changxian == 1) { ?>
                    <div class="wancheng">
                        <span>今天已完成，请明天再申请</span>
                    </div>
            <?php } else { ?>
                <?php if($_G['uid']) { ?>
                    <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="立即申请" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                    <div class="shop-qrcode" style="text-align: center">
                        <img src="http://image1.8264.com/forum/201506/09/105105pvl3k3i4l4lidpso.png" title="扫一扫，用手机浏览" id="qr" width="150" height="150" style="display:none">
                    </div>
                <?php } else { ?>
                    <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="立即申请" ></a></div>
                <?php } ?>
            <?php } ?>
        <?php } elseif($task['scriptname'] == 'tiezi') { ?>


            <?php if($is_share_tiezi == 1) { ?>
                    <div class="wancheng">
                        <span>今天已完成，请明天再申请</span>
                    </div>
            <?php } else { ?>
                <?php if($_G['uid']) { ?>
                    <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="立即申请" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>&amp;zhuzhanuser=<?php echo $_G['uid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                    <div class="shop-qrcode" style="text-align: center;">
                        <img src="" title="扫一扫，用手机浏览" id="qr" width="150" height="150" style="display:none">
                    </div>
                <?php } else { ?>
                    <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="立即申请" ></a></div>
                <?php } ?>
            <?php } ?>

        <?php } elseif($task['scriptname'] == 'appfollow') { ?>
 <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="立即申请" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
<?php } else { ?>
            <div class="mt17"><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="ljsq" title="立即申请" ></a></div>
        <?php } ?>
    <?php } ?>
    <?php if($task['applicants']) { ?>
    <div class="rw_people">
        <div class="rw_p_t clear_b">
            <span class="tname">已有<i><?php echo $task['applicants'];?></i>位会员参与此任务</span>
            <span class="zk"></span>
        </div>
        <div class="people_list clear_b" id="ajaxparter"></div>
        <script type="text/javascript">ajaxget('home.php?mod=task&do=parter&id=<?php echo $task['taskid'];?>', 'ajaxparter');</script>
    </div>
    <?php } ?>

    <?php if(($task['scriptname'] == 'weixin') || ($task['scriptname'] == 'appshare') || ($task['scriptname'] == 'changxian') ) { ?>
    <script>
        jQuery.ajaxSetup ({
            // Disable caching of AJAX responses */
            cache: false
            //aysnc: false , // 默认同步加载

        });
        function checkqr(taskid){
            //alert(taskid);
            jQuery("#qr").show();
            set_server_time();
            return false;
        }
        
        jQuery(function(){
            var url = ('<?php echo $qr_url;?>');
            jQuery("#qr").attr('alt','二维码生成中……');
                jQuery.post("qrcode.php",{url:url},function(data){
                    jQuery("#qr").attr('src','http://image1.8264.com/forum/'+data);
                },'json');

        })
        if(<?php echo $_G['uid'];?>){
            jQuery("#qr").show();
            jQuery("#apply_qr").hide();
            set_server_time();
        }
        function set_server_time(){
            server_time = setInterval("getServer()",5000);
        }

        //轮询查询用户是否分享二维码
        //自定义轮询数据库方

        function getServer() {
            jQuery.get("home.php?mod=task", {is_qr_:1,taskid:jQuery("#apply_qr").attr('taskid')},function(data) {
                if(data > 0){
                    jQuery('#apply_qr').attr('class','lqjl');
                    jQuery('#apply_qr').attr('href',jQuery("#apply_qr").attr('myid'));
                    jQuery("#apply_qr").show();
                    jQuery("#qr").remove();
                    //二维码扫描后逻辑处理
                    jQuery.get("home.php?mod=task",{'do':'apply',id:jQuery("#apply_qr").attr('taskid'),is_qr:1},function(data){
                        clearInterval(server_time);
                    });
                }
            });
        }
    </script>
    <?php } ?>
    <?php if(($task['scriptname'] == 'tiezi')) { ?>
    <script>
        jQuery.ajaxSetup ({
            // Disable caching of AJAX responses */
            cache: false
            //aysnc: false , // 默认同步加载

        });
        function checkqr(taskid){
            //alert(taskid);
            jQuery("#qr").show();
            set_server_time();
            return false;
        }
        if(<?php echo $allowapply;?> !== -1){
            jQuery(function(){
            var url = ('<?php echo $qr_url;?>');
            jQuery("#qr").attr('alt','二维码生成中……');
                jQuery.post("qrcode.php",{url:url},function(data){
                    jQuery("#qr").attr('src','http://image1.8264.com/forum/'+data);
                },'json');

            });
            
            if(<?php echo $_G['uid'];?>){
                jQuery("#qr").show();
                jQuery("#apply_qr").hide();
                set_server_time();
            }
        }
        
        function set_server_time(){
            server_time = setInterval("getServer()",5000);
        }

        //轮询查询用户是否分享二维码
        //自定义轮询数据库方

        function getServer() {
            jQuery.get("home.php?mod=task", {is_tiezi:1,taskid:jQuery("#apply_qr").attr('taskid')},function(data) {
                if(data > 0){
                    jQuery('#apply_qr').attr('class','lqjl');
                    jQuery('#apply_qr').attr('href',jQuery("#apply_qr").attr('myid'));
                    jQuery("#apply_qr").show();
                    jQuery("#qr").remove();
                    //二维码扫描后逻辑处理
                    jQuery.get("home.php?mod=task",{'do':'apply',id:jQuery("#apply_qr").attr('taskid'),is_qr:1},function(data){
                        clearInterval(server_time);
                    });
                }
            });
        }
    </script>
    <?php } if(($task['scriptname'] == 'appfollow')) { ?>
<script>
if(<?php echo $_G['uid'];?>){
            jQuery("#apply_qr").hide();
<?php if($allowapply != -5) { ?>
            set_server_time_follow();
<?php } ?>
    <?php if($allowapply == -1||$allowapply == -5) { ?>
            jQuery("#ghhao_img").remove();
<?php } ?>
        }
   function set_server_time_follow(){
            server_time = setInterval("getServer_follow()",5000);
        }

function getServer_follow() {
            jQuery.get("home.php?mod=task", {is_qr_:'getIsfollow',taskid:jQuery("#apply_qr").attr('taskid')},function(data) {
                if(data > 0){
                    jQuery('#apply_qr').attr('class','lqjl');
                    jQuery('#apply_qr').attr('href',jQuery("#apply_qr").attr('myid'));
                    jQuery("#apply_qr").show();
jQuery("#ghhao_img").remove();
                    //二维码扫描后逻辑处理
                    jQuery.get("home.php?mod=task",{'do':'apply',id:jQuery("#apply_qr").attr('taskid'),is_qr:1},function(data){
                        clearInterval(server_time);
                    });
                }
            });
        }
</script>   
<?php } ?>
</div>
<?php } ?>
<div class="fheight"></div>
</div>
</div>
</div><script type="text/javascript">
var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
ie6=true;
}
if(ie6){
jQuery(".w980").css('height',jQuery(window).height()-130);
} else {
jQuery(".w980").css('min-height',jQuery(window).height()-130);
}

jQuery(".list760 li").hover(function(){
jQuery(this).addClass("z");
},function(){
jQuery(this).removeClass("z");
})
</script></div>
<!-- 友情链接 -->
<style>
.friendLink{ background: #0f1f2b; padding: 15px 0 18px 0px;}
.friendLink a { color: #807f7f; display: inline; margin-right: 10px; white-space: nowrap; font-size:12px;}
.friendLink a:hover { color: #fff; text-decoration:none;}
</style>
<div class="friendLink">
<div class="layout w980">
<?php if(!empty($_G['setting']['pluginhooks']['global_friendlylink'])) echo $_G['setting']['pluginhooks']['global_friendlylink']; ?>
</div>
</div>
<div class="bottomNav">
<div class="layout" style="position:relative;">
<div class="copyright">
<p><a href="http://www.miitbeian.gov.cn/" target="_blank">津ICP备05004140号-10</a> ICP证 津B2-20110106&nbsp;&nbsp;&nbsp;天津信一科技有限公司版权所有</p>
<p>户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank">户外保险</a></p>
</div>
<div class="someLink">
<a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">清除COOKIE</a>
|
<?php if($_G['group']['allowstatdata']) { ?>
<a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">站点统计</a> |
<?php } ?>
<a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">联系我们</a>
|
<a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264招聘</a>
|
<a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">帮助</a>
<span class="app">
<a href="http://bbs.8264.com/thread-2317569-1-1.html" target="_blank" class="appIco_95x27" rel="nofollow"></a>
</span>
</div>


        <?php if($_GET['mod'] =='index') { ?>
        <style>
.qdcionbottom{ position:absolute; left:509px; top:0px;}
.qdcionbottom img{ width:49px; height:44px;}
        </style>
        <a href='http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&ztLOID=8b4b03e47f0000012b8f0a26c9a87e67' class="qdcionbottom" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/guohui.png" /></a>
        <?php } ?>



</div>
</div>
<?php if($nobottomad !== false) { ?>
<!-- 页面底部弹出新闻表 -->
<script src="http://static.8264.com/static/js/jquery.cookie.js" type="text/javascript" type="text/javascript"></script>
<style>
  .newswarpten{ position:absolute; position:fixed!important; bottom:0px; display:none; left:50%;z-index: 999}
  .newstopone{ height:46px;  font-size:14px; background: url(http://static.8264.com/static/image/common/kxbg.png) 0px -1px no-repeat #fffff6; border:#e0d3be solid 1px;  float:left; border-right:0 none;}
  .newstopone .linktitle_4587{ float:left; margin:12px 0px 0px 70px; display:inline;}
  .newstopone .linktitle_4587 a{ font-size:16px; color:#064361; text-decoration:none;}
  .newstopone .linktitle_4587 a:hover{ font-size:16px; color:#ff7e00; text-decoration:none;}
  .newstopone .close16_16{ width:16px; height:16px; float:right; cursor:pointer; background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -47px -1px no-repeat; margin:16px 0px 0px 10px; display:inline;}
  .newstopone .close16_16:hover{background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -1px -1px no-repeat;}
  .newsarrow{ width:18px; height:48px; background:url(http://static.8264.com/static/image/common/kxbgarrow.png) left top no-repeat; float:right;}
</style>
<body>
<div class="newswarpten">
  <div class="newstopone">
    <div style="display: inline-block;padding-left: 70px;height: 46px;line-height: 46px;"><?php echo adshow("custom_294"); ?></div>
    <span class="close16_16"></span>
  </div>
  <div class="newsarrow"></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
  var tiao = jQuery(".newswarpten").width();
  jQuery(".newswarpten").css( 'margin-left' , -tiao/2 );
  var t_time = Date.parse(new Date());
  var cookietime = jQuery.cookie('showboxtime');
  if(!cookietime){
    jQuery(".newswarpten").show();
  };
  if(t_time >= cookietime){
     jQuery(".newswarpten").show();
  };
  jQuery('.close16_16,.linktitle_4587 a').click(function(){
    var t_time = Date.parse(new Date());
    jQuery.cookie('showboxtime',t_time+3600*24*1000,{expires:30,domain:'8264.com',path:'/'});
    jQuery(".newswarpten").hide();
  });
});
</script>
<!-- //页面底部弹出新闻表 -->
<?php } if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
    </div>
    <div class="mncr"></div>
    </div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; if(!$_G['setting']['bbclosed']) { ?> <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
    <script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="http://static.8264.com/static/js/space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F49299785f8cc72bacc96c9a5109227da' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- 链接自动推送 -->
<script type="text/javascript">
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!-- //链接自动推送 -->
<?php if(($_G['mod'] == 'viewthread' || $_GET['act'] == 'showview' || $_GET['act'] == 'commentdetail' || $_G['mod'] == 'view' || $_GET['ctl'] == 'topic')) { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if($_G['mod'] == 'view') { ?>
_gaq.push(['tid', '<?php echo $_GET['aid'];?>']);
_gaq.push(['type', '3']);
<?php } elseif($_GET['ctl'] == 'topic') { ?><?php $_G['tid'] = $topic['topicid'] ? $topic['topicid'] : 1; ?>_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
_gaq.push(['type', '6']);
<?php } else { ?>
_gaq.push(['fid', '<?php echo $_G['fid'];?>']);
_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
<?php } if($_G['mod'] == 'viewthread') { ?>
_gaq.push(['type', '1']);
<?php } elseif($_GET['act'] == 'showview') { ?>
_gaq.push(['type', '2']);
<?php } elseif($_GET['act'] == 'commentdetail') { ?>
_gaq.push(['pid', '<?php echo $pid;?>']);
_gaq.push(['type', '4']);
<?php } ?>

(function(d, t) {
var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
g.type = 'text/javascript'; g.async = true;
g.src = 'http://static.8264.com/static/js/ga.js?<?php echo VERHASH;?>';
s.parentNode.insertBefore(g, s);
})(document, 'script');
</script>
<?php } ?>
</body>
</html><?php output(); ?>