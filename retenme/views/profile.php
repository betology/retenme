<div class="row">
<div class="span6">
<h2>
	<?php echo isset($profile['username']) ? $profile['username']: ''?>
</h2>
</div>
<div class="span2">
	<?php if (is_logged() && $profile['id'] !== $this->session->userdata('user_id')): ?>
	<?php if ($is_friendship_requested){?>
	<p>Esperando confirmación de amistad...</p>
	<?php }
	if ( ! $is_friend && ! $is_friendship_requested) {?>
	<a style="float:right" href="<?php echo site_url('friend/' . $profile['id'])?>"class="btn btn-danger">Agregar como amigo</a>
	<?php }?>
	<?php endif;?>
</div>
</div>

<?php if ($is_friend) :?>
	<div class="row">
		<div class="span8">
			<?php echo form_open('challenge/add', array('class' => 'contact'))?>
				<label><strong>Reto:</strong></label>
				<input type="text" name="name" placeholder="Ponle un nombre..." class="span5">
				<?php echo form_error('name'); ?>
				<label><strong>Descripción:</strong></label>
				<textarea class="span5" name="description" id="textarea" rows="3"></textarea>
				<?php echo form_error('description'); ?>
				<input type="hidden" name="user_id" value="<?php echo $profile['id']?>" />
				<br>
				<button class="btn btn-danger" type="submit">¡Te reto!</button>
			</form>
		</div>
	</div>
<?php endif;?>


<?php if(isset($challenges[CHALLENGE_STATUS_HECHO]))foreach($challenges[CHALLENGE_STATUS_HECHO] as $challenge):?>
<hr />
<h3>Últimos retos hechos</h3>
<div class="row" id="portfolio">
	<div class="span4 YDCOZA packaging">
		<div class="single-item">
			<div class="img-box">
				<img alt="Alt Text" src="<?php echo site_url('img/gallery/gallery-01.jpg')?>">
				<div class="single-navigation">
					<a href="<?php echo site_url('img/gallery/gallery-01.jpg')?>" rel="prettyPhoto"
						class="fullimage">
						<div class="full-image"></div>
					</a> <a href="#" class="pagelink">
						<div class="page-link"></div>
					</a>
				</div>
				<!-- .single-navigation -->
			</div>
			<!-- .img-box -->
			<div class="desc">
				<h5>
					<a href="#"><?php echo $challenge['name']?></a>
				</h5>
				<p><?php echo isset($challenge['description']) ? $challenge['description']: ''?></p>
			</div>
			<!-- .description -->
			<?php if (isset($challenge['date'])):?>
			<span class="date"><span><?php echo gmdate('d', strtotime($challenge['created']))?></span><?php echo gmdate('M', strtotime($challenge['created']))?></span>
			<?php endif; ?>
		</div>
		<!-- .single-item -->
	</div>
	<!-- .YDCOZA -->
<?php endforeach;?>
</div>