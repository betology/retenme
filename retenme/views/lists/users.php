<h2 id="foundusers">Usuarios encontrados</h2>

<div class="row">
<?php foreach ($users as $user):?>
	<div class="span4">
		<div class="well">
		<a href="<?php echo site_url('profile/' . $user['username'])?>">
		<h3><?php echo $user['username']?></h3>
		</a>
		</div>
	</div>
<?php endforeach;?>
</div>