<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_notice_new_header', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/space_notice_new_header.htm', './template/8264/home/space_left_2014.htm', 1509518163, '2', './data/template/2_2_home_space_notice_new_header.tpl.php', './template/8264', 'home/space_notice_new_header')
;?>
<?php $_G['home_tpl_titles'] = array('����'); include template('common/header_8264_new'); ?><link rel="stylesheet" href="http://static.8264.com/static/css/common/common_head_bottom.css?<?php echo VERHASH;?>">
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/bootstrap.min.css?<?php echo VERHASH;?>">
<div class="container main-container" style="position:relative">
<?php if($tasklist) { ?>
<div class="title52">
<span>��������</span>
<a href="home.php?mod=task&amp;item=new">ǰ����������>></a>
</div>
<div class="taskall clearfix">
<ul><?php if(is_array($tasklist)) foreach($tasklist as $task) { ?>        <?php if($task['scriptname'] != 'weixin') { ?>
            <?php if($task['scriptname']=='appshare' ) { ?>
            <li>
                <span class="tasktitlename"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" target="_blank"><?php echo $task['name'];?></a></span>
                <p>
                    <span>
                        <?php if($task['reward'] == 'credit') { ?>
                        <b><?php echo $task['bonus'];?></b><i> ö </i><em><?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?></em>
                        <?php } elseif($task['reward'] == 'magic') { ?>
                        <b><?php echo $task['bonus'];?></b><i>��</i><em>���� <?php echo $listdata[$task['prize']];?></em>
                        <?php } ?>
                    </span>
                    <?php if($task['noperm']) { ?>
                        <a href="javascript:;" onclick="doane(event);showDialog('�����ڵ��û����޷����������')" title="�����ڵ��û����޷����������"></a>
                    <?php } elseif($task['appliesfull']) { ?>
                        <a href="javascript:;" onclick="doane(event);showDialog('��������')" title="��������"></a>
                    <?php } else { ?>
                        <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>">��������</a>
                    <?php } ?>
                </p>
            </li>

            <?php } elseif($task['scriptname']!='changxian') { ?>
            <li>
                <span class="tasktitlename"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" target="_blank"><?php echo $task['name'];?></a></span>
                <p>
                    <span>
                        <?php if($task['reward'] == 'credit') { ?>
                        <b><?php echo $task['bonus'];?></b><i> ö </i><em><?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?></em>
                        <?php } elseif($task['reward'] == 'magic') { ?>
                        <b><?php echo $task['bonus'];?></b><i>��</i><em>���� <?php echo $listdata[$task['prize']];?></em>
                        <?php } ?>
                    </span>
                    <?php if($task['noperm']) { ?>
                    <a href="javascript:;" onclick="doane(event);showDialog('�����ڵ��û����޷����������')" title="�����ڵ��û����޷����������"></a>
                    <?php } elseif($task['appliesfull']) { ?>
                    <a href="javascript:;" onclick="doane(event);showDialog('��������')" title="��������"></a>
                    <?php } else { ?>
                    <?php if($task['scriptname']=='weixin') { ?>
                    <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>">��������</a>
                    <?php } else { ?>
                    <a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>">��������</a>
                    <?php } ?>
                    <?php } ?>
                </p>
            </li>
        <?php } ?>
        <?php } else { ?>
        <li>
            <span class="tasktitlename"><a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>" target="_blank"><?php echo $task['name'];?></a></span>
            <p>
<span>
<?php if($task['reward'] == 'credit') { ?>
<b><?php echo $task['bonus'];?></b><i> ö </i><em><?php echo $_G['setting']['extcredits'][$task['prize']]['title'];?></em>
<?php } elseif($task['reward'] == 'magic') { ?>
<b><?php echo $task['bonus'];?></b><i>��</i><em>���� <?php echo $listdata[$task['prize']];?></em>
<?php } ?>
</span>
                <?php if($task['noperm']) { ?>
                <a href="javascript:;" onclick="doane(event);showDialog('�����ڵ��û����޷����������')" title="�����ڵ��û����޷����������"></a>
                <?php } elseif($task['appliesfull']) { ?>
                <a href="javascript:;" onclick="doane(event);showDialog('��������')" title="��������"></a>
                <?php } else { ?>
                <?php if($task['scriptname']=='weixin') { ?>
                <a href="home.php?mod=task&amp;do=view&amp;id=<?php echo $task['taskid'];?>">��������</a>
                <?php } else { ?>
                <a href="home.php?mod=task&amp;do=apply&amp;id=<?php echo $task['taskid'];?>">��������</a>
                <?php } ?>
                <?php } ?>
            </p>
        </li>
        <?php } } ?>
</ul>
</div>
<?php } ?>
<!-- ����ѧУ��� -->
<style>
.hotmudidibox{border:#e0e7eb solid 1px; border-bottom:0px; border-right:0px; margin-top:15px; width:980px;background-color:#FFF;}
.hotmudidibox li{ width:139px; border-bottom:#e0e7eb solid 1px; border-right:#e0e7eb solid 1px; height:70px; float:left;}
.hotmudidibox li a{ display:block; height:72px; width:133px; text-align:center; overflow:hidden;}
.hotmudidibox li a:hover{text-decoration:none;}
.hotmudidibox li:hover,.hotmudidibox li.hover{ background:#508eff;}
.hotmudidibox li:hover span,.hotmudidibox li.hover span{ color:#fff;}
.hotmudidibox li:hover em,.hotmudidibox li.hover em{ color:#fff;}
.hotmudidibox li span{ font-size:16px; color:#31424e; display: block; width:100%; padding:13px 0px 0px 0px;}
.hotmudidibox li em{ font-size:12px; color:#93a4b0; display:block; width:100%;}
.hotmudidibox li i{ font-size:16px; color:#31424e; display: block; width:100%; line-height:70px; height:72px; font-style:normal;}
.hotmudidibox li:hover i,.hotmudidibox li.hover i{ color:#fff;}
</style>
<div class="hotmudidibox clearfix">
    <ul>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-2.html" target="_blank">
                <span>��ȫ���ȿ���</span>
                <em>268��</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-1.html" target="_blank">
                <span>�����������</span>
                <em>187��</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-18.html" target="_blank">
                <span>Ұ�����濼��</span>
                <em>91��</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-15.html" target="_blank">
                <span>ͽ��֪ʶ����</span>
                <em>77��</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-5.html" target="_blank">
                <span>��ɽ֪ʶ����</span>
                <em>49��</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-3.html" target="_blank">
                <span>����֪ʶ����</span>
                <em>43��</em>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/catinfo-8.html" target="_blank">
                <span>�ܲ�֪ʶ����</span>
                <em>71��</em>
            </a>
        </li>
    </ul>
</div>
<!-- //����ѧУ��� -->
<div class="module user-setting-wrap">	<div class="mt-menu-tree">
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
    
<div class="setting-form">
<div class="main-wrap" id="main_message">
