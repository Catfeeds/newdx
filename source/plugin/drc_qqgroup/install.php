<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF

DROP TABLE IF EXISTS cdb_drc_qqgroups;
CREATE TABLE cdb_drc_qqgroups (
  `id` int(10) NOT NULL auto_increment,
  `num` varchar(255) NOT NULL,
  `name` char(50) NOT NULL,
  `typeid` tinyint(4) NOT NULL,
  `intro` text NOT NULL,
  `creator` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  `display` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS cdb_drc_qqgroup_type;
CREATE TABLE cdb_drc_qqgroup_type (
  `id` tinyint(4) NOT NULL auto_increment,
  `typename` char(50) NOT NULL,
  `displayorder` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

EOF;

runquery($sql);

$finish = TRUE;

?>