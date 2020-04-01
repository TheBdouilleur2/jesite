<?php

require_once("models/ChatManager.php");

$chatManager = new ChatManager();

function displayUsersMessages(){
	global $chatManager;
	$messages = $chatManager->getUsersMessages();
	require_once("views/chatView.php");
}
