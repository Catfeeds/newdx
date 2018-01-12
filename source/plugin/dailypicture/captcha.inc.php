<?php
require_once DISCUZ_ROOT.'/source/plugin/components/captcha/captcha.php';
$captcha = new Captcha(1);
$captcha->backColor = 0xfafafa;
$captcha->width = 80;
$captcha->height = 32;
$captcha->padding = 0;
$captcha->render();