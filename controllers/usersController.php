<?php
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {

	require('models/UsersManager.php');

	$UserManager = new UsersManager();

	if (isset($_POST['formregistration'])) {
	   if (!empty($_POST['username']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['passwd']) AND !empty($_POST['passwd2'])) {
		$username = htmlspecialchars($_POST['username']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$passwd = $_POST['passwd'];
		$passwd2 = $_POST['passwd2'];
		$usernamelength = strlen($username);
	    if($usernamelength <= 20) {
		    $is_username_exist = $UserManager->userTest($username);
		    if(!($is_username_exist)){
			    if($mail == $mail2) {
	            	if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
	                	$is_mail_exist = $UserManager->mailTest($mail);
	                	if(!($is_mail_exist)){
		               		if($passwd == $passwd2) {
		                 	    $passwd = sha1($passwd);
		                  		$UserManager->createUser($username, $mail, $passwd);
			              		if(isset($_POST['rememberme'])){
			              			setcookie('username', $username, time()+365*24*60*60, null, null, false, true);
			              	 	    setcookie('passwd', $passwd, time()+365*24*60*60, null, null, false, true);
		                   		}
		                   		$user_info = $UserManager->getUser($username);
		                   		$_SESSION['ID'] = $user_info['ID'];
		                  	  	$_SESSION['username'] = $user_info['username'];
		                  	  	$_SESSION['mail'] = $user_info['mail'];
		                  	  	$_SESSION['state'] = $user_info['state'];
		                  	  	$_SESSION['msg'] = $user_info['msg'];
		                   		header('Location: index.php');
		                    }else {
		                       $error = ("Vos mots de passes ne correspondent pas !");
		                       require('views/sign_upView.php');
		                    }
		                }else{
		                    $error = ("Adresse mail déjà utilisée !");
		                    require('views/sign_upView.php');
		                }
	        		} else {
			            $error = ("Votre adresse mail n'est pas valide !");
			            require('views/sign_upView.php');
			        }
			    } else {
			        $error = ("Vos adresses mail ne correspondent pas !");
			        require('views/sign_upView.php');
			    }
		    }else {
	        			$error = ("Le pseudo est déjà utilisé!");
			    		require('views/sign_upView.php');
			    	}
		} else {
		    $error = ("Votre pseudo ne doit pas dépasser 20 caractères !");
		    require('views/sign_upView.php');
		}
	} else {
		$error = ("Tous les champs doivent être complétés !");
		require('views/sign_upView.php');
	}
}

	if (isset($_POST['formconnection'])) {
		$username_connect = htmlspecialchars($_POST['username_connect']);
		$passwd_connect = sha1($_POST['passwd_connect']);
		if (!empty($username_connect) && !empty($passwd_connect)) {
			$is_user_exist = ($UserManager->userTest($username_connect)) && $UserManager->passwdTest($passwd_connect);
			if ($is_user_exist) {
				$user_info = $UserManager->getUser($username_connect);
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
				$error = 'Pseudo et mot de passe inconnus, si vous n\'avez pas de compte, créé en un <a href="index.php?url=sign_up">ici</a>';
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