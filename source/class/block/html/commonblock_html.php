<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: commonblock_html.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class commonblock_html {

	function fields() {
		return array();
	}

	function blockclass() {
		return array('html', lang('blockclass', 'blockclass_html_html'));
	}

}