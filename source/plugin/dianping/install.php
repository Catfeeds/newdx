<?php
if(!defined('IN_DISCUZ')) {
	exit('Access denied');
}
$sql = <<<EOT
CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_modules` (
  `mid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL,
  `mname` varchar(50) NOT NULL COMMENT '模块名称',
  `status` tinyint(2) NOT NULL DEFAULT '-1' COMMENT '模块状态（-1为开发中，0为关闭，1为开启）',
  `asktime` int(10) NOT NULL COMMENT '申请时间',
  `finishtime` int(10) NOT NULL COMMENT '开发完成时间',
  `comment` text COMMENT '备注说明',
  `modules` varchar(150) NOT NULL DEFAULT '' COMMENT '模块',
  `authorid` int(10) NOT NULL,
  `authorname` varchar(15) NOT NULL,
  `close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是驳回',
  `reason` text COMMENT '驳回原因',
  `templates` text COMMENT '模板的参数',
  `srcid` varchar(50) NOT NULL COMMENT '标识',
  `maxcount` int(10) NOT NULL DEFAULT '0' COMMENT '模块内商品的数量',
  `listlimit` tinyint(2) NOT NULL DEFAULT '10' COMMENT '列表页分页的数量',
  `commentlimit` tinyint(2) NOT NULL DEFAULT '10' COMMENT '评论列表分页数量',
  `otherlimit` tinyint(2) NOT NULL DEFAULT '4' COMMENT '侧边列表分页数量（热门列表，同城列表等）',
  `settings` text COMMENT '模块内的其他设置信息，用序列化保存',
  `title` text,
  `keyword` text,
  `description` text,
  PRIMARY KEY (`mid`),
  KEY `fid` (`fid`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `close` (`close`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk COMMENT='点评的总模块表，存储当前的所有模块';

CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_mains` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mid` mediumint(8) NOT NULL COMMENT '模块ID',
  `tid` int(10) NOT NULL COMMENT '关联的tid',
  `name` char(80) NOT NULL COMMENT '名称',
  `pic` varchar(200) DEFAULT NULL COMMENT '首图地址',
  `pro` mediumint(8) DEFAULT NULL COMMENT '地区码',
  `enable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否前台可见',
  `serverid` tinyint(2) NOT NULL DEFAULT '0' COMMENT '保存的附件服务器id',
  `score` float(4,1) NOT NULL DEFAULT '0.0' COMMENT '评分',
  `orderby` tinyint(2) NOT NULL DEFAULT '0' COMMENT '排序权重',
  `num` int(10) NOT NULL DEFAULT '0' COMMENT '评论的人数',
  `url` varchar(250) DEFAULT NULL COMMENT '网站主页',
  `phone` mediumint(20) DEFAULT NULL COMMENT '电话',
  `address` varchar(250) DEFAULT NULL COMMENT '地区',
  `typeclass` varchar(500) DEFAULT NULL COMMENT '分类ID组',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `pro` (`pro`) USING BTREE,
  KEY `enable` (`enable`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_support` (
  `fid` mediumint(8) NOT NULL COMMENT '帖子fid',
  `tid` mediumint(8) NOT NULL COMMENT '帖子tid',
  `pid` int(10) NOT NULL COMMENT '帖子pid',
  `uid` int(10) NOT NULL COMMENT '用户uid',
  `username` varchar(15) NOT NULL COMMENT '用户名',
  `ip` varchar(15) NOT NULL COMMENT '用户ip',
  `dateline` int(10) NOT NULL COMMENT '时间戳',
  `good` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否为赞（为以后可能会出现的不赞成做铺垫）',
  PRIMARY KEY (`pid`,`uid`),
  KEY `tid` (`tid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

CREATE TABLE IF NOT EXISTS `pre_plugin_dianping_childmodules` (
  `mdid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `keyname` varchar(30) NOT NULL COMMENT '模块对应的键名',
  `mdname` varchar(50) NOT NULL COMMENT '模块名称',
  `mdenable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '模块状态',
  PRIMARY KEY (`mdid`),
  KEY `mdenable` (`mdenable`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk;

INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('1', 'pic', '图片', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('2', 'pro', '地区', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('3', 'url', '网址', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('4', 'phone', '电话', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('5', 'address', '地址', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('6', 'map', '地图', '1');
INSERT INTO `pre_plugin_dianping_childmodules` VALUES ('7', 'typeclass', '分类', '1');

EOT;

runquery($sql);
$finish = true;
?>
