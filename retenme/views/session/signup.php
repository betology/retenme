<div class="row">
	<div class="span6 offset3">
		<?php echo form_open('signup', array('class' => 'contact'))?>
		<label><strong>Email:</strong></label>
		<input name="email" type="text" class="span5" value="<?php echo set_value('email'); ?>" />
		<?php echo form_error('email'); ?>
		<label><strong>Usuario:</strong></label>
		<input name="username" type="text" class="span5" autocomplete="off" value="<?php echo set_value('username'); ?>" />
		<?php echo form_error('username'); ?>
		<label><strong>Contraseña:</strong></label>
		<input name="password" type="password" class="span5" autocomplete="off" value="<?php echo set_value('password'); ?>" />
		<?php echo form_error('password'); ?>
		<label><strong>Verifica la contraseña:</strong></label>
		<input name="password_verification" type="password" class="span5" value="<?php echo set_value('password_verification'); ?>" />
		<?php echo form_error('password_verification'); ?>
		<button class="btn btn-danger">Crear cuenta</button>
		</form>
	</div>
</div>
<script>
	$(document).ready(function (){
		var emptyTextBoxes = $('input').filter(function() { return this.value == ""; });
		if (emptyTextBoxes.length != 0){
			emptyTextBoxes[0].focus();
		}
	});
</script>