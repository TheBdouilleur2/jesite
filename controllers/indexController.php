<?php
session_start();
require ('models/UsersManager.php');

$userManager = new UsersManager();
$userManager->connectUser();
if (isset($_SESSION['ID'])) {
	$msg = $_SESSION['msg'];
}else{
	$msg = 'Bienvenue sur le page d\'accueil, tu peux trouver ici plein de chose super.';
}

require('views/indexView.php');
?>