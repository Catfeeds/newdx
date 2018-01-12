<?php
/**
 * @author JiangHong
 * 本程序用于做全站的访问统计和防爬虫。
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_plugin_ipbanspider_rules` (
`rid`  smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(50) NOT NULL COMMENT '规则名称' ,
`pertime`  int(15) UNSIGNED NOT NULL COMMENT '时间段' ,
`num`  int(5) UNSIGNED NOT NULL COMMENT '时间段内访问次数' ,
`bantime`  int(15) UNSIGNED NOT NULL COMMENT '封号时间' ,
`dateline`  int(10) UNSIGNED NOT NULL COMMENT '加入时间' ,
PRIMARY KEY (`rid`)
)
ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `pre_plugin_ipbanspider_spiders` (
`sid`  smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT ,
`sname`  varchar(30) NOT NULL COMMENT '蜘蛛的名' ,
`friend`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否友好' ,
`dateline`  int(10) UNSIGNED NOT NULL COMMENT '加入时间' ,
PRIMARY KEY (`sid`)
)
ENGINE=MyISAM;

EOF;
runquery($sql);
$finish = true;
?>