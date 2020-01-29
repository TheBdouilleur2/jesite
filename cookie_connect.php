<?php
try {
	$bdd_membres = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}
if(isset($_COOKIE['pseudo']) AND isset($_COOKIE['mdp']) && !empty($_COOKIE['pseudo']) && !empty($_COOKIE['mdp'])){
	$req_user = $bdd_membres->prepare("SELECT * FROM membres WHERE pseudo=? AND mdp=?");
	$req_user->execute(array($_COOKIE['pseudo'], $_COOKIE['mdp']));
	$user_exist = $req_user->rowCount();
	if ($user_exist == 1) {
		$user_info = $req_user->fetch();
		$_SESSION['pseudo'] = $user_info['pseudo'];
		$_SESSION['mail'] = $user_info['mail'];
		$_SESSION['status'] = $user_info['status'];
		$_SESSION['msg'] = $user_info['msg'];
	}
}
 ?>
