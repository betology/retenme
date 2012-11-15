<?php
if (! empty($friendship_requests)):?>
<h2>Solicitudes de amistad pendientes</h2>
<br />
<?php foreach($friendship_requests as $friendship_request):?>
<div class="row">
	<div class="span6">
		<h4><?php echo $friendship_request['username']?></h4>
	</div>	
	<div class="span2">
		<a href="<?php echo site_url('friend/accept/' . $friendship_request['id'])?>">Aceptar solicitud de amistad</a>
	</div>
</div>
<hr class="dotted" />
<?php
endforeach; 
else:?>
<h3>No hay peticiones de amistad pendientes</h3>
<?php endif;
?>