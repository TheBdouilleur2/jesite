<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/CommentsManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/Parsedown.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/functions.php");

$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

$CommentsManager = new CommentsManager();
$UsersManager = new UsersManager();

$success = 0;
$msg = "Une erreur est survenue (script.php)";



if (!empty($_POST['msg'])) {
	$msg = htmlspecialchars(strip_tags($_POST['msg']));
	
	$msg = preg_replace_callback('#@([A-Za-z0-9]+)#', "userMention", $msg);

	$project_id = explode("/", $_POST['path'])[2];

	$msg = $Parsedown->line($msg);
    
	$CommentsManager->postComment($project_id, $_SESSION['ID'], $msg);
	$success = 1;
} else {
	$msg = "Veuillez écrire un message";
}
echo json_encode(compact("success", "msg")); 
// La fonction compact() crée un tableau contenant le nom des variables et leur valeurs
