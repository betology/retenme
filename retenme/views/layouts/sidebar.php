<div class="container margin-bottom">
<div class="row">
<div class="span12">
	<div class="row">
		<!-- Start Sidebar -->
		<div class="span4">
			<hr class="visible-phone">
			<div class="sidebar">
			<?php echo isset($sidebar) ? $sidebar : ''?>
			</div>
			<!-- .sidebar -->
		</div>
		<!-- .span4 .sidebar -->
		<!-- End Sidebar -->
		<div class="span8 margin-bottom">
			<hr class="dashed visible-phone margin-top-bottom">
			<?php echo isset($content) ? $content : ''?>
		</div>
		<!-- .span8 -->
	</div>
	<!-- .row margin-top-->
</div>
<!-- .span12 -->
</div>
<!-- .row -->
</div>
