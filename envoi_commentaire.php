<?php
session_start();

if (isset($_POST['commentaire_envoi']) && isset($_POST['commentaire'])) {
  if (isset('prenom')) {
    $pseudo = htmlspecialchars($_POST['prenom']);
  }else{
    $pseudo = $_SESSION['pseudo'];
  }
  try {
    $bdd= new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
  $insert_commentaire = $bdd->prepare('INSERT INTO commentaires_projects ()')
}else{
  header('Location: project.php')
}
 ?>
