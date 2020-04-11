<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {

	require($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');

	$UserManager = new UsersManager();

	function sign_up(){
		require('views/sign_upView.php');
	}
	function sign_in(){
		require('views/sign_inView.php');
	}

}else{
	if(isset($_SERVER['HTTP_REFERER'])){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		header('Location: index.php');
	}
}