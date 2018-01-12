<?php
/**
 * @author JiangHong
 * @copyright 2014
 */
if ( $_G['uid'] != 1 )
{
	exit( 'Access Denied' );
}
showtime( "程序开始" );
set_time_limit( 0 );
require_once libfile( 'class/sockpost' );
require_once DISCUZ_ROOT . "./source/plugin/attachment_server/attachment_server.class.php";
include ( DISCUZ_ROOT . '/source/8264/launcher.php' );
include ( DISCUZ_ROOT . '/source/8264/model/model.base.php' );
require_once libfile( 'function/forum' );
$attachserver = new attachserver;
global $domain;
$domain = $attachserver->get_server();
$start = max( intval( $_G['gp_start'] ), 0 );
$limit = 3;
$next = $start + $limit;
$url = "http://bbs.8264.com/plugin.php?id=api:insertequ";
//$query = DB::query( "SELECT * FROM " . DB::table( "sanfu_Content" ) . " LIMIT {$start},{$limit}" );
$query = DB::query( "SELECT * FROM " . DB::table( "sanfu_content" ) . " WHERE used = 0 LIMIT {$limit}" );
function htmlsp( &$_v, $_k )
{
	if ( empty( $_v ) )
	{
		return;
	}
	showtime( "处理信息开始 ：{$_k}" );
	switch ( $_k )
	{
		case 'pic':
			preg_match_all( "/src=(?:\"|\')([^'\"]*)(?:\"|\')/i", $_v, $matchs );
			$picurl = $matchs[1][0];
			showtime( "处理图片中上传图片开始" );
			$_v = pic_handle( $picurl, 'forum' );
			showtime( "处理图片中上传图片完毕" );
			break;
		case 'message':
			if ( stripos( $_v, '<!--品牌简介' ) !== false )
			{
				$_v = substr( $_v, 0, stripos( $_v, '<!--品牌简介' ) );
			}
			$_v = preg_replace( "/\s\s+/i", " ", $_v );
			$_v = preg_replace( "/<.*?\/?>/i", "<br/>", $_v );
			$_v = preg_replace( "/(<br\/>)*\s*(<br\/>)/i", " ", $_v );
			$_v = preg_replace( "/<\s*br\s*\/?>/i", "\n", $_v );
			$_v = trim( $_v );
			break;
		case 'code':
			$_v = code_handle( $_v );
			break;
		case 'title':
			$_v = preg_replace( "/<.*?\/?>/i", "", $_v );
			break;

	}
	showtime( "处理信息完毕 ：{$_k}" );
	//is_string( $_v ) && $_v = htmlspecialchars( $_v );
}
function code_handle( $_v )
{
	$_v = preg_replace( "/\s+/i", "", $_v );
	$_v = explode( ',', $_v );
	$return = array();
	foreach ( $_v as $k => $v )
	{
		$v = str_replace( array(
			"'",
			"\"",
			"http://" ), '', $v );
		list( $_kk, $_vv ) = explode( ":", $v );
		$return[$_kk] = $_vv;
	}
	return $return;
}

function pic_handle( $picurl, $type )
{
	global $domain, $_G;
	showtime( "抓取图片前" );
	$fp = fopen( $picurl, 'rb' );
	$starttime = time();
	if ( $fp )
	{
		while ( ! feof( $fp ) )
		{
			$endtime = time();
			if ( ( $endtime - $starttime ) > 60 )
			{
				return false;
			}
			$piccontent .= fread( $fp, 1024 );
		}
	}
	showtime( "抓取图片后" );
	fclose( $fp );
	if ( ! empty( $piccontent ) && strlen( $piccontent ) >= 500 )
	{
		$filename = substr( $picurl, strripos( $picurl, '/' ) + 1 );
		$savefilename = date( 'His' ) . strtolower( random( 16 ) ) . '.jpg';
		$dir = date( 'Ym' ) . '/' . date( 'd' ) . '/';
		$args = array(
			'classname' => 'discuz',
			'dir' => $type . '/' . $dir,
			'attachment' => $type . '/' . $dir . $savefilename,
			'replace' => true,
			'method' => 'ver_file',
			);
		$return = sockpost::post( $piccontent, $domain['domain'], $domain['api'], $savefilename, 'image/jpeg', $args, array(), false );
		$attachment = $return['save'] ? $dir . $savefilename : false;
		if ( $attachment !== false )
		{
			DB::query( "INSERT INTO " . DB::table( 'forum_attachment' ) . " (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
			VALUES ('0', '0', '$_G[timestamp]', '0', '0', '$filename', 'image/jpeg', '" . intval( $return['classreturn']['filesize'] ) . "', '" . $attachment . "', '0', '1', '" . $_G['uid'] . "', '0', '0', '" . intval( $return['classreturn']['imageinfo']['width'] ) . "', '{$domain[serverid]}', '{$type}')" );
			$aid = DB::insert_id();
			return array(
				'aid' => $aid,
				'attachment' => $attachment,
				'dir' => $type,
				'url' => $picurl );
		}else{
			echo "<br />存储错误<br />" . var_export($return, true) . "<br />";
		}
	}else{
		echo "<br />抓不到图片{$picurl}<br />";
	}
	return false;
}
function getpicaid( $value, $dir )
{
	$headimgselect = 0;
	if ( $value['pic'] )
	{
		$headimgselect = $value['pic']['aid'];
		$picurl = $value['pic']['url'];
	}
	elseif ( $value['code']['image_link'] )
	{
		$picurl = "http://" . $value['code']['image_link'];
	}
	if ( ( $headimgselect == 0 && ! empty( $picurl ) ) || $dir == 'plugin' )
	{
		$_tmp = pic_handle( $picurl, $dir );
		$headimgselect = $_tmp['aid'];
	}
	return $headimgselect;
}
function copyfengmian( $aid, $tdir )
{
	global $domain, $_G;
	$attachinfo = DB::fetch_first( "SELECT * FROM " . DB::table( "forum_attachment" ) . " WHERE aid = {$aid}" );
	if ( $attachinfo )
	{
		$methodargs = array(
			'classname' => 'discuz',
			'method' => 'copyfile',
			'sfile' => $attachinfo['dir'] . '/' . $attachinfo['attachment'],
			'tfile' => $tdir . '/' . $attachinfo['attachment'],
			'move' => false );
		$return = sockpost::method( $domain['domain'], $domain['api'], $methodargs );
		if ( $return['classreturn']['save'] )
		{
			DB::query( "INSERT INTO " . DB::table( 'forum_attachment' ) . " (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
			VALUES ('0', '0', '$_G[timestamp]', '0', '0', '{$attachinfo[filename]}', 'image/jpeg', '" . $attachinfo['filesize'] . "', '" . $attachinfo['attachment'] . "', '0', '1', '" . $_G['uid'] . "', '0', '0', '" . $attachinfo['width'] . "', '{$domain[serverid]}', '{$tdir}')" );
			$naid = DB::insert_id();
			return array(
				'aid' => $naid,
				'attachment' => $attachinfo['attachment'],
				'dir' => $tdir );
		}
	}
	return false;
}
function showtime( $str )
{
	static $cishu = 0;
	static $lasttime;
	$cishu++;
	$now = microtime( true );
	$shijian = sprintf( "%1.5f", $now - $lasttime );
	//echo "<p>{$str}   ----   第" . $cishu . "次 [" . ( $shijian > 10 ? "<b>{$shijian}</b>" : $shijian ) . "]</p>";
	$lasttime = $now;
}
$jj = 0;
$_ok_id = array();
$equmod = m( 'equipment' );
while ( $value = DB::fetch( $query ) )
{
	$jj++;
	$postdata = $_ttmp = array();
	showtime( "判断消息前" );
	if ( ! empty( $value['message'] ) )
	{
		array_walk( $value, 'htmlsp' );
		$value['message'] = "[color=Red]原网页地址：[/color][url={$value['PageUrl']}]{$value['PageUrl']}[/url]\n" . $value['message'];
		showtime( "循环处理数据后" );
		$postdata['imgselect'] = $needsaveforum = array();
		$postdata['headimgselect'] = getpicaid( $value, 'forum' );
		showtime( "抓图片后" );
		if ( $postdata['headimgselect'] > 0 )
		{
			$_tmps = copyfengmian( $postdata['headimgselect'], 'plugin' );
			$_tmps && $postdata['imgselect'][] = $_tmps['aid'];
		}
		showtime( "封面拷贝后" );
		$otherpic = DB::result_first( "SELECT imglist FROM " . DB::table( 'sanfu_pic' ) . " WHERE ID = {$value[ID]}" );
		if ( $otherpic )
		{
			if ( stripos( $otherpic, "|||" ) !== false )
			{
				$_i = 0;
				foreach ( explode( "|||", $otherpic ) as $_picurl )
				{
					$_i++;
					if ( $_i <= 4 )
					{
						$_ttmp = pic_handle( "http://www.sanfo.com/" . $_picurl, 'plugin' );
						if ( $_ttmp )
						{
							$postdata['imgselect'][] = $_ttmp['aid'];
						}
					}
					else
					{
						$_ttmp = pic_handle( "http://www.sanfo.com/" . $_picurl, 'forum' );
						if ( $_ttmp )
						{
							$postdata['imgselect'][] = $_ttmp['aid'];
							$value['message'] .= "\n[attach]{$_ttmp['aid']}[/attach]";
						}
					}
				}
			}
			else
			{
				$_ttmp = pic_handle( "http://www.sanfo.com/" . $otherpic, 'plugin' );
				if ( $_ttmp )
				{
					$postdata['imgselect'][] = $_ttmp['aid'];
				}
			}
		}
		showtime( "其他图片抓后" );
		if ( ! empty( $value['code']['price'] ) )
		{
			$postdata['price'] = sprintf( "%1.2f", $value['code']['price'] );
		}
		$postdata['subject'] = ! empty( $value['title'] ) ? $value['title'] : ( ! empty( $value['code']['name'] ) ? $value['code']['name'] : "请手动编辑商品标题" );
		$postdata['subject'] = str_replace( array(
			'[特价]',
			'(已售完)',
			'（已售完）',
			'(停售)',
			'（停售）',
			'(删除)',
			'（删除）',
			'(仅限网上销售)',
			'（仅限网上销售）',
			'(断码)',
			'（断码）',
			'&nbsp;' ), '', $postdata['subject'] );
		$postdata['subject'] = trim( $postdata['subject'] );
		$brand = false;
		showtime( "过滤标题后" );
		if ( ( $_left = stripos( $postdata['subject'], "(" ) ) !== false && ( $_right = stripos( $postdata['subject'], ")", $_left ) ) !== false )
		{
			$_pp = substr( $postdata['subject'], $_left + 1, $_right - $_left - 1 );
			$brand = getBrand( $_pp );
			if ( $brand === false )
			{
				$brand = getBrand( substr( $postdata['subject'], 0, $_left ) );
			}

		}
		showtime( "第一次读品牌后" );
		if ( $brand === false )
		{
			$brand = getBrand( substr( $postdata['subject'], 0, stripos( $postdata['subject'], ' ' ) !== false ? stripos( $postdata['subject'], ' ' ) : strlen( $postdata['subject'] ) ) );
		}
		showtime( "第二次读品牌后" );
		//var_dump($brand);exit;
		if ( is_array( $brand ) )
		{
			$postdata['bid'] = $brand['bid'];
			$postdata['bname'] = $brand['bname'];
			$postdata['btid'] = $brand['btid'];
		}
		showtime( "入库前" );
		$postdata['subject'] = daddslashes( $postdata['subject'] );
		if ( ! empty( $postdata['imgselect'] ) && $postdata['headimgselect'] > 0 )
		{
			$postdata['message'] = daddslashes( $value['message'] );
			$postdata['justreturn'] = true;
			$_return = $equmod->dopost( $postdata );
			$_ok_id[] = $value['ID'];
		}else{
			echo "<br />图片或头图错误<br />";
		}
		showtime( "结束" );
	}
}
function getBrand( $str )
{
	if ( ! in_array( $str, array(
		"停售",
		"缺货",
		"下架" ) ) )
	{
		if(($_ll = stripos($str, "'")) !== false){
			$str = substr($str, 0, $_ll);
		}
		$_ppinfo = DB::fetch_first( "SELECT id, subject, tid FROM " . DB::table( 'dianping_brand_info' ) . " WHERE subject LIKE '%" . $str . "%'" );
		if ( $_ppinfo )
		{
			return array(
				'bid' => $_ppinfo['id'],
				'bname' => $_ppinfo['subject'],
				'btid' => $_ppinfo['tid'],
				);
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}
if ( ! empty( $_ok_id ) )
{
	DB::query( "UPDATE " . DB::table( 'sanfu_content' ) . " SET `used` = 1 WHERE `ID` IN(" . dimplode( $_ok_id ) . ")" );
}
echo "当前完成{$limit}(" . count($_ok_id) . ")个";
if ( $jj < $limit )
{
	echo "，已经全部添加完成！";
}
else
{
	echo "，5秒后继续。<meta http-equiv='refresh'content=5;URL='$url'>";
	echo <<<EOF
<script>
function reloadPage(){
	window.location.reload();
}
setTimeout(reloadPage, 1000 * 300);
</script>
EOF;
}
?>