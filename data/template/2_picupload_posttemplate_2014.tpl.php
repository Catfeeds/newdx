<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$return = <<<EOF

<a class="imgfl" href="plugin.php?id=picupload&amp;fid={$_G['fid']}
EOF;
 if($authorid == $_G['uid']) { if($_G['gp_tid']) { 
$return .= <<<EOF
&amp;tid={$_G['gp_tid']}&amp;action=reply
EOF;
 } } 
$return .= <<<EOF
" onclick="return confirm('{$str}')"></a>

EOF;
?>