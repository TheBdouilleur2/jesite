<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatsManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/functions.php");


$ChatsManager = new ChatsManager();
$UsersManager = new UsersManager();

$success = 0;
$msg = "Une erreur est survenue (script.php)";


if (!empty($_POST['msg'])) {
	$msg = htmlspecialchars(strip_tags($_POST['msg']));
	
	$msg = preg_replace_callback('#@([A-Za-z0-9]+)#', "userMention", $msg);

	if($_POST['category'] === 'user'){
		$ChatsManager->postUserMessage($msg, $_SESSION['ID']);
		$success = 1;
		$msg = "";
	}elseif ($_POST['category'] === 'admin') {
		$ChatsManager->postAdminMessage($msg, $_SESSION['ID']);
		$success = 1;
		$msg = "";
	}
	

} else {
	$msg = "Veuillez écrire un message à envoyer";
}
echo json_encode(compact("success", "msg", "post")); 
// La fonction compact() crée un tableau contenant le nom des variables et leur valeurs
