<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$myheader = <<<EOF

<li>
<a href="javascript:;" class="head_login_icon24_24"><span class="mjimg"></span></a>
<div class="mjwarpten" style="display:none;">
EOF;
 if(is_array($nuserlist)) foreach($nuserlist as $user) { 
$myheader .= <<<EOF
<a href="plugin.php?id=myrepeats:switch&amp;username={$user['uname']}&amp;formhash={$__FORMHASH}">{$user['name']}</a>

EOF;
 } 
$myheader .= <<<EOF

<a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=myrepeats:memcp">{$language['memcp']}</a>
</div>
</li>

EOF;
?>