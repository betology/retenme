<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
	<?php echo $this->load->view('elements/head')?>
	<script>
		$(document).ready(function(){
			$('.messages').on('click', function(){
				$(this).fadeOut();
			});

			var tour = new Tour();

			tour.addStep({
				element: "#logo",
				placement: 'bottom',
				title: "Bienvenido a reten.me",
				content: "Esto es un lugar donde puedes aceptar y proponer retos entre amigos, la intención es hacer de cada reto una historia digna de contarse. ¿Te hacen falta anécdotas? Aquí puedes comenzar algunas, como esa vez que saltaste en bungee, que cantaste en el metro o que corriste de los toros en Pamplona."
			});
			
			tour.addStep({
				element: "#yourname",
				title: "¡Este es tu nombre!",
				content: "Para empezar comparte tu nombre con los demás para que te encuentren en reten.me y pídele el suyo a tus amigos."
			});
			
			tour.addStep({
				element: "#challengesfriends",
				title: "Los retos propuestos a tus amigos",
				content: "Aquí puedes ver los retos que han hecho a todos tus amigos."
			});

			tour.addStep({
				element: "#challengenew",
				title: "Nuevos retos",
				content: "Aquí están los retos que te han hecho tus amigos, ármate de valor y acepta algunos."
			});
			
			tour.addStep({
				element: "#searchfriends",
				title: "Busca a un amigo",
				content: "Para empezar una nueva vida legendaria debes buscar a un amigo o pedir a alguien ser tu amigo, escribe aquí su nombre para buscarlo."
			});

			tour.start();
		});
	</script>
</head>
<body>
	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
	<header>
		<?php echo $this->load->view('elements/navbar')?>
	</header>

	<?php if ($this->session->flashdata('alert_type')){ ?>
	<div class="messages">
			<div class="alert alert-<?php echo $this->session->flashdata('alert_type')?> center">
				<a class="close" data-dismiss="alert" href="#">×</a>
				<?php echo $this->session->flashdata('alert');?>
			</div> 
	</div>
	<?php }?>
	
	<?php if ( ! empty($title)): ?>
	<div class="exclamation title">
	<div class="container">
	<div class="row welcome">
		<div class="span12">
			<h2><?php echo isset($title) ? $title : ''?> 
			<small><?php echo isset($subtitle) ? $subtitle : ''?></small></h2>
		</div>
	</div>
	</div>
	</div>
	<?php endif;?>
	
	<section id="content">
		<?php echo isset($content) ? $content : ''?>
	</section>

	<footer>
		<?php echo $this->load->view('elements/footer')?>
	</footer>

</body>
</html>