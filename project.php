<?php
session_start();
include_once('cookie_connect.php');
try {
	$bdd= new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}
if (isset($_GET['id']) && isset($_GET['suprime'])) {
	if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
		$project_id = (int)$_GET['id'];
		$supr_proj = $bdd->prepare('DELETE FROM projects WHERE id=?');
		$supr_proj->execute(array($project_id));
		$supr_proj->closeCursor();
		$supr_comment = $bdd->prepare('DELETE FROM commentaires_projects WHERE id_project=?');
		$supr_comment->execute(array($project_id));
		$supr_comment->closeCursor();
	}
}
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
	include("header.php");?>
<section>
	<?php
		if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin') { ?>
	<div class='button' id='creation_project'>
		<a href='creation_project.php'>Creer un nouveau project</a>
	</div>
	<?php }
	 ?>
	 <?php
	 $req_project = $bdd->query('SELECT ID, createur,  titre, resume, DATE_FORMAT(date_publication, \'%d/%m/%Y à %Hh%imin\') AS date_fr FROM projects ORDER BY date_publication DESC');
	 while($project_info = $req_project->fetch()){
	  ?>
		<a href='affichage_project.php?id=<?=$project_info['ID'] ?>' class='unlink'>
			<div class="project">
				<p><strong><?=$project_info['titre']?></strong>  publié le <?=$project_info['date_fr']?> par <strong>@<?=$project_info['createur']?></strong></p>
				<p><?=nl2br($project_info['resume'])?></p>
				<?php if (isset($_SESSION['status']) && $_SESSION['status']=="admin") {?>
					<a href="edition_project.php?id=<?=$project_info['ID']?>" class='button'>Modifier le projet.</a>
	<?php	} ?>
				<?php if (isset($_SESSION['status']) && $_SESSION['status']=='admin') {?>
						<a href="project.php?id=<?=$project_info['ID']?>&suprime=1" class='button'>Suprimer le projet.</a>
			<?php	} ?>

			</div>
		</a>
	<?php } ?>
</section>
</body>
</html>
