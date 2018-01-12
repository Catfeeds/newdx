<script id="commentsTemplate" type="text/x-jquery-tmpl">
<div id="post_${pid}" class="xld xlda mbm">
    <dl class="bbda cl" id="pid${pid}" style="width:605px;overflow:hidden;">
        <dd class="m avt" style="margin-bottom:0;padding-bottom:8px;">
            <a href="home.php?mod=space&uid=${authorid}">
            {{html avatar}}
            </a>
        </dd>
        <dt>
            <span class="y xw0">
                <a href="forum.php?mod=post&action=reply&fid=${fid}&tid=${tid}&reppost=${pid}&extra=<?php echo $_G['gp_extra']; ?>&page=<?php echo $page; ?>" onclick="showWindow('reply', this.href)">回复</a>
                <a href="forum.php?mod=post&action=reply&fid=${fid}&tid=${tid}&repquote=${pid}&extra=<?php echo $_G['gp_extra']; ?>&page=<?php echo $page; ?>" onclick="showWindow('reply', this.href)">引用</a>
                <?php if (($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid'])): ?>
                <a href="forum.php?v=1&mod=post&action=edit&fid=${fid}&tid=${tid}&pid=${pid}&page={$page}">编辑</a>
                <?php endif; ?>
            </span>
            <em id="author_${pid}">${author}</em>
            <span class="xg1 xw0">{{html dateline}}</span>
        </dt>
        <dd class="z">
            <div class="pcb">
                <div class="t_fsz">
                <table cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td id="postmessage_${pid}" class="t_f">{{html message}}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div style="text-align:right;">
            <?php if ($modmenu['post']): ?>
                <span class="y">
                <label for="manage${pid}">
                <input type="checkbox" id="manage${pid}" class="pc" onclick="pidchecked(this);modclick(this, ${pid})" value="${pid}" autocomplete="off" />
                管理
                </label>
                </span>
            <?php endif; ?>
            </div>
        </dd>
    </dl>
</div>
</script>