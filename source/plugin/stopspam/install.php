<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: install.php 8889 2011-03-16 12:48:22Z Nie xinyuan $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

CREATE TABLE `pre_stopspam_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(15) NOT NULL DEFAULT '',
  `lastsubject` char(80) NOT NULL,
  `bandate` int(10) unsigned NOT NULL DEFAULT '0',
  `dispose` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`uid`,`username`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS pre_stopspam_thread;
CREATE TABLE `pre_stopspam_thread` (
  `tid` mediumint(8) NOT NULL,
  `authorid` mediumint(8) NOT NULL,
  KEY `tid` (`tid`),
  KEY `authorid` (`authorid`)
) ENGINE=MyISAM;

EOF;

runquery($sql);

$finish = TRUE;

?>