<?php foreach ($comments as $comment):?>
<div class="wrapper">
	<!--  
	<figure class="pull-left">
		<img src="img/aside-01.png" alt="">
	</figure>
	-->
	<div class="extra-wrap">
		<span class="small-font"><a href="#"><?php echo $comment['username']?> dijo</a> </span>
		<p>
			<?php echo $comment['comment']?>
			<br />
			<span class="small-font colored"><?php echo $comment['created']?></span>
		</p>
	</div>
</div>
<hr class="dotted" />
<?php endforeach;?>