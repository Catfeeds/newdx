<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

set_time_limit(9999);
if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_town_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}
/*查询当前已经设置分区版主的大版区fup*/
function geteditfup(){
    if($return = memory('get','master_manager_setting')){
	$return = unserialize($return);
    }else{
	$query = DB::query("SELECT setting_value FROM ".DB::table('plugin_master_manager_setting')." WHERE setting_name = 'fup'");
	while($values = DB::fetch($query)){
	    $return[] = $values['setting_value'];
	}
	memory('set','master_manager_setting',serialize($return),3600);
    }
    return $return;
}
//$localforum_id=DB::result_first("SELECT value FROM ".DB::table('plugin_forumoption_setting')." WHERE name='localfroum_id'");
//$localforum_id=$localforum_id?$localforum_id:'76';
$editFup = geteditfup();
$localforum_id = (isset($_POST['localforum_id_select']) && $_POST['localforum_id_select'] > 0) ? $_POST['localforum_id_select'] : $editFup[0];
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_forum')." WHERE fup = $localforum_id");

$forums = array();
$querys = DB::query("SELECT * FROM ".DB::table('forum_forum')." WHERE fup = $localforum_id ORDER BY name");
while ($forum = DB::fetch($querys)) {
	$data['threads'] = $tids = array();
	$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." t".
				   " RIGHT JOIN ".DB::table('plugin_forumoption_town_recommends')." r ON r.tid = t.tid".
				   " WHERE t.fid = {$forum['fid']} LIMIT 5");
	while ($value = DB::fetch($query)) {
		$data['threads'][] = $value;
		$tids[] = $value['tid'];
	}
	$count = 5 - count($data['threads']);
	if ($count > 0) {
		$where_tid = $tids ? " AND t.tid NOT IN (".implode(', ', $tids).")" : '';
		$dateline = time() - 604800; // 3600 * 24 * 7 == 604800
		$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." t WHERE t.fid = {$forum['fid']} AND digest = 1 $where_tid AND dateline > $dateline ORDER BY digest DESC, dateline DESC LIMIT $count");
		while ($value = DB::fetch($query)) {
			$data['threads'][] = $value;
			$tids[] = $value['tid'];
		}
	}
	$count = 5 - count($data['threads']);
	if ($count > 0) {
		$where_tid = $tids ? " AND tid NOT IN (".implode(', ', $tids).")" : '';
		$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." t WHERE t.fid = {$forum['fid']} $where_tid AND dateline > $dateline ORDER BY heats DESC LIMIT $count");
		while ($value = DB::fetch($query)) {
			$data['threads'][] = $value;
		}
	}
	$forum['threads']=$data['threads'];
	$forums[] = $forum;
}
?>
<form id="select_fup" action="" method="post">
<div style='margin-top:10px;'>板块id：
<select id='localforum_id_select' name="localforum_id_select" >
<?php
foreach($editFup as $fids){
?>
    <option id="option_<?php echo $fids;?>" value="<?php echo $fids;?>" <?php if($localforum_id==$fids) echo "selected"; ?>><?php echo $fids;?></option>
<?php
}
?>
    </select>
    <input type="submit" name="submmit" value="选择"/>
    <a href="javascript:;" id="localforum_id_del">删除</a>
    <span style="margin: 0 10px;">|</span>
    <input type='text' size="5" id='localforum_id' value='<?=$localforum_id?$localforum_id:'0'?>'/>
    <a href="javascript:;" id="localforum_id_edit">添加</a>
    <span style="color: green;margin-left:20px;" id="localforum_tips"></span>
</div>
</form>
<form action="" method="post" id="forumForm">
<?php showtableheader(); ?>
<tr class="header">
    <th>版块名称</th>
    <th width="60%">操作</th>
</tr>

<?php
//增加隔行变色功能，方便用户选择 add by jianghong 2012-06-07
$num_row = 1;
foreach ($forums as $forum): ?>
<tr class="thread_show" <?=($num_row%2==1) ? "style='background:#DDD'" : ""?>>
    <td class="box">
        <a class="fid" href="<?php echo $_G['config']['web']['forum']; ?>forum-<?php echo $forum['fid']; ?>-1.html" target="_blank" title="<?php echo $forum['name']; ?>">
            <?php echo $forum['name']; ?>
        </a>
		<div style="width: 470px;display: none;overflow: hidden;z-index: 120px;" id="fid_<?php echo $forum['fid']; ?>">
		    <?php foreach($forum['threads'] as $thread): ?>
			<p style="width: 465px;"><a style="color: #000000;" href="<?php echo $_G['config']['web']['forum']; ?>thread-<?php echo $thread['tid']; ?>-1-1.html" target="_blank"><?php echo $thread['subject']; ?></a></p>
			<?php endforeach;?>
		</div>
    </td>
	<td>
		<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_town&op=editmaster&fid=<?php echo $forum['fid']; ?>&fup=<?php echo $localforum_id; ?>">版主管理</a>
		&nbsp;
		<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=forumoption&pmod=admincp_town&op=edit&fid=<?php echo $forum['fid']; ?>&fup=<?php echo $localforum_id; ?>">推荐贴子</a>
    </td>
</tr>
<?php
	$num_row++;
 endforeach;
//以上代码修改 2012-06-07
?>

<?php showtablefooter(); ?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">

    <div style="float:right;">
        <?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=forumoption&pmod=admincp_town");?>
    </div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
    $('.box').mouseover(function(){
	    $(this).children('.fid').next().css("display","");
    });
    $('.box').mouseout(function(){
	    $(this).children('.fid').next().css("display","none");
    });
    $('#localforum_id_edit').live('click',function(){
	   $('#localforum_id_edit').hide();
       $('#localforum_tips').text('正在添加...');
       var $newid = $('#localforum_id').val();
       $.get('plugin.php?id=forumoption:ajax_edit_localfid',{
            inajax:'1',
            method:'add',
            newfid:$newid
       },function(data,textStatus){
            $('#localforum_tips').text(data);
            $('#localforum_id_edit').show();
            if(data=='修改完成'){
                $('#localforum_id_select').append('<option id="option_'+$newid+'" value="'+$newid+'">'+$newid+'</option>');
            }
       });
	});
    $('#localforum_id_del').click(function(){
        var $newid = $('#localforum_id_select').val();
        if(confirm('确认删除？将会删除已经设定的当前fup='+$newid+'的所有版主设定')){
            $('#localforum_id_del').hide();
            $('#localforum_tips').text('正在删除...');

            $.get('plugin.php?id=forumoption:ajax_edit_localfid',{
                inajax:'1',
                method:'del',
                newfid:$newid
           },function(data,textStatus){
                $('#localforum_tips').text(data);
                $('#localforum_id_edit').show();
                $('#localforum_id_select #option_'+$newid).remove();
           });
       }
    });
})(jQuery);
</script>
