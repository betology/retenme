<?php
$CI =& get_instance();
$CI->load->model('challengemodel');
$CI->load->model('commentmodel');
$user_id = $CI->session->userdata('user_id');

foreach (array(CHALLENGE_STATUS_NUEVO, CHALLENGE_STATUS_ACEPTADO, CHALLENGE_STATUS_HECHO) as $type) {
	$challenges[$type] = $CI->challengemodel->getByUser($user_id, $type);
	$challenges_count[$type] = $CI->challengemodel->count($user_id, $type);
}
?>
<h3 id="yourname">¡Hola <?php echo $CI->session->userdata('username')?>!</h3>
<a href="<?php echo site_url('logout')?>">cerrar sesión</a>
<hr />
<h4>Reta a un amigo</h4>
<?php echo form_open('challenge/friend')?>
<input id="searchfriends" name="friend" type="text" placeholder="Escribe el nombre de tu amigo...">
</form>
<hr />

<h4 id="challengesfriends">Retos a mis amigos</h4>
<br />
<?php 
$friend_challenges = $CI->challengemodel->getByFriends($user_id);
if ( ! empty($friend_challenges) ) :?>
<ul>
<?php foreach($friend_challenges as $challenge) :
$last_seen = $CI->challengemodel->lastView($challenge['id']);
$num_comments = $CI->commentmodel->countByChallenge($challenge['id'], $last_seen);
?>
<li>
	<a href="<?php echo site_url('challenge/view/' . $challenge['id'])?>" rel="popove"
		data-original-title="<?php echo $challenge['name']?>"  
		data-content="<?php echo $challenge['description']?>">
		<strong><?php echo $num_comments > 0 ? "($num_comments)" : ''?></strong> <?php echo $challenge['name']?> >>
	</a></li>
<?php endforeach;?>
</ul>
<?php else: ?>
<p>No hay retos nuevos</p>
<?php endif;?>
<a href="#" class="right" title="Chécate a qué más te han retado" rel="tooltip">Ver más retos</a>
<hr />

<h4 id="challengenew">¿A qué me retaron mis amigos?</h4>
<br />
<?php if ( isset($challenges[CHALLENGE_STATUS_NUEVO]) && ! empty($challenges[CHALLENGE_STATUS_NUEVO]) ) :?>
<ul>
<?php foreach($challenges[CHALLENGE_STATUS_NUEVO] as $challenge) :
$last_seen = $CI->challengemodel->lastView($challenge['id']);
$num_comments = $CI->commentmodel->countByChallenge($challenge['id'], $last_seen);
?>
<li>
	<a href="<?php echo site_url('challenge/view/' . $challenge['id'])?>" rel="popove"
		data-original-title="<?php echo $challenge['name']?>"  
		data-content="<?php echo $challenge['description']?>">
		<strong><?php echo $num_comments > 0 ? "($num_comments)" : ''?></strong> <?php echo $challenge['name']?> >>
	</a></li>
<?php endforeach;?>
</ul>
<?php else: ?>
<p>No hay retos nuevos</p>
<?php endif;?>
<?php if (isset($challenges[CHALLENGE_STATUS_NUEVO]) && $challenges_count[CHALLENGE_STATUS_NUEVO] > count($challenges[CHALLENGE_STATUS_NUEVO])): ?>
<a href="#" class="right" title="Chécate a qué más te han retado" rel="tooltip">Ver más retos</a>
<?php endif;?>
<hr />

<h4>Mis retos aceptados</h4>
<br />
<?php if ( isset($challenges[CHALLENGE_STATUS_ACEPTADO]) && ! empty($challenges[CHALLENGE_STATUS_ACEPTADO]) ) :?>
<ul>
<?php foreach($challenges[CHALLENGE_STATUS_ACEPTADO] as $challenge) :
$last_seen = $CI->challengemodel->lastView($challenge['id']);
$num_comments = $CI->commentmodel->countByChallenge($challenge['id'], $last_seen);?>
<li>
	<a href="<?php echo site_url('challenge/view/' . $challenge['id'])?>" rel="popove"
		data-original-title="<?php echo $challenge['name']?>"  
		data-content="<?php echo $challenge['description']?>">
		<strong><?php echo $num_comments > 0 ? "($num_comments)" : ''?></strong> <?php echo $challenge['name']?> >>
	</a></li>
<?php endforeach;?>
</ul>
<?php else: ?>
<p>No hay retos aceptados</p>
<?php endif;?>
<?php if (isset($challenges[CHALLENGE_STATUS_ACEPTADO]) && $challenges_count[CHALLENGE_STATUS_ACEPTADO] > count($challenges[CHALLENGE_STATUS_ACEPTADO])): ?>
<a href="#" class="right" title="Chécate a qué más te han retado" rel="tooltip">Ver más retos</a>
<?php endif;?>
<hr />

<h4>Mis retos completados</h4>
<br />
<?php if ( isset($challenges[CHALLENGE_STATUS_HECHO]) && ! empty($challenges[CHALLENGE_STATUS_HECHO]) ) :?>
<ul>
<?php foreach($challenges[CHALLENGE_STATUS_HECHO] as $challenge) :
$last_seen = $CI->challengemodel->lastView($challenge['id']);
$num_comments = $CI->commentmodel->countByChallenge($challenge['id'], $last_seen);?>
<li>
	<a href="<?php echo site_url('challenge/view/' . $challenge['id'])?>" rel="popove"
		data-original-title="<?php echo $challenge['name']?>"  
		data-content="<?php echo $challenge['description']?>">
		<strong><?php echo $num_comments > 0 ? "($num_comments)" : ''?></strong> <?php echo $challenge['name']?> >>
	</a></li>
<?php endforeach;?>
</ul>
<?php else: ?>
<p>No hay retos hechos</p>
<?php endif;?>
<?php if (isset($challenges[CHALLENGE_STATUS_HECHO]) && $challenges_count[CHALLENGE_STATUS_HECHO] > count($challenges[CHALLENGE_STATUS_HECHO])): ?>
<a href="#" class="right" title="Chécate a qué más te han retado" rel="tooltip">Ver más retos</a>
<?php endif;?>

<script src="<?php echo site_url('js/libs/bootstrap/bootstrap-modal.js')?>"></script>
<script src="<?php echo site_url('js/libs/bootstrap/tooltip.js')?>"></script>
<script src="<?php echo site_url('js/libs/bootstrap/popove.js')?>"></script>
<script src="<?php echo site_url('js/libs/bootstrap/application.js')?>"></script>