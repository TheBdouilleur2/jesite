<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Donner un avis</title>
	<link rel="stylesheet" href="style/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
	<?php include("header.php");?>
<section>
  <form action="cible.php" method="POST">
		<p><label>Avez vous aimé le site? <input type="checkbox" name="avisdusitepositif" /> Oui <input type="checkbox" name="avisdusitenegatif" /> Non</label></p>
		<p><textarea name="avis" id="avis" cols="40" rows="10" placeholder="Ecriver ici votre ressenti sur ce site."></textarea></p>
		<?php if(!isset($_SESSION['id'])){ echo "<p><label>Prenom: <input type=\"text\" name=\"prenom\" /></label></p>";} ?>
		<p><input type="submit"></p>
	</form>
</section>
</body>
