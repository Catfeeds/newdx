<?php
	
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: update.php 16840 2011-06-10 08:19:59Z Niexinyuan $
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_G['gp_fromversion'] == '1.0') {
	$sql = <<<EOF
RENAME TABLE `pre_stopspam` TO `pre_stopspam_user`;
EOF;
	runquery($sql);
	
	$sql = <<<EOF
ALTER TABLE `pre_stopspam_user` ADD `lastsubject` CHAR(80) NOT NULL AFTER `username`;
EOF;
	runquery($sql);
	
	
	$sql = <<<EOF
	CREATE TABLE `pre_stopspam_thread` (
	  `tid` mediumint(8) NOT NULL,
	  `authorid` mediumint(8) NOT NULL,
	  KEY `tid` (`tid`),
	  KEY `authorid` (`authorid`)
	) ENGINE=MyISAM;
EOF;
	runquery($sql);
}


$finish = TRUE;

?>