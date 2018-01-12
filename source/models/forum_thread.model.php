<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * forum_thread 模型
 * 
 * @author lxp 20130924
 */
class Forum_threadModel extends BaseModel {
	var $table = 'forum_thread';
	var $alias = 'f_t';
	var $prikey = 'tid';
	var $_relation = array(
			// 对应主贴记录，需配合 first=1 lxp 20131106
			'has_post' => array(
					'model' => 'forum_post',
					'type' => HAS_ONE,
					'foreign_key' => 'tid'
			)
	);

	/**
	 * 更新热度
	 * 
	 * @author lxp 20131112
	 * @param int $tid
	 */
	function updateHeats($tid){
		global $_G;
		if(!intval($tid)) return false;
		$thread = $this->get(array(
				'fields' => 'lastposter, heats',
				'conditions' => "tid = {$tid}"
		));
		if($thread['lastposter'] != $_G['member']['username']){
			$mod_forum_post = m('forum_post');
			$u_replies = current($mod_forum_post->get(array(
					'fields' => 'COUNT(*) AS count',
					'conditions' => "tid = {$tid} AND first = 0 AND authorid = {$_G['uid']}"
			)));
			$thread['heats'] += round($_G['setting']['heatthread']['reply'] * pow(0.8, $u_replies));
			$this->edit($tid, "heats = {$thread['heats']}");
		}
	}
}