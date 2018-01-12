<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: task_post.php 17028 2010-09-19 06:00:02Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class task_appfollow {

	var $version = '1.0';
	var $name = 'appfollow_name';
	var $description = 'appfollow_desc';
	var $copyright = '<a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>';
	var $icon = '';
	var $period = '';
	var $periodtype = 0;
	var $conditions = array(
		/*'act' => array(
			'title' => 'post_complete_var_act',
			'type' => 'mradio',
			'value' => array(
				array('newthread', 'post_complete_var_act_newthread'),
				array('newreply', 'post_complete_var_act_newreply'),
				array('newpost', 'post_complete_var_act_newpost'),
			),
			'default' => 'newthread',
			'sort' => 'complete',
		),*/
		/*'forumid' => array(
			'title' => 'post_complate_var_forumid',
			'type' => 'mselect',
			'value' => array(),
			'sort' => 'complete',
		),*/
		'url' => array(
			'title' => 'appfollow_url',
			'type' => 'text',
			'value' => '',
			'sort' => 'complete',
		),
		'descript' => array(
			'title' => 'appfollow_descript',
			'type' => 'text',
			'value' => '',
			'sort' => 'complete',
		),
		'subject' => array(
			'title' => 'appfollow_subject',
			'type' => 'text',
			'value' => '',
			'sort' => 'complete',
		),
	);
	var $taskinfo;

	function task_appfollow() {
		global $_G;

		loadcache('forums');
		$this->conditions['forumid']['value'][] = array(0, '&nbsp;');
		if(empty($_G['cache']['forums'])) $_G['cache']['forums'] = array();
		foreach($_G['cache']['forums'] as $fid => $forum) {
			$this->conditions['forumid']['value'][] = array($fid, ($forum['type'] == 'forum' ? str_repeat('&nbsp;', 4) : ($forum['type'] == 'sub' ? str_repeat('&nbsp;', 8) : '')).$forum['name']);
		}
        //echo '<pre>';
        //print_r($this->conditions);exit;
	}

	function csc($task = array()) {
		return true;
	}

/*	function view($task, $taskvars) {
		global $_G;
		$return = $value = '';
		if(!empty($taskvars['complete']['forumid'])) {
			$forumids = explode(',', $taskvars['complete']['forumid']['value']);
			loadcache('forums');
			foreach ($forumids as $fid) {
				$value .= '<a href="forum.php?mod=forumdisplay&fid='.$fid.'" target="_blank"><strong>['.$_G['cache']['forums'][$fid]['name'].']</strong></a> ';
			}
		} elseif(!empty($taskvars['complete']['threadid'])) {
			$value = intval($taskvars['complete']['threadid']['value']);
			$subject = DB::result_first("SELECT subject FROM ".DB::table('forum_thread')." WHERE tid='$value'");
			$value = '<a href="forum.php?mod=viewthread&tid='.$value.'"><strong>'.($subject ? $subject : 'TID '.$value).'</strong></a>';
		} elseif(!empty($taskvars['complete']['author'])) {
			$value = addslashes($taskvars['complete']['author']['value']);
			$authorid = DB::result_first("SELECT uid FROM ".DB::table('common_member')." WHERE username='".$value."'");
			$value = '<a href="home.php?mod=space&uid='.$authorid.'"><strong>'.$value.'</strong></a>';
		}
		$taskvars['complete']['num']['value'] = intval($taskvars['complete']['num']['value']);
		if($taskvars['complete']['act']['value'] == 'newreply') {
			if($taskvars['complete']['threadid']) {
				$return .= lang('task/appfollow', 'task_complete_act_newreply_thread', array('value' => $value, 'num' => $taskvars['complete']['num']['value']));
			} else {
				$return .= lang('task/appfollow', 'task_complete_act_newreply_author', array('value' => $value, 'num' => $taskvars['complete']['num']['value']));
			}
		} else {
			if($taskvars['complete']['forumid']) {
				$return .= lang('task/appfollow', 'task_complete_forumid', array('value' => $value));
			}
			if($taskvars['complete']['act']['value'] == 'newthread') {
				$return .= lang('task/appfollow', 'task_complete_act_newthread', array('num' => $taskvars['complete']['num']['value']));
			} else {
				$return .= lang('task/appfollow', 'task_complete_act_newpost', array('num' => $taskvars['complete']['num']['value']));
			}
		}
        echo '<pre>';var_dump($return);exit;
		return $return;
	}*/

	function sufprocess($task) {
	}

	/**
	 * @author JiangHong
	 * 新增，用户记录回帖发帖的用户记录信息
	 */
	function record($task = array()){
		global $_G;
		$return = '对'.lang('admincp','nav_task_post');
		if($this->taskinfo['act'] == 'newreply' && $this->taskinfo['threadid']) {
			$sqladd .= " AND p.tid='".$this->taskinfo['threadid']."'";
			$return .= '<a target="_blank" href="forum.php?mod=viewthread&tid='.$this->taskinfo['threadid'].'">'.lang('admincp','tasks_add_limit_threadid').'</a> ';
		} else {
			if($this->taskinfo['forumid']) {
				$sqladd .= " AND p.fid IN (".$this->taskinfo['forumid'].")";
				list($url_forumid) = explode(',', $this->taskinfo['forumid']);
				$return .= '<a target="_blank" href="forum.php?mod=forumdisplay&fid='.$url_forumid.'">'.lang('admincp','tasks_add_limit_forumid').'</a> ';
			}
			if($this->taskinfo['author']) {
				$tbladd .= " , ".DB::table('forum_thread')." t ";
				$sqladd .= " AND p.tid=t.tid AND t.authorid='".$this->taskinfo['authorid']."'";
				$return .= '<a target="_blank" href="home.php?uid='.$this->taskinfo['author'].'">'.lang('admincp','tasks_add_limit_authorid').'</a> ';
			}
		}
		$sqladd .= ($this->taskinfo['time'] = floatval($this->taskinfo['time'])) ? " AND p.dateline BETWEEN ".$task['applytime']." AND ".($task['applytime']+3600*$this->taskinfo['time']) : " AND p.dateline>".$task['applytime'];
		// $sqladd .= $this->taskinfo['act'] ? ($this->taskinfo['act'] == 'newthread' ? " AND p.first='1'" : " AND p.first='0'") : '';
		if($this->taskinfo['act']) {
			if($this->taskinfo['act'] == 'newthread') {
				$sqladd .= " AND p.first='1'";
			} elseif($this->taskinfo['act'] == 'newreply') {
				$sqladd .= " AND p.first='0'";
			}
		}
		$sql = "SELECT p.tid , p.pid ,p.first FROM ".DB::table('forum_post')." p ".$tbladd." WHERE p.authorid='{$_G['uid']}' $sqladd order by p.dateline ASC limit ".($this->taskinfo['num'] > 0 ? $this->taskinfo['num'] : 1);
		$query = DB::query($sql);
		$return .= ' 的 ';
		$return	.= ($this->taskinfo['act'] ? ($this->taskinfo['act'] == 'newthread' ? lang('admincp','tasks_add_act_newthread') : lang('admincp','tasks_add_act_newreply')) : '');
		$i = 1;
		while($values = DB::fetch($query)){
			$return .= $values['first']==1 ? '|&nbsp;&nbsp;<a target="_blank" href="forum.php?mod=viewthread&tid='.$values['tid'].'">新帖'.$i.'</a>' : '|&nbsp;&nbsp;<a target="_blank" href="forum.php?mod=redirect&goto=findpost&pid='.$values['pid'].'&ptid='.$values['tid'].'">回帖'.$i.'</a>' ;
			$i++;
		}
		return $return;
	}
}

?>
