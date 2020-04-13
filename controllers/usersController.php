<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {

	require($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');

	$UserManager = new UsersManager();

	function sign_up(){
		require('views/users/sign_upView.php');
	}
	function sign_in(){
		require('views/users/sign_inView.php');
	}

	function profile(){
		$title = "Profil";

		require_once($_SERVER['DOCUMENT_ROOT'] . '/views/users/profile.php');
	}

}else{
	if(isset($_SERVER['HTTP_REFERER'])){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		header('Location: index.php');
	}
}