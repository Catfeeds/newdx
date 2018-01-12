<?php
echo <<<EOT
<script id="productTemplate" type="text/x-jquery-tmpl">
<div class="product_item" id="product_tid_\${tid}">
    <div class="inner">
        <div class="white_border">
            <div class="image" style="height:\${img_height}">
                <a href="http://www.8264.com/zb-\${tid}">
                    <img src="\${cptp}.thumb210.jpg?abs" />
                </a>
                {{if cpjg != 0}}<span class="jiage">￥\${cpjg}</span>{{/if}}
                {{if index_height >= 600}}<div class="cover"></div>{{/if}}
            </div>
            <div class="product_userinfo">
                <div class="showtx">
                    <div class="sjx">               
                    </div>
                    <div style="padding: 7px;">
                        <a href="http://u.8264.com/home-space-uid-\${authorid}-view-admin.html" target="_blank">个人空间</a><span style="font-size: 12px;line-height: 12px;position: absolute;right: 7px;top: 4px;cursor: pointer;">x</span><br>
                        <a href="http://u.8264.com/home-space-uid-\${authorid}-do-produce-view-me-from-space.html" target="_blank">装备分享(\${sharenum})</a><br>
                        <a onclick="showWindow('showMsgBox', this.href, 'get', 0);" href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_\${authorid}&touid=\${authorid}&pmid=0&daterange=2" target="_blank">发消息</a>   
                    </div>                    
                </div>
                <div class="product_userinfo_face">
                    <a href="http://u.8264.com/home-space-uid-\${authorid}-do-profile.html" target="_blank">
                        {{html avatar}}
                    </a>
                </div>
                <div class="product_userinfo_text">
                    <a href="http://u.8264.com/home-space-uid-\${authorid}-do-profile.html" target="_blank">
                        \${author}
                    </a>
                    发布
                    <a href="http://www.8264.com/zb-\${tid}"  onclick="atarget(this)">
                        \${subject}
                    </a>
                    <br />
                </div>
            </div>
            <div class="stat">
                {{if {$_G['groupid']} == 1 || {$_G['groupid']} == 45}}
                <span class="cz" title="操作分值" onclick="test(\${tid});">分值</span>
                {{/if}}
                <a href="http://www.8264.com/zb-\${tid}">
                \${views}
                </a> 人浏览 &nbsp;
            </div>
        </div>
    </div>
</div>
</script>
EOT;
//