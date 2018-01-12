<?php
if ( ! defined( 'IN_DISCUZ' )  || !defined('IN_ADMINCP'))
{
	exit( 'Access Denied' );
}
if ( isset( $_POST['comments'] ) && ! empty( $_POST['comments'] ) && ! empty( $_POST['cdnname'] ) )
{
	$urls = $_POST['comments'];
	require_once DISCUZ_ROOT . './source/plugin/attachment_server/attachment_server.class.php';
	$urls = str_replace( "http://", " http://", $urls );
	$urls = trim( preg_replace( "/\s\s+/i", ' ', $urls ) );
	$return = attachserver::shuaxinCdn($_POST['cdnname'], explode( " ", $urls ));
	if( $return['errorurl'] ) {
		echo "<font color='red'><h6>以下文件不在cdn中，无法进行更新</h6>";
		echo implode( "<br />", $return['errorurl'] ) . "</font>";
	}
	if( $return['successurl'] ) {
		echo "<font color='green'><h4>以下文件更新完毕！</h4>";
		echo implode( "<br />", $return['successurl'] ) . "</font>";
	}
}
?>
<p>每个URL一行,以协议://开头,如(http://)开头的图片地址,例如http://image.8264.com/img/zzz.png</p>
<form action="admin.php?action=plugins&operation=config&do=<?php
echo $pluginid;
?>&identifier=forumoption&pmod=admincp_dnssetting" method="post">
	<textarea name="comments" cols="80" rows="10" id="urls">http://image.8264.com/img/zzz.png</textarea><br/>
	<p>请选择需要刷新的cdn：<select name="cdnname">
		<?php foreach( $_G['config']['cdn'] as $_key => $_value ) { ?>
		<option value="<?php echo $_key; ?>"><?php echo $_value['name']; ?></option>
		<?php } ?>
	</select></p>
	<input type="reset" value="重填" /><input type="submit" value="更新CDN"/>
</form>
