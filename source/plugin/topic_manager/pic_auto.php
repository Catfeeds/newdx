<?php
/**
 * @todo 用于解决论坛切换宽窄版时，图片大小变化的问题
 * @author jianghong
 * @version 2012.8.9
 */
 ?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	$("#wh").live("click",function(){
		$("img.zoom").css('max-width',$("div.t_fsz td.t_f:first").width());
    });
	$("img.zoom").css('max-width',$("#postlist div table tr td.plc div.pct:first").width());
    var $post = $("#postlist div table tr td.plc div.pct");
	for(i=0;i<$post.length;i++){
		var obj = $post.eq(i);
		var ggwidth = 0;
        $ggobj = obj.children(".a_pr");
        ggwidth = $ggobj.width();
        var maxwidth = $post.width();
        var $index = "";
        if(ggwidth > 0){
            var $bottom = $ggobj.offset().top + $ggobj.height() + 10;
            if(obj.find("img.zoom:first").offset().top <= $bottom){
                $index = ":gt(0)";
                obj.find("img.zoom:first").css('max-width',(maxwidth-ggwidth-10));
            }
        }
        obj.find("img.zoom"+$index).css('max-width',maxwidth);
	}
})(jQuery);
</script>