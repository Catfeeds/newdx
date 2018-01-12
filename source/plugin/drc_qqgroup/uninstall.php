<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE cdb_drc_qqgroups;
DROP TABLE cdb_drc_qqgroup_type;

EOF;

runquery($sql);

$finish = TRUE;