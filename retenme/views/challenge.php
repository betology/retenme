<h2><?php echo isset($name) ? $name : ''?> 
<small>para <a href="<?php echo site_url('profile/' . $username)?>"><?php echo $username?></a></small>
</h2>
<p><?php echo isset($description) ? $description : ''?></p>

<?php if ( $status === CHALLENGE_STATUS_ACEPTADO) :
	if ($this->session->userdata('user_id') === $user_id):?>
	<a href="<?php echo site_url('challenge/done/' . $id)?>" class="btn btn-danger">Está hecho</a>
	<?php else:?>
	<p class="colored"><strong>Reto aceptado</strong></p>
<?php endif;endif;?>

<?php if ( $status === CHALLENGE_STATUS_NUEVO) :
	if ($this->session->userdata('user_id') === $user_id):?>
	<a href="<?php echo site_url('challenge/accept/'. $id)?>" class="btn btn-danger">Acepto el reto</a>
	<?php else:?>
	<p class="colored"><strong>El reto no se ha aceptado</strong></p>
<?php endif;endif;?>

<?php if ( $status === CHALLENGE_STATUS_HECHO) :?>
<p class="colored"><strong>Reto hecho</strong></p>
<!-- 
<div class="minislider">
	<ul class="slides">
		<li class="post-img-container" style="width: 100%; float: left; margin-right: -100%; display: list-item;">
			<img src="img/blog/blog-img-1.jpg" alt="Image">
		</li>
		<li class="post-img-container" style="width: 100%; float: left; margin-right: -100%; display: list-item;">
			<img src="img/blog/blog-img-2.jpg" alt="Image">
		</li>
		<li class="post-img-container" style="width: 100%; float: left; margin-right: -100%;">
			<img src="img/blog/blog-img-3.jpg" alt="Image">
		</li>
	</ul>
	<ul class="flex-direction-nav">
		<li><a href="#" class="prev"><i class="icon-chevron-left"></i></a></li>
		<li><a href="#" class="next"><i class="icon-chevron-right"></i></a></li>
	</ul>
</div>
 -->
<?php endif;?>

<hr />
<label><strong>Yo digo que:</strong></label>
<?php echo form_open('comment')?>
<input type="text" class="span8" id="textarea" name="comment" />
<input type="hidden" name="challenge_id" value="<?php echo $id?>" />
</form>
<?php echo $pagination?>
<?php echo $this->load->view('lists/comments', array('comments' => $comments), TRUE)?>
<?php echo $pagination?>
<script type="text/javascript">
jQuery(document).ready(function() {
	console.debug('asdas');
	jQuery("abbr.timeago").timeago();
});
</script>