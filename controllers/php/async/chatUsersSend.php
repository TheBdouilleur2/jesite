<?php
require_once("models/ChatManager.php");

$chatManager = new ChatManager();
$success = 0;
$msg = "Une erreur est survenue (script.php)";

if (!empty($_POST['msg'])) {
	$msg = htmlspecialchars(strip_tags($_POST['msg']));
	// Plus tard, ajouter le traitement des liens et du markdown
	$chatManager->postUserMessage($msg);
	$success = 1;
	$msg = "";

} else {
	$msg = "Veuillez renseigner tous le champ de message";
}

$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);​