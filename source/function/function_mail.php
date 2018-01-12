<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: function_mail.php 19339 2010-12-28 06:56:27Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


function sendmail($toemail, $subject, $message, $from = '') {
	global $_G;
	if(!is_array($_G['setting']['mail'])) {
		$_G['setting']['mail'] = unserialize($_G['setting']['mail']);
	}
	$_G['setting']['mail']['server'] = $_G['setting']['mail']['port'] = $_G['setting']['mail']['auth'] = $_G['setting']['mail']['from'] = $_G['setting']['mail']['auth_username'] = $_G['setting']['mail']['auth_password'] = '';
	if($_G['setting']['mail']['mailsend'] != 1) {
		$smtpnum = count($_G['setting']['mail']['smtp']);
		if($smtpnum) {
			$rid = rand(0, $smtpnum-1);
			$smtp = $_G['setting']['mail']['smtp'][$rid];
			$_G['setting']['mail']['server'] = $smtp['server'];
			$_G['setting']['mail']['port'] = $smtp['port'];
			$_G['setting']['mail']['auth'] = $smtp['auth'] ? 1 : 0;
			$_G['setting']['mail']['from'] = $smtp['from'];
			$_G['setting']['mail']['auth_username'] = $smtp['auth_username'];
			$_G['setting']['mail']['auth_password'] = $smtp['auth_password'];
		}
	}
	$message = preg_replace("/href\=\"(?!http\:\/\/)(.+?)\"/i", 'href="'.$_G['siteurl'].'\\1"', $message);
	$msg = $message;
$message = <<<EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=$_G[charset]">
<title>$subject</title>
</head>
<body>
$subject<br />
$message
</body>
</html>
EOT;

	$maildelimiter = $_G['setting']['mail']['maildelimiter'] == 1 ? "\r\n" : ($_G['setting']['mail']['maildelimiter'] == 2 ? "\r" : "\n");
	$mailusername = isset($_G['setting']['mail']['mailusername']) ? $_G['setting']['mail']['mailusername'] : 1;
	$_G['setting']['mail']['port'] = $_G['setting']['mail']['port'] ? $_G['setting']['mail']['port'] : 25;
	$_G['setting']['mail']['mailsend'] = $_G['setting']['mail']['mailsend'] ? $_G['setting']['mail']['mailsend'] : 1;

	if($_G['setting']['mail']['mailsend'] == 3) {
		$email_from = empty($from) ? $_G['setting']['adminemail'] : $from;
	} else {
		$email_from = $from == '' ? '=?'.CHARSET.'?B?'.base64_encode($_G['setting']['sitename'])."?= <".$_G['setting']['adminemail'].">" : (preg_match('/^(.+?) \<(.+?)\>$/',$from, $mats) ? '=?'.CHARSET.'?B?'.base64_encode($mats[1])."?= <$mats[2]>" : $from);
	}

	$email_to = preg_match('/^(.+?) \<(.+?)\>$/',$toemail, $mats) ? ($mailusername ? '=?'.CHARSET.'?B?'.base64_encode($mats[1])."?= <$mats[2]>" : $mats[2]) : $toemail;

	$email_subject = '=?'.CHARSET.'?B?'.base64_encode(preg_replace("/[\r|\n]/", '', '['.$_G['setting']['sitename'].'] '.$subject)).'?=';
	$email_message = chunk_split(base64_encode(str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $message))))));
	$host = $_SERVER['HTTP_HOST'];
	$version = $_G['setting']['version'];
	$headers = "From: $email_from{$maildelimiter}X-Priority: 3{$maildelimiter}X-Mailer: $host $version {$maildelimiter}MIME-Version: 1.0{$maildelimiter}Content-type: text/html; charset=".CHARSET."{$maildelimiter}Content-Transfer-Encoding: base64{$maildelimiter}";
	if($_G['setting']['mail']['mailsend'] == 1) {
		if(function_exists('mail') && @mail($email_to, $email_subject, $email_message, $headers)) {
			return true;
		}
		return false;

	} elseif($_G['setting']['mail']['mailsend'] == 2) {

		if(!$fp = fsockopen($_G['setting']['mail']['server'], $_G['setting']['mail']['port'], $errno, $errstr, 30)) {
			runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) CONNECT - Unable to connect to the SMTP server", 0);
			return false;
		}
		stream_set_blocking($fp, true);

		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != '220') {
			runlog('SMTP', "{$_G[setting][mail][server]}:{$_G[setting][mail][port]} CONNECT - $lastmessage", 0);
			return false;
		}

		fputs($fp, ($_G['setting']['mail']['auth'] ? 'EHLO' : 'HELO')." uchome\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 220 && substr($lastmessage, 0, 3) != 250) {
			runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) HELO/EHLO - $lastmessage", 0);
			return false;
		}

		while(1) {
			if(substr($lastmessage, 3, 1) != '-' || empty($lastmessage)) {
				break;
			}
			$lastmessage = fgets($fp, 512);
		}

		if($_G['setting']['mail']['auth']) {
			fputs($fp, "AUTH LOGIN\r\n");
			$lastmessage = fgets($fp, 512);
			if(substr($lastmessage, 0, 3) != 334) {
				runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) AUTH LOGIN - $lastmessage", 0);
				return false;
			}

			fputs($fp, base64_encode($_G['setting']['mail']['auth_username'])."\r\n");
			$lastmessage = fgets($fp, 512);
			if(substr($lastmessage, 0, 3) != 334) {
				runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) USERNAME - $lastmessage", 0);
				return false;
			}

			fputs($fp, base64_encode($_G['setting']['mail']['auth_password'])."\r\n");
			$lastmessage = fgets($fp, 512);
			if(substr($lastmessage, 0, 3) != 235) {
				runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) PASSWORD - $lastmessage", 0);
				return false;
			}

			$email_from = $_G['setting']['mail']['from'];
		}

		fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 250) {
			fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $email_from).">\r\n");
			$lastmessage = fgets($fp, 512);
			if(substr($lastmessage, 0, 3) != 250) {
				runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) MAIL FROM - $lastmessage", 0);
				return false;
			}
		}

		fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $toemail).">\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 250) {
			fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $toemail).">\r\n");
			$lastmessage = fgets($fp, 512);
			runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) RCPT TO - $lastmessage", 0);
			return false;
		}

		fputs($fp, "DATA\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 354) {
			runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) DATA - $lastmessage", 0);
			return false;
		}

		$headers .= 'Message-ID: <'.gmdate('YmdHs').'.'.substr(md5($email_message.microtime()), 0, 6).rand(100000, 999999).'@'.$_SERVER['HTTP_HOST'].">{$maildelimiter}";

		fputs($fp, "Date: ".gmdate('r')."\r\n");
		fputs($fp, "To: ".$email_to."\r\n");
		fputs($fp, "Subject: ".$email_subject."\r\n");
		fputs($fp, $headers."\r\n");
		fputs($fp, "\r\n\r\n");
		fputs($fp, "$email_message\r\n.\r\n");
		$lastmessage = fgets($fp, 512);
		if(substr($lastmessage, 0, 3) != 250) {
			runlog('SMTP', "({$_G[setting][mail][server]}:{$_G[setting][mail][port]}) END - $lastmessage", 0);
		}
		fputs($fp, "QUIT\r\n");

		return true;

	} elseif($_G['setting']['mail']['mailsend'] == 3) {

		ini_set('SMTP', $_G['setting']['mail']['server']);
		ini_set('smtp_port', $_G['setting']['mail']['port']);
		ini_set('sendmail_from', $email_from);

		if(function_exists('mail') && @mail($email_to, $email_subject, $email_message, $headers)) {
			return true;
		}
		return false;
	} elseif($_G['setting']['mail']['mailsend'] == 4) {
		/*
			### 要开启此方法发送邮件须在后台设置 ###
			SOUHU sendcloud不支持 "昵称 <example@domain.com>"的形式。
			收件人邮箱地址，多个地址使用;分割，如：to1@sendcloud.org;to2@sendcloud.org。
			如果地址中可以使用邮件列表地址，需将参数use_maillist=true.
			更多参数说明见：http://sendcloud.sohu.com/sendcloud/api-doc/web-api-mail-detail
			@@@ 注意：包含汉字的内容必须转码为UTF-8才能通过匹配 @@@
			如新增发送新模板的邮件，必须在sendcloud后台增加相应的邮件模板，并且匹配度非常高的情况下才能发送
		*/
		$email_to = preg_match('/^(.+?) \<(.+?)\>$/',$toemail, $mats) ? $mats[2] : $toemail;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://sendcloud.sohu.com/webapi/mail.send.json');
		//不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
		curl_setopt($ch, CURLOPT_POSTFIELDS,
			array('api_user' => 'postmaster@service8264.sendcloud.org',	//触发邮件地址，如果批量发送邮件需要使用批量邮件地址，并且须模板与此一致才能发送
			'api_key' => '6rMtxOF1wq5upafM',
			'from' => $email_from,
			'fromname' => diconv('8264户外资料网','GBK','UTF-8'),
			'to' => $email_to,
			'subject' => diconv($subject,'GBK','UTF-8'),
			'html' => diconv($msg,'GBK','UTF-8')
			));
		$result = curl_exec($ch);

		if($result === false) //请求失败
		{
		   runlog('SENDCLOUD','curl error : '.curl_error($ch));
		}

		$return_msg = array();
		$return_msg = json_decode($result, true);
		if($return_msg['message'] == 'error')
		{
			$result = false;
			runlog('SENDCLOUD',"msg error : {$return_msg['errors'][0]}");
		}

		curl_close($ch);
		return $result;
	}
}

function sendmail_cron($toemail, $subject, $message) {

	$toemail = addslashes($toemail);

	$query = DB::query("SELECT * FROM ".DB::table('common_mailcron')." WHERE email='$toemail' LIMIT 1");
	if($value = DB::fetch($query)) {
		$cid = $value['cid'];
	} else {
		$cid = DB::insert('common_mailcron', array('email'=>$toemail), 1);
	}
	$message = preg_replace("/href\=\"(?!http\:\/\/)(.+?)\"/i", 'href="'.$_G['siteurl'].'\\1"', $message);
	$setarr = array(
		'cid' => $cid,
		'subject' => addslashes($subject),
		'message' => addslashes($message),
		'dateline' => $_G['timestamp']
	);
	DB::insert('common_mailqueue', $setarr);

	return true;
}

function sendmail_touser($touid, $subject, $message, $mailtype='') {
	global $_G;

	if(empty($_G['setting']['sendmailday'])) return false;

	require_once libfile('function/home');
	$tospace = getspace($touid);
	if(empty($tospace['email'])) return false;

	space_merge($tospace, 'field_home');
	space_merge($tospace, 'status');

	$acceptemail = $tospace['acceptemail'];
	if(!empty($acceptemail[$mailtype]) && $_G['timestamp'] - $tospace['lastvisit'] > $_G['setting']['sendmailday']*86400) {
		if(empty($tospace['lastsendmail'])) {
			$tospace['lastsendmail'] = $_G['timestamp'];
		}
		$sendtime = $tospace['lastsendmail'] + $acceptemail['frequency'];

		$query = DB::query("SELECT * FROM ".DB::table('common_mailcron')." WHERE touid='$touid' LIMIT 1");
		if($value = DB::fetch($query)) {
			$cid = $value['cid'];
			if($value['sendtime'] < $sendtime) $sendtime = $value['sendtime'];
			DB::update('common_mailcron', array('email'=>addslashes($tospace['email']), 'sendtime'=>$sendtime), array('cid'=>$cid));
		} else {
			$cid = DB::insert('common_mailcron', array('touid'=>$touid, 'email'=>addslashes($tospace['email']), 'sendtime'=>$sendtime), 1);
		}
		$message = preg_replace("/href\=\"(?!http\:\/\/)(.+?)\"/i", 'href="'.$_G['siteurl'].'\\1"', $message);
		$setarr = array(
			'cid' => $cid,
			'subject' => addslashes($subject),
			'message' => addslashes($message),
			'dateline' => $_G['timestamp']
		);
		DB::insert('common_mailqueue', $setarr);
		return true;
	}
	return false;
}

?>
