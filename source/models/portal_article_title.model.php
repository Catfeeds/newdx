<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * portal_article_title 模型
 * 
 * @author lxp 20131104
 */
class Portal_article_titleModel extends BaseModel {
	var $table = 'portal_article_title';
	var $alias = 'p_a_t';
	var $prikey = 'aid';
	var $_relation = array(
		// 一条记录对应一条content lxp 20130927
		'has_content' => array(
			'model' => 'portal_article_content',
			'type'  => HAS_ONE,
			'refer_key' => 'aid',
			'foreign_key' => 'aid'
		)
	);
	
	/**
	 * 返回文章数目
	 * @access public
	 * @param String $where 条件
	 * @return string
	 */
	function getCount($where = ""){
		$result = $this->get(array('fields'=>"count(*) as num", 'conditions' => $where, "limit"=>"0,1"));
		return $result["num"];
	}	
	
}