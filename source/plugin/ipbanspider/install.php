<?php
/**
 * @author JiangHong
 * ������������ȫվ�ķ���ͳ�ƺͷ����档
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
$sql = <<<EOF
CREATE TABLE IF NOT EXISTS `pre_plugin_ipbanspider_rules` (
`rid`  smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(50) NOT NULL COMMENT '��������' ,
`pertime`  int(15) UNSIGNED NOT NULL COMMENT 'ʱ���' ,
`num`  int(5) UNSIGNED NOT NULL COMMENT 'ʱ����ڷ��ʴ���' ,
`bantime`  int(15) UNSIGNED NOT NULL COMMENT '���ʱ��' ,
`dateline`  int(10) UNSIGNED NOT NULL COMMENT '����ʱ��' ,
PRIMARY KEY (`rid`)
)
ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `pre_plugin_ipbanspider_spiders` (
`sid`  smallint(2) UNSIGNED NOT NULL AUTO_INCREMENT ,
`sname`  varchar(30) NOT NULL COMMENT '֩�����' ,
`friend`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '�Ƿ��Ѻ�' ,
`dateline`  int(10) UNSIGNED NOT NULL COMMENT '����ʱ��' ,
PRIMARY KEY (`sid`)
)
ENGINE=MyISAM;

EOF;
runquery($sql);
$finish = true;
?>