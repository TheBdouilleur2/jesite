<?php
session_start();
if(isset($_SESSION["status"]) && $_SESSION['status']=='admin'){
  $bdd = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  include_once('cookie_connect.php');

  	if (isset($_POST['formcreation'])) {
  			$titre = htmlspecialchars($_POST['titre']);
  			$contenu = htmlspecialchars($_POST['contenu']);
  			$resume = htmlspecialchars($_POST['resume']);
  			if (!empty($titre) && !empty($contenu) && !empty($resume)) {
          if(strlen($titre)<250){
            if(strlen($contenu)>strlen($resume)){
              global $bdd;
      				$req_project = $bdd->prepare("SELECT * FROM projects WHERE titre=?");
      				$req_project->execute(array($titre));
      				$project_exist = $req_project->rowCount();
      				if ($project_exist == 0) {
                $req_project->closeCursor();
                $insert_project = $bdd->prepare('INSERT INTO projects (createur, titre, contenu, resume) VALUES(?, ?, ?, ?)') ;
                $insert_project->execute(array($_SESSION['pseudo'], $titre, $contenu, $resume));
                $_SESSION['msg'] = 'Votre project '.$titre.' a bien été créé';
                header('Location: project.php');
      				}else{
      					$erreur = 'Le titre que vous avez choisi est déjà utilisé. Veuillez en choisir un autre.';
                $req_project->closeCursor();
        			}
            }else {
              $erreur = 'Le résumé est plus long que le contenu.';
            }
          }else{
            $erreur = 'Le titre est trop long, il ne doit pas exéder 250 caractères.';
          }
  			}else{
  				 $erreur = 'Tout les champs doivent être remplis';
  			}
  		  $req_user->closeCursor();
  		}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Creation project</title>
	<link rel="stylesheet" href="style/style.css">
  <link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">

</head>
<body>
	<p>Les champs marqué d'une * sont à renseigner obligatoirement.</p>
	<form action='' method="POST" id="creation_project">
    <table>
         <tr>
            <td align="right">
               <label for="titre">Titre*:</label>
            </td>
            <td>
               <input type="text" placeholder="Votre titre" id="titre" name="titre" value="<?php if(isset($titre)) { echo $titre; } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="contenu">Contenu*:</label>
            </td>
            <td>
               <textarea placeholder="Votre contenu" id="contenu" name="contenu" rows="40" cols="60"><?php if(isset($contenu)) { echo $contenu; } ?></textarea>
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="resume">Resumé*:</label>
            </td>
            <td>
               <textarea placeholder="Votre resumé" id="resume" name="resume" rows="10" cols="60"><?php if(isset($resume)) { echo $resume; } ?></textarea>
            </td>
         </tr>
         <tr>
            <td></td>
            <td align="center">
               <br />
               <input type="submit" name="formcreation" value="Creation du project" />
            </td>
         </tr>
      </table>
	</form>
	<p id="erreur" style="color: red;"><?php if(isset($erreur)){echo $erreur;} ?></p>
</body>
</html>
<?php }else{ header('Location: project.php');} ?>
