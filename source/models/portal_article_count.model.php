<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/** 
 * @author Lishuaiquan
 */
class Portal_article_countModel extends BaseModel {
	var $table = 'portal_article_count';
	var $alias = 'p_a_c';
	var $prikey = 'aid';	
}