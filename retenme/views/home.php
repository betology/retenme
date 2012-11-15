<script type="text/javascript">
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
</script>