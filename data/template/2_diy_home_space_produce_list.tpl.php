<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_produce_list', 'common/header');
0
|| checktplrefresh('./template/default/home/space_produce_list.htm', './template/default/common/simplesearchform.htm', 1509518977, 'diy', './data/template/2_diy_home_space_produce_list.tpl.php', './template/8264', 'home/space_produce_list')
|| checktplrefresh('./template/default/home/space_produce_list.htm', './template/default/common/userabout.htm', 1509518977, 'diy', './data/template/2_diy_home_space_produce_list.tpl.php', './template/8264', 'home/space_produce_list')
|| checktplrefresh('./template/default/home/space_produce_list.htm', './template/8264/home/space_userabout.htm', 1509518977, 'diy', './data/template/2_diy_home_space_produce_list.tpl.php', './template/8264', 'home/space_produce_list')
;?>
<?php $friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见'); if(empty($diymode)) { include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="搜索本版">搜索本版</label></li>
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
 /><label for="mod_article" title="搜索文章">文章</label></li>
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
 /><label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
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
 /><label for="mod_blog" title="搜索日志">日志</label></li>
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
 /><label for="mod_album" title="搜索相册">相册</label></li>
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
 /><label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="搜索用户">用户</label></li>
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
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=album">相册</a>
<?php if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me"><?php echo $space['username'];?>的相册</a>
<?php } ?>
</div>
</div>

<style id="diy_style" type="text/css"></style>

<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bw0">
<?php if((!$_G['uid'] && !$space['uid']) || $space['self']) { ?>
<h1 class="mt"><img alt="album" src="http://static.8264.com/static/image/feed/album.gif" class="vm" /> 相册</h1>
<?php } if($space['self']) { ?>
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=we">好友的相册</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=me">我的相册</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;view=all">随便看看</a></li>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=upload">上传图片</a></li>
</ul>
<?php } else { ?><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=album&amp;view=me\">TA的所有相册</a>"; include template('home/space_menu'); } if($space['self'] && $_GET['view']=='me') { ?>
<p class="tbmu">
下面列出的是你自行创建相册列表。<br />
						你在日志里面上传的图片附件，全部存放在 <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=album&amp;id=-1" style="font-weight: 700;">系统默认相册</a> 里面。
</p>
<?php } if($_GET['view'] == 'all') { ?>
<div class="tbmu cl">
<?php if($_GET['view']=='all' && $_G['setting']['albumcategorystat'] && $category) { ?>	
<div class="y">
<select name="albumlist" id="albumlist" width="68" onchange="location.href='home.php?mod=space&do=album&catid='+this.value+'&view=all'">
<option value="">分类浏览</option><?php if(is_array($category)) foreach($category as $value) { ?><option value="<?php echo $value['catid'];?>"<?php if($_GET['catid']==$value['catid']) { ?> selected="selected"<?php } ?>><?php echo $value['catname'];?></option>
<?php } ?>
</select>
</div>
<?php } ?>
<a href="home.php?mod=space&amp;do=album&amp;view=all&amp;order=dateline" <?php echo $orderactives['dateline'];?>>最新更新的相册</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=album&amp;view=all&amp;order=hot" <?php echo $orderactives['hot'];?>>热门图片推荐</a>
</div>
<?php } if(($_GET['view'] == 'we') && $userlist) { ?>
<p class="tbmu">
按好友筛选
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
</p>
<?php } } else { include template('home/space_header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<div id="ct" class="ct2 wp cl">
<div class="mn">
<div class="bm">
<div class="bm_h cl">
<h1 class="mt"><span class="z">装备分享</span><?php if($space['self']) { ?><span class="xs1 xw0 y"> <a href="http://www.8264.com/zb-public">分享新装备</a> </span><?php } ?></h1>
</div>
<div class="bm_c">
<?php } ?>
                       
<div class="tbmu cl">
                <a href="http://u.8264.com/home-space-uid-<?php echo $space['uid'];?>-do-produce-view-me-from-space.html"><?php if($space['self']) { ?>我的<?php } else { ?>TA的<?php } ?>装备分享</a>
    
    <a style="float:right;padding-right:10px;" href="http://www.8264.com/zb" target="_blank">返回装备分享主页</a>
</div>		    
            <style type="text/css">
.showbox{ width:737px; text-align:left; margin:0 auto; margin-top:10px; margin-left:7px;}
.grid_4col{ display:inline; float:left; margin-right:8px; width:232px;}
.oumiga{ margin-left:0;}
.product_item {background: url("images/produce_bottom_shadow.gif") no-repeat scroll 0 bottom transparent;color: #666666;
                           overflow: hidden;width: 232px;}
.product_item .jiage{ background: none repeat scroll 0 0 #FFFFFF;bottom: 0;color: #000000;right:1px;opacity: 0.5;padding: 2px;position: absolute;right: 1;border-radius:4px 4px 4px 4px; filter: alpha(opacity=50); border-left:0px solid; border-right:0px solid;}			   
.product_item .inner {background: none repeat scroll 0 0 #FAFAFA;border: 1px solid #E6E6E6;overflow: hidden;width: 230px;margin-bottom: 10px;}
.product_item .white_border {background: none repeat scroll 0 0 #FAFAFA; border: 1px solid #FFFFFF; width: 228px;}
.product_item .image {margin: 9px auto;overflow: hidden;position: relative;width: 210px;}
.product_item .tag {margin: 8px;}
.product_item .product_userinfo {margin: 5px auto;overflow: hidden;width: 210px;}
.product_item .datetime {color: #888888; float:right;}
.product_item .stat {background: none repeat scroll 0 0 #F2F2F2;color: #333333;height: 30px;line-height: 30px;margin-top: 10px;padding: 0 10px;text-align: right;}
.product_item .stat img {vertical-align: middle;}
#loadding_ico {padding: 5px 0;text-align: center;width: 100%;}
.clear {clear: both;display: block;height: 0;overflow: hidden;visibility: hidden;width: 0;}
</style> 
            
            <?php if($count) { ?>       
            <div class="showbox">
                 <div class="grid_4col oumiga">  
                 
                     
                 </div>
                 <div class="grid_4col">     
                 
                 
                 </div>
                 <div class="grid_4col">       
             
                 </div>
                 <div class="clear"></div>
                <div id="loadding_ico">
                <span>正在加载...</span>
                </div>  
                <?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } ?> 
                <script src="http://static.8264.com/static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
                jQuery.noConflict();
                </script>
<script type="text/javascript">
                ;(function($){
var load_lock = false;
var box_index = 0; // 初始变量
var ppp = <?php echo $_G['tpp'];?>;
var incream_num = 10;
var showed_num = 0;  

function getMinHeightBoxIndex() {

var min_height = jQuery('.grid_4col').eq(0).height();
var min_index = 0;
var box_num = jQuery('.grid_4col').size();
for (var i = 1; i < box_num; ++i) {
if (jQuery('.grid_4col').eq(i).height() < min_height) {
min_height = jQuery('.grid_4col').eq(i).height();
min_index = i;
}
}
return min_index;
}
                    

function loadData(){

if (load_lock) return;

var window_height = $(window).scrollTop() + $(window).height();
var loadding_ico_top = $('#loadding_ico').offset().top;			

if (window_height >= loadding_ico_top) {
load_lock = true;
$('#loadding_ico span').css('display', 'inline-block');

var data = 'limit='+((<?php echo $_G['page'];?> - 1) * ppp + showed_num)+','+incream_num+'&type=<?php echo $_G['gp_view'];?>';						

$.ajax({
type: 'GET',					

url: '/plugin.php?id=produce:ajax_getproductathome&uid=<?php echo $space['uid'];?>',

dataType: 'json',
data: data,						
success: function(html){
                      for (var i in html) {
var item = html[i];
if ($('#product_tid_'+item['tid']).size() > 0) {
continue;
}							
box_index = getMinHeightBoxIndex();
if(typeof (item['cpxh']-0) == 'number' && item['cpxh']== 1 ){
item['cpxh']="<span class='cpxh' style='width:78px;'><img src='source/plugin/produce/images/zr.gif'></span>";	
}else if(typeof (item['cpxh']-0) == 'number' && item['cpxh']==2){
item['cpxh']="<span class='cpxh' style='width:108px;'><img src='source/plugin/produce/images/tzb.gif'></span>";		
}else{
item['cpxh']="";	
}
if(typeof (item['digest']-0) == 'number' && item['digest']== 1 ){
item['digest']="<span class='digest' style='float:left;width:74px;'><img src='source/plugin/produce/images/digest.png'></span>";		
}else{
item['digest']="";		
}
$('<div class="product_item" id="product_tid_'+item['tid']+'"><div class="inner"><div class="white_border"><div class="image"><a href="http://bbs.8264.com/thread-'+item['tid']+'-1-1.html" target="_blank"><img src="http://bbs.8264.com/data/attachment/plugin/'+item['cptp']+'.thumb210.jpg'+'" /></a></div><div class="tag">'+item['digest']+''+item['cpxh']+'</div><div class="product_userinfo"><div class="product_userinfo_text"> <a href="http://bbs.8264.com/thread-'+item['tid']+'-1-1.html"  onclick="atarget(this)">'+item['subject']+'</a>&nbsp;&nbsp;&nbsp;&nbsp;'+item['dateline']+'</div></div><div class="stat"><a href="http://bbs.8264.com/thread-'+item['tid']+'-1-1.html" target="_blank">'+item['views']+'</a> 人访问 &nbsp; <img src="http://bbs.8264.com/source/plugin/produce/css/images/icon1.gif" alt="" /> <a href="http://bbs.8264.com/thread-'+item['tid']+'-1-1.html" target="_blank">我来说说</a></div></div></div></div>').css('display', 'none').appendTo($('.grid_4col').eq(box_index)).fadeIn(1000);
  }						
  showed_num += incream_num;
  if (showed_num >= 20) {
     load_lock = true;
  } else if (html.length < incream_num) { //返回内容少于指定个数(己到达末尾)
     load_lock = true;
  } else {
     load_lock = false;
  }												
  $('#loadding_ico span').css('display', 'none');						 
},
error: function() {
$('#loadding_ico span').css({'padding':'0','background':'none'}).text('网络出现故障, 加载失败.');
}
});
}
}					
function initProducts() {
    <?php $product_list = $list; ?>var html = new Array();<?php if(is_array($product_list)) foreach($product_list as $i => $item) { ?>html[<?php echo $i;?>] = new Array();<?php if(is_array($item)) foreach($item as $j => $j_item) { ?><?php $j_value = addcslashes($j_item, "\\'"); ?>html[<?php echo $i;?>]['<?php echo $j;?>'] = '<?php echo $j_value;?>';
<?php } } ?>	
for (var i in html) {
var item = html[i];
box_index = getMinHeightBoxIndex();
if(typeof (item['cpxh']-0) == 'number' && item['cpxh']== 1 ){
item['cpxh']="<span class='cpxh' style='width:78px;'><img src='source/plugin/produce/images/zr.gif'></span>";	
}else if(typeof (item['cpxh']-0) == 'number' && item['cpxh']==2){
item['cpxh']="<span class='cpxh' style='width:108px;'><img src='source/plugin/produce/images/tzb.gif'></span>";		
}else{
item['cpxh']="";	
}
if(typeof (item['digest']-0) == 'number' && item['digest']== 1 ){
item['digest']="<span class='digest' style='float:left;width:74px;'><img src='source/plugin/produce/images/digest.png'></span>";		
}else{
item['digest']="";		
}
if(item['tag']==0){
  var tag = 'TA真实用过';
}else if(item['tag']==1){
  var tag = 'TA用过的';		
}else if(item['tag']==2)	{
  var tag = 'TA分享的';	
}else if(item['tag']==3){
  var tag = 'TA喜欢的';	
}else{
  var tag = '';		
    }							
$('<div class="product_item" id="product_tid_'+item['tid']+'"><div class="inner"><div class="white_border"><div class="image"><a href="http://www.8264.com/zb-'+item['tid']+'" target="_blank"><img src="'+item['cptp']+'.thumb210.jpg'+'" /></a>'+(item['tag']!='' ? '<span class="jiage">'+tag+'</span>' : '<span class="jiage">￥'+item['cpjg']+'</span>')+'</div><div class="tag">'+item['digest']+''+item['cpxh']+'</div><div class="product_userinfo"><div class="product_userinfo_text"> <a href="http://www.8264.com/zb-'+item['tid']+'" target="_blank" onclick="atarget(this)">'+item['subject']+'</a>&nbsp;&nbsp;&nbsp;&nbsp;'+item['dateline']+'</div></div><div class="stat"><a href="http://www.8264.com/zb-'+item['tid']+'" target="_blank">'+item['views']+'</a> 人访问 &nbsp; <img src="http://www.8264.com/source/plugin/produce/css/images/icon1.gif" alt="" /> <a href="http://www.8264.com/zb-'+item['tid']+'" target="_blank">我来说说</a></div></div></div></div>').appendTo($('.grid_4col').eq(box_index));
}
showed_num = $('.product_item').size();		
$('#loadding_ico span').css('display', 'none');				
//$(window).scroll(loadData).resize(loadData);				
          }
        initProducts();                
                })(jQuery);
                </script>                          
</div>  
            <?php } else { ?>
<div class="emp">没有可浏览的列表。</div>
<?php } ?>


<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=album&view=we&fuid='+fuid;
}
</script>

<?php if(empty($diymode)) { ?>
</div>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
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
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">展开</a></p>
<?php } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?php echo IMGDIR;?>/app_add.gif" alt="app_add" />添加<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?php echo IMGDIR;?>/app_set.gif" alt="app_set" />管理<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
</ul>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script></div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<?php } else { ?>
</div>
</div>
</div>
<div class="sd"><div id="pcd" class="bm cl">
<div class="hm">
<p><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo avatar($space[uid],middle); ?></a></p>
<h2 class="xs2"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo $space['username'];?></a></h2>
</div>
<?php if(file_exists(DISCUZ_ROOT.'/source/plugin/userverify/UserVerify.php')) { ?><?php require_once DISCUZ_ROOT.'/source/plugin/userverify/UserVerify.php'; ?><?php UserVerify::renderUserInfoHtml($space['uid']); } ?>
<ul class="xl xl2 cl ul_list">
<?php if($space['self']) { ?>
<li class="ul_diy"><a href="home.php?mod=space&amp;diy=yes">装扮空间</a></li>
<li class="ul_msg"><a href="home.php?mod=space&amp;do=wall">查看留言</a></li>
<li class="ul_avt"><a href="home.php?mod=spacecp&amp;ac=avatar">编辑头像</a></li>
<li class="ul_profile"><a href="home.php?mod=spacecp&amp;ac=profile">更新资料</a></li>
<?php } else { ?><?php require_once libfile('function/friend');$isfriend=followed_by_me($_G[uid], $space[uid]); ?><li class="ul_add" <?php if($isfriend) { ?>style="display:none;"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=addfriendhk_<?php echo $space['uid'];?>" id="a_friend_li_<?php echo $space['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">添加关注</a></li>
<li class="ul_ignore" <?php if(! $isfriend) { ?>style="display:none;"<?php } ?>><a href="javascript:void(0);" class="unfollow" fuid="<?php echo $space['uid'];?>">取消关注</a></li>
<li class="ul_contect"><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=wall">给我留言</a></li>
<li class="ul_poke"><a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=<?php echo $space['uid'];?>&amp;handlekey=propokehk_<?php echo $space['uid'];?>" id="a_poke_<?php echo $space['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">打个招呼</a></li>
<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;touid=<?php echo $space['uid'];?>">发送消息</a></li>
<!--<li class="ul_pm"><a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $space['uid'];?>&amp;touid=<?php echo $space['uid'];?>&amp;pmid=0&amp;daterange=2" id="a_sendpm_<?php echo $space['uid'];?>" onclick="showWindow('showMsgBox', this.href, 'get', 0)">发送消息</a></li>-->
<?php } ?>
</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser') || $_G['adminid'] == 1) { ?>
<hr class="da mtn m0">
<ul class="ptn xl xl2 cl">
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<li>
<?php if(checkperm('allowbanuser')) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?php echo $space['username'];?>&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?php echo $space['uid'];?><?php } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<?php } else { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?php echo $space['username'];?>&submit=yes&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $space['uid'];?><?php } ?>" id="usermanageli" onmouseover="showMenu(this.id)" class="showmenu" target="_blank">用户管理</a>
<?php } ?>
</li>
<?php } if($_G['adminid'] == 1) { ?>
<li><a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?php echo $space['username'];?>" id="umanageli" onmouseover="showMenu(this.id)" class="showmenu">内容管理</a></li>
<?php } ?>
</ul>
<?php if(checkperm('allowbanuser') || checkperm('allowedituser')) { ?>
<ul id="usermanageli_menu" class="p_pop" style="width: 80px; display:none;">
<?php if(checkperm('allowbanuser')) { ?>
<li><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=ban&username=<?php echo $space['username'];?>&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=ban&uid=<?php echo $space['uid'];?><?php } ?>" target="_blank">禁止用户</a></li>
<?php } if(checkperm('allowedituser')) { ?>
<li><a href="<?php if($_G['adminid'] == 1) { ?>admin.php?action=members&operation=search&username=<?php echo $space['username'];?>&submit=yes&frames=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $space['uid'];?><?php } ?>" target="_blank">编辑用户</a></li>
<?php } ?>
</ul>
<?php } if($_G['adminid'] == 1) { ?>
<ul id="umanageli_menu" class="p_pop" style="width: 80px; display:none;">
<li><a href="admin.php?action=threads&amp;users=<?php echo $space['username'];?>" target="_blank">管理帖子</a></li>
<li><a href="admin.php?action=doing&amp;searchsubmit=1&amp;users=<?php echo $space['username'];?>" target="_blank">管理记录</a></li>
<li><a href="admin.php?action=blog&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理日志</a></li>
<li><a href="admin.php?action=feed&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理动态</a></li>
<li><a href="admin.php?action=album&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理相册</a></li>
<li><a href="admin.php?action=pic&amp;searchsubmit=1&amp;users=<?php echo $space['username'];?>" target="_blank">管理图片</a></li>
<li><a href="admin.php?action=comment&amp;searchsubmit=1&amp;authorid=<?php echo $space['uid'];?>" target="_blank">管理评论</a></li>
<li><a href="admin.php?action=share&amp;searchsubmit=1&amp;uid=<?php echo $space['uid'];?>" target="_blank">管理分享</a></li>
<li><a href="admin.php?action=threads&amp;operation=group&amp;users=<?php echo $space['username'];?>" target="_blank">群组主题</a></li>
<li><a href="admin.php?action=prune&amp;searchsubmit=1&amp;operation=group&amp;users=<?php echo $space['username'];?>" target="_blank">群组帖子</a></li>
</ul>
<?php } } ?>
</div>
</div>
<script type="text/javascript">
setTimeout(function() {
jQuery(document).ready(function() {
/*unfollow to somebody*/
jQuery("li.ul_ignore a.unfollow").off("click").click(function(e) {
var uid = jQuery(this).attr("fuid");
var url = "home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=%uid&amp;confirm=1";
url = url.replace(/%uid/g, uid).replace(/&amp;/g, "&");
dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, {uid:uid}, function(data) {
if(data == 'success') {
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
jQuery("li.ul_add").show();
jQuery("li.ul_ignore").hide();
}
});
});
e.preventDefault();
});
});
}, 3000);
function callback_follow_successfully(mutual) {
jQuery("li.ul_add").hide();
jQuery("li.ul_ignore").show();
}
</script></div>
</div>
<?php } include template('common/footer'); ?>