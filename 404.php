<?php
/**
 * 404 PAGE
 */

require './source/class/class_core.php';
$discuz = & discuz_core::instance();

$discuz->init();

$pageTitle = "404 Not Found";

//不显示底部广告
$nobottomad = false;

include template("common/404");
