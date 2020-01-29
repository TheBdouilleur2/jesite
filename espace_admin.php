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
		  <a class="nav-item nav-link active" href="espace_admin.php" data-toggle="tab">Utilisateurs</a>
		  <a class="nav-item nav-link" href="espace_admin_avis.php" data-toggle="tab">Avis</a>
		</nav>
		<table>
		  <?php /* Affichage des 10 derniers utilisateurs inscrits.*/
		  $req_all_users = $bdd->query('SELECT * FROM membres ORDER BY ID DESC LIMIT 0, 10');
		  while($lasts_users = $req_all_users->fetch()){?>
					<tr>
						<td align="right"><strong>@<?=$lasts_users['pseudo']?></strong></td>
						<td><a href="espace_admin.php?id=<?=$lasts_users['ID']?>&suprimer=1" id="delete_button" class='button'>Suprimer</a></td><!-- bouton pour suprimer le compte -->
						<td><?php if(isset($lasts_users['status']) && $lasts_users['status'] == 'admin') {?>
			      <a href="espace_admin.php?id=<?=$lasts_users['ID'];?>&status=user" id="user_button" class='button'>Administrateur</a>
			    <?php } else{?><a href="espace_admin.php?id=<?=$lasts_users['ID'];?>&status=admin" id="admin_button" class='button'>Utilisateur</a><?php } ?></p></td> <!-- Bouton pour passer en admin ou en user -->
						<td><label for="msg_user">Message: </label></td>
						<td><input type='text' id='msg_user' name='msg_user' formmethod="get"/></td>
						<td><input type='submit' name='msg_button' formmethod="get"/></td><?php // TODO: envoie de message ?>
					</tr>
		<?php	}
		$req_all_users->closeCursor();	?>
	</table>
	</section>
	<script src="js/bootstrap.js"></script>
	</body>
	</html>
<?php }
else{
	header('Location: index.php');
} ?>
