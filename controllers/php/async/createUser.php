<?php
$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
$UserManager = new UsersManager();
	 
if (!empty($_POST['username']) AND !empty($_POST['passwd']) AND !empty($_POST['passwd2'])) {
	$username = htmlspecialchars(strip_tags($_POST['username']));
	$passwd = $_POST['passwd'];
	$passwd2 = $_POST['passwd2'];
	$usernamelength = strlen($username);
    if($usernamelength <= 20) {
	    $is_username_exist = $UserManager->userTest($username);
	    if(!$is_username_exist){
	        if($passwd == $passwd2) {
	        	$passwd = password_hash($passwd, PASSWORD_DEFAULT);
	        	if(!empty($_POST['mail'])){
	        		$mail = htmlspecialchars(strip_tags($_POST['mail']));
	        	}else{
	        		$mail = '';
	        	}
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
		        $success = 1;
		    }else {
		        $msg = ("Vos mots de passes ne correspondent pas !");
	        }
		}else {
	        $msg = ("Le pseudo est déjà utilisé!");
		}
	} else {
		$msg = ("Votre pseudo ne doit pas dépasser 20 caractères !");
	}
} else {
	$msg = ("Tous les champs doivent être complétés !");
}

$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);