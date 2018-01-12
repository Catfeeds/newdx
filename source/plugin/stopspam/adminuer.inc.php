<?php
	
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: stopspam.class.php 16840 2011-03-15 08:19:59Z Niexinyuan $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

include_once 'function_stopspam.php';

$identifier = $plugin['identifier'];
$Plang = $scriptlang['stopspam'];

if(submitcheck('stopspamsubmit')) {	
	
	if($ids = dimplode($_G['gp_delete'])) {		
		$query = DB::query("SELECT uid FROM ".DB::table('stopspam_user')." WHERE id IN ($ids)");
		while($result = DB::fetch($query)) {			
            $uids[] = $result['uid'];
		}
		$uid = dimplode($uids);
		$query = DB::query("SELECT tid FROM ".DB::table('stopspam_thread')." WHERE authorid in ($uid)");
        while($result = DB::fetch($query)) {
			$tidlist[] = $result['tid'];
		}
		$tids = dimplode($tidlist);

		updatethread($tids, 'recover');       
        foreach($uids as $uid) {
            updateuser($uid, 'recover');
        }

        DB::delete('stopspam_thread', "tid IN ($tids)");		
		DB::delete('stopspam_user', "id IN ($ids)");
	}
	cpmsg($Plang['delete_success'], "action=plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer", 'succeed');
	
} elseif($_G['gp_op'] == 'recoveruser' && $_G['gp_opuid']) {		
	
	$query = DB::query("SELECT tid FROM ".DB::table('stopspam_thread')." WHERE authorid=$_G[gp_opuid]");
	while($result = DB::fetch($query)) {
	   $tidlist[] = $result['tid'];
	}
	$tids = dimplode($tidlist);
	updatethread($tids, 'recover');	
    DB::delete('stopspam_thread', "tid IN ($tids)");
	cpmsg($Plang['recover_success'], "action=plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer", 'succeed');	

} elseif($_G['gp_op'] == 'threadlist'){
    
    if(!submitcheck('delsubmit') && !submitcheck('undelsubmit')) {

        $ppp = 20;
        $startlimit = ($page - 1) * $ppp;          
        $sqladd = '1';
        $sqladd.= " AND s.authorid = '$_G[gp_opuid]'";
        $totalcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('stopspam_thread')." s WHERE $sqladd");
        showtableheader($Plang['threadlist']);
        showformheader("plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer&op=threadlist&uid=$_G[gp_opuid]", 'threadlistsubmit');
        showsubtitle(array('',$Plang['subject'], $Plang['forum'], $Plang['author'], $Plang['status'], $Plang['posttime']));
        if($totalcount) {
            $multipage = multi($totalcount, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer&op=threadlist&opuid=$_G[gp_opuid]");
            $query = DB::query("SELECT t.tid, t.authorid, t.author, t.dateline, t.subject, t.displayorder, t.fid, f.name FROM ".DB::table('forum_thread')." t LEFT JOIN ".DB::table('stopspam_thread')." s ON t.tid = s.tid 
                                LEFT JOIN ".DB::table('forum_forum')." f ON t.fid = f.fid WHERE $sqladd LIMIT $startlimit, $ppp");
            while($thread = DB::fetch($query)) {
                $dateline = dgmdate($thread['dateline'], 'dt');
                $state = $thread['displayorder'] == -1 ? '<span style="color:grey">'.$Plang['recycle'].'</span>' : '<span style="color:red">'.$Plang['verify'].'</span>';
                $subject = '<a href="forum.php?mod=viewthread&tid='.$thread['tid'].'" target="_blank">'.$thread['subject'].'</a>';
                $forum = '<a href="forum.php?mod=forumdisplay&fid='.$thread['fid'].'" target="_blank">'.$thread['name'].'</a>';
                $username = '<a href="admin.php?action=members&operation=group&uid='.$thread['authorid'].'" target="_blank">'.$thread['author'].'</a>';
                showtablerow('', array('class="td25"', '', '', '', '', '') , array("<input class=\"checkbox\" type=\"checkbox\" name=\"threadlist[]\" value=\"$thread[tid]\" $disabled>",
    			             $subject, $forum, $username, $state, $dateline));
            }        
        } 
        showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'threadlist\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;<input type="submit" class="btn" name="delsubmit" value="'.cplang('recyclebin_delete').'" />&nbsp;
                    <input type="submit" class="btn" name="undelsubmit" value="'.cplang('recyclebin_undelete').'" /><input type="checkbox" value="1" checked="1" id="isreoveruser" name="isreoveruser" style="margin-left:10px;vertical-align:middle;"/><label for="isreoveruser" style="vertical-align:middle;">'.$Plang['isreoveruser'].'</label>', $multipage);
        showformfooter();
        showtablefooter();
    } else {
        if(!$threadlist = $_G['gp_threadlist']) {
			cpmsg('recyclebin_none_selected', dreferer(), 'error');
		}
        $tids = dimplode($threadlist);
        $threadsundel = $threadsdel = 0;
        if(submitcheck('undelsubmit')) {
			$threadsundel = updatethread($tids, 'recover');
            DB::delete('stopspam_thread', "tid IN ($tids)");
            if($_G['gp_isreoveruser'] && $_G['gp_uid']) {
                updateuser($_G['gp_uid'], 'recover');
            }
		} elseif(submitcheck('delsubmit')) {
			require_once libfile('function/delete');
			$threadsdel = deletethread("tid IN (".dimplode($threadlist).")");
            DB::delete('stopspam_thread', "tid IN ($tids)");
		}        
        cpmsg('recyclebin_succeed', "action=plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer", 'succeed', array('threadsdel' => $threadsdel, 'threadsundel' => $threadsundel));
    }
       	
} else {
			
	$ppp = 20;
	$startlimit = ($page - 1) * $ppp;
	$sqladd = '1';

    if($ctime = $_G['gp_ctime']) {
        $sqladd .= " AND `bandate` >= '".(TIMESTAMP - 86400 * $ctime)."'";
        $checkctime[$ctime] = "selected = '1'";
    }	
	showtableheader($Plang['userlist'].
				'&nbsp&nbsp<select onchange="if(this.options[this.selectedIndex].value != \'\') {window.location=\''.ADMINSCRIPT.'?action=plugins&&operation=config&do='.$pluginid.'&identifier='.$identifier.'&pmod=adminuer&ctime=\'+this.options[this.selectedIndex].value }">
				<option value="0" '.$checkctime[0].'> '.$Plang['all_user'].'</option><option value="1" '.$checkctime[1].'> '.$Plang['day_user'].' </option><option value="7" '.$checkctime[7].'>'.$Plang['week_user'].'</option><option value="30" '.$checkctime[30].'>'.$Plang['month_user'].'</option></select>');
	showformheader("plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer", 'stopspamsubmit');
	showsubtitle(array('',$Plang['userid'], $Plang['username'], $Plang['state'], $Plang['lastsubject'], $Plang['bandate'], $Plang['dispose']));
	$totalcount = DB::result_first("SELECT count(*) FROM ".DB::table('stopspam_user')." WHERE $sqladd");
	if ($totalcount) {
		$multipage = multi($totalcount, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=$identifier&pmod=adminuer&ctime=$ctime");
		$query = DB::query("SELECT a.id, a.uid, a.username, a.lastsubject, a.bandate, a.dispose, b.groupid, b.groupexpiry FROM ".DB::table('stopspam_user')." a, ".DB::table('common_member')." b WHERE $sqladd AND a.uid = b.uid ORDER BY a.id DESC LIMIT $startlimit, $ppp");
		while ($usrinfo = DB::fetch($query)) {
			switch ($usrinfo['groupid']) {
				case 4 : $state = '<span style="color:red">'.$Plang['banedpost'].'</span>';break;
				case 5 : $state = '<span style="color:grey">'.$Plang['banedvisit'].'</span>';break;	
				default : $state = '<span style="color:green">'.$Plang['normal'].'</span>';break;
			}
            $link = '<a href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier='.$identifier.'&pmod=adminuer&op=threadlist&opuid='.$usrinfo['uid'].'">'.$Plang['chkpost'].'</a>';
			$username = '<a href="admin.php?action=members&operation=group&uid='.$usrinfo[uid].'" target="_blank">'.$usrinfo['username'].'</a>';
			$bandate = dgmdate($usrinfo['bandate'], 'dt');
			showtablerow('', array('class="td25"', '', '', '', '', '', '') , array("<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$usrinfo[id]\" $disabled>",
				$usrinfo['uid'], $username, $state, $usrinfo['lastsubject'], $bandate, $link));
		}
	}
	showsubmit('stopspamsubmit', 'submit', 'del', '', $multipage, false);
	showformfooter();
	showtablefooter();	
	
}

?>