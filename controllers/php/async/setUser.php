<?php
session_start();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
$UserManager = new UsersManager();

$user = $UserManager->getUserByID($_SESSION['ID']);

extract($_POST);

if(isset($new_username) && $new_username !== $_SESSION['username']){
    $newUsername = htmlspecialchars($new_username);
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

if(isset($new_mail) && $new_mail !== $_SESSION['mail']){
    $newMail = htmlspecialchars($new_mail);
    if(filter_var($newMail, FILTER_VALIDATE_EMAIL)){
        $UserManager->setMail($_SESSION['ID'], $newMail);
        $_SESSION['mail'] = $newMail;
        $success = 1;
    }
}

if(!empty($new_passwd)){
    if(!empty($new_passwd2)){
        $newPasswd = htmlspecialchars($new_passwd);
        $newPasswd2 = htmlspecialchars($new_passwd2);
        if($newPasswd == $newPasswd2){
            $user = $UserManager->getUser($_SESSION['username']);
            if(!password_verify($newPasswd, $user['passwd'])){
                $UserManager->setPasswd($_SESSION['ID'], $newPasswd);
                $success = 1;
            }else{
                $msg = 'Le mot de passe renseigné n\'est pas nouveau';
            }
        }else{
            $msg = 'Les mots de passes ne correspondent pas!';
        }
    }else{
        $msg = 'Veuillez confirmer votre mot de passe!';
    }
}

if(isset($bio) && $bio !== $_SESSION['bio']){
    $bio = htmlspecialchars($bio);
    $UserManager->setBio($_SESSION['ID'], $bio);
    $_SESSION['bio'] = $bio;
    $success = 1;
}

if(isset($skills) && $skills !== $_SESSION['skills']){
    $skills = htmlspecialchars($skills);
    $UserManager->setSkills($_SESSION['ID'], $skills);
    $_SESSION['skills'] = $skills;
    $success = 1;
}


echo json_encode(compact('success', 'msg'));
