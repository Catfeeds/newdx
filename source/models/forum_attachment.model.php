<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
/**
 * forum_attachment ฤฃะอ
 * 
 * @author lxp 20130924
 */
class Forum_attachmentModel extends BaseModel {
	var $table = 'forum_attachment';
	var $alias = 'f_a';
	var $prikey = 'aid';
}