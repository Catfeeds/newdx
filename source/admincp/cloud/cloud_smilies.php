<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cloud_smilies.php 22725 2011-05-18 06:45:29Z monkey $
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

cpheader();

$_G['gp_anchor'] = in_array($_G['gp_anchor'], array('base')) ? $_G['gp_anchor'] : 'base';

shownav('navcloud', 'cloud_smilies');

showsubmenu('cloud_smilies');
showtips('cloud_smilies_tips');

?>