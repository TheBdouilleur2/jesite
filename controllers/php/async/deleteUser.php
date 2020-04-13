<?php
session_start();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
$UserManager = new UsersManager();

$id = (int)$_POST['id'];

if($id !== $_SESSION['ID']){
    $UserManager->deleteUser($id);
    $success = 1;
}

echo json_encode(compact('success', 'msg'));