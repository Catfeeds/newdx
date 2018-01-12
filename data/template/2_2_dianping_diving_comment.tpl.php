<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(is_array($commentlist)) foreach($commentlist as $comment) { ?><div id="post_<?php echo $comment['pid'];?>" class="comment-list-box">
    <div class="avatar-box">
        <a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow">
            <?php echo avatar($comment['authorid'], small); ?>            <span class="user-name"><?php echo $comment['author'];?></span>
        </a>
    </div>
<div class="comment-word">
<div class="rows-content row-color-2">
<div class="commAttr">
<i class="attrs-icon comm"></i>推荐
</div>
<div class="attrValues">
<div class="rating-level big-rating clist-rating">
<span class="score-value score-value-<?php echo $comment['starnum']*2; ?>">
<em></em>
</span>
<span>(<?php if($comment['starnum']==1) { ?>很差<?php } elseif($comment['starnum']==2) { ?>较差<?php } elseif($comment['starnum']==3) { ?>还行<?php } elseif($comment['starnum']==4) { ?>推荐<?php } elseif($comment['starnum']==5) { ?>力荐<?php } ?>)</span>
</div>
</div>
</div>
        <div class="rows-content row-color-3">
            <div class="commAttr">
                <i class="attrs-icon date"></i>不足
            </div>
            <div class="attrValues">
                <p><?php echo $comment['weakpoint'];?></p>
            </div>
        </div>
<div class="rows-content row-color-4">
<div class="commAttr">
<i class="attrs-icon date"></i>优点
</div>
<div class="attrValues">
<p><?php echo $comment['goodpoint'];?></p>
</div>
</div>

<div class="rows-content row-color-5">
<div class="commAttr">
<i class="attrs-icon complex"></i>综合
</div>
<div class="attrValues">
<p><?php echo $comment['message'];?></p>
</div>
</div>
        <?php if($comment['attachlist']) { ?>
        <div class="rows-content row-color-6">
            <div class="commAttr">
                <i class="attrs-icon picture"></i>图片
            </div>
            <div class="attrValues">
                <ul class="attrPic-list">
                    <?php if(is_array($comment['attachlist'])) foreach($comment['attachlist'] as $item) { ?>                    <li>
                        <a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="点击查看大图"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $comment['subject'];?>"></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <div class="rows-content row-color-6">
            <div class="attrValues rows-detail">
                <a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=commentdetail&amp;tid=<?php echo $comment['tid'];?>&amp;pid=<?php echo $comment['pid'];?>&amp;uid=<?php echo $comment['uid'];?>" target="_blank"><span class="rows-time"><?php echo dgmdate($comment['dateline']); ?></span></a>
                <span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $comment['tid'];?>" target="_blank"><?php echo $comment['subject'];?></a></span>
                <div class="rows-praise">
                    <a href="javascript:void(0);" id="support_<?php echo $comment['pid'];?>" onclick="support(<?php echo $comment['pid'];?>);"><i class="rows-icon<?php if($comment['supports']) { ?> icon-praise<?php } ?>"></i>有用<em><?php if($comment['supports']) { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></a>
                </div>
            </div>
        </div>
        <?php if($act=='showview' && $_G['adminid'] == 1) { include template('dianping/cplist_comment'); } ?>
</div>
    <?php if($comment['rate']) { ?><span class="b8264icon"></span><?php } ?>
</div>
<?php } if($act=='showview' && $multipage) { ?>
<!-- page -->
<div class="page-box-warpten"><?php echo $multipage;?></div>
<!-- //page -->
<?php } if($_GET['ajaxreply'] == 1) { ?><?php dp_output(); } if($act=='showview' && $_G['adminid'] == 1) { ?>
<form method="post" autocomplete="off" name="modactions" id="modactions">
    <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
    <input type="hidden" name="optgroup" />
    <input type="hidden" name="operation" />
    <input type="hidden" name="listextra" value="<?php echo $_G['gp_extra'];?>" />
</form>
<style>#mdly { margin: 20px 0 0 10px; padding: 0; width: 200px; height: auto; background: none; }</style>
<div id="mdly" class="fwinmask" style="display:none;">
    <table cellspacing="0" cellpadding="0" class="fwin">
        <tr>
            <td class="t_l"></td>
            <td class="t_c"></td>
            <td class="t_r"></td>
        </tr>
        <tr>
            <td class="m_l">&nbsp;&nbsp;</td>
            <td class="m_c">
                <div class="f_c">
                    <div class="c">
                        <h3>选中&nbsp;<strong id="mdct" class="xi1"></strong>&nbsp;篇: </h3>
                        <?php if($_G['adminid'] == 1) { ?>
                        <?php if($_G['group']['allowdelpost']) { ?><a href="javascript:;" onclick="modaction('delpost', '', '', 'forum.php?ctl=<?php echo $mod;?>&act=moderator')">删除</a><span class="pipe">|</span><?php } ?>
                        <?php if($_G['group']['allowstickreply']) { ?><a href="javascript:;" onclick="modaction('stickreply', '', '', 'forum.php?ctl=<?php echo $mod;?>&act=moderator')">置顶</a><?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </td>
            <td class="m_r"></td>
        </tr>
        <tr>
            <td class="b_l"></td>
            <td class="b_c"></td>
            <td class="b_r"></td>
        </tr>
    </table>
</div>
<?php } ?>
