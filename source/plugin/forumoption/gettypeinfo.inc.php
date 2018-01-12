<?php
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';


$brandData = ForumOptionProduce::getTypeNextData($_GET['td']);
echo json_encode($brandData);



