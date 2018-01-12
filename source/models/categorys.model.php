<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class CategorysModel extends BaseModel
{
	var $table = 'plugin_categorys';
	var $prikey = 'cid';
	var $alias = 'cgs';
}
?>