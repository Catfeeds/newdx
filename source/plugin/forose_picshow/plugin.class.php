<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_forose_picshow {

}

class plugin_forose_picshow_forum extends plugin_forose_picshow  {
	function forumdisplay_thread_output(){
		global $_G;
		if(!isset($_G['cache']['plugin'])){
			loadcache('plugin');
		}
		@extract($_G['cache']['plugin']['forose_picshow']);
		if(!in_array($_G['fid'],(array)unserialize($usefids))) return array();
		if(!$_G['forum_threadlist']||!is_array($_G['forum_threadlist'])) return array();
		$return=array();
		foreach ($_G['forum_threadlist'] as $key=>$thread){
			$md5=md5($thread['tid']);
			$pic="
 <a href=\"forum.php?mod=viewthread&tid={$thread['tid']}\" target=\"_blank\"><img 
src=\"./data/attachment/threadpic/{$picw}x{$pich}/{$md5[0]}{$md5[1]}/{$md5}.jpg\" 
onerror=\"this.src='plugin.php?id=forose_picshow:pic&ptid={$thread['tid']}'\" width=$picw height=$pich align=$picalign title='{$thread['subject']}' /></a> ";
			if($showway==1){
				$return[]=$pic;
			}else{
				$_G['forum_threadlist'][$key]['pic']=$pic;
			}
		}
		return $return;
	}
	function post_delthumb(){
		global $_G;
		if(!isset($_G['cache']['plugin'])){
			loadcache('plugin');
		}
		@extract($_G['cache']['plugin']['forose_picshow']);
		$tid=intval($_G['gp_tid']);
		if($_POST&&$_G['gp_action']=='edit'&&$_POST['attachnew']){
			$md5=md5($tid);
			$thumbdir="./data/attachment/threadpic/";
			if(is_dir($thumbdir)){
				$pic=$thumbdir."/{$picw}x{$pich}/".$md5[0].$md5[1]."/".$md5.".jpg";
				@unlink($pic);
			}
		}
	}
}
?>