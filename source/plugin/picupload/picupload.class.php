<?php

/**
 * @author JiangHong
 * 图片分楼
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_picupload{
    
}

class plugin_picupload_forum extends plugin_picupload{
    function forumdisplay_postbutton_top(){
        global $_G;
		$allowgroup = unserialize($_G['cache']['plugin']['picupload']['postgroup']);
		$allowforum = unserialize($_G['cache']['plugin']['picupload']['postforum']);
		if(($_G['groupid']!=1 && !in_array($_G['groupid'] , $allowgroup)) || !in_array($_G['fid'] , $allowforum)) return '';
        $config = $_G['cache']['plugin']['picupload'];
        // $return = $config['useajax'] ? '<a id="picupload_post" href="javascript:;" title="如果您的帖子照片较多，建议点此使用图片分楼发帖" onclick="showdialog(this)"><img src="static/images/tpfl.jpg"/><span id="new_tips"><img src="static/images/new.png"/></span></a>' : '<a  id="picupload_post" title="如果您的帖子照片较多，建议点此使用图片分楼发帖" href="plugin.php?id=picupload&fid='.$_G['fid'].'"><img src="static/images/tpfl.jpg"/><span id="new_tips"><img src="static/images/new.png"/></span></a>';
        include template('picupload:forumdisplaybutton');
        if($config['useajax']) $return .= <<<EOF
    <script type="text/javascript">
		function showdialog(obj){
			obj.style.display = 'none';
			ajaxget("plugin.php?id=picupload&fid=$_G[fid]", 'picupload_dialog_content');
			obj.style.display = '';
			$('picupload_dialog').style.display = 'block';
		}
	</script>
EOF;
        return $return;
    }
	function post_tpfl_return(){
		global $_G;
		$allowgroup = unserialize($_G['cache']['plugin']['picupload']['postgroup']);
		$allowforum = unserialize($_G['cache']['plugin']['picupload']['postforum']);
		if(($_G['groupid']!=1 && !in_array($_G['groupid'] , $allowgroup)) || !in_array($_G['fid'] , $allowforum)) return '';
		$str = $_G['cache']['plugin']['picupload']['tipstext1'] ? $_G['cache']['plugin']['picupload']['tipstext1'] : '您当前编辑的文字信息将会丢失';		
		$authorid = $_G['tid'] > 0 ? DB::result_first("SELECT authorid FROM ".DB::table("forum_thread")." WHERE tid = '$_G[tid]'") : 0;
		include template('picupload:posttemplate');
		return $return;
	}
    function viewthread_postbutton_top(){
        global $_G;
		$allowgroup = unserialize($_G['cache']['plugin']['picupload']['postgroup']);
		$allowforum = unserialize($_G['cache']['plugin']['picupload']['postforum']);
		if(($_G['groupid']!=1 && !in_array($_G['groupid'] , $allowgroup)) || !in_array($_G['fid'] , $allowforum)) return '';
		$authorid = DB::result_first("SELECT authorid FROM ".DB::table("forum_thread")." WHERE tid = '$_G[tid]'");
		$return = '';		
		if($_G['uid'] == $authorid){		
			include template('picupload:viewthreadbutton');
		}		
        return $return;
    }
}
 ?>