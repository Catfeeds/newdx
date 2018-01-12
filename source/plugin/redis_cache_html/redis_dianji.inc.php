<?php

/**
 * @author JiangHong
 * @copyright 2013
 * @uses 对于帖子点击量缓存量的纠错处理。
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

require_once libfile('class/myredis');
$redis = & myredis::instance(6381);
$message = array();
$message['state'] = $redis->connected ? '<b><font color="green">成功</font></b>' : '<b><font color="red">失败</font></b>' ;
$message['viewthread_doing'] = $redis->connected ? $redis->obj->hlen('viewthread_doing') : false ;
$message['viewthread_if'] = $redis->connected ? $redis->obj->ttl('viewthread_doing') : false ;
$message['viewthread_number'] = $redis->connected ? $redis->obj->hlen('viewthread_number') : false ;
$message['viewthread_bak'] = $redis->connected ? $redis->obj->keys('viewthread_doing_bak_???') : false ;
$message['viewthread_end'] = $redis->connected ? $redis->obj->hlen('viewthread_doing_end') : false ;

$message['attachment_number'] = $redis->connected ? $redis->obj->hlen('attachment_number') : false ;
$message['attachment_doing'] = $redis->connected ? $redis->obj->hlen('attachment_doing') : false ;
$message['attachment_if'] = $redis->connected ? $redis->obj->ttl('attachment_doing') : false ;
$message['attachment_bak'] = $redis->connected ? $redis->obj->keys('attachment_doing_bak_???') : false ;
$message['attachment_end'] = $redis->connected ? $redis->obj->hlen('attachment_doing_end') : false ;

$otherredis = & myredis::instance(6382);
$message['inqueue'] = $otherredis->obj->llen('VIEWSTODATABASE_QUEUE_CRON');
include template('redis_cache_html:thread_view');
?>
<script type="text/javascript" src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
    $(".ajaxdo").live('click',function(){
        var method = $(this).attr('id');
        var father = $(this).parent();
        $(this).remove();
        $("#tips").html("<img src='/static/image/common/loading.gif'/>");
        $.ajax({
            type: "GET",
            url: "plugin.php?id=redis_cache_html:ajax_dofix&inajax=1&method="+method,
            dateType:"string",
            success: function(data){
                $("#tips").html(data);
                father.remove();
            }
        });
    });
})(jQuery);
</script>
