1、首先在数据库中创建表
2、把domainset放在plugin下解压
3、找到template\default\common下header.htm, 在第一行下边添加
   <!--{eval include DISCUZ_ROOT.'./source/plugin/domainset/indomain.php';}--> 