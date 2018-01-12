<?php
function render_pic($pic) {
?>

<div class="mmone" id="<?php echo $pic['aid']; ?>">
	<div class="imgone"><a href="<?php echo $pic['url']; ?>" target="_blank"><img src="<?php echo $pic['pic']; ?>"/></a></div>
	<div class="imgname">
		<h2><a href="<?php echo $pic['url']; ?>" target="_blank"><?php echo $pic['title']; ?></a></h2>
		<?php if($pic['author']){ ?>
		<p>作者：<?php echo $pic['author']; ?></p>
		<?php } ?>
	</div>
	<div id="commit" style="display:none;">
		<?php foreach($pic['arr'] as $commit){ ?>
		<div class="pinglun_w" >
			<div class="pinglun_n">
				<div class="tou clearfix"> <a href="<?php echo $commit['uid']; ?>" target="_blank"><?php echo $commit['tx']; ?></a>
					<dd><a href="<?php echo $commit['uid']; ?>" target="_blank"><?php echo $commit['uname']; ?></a> ：<?php echo $commit['nr']; ?> </dd>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="intro"><?php echo $pic['content']; ?></div>
	<div class="xh clearfix"> <em><?php echo $pic['viewnum']; ?>人访问</em> <span><?php echo $pic['commentnum']; ?>人评论</span> </div>
</div>
<?php } ?>
