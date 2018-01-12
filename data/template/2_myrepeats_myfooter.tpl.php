<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$myfooter = <<<EOF

<ul id="myrepeats_menu" class="p_pop" style="display:none;">
EOF;
 if(is_array($nuserlist)) foreach($nuserlist as $user) { 
$myfooter .= <<<EOF
<li><a href="plugin.php?id=myrepeats:switch&amp;username={$user['uname']}&amp;formhash={$__FORMHASH}">{$user['name']}</a></li>

EOF;
 } 
$myfooter .= <<<EOF

<li style="clear:both"><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=myrepeats:memcp">{$language['memcp']}</a></li></ul>

EOF;
?>