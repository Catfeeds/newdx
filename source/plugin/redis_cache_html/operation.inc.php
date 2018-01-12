<?php
//echo 'connected';
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
if(isset($_POST) && isset($_POST['inajax']) && $_POST['inajax']==1){
    require_once libfile('class/myredis');
    global $myredis;
    $myredis = & myredis::instance(6378);
    $methodlist = array('0'=>'map_html','1'=>'pp_html');
    if($myredis->connected){
        call_user_func_array("do_".$_POST['mod'],array($_POST['type'],$_POST['nowpage']));
    }else{
		echo "error";
	}
}else{
    echo "error";
}
function do_details($type,$next){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    $maxnum = $myredis->hashget('cache_html_len',$cachehash);
    $perpage = 20;
    if(!$maxnum){
        $maxnum = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_html_pp')." WHERE type = ".$type);
        $myredis->hashset('cache_html_len',$cachehash,$maxnum);
    }
    $maxpage = ceil($maxnum/$perpage);
    $num = $myredis->obj->hLen($cachehash);
    $next;
    $query = DB::query("SELECT * FROM ".DB::table('plugin_html_pp')." WHERE type = ".$type." limit ".(($next-1)*$perpage).",".$perpage);
    while($value = DB::fetch($query)){
        $return[$value['filename']] = ($myredis->hashget($cachehash,$value['filename']) ? "<b class='green'>已经生成</b> | <a href='javascript:;' class='clear_one'>清理</a>" : "<b class='red'>未生成</b>  | <a href='javascript:;' class='create_one'>生成</a>");
        $mtype[$value['filename']] = $value['type'];
    }
    if($return){
        echo "<table style='width:550px;'>";
        echo '<tr><th><b>页面</b></th><th><b>缓存状态</b></th></tr>';
        foreach($return as $key => $value){
            echo <<<EOF
<tr id='$key'><td>$key</td><td class='{$mtype[$key]}'>$value</td></tr>
EOF;
        }
        echo "</table><p title='{$type}'>共{$maxpage}页    |    当前第".($next)."页    |    ";
        if($next>1){
            echo "<a href='javascript:;' class='changepage' title='".($next-1)."'>上一页</a>    |    ";
        }
        if($next<$maxpage){
            echo "<a href='javascript:;' class='changepage' title='".($next+1)."'>下一页</a>";
        }
    }
}

function do_clearcache($type){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    //echo "method do_clearcache";
    cache_change($type,'clear');
}

function do_docache($type){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    //echo "method do_docache";
    cache_change($type,'make');
}

function do_create_one($value,$type){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    $myredis->hashset($cachehash,$value,DB::result_first("SELECT html FROM ".DB::table('plugin_html_pp')." WHERE filename = '".$value."'"));
    if($myredis->hashget($cachehash,$value)){
        echo "<b class='green'>已经生成</b> | <a href='javascript:;' class='clear_one'>清理</a>";
    }else{
        echo "error";
    }
}

function do_clear_one($value,$type){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    $myredis->hashdel($cachehash,$value);
    if(!$myredis->hashget($cachehash,$value)){
        echo "<b class='red'>未生成</b>  | <a href='javascript:;' class='create_one'>生成</a>";
    }else{
        echo "error";
    }
}

function do_getlen($type){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    echo $myredis->obj->hLen($cachehash);
}

function cache_change($type,$method){
    global $myredis,$methodlist;
    $cachehash = $methodlist[$type];
    $query = DB::query("SELECT * FROM ".DB::table('plugin_html_pp')." WHERE type = ".$type);
    $return = array();
    while($value = DB::fetch($query)){
        $return[]=$value['filename'];
        switch($method){
            case 'clear':
            $myredis->hashdel($cachehash,$value['filename']);
            break;

            case 'make':
            $myredis->hashset($cachehash,$value['filename'],$value['html']);
            break;

            default:
            echo "error";
            return false;break;
        }
    }
    echo "操作完成";
}
?>
