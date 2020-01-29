<?php
session_start();
include_once('cookie_connect.php');
try {new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}
// TODO: ne pas augmenter
$compteur = fopen("fichiers/compteuraccueil.txt", 'r+');
$nbvue = fgets($compteur);
$nbvue += 1;
fseek($compteur, 0);
fputs($compteur, $nbvue);
fclose($compteur);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>J-E site</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>

	<?php
	include("header.php");
	?>
<section>
	<?php
	if (isset($_SESSION['msg'])) {
		echo '<p>'.$_SESSION['msg'].'</p>';
	}?>

</section>
</body>
</html>
