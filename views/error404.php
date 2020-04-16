<?php $title = 'Oh no·JE'?>

<?php ob_start(); ?>
	<style type="text/css" media="screen">

	body {

	background-color: #f6f8fa;

	color: #24292e;

	font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;

	font-size: 14px;

	line-height: 1.5;

	margin: 0;

	}

	

	.container {

	margin: 50px auto;

	max-width: 600px;

	text-align: center;

	padding: 0 24px;

	}

	

	a {

	color: #4183c4;

	text-decoration: none;

	}

	

	a:hover {

	text-decoration: underline;

	}

	

	h1 {

	letter-spacing: -1px;

	line-height: 60px;

	font-size: 60px;

	font-weight: 100;

	margin: 0px;

	text-shadow: 0 1px 0 #fff;

	}

	

	p {

	color: rgba(0, 0, 0, 0.5);

	margin: 20px 0 40px;

	font-size: 130%

	}

	

	ul {

	list-style: none;

	margin: 25px 0;

	padding: 0;

	}

	

	li {

	display: table-cell;

	font-weight: bold;

	width: 1%;

	}

	

	.logo {

	display: inline-block;

	margin-top: 35px;

	}

	

	.logo-img-2x {

	display: none;

	}

	

	@media only screen and (-webkit-min-device-pixel-ratio: 2),

	only screen and (min--moz-device-pixel-ratio: 2),

	only screen and (-o-min-device-pixel-ratio: 2/1),

	only screen and (min-device-pixel-ratio: 2),

	only screen and (min-resolution: 192dpi),

	only screen and (min-resolution: 2dppx) {

	.logo-img-1x {

	display: none;

	}

	

	.logo-img-2x {

	display: inline-block;

	}

	}

	

	#suggestions {

	margin-top: 35px;

	color: #ccc;

	}

	

	#suggestions a {

	color: #666666;

	font-weight: 200;

	font-size: 14px;

	margin: 0 10px;

	}

</style>

<div class="container">
	<h1>Oopsy daisy!!!</h1>
	<p>La page que vous recherchez n'est pas disponible pour le moment. </p>
	<div id="suggestions">
	<a href="mailto:bdouilleur@gmail.com">Nous contacter</a> —
	<a href="/index.php">Retour à la page d'accueil</a>
	</div>
	<a href="/index.php" class="logo logo-img-1x">
	<img width="32" height="32" title="" alt="" src="/public/Images/logo2.png">
	</a>
</div>
<?php $content = ob_get_clean();?>
<?php require('views/templates/template.php');?>