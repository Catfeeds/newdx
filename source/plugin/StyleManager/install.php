<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_plugin_css_cache` (
  `filename` varchar(300) NOT NULL COMMENT 'css文件的名称',
  `values` longtext COMMENT 'css的内容',
  `dateline` int(10) NOT NULL COMMENT '最后修改时间',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'css的类型（1为主css，0为通过module分解出的小css）',
  PRIMARY KEY (`filename`),
  KEY `type` (`type`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='在更新缓存时，将缓存生成的cache保存在此表中，注意：此表中为28个css（module将在后续分解后插入此表）';
DROP TABLE IF EXISTS `pre_plugin_style_manager`;
CREATE TABLE `pre_plugin_style_manager` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mod` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=253 DEFAULT CHARSET=gbk COMMENT='用于记录样式的模块名';
INSERT INTO `pre_plugin_style_manager` VALUES ('1', 'home', 'task');
INSERT INTO `pre_plugin_style_manager` VALUES ('2', 'search', 'forum');
INSERT INTO `pre_plugin_style_manager` VALUES ('3', 'member', 'logging');
INSERT INTO `pre_plugin_style_manager` VALUES ('4', 'group', 'viewthread');
INSERT INTO `pre_plugin_style_manager` VALUES ('5', 'forum', 'index');
INSERT INTO `pre_plugin_style_manager` VALUES ('6', 'forum', 'rss');
INSERT INTO `pre_plugin_style_manager` VALUES ('7', 'member', 'connect');
INSERT INTO `pre_plugin_style_manager` VALUES ('9', 'home', 'magic');
INSERT INTO `pre_plugin_style_manager` VALUES ('10', 'member', 'getpasswd');
INSERT INTO `pre_plugin_style_manager` VALUES ('11', 'home', 'medal');
INSERT INTO `pre_plugin_style_manager` VALUES ('12', 'member', 'lostpasswd');
INSERT INTO `pre_plugin_style_manager` VALUES ('13', 'group', 'forumdisplay');
INSERT INTO `pre_plugin_style_manager` VALUES ('14', 'forum', 'image');
INSERT INTO `pre_plugin_style_manager` VALUES ('15', 'portal', 'view');
INSERT INTO `pre_plugin_style_manager` VALUES ('16', 'member', 'switchstatus');
INSERT INTO `pre_plugin_style_manager` VALUES ('17', 'forum', 'post');
INSERT INTO `pre_plugin_style_manager` VALUES ('18', 'forum', 'topicadmin');
INSERT INTO `pre_plugin_style_manager` VALUES ('19', 'group', 'my');
INSERT INTO `pre_plugin_style_manager` VALUES ('21', 'home', 'misc');
INSERT INTO `pre_plugin_style_manager` VALUES ('22', 'forum', 'misc');
INSERT INTO `pre_plugin_style_manager` VALUES ('23', 'portal', 'portalcp');
INSERT INTO `pre_plugin_style_manager` VALUES ('24', 'forum', 'trade');
INSERT INTO `pre_plugin_style_manager` VALUES ('25', 'misc', 'invite');
INSERT INTO `pre_plugin_style_manager` VALUES ('26', 'forum', 'modcp');
INSERT INTO `pre_plugin_style_manager` VALUES ('27', 'forum', 'viewthread');
INSERT INTO `pre_plugin_style_manager` VALUES ('28', 'member', 'register');
INSERT INTO `pre_plugin_style_manager` VALUES ('30', 'group', 'index');
INSERT INTO `pre_plugin_style_manager` VALUES ('31', 'portal', 'comment');
INSERT INTO `pre_plugin_style_manager` VALUES ('32', 'home', 'spacecp');
INSERT INTO `pre_plugin_style_manager` VALUES ('33', 'forum', 'forumdisplay');
INSERT INTO `pre_plugin_style_manager` VALUES ('34', 'misc', 'stat');
INSERT INTO `pre_plugin_style_manager` VALUES ('35', 'search', 'curforum');
INSERT INTO `pre_plugin_style_manager` VALUES ('37', 'forum', 'attachment');
INSERT INTO `pre_plugin_style_manager` VALUES ('38', 'group', 'post');
INSERT INTO `pre_plugin_style_manager` VALUES ('39', 'forum', 'announcement');
INSERT INTO `pre_plugin_style_manager` VALUES ('40', 'misc', 'ranklist');
INSERT INTO `pre_plugin_style_manager` VALUES ('41', 'home', 'space');
INSERT INTO `pre_plugin_style_manager` VALUES ('42', 'group', 'misc');
INSERT INTO `pre_plugin_style_manager` VALUES ('43', 'group', 'group');

EOF;
runquery($sql);
$finish = TRUE;
?>
