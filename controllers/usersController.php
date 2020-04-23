<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {

	require_once($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');

	$UserManager = new UsersManager();
	$ProjectsManager = new ProjectsManager();
	$Parsedown = new Parsedown();

	function sign_up(){
		require_once('views/users/sign_upView.php');
	}
	function sign_in(){
		require_once('views/users/sign_inView.php');
	}

	function account(){
		$title = "Profil·JE";

		require_once($_SERVER['DOCUMENT_ROOT'] . '/views/users/account.php');
	}

	/**
	 * Affiche la page de profil d'un utilisateur
	 * @param int $id ID de l'utilisateur dont on veut afficher le profil
	 */
	function profile(int $id){
		global $UserManager, $Parsedown, $ProjectsManager;
		$user_info = $UserManager->getUserByID((int)$id);
		$user_info['age'] = getOld($user_info['login_date']);
		$user_info['bio'] = $Parsedown->line($user_info['bio']);
		$user_info['projects'] = $ProjectsManager->getProjectsByUser($id); 
		$user_info['skills'] = explode("/", $user_info['skills']);

		$title = "Profil·JE de " . $user_info['username'];

		require_once($_SERVER['DOCUMENT_ROOT'] . '/views/users/showProfile.php');
	}

	function create_user(){
		global $UserManager;
		if (!empty($_POST['username']) AND !empty($_POST['passwd']) AND !empty($_POST['passwd2'])) {
			$username = htmlspecialchars(strip_tags($_POST['username']));
			$passwd = $_POST['passwd'];
			$passwd2 = $_POST['passwd2'];
			$usernamelength = strlen($username);
			if($usernamelength <= 20) {
				$is_username_exist = $UserManager->userTest($username);
				if(!$is_username_exist){
					if($passwd == $passwd2) {
						if(!empty($_POST['mail'])){
							$mail = htmlspecialchars(strip_tags($_POST['mail']));
						}else{
							$mail = '';
						}
						$UserManager->createUser($username, $mail, $passwd);
						$user_info = $UserManager->getUser($username);
						if(isset($_POST['rememberme'])){
							setcookie('auth', $user_info['ID']."--".sha1($user_info['username'].$user_info['passwd']), time()+365*24*60*60, "/", null, false, true);
						}
						$_SESSION = $user_info;
						$_SESSION['error'] = "";
					}else {
						$msg = "Vos mots de passes ne correspondent pas !";
					}
				}else {
					$msg = "Le pseudo est déjà utilisé!";
				}
			} else {
				$msg = "Votre pseudo ne doit pas dépasser 20 caractères !";
			}
		} else {
			$msg = "Tous les champs doivent être complétés !";
		}
		if(!empty($msg)){
			$_SESSION['error'] = $msg;
			header("Location: sign_up");
		}else{
			header("Location: index.php");
		}
	}

	function connect_user(){
		global $UserManager;
		$username_connect = htmlspecialchars(strip_tags($_POST['username_connect']));
		$passwd_connect = $_POST['passwd_connect'];

		if (!empty($username_connect) && !empty($passwd_connect)) {
			$is_user_exist = $UserManager->userTest($username_connect);
			if ($is_user_exist) {
				$user_info = $UserManager->getUser($username_connect);
				if(password_verify($passwd_connect, $user_info['passwd'])){
					$_SESSION = $user_info;
					$success = 1;
					if(isset($_POST['rememberme'])){
						setcookie('auth', $user_info['ID']."--".sha1($user_info['username'].$user_info['passwd']), time()+365*24*60*60, "/", null, false, true);
					}
				}else{
					$msg = "Mot de passe incorrect";
				}							
			}else{
				$msg = "Pseudo inconnu, si vous n'avez pas de compte, créez en un <a href='sign_up'>ici</a>";
			}
		}else{
			$msg = 'Tout les champs doivent être remplis';
		}
		if(!empty($msg)){
			$_SESSION['error'] = $msg;
			header("Location: sign_in");
		}else{
			$_SESSION['error'] = "";
			header("Location: index.php");
		}
	}

}else{
	if(isset($_SERVER['HTTP_REFERER'])){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		header('Location: index.php');
	}
}