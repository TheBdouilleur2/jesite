<?php
session_start();
include_once('cookie_connect.php');
include('Parsedown.php');
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);
if(isset($_GET['id'])){
  try {
    $bdd= new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '');
  } catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
  $project_id = (int)$_GET['id'];
  if (isset($_POST['commentaire_envoi']) && isset($_POST['commentaire'])) {
    global $bdd;
    if(isset($_POST['prenom'])) {
      $pseudo = htmlspecialchars($_POST['prenom']);
    }else{
      $pseudo = $_SESSION['pseudo'];
    }
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $insert_commentaire = $bdd->prepare('INSERT INTO commentaires_projects (ID_project, pseudo, commentaire) VALUES(?, ?, ?)');
    $insert_commentaire->execute(array($project_id, $pseudo, $commentaire));
    $insert_commentaire->closeCursor();
  }
  $req_project = $bdd->prepare('SELECT ID, createur,  titre, contenu, resume, DATE_FORMAT(date_publication, \'%d/%m/%Y à %Hh%imin\') AS date_fr FROM projects WHERE ID=?');
  $req_project->execute(array($project_id));
  $project_info = $req_project->fetch();
  $req_project->closeCursor();
  $req_comment = $bdd->prepare('SELECT * FROM commentaires_projects WHERE id_project=?');
  $req_comment->execute(array($project_id));
  $contenu = $Parsedown->text($project_info['contenu']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?=$project_info['titre']?></title>
	<link rel="stylesheet" href="style/style.css">
  <link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
  <?php include_once('header.php'); ?>
  <section>
    <h1><?=$project_info['titre']?></h1>
    <p>Publié le <?=$project_info['date_fr']?> par <strong>@<?=$project_info['createur']?></strong></p>
    <?= $contenu ?>
    <br>
    <br>
    <?php
        while ($comment = $req_comment->fetch()) { ?>
            <div class="commentaire">
              <p><strong>@<?=$comment['pseudo']?></strong>: <?=$comment['commentaire']?> [<?=$comment['date_publication']?>]</p>
            </div>
      <?php  }
      $req_comment->closeCursor();
     ?>
     <br>
     <?php if(isset($_SESSION['id'])){ ?>
     <form action="" method="POST">
     		<p><input name="commentaire" id="commentaire" placeholder='Ecrivez votre commentaire ici.'/></p>
     		<?php if(isset($_SESSION['id'])){echo '<p><label for="prenom">Prenom: </label><input id="prenom" type="text" name="prenom">';} ?>
     		<p><input type="submit" name='commentaire_envoi'></p>
     	</form>
     <?php } ?>
  </section>
</body>

<?php
}else{
  header('Location: project.php');
}
 ?>
