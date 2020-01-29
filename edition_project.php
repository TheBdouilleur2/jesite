<?php
session_start();
include_once('cookie_connect.php');
try {
  $bdd= new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}
global $bdd;
if (isset($_GET['id'])) {
  $project_id = (int)$_GET['id'];
  $req_project = $bdd->prepare("SELECT * FROM projects WHERE id=?");
  $req_project->execute(array($project_id));
  $project_info = $req_project->fetch();
  $req_project->closeCursor();
  if(isset($_POST['formedition'])){
    if(isset($_POST['newtitre']) && !empty($_POST['newtitre']) && $_POST['newtitre'] != $project_info['titre']){
        $newtitre = htmlspecialchars($_POST['newtitre']);
        $req_titre = $bdd->prepare("SELECT * FROM projects WHERE titre=?");
        $req_titre->execute(array($newtitre));
        $titre_exist = $req_titre->rowCount();
        $req_titre->closeCursor();
        if ($titre_exist == 0) {
          $changetitre = $bdd->prepare('UPDATE projects SET titre=? WHERE ID=?');
          $changetitre->execute(array($newtitre, $project_id));
          $changetitre->closeCursor();
          header('Location: project.php');
        }else{
          $erreur = 'Ce titre est déjà utilisé';
        }
      }
      if(isset($_POST['newcontenu']) && !empty($_POST['newcontenu']) && $_POST['newcontenu'] != $project_info['contenu']){
          
          $newcontenu = htmlspecialchars($_POST['newcontenu']);
          $changecontenu = $bdd->prepare('UPDATE projects SET contenu=? WHERE ID=?');
          $changecontenu->execute(array($newcontenu, $project_id));
          $changecontenu->closeCursor();
          header('Location: project.php');
        }
        if( isset($_POST['newresume']) && !empty($_POST['newresume']) && $_POST['newresume'] != $project_info['resume']){
          if (strlen($_POST['newresume']) < 500) {
            $newresume = htmlspecialchars($_POST['newresume']);
            $changeresume = $bdd->prepare('UPDATE projects SET resume=? WHERE ID=?');
            $changeresume->execute(array($newresume, $project_id));
            $changeresume->closeCursor();
            header('Location: project.php');
          }else{
            $erreur = 'Le résumé est trop long.';
          }
        }
  }

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Edition du projet</title>
    <link rel="stylesheet" href="style/style.css">
  	<link rel='shortcut icon' href="Images/Pythonsign.ico">
  	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
  </head>
  <body>
    <p>Les champs marqué d'une * sont à renseigner obligatoirement.</p>
  	<form action='' method="POST" id="edition_project">
      <table>
           <tr>
              <td align="right">
                 <label for="titre">Titre*:</label>
              </td>
              <td>
                 <input type="text" placeholder="Votre titre" id="newtitre" name="newtitre" value="<?=$project_info['titre']?>" />
              </td>
           </tr>
           <tr>
              <td align="right">
                 <label for="contenu">Contenu*:</label>
              </td>
              <td>
                 <textarea placeholder="Votre contenu" id="newcontenu" name="newcontenu" rows="40" cols="60"><?php if(isset($project_info['contenu'])) { echo nl2br($project_info['contenu']); } ?></textarea>
              </td>
           </tr>
           <tr>
              <td align="right">
                 <label for="resume">Resumé*:</label>
              </td>
              <td>
                 <textarea placeholder="Votre resumé" id="newresume" name="newresume" rows="10" cols="60"><?php if(isset($project_info['resume'])) { echo nl2br($project_info['resume']); } ?></textarea>
              </td>
           </tr>
           <tr>
              <td></td>
              <td align="center">
                 <br />
                 <input type="submit" name="formedition" value="Sauvegarder les modifications" />
              </td>
           </tr>
        </table>
  	</form>
  	<p id="erreur" style="color: red;"><?php if(isset($erreur)){echo $erreur;} ?></p>
  </body>
</html>
<?php
}else {
  header('Location: project.php');
}
 ?>
