<?php
session_start();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/UsersManager.php");
$UserManager = new UsersManager();

$id = (int)$_POST['id'];

$user = $UserManager->getUserByID($id);

if($user['state'] === 'admin'){
    $UserManager->setState($id, 'user');
    $msg = '';
    $success = 1;
}
elseif($user['state'] === 'user'){
    $UserManager->setState($id, 'admin');
    $msg = '';
    $success = 1;
}
$msg = $id;

echo json_encode(compact('success', 'msg'));