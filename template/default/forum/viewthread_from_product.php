<?php
function render_product($product) {
    global $_G;
?>
<div class="product_item" id="<?php echo $product['tid']; ?>">
    <div class="inner">
        <div class="white_border">
            <div class="image" style="height:<?php echo $product['img_height']; ?>">
                <a href="http://www.8264.com/zb-<?php echo $product['tid']; ?>">
                    <img src="<?php echo $product['cptp']; ?>.thumb210.jpg?abs" />
                </a>
                <?php if ($product['cpjg']): ?>
                <span class="jiage">￥<?php echo $product['cpjg']; ?></span>
                <?php endif; ?>
                <?php if ($product['index_height'] >= 600): ?>
                <div class="cover"></div>
                <?php endif; ?>
            </div>
            <div class="product_userinfo">
                <div class="showtx">
                    <div class="sjx">               
                    </div>
                    <div style="padding: 7px;">
                        <a href="http://u.8264.com/home-space-uid-<?php echo $product['authorid'];?>-view-admin.html" target="_blank">个人空间</a><span style="font-size: 12px;line-height: 12px;position: absolute;right: 7px;top: 4px;cursor: pointer;">x</span><br>
                        <a href="http://u.8264.com/home-space-uid-<?php echo $product['authorid'];?>-do-produce-view-me-from-space.html" target="_blank">装备分享(<?php echo $product['sharenum'];?>)</a><br>
                        <a onclick="showWindow('showMsgBox', this.href, 'get', 0);" href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_<?php echo $product['authorid'];?>&touid=<?php echo $product['authorid'];?>&pmid=0&daterange=2" target="_blank">发消息<?php echo $product['state'];?></a>   
                    </div>                    
                </div>       
                <div class="product_userinfo_face">
                    <a href="http://u.8264.com/home-space-uid-<?php echo $product['authorid'];?>-do-profile.html" target="_blank">
                        <?php echo $product['avatar']; ?>
                    </a>
                </div>
                <div class="product_userinfo_text">
                    <a href="http://u.8264.com/home-space-uid-<?php echo $product['authorid'];?>-do-profile.html" target="_blank">
                        <?php echo $product['author']; ?>
                    </a>
                    发布
                    <a href="http://www.8264.com/zb-<?php echo $product['tid'];?>"  onclick="atarget(this)">
                        <?php echo $product['subject']; ?>
                    </a>
                </div>
            </div>
            <div class="stat">
                 <?php if($_G['groupid'] == 1 ||$_G['groupid']== 45): ?>
                <span class="cz" title="操作分值" onclick="test(<?php echo $product['tid']; ?>);">分值</span>
                <?php endif; ?>     
                <a href="http://www.8264.com/zb-<?php echo $product['tid']; ?>">
                <?php echo $product['views']; ?>
                </a> 人浏览 &nbsp;
            </div>
        </div>
    </div>
</div>
<?php } ?>