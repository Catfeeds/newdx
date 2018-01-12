<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * forum_post 模型
 * 
 * @author lxp 20130924
 */
class Forum_postModel extends BaseModel {
	var $table = 'forum_post';
	var $alias = 'f_p';
	var $prikey = 'pid';
	var $_relation = array(
			// 一条记录对应一条star_logs lxp 20130927
			'has_star' => array(
					'model' => 'dianping',
					'type'  => HAS_ONE,
					'refer_key' => 'pid',
					'foreign_key' => 'pid'
			),
			'has_thread' => array(
					'model' => 'forum_thread',
					'type' => HAS_ONE,
					'refer_key' => 'tid',
					'foreign_key' => 'tid'),
	);
}