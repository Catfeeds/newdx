<?php
/**
 *      $Id: task_albumpiccomment.php 2011-03-30 wangqi $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class task_albumpic {

	var $version = '1.0';
	var $name = 'albumpic_name';
	var $description = 'albumpic_desc';
	//var $copyright = '<a href="'.getglobal('config/web/portal').'" target="_blank">'.getglobal('setting/domain/root/forum').'</a>';
	var $icon = ''; 
	var $period = '';
	var $periodtype = 0;
	var $conditions = array(
		'picid' => array(
			'title' => 'albumpic_complate_var_picid_comment',
			'type' => 'text',
			'value' => '',
			'sort' => 'complete',
		),
	);

	function csc($task = array()) {
		global $_G;

		$taskvars = array('num' => 0);
		$query = DB::query("SELECT variable, value FROM ".DB::table('common_taskvar')." WHERE taskid='$task[taskid]'");
		while($taskvar = DB::fetch($query)) {
			if($taskvar['value']) {
				$taskvars[$taskvar['variable']] = $taskvar['value'];
			}
		}
		
		$sqladd  = '1';
		if ($taskvars['picid']) {
			$sqladd .= " AND id='{$taskvars['picid']}' AND idtype='picid' AND authorid = '{$_G['uid']}'";
		}
		$sqladd .= " AND dateline>$task[applytime]";

		$num = getcount('home_comment', $sqladd);

		if($num) {
			return TRUE;
		} else {
			return array('csc' => 0, 'remaintime' => 0);
		}
	}

	function view($task, $taskvars) {
		if(!empty($taskvars['complete']['picid'])) {
			$value = intval($taskvars['complete']['picid']['value']);
			$query = DB::query("SELECT title, uid FROM ".DB::table('home_pic')." WHERE picid='{$value}' limit 1");
			$pic = DB::fetch($query);
			$value = "<a href=\"home.php?mod=space&uid={$pic['uid']}&do=album&picid={$value}\"><strong>".($pic['title'] ? $pic['title'] : 'PICID '.$value)."</strong></a>";
		}
		return lang('task/albumpic', 'task_complete_act_newreply_pic', array('value' => $value));
	}

	function sufprocess($task) {
	}

}

?>