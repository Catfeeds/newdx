<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<?php $i = 0; ?><!--���ѡ����Ƭ��ʼ-->
<ul class="imglistcon"><?php if(is_array($photolist)) foreach($photolist as $photo) { ?><?php $i++; ?><li albumpicid="<?php echo $photo['picid'];?>"><img bigpic="<?php echo $photo['url'];?>" src="<?php echo $photo['thumburl'];?>"  title="<?php echo $photo['filename'];?>"  style="display:none;width:60px;height:60px;" onload="thumbImg(this, 1);this.style.display='';" onerror="this.src='static/images/tu_min.png';this.parentNode.className='errorpic';this.title='��ǰ���ͼƬ�����ڣ��޷���ӣ���ȥ���˶�'" width="60" height="60" _width="60" _height="60"/><a style="display:none;" href="javascript:;"></a></li>
<?php } ?>
<?php echo $b_space;?>
</ul>
<!--���ѡ����Ƭ����-->
<div class="pgs cl"><?php echo $multi;?></div>
<?php echo $addcss;?>