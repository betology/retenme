<h2 id="foundfriends">Amigos encontrados</h2>

<div class="row">
<?php foreach ($friends as $friend):?>
	<div class="span4">
		<div class="well">
		<a href="<?php echo site_url('profile/' . $friend['username'])?>">
		<h3><?php echo $friend['username']?></h3>
		</a>
		</div>
	</div>
<?php endforeach;?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var tour = new Tour();

	tour.addStep({
		element: "#foundfriends",
		placement: 'left',
		title: "Estos son tus amigos encontrados",
		content: "Para retar a uno de tus amigos dale clic a su nombre"
	});

	tour.addStep({
		element: "#foundusers",
		placement: 'left',
		title: "Usuarios de reten.me",
		content: "Si la persona a la que buscabas aún no es tu amigo, puedes invitarlo a ser tu amigo. Dale clic a su nombre."
	});

	tour.start(true);
});
</script>