<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_related_article', 'common/header');?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<?php if(($op == 'manual')) { if($ra) { ?>
<li id="<?php echo $ra['aid'];?>">
<em><?php echo $ra['title'];?></em>
<span class="xg1">
<a href="javascript:;" onclick="uparticle(<?php echo $ra['aid'];?>);" title="����"><img class="vm" src="<?php echo IMGDIR;?>/icon_top.gif" alt="����" /></a>
<a href="javascript:;" onclick="downarticle(<?php echo $ra['aid'];?>);" title="����"><img class="vm" src="<?php echo IMGDIR;?>/icon_down.gif" alt="����" /></a>
<a href="javascript:;" onclick="delarticle(<?php echo $ra['aid'];?>);" title="ɾ��"><img class="vm" src="<?php echo IMGDIR;?>/data_invalid.gif" alt="ɾ��" /></a>
</span>
</li>
<?php } } elseif(($op == 'get')) { if(is_array($articlelist)) foreach($articlelist as $list) { ?><li id="<?php echo $list['aid'];?>">
<em><?php echo $list['title'];?></em>
<span class="xg1">
<a href="javascript:;" onclick="uparticle(<?php echo $list['aid'];?>);" title="����"><img class="vm" src="<?php echo IMGDIR;?>/icon_top.gif" alt="����" /></a>
<a href="javascript:;" onclick="downarticle(<?php echo $list['aid'];?>);" title="����"><img class="vm" src="<?php echo IMGDIR;?>/icon_down.gif" alt="����" /></a>
<a href="javascript:;" onclick="delarticle(<?php echo $list['aid'];?>);" title="ɾ��"><img class="vm" src="<?php echo IMGDIR;?>/data_invalid.gif" alt="ɾ��" /></a>
</span>
</li>
<?php } } elseif(($op == 'search')) { if(is_array($articlelist)) foreach($articlelist as $list) { ?><li>
<input type="checkbox" name="article" id="article_<?php echo $list['aid'];?>_pc" class="pc" value="<?php echo $list['aid'];?>" onclick="getarticlenum();"/> 
<label for="article_<?php echo $list['aid'];?>_pc" id="article_<?php echo $list['aid'];?>"><?php echo $list['title'];?></label>
</li>
<?php } } elseif(($op == 'add')) { if(is_array($articlelist)) foreach($articlelist as $ra) { ?><li id="raid_li_<?php echo $ra['aid'];?>">
<input type="hidden" name="raids[]" value="<?php echo $ra['aid'];?>" size="5">
<a href="portal.php?mod=view&amp;aid=<?php echo $ra['aid'];?>" target="_blank"><?php echo $ra['title'];?></a> 
(���� ID: <?php echo $ra['aid'];?>)
<a href="javascript:;" onclick="raid_delete(<?php echo $ra['aid'];?>);" class="xg1">ɾ��</a>
</li>
<?php } } else { ?>
<h3 class="flb">
<em>�����������</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<div class="c bart">
<div class="pns cl">
<div class="y">
���� ID:
<input type="text" name="manualid" id="manualid" class="px vm" value="0" size="10" />&nbsp;
<button type="button" name="raid_button" class="pn" value="false" onclick="manualadd();"><em>�ֹ����</em></button>
</div>
<?php echo $category;?> 
<input type="text" name="searchkey" id="searchkey" class="px vm" value="<?php echo $searchkey;?>" size="10" />&nbsp;
<button type="button" name="search_button" class="pn vm" value="false" onclick="articlesearch();"><em>����</em></button>
</div>
<div class="cl">
<div class="z">
<p class="mtm mbn">��ѡ(<span id="articlenum">0</span>/<span id="articlenumall"><?php echo $count;?></span> �����ʾ50��)</p>
<ul id="articlelist" class="bartl"><?php if(is_array($articlelist)) foreach($articlelist as $list) { ?><li>
<input type="checkbox" name="article" id="article_<?php echo $list['aid'];?>_pc" class="pc" value="<?php echo $list['aid'];?>" onclick="getarticlenum();"/> 
<label for="article_<?php echo $list['aid'];?>_pc" id="article_<?php echo $list['aid'];?>"><?php echo $list['title'];?></label>
</li>
<?php } ?>
</ul>
</div>
<div class="barto">
<button name="choosebutton" class="pn" onclick="choosearticle();" title="��ѡ������Ϊ��ѡ"><em>&gt;</em></button>
</div>
<div class="y">
<p class="mtm mbn">��ѡ(<strong id="selectednum" class="xi1">0</strong>)</p>
<ul id="selectedarticle" class="bartl"></ul>
</div>
</div>
</div>
<p class="o pns">
<input type="hidden" id="selectedarray" name="selectedarray" value="" />
<button type="submit" name="dsf" class="pn pnc" onclick="addrelatearticle();"><span>ȷ��</span></button>
<button type="reset" name="dsf" class="pn" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"><em>ȡ��</em></button>
</p>

<script type="text/javascript">
function choosearticle() {
var article = document.getElementsByName("article");
for(var i = 0; i < article.length; i++){
if(article[i].checked) {
var choosed = $("article_"+article[i].value).innerHTML;
choosed ='<li id="'+article[i].value+'"><em>'+choosed+'</em><span class="xg1"><a href="javascript:;" onclick="uparticle('+article[i].value+');" title="����"><img class="vm" src="<?php echo IMGDIR;?>/icon_top.gif" alt="����" /></a> <a href="javascript:;" onclick="downarticle('+article[i].value+');" title="����"><img class="vm" src="<?php echo IMGDIR;?>/icon_down.gif" alt="����" /></a> <a href="javascript:;" onclick="delarticle('+article[i].value+');" title="ɾ��"><img class="vm" src="<?php echo IMGDIR;?>/data_invalid.gif" alt="ɾ��" /></a></span></li>';
if(!$(article[i].value)) {
$("selectedarticle").innerHTML += choosed;
}
}
}
updatearticlearray();
}
function uparticle(id) {
var lastid = getdivid(id, 'last');
if(lastid) {
var lastdiv = $(lastid);
        var div = $(id);
$("selectedarticle").insertBefore(div,lastdiv);
}
updatearticlearray();
}
function downarticle(id) {
var nextid = getdivid(id, 'next');
if(nextid) {
var nextdiv = $(nextid);
        var div = $(id);
$("selectedarticle").insertBefore(nextdiv,div);
}
updatearticlearray();
}
function delarticle(id) {
var div = $(id);
div.parentNode.removeChild(div);
updatearticlearray();
}
function updatearticlearray() {
var list = document.getElementById("selectedarticle").getElementsByTagName("li");
var str = '';
for(var i = 0; i < list.length; i++)
{
if(str == '') {
str = list[i].id;
} else {
str = str + ',' + list[i].id;
}
       
}
$('selectedarray').value = str;
$('selectednum').innerHTML = list.length;
}
function getdivid(id,type) {
var str = $('selectedarray').value;
    var arr = new Array();
var rstr = '';
arr = str.split(",");

for (var i = 0; i < arr.length; i++) {
if (arr[i] == id) {
if(type == 'last') {
if(arr[i-1]) {
rstr = arr[i-1];
}
} else if(type == 'next') {
if(arr[i+1]) {
rstr = arr[i+1];
}
}
break;
}
}
return rstr;
}
function manualadd() {
var manualid = $('manualid').value;
if($(manualid)) {
alert('�������Ѿ���ӹ���');
return false;
}
var url = 'portal.php?mod=portalcp&ac=related&op=manual&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&manualid='+manualid;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$('selectedarticle').innerHTML += s;
updatearticlearray();
} else {
alert('û���ҵ�ָ��������');
return false;
}
});
}
function articlesearch() {
var searchkey = $('searchkey').value;
var searchcate = $('searchcate').value;
var url = 'portal.php?mod=portalcp&ac=related&op=search&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&searchkey='+searchkey+'&searchcate='+searchcate;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$('articlelist').innerHTML = s;
getarticlenum();
} else {
$('articlelist').innerHTML = '';
getarticlenum();
return false;
}
});

}
function getarticlenum() {
var article = document.getElementsByName("article");
for(var i = 0, j = 0; i < article.length; i++){
if(article[i].checked) {
j++;
}
}
$('articlenum').innerHTML = j;
$('articlenumall').innerHTML = article.length;
}
function addrelatearticle() {
var relatedid = $("selectedarray").value;
if(relatedid) {
var url = 'portal.php?mod=portalcp&ac=related&op=add&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&relatedid='+relatedid;
var x = new Ajax();	
x.get(url, function(s){
s = trim(s);
if(s) {
$('raid_div').innerHTML = '';
$('raid_div').innerHTML = s;
}
});
} else {
$('raid_div').innerHTML = '';
}
hideWindow('<?php echo $_G['gp_handlekey'];?>');
}
function getrelatedarticle() {
var input = document.getElementById("raid_div").getElementsByTagName("input");
if(input) {
var id = '';
for(var i = 0;i < input.length;i++)
{
if(id) {
id = id + ',' + input[i].value;
} else {
id = input[i].value;
}
}
if(id != '') {
var url = 'portal.php?mod=portalcp&ac=related&op=get&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&id='+id;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$("selectedarray").value = id;
$('selectedarticle').innerHTML = s;
$('selectednum').innerHTML = input.length;
}
});
}

} else {
return true;
}
}
getrelatedarticle();
</script>
<?php } include template('common/footer'); ?>