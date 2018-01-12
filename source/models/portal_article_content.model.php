<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * portal_article_content ฤฃะอ
 * 
 * @author lxp 20131104
 */
class Portal_article_contentModel extends BaseModel {
	var $table = 'portal_article_content';
	var $alias = 'p_a_c';
	var $prikey = 'cid';
}