<?php
/**
 * 用于管理存在的样式
 * @author JiangHong
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$styleids = $_GET['styleids'] ? intval($_GET['styleids']) : 0;
if($_G['gp_method']){
    switch($_G['gp_method']){
        case 'update' :
        updatecache('styles',true);
        break;

        case 'export' :
        export_css($styleids);
        break;

        default:
        echo "不存在的方法";
        break;
    }
}
$template = '';
$lang = $scriptlang['StyleManager'];
$defaultid = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='styleid'");
$query = DB::query("SELECT * FROM ".DB::table("common_style"));
$styleids = 0;
while($values = DB::fetch($query)){
    $ftime = date("Y-m-d H:i:s",filemtime(DISCUZ_ROOT."./data/cache/style_{$values['styleid']}_module.css"));
    $template .= showtablerow('',array(),array($values['styleid'],$values['name'],($defaultid==$values['styleid'] ? $lang['style_on'] : $lang['style_off']),$ftime),true);
    $styleids++;
}
$control = "<a href='".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=StyleManager&pmod=StyleManager&method=update'>".$lang['control_update']."</a><br /><br /><a href='".ADMINSCRIPT."?action=plugins&operation=config&do=".$pluginid."&identifier=StyleManager&pmod=StyleManager&styleids={$styleids}&method=export'>".$lang['control_export']."</a>";
showtableheader();
showtablerow('',array('width="50px"','width="150px"'),array($lang['styleid'],$lang['stylename'],$lang['stylestatus'],$lang['stylelasttime']));
echo $template;
showtablefooter();
print <<<EOF
<fieldset style="margin:20px;width:150px;height:60px;padding:30px;">
<legend>相关操作</legend>
<p>$control</p>
</fieldset>
EOF;
function export_css($styleids){
    global $css_array,$zipfiles;
    updatecache('styles',true);
	$css_array = array();
    if(!is_dir(DISCUZ_ROOT."./source/plugin/StyleManager/tmpcss/")) @mkdir(DISCUZ_ROOT."./source/plugin/StyleManager/tmpcss/");
    $query = DB::query('SELECT * FROM '.DB::table('plugin_css_cache').' WHERE type = 1');
    while($values = DB::fetch($query)){
        file_put_contents(DISCUZ_ROOT.'./source/plugin/StyleManager/tmpcss/'.$values['filename'],base64_decode($values['values']));
        $zipfiles[] = DISCUZ_ROOT."./source/plugin/StyleManager/tmpcss/".$values['filename'];
    }
	$query = DB::query('SELECT * FROM '.DB::table('plugin_style_manager'));
	while($values = DB::fetch($query)){
		$bname = $values['name'];
		$modname = $values['mod'];
		for($i = 1; $i<=$styleids ;$i++){
			$content = @implode('', file(DISCUZ_ROOT.'./source/plugin/StyleManager/tmpcss/style_'.$i.'_module.css'));
			$content = preg_replace("/\[(.+?)\](.*?)\[end\]/ies", "cssvtags('\\1','\\2',{$i},{$bname},{$modname})", $content);
			$filename = "style_".$i."_".$bname."_".$modname.".css";
			$css_array[$filename] = preg_replace(array('/\s*([,;:\{\}])\s*/', '/[\t\n\r]/', '/\/\*.+?\*\//'), array('\\1', '',''), $css_array[$filename]);
			DB::query("REPLACE INTO ".DB::table('plugin_css_cache')."(`filename`,`values`,`dateline`) VALUES('{$filename}','".(base64_encode($css_array[$filename]))."',".time().")");
			file_put_contents(DISCUZ_ROOT."./source/plugin/StyleManager/tmpcss/".$filename,$css_array[$filename]);
			$zipfiles[] = DISCUZ_ROOT."./source/plugin/StyleManager/tmpcss/".$filename;
		}
	}
    $downfile = DISCUZ_ROOT.'./source/plugin/StyleManager/tmpcss/css.zip';
	echo "<b><font color='".(create_zip($zipfiles,$downfile,true) ? "green'>压缩完成，<a href='plugin.php?id=StyleManager:downcss'>点击下载</a>" : "red'>压缩失败")."</font></b>";
}

function cssvtags($param, $content, $styleid, $bname, $modname) {
	global $css_array;
	$modules = explode(',', $param);
	foreach($modules as $module) {
		$module .= '::'; //fix notice
		list($b, $m) = explode('::', $module);
		if($b && $b == $bname && (!$m || $m == $modname)){
            $filename = "style_".$styleid."_".$bname."_".$modname.".css";
			$css_array[$filename] .= $content;
			return;
		}
	}
	return;
}
function create_zip($files=array(),$des='',$overwrite=FALSE){
    if(file_exists($des) && !$overwrite) return false;
    if(!is_array($files)) $files = array($files);
    $var_files = array();
    foreach($files as $file){
        if(file_exists($file)) $var_files[] = $file;
    }
    if(!empty($var_files)){
		if(!extension_loaded('zip')){
			echo '<b><font color="red">失败，没有开启php_zip压缩的扩展!</font></b>';
			return false;
		}
        $zip = new ZipArchive;
        if($zip->open($des,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE)!==true){
			echo '<b><font color="red">失败，不能启用压缩类，或没有权限!</font></b>';
            return false;
        }
		echo "<ol>";
        foreach($var_files as $addfile){
			echo "<li>".substr($addfile,strrpos($addfile,"/")+1)."</li>";
            $zip->addFile($addfile,substr($addfile,strrpos($addfile,"/")+1));
        }
		echo "</ol>";
        $zip->close();
        return file_exists($des);
    }else{
		echo '<b><font color="red">失败，没有存在的压缩文件!</font></b>';
        return false;
    }
}
?>
