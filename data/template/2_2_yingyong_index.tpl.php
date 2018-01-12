<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index', 'common/header_fav');
0
|| checktplrefresh('./template/default/yingyong/index.htm', './template/default/common/header_fav.htm', 1489368095, '2', './data/template/2_2_yingyong_index.tpl.php', './template/8264', 'yingyong/index')
;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />

<base href="<?php echo $_G['siteurl'];?>" />		

     
<script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>

    <?php if($_G['basescript'] == 'fav' || $_G['basescript'] == 'adminfav') { ?>
    	<link rel="stylesheet" type="text/css" href="data/cache/style_1_common.css" />
        <link rel="stylesheet" type="text/css" href="static/image/yingyong/fav.css" />
      	<script src="<?php echo $_G['setting']['jspath'];?>selcolor.js?<?php echo VERHASH;?>" type="text/javascript"></script>
        <script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>
        <script src="<?php echo $_G['setting']['jspath'];?>fav.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <?php } ?>
</head>
<body id="nv_<?php echo $_G['basescript'];?>" class="pg_<?php echo CURMODULE;?>" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>       <div id="addurl" class="bm_c"  style="display:block; height:270px;">
       <?php if($_G['uid']) { ?>    
      <div id="daohang_guest" class="cl" style="height:220px;">
        <table cellpadding="0" cellspacing="0" align="center">
        <tr style="border-bottom:1px solid #E6E6E6">
        <?php if(is_array($daohang)) foreach($daohang as $key => $value) { ?>   			 <td height="30" width="150" align="left" class="showem" id="edit_<?php echo $value['id'];?>" onmousemove="showedit('edit_<?php echo $value['id'];?>',1)" onmouseout="showedit('edit_<?php echo $value['id'];?>',0)">
             <div id="daohangtext" class="showem" style="width:155px;">
                 <a href="<?php echo $value['href'];?>" title="<?php echo $value['name'];?>" class="xi2" style="font-size:14px;line-height:24px;" target="_blank"> <?php if($value['color']) { ?><font class="showem" color="<?php echo $value['color'];?>"><?php echo $value['name'];?></font><?php } else { ?><?php echo $value['name'];?><?php } ?></a>
                 <span onclick="$('return_daohang').innerHTML='';changecon(this,'<?php echo $value['id'];?>','<?php echo $value['name'];?>','<?php echo $value['href'];?>','<?php echo $value['color'];?>');" class="admin_edit" title="编辑">ddff</span>
                  <span onclick="showWindow('daohang_del_<?php echo $value['id'];?>','fav.php?mod=ajax&id=<?php echo $value['id'];?>&op=del_fav')" class="admin_del" title="删除">dddd</span>
                 
             </div>
             </td>
        	 <?php if(($key+1)%5==0) { ?></tr><tr style="border-bottom:1px solid #E6E6E6"> <?php } ?>
         <?php } ?>
         </tr>
         </table>
         </div>
          <div>
            <div id="return_daohang" style="color:red;"></div>
            
            <form id="form_daohang_add" name="form_daohang_edit" method="post" action="fav.php">
              <table cellpadding="0" cellspacing="0" width="100%" class="fav" height="50" align="center">
                <tr><td width="20"></td><td width="50">名称：</td><td><input style="width:130px;" id="name" type="text" name="title" class="px" onkeydown="ctrlEnter(event, 'add');" onkeyup="strLenCalcnew(this, 'maxlimit',14)"  size="30" value="" /></td>
                <td width="50">地址：</td><td><input style="width:180px;" id="href" type="text" name="href" class="px" size="30" value="http://" onfocus="if(this.value=='http://'){this.value='';}" onblur="if(this.value==''){this.value='http://'}" /></td>
                <td width="50">颜色：</td><td><input style="width:70px;" id="color" type="text" name="color" class="px" size="20" value="" onchange="$('color_btn').style.backgroundColor=this.value" />&nbsp;<button type="button" class="setColor" id="color_btn" style="background-color:#000;width:50px;height:26px;" onclick="intocolor('selcolor', this, 'color');setdisplay('selcolor');">　</button> <div id="selcolor" style="width:auto; position:absolute; top:50px;right:50px;width:251px;z-index:65534"></div></td>
                <td><button type="button" onclick="validate1($('form_daohang_add'));" class="pn pnc" id="daohang_editsubmit" ><em id="daohangname">增 加</em></button></td></tr>
                </table>
                <input type="hidden" name="id" id="id" value='' />
                <input type="hidden" name="daohang_editsubmit" value="true" />
                <input type="hidden" name="handlekey" value="daohang_result" />
                <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
                </form>
                <script type="text/javascript">

function validate1(obj) {

var count = <?php echo $count;?>;
if (count>=35) {

showDialog("不能超过35！！！");
return false;
}
else
{
obj.submit();
return true;
}}
</script> 
            </div>
  
       <?php } else { ?>   
      <table height="100%" width="100%">    
           <tr><td align="center" style="font-size:14px; padding-top:50px;">随时随地使用您的个人导航，不再担心收藏网址丢失！</td></tr>
           <tr>
                <td align="center" valign="middle">
                <?php include template('member/login_simple1'); ?>                </td>
            </tr>
            <tr>
            	<td align="center" style="font-size:14px; padding-bottom:50px;">还没有注册？  <a style="cursor:pointer; color:#336699;" href="member.php?mod=register" target="_blank">立即注册</a></td>
            </tr>
       	</table>
       <?php } ?>
    </div>
</body>
</html>