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
<div class="clear_b module user-setting-wrap"><!--ȥ������չʾ��δ��½�û��Ŀ���-->
<?php if(!empty($_G['uid'])) { ?>	<div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked navigate_notification">
<li <?php if($notify_type == 'notification') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=notification"><s class="menu-nav-icon icon-1">����</s><span showclass="li_tz">֪ͨ
</span><?php if(isset($space['notifications']) && $space['notifications']) { ?><em class="number"><?php echo $space['notifications'];?></em><?php } ?></a>
</li>
<li <?php if($notify_type == 'invitation') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=invitation"><s class="menu-nav-icon icon-2">����</s><span showclass="li_yq">����
</span><?php if(isset($space['newinvite']) && $space['newinvite']) { ?><em class="number"><?php echo $space['newinvite'];?></em><?php } ?></a>
</li>
<!--
<li <?php if($notify_type == 'greeting') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=greeting"><s class="menu-nav-icon icon-5">�к�</s><span showclass="li_dzh">�к�
</span><?php if(isset($space['pokes']) && $space['pokes']) { ?><em class="number"><?php echo $space['pokes'];?></em><?php } ?></a>
</li>
-->
<li <?php if($notify_type == 'smessage' || $_G['gp_ac'] == 'pm' || $_G['gp_do'] == 'pm') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=smessage"><s class="menu-nav-icon icon-7">����Ϣ</s><span showclass="li_dxx">����Ϣ
</span><?php if(isset($space['newpm']) && $space['newpm']) { ?><em class="number smessage_number"><?php echo $space['newpm'];?></em><?php } ?></a>
</li>

<li <?php if($_G['gp_mod'] == 'task') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=task&item=new"><s class="menu-nav-icon icon-8">����</s><span showclass="li_dxx">����
</span><?php if($taskcount) { ?><em class="number smessage_number"><?php echo $taskcount;?></em><?php } ?></a>
</li>
</ul>
        <div style="margin:10px 0px 0px 0px;"><?php echo adshow("custom_435"); ?></div>
</div>
    
<?php } ?>
<div <?php if(!empty($_G['uid'])) { ?>class="r_760"<?php } ?>>
<?php if(empty($do)) { ?><div class="top_q_d clear_b">
<a href="home.php?mod=task&amp;item=new"<?php if($actives['new']) { ?> class="zhong"<?php } ?>>������</a>
<a href="home.php?mod=task&amp;item=doing"<?php if($actives['doing']) { ?> class="zhong"<?php } ?>>�����е�����</a>
<a href="home.php?mod=task&amp;item=done"<?php if($actives['done']) { ?> class="zhong"<?php } ?>>����ɵ�����</a>
<a href="home.php?mod=task&amp;item=failed"<?php if($actives['failed']) { ?> class="zhong"<?php } ?>>ʧ�ܵ�����</a>
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
                            <?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?>��<i class="orange"><?php echo $task['bonus'];?></i>
                    <?php } elseif($task['reward'] == 'magic') { ?>
                            ���� <?php echo $listdata[$task['prize']];?> <?php echo $task['bonus'];?> ��
                    <?php } elseif($task['reward'] == 'medal') { ?>
                            ѫ�� <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?>��Ч�� <?php echo $task['bonus'];?> �� <?php } ?>
                    <?php } elseif($task['reward'] == 'invite') { ?>
                            ������ <?php echo $task['prize'];?> ��Ч�� <?php echo $task['bonus'];?> ��
                    <?php } elseif($task['reward'] == 'group') { ?>
                            �û��� <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> �� <?php } ?>
                    <?php } ?>
                    </span>
                    <span>������<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>#parter"><?php echo $task['applicants'];?></a></span>
                </span>
                <?php if($_G['gp_item'] == 'new') { ?>
                    <?php if($task['noperm']) { ?>
                            <a href="javascript:;" onclick="doane(event);showDialog('�����ڵ��û����޷����������')" class="ljsq_g" title="�����ڵ��û����޷����������"></a>
                    <?php } elseif($task['appliesfull']) { ?>
                            <a href="javascript:;" onclick="doane(event);showDialog('��������')" class="ljsq_g" title="��������"></a>
                    <?php } else { ?>
                        <?php if($task['scriptname'] == 'weixin') { ?>
                            <?php if(!$is_share) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                            <?php } else { ?>
                            <div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>
                            <?php } ?>
                        <?php } elseif($task['scriptname'] == 'changxian') { ?>
                            <?php if(!$is_share_changxian) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zaiwailink">��������</a></div>
                            <?php } else { ?>
                            <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>-->
                            <div class="mingtianzai"><span>��������ɣ�������������</span></div>
                            <?php } ?>
                        <?php } elseif($task['scriptname'] == 'tiezi') { ?>
                            <?php if(!$is_share_tiezi) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                            <?php } else { ?>
                            <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>-->
                            <div class="mingtianzai"><span>��������ɣ�������������</span></div>
                            <?php } ?>    
                        <?php } elseif($task['scriptname'] == 'appshare') { ?>
                            <?php if(!$is_share_appshare) { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zaiwailink">��������</a></div>
                            <?php } else { ?>
                            <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>-->
                            <div class="mingtianzai"><span>��������ɣ�������������</span></div>
                            <?php } ?>
                        <?php } elseif($task['scriptname'] == 'appfollow') { ?>
                            <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zaiwailink">��������</a></div>	
                        <?php } else { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } ?>
                    <?php } ?>
                <?php } elseif($_G['gp_item'] == 'doing') { ?>
                    <div class="jdtwarpten">
                            <div class="gojdt" style="width:<?php echo $task['csc'];?>%;"></div>
                            <span class="wczt">�����<i id="csc_<?php echo $task['taskid'];?>"><?php echo $task['csc'];?></i>%</span>
                    </div>
                    <div class="rw_b_45"><a href="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" class="<?php if($task['csc']>=100 && $task['checked']) { ?>lqjl<?php } else { ?>lqjl_no<?php } ?>"></a></div>
                    <?php if($task['csc'] >=100 && !$task['checked'] ) { ?>
                    <div style="text-align:center;"><font color="green">�����</font>,<font color="red">�ȴ����</font></div>
                    <?php } ?>
                <?php } elseif($_G['gp_item'] == 'done') { ?>
                    <div class="jdtwarpten_dg"><span>����� <?php echo $task['dateline'];?></span></div>
                    <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                            <?php if($task['allowapply']) { ?>
                                <?php if($task['scriptname'] == 'tiezi') { ?>
                                    <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a>
                                <?php } else { ?>    
                                    <a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a>
                                <?php } ?>
                            <?php } else { ?>
                                <span><?php echo $task['t'];?> ������ٴ�����</span>
                            <?php } ?>
                    <?php } ?>
                    </div>
                <?php } elseif($_G['gp_item'] == 'failed') { ?>
                    <div class="jdtwarpten_sb"><span>ʧ���� <?php echo $task['dateline'];?><?php if($task['checked'] == -1) { ?> ���δͨ��<?php } ?></span></div>
                    <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                            <?php if($task['allowapply']) { ?><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a><?php } else { ?><?php echo $task['t'];?>�������������<?php } ?>
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
                            <?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?>��<i class="orange"><?php echo $task['bonus'];?></i>
                    <?php } elseif($task['reward'] == 'magic') { ?>
                            ���� <?php echo $listdata[$task['prize']];?> <?php echo $task['bonus'];?> ��
                    <?php } elseif($task['reward'] == 'medal') { ?>
                            ѫ�� <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?>��Ч�� <?php echo $task['bonus'];?> �� <?php } ?>
                    <?php } elseif($task['reward'] == 'invite') { ?>
                            ������ <?php echo $task['prize'];?> ��Ч�� <?php echo $task['bonus'];?> ��
                    <?php } elseif($task['reward'] == 'group') { ?>
                            �û��� <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> �� <?php } ?>
                    <?php } ?>
                    </span>
                    <span>������<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>#parter"><?php echo $task['applicants'];?></a></span>
                </span>
                <?php } ?>
            <?php } else { ?>
                <li>
                <span class="rwicon49_50"></span>
                <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="rwname"><?php echo $task['name'];?></a>
                <span class="lbrq">
                    <span>
                    <?php if($task['reward'] == 'credit') { ?>
                            <?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?>��<i class="orange"><?php echo $task['bonus'];?></i>
                    <?php } elseif($task['reward'] == 'magic') { ?>
                            ���� <?php echo $listdata[$task['prize']];?> <?php echo $task['bonus'];?> ��
                    <?php } elseif($task['reward'] == 'medal') { ?>
                            ѫ�� <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?>��Ч�� <?php echo $task['bonus'];?> �� <?php } ?>
                    <?php } elseif($task['reward'] == 'invite') { ?>
                            ������ <?php echo $task['prize'];?> ��Ч�� <?php echo $task['bonus'];?> ��
                    <?php } elseif($task['reward'] == 'group') { ?>
                            �û��� <?php echo $listdata[$task['prize']];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> �� <?php } ?>
                    <?php } ?>
                    </span>
                    <span>������<a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>#parter"><?php echo $task['applicants'];?></a></span>
                </span>
            <?php } ?>

            <?php if($_G['gp_item'] == 'new') { ?>
                <?php if($task['noperm']) { ?>
                <a href="javascript:;" onclick="doane(event);showDialog('�����ڵ��û����޷����������')" class="ljsq_g" title="�����ڵ��û����޷����������"></a>
                <?php } elseif($task['appliesfull']) { ?>
                <a href="javascript:;" onclick="doane(event);showDialog('��������')" class="ljsq_g" title="��������"></a>
                <?php } else { ?>

                <?php if(!$is_doing) { ?>
                    <?php if($task['scriptname'] == 'weixin') { ?>
                        <?php if(!$is_share) { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } else { ?>
                        <div class="mingtianzai"><span>��������ɣ�������������</span></div>
                        <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>-->
                        <?php } ?>
                    <?php } elseif($task['scriptname'] == 'changxian') { ?>
                        <?php if(!$is_share_changxian) { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } else { ?>
                        <div class="mingtianzai"><span>��������ɣ�������������</span></div>
                        <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>-->
                        <?php } ?>
                    <?php } elseif($task['scriptname'] == 'tiezi') { ?>
                        <?php if(!$is_share_tiezi) { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                        <?php } else { ?>
                        <div class="mingtianzai"><span>��������ɣ�������������</span></div>
                        <!--<div class="rw_b_45 mt10"><a href="javascript:void(0);" class="sqjlzh">������׬</a></div>-->
                        <?php } ?>
                    <?php } else { ?>
                        <div class="rw_b_45 mt10"><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="ljsq"></a></div>
                    <?php } ?>
            <?php } ?>

        <?php } ?>
            <?php } elseif($_G['gp_item'] == 'doing') { ?>
                <div class="jdtwarpten">
                    <div class="gojdt" style="width:<?php echo $task['csc'];?>%;"></div>
                    <span class="wczt">�����<i id="csc_<?php echo $task['taskid'];?>"><?php echo $task['csc'];?></i>%</span>
                </div>
                <div class="rw_b_45"><a href="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" class="<?php if($task['csc']>=100 && $task['checked']) { ?>lqjl<?php } else { ?>lqjl_no<?php } ?>"></a></div>
                <?php if($task['csc'] >=100 && !$task['checked'] ) { ?>
                <div style="text-align:center;"><font color="green">�����</font>,<font color="red">�ȴ����</font></div>
                <?php } ?>
            <?php } elseif($_G['gp_item'] == 'done') { ?>
                <div class="jdtwarpten_dg"><span>����� <?php echo $task['dateline'];?></span></div>
                <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                    <?php if($task['allowapply']) { ?><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a><?php } else { ?><span><?php echo $task['t'];?> ������ٴ�����</span><?php } ?>
                    <?php } ?>
                </div>
            <?php } elseif($_G['gp_item'] == 'failed') { ?>
                <div class="jdtwarpten_sb"><span>ʧ���� <?php echo $task['dateline'];?><?php if($task['checked'] == -1) { ?> ���δͨ��<?php } ?></span></div>
                <div class="rw_b_45">
                    <?php if($task['period'] && $task['t']) { ?>
                    <?php if($task['allowapply']) { ?><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="zcsq"></a><?php } else { ?><?php echo $task['t'];?>�������������<?php } ?>
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
<span class="rwsbwen"><?php if($_G['gp_item'] == 'new') { ?>����������������������ɺ�����ٴ����룬�����ע��<?php } elseif($_G['gp_item'] == 'doing') { ?>���޽����е������뵽�����������룡<?php } else { ?>��������<?php } ?></span>
</div>
<?php } } elseif($do == 'view') { ?><div class="clear_b">
<a class="y xs1 xw0 mtn" href="home.php?mod=task&amp;item=<?php if($task['status'] == '1') { ?>done<?php } elseif($task['status'] == '0') { ?>doing<?php } elseif($task['status'] == '-1') { ?>failed<?php } else { ?>new<?php } ?>">����</a>
<h4 class="rwt_14">��������</h4>

<div class="h98_g clear_b">
    <div class="rwicon49"></div>
    <div class="rwp">
        <a href="javascript:;"><?php echo $task['name'];?></a>
        <?php if($task['period']) { ?>
            <span>
            <?php if($task['periodtype'] == 0) { ?>
                    ( ÿ�� <?php echo $task['period'];?> Сʱ��������һ�� )
            <?php } elseif($task['periodtype'] == 1) { ?>
                    ( ÿ <?php echo $task['period'];?> ����������һ�� )
            <?php } elseif($task['periodtype'] == 2) { ?>
                    <?php $periodweek = $_G['lang']['core']['weeks'][$task[period]]; ?>                    ( ÿ�� <?php echo $periodweek;?> ��������һ�� )
            <?php } elseif($task['periodtype'] == 3) { ?>
                    ( ÿ�� <?php echo $task['period'];?> ����������һ�� )
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
            ���� <?php echo $task['rewardtext'];?> <?php echo $task['bonus'];?> ��
        <?php } elseif($task['reward'] == 'medal') { ?>
            ѫ�� <?php echo $task['rewardtext'];?> <?php if($task['bonus']) { ?>��Ч�� <?php echo $task['bonus'];?> �� <?php } ?>
        <?php } elseif($task['reward'] == 'invite') { ?>
            ������ <?php echo $task['prize'];?> ��Ч�� <?php echo $task['bonus'];?> ��
        <?php } elseif($task['reward'] == 'group') { ?>
            �û��� <?php echo $task['rewardtext'];?> <?php if($task['bonus']) { ?> <?php echo $task['bonus'];?> �� <?php } ?>
        <?php } else { ?>
            ��
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
    1����΢�ţ�����ײ���<em class="biao">�����֡�</em>��ť��ʹ��<em class="biao">��ɨһɨ��</em>����
                    </span>
            <span class="sqtj">
    2��ɨ����ά���������Ȧ����������˵�Ļ������<em class="biao">�����͡�</em>
                    </span>
            <span class="sqtj ">
    3�����ͳɹ��󣬻ص�����ҳ�棬���<em class="biao">����ȡ������</em>�����ɻ��8264��
                    </span>

    </div>
<?php } elseif($task['scriptname'] == 'appshare') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1����΢�ţ�����ײ���<em class="biao">�����֡�</em>��ť��ʹ��<em class="biao">��ɨһɨ��</em>����
                    </span>
            <span class="sqtj">
    2��ɨ����ά���������Ȧ����������˵�Ļ������<em class="biao">�����͡�</em>
                    </span>
        <span class="sqtj">
    3�����ͳɹ��󣬻ص�����ҳ�棬���<em class="biao">����ȡ������</em>�����ɻ��8264��
                    </span>
    </div>
<?php } elseif($task['scriptname'] == 'changxian') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1����΢�ţ�����ײ���<em class="biao">�����֡�</em>��ť��ʹ��<em class="biao">��ɨһɨ��</em>����
                    </span>
            <span class="sqtj">
    2��ɨ����ά���������Ȧ����������˵�Ļ������<em class="biao">�����͡�</em>
                    </span>
        <span class="sqtj">
    3�����ͳɹ��󣬻ص�����ҳ�棬���<em class="biao">����ȡ������</em>�����ɻ��¿��
                    </span>
    </div>
<?php } elseif($task['scriptname'] == 'tiezi') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1����΢�ţ�����ײ���<em class="biao">�����֡�</em>��ť��ʹ��<em class="biao">��ɨһɨ��</em>����
                    </span>
            <span class="sqtj">
    2��ɨ����ά���������Ȧ����������˵�Ļ������<em class="biao">�����͡�</em>
                    </span>
        <span class="sqtj">
    3�����ͳɹ��󣬻ص�����ҳ�棬���<em class="biao">����ȡ������</em>�����ɻ��¿��
                    </span>
    </div>
<?php } elseif($task['scriptname'] == 'appfollow') { ?>
    <div class="rwtl" style="text-align: left;padding-left: 10px;">
        <span style="text-align: center;font-weight: bold"><?php echo $taskvars['complete']['descript']['value'];?></span>
        <span class="sqtj">
    1����΢�ţ�����ײ���<em class="biao">�����֡�</em>��ť��ʹ��<em class="biao">��ɨһɨ��</em>����
                    </span>
            <span class="sqtj">
    2��ɨ����ά��󣬵������ע�������ɹ�ע������APP�����ں�<br/>
                    </span>
        <span class="sqtj">
    3����ע�ɹ��󣬻ص�����ҳ�棬���<em class="biao">����ȡ������</em>�����ɻ��¿��

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
            <span>��ɴ�������������</span>
            <?php if($taskvars['complete']) { ?>
                <?php if(is_array($taskvars['complete'])) foreach($taskvars['complete'] as $taskvar) { ?>                <span><?php echo $taskvar['name'];?> : <?php echo $taskvar['value'];?></span>
                <?php } ?>
            <?php } else { ?>
                <span>����</span>
            <?php } ?>
        <?php } ?>
        <?php if($task['endtime']) { ?><span class="gray_s">��ǰ��������ʱ��Ϊ <?php echo $task['endtime'];?>�����ں��㽫�������������</span><?php } ?>
            <span class="sqtj">
                �������������������
                <?php if($task['applyperm'] || $task['relatedtaskid'] || $task['tasklimits'] || $taskvars['apply']) { ?>
                        <?php if($task['grouprequired']) { ?>�û���: <?php echo $task['grouprequired'];?> <?php } elseif($task['applyperm'] == 'member') { ?>��ͨ��Ա<?php } elseif($task['applyperm'] == 'admin') { ?>������Ա<?php } ?>
                        <?php if($task['relatedtaskid']) { ?>�������ָ������: <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['relatedtaskid'];?>"><?php echo $_G['taskrequired'];?></a><?php } ?>
                        <?php if($task['tasklimits']) { ?>�˴�����: <?php echo $task['tasklimits'];?><?php } ?>
                        <?php if($taskvars['apply']) { ?>
                                <?php if(is_array($taskvars['apply'])) foreach($taskvars['apply'] as $taskvar) { ?>                                        <?php echo $taskvar['name'];?>: <?php echo $taskvar['value'];?>
                                <?php } ?>
                        <?php } ?>
                <?php } else { ?>
                        ����
                <?php } ?>
            </span>
    </div>
<?php } if($allowapply == '-1') { ?>
    <div class="jdtwarpten mt17">
        <div class="gojdt" style="width:<?php echo $task['csc'];?>%;"></div>
        <span class="wczt">����� <i><?php echo $task['csc'];?></i>%</span>
    </div>
    <div class="mt17"><a href="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" class="<?php if($task['csc']>=100 && $task['checked']) { ?>lqjl<?php } else { ?>lqjl_no<?php } ?>" id="apply_qr" taskid="<?php echo $task['taskid'];?>"></a></div>
    <?php if($task['csc'] >=100 && !$task['checked'] ) { ?><div><font color="green">�����</font>,<font color="red">�ȴ����</font></div><?php } } elseif($allowapply == '-2') { ?>
    <div class="rwts">�����ڵ��û����޷����������</div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('�����ڵ��û����޷����������')" class="ljsq_g" title="�����ڵ��û����޷����������"></a></div>
<?php } elseif($allowapply == '-3') { ?>
    <div class="rwts">��������</div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('��������')" class="ljsq_g" title="��������"></a></div>
<?php } elseif($allowapply == '-4') { ?>
    <div class="rwts">ʧ����<?php echo $task['dateline'];?></div>
<?php } elseif($allowapply == '-5') { ?>

    <?php if($task['scriptname'] == 'weixin') { ?>
    <?php if($is_share == 1) { ?>
    <div class="wancheng">
        <span>��������ɣ�������������</span>
    </div>
    <?php } ?>
    <?php } else { ?>
    <div class="rwts">�����<?php echo $task['dateline'];?></div>
    <?php } } elseif($allowapply == '-6') { ?>
    <?php if($task['scriptname'] == 'appshare') { ?>
        <div class="rwts">
        �����<?php echo $task['dateline'];?> &nbsp; <?php echo $task['t'];?> ������ٴ�����
        <?php if($task['checked'] == -1) { ?><b style='margin-left:5px;color:red'>���δͨ��</b><br/><br/><?php } ?>
        </div>
        <div class="wancheng">
            <span>��������ɣ�������������</span>
        </div>
    <?php } else { ?>
    <div class="rwts">
        �����<?php echo $task['dateline'];?> &nbsp; <?php echo $task['t'];?> ������ٴ�����
        <?php if($task['checked'] == -1) { ?><b style='margin-left:5px;color:red'>���δͨ��</b><br/><br/><?php } ?>
    </div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('<?php echo $task['t'];?> ������ٴ�����')" class="ljsq_g" title="��������"></a></div>
    <?php } } elseif($allowapply == '-7') { ?>
    <div class="rwts">
        ʧ����<?php echo $task['dateline'];?> &nbsp; <?php echo $task['t'];?>�������������
        <?php if($task['checked'] == -1) { ?><br/><b style='margin-left:5px;color:red'>���δͨ��</b><?php } ?>
    </div>
    <div class="mt17"><a href="javascript:;" onclick="doane(event);showDialog('<?php echo $task['t'];?>�������������')" class="ljsq_g" title="��������"></a>
<?php } elseif($allowapply == '2') { ?>
    <div class="rwts">�����<?php echo $task['dateline'];?> &nbsp; ���ڿ����ٴ�����</div>
<?php } elseif($allowapply == '3') { ?>
    <div class="rwts">
        ʧ����<?php echo $task['dateline'];?> &nbsp; ���ڿ�����������
        <?php if($task['checked'] == -1) { ?><br/><b style='margin-left:5px;color:red'>���δͨ��</b><?php } ?>
    </div>
<?php } ?>

    <?php if($allowapply > '0') { ?>
        <?php if($task['scriptname'] == 'weixin') { ?>
            <?php if($is_share == 1) { ?>
                <div class="wancheng">
                    <span>��������ɣ�������������</span>
                </div>
            <?php } else { ?>
                    <?php if($_G['uid']) { ?>
                        <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="��������" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                        <div class="shop-qrcode" style="text-align: center">
                            <img src="http://image1.8264.com/forum/201506/09/105105pvl3k3i4l4lidpso.png" title="ɨһɨ�����ֻ����" id="qr" width="150" height="150" style="display:none">
                        </div>
                    <?php } else { ?>
                        <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="��������" ></a></div>
                    <?php } ?>
            <?php } ?>
        <?php } elseif($task['scriptname'] == 'appshare') { ?>


                <?php if($is_share_appshare == 1) { ?>
                        <div class="wancheng">
                            <span>��������ɣ�������������</span>
                        </div>
                <?php } else { ?>
                        <?php if($_G['uid']) { ?>
                            <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="��������" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                            <div class="shop-qrcode" style="text-align: center">
                                <img src="http://image1.8264.com/forum/201506/09/105105pvl3k3i4l4lidpso.png" title="ɨһɨ�����ֻ����" id="qr" width="150" height="150" style="display:none">
                            </div>
                        <?php } else { ?>
                            <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="��������" ></a></div>
                        <?php } ?>
                <?php } ?>

        <?php } elseif($task['scriptname'] == 'changxian') { ?>


            <?php if($is_share_changxian == 1) { ?>
                    <div class="wancheng">
                        <span>��������ɣ�������������</span>
                    </div>
            <?php } else { ?>
                <?php if($_G['uid']) { ?>
                    <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="��������" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                    <div class="shop-qrcode" style="text-align: center">
                        <img src="http://image1.8264.com/forum/201506/09/105105pvl3k3i4l4lidpso.png" title="ɨһɨ�����ֻ����" id="qr" width="150" height="150" style="display:none">
                    </div>
                <?php } else { ?>
                    <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="��������" ></a></div>
                <?php } ?>
            <?php } ?>
        <?php } elseif($task['scriptname'] == 'tiezi') { ?>


            <?php if($is_share_tiezi == 1) { ?>
                    <div class="wancheng">
                        <span>��������ɣ�������������</span>
                    </div>
            <?php } else { ?>
                <?php if($_G['uid']) { ?>
                    <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="��������" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>&amp;zhuzhanuser=<?php echo $_G['uid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
                    <div class="shop-qrcode" style="text-align: center;">
                        <img src="" title="ɨһɨ�����ֻ����" id="qr" width="150" height="150" style="display:none">
                    </div>
                <?php } else { ?>
                    <div class="mt17"><a href="member.php?mod=logging&amp;action=login" class="ljsq" title="��������" ></a></div>
                <?php } ?>
            <?php } ?>

        <?php } elseif($task['scriptname'] == 'appfollow') { ?>
 <div class="mt17"><a href="javascript:void(0);" class="ljsq" title="��������" onclick="checkqr(<?php echo $task['taskid'];?>);" id="apply_qr" myid="home.php?mod=task&amp;do=draw&amp;id=<?php echo $task['taskid'];?>" taskid="<?php echo $task['taskid'];?>"></a></div>
<?php } else { ?>
            <div class="mt17"><a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>" class="ljsq" title="��������" ></a></div>
        <?php } ?>
    <?php } ?>
    <?php if($task['applicants']) { ?>
    <div class="rw_people">
        <div class="rw_p_t clear_b">
            <span class="tname">����<i><?php echo $task['applicants'];?></i>λ��Ա���������</span>
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
            //aysnc: false , // Ĭ��ͬ������

        });
        function checkqr(taskid){
            //alert(taskid);
            jQuery("#qr").show();
            set_server_time();
            return false;
        }
        
        jQuery(function(){
            var url = ('<?php echo $qr_url;?>');
            jQuery("#qr").attr('alt','��ά�������С���');
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

        //��ѯ��ѯ�û��Ƿ�����ά��
        //�Զ�����ѯ���ݿⷽ

        function getServer() {
            jQuery.get("home.php?mod=task", {is_qr_:1,taskid:jQuery("#apply_qr").attr('taskid')},function(data) {
                if(data > 0){
                    jQuery('#apply_qr').attr('class','lqjl');
                    jQuery('#apply_qr').attr('href',jQuery("#apply_qr").attr('myid'));
                    jQuery("#apply_qr").show();
                    jQuery("#qr").remove();
                    //��ά��ɨ����߼�����
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
            //aysnc: false , // Ĭ��ͬ������

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
            jQuery("#qr").attr('alt','��ά�������С���');
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

        //��ѯ��ѯ�û��Ƿ�����ά��
        //�Զ�����ѯ���ݿⷽ

        function getServer() {
            jQuery.get("home.php?mod=task", {is_tiezi:1,taskid:jQuery("#apply_qr").attr('taskid')},function(data) {
                if(data > 0){
                    jQuery('#apply_qr').attr('class','lqjl');
                    jQuery('#apply_qr').attr('href',jQuery("#apply_qr").attr('myid'));
                    jQuery("#apply_qr").show();
                    jQuery("#qr").remove();
                    //��ά��ɨ����߼�����
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
                    //��ά��ɨ����߼�����
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
<!-- �������� -->
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
<p><a href="http://www.miitbeian.gov.cn/" target="_blank">��ICP��05004140��-10</a> ICP֤ ��B2-20110106&nbsp;&nbsp;&nbsp;�����һ�Ƽ����޹�˾��Ȩ����</p>
<p>�����з��գ�8264����������<a href="http://bx.8264.com/?8264com" target="_blank">���Ᵽ��</a></p>
</div>
<div class="someLink">
<a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">���COOKIE</a>
|
<?php if($_G['group']['allowstatdata']) { ?>
<a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">վ��ͳ��</a> |
<?php } ?>
<a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">��ϵ����</a>
|
<a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264��Ƹ</a>
|
<a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">����</a>
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
<!-- ҳ��ײ��������ű� -->
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
<!-- //ҳ��ײ��������ű� -->
<?php } if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        ���� <?php echo $_G['member']['credits'];?>, ������һ������ <?php echo $upgradecredit;?> ����
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
<!-- �����Զ����� -->
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
<!-- //�����Զ����� -->
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