<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include(DISCUZ_ROOT . '/source/8264/launcher.php');
include(DISCUZ_ROOT . '/source/8264/model/model.base.php');

$mod = m('templatesrv');
$models = $mod->getmodels();

include template("templatesrv:main");
?>