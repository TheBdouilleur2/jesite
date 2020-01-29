<?php session_start();

$compteur = fopen("fichiers/compteurdiscussion.txt", 'r+');
$nbvue = fgets($compteur);
$nbvue += 1;
fseek($compteur, 0);
fputs($compteur, $nbvue);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Discussions</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
	<?php include("header.php");?>
<section>
	<form action="chat_post.php" method="POST">
		<p><label for="msg"><?php echo $_SESSION['pseudo']; ?>: <input id="msg", type='text', name='msg'/></label>
		<input type='submit', name='msg_envoie_user'/></p>
	</form>

	<?php
	try {
    $bdd= new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
	$req_msg = $bdd->query('SELECT * FROM chat_user ORDER BY date_publication DESC LIMIT 0,20');
	while ($donnees = $req_msg->fetch()) {?>
		<div class="msg">
			<p><strong>@<?php echo htmlspecialchars($donnees["pseudo"]); ?></strong>[<?php echo htmlspecialchars($donnees['date_publication']); ?>]: <?php echo $donnees['msg']; ?></p>
		</div>

<?php	}
	$req_msg->closeCursor();
	 ?>
 </section>
</body>
</html>
