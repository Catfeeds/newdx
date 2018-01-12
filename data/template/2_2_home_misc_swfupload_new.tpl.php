<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(!empty($uploadResponse)) { ?>
<uploadResponse>
<message><?php if($status=="success") { ?>完成<?php } else { ?><?php echo $uploadfiles;?><?php } ?></message>
<status><?php echo $status;?></status>
<albumid><?php echo $albumid;?></albumid>
<?php if($fileurl) { ?><filepath><?php echo $fileurl;?></filepath><?php } ?>
</uploadResponse>
<?php } else { ?>
<parameter>
<allowsExtend>
<extend depict="All Image File(*.jpg,*.jpeg,*.gif,*.png)">*.jpg,*.gif,*.png,*.jpeg</extend>
</allowsExtend>
<config>
<debugmod><?php echo $debugmod;?></debugmod>
<userid><?php echo $_G['uid'];?></userid>
<hash><?php echo $hash;?></hash>
<maxupload><?php echo $max;?></maxupload>
        <quality><?php echo $_G['setting']['thumbquality'];?></quality>
        <maxwidth><?php if($_G['config']['cdns']['opend']) { ?>9999<?php } else { ?><?php echo $_G['setting']['maxthumbwidth'];?><?php } ?></maxwidth>
        <maxheight><?php if($_G['config']['cdns']['opend']) { ?>9999<?php } else { ?><?php echo $_G['setting']['maxthumbheight'];?><?php } ?></maxheight>
        <back>homeuploadsuccess</back>
<uploadurl><?php echo $uploadurl;?></uploadurl>
<feedurl><?php echo $feedurl;?></feedurl>
<albumurl><?php echo $albumurl;?></albumurl>
<albumidselect><?php echo $_G['gp_albumid'];?></albumidselect>
<categoryStat><?php echo $categorystat;?></categoryStat>
<categoryRequired><?php echo $categoryrequired;?></categoryRequired>
<?php if($iscamera) { ?>
<countdown>3</countdown>
<countBy>2000</countBy>
<?php } ?>
</config>
<?php if($isdoodle) { ?>
<filters>
<filter id="0">禁用</filter>
<filter id="1">阴影</filter>
<filter id="2">模糊</filter>
<filter id="3">发光</filter>
<filter id="4">水彩</filter>
<filter id="5">喷溅</filter>
<filter id="6">布纹</filter>
</filters>
<?php } ?>
<albums>
<album id="-1" image="">请选择相册</album>
        
        <album id="add" image="">+创建新相册</album>
        <?php if(is_array($albums)) foreach($albums as $key => $value) { ?><album id="<?php echo $value['albumid'];?>" image="<?php echo $value['albumcover'];?>" ><?php echo $value['albumname'];?></album>
<?php } ?>
</albums>
<?php if($_G['setting']['albumcategorystat'] && $categorys) { ?>
<categorys>
<category catid="0">选择分类</category><?php if(is_array($categorys)) foreach($categorys as $key => $value) { if($value['level'] == 0) { ?>
<category catid="<?php echo $key;?>"><?php echo $value['catname'];?></category><?php if(is_array($value['children'])) foreach($value['children'] as $catid) { ?><category catid="<?php echo $categorys[$catid]['catid'];?>">--<?php echo $categorys[$catid]['catname'];?></category><?php if(is_array($categorys[$catid]['children'])) foreach($categorys[$catid]['children'] as $catid2) { ?><category catid="<?php echo $categorys[$catid2]['catid'];?>">----<?php echo $categorys[$catid2]['catname'];?></category>
<?php } } } } ?>
</categorys>
<?php } ?>
</parameter>
<?php } ?>