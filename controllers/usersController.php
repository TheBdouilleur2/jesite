<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {

	require($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');

	$UserManager = new UsersManager();


	if (isset($_POST['formconnection'])) {
		$username_connect = htmlspecialchars($_POST['username_connect']);
		$passwd_connect = $_POST['passwd_connect'];
		if (!empty($username_connect) && !empty($passwd_connect)) {
			$is_user_exist = ($UserManager->userTest($username_connect));
			if ($is_user_exist) {
				$user_info = $UserManager->getUser($username_connect);
				if(password_verify($passwd_connect, $user_info['passwd'])){
					$_SESSION['ID'] = $user_info['ID'];
				$_SESSION['username'] = $user_info['username'];
				$_SESSION['mail'] = $user_info['mail'];
				$_SESSION['state'] = $user_info['state'];
				$_SESSION['msg'] = $user_info['msg'];
				if(isset($_POST[rememberme])){
					setcookie('username', $username_connect, time()+365*24*60*60);
					setcookie('passwd', $passwd_connect, time()+365*24*60*60);
				}
				header('Location: index.php');
			}else{
				$error = "Mot de passe incorect";
			}							
			}else{
				$error = 'Pseudo inconnu, si vous n\'avez pas de compte, créé en un <a href="index.php?url=sign_up">ici</a>';
				require('views/sign_inView.php');
			}
		}else{
			$error = 'Tout les champs doivent être remplis';
			require('views/sign_inView.php');
		}
	}
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
		header('index.php');
	}
}