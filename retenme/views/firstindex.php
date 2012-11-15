<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>

<!-- No te molestes este código no tiene nada de asombroso, éste sí https://github.com/torvalds/linux-->

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>RETEN.ME - Por una vida legendaria</title>
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/reset-bootstrap-responsive-docs.css">
<link rel="stylesheet" href="css/fontawesome.css">
<!--[if lt IE 7]>
    <link rel="stylesheet" href="css/font-awesome-ie7.css">
  <![endif]-->
<link rel="stylesheet" href="css/prettyphoto.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/skin/default.css">

<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Questrial'
	rel='stylesheet' type='text/css'>

<link rel="apple-touch-icon" href="img/icons/apple-touch-icon.png">
<link rel="apple-touch-icon"
	href="img/icons/apple-touch-icon-precomposed.png">
<link rel="apple-touch-icon" sizes="57x57"
	href="img/icons/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="img/icons/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="img/icons/apple-touch-icon-114x114-precomposed.png">
</head>
<body>

	<!--[if lt IE 7]><p class=chromeframe>Tú navegador no pasó la última verificación. <a href="http://browsehappy.com/">Bájate otro mejor</a>.</p><![endif]-->
		<?php if ($this->session->flashdata('alert_type')){ ?>
	<div class="messages">
			<div class="alert alert-<?php echo $this->session->flashdata('alert_type')?> center">
				<a class="close" data-dismiss="alert" href="#">×</a>
				<?php echo $this->session->flashdata('alert');?>
			</div> 
	</div>
		<?php }?>
	<!-- Header -->
	<header>
		<div class="container margin-top-bottom">
			<div class="row">
				<div class="span10">
					<div class="logo">
						<h1>reten.me</h1>
					</div>
					<!-- .logo -->
				</div>
				<!-- .span10 -->
				<div class="span2">
					<a href="<?php echo site_url('signup')?>">Crear cuenta</a>
				</div>
			</div>
			<!-- .row -->
		</div>
		<!-- .container -->
	</header>
	<!-- Start Content -->

	<section id="content">
		<!-- Start Hero Intro -->
		<div class="exclamation margin-top-bottom center">
			<div class="container">
				<div class="row welcome">
					<div class="span12">
						<h1>
							Por una vida <span class="underline">legendaria</span>
						</h1>
						<p>
							<em>Vive una vida legendaria y reta a tus amigos a hacer lo mismo</em>
						</p>
					</div>
				</div>
			</div>
			<!-- .container -->
		</div>
		<!-- .exclamation margin-top-bottom -->
		<!-- End Hero Intro -->
		<div class="container center">
			<div class="row exclamation">
	<div class="span4 offset4 center">
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
		
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/libs/bootstrap/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/jquery.hoverIntent.minified.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/script.js"></script>
	<script>
		jQuery(document).ready(function(){
			jQuery('.alert').on('click', function(){
				jQuery(this).fadeOut();
			});
		});
	</script>
</body>
</html>