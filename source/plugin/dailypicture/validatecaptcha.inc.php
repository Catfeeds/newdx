<?php
require_once DISCUZ_ROOT.'/source/plugin/components/captcha/captcha.php';
if ($_GET['captcha']) {
    $captcha = new Captcha(1);
    echo $captcha->validate($_GET['captcha']) ? 1 : 0;
    exit;
}
echo 0;