<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/functions.php");

$ChatManager = new ChatManager();

function displayUsersMessages($page = 1){
	if (isset($_SESSION['ID'])) {
		global $ChatManager;
		$perPage = 20;
    	$nbMessages = $ChatManager->getNumberUsersMessages();
    	$nbPage = ceil($nbMessages/$perPage);

    	$page = !($page>0 && $page<=$nbPage) ? 1 : $page;

		$messages = $ChatManager->getUsersMessages($page, $perPage);
		for($i = 0; $i< count($messages); $i++){
			$messages[$i]['age'] = getOld($messages[$i]['sending_date']);
		}
		$title = 'Discussion·JE';
		require_once("views/chat/chatView.php");
	}else {
		header("Location: index.php");
	}
}

function displayAdminMessages($page = 1){
	if(isset($_SESSION['ID']) && $_SESSION['state'] === 'admin'){
		global $ChatManager;
		$perPage = 20;
    	$nbMessages = $ChatManager->getNumberAdminMessages();
    	$nbPage = ceil($nbMessages/$perPage);

    	$page = !($page>0 && $page<=$nbPage) ? 1 : $page;
		$messages = $ChatManager->getAdminMessages($page, $perPage);
		for($i = 0; $i< count($messages); $i++){
			$messages[$i]['age'] = getOld($messages[$i]['sending_date']);
		}
		$title = 'Discussion admin·JE';
		require_once("views/chat/chatAdmin.php");
	}else {
		header('Location: index.php');
	}
}
