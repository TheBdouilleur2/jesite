<?php
session_start();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
$UserManager = new UsersManager();

$username_connect = htmlspecialchars(strip_tags($_POST['username_connect']));
$passwd_connect = $_POST['passwd_connect'];

if (!empty($username_connect) && !empty($passwd_connect)) {
    $is_user_exist = $UserManager->userTest($username_connect);
    if ($is_user_exist) {
        $user_info = $UserManager->getUser($username_connect);
        if(password_verify($passwd_connect, $user_info['passwd'])){
            $_SESSION['ID'] = $user_info['ID'];
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['mail'] = $user_info['mail'];
            $_SESSION['state'] = $user_info['state'];
            $_SESSION['bio'] = $user_info['bio'];
            $_SESSION['skills'] = $user_info['skills'];
            $success = 1;
            if(isset($_POST['rememberme'])){
                setcookie('username', $username_connect, time()+365*24*60*60);
                setcookie('passwd', $passwd_connect, time()+365*24*60*60);
            }
        }else{
            $msg = "Mot de passe incorrect";
        }							
    }else{
        $msg = "Pseudo inconnu, si vous n'avez pas de compte, créez en un";
    }
}else{
    $msg = 'Tout les champs doivent être remplis';
} 

echo json_encode(compact('success', 'msg'));
