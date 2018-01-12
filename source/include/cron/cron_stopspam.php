<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cron_stopspam.php 21547 2011-03-31 03:55:35Z Nie xinyuan $
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT s.uid FROM ".DB::table('stopspam_user')." s LEFT JOIN ".DB::table('common_member')." m ON s.uid=m.uid 
                    WHERE m.groupid NOT IN ('4', '5')");
while($user = DB::fetch($query)){
    $uidlist[] = $user['uid'];
}                   
$uids = dimplode($uidlist);
if($uids) {
    DB::delete('stopspam_user', "uid IN ($uids)");
}
$query = DB::query("SELECT s.tid FROM ".DB::table('stopspam_thread')." s LEFT JOIN ".DB::table('forum_thread')." t ON s.tid=t.tid
                    WHERE t.displayorder >= 0");
while($thread = DB::fetch($query)){
    $tidlist[] = $thread['tid'];
} 
$tids = dimplode($tidlist);
if($tids) {
    DB::delete('stopspam_thread', "tid IN ($tids)");
}

?>