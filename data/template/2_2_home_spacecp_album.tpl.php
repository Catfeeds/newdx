<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_album', 'common/header');
0
|| checktplrefresh('./template/8264/home/spacecp_album.htm', './template/default/common/simplesearchform.htm', 1488800527, '2', './data/template/2_2_home_spacecp_album.tpl.php', './template/8264', 'home/spacecp_album')
|| checktplrefresh('./template/8264/home/spacecp_album.htm', './template/default/common/userabout.htm', 1488800527, '2', './data/template/2_2_home_spacecp_album.tpl.php', './template/8264', 'home/spacecp_album')
;?>
<?php $_G[home_tpl_titles] = array($album[albumname], '���'); include template('common/header'); if($_GET['op']=='edit' || $_GET['op']=='editpic') { ?>
<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="��������">��������</label></li>
EOF;
?><?php } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="��������">����</label></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="����{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="������־">��־</label></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="�������">���</label></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="����{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="�����û�">�û�</label></li>
EOF;
?>
<?php if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?php echo $_G['siteurl'];?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">����</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="��������������" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">����</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z"><a href="./" class="nvhm" title="��ҳ"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> <a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> <a href="home.php?mod=space&amp;do=album">���</a><?php if($album['albumname']) { ?> <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;id=<?php echo $albumid;?>"><?php echo $album['albumname'];?></a><?php } ?> <em>&rsaquo;</em> �༭���</div>
</div>

<div id="ct" class="wp ct2_a cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt"><img alt="album" src="<?php echo STATICURL;?>image/feed/album.gif" class="vm" /> ���</h1>
<ul class="tb cl"><?php $aid = $albumid ? $albumid : -1; ?><li><a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;id=<?php echo $aid;?>">�鿴���</a></li>
<li<?php if($_GET['op']=='edit') { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=album&amp;op=edit&amp;albumid=<?php echo $albumid;?>">�༭�����Ϣ</a></li>
<li<?php if($_GET['op']=='editpic') { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?php echo $albumid;?>">�༭ͼƬ</a></li>
<li class="y"><a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;view=me">&laquo; ��������б�</a></li>
</ul>
<?php } if($_GET['op'] == 'edit') { ?>

<form method="post" autocomplete="off" id="theform" name="theform" action="home.php?mod=spacecp&amp;ac=album&amp;op=edit&amp;albumid=<?php echo $albumid;?>">
<table cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th><label for="albumname">�����</label></th>
<td><input type="text" id="albumname" name="albumname" value="<?php echo $album['albumname'];?>" size="20" class="px" /></td>
</tr>

<?php if($categoryselect) { ?>
<tr>
<th>վ�����</th>
<td>
<?php echo $categoryselect;?>
(ѡ��һ��վ����࣬�����������ᱻ������������)
</td>
</tr>
<?php } ?>
<tr>
<th>��˽����</th>
<td>
<select name="friend" onchange="passwordShow(this.value);" class="ps">
<option value="0" <?php if($album['friend'] == 0) { ?>selected="selected"<?php } ?>>ȫվ�û��ɼ�</option>
<option value="3" <?php if($album['friend'] > 0) { ?>selected="selected"<?php } ?>>���Լ��ɼ�</option>
</select>							
</td>
</tr>
<tbody id="span_password" style="<?php echo $passwordstyle;?>">
<tr>
<th>����</th>
<td><input type="text" name="password" value="<?php echo $album['password'];?>" size="10" class="px" /></td>
</tr>
</tbody>
<tbody id="tb_selectgroup" style="<?php echo $selectgroupstyle;?>">
<tr>
<th>ָ������</th>
<td>
<select name="selectgroup" onchange="getgroup(this.value);" class="ps">
<option value="">�Ӻ�����ѡ�����</option><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><option value="<?php echo $key;?>"><?php echo $value;?></option>
<?php } ?>
</select>
<p class="d">���ѡ����ۼӵ�����ĺ�������</p>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td>
<textarea name="target_names" id="target_names" rows="3" class="pt"><?php echo $album['target_names'];?></textarea>
<p class="d">������д��������������ÿո���зָ�</p>
</td>
</tr>
</tbody>
<tr>
<th>&nbsp;</th>
<td>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="editsubmit" value="true" />
<button name="submit" type="submit" class="pn" value="true"><strong>ȷ��</strong></button>
</td>
</tr>
<tr>
<th>&nbsp;</th>
<td><a href="home.php?mod=spacecp&amp;ac=album&amp;op=delete&amp;albumid=<?php echo $album['albumid'];?>&amp;handlekey=delalbumhk_<?php echo $album['albumid'];?>" id="album_delete_<?php echo $album['albumid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">ɾ�����</a></td>
</tr>
</table>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>

<?php } elseif($_GET['op'] == 'editpic') { if($list) { ?>
<form method="post" autocomplete="off" id="theform" name="theform" action="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?php echo $albumid;?>">
<table cellspacing="0" cellpadding="0" class="tfm">
<caption>��ʾ�������ָ��һ��ͼƬ��Ϊ��ǰ���ķ���ͼƬ�����ǣ����´��ϴ��µ�ͼƬ��ϵͳ���Զ�ѡ��һ����ͼƬ�����±����ķ���ͼƬ��</caption><?php $common = ''; if(is_array($list)) foreach($list as $value) { ?><tr>
<td width="20"><input type="checkbox" name="ids[<?php echo $value['picid'];?>]" value="<?php echo $value['picid'];?>" <?php echo $value['checked'];?> class="pc"></td>
<td width="130" align="center" class="gt">
<a href="<?php echo $value['bigpic'];?>" target="_blank"><img src="<?php echo $value['pic'];?>" alt="" width="140" /></a><?php $ids .= $common.$value['picid'].':'.$value['picid']; ?><?php $common = ','; if($album['albumname']) { ?><p><a href="home.php?mod=spacecp&amp;ac=album&amp;op=setpic&amp;albumid=<?php echo $value['albumid'];?>&amp;picid=<?php echo $value['picid'];?>&amp;handlekey=setpichk" id="a_picid_<?php echo $value['picid'];?>" onclick="showWindow('setpichk', this.href, 'get', 0)">��Ϊ����</a></p><?php } ?>
</td>
<td><textarea name="title[<?php echo $value['picid'];?>]" rows="4" cols="70" class="pt"><?php echo $value['title'];?></textarea></td>
</tr>
<?php } ?>
<tr>
<td colspan="3">
<input type="checkbox" id="chkall" name="chkall" onclick="checkAll(this.form, 'ids')" class="pc" />
<label for="chkall">ȫѡ</label>
<button type="submit" name="editpicsubmit" value="true" class="pn" onclick="this.form.action+='&subop=update';"><strong>����˵��</strong></button>
<button type="submit" name="editpicsubmit" value="true" class="pn" onclick="this.form.action+='&subop=delete';return ischeck('theform', 'ids')"><strong>ɾ��</strong></button>

<?php if($albumlist) { ?>
<button type="submit" name="editpicsubmit" value="true" class="pn" onclick="this.form.action+='&subop=move';return ischeck('theform', 'ids')"><strong>ת�Ƶ�</strong></button>
<select name="newalbumid" class="ps"><?php if(is_array($albumlist)) foreach($albumlist as $key => $value) { if($albumid != $value['albumid']) { ?><option value="<?php echo $value['albumid'];?>"><?php echo $value['albumname'];?></option><?php } } if($albumid>0) { ?><option value="0">Ĭ�����</option><?php } ?>
</select>
<?php } ?>

<p class="d">ɾ��ͼƬ��ʾ�������Ҫɾ����ͼƬ������������ӡ���־�������У�ɾ���󣬻ᵼ�����������ͼƬͬʱ�޷���ʾ��,</p>
</td>
</tr>
</table>
<input type="hidden" name="page" value="<?php echo $page;?>" />
<input type="hidden" name="editpicsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
<?php if($multi) { ?><div class="pgs cl"><?php echo $multi;?></div><?php } ?>
<script type="text/javascript">
var picObj = {<?php echo $ids;?>};
function succeedhandle_setpichk(url, msg, values) {
for(var id in picObj) {
$('a_picid_' + picObj[id]).innerHTML = "��Ϊ����";
}
if(values['picid']) {
$('a_picid_' + values['picid']).innerHTML = "����ͼƬ";
}
}
</script>
<?php } else { ?>
<div class="emp">������»�û��ͼƬ</div>
<?php } } elseif($_GET['op'] == 'delete') { ?>	
<form method="post" autocomplete="off" id="albumdeleteform" name="albumdeleteform" action="home.php?mod=spacecp&amp;ac=album&amp;op=delete&amp;albumid=<?php echo $albumid;?>&amp;uid=<?php echo $_G['gp_uid'];?>" >
<div class="popbox w570">
<div class="flb">
<div class="popbox_title clearfix">
<span>ɾ�����</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="albumform">
<li>
<label>������е�ͼƬ��</label>	
<select name="moveto" class="h36">
<option value="-1">����ɾ��</option>
<option value="0">ת�Ƶ� Ĭ�����</option><?php if(is_array($albums)) foreach($albums as $value) { if($albumid != $value['albumid']) { ?>
<option value="<?php echo $value['albumid'];?>">ת�Ƶ� <?php echo $value['albumname'];?></option>
<?php } } ?>
</select>				
</li>
<li>
<label></label>
<button type="submit" name="deletesubmit" value="true" class="button_confirm">ȷ��</button>
</li>
</ul>
</div>
</div>
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>	
</form>

<?php } elseif($_GET['op'] == 'edittitle') { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�༭˵��</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form id="titleform" name="titleform" action="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;subop=update&amp;albumid=<?php echo $pic['albumid'];?>" method="post" autocomplete="off" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="editpicsubmit" value="true" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div class="c">
<textarea name="title[<?php echo $pic['picid'];?>]" cols="50" rows="7" class="pt"><?php echo $pic['title'];?></textarea>
</div>
<p class="o pns">
<button type="submit" name="editpicsubmit_btn" class="pn pnc" value="true"><strong>����</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
$('<?php echo $_G['gp_handlekey'];?>').innerHTML = values['title'];
}
</script>
<?php } elseif($_GET['op'] == 'edithot') { ?>
<h3 class="flb">
<em>�����ȶ�</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=album&amp;op=edithot&amp;picid=<?php echo $picid;?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="hotsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
�µ��ȶ�:<input type="text" name="hot" value="<?php echo $pic['hot'];?>" size="10" class="px" />
</div>
<p class="o pns">
<button type="submit" name="btnsubmit" value="true" class="pn pnc"><strong>ȷ��</strong></button>
</p>
</form>
<?php } if($_GET['op']=='edit' || $_GET['op']=='editpic') { ?>
</div>
</div>
<div class="appl"><?php if(!empty($_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE]; ?><?php getuserapp(1); ?><ul><?php if(is_array($_G['setting']['spacenavs'])) foreach($_G['setting']['spacenavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { if(in_array($nav['code'], array('userpanelarea1', 'userpanelarea2'))) { if(!empty($_G['my_panelapp']) && $_G['setting']['my_app_status']) { if($nav['code']=='userpanelarea1' && !empty($_G['my_panelapp']['1'])) { if(is_array($_G['my_panelapp']['1'])) foreach($_G['my_panelapp']['1'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?php echo $app['appid'];?>" title="<?php echo $app['appname'];?>"><img <?php if($app['icon']) { ?>src="<?php echo $app['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $app['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $app['appid'];?>"<?php } ?> name="<?php echo $appid;?>" alt="<?php echo $app['appname'];?>" /><?php echo $app['appname'];?></a>
</li>
<?php } } elseif($nav['code']=='userpanelarea2' && !empty($_G['my_panelapp']['2'])) { if(is_array($_G['my_panelapp']['2'])) foreach($_G['my_panelapp']['2'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?php echo $app['appid'];?>" title="<?php echo $app['appname'];?>"><img <?php if($app['icon']) { ?>src="<?php echo $app['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $app['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $app['appid'];?>"<?php } ?> name="<?php echo $appid;?>" alt="<?php echo $app['appname'];?>" /><?php echo $app['appname'];?></a>
</li>
<?php } } } } else { ?>
<?php echo $nav['code'];?>
<?php } } } ?>
</ul>
<?php if($_G['setting']['my_app_status']) { if(!empty($_G['cache']['userapp'])) { ?>
<ul id="my_defaultapp"><?php if(is_array($_G['cache']['userapp'])) foreach($_G['cache']['userapp'] as $value) { ?><li><a href="userapp.php?mod=app&amp;id=<?php echo $value['appid'];?>"><img <?php if($value['icon']) { ?>src="<?php echo $value['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $value['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $value['appid'];?>"<?php } ?> alt="<?php echo $value['appname'];?>" /><?php echo $value['appname'];?></a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_top'])) echo $_G['setting']['pluginhooks']['userapp_menu_top']; ?>
</ul>
<?php } if($_G['my_menu']) { ?>
<ul id="my_userapp"><?php if(is_array($_G['my_menu'])) foreach($_G['my_menu'] as $value) { ?><li id="userapp_li_<?php echo $value['appid'];?>"><a href="userapp.php?mod=app&amp;id=<?php echo $value['appid'];?>" title="<?php echo $value['appname'];?>"><img <?php if($value['icon']) { ?>src="<?php echo $value['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $value['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $value['appid'];?>"<?php } ?> alt="<?php echo $value['appname'];?>" /><?php echo $value['appname'];?></a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_middle'])) echo $_G['setting']['pluginhooks']['userapp_menu_middle']; ?>
</ul>
<?php } if($_G['my_menu_more']) { ?>
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">չ��</a></p>
<?php } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?php echo IMGDIR;?>/app_add.gif" alt="app_add" />���<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?php echo IMGDIR;?>/app_set.gif" alt="app_set" />����<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
</ul>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script></div>
</div>
<?php } include template('common/footer'); ?>