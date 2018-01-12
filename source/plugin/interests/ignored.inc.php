<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

$uid = $_G['uid'];
$lineid = $_G['gp_lineid'];
$linepos = $_G['gp_linepos'];
$msgid = $_G['gp_msgid'];
require_once dirname(__FILE__) . '/model/historymod.php';
if($lineid > 0 && $uid > 0 && $linepos > 0)
{	
	historymod::recordhistory($uid, $lineid, $_G['clientip'], $linepos, 0);
}
if($_G['inajax']){
include template('common/header_ajax');
?>
<script>
$('fwin_a_note_line_<?php echo $lineid; ?>').remove();
$('notice_node_<?php echo $msgid ?>').remove();
if(jQuery('.notelist').children('li').length == 0){
	location.reload();
}	
</script>
<?php
include template('common/footer_ajax');
}else{
	exit('1');
}
?>