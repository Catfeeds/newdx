<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 点评系统后台管理 --- 主题管理
 */

if(! defined('IN_DISCUZ') || !defined('IN_ADMINCP')){
	exit('Access Denied');
}
include 'dianping.fun.php';
$categorys = m('categorys');
$allNode = $categorys->findAll();
$childs = array();
$allnodeids = $allNode;
foreach($allNode as $_k => $_v) {
	$childs[$_v['fatherid']][$_k] = $_v;
	if(in_array($_v['fatherid'], $allnodeids)) unset($allnodeids[$_v['fatherid']]);
}
$allnodeids = array_keys($allnodeids);
$allNode[0]['name'] = "总结点";
//echo '<pre>' . var_export($allnodeids, true) . '</pre><br />';
?>
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<div id="container">
	<p id="ajaxreturns"></p>
	<fieldset>
		<legend>管理模块</legend>
			<div id="showallview">
			</div>
	</fieldset>
</div>
<style>
#container fieldset{padding:15px;}
#showallview ul{margin-right:10px;padding:5px 10px;border:2px solid silver;float:left;}
#showallview ul li{margin-bottom: 10px;cursor:pointer;float:left;clear:both;}
.newoption{color:red;}
.cate_windows{padding:20px;}
.cate_windows input{text-align:center;}
.cate_windows p{margin:10px 0;}
.edit{display:none;color:blue;margin-left:10px;}
.green{color:green;}
.red{color:red;}
.green,.red{margin-right:5px;}
</style>
<script src="static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="static/js/jquery.form.js"></script>
<script>
jQuery.noConflict();
</script>
<script>
var murl = "/admin.php?ctl=categorysadmin";
var disallowfloat = '';
jQuery(document).ready(function($){
	$('#showallview').on('click', 'li:not(.newoption)', function(){
		var selectid = $(this).attr('value');
		$('#fwin_new').hide();
		$(this).siblings('li').each(function(){
			if($(this).attr('value') != selectid) {
				$('#fatherid_' + $(this).attr('value')).hide();
			}
		});
		$(this).parent('ul').nextAll().hide();
		$('.dannew').hide();
		$('#fatherid_' + selectid).show();
	});
	$('#showallview').on('mouseover', 'li:not(.dannew)', function(){
		$(this).find('.edit').show();
	});
	$('#showallview').on('mouseout', 'li:not(.dannew)', function(){
		$(this).find('.edit').hide();
	});
	$('#showallview').on('click', 'li b.edit', function(){
		showWindow('cate', 'admin.php?ctl=categorysadmin&act=editcate&editid=' + $(this).parent('li').attr('value'));
	});
	$('#container').on('click', 'li.newoption', function(){
		showWindow('cate', 'admin.php?ctl=categorysadmin&act=shownewcatedialog&fatherid=' + $(this).parent('ul').attr('fatherid'));
	});
	$(document).on('submit', '#newcateform', function(){
		var showids = new Array;
		$('#showallview ul:visible').each(function(){
			showids.push(this.id);
		});
		var returnajax = function(){
			for(var i=0; i<showids.length; i++){
				document.getElementById(showids[i]).style.display = '';
			}
		}
		var returnfun = function(){
			$('.fwinmask').hide();
			ajaxget(murl + '&act=getview', 'showallview', null, null, null, returnajax);
			};
		$(this).ajaxSubmit({success:returnfun,error:function(){alert('error')}});
		return false;
	});
});
ajaxget(murl + '&act=getview', 'showallview');
</script>
