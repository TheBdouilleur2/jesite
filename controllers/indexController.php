<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');

$userManager = new UsersManager();
$userManager->connectUser();
if (isset($_SESSION['ID'])) {
	$msg = $_SESSION['msg'];
}else{
	$msg = 'Bienvenue sur le page d\'accueil, tu peux trouver ici plein de choses super.';
}

require_once('views/indexView.php');
?>
