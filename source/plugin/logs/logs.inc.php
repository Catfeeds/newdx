<?php
/**
 * @author JiangHong
 * @copyright 2012
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

require_once dirname(__file__) . "/logs.class.php";
?>
<style>
.hidden{display: none;}
#search_info td,#search_info th{border-bottom: 1px solid #CCC;padding: 10px;border-right: dotted 2px #BBB;}
#tips{color:red;font-weight: bold;}
#search_info td p{line-height: 18px;}
#mscontrl{position:fixed;background:#CFF;padding:8px;}
#nowpage{color:blue;}
.red{color:red;}
.prev,.next, .maxpage{text-align:center;font-size:14px;font-weight:bold;color:blue;cursor:pointer;}
</style>
<p id="mscontrl"><input type="checkbox" id="autoload" name="autoload" checked="true"/>自动刷新(15秒) &nbsp;&nbsp;&nbsp;&nbsp;剩余<span id="showtime" style="padding:0 5px;color:red;font-weight:700;">16</span>秒,<a href="javascript:;" id="nowref">立刻刷新</a>&nbsp;&nbsp;当前第<b id="nowpage">1</b>页</p>
<div id="search_bar" style="margin: 40px;">
<span><a href="javascript:;" id="del_logs">删除当显示日志</a><b style="margin: 0 10px;">|</b><a href="javascript:;" id="getnew">刷新</a></span>
<span></span>
<select id="search_type">

</select>
<span></span>
<select id="search_yearmonth" class="hidden">
<option value="">选择年月</option>
</select>
<span></span>
<select id="search_day" class="hidden">
<option value="">选择日期</option>
</select>
<span id="tips"></span>
<div id="search_info">
<?php
showtableheader();
?>
<tr class="header">
    <th>年月</th>
    <th>日期</th>
</tr>
<?php
showtablefooter();
?>
</div>
</div>
<script type="text/javascript" src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
	var reftime = 15;
    function search_type(){
        $prev = $('#search_type').prev();
        $('#search_type').nextAll('select').addClass('hidden');
        $prev.html("<img src='/static/image/common/loading.gif'/>");
        $.ajax({
            type:"GET",
            url:"plugin.php?id=logs:ajax_getlogs&inajax=1&method=search_type",
            dateType:"string",
            success: function(data){
                $prev.html('');
                $('#search_type').html(data);
            }
        });
    }
    search_type();
    $('select:not(:last)').change(function(){
        var $type = $(this).val();
        $(this).nextAll("select").val('').addClass('hidden');
        var $loading = $(this).next()
        var $next = $loading.next();
        var $method = $next.attr('id');
        $loading.html("<img src='/static/image/common/loading.gif'/>");
        $.ajax({
            type:"GET",
            url:"plugin.php?id=logs:ajax_getlogs&inajax=1&method="+$method+"&key="+$type,
            dateType:"string",
            success: function(data){
                $loading.html('&nbsp;&nbsp;&nbsp;&nbsp;');
                $next.removeClass('hidden').html("");
                $next.html(data);
                $('#tips').html('');
            }
        });
    });
	function doajax(page){
		var $page = $('#nowpage').text();
		if(typeof(page) == 'string'){$page = page;}
		$("#search_info").html("<img style='margin:100px 300px;' src='/static/image/common/loading.gif'/>");
        var $type = $('#search_type').val();
        var $yearmonth = $('#search_yearmonth').val();
        var $day = $('#search_day').val();
        $.ajax({
            type:"GET",
            url:"plugin.php?id=logs:ajax_getlogs&inajax=1&method=getinfo&type="+$type+"&yearmonth="+$yearmonth+"&day="+$day+"&nowpage="+$page,
            dateType:"string",
            success: function(data_return){
                $("#search_info").html(data_return);
                $('#tips').html('');
            }
        });
	}
	$('#nowref').bind('click', '', doajax);
	$('#search_bar').live('change','',doajax);
	$('.prev').live('click', function(){
		var page = $(this).attr('page');
		$('#autoload').attr('checked', false);
		doajax(page);
		$('#nowpage').text(page);
	});
	$('.next').live('click', function(){
		var page = $(this).attr('page');
		$('#autoload').attr('checked', false);
		doajax(page);
		$('#nowpage').text(page);
	});
	function auto(){
		reftime = 16;
		if($('#autoload').is(':checked')){
			doajax();
		}
	}
	function showtime(){
		reftime--;
		//if($('#autoload').is(':checked')){
			if(reftime>=0){
				$('#showtime').html(reftime);
			}
		//}
	}
	setInterval(auto,15000);
	setInterval(showtime,1000);
    $('#del_logs').click(function(){
        var $type = $('#search_type').val();
        var $yearmonth = $('#search_yearmonth').val();
        var $day = $('#search_day').val();
        if(confirm('是否确定删除？')){
            $.ajax({
                type:"GET",
                url: "plugin.php?id=logs:ajax_getlogs&inajax=1&method=del_logs&type="+$type+"&yearmonth="+$yearmonth+"&day="+$day,
                dateType:"string",
                success: function(data){
                    $('#tips').html(data);
                    search_type();
                }
            });
        }
    });
    $('#getnew').click(function(){
        search_type();
    });
})(jQuery);
</script>
