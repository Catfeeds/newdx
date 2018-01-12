<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cache_forumlinks.php 16696 2010-09-13 05:02:24Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_forumlinks() {
	global $_G;

	$data = array();
	$query = DB::query("SELECT * FROM ".DB::table('common_friendlink')." ORDER BY displayorder");

	if($_G['setting']['forumlinkstatus']) {
		while($flink = DB::fetch($query)) {
			$type = sprintf('%04b', $flink['type']);
			$type_mode = array('portal', 'forum', 'group', 'home');
			for($i=0; $i<4; $i++){
				if($type[$i]){
					if($flink['description']) {
						if($flink['logo']) {
							$data[$type_mode[$i]]['index'][0] .= '<li class="lk_logo mbm bbda cl"><img src="'.$flink['logo'].'" border="0" alt="'.$flink['name'].'" /><div class="lk_content z"><h5><a href="'.$flink['url'].'" target="_blank">'.$flink['name'].'</a></h5><p>'.$flink['description'].'</p></div>';
						} else {
							$data[$type_mode[$i]]['index'][0] .= '<li class="mbm bbda"><div class="lk_content"><h5><a href="'.$flink['url'].'" target="_blank">'.$flink['name'].'</a></h5><p>'.$flink['description'].'</p></div>';
						}
					} else {
						if($flink['logo']) {
							$data[$type_mode[$i]]['index'][1] .= '<a href="'.$flink['url'].'" target="_blank"><img src="'.$flink['logo'].'" border="0" alt="'.$flink['name'].'" /></a> ';
						} else {
							$data[$type_mode[$i]]['index'][2] .= '<li><a href="'.$flink['url'].'" target="_blank" title="'.$flink['name'].'">'.$flink['name'].'</a></li>';
						}
					}
				}
			}
			// °æ¿éÄÚÓÑÁ´
			if($flink['fids']){
				$fids = explode(',', $flink['fids']);
				foreach ($fids as $fid) {
					if($flink['description']) {
						if($flink['logo']) {
							$data['forum'][$fid][0] .= '<li class="lk_logo mbm bbda cl"><img src="'.$flink['logo'].'" border="0" alt="'.$flink['name'].'" /><div class="lk_content z"><h5><a href="'.$flink['url'].'" target="_blank">'.$flink['name'].'</a></h5><p>'.$flink['description'].'</p></div>';
						} else {
							$data['forum'][$fid][0] .= '<li class="mbm bbda"><div class="lk_content"><h5><a href="'.$flink['url'].'" target="_blank">'.$flink['name'].'</a></h5><p>'.$flink['description'].'</p></div>';
						}
					} else {
						if($flink['logo']) {
							$data['forum'][$fid][1] .= '<a href="'.$flink['url'].'" target="_blank"><img src="'.$flink['logo'].'" border="0" alt="'.$flink['name'].'" /></a> ';
						} else {
							$data['forum'][$fid][2] .= '<li><a href="'.$flink['url'].'" target="_blank" title="'.$flink['name'].'">'.$flink['name'].'</a></li>';
						}
					}
				}
			}
		}
	}

	save_syscache('forumlinks', $data);
}

?>
