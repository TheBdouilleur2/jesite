<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/Parsedown.php");

$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

$chatManager = new ChatManager();
$success = 0;
$msg = "Une erreur est survenue (script.php)";

if (!empty($_POST['msg'])) {
	$msg = htmlspecialchars(strip_tags($_POST['msg']));
	
	// TODO: ajouter le traitement des liens

	$msg = $Parsedown->line($msg);

	if($_POST['category'] === 'user'){
		$chatManager->postUserMessage($msg, $_SESSION['ID']);
		$success = 1;
		$msg = "";
	}elseif ($_POST['category'] === 'admin') {
		$chatManager->postAdminMessage($msg, $_SESSION['ID']);
		$success = 1;
		$msg = "";
	}
	

} else {
	$msg = "Veuillez renseigner tous les champs du message";
}
echo json_encode(compact("success", "msg", "post")); 
// La fonction compact() crée un tableau contenant le nom des variables et leur valeurs
