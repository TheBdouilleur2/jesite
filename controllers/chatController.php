<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatsManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/functions.php");

$ChatsManager = new ChatsManager();

function displayUsersMessages($page = 1){
	if (isset($_SESSION['ID'])) {
		global $ChatsManager;
		$perPage = 20;
    	$nbMessages = $ChatsManager->getNumberUsersMessages();
    	$nbPage = ceil($nbMessages/$perPage);

    	$page = !($page>0 && $page<=$nbPage) ? 1 : $page;

		$messages = $ChatsManager->getUsersMessages($page, $perPage);
		$title = 'Discussion·JE';
		require_once("views/chat/chatView.php");
	}else {
		header("Location: index.php");
	}
}

function displayAdminMessages($page = 1){
	if(isset($_SESSION['ID']) && $_SESSION['state'] === 'admin'){
		global $ChatsManager;
		$perPage = 20;
    	$nbMessages = $ChatsManager->getNumberAdminMessages();
    	$nbPage = ceil($nbMessages/$perPage);

    	$page = !($page>0 && $page<=$nbPage) ? 1 : $page;
		$messages = $ChatsManager->getAdminMessages($page, $perPage);
		$title = 'Discussion admin·JE';
		require_once("views/chat/chatAdmin.php");
	}
	header('Location: index.php');
}
