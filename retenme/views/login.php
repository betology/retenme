<?php if (isset($show_signup) && $show_signup) :?>
<div class="row">
	<div class="span12">
		<a href="<?php echo site_url('signup')?>">Crear cuenta</a>
	</div>
</div>
<?php endif;?>
<br />
<div class="row">
	<div class="span4">
		<?php echo validation_errors(); ?>
		<?php echo form_open('login');?>
		<input name="username" type="text" placeholder="Usuario..."
			value="<?php echo set_value('username'); ?>" /> <input
			name="password" type="password" placeholder="Contraseña..."
			value="<?php echo set_value('password'); ?>" /> <br /> <br />
		<button type="submit" class="btn btn-danger btn-large">Entrar</button>
		</form>
	</div>
</div>
