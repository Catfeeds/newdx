<?php
if(!defined('IN_DISCUZ')) {
	exit('Access denied');
}
$sql = <<<EOT
CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_modules` (
  `mid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL,
  `mname` varchar(50) NOT NULL COMMENT 'ģ������',
  `status` tinyint(2) NOT NULL DEFAULT '-1' COMMENT 'ģ��״̬��-1Ϊ�����У�0Ϊ�رգ�1Ϊ������',
  `asktime` int(10) NOT NULL COMMENT '����ʱ��',
  `finishtime` int(10) NOT NULL COMMENT '�������ʱ��',
  `comment` text COMMENT '��ע˵��',
  `modules` varchar(150) NOT NULL DEFAULT '' COMMENT 'ģ��',
  `authorid` int(10) NOT NULL,
  `authorname` varchar(15) NOT NULL,
  `close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '�Ƿ��ǲ���',
  `reason` text COMMENT '����ԭ��',
  `templates` text COMMENT 'ģ��Ĳ���',
  `srcid` varchar(50) NOT NULL COMMENT '��ʶ',
  `maxcount` int(10) NOT NULL DEFAULT '0' COMMENT 'ģ������Ʒ������',
  `listlimit` tinyint(2) NOT NULL DEFAULT '10' COMMENT '�б�ҳ��ҳ������',
  `commentlimit` tinyint(2) NOT NULL DEFAULT '10' COMMENT '�����б��ҳ����',
  `otherlimit` tinyint(2) NOT NULL DEFAULT '4' COMMENT '����б��ҳ�����������б�ͬ���б�ȣ�',
  `settings` text COMMENT 'ģ���ڵ�����������Ϣ�������л�����',
  `title` text,
  `keyword` text,
  `description` text,
  PRIMARY KEY (`mid`),
  KEY `fid` (`fid`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `close` (`close`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk COMMENT='��������ģ����洢��ǰ������ģ��';

CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_mains` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mid` mediumint(8) NOT NULL COMMENT 'ģ��ID',
  `tid` int(10) NOT NULL COMMENT '������tid',
  `name` char(80) NOT NULL COMMENT '����',
  `pic` varchar(200) DEFAULT NULL COMMENT '��ͼ��ַ',
  `pro` mediumint(8) DEFAULT NULL COMMENT '������',
  `enable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '�Ƿ�ǰ̨�ɼ�',
  `serverid` tinyint(2) NOT NULL DEFAULT '0' COMMENT '����ĸ���������id',
  `score` float(4,1) NOT NULL DEFAULT '0.0' COMMENT '����',
  `orderby` tinyint(2) NOT NULL DEFAULT '0' COMMENT '����Ȩ��',
  `num` int(10) NOT NULL DEFAULT '0' COMMENT '���۵�����',
  `url` varchar(250) DEFAULT NULL COMMENT '��վ��ҳ',
  `phone` mediumint(20) DEFAULT NULL COMMENT '�绰',
  `address` varchar(250) DEFAULT NULL COMMENT '����',
  `typeclass` varchar(500) DEFAULT NULL COMMENT '����ID��',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `pro` (`pro`) USING BTREE,
  KEY `enable` (`enable`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_support` (
  `fid` mediumint(8) NOT NULL COMMENT '����fid',
  `tid` mediumint(8) NOT NULL COMMENT '����tid',
  `pid` int(10) NOT NULL COMMENT '����pid',
  `uid` int(10) NOT NULL COMMENT '�û�uid',
  `username` varchar(15) NOT NULL COMMENT '�û���',
  `ip` varchar(15) NOT NULL COMMENT '�û�ip',
  `dateline` int(10) NOT NULL COMMENT 'ʱ���',
  `good` tinyint(1) NOT NULL DEFAULT '1' COMMENT '�Ƿ�Ϊ�ޣ�Ϊ�Ժ���ܻ���ֵĲ��޳����̵棩',
  PRIMARY KEY (`pid`,`uid`),
  KEY `tid` (`tid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_childmodules` (
  `mdid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `keyname` varchar(30) NOT NULL COMMENT 'ģ���Ӧ�ļ���',
  `mdname` varchar(50) NOT NULL COMMENT 'ģ������',
  `mdenable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'ģ��״̬',
  PRIMARY KEY (`mdid`),
  KEY `mdenable` (`mdenable`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('1', 'pic', 'ͼƬ', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('2', 'pro', '����', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('3', 'url', '��ַ', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('4', 'phone', '�绰', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('5', 'address', '��ַ', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('6', 'map', '��ͼ', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('7', 'typeclass', '����', '1');

EOT;

runquery($sql);
$finish = true;
?>
