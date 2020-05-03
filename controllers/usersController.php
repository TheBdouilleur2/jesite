<?php

require_once("Controller.php");

class UsersController extends Controller{

	public function __construct(){
		$this->loadModel("Users");
		$this->loadModel("Projects");
	}

	public function sign_up(){
		$this->setVariables("title", "Créer un compte·JE");
		$this->render("users", "sign_up");
	}

	public function sign_in(){
		$this->setVariables("title", "Se connecter·JE");
		$this->render("users", "sign_in");
	}

	public function account(){
		$this->setVariables("title", "Profil·JE");
		$this->render("users", "account");
	}

	/**
	 * Affiche la page de profil d'un utilisateur
	 * @param int $id ID de l'utilisateur dont on veut afficher le profil
	 */
	public function profile(int $user_id){
		$user_info = $this->Users->getUserByID((int)$user_id);
		$user_info['projects'] = $this->Projects->getProjectsByUser($user_id); 

		$this->setVariables(array(
			"title"=>"Profil·JE de " . $user_info['username'],
			"user_info"=>$user_info
		));

		$this->render("users", "showProfile");
	}

	public function create_user(){
		if (!empty($_POST['username']) AND !empty($_POST['passwd']) AND !empty($_POST['passwd2'])) {
			$username = htmlspecialchars(strip_tags($_POST['username']));
			$passwd = $_POST['passwd'];
			$passwd2 = $_POST['passwd2'];
			if(strlen($username) <= 20) {
				$isUsernameExist = $this->Users->userTest($username);
				if(!$isUsernameExist){
					if($passwd == $passwd2) {
						$mail = "";
						if(!empty($_POST['mail'])){
							$mail = htmlspecialchars(strip_tags($_POST['mail']));
						}
						$this->Users->createUser($username, $mail, $passwd);
						$user_info = $this->Users->getUser($username);
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
		$location = "index.php";
		if(!empty($msg)){
			$_SESSION['error'] = $msg;
			$location = "sign_up";
		}
		header("Location: $location");
	}

	public function connect_user(){
		$username_connect = htmlspecialchars(strip_tags($_POST['username_connect']));
		$passwd_connect = $_POST['passwd_connect'];
		$success = 0;

		if (!empty($username_connect) && !empty($passwd_connect)) {
			$is_user_exist = $this->Users->userTest($username_connect);
			if ($is_user_exist) {
				$user_info = $this->Users->getUser($username_connect);
				$success = 1;
				if(password_verify($passwd_connect, $user_info['passwd'])){
					$_SESSION = $user_info;
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
		if($success === 1){
			$_SESSION['error'] = "";
			header("Location: index.php");
		}else{
			$_SESSION['error'] = $msg;
			header("Location: sign_in");
		}
	}

}
//TODO vider sesion error