<?php
session_start();
include_once('cookie_connect.php');
if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
	try {
    $bdd= new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
	if (isset($_GET['id']) AND isset($_GET['suprimer'])) {
		$id = (int)$_GET['id'];
		$reponse = $bdd->prepare('DELETE FROM  membres WHERE id=?');
		$reponse->execute(array($id));
		$reponse->closeCursor();
	}
	if (isset($_GET['id']) AND isset($_GET['status']) && $_GET['status']=='admin') {
		$id = (int)$_GET['id'];
		$reponse = $bdd->prepare('UPDATE membres SET status=? WHERE id=?');
		$reponse->execute(array('admin', $id));
		$reponse->closeCursor();
	}
	if (isset($_GET['id']) AND isset($_GET['status']) && $_GET['status']=='user') {
		$id = (int)$_GET['id'];
		$reponse = $bdd->prepare('UPDATE membres SET status=? WHERE id=?');
		$reponse->execute(array('user', $id));
		$reponse->closeCursor();
	}
	if (isset($_GET['id']) AND isset($_GET['msg_user'])) {
		$id = (int)$_GET['id'];
		$msg = htmlspecialchars($_GET['msg_user']);
		$set_msg_user = $bdd->prepare('UPDATE membres SET msg=? WHERE id=?');
		$set_msg_user->execute(array($msg, $id));
		$set_msg_user->closeCursor();
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>J-E site</title>
		<link rel="stylesheet" href="style/style.css">
		<link href="style/bootstrap.css" rel="stylesheet">
		<link rel='shortcut icon' href="Images/Pythonsign.ico">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
	</head>
	<body>

		<?php
		include("header.php");
		?>
	<section>
		<nav class="nav nav-tabs">
		  <a class="nav-item nav-link " href="espace_admin.php" data-toggle="tab">Utilisateurs</a>
		  <a class="nav-item nav-link active" href="espace_admin_avis.php" data-toggle="tab">Avis</a>
		</nav>
	<?php  // TODO:style des avis ?>
	  <p>Derniers avis sur le site:</p>
		<div class='conteneur_avis'>
			<?php
			  $reponse = $bdd->query('SELECT * FROM avis_visiteurs ORDER BY ID DESC LIMIT 0, 10');
			  while ($donnees = $reponse->fetch())
			  {?>
			    <div class="avis"> <!-- Affichage des avis dans des div avec border noir. -->
			      <p><strong>@<?php echo $donnees['Prenom']; ?></strong> a donné un avis <?=$donnees['avis_simple']?>: <?=$donnees['avis']?></p>
			      <p>[<?=$donnees['date_publication']?>]</p>
			    </div>
			  <?php }
			  $reponse->closeCursor();?>
			</div>
	</section>
	<script src="js/bootstrap.js"></script>
	</body>
	</html>
<?php }
else{
	header('Location: index.php');
} ?>
