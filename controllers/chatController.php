<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ChatManager.php");

$chatManager = new ChatManager();

function displayUsersMessages(){
	global $chatManager;
	$messages = $chatManager->getUsersMessages();
	require_once("views/chatView.php");
}
