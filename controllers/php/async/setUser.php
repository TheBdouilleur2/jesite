<?php
session_start();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
$UserManager = new UsersManager();

$newUsername = htmlspecialchars(strip_tags($_POST['new_username']));
$newMail = htmlspecialchars(strip_tags($_POST['new_mail']));
$newPasswd = htmlspecialchars(strip_tags($_POST['new_passwd']));
$newPasswd2 = htmlspecialchars(strip_tags($_POST['new_passwd2']));

if(isset($newUsername) && $newUsername !== $_SESSION['username']){
    if (strlen($newUsername) < 21) {
        $is_username_exist = $UserManager->userTest($newUsername);
        if(!$is_username_exist){
            $UserManager->setUsername($_SESSION['ID'], $newUsername);
            $_SESSION['username'] = $newUsername;
            $success = 1;
        }else{
            $msg = "Ce pseudo est déjà utilisé!";
        }
    }else{
        $msg = "Votre nouveau pseudo est trop long!";
    }
}

if(isset($newMail) && $newMail !== $_SESSION['mail']){
    if(filter_var($newMail, FILTER_VALIDATE_EMAIL)){
        $UserManager->setMail($_SESSION['ID'], $newMail);
        $_SESSION['mail'] = $newMail;
        $success = 1;
    }
}

if(isset($newPasswd)){
    if(isset($newPasswd2)){
        if($newPasswd == $newPasswd2){
            $user = $UserManager->getUser($_SESSION['username']);
            if(!password_verify($newPasswd, $user['passwd'])){
                $UserManager->setPasswd($_SESSION['ID'], $newPasswd);
                $_SESSION['passwd'] = $newPasswd;
                $success = 1;
            }else{
                $msg = 'Le mot de passe renseigné n\'est pas nouveau';
            }
        }else{
            $msg = 'Les mots de passes ne corespondent pas!';
        }
    }else{
        $msg = 'Veuillez confirmer votre mot de passe!';
    }
}

echo json_encode(compact('success', 'msg'));