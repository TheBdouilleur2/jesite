<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatManager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/functions.php");

$chatManager = new ChatManager();

function displayUsersMessages(){
	if (isset($_SESSION['ID'])) {
		global $chatManager;
		$messages = $chatManager->getUsersMessages();
		$sending_dates = array();
		foreach($messages[2] as $sending_date){
			$sending_dates[] = getOld($sending_date);
		}
		$title = 'Discussion';
		$chat_category = 'user';
		require_once("views/chat/chatView.php");
	}else {
		header("Location: index.php");
	}
}

function displayAdminMessages(){
	if(isset($_SESSION['ID']) && $_SESSION['state'] === 'admin'){
		global $chatManager;
		$messages = $chatManager->getAdminMessages();
		$sending_dates = array();
		foreach($messages[2] as $sending_date){
			$sending_dates[] = getOld($sending_date);
		}
		$title = 'Discussion admin';
		$chat_category = 'admin';
		require_once("views/chat/chatView.php");
	}else {
		header('Location: index.php');
	}
}
