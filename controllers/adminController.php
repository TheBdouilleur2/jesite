<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id']) && $_SESSION['state'] === 'admin') {

	require($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');

    $UserManager = new UsersManager();
    
    function index(){
        global $UserManager;
        $title = 'Espace Admin·JE';
        $users = $UserManager->getUsers(0);
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin/index.php');
    }

}else{
    header("Location: index.php");
}