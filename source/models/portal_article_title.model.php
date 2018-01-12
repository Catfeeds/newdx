<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * portal_article_title ģ��
 * 
 * @author lxp 20131104
 */
class Portal_article_titleModel extends BaseModel {
	var $table = 'portal_article_title';
	var $alias = 'p_a_t';
	var $prikey = 'aid';
	var $_relation = array(
		// һ����¼��Ӧһ��content lxp 20130927
		'has_content' => array(
			'model' => 'portal_article_content',
			'type'  => HAS_ONE,
			'refer_key' => 'aid',
			'foreign_key' => 'aid'
		)
	);
	
	/**
	 * ����������Ŀ
	 * @access public
	 * @param String $where ����
	 * @return string
	 */
	function getCount($where = ""){
		$result = $this->get(array('fields'=>"count(*) as num", 'conditions' => $where, "limit"=>"0,1"));
		return $result["num"];
	}	
	
}