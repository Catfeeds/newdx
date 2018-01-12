<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: lang_notification.php 19443 2010-12-31 06:27:06Z zhengqingpeng $
 */

$lang = array
(

	'type_wall' => '����',
	'type_piccomment' => 'ͼƬ����',
	'type_blogcomment' => '��־����',
	'type_clickblog' => '��־��̬',
	'type_clickarticle' => '���±�̬',
	'type_clickpic' => 'ͼƬ��̬',
	'type_sharecomment' => '��������',
	'type_doing' => '��¼',
	'type_friend' => '����',
	'type_credit' => '����',
	'type_bbs' => '��̳',
	'type_system' => 'ϵͳ',
	'type_thread' => '����',
	'type_task' => '����',
	'type_group' => 'Ⱥ��',

	'mail_to_user' => '���µ�֪ͨ',
	'showcredit' => '{actor} ���͸��� {credit} �����ۻ��֣����������� <a href="misc.php?mod=ranklist&type=member" target="_blank">�������а�</a> �е�����',
	'share_space' => '{actor} ��������Ŀռ�',
	'share_blog' => '{actor} �����������־ <a href="{url}" target="_blank">{subject}</a>',
	'share_album' => '{actor} ������������ <a href="{url}" target="_blank">{albumname}</a>',
	'share_pic' => '{actor} ������������ {albumname} �е� <a href="{url}" target="_blank"> ͼƬ</a>',
	'share_thread' => '{actor} ������������� <a href="{url}" target="_blank">{subject}</a>',
	'share_article' => '{actor} ������������� <a href="{url}" target="_blank">{subject}</a>',
	'magic_present_note' => '�͸���һ������ <a href="{url}" target="_blank">{name}</a>',
	'friend_add' => '{actor} �����Ϊ�˺���',
	'doing_reply' => '{actor} �� <a href="{url}" target="_blank">��¼</a> �ж�������˻ظ�',
	'wall_reply' => '{actor} �ظ������ <a href="{url}" target="_blank">����</a>',
	'pic_comment_reply' => '{actor} �ظ������ <a href="{url}" target="_blank">ͼƬ����</a>',
	'blog_comment_reply' => '{actor} �ظ������ <a href="{url}" target="_blank">��־����</a>',
	'share_comment_reply' => '{actor} �ظ������ <a href="{url}" target="_blank">��������</a>',
	'wall' => '{actor} �����԰��ϸ��� <a href="{url}" target="_blank">����</a>',
	'pic_comment' => '{actor} ��������� <a href="{url}" target="_blank">ͼƬ</a>',
	'blog_comment' => '{actor} �����������־ <a href="{url}" target="_blank">{subject}</a>',
	'share_comment' => '{actor} ��������� <a href="{url}" target="_blank">����</a>',
	'click_blog' => '{actor} �������־ <a href="{url}" target="_blank">{subject}</a> ���˱�̬',
	'click_pic' => '{actor} ����� <a href="{url}" target="_blank">ͼƬ</a> ���˱�̬',
	'click_article' => '{actor} ��������� <a href="{url}" target="_blank">{subject}</a> ���˱�̬',
	'show_out' => '{actor} �����������ҳ�����ھ��������������һ������Ҳ�����ѵ���',
	'puse_article' => '��ϲ�㣬���<a href="{url}" target="_blank">{subject}</a>�ѱ����ӵ������б��� <a href="{newurl}" target="_blank">����鿴</a>',


	'group_member_join' => '{actor} ������� <a href="forum.php?mod=group&fid={fid}" target="_blank">{groupname}</a> Ⱥ����Ҫ��ˣ��뵽Ⱥ��<a href="{url}" target="_blank">������̨</a> �������',
	'group_member_invite' => '{actor} ��������� <a href="forum.php?mod=group&fid={fid}" target="_blank">{groupname}</a> Ⱥ�飬<a href="{url}" target="_blank">������ϼ���</a>',
	'group_member_check' => '���Ѿ�ͨ���� <a href="{url}" target="_blank">{groupname}</a> Ⱥ�����ˣ��� <a href="{url}" target="_blank">�������</a>',
	'group_member_check_failed' => '��û��ͨ�� <a href="{url}" target="_blank">{groupname}</a> Ⱥ�����ˡ�',

	'reason_moderate' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} {modaction} <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_merge' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} {modaction} <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_delete_post' => '���� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �����ӱ� {actor} ɾ�� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_delete_comment' => '���� <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank">{subject}</a> �ĵ����� {actor} ɾ�� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_ban_post' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} {modaction} <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_warn_post' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} {modaction}<br />
���� {warningexpiration} �����ۼ� {warninglimit} �ξ��棬�㽫���Զ���ֹ���� {warningexpiration} �졣<br />
����Ŀǰ�����ѱ����� {authorwarnings} �Σ���ע�⣡<div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_move' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} �ƶ��� <a href="forum.php?mod=forumdisplay&fid={tofid}" target="_blank">{toname}</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_copy' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ����Ϊ <a href="forum.php?mod=viewthread&tid={threadid}" target="_blank">{subject}</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_remove_reward' => '����������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ���� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_stamp_update' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ������ͼ�� {stamp} <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_stamp_delete' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ������ͼ�� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_stamplist_update' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ������ͼ�� {stamp} <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_stamplist_delete' => '������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ������ͼ�� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_stickreply' => '�������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �Ļ����� {actor} �ö� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'reason_stickdeletereply' => '�������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �Ļ����� {actor} �����ö� <div class="quote"><blockquote>{reason}</blockquote></div>',

	'modthreads_delete' => '�㷢�������� {threadsubject} û��ͨ����ˣ����ѱ�ɾ����<div class="quote"><blockquote>{reason}</blockquote></div>',

	'modthreads_validate' => '�㷢�������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{threadsubject}</a> �Ѿ����ͨ���� &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'modreplies_delete' => '�㷢���ظ�û��ͨ����ˣ����ѱ�ɾ���� <p class="summary">�ظ����ݣ�<span>{post}</span></p> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'modreplies_validate' => '�㷢���Ļظ��Ѿ����ͨ���� &nbsp; <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a> <p class="summary">�ظ����ݣ�<span>{post}</span></p> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'transfer' => '���յ�һ������ {actor} �Ļ���ת�� {credit} &nbsp; <a href="home.php?mod=spacecp&ac=credit&op=log&suboperation=creditslog" target="_blank" class="lit">�鿴 &rsaquo;</a>
<p class="summary">{actor} ˵��<span>{transfermessage}</span></p>',

	'addfunds' => '���ύ�Ļ��ֳ�ֵ�����ѳɹ���ɣ���Ӧ����Ļ����Ѿ�������Ļ����˻� &nbsp; <a href="home.php?mod=spacecp&ac=credit&op=base" target="_blank" class="lit">�鿴 &rsaquo;</a>
<p class="summary">�����ţ�<span>{orderid}</span></p><p class="summary">֧����<span>����� {price} Ԫ</span></p><p class="summary">���룺<span>{value}</span></p>',
        
        'rate_reason' => '�������� <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank">{subject}</a> �����ӱ� {actor} ���� {ratescore} <div class="quote"><blockquote>{reason}</blockquote></div>',
	
        'rate_reasons' => '�������� <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank">{subject}</a> �����ӱ� {actor} ���� {ratescore} <div class="quote"><blockquote>{reason}</blockquote>&nbsp;&nbsp;&nbsp;8264�ҿ��Զһ���Ʒ����������<a href="http://bbs.8264.com/forum-483-1.html" target="_blank">��Ʒ�һ�����</a></div>',

	'rate_removereason' => '{actor} �������������� <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank">{subject}</a> �����ӵ����� {ratescore} <div class="quote"><blockquote>{reason}</blockquote></div>',

	'trade_seller_send' => '<a href="home.php?mod=space&uid={buyerid}" target="_blank">{buyer}</a> ���������Ʒ <a href="forum.php?mod=trade&orderid={orderid}" target="_blank">{subject}</a>���Է��Ѿ�����ȴ��㷢�� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'trade_buyer_confirm' => '�㹺�����Ʒ <a href="forum.php?mod=trade&orderid={orderid}" target="_blank">{subject}</a>��<a href="home.php?mod=space&uid={sellerid}" target="_blank">{seller}</a> �ѷ������ȴ���ȷ�� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'trade_fefund_success' => '��Ʒ <a href="forum.php?mod=trade&orderid={orderid}" target="_blank">{subject}</a> ���˿�ɹ� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">���� &rsaquo;</a>',

	'trade_success' => '��Ʒ <a href="forum.php?mod=trade&orderid={orderid}" target="_blank">{subject}</a> �ѽ��׳ɹ� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">���� &rsaquo;</a>',

	'trade_order_update_sellerid' => '���� <a href="home.php?mod=space&uid={sellerid}" target="_blank">{seller}</a> �޸�����Ʒ <a href="forum.php?mod=trade&orderid={orderid}" target="_blank">{subject}</a> �Ľ��׵�����ȷ�� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'trade_order_update_buyerid' => '��� <a href="home.php?mod=space&uid={buyerid}" target="_blank">{buyer}</a> �޸�����Ʒ <a href="forum.php?mod=trade&orderid={orderid}" target="_blank">{subject}</a> �Ľ��׵�����ȷ�� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'eccredit' => '���㽻�׵� {actor} �Ѿ������������� &nbsp; <a href="forum.php?mod=trade&orderid={orderid}" target="_blank" class="lit">���� &rsaquo;</a>',

	'activity_notice' => '{actor} ���������ٰ�Ļ <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a>������� &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'activity_apply' => '� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �ķ����� {actor} ����׼��μӴ˻ &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'activity_replenish' => '� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �ķ����� {actor} ֪ͨ����Ҫ���ƻ������Ϣ &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'activity_delete' => '� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �ķ����� {actor} �ܾ���μӴ˻ &nbsp; <a href="forum.php?mod=viewthread&tid={tid}"  target="_blank" class="lit">�鿴 &rsaquo;</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'activity_cancel' => '{actor} ȡ���˲μ� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> � &nbsp; <a href="forum.php?mod=viewthread&tid={tid}"  target="_blank" class="lit">�鿴 &rsaquo;</a> <div class="quote"><blockquote>{reason}</blockquote></div>',

	'activity_notification' => '� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �ķ����� {actor} ����֪ͨ&nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴� &rsaquo;</a> <div class="quote"><blockquote>{msg}</blockquote></div>',

	'reward_question' => '����������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> �� {actor} ��������Ѵ� &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'reward_bestanswer' => '��Ļظ����������� <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> ������ {actor} ѡΪ������Ѵ� &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'comment_add' => '{actor} ������������������ <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> ���������� &nbsp; <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',

	'repquote_noticeauthor' => '{actor} �ظ���������� <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank">{subject}</a> &nbsp; <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank" class="lit">�鿴</a>',

	'reppost_noticeauthor' => '{actor} ����������� <a href="forum.php?mod=redirect&goto=findpost&ptid={tid}&pid={pid}" target="_blank">{subject}</a> &nbsp; <a href="forum.php?mod=redirect&goto=findpost&pid={pid}&ptid={tid}" target="_blank" class="lit">�鿴</a>',

	'task_reward_credit' => '��ϲ���������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>����û��� {creditbonus} &nbsp; <a href="home.php?mod=spacecp&ac=credit&op=base" target="_blank" class="lit">�鿴�ҵĻ��� &rsaquo;</a></p>',

	'task_reward_magic' => '��ϲ���������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>����õ��� <a href="home.php?mod=magic&action=mybox" target="_blank">{rewardtext}</a> {bonus} ��',

	'task_reward_medal' => '��ϲ���������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>�����ѫ�� <a href="home.php?mod=medal" target="_blank">{rewardtext}</a> ��Ч�� {bonus} ��',

	'task_reward_invite' => '��ϲ���������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>�����<a href="home.php?mod=spacecp&ac=invite" target="_blank">������ {rewardtext}��</a> ��Ч�� {bonus} ��',

	'task_reward_group' => '��ϲ���������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>������û��� {rewardtext} ��Ч�� {bonus} �� &nbsp; <a href="home.php?mod=spacecp&ac=usergroup" target="_blank" class="lit">����������ʲô &rsaquo;</a>',
	
	'task_reward_checked_ok' => '��ϲ�������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>���Ѿ�ͨ������Ա�����',
	
	'task_reward_checked_error' => '���ź����������<a href="home.php?mod=task&do=view&id={taskid}" target="_blank">{name}</a>��δ��ͨ������Ա�����',

	'user_usergroup' => '����û�������Ϊ {usergroup} &nbsp; <a href="home.php?mod=spacecp&ac=usergroup" target="_blank" class="lit">����������ʲô &rsaquo;</a>',

	'grouplevel_update' => '��ϲ�㣬���Ⱥ�� {groupname} �Ѿ��������� {newlevel}��',

    'thread_invitefx' => '{actor} ������{invitename} <a href="http://www.8264.com/zb-{tid}" target="_blank">{subject}</a> &nbsp; <a href="http://www.8264.com/zb-{tid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',
	'thread_invite' => '{actor} ������{invitename} <a href="forum.php?mod=viewthread&tid={tid}" target="_blank">{subject}</a> &nbsp; <a href="forum.php?mod=viewthread&tid={tid}" target="_blank" class="lit">�鿴 &rsaquo;</a>',
	'invite_friend' => '��ϲ��ɹ����뵽 {actor} ����Ϊ��ĺ���',

	'profile_verify_error' => '{verify}������˱��ܾ�,�����ֶ���Ҫ������д:<br/>{profile}<br/>�ܾ�����:{reason}',
	'profile_verify_pass' => '��ϲ�㣬����д��{verify}�������ͨ����',
	'profile_verify_pass_refusal' => '���ź�������д��{verify}������˱��ܾ���',
	'member_ban_speak' => '���ѱ� {user} ��ֹ���ԣ����ޣ�{day}��(0���������ý���)���������ɣ�{reason}',

	'member_moderate_invalidate' => '����˺�δ��ͨ������Ա����ˣ���<a href="home.php?mod=spacecp&ac=profile">�����ύע����Ϣ</a>��<br />����Ա����: <b>{remark}</b>',
	'member_moderate_validate' => '����˺��Ѿ�ͨ����ˡ�<br />����Ա����: <b>{remark}</b>',
	'member_moderate_invalidate_no_remark' => '����˺�δ��ͨ������Ա����ˣ���<a href="home.php?mod=spacecp&ac=profile">�����ύע����Ϣ</a>��',
	'member_moderate_validate_no_remark' => '����˺��Ѿ�ͨ����ˡ�',

	'system_notice' => '{subject}<p class="summary">{message}</p>',
	'report_change_credits' => '{actor} ��������ľٱ������ {creditchange}',
	'new_report' => '���µľٱ��ȴ�������<a href="admin.php?action=report" target="_blank">��˽����̨����</a>��',
	'magics_receive' => '���յ� {actor} �͸���ĵ��� {magicname}
<p class="summary">{actor} ˵��<span>{msg}</span></p>
<p class="mbn"><a href="home.php?mod=magic" target="_blank">��������</a><span class="pipe">|</span><a href="home.php?mod=magic&action=mybox" target="_blank">�鿴�ҵĵ�����</a></p>',
	'at_message' => '<a href="home.php?mod=space&uid={src_uid}" target="_blank">{src_username}</a> �� <a href="forum.php?mod=redirect&goto=findpost&ptid={tid}&pid={pid}" target="_blank">{subject}</a> ���ᵽ������<a href="forum.php?mod=redirect&goto=findpost&ptid={tid}&pid={pid}" target="_blank">����ȥ����</a>��',
	'following_notify' => '{actor} ��ע����',

);

?>