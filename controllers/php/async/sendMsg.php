<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/Parsedown.php");

$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

$ChatManager = new ChatManager();
$UsersManager = new UsersManager();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

function userMention($matches){
	global $UsersManager;
	if($UsersManager->userTest($matches[1])){
		$user_info = $UsersManager->getUser($matches[1]);
		$mention = '[**'.$matches[0].'**](/profile/'. $user_info['ID'] .')';
	}else{
		$mention = '**'.$matches[0].'**';
	}
	return $mention;
}

if (!empty($_POST['msg'])) {
	$msg = htmlspecialchars(strip_tags($_POST['msg']));
	
	$msg = preg_replace_callback('#@([A-Za-z0-9]+)#', "userMention", $msg);
	

	$msg = $Parsedown->line($msg);

	if($_POST['category'] === 'user'){
		$ChatManager->postUserMessage($msg, $_SESSION['ID']);
		$success = 1;
		$msg = "";
	}elseif ($_POST['category'] === 'admin') {
		$ChatManager->postAdminMessage($msg, $_SESSION['ID']);
		$success = 1;
		$msg = "";
	}
	

} else {
	$msg = "Veuillez un message à envoyer";
}
echo json_encode(compact("success", "msg", "post")); 
// La fonction compact() crée un tableau contenant le nom des variables et leur valeurs
