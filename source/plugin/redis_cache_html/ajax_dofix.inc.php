<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(isset($_GET['method']) && $_G['uid']==1 && $_GET['inajax']==1){
    $return = "<b><font color='green'>连接成功</font></b>";
    require_once libfile('function/misc');
    if($_GET['method']=='sql_viewthread'){
        updateviews_redis('forum_thread', 'tid', 'views', 'viewthread');
        //fix_redis_views('viewthread_doing','viewthread_number',array('table'=>$threadtable,'idcol'=>'tid','viewscol'=>'views'));
        echo "<b><font color='green'>入库成功</font></b>";
    }elseif($_GET['method']=='sql_attachment'){
        updateviews_redis('forum_attachment', 'aid', 'downloads', 'attachment');
        //fix_redis_views('attachment_doing','attachment_number',array('table'=>'forum_attachment','idcol'=>'aid','viewscol'=>'downloads'));
        echo "<b><font color='green'>入库成功</font></b>";
    }elseif($_GET['method']=='cache_viewthread'){
        fix_redis_views('viewthread_doing','viewthread_number',array());
        echo "<b><font color='green'>入缓存成功</font></b>";
    }elseif($_GET['method']=='cache_attachment'){
        fix_redis_views('attachment_doing','attachment_number',array());
        echo "<b><font color='green'>入缓存成功</font></b>";
    }else{
        echo "<b><font color='green'>错误！</font></b>";
    }
}
?>