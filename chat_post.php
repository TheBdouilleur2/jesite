<?php
session_start();

function dbConnect(){
  try {
    $db = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
  return $db;
}
if(isset($_POST['msg_envoie_user'])){ // Vérifie si le message à bien été envoiyé
  $msg = htmlspecialchars($_POST['msg']); // S'assure de la fiabilité du message
  $bdd = dbConnect();
  $post_msg = $bdd->prepare("INSERT INTO chat_user (`pseudo`, `msg`) VALUES(?, ?)");
  $post_msg->execute(array($_SESSION['pseudo'], $msg));
  $post_msg->closeCursor();
  header('Location: discussions.php');
}

if(isset($_POST['msg_envoie_admin'])){ // Vérifie si le message à bien été envoiyé
  $msg = htmlspecialchars($_POST['msg']); // S'assure de la fiabilité du message
  $bdd= dbConnect();
  $post_msg = $bdd->prepare("INSERT INTO chat_admin (`pseudo`, `msg`) VALUES(?, ?)");
  $post_msg->execute(array($_SESSION['pseudo'], $msg));
  $post_msg->closeCursor();
  header('Location: chat_admin.php');
}


 ?>
