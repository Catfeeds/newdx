<?php
/**
 * @author JiangHong
 * @copyright 2014
 * @todo 用于对样式版本记录，并在相应的样式前增加相应的版本号标识
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include(DISCUZ_ROOT . '/source/8264/launcher.php');
include(DISCUZ_ROOT . '/source/8264/model/model.base.php');

include template('StyleManager:mains');
