<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 论坛接口，用于调取回帖的详细内容
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

if($_G['groupid']==1){
    $url = $_G['gp_url'];
    $url = substr($url,strpos($url,'?')+1);
    $url = explode('&',$url);
    $args = array();
    foreach($url as $k_v){
        $k_v = explode('=',$k_v);
        $args[$k_v[0]] = $k_v[1];
    }
    if($args['mod'] == 'redirect' && $args['goto'] == 'findpost'){
        $subject = DB::result_first('SELECT subject FROM '.DB::table('forum_thread').' WHERE tid = \''.$args['ptid'].'\';');
        $message = DB::result_first('SELECT message FROM '.DB::table('forum_post').' WHERE pid = \''.$args['pid'].'\';');
    }
echo <<<EOF
<h3>$subject</h3>
<hr/>
<h5>以下为回帖详情：</h5>
<hr/>
<p>$message</p>    
EOF;
}else{
    echo '权限不够,无法查看相关内容';
}

?>