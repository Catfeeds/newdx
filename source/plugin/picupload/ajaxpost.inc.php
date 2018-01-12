<?php
/**
 * @author JiangHong
 * ajax方式来处理分楼发帖
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$returnjson = array('error' => 1);
if ($_POST) {
	$allowgroup = unserialize($_G['cache']['plugin']['picupload']['postgroup']);
	$allowforum = unserialize($_G['cache']['plugin']['picupload']['postforum']);
	$maxpic = $_G['cache']['plugin']['picupload']['maxpic'] > 0 ? $_G['cache']['plugin']['picupload']['maxpic'] : 50;
	if ($_G['groupid'] != 1 && ! in_array($_G['groupid'], $allowgroup)) {
		// $returnjson['why'] = lang('message','postperm_login_nopermission');
		$returnjson['why'] = '您当前的用户组 ( '.$_G['group']['grouptitle'].' )，不能执行此操作。';
	} elseif ($_G['formhash'] != $_G['gp_formhash']) {
		$returnjson['why'] = lang('message', 'submit_invalid');
	} elseif (empty($_G['gp_fid'])) {
		$returnjson['why'] = lang('message', 'forum_nonexistence');
	} elseif (! $_G['uid']) {
		$returnjson['why'] = lang('message', 'postperm_login_nopermission');
	} else {
		$_G['fid'] = $_G['gp_fid'];
		include libfile('function/forum');
		include libfile('function/post');
		loadforum();
		set_rssauth();
		runhooks();
                if(periodscheck('postmodperiods', 0)) {
                    $modnewthreads = $modnewreplies = 1;

                } else {
                        $censormod = censormod($subject."\t".$message);

                        $modnewthreads = (!$_G['group']['allowdirectpost'] || $_G['group']['allowdirectpost'] == 1) && $_G['forum']['modnewposts'] || $censormod ? 1 : 0;
                        $modnewreplies = (!$_G['group']['allowdirectpost'] || $_G['group']['allowdirectpost'] == 2) && $_G['forum']['modnewposts'] == 2 || $censormod ? 1 : 0;
                }
		if (! in_array($_G['fid'], $allowforum)) {
			$returnjson['why'] = '当前版块 ( '.$_G['forum']['name'].' ) 未开放此功能。';
		} elseif (! $_G['uid'] && ! ((! $_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
			$returnjson['why'] = lang('message', 'postperm_login_nopermission');
		} elseif (empty($_G['forum']['allowpost'])) {
			if (! $_G['forum']['postperm'] && ! $_G['group']['allowpost']) {
				$returnjson['why'] = lang('message', 'postperm_none_nopermission');
			} elseif ($_G['forum']['postperm'] && ! forumperm($_G['forum']['postperm'])) {
				$returnjson['why'] = lang('message', 'forum_access_disallow');
			}
		} elseif ($_G['forum']['allowpost'] == -1) {
			$returnjson['why'] = lang('message', 'post_forum_newthread_nopermission');
		}
		if (empty($returnjson['why'])) {
			if (! $_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
				$returnjson['why'] = lang('message', 'postperm_login_nopermission');
			} else {
				if ($limit = checklowerlimit('post', 0, 1, $_G['forum']['fid'], 1) !== true) {
					include_once libfile('class/credit');
					$credit = &credit::instance();
					$rule = $credit->getrule('post', $_G['fid']);
					$lowerlimit = is_array($action) && $action['extcredits'.$limit] ? abs($action['extcredits'.$limit]) + $_G['setting']['creditspolicy']['lowerlimit'][$limit] : $_G['setting']['creditspolicy']['lowerlimit'][$limit];
					foreach ($_G['setting']['extcredits'] as $extcreditid => $extcredit) {
						if ($rule['extcredits'.$extcreditid]) {
							$rulecredit[] = $extcredit['title'].($rule['extcredits'.$extcreditid] > 0 ? '+'.$rule['extcredits'.$extcreditid] : $rule['extcredits'.$extcreditid]);
						}
					}
					$returnjson['why'] = '对不起，本版块'.$rule['rulename'].' '.implode(', ', $rulecredit).'，本操作后你的'.$_G['setting']['extcredits'][$limit]['title'].'将不足 '.$lowerlimit.' '.$_G['setting']['extcredits'][$limit]['unit'].'，请返回。';
				} else {
					if (! $_G['adminid'] && $_G['setting']['newbiespan'] && (! getuserprofile('lastpost') || TIMESTAMP - getuserprofile('lastpost') < $_G['setting']['newbiespan'] * 60)) {
						if (TIMESTAMP - (DB::result_first("SELECT regdate FROM ".DB::table('common_member')." WHERE uid='$_G[uid]'")) < $_G['setting']['newbiespan'] * 60) {
							$returnjson['why'] = '对不起，你只在注册时间起 '.$_G['setting']['newbiespan'].' 分钟后才有发帖权限，请返回。';
						}
					}
					$postimage = $_G['gp_attachnew'];
					if (empty($postimage))
						$returnjson['why'] = ($_G['cache']['plugin']['picupload']['nopic_upload'] ? $_G['cache']['plugin']['picupload']['nopic_upload'] : '没有提交任何图片,不能进行分楼操作');
					$subject = iconv('UTF-8', 'gbk', $_G['gp_subject']);
                                        $censor = censor_ajax($subject);
                                        if($censor == 1){
                                            $returnjson['why'] = '对不起，你填写的内容包含不良信息而无法提交，请返回修改';
                                        }else{
                                            $subject = $censor;
                                        }
					$typeid = $_G['gp_typeid'];
					$posttime = $_G['gp_posttime'];
					$action = $_G['gp_action'] ? $_G['gp_action'] : 'reply';
					$tid = $_G['gp_tid'] ? $_G['gp_tid'] : 0;
					$first = 0;
					$deleteattach = array();
					if ($action == 'replay' && $tid == 0)
						$returnjson['why'] = lang('message', 'undefined_action');
					if ($action == 'newthread' && trim($subject) == '')
						$returnjson['why'] = lang('message', 'post_sm_isnull');
					if ($action == 'newthread' && strlen($subject) > 80)
						$returnjson['why'] = lang('message', 'post_subject_toolong');
					if ($action == 'newthread' && $_G['forum']['threadtypes'] && $typeid == 0)
						$returnjson['why'] = lang('message', 'post_sort_isnull');
					if (checkflood()) {
//						$returnjson['why'] = '对不起，您两次发表间隔少于 '.$_G['setting']['floodctrl'].' 秒，请稍后再发表。';
					} elseif (checkmaxpostsperhour()) {
						$returnjson['why'] = '对不起，您所在的用户组每小时限制发帖 '.$_G['group']['maxpostsperhour'].' 个，请稍后再发表';
					}
					$readperm = $_G['group']['allowsetreadperm'] ? $readperm : 0;
					$usesig = ! empty($_G['gp_usesig']) && $_G['group']['maxsigsize'] ? 1 : 0;
					$newalbum = 0;
					if ($_G['gp_savetoalbum'] == 1) {
						$_G['gp_newalbumname'] = trim(iconv('UTF-8', 'gbk', $_G['gp_newalbumname']));
						if (! $_G['gp_albumid']) {
							if (empty($_G['gp_newalbumname'])) {
								$returnjson['why'] = '对不起，您选择保存为相册并建立新相册，但相册名为空，请确认！';
							} else {
								require_once libfile('function/spacecp');
								$_G['gp_albumid'] = album_creat(array('albumname' => $_G['gp_newalbumname']));
								$newalbum = 1;
							}
						}
						if (! $_G['gp_albumid'])
							$returnjson['why'] = '对不起，您选择保存为相册但未选取相册，请确认！';
						$returnjson['albumid'] = $_G['gp_albumid'];
					}
				}
			}
		}
		if (empty($returnjson['why'])) {
			$allimage = $_G['gp_attachimage'];
			$query = DB::query("SELECT * FROM ".DB::table('forum_attachment')." WHERE aid IN(".dimplode($allimage).");");
			while ($value = DB::fetch($query)) {
				$attach[$value['aid']] = $value;
			}
                        $_G['gp_save'] = $_G['uid'] ? $_G['gp_save'] : 0;
                        $displayorder = $modnewthreads ? -2 : ( ( $_G['forum']['ismoderator'] && ! empty( $_G['gp_sticktopic'] ) ) ? 1 : ( empty( $_G['gp_save'] ) ? 0 : -4 ) );
			$picnum = 0;
			foreach ($postimage as $attachid => $attachoption) {
				if ($attachoption['delete']) {
					$deleteattach[] = $attachid;
					continue;
				}
				$forumsave = 1;
				$message = iconv('UTF-8', 'gbk', $attachoption['description']);
                                $message = censor($message);
				(strpos($message, '[/img]') || strpos($message, '[/flash]')) && $message = preg_replace("/\[img[^\]]*\].+?\[\/img\]|\[flash[^\]]*\].+?\[\/flash\]/is", '', $message);
				$message = preg_replace("/((https?|ftp|gopher|news|telnet|rtsp|mms|callto):\/\/|www\.)([a-z0-9\/\-_+=.~!%@?#%&;:$\\()|]+\s*)/i", '', $message);
				$message = htmlspecialchars($message, ENT_COMPAT, 'GB2312');
				if ($attachoption['type'] == 'album') {
					if($newalbum == 1) $newalbum = 0;
					if ($attachoption['url']) {
						$forumsave = false;
						$attachtag = '[img]'.$attachoption['url'].'[/img]';
					} else {
						continue;
					}
				} else {
					$_G['forum_attachexist'] = 1;
					$attachtag = '[attach]'.$attachid.'[/attach]';
				}
				if ($picnum >= $maxpic)
					continue;
				$picnum++;
                                

                                //添加过滤
                                $pattern = "[img=1,1";
                                if ( strstr( $message, $pattern ) )
                                {
                                        $displayorder = $modnewthreads = -2;
                                }
                                $pattern1 = "[flash=1,1";
                                if ( strstr( $message, $pattern1 ) )
                                {
                                        $displayorder = $modnewthreads = -2;
                                }
                                //end
                                if ( $displayorder == -2 )
                                {
                                        /* debug
                                        * $has_moderated = $_G['cookie']['has_moderated'];
                                        * $has_moderated_arr = explode('|', $has_moderated);
                                        * if(!in_array($_G['fid'], $has_moderated_arr)) {
                                        * $has_moderated_arr[] = $_G['fid'];
                                        * }
                                        * dsetcookie('has_moderated', implode('|', $has_moderated_arr), 86400);*/
                                        DB::update( 'forum_forum', array( 'modworks' => '1' ), "fid='{$_G['fid']}'" );
                                        //start 记录修改版块操作
                                        addrecordforuminfo( $_G['fid'], 3 );
                                        //end
                                }
                                elseif ( $displayorder == -4 )
                                {
                                        $_G['gp_addfeed'] = 0;
                                }
                                
                                $pinvisible = $modnewthreads ? -2 : ( empty( $_G['gp_save'] ) ? 0 : -3 );
                                
				$message = $_G['gp_beforeattach'] ? $message.'\n\n'.$attachtag : $attachtag.'\n\n'.$message;
				$newthread = 0;
				$doaction = 'reply';
				if ($first == 0 && $action == 'newthread') {
					$firstmessage = $message;
					$newthread = 1;
					$doaction = 'post';
					$posttableid = getposttableid('p');
					$thread['status'] = 0;
					$_G['gp_reply_notice'] && $thread['status'] = setstatus(6, 1, $thread['status']);
					DB::query("INSERT INTO ".DB::table('forum_thread')." (fid, posttableid, readperm, price, typeid, sortid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup) VALUES "
                                                . "('$_G[fid]', '$posttableid', '$readperm', '', '$typeid', '', '$_G[username]', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$_G[username]', '$displayorder', '', '', '2', '', '$thread[status]', '')");
					$tid = DB::insert_id();
				}
				$pid = insertpost(array(
					'fid' => $_G['fid'],
					'tid' => $tid,
					'first' => $newthread,
					'author' => $_G['username'],
					'authorid' => $_G['uid'],
					'subject' => $newthread ? $subject : '',
					'dateline' => $_G['timestamp'],
					'message' => $message,
					'useip' => $_G['clientip'],
					'invisible' => '',
					'anonymous' => '',
					'usesig' => $usesig,
					'htmlon' => '',
					'bbcodeoff' => '',
					'smileyoff' => '',
					'parseurloff' => '',
					'attachment' => '2',
					'tags' => '',
					));
				/*start record*/
				$arr = array(
					'tid' => $tid,
					'pid' => $pid,
					'uid' => $_G['uid'],
					'username' => $_G['username'],
					'fid' => $_G['fid'],
					'name' => $_G['forum']['name'],
					'subject' => $subject,
					'message' => $message,
					'ip' => $_G['clientip'],
					'lastpost' => $_G['timestamp'],
					'picupload' => 1,
					'replies' => $first);
				addrecordthread($arr, $newthread == 1 ? 1 : 3);
				addrecordforuminfo($_G['fid'], 3, array(
					'posts' => ($first + 1),
					'lastpost' => $_G['timestamp'],
					'threads' => $newthread));
				/*-----end----*/
				$update = array(
					'readperm' => $_G['group']['allowsetattachperm'] ? $attach[$attachid]['readperm'] : 0,
					'price' => $_G['group']['maxprice'] ? (intval($attach[$attachid]['price']) <= $_G['group']['maxprice'] ? intval($attach[$attachid]['price']) : $_G['group']['maxprice']) : 0,
					'tid' => $tid,
					'pid' => $pid,
					'uid' => $_G['uid']);
				if ($_G['gp_savetoalbum'] && $forumsave) {
					$picdata = array(
						'albumid' => $_G['gp_albumid'],
						'uid' => $_G['uid'],
						'username' => $_G['username'],
						'dateline' => $attach[$attachid]['dateline'],
						'postip' => $_G['clientip'],
						'filename' => $attach[$attachid]['filename'],
						'title' => $attach[$attachid]['description'],
						'type' => fileext($attach[$attachid]['attachment']),
						'size' => $attach[$attachid]['filesize'],
						'filepath' => $attach[$attachid]['attachment'],
						'thumb' => $attach[$attachid]['thumb'],
						'remote' => $attach[$attachid]['remote'] + 2,
						'serverid' => $attach[$attachid]['serverid']);
					$update['picid'] = DB::insert('home_pic', $picdata, 1);
				}
				DB::query("REPLACE INTO ".DB::table('forum_attachmentfield')." (aid, tid, pid, uid, description) VALUES ('$attachid', '$tid', '$pid', '$_G[uid]', '".cutstr(dhtmlspecialchars($attach[$attachid]['description']), 100)."')");
				DB::update('forum_attachment', $update, "aid='$attachid' and uid='$_G[uid]'");
				if ($pid && getstatus($thread['status'], 1)) {
					savepostposition($tid, $pid);
				}
				updatepostcredits('+', $_G['uid'], $doaction, $_G['fid']);
				if ($newthread) {
					DB::update('common_member_field_home', array('recentnote' => $subject), array('uid' => $_G['uid']));
					$feed = array(
						'icon' => '',
						'title_template' => '',
						'title_data' => array(),
						'body_template' => '',
						'body_data' => array(),
						'title_data' => array(),
						'images' => array());
					if (! empty($_G['gp_addfeed']) && $_G['forum']['allowfeed']) {
						$message = str_replace('\n', '', $message);
						$feed['icon'] = 'thread';
						$feed['title_template'] = 'feed_thread_title';
						$feed['body_template'] = 'feed_thread_message';
						$feed['body_data'] = array('subject' => "<a href=\"forum.php?mod=viewthread&tid=$tid\">$subject</a>", 'message' => messagecutstr($message, 150));
						if (! empty($_G['forum_attachexist'])) {
							if ($attachid) {
								$feed['images'] = array(getforumimg($attachid));
								$feed['image_links'] = array("forum.php?mod=viewthread&do=tradeinfo&tid=$tid&pid=$pid");
							}
						}
						$feed['title_data']['hash_data'] = "tid{$tid}";
						$feed['id'] = $tid;
						$feed['idtype'] = 'tid';
						if ($feed['icon']) {
							postfeed($feed);
						}
					}
				}
				$first++;
			}
			include_once libfile('function/stat');
                        //主题数量的更改
			//updatestat('thread');
			updatestat('post');
			DB::query("UPDATE ".DB::table('forum_thread')." SET lastposter='$_G[username]', lastpost='$_G[timestamp]', replies=replies+".($action == 'newthread' ? ($first - 1) : $first)." WHERE tid='$tid'", 'UNBUFFERED');
			if ($newalbum || $_G['gp_finish'] == 1) {
				require_once libfile('function/home');
				require_once libfile('function/spacecp');
				album_update_pic($_G['gp_albumid']);
			}
			if ($_G['gp_albumid']) {
				$albumdata = array(
					'picnum' => DB::result_first("SELECT count(*) FROM ".DB::table('home_pic')." WHERE albumid='$_G[gp_albumid]' " . getSlaveID()),
					'updatetime' => $_G['timestamp'],
					);
				DB::update('home_album', $albumdata, "albumid='$_G[gp_albumid]'");
			}
			if ($deleteattach) {
				foreach ($deleteattach as $delaid) {
					dunlink($attach[$delaid]);
				}
				file_put_contents(DISCUZ_ROOT.'data/dlogs/fenlou_'.date("Ymd", $_G['timestamp']).'.log', date("H:i:s", $_G['timestamp']).",line:274,{$_G['uid']},".dimplode($deleteattach)."\r\n---------------\r\n", FILE_APPEND);
				DB::delete('forum_attachment', " aid IN(".dimplode($deleteattach).")");
			}
			if ($action == 'newthread') {
				$subject = str_replace("\t", ' ', $subject);
				$lastpost = "$tid\t$subject\t$_G[timestamp]\t$_G[username]";
				DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', threads=threads+1, posts=posts+$picnum, todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED');
				if ($_G['forum']['type'] == 'sub') {
					DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', threads=threads+1, posts=posts+$picnum, todayposts=todayposts+1 WHERE fid='".$_G['forum'][fup]."'", 'UNBUFFERED');
				}
				$typeid > 0 && DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');
			} else {
				$lastpost = "$tid\t\t$_G[timestamp]\t$_G[username]";
				DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+$picnum, todayposts=todayposts+$picnum WHERE fid='$_G[fid]'", 'UNBUFFERED');
				if ($_G['forum']['type'] == 'sub') {
					DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', posts=posts+$picnum, todayposts=todayposts+$picnum WHERE fid='".$_G['forum']['fup']."'", 'UNBUFFERED');
				}
				$typeid = DB::result_first("SELECT typeid FROM ".DB::table('forum_thread')." WHERE tid='{$tid}'");
				$typeid > 0 && DB::query("UPDATE ".DB::table('forum_threadclass')." SET todayposts=todayposts+$picnum WHERE typeid='$typeid'", 'UNBUFFERED');
			}
			$returnjson['tid'] = $tid;
			$returnjson['picnum'] = $picnum;
			$returnjson['first'] = $first;
			if ($first > 0) {
				$returnjson['error'] = 0;
                                $returnjson['displayorder'] = $displayorder;
                                $returnjson['url'] = "forum.php?mod=viewthread&tid=$tid&extra=$extra";
			} elseif (! empty($deleteattach)) {
				$returnjson['error'] = 0;
				$returnjson['del'] = 1;
				$returnjson['url'] = "forum.php?mod=forumdisplay&fid=$_G[fid]";
			}
		}
	}
}

//当是旅游攻略板块时，页面提示
if($_G['fid'] == 52){
	$cookieKey = "fenlou_erweima_{$_G['uid']}";
	if ($action == 'newthread') {
		$returnjson['erweima'] = 1;
		$returnjson['tid']     = $tid;
		$returnjson['fid']     = $_G['fid'];
		dsetcookie($cookieKey, "{$returnjson['tid']},{$returnjson['fid']}", 100);
	} else {
		$cookieValue = getcookie($cookieKey);
		if ($cookieValue) {
			$cookieValue = explode(',', $cookieValue);
			$returnjson['erweima'] = 1;
			$returnjson['tid']     = $cookieValue[0];
			$returnjson['fid']     = $cookieValue[1];
		}
	}
}

if (! empty($returnjson['why'])){$returnjson['why'] = iconv('gbk', 'UTF-8', $returnjson['why']);}
echo json_encode($returnjson);

?>
