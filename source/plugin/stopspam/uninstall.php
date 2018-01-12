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

DROP TABLE pre_stopspam_user;
DROP TABLE pre_stopspam_thread;

EOF;

runquery($sql);

$finish = TRUE;